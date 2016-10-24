<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/company_m');
 	}
	
	//企业列表
	function index($page = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = admin_url('company/index');
		$config['page_query_string'] = false;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->db->order_by('dateline','desc');
		$result = $this->db->get('company_user',$config['per_page'],$page)->result_array();
		$config['total_rows'] = $this->db->count_all_results('company_user');
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result;
		$this->_view('company/company_list',$data);	
	}
	
	//增加企业
	function add_company()
	{	
		$this->form_validation->set_rules('company_name', '名称', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('company/add_company');
		}
		else
		{
			$return = $this->company_m->create_company_user();
			if($return[0] == 0)
			{
				$this->_message('提交成功',admin_url('company/index'));	
			}
			else
			{
				$this->_message($return[1],admin_url('company/add_company'));		
			}
		}
			
	}
	
	//编辑企业
	function edit_company($id = false)
	{
		$this->form_validation->set_rules('company_name', '名称', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->db->where('id',$id);
			$data['row'] = $this->db->get('company_user',1,0)->row_array();
			$this->_view('company/edit_company',$data);
		}
		else
		{
			if($this->company_m->edit_company($id))
			{
				$this->_message('提交成功',admin_url('company/index'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('company/edit_company/'.$id));		
			}
		}
	}
	

	
	//审核企业
	function check_company($id = false)
	{
		$return = $this->company_m->check_company($id);	
		
		switch($return)
		{
			case "uploaderror":$msg = "上传资质文件失败";break;
			case "exits":$msg = "企业未找到";break;
			case "static":$msg = "审核中和已审核的企业无法提交审核";break;
			case "success":	$msg = "提交成功";break;
			default:$msg = $return;break;	
		}
		
		$this->_message($msg,admin_url('company/index'));	
	}
	//检查审核企业结果状态
	function check_company_show($id = false,$audit_order_no = false)
	{
		$return = $this->company_m->query_audit_result($id,$audit_order_no);
		if($return[0] == 1)
		{
			echo "执行错误";	
		}	
		else
		{
			switch($return[1]['audit_result'])
			{
				case "SUCCESS":$jg = "审核成功";break;
				case "FAILED":$jg = "审核失败";break;
				case "PROCESSING":$jg = "审核中";break;
			}
			echo "审核结果:".$jg."<br>"."审核建议:".$return[1]['audit_mgs']."<br>";	
		}
	}
	//查看企业信息
	function show_company($id = false)
	{
		$this->db->where('id',$id);
		$data['row'] = $this->db->get('company_user',1,0)->row_array();
		$this->_view('company/show_company',$data);
	}
}