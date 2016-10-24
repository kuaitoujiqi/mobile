<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-债权转让</title>
    <meta name="keywords" content="快投机器|债权转让" />
    <meta name="description" content="债权转让" />
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
			<a href="<?php echo site_url('news/article_transfer');?>" class="active"><img src="/../style/img/article/debt_.png" height="50" /> 债权转让</a>
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
.transfer_ul{
	list-style-type:disc;
	color:#00aac6;
	font-size:18px;
}
.transfer_ul li{
	margin-top:20px;
}
.transfer_ul p{
	color:#888;
	font-size:14px;
	line-height:30px;
}
</style>				
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666">
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">债 权 转 让</div>
					
					<div style="width:98%;margin:20px auto;">
						<div><img src="/../style/img/article/transfer.png" /></div>
						<div style="width:100%;margin:50px auto 0 auto;">
							<div style="border-bottom:1px solid #888;">
								<h4>关于债权市场</h4>
							</div>
							
							<div class="row" style="margin:30px auto;">
								<div class="col-xs-12 col-md-7" style="margin-top:25px;">
									<p style="text-indent:20px;color:#888;line-height:30px;">快投机器“债权转让服务”是指为已在快投机器平台投资的快投机器注册用户，可将符合相关条件的债权转让给其他快投机器注册用户，由快投机器平台为债权出让人和债权受让人双方提供的中介服务。</p>
								</div>
								<div class="col-xs-12 col-md-5">
									<img src="/../style/img/article/transfer2.png" width="381" />
								</div>								
							</div>
							
							<div style="border-bottom:1px solid #888;">
								<h4>债权转让细则</h4>
							</div>
							
							<div style="width:95%;margin:20px auto;">
								<div style="color:#888;font-size:14px;line-height:30px;">
									<ul class="transfer_ul">
										<li>
											<h4 class="text-kt">"快投机器债权转让服务"中的各方</h4>
											<p>● 债权出让人</p>
											<p>债权出让人，通过快投机器债权转让服务”，将借款债权以一定价格转让给债权受让人，债权出让人得以提前回收资金。</p>
											<p>● 债权受让人</p>
											<p>债权受让人，可通过快投机器债权转让服”，以一定价格受让借款债权，并有权获得借款人定期支付的还款本息。</p>
											<p>● 借款人</p>
											<p>在借款债权的转让生效日前后，借款人的相关权益及责任将不受影响。借款人需按《网络借款协议》中相关规定定期还本付息，快投机器会将借款人的还款通过新浪支付划拨到当前债权人的账户。</p>
										</li>									
										<li>
											<h4 class="text-kt">转让条件</h4>
											<p>为保障债权出让人和债权受让人双方的权益以及交易秩序，现对快投机器平台（www.kuaitoujiqi.com）提供的快投机器债权转让服务”作出如下规定：</p>
											<p>借款债权必须符合以下条件才可申请转让</p>
											<p>1. 债权出让人持有该借款债权至少已满60天；</p>
											<p>2. 在转让申请日，该借款债权不能处于逾期状态；</p>
											<p>3. 快投机器届时合理要求的其他条件。</p>
										</li>									
										<li>
											<h4 class="text-kt">债权出让人向快投机器提交转让申请的规则</h4>
											<p>1. 转让申请日应为一个非还款日/结息日且至少在下一个还款日/结息日的7天之前；</p>
											<p>2. 债权出让人在提交转让申请后的转让时效内未达成转让的，债权出让人同意快投机器自动撤销该转让申请。转让时效为24小时。</p>
											<p>3. 债权出让人在提交转让申请后，有权在转让未达成前，手动撤销转让申请；</p>
											<p>4. 债权出让人提交的转让申请属于要约，除依上述第2款、第3款的约定撤销外，转让申请不得撤销；一旦债权受让人接受债权出让人提交的转让申请，转让交易即达成，对债权出让人和债权受让人产生法律约束力；</p>
											<p>5. 快投机器有权对债权出让人提交的转让申请进行审核，以确保该等申请符合法律法规及快投机器交易规则的要求。</p>
											<p>6. 每个债权仅能转让一次。</p>
											<p>7. 债权可拆分转让，但只能拆分一次，拆分转让债权的，债权总金额不得低于2万元，每笔拆分金额不得低于总金额的50%。</p>
										</li>
										<li>
											<h4 class="text-kt">债权出让人申请转让价格的设定方式：</h4>
											<p>自定义价格转让</p>
											<p>债权出让人可以自定义转让价格，转让价格=债权本金 - 折让金；折让金区间：债权本金0%-20%。</p>
											<p>借款债权转让对该笔借款债权本身的影响</p>
											<p>在借款债权的转让生效日前后，仅债权人发生变更，对该借款债权本金余额、年化利率、还款方式、逾期还款、提前还款等相关事项均不造成影响。</p>
										</li>
										<li>
											<h4 class="text-kt">服务收费</h4>
											<p>快投机器提供债权转让服务有权向债权出让人和债权受让人双方收取一定的服务费用（具体收费规则、标准请关注快投机器网站收费公告）。</p>
										</li>
										<li>
											<h4 class="text-kt">风险提示</h4>
											<p>快投机器债权转让服务仅为快投机器向债权出让人和债权受让人双方提供的中介服务。该服务项下的借款债权转让活动涉到资金和权益的处分，由此带来的潜在风险需要债权出让人和债权受让人自行衡量和承担。个人借款债权转让主要风险包括但不限于：</p>
											<p>债权出让人的主要风险</p>
											<h5>1. 转让失败风险</h5>
											<p>快投机器债权转让服务仅为债权出让方和受让方提供中介服务，并不承诺为每一个债权出让人成功完成转让。因此，在转让申请的预期时效内，出让人有债权无法成功转让的风险。</p>
											<h5>2. 损失部分利息或部分借款债权本金余额</h5>
											<p>如果出让人设定的转让价格大于借款债权本金余额但小于借款债权本金余额与当期至今利息之和，出让人将损失部分利息。当期至今利息指上一结息日次日至转让生效日期间应收的利息。</p>
											<h5>3. 债权受让人的主要风险</h5>
											<p>债权受让人面临的风险与原出借人面临风险等同，详情请参见<a href="<?php echo site_url('news/article/74');?>" target="_blank">《快投机器注册服务协议》</a>。</p>
										</li>
									</ul>
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
