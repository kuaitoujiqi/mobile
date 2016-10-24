<!DOCTYPE html>
<html>
<head>
<?php /*?>	<script src="<?php echo base_url();?>style/js/uaredirect.js"></script>
	<script language="javascript">
    	uaredirect("https://www.kuaitoujiqi.com/m/");
    </script><?php */?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keyword;?>" />
    <meta name="description" content="<?php echo $description;?>" />
    <meta name="viewport" content="width=device-width">
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
	
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>


</head>
<body>
<style>
.login_title{
	width:100px;
	height:30px;
	text-align:center;
	margin-left:18px;
	border-bottom:3px solid #00aac6;
}
.login_frame .row{
	margin:20px auto 20px 0;
}
.login_frame_input{
	margin:50px auto auto 50px;
	border-right:1px solid #f2f2fd;
}
.login_frame_adv{
	margin:130px auto auto 30px;	
	
}
</style>
	<!---头部--->
    <?php $this->load->view('front/header');?>
	
	<div style="background: #f2f2fd;padding:20px 0;">
		<div class="container" style="min-height:600px;line-height:26px;background:#fff;padding-bottom:30px;">

			<div class="row login_frame" id="getpasswordModal">
				<div class="col-xs-14 col-md-4 login_frame_input">
					<div class="row">
					<h4>
						<div class="login_title">找回密码</div>
					</h4>					
					</div>
					<form class="form-horizontal mt10">
						<div class="row">
							<div class="col-xs-14 col-md-12">
								<input type="text" class="form-control"  placeholder="请输入手机号" name="mobile" id="mobile">
							</div>
						</div>
						<div class="row" style="display:none;">
							<div class="col-xs-14 col-md-12" id="mobile_error">
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-14 col-md-8">
								<input type="text" class="form-control" placeholder="请输入验证码" name="piccode" id="piccode">
							</div>
							<div class="col-xs-14 col-md-4">
								<img src="<?php echo site_url('welcome/regesiter_code');?>"  alt="点击刷新,不分大小写"  style="cursor:pointer" class="piccode"/>
							</div>
						</div>				
										
						<div class="row">
							<div class="col-xs-14 col-md-8">
								<input type="text" class="form-control" placeholder="请输入短信验证码" name="phonecode" id="phonecode">
							</div>
							<div class="col-xs-14 col-md-4">
								<button type="button" class="btn btn-default btn-block sendSMSButton" id="sendphonecode" data="0">发送短信</button>
							</div>
						</div>		
						<div class="row" style="display:none;">
							<div class="col-xs-14 col-md-12" id="phonecode_error">
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-14 col-md-12">
								<input type="password" class="form-control" placeholder="请输入新密码" name="password" id="password">
							</div>
						</div>
						<div class="row" style="display:none;">
							<div class="col-xs-14 col-md-12" id="password_error">
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-14 col-md-12">
								<input type="password" class="form-control" placeholder="请再次输入新密码" name="matches_password" id="matches_password">
							</div>
						</div>
						<div class="row" style="display:none;">		
							<div class="col-xs-14 col-md-12" id="matches_password_error">
							</div>
						</div>							
						
						<div class="row">
							<div class="col-xs-14 col-md-12">
								<button type="button" class="btn btn-info btn-default btn-block" id="forget_change">现在修改</button>
							</div>
						</div>	
						<div class="row">
							<div class="col-xs-14 col-md-6">
								没有账号？&nbsp;&nbsp;<a href="<?php echo site_url('welcome/register_frame');?>">立即注册</a>
							</div>
							<div class="col-xs-14 col-md-6 text-right">
								想起密码？&nbsp;&nbsp;<a href="<?php echo site_url('welcome/login_frame');?>">立即登录</a>
							</div>
						</div>
					</form>
				</div>
				<div class="col-xs-14 col-md-7">
					<div class="login_frame_adv">
						<a href="#"><img src="<?php echo base_url();?>style/img/forget_password_banner.png" width="100%" /></a>
					</div>
				</div>
			</div>
		</div>
	</div>
		
<!----
			<div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">欢迎登录</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal mt10">
								<div class="form-group" id="login_error" style="display:none">
									<div class="col-lg-12">
										<p class="alert alert-danger my_alert">用户名或密码错误！</p>
									</div>
								</div>
								<div class="form-group">
									<label for="recipient-name" class="control-label col-lg-2">用户名：</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="recipient-name"  placeholder="请输入注册时的用户名或手机号" id="username">
									</div>
								</div>
								<div class="form-group">
									<label for="message-text" class="control-label col-lg-2">密码：</label>
									<div class="col-lg-10">
										<input type="password" class="form-control"  id="login_password">
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning pull-left col-md-4 col-xs-12" style="margin-bottom: 10px;" id="login_regesiter">还没有账号，去注册</button>
							<button type="button" class="btn btn-warning pull-left col-md-3 col-xs-12" style="margin-bottom: 10px;" id="login_forget" data-toggle="modal">忘记密码</button>
							<button type="button" class="btn btn-success col-lg-4 pull-right col-xs-12" style="margin-bottom: 10px;" id="login">登录</button>
						</div>
					</div>
				</div>
			</div>		
--->
		
	<!---底部--->
    <?php $this->load->view('front/footer');?>
    
   
</body>
</html>
