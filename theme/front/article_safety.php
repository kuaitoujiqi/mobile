<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>快投机器-安全保障</title>
    <meta name="keywords" content="快投机器|安全保障" />
    <meta name="description" content="安全保障" />
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
			<a href="<?php echo site_url('news/article_safety');?>" class="active"><img src="/../style/img/article/safety_.png" height="50" /> 安全保障</a>
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
</style>				
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666">
					<div style="border-left:4px solid #00aac6;border-bottom:1px solid #888;font-size:16px;height:30px;line-height:30px;margin-bottom:20px;padding-left:10px;">安 全 保 障</div>
					<div style="width:95%;margin:20px auto;">
						<h3 class="text-center">数据安全</h3>
						<p class="text-center text-kt">多重防护，保护您的账户资金数据</p>
						<div class="row" style="width:95%;margin:50px auto 0 auto;">
							<div class="col-xs-12 col-md-6">
								<div class="pull-left" style="width:82px;margin-right:15px;"><img src="/../style/img/article/11.png" /></div>
								<div class="pull-left" style="width:262px;">
									<p class="text-kt text-center"><b>24小时系统自动监控，时时手机验证</b></p>
									<p class="text-grey">在快投机器严密的监控，一旦你的账户资金发生异常，我们可以快速发现并处理</p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="pull-left" style="width:82px;margin-right:15px;"><img src="/../style/img/article/2.png" /></div>
								<div class="pull-left" style="width:262px;">
									<p class="text-kt text-center"><b>SSL网络传输加密</b></p>
									<p class="text-grey">SSL（GlobalSign）专员24小时监控服务器安全，不让黑客威胁您的资金安全</p>
								</div>
								<div class="clear"></div>
							</div>
						</div>

						<div class="row" style="width:95%;margin:50px auto 0 auto;">
							<div class="col-xs-12 col-md-6">
								<div class="pull-left" style="width:82px;margin-right:15px;"><img src="/../style/img/article/3.png" /></div>
								<div class="pull-left" style="width:262px;">
									<p class="text-kt text-center"><b>实名认证和绑定银行卡</b></p>
									<p class="text-grey">实名认证连接公安部信息查询系统，银行卡绑定需与实名认证相符，投资提现同卡进出</p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="pull-left" style="width:82px;margin-right:15px;"><img src="/../style/img/article/4.png" /></div>
								<div class="pull-left" style="width:262px;">
									<p class="text-kt text-center"><b>手机认证和提醒</b></p>
									<p class="text-grey">提现时需要您的手机验证，此外当您账户资金发生变动时，会立刻发送短信至您的手机</p>
								</div>
								<div class="clear"></div>
							</div>
						</div>

						<div class="row" style="width:95%;margin:50px auto 50px auto;">
							<div class="col-xs-12 col-md-6">
								<div class="pull-left" style="width:82px;margin-right:15px;"><img src="/../style/img/article/5.png" /></div>
								<div class="pull-left" style="width:262px;">
									<p class="text-kt text-center"><b>数据加密存储</b></p>
									<p class="text-grey">保护您的个人隐私，防止任何人包括公司员工窃取您的账户信息</p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="pull-left" style="width:82px;margin-right:15px;"><img src="/../style/img/article/6.png" /></div>
								<div class="pull-left" style="width:262px;">
									<p class="text-kt text-center"><b>用户资金数据多重备份</b></p>
									<p class="text-grey">保障在任何状况下您账户资金的数据都不会消失</p>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<hr />
						
						<div class="row" style="width:95%;margin:0 auto;">
							<h3 class="text-center">账户安全</h3>
							<p class="text-center text-kt">资金第三方托管</p>
							<div style="margin-top:30px;">
								<div class="pull-left" style="width:123px;margin-right:20px;"><img src="/../style/img/article/7.png" /></div>
								<div class="pull-left text-grey" style="width:650px;margin-top:30px;">平台严格实行资金第三方托管，快投机器与新浪支付合作，为用户提供银行级资金安全保障，资金全程由新浪支付托管，账户分离，资金专款专用；确保投资者资金投向准确无误，杜绝资金挪用</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<hr />
						<div class="row" style="width:95%;margin:0 auto;">
							<h3 class="text-center">风险准备金机制</h3>
							<div style="margin-top:30px;">
								<div class="pull-left" style="width:123px;margin-right:20px;"><img src="/../style/img/article/8.png" /></div>
								<div class="pull-left text-grey" style="width:650px;margin-top:30px;">风险准备金机制是快投机制为保护平台全体投资人的共同权益而建立的风险保障机制。所有投资人在平台的投资行为均适用于风险准备金机制。风险准备金由快投机器提供建立，投资人无需为此支付任何费用。</div>
								<div class="clear"></div>
							</div>
							
							<div style="margin-top:50px;">
								<div class="pull-left" style="width:123px;margin-right:20px;"><img src="/../style/img/article/9.png" /></div>
								<div class="pull-left text-grey" style="width:650px;margin-top:30px;">为了保障风险备用金专款专用，快投机器风险备用金由民生银行专户管理</div>
								<div class="clear"></div>
							</div>
							
							<div style="width:90%;margin:60px auto;" class="text-grey">
								<h3>规则说明</h3>
								<hr />
								<h5 class="text-kt">1.本息保障机制的资金来源</h5>
								<p>快投机器设立风险准备金专用账户，由快投机器提供3,000,000元建立。</p>	
								
								<h5 class="text-kt">2.风险准备金的用途</h5>
								<p>若借款项目出现逾期时，先由担保方进行还款，假定担保人无法立刻偿还借款时，快投机器将启动风险准备金代偿，从风险准备金账户中提取等额的资金垫付给投资人本金和利息。之后快投机器平台再向担保方和借款企业追偿，回笼资金后存入风险准备金账户。</p>
								
								<h5 class="text-kt">3.风险准备金的规则</h5>
								<p>风险准备金使用遵循以下规则：</p>
								<p>（1）专款专用规则</p>
								<p>以快投机器的名义单独设立一个专款专用的风险准备金银行账户，并接受所有投资人的监督。</p>
								<p>（2）违约垫付规则</p>
								<p>快投机器平台所有发布的借款标，均适用于风险准备金机制。即当借款人在合同约定还款日未履行还款义务时，假定担保人无法立刻偿还借款时，快投机器将从风险准备金账户中提取等额的资金垫付给投资人，之后快投机器平台再向担保方和借款企业追偿，回笼资金后存入风险准备金账户。</p>
								<p>（3）时间顺序规则</p>
								<p>当有两笔或以上的借款发生逾期时，按债权逾期的时间顺序进行偿付，先偿付逾期在先的债权，后偿付逾期在后的债权。</p>
								<p>（4）债权比例规则</p>
								<p>即“风险准备金账户”资金对同一借款的《借款协议》项下不同出借方逾期应收赔付金额的偿付按照各债权金额占同协议内发生的债权总额的比例进行偿付分配</p>
								<p>（5）债权转移规则</p>
								<p>即当出借方享有了“风险准备金账户”对某笔借款按照既定规则进行的偿付后，快投机器平台即取得对应债权；该债权对应的借款方其后为该笔借款所偿还的全部本金、利息、违约金等归属“风险准备金账户”；如该笔受保障借款有抵押、质押或其他担保的，则快投机器平台处置抵押质押物或行使其他担保权利的所得等也归属“风险准备金账户”。</p>
								<p>（6）备付金余额不足时应急制度</p>
								<p>当风险准备金余额不足以垫付时，根据快投机器与战略合作伙伴的协议，担保机构、担保方或项目发起方必须无条件增加风险准备金并保证能按时及足额垫付给投资人。</p>
								
								<h5 class="text-kt">4.风险准备金归属及解释权</h5>
								<p>风险准备金机制最终解释权归快投机器所有</p>
								<div style="margin-top:15px;height:40px;line-height:40px;border:1px solid #ddd;text-align:center;border-radius:5px;">证明文件：专用的风险准备金账户证明文件 <a class="text-kt" href="/../style/img/zizhi/bank.png" target="_blank">点击查看</a></div>
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
