<!DOCTYPE html>
<html>
<head>
<?php /*?>	<script src="<?php echo base_url();?>style/js/uaredirect.js"></script>
	<script language="javascript">
    	uaredirect("https://www.kuaitoujiqi.com/m/");
    </script><?php */?>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keyword;?>" />
    <meta name="description" content="<?php echo $description;?>" />
    <!--<meta name="viewport" content="width=device-width"> -->
    <link href="" rel="apple-touch-icon-precomposed">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>


</head>
<body>
<style>
.login_title{
	width:150px;
	height:30px;
	text-align:center;
	margin-left:18px;
	border-bottom:3px solid #00aac6;
}
.login_frame .row{
	margin:20px auto 20px 0;
}
.login_frame_input{
	margin:80px auto auto 43px;
	border-right:1px solid #f2f2fd;
}
.login_frame_adv{
	margin:113px auto auto 30px;	
	
}
</style>
	<!---头部--->
    <?php $this->load->view('front/header');?>
	
	<div style="background: #f2f2fd;padding:20px 0;">
		<div class="container" style="height:600px;line-height:26px;background:#fff;">

			<div class="row login_frame" id="login_frame">
				<div class="col-xs-12 col-md-4 login_frame_input">
					<div class="row">
					<h4>
						<div class="login_title">欢迎登录快投机器</div>
					</h4>					
					</div>
					<form class="form-horizontal mt10">
										
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="input-group">
							   <span class="input-group-btn">
								  <button class="btn btn-primary" type="button" style="width:80px;" disabled="disabled">
									 手机号
								  </button>
							   </span>
							   <input type="text" class="form-control" id="recipient-name"  placeholder="请输入手机号或用户名" id="username">
							</div>								
						</div>
					</div>
					<div class="row" id="username_error" style="display:none;">
						<div class="col-xs-12 col-md-12">
                            <div class="alert alert-danger">用户名不能为空</div>
						</div>					
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="input-group">
							   <span class="input-group-btn">
								  <button class="btn btn-primary" type="button" style="width:80px;" disabled="disabled">
									 密码
								  </button>
							   </span>
							   <input type="password" class="form-control" placeholder="请输入密码" id="login_password">
							</div>	
						</div>
					</div>
					<div class="row" id="login_password_error" style="display:none;">
						<div class="col-xs-12 col-md-12">
                            <div class="alert alert-danger">密码不能为空</div>
						</div>					
					</div>
					
					<div class="row" id="info_error" style="display:none;">
						<div class="col-xs-12 col-md-12">
                            <div class="alert alert-danger">用户名或密码错误！</div>
						</div>					
					</div>
										
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<div class="input-group">
							   <span class="input-group-btn">
								  <button class="btn btn-primary" type="button" style="width:80px;" disabled="disabled">
									验证码
								  </button>
							   </span>
							   <input type="text" class="form-control" placeholder="请输入验证码" name="piccode" id="piccode">
							</div>												
						</div>
						<div class="col-xs-12 col-md-4">
							<img src="<?php echo site_url('welcome/regesiter_code');?>"  alt="点击刷新,不分大小写"  style="cursor:pointer;border:1px solid #ddd;width:80%;" class="piccode"/>
						</div>
					</div>
					<div class="row" id="verify_error" style="display:none;">
						<div class="col-xs-12 col-md-12">
                            <div class="alert alert-danger">验证码错误！</div>
						</div>					
					</div>	
					
					<!----	
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<input type="checkbox" />&nbsp;&nbsp;记住密码
						</div>
					</div>
					----->
					
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<button type="button" class="btn btn-danger btn-block" id="submit_login">立即登录</button>
						</div>
					</div>	
					<div class="row">
						<div class="col-xs-12 col-md-6">
							没有账号？&nbsp;&nbsp;<a href="<?php echo site_url('welcome/register_frame');?>">立即注册</a>
						</div>
						<div class="col-xs-12 col-md-6 text-right">
							<a href="<?php echo site_url('welcome/forget_frame');?>">忘记密码？</a>
						</div>
					</div>
					</form>
				</div>
				<div class="col-xs-12 col-md-7">
					<div class="login_frame_adv">
						<a href="#"><img src="<?php echo base_url();?>style/img/login_banner.png" width="100%" /></a>
					</div>
					<div class="row" style="border:1px solid #ddd;margin-left:30px;">
						<div class="col-xs-12 col-md-3 text-right">
							<img src="<?php echo base_url();?>style/img/header/xinlang.jpg" />
						</div>
						<div class="col-xs-12 col-md-3" style="font-size:12px;color:#888;">
							您的资金安全有新浪支付全程护航
						</div>
						<div class="col-xs-12 col-md-3">
							<img src="<?php echo base_url();?>style/img/header/lvsuo.png" width="150" />
						</div>
						<div class="col-xs-12 col-md-3" style="font-size:12px;color:#888;">
							来自优秀律所提供的全方位法律保障
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
		
	<!---底部--->
    <?php $this->load->view('front/footer');?>
    
   
</body>
</html>
