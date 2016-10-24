<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>操作记录-快投机器</title>
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
<?php $this->load->view('m/usercenter/menu_back',array('title'=>'操作记录','url'=>site_url('m/usercenter'))); ?>
<input type="hidden" id="url" value="/m/usercenter/record/<?php echo $type;?>/">
<input type="hidden" id="static" value="1">
<input type="hidden" id="isend" value="1">
<input type="hidden" id="page" value="<?php echo $page;?>">
</div><!--header_scroller-->
<div id="wrapper">
<div id="scroller">
<div class="container" style="margin-top: 20px; margin-bottom:20px">
    <div class="btn-group btn-group-justified" role="group" style="width:100%;">
		<a role="button" class="btn <?php if($type == 2){?>btn-primary<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/2');?>';">投资</a>
		<a role="button" class="btn <?php if($type == 5){?>btn-primary<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/5');?>';">还款</a>
        <a role="button" class="btn <?php if($type == 1){?>btn-primary<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/1');?>';">充值</a>
        <a role="button" class="btn <?php if($type == 7){?>btn-primary<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('m/usercenter/record/7');?>';">提现</a> 
    </div>

</div>
	<?php if($type == 2){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>	
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
				 <div class="record_one" style="border-bottom:5px solid #eee;height:89px;">
					<div class="row" style="height:30px;border-bottom:1px solid #ddd;margin-top:0;border-top:1px solid #eee;">
						
						<div class="col-xs-12 text-left"><a href="<?php echo base_url();?><?php echo 'm/product/bulk_standard/'.$key['productid']; ?>"><?php echo $key['title'];?></a></div>
					</div>	 
					<div class="row">
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
							<div class="text-center">投资金额</div>
						</div>
						<div class="col-xs-4">
							<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
							<div class="text-center">投资日期</div>
						</div>
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b>
								<?php 
									if($key['static'] == 1){
										echo "处理中";
									}else{
										if($key['static'] == 5){
											echo "已结束";	
										}else{
											if($type == 1 && $key['static'] == 4){
												echo "已转让";	
											}else{
												switch($key['pstatic']){
													case 1:echo "等待开始";break;
													case 2:echo date('Y-m-d',$key['next_interest']);break;
													case 3:echo "已结束";
												}
											}
										}
									}
								?>
							</b></div>
							<div class="text-center">下期还款</div>	
						</div>		
						
					</div>	 
				 </div>
			<?php }?>	
		<?php }?>		
	<?php }?>

	<?php if($type == 5){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>						
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
				 <div class="record_one" style="border-bottom:5px solid #eee;height:89px;">
					<div class="row" style="height:30px;border-bottom:1px solid #ddd;">
						
						<div class="col-xs-12 text-left"><a href="<?php echo base_url();?><?php echo 'm/product/bulk_standard/'.$key['productid']; ?>"><?php echo $key['title'];?></a></div>
					</div>	 
					<div class="row">
						<div class="col-xs-6 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
							<div class="text-center">还款金额</div>
						</div>		
						<div class="col-xs-6">
							<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
							<div class="text-center">日期</div>
						</div>

					</div>	 
				 </div>
			<?php }?>	
		<?php }?>		
	<?php }?>
	
	<?php if($type == 7){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>							
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
				 <div class="record_one" style="border-bottom:5px solid #eee;height:59px;margin-top:0;border-top:1px solid #eee;"> 
					<div class="row">
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
							<div class="text-center">提现金额</div>
						</div>
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></b></div>
							<div class="text-center">状态</div>	
						</div>		
						<div class="col-xs-4">
							<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
							<div class="text-center">日期</div>
						</div>

					</div>	 
				 </div>
			<?php }?>	
		<?php }?>	
	<?php }?>
	
	<?php if($type == 1){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>		
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
			 <div class="record_one" style="border-bottom:5px solid #eee;height:59px;margin-top:0;border-top:1px solid #eee;"> 
				<div class="row">
					<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
						<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
						<div class="text-center">充值金额</div>
					</div>
					<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
						<div class="text-center text-primary"><b><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></b></div>
						<div class="text-center">状态</div>	
					</div>		
					<div class="col-xs-4">
						<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
						<div class="text-center">日期</div>
					</div>
				</div>	 
			 </div>
			<?php }?>	
		<?php }?>
	<?php }?>	


        </div>
    </div>


<!--最近操作--------------------------------------------------------------------------------------------->

<div id="footer_scroller"></div><?php $this->load->view('m/footer');?>
</body>
</html>
