<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class public_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//发放红包
	function send_paper($uid = false,$paperid = false)
	{
		$this->db->set('user_id',$uid);
		$this->db->set('dateline',date('Y-m-d H:i:s'));
		$this->db->set('static',1);
		$this->db->set('paperid',$paperid);
		$this->db->insert('user_paper');
	}
	
	//发送消息
	function send_notice($uid,$content)
	{
		$this->db->set('dateline',date('Y-m-d H:i:s'));
		$this->db->set('user_id',$uid);
		$this->db->set('static',1);
		$this->db->set('content',$content);
		$this->db->insert('user_notice');
	}
	

}