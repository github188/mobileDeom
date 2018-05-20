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
                <img src="/Public/Mobile/images/rate01.png">
            </div>
            <div class="txt">
                <div class="tx01 cur">
                    <span>充值学习币</span>
                </div>
                <div class="tx02">
                    <span>支付方式</span>
                </div>
                <div class="tx03">
                    <span>支付成功</span>
                </div>
            </div>
        </div>
        <form action="<?php echo U('Pay/payWay');?>" method="post" class="myForm">
            <div class="money">
                <div class="mm">
                    <span class="ti">当前账户</span>
                    <i class="ico"></i>
                    <em> <?php echo (floatval($user_arr["currency"])); ?> </em>
                    <span>学习币</span>
                </div>
                <div class="bb">
                    <span class="ti">充值金额</span>
                    <input type="text"  name="money" value="<?php echo ($money); ?>" id="recMoney"><em>元</em>
                </div>
            </div>
            <div class="paySel">
                <div class="payTip">
                    <p>快捷选择：<span>（比例：充值1元，可兑换1个学习币）</span></p>
                </div>
                <div class="selList">
                    <ul>
                        <li data-num=1000 >
                            <i class="radIco"></i>
                            <span class="tl">1000学币</span>
                            <span class="tr">￥1000元</span>
                        </li>
                        <li data-num=2000 >
                            <i class="radIco"></i>
                            <span class="tl">2000学币</span>
                            <span class="tr">￥2000元</span>
                        </li>
                        <li data-num=3000 >
                            <i class="radIco"></i>
                            <span class="tl">3000学币</span>
                            <span class="tr">￥3000元</span>
                        </li>
                        <li data-num=4000 >
                            <i class="radIco"></i>
                            <span class="tl">4000学币</span>
                            <span class="tr">￥4000元</span>
                        </li>
                        <li data-num=5000 >
                            <i class="radIco"></i>
                            <span class="tl">5000学币</span>
                            <span class="tr">￥5000元</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="myBtn">
                <button type="submit">下一步</button>
            </div>
        </form>
        <div class="txtExp">
            <h6 class="tit">说明</h6>
            <p>1、 充值学习币可在嗨推学院的PC端，WAP端，APP中购买所有课程。</p>
            <p>2、 充值学习币没有使用期限，会一直保存在您的账户内，可以随时使用。</p>
            <p>3、 充值学习币后不能退回，不能兑现，不能转让给他人，请谅解。</p>
            <p>4、 您充值的学习币仅可以在嗨推学院的PC端，WAP端，App内消费，不可以在其他平台消费。</p>
            <p>5、 最终解释权归嗨推学院所有。</p>
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
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>