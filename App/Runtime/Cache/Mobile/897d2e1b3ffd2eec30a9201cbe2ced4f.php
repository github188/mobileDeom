<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="browsermode" content="application">
    <meta name="x5-page-mode" content="app">
    <title>嗨推学院-知名网络推广实战培训平台</title>
    <link rel="stylesheet" href="/Public/Mobile/css/base.css">
    <link rel="stylesheet" href="/Public/Mobile/css/common.css">
    <link rel="stylesheet" href="/Public/Mobile/css/style.css">
</head>
<body style="background-color: #fff;">

<!--findPwd-->
<section class="findPwd">
    <div class="in">
        <div class="withRate">
            <div class="tp">
                <img src="/Public/Mobile/images/rate01.png">
            </div>
            <div class="txt">
                <div class="tx01 cur">
                    <span>验证方式</span>
                </div>
                <div class="tx02">
                    <span>重置密码</span>
                </div>
                <div class="tx03">
                    <span>重置成功</span>
                </div>
            </div>
        </div>
        <div class="pwdInpCom">
            <div class="hd">
                <p class="tit">请输入找回密码的方式</p>
            </div>
            <form action="" method="" name="" id="c">
                <div class="logInpCom">
                    <div class="inp userInp">
                        <span class="ico"></span>
                        <input type="text" placeholder="请输入用户名/手机号/邮箱" name="urseMsg">
                    </div>
                    <div class="inp yzmInp">
                        <span class="ico"></span>
                        <input type="text" placeholder="请输入验证码" name="imgMsg" >
                        <div class="yzm">
                            <img src="<?php echo U('Mobile/Login/verify');?>" id="captcha_img" alt="验证码" height="38" width="120" class="ml16">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="myBtn" id="myBtn">
            <a href="javascript:;">下一步</a>
        </div>
        <div class="botLink">
            <p style="height: 0.4rem">如遇到问题，请<a href="javascript:;" class="link">联系客服</a></p>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>
<script>
    var yzsfUrl="<?php echo U(MODULE_NAME .'/Login/passwordWay');?>";       //找回密码---验证方式接口

    var page2="<?php echo U(MODULE_NAME .'/Login/password');?>";            //指向重置密码的路径

</script>
<!--提示插件-->
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>

<script src="/Public/Mobile/js/Hform.js"></script>

</body>
</html>