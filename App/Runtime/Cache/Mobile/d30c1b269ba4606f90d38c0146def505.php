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
<body>

<!--myAddress-->
<section class="myAddress">
    <div class="in">
        <div class="addressList">
            <ul>
                <?php if($data): if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                        <div class="hd">
                            <i class="radIco js-radIco <?php echo ($v['is_default']==1?'hover':''); ?>"></i>
                            <div class="th">
                                <span class="tName fl"><?php echo ($v['name']); ?></span>
                                <span class="tPhone fr"><?php echo ($v['mobile']); ?></span>
                            </div>
                            <div class="dz">
                                <p><?php echo ($v['province']); echo ($v['city']); echo ($v['county']); echo htmlspecialchars_decode($v['address']);?></p>
                            </div>
                        </div>
                        <div class="han">
                            <div class="setDef fl">
                                <?php if($v['is_default'] == 1): ?><i class="setDefChe hover js-defIco"></i>
                                <?php else: ?>
                                    <i type="checkbox" class="setDefChe js-defIco"></i><?php endif; ?>

                                <span class="ti">设为默认地址</span>
                            </div>
                            <div class="btnCom fr">
                                <a href="<?php echo U('User/myAddress',array('edit'=>$v['id']));?>" class="btn ediBtn">
                                    <i class="ico"></i><span>编辑</span>
                                </a>
                                <a href="javascript:;" class="btn delBtn" delete-id="<?php echo ($v['id']); ?>">
                                    <i class="ico"></i><span>删除</span>
                                </a>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

                <?php else: ?>
                    <p style="text-align: center;line-height: 50px;"><em>还没有添加收货地址哦~</em></p><?php endif; ?>
            </ul>
        </div>
        <div class="myBtns">
            <a href="<?php echo U('User/myAddress');?>">新增地址</a>
        </div>
    </div>
</section>

<script src="/Public/Mobile/js/jquery-1.11.3.min.js"></script>
<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>
<script src="/Public/Mobile/js/style.js"></script>
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>
<script>
    var formActionUrl = "<?php echo U('User/myAddressList');?>";//删除收货地址
    //删除收货地址
    $('.delBtn').on('click',function(){
        var delID = $(this).attr('delete-id');
        //询问框
        var index = layer.open({
            className: 'popuo-confirm', //这样你就可以在css里面控制该弹层的风格了
            content: '确定要删除该收货地址吗？'
            ,btn: ['取消', '确定']
            ,no: function(index){
                deleteAddress(delID);
                layer.close(index);
            }
        });
    });
    //执行删除操作
    function deleteAddress(id){
        $.post(formActionUrl,{'delID':id},function(data){
            //弹出--提示信息
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
                    location.reload();
                },1500);
            }
        },'json');
    }
</script>
</body>
</html>