
<!DOCTYPE html>
<html>
<head>
<title>快投机器企业用户管理平台</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="keywords" content="快投机器企业用户管理平台">
<meta name="discription" content="快投机器企业用户管理平台">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/company/css/common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/company/css/system.css" />
<script src="<?php echo base_url();?>style/company/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#selectall").click(function(){
	var s=$(this).attr("src");
	if(s.indexOf("up")>0){//未选中状态
		$(".sysinfo .chk").attr("src","images/index/ck_down.gif")
		$(".sysinfo input:checkbox").attr("checked","checked");
	}
	else{
			$(".sysinfo .chk").attr("src","images/index/ck_up.gif")
			$(".sysinfo input:checkbox").removeAttr("checked");
		}
	});
	$(".list .chk").click(function(){
		var s=$(this).attr("src");
		if(s.indexOf("up")>0){//未选中状态
			$(this).attr("src","images/index/ck_down.gif")
			//$(".sysinfo input:checkbox").attr("checked","checked");
		}
		else{
				$(this).attr("src","images/index/ck_up.gif")
				//$(".sysinfo input:checkbox").removeAttr("checked");
			}
	});
});
</script>
</head>
<body id="sysmain">
	<div class="content">
		<div class="syshead">
			<div class="clearfix">
				<p class="left" style="color:#fff">快投机器企业用户管理平台</p>
				<p class="right"><a class="outsys" style="color:#fff" title="退出系统" href="<?php echo site_url('company/welcome/exit_login');?>">退出</a></p>
			</div>
		</div>
		<div class="sysmain clearfix">
			<div class="sysmenua">
				<ul>
					<li><a href="<?php echo site_url('company/main');?>">后台首页</a></li>
                    <li><a href="<?php echo site_url('company/main/password_change');?>">密码修改</a></li>
                    <li><a href="<?php echo site_url('company/main/recharge');?>">充值</a></li>
                    <li><a href="<?php echo site_url('company/main/withdraw');?>">提现</a></li>
                    <li><a href="<?php echo site_url('company/main/record');?>">账户操作记录</a></li>
					<li><a href="<?php echo site_url('company/main/repayment');?>">还款信息</a></li>
				</ul>
			</div>
