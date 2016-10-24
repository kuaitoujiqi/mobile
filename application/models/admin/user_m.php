<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	function userlist($per_page = 10)
	{
		
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		//获取关键词
		$text = $this->input->get('text');
		$monkey = $this->input->get('monkey');
		if($text)
		{
			$this->db->start_cache();
			$this->db->where('id',$text);//用户ID
			$this->db->or_where('email',$text);//email
			$this->db->or_where('mobile',$text);//moblie
			$this->db->or_where('name',$text);//姓名
			$this->db->stop_cache();	
		}
		$this->db->start_cache();
		$this->db->where('type',1);//用户ID
		$this->db->stop_cache();
		$count = $this->db->count_all_results('user');
		$this->db->limit($per_page,$page);
		
		if($monkey == 2)
		{
			$this->db->order_by('balance','desc');	
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get('user');
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);	
	}
	
	//需要发送红包的用户列表
	function senduserlist($per_page = 10,$userType){
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		//获取关键词
		//$userType = $this->input->get('userType');
		if($userType == 1){   ///发送红包规则1   投资超过5000以上
			$this->db->start_cache();
			
			$this->db->where('fr_order.static = 2');
			$this->db->where('fr_order.type = 2');
			$this->db->where('fr_order.monkey > 5000');
			$this->db->or_where('fr_order.monkey = 5000');
			$this->db->stop_cache();
			
		}else{

			
		}
		
		$this->db->from('fr_order');
		$this->db->join('user','fr_order.uid = user.id','left');
		$this->db->join('red_packets','fr_order.uid = red_packets.uid','left');
		
		$this->db->select('fr_order.*,user.*');
		$this->db->order_by('fr_order.id','desc');
		$this->db->limit($per_page,$page);
		
		
		//$this->db->limit($per_page,$page);
		
		/*
		if($monkey == 2)
		{
			$this->db->order_by('balance','desc');	
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get('user');
		*/
		$query = $this->db->get();
		//$count = $query->count_all_results();
		$return = $query->result_array();
		$count = count($return);
		$this->db->flush_cache();
		return array($count,$return);			
	}
	
	//用户信息
	function userinfo($id = false)
	{
		$this->db->where('id',$id);//用户ID
		return $this->db->get('user')->row_array();	
	}
	//编辑用户验证
	function check_userinfo()
	{
		$this->form_validation->set_rules('nickname', '昵称', 'trim|required');
		$this->form_validation->set_rules('password', '密码', 'trim');
		$this->form_validation->set_rules('mobile', '手机号', 'trim|required|integer|min_length[11]|max_length[11]|editonly[user.id.mobile]');
		$this->form_validation->set_rules('idcard', '身份证', 'trim|required|iscard|min_length[18]|max_length[18]|editonly[user.id.idcard]');
		$this->form_validation->set_rules('name', '姓名', 'trim|required');
		$this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email|editonly[user.id.email]');
		$this->form_validation->set_rules('is_mobile', '手机验证', 'trim|required');
		$this->form_validation->set_rules('is_idcard', '身份证验证', 'trim|required');
		$this->form_validation->set_rules('is_email', '邮箱验证', 'trim|required');
		return $this->form_validation->run();	
	}
	//提交编辑用户
	function edituser()
	{
		$arr = $this->input->post();
		unset($arr['submit']);
		$this->db->where('id',$arr['id']);
		unset($arr['id']);
		if($arr['password'] == "")
		{
			unset($arr['password']);	
		}
		else
		{
			$arr['password'] = sha1($arr['password']);	
		}
		return $this->db->update('user',$arr);	
	}
	//删除用户
	function deluser($id = false)
	{
		$this->db->where('id',$id);
		return $this->db->delete('user');	
	}
	//绑定银行卡信息
	function user_bind_bank($perpage = 20)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		$this->db->start_cache();
		$this->db->select('user_bank.*');
		$this->db->from('user_bank');
		$uid = $this->input->get('uid');
		if($uid)
		{
			$this->db->start_cache();
			$this->db->where('user_bank.user_id',$uid);
			$this->db->stop_cache();	
		}
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->order_by('user_bank.id','desc');
		$this->db->limit($perpage,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);				
	}

}