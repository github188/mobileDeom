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

<!--myPortrait-->
<section class="myPortrait">
    <div class="in">
       <div class="faceList">
           <ul>
               <?php $__FOR_START_24054__=1;$__FOR_END_24054__=40;for($i=$__FOR_START_24054__;$i <= $__FOR_END_24054__;$i+=1){ ?><li <?php echo session(C('USER_FACE'))==$i?'class="cur"':'';?> >
                   <a href="javascript:;" class="tp">
                       <img src="/Public/Member/images/logo/<?php echo ($i); ?>.png" alt="个人头像" face="<?php echo ($i); ?>" >
                   </a>
                   </li><?php } ?>

           </ul>
       </div>
        <div class="myBtn">
            <a href="javascript:;" class="submit-btn">保存修改</a>
        </div>
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
    var formActionUrl = "<?php echo U('User/myLogo');?>";
    //用户修改头像
    $('.submit-btn').on('click', function(){
        var face = $('li[class="cur"]').find('img').attr('face');
        if(!face){
            layer.open({content: '请选择要修改的头像',skin: 'msg',time: 2});
            return false;
        }
        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: {'face':face},
            success: function(data){
                layer.open({content: data.msg,skin: 'msg',time: 2});
                if(data.status==0){
                    return false;
                }
                else if(data.status==1){
                    setTimeout(function(){
                        location.href = data.url;
                    },1200);
                }
            }
        });
    });


</script>