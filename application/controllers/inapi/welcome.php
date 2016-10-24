<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('welcome_m');
		//$this->load->helper('front');
	}
	
	function index()
	{
		$username = trim($this->input->get('username'));
		$password = $this->input->get('password',true);
		//sys_log($username.$password);
		$where = "password = '".$password."' and (nickname = '".$username."' or mobile = '".$username."')";
		$where .= "and type = 1";//投资人用户类型
		$this->db->where($where);
		$query = $this->db->get('user',1,0);
		//sys_log($this->db->last_query());
		if($query->num_rows()<=0)
		{
			$return['code'] = 002;	
			$return['desc'] = "用户名或密码错误";
			$data['uid'] = "failed";
		}
		else
		{
			$row = $query->row_array();
			$this->session->set_userdata('from','app');	
			$this->session->set_userdata('uid',$row['id']);
			//$this->session->userdata('alogin',true);
			$this->load->model('sina_m');
			$sina_query = $this->sina_m->query_balance($row['id']);
			if($sina_query[0] == 0)
			{
				//新浪查询返回正确结果  同步本地余额和冻结
				$this->db->set('balance',$sina_query[1]['available_balance']); //更新本地余额 可用余额
				//$this->db->set('frozen',$sina_query[1]['balance']-$sina_query[1]['available_balance']);//更新本地冻结余额 余额减去可用余额
				
				$this->db->set('lastlogin',time());
				$this->db->where('id',$row['id']);
				$this->db->update('user');
			}
			$return['code'] = 001;	
			$this->db->where('id',$row['id']);
			$this->db->set('app',1);
			$this->db->update('user');
			$data['uid'] = $row['id'];
			$return['data'] = array('uid'=>$row['id'],'mobile'=>$row['mobile'],'password'=>$row['password']);
		}
		
		//$data['json'] = json_encode($return);
		$data['code'] = $return['code'];
		$this->load->view('m/app_auto_login',$data);
	}
	
}