<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8" name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0">
    <meta name="Keywords" content="嗨推学院客服，嗨推在线客服，嗨推客服中心，嗨推客服网站，嗨推客服在线，，嗨推客服电话，嗨推客服，嗨推客服网站，嗨推客服首页，嗨推客服官网，嗨推官网客服，嗨推客服中心，嗨推客户服务，嗨推客服电话"/>
    <meta name="description" content="嗨推客服官网网站，为您解决使用嗨推产品过程中遇到的问题，嗨推客服中心提醒您：谨防网络骗术，教您如何识别网络骗术"/>
    <meta http-equiv="Content-Language" content="zh-cn"/>
    <meta name="robots" content="all"/>
    <meta name="author" content="Tencent-OUI"/>
    <meta name="Copyright" content="Tencent"/>
   <!-- 移动端首页样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/moblie_index.css"/>
    <link rel="stylesheet" href="/Public/Home/css/reset.css"/>
    <!-- 移动端样式-->
    <link rel="stylesheet" href="/Public/Home/css/moblie_register.css"/>
    <!--表单验证插件CSS -->
    <link rel="stylesheet" href="/Public/AdminLte/plugins/validator/jquery.validator.css">

    <title>账号登录 - <?php echo getConfig('web_name');?></title>
</head>
<body>
<!-- 头部 -->
<div class="common_header clearfix">
    <a href="<?php echo U('Index/index');?>" class="logo"></a>
    <?php if(session('ht_kf_uid')){ ?>
        <span class="denglu">
            <a href="#" class="uname"><span class="h_denglu"></span><?php echo session('ht_kf_uname');?></a>
            <a href="<?php echo U('Login/logout');?>" class="logout">[退出]</a>
        </span>
    <?php }else{ ?>
    <a href="<?php echo U('Login/index');?>" class="denglu"><span class="h_denglu"></span>登录</a>
    <?php } ?>
</div>

<!--内容块-->
<div class="login_content">
    <h1 class="h1">欢迎来到嗨推客服中心</h1>
    <div class="web_qr_login" id="web_qr_login" style="display: block;left: 36%;">
        <div class="web_login" id="web_login">
            <div class="tips" id="tips">
                <div class="title" id="title_2">登录平台</div>
            </div>
            <div class="login_form">
                <form method="post" style="margin:0px">
                    <div class="error" id="uinArea" style="display: none"> 对不起,您输入的密码不正确</div>
                    <div class="fromArea" id="pwdArea" style="margin-top: 15px">
                        <label class="input_tips">登录账号: </label>
                        <div class="inputOuter">
                            <input name="uname" type="text" class="inputstyle" value="" maxlength="20" placeholder="请输入嗨推学院账号">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips">登录密码: </label>
                        <div class="inputOuter">
                            <input type="password" class="inputstyle" name="upass" value="" maxlength="20">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips">验证码: </label>
                        <div class="inputOuter" style="width: 74%;">
                            <input type="text" class="inputstyle" name="verify" value="" maxlength="8" placeholder="验证码" style="width:100px;">
                            <img id="captcha_img" alt="点击切换" src="<?php echo U('Login/verify','','');?>" height="34" width="100" style="vertical-align: bottom;" >
                        </div>
                    </div>

                    <div class="bottom" style="margin-left: 8%;">
                        <a href="#" class="link fl" style="color: #959595" target="_blank">忘记密码？</a>
                        <a class="link fr zhuce_link" href="<?php echo U('Login/register');?>" >还没注册嗨推账号？</a>
                    </div>
                    <div class="submit" >
                        <button class="btn" type="button" onclick="loginform(this)">立即登录</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 底部 -->
<script type="text/javascript" src="/Public/AdminLte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!--表单验证插件 参考http://niceue.com/validator/-->
<script src="/Public/AdminLte/plugins/validator/jquery.validator.js?local=zh-CN"></script>
<script type="text/javascript">

    //异步登录
    function loginform(obj) {
        var item =  $('#uinArea');
        var uname = $('form input[name=uname]').val();
        var upass = $('form input[name=upass]').val();
        var verify = $('form input[name=verify]').val();
        if(uname =='' || upass =='') {
            item.css('display','');
            item.html('登录账号或密码不能为空！');
            return false;
        }

        if(verify =='') {
            item.css('display','');
            item.html('验证码不能为空！');
            return false;
        }

        // $('#uinArea').css('display','none');

        $.ajax({
            type    : 'post',
            async   : true,
            dataType: 'json',
            url     : "<?php echo U('Login/index');?>",
            data    : {name:uname,pass:upass,verify:verify},
            success : function(data) {
                if (data.status ==1) {
                    window.location.href = data.url;
                    return false;
                }else{
                    item.css('display','');
                    item.html(data.info);
                    //刷新验证码
                    $("#captcha_img").click();
                    $("input[name=upass]").val('');
                    $("input[name=verify]").val('');
                }

            }
        });

    }

    //刷新验证码
    var URL = $("#captcha_img").attr("src");
    $("#captcha_img").click(function(){
        $("#captcha_img").attr("src",URL+'/'+Math.random());
        return false;
    });

</script>