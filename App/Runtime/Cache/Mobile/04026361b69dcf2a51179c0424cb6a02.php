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
<style type="text/css">
    body{
        background-color: #fff;
    }
</style>

<!--myRecharge-->
<section class="myRecharge">
    <div class="in">
        <div class="withRate">
            <div class="tp">
                <img src="/Public/Mobile/images/rate02.png">
            </div>
            <div class="txt">
                <div class="tx01 cur">
                    <span>充值学习币</span>
                </div>
                <div class="tx02 cur">
                    <span>支付方式</span>
                </div>
                <div class="tx03">
                    <span>支付成功</span>
                </div>
            </div>
        </div>
        <form action="<?php echo U('Pay/payAlipay');?>" method="post" class="myForm" name="payForm">
            <div class="recDet">
                <p><span>订单编号：</span><span><?php echo ($trade_no); ?></span></p>
                <p><span>充值数量：</span><span><?php echo ($money); ?>学习币</span></p>
                <p><span>应付总金额：</span><em>¥<?php echo ($money); ?>元</em></p>
            </div>
            <div class="recStyle">
                <h6 class="tit">充值方式：</h6>
                <ul>
                    <li>
                        <a href="javascript:;" class="tp" data-pay-url="<?php echo U('Pay/payAlipay');?>">
                            <img src="/Public/Mobile/images/zfbTp.png">
                        </a>
                        <i class="ico"></i>
                    </li>
                    <li>
                        <a href="javascript:;" class="tp" data-pay-url="<?php echo U('Pay/payWeixin');?>">
                            <img src="/Public/Mobile/images/wxTp.png">
                        </a>
                        <i class="ico"></i>
                    </li>
                </ul>
            </div>
            <div class="myBtn">
                <input type="hidden" name="trade_no" value="<?php echo ($trade_no); ?>">
                <input type="hidden" name="money" value="<?php echo ($money); ?>">
                <button type="submit">立即充值</button>
            </div>
        </form>
        <div class="txtExp">
            <h6 class="tit">付款遇到问题：</h6>
            <p>* 付款完成后请等待页面跳转，系统将自动为您充值学习币</p>
            <p>* 微信充值方式只适用于微信客户端，支付宝充值方式可适用于网页浏览器</p>
            <p>* 如您无法使用在线支付，可联系客服选择汇款方式  <a href="javascript:;" class="goLink">联系客服&gt;&gt;</a></p>
            <p>* 最终解释权归嗨推学院所有。</p>
        </div>
    </div>
</section>

<!--footNav-->
<footer class="footNav">
    <div class="in">
        <ul class="nav">
            <li <?php echo ACTION_NAME=='index'?'class="cur"':'';?> >
                <a href="<?php echo U('Index/index');?>" class="item">
                    <img src="/Public/Mobile/images/nav01.png" rel="/Public/Mobile/images/nav01-hover.png" alt="">
                    <span class="ti">首页</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='videoList'?'class="cur"':'';?>>
                <a href="<?php echo U('Index/videoList');?>" class="item">
                    <img src="/Public/Mobile/images/nav02.png" rel="/Public/Mobile/images/nav02-hover.png" alt="">
                    <span class="ti">视频</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='allQuestion'?'class="cur"':'';?> <?php echo ACTION_NAME=='myQuestion'?'class="cur"':'';?>>
                <a href="<?php echo U('Study/allQuestion');?>" class="item">
                    <img <?php echo ACTION_NAME=='allQuestion'?'src="/Public/Mobile/images/nav03-hover.png"':'src="/Public/Mobile/images/nav03.png';?>" rel="/Public/Mobile/images/nav03-hover.png" alt="">
                    <span class="ti">问答</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='my'?'class="cur"':'';?>>
                <a href="<?php echo U('User/my');?>" class="item">
                    <img src="/Public/Mobile/images/nav04.png" rel="/Public/Mobile/images/nav04-hover.png" alt="">
                    <span class="ti">我的</span>
                </a>
            </li>
        </ul>
    </div>
</footer>
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