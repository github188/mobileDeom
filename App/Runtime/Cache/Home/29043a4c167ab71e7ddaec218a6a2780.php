<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="Keywords" content="嗨推学院客服，嗨推在线客服，嗨推客服中心，嗨推客服网站，嗨推客服在线，，嗨推客服电话，嗨推客服，嗨推客服网站，嗨推客服首页，嗨推客服官网，嗨推官网客服，嗨推客服中心，嗨推客户服务，嗨推客服电话"/>
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
    <title>账号登录 - <?php echo getConfig('web_name');?></title>
</head>
<body class="home" id="home">

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
    <!--<div class="web_qr_login" id="web_qr_login" style="top: 24%;left: 50%;margin-left: -320px; position: absolute">-->
    <div class="web_qr_login" id="web_qr_login" style="top: 24%;left: 50%;margin-left: -285px;">
            <div class="web_login" id="web_login">
                <div class="tips" id="tips">
                    <div class="title" id="title_2">登录平台</div>
                </div>
                <div class="login_form">
                    <form method="post" style="margin:0px">
                        <div class="error" id="uinArea" style="display: none"> 对不起,您输入的密码不正确</div>
                        <div class="fromArea" id="pwdArea" style="margin-top: 15px">
                            <label class="input_tips">登录账号 : </label>
                            <div class="inputOuter">
                                <input name="uname" type="text" class="inputstyle" value="" maxlength="20" placeholder="请输入嗨推学院账号">
                            </div>
                        </div>
                        <div class="fromArea">
                            <label class="input_tips">登录密码 : </label>
                            <div class="inputOuter">
                                <input type="password" class="inputstyle" name="upass" value="" maxlength="20">
                            </div>
                        </div>
                        <div class="fromArea">
                            <label class="input_tips">验证码 : </label>
                            <div class="inputOuter">
                                <input type="text" class="inputstyle" name="verify" value="" maxlength="8" placeholder="验证码" style="width:100px;">
                                <img id="captcha_img" alt="点击切换" src="<?php echo U('Login/verify','','');?>" height="38" width="130" style="margin-left:10px;margin-top: -8px;" >  
                            </div>
                        </div>

                        <div class="bottom" style="margin-left: 195px;">
                            <a href="#" class="link fl" style="color: #959595" target="_blank">忘记密码？</a>
                            <a class="link fr zhuce_link" href="<?php echo U('Login/register');?>" >还没注册嗨推账号？</a>
                        </div>
                        <div class="submit" style="padding: 20px 190px 20px 240px;">
                            <button class="btn" type="button" onclick="loginform(this)">立即登录</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
<!-- 底部 -->
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