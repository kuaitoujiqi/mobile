<!DOCTYPE html>
<html>
<head>
<?php /*?>	<script src="<?php echo base_url();?>style/js/uaredirect.js"></script>
	<script language="javascript">
    	uaredirect("https://www.kuaitoujiqi.com/m/");
    </script><?php */?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <meta name="baidu-tc-verification" content="24ad5de6e1e74859048d1c0d972d74e5" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keyword;?>" />
    <meta name="description" content="<?php echo $description;?>" />
    <meta name="viewport" content="width=device-width">
    <link href="" rel="apple-touch-icon-precomposed">
	<meta name="baidu-site-verification" content="zHlNWOnzub" />
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?fcd37886b18b856cbd75a8a25d09fbad";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
    <script>
        $('.carousel').carousel({
            interval: 2000
        });
$(function(){
	$('#retop .m1').click(function(){
		$('body,html').animate({scrollTop:0},600);
		return false
	});
	var $retop = $('#retop');
	function backTopLeft(){
		var btLeft = $(window).width() / 2 + 500;
		if (btLeft <= 950){
			$retop.css({ 'left':955 });
		}else{
			$retop.css({ 'left': btLeft }); 
		}
	}
	backTopLeft();
	$(window).resize(backTopLeft);
	$(window).scroll(function(){
		if ($(document).scrollTop()>0){
			$("#retop .m1").fadeIn();
			$retop.fadeIn();
		}else if($(document).scrollTop()<=0){
			$('#retop .m1').stop().fadeOut();
		}

		if ($.browser.msie && $.browser.version == 6.0 && $(document).scrollTop() !== 0){
			$retop.css({ 'opacity': 1 });
		} 
	});
	/*setTimeout(function(){
	$("#retop .m2").slideDown();	
},800);*/


	/*$("body").css("overflow-x","scroll");*/

	function preventDefault(e){
		if(document.all)window.event.returnValue=false;
		e.preventDefault();
		return false;
	}

	$(".contactusyinker").hover(function(){	
		$(".contactusyinker .f1").css("color","#fff")
		$("#yinkermask2").show();
		$(".hoverbtn img").attr({src:basePath_+"style/img/activebtnbg.png"})
		$("#yinkermask2").stop().animate({opacity:0.4});
		$("#yinkermask2").css({
			width	:	$(document).outerWidth(),
			height	:	$(document).outerHeight()
		});
		$(this).stop().animate({
			right:"0px"
		},800);
		$(window).bind('DOMMouseScroll', preventDefault);
		$(window).bind('mousewheel', preventDefault);
		$(window).bind('mousedown', preventDefault);
		$("body").bind('DOMMouseScroll', preventDefault);
		$("body").bind('mousewheel', preventDefault);
		$("body").bind('mousedown', preventDefault);	
	},function(){
		$(window).unbind('DOMMouseScroll', preventDefault);
		$(window).unbind('mousewheel', preventDefault);
		$(window).unbind('mousedown', preventDefault);
		$("body").unbind('DOMMouseScroll', preventDefault);
		$("body").unbind('mousewheel', preventDefault);
		$("body").unbind('mousedown', preventDefault);
		$(".hoverbtn img").attr({src:basePath_+"style/img/hoverbtnbg.png"})
		$("#yinkermask2").stop().fadeOut(800); 	
		$("#yinkermask2").stop().animate({opacity:0},function(){$("#yinkermask2").hide();});
		$(this).stop().animate({
			right:"-230px"
		});

	});
	var basePath_='<?php echo base_url();?>';
	$("#yinkermask2").click(function(){
		$("#yinkermask2").hide()
		$(this).stop().animate({
			right:"-230px"
		});
	});
});
    </script>


</head>
<body>
<link rel="stylesheet" href="<?php echo base_url();?>style/css/front.css">

	<!---头部--->
    <?php $this->load->view('front/header');?>
	
	
    <!-- --------------------------- 焦点图---------------------->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        	<?php foreach($focus as $val=>$key){?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $val;?>" <?php if($val==0){?>class="active"<?php }?>></li>
            <?php }?>
        </ol>
        <div class="carousel-inner" role="listbox">
        	<?php foreach($focus as $val=>$key){?>
            <div class="item <?php if($val==0){?>active<?php }?>">
                <a href="<?php echo $key['url'];?>"><img src="<?php echo $key['photo'];?>" alt="<?php echo $key['title'];?>"></a>
                <div class="container">
                    <div class="carousel-caption">
                    </div>
                </div>
            </div>
            <?php }?>
    		
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- /.carousel -->
	
	<!-- 轮播图/点击注册 
	<!-- 
	<div class="registryFrame" style="background:url('style/img/GlassFrame.png');">
		<div class="registryFrameInfo">
			<div class="registryFrameInfo1">100%</div>
			<div class="registryFrameInfo2">活期存款收益</div>
			<div class="registryFrameInfo3"></div>
			<div class="registryFrameInfo4">
				<a href="<?php echo site_url('welcome/register_frame');?>">
					<img src="style/img/registerReward.png" />
				</a>
			</div>
			<div class="registryFrameInfo5">
				<a href="<?php echo site_url('welcome/login_frame');?>">已有账号，<span>马上登陆</span></a>
			</div>
		</div>
	</div>	
	-->
			
