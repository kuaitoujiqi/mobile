<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sina_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
		include_once FCPATH. "key/api/weibopay.class.php";
    }
	//开户
	function create_activate_member($id = false)
	{	$post['client_ip'] = '182.92.67.0';
		$post['identity_id'] = $id;	
		$post['identity_type'] = 'UID';
		$post['member_type'] = 1; //会员类型
		$post['extend_param'] = '';
		$post['service'] = 'create_activate_member';
		return $this->_interface_submit($post);
	}
	
	//认证信息 手机或邮箱
	function binding_verify($id = false,$type = "MOBILE",$verify_entity = false) //MOBILE EMAIL
	{	$post['client_ip'] = '182.92.67.0';
		$post['verify_type'] = $type;
		$post['identity_id'] = $id;	
		$post['identity_type'] = 'UID';
		$post['verify_entity'] = $this->encode($verify_entity);
		$post['service'] = 'binding_verify'; //认证类型
		return $this->_interface_submit($post);
	}
	
	//解除认证信息绑定
	function unbinding_verify($id = false,$type = "MOBILE")//MOBILE EMAIL
	{	$post['client_ip'] = '182.92.67.0';
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
		$post['account_type'] = "SAVING_POT"; //存钱罐
		$post['service'] = "query_balance";
		return $this->_interface_submit($post);
	}
	
	//实名认证
	function set_real_name($uid = false,$real_name = false,$cert_no = false)
	{	$post['client_ip'] = '182.92.67.0';
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

	//托管充值   将旧接口替换掉
	function create_hosting_deposit_new($trade_no = false,$pay_type = array(),$monkey = false,$moblie = false){
		$userinfo = userinfo();	
		$ip = $this->session->userdata('ip');
		$post['payer_ip'] = $ip;
		$post['out_trade_no'] = $trade_no; 		//交易订单号
		$post['summary'] = "账户充值";  		//摘要
		$post['identity_id'] = $userinfo['id']; //用户标识信息
		$post['identity_type'] = "UID"; 		//用户标识类型
		$post['account_type'] = "SAVING_POT"; 	//账户类型
		$post['amount'] = $monkey; 				//金额
		//$post['user_fee'] = 0;				//用户手续费
		//付款用户IP地址
		$post['pay_method'] = "online_bank^".$monkey."^SINAPAY,DEBIT,C";		//支付方式
		//$post['extend_param'] = //扩展信息
		$post['service'] = "create_hosting_deposit";	//调用接口
		$post['notify_url'] = site_url('sinanotify/recharge');	//异步跳转
		if($moblie == "m")
		{
			$post['return_url'] = site_url('m/usercenter/recharge_success');//同步跳转
		}
		else
		{
			$post['return_url'] = site_url('usercenter/recharge_success');//同步跳转
		}
		
		return $this->_interface_submit($post,'mas');	
	}	
	
	//托管充值  pay_type 支付类型 + 支付内容字符串 trade_no 支付订单号
	function create_hosting_deposit($trade_no = false,$pay_type = array(),$monkey = false,$moblie = false)
	{
		$userinfo = userinfo();
		$ip = $this->session->userdata('ip');
		$post['payer_ip'] = $ip;
		$post['out_trade_no'] = $trade_no;
		$post['summary'] = "账户充值";
		$post['identity_id'] = $userinfo['id'];	
		$post['identity_type'] = "UID";
		$post['account_type'] = "SAVING_POT";//存钱罐
		$post['amount'] = $monkey;//充值金额
		//$post['user_fee'] = 0; //用户充值手续费
		$post['pay_method'] = $pay_type[1];//支付方式 online_bank quick_pay binding_pay"online_bank^1.00^TESTBANK,DEBIT,C"
		$post['service'] = "create_hosting_deposit";
		$post['notify_url'] = site_url('sinanotify/recharge');//异步跳转
		if($moblie == "m")
		{
			$post['return_url'] = site_url('m/usercenter/recharge_success');//同步跳转
		}
		else
		{
			$post['return_url'] = site_url('usercenter/recharge_success');//同步跳转
		}
		
		$post['version'] = "1.0";	
		$post['request_time'] = date("YmdHis");
		$post['partner_id'] = sinapay_partner_id;
		$post['_input_charset'] = sinapay_input_charset;
		$post['sign_type'] = "RSA";
		
				
		if($pay_type[0] == "online_bank")
		{
			$weibopay = new Weibopay ();
			ksort($post);
			$post['sign'] = $weibopay->getSignMsg($post,$post['sign_type']);
			
			
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
		else
		{
			if($pay_type[0] == "binding_pay")
			{
				//绑卡支付
				return $this->_interface_submit($post,'mas');	
			}
		}
		return array(1,'请选择正确的支付方式');
	}
	
	//支付推进
	function advance_hosting_pay($out_advance_no = false,$ticke = false,$validate_code = false)
	{	 $ip = $this->session->userdata('ip');
		$post['user_ip'] = $ip;
		$post['out_advance_no'] = $out_advance_no;//订单号
		$post['ticket'] = $ticke;//新浪支付返回的校验码
		$post['validate_code'] = $validate_code;//短信验证码
		$post['service'] = "advance_hosting_pay";
		return $this->_interface_submit($post,'mas');
	}
	
	//托管提现金
	function create_hosting_withdraw($order = false,$uid = false,$monkey = false,$card_id = false,$user_fee = false,$type = 1)
	{	
		$ip = $this->session->userdata('ip');
		$post['user_ip'] = $ip;
		$post['out_trade_no'] = $order;
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$post['account_type'] = "SAVING_POT";
		$post['amount'] = $monkey;
		$post['user_fee'] = $user_fee;//手续费
		//$post['card_id'] = $card_id;//卡
		$post['notify_url'] = site_url('sinanotify/u_withdraw');//异步跳转
		if($type == 2){
			$post['return_url'] = site_url('m/usercenter/withdraw');//异步跳转	
		}else{
			$post['return_url'] = site_url('usercenter/record/7');//异步跳转	
		}
		
		$post['service'] = "create_hosting_withdraw";
		$return = $this->_interface_submit($post,'mas');
		return $return;
	}
	
	//托管待收 用户购买产品  1001 代收投资金  1002代收还款金 
	function create_hosting_collect_trade($out_trade_no = false,$goodsid = "",$uid = false,$total = false,$type = 1)
	{	
		// $ip = $this->session->userdata('ip');
		// $post['payer_ip'] = $ip;
		$post['payer_ip'] = '182.92.67.0';
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  1001;
		$post['summary'] = "用户购买产品".$goodsid;
		$post['trade_close_time'] = "5m";//5分钟
		$post['goods_id'] = $goodsid; //散标ID
		$post['payer_id'] = $uid;//付款用户ID
		$post['payer_identity_type'] = "UID";
		//$post['pay_method'] = "balance^".$total."^SAVING_POT"; //余额支付  存钱罐支付
		$post['pay_method'] = "online_bank^".$total."^SINAPAY,DEBIT,C"; //余额支付  存钱罐支付
		
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		
		if($type == 2){
			$post['return_url'] = site_url("m/usercenter/record");
		}else{
			$post['return_url'] = site_url("usercenter/products");
		}
		
		
		$post['notify_url'] = site_url('sinanotify/buy_product');//异步跳转
		return $this->_interface_submit($post,'mas');
	}
	//托管代收 用户提现手续费
	function withdraw_shou($out_trade_no = false,$goodsid = "",$uid = false,$total = false)
	{	
		$post['payer_ip'] = '182.92.67.0';
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  1001;
		$post['summary'] = "用户提现手续费";
		$post['goods_id'] = $goodsid; //散标ID
		$post['payer_id'] = $uid;//付款用户ID
		$post['payer_identity_type'] = "UID";
		$post['pay_method'] = "balance^".$total."^SAVING_POT"; //余额支付  存钱罐支付
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		$post['notify_url'] = site_url('sinanotify/withdraw_shou');//异步跳转
		return $this->_interface_submit($post,'mas');	
	}
	
	//债券转让代收交易
	function buy_transfer($out_trade_no = false,$goodsid = "",$uid = false,$total = false)
	{	
		$ip = $this->session->userdata('ip');
		$post['payer_ip'] = $ip;
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  1001;
		$post['summary'] = "用户购买债券";
		$post['trade_close_time'] = "5m";//5分钟
		$post['goods_id'] = $goodsid; //散标ID
		$post['payer_id'] = $uid;//付款用户ID
		$post['payer_identity_type'] = "UID";
		$post['pay_method'] = "online_bank^".$total."^SINAPAY,DEBIT,C"; //余额支付  存钱罐支付
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		$post['return_url'] = site_url("usercenter/products");
		$post['notify_url'] = site_url('transfer/buy_transfer');//异步跳转
		return $this->_interface_submit($post,'mas');	
	}
	
	// //债券转让代付交易
	// function sell_transfer($out_trade_no = false,$trade_list = false)
	// {
		
	// 	$post['out_trade_no'] = $out_trade_no;
	// 	$post['out_trade_code'] =  2001;
	// 	$post['payee_identity_id'] = $uid; //收款人ID	
	// 	$post['payee_identity_type'] = "UID";
	// 	$post['amount'] = $monkey;
	// 	$post['account_type'] = "SAVING_POT";
	// 	//$post['split_list'] = "";//分账信息
	// 	$post['summary'] = "债券转让成功收款";
	// 	$post['goods_id'] = $goods_id; //标的ID 
	// 	$post['service'] = "create_single_hosting_pay_trade";
	// 	$post['notify_url'] = site_url('transfer/sell_transfer');//异步跳转
	// 	return $this->_interface_submit($post,'mas');
		
		
	// 	$post['out_pay_no'] = $out_trade_no;
	// 	$post['out_trade_code'] = 2001;	
	// 	$post['trade_list'] = $trade_list;
	// 	$post['notify_method'] = "single_notify";
	// 	//$post['notify_url'] = wwwdomain.'sinanotify/send_user_lixi';//异步跳转
	// 	$post['notify_url'] = site_url('transfer/sell_transfer');//异步跳转
	// 	$post['service'] = "create_batch_hosting_pay_trade";
	// 	$result =  $this->_interface_submit($post,'mas');
	// 	return $result;		
	// }
	
	function sell_transfer($out_trade_no = false,$monkey,$uid,$fenzhang)
	{
		$post['user_ip'] = "182.92.67.0";
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] = 2001;	
		$post['payee_identity_id'] = "$uid";
		$post['payee_identity_type'] = "UID";
		$post['account_type'] = "SAVING_POT";
		$post['amount'] = $monkey;
		$post['split_list'] = $fenzhang;
		$post['summary'] = "债权转让";
		$post['notify_method'] = "single_notify";
		//$post['notify_url'] = wwwdomain.'sinanotify/send_user_lixi';//异步跳转
		$post['notify_url'] = site_url('transfer/sell_transfer');//异步跳转
		$post['service'] = "create_single_hosting_pay_trade";
		$result =  $this->_interface_submit($post,'mas');
		return $result;		
	}
	//托管提现 代付手续费到账户
	function withdraw_fu($out_trade_no = false,$monkey = false)
	{	
		$post['user_ip'] = '182.92.67.0';
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  2001;
		$post['payee_identity_id'] = sinapay_system; //收款人ID	
		$post['payee_identity_type'] = "EMAIL";
		$post['amount'] = $monkey;
		$post['account_type'] = "BASIC";
		//$post['split_list'] = "";//分账信息
		$post['summary'] = "提现手续费代付";
		$post['service'] = "create_single_hosting_pay_trade";
		$post['notify_url'] = site_url('sinanotify/withdraw_fu');//异步跳转
		return $this->_interface_submit($post,'mas');		
	}
	
	//冻结余额
	function balance_freeze($out_trade_no = false,$uid = false,$monkey = false)
	{	
		$ip = $this->session->userdata('ip');
		$post['client_ip'] = $ip;
		$post['out_freeze_no'] = $out_trade_no;
		$post['identity_id'] = $uid; //收款人ID	
		$post['identity_type'] = "UID";
		$post['amount'] = $monkey;
		$post['account_type'] = "SAVING_POT";
		$post['summary'] = "提现手续费冻结";
		$post['service'] = "balance_freeze";
		return $this->_interface_submit($post,'mgs');		
	}
	
	//解冻余额
	function balance_unfreeze($out_trade_no = false,$old = false,$uid = false,$monkey = false)
	{	
		$ip = $this->session->userdata('ip');
		$post['client_ip'] = $ip;
		$post['out_unfreeze_no'] = $out_trade_no;
		$post['out_freeze_no'] = $old; //原冻结订单
		$post['identity_id'] = $uid; //收款人ID	
		$post['identity_type'] = "UID";
		$post['amount'] = $monkey;
		$post['summary'] = "提现手续费解冻";
		$post['service'] = "balance_unfreeze";
		return $this->_interface_submit($post,'mgs');		
	}
	
	//债券转让代付交易
	
	
	//临时测试
/*	function daifu_user()
	{
		$post['service'] = "create_single_hosting_pay_trade";	
		$post['out_trade_no'] = 524671;
		$post['out_trade_code'] = "2001";
		$post['payee_identity_id'] = 33106;
		$post['payee_identity_type'] = "UID";
		$post['account_type'] = "SAVING_POT";
		$post['amount'] = 2000;
		$post['summary'] = "超卖2000返还给用户31246";
		$post['goods_id'] = 307;
		$post['notify_url'] = site_url("welcome/trade_daifu/notify_url");
		$this->_interface_submit($post,'mas');	
	}*/
	
	//临时测试
/*	function trade_daishou()
	{
		$post['out_trade_no'] = 522950;
		$post['out_trade_code'] =  1001;
		$post['summary'] = "债券代付多付了代收回来";
		$post['goods_id'] = 95; //散标ID
		$post['payer_id'] = 31146;//付款用户ID
		$post['payer_identity_type'] = "UID";
		$post['pay_method'] = "balance^90000^SAVING_POT"; //余额支付  存钱罐支付
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		$post['notify_url'] = site_url('welcome/trade_daishou/notify_url');//异步跳转
		return $this->_interface_submit($post,'mas');
	}*/
/*	function trade_daishou()
	{
		$post['service'] = "create_single_hosting_pay_trade";	
		$post['out_trade_no'] = 505297;
		$post['out_trade_code'] = "2001";
		$post['payee_identity_id'] = 30703;
		$post['payee_identity_type'] = "UID";
		$post['account_type'] = "BASIC";
		$post['amount'] = 200000;
		$post['summary'] = "原用户30025临沂荣达20万付给用户30703唐佳原因录入错误";
		$post['goods_id'] = 94;
		$post['notify_url'] = site_url("welcome/trade_daishou/notify_url");
		$this->_interface_submit($post,'mas');
	}*/
	
	
	//托管代付用户利息
	function create_batch_hosting_pay_trade($out_trade_no = false,$trade_list = false)
	{	
		$post['user_ip'] = '182.92.67.0';
		$post['out_pay_no'] = $out_trade_no;
		$post['out_trade_code'] = 2002;	
		$post['trade_list'] = $trade_list;
		$post['notify_method'] = "single_notify";
		//$post['notify_url'] = wwwdomain.'sinanotify/send_user_lixi';//异步跳转
		//$post['notify_url'] = site_url('sinanotify/send_user_lixi');//异步跳转
		//$post['notify_url'] = wwwdomain.'sinanotify/send_user_lixi';
		$post['notify_url'] = 'https://www.kuaitoujiqi.com/sinanotify/send_user_lixi.html';
		
		$post['service'] = "create_batch_hosting_pay_trade";
		$result =  $this->_interface_submit($post,'mas');
		return $result;
	}
	
	//绑定银行卡
	function binding_bank_card($request_no = false,$bank_code = false,$bank_account_no = false,$phone_no = false,$prov = false,$city = false,$bank_branch = false,$verify_mode = 1)
	{
		$userinfo = userinfo();
		$ip = $this->session->userdata('ip');
		$post['client_ip'] = $ip;
		$post['request_no'] = $request_no;//邦卡请求号
		$post['identity_id'] = $userinfo['id']; //UID
		$post['identity_type']	= "UID";
		$post['bank_code'] = $bank_code;//银行编号
		$post['bank_account_no'] =  $this->encode($bank_account_no);//银行卡号
		//$post['account_name'] = $this->encode($userinfo['name']);//户名
		$post['card_type'] = "DEBIT"; //卡类型
		$post['card_attribute'] = "C";//卡属性
		//$post['cert_type'] = "IC";//证件类型 身份证
		//$post['cert_no'] = $this->encode($userinfo['idcard']);//证件号码
		$post['phone_no'] = $this->encode($phone_no);//预留手机号
		$post['province'] = $prov;//身份
		$post['city'] = $city;//城市
		$post['bank_branch'] = $bank_branch;//支行名称
		if($verify_mode == 1)
		{
			$post['verify_mode'] = "SIGN";//认证方式
		}
		else
		{
			$post['verify_mode'] = "";//认证方式	
		}
		$post['service'] = "binding_bank_card";
		return $this->_interface_submit($post);
	}
	//绑定银行卡推进
	function binding_bank_card_advance($valid_code = false,$ticket = false)
	{	$ip = $this->session->userdata('ip');
		$post['client_ip'] = $ip;
		$post['valid_code'] = $valid_code;	
		$post['ticket'] = $ticket;
		$post['service'] = "binding_bank_card_advance";
		return $this->_interface_submit($post);
	}
	
	
	//查询银行卡
	function query_bank_card($id = false)
	{
		$userinfo = userinfo();
		$post['identity_id'] = $id;	
		$post['identity_type'] = "UID";
		$post['service'] = "query_bank_card";
		return $this->_interface_submit($post);
	}
	//解除绑定 
	function unbinding_bank_card($card_id = false)
	{
		$userinfo = userinfo();
		$ip = $this->session->userdata('ip');
		$post['client_ip'] = $ip;
		$post['identity_id'] = $userinfo['id'];	
		$post['identity_type'] = "UID";
		$post['card_id'] = $card_id;
		$post['service'] = "unbinding_bank_card";
		return $this->_interface_submit($post);
	}

	
	//临时解除绑定
	function tmp_bank_card($card_id = false,$uid = false)
	{
		$userinfo = userinfo();
		$ip = $this->session->userdata('ip');
		$post['client_ip'] = $ip;
		$post['identity_id'] = $uid;	
		$post['identity_type'] = "UID";
		$post['card_id'] = $card_id;
		$post['service'] = "unbinding_bank_card";
		return $this->_interface_submit($post);	
	}
	

	
	
	
	//加密方式 部分字段需要加密传输
	function encode($str = false)
	{
		$weibopay = new Weibopay ();
		return 	$weibopay->Rsa_encrypt($str,sinapay_rsa_public__key);
	}
	
	
	//新浪返回界面查看个人信息
	function  show_member_infos_sina($uid = false)
	{
		$post['identity_type'] = "UID";	
		$post['identity_id'] = $uid;
		$post['service'] = "show_member_infos_sina";
		$post['resp_method'] =1;//新增
		$post['request_time'] = date("YmdHis");
		$post['return_url'] = site_url('usercenter');
		$return = $this->_interface_submit($post);

		redirect($return[1]['redirect_url']);
		/*$weibopay = new Weibopay ();
		ksort($post);
		$post['sign'] = $weibopay->getSignMsg($post,$post['sign_type']);
		//模拟提交表单
		$html = '<form action="'.sinapay_wpay_url.'" id="form1" method="post">';
		foreach($post as $val=>$key)
		{
			$html .= '<input type="hidden" name="'.$val.'" value="'.$key.'">';	
		}
		$html.= '</form>';
		return $html;
		$data = $weibopay->createcurl_data($post);
		$result = $weibopay->curlPost(sinapay_wpay_url,$data); // 使用模拟表单提交进行数据提交
		return  urldecode ($result);*/
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
	function set_pay_password($uid = false,$type = 1)
	{
		$post['service'] = "set_pay_password";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		if($type == 2){
			$post['return_url'] = site_url("m/usercenter/safe");
		}else{
			$post['return_url'] = site_url("usercenter/safe");
		}
		
		$return = $this->_interface_submit($post);
		
		redirect($return[1]['redirect_url']);
	}
	
	//更改交易密码
	function modify_pay_password($uid = false,$type = 1)
	{
		$post['service'] = "modify_pay_password";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		if($type == 2){
			$post['return_url'] = site_url("m/usercenter/safe");
		}else{
			$post['return_url'] = site_url("usercenter/safe");
		}
		$return = $this->_interface_submit($post);
		redirect($return[1]['redirect_url']);	
	}
	//更改认证手机号
	function modify_verify_mobile($uid = false)
	{
		$post['service'] = "modify_verify_mobile";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$post['return_url'] = site_url("usercenter/safe");
		$return = $this->_interface_submit($post);
		redirect($return[1]['redirect_url']);		
	}
	//查询认证信息
	function query_verify($uid = false)
	{
		$post['service'] = "query_verify";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$post['verify_type'] = "MOBILE";
		$post['is_mask'] = "N";
		$return = $this->_interface_submit($post);	
		return $return;
	}
	
	//跳转邦卡
	function web_binding_bank_card($uid = false,$type = 1)
	{
		$post['service'] = "web_binding_bank_card";	
		$post['identity_id'] = $uid;
		$post['identity_type'] = "UID";
		$post['could_unbind'] = 'Y';
		if($type == 2){
			$post['return_url'] = site_url("m/usercenter/binding");
		}else{
			$post['return_url'] = site_url("usercenter/");
		}
		
		$return = $this->_interface_submit($post);
		//print_r($return);exit();
		redirect($return[1]['redirect_url']);	
	}
	
	
	//查询企业会员信息
	function query_member_infos()
	{
		$post['identity_id'] = "20009";
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
		$weibopay = new Weibopay();
		ksort($post);
		$post['sign'] = $weibopay->getSignMsg($post,$post['sign_type']);
		
		$in_attr['content'] = json_encode($post);
		
		$data = $weibopay->createcurl_data($post);
		$result = $weibopay->curlPost($url,$data); //使用模拟表单提交进行数据提交

		$result = urldecode ($result);
		$this->db->insert('sys_log',array('content' => json_encode($result)));
		
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
					return array(0,$splitdata);
				} else {	//失败
					$in_attr['return'] = 2;
					if($in_attr['type'] ==2)
					{
						$this->db->insert('sina_log',$in_attr);
					}
					return array(1,$splitdata['response_message']);
					exit();
				}
			} else {
					$in_attr['return'] = 2;
					if($in_attr['type'] ==2)
					{
						$this->db->insert('sina_log',$in_attr);
					}
			return array(1,$splitdata['response_message']);
		}
		
	}
}