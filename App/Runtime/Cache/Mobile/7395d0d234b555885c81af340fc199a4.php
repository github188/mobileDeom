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
<style>
    /*翻页*/
    .pages{
        display: inline-table;
        height: 50px;
        text-align: center;
        padding-top: 20px;
    }
    .pages a,.pages span{
        display: inline;
        border-radius: 4px;
        margin: 0 3px;
        background-color: #fff;
        border: 1px solid #ddd;
        color: #ff6100;
        float: left;
        line-height: 1.42857;
        padding: 6px 10px;
        position: relative;
        text-decoration: none;
    }
    .pages a:hover{
        background-color: #eee;
        border-color: #ddd;
        color: #111;
        z-index: 2;
    }
    .pages .current{
        background-color: #ff6100;
        border-color: #ff6100;
        color: #fff;
        cursor: default;
        z-index: 3;
    }
    .pages >div{
        line-height: 32px;
        text-align: center;
    }
    .pages .prev_disabled , .pages .next_disabled{
        cursor: no-drop;
    }
</style>
<!--myAccount-->
<section class="myAccount">
    <div class="in">
        <div class="accHd">
            <h3 class="tit">账户余额</h3>
            <div class="mm">
                <i class="ico"></i>
                <em><?php echo ($user_account['currency']); ?></em>
                <span>学习币</span>
            </div>
            <div class="bot">
                <a href="myRecharge01.html" class="payBtn">充值</a>
                <a href="<?php echo U('Pay/courseChoose');?>" class="joinBtn">报名课程</a>
            </div>
        </div>
        <div class="accChg">
            <div class="tab">
                <ol>
                    <li><a href="<?php echo U('User/myAccount');?>">充值记录</a></li>
                    <li class="cur"><a href="<?php echo U('User/myAccountPurchase');?>">消费记录</a></li>
                </ol>
            </div>
            <div class="list">
                <ul class="ul01">
                    <li>
                        <div class="tit">
                            <span class="ti0 ti01">课程类型</span>
                            <span class="ti0 ti02">学习币</span>
                            <span class="ti0 ti03">消费时间</span>
                            <span class="ti0 ti04">状态</span>
                        </div>
                        <div class="itemCom">
                            <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="item">
                                    <a href="<?php echo U('Pay/courseResult',array('order'=>$v['id'],'orderDetail'=>1));?>">
                                        <span class="ti0 ti01"><?php echo jiequ($v['goods_name'],0,15,'');?></span>
                                        <span class="ti0 ti02"><?php echo ($v['pay_currency']); ?></span>
                                        <span class="ti0 ti03"><?php echo ($v['status']==1?date('Y/m/d',$v['paytime']):date('Y/m/d',$v['addtime'])); ?></span>
                                        <?php if($v['status'] == 1): ?><span class="ti0 ti04">
                                                    成功
                                                </span>
                                            <?php else: ?>
                                                <span class="ti0 ti04" data-id="<?php echo ($v['id']); ?>">
                                                    <a href="javascript:;" class="payOrderBtn" >[支付]</a> <a href="javascript:;" class="deleteOrderBtn" >[取消]</a>
                                                </span><?php endif; ?>
                                    </a>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </li>
                </ul>
                <ul class="ul02">

                </ul>
            </div>
        </div>
    </div>
</section>
<?php if($totalPages > 1): ?><div class="pages"><?php echo ($pages); ?></div><?php endif; ?>
<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

</body>
</html>