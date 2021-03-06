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
                <img src="/Public/Mobile/images/rate02.png">
            </div>
            <div class="txt">
                <div class="tx01 cur">
                    <span>验证方式</span>
                </div>
                <div class="tx02 cur">
                    <span>重置密码</span>
                </div>
                <div class="tx03">
                    <span>重置成功</span>
                </div>
            </div>
        </div>
        <div class="pwdInpCom">
            <div class="hd">
                <p class="tit">已经发送验证码到您的<em class="phoNum">135*****5251</em></p>
            </div>
            <form action="" method="" name="" id="d">
                <div class="logInpCom">
                    <div class="inp mesInp">
                        <span class="ico"></span>
                        <input type="text" placeholder="请输入短信验证码" id="code">
                    </div>
                    <div class="inp pwdInp">
                        <span class="ico"></span>
                        <input type="password" placeholder="请输入密码" id="oldPsd">
                    </div>
                    <div class="inp pwdInp">
                        <span class="ico"></span>
                        <input type="password" placeholder="请再次输入密码" id="newPsd">
                    </div>
                </div>
            </form>
        </div>
        <div class="myBtn confirPsd">
            <a href="javascript:;">确认重置</a>
        </div>
        <div class="botLink">
            <p>如遇到问题，请<a href="javascript:;" class="link">联系客服</a></p>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>
<script>
    var backPsdUrl="<?php echo U(MODULE_NAME .'/Login/password');?>";        //找回密码 ---重置密码的接口

    var page3Url="<?php echo U(MODULE_NAME .'/Login/passwordSuccess');?>"   //重置成功

</script>

<!--提示插件-->
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>

<script src="/Public/Mobile/js/Hform.js"></script>
</body>
</html>