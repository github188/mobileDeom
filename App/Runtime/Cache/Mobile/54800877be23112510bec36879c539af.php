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

<!--backCom-->
<section class="backCom"><a href="javascript:history.back(-1);"></a></section>

<!--myBasic-->
<section class="myBasic">
    <div class="in">
        <div class="remTip">
            <p class="tx">注：标星号*处必填，否则无法查看视频</p>
            <i class="close js-shut"></i>
        </div>
        <div class="myInpCom">
            <form action="" method="post" name="" id="">
                <div class="inp">
                    <span class="ti">教研室账号</span>
                    <input type="text" placeholder="请填写教研室用户名" name="uc_username" value="<?php echo ($user_info['uc_username']); ?>">
                </div>
                <div class="inp">
                    <span class="ti">教研室密码</span>
                    <input type="password" placeholder="请填写教研室密码" name="uc_password" value="">
                </div>
                <div class="inp">
                    <span class="ti">真实姓名</span>
                    <input type="text" placeholder="请填写真实姓名" name="realname" value="<?php echo ($user_info['realname']); ?>">
                </div>
                <div class="inp">
                    <span class="ti">微信号码<em>*</em></span>
                    <input type="text" placeholder="请填写微信号码" name="weixin_username" id="wx" value="<?php echo ($user_info['weixin_username']); ?>">
                </div>
                <div class="inp">
                    <span class="ti">QQ号码<em>*</em></span>
                    <input type="text" placeholder="请填写QQ号码" name="qq" id="qq"  value="<?php echo ($user_info['qq']); ?>">
                </div>
                <div class="inp">
                    <span class="ti">公司名称</span>
                    <input type="text" placeholder="请填写公司名称" name="company" value="<?php echo ($user_info['company']); ?>">
                </div>
                <div class="inp">
                    <span class="ti">所在城市</span>
                    <input type="text" placeholder="请填写所在城市" name="city" value="<?php echo ($user_info['city']); ?>">
                </div>
                <div class="inp">
                    <span class="ti">所在行业</span>
                    <input type="text" placeholder="请填写所在行业" name="trade" value="<?php echo ($user_info['trade']); ?>">
                </div>
            </form>
        </div>
        <div class="myBtn">
            <a href="javascript:;">保存</a>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>

<script>
    var formActionUrl = "<?php echo U('User/myInfo');?>";
    //用户资料修改
    $('.myBtn').on('click', function(){
        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: $('form').serialize(),
            success: function(data){
                //提示
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                if(data.status==0){
                    return false;
                }
                if(data.url!=''){
                    setTimeout(function(){
                        location.href = data.url;
                    },2000);
                }
            }
        });
    });

</script>
</body>
</html>