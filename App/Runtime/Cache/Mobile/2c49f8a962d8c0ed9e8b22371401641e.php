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

<!--myBankEdit-->
<section class="myAddEdit myBankEdit">
    <div class="in">
        <div class="addInpCom">
            <form action="<?php echo U('Safe/myBank');?>" method="post" name="" id="">
                <div class="inp">
                    <span class="ti">账户类型<em>*</em></span>
                    <div class="cardSel">
                        <select name="bankType" class="bankType">
                            <option value="0">请选择账户类型</option>
                            <?php $allBankCard = getBankType(); ?>
                            <?php if(is_array($allBankCard)): $k = 0; $__LIST__ = array_slice($allBankCard,0,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>" >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($v); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="inp">
                    <span class="ti">本人姓名<em>*</em></span>
                    <input type="text" placeholder="请填写您的姓名" name="name">
                </div>
                <div class="inp">
                    <span class="ti">账户号码<em>*</em></span>
                    <input type="text" class="number"  placeholder="请填写对应账户号码" name="number">
                </div>
                <div class="inp bank_address">
                    <span class="ti">开户地址<em>*</em></span>
                    <div class="addSel">
                        <select name="province">
                            <option value="0">请选择省份</option>
                            <?php if(is_array($province)): $k = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><option value="<?php echo ($v['id']); ?>" <?php echo ($info['province']==$v['id']?'selected':''); ?> ><?php echo ($v['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <select name="city">
                            <option value="<?php echo ($info['city']?$info['city']:0); ?>"><?php echo ($info['city']?$info['city_']:'请选择城市'); ?></option>
                        </select>
                        <select name="county">
                            <option value="<?php echo ($info['county']?$info['county']:0); ?>"><?php echo ($info['county']?$info['county_']:'请选择地区'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="inp bank_address">
                    <span class="ti">开户支行</span>
                    <input type="text" name="address" placeholder="例：中国工商银行广州支行">
                </div>
                <div class="inp yzmInp">
                    <span class="ti">验证码<em>*</em></span>
                    <input type="text" name="code" placeholder="请填写短信验证码">
                    <button type="button" class="getCode">获取验证码</button>
                </div>
                <input type="hidden" name="mobile" value="<?php echo getUserInfo(session(C('USER_AUTH_UID')),'mobile');?>">
                <!--<p class="showTip">已经发送验证码到您的<span>123334566799</span></p>-->
            </form>
        </div>
        <div class="myBtn">
            <a href="javascript:;" class="submit-btn">保存</a>
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
<!--收货地址js文件-->
<script src="/Public/Member/js/myAddress.js"></script>
<script>
    var formActionUrl   = "<?php echo U('Safe/myBank');?>";
    var selectAddressUrl= "<?php echo U('User/getSelectAddress');?>";//select框获取地址
    var getCodeUrl      = "<?php echo U('Index/publicSendCode');?>";

    $('.bankType').on('change',function(){
        $this_ = $(this);
        if($this_.val()==16){
            $('.bank_address').hide();
        }else{
            $('.bank_address').show();
        }
    });

    //发送验证码
    $('.getCode').on('click',function(){
        var this_ = $(this);
        var num = $.trim($('input[name="mobile"]').val());
        $.ajax({
            url: getCodeUrl,
            type: 'POST',
            data: {'num':num},
            success: function(data){
                layer.open({content: data.msg,skin: 'msg',time: 2});
                if(data.status==0){
                    return false;
                }
                countTime(this_,60);
            },
            error:function(data){
                alert('网络繁忙请稍后重试!');
            }
        });
    });

    //提交表单-添加银行卡
    $('.submit-btn').on('click', function(){
        var bankType = $('.bankType').val();
        if(bankType==0){
            layer.open({content: '请选择账户类型!',skin: 'msg',time: 2});
            return;
        }
        if(bankType!=16 && isBankCard($('.number').val())==false)
        {
            layer.open({content: '请填写正确的银行卡号!',skin: 'msg',time: 2});
            return;
        }
        if(bankType!=16 && select_province.val()==0)
        {
            layer.open({content: '请选择银行卡开户省份的所在地!',skin: 'msg',time: 2});
            return;
        }
        else if(bankType!=16 && select_city.val()==0)
        {
            layer.open({content: '请选择银行卡开户城市的所在地!',skin: 'msg',time: 2});
            return;
        }
        $.ajax({
            url: $('form').attr('action'),
            type: 'POST',
            data: $('form').serialize(),
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
            },
            error:function(data){
                alert('网络繁忙请稍后重试');
            }
        });
    });
    //js正则匹配是否是银行卡
    function isBankCard(str) {
        var value = str.replace(/\s/g, ''),
                isValid = true,
                rFormat = /^[\d]{12,19}$/;

        if ( !rFormat.test(value) ) {
            isValid = false;
        } else {
            var arr = value.split('').reverse(),
                    i = arr.length,
                    temp,
                    sum = 0;

            while ( i-- ) {
                if ( i%2 === 0 ) {
                    sum += +arr[i];
                } else {
                    temp = +arr[i] * 2;
                    sum += temp % 10;
                    if ( temp > 9 ) sum += 1;
                }
            }
            if ( sum % 10 !== 0 ) {
                isValid = false;
            }
        }
        return isValid;
    }

</script>