<script>
$(function(){
	$(".newsListGGTitleLeft").click(function(){
		$(this).siblings().addClass("active");
		$(this).removeClass("active");
		$(this).css("border-right","1px solid #c6c6c6");
		$(this).siblings().css("border-left","0px solid #c6c6c6");
		$(".newsListGGContent").show();
		$(".newsListGGContent_").hide();
	})
	$(".newsListGGTitleRight").click(function(){
		$(this).siblings().addClass("active");
		$(this).removeClass("active");
		$(this).css("border-left","1px solid #c6c6c6");
		$(this).siblings().css("border-right","0px solid #c6c6c6");
		$(".newsListGGContent").hide();
		$(".newsListGGContent_").show();
	})	
	
	$(".mediaListContent").find("li").hover(function(){
		$(this).find("img").attr("src","style/img/index/alarm.png");		
	},function(){
		$(this).find("img").attr("src","style/img/index/time.png");	
	})
	
	$(".newsListGGContent").find("li").hover(function(){
		$(this).find("img").attr("src","style/img/index/alarm.png");		
	},function(){
		$(this).find("img").attr("src","style/img/index/time.png");	
	})
	
	$(".newsListGGContent_").find("li").hover(function(){
		$(this).find("img").attr("src","style/img/index/alarm.png");		
	},function(){
		$(this).find("img").attr("src","style/img/index/time.png");	
	})
})
</script>		
	
	<!---- 风控安全体系 ---->
	<div class="safetySystem">
		<div class="container xinlang">
			<div class="row">
				<div class="col-xs-4 col-md-4">
					<div class="safetySystemImg fLeft">
						<a href="<?php echo site_url('news/article_safety');?>"><img src="style/img/sanfang.png" /></a>
					</div>
					<div class="safetySystemContent fLeft">
					<h4 class="text-center">收益稳健</h4>
					<p class="text-center" style="margin-bottom:5px;">多种期限 任意选择</p>
					<p class="text-center" style="margin-bottom:5px;">100元起投 灵活投资</p>
					<p class="text-center" style="margin-bottom:5px;">10%-18%超高稳定收益</p>
					</div>
					<div class="safetySystemLink fRight">
						<img src="style/img/jianbian.jpg" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="col-xs-4 col-md-4">
					<div class="safetySystemImg fLeft">
						<a href="<?php echo site_url('news/article_safety');?>"><img src="style/img/fengkong.png" /></a>
					</div>
					<div class="safetySystemContent fLeft">
					<h4 class="text-center">高效专业</h4>
					<p class="text-center" style="margin-bottom:5px;">高度透明 专款专用</p>
					<p class="text-center" style="margin-bottom:5px;">核心企业 优质资源</p>
					<p class="text-center" style="margin-bottom:5px;">供应链金融掌握关键</p>
					</div>
					<div class="safetySystemLink fRight">
						<img src="style/img/jianbian.jpg" />
					</div>
					<div class="clear"></div>				
				</div>
				<div class="col-xs-4 col-md-4">
					<div class="safetySystemImg fLeft">
						<a href="<?php echo site_url('news/article_safety');?>"><img src="style/img/xianxing.png" /></a>
					</div>
					<div class="safetySystemContent fLeft">
					<h4 class="text-center">安全保障</h4>
					<p class="text-center" style="margin-bottom:5px;">256位全程交易加密</p>
					<p class="text-center" style="margin-bottom:5px;">新浪支付品牌资金托管</p>
					<p class="text-center" style="margin-bottom:5px;">核心企业全额本息保障</p>
					</div>
					<div class="clear"></div>				
				</div>
			</div>
		</div>
	</div>

	<!--网站公告-->
	<!--
	<div>
		<div class="container" style="height:50px;line-height:50px;">
			<div class="row">
				<div class="col-xs-14 col-md-9">
					<div class="pull-left"><img src="style/img/alarm.jpg" /></div>
					<div class="pull-left" style="margin-left:10px;">快投机器公告</div>
					<div class="pull-left cls_container myscroll" style="margin-left:10px;height:50px;line-height:50px;">
						 <ul>
							<?php foreach($meiti as $key){?>
								<li style="height:50px;line-height:50px;"><a href="<?php echo site_url('news/article/'.$key['id']);?>"><?php echo $key['title'];?></a></li>
							<?php }?>
						 </ul>
					</div>
				</div>
				<div class="col-xs-14 col-md-3">
				</div>
			</div>
		</div>
	</div>	
	-->
	
	
	<div>
		<!---- 新浪存钱罐利润 ---->
		
		<!---- 
		<div class="container weiQianBao">
			<div class="weiQianBaoLeft fLeft">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="weiQianBaoLeftImg fLeft"><img src="style/img/index/weiqianbao.png" /></div>
						<div class="weiQianBaoLeftContent fLeft">
							<div class="row text-center">
								<div class="col-xs-3 col-md-3">
									<div class="weiQianBaoLeftContentText">
										<span class="text-red"><span class="text-lg">0.01</span>元</span><br />
										<span class="text-blue">起存金额</span>
									</div>
								</div>
								<div class="col-xs-3 col-md-3">
									<div class="weiQianBaoLeftContentText">
										<span class="text-red"><span class="text-lg">2.786</span>%</span><br />
										<span class="text-blue">七日年化收益率</span>
									</div>								
								</div>
								<div class="col-xs-2 col-md-2">
									<div class="weiQianBaoLeftContentText">
										<span class="text-red"><span class="text-lg">T</span>+<span class="text-lg">1</span></span><br />
										<span class="text-blue">赎回方式</span>
									</div>									
								</div>
								<div class="col-xs-4 col-md-4">
									<a href="<?php echo site_url('welcome/register_frame');?>">
										<div class="weiQianBaoLeftContentBtn">立即加入</div>
									</a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="weiQianBaoRight fRight">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="weiQianBaoRightContent1">
						<img src="style/img/index/zhuceren.png" />
						<span>
							注册用户
							<span class="text-blue">35535</span>
							人
						</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="weiQianBaoRightContent2">
						<img src="style/img/index/gongtouzijin.png" />
						<span>
							累计投资
							<span class="text-blue">355350914</span>
							元
						</span>
						</div>						
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="weiQianBaoRightContent3">
						<img src="style/img/index/zuanquzijin.png" />
						<span>
							已为投资赚取
							<span class="text-blue">35535091</span>
							元
						</span>
						</div>						
					</div>
				</div>
			</div>
			<div class="weiQianBaoLink1"><img src="style/img/index/weiqianbaoLink.png" /></div>
			<div class="weiQianBaoLink2"><img src="style/img/index/weiqianbaoLink.png" /></div>
			<div class="clear"></div>
		</div>
		---->
		
		<!---- 投资项目  网站公告 ---->
		<div class="container productList">
				<div class="productListLeft fLeft">
				
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="productListTitle">
								<b>投 资 项 目</b>
								<a href="<?php echo site_url('product/bulk_standard_list');?>" class="fRight">查看更多>></a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					
					
					<?php foreach($bulk as $key){?>
					<div class="row productListDetail">
						<div class="col-xs-12 col-md-12">
							<div class="productListContent">
								<div>
									<div class="projectTitle">
										<div class="fLeft"><a href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>"><?php echo $key['title'];?></a></div>
										<div class="fRight">上线日期：<?php echo date('m月d日 H:i',strtotime($key['creattime']));?></div>
										<div class="clear"></div>
									</div>	
									<div class="projectLink"></div>
								</div>
								<div class="productListContentLeft fLeft">
									<div class="row projectInfo">
										<div class="col-xs-4 col-md-4">
											<div class="projectImg">
												<a href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>"><img src="<?php echo $key['photo'];?>" width="166" height="125"/></a>
											</div>										
										</div>
										<div class="col-xs-8 col-md-8 text-center">
											<div class="row projectNum">
												<div class="col-xs-6 col-md-6">
													<p>借款金额：<span class="text-success">￥<span class="text-mid"><?php echo $key['money'];?></span></span></p>
													<p>年化收益率：<span class="text-red"><span class="text-mid"><?php echo $key['rate']*100;?></span>%</span></p>
												</div>
												<div class="col-xs-1 col-md-1">
													<img src="style/img/index/pline.png" />
												</div>
												<div class="col-xs-5 col-md-5">
													<p>期限：<span class="text-success"><span class="text-mid"><?php echo $key['day'];?></span>个月</span></p>
													<p style="line-height:30px;"><?php echo $key['repay'];?></p>												
												</div>
											</div>
											<div class="row" style="margin-top:10px;">
												<div class="col-xs-12 col-md-12" style="width:95%;">
													<div class="progress progress-striped" style="height:10px;margin-top:10px;">
													   <div class="progress-bar progress-bar-info active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ((int)$key['money']-(int)$key['restmoney'])/(int)$key['money']*100;?>%;">
														  <span class="sr-only"><?php echo ((int)$key['money']-(int)$key['restmoney'])/(int)$key['money']*100;?>%</span>
													   </div>
													</div>												
												</div>
											</div>	
										</div>
									</div>
								</div>
								<div class="productListContentRight fRight text-center">
									<div class="productListStatus">
										可购余额：<span class="text-success">￥ <span class="text-mid"><?php echo $key['restmoney'];?></span></span>
										<?php if($key['static'] == 1){
													if($key['restmoney'] == 0){?>
														<a href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>" class="btn btn-primary btn-normal" target="_blank" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;审核中&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
													<?php }else{
													if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){ 
													//预告  当前时间小于开始时间?>
														<a href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>" class="btn btn-success btn-primary btn-normal" id="ljgm_step3" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;即将上线&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
													<?php }else{?>
														<a class="btn btn-danger btn-normal" href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;购买&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
										<?php } } }?>
										<?php if($key['static'] == 2){?>
											<a class="btn btn-warning btn-normal" href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;还款中&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
										<?php }?>
										<?php if($key['static'] == 3){?>
											<input type="button" class="btn btn-default btn-normal" id="ljgm_step3" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已结束&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" disabled="disabled">
										<?php }?>										
										<?php if($key['static'] == 4){?>
											<input type="button" class="btn btn-default btn-normal" id="ljgm_step3" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;初审中&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" disabled="disabled">
										<?php }?>	
									</div>
								</div>	
								<div class="clear"></div>
							</div>	
						</div>
					</div>					
					<?php }?>				

					<div class="row">
						<div class="col-xs-12 col-md-12 ">
							<div class="productListDetailAlert text-right">
								项目上线时间：工作日上午<span class="text-red text-mid">9：00</span>，其他时间以实际为准。&nbsp;&nbsp;
							</div>
						</div>
					</div>				
				</div>
						
				<div class="productListRight fRight">
					<!--- 登录 注册 --->
					<!--- 
					<div style="margin-bottom:20px;">
						<div style="width:50%;float:left;"><a role="btn" class="btn btn-danger btn-block" href="<?php echo site_url('welcome/login_frame');?>">登 录</a></div>
						<div style="width:50%;float:left;"><a role="btn" class="btn btn-default btn-block" href="<?php echo site_url('welcome/register_frame');?>">注 册</a></div>
						<div class="clear"></div>
					</div>			
					--->
					
					<!--- 红包送不停 --->
					<div class="newsListTop">
						<a href="<?php echo site_url('welcome/huodong');?>" ><img src="style/img/index/xiaojiaodian.png" width="100%" /></a>
					</div>
					
					<div class="newsListGG">
						<div class="newsListGGTitle">
							<div class="newsListGGTitleLeft fLeft text-center" style="border-right:1px solid #c6c6c6;">平台公告</div>
							<div class="newsListGGTitleRight fRight text-center active">还款公告</div>
						</div>
						<div class="newsListGGContent">
							<ul>
								<?php foreach($webgonggao as $key){?>
								<li>
									<a href="<?php echo site_url('news/article/'.$key['id']);?>">
										<div class="newsListGGContent1 fLeft"><img src="style/img/index/time.png" /></div>
										<div class="newsListGGContent2 fLeft"><?php echo $key['title'];?></div>
										<div class="newsListGGContent3 fRight"><?php echo substr($key['dateline'],5,5);?></div>
										<div class="clear"></div>
									</a>
								</li>
								<?php }?>
							</ul>
							<div class="text-right"><a href="<?php echo site_url('news/newslist/11');?>">查看更多>></a></div>
						</div>
						<div class="newsListGGContent_" style="display:none;">
							<ul>
								<?php foreach($gonggao as $key){?>
								<li>
									<a href="<?php echo site_url('news/article/'.$key['id']);?>">
										<div class="newsListGGContent1 fLeft"><img src="style/img/index/time.png" /></div>
										<div class="newsListGGContent2 fLeft"><?php echo $key['title'];?></div>
										<div class="newsListGGContent3 fRight"><?php echo substr($key['dateline'],5,5);?></div>
										<div class="clear"></div>
									</a>
								</li>
								<?php }?>
							</ul>
							<div class="text-right"><a href="<?php echo site_url('news/newslist/1');?>">查看更多>></a></div>
						</div>						
					</div>	
					
					<!--- 新手引导 --->
					<div class="noviceGuide">
						<a href="<?php echo site_url('news/article_novice');?>"><img src="style/img/index/novice.png" width="100%" /></a>
					</div>	
					
					<div class="mediaList">
						<div class="mediaListTitle">
							<div class="text-center">媒体报道</div>
						</div>		
						<div class="mediaListContent">
							<ul>
								<?php foreach($meiti as $key){?>
								<li>
									<a href="<?php echo site_url('news/article/'.$key['id']);?>">
										<div class="newsListGGContent1 fLeft"><img src="style/img/index/time.png" /></div>
										<div class="newsListGGContent2 fLeft"><?php echo $key['title'];?></div>
										<div class="newsListGGContent3 fRight"><?php echo substr($key['dateline'],5,5);?></div>
										<div class="clear"></div>
									</a>
								</li>
								<?php }?>
							</ul>
							<div class="text-right"><a href="<?php echo site_url('news/newslist/3');?>">查看更多>></a></div>
						</div>					
					</div>
				</div>
		</div>
		
	</div>			
	

    <!----------------------------- 活动 -------------------->
        <div class="container" style="margin-top:40px;">
			<div class="productListTitle"><b>活动专题</b></div>
			
			<div class="row" style="border:1px solid #ddd;margin:12px auto;background:#fff;">
				<div class="col-xs-12 col-md-7" style="padding:0;margin:0;">
					<img src="style/img/huodong.jpg" width="100%"/>
				</div>
				<div class="col-xs-12 col-md-5" style="padding:0;margin:0;line-height:25px;font-size:13px;">
					<div style="width:90%;margin:10px auto auto 20px;">
					<p class="text-center">活动规则<p>
					<p>1.用户注册并实名认证。<p>
					<p>2.注册投资项目5000元（含）以上可以得10元金奖励。（限单笔投资，无推荐人的）<p>
					<p>3.推荐好友单笔投资项目10000元（含）以上,双方将各获得10元现金奖励（限好友单笔投资项目）。<p>
					<p>4.用户邀请好友数额无上限，邀请好友越多，投资额越高，现<br />金奖励越大。<p>
					<p>活动期限：即日起至2016年5月30日<p>
					<a style="margin-left:200px;" href="<?php echo site_url('welcome/register_frame');?>" target="_blank">邀请好友一起加入>></a>
					</div>
					<img src="style/img/huodongqianbao.png" style="position:absolute;top:150px;left:340px;"/>
				</div>
			</div>
        </div>
	
	
	<!----合作伙伴--->
	<!----	
