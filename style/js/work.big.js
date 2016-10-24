$(document).ready(function(){
	$('.form_error').css("display",'block');
	$('.form_error').css("font-weight",'normal');
	$('#login_error').hide();
	//检查登录
	function check_login()
	{
		if($('#uid').val() > 0)
		{
			return true;	
		}	
		else
		{
			return false;	
		}
	}
	
	//注册ajax验证
	
	//$('#regesiter').bind('submit',function(){
		
	//});
	//点击注册按钮
	$('#registerModal').on("click","#mszc",function(){
	//$('#mszc').click(function(){
		$('#mszc').attr("disabled",true);
		$('#mszc').text('注册中...');
		var arg = {};
		$('#registerModal input').each(function(){
			arg[$(this).attr('name')] = $(this).val();
		});
		$.post("/welcome/regesiter/",arg,function(data,status){
			//console.log(data);
			var obj = JSON.parse(data);
			if(obj.error == 0)
			{
				var msg = JSON.parse(obj.msg);
				$.each(msg,function(key,val){
					$("#" + key + '_error').html('<div class="col-lg-4"><p class="alert alert-danger my_alert">' + val + '</p></div>');
			  		$("#" + key + '_error').show();
					$("#" + key + '_error').attr('data','faield');
				});	
				//alert(msg[0][0]);
				//表单未通过验证	
				$('#mszc').attr("disabled",false);
				$('#mszc').text('马上注册');
			}
			if(obj.error == 1)
			{
				//注册失败	
				alert('注册失败');
				location.reload();
			}
			if(obj.error == 2)
			{
				//注册成功
				alert('注册成功');
				location.href = "/usercenter/safe";	
			}
		});
	});
	$('#registerModal').on("blur","input",function(){
	//$('#regesiter input').blur(function(){
		var ajax_id = $(this).attr('name');  //获取文本框的名称
		var arg = {};
		var arg1 = ajax_id;
        var value1 = $(this).val();
		arg[arg1] = value1;  //提交POST
		if($(this).attr('name') == 'matches_password')
		{
			var value2 = $('#regesiter #password').val();
			var arg2 = 'password';
			arg[arg2] = value2;
		}
		if($(this).attr('name') == 'phonecode')
		{
			var value2 = $('#regesiter #mobile').val();
			var arg2 = 'mobile';
			arg[arg2] = value2;
		}
		
	
		$.post("/welcome/regesiter/" + ajax_id,arg,
			  function(data,status){
			  if(data == "")
			  {
			  	$("#" + ajax_id + '_error').html(
					'<div class="col-lg-4"><p class="alert alert-success my_alert">输入正确!</p></div>'
				 );   
				 $("#" + ajax_id + '_error').attr('data','success');  
				 return true;      
			  }       
			  else
			  {
			  	$("#" + ajax_id + '_error').html(data);
			  	$("#" + ajax_id + '_error').show();
				$("#" + ajax_id + '_error').attr('data','faield');
				return false; 
			  }
		});
	});
	//注册发送短信						
	$('#regesiter #sendcode').click(function(){
		var telphone = $('#regesiter #mobile').val();
		var shengyu_b = $('#sendcode').attr('data');
		if(shengyu_b <=0)
		 { 
			 $.get("/welcome/sendmessage/" + telphone,function(data,status){
				if(data == "success")
				{
					$('#phonecode_error').html('<div class="col-lg-4"><p class="alert alert-success my_alert">短信已发送,3分钟有效</p></div>');
					$('#sendcode').attr('data',59);
					$('#sendcode').text("重新发送(59)");
					daojishi = setInterval(function(){
						var shengyu_text = $('#sendcode').attr('data')-1;
						var shengyu = $('#sendcode').attr('data',shengyu_text);
						if(shengyu_text >=0)
						{
							$('#sendcode').text("重新发送("+shengyu_text+")");
						}else
						{
							window.clearInterval(daojishi);	
							$('#sendcode').text("点击获取验证码");
						}
					},1000);
					
				}
				else
				{
					$('#phonecode_error').html('<div class="col-lg-4"><p class="alert alert-danger my_alert">'+data+'</p></div>');
				}
			});
		 }

	});
	//忘记密码
	$('#login_forget').click(function(){
		$('#loginModal .close').click();
		$('#header_getpassword').click();
	});
	
	//登录
	$('#login').click(function(){
		var arg = {};
		arg['username'] = $('#recipient-name').val();  //提交POST
		arg['password'] = $('#login_password').val();  //提交POST
		$.post("/welcome/login/",arg,function(data,status){
			if(data == "success")
			{
				location.href = '/usercenter/';
			}
			else
			{
				$('#login_error').show();
			}
		});
	});
	
	//登录页面跳转到注册页面
	$('#login_regesiter').click(function(){
		$('#loginModal .close span').click();
		$('[data-target="#registerModal"]').click();
	});
	//注册页面跳转到登录页面
	$('#regesiter_login').click(function(){
		$('#registerModal').modal('hide');
		$('#loginModal').modal('show');	
	});

	//绑定邮箱
	
	//修改手机号

	//修改密码
	$('#passwordModal input').blur(function(){
		var arg = {};
		var obj = $(this);
		ajax_id = $(this).attr('id');
		arg["oldpass"] = $('#oldpass').val();
		arg["newpass"] = $('#newpass').val();
		arg["matches_password"] = $('#matches_password').val();
		$.post("/usercenter/change_password/"+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	$('#passwordModal button').click(function(){
		var error = 0;
		var arg = {};
		$('#passwordModal input').blur();
		$('#passwordModal input').each(function() {
             arg[$(this).attr('id')] = $(this).val();
			 if($(this).parent('.col-lg-4').next('.col-lg-4').find('p').hasClass('alert-danger'))
			 {
				error = error - (-1);
			 } 
        });
		if(error <= 0)
		{
			$.post("/usercenter/change_password/",arg, function(data,status){
				if(data == "success")
				{
					alert('修改成功');
				}
				else
				{
					alert('修改失败');	
				}
				location.href = '/usercenter/safe.html';
			});
		}
	});
	//添加修改邮箱
	$('#transferModal input').blur(function(){
		var arg = {};
		var obj = $(this);
		var type = $('#transferModal #bind').attr('data');
		var ajax_id = $(this).attr('id');
		$('#transferModal input').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/usercenter/bind_email/"+type+'/'+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	//发送邮件验证码
	$('#transferModal #sendemail').click(function(){
		var email = $('#transferModal #email').val();
		var shengyu_b = $('#sendemail').attr('data');
		var type = $('#transferModal #bind').attr('data');
		var obj = $(this);
		var error_field = obj.parent('.col-lg-4').next('.col-lg-4').find('p');
		if(shengyu_b <=0 || shengyu_b == "undefined")
		 { 
			 $.get("/usercenter/sendemailcode/"+  type + '/' + encodeURIComponent(email),function(data,status){
				obj.parent('.col-lg-4').next('.col-lg-4').show();
				if(data == "success")
				{
					error_field.attr('class',"alert alert-success my_alert");
					error_field.text('邮件已发送,5分钟有效');
					obj.attr('data',119);
					obj.text("重新发送(119)");
					daojishi = setInterval(function(){
						var shengyu_text = obj.attr('data')-1;
						var shengyu = obj.attr('data',shengyu_text);
						if(shengyu_text >=0)
						{
							obj.text("重新发送("+shengyu_text+")");
						}else
						{
							window.clearInterval(daojishi);	
							obj.text("点击获取验证码");
						}
					},1000);
					
				}
				else
				{
					error_field.text(data);
				}
			});
		 }
	});
	//提交表单
	$('#transferModal #bind').click(function(){
		var error = 0;
		var arg = {};
		$('#transferModal input').blur();
		$('#transferModal input').each(function() {
             arg[$(this).attr('id')] = $(this).val();
			 if($(this).parent('.col-lg-4').next('.col-lg-4').find('p').hasClass('alert-danger'))
			 {
				error = error - (-1);
			 } 
        });
		if(error <= 0)
		{
			$.post("/usercenter/bind_email/add/",arg, function(data,status){
				if(data == "success")
				{
					alert('修改成功');
				}
				else
				{
					alert('修改失败');	
				}
				location.href = '/usercenter/safe.html';
			});
		}
	});
	
	
	//实名认证
	$('#authentication input').blur(function(){
		var arg = {};
		var obj = $(this);
		var ajax_id = $(this).attr('id');
		$('#authentication input').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/usercenter/authentication/"+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	
	$('#authentication button.btn').click(function(){
		var obj_btn = $(this);
		obj_btn.attr("disabled",true);
		obj_btn.text('提交中...');
		var arg = {};
		arg['name'] = $('#authentication #name').val();
		arg['idcard'] = $('#authentication #idcard').val();
		$.post("/usercenter/authentication/",arg,function(data,status){
			var obj = JSON.parse(data);
			if(obj.error == 3)
			{
				//表单未通过验证
				var msg = JSON.parse(obj.msg);
				$.each(msg,function(key,val){
					$("#authentication #" + key).parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
					$("#authentication #" + key).parent('.col-lg-4').next('.col-lg-4').find('p').html(val);
			  		$("#authentication #" + key).parent('.col-lg-4').next('.col-lg-4').show();
				});
				obj_btn.attr("disabled",false);	
				obj_btn.text('确认绑定');	
			}
			if(obj.error == 1)
			{
				//验证不通过
				alert(obj.msg);
				obj_btn.attr("disabled",false);
				obj_btn.text('确认绑定');
			}
			if(obj.error == 0)
			{
				//验证通过
				alert('实名认证成功');
				location.reload();	
			}
		});
	});
	//绑定银行卡
	$('#bind_bank input,#bind_bank select').blur(function(){
		var arg = {};
		var obj = $(this);
		var ajax_id = $(this).attr('id');
		var type = $('#bind_bank button').attr('data');
		$('#bind_bank input,#bind_bank select').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/usercenter/bind_bank/"+ type + '/'+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	
	$('#bind_bank button').click(function(){
		var error = 0;
		var arg = {};
		$('#bind_bank input,#bind_bank select').blur();
		$('#bind_bank input,#bind_bank select').each(function() {
             arg[$(this).attr('id')] = $(this).val();
			 if($(this).parent('.col-lg-4').next('.col-lg-4').find('p').hasClass('alert-danger'))
			 {
				error = error - (-1);
			 } 
        });
		if(error <= 0)
		{
			$.post("/usercenter/bind_bank/add/",arg, function(data,status){
				if(data == "success")
				{
					alert('提交成功');
				}
				else
				{
					alert('提交失败');	
				}
				location.href = '/usercenter/safe.html';
			});
		}
	});
	
	//添加交易密码
	$('#trading input').blur(function(){
		var arg = {};
		var obj = $(this);
		var ajax_id = $(this).attr('id');
		$('#trading input').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/usercenter/trading/"+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	//设置交易密码发送短信验证码
	$('#trading #sendphonecode').click(function(){
		var shengyu_b = $('#trading #sendphonecode').attr('data');
		var obj = $(this);
		var error_field = obj.parent('.col-lg-4').next('.col-lg-4').find('p');
		if(shengyu_b <=0 || shengyu_b == "undefined")
		 { 
			 $.get("/usercenter/sendphoncode/trading",function(data,status){
				obj.parent('.col-lg-4').next('.col-lg-4').show();
				if(data == "success")
				{
					error_field.attr('class',"alert alert-success my_alert");
					error_field.text('短信已发送,3分钟有效');
					obj.attr('data',59);
					obj.text("重新发送(59)");
					daojishi = setInterval(function(){
						var shengyu_text = obj.attr('data')-1;
						var shengyu = obj.attr('data',shengyu_text);
						if(shengyu_text >=0)
						{
							obj.text("重新发送("+shengyu_text+")");
						}else
						{
							window.clearInterval(daojishi);	
							obj.text("点击获取验证码");
						}
					},1000);
					
				}
				else
				{
					error_field.text(data);
				}
			});
		 }
	});
	//修改交易密码
	$('#trading #bind').click(function(){
		var error = 0;
		var arg = {};
		$('#trading input').blur();
		$('#trading input').each(function() {
             arg[$(this).attr('id')] = $(this).val();
			 if($(this).parent('.col-lg-4').next('.col-lg-4').find('p').hasClass('alert-danger'))
			 {
				error = error - (-1);
			 } 
        });
		if(error <= 0)
		{
			$.post("/usercenter/trading/",arg, function(data,status){
				if(data == "success")
				{
					alert('修改成功');
				}
				else
				{
					alert('修改失败');	
				}
				location.href = '/usercenter/safe.html';
			});
		}
	});
	
	
	//个人中心修改手机号
	$('#addphoneModal input').blur(function(){
		var arg = {};
		var obj = $(this);
		var ajax_id = $(this).attr('id');
		$('#addphoneModal input').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/usercenter/change_phone/"+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	//个人中心修改手机号发送短信验证码
	$('#addphoneModal #sendphonecode').click(function(){
		var shengyu_b = $('#addphoneModal #sendphonecode').attr('data');
		var obj = $(this);
		var error_field = obj.parent('.col-lg-4').next('.col-lg-4').find('p');
		if(shengyu_b <=0 || shengyu_b == "undefined")
		 { 
			 $.get("/usercenter/sendphoncode/edit_phone/"+ $('#addphoneModal #newphone').val(),function(data,status){
				obj.parent('.col-lg-4').next('.col-lg-4').show();
				if(data == "success")
				{
					error_field.attr('class',"alert alert-success my_alert");
					error_field.text('短信已发送,3分钟有效');
					obj.attr('data',59);
					obj.text("重新发送(59)");
					daojishi = setInterval(function(){
						var shengyu_text = obj.attr('data')-1;
						var shengyu = obj.attr('data',shengyu_text);
						if(shengyu_text >=0)
						{
							obj.text("重新发送("+shengyu_text+")");
						}else
						{
							window.clearInterval(daojishi);	
							obj.text("点击获取验证码");
						}
					},1000);
					
				}
				else
				{
					error_field.text(data);
				}
			});
		 }
	});
	//个人中心修改手机号表单提交
	$('#addphoneModal #bind').click(function(){
		var error = 0;
		var arg = {};
		$('#addphoneModal input').blur();
		$('#addphoneModal input').each(function() {
             arg[$(this).attr('id')] = $(this).val();
			 if($(this).parent('.col-lg-4').next('.col-lg-4').find('p').hasClass('alert-danger'))
			 {
				error = error - (-1);
			 } 
        });
		if(error <= 0)
		{
			$.post("/usercenter/change_phone/",arg, function(data,status){
				
				if(data == "success")
				{
					alert('提交成功');
				}
				else
				{
					alert('提交失败');	
				}
				location.href = '/usercenter/safe.html';
			});
		}
	});
	
	
	//首页忘记密码
	$('#getpasswordModal input').blur(function(){
		var arg = {};
		var obj = $(this);
		var ajax_id = $(this).attr('id');
		$('#getpasswordModal input').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/welcome/forget/"+ajax_id,arg, function(data,status){
			 if(data == "")
			  {
			  	 obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-success my_alert"); 
				 obj.parent('.col-lg-4').next('.col-lg-4').find('p').text("输入正确");    
				 obj.parent('.col-lg-4').next('.col-lg-4').show();   
			  }       
			  else
			  {
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').attr('class',"alert alert-danger my_alert");
				obj.parent('.col-lg-4').next('.col-lg-4').find('p').html(data);
				obj.parent('.col-lg-4').next('.col-lg-4').show(); 
			  }
		});
	});
	//首页忘记密码发送短信
	$('#getpasswordModal #sendphonecode').click(function(){
		var shengyu_b = $('#getpasswordModal #sendphonecode').attr('data');
		var obj = $(this);
		var phone = $('#getpasswordModal #mobile').val();
		var error_field = obj.parent('.col-lg-4').next('.col-lg-4').find('p');
		if(shengyu_b <=0 || shengyu_b == "undefined")
		 { 
			 $.get("/welcome/fogetsend/" + phone,function(data,status){
				obj.parent('.col-lg-4').next('.col-lg-4').show();
				if(data == "success")
				{
					error_field.attr('class',"alert alert-success my_alert");
					error_field.text('短信已发送,3分钟有效');
					obj.attr('data',59);
					obj.text("重新发送(59)");
					daojishi = setInterval(function(){
						var shengyu_text = obj.attr('data')-1;
						var shengyu = obj.attr('data',shengyu_text);
						if(shengyu_text >=0)
						{
							obj.text("重新发送("+shengyu_text+")");
						}else
						{
							window.clearInterval(daojishi);	
							obj.text("点击获取验证码");
						}
					},1000);
					
				}
				else
				{
					error_field.text(data);
				}
			});
		 }
	});
	
	//首页忘记密码提交
	$('#getpasswordModal #forget_change').click(function(){
		var error = 0;
		var arg = {};
		$('#getpasswordModal input').blur();
		$('#getpasswordModal input').each(function() {
             arg[$(this).attr('id')] = $(this).val();
			 if($(this).parent('.col-lg-4').next('.col-lg-4').find('p').hasClass('alert-danger'))
			 {
				error = error - (-1);
			 } 
        });
		if(error <= 0)
		{
			$.post("/welcome/forget/",arg, function(data,status){
				
				if(data == "success")
				{
					alert('提交成功');
				}
				else
				{
					alert('提交失败');	
				}
				location.href = '/welcome.html';
			});
		}
	});
	
});