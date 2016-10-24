<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理中心</title>
<link href="<?php echo static_url();?>css/css.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?php echo static_url();?>js/jquery.js"></script>
<script language="javascript" src="<?php echo static_url();?>js/back.js"></script>
</head>

<body>
<div class="top">
	<div class="topleft"><img src="<?php echo static_url();?>img/logo.png" width="150" height="46" /></div>
    <div class="topcenter">
   	  <ul class="bigmenu">
      		<?php foreach($menulist as $val =>$key){
				if($key['pid'] == 0){
			?>
            <li <?php if($val==0){?>class="hover"<?php }?>><?php echo $key['name'];?></li>
            <?php }
			}
			?>
      </ul>
    </div>
  <div class="topright">欢迎登录,'<?php echo $user['name']; ?>' [<a url="<?php echo admin_url('main/index');?>" style="cursor:pointer" id="htindex">后台首页</a>] [<a href="<?php echo base_url();?>" target="_blank">前台首页</a>] [<a href="<?php echo admin_url('welcome/exit_login');?>">退出</a>]</div>
</div>
<div class="main">
	<div class="left">
     	<div class="title"><img src="<?php echo static_url();?>img/bt.png"  width="9" height="9"/> <span>个人中心</span></div>
    	<?php 
		$data = -1;
		foreach($menulist as $val =>$key){
			if($key['pid'] == 0){
			$data = $data -(-1);	
		?>
		<div id="l<?php echo $data?>" class="leftmenu" <?php if($val >0){?>style="display:none"<?php }?>>
        <dl data="<?php echo $data?>">
            <?php foreach($menulist as $key_s){
				if($key_s['pid'] == $key['id']){
			?>
            <dd url="<?php echo admin_url($key_s['uri']);?>"><?php echo $key_s['name'];?></dd>
            <?php } }?>
    	</dl>
        </div>
		<?php } }?>
        
    </div>
    <div class="right">
    	<div class="righttab">
			<span>后台首页</span>
        </div>
        <div class="rightcon">
        	<iframe src="<?php echo admin_url('main/index');?>" id="iframe"></iframe>
        </div>
    </div>
</div>


</body>
</html>
