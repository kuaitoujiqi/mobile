<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/news_m');
		$this->load->model('admin/public_m');
 	}
	function index()
	{
		$data['result'] = $this->news_m->category();
		$this->_view('news/category',$data);	
	}
	function add_category()
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('news/add_category');
		}
		else
		{
			if($this->public_m->add('news_category'))
			{
				$this->_message('提交成功',admin_url('news/index'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('news/index'),2);	
			}	
		}
	}
	function edit_category($id = flase)
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->db->where('id',$id)->get('news_category',1,0)->row_array();
			$this->_view('news/edit_category',$data);
		}
		else
		{
			if($this->public_m->edit('news_category',$id))
			{
				$this->_message('提交成功',admin_url('news/edit_category/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('news/edit_category/'.$id),2);	
			}	
		}
	}
	function del_category($id = false)
	{
		if($this->public_m->del('news_category',$id))
		{
			$this->_message('提交成功',admin_url('news/index'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('news/index'),2);	
		}			
	}
	
	function news_list($page = 0)
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('news/news_list?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->news_m->newslist($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('news/newslist',$data);
	}
	function add_news()
	{
		$this->form_validation->set_rules('title', '标题', 'trim|required');
		$this->form_validation->set_rules('pid', '分类', 'trim|required');
		$this->form_validation->set_rules('keyword', '关键词', 'trim');
		$this->form_validation->set_rules('description', '描述', 'trim');
		$this->form_validation->set_rules('photo', '缩略图', 'trim');
		$this->form_validation->set_rules('dateline', '时间', 'trim');
		$this->form_validation->set_rules('content', '内容', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['resutl'] = $this->public_m->result('news_category');
			$this->_view('news/add_news',$data);
		}
		else
		{
			if($this->public_m->add('news'))
			{
				$this->_message('提交成功',admin_url('news/news_list'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('news/news_list'),2);	
			}		
		}	
	}
	function edit_news($id = false)
	{
		if($id == false)
		{
			$this->_message('路径错误',admin_url('news/news_list/'));exit();		
		}
		$this->form_validation->set_rules('title', '标题', 'trim|required');
		$this->form_validation->set_rules('pid', '分类', 'trim|required');
		$this->form_validation->set_rules('keyword', '关键词', 'trim');
		$this->form_validation->set_rules('description', '描述', 'trim');
		$this->form_validation->set_rules('photo', '缩略图', 'trim');
		$this->form_validation->set_rules('dateline', '时间', 'trim');
		$this->form_validation->set_rules('content', '内容', '');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['resutl'] = $this->public_m->result('news_category');
			$data['row'] = $this->public_m->row('news',$id);
			$this->_view('news/edit_news',$data);
		}
		else
		{
			if($this->public_m->edit('news',$id))
			{
				//echo $this->db->last_query();exit();
				$this->_message('提交成功',admin_url('news/edit_news/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('news/edit_news/'.$id),2);	
			}		
		}
	}
	function del_news($id = false)
	{
		if($this->public_m->del('news',$id))
		{
			$this->_message('提交成功',admin_url('news/news_list/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('news/news_list'),2);	
		}			
	}
}