<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>下期收益-快投机器</title>
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
</head>


<body class="index">
<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<div id="xghead">
	<div class="container has-feedback">
    	<div class="gback"><a href="<?php echo site_url('m/usercenter')?>"><span class="glyphicon glyphicon-menu-left"></span></a></div>
        <div class="text-center">下期收益</div>
    </div>
</div>
<!--选项菜单--------------------------------------------------------------------------------------------->
<?php if(count($data[0]) <= 0){?>
<div class="bgzwsy">
	下期暂无收益,<a href="<?php echo site_url('m/product/bulk_standard_list');?>">去投资</a>
</div>
<?php }?>
<?php foreach($data[0] as $key){?>
<div>
	<div class="xqsy_title">&nbsp;&nbsp;<?php echo $key;?></div>
    <?php foreach($data[1] as $key_s){?>
    <?php if($key_s['time_m'] == $key){?>
    <div class="xqsy_con">
    	收益<br>
        <span><?php echo $key_s['time'];?></span>
        <div class="xqsy_sysl">
        	+<?php echo $key_s['shouyi'];?>
        </div>
    </div>
    <?php }?>
    <?php }?>
    
</div>
<?php }?>


<?php $this->load->view('m/footer');?>
</body>
</html>