<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sina_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		include_once FCPATH. "key/api/weibopay.class.php";
    }
	
	//认证信息 手机或邮箱
	function binding_verify($id = false,$type = "MOBILE",$verify_entity = false) //MOBILE EMAIL
	{
		$post['verify_type'] = $type;
		$post['identity_id'] = $id;	
		$post['identity_type'] = 'UID';
		$post['verify_entity'] = $this->encode($verify_entity);
		$post['service'] = 'binding_verify'; //认证类型
		return $this->_interface_submit($post);
	}
	
	//查询是否设置交易密码
	function query_is_set_pay_password($uid = false)
	{
		$post['service'] = "query_is_set_pay_password";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$return = $this->_interface_submit($post);
		return $return[1]['is_set_paypass'] == "Y"?true:false;
	}
	//设置交易密码
	function set_pay_password($uid = false)
	{
		$post['service'] = "set_pay_password";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$post['return_url'] = site_url("company/main");
		$return = $this->_interface_submit($post);
		redirect($return[1]['redirect_url']);
	}
	
	//解除认证信息绑定
	function unbinding_verify($id = false,$type = "MOBILE")//MOBILE EMAIL
	{
		$post['verify_type'] = $type;
		$post['identity_id'] = $id;	
		$post['identity_type'] = 'UID';
		$post['service'] = 'unbinding_verify'; //认证类型
		return $this->_interface_submit($post);	
	}
	
	//查询余额
	function query_balance($id = false)
	{
		$post['identity_id'] = $id;	
		$post['identity_type'] = 'UID';	
		//$post['account_type'] = "";
		$post['extend_param'] = "";
		$post['account_type'] = "BASIC"; //存钱罐
		$post['service'] = "query_balance";
		return $this->_interface_submit($post);
	}
	
	//实名认证
	function set_real_name($uid = false,$real_name = false,$cert_no = false)
	{
		$post['identity_id'] = $uid;	
		$post['identity_type'] = 'UID';	
		//$post['account_type'] = "";
		$post['extend_param'] = "";
		$weibopay = new Weibopay ();
		$post['real_name'] = $weibopay->Rsa_encrypt($real_name,sinapay_rsa_public__key); //真实姓名
		$post['cert_type'] = "IC";//身份证件类型
		$post['cert_no'] = $weibopay->Rsa_encrypt($cert_no,sinapay_rsa_public__key); //身份证号
		$post['service'] = "set_real_name";
		return $this->_interface_submit($post);	
	}
	
	function query_verify($uid = false,$type = "MOBILE")
	{
		$post['identity_type'] = "UID";
		$post['identity_id'] = $uid;
		$post['verify_type'] = $type;
		$post['service'] = "query_verify";
		return $this->_interface_submit($post);	
	}
	
	//托管充值  pay_type 支付类型 + 支付内容字符串 trade_no 支付订单号
	function create_hosting_deposit($trade_no = false,$pay_type = array(),$monkey = false)
	{
		$userinfo = companyinfo();
		$post['out_trade_no'] = $trade_no;
		$post['summary'] = "账户充值";
		$post['identity_id'] = $userinfo['id'];	
		$post['identity_type'] = "UID";
		$post['account_type'] = "BASIC";//基本户
		$post['amount'] = $monkey;//充值金额
		//$post['user_fee'] = 0; //用户充值手续费
		$post['pay_method'] = $pay_type[1];//支付方式 online_bank quick_pay binding_pay"online_bank^1.00^TESTBANK,DEBIT,C"
		$post['service'] = "create_hosting_deposit";
		$post['notify_url'] = site_url('sinanotify/recharge');//异步跳转
		$post['return_url'] = site_url('company/main');//同步跳转
		$post['version'] = "1.0";	
		$post['user_fee'] = 10;
		$post['request_time'] = date("YmdHis");
		$post['partner_id'] = sinapay_partner_id;
		$post['_input_charset'] = sinapay_input_charset;
		$post['sign_type'] = "RSA";
		$weibopay = new Weibopay ();
		ksort($post);
		$post['sign'] = $weibopay->getSignMsg($post,$post['sign_type']);
		//网银在线支付
		$html="<form name='sinapay_checkout' id='sinapay_checkout' method='post'>";
		foreach ($post as $key => $val)
		{
			$html.="<input type='hidden' name='".$key."' value='".urlencode($val)."'/>";
		}
		$html.= "<script type = 'text/javascript'>";
		$html.="document.sinapay_checkout.action = '".sinapay_pay_url."';";
		$html.="document.sinapay_checkout.submit();";
		$html.="</script>";
		echo $html;
		exit();		
	}
	

	
	//托管提现金
	function create_hosting_withdraw($order = false,$uid = false,$monkey = false,$shouxufei = false)
	{
		$post['out_trade_no'] = $order;
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$post['account_type'] = "BASIC";
		$post['amount'] = $monkey;
		//$post['card_id'] = $card_id;
		$post['user_fee'] = $shouxufei;
		
		$post['notify_url'] = site_url('sinanotify/withdraw');//异步跳转
		$post['return_url'] = site_url('company/main/record');
		$post['service'] = "create_hosting_withdraw";
		$return = $this->_interface_submit($post,'mas');
		
		return $return;
		
	}
	
	//代付利息
	function pay_repayment($out_trade_no = false,$goodsid = "",$uid = false,$total = false)
	{
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  1002; //待收还款金
		$post['summary'] = $goodsid."项目还款";
		$post['goods_id'] = $goodsid; //散标ID
		$post['payer_id'] = $uid;//付款用户ID
		$post['payer_identity_type'] = "UID";
		$post['pay_method'] = "online_bank^".$total."^SINAPAY,DEBIT,B"; //余额支付  存钱罐支付
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		$post['trade_close_time'] = "10m";
		$post['notify_url'] = site_url('sinanotify/pay_repayment');//异步跳转
		$post['return_url'] = site_url('company/main/repayment');//异步跳转
		
		return $this->_interface_submit($post,'mas');
	}
	
	
	//查询银行卡
	function query_bank_card()
	{
		$userinfo = companyinfo();
		$post['identity_id'] = $userinfo['id'];	
		$post['identity_type'] = "UID";
		$post['service'] = "query_bank_card";
		return $this->_interface_submit($post);
	}
	//解除银行卡绑定 
	function unbinding_bank_card($card_id = false)
	{
		$userinfo = userinfo();
		$post['identity_id'] = $userinfo['id'];	
		$post['identity_type'] = "UID";
		$post['card_id'] = $card_id;
		$post['service'] = "unbinding_bank_card";
		return $this->_interface_submit($post);
	}
	
	//冻结余额
	function balance_freeze($uid = false)
	{
		$post['out_freeze_no'] = "";//冻结余额订单号
		$post['identity_id'] = $uid; //用户ID
		$post['identity_type'] = "UID";
		$post['account_type'] = "SAVING_POT";//账户类型	
		$post['amount'] = $amount;//冻结的金额数
		$post['summary'] = "";//冻结金额备注
		return $this->_interface_submit($post);
	}
	
	//解冻余额
	function balance_unfreeze($uid = false)
	{
		$post['out_unfreeze_no'] = "";
		$post['out_freeze_no'] = "";
		$post['identity_id'] = $uid; //用户ID
		$post['identity_type'] = "UID";
		$post['amount'] = "";//解冻金额
		$post['summary'] = "";//摘要
		return $this->_interface_submit($post);	
	}
	
	//加密方式 部分字段需要加密传输
	function encode($str = false)
	{
		$weibopay = new Weibopay ();
		return 	$weibopay->Rsa_encrypt($str,sinapay_rsa_public__key);
	}
	
	
	//查询企业会员信息
	function query_member_infos($uid = false)
	{
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";	
		$post['member_type'] = 2;
		$post['service'] = "query_member_infos";
		return $this->_interface_submit($post);
	}
	
	
	//提交接口  //mgs url sinapay_wpay_url mas url sinapay_pay_url
	function _interface_submit($post=false,$type = "mgs")
	{
		//公用post信息
		$post['version'] = "1.0";	
		$post['request_time'] = date("YmdHis");
		$post['partner_id'] = sinapay_partner_id;
		$post['_input_charset'] = sinapay_input_charset;
		$post['sign_type'] = "RSA";
		//公共post结束
		if($type == "mgs")
		{
			$url = 	sinapay_wpay_url;
			$in_attr['type'] = 1;			
		}
		else
		{
			$url = sinapay_pay_url;	
			$in_attr['type'] = 2;			
		}
		$weibopay = new Weibopay ();
		ksort($post);
		
		
		$post['sign'] = $weibopay->getSignMsg($post,$post['sign_type']);
		$in_attr['content'] = json_encode($post);

		$data = $weibopay->createcurl_data($post);
		$result = $weibopay->curlPost($url,$data); // 使用模拟表单提交进行数据提交
		
		$result = urldecode ($result);
		
		$splitdata = array ();
		$splitdata = json_decode($result,true);
		if(!isset($splitdata['response_code']))
		{

			return array(0,$result);	
		}
		$sign_type = $splitdata ['sign_type'];//签名方式
		ksort($splitdata); // 对签名参数据排序
		$in_attr['dateline'] = date('Y-m-d H:i:s');
		if ($weibopay->checkSignMsg ($splitdata,$sign_type)) {
			$in_attr['return_msg'] = json_encode($splitdata);

			if ($splitdata["response_code"] == 'APPLY_SUCCESS') { // 成功
					$in_attr['return'] = 1;

					if($in_attr['type'] ==2)
					{

						$this->db->insert('sina_log',$in_attr);
					}					
					return array(0,$splitdata);//exit();
				} else {	//失败

					$in_attr['return'] = 2;
					if($in_attr['type'] ==2)
					{
	
						$this->db->insert('sina_log',$in_attr);
					}				
					return array(1,$splitdata['response_message']);
					exit();
				}
			} 
			else {
					$in_attr['return'] = 2;
					if($in_attr['type'] ==2)
					{
						$this->db->insert('sina_log',$in_attr);
					}			
				return array(1,$splitdata['response_message']);//exit();
		}
		
	}
}