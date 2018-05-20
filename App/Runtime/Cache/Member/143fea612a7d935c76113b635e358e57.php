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


<link rel="stylesheet" href="//at.alicdn.com/t/font_xk6xbeex7q281tt9.css">
<link rel="stylesheet" href="/Public/Member/pugins/libs/validator/dist/jquery.validator.css">
<!--[if IE 8]>
<script>
    var DEFAULT_VERSION = "8.0";
    var ua = navigator.userAgent.toLowerCase();
    var isIE = ua.indexOf("msie")>-1;
    var safariVersion;
    if(isIE){
        safariVersion =  ua.match(/msie ([\d.]+)/)[1];
    }
    if(safariVersion <= DEFAULT_VERSION ){
        alert("Your browser version is too low, please upgrade your browser");
    }
</script>
<![endif]-->
<style>
    .hpdUl img,.wz img{
        display: inline-block!important;
    }
    .bgColor{
        margin-top: 20px;
    }
</style>

<!--content-->
<div class="videoContent m0a learnNote">
    <div class="videoHeader mt22 pl20">
        <span class="sp1" ><i class="iconfont icon-geren"></i> <a href="javascript:void(0)" class="fonts16">我的账户</a></span>
        <span class="arrows ml2 mr10"></span>
        <span class="sp2"><a href="javascript:void(0)" class="fonts16">No.2项目分享</a></span>
        <span class="arrows ml2 mr10"></span>
        <span class="sp3 fonts16"><a href="javascript:void(0)">百度贴吧推广的进阶技巧</a></span>
    </div>
    <div class="videoBody clearfix">
        <div class="videoLeft fl" id="videoLeft">
            <script src="https://player.polyv.net/script/polyvplayer.min.js"></script>
            <!-- 视频播放 -->
            <div id='polyvplayerd81a899efa2b46067129582904a9e95f_d'></div>
            <script>
                //视频播放参数
                var player = polyvObject('#polyvplayerd81a899efa2b46067129582904a9e95f_d').videoPlayer({
                    'width':'1098',
                    'height':'575',
                    'vid' : 'd81a899efa2b46067129582904a9e95f_d',
                    //ban_history_time off 记录播放进度并续播  history_video_duration表示视频总时长超过多少分钟时，记录历史播放进度，下次播放时自动续播，默认为5分钟
                    'flashvars':{"ban_history_time":"off", "history_video_duration":1, "autoplay":1}

                });
            </script>

            <!--<div id="plv_988c7c15eaf6f36607eed03a2ff612ff_9"><object type="application/x-shockwave-flash" data="//player.polyv.net/videos/player.swf" id="988c7c15eaf6f36607eed03a2ff612ff_9" width="1100" height="640" class="polyvFlashObject"><param name="allowScriptAccess" value="always"><param name="allowFullScreen" value="true"><param name="quality" value="high"><param name="bgcolor" value="#ffffff"><param name="wmode" value="transparent"><param name="flashvars" value="vid=988c7c15eaf6f36607eed03a2ff612ff_9&amp;"></object></div>-->
            <!--<object type="application/x-shockwave-flash" data="//static.youku.com/v20170502.0/v/swf/upsplayer/player_yknpsv.swf" width="100%" height="100%" id="movie_player" class="__web-inspector-hide-shortcut__"><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always"><param name="allowFullScreenInteractive" value="true"><param name="wmode" value="direct"><param name="bgcolor" value="#000000"><param name="flashvars" value="skincolor1=ffffff&amp;skincolor2=ffffff&amp;VideoIDS=XMjc0MTI2NDMyMA==&amp;ShowId=307775&amp;category=97&amp;Cp=authorized&amp;sv=true&amp;unCookie=0&amp;frame=undefined&amp;uepflag=0&amp;Tid=0&amp;isAutoPlay=true&amp;playmode=3&amp;show_ce=1&amp;winType=interior&amp;Fid=0&amp;Pt=0&amp;Ob=0&amp;plchid=&amp;embedid=AjY4NTMxNjA4MAJ3d3cueW91a3UuY29tAi8=&amp;ysuid=1493791326911faV&amp;vext=bc%3D%26pid%3Dundefined%26unCookie%3Dundefined%26frame%3Dundefined%26type%3D1%26fob%3D0%26fpo%3D0%26svt%3D1%26stg%3Dundefined%26cna%3DXmCQESrilkMCATsqkeLowMQu%26emb%3DAjY4NTMxNjA4MAJ3d3cueW91a3UuY29tAi8%3D%26dn%3D%E7%BD%91%E9%A1%B5%26hwc%3D1%26mtype%3Doth&amp;cna=XmCQESrilkMCATsqkeLowMQu&amp;pageStartTime=1493791396211"><param name="movie" value="//static.youku.com/v20170502.0/v/swf/upsplayer/player_yknpsv.swf"><div class="player_html5"><div class="picture" style="height:100%"><div style="line-height:460px;"><span style="font-size:18px">您还没有安装flash播放器,请点击<a href="//www.adobe.com/go/getflash" target="_blank">这里</a>安装</span></div></div></div></object>-->
        </div>
        <div class="videoRight ">
            <div class="courList courListX ">
                <div class="vidListX">
                    <ul class="videoUl">
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="playing">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                        <li class="">
                            <div class="fl">
                                <i class="ico"></i>
                                <a href="javascript:;">第163期 嗨推大讲堂 淘宝客 ....</a>
                            </div>
                            <div class="fr">
                                <span class="sc2"><i class="iconfont icon-shoucang"></i></span>
                            </div>
                            <div class="time fr">时长<em>11:30</em></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="videoTab mt20">
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title" style="height: 50px;">
                <li class="layui-this learnAcitve">笔记<span>(<em id="note_total"><?php echo ($noteList["total"]); ?></em>)</span></li>
                <li>问答<span>(<em id="question_total"><?php echo ($question["total"]); ?></em>)</span></li>
                <li>介绍</li>
            </ul>
            <div class="layui-tab-content"style=" min-height: 500px;">
                <!-- 笔记S -->
                <div class="layui-tab-item layui-show">
                    <!--<div style="width: 1060px;" class="m0a pd16">-->
                        <!--<form class="layui-form clearfix" id="layui-form">-->
                            <!--<div class="layui-form-item mt30">-->
                                <!--<textarea name="demo" id="note" class="layui-hide">-->
                                <!--</textarea>-->
                            <!--</div>-->
                            <!--<button onclick="writeNote()" class="layui-btn layui-btn-new " type="button" id="layui-btn">发表笔记</button>-->
                        <!--</form>-->
                    <!--</div>-->
                    <div style="width: 1060px;" class="m0a pb40 mt16">
                        <form class="layui-form nice-validator n-simple" novalidate="novalidate">
                            <div class="layui-form-item">
                                <textarea name="demo" id="note" class="layui-hide"></textarea><div class="layui-layedit"><div class="layui-unselect layui-layedit-tool"><i class="layui-icon layedit-tool-b" title="加粗" lay-command="Bold" layedit-event="b" "=""></i><i class="layui-icon layedit-tool-i" title="斜体" lay-command="italic" layedit-event="i" "=""></i><i class="layui-icon layedit-tool-u" title="下划线" lay-command="underline" layedit-event="u" "=""></i><i class="layui-icon layedit-tool-d" title="删除线" lay-command="strikeThrough" layedit-event="d" "=""></i><span class="layedit-tool-mid"></span><i class="layui-icon layedit-tool-left" title="左对齐" lay-command="justifyLeft" layedit-event="left" "=""></i><i class="layui-icon layedit-tool-center" title="居中对齐" lay-command="justifyCenter" layedit-event="center" "=""></i><i class="layui-icon layedit-tool-right" title="右对齐" lay-command="justifyRight" layedit-event="right" "=""></i><i class="layui-icon layedit-tool-link" title="插入链接" layedit-event="link" "=""></i><i class="layui-icon layedit-tool-unlink layui-disabled" title="清除链接" lay-command="unlink" layedit-event="unlink" "=""></i><i class="layui-icon layedit-tool-face" title="表情" layedit-event="face" "=""></i></div><div class="layui-layedit-iframe"><iframe id="LAY_layedit_2" name="LAY_layedit_2" textarea="question" frameborder="0" style="height: 180px;"></iframe></div></div>
                            </div>
                            <button onclick="writeNote()" class="layui-btn layui-btn-new " type="button" id="layui-btn">发表笔记</button>
                        </form>
                    </div>

                    <!--笔记内容部分S-->
                    <div class="noteHeader pl30" >全部笔记</div>
                    <div class="bgColor hpdUl">
                        <ul id="notelist" data-last-note-id="<?php echo ($noteList["limit_end_id"]); ?>">
                            <?php if(empty($noteList["noteList"])): ?><!--没有数据：-->
                                <div id="note_noData" class="noData" style="text-align: center;">
                                    <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据"  width="" height="">
                                    <p>数据为空</p>
                                </div><?php endif; ?>
                            <?php if(is_array($noteList["noteList"])): foreach($noteList["noteList"] as $key=>$val): ?><li id="note<?php echo ($val["id"]); ?>" class="Hpd clearfix">
                                    <div class="fonts16 ft16Color noteContent" flag="true" style="display: block;"><?php echo ($val["content"]); ?></div>
                                    <div class="source">来源: <a data-category-id="<?php echo ($val["category_id"]); ?>" href="/Member/Video/showList/category/<?php echo ($val["category_id"]); ?>" class="sorC category_name"><?php echo ($val["category_name"]); ?></a>/ <a data-vid="<?php echo ($val["vid"]); ?>" class="sorC video_name" href="/Member/Video/play/vid/<?php echo ($val["vid"]); ?>"><?php echo ($val["video_name"]); ?></a></div>

                                    <!--文本框S-->
                                    <div class="anArea mt0 bgColor">
                                        <form action="" method="post" class="nice-validator n-simple" novalidate="novalidate">
                                            <textarea placeholder="" id="demo<?php echo ($val["id"]); ?>" class="pl15 pt15"></textarea>
                                            <div class="bot mt20 mr42 mb25">
                                                <a onclick="quxiao($(this))" class="HcancleBtn subBtn1">取消</a>
                                                <a data-note-id="<?php echo ($val["id"]); ?>" class="HsubBtn subBtn1">提交</a>
                                            </div>
                                        </form>
                                    </div>
                                    <!--文本框E-->

                                    <div class="msgFoot clearfix" style="display: block;">
                                        <div class="timeL fl mb25 fonts14 mt10"><?php echo ($val["addtime"]); ?></div>
                                        <div class="fr mb25 fonts15">

                                            <?php if($val['user_id'] == $user_id){ echo '<span class="mr25 delete" data-note-id="'.$val['id'].'"><i class="iconfont icon-del iconNote"></i>删除</span>'; echo '<span class="mr25 Hrevise bb" flag="true" onclick="editNote($(this), \'demo'.$val['id'].'\')"><i class="iconfont icon-bianxie iconNote"></i>修改</span>'; } ?>


                                            <span class="HpdSpan"><a href="/Member/Video/play/vid/<?php echo ($val["vid"]); ?>"><i class="iconfont icon-shipin-copy"></i> <i class="Htime"><?php echo ($val["playtime"]); ?></i></a></span>
                                        </div>
                                    </div>
                                </li><?php endforeach; endif; ?>

                            <!-- 遮罩层 -->
                            <div class="Hmask">
                                <div class="maskDel">
                                    <p>您确定删除吗？</p>
                                    <div class="clearfix mb15 mt10">
                                        <a href="#" class="Hcancel mr15">取消</a>
                                        <a href="#" onclick="Hsubmit()" class="Hsubmit">确定</a>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <?php if(!empty($noteList["is_show_more"])): ?><div class="bgColor textAlign mt-10">
                            <a onclick="note_page($(this), <?php echo ($user_id); ?>)" class="Hmore m0a">点击加载更多</a>
                        </div><?php endif; ?>

                </div>

                <!-- 问答S -->
                <div class="layui-tab-item">
                    <div style="width: 1060px;" class="m0a pb40 mt16">
                        <form class="layui-form">
                            <div class="layui-form-item">
                                <textarea name="demo" id="question" class="layui-hide">
                                </textarea>
                            </div>
                            <button onclick="writeQuestion()" class="layui-btn layui-btn-new " type="button" id="layui-btn1">发表问答</button>
                        </form>
                    </div>

                <!-- 问答内容 -->
                    <div class="noteHeader pl30" >全部问答</div>
                    <div class="bgColor">
                        <div class="com newsAsk">
                            <ul id="questionlist" data-last-question-id="<?php echo ($question["end_id"]); ?>">

                                <?php if(empty($question["question"])): ?><!--没有数据：-->
                                    <div id="question_noData" class="noData" style="text-align: center;">
                                        <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据"  width="" height="">
                                        <p>您目前数据为空</p>
                                    </div><?php endif; ?>
                                <?php if(is_array($question["question"])): foreach($question["question"] as $k=>$val): ?><li>
                                        <div data-last-answer-id="<?php echo ($val["limit_end_id"]); ?>" class="item question_list">
                                            <div class="tp">
                                                <a href="javascript:;">
                                                    <img src="/Public/Member/images/logo/<?php echo ($val["face"]); ?>.png" alt="">
                                                </a>
                                            </div>
                                            <div class="txt">
                                                <div class="txIn">
                                                    <div class="tHd">
                                                        <img style="display: inline-block" src="/Public/Member/images/user_group/<?php echo ($val["user_group_id"]); ?>.png" alt="">
                                                        <span class="name"><?php echo ($val["username"]); ?></span>
                                                    </div>
                                                    <p class="wz"><?php echo ($val["question"]); ?></p>
                                                    <p class="from">
                                            <span>
                                                <em>来源：</em>
                                                <a class="category_name" data-category-id="<?php echo ($val["category_id"]); ?>" href="/Member/Video/showList/category/<?php echo ($val["category_id"]); ?>"><?php echo ($val["category_name"]); ?>/</a><a data-vid="<?php echo ($val["vid"]); ?>" class="video_name" href="/Member/Video/play/vid/<?php echo ($val["vid"]); ?>"><?php echo ($val["video_name"]); ?></a>
                                            </span>
                                                    </p>
                                                    <div class="hand handLi clearfix">
                                                        <span class="time"><?php echo ($val["addtime"]); ?></span>
                                                        <?php if(empty($val["is_shoucang"])): ?><span onclick="shoucang($(this), <?php echo ($val["id"]); ?>)" class="sc1 fr ml110"><em class="videoEms"></em><i class="fonts14"><i>收藏</i></i></span>
                                                            <?php else: ?>
                                                            <span onclick="shoucang($(this), <?php echo ($val["id"]); ?>)" class="sc1 fr ml110"><em class="videoEms active"></em><i class="fonts14"><i>取消</i></i></span><?php endif; ?>

                                                        <a onclick="createBox($(this))" class="mesIco mesIcoT"><i></i>(<span class="reply_count"><?php echo ($val["count"]); ?></span>)</a>
                                                    </div>
                                                </div>
                                                <div class="anArea anAreaT">
                                                    <form action="" method="post">
                                                        <textarea placeholder="" id="q<?php echo ($val["id"]); ?>"></textarea>
                                                        <div class="bot">
                                                            <a href="javascript:;" class="cancleBtn cancel">取消</a>
                                                            <a data-question-id="<?php echo ($val["id"]); ?>" onclick="replyMssage($(this),<?php echo ($val["user_id"]); ?>, <?php echo ($user_id); ?>)" style="background-color: #0b97c4; color: #fff;">提交</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php if(is_array($val["answer"])): foreach($val["answer"] as $kk=>$v): ?><div data-last-answer-id="<?php echo ($v["id"]); ?>" class="item itemX">
                                                    <div class="tp">
                                                        <a href="javascript:;">
                                                            <img src="/Public/Member/images/logo/<?php echo ($v["face"]); ?>.png" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="txt">
                                                        <div class="txIn txInB">
                                                            <div class="tHd">
                                                                <!--<i style="background-color: #ff7683; border-color: #e55a5a;">试</i>-->

                                                                <?php  if($v['reply_user_id'] == 0){ echo '<img style="display: inline-block" src="/Public/Member/images/user_group/'.$v['user_group_id'].'.png"><span class="name">'.$v['username'].'：</span><span class="ask">'.htmlspecialchars_decode(stripslashes($v['answer'])).'</span>'; }else{ echo '<img style="display: inline-block" src="/Public/Member/images/user_group/'.$v['user_group_id'].'.png" alt=""><span class="name">'.$v['username'].'：回复#<img style="display: inline-block" src="/Public/Member/images/user_group/'.$v['reply_user_group_id'].'.png" alt="">'.$v['reply_username'].'：</span><span class="ask">'.htmlspecialchars_decode(stripslashes($v['answer'])).'</span>'; } ?>

                                                            </div>
                                                            <div class="hand">
                                                                <span class="time"><?php echo ($v["addtime"]); ?></span>
                                                                <?php if($v['user_id'] != $user_id){ echo ' <a onclick="createBox($(this))" class="mesIco mesIcoBs"><i></i></a>'; } ?>
                                                            </div>
                                                        </div>
                                                        <div class="anArea anAreaB">
                                                            <form action="" method="post">
                                                                <textarea class="answer" id="e<?php echo ($v["id"]); ?>" placeholder=""></textarea>
                                                                <div class="bot">
                                                                    <a href="javascript:;" class="cancleBtn cancel">取消</a>
                                                                    <a style="background-color: #0b97c4; color: #fff;" data-question-id="<?php echo ($val["id"]); ?>" data-answer-id="<?php echo ($v["id"]); ?>" onclick="replyMssage($(this),<?php echo ($v["user_id"]); ?>, <?php echo ($user_id); ?>)">提交</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><?php endforeach; endif; ?>
                                            <?php if(!empty($val["is_show_more"])): ?><a data-limit-end-id="<?php echo ($val["limit_end_id"]); ?>" onclick="answer_page($(this), <?php echo ($val["id"]); ?>, <?php echo ($user_id); ?>)" style="display:block; text-align: left; margin-left: 80px; margin-top:25px;cursor:pointer;color: rgba(102, 102, 102, 0.65);">查看更多</a><?php endif; ?>
                                        </div>
                                    </li><?php endforeach; endif; ?>
                                <?php if(!empty($question["is_show_more"])): ?><div class="bgColor textAlign mt-10">
                                    <a data-last-limit-id="<?php echo ($question["limit_end_id"]); ?>" class="Hmore m0a" onclick="question_page($(this), <?php echo ($user_id); ?>)">点击加载更多</a></div><?php endif; ?>


                            </ul>
                        </div>

                    </div>
                    <input type="hidden" id="vid" value="<?php echo ($vid); ?>">
                </div>

                <!-- 介绍S -->
                <div class="layui-tab-item"><?php echo ($videoInfo['remark']); ?></div>

            </div>
        </div>
    </div >

