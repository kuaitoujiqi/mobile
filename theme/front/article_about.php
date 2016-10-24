<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-关于我们</title>
    <meta name="keywords" content="快投机器|关于我们" />
    <meta name="description" content="关于我们" />
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

			<a href="<?php echo site_url('news/article_about');?>" class="active"><img src="/../style/img/article/about_.png" height="50" /> 关于我们</a>
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
			<a href="<?php echo site_url('news/article_contact');?>"><img src="/../style/img/article/contact.png" height="50" /> 联系我们</a>
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
.mode_ul{
	list-style-type:disc;
	color:#00aac6;
	font-size:18px;
}
.mode_ul li{
	margin-top:20px;
}
.mode_ul p{
	color:#888;
	font-size:14px;
	line-height:30px;
}
</style>	
<link rel="stylesheet" href="<?php echo base_url();?>style/css/lightbox.css">
<script src="<?php echo base_url();?>style/js/lightbox-plus-jquery.js"></script>
			
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666">
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">关 于 我 们</div>
				
					<div style="width:98%;margin:20px auto;">
						<div><img src="/../style/img/article/about1.png" /></div>
						<div style="width:90%;margin:50px auto 0 auto;">
							<ul class="mode_ul">
								<li>
									<h4 style="margin-bottom:20px;">公 司 简 介</h4>
									<div class="row">
										<div class="col-md-8">
											<p style="text-indent:20px;">
												<span style="font-size:30px;">快</span>投机器平台（www.kuaitoujiqi.com）成立于2015年9月，由北京泰恒长隆网络科技有限公司建设并运营，是主要专注于供应链金融模式，风控严谨，制度完善，交易系统安全。作为成熟投资人选择的安全投资平台，快投机器与新浪第三方支付进行合作，支付端做到独立与隔离，保障资金通道效率与安全 <a href="<?php echo site_url('news/article_safety');?>">>>点击查看 安全保障</a>，资产端通过与大中型企业、集团公司等核心企业，第三方担保公司、资产管理公司、银行等金融机构合作，同时与专业的律师事务所以及会计事务所全程合作 <a href="<?php echo site_url('news/article_partener');?>">>>点击查看 合作伙伴</a>，打造高端的互联网金融平台模式，为投资人提供全方位的投资安全保障。
											</p>
										</div>
										<div class="col-md-4" style="margin-top:30px;">
											<p><img src="/../style/img/zizhi/about_1.png" /></p>
										</div>
									</div>									
								</li>
								<li>
									<h4 style="margin-bottom:20px;">供 应 链 金 融</h4>
									<div class="row">
										<div class="col-md-4" style="margin-top:100px;">
											<p><img src="/../style/img/zizhi/about_2.png" /></p>
										</div>									
										<div class="col-md-8">
											<p style="text-indent:20px;"><span style="font-size:30px;">供</span>应链金融是目前快投机器平台推出的主要融资产品，平台首先对核心企业进行精心的筛选和全方位的审查，再对根据通过申请或者核心企业推荐的供应链上下游企业进行借款风控审查 <a href="<?php echo site_url('news/article_control');?>">>>点击查看 风控体系</a>，并且由核心企业为供应链企业提供担保。除此之外，平台对供应链所涉行业也会有整体的评估，对供应链整体和局部都做出分析，做到对借款项目的全方位的整体把控，避免了只对借款企业的单一审查而产生的局限。</p>
											<p style="text-indent:20px;">除此之外，平台还将提供商户贷和机构金融项目等精品项目供投资者选择，在做到提供专业投资产品的同时，也为投资用户提供多元化的选择。总之，清晰便捷的投资流程，专业化与多元化并存的投资产品，是快投机器的服务宗旨 <a href="<?php echo site_url('news/article_mode');?>">>>点击查看 平台模式</a></p>
										</div>
									</div>									
								</li>
								<li>
									<h4 style="margin-bottom:20px;">企 业 优 选 计 划</h4>
									<div class="row">								
										<div class="col-md-8">
											<p style="text-indent:20px;"><span style="font-size:30px;">平</span>台推出的每个项目的安全性和质量都有很大的保障，这就是平台推出的“企业优选计划”，我们提供给投资人的是精品项目，所有项目做到最大程度的透明披露，免去投资人对投资项目安全的忧虑，可以在快节奏的工作和生活当中快速的、机器化精准筛选投资项目，获得预期的投资收益。另外，投资者在急于收回资金的时候，可以通过平台提供的债权转让服务 <a href="<?php echo site_url('news/article_transfer');?>">>>点击查看 债权转让</a>进行转让债权，及时回笼资金。</p>
										</div>
										<div class="col-md-4">
											<p><img src="/../style/img/zizhi/about_3.png" /></p>
										</div>											
									</div>									
								</li>
								<li>
									<h4 style="margin-bottom:20px;">风 险 准 备 金</h4>
									<div class="row">
										<div class="col-md-4">
											<p><img src="/../style/img/zizhi/about_4.png" /></p>
										</div>									
										<div class="col-md-8">
											<p style="text-indent:20px;"><span style="font-size:30px;">平</span>台在通过严格把控项目质量的同时，不忽略经济波动或者政策指向等因素带来的投资风险，平台通过建立风险准备金制度 <a href="<?php echo site_url('news/article_safety');?>">>>点击查看 安全保障</a>，在借款人出现违约时，在第一时间为投资人补充资金，投资者债权从而转移给平台，平台再去向借款人追索，这样就避免了追索期给投资人带来的损失。</p>
										</div>
									</div>									
								</li>
								<li>
									<h4 style="margin-bottom:20px;">公 司 资 质</h4>
									<div class="dealImgFrame">
									<!----
										<a class="thumbnail" data-lightbox="certificate" href="/../style/img/zizhi/1.jpg" style="margin-right:20px;">
											<img src="/../style/img/zizhi/1.jpg" style="width:150px;">
										</a>
									
										<a class="thumbnail" data-lightbox="certificate" href="/../style/img/zizhi/2.jpg" style="margin-right:20px;">
											<img src="/../style/img/zizhi/2.jpg" style="width:150px;">
										</a>
										----->		
										<a class="thumbnail" data-lightbox="certificate" href="/../style/img/zizhi/3.jpg">
											<img src="/../style/img/zizhi/3.jpg" style="width:150px;">
										</a>										
									</div>							
								</li>
							</ul>
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
