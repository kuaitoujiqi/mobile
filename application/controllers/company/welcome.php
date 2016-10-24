<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('welcome_m');
	}
	
	function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('u', '企业名称', 'trim');
		$this->form_validation->set_rules('p', '密码', 'trim');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('company/login');	
		}
		else
		{
			$u = $this->input->post('u');
			$p = $this->input->post('p');
			$this->db->where('nickname',$u);
			$this->db->where('password',sha1($p));
			$this->db->where('type',2);
			$query = $this->db->get('user',1,0);
			
			if($query->num_rows()<=0)
			{
				echo "<script>alert('企业全称或密码错误');location.href='".site_url('company/welcome/login')."';</script>";exit();
			}
			else
			{
				$row = $query->row_array();
				$this->session->set_userdata('com_id',$row['id']);
				redirect('company/main');
			}
		}	
	}
	
	function exit_login()
	{
		$this->session->unset_userdata('com_id');
		redirect('company/welcome/login');	
	}
}