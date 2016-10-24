<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>用户中心</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/member.css">	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
</head>
<body>
<style>
.login_title{
	width:103px;
	height:30px;
	text-align:center;
	margin-left:18px;
	border-bottom:3px solid #00aac6;
}
.verify_frame .row{
	margin:20px auto 20px 0;
}
.verify_frame_input{
	margin:20px auto auto 43px;
	border-right:1px solid #f2f2fd;
}
.login_frame_adv{
	margin:110px auto auto 30px;	
	
}
</style>

	<!---头部--->
    <?php $this->load->view('usercenter/header');?>
	
	<div style="background: #f2f2fd;padding:90px 0 30px 0;">
		<div class="container" style="min-height:800px;line-height:26px;background:#fff;">
			<div class="row" style="border-bottom:1px solid #f2f2fd;height:60px;line-height:60px;margin-top:60px;">
				<div class="col-xs-12 col-md-3 text-center">
					<img src="<?php echo base_url();?>style/img/register_step_1.jpg" />
					<img src="<?php echo base_url();?>style/img/register_step_finished.jpg" />
				</div>
				<div class="col-xs-12 col-md-1 text-center">
					<img src="<?php echo base_url();?>style/img/register_step_link.jpg" />
				</div>
				<div class="col-xs-12 col-md-3 text-center">
					<img src="<?php echo base_url();?>style/img/register_step_2.png" />
					<img src="<?php echo base_url();?>style/img/register_step_finished.jpg" />
				</div>
				<div class="col-xs-12 col-md-1 text-center">
					<img src="<?php echo base_url();?>style/img/register_step_link.jpg" />
				</div>
				<div class="col-xs-12 col-md-3 text-center">
					<img src="<?php echo base_url();?>style/img/register_step_3.jpg" />
					<img src="<?php echo base_url();?>style/img/register_step_finished.jpg" />
				</div>
			</div>
			<div class="row verify_frame" id="authentication">
				<div class="col-xs-12 col-md-4 verify_frame_input">
					<div class="row">
					<h4>
						<div class="login_title">开通成功</div>
					</h4>					
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="row text-center"><img src="/../../style/img/sanfang.png" /></div>
							<div class="row">
							<h3 class="text-success text-center" style="line-height:30px;">
								<?php echo userinfo('nickname'); ?>，恭喜您！<br />
								<span style="font-size:15px;font-weight:500;">微信存钱罐账户成功开通</span>
							</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-6">
							<a role="btn" href="<?php echo site_url('usercenter/safe');?>" class="btn btn-default btn-block">设置支付密码</a>
							
						</div>
						<div class="col-xs-6 col-md-6">
							<a role="btn" href="<?php echo site_url('usercenter/usercenter');?>" class="btn btn-default btn-block">个人中心</a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-7">
					<div class="login_frame_adv">
						<a href="#"><img src="<?php echo base_url();?>style/img/register_banner.jpg" width="100%" /></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('usercenter/footer');?>
</body>
</html>