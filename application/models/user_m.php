<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	用户模型 
	注册、登录、同步余额
*/
class User_m extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('sina_m');
    }
	//同步金额
	function same_monkey()
	{
		$userinfo = userinfo();
		$sina_query = $this->sina_m->query_balance($userinfo['id']);
		if($sina_query[0] == 0)
		{
			$this->db->set('balance',$sina_query[1]['available_balance']); //更新本地余额 可用余额
			$this->db->where('id',$id);
			$this->db->update('user');
		}
	}
	
	
}