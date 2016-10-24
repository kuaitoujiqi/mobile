<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>投资列表-快投机器理财</title>
    <meta name="keywords" content="理财产品,理财产品哪个好" />
    <meta name="description" content="理财产品哪个好？尽在快投机器理财产品！" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
		
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
		})
    </script>
</head>
<body style="background: #fff">
<?php $this->load->view('front/header');?>

<!----------------------------- 项目列表-------------------->

<style>
.module-title{
	font-size:20px;
	color:#00aac6;
}
.info_text{
	font-size:12px;	
}
#list_select_frame{
	overflow:hidden;
	background: #fff;
	padding:20px;
	margin-top:20px;
	min-height:100px;
	border:1px solid #ddd;
}
.list_one{
	border:1px solid #ddd;
}
#list_select_button{
	background:#fff;
	height:20px;
	font-size:16px;
}
.list_select{
	margin-top:0;
	height:35px;
	line-height:35px;
	color:#888;
}
.list_select .active{
	/*
	color:#d43f3a;
	*/
	color:#888;
}
.info_text_red{
	color:#ff0000;
}
.info_list>div{
	font-size:12px;
	line-height:30px;
	width:100px;
}
.info_list>div:nth-of-type(6){
	width:200px;
}
.list_title_underline{
	width:;
	height:3px;
	background:#00aac6;
	position:relative;
	top:3px;
}
.info_list_detail{
	background-image:url('/../style/img/jianbian.png');
}
</style>
<div style="background: #f2f2fd;padding:20px 0">
	<div class="container mt10" style="width:1270px;padding:0px 50px 0 50px;">
		<div class="row" style="line-height:40px;">
			<div class="col-xs-12 col-md-2 text-center" style="font-size:18px;">
				<div class="row"><a style="text-decoration:none;" href="<?php echo site_url('product/bulk_standard_list');?>">投资列表</a></div>
				<div class="row list_title_underline"></div>
			</div>
			
			<div class="col-xs-12 col-md-2 text-center" style="font-size:18px;">
				<!----<div class="row"><a style="text-decoration:none;" href="<?php echo site_url('product/transfer_list');?>">债权转让</a></div>---->
			</div>

			<div class="col-xs-12 col-md-8 text-right" style="font-size:12px;color:#aaa;">
				项目上线时间：工作日上午<span class="info_text info_text_red">9：00</span>，其他时间以实际为准。&nbsp;&nbsp;			
			</div>
			<div style="height"></div>
		</div>	
		<div class="row" style="border-bottom:2px solid #aaa;">
		</div>	
		<div id="list_select_frame">
			<div class="row list_select" style="border-bottom:1px dashed #ddd;">
				<div class="col-xs-1 col-md-1" style="width:120px;">
					项目期限
				</div>
				<div class="col-xs-1 col-md-1">
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('cycle',0,array('page')); ?>" <?php if($select_cycle == 0){ ?>class="active"<?php } ?>>
						全部
						</a>
				</div>
				<div class="col-xs-12 col-md-9">
					<div class="row">
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('cycle',1,array('page')); ?>" <?php if($select_cycle == 1){ ?>class="active"<?php } ?>>	
							3个月以下
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('cycle',2,array('page')); ?>" <?php if($select_cycle == 2){ ?>class="active"<?php } ?>>	
							3个月-6个月
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('cycle',3,array('page')); ?>" <?php if($select_cycle == 3){ ?>class="active"<?php } ?>>	
							6个月以上
						</a>
					</div>
				</div>				
			</div>	
			<!---
			<div class="row list_select" style="border-bottom:1px dashed #ddd;">
				<div class="col-xs-12 col-md-1">
					项目金额
				</div>
				<div class="col-xs-12 col-md-1">
					<a href="<?php echo site_url('product/bulk_standard_list').url_str('total',0,array('page')); ?>" <?php if($select_total == 0){ ?>class="active"<?php } ?>>	
						全部
					</a>
				</div>
				<div class="col-xs-12 col-md-10">
					<div class="row">
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('total',1,array('page')); ?>" <?php if($select_total == 1){ ?>class="active"<?php } ?>>	
							10万以下
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('total',2,array('page')); ?>" <?php if($select_total == 2){ ?>class="active"<?php } ?>>	
							10万-30万
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('total',3,array('page')); ?>" <?php if($select_total == 3){ ?>class="active"<?php } ?>>	
							30万-50万
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('total',4,array('page')); ?>" <?php if($select_total == 4){ ?>class="active"<?php } ?>>	
							50万以上
						</a>
					</div>
				</div>
			</div>	
			--->
			<div class="row list_select">
				<div class="col-xs-1 col-md-1" style="width:120px;">
					年化收益率
				</div>
				<div class="col-xs-1 col-md-1">
					<a href="<?php echo site_url('product/bulk_standard_list').url_str('rate',0,array('page')); ?>" <?php if($select_rate == 0){ ?>class="active"<?php } ?>>
						全部
					</a>
				</div>
				<div class="col-xs-12 col-md-9">
					<div class="row">
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('rate',1,array('page')); ?>" <?php if($select_rate == 1){ ?>class="active"<?php } ?>>		
							12%以下
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('rate',2,array('page')); ?>" <?php if($select_rate == 2){ ?>class="active"<?php } ?>>	
							12%~14%
						</a>
						<a href="<?php echo site_url('product/bulk_standard_list').url_str('rate',3,array('page')); ?>" <?php if($select_rate == 3){ ?>class="active"<?php } ?>>	
							14%以上
						</a>
					</div>
				</div>					
			</div>		
		</div>
	</div>
	
