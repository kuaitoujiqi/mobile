<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>个人中心 - 安全中心</title>
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
    <script src="<?php echo base_url();?>style/js/work.js"></script>
    
    
    <script language="javascript">
    $(document).ready(function(){
		<?php if($this->session->flashdata('idcard') == 1){ //注册过来的弹出身份验证的框?>
			$('[data-target="#authentication"]').click();
		<?php }?>
		<?php if($this->session->flashdata('trading') == 1 || $trading == 1){ //注册过来的弹出身份验证的框?>
			$('[data-target="#trading"]').click();
		<?php }?>
	});
    </script>
  
</head>
<body>

<!--添加修改交易密码弹出 -->
<div class="modal fade" id="trading" tabindex="-1" role="dialog" aria-labelledby="addmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">设置交易密码</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10"> 
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">新的交易密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入新的交易密码"  id="trading">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">确认交易密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请确认交易密码"  id="match_trading">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
					<?php if($userinfo['trading'] != ""){?>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2"></label>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-sm btn-info" id="sendphonecode" data="0">发送手机验证码</button>
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">手机验证码：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入手机验证码" id="phonecode">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
                    <?php }?>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="bind">确认绑定</button>
                
                
            </div>
        </div>
    </div>
</div>

<!--  修改密码弹出 -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="addmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">修改密码</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10">

                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">旧密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的原密码" id="oldpass">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">新密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的新密码" id="newpass">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">确认密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的确认密码" id="matches_password">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success col-lg-4 pull-right">确认修改</button>
            </div>
        </div>
    </div>
</div>

<!--  实名认证弹出 -->
<div class="modal fade" id="authentication" tabindex="-1" role="dialog" aria-labelledby="addmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">实名认证</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10" onSubmit="return false">
					
                     <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">真实姓名：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入真实姓名" id="name">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
					
                    
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">身份证号：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入您的身份证号"  id="idcard">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
            	<div class="col-lg-4">
                      <p class="alert alert-danger my_alert" style="text-align:left">提示：绑定后不可修改,请仔细填写</p>
                 </div>
                <button type="button" class="btn btn-success col-lg-4 pull-right">确认绑定</button>
            </div>
        </div>
    </div>
</div>

<!--  修改手机号弹出 -->
<div class="modal fade" id="addphoneModal" tabindex="-1" role="dialog" aria-labelledby="addmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">修改手机号</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10"> 
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">原手机号：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入原手机号"  id="mobile">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">新手机号：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入新手机号"  id="newphone">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2"></label>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-sm btn-info" id="sendphonecode" data="0">发送手机验证码</button>
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">手机验证码：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入手机验证码" id="phonecode">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="bind">确认绑定</button>
                
                
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
    <!---------------- 个人中心 安全中心 -------------------->
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
						<div class="row" style="margin:30px;">	
							<div class="col-md-12 col-xs-12">
								<div class="row">
									<h4 style="border-left:4px solid #00aac6;padding-left:10px;">个人中心</h4>
									<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
								</div>
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">用户名</div>
									<div class="col-md-4 col-xs-12"><?php echo $userinfo['nickname'];?></div>
									<div class="col-md-4 col-xs-12"></div>
								</div>
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">绑定手机</div>
									<div class="col-md-4 col-xs-12"><?php echo substr_replace($userinfo['mobile'],'*****',3,5);?></div>
									<div class="col-md-4 col-xs-12"><button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#addphoneModal">修改</button></div>
								</div>
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">登陆密码</div>
									<div class="col-md-4 col-xs-12">已单向加密存储</div>
									<div class="col-md-4 col-xs-12"><button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#passwordModal">修改</button></div>
								</div>
								<div class="row" style="color:#888;margin-top:30px;">
									<h4 style="border-left:4px solid #00aac6;padding-left:10px;">安全中心</h4>
									<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
								</div>	
								<?php if($userinfo['is_idcard'] == 1){?>
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">真实姓名</div>
									<div class="col-md-4 col-xs-12"><?php echo $userinfo['name'];?></div>
									<div class="col-md-4 col-xs-12"></div>
								</div>							
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">身份证号</div>
									<div class="col-md-4 col-xs-12"><?php echo $userinfo['idcard'];?></div>
									<div class="col-md-4 col-xs-12"></div>
								</div>	
								<?php }else{ ?>
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">实名认证</div>
									<div class="col-md-4 col-xs-12">未认证</div>
									<div class="col-md-4 col-xs-12"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#authentication">实名认证</button></div>
								</div>		
								<?php }?>	
								<div class="row" style="color:#888;margin-top:30px;">
									<div class="col-md-4 col-xs-12">支付密码</div>
									<div class="col-md-4 col-xs-12"><?php if($userinfo['trading'] == ""){echo "未设置";}else{echo "已设置";}?></div>
									<div class="col-md-4 col-xs-12">
										<?php if($userinfo['trading'] == ""){ ?> 
											<a role="btn" href="<?php echo site_url('usercenter/set_trading');?>" class="btn btn-sm btn-danger" target="_blank">添加</a>
										<?php }else{?> 
											<a role="btn" href="<?php echo site_url('usercenter/change_trading');?>" class="btn btn-sm btn-default" target="_blank">修改</a>
										<?php } ?>
									</div>
								</div>							
							</div>
						</div>							
					</div>
					
				</div>
				
			</div>	
		</div>	
    </div>

</body>
</html>