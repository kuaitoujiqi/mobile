<div id="morehead">
	<div class="container has-feedback">
    	<?php $userinfo = userinfo();?>
    	<a href="<?php echo site_url('m/usercenter/recharge')?>"><div class="pull-left">充值</div></a>
        <div class="text-center">我的账号<small>（<?php echo $userinfo['nickname'];?>）</small></div>
        <div class="wdzh"><a href="<?php echo site_url('m/usercenter')?>"><span class="glyphicon glyphicon-user " ></span></a></div>
    </div>
</div>
<?php /*?><div class="container wallet_nav_bar">
    <div class="row">
        <a href="<?php echo site_url('m/usercenter/recharge');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-save"></span> <br>充值</div></a>
        <a href="<?php echo site_url('m/usercenter/withdraw');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-open"></span> <br>提现</div></a>
        <a href="<?php echo site_url('m/usercenter/info');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-comment"></span> <br>消息中心</div></a>
        <a href="<?php echo site_url('m/usercenter/binding');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-credit-card"></span> <br>银行卡</div></a>
    </div>
    <div class="row">
        <a href="<?php echo site_url('m/usercenter/record');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-th-list"></span> <br>账单</div></a>
         <a href="<?php echo site_url('m/usercenter/safe');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-tower"></span> <br>安全中心</div></a>
         <a href="<?php echo site_url('m/usercenter');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-fire"></span> <br>账户总览</div></a>
        <a href="<?php echo site_url('m/welcome/exit_login');?>"><div class="col-xs-3"><span class="glyphicon glyphicon-log-out"></span> <br>退出登录</div></a>
    </div>
</div><?php */?>