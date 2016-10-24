<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>消息中心-快投机器</title>
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
	<script src="<?php echo base_url();?>style/js/iscroll.js"></script>
	<script src="<?php echo base_url();?>style/js/mscroll.js"></script>
</head>


<body class="index">
<div id="header_scroller">
<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<?php $this->load->view('m/usercenter/menu_back',array('title'=>'消息中心','url'=>site_url('m/usercenter'))); ?>
</div><!--header_scroller-->
<input type="hidden" id="url" value="/m/usercenter/info/<?php echo $type;?>/">
<input type="hidden" id="static" value="1">
<input type="hidden" id="isend" value="1">
<input type="hidden" id="page" value="<?php echo $page;?>">
<!--选项菜单--------------------------------------------------------------------------------------------->
<div id="wrapper">
<div id="scroller">
<div class="container" style="margin-top: 10px;">
    
    <div class="btn-group" role="group" style="padding-bottom:10px">
        <button type="button" class="btn <?php if($type ==0){echo "btn-danger";}else{echo "btn-default";}?>" onClick="javascript:location='<?php echo site_url('m/usercenter/info/0');?>';">全部消息</button>
        <button type="button" class="btn <?php if($type ==1){echo "btn-danger";}else{echo "btn-default";}?>" onClick="javascript:location='<?php echo site_url('m/usercenter/info/1');?>';">未读消息</button>
        <button type="button" class="btn <?php if($type ==2){echo "btn-danger";}else{echo "btn-default";}?>" onClick="javascript:location='<?php echo site_url('m/usercenter/info/2');?>';">已读消息</button>
    </div>
</div>

<!--导航块--------------------------------------------------------------------------------------------->





	<?php foreach($result as $key){?>
    <div class="record_one">
        <h4 class=" text-muted">
            [<?php echo date('Y年m月d日 H:i',strtotime($key['dateline']));?>]
            <button type="button" class="btn btn-sm btn-danger pull-right" onClick="javascript:location='<?php echo site_url('m/usercenter/del_info/'.$key['id']);?>'">删除</button>
        </h4>
        <p><?php echo $key['content'];?></p>
    </div>
	<?php }?>
    
    	<div id="pullUp">
       		<span class="pullUpLabel">上拉加载更多</span>
    	</div>
        </div>
    </div>



<!--最近操作--------------------------------------------------------------------------------------------->

<div id="footer_scroller"></div><?php $this->load->view('m/footer');?>
</body>
</html>