</div>

<!--footer-->
<script type="text/html" id="myFooter"></script>

<script src="/Public/Member/js/jquery-1.11.2.min.js"></script>
<script src="/Public/Member/js/common.js"></script>
<script src="/Public/Member/js/from.js"></script>
<!--<script src="/Public/Member/js/loginAfter.js"></script>-->
<script src="/Public/Member/js/HloginAftert.js"></script>
<script src="/Public/Member/pugins/libs/layui-master/layui.js"></script>
<script src="/Public/Member/pugins/libs/validator/dist/jquery.validator.js?local=zh-CN"></script>
<!--修改笔记、回复问答 查看更多JS-->
<script src="/Public/Member/js/replyMssage.js"></script>
<script>
    // 插件validator.js
    $('form').validator({
        theme: "simple_right", //消息皮肤
        msgClass: "n-bottom"   //消息将自动显示在输入框右边
    });
    layui.use('element', function(){
        var $ = layui.jquery
            ,element = layui.element();
    });



    //富文本编辑器

    var __note_index; //笔记编辑器索引
    var __question_index; //问答编辑器索引
    var __layedit;
    var __layer;
    var __user_id = <?php echo ($user_id); ?>;
    var __vid = <?php echo ($vid); ?>;
    var __video_name = '<?php echo ($video_name); ?>';
    var __category_id = <?php echo ($category_id); ?>;
    var __category_name = '<?php echo ($category_name); ?>';

    layui.use('layer', function(){
        __layer = layui.layer;
    });

    layui.use('layedit', function(){
        __layedit = layui.layedit;

        __note_index = __layedit.build('note', {
            tool: [
                'strong' //加粗
                ,'italic' //斜体
                ,'underline' //下划线
                ,'del' //删除线
                ,'|' //分割线
                ,'left' //左对齐
                ,'center' //居中对齐
                ,'right' //右对齐
                ,'link' //超链接
                ,'unlink' //清除链接
                ,'face' //表情
            ]
            ,height: 180
        });

        __question_index = __layedit.build('question', {
            tool: [
                'strong' //加粗
                ,'italic' //斜体
                ,'underline' //下划线
                ,'del' //删除线
                ,'|' //分割线
                ,'left' //左对齐
                ,'center' //居中对齐
                ,'right' //右对齐
                ,'link' //超链接
                ,'unlink' //清除链接
                ,'face' //表情
            ]
            ,height: 180
        });
    });


