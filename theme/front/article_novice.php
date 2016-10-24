<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-新手指引</title>
    <meta name="keywords" content="快投机器|新手指引" />
    <meta name="description" content="新手指引" />
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
			<a href="<?php echo site_url('news/article_novice');?>" class="active"><img src="/../style/img/article/novice_.png" height="50" /> 新手指引</a>
			<a href="<?php echo site_url('news/newslist/1');?>"><img src="/../style/img/article/repay.png" height="50" /> 还款公告</a>
			<a href="<?php echo site_url('news/newslist/11');?>"><img src="/../style/img/article/website.png" height="50" /> 网站公告</a>
			<a href="<?php echo site_url('news/newslist/3');?>"><img src="/../style/img/article/media.png" height="50" /> 媒体报道</a>
			<a href="<?php echo site_url('news/newslist/7');?>"><img src="/../style/img/article/help.png" height="50" /> 帮助中心</a>
			<a href="<?php echo site_url('news/article_contact');?>"><img src="/../style/img/article/contact.png" height="50" /> 联系我们</a>
        </div>

        <div class="col-xs-12 col-md-10">
            <div class="about_con clearfix">

<style>
.clear{
	clear:both;
}
.new_content p{
	color:#888;
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
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">新 手 指 引</div>
				
					<div style="width:98%;margin:20px auto;">
						<div><img src="/../style/img/article/x1.png" width="100%" /></div>
						<div style="width:100%;margin:50px auto 0 auto;">
							<div style="border-bottom:1px solid #888;">
								<h4>什么是供应链金融？</h4>
							</div>
							
							<div class="row" style="margin:30px auto;">
								<div class="col-xs-12 col-md-3">
									<img src="/../style/img/article/x2.png" width="183" />
								</div>
								<div class="col-xs-12 col-md-9" style="margin-top:30px;">
									<p style="text-indent:20px;">快投机器凭借多年金融行业背景，在国内首创供应链合规模式的P2P网贷平台，将借款方锁定大中型企业、集团公司等核心企业，为其上下游供应商和分销商，子公司、合作伙伴和其他关联公司提供整合型征信的新型融资方式。这些企业有着良好的实体经营，有发展前景的项目，有能提供固定资产抵押，同时有借款需求以促进自己的高速发展。</p>
								</div>
							</div>
							
							<div style="border-bottom:1px solid #888;">
								<h4>为什么选择供应链金融？</h4>
							</div>
							
							<div class="row text-center" style="margin:30px auto;">
								<div class="col-xs-12 col-md-3"><img src="/../style/img/article/x3.png" width="96"/></div>
								<div class="col-xs-12 col-md-3"><img src="/../style/img/article/x4.png" width="115"/></div>
								<div class="col-xs-12 col-md-3"><img src="/../style/img/article/x5.png" width="93"/></div>
								<div class="col-xs-12 col-md-3"><img src="/../style/img/article/x6.png" width="70"/></div>
							</div>	
							<div class="row text-center">
								<div class="col-xs-12 col-md-3">
									<h4>背景好</h4>
									<p>核心企业  政府资源</p>
									<p>供应链金融掌握关键</p>
								</div>
								<div class="col-xs-12 col-md-3">
									<h4>风控严</h4>
									<p>多层次风险保障机制</p>
									<p>高标准机构准入门槛</p>
									<p>严格担保总额控制</p>									
									<p>严密风险监控</p>									
								</div>
								<div class="col-xs-12 col-md-3">
									<h4>收益稳健</h4>
									<p>多种期限 任意选择</p>
									<p>100元起投?灵活投资?</p>											
									<p>10%-18%超高稳定收益</p>											
								</div>
								<div class="col-xs-12 col-md-3">
									<h4>资金安全</h4>
									<p>256位全程交易加密</p>
									<p>新浪支付品牌资金托管</p>											
									<p>核心企业全额本息保障</p>											
								</div>
							</div>									

							<div style="border-bottom:1px solid #888;">
								<h4>如何投资？</h4>
							</div>	
								
							<div style="width:95%;margin:30px auto;">
								<div>
									<div style="background:#fefefe;color:#fff;width:688px;padding-left:10px;border:1px solid #00aac6;margin-bottom:10px;">
										<h5 style="height:30px;line-height:30px;color:#00aac6;">1.注册</h5>
									</div>
									<div>
										<img src="/../style/img/article/x8.png" />
									</div>
								</div>
								
								<div style="margin-top:30px;">
									<div style="background:#fefefe;color:#fff;width:675px;padding-left:10px;border:1px solid #00aac6;margin-bottom:10px;">
										<h5 style="height:30px;line-height:30px;color:#00aac6;">2.账户</h5>
									</div>
									<div>
										<img src="/../style/img/article/x9.png" />
									</div>
								</div>
								
								<div style="margin-top:30px;">
									<div style="background:#fefefe;color:#fff;width:694px;padding-left:10px;border:1px solid #00aac6;margin-bottom:10px;">
										<h5 style="height:30px;line-height:30px;color:#00aac6;">3.投资</h5>
									</div>
									<div>
										<img src="/../style/img/article/x10.png" />
									</div>

								</div>
								
								<div style="margin-top:30px;">
									<div style="background:#fefefe;color:#fff;width:693px;padding-left:10px;border:1px solid #00aac6;margin-bottom:10px;">
										<h5 style="height:30px;line-height:30px;color:#00aac6;">4.支付</h5>
									</div>									
									<div>
										<img src="/../style/img/article/x11.png" />
									</div>
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
