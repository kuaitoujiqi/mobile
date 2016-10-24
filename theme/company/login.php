<!DOCTYPE html>
<html>
<head>
<title>快投机器企业登录系统</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="keywords" content="快投机器企业登录系统">
<meta name="discription" content="快投机器企业登录系统">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/company/css/common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/company/css/system.css" />
</head>
<body id="loginpage">
	<div id="login" class="clearfix">
		<div class="main clearfix">
			<div class="logbox">
				<div class="header">
					快投机器企业用户登录系统
				</div>
				<div class="web_login" id="web_login">
					<form id="loginform"  name="loginform" action="" method="post">
						<div class="inputOuter" style="background:none; height:10px; margin:15px 0px">
                        	请输入企业全称
                        </div>
                        <div class="inputOuter">
                            <input type="text" class="inputstyle" id="u" name="u" value="" tabindex="1">
                        </div>
                        <div class="inputOuter" style="background:none; height:10px;margin:15px 0px">
                        	请输入密码
                        </div>
						<div class="inputOuter">
                            <input type="password" class="inputstyle password" id="p" name="p" value="" maxlength="16" tabindex="2"> 
                        </div>
                        <div class="submit">
	                        <a class="login_button" href="javascript:void(0);">
	                            <input type="submit" tabindex="6" value="登 录" class="btn" id="login_button">
	                        </a>
                        </div>
					</form>
				</div>
				<div class="footer">
					
				</div>
			</div>
			<!--<div class="leftshow">
				<p class="systit">食堂出入库管理</p>
			</div>
-->		</div>
	</div>
</body>
</html>
