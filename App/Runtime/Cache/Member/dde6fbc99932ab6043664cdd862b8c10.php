<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>嗨推学院-知名网络推广实战培训平台</title>
    <link rel="shortcut icon" href="/Public/Member/images/favicon.ico">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_lemhis1loyqcwhfr.css">
    <link rel="stylesheet" href="/Public/Member/pugins/libs/layui-master/css/layui.css">
    <link rel="stylesheet" href="/Public/Member/pugins/libs/validator/dist/jquery.validator.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.static.runoob.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/Public/Member/css/base.css">
    <link rel="stylesheet" href="/Public/Member/css/common.css">
    <link rel="stylesheet" href="/Public/Member/css/loginBefore.css">
</head>
<body>

<!--[if lt IE 9]>
<div class="chromeframe">您使用的IE浏览器版本过低，本站不再支持，<a href="http://windows.microsoft.com/">升级您的IE浏览器</a>，或使用<a
        href="http://www.google.cn/chrome/">Google Chrome</a>、<a href="http://www.firefox.com.cn/download/">Firefox</a>等高级浏览器，将会得到更好的体验！
</div>
<![endif]-->

<header class="toolBar clearfix" id="toolBar">
    <div class="in w1100 m0a">
        <div class="inL fl">
            <div class="sp app">
                <a href="javascript:;">
                    <i class="iconfont icon-shouji"></i><span>手机APP</span>
                </a>
            </div>
            <div class="sp wx">
                <a href="javascript:;">
                    <i class="iconfont icon-weixin_sel "></i>
                    <span>微信公众号</span>
                </a>

                <div class="ewmPop">
                    <i></i>
                    <div class="con">
                        <a href="javascript:;">
                            <img src="/Public/Member/images/ewmWx.png"  alt="嗨推微信公众号">
                        </a>
                        <p>[微信公众号]</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="inR fr">
            <div class="sp tel">
                <a href="javascript:;">
                    <i class="iconfont icon-telphone"></i>
                    <span>联系电话&nbsp;&nbsp;020-36700550</span>
                </a>
            </div>
            <div class="sp chat">
                <a href="<?php echo U('Content/contactUs');?>">
                    <span>联系我们</span>
                </a>
            </div>
            <div class="sp kf">
                <a href="<?php echo U('Home/Index/index');?>">
                    <span>客服中心</span>
                </a>
            </div>
        </div>

    </div>
</header>

<section class="header clearfix" id="header">
    <div class="in w1100 m0a ">
        <div class="inL fl">
            <div class="logo">
                <h1>
                    <a href="<?php echo U('Index/index');?>" title="嗨推学院"></a>
                </h1>
            </div>
        </div>
        <div class="inR fr">
            <nav class="nav fl">
                <ul>
                    <li><a href="<?php echo session(C('USER_AUTH_UID'))?U('Study/index'):U('Index/index');?>" class="ti">首页</a><span></span></li>
                    <li><a href="<?php echo U('Index/videoList');?>" class="ti">热门视频</a><span></span></li>
                    <li class="down">
                        <a href="<?php echo U('Index/course');?>" class="ti">课程介绍</a><span></span>
                         <div class="Hlist">
                             <ul>
                                 <li><a href="#">推广精英</a></li>
                                 <li><a href="#">微信引流与变现</a></li>
                                 <li><a href="#">社交电商</a></li>
                                 <li><a href="#">淘宝客项目</a></li>
                                 <li><a href="#">试听会员</a></li>
                             </ul>
                         </div>
                    </li>
                    <li><a href="<?php echo U('Study/newQuestion');?>" class="ti">学习助手</a><span></span></li>
                    <li class="mes"><a href="<?php echo U('User/myNews');?>" class="ti">消息</a><span></span><i class="mesNum">0</i></li>
                </ul>
            </nav>
            <div class="rCon fr">
                <div class="sel fl">
                    <form id="key_word_form" action="<?php echo U('Index/videoList');?>">
                        <input type="text" name="key_word" value="<?php echo cookie('key_word');?>" placeholder="视频名称">
                        <a onclick="$('#key_word_form').submit();" class="ico iconfont icon-sousuo"></a>
                    </form>

                </div>

                <?php if(session(C('USER_AUTH_UID'))): ?><!--已登录 start-->
                    <div class="myTx fl">
                        <div class="tx">
                            <a href="javascript:;"><img src="/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png" alt="个人头像"></a>
                        </div>

                        <div class="myList">
                            <i></i>
                            <ul>
                                <li><a href="<?php echo U('User/myAccount');?>">个人中心</a></li>
                                <li><a href="<?php echo U('Safe/securityList');?>">安全设置</a></li>
                                <li><a href="<?php echo U('User/myInfo');?>">用户信息</a></li>
                                <li><a href="<?php echo U('Login/loginOut');?>">退出</a></li>
                            </ul>
                        </div>

                    </div>
                <!--已登录 end-->
                <?php else: ?>
                    <!--未登录 start-->
                    <div class="loginBtn fl">
                        <a href="<?php echo U('Login/index');?>">登录</a>
                    </div>
                    <!--未登录 end--><?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!--content-->
