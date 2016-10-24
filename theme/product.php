<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
class Product extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_m');
		$this->load->model('transfer_m');
		$this->load->model('response_m');
	}
	function bulk_standard()
	   // {	$id = $_POST['id'];
	   { $id = 1209;
		$row = $this->product_m->bulk_standard($id);
		$data= array();
		 $userproject = $this->product_m->user_bulk($id);
		 if($row)
		 {   //项目简介
	  //       $alldata = array();
	 	//     $alldata['fId'] = $row['id'];
			// $alldata['fNum'] = $row['number'];	
		 //    $alldata['fLei'] = '哈哈';
		 //    $alldata['fRate'] = $row['rate'];
		 //    $alldata['fShang'] = $row['creattime'];
			// $alldata['fTitle'] = $row['title'];
			// $alldata['fTotal'] = $row['money'];
			// $alldata['fTou'] = $row['restmoney'];
			// //风控 亮点
			// $pdata = array();
			// $pdata[0]['fID'] = '001';
			// $pdata[0]['fTitle1'] = "项目详情";
			// $pdata[0]['fText1'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['assets'])));
			// $pdata[0]['fTitle2'] = "风控保证";
			// $pdata[0]['fText2'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['pledge'])));
			// $pdata[0]['fTitle3'] = "项目亮点";
			// $pdata[0]['fText3'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['describe'])));
			// $pdata[0]['fOneID'] = '001';
			// //证照
			// $pdata[1]['fID'] = '002';
			// $pdata[1]['fTitle1'] = "企业证照";
			 // $certi = explode("~",$row['certificate'])
			// var_dump(explode("~",$row['certificate']));
			$arr= array();
	  		foreach(explode("~",$row['certificate']) as $v)
         {
	       $arr[] = $v; 
		  }
         $arr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $arr);
         print_r($arr);
		// 	$pdata[1]['fText1'] = $row['certificate'];
		// 	$pdata[1]['fTitle2'] = "合同协议";
		// 	$pdata[1]['fText2'] = $row['property'];
		// 	$pdata[1]['fTitle3'] = "企业资产";
		// 	$pdata[1]['fText3'] = $row['control'];
		// 	$pdata[1]['fOneID'] = '002';
		// 	$pdata[2]['fID'] = '003';
		// 	$pdata[2]['fText11'] = '用户名';
		// 	$pdata[2]['fText22'] = '购买金额';
		// 	$pdata[2]['fText33'] = '购买时间';
		// 	$pdata[2]['fOneID'] = '003';
		//   	foreach ($userproject as $key => $value) {
		//    	$pdata[$key+3]['fText11'] = substr($value['nickname'], 0,3).'***';
		// 	$pdata[$key+3]['fText22'] = $value['monkey'];	
		// 	$pdata[$key+3]['fText33'] = date('Y-m-d',$value['dateline']);	
		// 	$pdata[$key+3]['fID'] = '004';	
		// 	$pdata[$key+3]['fOneID'] = '003';
		//    }

	  }
	  
	 //     $data['presult'] = $pdata;
	 //     // echo '<pre>';
	 //     // var_dump($data['presult']);
	 //     $data['result'][0] = $alldata;
	 // return $this->response_m->show(200, '个人中心数据获取成功', $data);	  
	}
}