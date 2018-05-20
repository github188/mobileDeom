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
    <link rel="stylesheet" href="/Public/Mobile/css/common.css">
    <link rel="stylesheet" href="/Public/Mobile/css/style.css">
</head>
<body style="background-color: #fff;">

<!--myWithdraw-->
<section class="myWithdraw">
    <div class="in">
        <div class="draw">
            <div class="hd">
                <span class="ti">可提现佣金</span>
                <span><em class="money"><?php echo ($user_account['brokerage']); ?></em>元</span>
            </div>
            <div class="drawInpCom">
                <form action="<?php echo U('User/myTiXian');?>" method="post" >
                    <div class="inp">
                        <span class="ti">选择银行卡</span>
                        <!--已绑定:-->
                        <select class="select selBank" name="bank_card">
                            <?php if(is_array($user_bank)): $k = 0; $__LIST__ = $user_bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><option value="<?php echo ($v['id']); ?>">&nbsp;&nbsp;<?php echo getBankType($v['type']);?>&nbsp;&nbsp;(<?php echo substr($v['number'],-4,4);?>)</option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <!--未绑定:-->
                        <a href="<?php echo U('Safe/myBankList');?>" class="bindCard">绑定银行卡</a>
                    </div>
                    <div class="inp">
                        <span class="ti">提现金额</span>
                        <input type="text" class="input-money" name="money" placeholder="请输入提现金额">
                    </div>
                    <div class="inp">
                        <span class="ti">登录密码</span>
                        <input type="password" class="input-password" name="password" placeholder="请输入登录密码">
                    </div>
                </form>
            </div>
            <div class="myBtn">
                <a href="javascript:;" class="submit-btn">确定提现</a>
            </div>
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
    //提现提交审核
    $('.submit-btn').on('click',function(){
        if(!$.trim($('.input-money').val()))  {
            layer.open({content: '请输入提现金额！',skin: 'msg',time: 2});
            return false;
        }
        if(!$.trim($('.input-password').val()))  {
            layer.open({content: '请输入密码！',skin: 'msg',time: 2});
            return false;
        }
        $.post($('form').attr('action'), $('form').serialize(),function(data){
            layer.open({content: data.info,skin: 'msg',time: 2});
            if(data.status==0){
                $('input[name="password"]').val('');
            }
            else if(data.status==1){
                if(data.url != ''){
                    setTimeout(function(){location.href = data.url;},1500);
                }
            }
        },'json');
    });
    //输入框--只允许输入金额
    $(".input-money").keyup(function () {
             var reg = $(this).val().match(/\d+\.?\d{0,2}/);
             var txt = '';
             if (reg != null) {
                     txt = reg[0];
                 }
             $(this).val(txt);
         }).change(function () {
             $(this).keypress();
             var v = $(this).val();
             if (/\.$/.test(v))
                 {
                     $(this).val(v.substr(0, v.length - 1));
                 }
         });
</script>