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
<link rel="stylesheet" href="//at.alicdn.com/t/font_2xxs7sl9jpf7ds4i.css">
<style>
    body{background-color: #fff;}
</style>
<!--banShow-->
<section class="banShow" id="banShow">
    <?php if($banner): ?><div class="banner">
            <div class="bImg">
                <?php if(is_array($banner)): $k = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><a href="javascript:;" style="background-image:url('<?php echo ($v['img_url']); ?>');background-size:100% 100%"></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="bList hor_center"></div>
        </div>
    <?php else: ?>
        <p style="line-height: 400px;background-color: #00a65a;"></p><?php endif; ?>
    <div class="regLogPop w1100">
        <div class="in">
            <?php if(session(C('USER_AUTH_UID'))): ?><!--已登录 start-->
                <div class="regLog log">
                    <div class="hd">
                        <h2>我的账号</h2>
                    </div>
                    <div class="face">
                        <a href="javascript:;">
                            <img src="/Public/Member/images/logo/<?php echo ($user_arr["face"]); ?>.png" alt="">
                        </a>
                        <p><?php echo ($user_arr["username"]); ?></p>
                        <span class="lab"><?php $getUserGroup = getUserGroup($user_arr['id']); ?> <?php echo ($getUserGroup['group_name']); ?> </span>
                    </div>
                    <div class="bot">
                        <div class="ye">
                            <p>
                                <span class="fl">学习币余额：</span>
                                <span class="fr"><?php echo ($user_arr["currency"]); ?></span>
                            </p>
                            <p>
                                <span class="fl">账号佣金：</span>
                                <span class="fr"><?php echo ($user_arr["brokerage"]); ?></span>
                            </p>
                        </div>
                        <div class="bbtn">
                            <a href="<?php echo U('Study/index');?>">进入系统</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!--未登录 start-->
                <div class="regLog reg" >
                    <div class="hd">
                        <h2>免费注册</h2>
                    </div>
                    <div class="face">
                        <a href="javascript:;">
                            <img src="/Public/Member/images/defautTx.png" alt="">
                        </a>
                        <p style="margin-top: 10px;">学推广到嗨推</p>
                    </div>
                    <div class="bot">
                        <div class="bbtn">
                            <a href="<?php echo U('Login/register');?>">注册</a>
                        </div>
                        <div class="link">
                            <span>已有账号</span>
                            <a href="<?php echo U('Login/index');?>">立即登录</a>
                        </div>
                    </div>
                </div><?php endif; ?>
        </div>
    </div>
</section>

<!--main-->
<section class="indMain" id="indMain">
    <div class="affiche">
        <div class="gfNot  m0a">
            <div class="tit fl">
                <i></i>
                <h6>官方公告：</h6>
            </div>
            <a href="<?php echo U('Content/webNoticeList');?>" class="more">更多公告&gt;&gt;</a>
            <ul >

                <?php if(is_array($notice)): $k = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                        <a href="<?php echo U('Content/webNotice',array('main'=>$v['id']));?>">

                            <p><?php echo ($v['title']); ?></p>
                        </a>
                        <span><?php echo date('Y/m/d',$v['addtime']);?></span>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="affList w1100 m0a">
            <ul>
                <li>
                    <a href="javascript:;">
                        <div class="tp">
                            <img src="/Public/Member/images/aff01.png" alt="">
                        </div>
                    </a>
                    <div class="txt">
                        <span class="ti"><em><?php echo ($userCount); ?></em>人</span>
                        <p>学员人数</p>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="tp">
                            <img src="/Public/Member/images/aff02.png" alt="">
                        </div>
                    </a>
                    <div class="txt">
                        <span class="ti"><em><?php echo ($videoCount); ?></em>节</span>
                        <p>专业课程</p>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="tp">
                            <img src="/Public/Member/images/aff03.png" alt="">
                        </div>
                    </a>
                    <div class="txt">
                        <span class="ti"><em><?php echo ($timeCount); ?></em>分钟</span>
                        <p>课程时间</p>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="tp">
                            <img src="/Public/Member/images/aff04.png" alt="">
                        </div>
                    </a>
                    <div class="txt">
                        <span class="ti"><em>1368</em>家</span>
                        <p>服务商家</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="mainCom kcCom ">
        <div class="hdTit">
            <div class="fl">
                <i class="ico ico01"></i><h4>课程推荐</h4><span>看看别人是如何成功的</span>
            </div>
            <a href="<?php echo U('Index/course');?>" class="more">更多&gt;&gt;</a>
        </div>
        <div class="kcIn">
            <div class="fl kcL" style="background: url(/Public/Member/images/kcTP01.png) no-repeat;">
                <p>权威课程 坏坏主讲</p>
                <a href="<?php echo U('Index/course');?>" class="linkDet">
                    <span>课程详情</span>
                </a>
            </div>
            <div class="fr kcR">
                <div class="kcList">
                    <ul>
                        <?php if(is_array($coursePrice)): $k = 0; $__LIST__ = $coursePrice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                                <?php if(($k == 1)): ?><i class="lab" style="background-color: #76bdff;">最新课程</i>
                                <?php elseif(($k == 2)): ?>
                                    <i class="lab" style="background-color: #ff6100;">最热课程</i><?php endif; ?>
                                <div class="ti ti01">
                                    <h6><a href="javascript:;"> <?php echo ($v['name']); ?></a></h6>
                                    <p><a href="javascript:;"> <?php echo ($v['remark']); ?></a></p>
                                </div>
                                <div class="ti ti02">
                                    <span><?php echo floor($v['gqtime']/365);?>年</span>
                                    <p>期限</p>
                                </div>
                                <div class="ti ti03">
                                    <em><?php echo ($v['buy_money']); ?></em>
                                    <p>学习币</p>
                                </div>
                                <div class="ti ti04">
                                    <a href="<?php echo U('Pay/courseConfirm',array('group_id'=>$v['id']));?>" class="">立即报名</a>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mainCom spCom clearfix">
        <div class="hdTit">
            <div class="fl">
                <i class="ico ico02"></i><h4>热门视频</h4><span>看看别人是如何成功的</span>
            </div>
            <a href="<?php echo U('Index/videoList');?>" class="more">更多&gt;&gt;</a>
        </div>
        <div class="courIn courIn2">
            <div class="turn">
                <i class="prev"></i>
                <i class="next"></i>
            </div>
            <div class="courLists">
                <ul>
                    <?php if(is_array($videoshow)): $k = 0; $__LIST__ = $videoshow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; $playAuth = $user_id ? videoPlayAuth($v['id']) : ''; if($user_id){ $v['shoucang'] = M('video_shoucang')->where(array('user_id'=>$user_id,'vid'=>$v['id']))->getField('id'); } ?>
                        <li>
                            <div class="item">
                                <div class="tp">
                                    <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                        <img src="/Public/Member/images/tptp01.png" alt="" title="" >
                                    </a>

                                    <i data-id="<?php echo ($v['id']); ?>" class="love-btn iconfont icon-shoucang <?php echo ($v['shoucang']?'icon-shoucang_sel-copy':''); ?>"></i>

                                    <span>
                                    <?php if($v['is_tag'] == 1): ?>class="lab labNew"
                                        <?php elseif($v['is_tag'] == 2): ?>
                                            class="lab labTj"<?php endif; ?>
                                    </span>
                                </div>
                                <div class="txt">
                                    <p class="tiName">
                                        <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                            <?php echo jiequ($v['title'],0,30,'');?>
                                        </a>
                                    </p>
                                    <div class="bot">
                                        <div class="money fl <?php echo ($playAuth['allow_play']==1 ? 'delNo':''); ?>">
                                            <em><?php echo ($v['buy_money']); ?></em>学习币
                                        </div>
                                        <div class="handle fr">
                                            <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                                <i class="iconfont <?php echo ($playAuth['allow_play']==1 ? 'icon-bofang':'icon-216'); ?>"></i>
                                                <span class="ti00"><?php echo ($playAuth['allow_play']==1 ? '播放':'购买'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="mainCom xyCom">
        <div class="hdTit">
            <div class="fl">
                <i class="ico ico03"></i><h4>精英学员</h4><span>看看别人是如何成功的</span>
            </div>
            <a href=" <?php echo U('Content/studentSay');?>" class="more">更多&gt;&gt;</a>
        </div>
        <div class="stuElite stuEliste2">
            <div class="elList">
                <ul>
                    <?php if(is_array($student)): $k = 0; $__LIST__ = $student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li class="js-text">
                            <div class="item">
                                <div class="tp">
                                    <img src="<?php echo ($v['cover_img']); ?>" alt="学员头像">
                                </div>
                                <div class="txt">
                                    <h4 class="tiName"><?php echo ($v['title']); ?></h4>
                                    <div class="wz js-wz" ><?php echo htmlspecialchars_decode($v['content']);?></div>
                                </div>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="mainCom notCom" style="margin-top: -80px;">
        <div class="notTab" >
            <ol>
                <li>
                    <span>平台公告</span>
                </li>
                <li>
                    <span>干货分享</span>
                </li>
                <li>
                    <span>常见问题</span>
                </li>
            </ol>
            <a href="<?php echo U('Content/index');?>" class="more">更多&gt;&gt;</a>
        </div>
        <div class="notList">
            <ul>
                <li>
                    <div class="tp">
                        <a href="javascript:;"><img src="/Public/Member/images/notTp01.jpg" alt=""></a>
                    </div>
                    <div class="txt">
                        <?php if(is_array($notice)): $k = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="pp">
                                <p class="fl wz"><a href="<?php echo U('Content/webNotice',array('main'=>$v['id']));?>"><?php echo ($v['title']); ?></a></p>
                                <span class="fr data"><?php echo (date('Y-m-d',$v['addtime'])); ?></span>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </li>
                <li>
                    <div class="tp">
                        <a href="javascript:;"><img src="/Public/Member/images/notTp02.jpg" alt=""></a>
                    </div>
                    <div class="txt">
                        <?php if(is_array($ganhuo)): $k = 0; $__LIST__ = $ganhuo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="pp">
                                <p class="fl wz"><a href="<?php echo U('Content/goodShare',array('main'=>$v['id']));?>"><?php echo ($v['title']); ?></a></p>
                                <span class="fr data"><?php echo (date('Y-m-d',$v['addtime'])); ?></span>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </li>
                <li>
                    <div class="tp">
                        <a href="javascript:;"><img src="/Public/Member/images/notTp03.jpg" alt=""></a>
                    </div>
                    <div class="txt">
                        <?php if(is_array($problem)): $k = 0; $__LIST__ = $problem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="pp">
                                <p class="fl wz"><a href="<?php echo U('Content/problem',array('main'=>$v['id']));?>"><?php echo ($v['title']); ?></a></p>
                                <span class="fr data"><?php echo (date('Y-m-d',$v['addtime'])); ?></span>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </li>
            </ul>
        </div>
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

<script src="/Public/AdminLte/layer/layer.js"></script>
<script>
    var user_id = '<?php echo ($user_id); ?>';
    var formActionUrl = "<?php echo U('Video/videoShoucang');?>";
    //收藏和取消视频
    $('.love-btn').on('click',function(e){
        var this_ = $(this);
        var vid = this_.attr('data-id');
        if(!user_id){
            layer.msg('收藏失败，请先登录');
            return false;
        }

        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: {'vid':vid},
            success: function(data){
                if(data.status==0){
                    this_.attr('class','love-btn iconfont icon-shoucang');
                }
                else if(data.status==1){
                    this_.attr('class','love-btn iconfont icon-shoucang icon-shoucang_sel-copy');
                }
                layer.msg(data.info);
            },
            error:function(data){
                show_msg('网络繁忙请稍后重试','error');
            }
        });
    });
</script>