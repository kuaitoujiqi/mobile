<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sina_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		include_once FCPATH. "key/api/weibopay.class.php";
    }
	
		//托管退款   用户购买错误  退款
	function create_hosting_refund($out_trade_no = false,$orig_outer_trade_no = false,$refund_amount = false,$summary = false){
		$post['out_trade_no'] = $out_trade_no;				//交易订单号
		$post['orig_outer_trade_no'] = $orig_outer_trade_no;		//需要退款的商户订单号
		$post['refund_amount'] = $refund_amount;					//退款金额
		$post['summary'] = $summary;							//摘要 退款原因

		//$post['split_list'] = $out_trade_no;  //分账信息列表（目前代付不支持退款，因此退款时分账列表都为空）
		//$post['extend_param'] = $out_trade_no; //扩展信息
		
		$post['service'] = 'create_hosting_refund';
		
		$type = "mas";
		return $this->_interface_submit($post,$type);
	}	
	
	function create_activate_member($id = false)
	{
		$post['identity_id'] = $id;	
		$post['identity_type'] = 'UID';
		$post['member_type'] = 2; //企业会员
		$post['extend_param'] = '';
		$post['service'] = 'create_activate_member';
		return $this->_interface_submit($post);
	}	
	
	function audit_member_infos_new($row,$orderid){
        $weibopay = new Weibopay();
        /**************获取解冻结余额信息参数****************/
        $service=$data['service'];//服务名称
        $version=$data['version'];//接口版本
        $request_time=$data['request_time'];//请求时间
        $partner_id=$data['partner_id'];//合作者身份ID
        $_input_charset=$data['_input_charset'];//参数编码字符集
        $sign_type=$data['sign_type'];//签名类型
        /****************业务参数***********************/
        $audit_order_no=$data['audit_order_no'];//
        $identity_id=$data['identity_id'];//会员标识
        $identity_type=$data['identity_type'];//用户标识类型
        $company_name=$data['company_name'];//公司名称
        $address=$data['address'];//企业地址
        //执照号
        $license_no=$weibopay->Rsa_encrypt($data["license_no"],sinapay_rsa_public__key);
        $license_address=$data['license_address'];//营业执照所在地
        $license_expire_date=$data['license_expire_date'];//执照过期日（营业期限）
        $business_scope=$data['business_scope'];//营业范围
       //联系电话
        $telephone=$weibopay->Rsa_encrypt($data["telephone"],sinapay_rsa_public__key);
        //联系Email
        $email=$weibopay->Rsa_encrypt($data["email"],sinapay_rsa_public__key);
       //组织机构代码
        $organization_no=$weibopay->Rsa_encrypt($data["organization_no"],sinapay_rsa_public__key);
        $summary=$data['summary'];//企业简介

       //企业法人
        $legal_person=$weibopay->Rsa_encrypt($data["legal_person"],sinapay_rsa_public__key);
       //法人证件号码
        $cert_no=$weibopay->Rsa_encrypt($data["cert_no"],sinapay_rsa_public__key);
        $cert_type=$data['cert_type'];//证件类型

       //法人手机号码
        $legal_person_phone=$weibopay->Rsa_encrypt($data["legal_person_phone"],sinapay_rsa_public__key);
        $bank_code=$data['bank_code'];//银行编号
        //银行卡号
        $bank_account_no=$weibopay->Rsa_encrypt($data["bank_account_no"],sinapay_rsa_public__key);
        $card_type=$data['card_type'];//卡类型
        $card_attribute=$data['card_attribute'];//卡属性
        $province=$data['province'];//开户行省份
        $city=$data['city'];//开户行城市
        $bank_branch=$data['bank_branch'];//支行名称
        $fileName=$data["fileName"];//文件名称
       //demo默认的资质文件上传路径，资质文件先传到demo目录，demo再传到sina sftp
        $filedata=sinapay_file_path.$fileName;
        $digest=$weibopay->md5_file($filedata);//文件摘要
        $digestType=$data['digestType'];//文件摘要算法
        $weibopay->write_log("文件摘要:".$digest);
         //sftp上传

        if($data['update_status']=="Y") {
            $weibopay->write_log("开始连接sftp进行文件上传:".$digest);
           $is_upload = $weibopay->sftp_upload($filedata, $fileName);
			if ($is_upload) {
			$weibopay->write_log("上传资质文件成功！" . $filedata);
		   } else {
			$weibopay->write_log("上传资质文件失败！" . $filedata);
			}
		}

        $param=array();
        $param['service']=$service;
        $param['version']=$version;
        $param['request_time']=$request_time;
        $param['partner_id']=$partner_id;
        $param['_input_charset']=$_input_charset;
        $param['sign_type']=$sign_type;

        $param['audit_order_no']=$audit_order_no;
        $param['identity_id']=$identity_id;
        $param['identity_type']=$identity_type;
        $param['company_name']=$company_name;
        $param['address']=$address;
        $param['license_no']=$license_no;
        $param['license_address']=$license_address;
        $param['license_expire_date']=$license_expire_date;
        $param['business_scope']=$business_scope;
        $param['telephone']=$telephone;
        $param['email']=$email;
        $param['organization_no']=$organization_no;
        $param['summary']=$summary;
        $param['legal_person']=$legal_person;
        $param['cert_no']=$cert_no;
        $param['cert_type']=$cert_type;
        $param['legal_person_phone']=$legal_person_phone;
        $param['bank_code']=$bank_code;
        $param['bank_account_no']=$bank_account_no;
        $param['card_type']=$card_type;
        $param['card_attribute']=$card_attribute;
        $param['province']=$province;
        $param['city']=$city;
        $param['bank_branch']=$bank_branch;
        $param['fileName']=$fileName;
        $param['digest']=$digest;
        $param['digestType']=$digestType;
        ksort($param);//对签名参数据排序
        //计算请求报文签名
        $sign=$weibopay->getSignMsg($param,$sign_type);
        //将签名放到报文
        $param['sign']=$sign;
        $weibopay->write_log("请求企业会员资质审核信息请求参数".json_encode($param));
        $data = $weibopay->createcurl_data($param); // 调用createcurl_data创建模拟表单需要的数据
        $result = $weibopay->curlPost(sinapay_mgs_url,$data ); // 使用模拟表单提交进行数据提交
        $result = urldecode ($result);
        $splitdata = json_decode($result,true);
        $sign_type = $splitdata ['sign_type'];//签名方式
        ksort($splitdata); // 对签名参数据排序
        if ($weibopay->checkSignMsg ($splitdata,$sign_type)) {
            if ($splitdata["response_code"] == 'APPLY_SUCCESS') { // 成功
                return $splitdata;
                exit();
            }else
            {
                //业务处理失败
                return $splitdata;
                exit();
            }
        } else {
            die ( "sing error！" );
        }		
		
	}
	
	
	function audit_member_infos($row,$orderid)
	{
		$post = $row;
		$post['identity_id'] = $row['id']; //用户ID 
		unset($post['id']);//删除ID
		$post['audit_order_no'] = $orderid; //提交审核订单ID
		$post['identity_type'] = "UID";
		$post['member_type'] = 2;//企业会员
		$post['cert_type'] = "IC";//身份证认证
		$post['card_type'] = "DEBIT"; //卡类型
		$post['card_attribute'] = "B";//卡类型 对公
		$post['service'] = "audit_member_infos";
		$post['license_no'] = $this->encode($post['license_no']);
		$post['telephone'] = $this->encode($post['telephone']);
		$post['email'] = $this->encode($post['email']);
		$post['organization_no'] = $this->encode($post['organization_no']);
		$post['legal_person'] = $this->encode($post['legal_person']);
		$post['cert_no'] = $this->encode($post['cert_no']);
		$post['legal_person_phone'] = $this->encode($post['legal_person_phone']);
		$post['bank_account_no'] = $this->encode($post['bank_account_no']);
		$explode = explode("/",$post['fileName']);
		$fileName = $explode[count($explode) - 1];
		$post['fileName'] = $fileName;
		$post['digestType'] = "MD5";
		
		unset($post['static']);
		unset($post['uid']);
		unset($post['dateline']);
		unset($post['checkid']);
		unset($post['failed_msg']);
		unset($post['password']);
		$post['notify_url'] = site_url("sinanotify/chenck_company");
		return $this->_interface_submit($post);
	}
	
	//查看企业审核结果
	function query_audit_result($id = false,$audit_order_no = false)
	{
		$post['identity_id'] = $id;
		$post['service'] = "query_audit_result";
		$post['identity_type'] = "UID";
		//$post['audit_order_no'] = $audit_order_no;
		return $this->_interface_submit($post);	
	}
	
	//创建标的
	function create_p2p_hosting_borrowing_target($row = array())
	{
		$post['goods_id'] = $row['id'];
		$post['goods_name'] = $row['title'];
		$post['annual_yield'] = number_format($row['rate']*100,2,'.',''); //年华收益率
		$post['term'] = date('YmdHis',strtotime('+'.$row['day'].' months',time())-(-172800));//还款期限
		$post['repay_method'] = "MONTHLY_PAYMENT";	 //按月付息
		$post['guarantee_method'] = "企业担保";//担保方式
		
		if($row['borrower_type'] == 3){			
			$post['debtor_list'] = $row['borrower_id']."^UID^".$row['money']."$";//借款用户为个人 集合 Id^id_type^6000$
		}else{
			$post['debtor_list'] = $row['company']."^UID^".$row['money']."$";//借款用户为企业 集合 Id^id_type^6000$			
		}
		
		
		$post['total_amount'] = $row['money'];//标的总金额
		$post['begin_date'] = date('YmdHis',time()-(-1296000));//标的开始时间
		$post['url'] = site_url('product/bulk_standard/'.$row['id']);//标的uRL
		$post['summary'] = $row['title'];
		$post['service'] = "create_p2p_hosting_borrowing_target";
		//$this->db->set('content','结束时间'.date('YmdHis',strtotime('+'.$row['day'].' months',time())-(-172800))."开始时间".date('YmdHis',time()-(-1296000)));
		//$this->db->insert('sys_log');
		
		return $this->_interface_submit($post,'mas');
	}
	//代付到银行卡 审标的时候把款打给借款人
	function pay_trade_send($out_trade_no,$uid,$amount,$summary,$goods_id,$borrower_type)
	{
		$post['service'] = "create_single_hosting_pay_trade";	
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] = "2001";
		$post['payee_identity_id'] = $uid;
		$post['payee_identity_type'] = "UID";
		//if($borrower_type == 3){
		//	$post['account_type'] = "SAVING_POT";
		//}else{
			$post['account_type'] = "BASIC";	
		//}
		
		$post['amount'] = $amount;
		$post['summary'] = $summary;
		$post['goods_id'] = $goods_id;
		$post['notify_url'] = site_url("sinanotify/check_bulk");
		$this->_interface_submit($post,'mas');
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
	
	//加密方式 部分字段需要加密传输
	function encode($str = false)
	{
		$weibopay = new Weibopay ();
		return 	$weibopay->Rsa_encrypt($str,sinapay_rsa_public__key);
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
		}
		else
		{
			$url = sinapay_pay_url;	
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
		$sign_type = $splitdata ['sign_type'];//签名方式
		ksort($splitdata); // 对签名参数据排序
		//print_r($splitdata);
		$in_attr['dateline'] = date('Y-m-d H:i:s');
		if ($weibopay->checkSignMsg ($splitdata,$sign_type)) {
			$in_attr['return_msg'] = json_encode($splitdata);
			$this->db->insert('sina_log',$in_attr);
			if ($splitdata["response_code"] == 'APPLY_SUCCESS') { // 成功
					return array(0,$splitdata);
				} else { // 失败
					return array(1,$splitdata['response_message']);
				exit();
				}
			} else {
			return false;
		}
		
	}
	
	//创建红包
	function create_hosting_redpackets($out_trade_no = false,$uid = false,$monkey = false,$summary = false){
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  2001;
		$post['payee_identity_id'] = $uid; //收款人ID	
		$post['payee_identity_type'] = "UID";
		$post['amount'] = $monkey;
		$post['account_type'] = "SAVING_POT";
		
		$post['summary'] = "发送红包";
		$post['service'] = "create_single_hosting_pay_trade";
		$post['notify_url'] = site_url('832BB7C4398238F3/user/send_red_packets');//异步跳转
		return $this->_interface_submit($post,'mas');	
	}	
	
}