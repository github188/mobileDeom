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
    <!--<link rel="stylesheet" href="//at.alicdn.com/t/font_lemhis1loyqcwhfr.css">-->
    <link rel="stylesheet" href="//at.alicdn.com/t/font_emcubu7melwn4s4i.css">
    <link rel="stylesheet" href="/Public/Member/pugins/libs/layui-master/css/layui.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.static.runoob.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/Public/Member/css/base.css">
    <link rel="stylesheet" href="/Public/Member/css/common.css">
    <link rel="stylesheet" href="/Public/Member/css/loginAfter.css">
</head>
<body>

<!--[if lt IE 9]>
<p class="chromeframe">您使用的IE浏览器版本过低，本站不再支持，<a href="http://windows.microsoft.com/">升级您的IE浏览器</a>，或使用<a
        href="http://www.google.cn/chrome/">Google Chrome</a>、<a href="http://www.firefox.com.cn/download/">Firefox</a>等高级浏览器，将会得到更好的体验！
</p>
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
                <a href="javascript:;">
                    <span>联系我们</span>
                </a>
            </div>
            <div class="sp kf">
                <a href="javascript:;">
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
                    <li><a href="<?php echo session(C('USER_AUTH_UID'))?U('Study/index'):U('Index/index');?>">首页</a><span></span></li>
                    <li><a href="<?php echo U('Index/course');?>">课程介绍</a><span></span></li>
                    <li><a href="<?php echo U('Study/newQuestion');?>">学习助手</a><span></span></li>
                    <li class="mes"><a href="<?php echo U('User/myNews');?>">消息</a><span></span><i class="mesNum">2</i></li>
                </ul>
            </nav>
            <div class="rCon fr">
                <div class="sel fl">
                    <form id="key_word_form" action="<?php echo U('Index/videoList');?>">
                        <input type="text" name="key_word" value="<?php echo cookie('key_word');?>" placeholder="">
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



<!--myBasicInf-->
<section class="myCom myBasicInf" id="myBasicInfe">
    <div class="in w1100 m0a">
        <!--左侧共用菜单-->
        <div class="myLeft fl">
    <div class="myLHd">
        <div class="tp">
            <a href="<?php echo U('User/myLogo');?>">
                <img src="/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png" alt="个人头像">
            </a>
        </div>
        <div class="txt">
            <p class="name"><?php echo session(C('USER_AUTH_UNAME'));?></p>
            <p class="lab"><?php echo session(C('USER_GROUP_UNAME'));?></p>
        </div>
    </div>
    <div class="myItem">
        <ul>
            <li <?php echo ACTION_NAME=='myAccount'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myAccount');?>"><i class="iconfont icon-zhanghao"></i><span>账户余额</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myBrokerage' || ACTION_NAME=='myInvite' ?'class="cur"':'';?>>
                <a href="<?php echo U('User/myBrokerage');?>"><i class="iconfont icon-yongjin"></i><span>我的佣金</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myRank'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myRank');?>"><i class="iconfont icon-paiming"></i><span>积分排名</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myCourse'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myCourse');?>"><i class="iconfont icon-jibie"></i><span>报名课程</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myInfo'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myInfo');?>"><i class="iconfont icon-jibenxinxi"></i><span>基本信息</span></a>
            </li>
            <li <?php echo CONTROLLER_NAME=='Safe'?'class="cur"':'';?>>
                <a href="<?php echo U('Safe/securityList');?>"><i class="iconfont icon-lock"></i><span>安全设置</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myLogo'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myLogo');?>"><i class="iconfont icon-user1"></i><span>修改头像</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myAddressList' || ACTION_NAME=='myAddress'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myAddressList');?>"><i class="iconfont icon-dizhi"></i><span>收货信息</span></a>
            </li>
            <li <?php echo ACTION_NAME=='myNews'?'class="cur"':'';?>>
                <a href="<?php echo U('User/myNews');?>"><i class="iconfont icon-lingdang"></i><span>消息中心</span></a>
            </li>
        </ul>
    </div>
