<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-费用标准</title>
    <meta name="keywords" content="快投机器|费用标准" />
    <meta name="description" content="费用标准" />
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
			<a href="<?php echo site_url('news/article_fee');?>" class="active"><img src="/../style/img/article/fee_.png" height="50" /> 费用标准</a>
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
.mode_ul table{
	color:#888;
	border-collapse: separate;
    border-spacing: 10px 10px;	
	font-size:13px;
	border:1px solid #00aac6;
}
.mode_ul table tr td{
	background:#f4f4f4;
	color:#888;
	padding:10px;
	
}
.mode_ul table tr:nth-of-type(1) td{
	background:#00aac6;
	color:#fff;
	padding:10px;
}
</style>				
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666">
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">费 用 标 准</div>
					
					<div style="width:98%;margin:20px auto;">
						<div style="width:90%;margin:50px auto 0 auto;">
							<ul class="mode_ul">
								<li>
									<h4>收费一览表</h4>
									<p>
										<table class="fee_table text-center" width="100%" height="" >
											<tr>
												<td colspan="2"></td>
												<td>收费标准</td>
											</tr>
											<tr>
												<td rowspan="4" style="background:#d9f2f7;">投资用户</td>
												<td>投资管理</td>
												<td>暂不收取</td>
											</tr>
											<tr>
												<td>利息管理</td>
												<td>暂不收取</td>
											</tr>
											<tr>
												<td>提现</td>
												<td>每日首次提现免费，再次及多次提现每笔1.5元手续费</td>
											</tr>
											<tr>
												<td>债权转让</td>
												<td>*债权持有60日后，可申请债权转让，债权转让费用为转让本金的0.5%</td>
											</tr>
										</table>
									</p>
								</li>
								<li style="margin-top:30px;">
									<h4>提现到账时间</h4>
									<p>由于货币基金（新浪微钱包）的结算周期约为每日下午4点-6点，快投机器无法实现当日提现当日到账</p>								
									<p><span class="text-danger">*</span> T+1：当日下午3点前提现，次日到账</p>								
									<p><span class="text-danger">*</span> T+2：当日下午3点后提现，第三日到账</p>								
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
