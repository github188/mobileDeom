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
<body>

<!--mySetting-->
<section class="mySetting">
    <div class="in">
        <div class="setList">
            <ul>
                <li>
                    <a href="<?php echo U('Safe/phoneStaus');?>" class="item">
                        <div class="tl">
                            <s class="ico"></s>
                            <span class="ti">手机绑定</span>
                        </div>
                        <div class="tr">
                            <span class=""><?php echo ($user_info['mobile']?substr_replace($user_info['mobile'],'****',3,4):'未绑定'); ?></span>
                        </div>
                        <i class="arr"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Safe/emailStaus');?>" class="item">
                        <div class="tl">
                            <s class="ico"></s>
                            <span class="ti">邮箱绑定</span>
                        </div>
                        <div class="tr">
                            <span class=""><?php echo ($user_info['email']?substr_replace($user_info['email'],'****',3,4):'未绑定'); ?></span>
                        </div>
                        <i class="arr"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Safe/weixin');?>" class="item">
                        <div class="tl">
                            <s class="ico"></s>
                            <span class="ti">微信绑定</span>
                        </div>
                        <div class="tr">
                            <span class=""><?php echo empty($user_info['weixin_openid']) && empty($user_info['weixin_unionid'])?'未绑定':'已绑定';?></span>
                        </div>
                        <i class="arr"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Safe/password');?>" class="item">
                        <div class="tl">
                            <s class="ico"></s>
                            <span class="ti">修改密码</span>
                        </div>
                        <div class="tr">
                            <span class="">修改</span>
                        </div>
                        <i class="arr"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Safe/myBankList');?>" class="item">
                        <div class="tl">
                            <s class="ico"></s>
                            <span class="ti">银行卡绑定</span>
                        </div>
                        <div class="tr">
                            <span class=""><?php echo ($bankCard?'已绑定':'未绑定'); ?></span>
                        </div>
                        <i class="arr"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

</body>
</html>