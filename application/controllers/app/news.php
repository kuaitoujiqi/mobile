<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
class News extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/public_m');
		 $this->load->model('app/response_m');
	}
	//网站公告
    function web($id=false,$page = 0){
    	$this->db->where('id',$id);
		$query = $this->db->get('news_category',1,0);
		if($query->num_rows() <=0)
		{
			show_404();exit();	
		}
		$row = $query->row_array();
		
		$config['base_url'] = site_url('news/newslist/'.$id);
		$config['per_page'] = 10; 
		$this->db->where('pid',$id);
		$config['total_rows'] = $this->db->count_all_results('news');
		$config['uri_segment'] = 4;
		$data['id'] = $id;
		$this->db->where('pid',$id);
		$this->db->order_by('dateline','desc');
		$data['result'] = $this->db->get('news',$config['per_page'],$page)->result_array();
		$data['row'] = $row;
		$this->load->library('pagination',$config);
		$data['links'] = $this->pagination->create_links();
			foreach ($data['result'] as $key => $value) {
			$web[$key]['fID'] = $value['id'];
			$web[$key]['fTitle'] = $value['title'];	
			$web[$key]['fText'] = 'hahah';	
		    $web[$key]['fTime'] = $value['dateline'];	
		    $web[$key]['fOneID'] = '001';	

	  }
	  $alldata['0'] = $web;
	  	return $this->response_m->show(200, '首页数据获取成功', $web);
    }
}
	