<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8" name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0">
    <title>文章搜索列表 - 嗨推客服中心</title>
   <!-- 移动端首页样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/moblie_index.css"/>
    <link rel="stylesheet" href="/Public/Home/css/reset.css"/>
    <link rel="stylesheet" href="/Public/Home/css/moblie_list.css"/>
    
    <!-- Font Awesome 图标字体 -->
    <link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/Public/AdminLte/dist/css/AdminLTE.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/kefu_public.css">
    <style type="text/css">
        a i {
            color: #00ace9;
            float: left;
            font-size: 18px;
            text-indent: 0;
        }
        .current{
/*            color: #00ace9;*/
            font-weight: bold;
        }

    </style>
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
<div class="cont_container">
    <div class="faq_cont_container">
        <div class="searchBox">
            <div class="kf_mod_searchBox">
                <form action="<?php echo U('Index/searchList');?>" method="post">
                    <div class="searchBar">
                        <input type="text" class="search" name="name" id="current_search_key" value="" placeholder="请输入关键字或问题搜索">
                        <button class="iconfont icon-search" id="kf_search_index_btn"></button>
                    </div>
                </form>
                <div class="search_key_suggest" id="kf_search_index_key_suggest" style="display: none">
                </div>
            </div>
        </div>
        <div class="faq_cont_list">
            <div class="tip" id="product_tip">
            </div>
            <div class="hotQuestion questionList" id="faqlist">
                <dl>
                    <?php if($arr): if(is_array($arr)): foreach($arr as $key=>$v): ?><dd><a href="<?php echo U('c/'.$v['id']);?>"><i class="iconfont icon-read"></i>  &nbsp; <?php echo ($v["title"]); ?></a></dd><?php endforeach; endif; ?>

                        <?php if($totalPages > 1): ?><div style="text-align: center;margin: 30px 0;">
                                <div class="pages"><?php echo ($page); ?></div>
                            </div><?php endif; ?>

                    <?php else: ?>
                        <dd>很抱歉，找不到您搜索的【 <span style="color: red;"> <?php echo ($name); ?> </span> 】<i>相符的内容或信息。</dd><?php endif; ?>
                </dl>
            </div>
        </div>
    </div>
</div>
</body>
</html>