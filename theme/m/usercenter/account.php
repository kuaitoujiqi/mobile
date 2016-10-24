<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>我的账户-快投机器</title>
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
<?php $this->load->view('m/usercenter/menu_back',array('title'=>'总资产','url'=>site_url('m/usercenter'))); ?>

<style>
.mainFrame{
	height:200px;
	background:url('<?php echo base_url();?>style/img/m/person_bg.png');
	color:#fff;
}	



/**/
.zcze{
	padding-top:0;
}
.wdzh{
	left:0;
}
.aqcenter a{
	color:#666;
}
.aqcenter a:hover{
	color:#666;
}
.mainFrame{
	height:200px;
	background:url('<?php echo base_url();?>style/img/m/person_bg.png');
	color:#fff;
}	
</style>
<div class="container aqcenter">
	<div class="row" style="margin-top:20px;">
		<div class="col-xs-3"></div>
		<div class="col-xs-6" style="height:220px;background:url('<?php echo base_url();?>style/img/m/totalzichan.png');background-size:100% auto;background-repeat:no-repeat;">
			<div class="text-center" style="margin-top:60px;">
				总资产
				<br />	
				<?php if($cyje['monkey'] == ""){$cyje_n = 0;}else{$cyje_n=$cyje['monkey'];}
				if($lsje['interest'] == ""){$lsje_n = 0;}else{$lsje_n=$lsje['interest'];}?>		
				<span class="text-success"><?php echo strval(number_format($cyje_n-(-$userinfo['balance'])-(-$lsje_n),2));?>元</span>	
			</div>
		</div>
		<div class="col-xs-3"></div>
	</div>
	<div class="row" style="height:10px;background:#eee;">
		<div class="col-xs-12"></div>
	</div>	
	
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-5">
			<span>●</span>	
			存钱罐余额
		</div>
		<div class="col-xs-5 text-success">
			<?php echo strval($userinfo['balance']);?>元
		</div>
		<div class="col-xs-1"></div>
	</div>
	
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-5">
			<span>●</span>	
			投资总额
		</div>
		<div class="col-xs-5 text-success">
			<?php echo strval(number_format($ljtz,2));?>元
		</div>
		<div class="col-xs-1"></div>
	</div>

	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-5">
			<span>●</span>	
			待收总额
		</div>
		<div class="col-xs-5 text-success">
			<?php echo strval(number_format($dsze,2));?>元
		</div>
		<div class="col-xs-1"></div>
	</div>

	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-5">
			<span>●</span>	
			预期收益
		</div>
		<div class="col-xs-5 text-success">
			<?php echo strval($lsje['interest'])==""?'0.00':strval(number_format($lsje['interest'],2));?>元
		</div>
		<div class="col-xs-1"></div>
	</div>	

	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-5">
			<span>●</span>	
			已获收益
		</div>
		<div class="col-xs-5 text-success">
			<?php echo strval(number_format($ljsy,2));?>元
		</div>
		<div class="col-xs-1"></div>
	</div>	
	
</div>

<?php $this->load->view('m/footer');?>



