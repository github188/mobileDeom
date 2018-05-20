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
<style>
    body{background: #fff}
</style>
<!--myCollect-->
<section class="myCollect">
    <div class="in">
        <div class="tab">
            <ol>
                <li><a href="<?php echo U('User/faqQuestion');?>">问题收藏</a></li>
                <li class="cur"><a href="javascript:;">课程收藏</a></li>
            </ol>
        </div>
        <div class="askList collList">

            <ul class="ul02" style="display: block">
                <?php if(empty($dataList)): ?><!--没有数据：-->
                    <div class="noData" style="text-align: center;">
                        <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据"  width="" height="">
                        <p>您目前数据为空</p>
                    </div><?php endif; ?>

                <?php if(is_array($dataList)): foreach($dataList as $k=>$val): ?><li>
                    <i class="ico"></i>
                    <a href="<?php echo U('Video/play', array('vid' => $val['vid']));?>" class="tx"><?php echo ($val["title"]); ?></a>
                    <div class="bot">
                        <span class="collectIco" data-vid="<?php echo ($val["vid"]); ?>"><s></s>取消</span>
                        <span class="date"><?php echo (date("Y-m-d H:i",$val["addtime"])); ?></span>
                    </div>
                </li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</section>





<script src="/Public/Mobile/js/jquery-1.11.3.min.js"></script>

<script src="/Public/Mobile/js/base.js"></script>
<!--提示插件-->
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>


<script>
    $('.collectIco').click(function () {
        var url = "<?php echo U('Video/videoShoucang');?>";
        var vid = $(this).attr('data-vid');
        var thisObj = $(this);

        $.ajax({
            type:"post",
            url:url,
            data:{"vid":vid},
            dataType:"json",
            success:function (data) {

                layer.open({
                    time: 2,
                    skin: "msg",
                    content:'已取消收藏'
                })

                thisObj.parents('li').slideUp();

            }
        })
    })
</script>