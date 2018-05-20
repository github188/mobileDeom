<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>视频播放页面</title>
    <link rel="stylesheet" href="/Public/Member/css/base.css">
</head>
<body>
<script src='//player.polyv.net/script/polyvplayer.min.js'></script>
<!-- 视频播放 -->
<div class="play_box" id='plv_efbb4ae8ac5c4e4f2019c1909f411ea8_e'></div>
<script>
    //视频播放参数
    var player = polyvObject('#plv_efbb4ae8ac5c4e4f2019c1909f411ea8_e').videoPlayer({
        'width':'750',
        'height':'450',
        'vid' : 'efbb4ae8ac5c4e4f2019c1909f411ea8_e'
    });
</script>
</body>
</html>