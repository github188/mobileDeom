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
<!--theMenu-->
<section class="theMenu">
    <div class="tabMenu">
        <div class="tabMenu_left">
            <div class="tabMenu_list">
                <ul>
                    <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                    <li <?php echo ACTION_NAME=='courseList'?'class="cur"':'';?> ><a href="<?php echo U('Content/courseList');?>">课程简介</a></li>
                    <li <?php echo ACTION_NAME=='videoList'?'class="cur"':'';?> ><a href="<?php echo U('Index/videoList');?>">课程视频</a></li>
                    <li <?php echo ACTION_NAME=='contactUs'?'class="cur"':'';?> ><a href="<?php echo U('Content/contactUs');?>">联系我们</a></li>
                    <li <?php echo ACTION_NAME=='webNoticeList'?'class="cur"':'';?> ><a href="<?php echo U('Content/webNoticeList');?>">平台公告</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<style>
    .layui-layer-demo{
        left: 0;
        width: calc(100%);
    }
    body{ background-color: #fff;}
</style>
<!--student-->
<section class="student">
    <div class="in">
        <div class="myBan">
            <a href="javascript:;" class="tp">
                <img src="/Public/Mobile/images/banTp.jpg" alt="">
            </a>
        </div>
        <div class="tab">
            <ol>
                <li class="li01 cur"><a href="javascript:;">学员介绍</a></li>
                <li class="li02"><a href="javascript:;">学员视频</a></li>
            </ol>
        </div>
        <div class="stuCom">

            <!--学员介绍-->
            <ul class="list list01">
                <?php if(is_array($studentRemark)): $i = 0; $__LIST__ = $studentRemark;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="js-text">
                        <div class="item">
                            <div class="tp">
                                <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="<?php echo ($val["cover_img"]); ?>" alt="">
                            </div>
                            <div class="txt">
                                <div class="tName"><?php echo ($val["title"]); ?></div>
                                <div class="wz js-wz"><?php echo ($val["content"]); ?></div>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>



            <!--学员视频-->
            <ul class="list list02">
                <?php if(is_array($videoStudent)): $i = 0; $__LIST__ = $videoStudent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
                    <div class="item">
                        <div data-code="<?php echo ($val["video_code"]); ?>" data-vid="<?php echo ($val["id"]); ?>" class="tp play_video">
                            <a href="javascript:;">
                                <i class="ico-play"></i>
                                <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="<?php echo ($val["cover_img"]); ?>" alt="">
                            </a>
                        </div>
                        <div class="txt">
                            <p class="ti"><?php echo ($val["title"]); ?></p>
                            <span class="more js-thgMore">更多<i class="ico"></i></span>
                        </div>
                    </div>
                    <div class="txBd">
                        <p class="ti"><?php echo ($val["remark"]); ?></p>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</section>

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
<script src="/Public/Mobile/js/menuSilder.js"></script>
<script src="/Public/Mobile/js/theMenu.js"></script>
<script src="/Public/AdminLte/layer/layer.js"></script>
<script>

    $('.play_video').on('click', function () {
        var vid = $(this).attr('data-vid');
        var code = $(this).attr('data-code');
        var w = document.body.clientWidth;
        var url = "<?php echo U('Student/openVideoPlay','',false);?>" + "/vid/"+vid+"/code/"+code+"/w/"+w;

        var h = document.body.clientHeight;
        h = h/3;

        //播放视频弹窗
        layer.open({
            type: 2,
            title:'学员公开视频',
            skin: 'layui-layer-demo', //样式类名
            scrollbar: false,
            closeBtn: 1, //不显示关闭按钮
            anim: 2,
            area: [w, h],
            shadeClose: true, //开启遮罩关闭
            shade: 0.5, //遮罩
            content: url
        });
    });
</script>
</body>
</html>