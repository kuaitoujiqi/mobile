<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_m');
		$this->load->model('transfer_m');
	}
	function index()
	{
		
	}
	
	//散标列表
	function bulk_standard_list($page = 1,$ajax = false)
	{
		$config['first_tag_open']		= '<li>';
		$config['first_tag_close']		= '</li>';
		$config['last_tag_open']		= '<li>';
		$config['last_tag_close']		= '</li>';
		$config['cur_tag_open']		= '<li class="active"><a>';
		$config['cur_tag_close']		= '</a></li>';
		$config['next_tag_open']		= '<li>';
		$config['next_tag_close']		= '</li>';
		$config['prev_tag_open']		= '<li>';
		$config['prev_tag_close']		= '</li>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']		= '</li>';
		$this->load->library('pagination');
		$config['base_url'] = site_url('product/bulk_standard_list/');
		$config['per_page'] = 5; 
		$return = $this->product_m->bulk_standard_list($config['per_page'],($page - 1) * $config['per_page']);
		$config['total_rows'] = $return[0];
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$data['page'] = 1;
		if($ajax == false)
		{
			$this->load->view('m/bulk_standard_list',$data);	
		}
		else
		{
			if(count($return[1]) > 0)
			{
				echo json_encode(array(0,$this->load->view('m/ajax_bulk',$data,true)));	
			}
			else
			{
				echo json_encode(array('1'));	
			}	
		}
	}
	//债券转让
	function transfer_list($page = 0)
	{
		//设置超过3天的债券转让状态或2天未审核的项目
		$this->transfer_m->task_transfer_list();
		$config['first_tag_open']		= '<li>';
		$config['first_tag_close']		= '</li>';
		$config['last_tag_open']		= '<li>';
		$config['last_tag_close']		= '</li>';
		$config['cur_tag_open']		= '<li class="active"><a>';
		$config['cur_tag_close']		= '</a></li>';
		$config['next_tag_open']		= '<li>';
		$config['next_tag_close']		= '</li>';
		$config['prev_tag_open']		= '<li>';
		$config['prev_tag_close']		= '</li>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']		= '</li>';
		$this->load->library('pagination');
		$config['base_url'] = site_url('product/transfer_list/');
		$config['per_page'] = 5; 
		$return = $this->transfer_m->front_transfer_list($config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$config['uri_segment'] = 3;
		$data['result'] = $return[1];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$this->load->view('front/transfer_list',$data);
			
	}
	//债券转让内页
	function transfer($id)
	{
		//设置超过3天的债券转让状态或2天未审核的项目
		$this->transfer_m->task_transfer_list();
		
		$row = $this->transfer_m->transfer_info($id);
		if($row)
		{
			$data['row'] = $row[1];
			$data['transfer'] = $row[0]; 
			$data['pro_info'] = $row[2];
			$this->load->view('front/transfer',$data);	
		}
		else
		{
			show_404();	
		}	
	}
	
	//债券转让购买页面
	function form_transfer($id = false,$step = 1)
	{
		$userinfo = userinfo();
		if(!$this->session->userdata('uid'))
		{
			echo "请先登录";exit();
		}
		if($userinfo['trading'] == "")
		{
			echo "请先设置交易密码";exit();
		}
		$check = $this->transfer_m->check_transfer($id);
		if($check[0] != 0)
		{
			echo $check[1];exit();
		}
		if($step == 1)
		{
			echo "success";exit();	
		}
		
		$jjmm = $this->input->post('jjmm');
		if(sha1($jjmm) != $userinfo['trading'])
		{
			echo "交易密码不正确";exit();	
		}
		$buy = $this->transfer_m->trade_transfer($id);
		if($buy[0] == 0)
		{
			echo "success";	exit();
		}
		else
		{
			echo $buy[1];exit();	
		}
		
	}
	
	//散标
	function bulk_standard($id = false)
	{
		$row = $this->product_m->bulk_standard($id);
		if($row)
		{
			$data['row'] = $row; 
			if($row['static'] == 3)
			{
				echo '<script language="javascript">alert("项目已结束");location.href="https://www.kuaitoujiqi.com/m";</script>';
				exit();
			} 
			$data['userproject'] = $this->product_m->user_bulk($id);
			$this->load->view('m/bulk_standard',$data);	
		}
		else
		{
			show_404();	
		}
			
	}
	
	
	
	//购买散标
	function buy_bulk($prouctid = false)
	{
		$userinfo = userinfo();
		if(!$this->session->userdata('uid'))
		{
			$return['code'] = 2;
			$return['msg'] = "请先登录";
			exit(json_encode($return));
		}
		if($userinfo['trading'] == "")
		{
			$return['code'] = 2;
			$return['msg'] = "请先设置交易密码";
			exit(json_encode($return));
		}
		
		$num = $this->input->post('num');
		$num = intval($num);
		$prouctid = intval($prouctid);
		echo json_encode($this->product_m->new_bulk_buy($prouctid,$num,2));		
		
		/*
		$userinfo = userinfo();
		if(!$this->session->userdata('uid'))
		{
			echo "请先登录";exit();
		}
		if($userinfo['trading'] == "")
		{
			echo "请先设置交易密码";exit();
		}
		$jjmm = $this->input->post('jjmm');
		if(sha1($jjmm) != $userinfo['trading'])
		{
			echo "交易密码不正确";exit();	
		}
		$num = $this->input->post('num');
		$num = intval($num);
		$red_paper = $this->input->post('red_papder');  //红包
		$red_paper = intval($red_paper);
		echo $this->product_m->buy_bulk_product($prouctid,$num,$red_paper);
		*/
	}
	//散标表单提交检测
	function buy_bulk_check($id = false)
	{
		if(!$this->session->userdata('uid'))
		{
			
			echo json_encode(array(0 => "login"));exit();
		}
		$num = $this->input->post('num');
		$num = intval($num);
		$check = $this->product_m->new_bulk_buy($id,$num,2);
		echo json_encode($check);
	}
	//加载红包
	function red_paper($id = false,$num = false)
	{
		$get_paper = $this->product_m->get_red_paper($id,$num);
		if($get_paper)
		{
			$data['result'] = $get_paper; 
			echo $this->load->view('front/red_paper_model',$data,true);
		}
		else
		{
			echo "";	
		}
	}
	
	
}