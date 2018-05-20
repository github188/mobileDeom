<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="//at.alicdn.com/t/font_pa4jl08eia6mvx6r.css">
    <link rel="stylesheet" href="/Public/Mobile/css/base.css">
    <link rel="stylesheet" href="/Public/Mobile/css/common.css">
    <link rel="stylesheet" href="/Public/Mobile/css/main.css">
    <link rel="stylesheet" href="/Public/Mobile/css/style.css">
</head>
<body class="bgcC">

<!--theMenu-->
<section class="theMenu">
    <div class="tabMenu">
        <div class="tabMenu_left">
            <div class="tabMenu_list">
                <ul>
                    <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                    <li <?php echo ACTION_NAME=='goodShareList'?'class="cur"':'';?> ><a href="<?php echo U('Content/goodShareList');?>">干货列表</a></li>
                    <li <?php echo ACTION_NAME=='courseList'?'class="cur"':'';?> ><a href="<?php echo U('Content/courseList');?>">课程简介</a></li>
                    <li><a href="javascript:;">团队风采</a></li>
                    <li><a href="javascript:;">最新视频</a></li>
                    <li><a href="javascript:;">每日更新</a></li>
                    <li <?php echo ACTION_NAME=='contactUs'?'class="cur"':'';?> ><a href="<?php echo U('Content/contactUs');?>">联系我们</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--背景图-->
<setion class="img">
    <img src="/Public/Mobile/images/banTp.jpg" alt="">
</setion>

<!--主要内容-->
<setion class="mianCont">
     <div class="contHear">
        <ul class="clearfix">
            <?php if(is_array($pidCategory)): $k = 0; $__LIST__ = $pidCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li <?php echo ($pid==$v['id']?'class="cur"':''); ?> onclick="location.href = '<?php echo U('Video/videoCategory',array('pid'=>$v['id']));?>';"><?php echo ($v['name']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
     </div>

    <!--试听课程-->
    <div class="swipe show">
        <ul>
            <?php if(is_array($videoCategory)): $k = 0; $__LIST__ = $videoCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                    <a  href="<?php echo U('Video/play',array('category_id'=>$v['id']));?>">
                        <div class="Himg"> <i class="iconfont <?php echo ($v['allow_play']==1?'icon-cur-eye':'icon-cur-lock'); ?>"></i> </div>
                        <div class="study fr">
                            <p class="pp"><?php echo ($v['name']); ?></p>
                            <div class="progess">
                                <div class="maxPro">
                                    <p class="curPro" style="width: <?php echo ($v['progress']); ?>%;"></p>
                                </div>
                                <span class="proNum"><?php echo ($v['progress']); ?>%</span>
                            </div>
                        </div>
                        <div class="hArrow"><span class="arows"></span><span class="arows"></span></div>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</setion>

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