<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/public_m');
	}
	function index()
	{
		$this->load->view('m/newslist');
	}
	function article($id = false)
	{
		$data['id'] = $id;
		$this->db->where('id',$id);
		$query = $this->db->get('news',1,0);
		if($query->num_rows() <=0) 
		{
			show_404();	
		}
		else
		{
			$row = $query->row_array();
			$data['category'] = $this->public_m->row('news_category',$row['pid']);	
			$data['row'] = $row;
			//上一篇
			$prev = $this->db->where(array('pid'=>$row['pid'],'id <'=>$id))->order_by('id','desc')->limit(1)->get('news')->row_array();
			//下一篇
			$next = $this->db->where(array('pid'=>$row['pid'],'id >'=>$id))->order_by('id','asc')->limit(1)->get('news')->row_array();
			$data['prev'] = $prev;
			$data['next'] = $next;
			$this->load->view('m/article',$data);	
		}
		
	}
}