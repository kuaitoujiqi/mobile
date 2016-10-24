<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appdown extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('welcome_m');
	}
	function index()
	{
		$this->load->view('appdown');
	}
}