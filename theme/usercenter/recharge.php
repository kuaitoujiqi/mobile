<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>个人中心 - 充值</title>
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
    <script language="javascript">
	$(document).ready(function() {
		var obj = $('.recharge_bank input:checked');
		$('.recharge_bank a').removeClass('label-success');
		$('.recharge_bank a').addClass('label-default');
		obj.next('a').removeClass('label-default');
		obj.next('a').addClass('label-success');
		
		$('.recharge_bank input').change(function(){
			$('.recharge_bank a').removeClass('label-success');
			$('.recharge_bank a').addClass('label-default');
			$(this).next('a').removeClass('label-default');
			$(this).next('a').addClass('label-success');
		});
		
		/*
		$('#submit_add').click(function(){
			$(this).attr("disabled",true);
			$('#recharge_form').submit();
		});
		*/
		
		$("#submit_add").click(function(){
			var money =  $('#exampleInputAmount').val();	
			$.post('/usercenter/send_recharge',{
				monkey:money
			},function(data){
				var obj = JSON.parse(data);
				console.log(obj);
				
				if(obj.error == 0){
					document.write(obj.msg);
				}else{
					alert(obj.msg);
				}	
			})
		})
		
		$('#inputmonkey').on("keyup","#exampleInputAmount",function(){
			var monkey = $(this).val();
			if(isNaN(monkey) || monkey < 0)
			{
				$(this).val(0);	
			}
			else
			{
				var dot = monkey.indexOf(".");
				if(dot != -1){
					var dotCnt = monkey.substring(dot+1,monkey.length);
					if(dotCnt.length > 2){
						var num = new Number(monkey);
						monkey = new Number(num.toFixed(2));	
					}
				}
				$(this).val(monkey);
			}
		});
		
	});
    </script>
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
	margin:0px auto auto 60px;
	line-height:50px;
}
.user_recharge_rule{
	width:90%;
}
.user_recharge_bank{
	width:90%;
	margin-left:30px;
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
    <div style="background: #f2f2fd;padding:90px 0 30px 0;">
		 <div class="container" style="width:1270px;">
			<div class="row">
				<?php $this->load->view('usercenter/left');?>
				<?php if($userinfo['is_idcard'] != 0){?>
				<div class="col-md-9 col-xs-12">
					<div class="row user_head">
						<div class="col-md-4 col-xs-12 text-center" style="height:130px;border-right:1px solid #ddd;line-height:50px;padding-top:6px;">
							<h4>可用余额</h4>
							<h4 class="text-success" style="font-size:14px;">￥<a class="text-success" href="<?php echo site_url('usercenter/sina_show');?>" target="_blank" style="font-size:20px;"><?php echo strval($userinfo['balance']);?></a></h4>
							<div>
								<a href="<?php echo site_url('product/bulk_standard_list');?>" class="btn btn-primary btn-sm" role="button">
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
						<div class="row">
							<div class="btn-group" style="margin:20px auto 20px 50px;">
								<!---<a href="<?php echo site_url('usercenter/recharge/quick_pay');?>" class="btn btn-info" role="btn">快捷支付</a>
								<a href="<?php echo site_url('usercenter/recharge/online_bank');?>" class="btn btn-default" role="btn">网银在线</a>---->
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-12">
								
								<form id="recharge_form" class=" col-md-12" style="margin-top: 10px;padding-left: 0" method="post">
									<div class="user_recharge_input text-center">
										<p><input type="text" class="form-control" id="exampleInputAmount" placeholder="充值金额" name="monkey"></p>
										<p><a role="button" class="btn btn-danger btn-block" id="submit_add">充值</a></p>
									</div>	
									<div style="margin:20px auto auto 30px;width:90%;">
										<?php if(form_error('monkey')!=""){?>
										<div class="alert alert-danger alert-dismissible fade in" role="alert">
										您输入的金额有误.
										</div><?php }?> 
										<div class="alert alert-warning transfer_rules" role="alert" style="line-height:25px;">
											<div class="row">
												<div class="col-lg-12">
													点击充值后，将跳转至新浪支付官方页面。<br />请您放心充值！
												</div>
											</div>
										</div>									
									</div>
								</form>
								
								<!----
								<div class=" col-md-12" style="margin-top: 10px;padding-left: 0" >
									<div class="user_recharge_input text-center">
									<a role="button" class="btn btn-danger btn-block" href="<?php echo site_url('product/bulk_standard_list');?>" target"_blank">开始投资</a>
									</div>
								</div>
								------>
								
							</div>
							
							
							<div class="col-md-8 col-xs-12" style="margin-top:10px;">
								<div class="user_recharge_rule">
									<div class="alert alert-info transfer_rules" role="alert">
										<div class="row">
											<div class="col-lg-12">
												<h4>投资规则</h4>
												<p>您绑定银行卡支付限额说明：具体额度请咨询各大银行客服</p>
												<p>用户充值投资，无充值手续费（由平台支付）</p>
												<p>无投资管理费，无利息管理费</p>
											</div>
										</div>

									</div>
									<div class="row" style="border:1px solid #ddd;width:100%;margin-left:0;">
										<div class="col-xs-12 col-md-3 text-right">
											<img src="<?php echo base_url();?>style/img/header/xinlang.jpg" />
										</div>
										<div class="col-xs-12 col-md-3" style="font-size:12px;color:#888;line-height:26px;">
											您的资金安全有新浪支付全程护航
										</div>
										<div class="col-xs-12 col-md-3" >
											<img src="<?php echo base_url();?>style/img/header/lvsuo.png" width="130" />
										</div>
										<div class="col-xs-12 col-md-3 text-right" style="font-size:12px;color:#888;line-height:26px;">
											来自优秀律所提供的全方位法律保障
										</div>											
									</div>									
								</div>
							</div>
						</div>
						<!-- <div class="row user_recharge_bank">
							<div class="row text-center" style="margin-bottom:10px;">
								<a href="#" class="btn btn-info" role="button">
									确认充值
								</a>
							</div>
						</div> -->
						<hr />	
						<div class="row user_recharge_log">
							<h4 style="border-left:4px solid #00aac6;padding-left:10px;">充值记录</h4>
							<div style="margin:20px 0 20px 0;line-height:20px;">
								<table class="table table-striped" style="">
									<thead style="background:#5bc0de;color:#fff;">
										<tr>
											<th>交易号</th>
											<th>日期</th>
											<th>操作类型</th>
											<th>金额（元）</th>
											<th>手续费</th>
											<th>状态</th>
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
											<td><?php echo $key['monkey'];?></td>
											<td><?php echo $key['poundage'];?></td>
											<td><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></td>
										
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
				<?php }else{?>
					<div class="col-md-9 col-xs-12">
						您还没有通过实名认证无法进行充值！前往<u><a href="<?php echo site_url('usercenter/safe');?>">实名认证</a>
					</div>
				<?php }?>
			</div>	
		</div>	
    </div>



</body>
</html>