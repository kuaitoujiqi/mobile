<script type="text/javascript">
$(document).ready(function(){
	$('.piccode').click(function(){
		$(this).attr('src',"http://www.kuaitoujiqi.com/welcome/regesiter_code/" + Math.random());
	});
});
</script>

<!-- ----------------------忘记密码弹出-------------------->
<!----
    <div class="modal" id="getpasswordModal" tabindex="-1" role="dialog" aria-labelledby="getpasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">找回密码</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">手机号：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="请输入您的手机号" id="mobile">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert">请输入您的11位手机号码！</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">手机验证码：</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="手机验证码" id="phonecode">
                        </div>
                  
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert">输入正确！</p>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2"></label>
                        <div class="col-lg-4">
                             <button type="button" class="btn btn-default" id="sendphonecode" data="0">发送手机验证码</button>
                        </div>
                      
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert">输入正确！</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">新登陆密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的新密码" id="password">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert">输入正确！</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-lg-2">确认新密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="再次确认您的新密码" id="matches_password">
                        </div>
                        <div class="col-lg-4" style="display:none">
                            <p class="alert alert-danger my_alert">输入正确！</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success col-md-4 co-xs-12 pull-right" id="forget_change">确认修改</button>
            </div>
        </div>
    </div>
</div>
------>

    <!-- ----------------------注册弹出-------------------->
	<!----
    <div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">30秒注册</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal mt10" action="<?php echo site_url('welcome/regesiter');?>" id="regesiter" method="post" onsubmit="return false">
                        <div class="form-group">
                            <label for="message-text" class="control-label col-lg-2">用户名：</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="nickname" id="nickname" placeholder="用户名为4-8个字符组成">
                            </div>
                            <label id="nickname_error" class="form_error" data="failed"></label> 
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label col-lg-2">手机号：</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" placeholder="请输入您的手机号" name="mobile" id="mobile">
                            </div>
                            <label id="mobile_error" class="form_error" data="failed"></label> 
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label col-lg-2">验证码：</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" placeholder="验证码" name="piccode" id="piccode">
                            </div>
                            <div class="col-lg-2">
                                <img src="<?php echo site_url('welcome/regesiter_code');?>"  alt="点击刷新,不分大小写"  style="cursor:pointer" class="piccode"/>
                            </div>
                            <label id="piccode_error" class="form_error" data="failed"></label> 
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label col-lg-2">手机验证码：</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" placeholder="手机验证码" name="phonecode" id="phonecode">
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default" id="sendcode" data="0">发送手机验证码</button>
                            </div>
                            <label id="phonecode_error" class="form_error" data="failed"></label> 
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label col-lg-2">登陆密码：</label>
                            <div class="col-lg-4">
                                <input type="password" class="form-control" placeholder="请输入您的密码" name="password" id="password">
                            </div>
                            <label id="password_error" class="form_error" data="failed"></label> 
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label col-lg-2">确认密码：</label>
                            <div class="col-lg-4">
                                <input type="password" class="form-control" placeholder="再次确认您的密码" name="matches_password" id="matches_password">
                            </div>
                            <label id="matches_password_error" class="form_error"></label> 
                        </div>
                       
                        <div class="form-group"><label class="col-lg-10 text-left" style="padding-left:65px; font-weight:normal"><small>注册蜂融帐号表示您已同意《<a href="<?php echo site_url('news/article/26');?>" target="_blank">蜂融网金融信息服务协议</a>》及《<a href="<?php echo site_url('news/article/27');?>" target="_blank">蜂融网隐私条款</a>》</small></label></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning col-md-5 col-xs-12 pull-left" style="margin-bottom: 10px;" id="regesiter_login">我有账号了，去登录</button>
                    <button type="button" class="btn btn-success col-md-4 col-xs-12 pull-right" style="margin-bottom: 10px;" id="mszc">马上注册</button>
                </div>
            </div>
        </div>
    </div>
	---->
    <!-- ----------------------登陆弹出-------------------->
	<!---
    <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">欢迎登录</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal mt10">
                        <div class="form-group" id="login_error" style="display:none">
                            <div class="col-lg-12">
                                <p class="alert alert-danger my_alert">用户名或密码错误！</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label col-lg-2">用户名：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="recipient-name"  placeholder="请输入注册时的用户名或手机号" id="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label col-lg-2">密码：</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control"  id="login_password">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left col-md-4 col-xs-12" style="margin-bottom: 10px;" id="login_regesiter">还没有账号，去注册</button>
                    <button type="button" class="btn btn-warning pull-left col-md-3 col-xs-12" style="margin-bottom: 10px;" id="login_forget" data-toggle="modal">忘记密码</button>
                    <button type="button" class="btn btn-success col-lg-4 pull-right col-xs-12" style="margin-bottom: 10px;" id="login">登录</button>
                </div>
            </div>
        </div>
    </div>
	----->