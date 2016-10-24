<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Interface_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//添加短信记录
	function add_sms_visit($phone = false)
	{
		$ip = $this->input->ip_address();
		$this->db->set('dateline',time());
		$this->db->set('ip',$ip);
		$this->db->set('phone',$phone);
		$this->db->insert('sms_visit');
	}
	
	//查看短信记录验证 验证规则24小时不能超过10条 1分钟内不能发
	function check_sms_visit($phone = false)
	{
		$this->del_sms_visit();
		$ip = $this->input->ip_address();
		$this->db->where('ip',$ip);
		$count = $this->db->count_all_results('sms_visit'); //24小时发送总数
		
		//获取手机号总数
		$this->db->where('phone',$phone);
		$count_phone = $this->db->count_all_results('sms_visit');
		
		if($count >= 15 || $count_phone >= 10) //同一IP不能超过15次 同一号码不能超过10次
		{
			return false;
		}	
		$this->db->where('ip',$ip);
		$this->db->where('dateline >=',time()-60);  //1分钟内
		$count = $this->db->count_all_results('sms_visit');
		if($count > 0)
		{
			return false;	
		}
		return true;
	}
	
	//删除短信记录昨天的 24小时以前的
	function del_sms_visit()
	{
		$this->db->where('dateline <=',time()-86400);
		$this->db->delete('sms_visit');
	}
	
	//发送普通短信
	function send_public_message($phone = '',$content = '')
	{
		$sn = "SDK-WSS-010-09397";
		$pwd = "B6B55709EA49F37DE5206CE1BF03654F"; //md5(sn+pwd) 大写
		$url = 'http://sdk.entinfo.cn:8061/webservice.asmx/mdsmssend?sn='.$sn.'&pwd='.$pwd.'&mobile='.$phone.'&content='.$content.'&ext=&rrid=&stime=&msgfmt=';
		$output = file_get_contents($url);
		$xml = simplexml_load_string($output);
		$arr = json_decode(json_encode($xml),true);
		if($arr[0] > 1)
		{
			return true;
		}
		else//哈哈
		{
			return false;
		}
	}
	
	//发送短信验证码
	function sendmessage($phone,$modelid = false)
	{
		
		if(!$this->check_sms_visit($phone))
		{
			return false;	
		}
		
		$this->add_sms_visit($phone);
		
		header("Content-Type:text/html;charset=UTF-8");
		$code = $this->creat_code(); //获取生成的验证码
		
		
		//获取短信模板
		$model = $this->get_sms($modelid);
		$content = str_replace('{code}',$code,$model);
		//$content = iconv( "UTF-8", "gb2312//IGNORE",$content);
		$sn = "SDK-WSS-010-09397";
		$pwd = "B6B55709EA49F37DE5206CE1BF03654F"; //md5(sn+pwd) 大写
		
		$url = 'http://sdk.entinfo.cn:8061/webservice.asmx/mdsmssend?sn='.$sn.'&pwd='.$pwd.'&mobile='.$phone.'&content='.$content.'&ext=&rrid=&stime=&msgfmt=';
		
		$output = file_get_contents($url);
		/*
			<?xml version="1.0" encoding="utf-8"?>
			<string xmlns="http://entinfo.cn/">141005120029754111</string>
		*/
		$xml = simplexml_load_string($output);
		$arr = json_decode(json_encode($xml),true);
		if($arr[0] > 1)
		{
			//发送成功保存信息 请勿更改session名称
			$this->session->set_userdata('phone_code',$code);
			$this->session->set_userdata('phone_code_time',time());
			$this->session->set_userdata('phone_numbner',$phone);	
			return true;	
		}
		else
		{
			return false;
		}
		
	    
	}
	
	//发送付息成功短信
	function sendinterestmessage($phone,$title,$money,$modelid = false)
	{
		
		$this->add_sms_visit($phone);
		
		header("Content-Type:text/html;charset=UTF-8");
		
		//获取短信模板
		$model = $this->get_sms($modelid);
		$username = substr($phone,-4);
		$content = str_replace('{username}',$username,$model);
		$content = str_replace('{title}',$title,$content);
		$content = str_replace('{money}',$money,$content);
		
		$sn = "SDK-WSS-010-09397";
		$pwd = "B6B55709EA49F37DE5206CE1BF03654F"; //md5(sn+pwd) 大写
		
		$url = 'http://sdk.entinfo.cn:8061/webservice.asmx/mdsmssend?sn='.$sn.'&pwd='.$pwd.'&mobile='.$phone.'&content='.$content.'&ext=&rrid=&stime=&msgfmt=';
		
		$output = file_get_contents($url);

		$xml = simplexml_load_string($output);
		$arr = json_decode(json_encode($xml),true);
		$content_sms = json_encode($xml);
		if($arr[0] > 1)
		{    
			$this->db->set('datetime',time());
			$this->db->set('phone',$phone);
			$this->db->set('content',$content_sms);
			$this->db->set('return',$output);
			$this->db->set('status',1);//成功
			$this->db->insert('sms_log');
			return true;	
		}
		else
		{    
			$this->db->set('datetime',time());
			$this->db->set('phone',$phone);
			$this->db->set('content',$content_sms);
			$this->db->set('return',$output);
			$this->db->set('status',0);//失败
			$this->db->insert('sms_log');
			return false;
		}
	}	
	
	//发送邮件
	function send_email($email = false)
	{
		$CI = & get_instance();
		$CI->load->helper('email');
		$code = $this->creat_code();
		$return = send_email($email,$email,'验证码','尊敬的客户,您的验证码为'.$code.',有效时间5分钟.');
		if($return == "success")
		{
			//发送成功保存session 
			$this->session->set_userdata('email_code',$code);
			$this->session->set_userdata('email_code_time',time());
			$this->session->set_userdata('email',$email);	
		}
		return $return;
	}
	
	/*生成随机数 $num 为位数*/
	 function creat_code($num = 6)
	 {
		$this->load->helper('array');
		$array = array(1,2,3,4,5,6,7,8,9,0);	
		$code = '';
		for($i=1;$i<=$num;$i++)
		{
			$code .= random_element($array);	
		} 
		return $code;
	 }
	 
	 //获取短信模板
	 function get_sms($id = false)
	 {
		$this->db->where('id',$id);
		$query = $this->db->get('sms_model',1,0);
		if($query->num_rows() <=0)
		{
			return "{code}【快投机器】";
		}
		else
		{
			$row = $query->row_array();
			return $row['content'];
		}
	 }
}