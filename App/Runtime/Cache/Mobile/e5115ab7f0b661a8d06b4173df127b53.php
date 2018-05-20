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

<!--myWxBind-->
<section class="myWxBind">
    <div class="in">
        <?php if($userinfo['weixin_openid'] || $userinfo['weixin_unionid']): ?><!--已绑定：-->
            <div class="wxBindYes">
                <div class="tp">
                    <img src="<?php echo ($userinfo['logo']); ?>" alt="">
                </div>
                <div class="txt">
                    <h3 class="name"><?php echo htmlspecialchars_decode($userinfo['weixin_username']);?></h3>
                    <div class="tx">
                        <p>恭喜您已成功绑定微信！</p>
                        <a href="javascript:;" class="unbind">解除绑定</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
            <!--未绑定：-->
            <div class="wxBindNo">
                <div class="tp" style="position: relative;">
                    <img style="position: absolute;left: 50%;top:50%;margin: -25px 0 0 -25px;width: 60px;height: 50px;" src="/Public/Member/images/weixin-icon.png" alt="二维码" >
                    <img src="<?php echo U('Safe/weixinErweima');?>" alt="二维码" width="250px" height="250px">
                    <!--<a style="width:200px;height:200px;display:block;background: url('<?php echo U('Member/Weixin/weixinErweima');?>') no-repeat 0 0;background-size: 100% 100%;"></a>-->
                    <script>
                        //检查微信绑定情况
                        window.onload = function(){
                            var Interval = window.setInterval(function(){checkedWeixin();},1000);
                            function checkedWeixin(){
                                $.post(url,{'bind':1},function(data){
                                    if(data.status==1){
                                        clearInterval(Interval);
                                        layer.open({content: data.info,skin: 'msg',time: 2});
                                        setTimeout(function(){
                                            window.location.reload();
                                        },2000);
                                    }
                                },'json');
                            }
                        }
                    </script>
                </div>
                <h4 class="tit">扫一扫绑定微信吧！</h4>
            </div><?php endif; ?>
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
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>
<script>
    var url = "<?php echo U('Safe/weixin');?>";
    //解除绑定微信
    $('.unbind').on('click',function(){
        //询问框
        var index = layer.open({
            className: 'popuo-confirm', //这样你就可以在css里面控制该弹层的风格了
            content: '确定要解除微信绑定吗？解除后将无法观看视频!'
            ,btn: ['取消', '确定']
            ,no: function(index){
                $.post(url,{'bind':2},function(data){
                    layer.open({content: data.info,skin: 'msg',time: 2});
                    if(data.status==1){
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                },'json');
                layer.close(index);
            }
        });

    });
</script>