//  发表笔记
    function writeNote(){
        var content = __layedit.getContent(__note_index);
        if(isEmpty(content) === false){
            __layer.msg('发表内容不能为空！');return;
        }
        var playtime = player.j2s_getCurrentTime();
        if (!playtime){
            __layer.msg('请播放视频后再发表笔记！');return;
        }

//      笔记数量+1
        var note_total = parseInt($('#note_total').text()) + 1;

        $.ajax({
            type: "post",
            url: '/Member/Study/writeNote',
            data: {"vid": __vid, "content":content, "playtime":playtime},
            dataType: "json",
            success: function (json) {
                if (json.status == 1) {
                    __layer.msg('发表成功！');
                    var html = '';

                    html += '<li id="note'+json.id+'" class="Hpd clearfix">';
                    html += '<div class="fonts16 ft16Color" flag="true" style="display: block;">'+content+'</div>';
                    html += '<div class="source">来源: <a href="/Member/Video/showList/category/'+__category_id+'" class="sorC">'+__category_name+'</a>/ <a class="sorC" href="/Member/Video/play/vid/'+__vid+'">'+__video_name+'</a></div>';

                    html += '<div class="anArea mt0 bgColor">';
                    html += '<form action="" method="post" class="nice-validator n-simple" novalidate="novalidate">';
                    html += '<textarea placeholder="" id="demo'+json.id+'" class="pl15 pt15"></textarea>';
                    html += '<div class="bot mt20 mr42 mb25">';
                    html += '<a onclick="quxiao($(this))" class="HcancleBtn subBtn1">取消</a>';
                    html += '<a data-note-id="'+json.id+'" class="HsubBtn subBtn1">提交</a>';
                    html += '</div>';
                    html += '</form>';
                    html += '</div>';

                    html += '<div class="msgFoot clearfix" style="display: block;">';
                    html += '<div class="timeL fl mb25 fonts14 mt10">'+json.addtime+'</div>';
                    html += '<div class="fr mb25 fonts15">';
                    html += '<span class="mr25 delete" data-note-id="'+json.id+'"><i class="iconfont icon-del iconNote"></i>删除</span>';
                    html += '<span class="mr25 Hrevise bb" flag="true" onclick="editNote($(this), \'demo'+json.id+'\')"><i class="iconfont icon-bianxie iconNote"></i>修改</span>';
                    html += '<span class="HpdSpan"><i class="iconfont icon-shipin-copy"></i> <i class="Htime">'+json.playtime+'</i></span>';
                    html += '</div>';
                    html += '</div>';
                    html += '</li>';


                    $('#notelist').prepend(html);
                    __layedit.setContent(__note_index, '');
                    $('#note_total').text(note_total);
                    $('#note_noData').hide();
                }else{
                    __layer.msg(json.info);
                }
            }
        })
    }



    //    发表问答
    function writeQuestion(){
        var content = __layedit.getContent(__question_index);
        if (isEmpty(content) === false){
            __layer.msg('请输入发表内容！');return;
        }
        var question_total = parseInt($('#question_total').text()) + 1 ;

        $.ajax({
            type: "post",
            url: '/Member/Study/writeQuestion',
            data: {"vid": __vid, "content":content, 'category_id':__category_id},
            dataType: "json",
            success: function (json) {
                if (json.status == 1) {
                    __layer.msg('发表成功！');
                    var html = '';
                    html +='<li data-last-question-id="'+json.id+'">';
                    html +='<div data-last-answer-id="" class="item question_list">';
                    html +='<div class="tp">';
                    html +='<a href="javascript:;">';
                    html +='<img src="/Public/Member/images/logo/'+json.face+'.png" alt="">';
                    html +='</a>';
                    html +='</div>';
                    html +='<div class="txt">';
                    html +='<div class="txIn">';
                    html +='<div class="tHd">';
                    html +='<img style="display: inline-block" src="/Public/Member/images/user_group/'+json.user_group_id+'.png" alt="">';
                    html +='<span class="name">'+json.username+'</span>';
                    html +='</div>';
                    html +='<p class="wz">'+content+'</p>';
                    html +='<p class="from">';
                    html +='<span>';
                    html +='<em>来源：</em>';
                    html +='<a class="category_name" href="/Member/Video/showList/category/'+__category_id+'">'+__category_name+'/</a><a class="video_name" href="/Member/Video/play/vid/'+__vid+'">'+__video_name+'</a>';
                    html +='</span>';
                    html +='</p>';
                    html +='<div class="hand">';
                    html +='<span class="time">'+json.addtime+'</span>';
                    html +='<a onclick="createBox($(this))" class="mesIco mesIcoT"><i></i>(<span class="reply_count">0</span>)</a>';
                    html +='</div>';
                    html +='</div>';
                    html +='<div class="anArea anAreaT">';
                    html +='<form action="" method="post">';
                    html +='<textarea placeholder="" id="q'+json.id+'"></textarea>';
                    html +='<div class="bot">';
                    html +='<a href="javascript:;" class="cancleBtn cancel">取消</a>';
                    html +='<a data-question-id="'+json.id+'" onclick="replyMssage($(this),'+__user_id+', '+__user_id+')" style="background-color: #0b97c4; color: #fff;">提交</a>';
                    html +='</div>';
                    html +='</form>';
                    html +='</div>';
                    html +='</div>';
//                    html +='<?php if(!empty($val["is_show_more"])): ?>';
//                    html +='<a data-last-answer-id="" onclick="answer_page($(this), '+json.id+', '+__user_id+')" style="display:block; text-align: left; margin-left: 80px; margin-top:25px;cursor:pointer;color: rgba(102, 102, 102, 0.65);">查看更多</a>';
//                    html +='<?php endif; ?>';
                    html +=' </div>';
                    html +='</li>';


                    $('#questionlist').prepend(html);
                    __layedit.setContent(__question_index, '');
                    $('#question_noData').hide();

                    $('#question_total').text(question_total);
                }else{
                    __layer.msg(json.info);
                }
            }
        })
    }


