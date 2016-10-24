<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Company_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('company/main_m');
		
	}
	
	function index()
	{
		$userinfo = companyinfo();
		
		if($userinfo['trading'] == "")
		{
			$check = $this->main_m->check_trading();
			
			if(!$check)
			{
				$this->main_m->set_trading();
				exit();
			}
		}
		$data['info'] = $this->main_m->show_company_info();
		$data['monkey'] = $this->main_m->query_balance();
		$this->_view('main',$data);	
		//echo  strtotime('+1 months',time())-172800;
	}
	function password_change()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpass', '旧密码', 'trim|required|callback_check_password');
		$this->form_validation->set_rules('newpass', '新密码', 'trim|required|min_length[8]|max_length[16]|alpha_dash');
		$this->form_validation->set_rules('compass', '确认密码', 'trim|required|matches[newpass]');
		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('password');
		}
		else
		{
			$password = $this->input->post('newpass');
			$uid = $this->session->userdata('com_id');
			$this->db->where('id',$uid);
			$this->db->set('password',sha1($password));
			if($this->db->update('user'))
			{
				echo "<script>alert('修改成功,下次登录请使用新密码');location.href='".site_url('company/main/password_change')."';</script>";exit();
			}
			else
			{
				echo "<script>alert('修改失败,请稍后在试');location.href='".site_url('company/main/password_change')."';</script>";exit();	
			}
		}	
	}
	
	function check_password($str = false)
	{
		$uid = $this->session->userdata('com_id');
		$password = sha1($str);
		$this->db->where('id',$uid);
		$this->db->where('password',$password);
		$num = $this->db->get('user',1,0)->num_rows();
		if($num > 0)
		{
			return true;	
		}
		else
		{
			$this->form_validation->set_message('check_password', '旧密码不正确');
			return false;
				
		}
	}
	
	
	//充值

	function recharge()
	{
		$this->load->library('form_validation');
		//网银在线支付
		$this->form_validation->set_rules('monkey', '充值金额', 'trim|required|integer|greater_than[0]');
		$this->form_validation->set_error_delimiters('', '');
			
		if ($this->form_validation->run() == FALSE)
		{	
			$this->_view('recharge');	
		}
		else
		{
			//充值提交	
			$return = $this->main_m->recharge();
			if(!$return)
			{
				$this->_view('recharge');		
			}
		}
	}
	
	//账户操作记录
	function record($page = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('company/main/record/');
		$config['per_page'] = 8; 
		$config['uri_segment'] = 4;
		$return = $this->main_m->record(0,$config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$this->_view('record',$data);		
	}
	//提现
	function withdraw()
	{
		$this->_view('withdraw');	
	}
	

	//提交提现
	function form_withdraw()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('monkey', '提现金额', 'trim|required|integer|greater_than[0]');
		
		$return = $this->main_m->withdraw();	
		echo $return[1];
	}
	
	
	//查询还款列表
	function repayment($page = 0)
	{
		
		$this->load->library('pagination');
		$config['base_url'] = site_url('company/main/repayment/');
		$config['per_page'] = 8; 
		$config['uri_segment'] = 4;
		$companyuid = $this->session->userdata('com_id');
		$this->db->start_cache();
		$this->db->where('company',$companyuid);
		$this->db->where('repayment_this',1);
		$this->db->where('static',2);
		$this->db->stop_cache();
		$config['total_rows'] = $this->db->count_all_results('bulk_standard');
		$this->pagination->initialize($config); 
		$this->db->order_by('next_interest','asc');
		$data['result'] = $this->db->get('bulk_standard',$config['per_page'],$page)->result_array();	;
		$data['links'] = $this->pagination->create_links();		
		$this->db->flush_cache();
		$this->_view('repayment',$data);	
	}
	//提交还款
	function form_repayment($id = false)
	{
		$return = $this->main_m->form_repayment($id);	
		if($return[0] == 0)
		{
			exit( $return[1]);
		}
		else
		{
			echo "<script>alert('提交失败,".$return[1]."');location.href='".site_url('company/main/repayment')."';</script>";exit();	
		}
	}
	
	//已还款历史记录
	function repayment_old($page = 0)
	{
			
	}
}