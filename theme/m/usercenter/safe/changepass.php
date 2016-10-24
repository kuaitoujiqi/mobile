<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>安全中心-快投机器</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/mbase.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/mwork.js"></script>
	<script language="javascript">
    $(document).ready(function(){
		
		$('#regesiter_btn').click(function(){
			$(this).attr('disabled',true);
			$(this).text('提交处理中');
			$('#regesiter_form').submit();
		});
	});
    </script>
</head>
<body class="index">

<div id="xghead" style="background:#337ab7;color:#fff;">
	<div class="container has-feedback">
    	<div class="gback"><a href="<?php echo site_url('m/usercenter/safe')?>"><span class="glyphicon glyphicon-menu-left" style="color:#fff;"></span></a></div>
        <div class="text-center">修改登录密码</div>
    </div>
</div>

<?php /*?><?php $this->load->view('m/usercenter/menu'); ?><?php */?>

<div class="container change_pas" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
            <div class="row" style="height:auto">
                <input type="password" class="form-control xgmminput" name="oldpass" id="oldpass" placeholder="请输入您的原密码" value="<?php echo set_value('oldpass');?>">
                <?php echo form_error('oldpass','<p class="alert alert-danger" style="padding:5px;font-size:12px">','</p>');?>
            </div>
            <div class="row" style="height:auto">
                <input type="password" class="form-control xgmminput" placeholder="请输入您的新密码" name="newpass" id="newpass" value="<?php echo set_value('newpass');?>">
                <?php echo form_error('newpass','<p class="alert alert-danger" style="padding:5px;font-size:12px">','</p>');?>
            </div>
			<div class="row" style="height:auto">
                <input type="password" class="form-control xgmminput" placeholder="请输入您的确认密码" name="matches_password" id="matches_password" value="">
                <?php echo form_error('matches_password','<p class="alert alert-danger" style="padding:5px;font-size:12px">','</p>');?>
            </div>
    </div>

<div class="container">
    <button class="btn btn-block btn-success btn-lg" type="submit"  id="regesiter_btn" style="margin-top:10px">提交</button>
    </div>

</form>
</div>
<?php $this->load->view('m/footer');?>
</body>
</html>