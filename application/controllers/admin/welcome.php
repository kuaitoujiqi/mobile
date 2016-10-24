<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	function __construct()
 	{
  		parent::__construct();
 	}	
	
	function index()
	{
		$this->session->sess_destroy();
		
		if($this->session->userdata('alogin'))
		{
			redirect(admin_url('main/logined'));	
		}
		$this->load->view('admin/login');
	}
	function form_login()
	{
		$chkcode = $this->input->post('verify');
		if(!$this->check_chkcode($chkcode))
		{
			//验证码失败
			$this->_message('验证码错误',admin_url(),1);
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->db->where('username',$username);
			$this->db->where('password',sha1($password));	
			$query = $this->db->get('admin',1,0);
			if($query->num_rows()<=0)
			{
				$this->_message('用户名密码错误',admin_url(),1);
			}
			else
			{
				
				//登录成功销毁验证码session
				$this->session->unset_userdata('aloginckcode');
				//登录成功保存session
				$row = $query->row_array();
				if($row['static'] != 1)
				{
					$this->_message('用户被禁用',admin_url(),2);exit();	
				}
				//获取用户组是否存在
				if($row['group'] != 0)
				{
					$this->db->where('id',$row['group']);
					$num = $this->db->get('admin_group',1,0)->num_rows();
					if($num <=0)
					{
						$this->_message('用户组异常联系管理员',admin_url(),2);exit();	
					}	
				}
				
				$this->session->set_userdata('alogin',true);
				$this->session->set_userdata('auid',$row['id']);
				$this->_message('登录成功',admin_url('main/logined'));
			}
		}
		
	}
	//检查验证码
	public function check_chkcode($str)
	{
		$chkcode = $this->session->userdata('aloginckcode');
		if(strtolower($chkcode) != strtolower($str)) //对比验证码 不分大小写
		{
			return false;	
		}
		else
		{
			return true;	
		}
		
	}
	//验证码
	function chkcode()
	{
		$this->load->helper('code');
		code('4','aloginckcode');	
	}
	
	//退出登录
	function exit_login()
	{
		$this->session->sess_destroy();
		redirect(admin_url());	
	}
	
}