<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>用户中心 - 债权转让</title>
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
    $(document).ready(function(){
		$('[data-target="#transferModal111"]').click(function(){
			$('#xmje').text($(this).attr('total'));
			$('#buy').text($(this).attr('buy'));
			$('#endtime').text($(this).attr('endtime'));
			$('#projectid').val($(this).attr('projectid'));
		});
		
		$('#transferModal111 #zhuanrang').click(function(){
			var arg = {};
			arg['projectid'] = parseInt($('#projectid').val());
			arg['monkey'] = $('#monkey').val();
			
			$('#zhuanrang').attr('disabled',true);
			$.post('/usercenter/ajax_transfer',arg,function(data,status){
				if(data == "success")
				{
					alert('提交成功');
					location.href="/usercenter/transfer";
				}
				else
				{
					alert(data);	
					$('#zhuanrang').attr('disabled',false);
				}
			});
		});
	});
    </script>
</head>
<body>
<!--  转让弹出 -->
<div class="modal fade" id="transferModal111" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">债权转让</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10">
                	<input type="hidden"  id="projectid" value="">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">项目金额：</label>
                        <div class="col-lg-4">
                            <p class="form-control-static" id="xmje"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">购买日期：</label>
                        <div class="col-lg-4">
                            <p class="form-control-static" id="buy"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">到期日：</label>
                        <div class="col-lg-4">
                            <p class="form-control-static" id="endtime"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">转让价格：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入您的转让价格" id="monkey">
                        </div>
                        <div class="col-lg-4">
                            <p class="alert alert-info my_alert">折让为0-20%区间的整数.</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="zhuanrang">确认转让</button>
            </div>
        </div>
    </div>
</div>

<style>
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
    <!---------------- 个人中心 债权转让 -------------------->
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
							<div class="col-md-12 col-xs-12">
								<div class="user_recharge_rule">
									<div class="alert alert-info transfer_rules" role="alert" style="margin:30px;">
										<div class="row">
											<div class="col-lg-12">
												<h4>投资到期前用户可以进行债权转让。</h4>
												<p>债权转让成功，则原债权人人相关权益（收益）转让给新的债权人。</p>
												<p>债权转让失败，则可以撤销转让、调整转让价格后再次转让。</p>
												<p>债权转让申请提交后快投机器会在2个工作日之内审核。</p>
												<h4>转让条件：</h4>
												<p>债权持有期超过2个月，并且债权转让发起日距离下个还款日超过7天。</p>
												<p>债权只能整笔转让，不可拆分。</p>
												<p>每个债权仅能转让一次，购买债权转让项目不能进行再次转让。</p>
												<h4 style="margin-top: 10px">转让定价：</h4>
												<p>转让价格=债权本金 - 折让金</p>
												<p>折让金区间：债权本金0%—20%</p>
												<h4 style="margin-top: 10px">收益分配：</h4>
												<p>原债权人持有债权期间已获收益归属原债权人所有，债权转让后，债权所有权利、义务及收益归属新债权人所有。</p>						
											</div>
										</div>
									</div>									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="btn-group" style="margin:20px auto 20px 50px;">
								<button type="button" class="btn btn-info" onclick="javascript:location='<?php echo site_url('usercenter/transfer/');?>';">债权转让</button> 
								<button type="button" class="btn btn-defalut" onclick="javascript:location='<?php echo site_url('usercenter/user_transfer');?>';">转让列表</button>
							</div>						
						</div>	
						<div class="row">
							<div class="col-md-11 col-xs-12" style="margin-left:35px;">
								<table class="table table-striped" style="">
									<thead style="background:#5bc0de;color:#fff;">
										<tr>
											<th>项目ID</th>
											<th>购买时间</th>
											<th>年化收益</th>
											<th>持有金额</th>
											<th>到期日</th>
											<th>剩余收益/总收益</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										function interest($rate=false,$day = false,$monkey = false)
										{
											$year_rate = $rate * $monkey;
											$day_rate = number_format($year_rate/12,2,'.','');
											$day_rate = $day_rate * $day;
											return number_format($day_rate,2,'.','');
										}
										?>
										
										<?php foreach($result as $key){ ?>
										<tr>
											<td><a href="<?php echo site_url('product/bulk_standard/'.$key['projectid']);?>" target="_blank"><?php echo $key['projectid'];?></a></td>
											<td><?php echo date('Y年m月d日',$key['dateline']);?></td>
											<td><?php echo $key['rate']*100;?>%</td>
											<td><?php echo $key['monkey'];?></td>
											<td><?php echo date('Y年m月d日',$key['endtitme']);?></td>
											<td><?php echo $key['interest']."/".interest($key['rate'],$key['day'],$key['monkey']);?></td>            
											<td><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#transferModal111" buy="<?php echo date('Y年m月d日',$key['dateline']);?>" projectid="<?php echo $key['id'];?>" endtime="<?php echo date('Y年m月d日',$key['endtitme']);?>" total="<?php echo $key['monkey'];?>">转让</button>        
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