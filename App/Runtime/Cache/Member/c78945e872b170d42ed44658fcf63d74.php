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


<style>

    .ask *,.wz img{
        display: inline-block;
    }
    .ask .time{
        display: block;
        font-size: 12px;
        color: #999;
    }
</style>

<style>
    .Hmore:hover {
        background-color: #ff6100;
        color: #fff;
    }
    .Hmore {
        display: inline-block;
        border: 1px solid #ff6f26;
        color: #ff6f26;
        text-align: center;
        padding: 11px 190px;
        border-radius: 4px;
        margin-top: 100px;
        margin-bottom: 60px;
        font-size: 18px;
        transition: all .6s ease;
        -webkit-transition: all .6s ease;
        -moz-transition: all .6s ease;
        -ms-transition: all .6s ease;
    }
</style>
<!--indexCom-->
<section class="indexCom mt20" id="indexCom">
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
            <div class="com notice">
                <div class="notBg">
                    <div class="txt">
                        <h5>欢迎来到嗨推学院！</h5>
                        <p>亲爱的嗨推学院 网络推广精英 学员，昨天有114人比你更努力哦！</p>
                        <p>抓紧时间学习，多多提问哦！</p>
                    </div>
                    <div class="bbtn">
                        <a href="<?php echo U('Pay/courseChoose');?>" class="layui-btn layui-btn-danger">立即升级</a>
                    </div>
                </div>
                <div class="gfNot">
                    <div class="tit fl">
                        <i></i>
                        <h6>官方公告：</h6>
                    </div>
                    <ul class="">
                        <?php if(is_array($notice)): $k = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                                <a href="<?php echo U('Content/webNotice',array('main'=>$v['id']));?>">
                                    <p><?php echo ($v['title']); ?></p>
                                </a>
                                <span><?php echo date('Y/m/d',$v['addtime']);?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="com record mt20">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4>你的记录</h4>
                </div>
                <div class="reList">
                    <ol>
                        <li>
                            <a href="javascript:;">
                                <img src="/Public/Member/images/record01.png"  alt="">
                                <div class="sNum">
                                    <span class="num"><?php echo ($AllowSeeVideo); ?></span>节
                                </div>
                                <p>已开通课程数</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <img src="/Public/Member/images/record02.png"  alt="">
                                <div class="sNum">
                                    <span class="num"><?php echo ($learned); ?></span>节
                                </div>
                                <p>已学习课程数</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <img src="/Public/Member/images/record03.png"  alt="">
                                <div class="sNum">
                                    <span class="num"><?php echo ($question); ?></span>条
                                </div>
                                <p>你已提问了</p>
                            </a>
                        </li>
                        <li class="lastLi">
                            <a href="javascript:;">
                                <img src="/Public/Member/images/record04.png" alt="">
                                <div class="sNum">
                                    <span class="num"><?php echo ($user_ranking); ?></span>名
                                </div>
                                <p>您的排名</p>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="com webNot mt20">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4>网站公告</h4>
                </div>
                <ul>
                    <?php if(is_array($notice)): $k = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                            <a href="<?php echo U('Content/webNotice',array('main'=>$v['id']));?>">
                                <i></i>
                                <p><?php echo ($v['title']); ?></p>
                                <span><?php echo date('Y-m-d',$v['addtime']);?></span>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="com newsAsk mt20">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4>最新问答</h4>
                </div>
                <ul id="questionlist" data-last-question-id="<?php echo ($newQuestion["end_id"]); ?>">
                    <?php if(empty($newQuestion["question"])): ?><!--没有数据：-->
                        <div class="noData" style="text-align: center;">
                            <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据"  width="" height="">
                            <p>您目前数据为空</p>
                        </div><?php endif; ?>
                    <?php if(is_array($newQuestion["question"])): foreach($newQuestion["question"] as $k=>$val): ?><li data-last-question-id="<?php echo ($val["id"]); ?>">
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
                                                <a href="/Member/Video/showList/category/<?php echo ($val["category_id"]); ?>"><?php echo ($val["category_name"]); ?>/</a><a href="/Member/Video/play/vid/<?php echo ($val["vid"]); ?>"><?php echo ($val["video_name"]); ?></a>
                                            </span>
                                        </p>
                                        <div class="hand">
                                            <span class="time"><?php echo (date("Y-m-d H:i",$val["addtime"])); ?></span>
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
                                                        <a href="javascript:;" class="cancleBtn">取消</a>
                                                        <a style="background-color: #0b97c4; color: #fff;" data-question-id="<?php echo ($val["id"]); ?>" data-answer-id="<?php echo ($v["id"]); ?>" onclick="replyMssage($(this),<?php echo ($v["user_id"]); ?>, <?php echo ($user_id); ?>)">提交</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><?php endforeach; endif; ?>
                                <?php if(!empty($val["is_show_more"])): ?><a data-limit-end-id="<?php echo ($val["limit_end_id"]); ?>" onclick="answer_page($(this), <?php echo ($val["id"]); ?>, <?php echo ($user_id); ?>)" style="display:block; text-align: left; margin-left: 80px; margin-top:25px;cursor:pointer;color: rgba(102, 102, 102, 0.65);">查看更多</a><?php endif; ?>
                            </div>
                        </li><?php endforeach; endif; ?>

                    <?php if(!empty($newQuestion["is_show_more"])): ?><div class="bgColor textAlign mt-10">
                            <a data-last-limit-id="<?php echo ($newQuestion["limit_end_id"]); ?>" class="Hmore m0a" onclick="question_page($(this), <?php echo ($user_id); ?>)">点击加载更多</a></div><?php endif; ?>

                </ul>
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

<!--回复评论JS-->
<script src="/Public/Member/js/replyMssage.js"></script>

<script>


</script>