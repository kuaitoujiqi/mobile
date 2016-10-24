<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Project_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//项目列表
	function project_list($per_page = 10)
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
		$count = $this->db->count_all_results('project');
		$this->db->order_by('id','desc');
		$this->db->limit($per_page,$page);
		$query = $this->db->get('project');
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);	
	}
	//标的列表
	function project_manage($per_page = 10)
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
		$count = $this->db->count_all_results('project_manage');
		$this->db->order_by('current_hour','desc');
		$this->db->select('project.title as title,project_manage.id as id,project_manage.size as size,project_manage.done_size as done_size,project_manage.current_hour as current_hour');
		$this->db->from('project_manage');
		$this->db->join('project','project_manage.project_id = project.id','left');
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);		
	}
	//投资机构与项目
	function invest($per_page = 10)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		$count = $this->db->count_all_results('invest');
		$this->db->order_by('invest_org.id','desc');
		$this->db->select('invest_org.id as id,invest_org.org_name as org_name,invest.invest_name as invest_name,repay_way.repay as repay,invest.invest_money as invest_money,invest.invest_yield as invest_yield,invest.invest_due as invest_due');
		$this->db->from('invest');
		$this->db->join('invest_org','invest.org_id = invest_org.id','left');
		$this->db->join('repay_way','invest.repay_way = repay_way.id','left');
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);		
	}
	//用户项目表
	function user_project($per_page = 10)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		$this->db->order_by('user_products.id','desc');
		$this->db->start_cache();
		$this->db->select('user_products.*');
		$this->db->from('user_products');
		//$this->db->join('user','user_project.user_id = user.id','left');
		//$this->db->join('project','user_project.project_id = project.id','left');
		$this->db->stop_cache();
		$this->db->limit($per_page,$page);
		//判断时间
		$starttime = $this->input->get('starttime');
		$endtime = $this->input->get('endtime');
		$uid = $this->input->get('name');
		$user_pro_id = $this->input->get('user_pro_id');
		if($user_pro_id)
		{
			$this->db->start_cache();
			$this->db->where('user_products.id',$user_pro_id);
			$this->db->stop_cache();	
		}
		if($uid)
		{
			$this->db->start_cache();
			$this->db->where('user_products.uid',$uid);
			$this->db->stop_cache();	
		}
		
		if($starttime)
		{
			$this->db->start_cache();
			$this->db->where('user_products.dateline >=',strtotime($starttime));
			$this->db->stop_cache();	
		}
		if($endtime)
		{
			$this->db->start_cache();
			$this->db->where('user_products.dateline <=',strtotime($endtime));
			$this->db->stop_cache();	
		}

		//判断项目名称
		$project = trim($this->input->get('project'));
		if($project)
		{
			$this->db->start_cache();
			$this->db->where('user_products.projectid',$project);
			$this->db->stop_cache();		
		}
		$query = $this->db->get();
		$count = $this->db->count_all_results();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);			
	}
	//审核用户项目
	function status_user_project($id = false)
	{
		$this->db->where('id',$id);
		$row = $this->db->get('user_project',1,0)->row_array();
		if($row['status'] == 0)
		{
			$this->db->set('status',1);	
		}	
		else
		{
			$this->db->set('status',0);			
		}
		$this->db->where('id',$id);
		return $this->db->update('user_project');
	}
}