<script src="<?php echo base_url();?>style/js/jquery.liMarquee.js" type="text/javascript" ></script>
<script>
$(function(){
	$('.dowebok').liMarquee();
});
</script>
	--->
        <div class="container" style="min-height:100px;margin-top:40px;">
			<div class="productListTitle">
				<b>合作伙伴</b>
				<a href="<?php echo site_url('news/article_partener');?>" class="fRight">查看更多>></a>			
			</div>
			<!---->
			<!--主要合作机构开始-->
			<div class="partner">
				<div class="dowebok" style="margin:30px 20px 15px 20px">
					<a href="<?php echo site_url('news/article_partener');?>" target="_blank"><img src="style/img/com_xlzf.png" border="0" /></a>	
					<a href="<?php echo site_url('news/article_partener');?>" target="_blank"><img src="style/img/header/lvsuo.png" border="0" /></a>	
					<a href="<?php echo site_url('news/article_partener');?>" target="_blank"><img src="style/img/header/danbao.png" border="0" /></a>	
					<a href="<?php echo site_url('news/article_partener');?>" target="_blank"><img src="style/img/header/aliyun.png"  border="0" /></a>		
				</div>
			</div>
			
        </div>
	<!--合作伙伴结束-->
	
	<!---底部--->
    <?php $this->load->view('front/footer');?>
    
   
</body>
</html>
