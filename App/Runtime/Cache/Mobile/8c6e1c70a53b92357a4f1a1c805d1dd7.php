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
<body>

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

<!--myContactUs-->
<section class="myContactUs">
    <div class="in">

        <div class="ban">
    <a href="javascript:;" class="tp">
        <img src="/Public/Mobile/images/banTp.jpg" alt="">
    </a>
</div>

        <div class="tab">
            <ol>
                <li class="li01"><a href="javascript:;">公司简介</a></li>
                <li class="li02"><a href="javascript:;">关于我们</a></li>
                <li class="li03 cur"><a href="javascript:;">联系我们</a></li>
            </ol>
        </div>
        <div class="moduleCom">
            <div class="module">
                <!--关于我们-->
                <div class="txtPage">
                    <?php echo htmlspecialchars_decode($about['content']);?>
                </div>
            </div>
            <div class="module">
                <div class="txtPage">
                    <p>我们，是一群执着于互联网的人、一群怀着极客精神的人。</p>
                    <p>我们，是一个年轻的团队，创造、进步、服务创业者是我们一直坚守的信念。</p>
                    <p>我们，拥有数 万产品推广用户，是最贴近他们的人，我们也是推广者。</p>
                    <p>我们，“企图”成为一颗启明星，为推广者的成长指明方向。</p>
                </div>
            </div>
            <div class="module">
                <div class="item itemMap">
                    <div class="hdTit">
                        <p class="line"></p>
                        <h3 class="tit">我的位置</h3>
                    </div>
                    <!--map-->
                    <div class="addMap">
                        <div class="addName">广州杰顺网络科技有限公司</div>
                        <iframe src="//uri.amap.com/marker?position=113.265316,23.172428&name=广州杰顺网络科技有限公司&src=mypage&coordinate=gaode&callnative=0"
                                name="myMap" id="myMap" frameBorder="0"></iframe>
                    </div>
                </div>
                <div class="item itemAdd">
                    <div class="hdTit">
                        <p class="line"></p>
                        <h3 class="tit">联系我们</h3>
                    </div>
                    <ol class="dzDet">
                        <li>
                            <p>联系我们</p>
                            <p>公司电话：<span>020-36700550</span></p>
                        </li>
                        <li>
                            <p>投诉邮箱</p>
                            <p>邮箱地址：<span>tousu@hitui.com</span></p>
                        </li>
                        <li>
                            <p>公司地址</p>
                            <p>广州白云区云城南二路万达广场C区2栋603室</p>
                        </li>
                    </ol>
                </div>
                <div class="item itemMes">
                    <form action="<?php echo U('Content/contactUs');?>" method="post" id="form_contactUs">
                        <div class="hdTit">
                            <p class="line"></p>
                            <h3 class="tit">留言表</h3>
                        </div>
                        <div class="msnInp">
                            <div class="inp">
                                <span class="ti">姓名</span>
                                <input type="text" name="name" placeholder="">
                            </div>
                            <div class="inp">
                                <span class="ti">电话</span>
                                <input type="text" name="mobile" placeholder="">
                            </div>
                            <div class="inp">
                                <span class="ti">邮箱</span>
                                <input type="text" name="email" placeholder="">
                            </div>
                            <div class="inp mesTxt">
                                <span class="ti">留言内容</span>
                                <textarea placeholder="" name="content"></textarea>
                            </div>
                        </div>
                        <div class="myBtn">
                            <a href="javascript:;" class="submit-btn">提交留言</a>
                        </div>
                    </form>
                </div>
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
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>
<script>
    $('.submit-btn').on('click',function(){
        var submit_contactUs_url = $('#form_contactUs').attr('action');
        var name_ = $('#form_contactUs input[name=name]');
        if (name_.val() == '' || name_.val().length <2) {
            layer.open({content: '请填写您的姓名!',skin: 'msg',time: 2});
            return false;
        }

        var mobile_ = $('#form_contactUs input[name=mobile]');
        if (mobile_.val() == '' || mobile_.val().length !=11) {
            layer.open({content: '请填写您的真实手机号码，方便联系您！',skin: 'msg',time: 2});
            return false;
        }

        var email_ = $('#form_contactUs input[name=email]');
        if (email_.val() == '') {
            layer.open({content: '请填写您的邮箱地址，方便联系您！',skin: 'msg',time: 2});
            return false;
        }

        var content_ = $('#form_contactUs textarea[name=content]');
        if (content_.val() == '' || content_.val().length <10) {
            layer.open({content: '请填写您要反馈的内容，不能小于10个字！',skin: 'msg',time: 2});
            return false;
        }

        $.ajax({
            type      : 'post',
            url       : submit_contactUs_url,
            data      : $('#form_contactUs').serialize(),
            dataType  : 'json',
            success:function (data) {
                layer.open({content: data.info,skin: 'msg',time: 2});
                if(data.status==1){
                    $('#form_contactUs input').val('');
                    $('#form_contactUs textarea').val('');
                    return false;
                }
            },
            error:function(data){
                alert('网络繁忙，请稍后再试！');
            }
        });

    });
</script>