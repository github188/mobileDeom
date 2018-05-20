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
                <a href="<?php echo U('Content/problemList');?>">
                    <span>常见问题</span>
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
                    <li class="mes">
                    <a href="<?php echo U('User/myNews');?>" class="ti">消息</a><span></span>
                    <?php $getUserMessageCount = getUserMessageCount(session(C('USER_AUTH_UID'))); ?>
                        <?php if($getUserMessageCount): ?><i class="mesNum"><?php echo ($getUserMessageCount); ?></i><?php endif; ?>
                    
                    </li>
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


<!--indexCom-->
<section class="HcourseCont mt32" id="">
    <div class="cContent mb20">
        <p class="fontpp mt6 fonts26">还不是vip ?</p>
        <p class="fontpp mt6">赶紧加入嗨推，一起成长，享受和数千名实战</p>
        <p class="fontpp">推广者一起交流成长的快乐，一起培训，终身朋友！</p>
        <p class="myCourse">
            <a href="<?php echo U('Pay/courseChoose');?>" class="mya"> 报名课程</a>
        </p>
    </div>

    <div class="in w1100 m0a   clearfix">
        <!-- 左边S  -->
        <div class="cLeft fl">
            <div class="first">
                <div class="leftHear">
                    <i class="leftI"></i>全部课程
                </div>
                <ul class="pb16">
                    <?php if(is_array($userGroup)): $k = 0; $__LIST__ = $userGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li class="cur">
                            <a <?php echo ($k==1?'class="curC"':''); ?> href="javascript:"><span><?php echo ($v['name']); ?></span></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    <!--
                    <li class="cur">
                        <a class="curC" href="javascript:"><span>新媒体</span></a>
                    </li>
                    <li>
                        <a href="javascript:"><span>引爆你的软文流量</span></a>
                    </li>
                    <li>
                        <a href="javascript:"><span>淘宝客特训</span></a>
                    </li>
                    <li>
                        <a href="javascript:"><span>微商引流特训</span></a>
                    </li>
                    <li>
                        <a href="javascript:"><span>推广总监班</span></a>
                    </li>
                    -->
                </ul>
            </div>
            <div class="shopping">
                <img src="/Public/Member/images/goumai.png" alt="" class="m0a">
                <a href="<?php echo U('Pay/courseChoose');?>" class="shoppingA">在线购买</a>
            </div>
            <div class="shopping">
                <img src="/Public/Member/images/shiting.png" alt="" class="m0a">
                <a href="javsscript:;" class="shoppingA">在线试听</a>
            </div>
        </div>

        <!-- 右边开始 -->
        <?php $i=0; ?>
        <?php if(is_array($userGroupInfo)): $k = 0; $__LIST__ = $userGroupInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; $i += 1; ?>
            <div class="cRigth fr ml15 clearfix <?php echo ($i==1?'activeH':''); ?>" >
                <p class="p pl50">
                    <span class="fonts18 textColor"><?php echo ($v['title']); ?></span>
                </p>
                <div class="nContent">
                    <?php echo htmlspecialchars_decode($v['content']);?>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--
        <div class="cRigth activeH fr ml15 clearfix">
            <p class="p pl50">
                <span class="fonts18 textColor">新媒体</span>
            </p>
            <div class="nContent">
                <ul class="mb8">
                    <div class="fonts15 mb8">课程主要内容:</div>
                    <li>
                        <span >新媒体文章标题写作技巧</span>
                    </li>
                    <li >
                        <span >文章内容如何原创</span>
                    </li>
                    <li >
                        <span>内容如何精炼</span>
                    </li>
                    <li >
                        <span >走心文案打造技巧</span>
                    </li>
                    <li >
                        <span >热点事件爆文技巧</span>
                    </li>
                    <li >
                        <span >如何玩转头条号转正号</span>
                    </li>
                    <li >
                        <span >头条号问答引流</span>
                    </li>
                    <li>
                        <span>百度百家等自媒体引流进阶</span>
                    </li>
                    <li>
                        <span >关于头条号如何盈利<br></span>
                    </li>
                </ul>
                <ul>
                    <div class="fonts15 mb8">创始人坏坏说:</div>
                    <li>
                        <span >随着内容时代的到来，优质的内容越来越受各大平台的欢迎，同时也让很多热衷于</span>
                    </li>
                    <li>
                        <span>内容创造和推广的人从新媒体红利中赚了不少。</span>
                    </li>
                </ul>
                <p class="cRigthP">目前学习新媒体课程主要有两种作用:</p>
                <ul>
                    <div class="fonts15 mb18">对上班族来说:</div>
                    <li>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;凭借对于新媒体良好的信息敏感度，以及对于内容的精准把控，能够为企业</span>
                    </li>
                    <li>
                        <span>的新媒体运营带来很大的帮助，在为企业带来经济效益的同时带来知名度。</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="cRigth  fr ml15 clearfix" >
            <p class="p pl50">
                <span class="fonts18 textColor">引爆你的软文流量</span>
            </p>
        </div>
        <div class="cRigth  fr ml15 clearfix" >
            <p class="p pl50">
                <span class="fonts18 textColor">淘宝客特训</span>
            </p>
        </div>
        <div class="cRigth  fr ml15 clearfix" >
            <p class="p pl50">
                <span class="fonts18 textColor">微商引流特训</span>
            </p>
        </div>
        <div class="cRigth  fr ml15 clearfix" >
            <p class="p pl50">
                <span class="fonts18 textColor">推广总监班</span>
            </p>
        </div>
        -->
    </div>
</section>

<!--footer-->
<footer class="footer clearfix mt20" id="footer">
    <div class="footHd w1100 m0a">
        <div class="hdL fl">
            <div class="log">
                <a href="<?php echo U('Index/index');?>">
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
                <a href="<?php echo U('Pay/courseChoose');?>">
                    <i id="shopCarNum">1</i>
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
                <a href="<?php echo U('Index/index');?>"></a>
                <div class="lePop" id="lePop02">
                    <img src="/Public/Member/images/ewmx.png" alt="">
                    <span>APP下载</span>
                    <em class="arr"></em>
                </div>
            </li>
            <li class="li04">
                <a href="<?php echo U('Index/course');?>"></a>
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