</script>
<script>



//    用户离开页面，记录播放进度
    window.onunload = function(){
        var playtime = player.j2s_getCurrentTime();
//        console.log(playtime);
        $.ajax({
            type:"post",
            url: "/Member/Video/videoPlayRecord",
            data:{"vid":__vid, "playtime":playtime},
            dataType:"json",
            success:function (json) {

            }
        })
    }
</script>
<!--videoList.js-->
<script>
    var vidBody = '.videoBody', colList = '.courListX',
        lef = 336, liHig = 42, hc = 'hover', vc= 'playing';
    $(vidBody).hover(function(){
        $(this).find(colList).css({'left':0});
    },function(){
        $(this).find(colList).css({'left':-lef+'px'});
     });
    $(colList+' li').each(function(i) {
        var $e = $(this);
        if($e.hasClass(vc)) {
            $(colList+' ul').scrollTop(liHig * i);
            $e.addClass(hc).siblings('li').removeClass(hc);
        }
    }).hover(function () {
        var $e = $(this);
        if($e.hasClass(vc)){
            $e.addClass(hc);
        }else{
            $e.toggleClass(hc);
        }
    });
//    ie
    var ua = navigator.userAgent;
    if ((ua.indexOf('compatible') > -1 && (ua.indexOf('MSIE 8') > -1 || ua.indexOf('MSIE 9') > -1))) {
       $(colList).css('background-color','#000');
       $(colList+' ul').css('width','100%');
    }
</script>


</body>
</html>