<style>
body{
	background:#f2f2fd;
	color:#666;
}
.safetySystem{
	background:#fff;
	height:186px;
	margin-bottom:30px;
	border-top:1px solid #c6c6c6;
	border-bottom:1px solid #c6c6c6;
	box-shadow:0px 5px 10px #dbdbea;
}
.safetySystem .row .col-md-4{
	margin-top:8px;
}
.safetySystemImg{
	width:62px;
	margin:60px 20px auto auto;
}
.safetySystemImg img{
	width:100%;
}
.safetySystemContent{
	margin:25px auto auto auto;
	width:70%;
	line-height:25px;
}
.safetySystemLink{
	width:1px;
	height:170px;
}
.safetySystemLink img{
	height:100%;
}
.fLeft{
	float:left;
}
.fRight{
	float:right;
}
.clear{
	clear:both;
}
.weiQianBao{
	height:145px;
	position:relative;
}
.weiQianBaoLeft{
	height:145px;
	width:830px;
	background:#fff;
	border:1px solid #c6c6c6;
	border-radius:5px 5px 5px 5px;	
}
.weiQianBaoLeftImg{
	margin:10px auto auto auto;
	width:120px;
	height:124px;
}
.weiQianBaoLeftContent{
	width:700px;
	height:145px;
}
.weiQianBaoLeftContentText{
	border:0px solid #000;
	height:80px;
	width:100%;
	margin-top:40px;
}
.weiQianBaoLeftContentBtn{
	margin:50px auto auto auto;
	height:40px;
	line-height:40px;
	color:#00aac6;
	width:85%;
	border-radius:25px 25px 25px 25px;
	border:1px solid #00aac6;
	
}
.weiQianBaoLeftContent a{
	text-decoration:none;
}
.weiQianBaoLeftContentText span:nth-of-type(1){
	line-height:35px;
}
.weiQianBaoRight{
	height:145px;
	width:290px;
	background:#fff;
	border:1px solid #c6c6c6;
	border-radius:5px 5px 5px 5px;
}
.weiQianBaoRight img{
	margin-right:10px;
}
.weiQianBaoRightContent1{
	margin:20px 0px auto 35px;
}
.weiQianBaoRightContent2{
	margin:15px 0px auto 35px;
}
.weiQianBaoRightContent3{
	margin:15px 0px auto 35px;
}
.weiQianBaoLink1{
	width:53px;
	height:14px;
	position:absolute;
	right:290px;
	top:16px;
	z-index:9999;
}
.weiQianBaoLink2{
	width:53px;
	height:14px;
	position:absolute;
	right:290px;
	top:106px;
	z-index:9999;
}
.text-red{
	color:#ee0000;
}
.text-lg{
	font-size:30px;
}
.text-mid{
	font-size:20px;
}
.text-blue{
	color:#00aac6;
}
.btn-kt{
	background-color:#00aac6;
}
.productList{
	margin-top:20px;
	margin-bottom:30px;
}
.productListTitle{
	width:100%;
	height:50px;
	line-height:45px;
	background:#fff;
	border-left:4px solid #00aac6;
	border-right:1px solid #c6c6c6;
	border-top:1px solid #c6c6c6;
	border-bottom:1px solid #c6c6c6;
}
.productListTitle b{
	margin-left:5px;
	font-size:18px;
}
.productListTitle a{
	margin-right:20px;
	color:#00aac6;
}
.productListTitle a:hover{
	text-decoration:none;
}
.productListContent{
	width:100%;
	height:200px;
	background:#fff;
	border-left:2px solid #00aac6;
	border-right:1px solid #c6c6c6;
	border-top:1px solid #c6c6c6;
	border-bottom:1px solid #c6c6c6;	
}
.productListDetail{
	margin-bottom:12px;
}
.productListContentLeft{
	width:75%;
	height:150px;
}
.productListContentRight{
	margin-left:10px;
	width:22%;
	background:#fefefe;
	height:150px;
}
.productListStatus{
	margin-top:26px;
}
.productListStatus a{
	margin-top:20px;
}
.projectTitle{
	height:40px;
	line-height:40px;
}
.projectTitle a{
	color:#000;
}
.projectTitle a:hover{
	color:#00aac6;
	text-decoration:none;
}
.projectTitle div:nth-child(1){
	width:77%;
	color:#000;
	margin-left:10px;
	font-size:16px;
}
.projectTitle div:nth-child(2){
	width:20%;
	font-size:12px;
	text-align:right;
	color:#aaa;
	margin-right:10px;
}
.projectLink{
	width:100%;
	height:2px;
	border-bottom:1px solid #dbdbea;
}
.projectImg{
	width:160px;
	margin:0px auto auto 20px;
}
.projectInfo{
	margin-top:10px;
}
.projectNum div:nth-child(1){
	margin-top:20px;
}
.projectNum div:nth-child(3){
	margin-top:20px;	
}
.productListLeft{
	width:830px;
}		
.productListRight{
	width:290px;
}
.productListDetailAlert{
	height:50px;
	line-height:50px;
	background:#fff;
	margin-top:10px;
	border:1px solid #c6c6c6;
	color:#aaa;
}
.newsListGG{
	margin-top:20px;
	border-top:2px solid #00aac6;
	border-right:1px solid #c6c6c6;
	border-left:1px solid #c6c6c6;
	border-bottom:1px solid #c6c6c6;
	background:#fff;
}
.mediaList{
	margin-top:20px;
	border-top:2px solid #00aac6;
	border-right:1px solid #c6c6c6;
	border-left:1px solid #c6c6c6;
	border-bottom:1px solid #c6c6c6;
	background:#fff;	
}
.mediaListTitle{
	height:40px;
	line-height:40px;
	border-bottom:1px solid #c6c6c6;
}
.mediaListContent{
	width:90%;
	margin:10px 15px 0px 15px;
}
.mediaListContent div{
	height:30px;
	line-height:30px;
}	
.mediaListContent div a{
	color:#00aac6;
}	
.mediaListContent div a:hover{
	text-decoration:none;
}
.mediaListContent ul li{
	height:40px;
	line-height:40px;
	border-bottom:1px dashed #c6c6c6;
}
.mediaListContent ul li a{
	color:#666;
}
.mediaListContent ul li a:hover{
	color:#00aac6;
}
.newsListGGTitle{
	height:40px;
	line-height:40px;
}
.newsListGGTitleRight{
	width:50%;
	cursor:pointer;
}
.newsListGGTitleLeft{
	width:50%;
	cursor:pointer;
}
.newsListGGTitle .active{
	border-bottom:1px solid #c6c6c6;
}
.newsListGGContent{
	width:90%;
	margin:10px 15px 0px 15px;
}
.newsListGGContent div{
	height:30px;
	line-height:30px;
}	
.newsListGGContent div a{
	color:#00aac6;
}	
.newsListGGContent div a:hover{
	text-decoration:none;
}
.newsListGGContent ul li{
	height:40px;
	line-height:40px;
	border-bottom:1px dashed #c6c6c6;
}
.noviceGuide{
	margin-top:20px;
}
.newsListGGContent ul li a{
	color:#666;
}
.newsListGGContent ul li a:hover{
	color:#00aac6;
}
.newsListGGContent_{
	width:90%;
	margin:10px 15px 0px 15px;
}
.newsListGGContent_ div{
	height:30px;
	line-height:30px;
}	
.newsListGGContent_ div a{
	color:#00aac6;
}	
.newsListGGContent_ div a:hover{
	text-decoration:none;
}
.newsListGGContent_ ul li{
	height:40px;
	line-height:40px;
	border-bottom:1px dashed #c6c6c6;
}
.newsListGGContent_ ul li a{
	color:#666;
}
.newsListGGContent_ ul li a:hover{
	color:#00aac6;
}
.newsListGGContent1{
	width:30px;
	height:40px;
	
}
.newsListGGContent2{
	width:180px;
	height:40px;
	white-space:nowrap; 
	text-overflow:ellipsis;
	overflow:hidden;
}
.newsListGGContent3{
	width:40px;
}
</style>
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
		$(this).find("img").attr("src","/../style/img/index/alarm.png");		
	},function(){
		$(this).find("img").attr("src","/../style/img/index/time.png");	
	})
	
	$(".newsListGGContent").find("li").hover(function(){
		$(this).find("img").attr("src","/../style/img/index/alarm.png");		
	},function(){
		$(this).find("img").attr("src","/../style/img/index/time.png");	
	})
	
	$(".newsListGGContent_").find("li").hover(function(){
		$(this).find("img").attr("src","/../style/img/index/alarm.png");		
	},function(){
		$(this).find("img").attr("src","/../style/img/index/time.png");	
	})
})
</script>	
		<!--项目列表-->
		<div class="container productList" style="width:1270px;padding:20px 50px 0 50px;">
				<div class="productListLeft fLeft">
					
					<?php foreach($result as $key){?>
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
													<img src="/../style/img/index/pline.png" />
												</div>
												<div class="col-xs-5 col-md-5">
													<p>期限：<span class="text-success"><span class="text-mid"><?php echo $key['day'];?></span>个月</span></p>
													<p style="line-height:30px;"><?php echo $key['repay'];?></p>												
												</div>
											</div>
											<div class="row" style="margin-top:10px;">
												<div class="col-xs-12 col-md-12">
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
					<!--- 红包送不停 --->
					<div class="newsListTop">
						<a href="<?php echo site_url('welcome/huodong');?>"><img src="/../style/img/index/xiaojiaodian.png" width="100%" /></a>
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
										<div class="newsListGGContent1 fLeft"><img src="/../style/img/index/time.png" /></div>
										<div class="newsListGGContent2 fLeft"><?php echo $key['title'];?></div>
										<div class="newsListGGContent3 fRight"><?php echo substr($key['dateline'],5,5);?></div>
										<div class="clear"></div>
									</a>
								</li>
								<?php }?>
							</ul>
							<div class="text-right"><a href="<?php echo site_url('news/newslist/3');?>">查看更多>></a></div>
						</div>
						<div class="newsListGGContent_" style="display:none;">
							<ul>
								<?php foreach($gonggao as $key){?>
								<li>
									<a href="<?php echo site_url('news/article/'.$key['id']);?>">
										<div class="newsListGGContent1 fLeft"><img src="/../style/img/index/time.png" /></div>
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
						<a href="<?php echo site_url('news/article_novice');?>"><img src="/../style/img/index/novice.png" width="100%" /></a>
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
										<div class="newsListGGContent1 fLeft"><img src="/../style/img/index/time.png" /></div>
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
				<div class="clear"></div>
			<div class="row text-center">
				<nav>
					<ul class="pagination">
						<?php echo $links;?>
					</ul>
				</nav>
			</div>		
		</div>	
	
</div>

<?php $this->load->view('front/footer');?>
</body>
</html>
