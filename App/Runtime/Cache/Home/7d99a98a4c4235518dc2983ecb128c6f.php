<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Keywords" content=" 嗨推学院客服，嗨推在线客服，嗨推客服中心，嗨推客服网站，嗨推客服在线，，嗨推客服电话，嗨推客服，嗨推客服网站，嗨推客服首页，嗨推客服官网，嗨推官网客服，嗨推客服中心，嗨推客户服务，嗨推客服电话"/>
    <meta name="description" content="嗨推客服官网网站，为您解决使用嗨推产品过程中遇到的问题，嗨推客服中心提醒您：谨防网络骗术，教您如何识别网络骗术"/>
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="robots" content="all">
    <meta name="author" content="Tencent-OUI">
    <meta name="Copyright" content="Tencent">

    <link rel="stylesheet" type="text/css" href="/Public/Home/css/kefu_public.css">
    <!--  浮窗样式 -->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
    <!-- Font Awesome 图标字体 -->
    <link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/AdminLte/dist/css/AdminLTE.min.css">

    <title>问题文章列表 - <?php echo getConfig('web_name');?></title>
    <style type="text/css">
        .pages > div{
            margin-left: 1px;
        }
        .pages > div >i{
            display: block; 
            width:93%;
        }
    </style>
</head>
<body>
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

    



<!--内容区域begin-->
<div class="main">
    <div class="container">
        <div class="sw-crumb clearfix mb15">
            <ul class="fleft">
                <em>当前位置：</em>
                <li><a href="/">首页</a>&nbsp; &gt; </li>
                <li><?php echo getCateName($pid);?>&nbsp; &gt; </li>
                <li><a href="<?php echo U('list/'.$cid);?>"><?php echo getCateName($cid);?></a>&nbsp; &gt; </li>
                <li>文章列表</li>
            </ul>
        </div>
        <!--左边选项卡-->
        <style>
    .fa {
        display: inline;
        margin-left: -25px;
    }
</style>
<div class="aside_container">
    <div class="faq_kinds_aside">
        <ul class="faq_kinds sw-listRank" id="menu_list">
            <li><a class="column" id="hot_faq">栏目分类</a></li>
            <?php if(is_array($cate)): foreach($cate as $key=>$val): ?><li>
                    <a down="0" id="<?php echo ($val["id"]); ?>" class="leftTab">
                        <i class="fa fa-angle-right" style="width: 6px"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($val["name"]); ?>
                    </a>
                    <dl>
                        <?php if(is_array($val["child"])): foreach($val["child"] as $key=>$v): ?><dd>
                                <a href="<?php echo U('list/'.$v['id']);?>" id="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $cid): ?>class="current"<?php endif; ?> ><?php echo ($v["name"]); ?></a>
                            </dd><?php endforeach; endif; ?>
                    </dl>
                </li><?php endforeach; endif; ?>
        </ul>
    </div>

    <div class="sw-listRank ">
        <div id="topten">
            <h3 class="h3">最新文章</h3><ol>
            <?php if(is_array($new_article)): foreach($new_article as $key=>$v): ?><li>
                    <?php echo ($v["pv"]); ?> 次阅读: <br>
                    <a href="<?php echo U('c/'.$v['id']);?>"><?php echo (jiequ($v["title"],0,30,'')); ?></a>
                </li><?php endforeach; endif; ?>

        </ol>
        </div>
    </div>



</div>

        <div class="cont_container">
            <div class="faq_cont_container details_cont_container">
                <div class="searchBox">
                    <!--<a href="javascript:history.go(-1);" class="btn-back"><i class="iconfont icon-back"></i>返回</a>-->
                    <div class="kf_mod_searchBox">
                        <form action="<?php echo U('Index/searchList');?>" method="post">
                            <div class="searchBar">
                                <input type="text" class="search" name="name" id="current_search_key" value="" placeholder="请输入关键字或问题搜索">
                                <button class="iconfont icon-search" type="submit" id="kf_search_inner_btn"></button>
                            </div>
                        </form>
                        <div class="search_key_suggest" id="kf_search_index_key_suggest" style="display: none"></div>
                    </div>
                </div>

                <!--问题列表-->
                <div class="faq_cont_list">
                    <div class="hotQuestion questionList" id="faqlist">
                        <dl>
                            <?php if(is_array($article)): foreach($article as $k=>$v): ?><dd>
                                    <a href="<?php echo U('c/'.$v['id']);?>">
                                        <i class="iconfont icon-read" style="color: #00ACE9;"></i> &nbsp; <?php echo (jiequ($v["title"],0,42,'...')); ?>
                                    </a>
                                    <span style="float: right; line-height: 30px;"><?php echo (date('Y-m-d',$v["addtime"])); ?></span>
                                </dd><?php endforeach; endif; ?>
                        </dl>
                        <?php if(!$article): ?><dl style="text-align: center; margin: 30px 0;">
                                <dd> 暂没有文章数据！</dd>
                            </dl><?php endif; ?>
                        <?php if($totalPages > 1): ?><div style="text-align: center; margin: 30px 0;">
                                <div class="pages"><?php echo ($page); ?></div>
                            </div><?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--内容区域end-->
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