<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="/favicon.ico" type="image/x-icon"/>
    <title>个人中心 - 提现</title>
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
		$('#inputmonkey').on("keyup","#exampleInputAmount",function(){
			var monkey = $(this).val();
			if(isNaN(monkey) || monkey < 0)
			{
				$(this).val(0);
				$('#shouxufei').text('手续费:0.00'); //提现金额小于手续费额度		
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

				var edu =new Number($('#mianfeiedu').val());
				if(monkey <= edu)
				{
					$(this).val(monkey);
					$('#shouxufei').text('手续费:0.00'); //提现金额小于手续费额度	
				}
				else
				{
					var shouxufeimonkey = monkey - edu;
					var shouxufei = shouxufeimonkey * 0.005;
					if(shouxufei <= 2)
					{
						shouxufei = 2;
					}
					
					$(this).val(monkey);
					$('#shouxufei').text('手续费:'+shouxufei.toFixed(2));
				}
			}
		});
		$('#tixian').click(function(){
			var arg = {};
			arg['monkey'] = $('#exampleInputAmount').val();
			arg['setp'] = 1;
			$.post('<?php echo site_url('usercenter/form_withdraw');?>',arg,function(data,status){
				var data_json = JSON.parse(data);
				
				if(data_json[0] == 0)
				{
					//$('[data-target="#buyModal"]').click(); //验证通过	
					document.write(data_json[1]);
				}
				else
				{
					$('#info_tishi .content').css('color','#D9534F');
					$('#info_tishi .content').html(data_json[1]);
					$('#info_tishi .buttons button').removeClass('btn-success');
					$('#info_tishi .buttons button').addClass('btn-danger');
					$('#info_tishi .buttons button').text('关闭');
					$('#info_tishi').attr('data',2);
					$('#info_tishi').modal('show');
					//alert(data_json[1]);	
				}
			});
			//
		});
		
		$('#tixian_buy').click(function(){
			$(this).attr("disabled",true);
			$(this).text('提现处理中，请稍等');
			var arg = {};
			arg['monkey'] = $('#exampleInputAmount').val();
			arg['trading'] = $('#jjmm').val();
			arg['setp'] = 2;
			$.post('<?php echo site_url('usercenter/form_withdraw');?>',arg,function(data,status){
				$('#jjmm').val('');
				$('#buyModal').modal('hide');

				var data_json = JSON.parse(data);
				if(data_json[0] == 0)
				{
					$('#info_tishi .content').css('color','#000000');
					$('#info_tishi .content').html('提交成功！');
					$('#info_tishi .buttons button').removeClass('btn-danger');
					$('#info_tishi .buttons button').addClass('btn-success');
					$('#info_tishi .buttons button').text('去查看');
					$('#info_tishi').attr('data',1);
					$('#info_tishi').modal('show');

					
					//alert('提交成功');
					//location.href = '<?php echo site_url('usercenter/record/7');?>';	
				}
				else
				{
					//alert(data_json[1]);	
					$('#info_tishi .content').css('color','#D9534F');
					$('#info_tishi .content').html(data_json[1]);
					$('#info_tishi .buttons button').removeClass('btn-success');
					$('#info_tishi .buttons button').addClass('btn-danger');
					$('#info_tishi .buttons button').text('关闭');
					$('#info_tishi').attr('data',2);
					$('#info_tishi').modal('show');


					$('#tixian_buy').attr("disabled",false);
					$('#tixian_buy').text('确认提现');
				}
			});
		});
		
		$('#info_tishi').on('hidden.bs.modal', function (e) {
			var data = $('#info_tishi').attr('data');
			if(data == 1)
			{
				location.href = "<?php echo site_url('usercenter/record/7');?>";	
			}
		});
		
		$('#info_tishi .buttons button').click(function(){
			$('#info_tishi').modal('hide');
		});
	});
    </script>
</head>
<body>

<div class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="info_tishi" data="1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="mySmallModalLabel">信息提示</h4>
        </div>
        <div class="modal-body">
          	<div class="content" style="height:70px; line-height:70px; font-size:18px; text-align:center">提现成功!</div>
            <div class="buttons" style="text-align:right"><button class="btn btn-success">去查看</button></div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


 <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">提现</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10" onSubmit="return false">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">交易密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的交易密码" id="jjmm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            	<a class="btn btn-warning pull-left" href="<?php echo site_url('usercenter/safe/jymm');?>" target="_blank">忘记交易密码?</a>
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="tixian_buy">确认提现</button>
            </div>
        </div>
    </div>
</div>


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
<?php $userinfo = userinfo();?>
<input type="hidden" id="mianfeiedu" value="<?php echo $userinfo['quota'];?>">
<?php $this->load->view('usercenter/header');?>

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
									充值
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
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-12">
								<form id="recharge_form" class=" col-md-12" style="margin-top: 10px;padding-left: 0" method="post" onSubmit="return false;">
									<div class="user_recharge_input text-center">
									<p> <input type="text" class="form-control" id="exampleInputAmount" placeholder="提现金额" name="monkey" ></p>
									<?php if(number_format($userinfo['balance'],2) != 0){;?>
										<a role="button" class="btn btn-danger btn-block" id="tixian" >提现</a>
									<?php }else{ ?>
										<a role="button" class="btn btn-warning btn-block" >无余额可提现</a>	
									<?php }?>
									
									<a role="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#buyModal" id="ljgm_step2" style="display:none">提现第二步</a>
									<div id="shouxufei">
										<?php if($shouxufei == 0){;?>
											<span class="text-success"><span style="text-decoration:line-through;">￥1.50</span> 由平台支付</span>
										<?php }else{?>
											
											<div>手续费 <span class="text-success" style="font-size:20px;">￥1.50</span></div>
											<div><span class="text-danger" style="line-height:14px;">今日免费提现次数用完</span></div>
										<?php }?>
									
									</div>
									
									
									<!--<a href="#" class="btn btn-danger" role="button">
										确认提现
									</a>-->
									</div>
		
								</form>
							</div>
							<div class="col-md-8 col-xs-12">
								<div class="user_recharge_rule">
									<div class="alert alert-info transfer_rules" role="alert">
										<div class="row">
											<div class="col-lg-12">
												<h4>提现规则</h4>
												<p>每日首次提现免费，再次及多次提现每笔1.5元手续费</p>
												<p>债权持有60日后，可申请债权转让，债权转让费用为0.5%</p>
												<p>每日最大提现额度为50万，单笔最大提现额度为50万</p>
												<h4>提现到账时间</h4>
												<p>由于货币基金（新浪微财富存钱罐）的结算周期约为每日下午4点-6点，无法实现当日提现当日到账</p>
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
							<h4 style="border-left:4px solid #00aac6;padding-left:10px;">提现记录</h4>
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
											<td><span class="text-success">￥<?php echo $key['monkey'];?></span></td>
											<td><span class="text-success">￥<?php echo $key['poundage'];?></span></td>
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
			</div>	
		</div>	
    </div>


</body>
</html>