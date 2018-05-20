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
                    <li class="cur"><a href="<?php echo U('User/myAccount');?>">充值记录</a></li>
                    <li><a href="<?php echo U('User/myAccountPurchase');?>">消费记录</a></li>
                </ol>
            </div>
            <div class="list">
                <ul class="ul01">
                    <li>
                        <div class="tit">
                            <span class="ti0 ti01">订单号</span>
                            <span class="ti0 ti02">金额</span>
                            <span class="ti0 ti03">学习币</span>
                            <span class="ti0 ti04">状态</span>
                        </div>
                        <div class="itemCom">
                            <?php if(is_array($order_pay)): $k = 0; $__LIST__ = $order_pay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="item">
                                    <a href="myTradeDet.html">
                                        <span class="ti0 ti01"><?php echo ($v["trade_no"]); ?></span>
                                        <span class="ti0 ti02"><?php echo ($v["buyer_pay_money"]); ?></span>
                                        <span class="ti0 ti03"><?php echo ($v["currency"]); ?></span>
                                        <span class="ti0 ti04">
                                            <?php if($v['status'] == 2): ?>成功
                                            <?php elseif($v['status'] == 0): ?>
                                                <button type="button" class="btn pay" onclick="window.open('')">付款</button>
                                                <button type="button" class="btn cancle" onclick="window.open('')">取消</button>
                                            <?php else: ?>
                                                失败<?php endif; ?>
                                        </span>
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