<div class="content bgColor">
    <div class="login-bg"></div>
    <div class="webLogin" id="web_qr_login">
        <div class="panel-header">
            <span class="panel-title-register">注册用户</span>
        </div>

        <div class="panel-body padder-md-login">
            <form action="<?php echo U('Login/register');?>" method="post" name="myForm" id="regMyForm" data-validator-option="{stopOnError:true}" autocomplete="off">
                <div class="error"></div>
                <div class="input-group input-group-change">
                         <span class="input-group-addon">
                             <i class="iconfont icon-user icon-change"></i>
                         </span>
                    <input class="form-control" placeholder="请输入用户名" name="username" maxlength="12" data-rule="用户名:required;username;">
                </div>
                <div class="input-group input-group-change">
                         <span class="input-group-addon">
                             <i class="iconfont icon-mima icon-change"></i>
                         </span>
                    <input class="form-control last-passsword" type="password" placeholder="请输入登录密码，6-16个字符" maxlength="16" name="pwd" data-rule="密码: required;password;length(6~16);">
                </div>
                <div class="input-group input-group-change">
                         <span class="input-group-addon">
                             <i class="iconfont icon-mima icon-change"></i>
                         </span>
                    <input class="form-control last-passsword" type="password" placeholder="请再次输入登录密码" maxlength="16" name="confirm_pwd" data-rule="确认密码: match(pwd);">
                </div>
                <div class="input-group input-group-change">
                         <span class="input-group-addon">
                             <i class="iconfont icon-shoujihao1 icon-change icon-change-new"></i>
                         </span>
                    <input class="form-control last-passsword" type="text" placeholder="请输入手机号" maxlength="11" name="mobile"  data-rule="手机号:required;mobile;">
                </div>
                <div class="input-group borderNone">
                    <div class="borderChange inlineBlock divWidth61 input-group-change">
                         <span class="input-group-addon">
                            <i class="iconfont icon-duanxinyanzhengma icon-change"></i>
                         </span>
                        <input class="form-control from-control-change" type="text" maxlength="6"  placeholder="请输入验证码" name="mobile_code" data-rule="验证码:required;" >
                    </div>

                    <input type="button" href="javascript:;" class="layui-btn layui-btn-primary  layui-btn-primary-new ml32" value="获取验证码" id="sendMobileCode" />
                </div>

                <div class="form-group clearfix">
                    <label class="checkbox i-checks text-left ft13">
                        <input name="" id="rmb" type="checkbox" value="" checked class="ck js-ck"><i></i>
                        <input id="rememberme" name="rememberme" value="" type="hidden">
                        我已经阅读并接受<span class="">《用户协议》</span>
                    </label>
                </div>
                <input type="hidden" value="1" name="register">
                <button type="submit" class="btn webBtn w-full mt18 mb20" id="submit_btn">立即注册</button>
            </form>
        </div>

        <div class="panel-footer clearfix mb20 textRight">
            <p  class="mr50  clearfix">
                <a href="#" class="ft16">已有账号？ </a>
                <a href="<?php echo U('Login/index');?>" class="commonColor ft16">立即登录</a>
            </p>
        </div>

    </div>
</div>

<!--footer-->
<footer class="footer clearfix mt20" id="footer">
    <div class="footHd w1100 m0a">
        <div class="hdL fl">
            <div class="log">
                <a href="javascript:;">
                    <img src="/Public/Member/images/htsLogo.png"  alt="嗨推学院">
                </a>
            </div>
            <div class="telTime">
                <div class="tel">
                    <p class="p1">公司电话</p>
                    <p class="p2">020-36700550</p>
                </div>
                <div class="time">
                    <p>工作日&nbsp;&nbsp;9:00-18:00&nbsp;&nbsp;周一至周六</p>
                </div>
            </div>
        </div>
        <div class="hdM fl">

            <div class="item">
                <h6>联系我们</h6>
                <ol>
                    <li><a href="<?php echo U('Content/index');?>">公司简介</a></li>
                    <li><a href="<?php echo U('Content/contactUs');?>">在线留言</a></li>
                    <li><a href="<?php echo U('Content/contactUs');?>">联系方式</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>帮助中心</h6>
                <ol>
                    <li><a href="<?php echo U('Content/problemList');?>">常见问题</a></li>
                    <li><a href="<?php echo U('Content/goodShareList');?>">干货分享</a></li>
                    <li><a href="<?php echo U('Home/Index/index');?>">客服中心</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>关于我们</h6>
                <ol>
                    <li><a href="<?php echo U('Index/course');?>">课程介绍</a></li>
                    <li><a href="<?php echo U('Content/studentSay');?>">精英学员</a></li>
                    <li><a href="<?php echo U('Content/openVideo');?>">学员视频</a></li>
                </ol>
            </div>
        </div>
        <div class="hdR fr">
            <div class="ewm" id="ewmApp">
                <p>扫码下载APP</p>
                <a href="javascript:;">
                    <img src="/Public/Member/images/ewmApp.png"  alt="嗨推APP">
                </a>
            </div>
            <div class="ewm" id="ewmWx">
                <p>关注微信公众号</p>
                <a href="javascript:;">
                    <img src="/Public/Member/images/ewmWx.png"  alt="微信公众号">
                </a>
            </div>
        </div>
    </div>
    <div class="links">
        <div class="in w1100 m0a">
            <div class="tit fl">
                <h5>友情链接</h5>
            </div>
            <ul>
                <?php if(is_array($friends)): $i = 0; $__LIST__ = $friends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($val["url"]); ?>" target="_blank"><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <div class="in w1100 m0a">
            <p><a href="javascript:">粤ICP备14026621号</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;Copyright © 2013-2017 hitui.com 嗨推学院 ALL Rights Reserved.</p>
            <ul>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy01.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy02.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy03.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy04.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy05.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy06.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy07.png" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
