<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Roler_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//获取顶级菜单
	function topmenulist()
	{
		$this->db->order_by('sort','asc');
		$this->db->where('pid',0);
		return $this->db->get('adminmenu')->result_array();
	}
	//后台菜单列表
	function menulist()
	{
		$this->db->order_by('sort','asc');	
		return $this->db->get('adminmenu')->result_array();
	}
	//批量更新菜单排序
	function menusotr()
	{
		$id = $this->input->post('id');
		$sort = $this->input->post('sort');
		$this->db->trans_start();	
		foreach($id as $val=>$key)
		{
			$this->db->where('id',$key);
			$this->db->set('sort',$sort[$val]);
			$this->db->update('adminmenu');
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	//删除菜单
	function delmenu($id = false)
	{
		//查询
		$this->db->where('id',$id);
		$row = $this->db->get('adminmenu',1,0)->row_array();
		if($row['pid'] == 0)
		{
			//查询是否有下属分类
			$this->db->where('pid',$row['id']);
			$query = $this->db->get('adminmenu');
			if($query->num_rows() > 0 )
			{
				return false;	
			}
		}
		$this->db->where('id',$id);
		return  $this->db->delete('adminmenu');
	}
	//添加用户组
	function addgroup()
	{
		$name = $this->input->post('name');	
		$roler = $this->input->post('roler');
		
		$roler = serialize($roler);
		$this->db->set('name',$name);
		$this->db->set('roler',$roler);
		return $this->db->insert('admin_group');
	}
	//修改用户组
	function editgroup($id = false)
	{
		$name = $this->input->post('name');	
		$roler = $this->input->post('roler');
		$roler = serialize($roler);
		$this->db->set('name',$name);
		$this->db->set('roler',$roler);
		$this->db->where('id',$id);
		return $this->db->update('admin_group');	
	}
	//用户列表
	function userlist($per_page = 10,$page = 0)
	{
		$count = $this->db->count_all_results('admin');
		$this->db->select('admin.name as name,admin.id as id,admin.username as username,admin_group.name as groupname,admin.static as static,admin.group');
		$this->db->from('admin');
		$this->db->join('admin_group', 'admin.group = admin_group.id','left');
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		return array($count,$return);
	}
	function adduser()
	{
		$arr = $this->input->post();
		unset($arr['submit']);
		$arr['password'] = sha1($arr['password']);
		return $this->db->insert('admin',$arr);
	}
	function edituser($id = false)
	{
		$arr = $this->input->post();
		$this->db->where('id',$id);
		unset($arr['submit']);
		if($arr['password'] != "")
		{
			$arr['password'] = sha1($arr['password']);
		}
		else
		{
			unset($arr['password']);
		}
		return $this->db->update('admin',$arr);	
	}
}