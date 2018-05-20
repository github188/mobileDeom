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

<!--myEnterCourses-->
<section class="myEnterCourses">
    <div class="in">
        <div class="withRate">
            <div class="tp">
                <img src="/Public/Mobile/images/rate01.png">
            </div>
            <div class="txt">
                <div class="tx01 cur">
                    <span>选择课程</span>
                </div>
                <div class="tx02">
                    <span>确认课程</span>
                </div>
                <div class="tx03">
                    <span>报名成功</span>
                </div>
            </div>
        </div>
        <div class="courSel">
            <div class="selList">
                <ul>
                    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li group-id="<?php echo ($v['id']); ?>">
                            <i class="radIco"></i>
                            <span class="tl"><?php echo ($v['name']); ?></span>
                            <span class="tr"><em class="num"><?php echo ($v['buy_money']); ?></em>学习币</span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="link">
            <a href="<?php echo U('Content/courseList');?>">课程介绍请点这里</a>
        </div>
        <div class="myBtn">
            <a href="javascript:;" class="submit-btn">下一步</a>
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
    var url = "<?php echo U('Pay/courseChoose');?>";
    //点击下一步跳转
    $('.submit-btn').on('click',function(){
        var group_id = $('ul').children('.cur').attr('group-id');
        if(!group_id) {
            layer.open({content: '请选择要购买的课程！' ,skin: 'msg',time: 2 });
            return false;
        }
        $.post(url,{'group_id':group_id},function(data){
            if(data.status==0){
                return false;
            }else if(data.status==1){
                location.href = data.url;
            }
        },'json');
    });
</script>