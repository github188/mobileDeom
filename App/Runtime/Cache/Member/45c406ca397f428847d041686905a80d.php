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
<!--courses-->
<section class="indexCom mt20 courses" id="courses">
    <div class="in w1100 m0a">
        <!--左侧栏-->
        <?php $AllowSeeVideo = 0; $AllowSeeCategory = 0; ?>
<div class="inL fl">
    <?php if(is_array($video_category)): $k = 0; $__LIST__ = $video_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="item item0<?php echo ($k); ?>">
            <div class="hdTit">
                <h3><?php echo ($v['name']); ?></h3>
                <i></i>
            </div>
            <div class="list">
                <ul>
                    <?php if($v['children']): $children = $v['children']; ?>
                        <?php if(is_array($children)): $kk = 0; $__LIST__ = $children;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk; if($vv['AllowSeeVideo'] > 0): $AllowSeeVideo += $vv['AllowSeeVideo']; endif; ?>
                            <?php if(($vv['allow_play'] == 1 && $vv['id'] == $category_id)): $AllowSeeCategory = 1; endif; ?>
                            <li>
                                <a href="<?php echo U('Video/showList',array('category'=>$vv['id']));?>">
                                    <p><img src="/Public/Member/images/<?php echo ($vv['allow_play']==1?'icon_eye':'icon_suo'); ?>.png"><?php echo ($vv['name']); ?></p>
                                    <div class="progess">
                                        <div class="maxPro">
                                            <p class="curPro"></p>
                                        </div>
                                        <span class="proNum"><?php echo ($vv['progress']); ?>%</span>
                                    </div>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </ul>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
        <div class="inR fr">
            <div class="cour">
                <div class="hdT">
                    <span class="sp1"><a href="javascript:;">我的账户</a></span>
                    <i></i>
                    <span class="sp2"><a href="javascript:;"><?php echo ($categoryPinfo['name']); ?></a></span>
                </div>
                <div class="courCon">
                    <div class="hdd">
                        <div class="bbg">
                            <h4><?php echo ($categoryinfo['name']); ?></h4>
                            <span class="line"></span>
                        </div>
                        <p><?php echo ($categoryinfo['remark']); ?></p>
                    </div>

                </div>
                <div class="courLists">
                    <?php if($category_video): ?><ul>
                            <?php if(is_array($category_video)): $k = 0; $__LIST__ = $category_video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; $playAuth = videoPlayAuth($v['id']); $shoucang = M('video_shoucang')->where(array('user_id'=>session(C('USER_AUTH_UID')),'vid'=>$v['id']))->getField('id'); ?>
                                <li>
                                    <div class="item">
                                        <div class="tp">
                                            <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                                <img src="/Public/Member/images/loading.gif" data-src="/Public/Member/images/tptp01.png" alt="logo" title="" class="lazy">
                                            </a>
                                            <i data-id="<?php echo ($v['id']); ?>" class="love-btn iconfont icon-shoucang <?php echo ($shoucang?'icon-shoucang_sel-copy':''); ?>"></i>
                                            <span class="lab"></span>
                                        </div>
                                        <div class="txt">
                                            <p class="tiName">
                                                <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                                    <?php echo jiequ($v['title'],0,30,'');?>
                                                </a>
                                            </p>
                                            <div class="bot">
                                                <div class="money fl <?php echo ($playAuth['allow_play']==1?'delNo':''); ?>">
                                                    <em><?php echo ($v['buy_money']); ?></em>学习币
                                                </div>
                                                <div class="handle fr">
                                                    <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                                        <i class="iconfont <?php echo ($playAuth['allow_play']==1?'icon-bofang':'icon-216'); ?>"></i>
                                                        <span class="ti00"><?php echo ($playAuth['allow_play']==1?'播放':'购买'); ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    <?php else: ?>
                        <div style="width: 300px;min-height: 100px;margin: 0 auto 100px;text-align: center;">
                            <img src="/Public/Member/images/chahua.png" alt="" width="300px" height="210px">
                            <p style="margin: 30px 0 0 0;">主人太懒了，暂时还没有上传视频哦~</p>
                        </div><?php endif; ?>
                </div>
                <?php if($totalPages > 1): ?><div class="pages"><?php echo ($pages); ?></div><?php endif; ?>

                <!--<div class="load">-->
                    <!--<a href="javascript:;" class="loadBtn" data-staus="0"><i></i>点击加载更多</a>-->
                <!--</div>-->
            </div>
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
<script src="/Public/Member/pugins/libs/jquery.lazyload.mini.js"></script>
<script>
    imgLoad();
    var formActionUrl = "<?php echo U('Video/videoShoucang');?>";
    //收藏和取消视频
    $('.love-btn').on('click',function(e){
        var this_ = $(this);
        var vid = this_.attr('data-id');
        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: {'vid':vid},
            success: function(data){
                if(data.status==0){
                    this_.removeClass('icon-shoucang_sel-copy');
                }
                else if(data.status==1){
                    this_.addClass('icon-shoucang_sel-copy');
                }
                layer.msg(data.info);
            },
            error:function(data){
                show_msg('网络繁忙请稍后重试','error');
            }
        });
    });
</script>