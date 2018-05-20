<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>注册新账号 - <?php echo getConfig('web_name');?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="Keywords" content=" 嗨推学院客服，嗨推在线客服，嗨推客服中心，嗨推客服网站，嗨推客服在线，，嗨推客服电话，嗨推客服，嗨推客服网站，嗨推客服首页，嗨推客服官网，嗨推官网客服，嗨推客服中心，嗨推客户服务，嗨推客服电话"/>
    <meta name="description" content="嗨推客服官网网站，为您解决使用嗨推产品过程中遇到的问题，嗨推客服中心提醒您：谨防网络骗术，教您如何识别网络骗术"/>
    <meta http-equiv="Content-Language" content="zh-cn"/>
    <meta name="robots" content="all"/>
    <meta name="author" content="Tencent-OUI"/>
    <meta name="Copyright" content="Tencent"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/kefu_public.css">
    <!--  引入首页的部分样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css"/>
    <!-- Font Awesome 图标字体 -->
    <link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/Home/css/login_content.css">
    <!--表单验证插件CSS --> 
    <link rel="stylesheet" href="/Public/AdminLte/plugins/validator/jquery.validator.css">
    
</head>
<body>
<!-- 头部 -->
<script type="text/javascript" src="/Public/AdminLte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="<?php echo U('Index/index');?>"><i class="logo_img"></i></a>
        </div>
        <div class="member">
            <div class="photo">
                <?php if(!session('ht_kf_uid')): ?><div>
                        <a href="<?php echo U('Login/index');?>" class="loginBtn" style="">登录</a>
                        <a href="<?php echo U('Login/register');?>" class="registerBtn" style="">注册</a>
                    </div>
                <?php else: ?>
                    <div style=""  class="headBtn">
                        <img src="http://xue.hitui.com/templates/front_new/img/face/<?php echo session('ht_kf_face') ? session('ht_kf_face') :1;?>.png">
                    </div>
                    <div style="" class="nameBtn">
                        <span style="white-space:nowrap">
                            <?php echo session('ht_kf_uname');?>
                            <a href="<?php echo U('Login/logout');?>" style="padding-left: 15px;">退出</a>
                        </span>
                        <span style="white-space:nowrap;">
                            <?php echo session('ht_kf_groupname') ? session('ht_kf_groupname') :'试听会员';?>
                        </span>
                    </div><?php endif; ?> 
            </div>

        </div>
    </div>
</div>

    


<div class="login_content">
    <h1 class="h1">欢迎来到嗨推客服中心</h1>
    <div class="web_qr_login" id="web_qr_login" style="display: block;top: 24%;left: 50%;margin-left: -350px;">
        <div class="web_login" id="web_login">
            <div class="tips" id="tips">
                <div class="title" id="title_2">注册嗨推学院账号</div>
            </div>
            <div class="login_form">
                <form action="<?php echo U('Login/register');?>" method="post" style="margin:0px">
                    <div class="error" id="uinArea" style="display: none"> 对不起,请填写完整</div>
                    <div class="fromArea">
                        <label class="input_tips" style="width: 130px;margin-right: 10px;text-align: right">登录账号: </label>
                        <div class="inputOuter">
                            <input type="text" class="inputstyle"  name="name" value="" maxlength="18"  placeholder="请输入4-16位登录用户名" data-rule="required;length[4~16];">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" style="width: 130px;margin-right: 10px;text-align: right">登录密码: </label>
                        <div class="inputOuter">
                            <input type="password" class="inputstyle"  name="pass" value="" maxlength="18" data-rule="required;password;">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" style="width: 130px;margin-right: 10px;text-align: right">确认密码: </label>
                        <div class="inputOuter">
                            <input type="password" class="inputstyle"  name="pass2" value="" maxlength="18" data-rule="required;password;match[pass]">
                        </div>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" style="width: 130px;margin-right: 10px;text-align: right">手机号码: </label>
                        <div class="inputOuter">
                            <input type="text" class="inputstyle"  name="mobile" value="" maxlength="11" placeholder="请输入手机号码" data-rule="required;mobile;">
                        </div>
                        <button type="button" class="from_btn" id="from_btn" onclick="getMobileCode(this)">获取验证码</button>
                    </div>
                    <div class="fromArea">
                        <label class="input_tips" style="width: 130px;margin-right: 10px;text-align: right">验证码: </label>
                        <div class="inputOuter">
                            <input type="text" class="inputstyle"  name="code" value="" maxlength="8"  placeholder="请输入手机短信验证码" data-rule="required;">
                        </div>
                    </div>
                    <div class="bottom" style="margin-left: 232px">
                        <label style="color: #959595;margin-right: 15px" title="请查看并勾选同意嗨推用户协议">
                            <input type="checkbox" value="" checked> 同意
                            《<a href="http://xue.hitui.com/index.php?m=public&c=index&a=xieyi" target="_blank"  style="color: #00ace9">用户协议</a>》
                        </label> 
                        <a class="link fr zhuce_link" href="<?php echo U('Login/index');?>">已有嗨推账号？</a>
                    </div>

                    <div class="submit" style="padding-left: 280px;padding-right: 280px">
                        <button type="submit" class="btn">立即注册</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 底部 -->

