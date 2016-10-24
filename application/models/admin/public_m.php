<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Public_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//添加到数据库操作
	function add($table = false)
	{
		$arr = $this->input->post();
		unset($arr['submit']);
		return $this->db->insert($table,$arr);	
	} 
	function edit($table = false,$id = false)
	{
		$arr = $this->input->post();
		unset($arr['submit']);
		$this->db->where('id',$id);
		unset($arr['id']);
		return $this->db->update($table,$arr);	
	}
	function del($table = false,$id = false)
	{
		$this->db->where('id',$id);
		return $this->db->delete($table);	
	}
	//查询单条数据 字段为ID
	function row($table = false , $id = false)
	{
		$this->db->where('id',$id);
		return $this->db->get($table,1,0)->row_array();
	}
	//查询多条数据 无排序
	function result($table = false)
	{
		return $this->db->get($table)->result_array();
	}
	
	//查询多条数据  分页数据
	function page_result($table = false,$per_page,$page,$order)
	{
		$this->db->order_by($order,'desc');
		return $this->db->get($table,$per_page,$page)->result_array();
	}
	//分页首页路径
	function page_url($pagestr = "page")
	{
		$get = $this->input->get();
		if($get)
		{
			$url = array();
			foreach($get as $val=>$key)
			{
				if($val != $pagestr)
				{
					array_push($url,$val.="=".$key);
				}
			}
			return implode("&",$url);
		}
		else
		{
			return "";
		}	
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