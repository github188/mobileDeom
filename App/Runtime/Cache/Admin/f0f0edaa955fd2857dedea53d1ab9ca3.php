<?php if (!defined('THINK_PATH')) exit();?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       	<meta charset="utf-8" />
    	<title><?php echo getConfig('web_name');?> - 后台管理登陆</title>
    	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
    	<meta content="" name="description" />
    	<meta content="" name="author" />
    	<link rel="stylesheet" href="/Public/Static/css/bootstrap.min.css">
    	<link rel="stylesheet" href="/Public/Static/css/bootstrap-theme.min.css">
    	<script src="/Public/Static/js/jquery.min.js"></script>
    	<script src="/Public/Static/js/bootstrap.min.js"></script>
    	<link rel="shortcut icon" href="/Public/Static/images/favicon.ico" />
    	<link rel="stylesheet" href="/Public/Static/css/form-elements.css">
        <link rel="stylesheet" href="/Public/Static/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="/Public/Static/js/libs/html5shiv.js"></script>
            <script src="/Public/Static/js/libs/respond.min.js"></script>
        <![endif]-->
        <script src="/Public/Static/js/jquery-1.7.2.min.js"></script>
        <script src="/Public/Static/js/jquery.cookie.js"></script>
        <script type="text/javascript">
        var COOKIE_NAME = 'cg_sys_uname';
        $(function() {
            if ($.cookie(COOKIE_NAME)){
                $("#form-username").val($.cookie(COOKIE_NAME));
                $("#form-password").focus();
                $("#form-remember").attr('checked', true);
            } else {
                $("#form-username").focus();
            }

            //刷新验证码
            var URL = $("#captcha_img").attr("src");
            $("#captcha_img").click(function(){
                $("#captcha_img").attr("src",URL+'/'+Math.random());
                return false;
            });

            $("#login_form").submit(function(){
                var $remember = $("#form-remember");
                if ($remember.attr('checked')) {
                    $.cookie(COOKIE_NAME, $("#form-username").val(), { path: '/', expires: 15 });
                } else {
                    $.cookie(COOKIE_NAME, null, { path: '/' });  //删除cookie
                }

                var self = $(this);
                $.post(self.attr("action"), self.serialize(), success, "json");
                return false;

                function success(data){
                    if(data.status){
                        window.location.href = data.url;
                    } else {
                        $("#msg_info").text(data.info);
                        //刷新验证码
                        $("#captcha_img").click();
                        $("input").val(''); 

                    }
                }

                return false;
            });
        });

        </script>

    </head>

    <body background="">
        <!-- Top content -->
        <div id="formbackground" class="linear">  
        <!-- <img src="/Public/Static/images/admin_log_bg.png" height="100%" width="100%"/>   -->
        </div>
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                             <img src="/Public/Static/images/logo.png"   height="100"style="margin:0 auto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>嗨推后台管理登录</h3>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form action="<?php echo U(MODULE_NAME .'/Login/login');?>" id="login_form" method="post" class="form-vertical login-form">
                                    <div class="form-group" style="margin-bottom:13px;">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="name" placeholder="用户名" class="Mailbox" id="form-username" style="background: #ffffff none repeat scroll 0 0;border: 1px solid #d0d0d0;display: inline-block;height: 34px;line-height: 34px;padding: 0 10px;width: 288px;color: #878787;">
                                    </div>
			                        <div class="form-group" style="margin-bottom:13px;">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password"  name="pass" placeholder="密码..." class="form-password form-control" id="form-password" style="background: #ffffff none repeat scroll 0 0;border: 1px solid #d0d0d0;display: inline-block;height: 34px;line-height: 34px;padding: 0 10px;width: 288px;color: #878787">
			                        </div>
			                        <div class="form-group" style="margin-bottom:13px;">
    			                        <input type="text" id="verify" name="verify" placeholder="验证码" autocomplete="off"  class="m-wrap placeholder-no-fix" style="background: #ffffff none repeat scroll 0 0;border: 1px solid #d0d0d0;display: inline-block;height: 34px;line-height: 34px;padding: 0 10px;width: 120px;color: #878787">
                                        <img id="captcha_img" alt="点击切换" src="<?php echo U(MODULE_NAME .'/Login/verify','','');?>" height="38" width="130" style="float:right;margin-right:130px" >  
                                         
               						</div>
					                <label class="checkbox" style="margin-left:20px;color:#878787;font-weight:400;line-height:30px;vertical-align:center;font-size:16px;">
    									<input type="checkbox" id="form-remember" name="remember" value="true" style="margin-top:10px" /> 记住登陆账号!
                                        <span id="msg_info" style="margin-left:40px;font-size:16px;color: #f00"></span>
								    </label>
			                        <button type="submit" class="loginbtn">登录</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                  
                </div>
            </div>
            
        </div>

    	<div class="copyright">
    		2016 &copy; 嗨推 版权所有
    	</div>
    </body>
</html>