<!--表单验证插件 参考http://niceue.com/validator/--> 
<script src="/Public/AdminLte/plugins/validator/jquery.validator.js?local=zh-CN"></script>
<script type="text/javascript">
    //表单验证
    $('form').validator({
        theme: "yellow_right_effect", //消息皮肤
        msgStyle: "margin-left:3px; margin-top:3px;" //消息自定义样式
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
            url     : "<?php echo U('Login/getMobileCode');?>",
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
            $(obj).text(mstime+"s后重新获取");
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
<div class="layer">
    <ul id="right_service">
        <li>
            <a href="javascript:void(0);" class="icon-weixin"></a>
            <div class="layer_box wechat_box">
                <i class="wechat_code"></i>
                <span>嗨推学院公众号</span>
            </div>
        </li>
        <li>
            <a href="javascript:void(0);" class="icon-qq"></a>
            <div class="layer_box qq_box">
                <i class="qq_code"></i>
                <span>嗨推微信公众号</span>
            </div>
        </li>
        <li>
            <a href="javascript:void(0);" class="icon-phone"></a>
            <div class="layer_box phone_box">
                <dl>
                    <dd><em>客服QQ</em>800062138</dd>
                    <dd><em>服务热线</em>020 - 36700550</dd>
                    <dd><em>邮箱地址</em>ceo@ihitui.com</dd>
                    <dt>目前仅提供以上业务的电话服务，其他产品请在本网站寻求帮助</dt>
                </dl>
            </div>
        </li>
        <li>
            <a href="javascript:void(0);" class="icon-throw"></a>
        </li>
    </ul>
</div>

<!--尾部begin-->
<div class="footer">
    <div class="container">
        <div class="leftArea">
            <p>
                <a href="http://xue.hitui.com">嗨推学院</a>
                <a href="http://bbs.hitui.com">嗨推社区</a>
                <a href="http://course.hitui.com">学员教研室</a>
                <a href="http://kf.hitui.com">客服中心</a>
            </p>
            <p id="copyright">Copyright © 2013 - 2017 嗨推学院在线教育学习平台 版权所有</p>
        </div>
        <div class="rightArea">
            <ul class="codes">
                <li>
                    <div class="codeBox">
                        <img src="/Public/Home/erweima/wechat_code.png">
                    </div>
                    <span>嗨推学院微信公众号</span>
                </li>
                <li>
                    <div class="codeBox">
                        <img src="/Public/Home/erweima/hitui_app.png">
                    </div>
                    <span>嗨推APP客户端下载</span>
                </li>
            </ul>
        </div>
        <i class="iconfont icon-goUp goTop" id="goTop" style="display: none"></i>
    </div>
</div>

<!--尾部end-->
<script type="text/javascript">
    //头部---缩放
    $(function($) {
        $(".problems a").on("mouseover",
                function() {
                    $(this).addClass("active").siblings().removeClass("active");
                });
        $(window).scroll(function() {
            if($(this).scrollTop() > 275){
                $('.header').addClass('header-scroll');
                $('.searchHide').show();
            } else {
                $('.header').removeClass('header-scroll');
                $('.searchHide').hide();
            }
        });

        var current = $(".faq_kinds dl").find('.current');
        if(current.length>0){
            current.parents('dl').siblings('a').find('i').removeClass('fa-angle-right').addClass('fa-angle-down');
            current.parents('dl').slideDown(0);
        }

        $('.leftTab').on('click',function(){
            var down_ = $(this).attr('down');
            var that=$(this);
            if (down_ ==0) {
                that.find('i').removeClass('fa-angle-down');
                that.find('i').addClass('fa-angle-right');
                that.attr('down',1);
                // that.next('dl').css('display','block');
                that.next('dl').stop().slideDown(0);
                return false;

            }else{
                that.find('i').removeClass('fa-angle-right');
                that.find('i').addClass('fa-angle-down');
                that.attr('down',0);
                // that.next('dl').css('display','none');
                that.next('dl').stop().slideUp(0);
            }
        }); 

    });

</script>
</body>
</html>