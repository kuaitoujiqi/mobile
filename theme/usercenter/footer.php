	<!--底部开始-->
	<div class="foot">
		<!-- <div style="background:#00ddf9;height:2px;margin:0px auto 10px auto;"></div> -->
		<div class="foot_center gy">
			<div class="foot_nav">
			<ul>
			<li><h1>关于我们</h1>
			<p><a href="<?php echo site_url('news/article/75');?>">公司简介</a></p>
			<!--<p><a href="<?php echo site_url('news/article/76');?>">联系我们</a></p>-->
			<!--<p><a href="about.html">加入我们</a></p>-->
			</li>
			<li>
			<h1>产品服务</h1>
			<p><a href="<?php echo site_url('news/article/6');?>">产品介绍</a></p>
			<p><a href="<?php echo site_url('news/article/73');?>">安全保障</a></p>
			<p><a href="<?php echo site_url('news/newslist/3');?>">媒体报道</a></p>
			<p><a href="tz_link.html">友情链接</a></p>
			</li>
			<li>
			<h1>帮助中心</h1>
			<p><a href="<?php echo site_url('news/newslist/7');?>">常见问题</a></p>
			<p><a href="<?php echo site_url('news/article/74');?>">服务协议</a></p>
			</li>
			<li>
			<h1>联系我们</h1>
			<p><a href="<?php echo site_url('news/article/76');?>">客服电话</a></p>
			<p><a href="<?php echo site_url('news/article/76');?>">客服邮箱</a></p>
			<p><a href="<?php echo site_url('news/article/76');?>">我要合作</a></p>
			</li>
			</ul>
			</div>
			<div class="foot_gz">
			<div class="foot_gz_top">关于我们</div>
			<div class="foot_gz_list">
			<ul>
			<li><a data-toggle="modal" data-target="#weixinModal" style="cursor:pointer"><img src="<?php echo base_url();?>style/img/footer/foot_weixin.jpg"  /><p>微信公众号</p></a></li>
			<li><a href="http://weibo.com/p/1006065833446993" rel="nofollow" target="_blank"><img src="<?php echo base_url();?>style/img/footer/foot_weibo.jpg"  /><p>新浪微博</p></a></li>
			</ul>
			</div>
			</div>
			<div class="foot_right">
			<div class="foot_gz_top">客服热线</div>
			<div class="foot_right_tel">
			  <img src="<?php echo base_url();?>style/img/foot_tel.png"  /> </div>
			  
			  <div class="foot_gz_top">服务时间</div>
			  <p>周一至周五  9:00-18:00</p>
			</div>
		</div>
		<div class="foot02">
			
			<div class="foot02_img">
				<img src="<?php echo base_url();?>style/img/footer/foot_pic01.jpg" />
				<img src="<?php echo base_url();?>style/img/footer/foot_pic02.jpg" />
				<img src="<?php echo base_url();?>style/img/footer/foot_pic03.jpg" />
				<img src="<?php echo base_url();?>style/img/footer/foot_pic04.jpg" />
				<img src="<?php echo base_url();?>style/img/footer/foot_pic05.jpg" />
				<div style="clear:both;"></div>
			</div>
			<div style="margin-top:20px;">
				<p style="margin:0;">©2015-2017 版权归属快投机器P2P投资平台所有    |     京ICP备15056810号-2    |    北京泰恒长隆网络科技有限公司</p>
				<p style="margin:0;">Copyright ©2015-2017 TaiHengChanglong Corporation, All Rights Reserved</p>
			</div>
		</div>
	</div>
	<!--底部结束-->
	
<!--<div class="foot">
    <div class="container">
        <div class="row" style="margin-top: 20px">
            <p class="col-lg-9 foot_nav">
                <a href="<?php echo site_url('news/article/9');?>">关于我们</a>
                <b>|</b>
                <a href="<?php echo site_url('news/article/6');?>">平台模式</a>
                <b>|</b>
                <a href="<?php echo site_url('news/article/8');?>">安全保障</a>
                <b>|</b>
                <a href="<?php echo site_url('news/article/7');?>">新手引导</a>
                <b>|</b>
                <a href="<?php echo site_url('news/newslist/7')?>">帮助中心</a>
                <b>|</b>
                <a href="<?php echo site_url('news/article/10');?>">联系我们</a>
            </p>
            <p class="col-lg-3">
                <span>关注我们：</span>
                <a href="http://weibo.com/u/5619033805" rel="nofollow" target="_blank"><img src="<?php echo base_url();?>style/img/foot_weibo.png"/></a>
                <a data-toggle="modal" data-target="#weixinModal" style="cursor:pointer"><img src="<?php echo base_url();?>style/img/foot_weixin.png" /></a>
            </p>
        </div>
        <div class="row" style="padding-top: 10px;padding-bottom: 10px;">
            <div class="col-lg-1">
                友情链接：
            </div>
            <div class="col-lg-8 friend_link">
            <?php $yqlj = yqlj();
				foreach($yqlj as $key)
				{
			?>
                <a href="<?php echo $key['url'];?>" target="_blank">
                    <?php echo $key['name'];?>
                </a>
     		<?php }?>
            </div>
            <div class="col-lg-3">
                <p style="font-size: 22px;font-weight: bold;margin-bottom: 0px;"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> 400-999-7956</p>
                <p style="margin-left: 30px;">（工作时间：9:00-17:00）</p>
                <p style="font-size: 16px;font-weight: bold;"><span class="glyphicon glyphicon-headphones" aria-hidden="true"></span> 在线客服</p>
            </div>
        </div>

        <div class="row" style="border-top: 1px solid #5a5a5a;padding: 20px 0;margin-left: 0">
            <div class="pull-left">
                
            </div>
            <div class="pull-left" style="margin-left: 15px">
                <p style="margin-bottom: 5px"><?php /*?><a href="http://webscan.360.cn/index/checkwebsite/url/www.kuaitoujiqi.com"><img border="0" src="http://img.webscan.360.cn/status/pai/hash/1a4da25a35c98cf05c2677b4f7528a91"/></a><?php */?> <script language="javascript" type="text/javascript" src="//smarticon.geotrust.com/si.js"></script>
<a target="_blank" href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action"> 沪ICP备15014079号-1</a></p>
                <p>© 2014 kuaitoujiqi.com  |  上海金椰金融信息服务有限公司 <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1255522926'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1255522926' type='text/javascript'%3E%3C/script%3E"));</script></p>
            </div>
        </div>
    </div>
</div>-->

    <div class="modal fade" id="weixinModal" tabindex="-1" role="dialog" aria-labelledby="weixinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">关注快投机器官方微信</h4>
                </div>
                <div class="modal-body">
                	<center>
                   <img src="<?php echo base_url();?>style/img/weixin_foot.jpg" width="258" height="258" />
                   </center>
                </div>
                
            </div>
        </div>
    </div>

