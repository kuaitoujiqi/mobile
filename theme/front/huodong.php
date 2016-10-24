<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title><?php echo $row['title'];?>_快投机器</title>
    <meta name="keywords" content="<?php echo $row['keyword'];?>" />
    <meta name="description" content="<?php echo $row['description'];?>" />
    <link href="" rel="apple-touch-icon-precomposed">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?fcd37886b18b856cbd75a8a25d09fbad";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>	
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
</head>
<body class="grey_body">
<?php $this->load->view('front/header');?>

<div style="width:100%;">
	<div><img src="/../style/img/huodong/1.png" width="100%" /></div>
	<div><img src="/../style/img/huodong/4.png" width="100%" /></div>
	<div><a href="<?php echo site_url('product/bulk_standard_list');?>" target="_blank"><img src="/../style/img/huodong/5.png" width="100%" border="0" /></a></div>
	<div><img src="/../style/img/huodong/6.png" width="100%" /></div>
</div>
<?php $this->load->view('front/footer');?>
</body>
</html>
