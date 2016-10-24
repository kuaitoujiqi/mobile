<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends Front_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$id = $_REQUEST['id'];
		redirect('news/article/'.$id);	
	}
}