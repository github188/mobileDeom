<?php if (!defined('THINK_PATH')) exit();?><!--header-->
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
    <link rel="stylesheet" href="//at.alicdn.com/t/font_xqe6sg1rhbzqia4i.css">
    <link rel="stylesheet" href="/Public/Member/pugins/libs/layui-master/css/layui.css">
    <!--[if lt IE9]>
    <script src="http://cdn.static.runoob.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/Public/Member/css/base.css">
    <link rel="stylesheet" href="/Public/Member/css/common.css">
    <link rel="stylesheet" href="/Public/Member/css/loginAfter.css">
</head>
<body>

<!--header-->

<!--header-->
<header class="toolBar clearfix" id="toolBar">
    <div class="in w1100 m0a ">
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
                <a href="javascript:;">
                    <span>联系我们</span>
                </a>
            </div>
            <div class="sp kf">
                <a href="javascript:;">
                    <span>客服中心</span>
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
                    <li><a href="<?php echo session(C('USER_AUTH_UID'))?U('Study/index'):U('Index/index');?>">首页</a><span></span></li>
                    <li><a href="<?php echo U('Index/course');?>">课程介绍</a><span></span></li>
                    <li><a href="<?php echo U('Study/newQuestion');?>">学习助手</a><span></span></li>
                    <li class="mes"><a href="<?php echo U('User/myNews');?>">消息</a><span></span><i class="mesNum">2</i></li>
                </ul>
            </nav>
            <div class="rCon fr">
                <div class="sel fl">
                    <input type="text" placeholder="淘宝客">
                    <a href="javascript:;" class="ico iconfont icon-sousuo"></a>
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



<!--content-->
<div class="videoContent m0a learnContent">
    <div class="videoTab mt20">
        <!--选项卡切换S-->
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <!--top菜单-->
            <ul class="layui-tab-title layui-tab-title-new">
    <!--<a href="<?php echo U('Study/myCourse');?>">   <li class="<?php echo ACTION_NAME=='myCourse'?'layui-this learnAcitve':'';?>">我的课程</li></a>-->
    <a href="<?php echo U('Study/newQuestion');?>"><li class="<?php echo ACTION_NAME=='newQuestion'?'layui-this learnAcitve':'';?>">最新问答</li></a>
    <a href="<?php echo U('Study/myNote');?>">     <li class="<?php echo ACTION_NAME=='myNote'?'layui-this learnAcitve':'';?>">我的笔记</li></a>
    <a href="<?php echo U('Study/myQuestion');?>"> <li class="<?php echo ACTION_NAME=='myQuestion'?'layui-this learnAcitve':'';?>">我的提问</li></a>
    <a href="<?php echo U('Study/faqQuestion');?>"><li class="<?php echo ACTION_NAME=='faqQuestion'?'layui-this learnAcitve':'';?>">问答收藏</li></a>
    <a href="<?php echo U('Study/faqCourse');?>">  <li class="<?php echo ACTION_NAME=='faqCourse'?'layui-this learnAcitve':'';?>">课程收藏</li></a>
