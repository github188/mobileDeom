<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
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
<body style="background-color: #fff;">

<!--noticeDet-->
<section class="noticeDet">
    <div class="in">
        <div class="pageHd">
            <h3 class="tit"><?php echo ($data['title']); ?></h3>
            <div class="date">发布时间：<?php echo date('Y-m-d H:i',$data['addtime']);?></div>
        </div>
        <div class="pageBd">
            <?php echo htmlspecialchars_decode($data['content']);?>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

</body>
</html>