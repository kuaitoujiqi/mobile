<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roler extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/roler_m');
		$this->load->model('admin/public_m');
 	}
	//用户组管理
	function index()
	{
		$data['grouplist'] = $this->public_m->result('admin_group');
		$this->_view('roler/group_list',$data);	
	}
	
	function addgroup()
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('roler[]', '权限', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['menulist'] = $this->roler_m->menulist();
			$this->_view('roler/addgroup',$data);
		}
		else
		{
			if($this->roler_m->addgroup())
			{
				$this->_message('提交成功',admin_url('roler/index'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('roler/addgroup'),2);		
			}	
		}
	}
	function editgroup($id = false)
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('roler[]', '权限', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['menulist'] = $this->roler_m->menulist();
			$data['row'] = $this->public_m->row('admin_group',$id);
			$this->_view('roler/editgroup',$data);
		}
		else
		{
			if($this->roler_m->editgroup($id))
			{
				$this->_message('提交成功',admin_url('roler/editgroup/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('roler/editgroup/'.$id),2);		
			}	
		}
	}
	function delgroup($id = false)
	{
		if($this->public_m->del('admin_group',$id))
		{
			$this->_message('提交成功',admin_url('roler/index'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('roler/index'),2);	
		}		
	}
	
	//后台菜单管理
	function menulist()
	{
		$data['menulist'] = $this->roler_m->menulist();
		$this->_view('roler/menulist',$data);
	}
	function addmenu()
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('uri', '控制器/方法名', 'trim');
		$this->form_validation->set_rules('pid', '上级', 'trim|required');
		$this->form_validation->set_rules('show', '是否显示菜单', 'required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$topmenulist = $this->roler_m->topmenulist();
			$data['topmenulist'] = $topmenulist;
			$this->_view('roler/addmenu',$data);
		}
		else
		{
			if($this->public_m->add('adminmenu'))
			{
				$this->_message('提交成功',admin_url('roler/menulist'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('roler/addmenu'),2);	
			}		
		}
	}
	function editmenu($id = false)
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('uri', '控制器/方法名', 'trim');
		$this->form_validation->set_rules('pid', '上级', 'trim|required');
		$this->form_validation->set_rules('show', '是否显示菜单', 'required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$topmenulist = $this->roler_m->topmenulist();
			$data['topmenulist'] = $topmenulist;
			$data['row'] = $this->public_m->row('adminmenu',$id);
			$this->_view('roler/editmenu',$data);
		}
		else
		{
			if($this->public_m->edit('adminmenu',$id))
			{
				$this->_message('提交成功',admin_url('roler/editmenu/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('roler/editmenu/'.$id),2);	
			}		
		}
	}
	function delmenu($id = false)
	{
		if($this->roler_m->delmenu($id))
		{
			$this->_message('提交成功',admin_url('roler/menulist'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('roler/menulist'),2);	
		}		
	}
	//更新排序
	function menusotr()
	{
		if($this->roler_m->menusotr())
		{
			$this->_message('提交成功',admin_url('roler/menulist'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('roler/menulist'),2);	
		}		
	}
	
	//用户管理
	function userlist($page = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = admin_url('roler/userlist/');
		$config['per_page'] = 15;
		$config['uri_segment'] = 4;
		$result = $this->roler_m->userlist($config['per_page'],$page);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('roler/userlist',$data);
	}
	function adduser()
	{
		$this->form_validation->set_rules('username', '用户名', 'trim|required|alpha_dash|is_unique[admin.username]');
		$this->form_validation->set_rules('group', '用户组', 'trim|required');
		$this->form_validation->set_rules('name', '姓名', 'trim|required');
		$this->form_validation->set_rules('static', '状态', 'trim|required');
		$this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]');
		if ($this->form_validation->run() == FALSE)
		{
			$data['group'] = $this->public_m->result('admin_group');
			$this->_view('roler/adduser',$data);
		}
		else
		{
			if($this->roler_m->adduser())
			{
				$this->_message('提交成功',admin_url('roler/userlist'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('roler/adduser'),2);		
			}	
		}
		
	}
	function edituser($id = false)
	{
		//$this->form_validation->set_rules('username', '用户名', 'trim|required|alpha_dash|is_unique[admin.username]');
		$this->form_validation->set_rules('group', '用户组', 'trim|required');
		$this->form_validation->set_rules('name', '姓名', 'trim|required');
		$this->form_validation->set_rules('static', '状态', 'trim|required');
		$this->form_validation->set_rules('password', '密码', 'trim');
		if ($this->form_validation->run() == FALSE)
		{
			$data['group'] = $this->public_m->result('admin_group');
			$data['row'] = $this->public_m->row('admin',$id);
			$this->_view('roler/edituser',$data);
		}
		else
		{
			if($this->roler_m->edituser($id))
			{
				$this->_message('提交成功',admin_url('roler/edituser/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('roler/edituser/'.$id),2);		
			}	
		}
	}
	function deluser($id = false)
	{
		if($this->public_m->del('admin',$id))
		{
			$this->_message('提交成功',admin_url('roler/userlist'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('roler/userlist'),2);	
		}			
	}
}