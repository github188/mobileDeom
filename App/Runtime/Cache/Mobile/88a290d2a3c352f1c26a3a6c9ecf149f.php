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
<body style="background-color: #fff;">

<!-- myBrokerage-->
<section class="myAccount myBrokerage">
    <div class="in">
        <div class="accHd">
            <h3 class="tit">我的佣金</h3>
            <div class="mm">
                <i class="ico"></i>
                <em><?php echo ($user_account['brokerage']); ?></em>
                <span>佣金额</span>
            </div>
            <div class="bot">
                <a href="<?php echo U('User/myTiXian');?>" class="joinBtn withdrawBtn">提现</a>
            </div>
        </div>
        <div class="accChg">
            <div class="tab">
                <ol>
                    <li class="<?php echo ACTION_NAME=='myBrokerage'?'cur':'';?>"><a href="<?php echo U('User/myBrokerage');?>">提现记录</a></li>
                    <li class="<?php echo ACTION_NAME=='myInvite' && $status==1?'cur':'';?>"><a href="<?php echo U('User/myInvite',array('status'=>1));?>">已出佣金</a></li>
                    <li class="<?php echo ACTION_NAME=='myInvite' && $status==0?'cur':'';?>"><a href="<?php echo U('User/myInvite');?>">未出佣金</a></li>
                </ol>
            </div>
            <div class="list">
                <ul>
                    <li>
                        <div class="tit">
                            <span class="ti0 ti01">账号</span>
                            <span class="ti0 ti02">金额</span>
                            <span class="ti0 ti03">时间</span>
                            <span class="ti0 ti04">状态</span>
                        </div>
                        <div class="itemCom">
                            <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="item <?php echo ($v['ratify_status']==0?'itemIng':'itemEd'); ?> ">
                                    <a href="<?php echo U('User/myTiXianDetail',array('order'=>$v['id']));?>">
                                        <span class="ti0 ti01">尾号(<?php echo substr($v['number'],-4);?>)</span>
                                        <span class="ti0 ti02"><?php echo ($v['money']); ?></span>
                                        <span class="ti0 ti03"><?php echo date('Y.m.d',$v['addtime']);?></span>
                                        <span class="ti0 ti04">
                                            <?php if($v['ratify_status'] == 0): ?>审核中
                                                <?php elseif($v['ratify_status'] == 1): ?>
                                                成功
                                                <?php else: ?>
                                                失败<?php endif; ?>
                                        </span>
                                    </a>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php if(!$data): ?><p style="text-align: center;line-height: 100px;">还没有提现记录哦~</p><?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

</body>
</html>