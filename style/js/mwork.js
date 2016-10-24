$(document).ready(function(){
$('#passwordModal input').blur(function(){
		var arg = {};
		var obj = $(this);
		ajax_id = $(this).attr('id');
		arg["oldpass"] = $('#oldpass').val();
		arg["newpass"] = $('#newpass').val();
		arg["matches_password"] = $('#matches_password').val();
		$.post("/m/usercenter/change_password/"+ajax_id,arg, function(data,status){
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
			$.post("/m/m/usercenter/change_password/",arg, function(data,status){
				if(data == "success")
				{
					alert('修改成功');
				}
				else
				{
					alert('修改失败');	
				}
				location.href = '/m/usercenter/safe.html';
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
		$.post("/m/usercenter/authentication/"+ajax_id,arg, function(data,status){
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
		$.post("/m/usercenter/authentication/",arg,function(data,status){
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
	
	$('#trading input').blur(function(){
		var arg = {};
		var obj = $(this);
		var ajax_id = $(this).attr('id');
		$('#trading input').each(function() {
			 arg[$(this).attr('id')] = $(this).val();
		});
		$.post("/m/usercenter/trading/"+ajax_id,arg, function(data,status){
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
			 $.get("/m/usercenter/sendphoncode/trading",function(data,status){
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
			$.post("/m/usercenter/trading/",arg, function(data,status){
				if(data == "success")
				{
					alert('修改成功');
				}
				else
				{
					alert('修改失败');	
				}
				location.href = '/m/usercenter/safe.html';
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
		$.post("/m/usercenter/change_phone/"+ajax_id,arg, function(data,status){
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
			 $.get("/m/usercenter/sendphoncode/edit_phone/"+ $('#addphoneModal #newphone').val(),function(data,status){
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
			$.post("/m/usercenter/change_phone/",arg, function(data,status){
				
				if(data == "success")
				{
					alert('提交成功');
				}
				else
				{
					alert('提交失败');	
				}
				location.href = '/m/usercenter/safe.html';
			});
		}
	});
});