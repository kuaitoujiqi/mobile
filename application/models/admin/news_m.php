<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//分类管理
	function category()
	{
		$this->db->order_by('sort','desc');
		return $this->db->get('news_category')->result_array();	
	} 
	//新闻列表
	function newslist($per_page = 10)
	{
		
		//判断搜索标题
		if($this->input->get('liketitle'))
		{
			$this->db->start_cache();
			$this->db->like('title',$this->input->get('liketitle'));
			$this->db->stop_cache();	
		}
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		$count = $this->db->count_all_results('news');
		$this->db->select('news.title as title,news.id as id,news.dateline as dateline,news_category.name as cate,admin.name as name');
		$this->db->from('news');
		$this->db->join('news_category','news.pid = news_category.id','left');
		$this->db->join('admin','news.uid = admin.id','left');
		$this->db->limit($per_page,$page);
		$this->db->order_by('dateline','desc');
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);
	}
}