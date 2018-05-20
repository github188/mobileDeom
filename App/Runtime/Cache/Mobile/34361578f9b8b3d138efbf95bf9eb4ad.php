<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="browsermode" content="application">
    <meta name="x5-page-mode" content="app">
    <title>嗨推学院-知名网络推广实战培训平台</title>
    <link rel="stylesheet" href="/Public/Mobile/css/base.css">
    <link rel="stylesheet" href="/Public/Mobile/css/style.css">
</head>
<body>

<!--myHead-->
<section class="myHead">
    <div class="in">
        <div class="head">
            <div class="tp">
                <a href="<?php echo U('User/myLogo');?>"><img src="/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png" alt="个人头像"></a>
            </div>
            <div class="txt">
                <h2 class="name"><?php echo session(C('USER_AUTH_UNAME'));?></h2>
                <p class="lab"><?php echo session(C('USER_GROUP_UNAME'));?></p>
                <div class="money">
                    <span>学习币：<em><?php echo ($user_account['currency']); ?></em></span>
                    <a href="<?php echo U('Pay/payMoney');?>" class="goRecharge">充值</a>
                </div>
            </div>
            <div class="goJoin">
                <a href="<?php echo U('Pay/courseChoose');?>" class="goCourses">报名课程</a>
            </div>
        </div>
        <div class="list">
            <ul>
                <li>
                    <a href="<?php echo U('Video/videoCategory');?>">
                        <img src="/Public/Mobile/images/myTp01.png">
                        <span>我的课程</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Study/myNote');?>">
                        <img src="/Public/Mobile/images/myTp02.png">
                        <span>我的笔记</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Study/myQuestion');?>">
                        <img src="/Public/Mobile/images/myTp03.png">
                        <span>我的提问</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<!--myList-->
<section class="myList">
    <div class="in">
        <ul class="listUl">
            <li>
                <a href="<?php echo U('User/myInfo');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">基本信息</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/myGrade');?>"  class="item">
                    <i class="ico"></i>
                    <span class="ti">账号级别</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/myAccount');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">账户余额</span>
                    <em><?php echo ($user_account['currency']); ?></em>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/myBrokerage');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">我的佣金</span>
                    <em><?php echo ($user_account['brokerage']); ?></em>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/myRank');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">我的积分</span>
                    <em><?php echo ($user_account['integral']); ?></em>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/myAddressList');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">收货地址</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/faqQuestion');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">我的收藏</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Safe/securityList');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">安全设置</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/myNews');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">消息通知</span>
                    <em><?php echo ($user_msgCount?$user_msgCount:''); ?></em>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Content/contactUs');?>" class="item">
                    <i class="ico"></i>
                    <span class="ti">联系我们</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="item" onclick="loginOut();">
                    <i class="ico"></i>
                    <span class="ti">退出登陆</span>
                </a>
            </li>
        </ul>
    </div>
</section>

<!--悬浮菜单-->
<section class="btn_mark" id="markFix">
    <div class="btn_home">
        <i class="ico ico00"></i>
    </div>
    <div class="btn_mark_bg"></div>
    <a href="javascript:;" class="btn_menu btn_video"> <i onclick="location.href='<?php echo U('Index/videoList');?>';" class="ico ico02"></i></a>
    <a href="javascript:;" class="btn_menu btn_course"><i onclick="location.href='<?php echo U('Content/courseList');?>';" class="ico ico03"></i></a>
    <a href="javascript:;" class="btn_menu btn_index"> <i onclick="location.href='<?php echo U('Index/index');?>';" class="ico ico01"></i></a>
    <a href="javascript:;" class="btn_menu btn_my" >   <i onclick="location.href='<?php echo U('User/my');?>';" class="ico ico04"></i></a>
</section>

<!--footNav-->
<footer class="footNav">
    <div class="in">
        <ul class="nav">
            <li <?php echo ACTION_NAME=='index'?'class="cur"':'';?> >
                <a href="<?php echo U('Index/index');?>" class="item">
                    <img src="/Public/Mobile/images/nav01.png" rel="/Public/Mobile/images/nav01-hover.png" alt="">
                    <span class="ti">首页</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='videoList'?'class="cur"':'';?>>
                <a href="<?php echo U('Index/videoList');?>" class="item">
                    <img src="/Public/Mobile/images/nav02.png" rel="/Public/Mobile/images/nav02-hover.png" alt="">
                    <span class="ti">视频</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='allQuestion'?'class="cur"':'';?> <?php echo ACTION_NAME=='myQuestion'?'class="cur"':'';?>>
                <a href="<?php echo U('Study/allQuestion');?>" class="item">
                    <img <?php echo ACTION_NAME=='allQuestion'?'src="/Public/Mobile/images/nav03-hover.png"':'src="/Public/Mobile/images/nav03.png';?>" rel="/Public/Mobile/images/nav03-hover.png" alt="">
                    <span class="ti">问答</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='my'?'class="cur"':'';?>>
                <a href="<?php echo U('User/my');?>" class="item">
                    <img src="/Public/Mobile/images/nav04.png" rel="/Public/Mobile/images/nav04-hover.png" alt="">
                    <span class="ti">我的</span>
                </a>
            </li>
        </ul>
    </div>
</footer>

<script src="/Public/Mobile/js/jquery-1.11.3.min.js"></script>
<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

<script>
    var Url = "<?php echo U('Login/loginOut');?>";//退出登陆url
    //执行退出登陆操作
    function loginOut(){
        //底部对话框
        var index = layer.open({
            content: '确定要退出当前登陆吗？'
            ,btn: ['确定', '取消']
            ,skin: 'footer'
            ,yes: function(index){
                layer.close(index);
                $.post(Url,{},function(data){
                    if(data.status==0){
                        return false;
                    }
                    if(data.url!=''){
                        location.href = data.url;
                    }
                },'json');
            }
        });
    }
</script>

</body>
</html>

<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>