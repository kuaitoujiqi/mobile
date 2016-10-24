<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	
	//修改密码
	function form_pass()
	{
		
		$ci = &get_instance();
		$uid = $ci->_uid();
		$this->form_validation->set_rules('oldpass', '旧密码', 'required|editpass[admin.id.'.$uid.'.password]');
		$this->form_validation->set_rules('newpass', '新密码', 'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('compass', '确认密码', 'required|matches[newpass]');
		if ($this->form_validation->run() == FALSE)
		{
			return false;
		}
		else
		{
			$this->db->where('id',$uid);
			$newpass = $this->input->post('newpass');
			$this->db->set('password',sha1($newpass));
			$this->db->update('admin');
			return true;	
		}		
	}
	//获取网站配置信息
	function  get_sysconfig()
	{
		$this->db->where('id',1);
		return $this->db->get('sysconfig',1,0)->row_array();	
	}
	//提交网站配置信息
	function form_sysconfig()
	{
		$arr = $this->input->post();
		$this->db->where('id',1);
		unset($arr['submit']);	
		return $this->db->update('sysconfig',$arr);
	}
	//友情连接列表
	function link()
	{
		$this->db->order_by('sort','desc');
		return $this->db->get('link')->result_array();	
	}
	//添加友情连接
	function add_link()
	{
		$arr = $this->input->post();
		unset($arr['submit']);	
		return $this->db->insert('link',$arr);
	}
	//编辑友情连接
	function edit_link()
	{
		$arr = $this->input->post();
		$this->db->where('id',$arr['id']);
		unset($arr['submit']);	
		return $this->db->update('link',$arr);
	}
	//删除友情连接
	function del_link($id = false)
	{
		$this->db->where('id',$id);	
		return $this->db->delete('link');
	}
	//获取后台菜单
	function menulist()
	{
		//获取用户组
		$uid = $this->session->userdata('auid');
		$this->db->where('id',$uid);
		$row = $this->db->get('admin',1,0)->row_array();
		//获取用户组信息
		if($row['group'] != 0)
		{
			$this->db->where('id',$row['group']);
			$groupinfo = $this->db->get('admin_group',1,0)->row_array();
			//权限信息
			$arr = unserialize($groupinfo['roler']);
			$this->db->where_in('id',$arr);	
		}
		$this->db->order_by('sort','asc');	
		$this->db->where('show',0);
		return $this->db->get('adminmenu')->result_array();
	}
	//配置邮箱地址
	function email()
	{
		$email_config = "./data/email.php";
		$arr = $this->input->post();
		unset($arr['submit']);
		return write_file($email_config,serialize($arr));	
	}
	//获取邮箱配置文件
	function get_email()
	{
		$email_config = "./data/email.php";
		if(!file_exists($email_config))
		{
			//未找到配置文件
			$row['smtp_host'] = "";
			$row['smtp_port'] = "";
			$row['smtp_user'] = "";
			$row['smtp_pass'] = "";
			$row['senduser'] = "";
			$row['sendname'] = "";
			$row['testname'] = "";

		}
		else
		{
			$row = unserialize(read_file($email_config));
		}	
		return $row;
	}

}