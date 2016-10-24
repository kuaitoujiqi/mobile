<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wexin_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->helper('front');
    }
	
	
	
	//获取access_token
	function get_token()
	{
		$config['appid'] = "wxd5b373a2b56fbdac";
		$config['secret'] = "7199c5d5706119b6b9db2c8b463dbdd0";
		$config['grant_type'] = "client_credential";
		$url = "https://api.weixin.qq.com/cgi-bin/token?".http_build_query($config);	
		$result = $this->_curl_get($url);
		if($result)
		{
			$json = json_decode($result,true);
			if(isset($json['access_token']))  //成功
			{
				$this->update_token($json['access_token'],$json['expires_in']);
				return array(1,$json['access_token']);	
			}
			else
			{
				sys_log('微信获取token'.$json['errcode']);
				return array(2,'微信返回错误'.$json['errcode']);
			}
		}
		else
		{
			sys_log('微信获取token请求失败');
			return array(2,'请求失败');	
		}
	}
	
	//检查token 是否过期
	function check_token()
	{
		$this->db->where('id',1);
		$row = $this->db->get('weixintoken',1,0)->row_array();
		if(time() - $row['expires_in'] < $row['creattime']) //创建时间 > 现在时间过期 - 过期时间
		{
			return $row['access_token'];
		}
		else
		{
			return false;//过期		
		}
			
	}
	//更新token
	function update_token($access_token = false,$expires_in = false)
	{
		$this->db->set('access_token',$access_token);
		$this->db->set('expires_in',$expires_in-200);
		$this->db->set('creattime',time());	
		$this->db->where('id',1);
		$this->db->update('weixintoken');
	}
	
	//curl接口
	function curl_get($url = false)
	{
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;	
	}
}