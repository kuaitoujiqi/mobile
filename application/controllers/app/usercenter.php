<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
class Usercenter extends Front_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('app/response_m');
		$this->load->model('app/usercenter_m');
		
		//添加假信息
		//$this->session->set_userdata('uid',500143);
		$this->load->helper('front');
		$this->load->helper('money');
		
		// if($userinfo['is_idcard'] == 0)
		// {
		// 	$this->session->set_flashdata('idcard','1');
		// 	if($this->uri->segment(2,2) != "verify_success" && $this->uri->segment(2,2) != "verify_idcard" && $this->uri->segment(2,2) != "safe" && $this->uri->segment(2,2) !="authentication" && $this->uri->segment(2,2) != "change_phone" && $this->uri->segment(2,2) !="change_password" && $this->uri->segment(2,2) !="sendphoncode")
		// 	{
		// 		redirect('usercenter/verify_idcard'); //未身份验证请先身份验证
		// 	}
		// }
		// else
		// {

		// 	//设置交易密码	
		// 	if($userinfo['trading'] == "")
		// 	{
		// 		//使用接口查询是否设置交易密码
		// 		$check_trading = $this->usercenter_m->check_trading();
		// 		if(!$check_trading)
		// 		{
		// 			$this->usercenter_m->set_trading();	
		// 		}
		// 	}
		
		// }

	}
	//首页
	function index()
	{
		
		// $userinfo = userinfo();
		// $data['userinfo'] = userinfo();
		$userinfo['id'] = $_POST['uid'];
		$name_record = $this->usercenter_m->check_userinfo($userinfo['id']);
		$data['name'] = $name_record['nickname'];
		$this->db->where('id',$userinfo['id']);
	    $this->db->select('balance');
	    $row = $this->db->get('user')->row_array();
	    $balance = $row['balance'];
		$user['czjl'] = $this->usercenter_m->record(0,15,0,$userinfo['id']);
		//持有产品金额
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('prostatic',1);
		$user['cyje'] = $this->db->get('user_products')->row_array();
		//待收利息
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('interest');
		$this->db->where('static',2);
		$user['lsje'] = $this->db->get('user_products')->row_array();
		$this->load->model('order_m');
		$this->order_m->same_monkey($userinfo['id']);
		// var_dump($user['lsje']);
		$mon = $user['lsje']['interest'];
		
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where_in('type',array(5,10));
		$user['ljhk'] = $this->db->get('fr_order')->row_array();
		// var_dump($user['ljhk']);
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',5); //10为债券
		$ljhk = $this->db->get('fr_order')->row_array(); //累计还款
		$ljhk = empty($ljhk['monkey'])?0:$ljhk['monkey'];
		
		
		//累计购买债券原始价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',9);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		$user['gmzq'] = $ljgz_s;
		//累计购买债券实际价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',2);
		$ljgz_y = $this->db->get('user_products')->row_array(); 
		$ljgz_y = empty($ljgz_y['monkey'])?0:$ljgz_y['monkey'];
		
		//累计购买债券实际价格状态5 提前还本
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$this->db->where('type',2);
		$ljgz_y1 = $this->db->get('user_products')->row_array(); 
		$ljgz_y1 = empty($ljgz_y1['monkey'])?0:$ljgz_y1['monkey'];
		
		$ljgz_y = $ljgz_y - (-$ljgz_y1);
		$gmzqsjjg = $ljgz_y;
        // 代收总额
		$lsjea = $user['lsje']['interest']== ""?0:$user['lsje']['interest'];
		$cyjea = $user['cyje']['monkey'] == ""?0:$user['cyje']['monkey'];
		 $fDai= $cyjea-(-$lsjea)-(-($user['gmzq']-$gmzqsjjg));
		 $data['fDai'] = strval(number_format($fDai,2));
		//累计投资
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',1); // 原始投资
		$ljtz = $this->db->get('user_products')->row_array(); //持有产品金额
		$ljtz = empty($ljtz['monkey'])?0:$ljtz['monkey'];
		
		//新增
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$this->db->where('type',1); // 原始投资
		$ljtz1 = $this->db->get('user_products')->row_array(); //持有产品金额
		$ljtz1 = empty($ljtz1['monkey'])?0:$ljtz1['monkey'];
		$fNum = $ljtz-(-$ljtz1);
		$data['fNum'] = strval(number_format($fNum,2));
		// var_dump($data['ljtz']);
		//获取已结束项目的的本金
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('interest',0);
		$this->db->where('static',2);
		$end_b = $this->db->get('user_products')->row_array(); 
		$end_b = empty($end_b['monkey'])?0:$end_b['monkey'];
		
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$end_b1 = $this->db->get('user_products')->row_array(); 
		$end_b1 = empty($end_b1['monkey'])?0:$end_b1['monkey'];
		
		$end_b = $end_b -(-$end_b1);//41000.00+10000.00
		
		 // $data['fEared'] = $ljhk - $end_b -(-($ljgz_y-$ljgz_s));//54156.00-51000  + (59000-69000.00)
		// $data['fEared'] = "900";//54156.00-51000  + (59000-69000.00)
		//历史还款 减去已结束的本金 加 债券差价
		if($user['cyje']['monkey'] == "")
		{
			$cyje_n = 0;
		}else{
			$cyje_n=$user['cyje']['monkey'];
		}
		if($user['lsje']['interest'] == ""){
			$lsje_n = 0;
		}else{
			$lsje_n=$user['lsje']['interest'];
		}
		$fInvest = $mon;//代收收益
		$data['fInvest'] = strval(number_format($fInvest,2));
		$fEared = $ljhk - $end_b -(-($ljgz_y-$ljgz_s));//已或收益
		$data['fEared'] = strval(number_format($fEared,2));
		$fTotal= $cyje_n-(-$balance)-(-$lsje_n);//总资产
		$data['fTotal'] = strval(number_format($fTotal,2));
		$fUse = $balance;//可用余额
		$data['fUse'] = strval(number_format($fUse,2));
		$userdata['0'] = $data;
	    return $this->response_m->show(200, '个人中心数据获取成功', $userdata);
		
	}
	//投资记录
	function invest()
	{   $userinfo['id'] = $_POST['uid'];
		$per_page = 50;
		$allpage = 1;
		$page = ($allpage - 1) * $per_page;
		$this->db->start_cache();
		$this->db->from('fr_order');
		$this->db->where('type',2);
	    $this->db->where('fr_order.static',2);
		$this->db->where('uid',$userinfo['id']);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->order_by('dateline','desc');
		$this->db->limit($per_page,$page);
		$this->db->select('fr_order.*,bulk_standard.is_backed,bulk_standard.title,bulk_standard.static as pstatic,bulk_standard.next_interest');	
		$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		$userdata = $result;
	 	$alldata = array();
		foreach ($userdata as $key => $value) {
			$alldata[$key]['fTitle'] = $value['title'];
			$alldata[$key]['fMoney'] = $value['monkey'];	
			$alldata[$key]['fTime'] = date('Y-m-d',$value['dateline']);	
		 if($value['pstatic'] == 2){
		 	$alldata[$key]['fStatus'] = '下期还款';
		}else if($value['pstatic'] == 1){
			$alldata[$key]['fStatus'] = '等待开始';
		}else if($value['pstatic'] == 3){
			$alldata[$key]['fStatus'] = '已结束';
		}
	  }
	
		 return $this->response_m->show(200, '个人中心数据获取成功', $alldata);
		
	}
	//还款记录
	function repayment()
	{   $userinfo['id'] = $_POST['uid'];
		$per_page = 50;
		$allpage = 1;
		$page = ($allpage - 1) * $per_page;
		$this->db->start_cache();
		$this->db->from('fr_order');
		$this->db->where('type',5);
		$this->db->where('uid',$userinfo['id']);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->order_by('dateline','desc');
		$this->db->limit($per_page,$page);
		$this->db->select('fr_order.*,bulk_standard.is_backed,bulk_standard.title,bulk_standard.static as pstatic,bulk_standard.next_interest');	
			$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		$userdata = $result;
	 	$alldata = array();
		foreach ($userdata as $key => $value) {
			$alldata[$key]['fTitle'] = $value['title'];
			$alldata[$key]['fRepay'] = $value['monkey'];	
			$alldata[$key]['fTime'] = date('Y-m-d',$value['dateline']);	
	  }
	
		 return $this->response_m->show(200, '个人中心数据获取成功', $alldata);
		
	}
	//红包记录
	function redpaper($page = 0)
	{   
		// $userinfo = userinfo();
		// $data['userinfo'] = userinfo();
		// $uid = $userinfo['id'];
		$uid = $_POST['uid'];
		$per_page = 15;	
		$queryall= $this->db->query("SELECT user_products.uid,user_products.projectid,bulk_standard.id,bulk_standard.title as alltitle,fr_order.id as allid,fr_order.type,fr_order.uid,fr_order.monkey,fr_order.dateline,user_products.monkey,red_paper.title,red_paper.monkey FROM (fr_order left join user_products on user_products.uid = fr_order.uid) left join red_paper on fr_order.monkey = red_paper.monkey left join bulk_standard on user_products.projectid = bulk_standard.id WHERE fr_order.type = 16 and user_products.monkey >= 5000 and fr_order.uid=$uid and red_paper.monkey>0");//获取记录总数

		$query= $this->db->query("SELECT bulk_standard.title as fTitle,FROM_UNIXTIME(fr_order.dateline, '%Y-%m-%d') as fTime,red_paper.monkey as fMoney FROM (fr_order left join user_products on user_products.uid = fr_order.uid) left join red_paper on fr_order.monkey = red_paper.monkey left join bulk_standard on user_products.projectid = bulk_standard.id WHERE fr_order.type = 16 and user_products.monkey >= 5000 and fr_order.uid=$uid and red_paper.monkey>0 order by fr_order.id DESC limit $page,10");
		 // var_dump($query);
		 $userdata['info'] = $query->result_array();
		 $num = $queryall->num_rows();
		 // echo '<pre>';
		  // var_dump($data['info']);
 		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/redpaper');
		$config['per_page'] = 10;//每页记录数 
		$config['cur_page'] = $page;
		$config['total_rows'] = $num;//总记录数

		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();	
		//var_dump($data['links']);
       // $this->load->view('usercenter/redpaper',$data);
        return $this->response_m->show(200, '个人中心数据获取成功', $userdata);
		 		
	}
	//重充值记录
	function recharge($page = 0)
 {	$uid = $_POST['uid'];
        // $uid = '500143';
		// $data['userinfo'] = userinfo();
		$this->load->library('form_validation');

 		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/recharge');
		$config['per_page'] = 15; 
		$config['cur_page'] = $page;
		$return = $this->usercenter_m->record(1,$config['per_page'],$page,$uid);
		
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$userdata = $return[1];
		$data['links'] = $this->pagination->create_links();	
		$data['type'] = 2;	

		$bankinfo = require('./data/bankinfo.php');
		$data['bankinfo'] = $bankinfo['u_online'];
	foreach ($userdata as $key => $value) {
			$alldata[$key]['fTitle'] = $value['id'];
			$alldata[$key]['fRecharge'] = $value['monkey'];	
			$alldata[$key]['fTime'] = date('Y-m-d',$value['dateline']);	
		 if($value['static'] == 2){
		 	$alldata[$key]['fStatus'] = '成功';
		}else if($value['static'] == 1){
			$alldata[$key]['fStatus'] = '处理中';
		}else if($value['static'] == 3){
			$alldata[$key]['fStatus'] = '失败';
		}
	  }
		// echo '<pre>';
		// var_dump($data);
		// $this->load->view('usercenter/recharge',$data);	
		 return $this->response_m->show(200, '个人中心数据获取成功', $alldata);

	}
	//提现 
	function withdraw($type = 7,$page = 0)
	{   
		$uid = $_POST['uid'];
		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/record/7');
		$config['per_page'] = 15; 
		$config['uri_segment'] = 4;
		$return = $this->usercenter_m->record(7,$config['per_page'],$page,$uid);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$userdata = $return[1];
		$data['links'] = $this->pagination->create_links();		
		$data['type'] = 7;
		
		foreach ($userdata as $key => $value) {
			$alldata[$key]['fTitle'] = $value['id'];
			$alldata[$key]['fRecharge'] = $value['monkey'];	
			$alldata[$key]['fTime'] = date('Y-m-d',$value['dateline']);	
		 if($value['static'] == 2){
		 	$alldata[$key]['fStatus'] = '成功';
		}else if($value['static'] == 1){
			$alldata[$key]['fStatus'] = '处理中';
		}else if($value['static'] == 3){
			$alldata[$key]['fStatus'] = '失败';
		}
	  }
		// echo '<pre>';
		// var_dump($alldata );
       return $this->response_m->show(200, '个人中心数据获取成功', $alldata);
	}
	function binding()
	{	   $uid = $_GET['uid'];
	 	   $this->usercenter_m->bind_bank(2,$uid);
	}
	// 充值
	function send_recharge(){
		$uid = $_GET['uid'];
		$money = $_GET['money'];
		$return = $this->usercenter_m->recharge('online','m',$uid,$money);
	    print_r($return[1]);
	}
	function form_withdraw()
	{    
		$uid = $_GET['uid'];
		$money = $_GET['money'];
		$return = $this->usercenter_m->withdraw(2,$uid,$money);	
		print_r($return[1]);

	}
	//验证是否实名制
	function checkinfo(){
		$uid = $_POST['uid'];
		
		$info = $this->usercenter_m->check_userinfo($uid);
		$data = array();
		if($info['is_idcard'] == 0){
			$this->session->set_flashdata('idcard','1');
			if($this->uri->segment(2,2) != "verify_success" && $this->uri->segment(2,2) != "verify_idcard" && $this->uri->segment(2,2) != "safe" && $this->uri->segment(2,2) !="authentication" && $this->uri->segment(2,2) != "change_phone" && $this->uri->segment(2,2) !="change_password" && $this->uri->segment(2,2) !="sendphoncode")
			{
				 $data[0] = '401';//未实名制
				 // echo '振奋未验证';
			}
		}else{
			$data[0] = '201';
		}
		if($info['trading'] == ""){
			$data[1] = '402';//交易密码未设置
		}else{
			$data[1] = '202';
		}
		if($info['is_mobile'] == 0){
			$data[2] = '403';//手机号未验证
		}else{
			$data[2] = '203';
		}
		return $this->response_m->show(200, '实名验证信息',$data);
		// var_dump($data);
	}
	//实名认证
	function authentication(){
		$uid = $_POST['uid'];
		$name = $_POST['name'];
		$idcard = $_POST['idcard'];
		$res = $this->usercenter_m->authentication($uid,$name,$idcard);
		if($res){
			return $this->response_m->show(200, '实名验证成功');
		}else{
			return $this->response_m->show(400, '实名验证失败');
		}
	}
	function set_trading(){
		$uid = 500171;
		$res = $this->usercenter_m->change_trading(2,$uid);
	}
		function change_phone()
	{   
		$uid = $_GET['uid'];
		$res = $this->usercenter_m->modify_verify_mobile($uid);
		print_r($res);
	}
	function change_trading()
	{   
		// $uid = 500143;
		
		$uid = $_GET['uid'];
		$res = $this->usercenter_m->change_trading(1,$uid);	
		print_r($res);
	}
	function change_password($ajax = false)
	{   
		$uid = $_POST['uid'];
		$oldpass = $_POST['password'];
		// $uid = 500143;
		// $oldpass = 'satan126';
		// $newpass = 'HUIHUI521';
		$preg = '/^[a-zA-Z]\w{5,17}$/';
				if(!preg_match($preg,$oldpass)){
				return $this->response_m->show(401, '旧密码格式不正确');
			}
		$newpass = $_POST['Scode'];
		$preg = '/^[a-zA-Z]\w{5,17}$/';
				if(!preg_match($preg,$oldpass)){
				return $this->response_m->show(402, '新密码格式不正确');
			}
		$userinfo = $this->usercenter_m->check_userinfo($uid);
		if(sha1($oldpass) != $userinfo['password']){
			return $this->response_m->show(403, '旧密码不正确');
		}
		$return = $this->usercenter_m->change_password($newpass,$uid);
		if($return){
			return $this->response_m->show(200, '密码修改成功');
		}else{
			return $this->response_m->show(404, '修改失败');
		}
	}
}