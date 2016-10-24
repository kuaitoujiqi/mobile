<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>个人中心 - 操作记录</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/member.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
</head>
<body>
<style>
body{
	background:#f2f2fd;
}
.menu_button{
	text-align:center;
}
.user_info{
	height:138px;
	border:1px solid #ddd;
	margin-bottom:20px;
	background:#fff;
}

.user_menu{
	height:45px;
	border-left:1px solid #ddd;
	border-right:1px solid #ddd;
	border-bottom:1px solid #ddd;
	background:#fff;
	line-height:45px;
	padding-left:40px;
}
.user_menu_1{
	height:30px;
	line-height:30px;
	background:#00aac6;
	color:#fff;
	padding-left:30px;
}
.user_left_menu .active{
	background:#eee;
	border-left:2px solid #00aac6;
}
.user_recharge{
	background:#fff;
	border:1px solid #ddd;
	margin-left:40px;
}
.user_recharge_input{
	width:60%;
	border:0px solid #000;
	margin:20px auto auto 60px;
	line-height:50px;
}
.user_recharge_rule{
	width:90%;
}
.user_recharge_bank{
	width:100%;
}
.user_recharge_bank input{
	margin-top:15px;
}
.user_recharge_bank .row{
	margin-top:10px;
}
.user_recharge_log{
	width:90%;
	margin-left:30px;
}
.user_head{
	background:#fff;
	border:1px solid #ddd;
	margin-left:40px;
	margin-bottom:30px;
	height:130px;
}
</style>

