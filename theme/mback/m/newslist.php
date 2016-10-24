<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>新闻中心-蜂融网</title>
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

<!--导航块--------------------------------------------------------------------------------------------->
<div class="container wallet_nav_bar">
    <div class="row">
        <a href="<?php echo site_url('m/news/article/7');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-book"></span> <br>新手引导</div></a>
        <a href="<?php echo site_url('m/news/article/8');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-lock"></span> <br>安全保障</div></a>
        <a href="<?php echo site_url('m/news/article/6');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-certificate"></span> <br>平台模式</div></a>
        <a href="<?php echo site_url('m/news/article/11');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-list"></span> <br>费用标准</div></a>
    </div>
    <div class="row">
        <a href="<?php echo site_url('m/news/article/12');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-globe"></span> <br>合作伙伴</div></a>
        <a href="<?php echo site_url('m/news/article/9');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-user"></span> <br>关于我们</div></a>
        <a href="<?php echo site_url('m/news/article/13');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-retweet"></span> <br>债权转让</div></a>
        <a href="<?php echo site_url('m/news/article/10');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-phone-alt"></span> <br>联系我们</div></a>
        <?php /*?><div class="col-xs-3"><span class="glyphicon glyphicon-volume-down"></span> <br>网站公告</div>
        <div class="col-xs-3"><span class="glyphicon glyphicon-camera"></span> <br>媒体报道</div><?php */?>
    </div>
    <?php /*?><div class="row">
        
        <div class="col-xs-3"><span class="glyphicon glyphicon-question-sign"></span> <br>帮助中心</div>
        
        <div class="col-xs-3"></div>
    </div><?php */?>
</div>

<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>