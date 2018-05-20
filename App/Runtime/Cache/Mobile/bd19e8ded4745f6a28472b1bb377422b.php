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
<style>
    /*翻页*/
    .pages{
        display: inline-table;
        height: 50px;
        text-align: center;
        padding-top: 20px;
    }
    .pages a,.pages span{
        display: inline;
        border-radius: 4px;
        margin: 0 3px;
        background-color: #fff;
        border: 1px solid #ddd;
        color: #ff6100;
        float: left;
        line-height: 1.42857;
        padding: 6px 10px;
        position: relative;
        text-decoration: none;
    }
    .pages a:hover{
        background-color: #eee;
        border-color: #ddd;
        color: #111;
        z-index: 2;
    }
    .pages .current{
        background-color: #ff6100;
        border-color: #ff6100;
        color: #fff;
        cursor: default;
        z-index: 3;
    }
    .pages >div{
        line-height: 32px;
        text-align: center;
    }
    .pages .prev_disabled , .pages .next_disabled{
        cursor: no-drop;
    }
</style>
<body style="background-color: #fff">

<!--myInfor-->
<section class="myInfor">
    <div class="in">
        <div class="tab">
            <ol>
                <li <?php echo ($is_read==2?'class="cur"':''); ?>><a href="<?php echo U(myNews,array('read'=>2));?>"><span>全部</span></a></li>
                <li <?php echo ($is_read==0?'class="cur"':''); ?>><a href="<?php echo U(myNews,array('read'=>0));?>"><span>未读</span></a></li>
                <li <?php echo ($is_read==1?'class="cur"':''); ?>><a href="<?php echo U(myNews,array('read'=>1));?>"><span>已读</span></a></li>
            </ol>
        </div>
        <div class="inList">
            <ul>
                <?php if($data): ?><form action="" method="post" name="myForm">
                        <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li class="li">
                                <i class="setChe js-mesChe" delete-id="<?php echo ($v['id']); ?>"></i>
                                <span class="ico">
                                    <img src="/Public/Mobile/images/<?php echo ($v['is_read']==1?'email01':'email02'); ?>.png" alt="">
                                </span>
                                <a href="javascript:;" onclick="show_news(this,<?php echo ($v['id']); ?>);" class="tx"><?php echo strip_tags(htmlspecialchars_decode($v['content']));?></a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </form>
                <?php else: ?>
                    <p style="text-align: center;line-height: 50px;"><em>没有更多消息啦~</em></p><?php endif; ?>
            </ul>
        </div>
        <?php if($data): ?><div class="han">
                <i class="setChe js-allMesChe"></i>
                <span class="ti">全选</span>
                <button type="button" class="del jsDelBtn">删除</button>
            </div><?php endif; ?>
        <?php if($totalPages > 1): ?><div class="pages"><?php echo ($pages); ?></div><?php endif; ?>
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
    var formActionUrl = "<?php echo U('User/myNews');?>";
    //显示消息内容
    function show_news(obj,id){
        $.post(formActionUrl,{'msg_id':id},function(data){
            if(data.status==1){
                layer.open({
                    style: 'border:none; background-color:#88a5b4; color:#fff;',
                    content:$(obj).html(),
                });
            }
        },'json');
    }
    //===========用户删除消息====================
    $('.jsDelBtn').on('click',function(){
        //拼接 要删除的消息ID
        var i = $('ul').find('.js-mesChe'),
            delID=''   ;
        for(var n=0;n< i.length;n++){
            if(i.eq(n).is('.hover')){
                delID += ','+i.eq(n).attr('delete-id');
            }
            //console.log(i.eq(n));
        }
        if(!delID){
            layer.open({content: '请选择要删除的消息！',skin: 'msg',time: 2});
            return false;
        }
        //询问框
        var index = layer.open({
            className: 'popuo-confirm', //这样你就可以在css里面控制该弹层的风格了
            content: '确定要删除选中的消息吗？'
            ,btn: ['取消', '确定']
            ,no: function(index){
                deleteNews(delID);
                layer.close(index);
            }
        });
    });
    //执行删除操作
    function deleteNews(delID){
        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: {'delID':delID},
            success: function(data){
                layer.open({content: data.msg,skin: 'msg',time: 2});
                if(data.status==0){
                    return false;
                }
                else if(data.status==1){
                    setTimeout(function(){
                        location.reload();
                    },1200);
                }
            },
            error: function(data){
                alert('网络繁忙,请稍后重试!');
            }
        });
    }
    //===========用户删除消息====================
</script>