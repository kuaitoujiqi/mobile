<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>投资列表-快投机器</title>
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

<?php $this->load->view('m/head'); ?>
</div>
<div id="wrapper">
<div id="scroller">

    <?php foreach($result as $val=>$key){?>
    <div class="index_list_one">
        <div class="row">
			<div class="col-xs-7">
				<h3 style="font-size: 14px;margin-bottom:2px;margin-top:10px;color:#666;"> <?php echo $key['title'];?></h3>
			</div>
			<div class="col-xs-5">
				<h3 style="font-size:10px;color:#999;margin-bottom:2px;margin-top:12px;"><?php echo $key['creattime']; ?></h3>
			</div>
        </div>	
		<div>
			<hr style="margin-top:2px;" />
		</div>
        <div class="row list_one_count">
			<div class="col-xs-4 text-center">
				<span style="font-size:14px;color:#666;"><?php echo $key['rate']*100;?></span>%
				<br />
				<span style="font-size:10px;color:#999;">年化收益率</span>
			</div>
			<div class="col-xs-4" style="text-align: center;border-left: 1px solid #eee;border-right: 1px solid #eee;">
				<span style="font-size:14px;color:#666;"><?php echo $key['restmoney'];?></span>元
				<br />
				<span style="font-size:10px;color:#999;">可购余额</span>
			</div>
			<div class="col-xs-4 text-center">
				<span style="font-size:14px;color:#666;"><?php echo $key['day'];?></span>个月
				<br />
				<span style="font-size:10px;color:#999;">还款期限</span>
			</div>		
        </div>
	<!-- 	<div class="row" style="margin-top:10px;">
			<div class="col-xs-12 text-center">
				<p style="font-size:10px;">
            	<?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                	<a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="border:1px solid #337ab7;color:#337ab7;">审核中</a>
                <?php }else{?>
                	<?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                		<a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#337ab7;color:#fff;">即将上线</a>
                    <?php }else{?>
                    	<a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#f68121;border:0px;color:#fff;">立即购买</a>
					<?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                	<a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#cbd3de;border:0px;color:#fff;">还款中</a>	
                <?php }?>
                <?php if($key['static'] == 3){?>
                	<a class="btn btn-defalut btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>	
                <?php }?>			
				</p>
				
			</div>				
		</div> -->		
        <div class="row" style="margin-top:10px;">
            <div class="col-xs-12 text-center">
                <p style="font-size:10px;">
                <?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                    <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="border:1px solid #337ab7;color:#337ab7;">审核中</a>
                <?php }else{?>
                    <?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                        <a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#337ab7;color:#fff;">即将上线</a>
                    <?php }else{?>
                        <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#f68121;border:0px;color:#fff;">立即购买</a>
                    <?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                    <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#cbd3de;border:0px;color:#fff;">还款中</a>  
                <?php }?>
                <?php if($key['static'] == 3){?>
                    <a class="btn btn-defalut btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>   
                <?php }?>           
                </p>
                
            </div>              
        </div>	
		<div class="row">
			<div class="col-xs-6 text-left">
				<span style="font-size:10px;color:#999;"><?php echo $key['introduction'];?></span>
			</div>
			<div class="col-xs-6 text-right"><span style="font-size:10px;color:#999;"><?php echo $key['repay'];?></span></div>
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