</div>
        <div class="myRight fr">
            <div class="rHd">
                <div class="hdTit">
                    <a href="javascript:;">个人中心</a>
                    <i></i>
                    <a href="javascript:;">基本信息</a>
                </div>
                <div class="com basicInf">
                    <div class="inpCom">
                        <form action="" method="post" name="myForm" data-validator-option="{stopOnError:true}" autocomplete="off">
                            <ul>
                                <li>
                                    <div class="inp">
                                        <span class="ti">教研账号</span>
                                        <input type="text" placeholder="" name="uc_username" value="<?php echo ($user_info['uc_username']); ?>">
                                    </div>
                                </li>
                                <li>
                                    <div class="inp">
                                        <span class="ti">教研室密码</span>
                                        <input type="password" placeholder="" name="uc_password" value="">
                                    </div>
                                </li>
                                <li>
                                    <div class="inp">
                                        <span class="ti">真实姓名</span>
                                        <input type="text" placeholder="" name="realname" value="<?php echo ($user_info['realname']); ?>">
                                    </div>
                                </li>
                                <li>
                                    <div class="inp">
                                        <span class="ti">公司名称</span>
                                        <input type="text" placeholder="" name="company" value="<?php echo ($user_info['company']); ?>">
                                    </div>
                                </li>
                                <li>
                                    <div class="inp">
                                        <span class="ti">所在行业</span>
                                        <input type="text" placeholder="" name="trade" value="<?php echo ($user_info['trade']); ?>">
                                    </div>
                                </li>
                                <li>
                                    <div class="inp qqInp">
                                        <span class="ti">QQ号码<i>*</i></span>
                                        <input type="text" placeholder="" name="qq" id="qq" data-rule="QQ号:required;" value="<?php echo ($user_info['qq']); ?>">
                                        <p class="tip"></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="inp wxInp">
                                        <span class="ti">微信号<i>*</i></span>
                                        <input type="text" placeholder="" name="weixin_username" id="wx" data-rule="微信号:required;" value="<?php echo ($user_info['weixin_username']); ?>">
                                        <p class="tip2"></p>
                                    </div>
                                </li>
                            </ul>
                            <div class="tipTx">（注：标红星处必填，否则无法查看视频）</div>
                            <div class="myBtn keepBtn">
                                <button type="submit" class="bbtn" id="subBtn3">保存修改</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                <h6>关注我们</h6>
                <ol>
                    <li><a href="javascript:;">公司介绍</a></li>
                    <li><a href="javascript:;">团队风采</a></li>
                    <li><a href="javascript:;">招贤纳士</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>联系我们</h6>
                <ol>
                    <li><a href="javascript:;">联系方式</a></li>
                    <li><a href="javascript:;">在线留言</a></li>
                    <li><a href="javascript:;">招贤纳士</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>关注我们</h6>
                <ol>
                    <li><a href="javascript:;">新手客服</a></li>
                    <li><a href="javascript:;">客服中心</a></li>
                    <li><a href="javascript:;">网站地图</a></li>
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
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院2</a></li>
                <li><a href="javascript:;">嗨推学院3</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院3</a></li>
                <li><a href="javascript:;">嗨推学院88</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院0</a></li>
                <li><a href="javascript:;">嗨推学院55</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
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
    var formActionUrl = "<?php echo U('User/myInfo');?>";
    //用户资料修改
    $('form[name="myForm"]').bind('valid.form', function(){
        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function(data){
                if(data.status==0){
                    show_msg(data.msg,'error');
                    return false;
                }
                else if(data.status==1){
                    show_msg(data.msg);
                    setTimeout(function(){
                        location.reload();
                    },1200);
                }
            }
        });
    });
    //nice表单验证-提示语样式
    $('form').validator({
        theme: "yellow_right_effect", //消息皮肤
        msgStyle: "margin-left:3px; margin-top:5px;" ,//消息自定义样式
        msgClass: "n-right"   //消息将自动显示在输入框右边
    });
</script>