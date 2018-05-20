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

<!--myAddEdit-->
<section class="myAddEdit">
    <div class="in">
        <div class="addInpCom">
            <form action="<?php echo U('User/myAddress');?>" method="post" name="" id="">
                <div class="inp">
                    <span class="ti">收货人<em>*</em></span>
                    <input type="text" value="<?php echo ($info['name']); ?>" name="name" placeholder="收货人姓名">
                </div>
                <div class="inp">
                    <span class="ti">所在区域<em>*</em></span>
                    <div class="addSel">
                        <select class="select" name="province">
                            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;请选择省份</option>
                            <?php if(is_array($province)): $k = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><option value="<?php echo ($v['id']); ?>" <?php echo ($info['province']==$v['id']?'selected':''); ?> >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($v['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <select class="select" name="city">
                            <option value="<?php echo ($info['city']?$info['city']:0); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($info['city']?$info['city_']:'请选择城市'); ?></option>
                        </select>
                        <select class="select" name="county">
                            <option value="<?php echo ($info['county']?$info['county']:0); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($info['county']?$info['county_']:'请选择地区'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="inp">
                    <span class="ti">详细地址<em>*</em></span>
                    <input type="text" name="address" value="<?php echo ($info['address']?htmlspecialchars_decode($info['address']):''); ?>" placeholder="建议您填写详细地址，例如街道，门牌等信息">
                </div>
                <div class="inp">
                    <span class="ti">手机号码<em>*</em></span>
                    <input type="text" name="mobile" value="<?php echo ($info['mobile']?$info['mobile']:''); ?>" placeholder="必须填写手机号码">
                </div>
                <div class="inp">
                    <span class="ti">邮政编码</span>
                    <input type="text" name="postalcode" value="<?php echo ($info['postalcode']?$info['postalcode']:''); ?>" placeholder="如您不清楚邮递区号，请填写000000">
                </div>
                <div class="han">
                    <input type="checkbox" value="1" name="is_default" <?php echo ($info['is_default']==1?'checked':''); ?> class="setDefChe js-che">
                    <span class="ti">设为默认地址</span>
                </div>
                <input type="hidden" name="edit" value="<?php echo ($id); ?>">
            </form>
        </div>
        <div class="myBtn">
            <a href="javascript:;">保存修改</a>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>

<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>
<!--收货地址js文件-->
<script src="/Public/Member/js/myAddress.js"></script>
<script>
    var selectAddressUrl= "<?php echo U('User/getSelectAddress');?>";
    var successUrl      = "<?php echo U('User/myAddressList');?>";

    //提交表单-添加收货地址
    $('.myBtn').on('click', function(){
        if(select_province.val()==0)
        {
            //提示
            layer.open({
                content: '请选择所在省的所在地!'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return;
        }
        else if(select_city.val()==0)
        {
            //提示
            layer.open({
                content: '请选择所在城市的所在地!'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return;
        }
        $.ajax({
            url: $('form').attr('action'),
            type: 'POST',
            data: $('form').serialize(),
            success: function(data){
                //提示
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                if(data.status==0){
                    return false;
                }
                else if(data.status==1){
                    setTimeout(function(){
                        location.href = data.url;
                    },1500);
                }
            },
            error:function(data){
                alert('网络繁忙请稍后重试!');
            }
        });
    });

</script>
</body>
</html>