<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8" name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0">
    <title>文章搜索列表 - 嗨推客服中心</title>
   <!-- 移动端首页样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/moblie_index.css"/>
    <link rel="stylesheet" href="/Public/Home/css/reset.css"/>
    <!-- 移动端样式-->
    <link rel="stylesheet" href="/Public/Home/css/moblie_register.css"/>
    <!--表单验证插件CSS -->
    <link rel="stylesheet" href="/Public/AdminLte/plugins/validator/jquery.validator.css">

</head>
<body>
<!-- 头部 -->
<div class="common_header clearfix">
    <a href="<?php echo U(MODULE_NAME.'/Index/index');?>" class="logo"></a>
    <?php if(session('ht_kf_uid')){ ?>
        <span class="denglu">
            <a href="#" class="uname"><span class="h_denglu"></span><?php echo session('ht_kf_uname');?></a>
            <a href="<?php echo U(MODULE_NAME.'/Login/logout');?>" class="logout">[退出]</a>
        </span>
    <?php }else{ ?>
    <a href="<?php echo U(MODULE_NAME.'/Login/index');?>" class="denglu"><span class="h_denglu"></span>登录</a>
    <?php } ?>
</div>
<!--内容块-->
<div class="login_content clearfix">
    <h1 class="h1">欢迎来到嗨推客服中心</h1>
    <div class="web_qr_login" id="web_qr_login">
        <div class="web_login" id="web_login">
            <div class="tips" id="tips">
                <div class="title" id="title_2">注册嗨推学院账号</div>
            </div>
            <div class="login_form">
                <form action="<?php echo U(MODULE_NAME.'/Login/register');?>" method="post" style="margin:0px">
                    <div class="error" id="uinArea" style="display: none"> 对不起,请填写完整</div>
                    <div class="fromArea">
                        <label class="input_tips" >登录账号: </label>
                        <div class="inputOuter">
                            <input type="text" class="inputstyle"  name="name" value="" maxlength="18"  placeholder="请输入4-16位登录用户名" data-rule="required;length[4~16];">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" >登录密码: </label>
                        <div class="inputOuter">
                            <input type="password" class="inputstyle"  name="pass" value="" maxlength="18" data-rule="required;password;">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips">确认密码: </label>
                        <div class="inputOuter">
                            <input type="password" class="inputstyle"  name="pass2" value="" maxlength="18" data-rule="required;password;match[pass]">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" >手机号码: </label>
                        <div class="inputOuter">
                            <input type="text" style="width: 137px" class="inputstyle"  name="mobile" value="" maxlength="11" placeholder="请输入手机号码" data-rule="required;mobile;">
                            <button type="button" class="from_btn" id="from_btn" onclick="getMobileCode(this)">获取验证码</button>
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" >验证码: </label>
                        <div class="inputOuter">
                            <input type="text" class="inputstyle"  name="code" value="" maxlength="8"  placeholder="请输入手机短信验证码" data-rule="required;">
                        </div>
                    </div>
                    <div class="bottom"  style="margin-left: 8%;">
                        <label style="color: #959595;" title="请查看并勾选同意嗨推用户协议">
                            <input type="checkbox" value="" checked> 同意
                            《<a href="http://xue.hitui.com/index.php?m=public&c=index&a=xieyi" target="_blank"  style="color: #00ace9">用户协议</a>》
                        </label>
                        <a class="link fr zhuce_link" href="<?php echo U(MODULE_NAME.'/Login/index');?>">已有嗨推账号？</a>
                    </div>

                    <div class="submit" >
                        <button type="submit" class="btn">立即注册</button>
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
    //表单验证
    $('form').validator({
        theme: "yellow_right_effect", //消息皮肤
        msgClass: "n-top",//控制消息的显示位置CLSSS
        msgStyle: "" //消息自定义样式
    });

    function getMobileCode(obj) {

        var item =  $('#uinArea');
        var mobile_ = $('form input[name=mobile]').val();
        if(mobile_ =='') {
            item.css('display','');
            item.html('请输入合法的手机号码！');
            return false;
        }

        $.ajax({
            type    : 'post',
            async   : true,
            dataType: 'json',
            url     : "<?php echo U(MODULE_NAME.'/Login/getMobileCode');?>",
            data    : {mobile:mobile_},
            success : function(e) {
                item.css('display','');
                item.html(e.info);
                $("input[name=code]").val('').focus();
                if (e.status ==1) {
                    //发送成功
                    emailColok(obj);
                    return false;
                }else{
                    // alert("操作失败");
                }
            }
        });
    }

    // 倒计时的处理
    var mstime = 90;
    function emailColok(obj){
        $(obj).css("disabled",true);
        $(obj).css("cursor", "not-allowed");
        var clock=setInterval(function(){
            $(obj).attr("disabled", "disabled");
            $("#from_btn").attr({"disabled":"disabled"});
            $(obj).text(mstime+"s后获取");
            console.log(obj);
            mstime--;
            console.log(mstime);
            if(mstime<=1){  //要是时间是等于0，就清除定时器了，不然时间就会出现负数.
                $(obj).css("disabled",false);
                $(obj).css("cursor", "default");
                clearInterval(clock);
                $(obj).text("获取验证码");
            }
        },500);
    }

</script>
</body>
</html>