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
    <link rel="stylesheet" href="/Public/Mobile/css/style.css">
</head>
<body style="background-color: #fff;">

<!--theMenu-->
<section class="theMenu">
    <div class="tabMenu">
        <div class="tabMenu_left">
            <div class="tabMenu_list">
                <ul>
                    <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                    <li <?php echo ACTION_NAME=='courseList'?'class="cur"':'';?> ><a href="<?php echo U('Content/courseList');?>">课程简介</a></li>
                    <li <?php echo ACTION_NAME=='videoList'?'class="cur"':'';?> ><a href="<?php echo U('Index/videoList');?>">课程视频</a></li>
                    <li <?php echo ACTION_NAME=='contactUs'?'class="cur"':'';?> ><a href="<?php echo U('Content/contactUs');?>">联系我们</a></li>
                    <li <?php echo ACTION_NAME=='webNoticeList'?'class="cur"':'';?> ><a href="<?php echo U('Content/webNoticeList');?>">平台公告</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--notice-->
<section class="myContactUs notice">
    <div class="in">

        <div class="ban">
    <a href="javascript:;" class="tp">
        <img src="/Public/Mobile/images/banTp.jpg" alt="">
    </a>
</div>

        <div class="tab">
            <ol>
                <li class="li01 cur"><a href="<?php echo U('Content/webNoticeList');?>">平台公告</a></li>
                <li class="li02"><a href="<?php echo U('Content/goodShareList');?>">干货分享</a></li>
                <li class="li03"><a href="<?php echo U('Content/problemList');?>">常见问题</a></li>
            </ol>
        </div>
        <div class="moduleCom moduleComs">
            <div class="module">
                <ul>
                    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                            <a href="<?php echo U('Content/webNotice',array('main'=>$v['id']));?>">
                                <div class="tp">
                                    <img src="/Public/Mobile/images/notMesIco.png" alt="">
                                </div>
                                <div class="txt">
                                    <p class="tName"><?php echo ($v['title']); ?></p>
                                    <p class="tWz"><?php echo jiequ(filtrationSrt(strip_tags(htmlspecialchars_decode($v['content']))),0,40,'...');?></p>
                                    <span class="date"><?php echo date('Y-m-d',$v['addtime']);?></span>
                                </div>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="module">

            </div>
            <div class="module">
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

<script src="/Public/Mobile/js/menuSilder.js"></script>
<script src="/Public/Mobile/js/theMenu.js"></script>