<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>操作记录-蜂融网</title>
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
<?php $this->load->view('m/usercenter/menu'); ?>
<input type="hidden" id="url" value="/m/usercenter/record/<?php echo $type;?>/">
<input type="hidden" id="static" value="1">
<input type="hidden" id="isend" value="1">
<input type="hidden" id="page" value="<?php echo $page;?>">
</div><!--header_scroller-->
<div id="wrapper">
<div id="scroller">
<div class="container" style="margin-top: 20px; margin-bottom:20px">
    <div class="btn-group" role="group">
        <button type="button" class="btn <?php if($type == 0){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/0');?>';">全部</button>
                    <button type="button" class="btn <?php if($type == 1){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/1');?>';">充值</button>
                    <button type="button" class="btn <?php if($type == 2){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/2');?>';">投资</button>
					<button type="button" class="btn <?php if($type == 5){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/5');?>';">还款</button>
                    <button type="button" class="btn <?php if($type == 7){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/7');?>';">提现</button> 
                    <?php /*?><button type="button" class="btn <?php if($type == 9){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/9');?>';">债权</button>
                    <button type="button" class="btn <?php if($type == 10){?>btn-danger<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/10');?>';">转让</button> <?php */?> 
    </div>

</div>
<!--导航块--------------------------------------------------------------------------------------------->
	<?php foreach($result as $key){?>
    <div class="record_one">
        <div class="row">
            <div class="col-xs-4">交易号：</div>
            <div class="col-xs-8"><?php echo $key['id'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">日期：</div>
            <div class="col-xs-8"><?php echo date('Y-m-d H:i',$key['dateline']);?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">操作类型：</div>
            <div class="col-xs-8"><?php 
							switch($key['type'])
							{
								case 1:echo "充值";break;
								case 2:echo "投资";break;
								case 5:echo "还款";break;
								case 7:echo "提现";break;
								case 9:echo "投资债权";break;
								case 10:echo "转让债权";break;
							}
						?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">金额（元)：</div>
            <div class="col-xs-8"><?php echo $key['monkey'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">手续费：</div>
            <div class="col-xs-8"><?php echo $key['poundage'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">状态：</div>
            <div class="col-xs-8"><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">详情：</div>
            <div class="col-xs-8"><?php switch($key['type'])
							{
								case 2:case 5:case 9:echo anchor('m/product/bulk_standard/'.$key['productid'],'项目详情',array('target'=>'_blank'));break;
								default:echo $key['remark'];break;	
							}?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">电子合同：</div>
            <div class="col-xs-8"><?php if($key['type'] == 2 && $key['static'] == 2 && check_pro_static($key['productid']) ){?>
								<a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/1');?>" target="_blank">服务协议</a> <?php if($key['is_backed'] == 1){?><a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/2');?>" target="_blank">保证合同</a><?php }?>
							<?php }?>
                            <?php if($key['type'] == 9 && $key['static'] == 2){?>
								<a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/1');?>" target="_blank">服务协议</a> <?php if($key['is_backed'] == 1){?><a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/2');?>" target="_blank">保证合同</a><?php }?>
							<?php }?></div>
        </div>
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
