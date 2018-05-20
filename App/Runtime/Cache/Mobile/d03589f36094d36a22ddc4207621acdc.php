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
    <link rel="stylesheet" href="/Public/Mobile/css/common.css">
    <link rel="stylesheet" href="/Public/Mobile/css/style.css">
</head>
<body>

<!--myGrade-->
<section class="myGrade">
    <div class="in">
        <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="itemCom">
                <div class="item">
                    <span class="ti fl"><img style="display: inline-block;border-radius: 3px;" src="/Public/Member/images/user_group/<?php echo ($v['group_id']); ?>.png" width="18px" height="18px" alt="图片"/>&nbsp;&nbsp;<?php echo ($v['group_name']); ?></span>
                    <div class="date fr"><?php echo date('Y-m-d',$v['end_time']);?> <?php if($v['end_time'] < time()): ?><em style="color: red;">(已过期)</em><?php endif; ?></div>
                    <i class="arr js-arr"></i>
                </div>
                <ul>
                    <li>
                        <a href="javascript:;">新人学习指导</a>
                    </li>
                    <li>
                        <a href="javascript:;">基础技能演练</a>
                    </li>
                </ul>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <div class="myBtn">
            <a href="<?php echo U('Pay/courseChoose');?>">升级账号</a>
        </div>
        <p style="text-align: right;padding: 0 15px 0 0;"><a href="<?php echo U('User/my');?>">&lt;&lt;返回</a></p>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

</body>
</html>