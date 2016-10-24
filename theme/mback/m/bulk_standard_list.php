<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>投资列表-蜂融网理财</title>
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
<input type="hidden" id="url" value="/m/product/bulk_standard_list/">
<input type="hidden" id="static" value="1">
<input type="hidden" id="isend" value="1">
<input type="hidden" id="page" value="<?php echo $page;?>">
<div id="header_scroller">
<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
</div>
<div id="wrapper">
<div id="scroller">
<!--列表--------------------------------------------------------------------------------------------->
<?php foreach($result as $key){?>
<div class="index_list_one">
    <div class="row">
        <h3 class="col-xs-12" style="font-size: 16px;font-weight: bold;"> <?php echo $key['title'];?></h3>
    </div>
    <div class="row">
        <p class="col-xs-12 text-muted" style="font-size: 12px;"><?php echo $key['introduction'];?></p>
    </div>
    <div class="row list_one_count">
        <div class="col-xs-4">
            <?php echo $key['rate']*100;?>%/年
        </div>
        <div class="col-xs-4" style="text-align: center;border-left: 1px solid #eee;border-right: 1px solid #eee;">
            <?php echo $key['day'];?>个月
        </div>
        <div class="col-xs-4" style="text-align: right">
             <?php echo $key['money'];?>元
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-6 text-muted" style="font-size: 12px;">
           <?php echo $key['repay'];?>
        </div>
        <div class="col-xs-6">
            <?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                	<a class="btn btn-primary pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">审核中</a>
                <?php }else{?>
                	<?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                		<a class="btn btn-success pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">即将上线</a>
                    <?php }else{?>
                    	<a class="btn btn-danger pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">余<?php echo $key['restmoney'];?>元</a>
					<?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                	<a class="btn btn-warning pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">还款中</a>	
                <?php }?>
                <?php if($key['static'] == 3){?>
                	<a class="btn btn-defalut pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>	
                <?php }?>
        </div>
    </div>
    <?php $buy_load = floor((($key['money'] - $key['restmoney'])/$key['money'])*100);//进度?>
        <div class="progress" style="margin-top: 10px;">
            <div class="progress-bar progress-bar-success progress-bar-striped pull-left" role="progressbar" aria-valuenow="<?php echo $buy_load;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $buy_load;?>%;line-height: 12px;">
               <?php echo $buy_load;?>%
            </div>
        </div>

</div>
<?php }?>
	<div id="pullUp">
       <span class="pullUpLabel">上拉加载更多</span>
    </div>
</div>
    
</div>
<div id="footer_scroller"></div>
<!--推荐标的--------------------------------------------------------------------------------------------->


<?php $this->load->view('m/footer');?>
</body>
</html>
