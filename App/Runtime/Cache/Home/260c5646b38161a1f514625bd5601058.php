<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8" name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0">
    <title>文章搜索列表 - 嗨推客服中心</title>
   <!-- 移动端首页样式-->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/moblie_index.css"/>
    <link rel="stylesheet" href="/Public/Home/css/reset.css"/>
    <link rel="stylesheet" href="/Public/Home/css/moblie_list.css"/>
    <!--  浮窗样式 -->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
    <!-- Font Awesome 图标字体 -->
    <link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/Public/AdminLte/dist/css/AdminLTE.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/kefu_public.css">
    <script type="text/javascript" src="/Public/AdminLte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
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
        <ul id="nav-main">
            <li class="mainLi" style="position: relative;" id="mainLi">
                <a style="color: #333333;font-size: 14px;" down="0" id="moblieTab">文章分类<span  class="arrows arrows-down"></span></a>
                <div class="bgc_mask" id="bgc_mask" style="display: none"></div>
                <ul id="two" flag=0 class="twoUl">
                    <?php if(is_array($cate)): foreach($cate as $key=>$val): ?><li style="text-align: -webkit-auto;" id="jqLi" flag="0">
                            <a id="oneA" onclick="changeArrow(this);"><i style="margin-left: 18%;font-size: 14px;"><?php echo ($val["name"]); ?></i><span  class="arrows arrows-right" style="float: right;margin-top: 11%;margin-right: 10%;"></span></a>
                            <ul class="aaa" >
                                <?php if(is_array($val["child"])): foreach($val["child"] as $key=>$v): ?><li><a style="background: #eee" class="twoA " href="<?php echo U('list/'.$v['id']);?>" <?php if($v['id'] == $cid): ?>class="current"<?php endif; ?> ><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
                            </ul>
                        </li><?php endforeach; endif; ?>
                </ul>
            </li>
            <!--<li>-->
            <!--<a href="<?php echo U('Index/index');?>">客服首页</a>-->
            <!--</li>-->
        </ul>
        <div class="faq_cont_list">
            <div class="tip" id="product_tip">
            </div>
            <div class="hotQuestion questionList" id="faqlist">
                <dl>

                    <?php if(is_array($article)): foreach($article as $key=>$v): ?><dd><a href="<?php echo U('c/'.$v['id']);?>"><i class="iconfont icon-read"></i>  &nbsp; <?php echo ($v["title"]); ?></a></dd><?php endforeach; endif; ?>

                    <?php if($totalPages > 1): ?><div style="text-align: center;margin: 30px 0;">
                            <div class="pages"><?php echo ($page); ?></div>
                        </div><?php endif; ?>

                </dl>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("ul li").hover(function(){
            $(this).find("ul:first").show();//鼠标滑过查找li下面的第一个ul然后显示；
            $(this).find("ul:first").css("display","fixed");
            //控制遮罩层的样式
            if($("#two").css("display")=="block"){
                $("#bgc_mask").show();
            }else if($("#two").css("display")=="none"){
                $("#bgc_mask").hide();
            }
        },function(){
            $(this).find("ul:first").hide();//鼠标离开隐藏li下面d的ul；
        })
        $("ul li ul li ul").prev().addClass("bbb");//给li下面ul是aaa的样式的前一个同辈元素添加css；
    })
    $(function($) {
        $('#moblieTab').on('click',function(){
            var down_ = $(this).attr('down');
            var that=$(this);
            if (down_ ==0) {
                that.find('span').removeClass('arrows-down');
                that.find('span').addClass('arrows-top');
                that.attr('down',1);
                return false;
            }else{
                that.find('span').removeClass('arrows-top');
                that.find('span').addClass('arrows-down');
                that.attr('down',0);
            }
        });
    });

//对遮罩层的高度做处理
    var height=$("#two").height();
    console.log(height);
    $("#bgc_mask").css({
        "position":"fixed",
         "top":"height",
          "left":"0"
    })


</script>
</body>
</html>