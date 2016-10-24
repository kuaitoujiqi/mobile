<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/project_m');
		$this->load->model('admin/public_m');
 	}
/*	//项目列表
	function project_list($page = 0)
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('project/project_list?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->project_m->project_list($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('project/project_list',$data);	
	}
	//添加项目
	function add_project()
	{
		$this->form_validation->set_rules('title', '项目标题', 'trim|required');
		$this->form_validation->set_rules('yield', '项目年化收益率', 'trim|required|numeric');
		$this->form_validation->set_rules('deadline', '项目期限', 'trim|required');
		$this->form_validation->set_rules('assignment_hour', '可转让期限', 'trim|required|is_natural');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('project/add_project');
		}
		else
		{
			if($this->public_m->add('project'))
			{
				$this->_message('提交成功',admin_url('project/project_list'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/project_list'),2);	
			}			
		}
	}
	//编辑项目
	function edit_project($id = false)
	{
		$this->form_validation->set_rules('title', '项目标题', 'trim|required');
		$this->form_validation->set_rules('yield', '项目年化收益率', 'trim|required|numeric');
		$this->form_validation->set_rules('deadline', '项目期限', 'trim|required');
		$this->form_validation->set_rules('assignment_hour', '可转让期限', 'trim|required|is_natural');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->public_m->row('project',$id);
			$this->_view('project/edit_project',$data);
		}
		else
		{
			if($this->public_m->edit('project',$id))
			{
				$this->_message('提交成功',admin_url('project/edit_project/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/edit_project/'.$id),2);	
			}			
		}	
	}
	//删除项目
	function del_project($id = false)
	{
		if($this->public_m->del('project',$id))
		{
			$this->_message('提交成功',admin_url('project/project_list/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('project/project_list'),2);	
		}		
	}
	//标的列表
	function project_manage($page = 0)
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('project/project_manage?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->project_m->project_manage($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('project/project_manage',$data);		
	}
	//添加标的
	function add_project_manage()
	{
		$this->form_validation->set_rules('project_id', '项目ID', 'trim|required');
		$this->form_validation->set_rules('current_hour', '项目日期', 'trim|required|callback_check_projectm');
		$this->form_validation->set_rules('size', '当日金额', 'trim|required|is_natural');
		if ($this->form_validation->run() == FALSE)
		{
			$data['project'] = $this->public_m->result('project');
			$this->_view('project/add_project_manage',$data);	
		}
		else
		{
			if($this->public_m->add('project_manage'))
			{
				$this->_message('提交成功',admin_url('project/project_manage/'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/project_manage/'),2);	
			}				
		}
	}
	//检查标的日期
	function check_projectm($str)
	{
		$this->db->where('project_id',$this->input->post('project_id'));
		$this->db->where('current_hour',$str);
		if($this->db->get('project_manage',1,0)->num_rows() <=0)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_projectm', '当前日期的项目已在标的');
			return false;
		}
	}
	//编辑标的
	function edit_project_manage($id = false)
	{
		$this->form_validation->set_rules('project_id', '项目ID', 'trim|required');
		$this->form_validation->set_rules('current_hour', '项目日期', 'trim|required|callback_check_projectme');
		$this->form_validation->set_rules('size', '当日金额', 'trim|required|is_natural');
		if ($this->form_validation->run() == FALSE)
		{
			$data['project'] = $this->public_m->result('project');
			$data['row'] = $this->public_m->row('project_manage',$id);
			$this->_view('project/edit_project_manage',$data);	
		}
		else
		{
			if($this->public_m->edit('project_manage',$id))
			{
				$this->_message('提交成功',admin_url('project/edit_project_manage/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/edit_project_manage/'.$id),2);	
			}				
		}
	}
	//编辑检查标的日期
	function check_projectme($str)
	{
		$this->db->where('project_id',$this->input->post('project_id'));
		$this->db->where('current_hour',$str);
		$this->db->where('id !=',$this->input->post('id'));
		if($this->db->get('project_manage',1,0)->num_rows() <=0)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_projectme', '当前日期的项目已在标的');
			return false;
		}
	}
	
	//删除标的
	function del_project_manage($id = false)
	{
		if($this->public_m->del('project_manage',$id))
		{
			$this->_message('提交成功',admin_url('project/project_manage/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('project/project_manage'),2);	
		}		
	}
	
	//投资机构与项目
	function invest($page = 0)
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('project/invest?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->project_m->invest($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('project/invest',$data);			
	}
	//添加投资机构与项目
	function add_invest()
	{
		$this->form_validation->set_rules('org_id', '投资机构', 'trim|required');
		$this->form_validation->set_rules('invest_name', '项目名称', 'trim|required');
		$this->form_validation->set_rules('repay_way', '还款方式', 'trim|required');
		$this->form_validation->set_rules('invest_money', '投资金额', 'trim|required');
		$this->form_validation->set_rules('invest_yield', '投资收益率', 'trim|required');
		$this->form_validation->set_rules('invest_due', '投资期限', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//获取投资机构
			$data['tzjg'] = $this->public_m->result('invest_org');
			//还款方式
			$data['hkfs'] = $this->public_m->result('repay_way');
			$this->_view('project/add_invest',$data);
		}
		else
		{
			if($this->public_m->add('invest'))
			{
				$this->_message('提交成功',admin_url('project/invest/'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/invest/'),2);	
			}		
		}
	}
	//编辑投资机构与项目
	function edit_invest($id = false)
	{
		$this->form_validation->set_rules('org_id', '投资机构', 'trim|required');
		$this->form_validation->set_rules('invest_name', '项目名称', 'trim|required');
		$this->form_validation->set_rules('repay_way', '还款方式', 'trim|required');
		$this->form_validation->set_rules('invest_money', '投资金额', 'trim|required');
		$this->form_validation->set_rules('invest_yield', '投资收益率', 'trim|required');
		$this->form_validation->set_rules('invest_due', '投资期限', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//获取投资机构
			$data['tzjg'] = $this->public_m->result('invest_org');
			//还款方式
			$data['hkfs'] = $this->public_m->result('repay_way');
			//当前数据
			$data['row'] = $this->public_m->row('invest',$id);
			$this->_view('project/edit_invest',$data);
		}
		else
		{
			if($this->public_m->edit('invest',$id))
			{
				$this->_message('提交成功',admin_url('project/edit_invest/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/edit_invest/'.$id),2);	
			}		
		}	
	}
	//删除投资机构与项目
	function del_invest($id = false)
	{
		if($this->public_m->del('invest',$id))
		{
			$this->_message('提交成功',admin_url('project/project_manage/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('project/project_manage'),2);	
		}		
	}*/
	//用户项目表  1为标的 2为散 标 $type = 1,
	function user_project()
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('project/user_project?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->project_m->user_project($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('project/user_project',$data);		
	}
