$(function() {
    $(".form_error").css("display", "block");
    $(".form_error").css("font-weight", "normal");
    $("#login_error").hide();
    function check_login() {
        if ($("#uid").val() > 0) {
            return true
        } else {
            return false
        }
    }
	
	//提交注册信息
    $("#register_frame").on("click", "#submit_register",function() {
        $("#submit_register").attr("disabled", true);
        $("#submit_register").text("注册中...");
		
		var ifAgree = $("#register_frame").find("#ifagree").is(":checked");
		if(ifAgree == false){
			alert("请先同意《快投机器服务协议》");
			$("#submit_register").attr("disabled", false);
           $("#submit_register").text("现在注册")			
			return false;
		}	
		
        var arg = {};
        $("#register_frame input").each(function() {
            arg[$(this).attr("name")] = $(this).val()
        });
		
        $.post("/welcome/regesiter/", arg,function(data, status) {
            var obj = JSON.parse(data);
            if (obj.error == 0) {
                var msg = JSON.parse(obj.msg);
                $.each(msg,function(key, val) {
                    $("#" + key + "_error").html('<div class="col-md-12"><p class="alert alert-danger my_alert">' + val + "</p></div>");
                    $("#" + key + "_error").show();
                    $("#" + key + "_error").attr("data", "faield")
                });
                $("#submit_register").attr("disabled", false);
                $("#submit_register").text("现在注册")
            }
            if (obj.error == 1) {
                $('#registerFaild').modal('show');
            }
            if (obj.error == 2) {
                $('#registerSuccess').modal('show');
            }
        })
    });
	
	
	
    /* $("#registerModal").on("blur", "input",
    function() {
        var ajax_id = $(this).attr("name");
        var arg = {};
        var arg1 = ajax_id;
        var value1 = $(this).val();
        arg[arg1] = value1;
        if ($(this).attr("name") == "matches_password") {
            var value2 = $("#regesiter #password").val();
            var arg2 = "password";
            arg[arg2] = value2
        }
        if ($(this).attr("name") == "phonecode") {
            var value2 = $("#regesiter #mobile").val();
            var arg2 = "mobile";
            arg[arg2] = value2
        }
        $.post("/welcome/regesiter/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                $("#" + ajax_id + "_error").html('<div class="col-lg-4"><p class="alert alert-success my_alert">输入正确!</p></div>');
                $("#" + ajax_id + "_error").attr("data", "success");
                return true
            } else {
                $("#" + ajax_id + "_error").html(data);
                $("#" + ajax_id + "_error").show();
                $("#" + ajax_id + "_error").attr("data", "faield");
                return false
            }
        })
    }); */
	
	
	
	//发送注册短信验证
    $("#register_frame").find("#sendcode").click(function() {
        var telphone = $("#register_frame").find("#mobile").val();
        var shengyu_b = $("#register_frame").find("#sendcode").attr("data");
        var img_code = $("#register_frame").find("#piccode").val();
		
        if (shengyu_b <= 0) {
            $.get("/welcome/sendmessage/" + telphone + "/" + img_code,
            function(data, status) {
                if (data == "success") {
                    $("#register_frame").find("#phonecode_error").html('<div class="col-md-12"><p class="alert alert-success my_alert">短信已发送,3分钟有效</p></div>');
					$("#register_frame").find("#phonecode_error").show();
                    $("#register_frame").find("#sendcode").attr("data", 59);
                    $("#register_frame").find("#sendcode").text("重发(59)");
					
                    daojishi = setInterval(function() {
                        var shengyu_text =  $("#register_frame").find("#sendcode").attr("data") - 1;
                        var shengyu =  $("#register_frame").find("#sendcode").attr("data", shengyu_text);
                        if (shengyu_text >= 0) {
                             $("#register_frame").find("#sendcode").text("重发(" + shengyu_text + ")")
                        } else {
                            window.clearInterval(daojishi);
                             $("#register_frame").find("#sendcode").text("发送短信")
                        }
                    },
                    1000)
					
                } else {
                    $("#register_frame").find("#phonecode_error").html('<div class="col-md-12"><p class="alert alert-danger my_alert">' + data + "</p></div>");
					$("#register_frame").find("#phonecode_error").show();
                }
            })
        }
    });
	
	
    /* $("#login_forget").click(function() {
        $("#loginModal .close").click();
        $("#header_getpassword").click()
    }); 
    $("#login_regesiter").click(function() {
        $("#loginModal .close span").click();
        $('[data-target="#registerModal"]').click()
    });	
    $("#regesiter_login").click(function() {
        $("#registerModal").modal("hide");
        $("#loginModal").modal("show")
    });	
	
	*/
	
	//提交登录信息 ajax
    $("#login_frame").find("#submit_login").click(function() {
        var arg = {};
        arg["username"] = $("#login_frame").find("#recipient-name").val();
        arg["password"] = $("#login_frame").find("#login_password").val();
		
		if($("#login_frame").find("#recipient-name").val().trim() == ''){
			$("#login_frame").find("#username_error").show();	
		}else{
			if($("#login_frame").find("#login_password").val().trim() == ''){
				$("#login_frame").find("#login_password_error").show();
			}else{
				//添加验证码验证
				arg["piccode"] = $("#login_frame").find("#piccode").val();
				
				$.post("/welcome/login/", arg,
				function(data, status) {
					if (data == "success") {
					   location.href = "/usercenter/";
					} else if(data == "piccode_error"){
						$("#login_frame").find("#verify_error").show();
						$("#login_frame").find('.piccode').click();
					} else {
						$("#login_frame").find("#info_error").show();
						$("#login_frame").find('.piccode').click();
					}
				})
			}
		}
    });
	
	$("#login_frame").find("#login_password").blur(function(){
		if($("#login_frame").find("#login_password").val().trim() != ''){
			$("#login_frame").find("#login_password_error").hide();	
		}	
	})
	
	$("#login_frame").find("#recipient-name").blur(function(){
		
		if($("#login_frame").find("#recipient-name").val().trim() != ''){
			$("#login_frame").find("#username_error").hide();	
		}	
	})
	
	
	
	//忘记密码
    $("#passwordModal input").blur(function() {
        var arg = {};
        var obj = $(this);
        ajax_id = $(this).attr("id");
        arg["oldpass"] = $("#oldpass").val();
        arg["newpass"] = $("#newpass").val();
        arg["matches_password"] = $("#matches_password").val();
        $.post("/usercenter/change_password/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-success my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").text("输入正确");
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            } else {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-danger my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").html(data);
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            }
        })
    });
	
	
	
    $("#passwordModal button").click(function() {
        var error = 0;
        var arg = {};
        $("#passwordModal input").blur();
        $("#passwordModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val();
            if ($(this).parent(".col-lg-4").next(".col-lg-4").find("p").hasClass("alert-danger")) {
                error = error - ( - 1)
            }
        });
        if (error <= 0) {
            $.post("/usercenter/change_password/", arg,
            function(data, status) {
                if (data == "success") {
                    alert("修改成功")
                } else {
                    alert("修改失败")
                }
                location.href = "/usercenter/safe.html"
            })
        }
    });
    $("#transferModal input").blur(function() {
        var arg = {};
        var obj = $(this);
        var type = $("#transferModal #bind").attr("data");
        var ajax_id = $(this).attr("id");
        $("#transferModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val()
        });
        $.post("/usercenter/bind_email/" + type + "/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-success my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").text("输入正确");
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            } else {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-danger my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").html(data);
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            }
        })
    });
    $("#transferModal #sendemail").click(function() {
        var email = $("#transferModal #email").val();
        var shengyu_b = $("#sendemail").attr("data");
        var type = $("#transferModal #bind").attr("data");
        var obj = $(this);
        var error_field = obj.parent(".col-lg-4").next(".col-lg-4").find("p");
        if (shengyu_b <= 0 || shengyu_b == "undefined") {
            $.get("/usercenter/sendemailcode/" + type + "/" + encodeURIComponent(email),
            function(data, status) {
                obj.parent(".col-lg-4").next(".col-lg-4").show();
                if (data == "success") {
                    error_field.attr("class", "alert alert-success my_alert");
                    error_field.text("邮件已发送,5分钟有效");
                    obj.attr("data", 119);
                    obj.text("重新发送(119)");
                    daojishi = setInterval(function() {
                        var shengyu_text = obj.attr("data") - 1;
                        var shengyu = obj.attr("data", shengyu_text);
                        if (shengyu_text >= 0) {
                            obj.text("重新发送(" + shengyu_text + ")")
                        } else {
                            window.clearInterval(daojishi);
                            obj.text("点击获取验证码")
                        }
                    },
                    1000)
                } else {
                    error_field.text(data)
                }
            })
        }
    });
    $("#transferModal #bind").click(function() {
        var error = 0;
        var arg = {};
        $("#transferModal input").blur();
        $("#transferModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val();
            if ($(this).parent(".col-lg-4").next(".col-lg-4").find("p").hasClass("alert-danger")) {
                error = error - ( - 1)
            }
        });
        if (error <= 0) {
            $.post("/usercenter/bind_email/add/", arg,
            function(data, status) {
                if (data == "success") {
                    alert("修改成功")
                } else {
                    alert("修改失败")
                }
                location.href = "/usercenter/safe.html"
            })
        }
    });
	
	//实名认证  数据有效性
    $("#authentication input").blur(function() {
        var arg = {};
        var obj = $(this);
        var ajax_id = $(this).attr("id");
        $("#authentication input").each(function() {
            arg[$(this).attr("id")] = $(this).val()
        });
        $.post("/usercenter/authentication/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                $("#authentication").find("#"+ajax_id+"_error").find("p").attr("class","alert alert-success my_alert");
                $("#authentication").find("#"+ajax_id+"_error").find("p").text("输入正确");
                $("#authentication").find("#"+ajax_id+"_error").show();
            } else {
                $("#authentication").find("#"+ajax_id+"_error").find("p").attr("class","alert alert-danger my_alert");
                $("#authentication").find("#"+ajax_id+"_error").find("p").html(data);
                $("#authentication").find("#"+ajax_id+"_error").show()
            }
        })
    });
	
	//实名认证
    $("#authentication").find("#submit_verify").click(function() {
        var obj_btn = $(this);
        obj_btn.attr("disabled", true);
        obj_btn.text("提交中...");
		var ifAgree = $("#authentication").find("#ifagree").is(":checked");
		if(ifAgree == false){
			alert("请先同意《新浪支付服务使用协议》");
			obj_btn.attr("disabled", false);
            obj_btn.text("现在认证")			
			return false;
		}
		
        var arg = {};
        arg["name"] = $("#authentication #name").val();
        arg["idcard"] = $("#authentication #idcard").val();
        $.post("/usercenter/authentication/", arg,
        function(data, status) {
            var obj = JSON.parse(data);
            if (obj.error == 3) {
                var msg = JSON.parse(obj.msg);
                $.each(msg,
                function(key, val) {
                    $("#authentication").find("#" + key + "_error").find("p").html(val);
                    $("#authentication").find("#" + key + "_error").show();
                });
                obj_btn.attr("disabled", false);
                obj_btn.text("现在认证")
            }
            if (obj.error == 1) {
                alert(obj.msg);
                obj_btn.attr("disabled", false);
                obj_btn.text("现在认证")
            }
            if (obj.error == 0) {
                alert("实名认证成功");
                location.href = "/usercenter/verify_success.html"
            }
        })
    });
    $("#bind_bank input,#bind_bank select").blur(function() {
        var arg = {};
        var obj = $(this);
        var ajax_id = $(this).attr("id");
        var type = $("#bind_bank button").attr("data");
        $("#bind_bank input,#bind_bank select").each(function() {
            arg[$(this).attr("id")] = $(this).val()
        });
        $.post("/usercenter/bind_bank/" + type + "/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-success my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").text("输入正确");
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            } else {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-danger my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").html(data);
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            }
        })
    });
    $("#bind_bank button").click(function() {
        var error = 0;
        var arg = {};
        $("#bind_bank input,#bind_bank select").blur();
        $("#bind_bank input,#bind_bank select").each(function() {
            arg[$(this).attr("id")] = $(this).val();
            if ($(this).parent(".col-lg-4").next(".col-lg-4").find("p").hasClass("alert-danger")) {
                error = error - ( - 1)
            }
        });
        if (error <= 0) {
            $.post("/usercenter/bind_bank/add/", arg,
            function(data, status) {
                if (data == "success") {
                    alert("提交成功")
                } else {
                    alert("提交失败")
                }
                location.href = "/usercenter/safe.html"
            })
        }
    });
    $("#trading input").blur(function() {
        var arg = {};
        var obj = $(this);
        var ajax_id = $(this).attr("id");
        $("#trading input").each(function() {
            arg[$(this).attr("id")] = $(this).val()
        });
        $.post("/usercenter/trading/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-success my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").text("输入正确");
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            } else {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-danger my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").html(data);
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            }
        })
    });
    $("#trading #sendphonecode").click(function() {
        var shengyu_b = $("#trading #sendphonecode").attr("data");
        var obj = $(this);
        var error_field = obj.parent(".col-lg-4").next(".col-lg-4").find("p");
        if (shengyu_b <= 0 || shengyu_b == "undefined") {
            $.get("/usercenter/sendphoncode/trading",
            function(data, status) {
                obj.parent(".col-lg-4").next(".col-lg-4").show();
                if (data == "success") {
                    error_field.attr("class", "alert alert-success my_alert");
                    error_field.text("短信已发送,3分钟有效");
                    obj.attr("data", 59);
                    obj.text("重新发送(59)");
                    daojishi = setInterval(function() {
                        var shengyu_text = obj.attr("data") - 1;
                        var shengyu = obj.attr("data", shengyu_text);
                        if (shengyu_text >= 0) {
                            obj.text("重新发送(" + shengyu_text + ")")
                        } else {
                            window.clearInterval(daojishi);
                            obj.text("点击获取验证码")
                        }
                    },
                    1000)
                } else {
                    error_field.text(data)
                }
            })
        }
    });
    $("#trading #bind").click(function() {
        var error = 0;
        var arg = {};
        $("#trading input").blur();
        $("#trading input").each(function() {
            arg[$(this).attr("id")] = $(this).val();
            if ($(this).parent(".col-lg-4").next(".col-lg-4").find("p").hasClass("alert-danger")) {
                error = error - ( - 1)
            }
        });
        if (error <= 0) {
            $.post("/usercenter/trading/", arg,
            function(data, status) {
                if (data == "success") {
                    alert("修改成功")
                } else {
                    alert("修改失败")
                }
                location.href = "/usercenter/safe.html"
            })
        }
    });
    $("#addphoneModal input").blur(function() {
        var arg = {};
        var obj = $(this);
        var ajax_id = $(this).attr("id");
        $("#addphoneModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val()
        });
        $.post("/usercenter/change_phone/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-success my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").text("输入正确");
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            } else {
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").attr("class", "alert alert-danger my_alert");
                obj.parent(".col-lg-4").next(".col-lg-4").find("p").html(data);
                obj.parent(".col-lg-4").next(".col-lg-4").show()
            }
        })
    });
    $("#addphoneModal #sendphonecode").click(function() {
        var shengyu_b = $("#addphoneModal #sendphonecode").attr("data");
        var obj = $(this);
        var error_field = obj.parent(".col-lg-4").next(".col-lg-4").find("p");
        if (shengyu_b <= 0 || shengyu_b == "undefined") {
            $.get("/usercenter/sendphoncode/edit_phone/" + $("#addphoneModal #newphone").val(),
            function(data, status) {
                obj.parent(".col-lg-4").next(".col-lg-4").show();
                if (data == "success") {
                    error_field.attr("class", "alert alert-success my_alert");
                    error_field.text("短信已发送,3分钟有效");
                    obj.attr("data", 59);
                    obj.text("重新发送(59)");
                    daojishi = setInterval(function() {
                        var shengyu_text = obj.attr("data") - 1;
                        var shengyu = obj.attr("data", shengyu_text);
                        if (shengyu_text >= 0) {
                            obj.text("重新发送(" + shengyu_text + ")")
                        } else {
                            window.clearInterval(daojishi);
                            obj.text("点击获取验证码")
                        }
                    },
                    1000)
                } else {
                    error_field.text(data)
                }
            })
        }
    });
    $("#addphoneModal #bind").click(function() {
        var error = 0;
        var arg = {};
        $("#addphoneModal input").blur();
        $("#addphoneModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val();
            if ($(this).parent(".col-lg-4").next(".col-lg-4").find("p").hasClass("alert-danger")) {
                error = error - ( - 1)
            }
        });
		
        if (error <= 0) {
            $.post("/usercenter/change_phone/", arg,
            function(data, status) {
                if (data == "success") {
                    alert("提交成功")
                } else {
                    alert("提交失败")
                }
                location.href = "/usercenter/safe.html"
            })
        }
    });
	
	//找回密码  检验数据有效性
    $("#getpasswordModal input").blur(function() {
        var arg = {};
        var obj = $(this);
        var ajax_id = $(this).attr("id");
        $("#getpasswordModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val()
        });
        $.post("/welcome/forget/" + ajax_id, arg,
        function(data, status) {
            if (data == "") {
				$("#getpasswordModal").find("#"+ajax_id+"_error").html("<div class='alert alert-success my_alert'>输入正确</div>");
                $("#getpasswordModal").find("#"+ajax_id+"_error").parent().show();
            } else {
				$("#getpasswordModal").find("#"+ajax_id+"_error").html("<div class='alert alert-danger my_alert'>"+data+"</div>");
                $("#getpasswordModal").find("#"+ajax_id+"_error").parent().show();
            }
        })
    });
	
	//找回密码  发送短息
    $("#getpasswordModal").find("#sendphonecode").click(function() {
        var shengyu_b = $("#getpasswordModal #sendphonecode").attr("data");
        var obj = $(this);
        var phone = $("#getpasswordModal #mobile").val();
        var error_field = obj.parent(".col-lg-4").next(".col-lg-4").find("p");
        if (shengyu_b <= 0 || shengyu_b == "undefined") {
            $.get("/welcome/fogetsend/" + phone,
            function(data, status) {
                obj.parent(".col-lg-4").next(".col-lg-4").show();
                if (data == "success") {
                    error_field.attr("class", "alert alert-success my_alert");
                    error_field.text("短信已发送,3分钟有效");
                    obj.attr("data", 59);
                    obj.text("重发(59)");
                    daojishi = setInterval(function() {
                        var shengyu_text = obj.attr("data") - 1;
                        var shengyu = obj.attr("data", shengyu_text);
                        if (shengyu_text >= 0) {
                            obj.text("重发(" + shengyu_text + ")")
                        } else {
                            window.clearInterval(daojishi);
                            obj.text("发送短信")
                        }
                    },
                    1000)
                } else {
                    error_field.text(data)
                }
            })
        }
    });
	
	//找回密码  提交
    $("#getpasswordModal").find("#forget_change").click(function() {
        var error = 0;
        var arg = {};
        $("#getpasswordModal input").blur();
        $("#getpasswordModal input").each(function() {
            arg[$(this).attr("id")] = $(this).val();
            if ($("#"+$(this).attr("id")+"_error").hasClass("alert-danger")) {
                error = error - ( - 1)
            }
        });
        if (error <= 0) {
            $.post("/welcome/forget/", arg,
            function(data, status) {
		
				
				
                if (data == "success") {
                    alert("提交成功")
					location.href = "/welcome/login_frame.html"
                } else {
						
					if (data == "") {
						$("#getpasswordModal").find("#"+ajax_id+"_error").html("<div class='alert alert-success my_alert'>输入正确</div>");
						$("#getpasswordModal").find("#"+ajax_id+"_error").parent().show();
					} else {
						$("#getpasswordModal").find("#"+ajax_id+"_error").html("<div class='alert alert-danger my_alert'>"+data+"</div>");
						$("#getpasswordModal").find("#"+ajax_id+"_error").parent().show();
					}							
				}
                
            })
        }
    })
});