<?php $this->load->view('usercenter/header');?>
    <!---------------- 个人中心 操作记录 -------------------->
    <div style="background: #f2f2fd;padding:90px 0 30px 0;">
		 <div class="container" style="width:1270px;">
			<div class="row">
				<?php $this->load->view('usercenter/left');?>
				<div class="col-md-9 col-xs-12">
					<div class="row user_head">
						<div class="col-md-4 col-xs-12 text-center" style="height:130px;border-right:1px solid #ddd;line-height:50px;padding-top:6px;">
							<h4>可用余额</h4>
							<h4 class="text-success" style="font-size:14px;">￥<a class="text-success" href="<?php echo site_url('usercenter/sina_show');?>" target="_blank" style="font-size:20px;"><?php echo strval($userinfo['balance']);?></a></h4>
							<div>
								<a href="<?php echo site_url('usercenter/recharge');?>" class="btn btn-primary btn-sm" role="button">
									投资
								</a>
								&nbsp;
								<a href="<?php echo site_url('usercenter/withdraw');?>" class="btn btn-info btn-sm" role="button">
									提现
								</a>								
							</div>
						</div>
						<div class="col-md-8 col-xs-12">
							<div class="row" style="line-height:40px;margin-top:10px;">
								<div class="col-md-3 col-xs-12"></div>
								<div class="col-md-8 col-xs-12">
									<div class="row">
										<div class="col-md-4 col-xs-12 text-center">
											<div><img src="/../style/img/ucenter/user_title_1<?php if($userinfo['is_idcard'] == 1){ echo "_"; } ?>.png" /></div>
											<div>
												<?php if($userinfo['is_idcard'] == 1){ ?>
												<a class="btn btn-default btn-sm" role="button" disabled="disabled">
													已认证
												</a>
												<?php }else{ ?>
												<a href="<?php echo site_url('usercenter/safe');?>" class="btn btn-danger btn-sm" role="button">
													未实名认证
												</a>
												<?php }?>
											</div>
										</div>
										<div class="col-md-4 col-xs-12 text-center">
											<div><img src="/../style/img/ucenter/user_title_2<?php if($userinfo['trading'] == 1){ echo "_"; } ?>.png" /></div>
											<div>
												<?php if($userinfo['trading'] == 1){ ?>
												<a class="btn btn-default btn-sm" role="button" disabled="disabled">
													已设置
												</a>
												<?php }else{ ?>
												<a href="<?php echo site_url('usercenter/safe');?>" class="btn btn-danger btn-sm" role="button">
													未设置支付密码
												</a>
												<?php }?>
											</div>								
										</div>
										<div class="col-md-4 col-xs-12 text-center">
											<div><img src="/../style/img/ucenter/user_title_3<?php if($userinfo['is_bind_bank'] == 1){ echo "_"; } ?>.png" /></div>
											<div>
												<?php if($userinfo['is_bind_bank'] == 1){ ?>
												<a class="btn btn-default btn-sm" role="button" disabled="disabled">
													已绑定
												</a>
												<?php }else{ ?>
												<a href="<?php echo site_url('usercenter/binding');?>" class="btn btn-danger btn-sm" role="button">
													未绑定银行卡
												</a>
												<?php }?>
											</div>								
										</div>									
									</div>
								</div>
								<div class="col-md-1 col-xs-12"></div>
							</div>
							<div class="row" style="line-height:30px;">
								<div class="col-md-3 col-xs-12 text-right" style="font-size:12px;">
									您当前的安全等级：
								</div>
								<div class="col-md-8 col-xs-12">
									<?php if($userinfo['is_bind_bank'] == 1){ ?>
										<img src="/../style/img/ucenter/user_progress_4.png" width="100%" />
									<?php }elseif($userinfo['trading'] == 1){ ?>
										<img src="/../style/img/ucenter/user_progress_3.png" width="100%" />
									<?php }elseif($userinfo['is_idcard'] == 1){ ?>
										<img src="/../style/img/ucenter/user_progress_2.png" width="100%" />
									<?php }else{ ?>
										<img src="/../style/img/ucenter/user_progress_1.png" width="100%" />
									<?php } ?>
								</div>
							</div>
						</div>
					</div>	
					<div class="row user_recharge">
						<div class="row" style="margin:30px;">	
							<div class="col-md-12 col-xs-12">
								<div class="row text-center" style="border:1px solid #ddd;height:130px;border-radius:5px;">
									<div class="col-md-2 col-xs-12" style="border-right:1px solid #ddd;height:130px;">
											<div style="margin-top:50px;">账户流动</div>
									</div>
									<div class="col-md-4 col-xs-12" style="border-right:1px solid #ddd;height:130px;">
										<div style="margin-top:45px;">
											<span class="text-success">￥<?php echo strval(number_format($ljcz,2));?></span><br />
											累计充值记录
										</div>
									</div>
									<div class="col-md-6 col-xs-12" style="margin-top:45px;">
											<span class="text-success">￥<?php echo strval(number_format($ljtx,2));?></span><br />
											累计提现记录
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="btn-group" style="margin:20px auto 20px 50px;">
								<button type="button" class="btn <?php if($type == 0){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/0');?>';">全部</button>
								<button type="button" class="btn <?php if($type == 1){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/1');?>';">充值</button>
								<button type="button" class="btn <?php if($type == 2){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/2');?>';">投资</button>
								<button type="button" class="btn <?php if($type == 5){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/5');?>';">还款</button>
								<button type="button" class="btn <?php if($type == 7){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/7');?>';">提现</button> 
								<button type="button" class="btn <?php if($type == 9){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/9');?>';">债权</button>
								<button type="button" class="btn <?php if($type == 10){?>btn-info<?php }else{?>btn-default<?php }?>" onClick="javascript:location='<?php echo site_url('usercenter/record/10');?>';">转让</button>     
							</div>						
						</div>	
						<div class="row">
							<div class="col-md-11 col-xs-12" style="margin-left:35px;">
								<table class="table table-striped" style="">
									<thead style="background:#5bc0de;color:#fff;">
										<tr>
											<th>交易号</th>
											<th>日期</th>
											<th>操作类型</th>
											<th>金额（元）</th>
											<th>手续费</th>
											<th>状态</th>
											<th>详情</th>
											<th>电子合同</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($result as $key){?>
										<tr>
											<td><?php echo $key['id'];?></td>
											<td><?php echo date('Y-m-d',$key['dateline']);?></td>
											<td><?php 
												switch($key['type'])
												{
													case 1:echo "充值";break;
													case 2:echo "投资";break;
													case 5:echo "还款";break;
													case 7:echo "提现";break;
													case 9:echo "投资债权";break;
													case 10:echo "转让债权";break;
												}
											?></td>
											<td><span class="text-success">￥<?php echo $key['monkey'];?></span></td>
											<td><span class="text-success">￥<?php echo $key['poundage'];?></span></td>
											<td><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></td>
											<td><?php switch($key['type'])
												{
													case 2:case 5:case 9:echo anchor('product/bulk_standard/'.$key['productid'],'项目详情',array('target'=>'_blank'));break;
													default:echo $key['remark'];break;	
												}?></td>
												
											
											 <td>
												<?php if($key['type'] == 2 && $key['static'] == 2 && check_pro_static($key['productid']) ){?>
													<a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/1');?>" target="_blank">服务协议</a> <?php if($key['is_backed'] == 1){?><a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/2');?>" target="_blank">保证合同</a><?php }?>
												<?php }?>
												<?php if($key['type'] == 9 && $key['static'] == 2){?>
													<a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/1');?>" target="_blank">服务协议</a> <?php if($key['is_backed'] == 1){?><a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/2');?>" target="_blank">保证合同</a><?php }?>
												<?php }?>
											 </td>
											
										</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row text-center">
							<div class="page"><?php echo $links;?></div>		
						</div>							
					</div>
					
				</div>
				
			</div>	
		</div>	
    </div>


</body>
</html>