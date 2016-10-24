<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
class Product extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('app/product_m');
		$this->load->model('transfer_m');
		$this->load->model('app/response_m');
		$this->load->model('app/usercenter_m');
	}
	function bulk_standard()
	   {//	$id = 1273;
	  	 $id = $_POST['id'];
		$row = $this->product_m->bulk_standard($id);
		$data= array();
		 $userproject = $this->product_m->user_bulk($id);
		 if($row)
		 {   //项目简介
		 	// echo '<pre>';
		 	// var_dump($row);
		 	if($row['static'] == 1){
		 		if($row['restmoney'] == 0){
		 			$static = 1;//审核中
		 		}else if($row['is_open'] == 1 and $row['creattime'] > date('Y-m-d H:i:s')){
		 			$static = 2;//即将上线
		 		}else{
		 			$static = 3;//可以购买
		 		}
		 	}
		 	if($row['static'] == 2){
		 		$static = 4;//还款中
		 	}
		 	if($row['static'] == 3){
		 		$static = 5;//已结束
		 	}
		 	// var_dump($static);
		//  	$static = 5;
	        $alldata = array();
	        $alldata['static'] = $static;
	 	    $alldata['fId'] = $row['id'];
			$alldata['fNum'] = $row['number'];	
		    $alldata['fRate'] = ($row['rate']*100).'%';
		    $alldata['fShang'] = $row['creattime'];
			$alldata['fTitle'] = $row['title'];
			$alldata['fTotal'] = $row['money'];
			$alldata['fTou'] = $row['restmoney'];
			$alldata['fTime'] = $row['day'];
			$alldata['fEach'] = $row['each'];
			$alldata['fJin'] = (((int)$row['money']-(int)$row['restmoney'])/(int)$row['money']*100).'%';
			//风控 亮点
			$pdata = array();
			$pdata[0]['fID'] = '001';
			$pdata[0]['fTitle1'] = "项目详情";
			$pdata[0]['fText1'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['assets'])));
			$pdata[0]['fTitle2'] = "风控保证";
			$pdata[0]['fText2'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['pledge'])));
			$pdata[0]['fTitle3'] = "项目亮点";
			$pdata[0]['fText3'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['describe'])));
			$pdata[0]['fOneID'] = '001';
			//证照
			$pdata[1]['fID'] = '002';
			$pdata[1]['fTitle1'] = "企业证照";
			//在前面加上网址
			$certiarr= array();
	  		foreach(explode("~",$row['certificate']) as $v)
          {
	       $certiarr[] = $v; 
		  }
           $certiarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $certiarr);
         	foreach ($certiarr as $key => $value) {
		   	$pdata[1]['fImg1'][$key] = $value;
		   }


		   $pdata[1]['fTitle2'] = "合同协议";
		    // $pdata[1]['fText9'] = $row['property'];
		   $proarr= array();
	  		foreach(explode("~",$row['property']) as $v)
          {
	       $proarr[] = $v; 
		  }
           $proarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $proarr);
         	foreach ($proarr as $key => $value) {
		   	$pdata[1]['fImg2'][$key] = $value;
		   }
			

			$pdata[1]['fTitle3'] = "企业资产";
			// $pdata[1]['fText10'] = $row['control'];
			$conarr= array();
	  		foreach(explode("~",$row['control']) as $v)
          {
	       $conarr[] = $v; 
		  }
           $conarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $conarr);
         	foreach ($conarr as $key => $value) {
		   	$pdata[1]['fImg3'][$key] = $value;
		   }
			
			$pdata[1]['fOneID'] = '002';
			$pdata[2]['fID'] = '003';
			$pdata[2]['fText11'] = '用户名';
			$pdata[2]['fText22'] = '购买金额';
			$pdata[2]['fText33'] = '购买时间';
			$pdata[2]['fOneID'] = '003';
		  	foreach ($userproject as $key => $value) {
		   	$pdata[$key+3]['fText11'] = substr($value['nickname'], 0,3).'***';
			$pdata[$key+3]['fText22'] = $value['monkey'];	
			$pdata[$key+3]['fText33'] = date('Y-m-d',$value['dateline']);	
			$pdata[$key+3]['fID'] = '004';	
			$pdata[$key+3]['fOneID'] = '003';
		   }

	  }
	     $data['presult'] = $pdata;
	     $data['result'][0] = $alldata;
	 return $this->response_m->show(200, '个人中心数据获取成功', $data);	  
	}
	function buybulk_standard()
	   {
	   	$uid = $_POST['uid'];
	   	$info = $this->usercenter_m->check_userinfo($uid);

	  	 $id = $_POST['id'];
		$row = $this->product_m->bulk_standard($id);
		$data= array();
		 $userproject = $this->product_m->user_bulk($id);
		 if($row)
		 {   //项目简介
		 	// echo '<pre>';
		 	// var_dump($row);
		 	if($row['static'] == 1){
		 		if($row['restmoney'] == 0){
		 			$static = 1;//审核中
		 		}else if($row['is_open'] == 1 and $row['creattime'] > date('Y-m-d H:i:s')){
		 			$static = 2;//即将上线
		 		}else{
		 			$static = 3;//可以购买
		 		}
		 	}
		 	if($row['static'] == 2){
		 		$static = 4;//还款中
		 	}
		 	if($row['static'] == 3){
		 		$static = 5;//已结束
		 	}
		 	// var_dump($static);
		//  	$static = 5;
	        $alldata = array();
	        	$alldata['balance'] = $info['balance'];
	        $alldata['static'] = $static;
	 	    $alldata['fId'] = $row['id'];
			$alldata['fNum'] = $row['number'];	
		    $alldata['fRate'] = ($row['rate']*100).'%';
		    $alldata['fShang'] = $row['creattime'];
			$alldata['fTitle'] = $row['title'];
			$alldata['fTotal'] = $row['money'];
			$alldata['fTou'] = $row['restmoney'];
			$alldata['fTime'] = $row['day'];
			$alldata['fEach'] = $row['each'];
			$alldata['fJin'] = (((int)$row['money']-(int)$row['restmoney'])/(int)$row['money']*100).'%';
			//风控 亮点
			$pdata = array();
			$pdata[0]['fID'] = '001';
			$pdata[0]['fTitle1'] = "项目详情";
			$pdata[0]['fText1'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['assets'])));
			$pdata[0]['fTitle2'] = "风控保证";
			$pdata[0]['fText2'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['pledge'])));
			$pdata[0]['fTitle3'] = "项目亮点";
			$pdata[0]['fText3'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row['describe'])));
			$pdata[0]['fOneID'] = '001';
			//证照
			$pdata[1]['fID'] = '002';
			$pdata[1]['fTitle1'] = "企业证照";
			//在前面加上网址
			$certiarr= array();
	  		foreach(explode("~",$row['certificate']) as $v)
          {
	       $certiarr[] = $v; 
		  }
           $certiarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $certiarr);
         	foreach ($certiarr as $key => $value) {
		   	$pdata[1]['fImg1'][$key] = $value;
		   }


		   $pdata[1]['fTitle2'] = "合同协议";
		    // $pdata[1]['fText9'] = $row['property'];
		   $proarr= array();
	  		foreach(explode("~",$row['property']) as $v)
          {
	       $proarr[] = $v; 
		  }
           $proarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $proarr);
         	foreach ($proarr as $key => $value) {
		   	$pdata[1]['fImg2'][$key] = $value;
		   }
			

			$pdata[1]['fTitle3'] = "企业资产";
			// $pdata[1]['fText10'] = $row['control'];
			$conarr= array();
	  		foreach(explode("~",$row['control']) as $v)
          {
	       $conarr[] = $v; 
		  }
           $conarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $conarr);
         	foreach ($conarr as $key => $value) {
		   	$pdata[1]['fImg3'][$key] = $value;
		   }
			
			$pdata[1]['fOneID'] = '002';
			$pdata[2]['fID'] = '003';
			$pdata[2]['fText11'] = '用户名';
			$pdata[2]['fText22'] = '购买金额';
			$pdata[2]['fText33'] = '购买时间';
			$pdata[2]['fOneID'] = '003';
		  	foreach ($userproject as $key => $value) {
		   	$pdata[$key+3]['fText11'] = substr($value['nickname'], 0,3).'***';
			$pdata[$key+3]['fText22'] = $value['monkey'];	
			$pdata[$key+3]['fText33'] = date('Y-m-d',$value['dateline']);	
			$pdata[$key+3]['fID'] = '004';	
			$pdata[$key+3]['fOneID'] = '003';
		   }

	  }
	     $data['presult'] = $pdata;
	     $data['result'][0] = $alldata;
	 return $this->response_m->show(200, '个人中心数据获取成功', $data);	  
	}
	function transfer()
	{    $id =$_POST['id'];
		//设置超过3天的债券转让状态或2天未审核的项目
		$this->transfer_m->task_transfer_list();
		
		$row = $this->transfer_m->transfer_info($id);
		// $id = $_POST['id'];
		$data= array();
		// echo '<pre>';
		// var_dump($row);
		 if($row)
		 {   //项目简介
	        $alldata = array();
	 	    $alldata['fId'] = $row[0]['id'];
			$alldata['fNum'] = $row[1]['number'];	
		    $alldata['fRate'] = ($row[0]['rate']*100).'%';
		    $alldata['fShang'] = $row[0]['cretattime'];
			$alldata['fTitle'] = $row[0]['title'];
			$alldata['fTransfer'] = $row[0]['monkey'];
			$alldata['fOriginal'] = $row[0]['holding'];
			$alldata['fTime'] = $row[0]['endtitme']-86400;
			// var_dump($alldata);
			//风控 亮点
			$pdata = array();
			$pdata[0]['fID'] = '001';
			$pdata[0]['fTitle1'] = "项目详情";
			$pdata[0]['fText1'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row[1]['assets'])));
			$pdata[0]['fTitle2'] = "风控保证";
			$pdata[0]['fText2'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row[1]['pledge'])));
			$pdata[0]['fTitle3'] = "项目亮点";
			$pdata[0]['fText3'] = str_replace(';','',str_replace('&nbsp','',strip_tags($row[1]['describe'])));
			$pdata[0]['fOneID'] = '001';
			//证照
			$pdata[1]['fID'] = '002';
			$pdata[1]['fTitle1'] = "企业证照";
			//在前面加上网址
			$certiarr= array();
	  		foreach(explode("~",$row[1]['certificate']) as $v)
          {
	       $certiarr[] = $v; 
		  }
           $certiarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $certiarr);
         	foreach ($certiarr as $key => $value) {
		   	$pdata[1]['fImg1'][$key] = $value;
		   }


		   $pdata[1]['fTitle2'] = "合同协议";
		    // $pdata[1]['fText9'] = $row['property'];
		   $proarr= array();
	  		foreach(explode("~",$row[1]['property']) as $v)
          {
	       $proarr[] = $v; 
		  }
           $proarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $proarr);
         	foreach ($proarr as $key => $value) {
		   	$pdata[1]['fImg2'][$key] = $value;
		   }
			

			$pdata[1]['fTitle3'] = "企业资产";
			// $pdata[1]['fText10'] = $row['control'];
			$conarr= array();
	  		foreach(explode("~",$row[1]['control']) as $v)
          {
	       $conarr[] = $v; 
		  }
           $conarr = array_map(create_function('$item', 'return "http://www.kuaitoujiqi.com$item";'), $conarr);
         	foreach ($conarr as $key => $value) {
		   	$pdata[1]['fImg3'][$key] = $value;
		   }
			
			 $pdata[1]['fOneID'] = '002';

	  }
	     $data['presult'] = $pdata;
	     $data['result'][0] = $alldata;
	 return $this->response_m->show(200, '个人中心数据获取成功', $data);
	}
	function test($prouctid = false)
	{	   
	        $uid = $_GET['uid'];
		    $prouctid = $_GET['pid']; 
			$num = $_GET['input'];
		    $num = intval($num);
		    print_r($this->product_m->app_new_bulk_buy($prouctid,$num,$uid));
	}
	
}