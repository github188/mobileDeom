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

<!--myBank-->
<section class="myBank">
    <div class="in">
        <div class="addHd">
            <span class="ti01">姓名</span>
            <span class="ti02">银行卡类型</span>
            <span class="ti03">银行卡号</span>
            <span class="ti04">操作</span>
        </div>
        <div class="list">
            <ul>
                <?php if($data): if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                            <span class="ti01"><?php echo ($v['name']); ?></span>
                            <span class="ti02"><?php echo ($v['bank_type']); ?></span>
                            <span class="ti03"><?php echo substr($v['number'],-4);?></span>
                            <div class="ti04 han">
                                <a href="javascript:;" class="del del-btn" delete-id="<?php echo ($v['id']); ?>">删除</a>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                    <p style="text-align: center;line-height: 50px;"><em>还没有添加银行卡哦~</em></p><?php endif; ?>
            </ul>
            <?php if($countPage > 1): ?><div class="pages"><?php echo ($pages); ?></div><?php endif; ?>
        </div>
        <div class="myBtn">
            <a href="<?php echo U('Safe/myBank');?>">添加银行卡</a>
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
    var formActionUrl = "<?php echo U('Safe/myBankList');?>";
    //删除收货地址
    $('.del-btn').on('click',function(){
        var delID = $(this).attr('delete-id');
        //询问框
        var index = layer.open({
            className: 'popuo-confirm', //这样你就可以在css里面控制该弹层的风格了
            content: '确定要删除该银行卡吗？'
            ,btn: ['取消', '确定']
            ,no: function(index){
                deleteBankCard(delID);
                layer.close(index);
            }
        });
    });
    //执行删除操作
    function deleteBankCard(id){
        $.post(formActionUrl,{'delID':id},function(data){
            layer.open({content: data.msg,skin: 'msg',time: 2});
            if(data.status==0){
                return false;
            }
            else if(data.status==1){
                setTimeout(function(){
                    location.reload();
                },1200);
            }
        },'json');
    }
</script>