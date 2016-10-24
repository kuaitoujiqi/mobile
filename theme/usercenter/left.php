			<!----
			<?php $uri = $this->uri->segment(2,"");?>
			<ul class="nav nav-sidebar">
                <li <?php if($uri == "" || $uri == "index"){?>class="active"<?php }?>>
					<a href="<?php echo site_url('usercenter');?>">
						<i class="glyphicon glyphicon-fire mr10"></i>账户总览
					</a>
				</li>
                <li <?php if($uri == "record"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/record');?>"><i class="glyphicon glyphicon-th-list mr10"></i>账户操作记录</a></li>
                <li <?php if($uri == "products"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/products');?>"><i class="glyphicon glyphicon-shopping-cart mr10"></i>投资记录</a></li>
                
                <?php /*?> <li <?php if($uri == "earnings"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/earnings');?>"><i class="glyphicon glyphicon-usd mr10"></i>存钱罐收益</a></li><?php */?>
                <li <?php if($uri == "recharge"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/recharge');?>"><i class="glyphicon glyphicon-save mr10"></i>充值</a></li>
                <li <?php if($uri == "withdraw"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/withdraw');?>"><i class="glyphicon glyphicon-open mr10"></i>提现</a></li>
              <li <?php if($uri == "transfer"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/transfer');?>"><i class="glyphicon glyphicon-retweet mr10"></i>债权转让</a></li>
          <?php /*?>        <li <?php if($uri == "redpaper"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/redpaper');?>"><i class="glyphicon glyphicon-yen mr10"></i>我的红包</a></li><?php */?>
                <li <?php if($uri == "info"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/info');?>"><i class="glyphicon glyphicon-comment mr10"></i>消息中心</a></li>
                <li <?php if($uri == "safe"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/safe');?>"><i class="glyphicon glyphicon-tower mr10"></i>安全中心</a></li>
                <li <?php if($uri == "binding" || $uri == "addbindbank"){?>class="active"<?php }?>><a href="<?php echo site_url('usercenter/binding');?>"><i class="glyphicon glyphicon-credit-card mr10"></i>银行卡管理</a></li>
            </ul>
			---->
<script>
$(function(){
	$(".user_menu").not(".active").hover(function(){
		$(this).css("background","#eee");
	},function(){
		$(this).css("background","#fff");
	})		
})
</script>			
				<?php $uri = $this->uri->segment(2,"");?>
				<div class="col-md-2 col-xs-12">
					<div class="row user_left_menu">
						<div class="user_info col-md-12 col-xs-12" style="background-image:url('/../style/img/ucenter/head_frame.jpg');background-size:100% auto;">
							<div style="margin:20px auto 20px auto;width:50px;"><img src="/../style/img/ucenter/head_img.png" width="50" /></div>
							<div style="text-align:center;">
								<?php echo userinfo('nickname'); ?> 
								<?php if(userinfo('nowTimeHours') > -1 && userinfo('nowTimeHours') < 12 ){
									echo "上午好！";
								}elseif(userinfo('nowTimeHours') > 18){
									echo "晚上好！";
								}else{
									echo "下午好！";
								}	?>
							</div>
						</div>
						<div class="user_menu_1 col-md-12 col-xs-12">我的账户</div>
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "" || $uri == "index" || $uri == "usercenter"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/usercenter');?>">
								我 的 账 户
							</a>
						</div>
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "recharge"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/recharge');?>">
								充 值
							</a>
						</div>
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "withdraw"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/withdraw');?>">
								提 现
							</a>
						</div>
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "safe"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/safe');?>">
								安 全 中 心
							</a>
						</div>
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "binding"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/binding');?>" target="_blank">
								银 行 卡 管 理
							</a>
						</div>
						
						<!----
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "record"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/record');?>">
								账 户 操 作 记 录
							</a>
						</div>
						--->
						
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "products"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/products');?>">
								投 资 记 录
							</a>
						</div>
						
						<!----
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "transfer"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/transfer');?>">
								债 权 转 让
							</a>
						</div>
						--->
						<div class='user_menu col-md-12 col-xs-12 <?php if($uri == "info"){?>active<?php }?>' style="word-spacing:4px;">
							<a href="<?php echo site_url('usercenter/info');?>">
								信 息 中 心
							</a>
						</div>
						
    
						<div class='col-md-12 col-xs-12'  style="word-spacing:4px;height: 45px;line-height: 45px;padding-left: 40px;background:#c9302c;">
							<a href="<?php echo site_url('welcome/exit_login');?>" style="color:#fff;">退 出 账 号</a>
						</div>
					</div>
				</div>