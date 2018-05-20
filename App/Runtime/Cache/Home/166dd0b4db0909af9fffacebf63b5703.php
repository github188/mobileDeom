<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8" name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0">
    <title>文章搜索列表 - 嗨推客服中心</title>

    <!--  引入首页的部分样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css"/>
   <!-- 移动端首页样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/moblie_index.css"/>
    <!-- 字体图标样式-->
    <link rel="stylesheet" href="/Public/Home/css/iconStyle.css"/>
    <!-- Font Awesome 图标字体 -->
    <link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
    <title><?php echo getConfig('web_name');?> - 客服中心官网首页</title>

</head>
<body>
<!-- 头部 -->
<div class="common_header clearfix">
    <a href="<?php echo U('Index/index');?>" class="logo"></a>
    <?php if(session('ht_kf_uid')){ ?>
        <span class="denglu">
            <a href="#" class="uname"><span class="h_denglu"></span><?php echo session('ht_kf_uname');?></a>
            <a href="<?php echo U('Login/logout');?>" class="logout">[退出]</a>
        </span>
    <?php }else{ ?>
    <a href="<?php echo U('Login/index');?>" class="denglu"><span class="h_denglu"></span>登录</a>
    <?php } ?>
</div>
<!--内容块-->
<div class="indexBanner">
    <div class="bannerText">
        <h1 class="fadeInB" >服务, 因为用心而温暖</h1>
        <div class="searchBox">
            <div class="kf_mod_searchBox">
                <form action="<?php echo U('Index/searchList');?>" method="post">
                    <div class="searchBar">
                        <input type="text" class="name" name="name" id="current_search_key" value="" placeholder="请输入关键字或问题搜索">
                        <button class="fa fa-search" type="submit" id="kf_search_index_btn"></button>
                    </div>
                </form>
                <div class="search_key_suggest" id="kf_search_index_key_suggest" style="display: none">
                </div>
            </div>
        </div>
    </div>
</div>
<!--广告内容块-->
<div class="moblie_content">
    <div class="item_content clearfix">
       <i class="moblieBgc-kecheng"></i>
       <a href="<?php echo U('Index/articleList');?>">
            <div class="item_content_left">
                <p class="ftColor" style="font-size: 17px">嗨推服务</p>
                <p>如何购买课程，如何购买课程</p>
                <p>项目实战，干货分享</p>
                <p>如何获得免费试听</p>
            </div>
        </a>
    </div>
    <div class="item_content clearfix">
        <i class="moblieBgc-weishang"></i>
        <a href="<?php echo U('Index/articleList');?>">
            <div class="item_content_left">
                <p class="ftColor" style="font-size: 17px">微商</p>
                <p>如何购买课程，如何购买课程</p>
                <p>项目实战，干货分享</p>
                <p>如何获得免费试听</p>
            </div>
        </a>
    </div>
    <div class="item_content clearfix">
        <i class="moblieBgc-icon-xinmeiti"></i>
        <a href="<?php echo U('Index/articleList');?>">
            <div class="item_content_left">
                <p class="ftColor" style="font-size: 17px">网络基础</p>
                <p>如何购买课程，如何购买课程</p>
                <p>项目实战，干货分享</p>
                <p>如何获得免费试听</p>
            </div>
        </a>
    </div>
    <div class="item_content clearfix">
        <i class="moblieBgc-icon-icon-taobaoke"></i>
        <a href="<?php echo U('Index/articleList');?>">
            <div class="item_content_left">
                <p class="ftColor" style="font-size: 17px">淘宝客</p>
                <p>如何购买课程，如何购买课程</p>
                <p>项目实战，干货分享</p>
                <p>如何获得免费试听</p>
            </div>
        </a>
    </div>
</div>
<!--底部-->
<div class="moblie_footer">
    <div class="rightArea">
        <ul class="codes">
            <li>
                <div class="codeBox">
                    <img src="/Public/Home/erweima/wechat_code.png">
                </div>
                <span>嗨推学院微信公众号</span>
            </li>
            <li style="margin-left: 10%;">
                <div class="codeBox">
                    <a href="http://app.hitui.com" target="_blank"><img src="/Public/Home/erweima/hitui_app.png"></a>
                </div>
                <span>嗨推APP客户端下载</span>
            </li>
        </ul>
    </div>
    <div class="leftArea">
        <p id="copyright">Copyright © 2013 - 2017 嗨推学院学习平台 版权所有</p>
    </div>

</div>



</body>
</html>