</ul>
            <div class="layui-tab-content clearfix layui-tab-content-new">

                <!--我的课程-->
                <div class="layui-tab-item layui-show learnCourese bgColor m0a">
                    <div class="CoureseHeader mb30">
                        <ul class="clearfix">
                        <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="courseItem">
                                <a data-ctegoryid="<?php echo ($v["id"]); ?>" down="0"  class="leftTab itemActive">
                                    <?php echo ($v["name"]); ?><i class="iconfont icon-xiala-copy-copy1"></i>
                                </a>
                                <dl class="courseUl" style="display: none;">
                                <?php if(is_array($v["son"])): $i = 0; $__LIST__ = $v["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><dd>
                                        <a data-ctegoryid="<?php echo ($vv["id"]); ?>" href="javascript:;" onclick="changeCategory(<?php echo ($vv["id"]); ?>,1)" ><?php echo ($vv["name"]); ?></a>
                                    </dd><?php endforeach; endif; else: echo "" ;endif; ?>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="CoureseBody">
                        <ul class="list tab-bd" id="videolist">

                            <?php if(is_array($video)): $i = 0; $__LIST__ = $video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="item">
                                    <div class="itemdd">
                                        <a class="pic" href="javascript:;" target="_blank">
                                            <img class="img" src="<?php echo ($v["cover_img"]); ?>" alt="<?php echo ($v["title"]); ?>" title="<?php echo ($v["title"]); ?>">
                                            <i class="iconfont icon-shoucang"></i>
                                            <div class="p-thumb-taglt">
                                                <?php switch($v["is_tag"]): case "1": ?><span class="ico-lt">推荐</span><?php break;?>
                                                    <?php case "2": ?><span class="ico-lt icon-lt-new">最新视频</span><?php break;?>
                                                    <?php default: endswitch;?>
                                            </div>
                                        </a>
                                        <div class="details">
                                            <h3>
                                                <a href="#" class="fonts16"><?php echo ($v["title"]); ?></a>
                                            </h3>
                                            <div class="row clearfix">
                                                <span class="fl fonts14 FtColorV"><?php echo ($v["buy_money"]); ?></span>
                                                <a class="fr fonts14" href="javascript:;" target="_blank"><i class="iconfont icon-bofang"></i>播放</a>
                                            </div>
                                        </div>
                                    </div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>

                    <div id="demo2" class="Hpage"> <?php if($totalPages > 1): echo ($pages); endif; ?></div>

                </div>
            <!-- 当前选择分类 -->
            <input type="hidden" id="current_category">
            <!-- 总页数 -->
            <input type="hidden" id="totalPages" value="<?php echo ($totalPages); ?>">
             </div>
            <!--选项卡切换E-->
         </div>
  </div>
</div>
<!--footer-->
<footer class="footer clearfix mt20" id="footer">
    <div class="footHd w1100 m0a">
        <div class="hdL fl">
            <div class="log">
                <a href="javascript:;">
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
                <h6>关注我们</h6>
                <ol>
                    <li><a href="javascript:;">公司介绍</a></li>
                    <li><a href="javascript:;">团队风采</a></li>
                    <li><a href="javascript:;">招贤纳士</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>联系我们</h6>
                <ol>
                    <li><a href="javascript:;">联系方式</a></li>
                    <li><a href="javascript:;">在线留言</a></li>
                    <li><a href="javascript:;">招贤纳士</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>关注我们</h6>
                <ol>
                    <li><a href="javascript:;">新手客服</a></li>
                    <li><a href="javascript:;">客服中心</a></li>
                    <li><a href="javascript:;">网站地图</a></li>
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
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院2</a></li>
                <li><a href="javascript:;">嗨推学院3</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院3</a></li>
                <li><a href="javascript:;">嗨推学院88</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
                <li><a href="javascript:;">嗨推学院0</a></li>
                <li><a href="javascript:;">嗨推学院55</a></li>
                <li><a href="javascript:;">嗨推学院</a></li>
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
                <a href="javascript:;">
                    <i id="shopCarNum">3</i>
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
                <a href="javascript:;"></a>
                <div class="lePop" id="lePop02">
                    <img src="/Public/Member/images/ewmx.png" alt="">
                    <span>APP下载</span>
                    <em class="arr"></em>
                </div>
            </li>
            <li class="li04">
                <a href="javascript:;"></a>
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
    layui.use('layedit', function(){
        var layedit = layui.layedit;

        var index = layedit.build('demo', {
            // hideTool: ['image']
            uploadImage: {
                url: '/upload/test/'
                ,type: 'post'
            }
            //,hideTool: []
            ,height: 180
        });
    });


// 切换视频分类
function changeCategory(category_id, click_page){
//    if (category_id) {
        var url = '/Member/Study/myCourse';
        $.ajax({type:'get', url:url, data:{category_id:category_id, p:click_page}, dataType:'json',
            success:function(obj){
                if (obj.code == 1) {
                    var videoListHtml = '';
                    if (obj.content.length != 0) {
                        $.each(obj.content, function(k,v){
                            videoListHtml += '<li class="item"><div class="itemdd"><a class="pic" href="javascript:;" target="_blank"><img class="img" src="' + v.cover_img + '" alt="' + v.title + '" title="' + v.title + '"><i class="iconfont icon-shoucang"></i><div class="p-thumb-taglt">';
                                switch(parseInt(v.is_tag)){
                                    case 1:

                                        videoListHtml += '<span class="ico-lt">推荐</span>';
                                    break;
                                    case 2:
                                        videoListHtml += '<span class="ico-lt icon-lt-new">最新视频</span>';
                                    break;
                                }
                            videoListHtml += '</div></a><div class="details"><h3><a href="#" class="fonts16">' + v.title + '</a></h3><div class="row clearfix"><span class="fl fonts14 FtColorV">' + v.buy_money + '</span><a class="fr fonts14" href="javascript:;" target="_blank"><i class="iconfont icon-bofang"></i>播放</a></div></div></div></li>';
                        })
                    }else{
                        videoListHtml += '<p style="font-size:22px; text-align:center;">该分类下没有视频</p>'
                    }
                    if(obj.totalPages > 1){
                        $('#demo2').html(obj.pages);
                    }

                    $('#videolist').html(videoListHtml);
                    $('#current_category').val(category_id);
                    $('#totalPages').val(obj.totalPages);
                }else{
                    layer.msg(obj.msg);
                }
            }
        })
//    }

    $('#current_category').val(category_id);
}

// 分页方法
$('#demo2').on("click","a",function(event){
    event.preventDefault();
    var category_id = $('#current_category').val();
    var current_page = parseInt($('.current').text());
    var totalPages = $('#totalPages').val();
    var text = $(this).text();
    var click_page = 0;
    switch (text) {
        case '上一页':
            click_page = current_page - 1;
            break;
        case '下一页':
            click_page = current_page + 1;
            break;
        default:
            click_page = text;
    }

    if (click_page < 1 || click_page > totalPages) {
        return false;
    }

    changeCategory(category_id, click_page);
});
</script>