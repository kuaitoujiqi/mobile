<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>新闻中心-快投机器</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1,initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
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

</head>
<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>


<style>
.xszy .aqzxs{
	color:#337ab7;
}	
.xszy .pad-left{
	color:#337ab7;	
}	
</style>
<!--导航块--------------------------------------------------------------------------------------------->
<div class="container xszy">
	
    <div class="row has-feedback">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			 <a href="<?php echo site_url('m/news/article/178');?>">
				<span class="glyphicon glyphicon-book form-control-feedback aqzxs"></span>
				<div class="pad-left">关于我们</div>
			</a>		
		</div>
		<div class="col-xs-1"></div>	
    </div>	
	<hr />
	
    <div class="row has-feedback">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			 <a href="<?php echo site_url('m/news/article/179');?>">
				<span class="glyphicon glyphicon-book form-control-feedback aqzxs"></span>
				<div class="pad-left">安全保障</div>
			</a>		
		</div>
		<div class="col-xs-1"></div>
    </div>
	<hr />
	
    <div class="row has-feedback">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			 <a href="<?php echo site_url('m/news/article/180');?>">
				<span class="glyphicon glyphicon-book form-control-feedback aqzxs"></span>
				<div class="pad-left">风控体系</div>
			</a>		
		</div>
		<div class="col-xs-1"></div>		
    </div>
	<hr />
	
    <div class="row has-feedback">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			 <a href="<?php echo site_url('m/news/article/267');?>">
				<span class="glyphicon glyphicon-book form-control-feedback aqzxs"></span>
				<div class="pad-left">供应链金融</div>
			</a>		
		</div>
		<div class="col-xs-1"></div>		
    </div>
	<hr />	
	
    <div class="row has-feedback">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			 <a href="<?php echo site_url('m/news/article/181');?>">
				<span class="glyphicon glyphicon-book form-control-feedback aqzxs"></span>
				<div class="pad-left">联系我们</div>
			</a>		
		</div>
		<div class="col-xs-1"></div>	
    </div>
	<hr />
    <?php /*?><div class="row">
        
        <div class="col-xs-3"><span class="glyphicon glyphicon-question-sign"></span> <br>帮助中心</div>
        
        <div class="col-xs-3"></div>
    </div><?php */?>
</div>

<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>