/*	//审核用户项目
	function status_user_project($id = false)
	{
		$url = $_SERVER['HTTP_REFERER'];
		if($this->project_m->status_user_project($id))
		{
			$this->_message('提交成功',$url);	
		}
		else
		{
			$this->_message('提交失败',$url,2);	
		}	
	}
	//删除用户项目
	function del_user_project($id = true)
	{
		if($this->public_m->del('user_project',$id))
		{
			$this->_message('提交成功',admin_url('project/user_project/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('project/user_project'),2);	
		}			
	}*/
	
	/*红包管理开始*/
	function red_paper()
	{
		$data['result'] = $this->public_m->result('red_paper');
		$this->_view('project/red_paper',$data);	
	}
	function add_red_paper()
	{
		$this->form_validation->set_rules('title', '红包名称', 'trim|required');
		$this->form_validation->set_rules('monkey', '红包金额', 'trim|required|integer');
		$this->form_validation->set_rules('min_monkey', '红包最小使用金额', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('project/add_red_paper');
		}
		else
		{
			if($this->public_m->add('red_paper'))
			{
				$this->_message('提交成功',admin_url('project/red_paper/'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/red_paper/'),2);	
			}		
		}
	}
	function edit_red_paper($id)
	{
		$this->form_validation->set_rules('title', '红包名称', 'trim|required');
		$this->form_validation->set_rules('monkey', '红包金额', 'trim|required|integer');
		$this->form_validation->set_rules('min_monkey', '红包最小使用金额', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_check_red_paper($id);
			$data['row'] = $this->public_m->row('red_paper',$id);
			$this->_view('project/edit_red_paper',$data);
		}
		else
		{
			if($this->public_m->edit('red_paper',$id))
			{
				$this->_message('提交成功',admin_url('project/edit_red_paper/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('project/edit_red_paper/'.$id),2);	
			}		
		}
	}
	function del_red_paper($id)
	{
		$this->_check_red_paper($id);
		if($this->public_m->del('red_paper',$id))
		{
			$this->_message('提交成功',admin_url('project/red_paper/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('project/red_paper'),2);	
		}
	}
	//检查红包是否有用户持有  如果持有禁止删除与编辑
	function _check_red_paper($id)
	{
		$this->db->where('paperid',$id);
		$count = $this->db->count_all_results('user_paper');
		if($count >0)
		{
			$this->_message('有用户已持有该红包禁止删除',$_SERVER['HTTP_REFERER'],2);	
		}
		else
		{
			return true;	
		}
	}
	
	/*红包管理结束*/
}