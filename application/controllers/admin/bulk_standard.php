<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bulk_standard extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/public_m');
		//$this->load->model('admin/bluk_m');
 	}
	//列表
	function index($page = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = admin_url('bulk_standard/index');
		$config['per_page'] = 20; 
		$config['total_rows'] = $this->db->count_all_results('bulk_standard');
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $this->public_m->page_result('bulk_standard',$config['per_page'],$page,'id');
		$this->_view('bulk/index',$data);	
	}
	//添加
	function add_bulk()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', '项目标题', 'required|trim');
		$this->form_validation->set_rules('photo', '缩略图', 'required');
		$this->form_validation->set_rules('number', '项目编号', 'required|trim');
		$this->form_validation->set_rules('rate', '项目收益率', 'required');
		$this->form_validation->set_rules('services', '服务费率', 'required');
		$this->form_validation->set_rules('borrower_type', '借款人类型', 'required');
		
		$this->form_validation->set_rules('company', '借款企业', '');
		$this->form_validation->set_rules('borrower_id', '借款个人', '');
		
		$this->form_validation->set_rules('day', '投资天数', 'required');
		$this->form_validation->set_rules('repayment', '还款方式', 'required');
		$this->form_validation->set_rules('introduction', '项目简介', 'required');
		$this->form_validation->set_rules('describe', '项目描述', 'required');
		$this->form_validation->set_rules('assets', '资产状况', 'required');
		$this->form_validation->set_rules('pledge', '风控保证', 'required');
		$this->form_validation->set_rules('scene', '项目实景', '');
		$this->form_validation->set_rules('certificate', '企业执照', '');
		$this->form_validation->set_rules('property', '企业资产', '');
		$this->form_validation->set_rules('control', '风控保证', '');
		
		$this->form_validation->set_rules('pact', '担保机构', 'required');
		$this->form_validation->set_rules('each', '每份金额', 'required|is_natural');
		$this->form_validation->set_rules('amount', '起投份数', 'required|is_natural');
		$this->form_validation->set_rules('money', '项目规模', 'required|is_natural');
		$this->form_validation->set_rules('restmoney', '剩余金额', 'required|is_natural');
		$this->form_validation->set_rules('creattime', '创建时间', 'trim|required');
		$this->form_validation->set_rules('is_open', '是否开通', 'trim|required');
		$this->form_validation->set_rules('typetitle', '标题类型', 'trim|required');
		$this->form_validation->set_rules('is_backed', '是否担保', 'trim|required');
		$this->form_validation->set_rules('yuyue', '是否预约', 'trim|required');
		$this->form_validation->set_rules('yuyueuid', '预约人id', 'trim');
		if ($this->form_validation->run() == FALSE)
		{
			$this->db->where('static',3); //审核通过的企业
			$data['company'] = $this->db->get('company_user')->result_array();
			$data['repay_way'] = $this->public_m->result('repay_way');//还款方式
			$this->_view('bulk/add_bulk',$data);
		}
		else
		{
			if($this->public_m->add('bulk_standard'))
			{
				$this->_message('提交成功',admin_url('bulk_standard/index'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('bulk_standard/index'),2);	
			}		
		}
	}
	//创建标的新浪 
	function create_p2p_product($id = false)
	{
		$this->db->where('id',$id);
		$row = $this->db->get('bulk_standard')->row_array();
		if($row['sina_check'] ==1)
		{
			$this->load->model('admin/sina_m');
			$sina_return = $this->sina_m->create_p2p_hosting_borrowing_target($row);
			
			if($sina_return[0] ==0)
			{
				$this->db->where('id',$id);
				$this->db->set('sina_check',2);
				$this->db->set('static',1);
				$this->db->update('bulk_standard');
				$this->_message('创建成功',admin_url('bulk_standard/index'));	
			}
			else
			{
				$this->_message($sina_return[1],admin_url('bulk_standard/index'));		
			}
		}
			
	}
	
	//编辑
	function edit_bulk($id = false)
	{
		
		$data['row'] = $this->public_m->row('bulk_standard',$id);
		if($data['row']['sina_check'] == 2)
		{
			//标的创建成功不可修改
			$this->_message('标的创建成功',admin_url('bulk_standard/index/'),2);exit();			
		}
		//判断此项目是否有人购买 如果有人购买禁止删除
		$this->db->where('type',2);
		$this->db->where('project_id',$id);
		$count = $this->db->count_all_results('user_project');
		if($count >0)
		{
			$this->_message('此项目有用户投资不可编辑',admin_url('bulk_standard/index/'),2);exit();		
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', '项目标题', 'required|trim');
		$this->form_validation->set_rules('photo', '缩略图', 'required');
		$this->form_validation->set_rules('number', '项目编号', 'required|trim');
		$this->form_validation->set_rules('services', '服务费率', 'required');
		$this->form_validation->set_rules('company', '借款企业', 'required');
		$this->form_validation->set_rules('rate', '项目收益率', 'required');
		$this->form_validation->set_rules('day', '投资天数', 'required');
		$this->form_validation->set_rules('repayment', '还款方式', 'required');
		$this->form_validation->set_rules('introduction', '项目简介', 'required');
		$this->form_validation->set_rules('describe', '项目描述', 'required');
		$this->form_validation->set_rules('assets', '资产状况', 'required');
		$this->form_validation->set_rules('pledge', '风控保证', 'required');
		$this->form_validation->set_rules('scene', '项目实景', '');
		$this->form_validation->set_rules('certificate', '企业执照', '');
		$this->form_validation->set_rules('pact', '担保机构', 'required');
		$this->form_validation->set_rules('property', '企业资产', '');
		$this->form_validation->set_rules('control', '风控保证', '');
		$this->form_validation->set_rules('each', '每份金额', 'required|is_natural');
		$this->form_validation->set_rules('amount', '起投份数', 'required|is_natural');
		$this->form_validation->set_rules('money', '项目规模', 'required|is_natural');
		$this->form_validation->set_rules('restmoney', '剩余金额', 'required|is_natural');
		$this->form_validation->set_rules('creattime', '创建时间', 'trim|required');
		$this->form_validation->set_rules('is_open', '是否开通', 'trim|required');
		$this->form_validation->set_rules('typetitle', '标题类型', 'trim|required');
		$this->form_validation->set_rules('is_backed', '是否担保', 'trim|required');
		$this->form_validation->set_rules('yuyue', '是否预约', 'trim|required');
		$this->form_validation->set_rules('yuyueuid', '预约人id', 'trim');
		if ($this->form_validation->run() == FALSE)
		{
			$this->db->where('static',3); //审核通过的企业
			$data['company'] = $this->db->get('company_user')->result_array();
			$data['row'] = $this->public_m->row('bulk_standard',$id);
			$data['repay_way'] = $this->public_m->result('repay_way');//还款方式
			$this->_view('bulk/edit_bulk',$data);
		}
		else
		{
			if($this->public_m->edit('bulk_standard',$id))
			{
				$this->_message('提交成功',admin_url('bulk_standard/edit_bulk/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('bulk_standard/edit_bulk/'.$id),2);	
			}		
		}
	}
	
	function second_edit($id = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('describe', '项目描述', 'required');
		$this->form_validation->set_rules('assets', '资产状况', 'required');
		$this->form_validation->set_rules('pledge', '风控保证', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->public_m->row('bulk_standard',$id);
			$this->_view('bulk/second_edit',$data);
		}
		else
		{
			if($this->public_m->edit('bulk_standard',$id))
			{
				$this->_message('提交成功',admin_url('bulk_standard/second_edit/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('bulk_standard/second_edit/'.$id),2);	
			}		
		}	
	}
	
	//删除
	function del_bulk($id = false)
	{
		$data['row'] = $this->public_m->row('bulk_standard',$id);
		if($data['row']['sina_check'] == 2)
		{
			//标的创建成功不可修改
			$this->_message('标的创建成功',admin_url('bulk_standard/index/'),2);exit();			
		}
		
		//判断此项目是否有人购买 如果有人购买禁止删除
		$this->db->where('type',2);
		$this->db->where('project_id',$id);
		$count = $this->db->count_all_results('user_project');
		if($count >0)
		{
			$this->_message('此项目有用户投资不可删除',admin_url('bulk_standard/index/'),2);exit();		
		}
		else
		{
			if($this->public_m->del('bulk_standard',$id))
			{
				$this->_message('提交成功',admin_url('bulk_standard/index/'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('bulk_standard/index'),2);	
			}			
		}
	}
	
	//审核examine
	function examine($id = false)
	{
		//判断投资是否有处理中的状态
		$this->db->where('projectid',$id);
		$this->db->where('static',1);
		$static_count = $this->db->count_all_results('user_products');
		if($static_count > 0)
		{
			$this->_message('此项目投资人有购买未处理完成的',admin_url('bulk_standard/index'),2);	exit();		
		}
		
		$this->db->where('id',$id);
		$row = $this->db->get('bulk_standard',1,0)->row_array();
		if($row['static'] >=2)
		{
			$this->_message('此项目还款中或已完成',admin_url('bulk_standard/index'),2);	exit();	
		}
		else
		{
			if($row['restmoney'] > 0)
			{
				$this->_message('此项目未满标',admin_url('bulk_standard/index'),2);	exit();	
			}
			else
			{
				//查询用户项目表 购买成功订单金额是否与那个一致
				$this->db->where('static',2);
				$this->db->where('projectid',$row['id']);
				$this->db->select_sum('monkey');
				$userproducts_sum = $this->db->get('user_products')->row_array();
				if($userproducts_sum['monkey'] != $row['money'])
				{
					//购买项目金额不一致
					$this->_message('用户购买项目金额不足项目规模金额',admin_url('bulk_standard/index'),2);	exit();		
				}
				
				//查询是否有处理中的订单
				$this->db->where('type',3);
				$this->db->where('uid',$row['company']);
				$this->db->where('static',1);
				$this->db->where('productid',$id);
				$fr_order_static = $this->db->get('fr_order')->num_rows();
				if($fr_order_static > 0 )
				{
					$this->_message('此项目已经提交请求，等待审核结果',admin_url('bulk_standard/index'),2);	exit();
				}
				$this->load->model('admin/sina_m');
				$this->load->model('order_m');
				$order_id = $this->order_m->create_order(3,$row['company'],$row['money'],false,$id);
				
				if($order_id)
				{
					if($row['borrower_type'] == 3){
						$return = $this->sina_m->pay_trade_send($order_id,$row['borrower_id'],$row['money'],$row['title']."发放借款金",$row['id'],$row['borrower_type']);
					}else{
						$return = $this->sina_m->pay_trade_send($order_id,$row['company'],$row['money'],$row['title']."发放借款金",$row['id'],$row['borrower_type']);
					}
					
					if($return[0] == 0)
					{
						$this->_message('提交成功,等待通过',admin_url('bulk_standard/index/'));exit();	
					}
					else
					{
						$this->_message($return[1],admin_url('bulk_standard/index'),2);	exit();		
					}
				}
				else
				{
					$this->_message('创建交易订单失败',admin_url('bulk_standard/index'),2);exit();	
				}
			}
			
		}
	}
	
	//债券转让列表
	function transfer($type = 0,$page = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = admin_url('bulk_standard/transfer/'.$type."/");
		$config['per_page'] = 20; 
		//查询开始
		$this->db->start_cache();
		$this->db->from('user_transfer');
		if($type !=0)
		{
			$this->db->where('static',$type);
		}
		$this->db->stop_cache();
		$config['total_rows'] = $this->db->count_all_results();
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$this->db->select('user_transfer.*');
		$this->db->order_by('id','desc');
		$data['result'] = $this->db->limit($config['per_page'],$page)->get()->result_array();
		$data['type'] = $type;
		$this->db->flush_cache();
		$data['page'] = $page;
		$this->_view('bulk/transfer',$data);	
	}
	
	//债券转让审核
	function shenhe_transfer($id = false,$type = 0,$page = 0)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('user_transfer',1,0);
		if($query->num_rows() <=0)
		{
			$this->_message('此项目不存在',admin_url('bulk_standard/transfer/'.$type.'/'.$page),2);	
		}	
		$row = $query->row_array();
		if($row['static'] != 1)
		{
			$this->_message('当前状态无法审核',admin_url('bulk_standard/transfer/'.$type.'/'.$page),2);
		}	
		$this->db->where('id',$id);
		$this->db->set('static',2);//已审核状态
		$this->db->set('examine',time());//审核时间
		if($this->db->update('user_transfer'))
		{
			$this->_message('审核成功',admin_url('bulk_standard/transfer/'.$type.'/'.$page));
		}
		else
		{
			$this->_message('数据库执行失败',admin_url('bulk_standard/transfer/'.$type.'/'.$page),2);	
		}
		
	}
	
	//债券转让撤销 
	function del_transfer($id = false,$type = 0,$page = 0)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('user_transfer',1,0);
		if($query->num_rows() <=0)
		{
			$this->_message('此项目不存在',admin_url('bulk_standard/transfer/'.$type.'/'.$page),2);	
		}	
		$row = $query->row_array();
		if($row['static'] > 3)
		{
			$this->_message('当前状态无法撤销',admin_url('bulk_standard/transfer/'.$type.'/'.$page),2);
		}
		$this->db->trans_begin();
		//把状态变味撤销原因 用户撤销
		$this->db->where('id',$id);
		$this->db->set('static',4);
		$this->db->set('reasons',"审核未通过");
		$this->db->set('revoketime',date('Y-m-d H:i:s'));//撤销时间
		$this->db->update('user_transfer');
		
		$this->db->set('transfer',1);//变为未发布转让
		$this->db->where('id',$row['projectid']);
		$this->db->update('user_products');
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->_message('数据库执行失败',admin_url('bulk_standard/transfer/'.$type.'/'.$page),2);
		}
		else
		{
			$this->db->trans_commit();	
			$this->_message('操作成功',admin_url('bulk_standard/transfer/'.$type.'/'.$page));
		}
			
	}
	//复制散标
	function copy_bulk()
	{
		$this->form_validation->set_rules('title', '项目标题', 'required|trim');
		$this->form_validation->set_rules('copyid', '复制项目ID', 'required|trim|integer');
		$this->form_validation->set_rules('money', '项目规模', 'required|is_natural');
		$this->form_validation->set_rules('creattime', '创建时间', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('bulk/copy_bulk');
		}
		else
		{
			//提交信息 
			$copyid = $this->input->post('copyid');
			$title = $this->input->post('title');
			$money = $this->input->post('money');
			$creattime = $this->input->post('creattime');
			//识别复制项目ID
			$this->db->where('id',$copyid);
			$query = $this->db->get('bulk_standard',1,0);
			if($query->num_rows() <=0 )
			{
				$this->_message('复制的项目不存在',admin_url('bulk_standard/copy_bulk'),2);exit();	
			}
			//获取复制项目的那条信息 并重置部分信息
			$row = $query->row_array();
			$row['title'] = $title;
			$row['money'] = $money;
			$row['restmoney'] = $money;
			$row['is_open'] = 2;
			$row['static'] = 1;
			$row['sina_check'] = 1;
			$row['repayment_this'] = 1;
			$row['repayment_num'] = 0;
			$row['send_num'] = 0;
			$row['creattime'] = $creattime;
			$row['starttime'] = "";
			$row['next_interest'] = "";
			$row['endtitme'] = "";
			$row['yuyue'] = 1;
			$row['yuyueuid'] = '';
			unset($row['id']);
			
			if($this->db->insert('bulk_standard',$row))
			{
				$this->_message('提交成功',admin_url('bulk_standard/index'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('bulk_standard/copy_bulk'),2);	
			}			
		}	
	}
	
	
}