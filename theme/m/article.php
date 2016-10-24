<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title><?php echo $row['title'];?>-快投机器</title>
    <meta name="keywords" content="<?php echo $row['keyword'];?>" />
    <meta name="description" content="<?php echo $row['description'];?>" />
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
	<script language="javascript">
    $(document).ready(function(){
		$('.container img').css('max-width','90%');
		$('.container img').css('height','auto');
	});
    </script>
</head>


<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>

<!--具体编辑器内容--------------------------------------------------------------------------------------------->

<div class="container">
	<h3 style="font-size: 22px;font-weight: bold; text-align:center; padding:15px 0px"> <?php echo $row['title']?></h3>
    
    <div style="padding:20px; line-height:1.7em;font-size:14px;color:#666; overflow:hidden"><?php echo $row['content'];?><br>
                <span class="pull-left news_one_title" >上一篇:<?php if(count($prev) >0){?><a href="<?php echo site_url('m/news/article/'.$prev['id']);?>"><?php echo $prev['title'];?></a><?php }else{ echo "没有了";}?></span><br>
                <span class="pull-left news_one_title" >下一篇:<?php if(count($next) >0){?><a href="<?php echo site_url('m/news/article/'.$next['id']);?>"><?php echo $next['title'];?></a><?php }else{ echo "没有了";}?></span>
   </div>
</div>

<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>


