<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-平台模式</title>
    <meta name="keywords" content="快投机器|平台模式" />
    <meta name="description" content="平台模式" />
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
			<a href="<?php echo site_url('news/article_mode');?>" class="active"><img src="/../style/img/article/platform_.png" height="50" /> 平台模式</a>
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
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666">
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">平 台 模 式</div>
					
					<div style="width:98%;margin:20px auto;">
						<div><img src="/../style/img/article/p1.png" /></div>
						<div style="width:90%;margin:50px auto 0 auto;">
							<ul class="mode_ul">
								<li>
									<h4>供 应 链 金 融</h4>
									<p style="text-indent:20px;">平台优选并整合优质的供应链，以其核心企业为重点，为其上下游关联企业提供融资服务。</p>
									<p style="text-indent:20px;">对中坚企业要求为优质行业（国家不提倡贷款的行业不予考虑），其规模应为中等以上企业，在当地应有一定的影响力和美誉度。企业资产规模不小于1000万元</p>
								</li>
								<li>
									<h4>商 户 金 融</h4>
									<p style="text-indent:20px;">平台精选推出拥有商铺（或厂房）、房产、车辆的商户专属借款项目。以房产、车辆为抵押或质押品，以合作机构为担保回购方。商户金融为投资用户提供双重保障，一为资产保证，抵押品不得高于评估价值的70%；二为合作机构所承担的担保回购责任，一旦借款商户逾期未还，则此债权转移至合作机构，由合作机构代偿投资用户本息。</p>								
								</li>
								<li>
									<h4>机 构 金 融</h4>
									<p style="text-indent:20px;">针对资产管理公司、典当行、小贷公司等金融机构所提供的抵押、质押债权资产包借款项目。用于金融机构项目资金补充，借款方为金融机构、以其所提供资产包为质押。如其相关借款资产产权人发生逾期或坏账，则由此金融机构进行代偿。</p>	
								</li> 
								<li>
									<h4>流 程 图</h4>
									<div style="width:80%;margin:0 auto;"><img src="/../style/img/article/p2.png" /></div>
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
