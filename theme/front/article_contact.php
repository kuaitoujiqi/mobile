<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-联系我们</title>
    <meta name="keywords" content="快投机器|联系我们" />
    <meta name="description" content="联系我们" />
    <link href="" rel="apple-touch-icon-precomposed">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
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
        })
	$(function(){
		$('.about_nav').find("a").not(".active").hover(function(){
			var imgSrc = $(this).find("img").attr("src");
			var srcArr = imgSrc.split(".");
			srcArr[2] = srcArr[2]+"_";
			var src;
			src = srcArr.join(".");
			$(this).css("color","#00aac6");
			 $(this).find("img").attr("src",src);
		},function(){
			var imgSrc = $(this).find("img").attr("src");
			var srcArr = imgSrc.split("_");
			var src;
			src = srcArr.join("");
			 $(this).find("img").attr("src",src);	
			 $(this).css("color","#666");
		})		
		
	})
    </script>
</head>
<body class="grey_body">
<?php $this->load->view('front/header');?>

<div class="container">
    <div class="row">	
        <div class="col-xs-12 col-md-2 about_nav">	

			<a href="<?php echo site_url('news/article_about');?>"><img src="/../style/img/article/about.png" height="50" /> 关于我们</a>
			<a href="<?php echo site_url('news/article_safety');?>"><img src="/../style/img/article/safety.png" height="50" /> 安全保障</a>
			<a href="<?php echo site_url('news/article_control');?>"><img src="/../style/img/article/control.png" height="50" /> 风控体系</a>
			<a href="<?php echo site_url('news/article_mode');?>"><img src="/../style/img/article/platform.png" height="50" /> 平台模式</a>
			<a href="<?php echo site_url('news/article_transfer');?>"><img src="/../style/img/article/debt.png" height="50" /> 债权转让</a>
			<a href="<?php echo site_url('news/article_partener');?>"><img src="/../style/img/article/cooperation.png" height="50" /> 合作伙伴</a>
			<a href="<?php echo site_url('news/article_fee');?>"><img src="/../style/img/article/fee.png" height="50" /> 费用标准</a>
			<a href="<?php echo site_url('news/article_novice');?>"><img src="/../style/img/article/novice.png" height="50" /> 新手指引</a>
			<a href="<?php echo site_url('news/newslist/1');?>"><img src="/../style/img/article/repay.png" height="50" /> 还款公告</a>
			<a href="<?php echo site_url('news/newslist/11');?>"><img src="/../style/img/article/website.png" height="50" /> 网站公告</a>
			<a href="<?php echo site_url('news/newslist/3');?>"><img src="/../style/img/article/media.png" height="50" /> 媒体报道</a>
			<a href="<?php echo site_url('news/newslist/7');?>"><img src="/../style/img/article/help.png" height="50" /> 帮助中心</a>
			<a href="<?php echo site_url('news/article_contact');?>" class="active"><img src="/../style/img/article/contact_.png" height="50" /> 联系我们</a>
        </div>

        <div class="col-xs-12 col-md-10">
            <div class="about_con clearfix">

<style>
.new_content p{
}
.new_content img{
	width:100%;
}
.clear{
	clear:both;
}
.text-kt{
	color:#00aac6;
}
.text-grey{
	color:#aaa;
}
.text-dgrey{
	color:#888;
}
</style>				
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666">
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">联 系 我 们</div>
					
					<div style="width:98%;margin:20px auto;">
						<div><img src="/../style/img/article/g1.png" /></div>
						
						<div style="width:80%;margin:0 auto;">
							<div style="margin-top:30px;">
								<h4 class="text-info">公 司 地 址</h4>
								<p class="text-dgrey">地址：北京市海淀区紫竹院路广源闸5号6层6138</p>
								<p class="text-dgrey">电话：010-52806303</p>
								<p class="text-dgrey">邮编：100081</p>
							</div>
							<div style="margin-top:30px;">
								<h4 class="text-info">客服电话</h4>
								<p class="text-dgrey">客服热线：400 677 7505（免长途费），周一至周五 9:00-18:00</p>
								<p class="text-dgrey">在线客服：点击右侧在线客服按钮与客服进行即时在线沟通</p>
								<p class="text-dgrey">客服邮箱：<span class="text-info">service@kuaitoujiqi.com</span></p>
							</div>
							<div style="margin-top:30px;">
								<h4 class="text-info">媒 体 采 访</h4>
								<p class="text-dgrey">媒体采访邮箱：</p>
								<p class="text-info">weiweiguang@kuaitoujiqi.com</p>
							</div>
							<div style="margin-top:30px;">
								<h4 class="text-info">市 场 合 作</h4>
								<p class="text-dgrey">网络推广合作邮箱：</p>
								<p class="text-info">longlong@kuaitoujiqi.com</p>
							</div>
							<div style="margin-top:30px;">
								<h4 class="text-info">战 略 发 展</h4>
								<p class="text-dgrey">金融产品合作邮箱：</p>
								<p class="text-info">longlong@kuaitoujiqi.com</p>
							</div>
							<div style="margin-top:30px;">
								<h4 class="text-info">其 他 联 系</h4>
								<div class="row">
									<div class="col-xs-12 col-md-2 text-center">
										<p><img src="/../style/img/weixin_foot.jpg" width="100" /></p>
										<p>微信</p>
									</div>
									<div class="col-xs-12 col-md-2 text-center">
										<p><img src="/../style/img/weibo.png" width="100" /></p>		
										<p>新浪微博</p>	
									</div>
									<div class="col-xs-12 col-md-2 text-center">
										<p>官方QQ群</p>
									</div>
									<div class="col-xs-12 col-md-3">
										<p>①：367770726</p>
										<p>②：321414036</p>
										<p>③：493842008</p>
										<p>④：494717113</p>										
									</div>
									<div class="col-xs-12 col-md-3"></div>
								</div>
							</div>
						</div>
						
					</div>
					
					
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front/footer');?>
</body>
</html>