</footer>

<!--sidebar-->
<section class="sidebar" id="sidebar">
    <div class="in">
        <ul>
            <li class="li01">
                <a href="javascript:;">
                    <i id="shopCarNum">3</i>
                </a>
            </li>
            <li class="li02">
                <a href="javascript:;"></a>
                <div class="lePop" id="lePop01">
                    <img src="/Public/Member/images/ewmx.png" alt="">
                    <span>微信公众号关注</span>
                    <em class="arr"></em>
                </div>
            </li>
            <li class="li03">
                <a href="javascript:;"></a>
                <div class="lePop" id="lePop02">
                    <img src="/Public/Member/images/ewmx.png" alt="">
                    <span>APP下载</span>
                    <em class="arr"></em>
                </div>
            </li>
            <li class="li04">
                <a href="javascript:;"></a>
            </li>
            <li class="li05 backTop">
                <a href="javascript:;"></a>
            </li>
        </ul>
    </div>
</section>
<script src="/Public/Member/js/jquery-1.11.2.min.js"></script>
<script src="/Public/Member/js/common.js"></script>
<script src="/Public/Member/js/from.js"></script>

<script src="/Public/Member/js/HloginAftert.js"></script>

<script src="/Public/Member/js/myForm.js"></script>
<script src="/Public/Member/js/loginAfter.js"></script>
<script src="/Public/Member/js/loginBefore.js"></script>
<script src="/Public/Member/pugins/libs/layui-master/layui.js"></script>
<script src="/Public/Member/pugins/libs/validator/dist/jquery.validator.js?local=zh-CN"></script>

<script>
    var URL = $("#captcha_img").attr("src");
    //刷新验证码
    $("#captcha_img").on('click',function(){
        $("#captcha_img").attr("src",URL+'?r='+Math.random());
    });

</script>
</body>
</html>


<script>

    var getCodeUrl    = "<?php echo U('Login/getMobileCode');?>";
    //发送验证码
    $('#sendMobileCode').on('click',function(){
        var mobile = $.trim($('input[name="mobile"]').val());
        if(!(/^1[34578]\d{9}$/.test(mobile))){
            show_msg('请输入正确手机号码','error');
            return false;
        }
        $.ajax({
            url: getCodeUrl,
            type: 'POST',
            data: {'mobile':mobile},
            success: function(data){
                if(data.status==0){
                    show_msg(data.msg,'error');
                    return false;
                }
                show_msg(data.msg);
                daojishi($('#sendMobileCode'));
            },
            error:function(data){
                show_msg('网络繁忙请稍后重试','info');
            }
        });
    });

    //用户注册
    $('#regMyForm').bind('valid.form', function(){
        var item = $(this);
        $.ajax({
            url: item.attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(data){
                item.find('.error').text(data.msg);
                if(data.status==1){
                    // show_msg(data.msg,'info');
                    $('#submit_btn').text('正在注册中..');
                    setTimeout(function(){
                        location.href = "<?php echo U('Study/index');?>";
                    },1200);
                    return false;
                }else{
                    // show_msg(data.msg,'error');
                    $('input[name="pwd"]').val('');
                    $('input[name="confirm_pwd"]').val('');
                }
            },
            error:function(data){
                show_msg('网络繁忙请稍后重试','info');
            }
        });
    });

    //nice表单验证-提示语样式
    $('form').validator({
        //theme: "yellow_right_effect", //消息皮肤
        //msgStyle: "margin-left:3px; margin-top:5px;" ,//消息自定义样式
        msgClass: "n-bottom"   //消息将自动显示在输入框右边
    });
</script>