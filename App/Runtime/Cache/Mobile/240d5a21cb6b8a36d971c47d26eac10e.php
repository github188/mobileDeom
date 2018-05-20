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

<!--theSearch-->
<section class="theSearch">
    <div class="in">
        <div class="inp">
            <form id="key_word_form" action="<?php echo U('Index/videoList');?>">
                <input type="text" name="key_word" value="<?php echo cookie('key_word');?>" placeholder="请输入关键字或视频名称搜索">
                <a href="javascript:;"  onclick="$('#key_word_form').submit();" class="btn"></a>
            </form>
        </div>
    </div>
</section>
<style>
    /*让a的宽高撑满li，点击li时才能触发到a*/
    .js-ul li a{
        display: block;
    }
</style>
<!--courses-->
<section class="courses">
    <div class="in">
        <div class="findSel">
            <div class="tabHd">
                <ol>
                    <li class="js-li">
                        <a href="javascript:;">
                            <span class="ti">付款方式</span><i class="ico"></i>
                        </a>
                    </li>
                    <li class="js-li">
                        <a href="javascript:;">
                            <span class="ti">推广方式</span><i class="ico"></i>
                        </a>
                    </li>
                    <li class="js-li">
                        <a href="javascript:;">
                            <span class="ti">课程分类</span><i class="ico"></i>
                        </a>
                    </li>
                </ol>
            </div>
            <div class="listBd">
                <div class="wrap"></div>

                <!--付款方式-->
                <ul class="js-ul">
                    <li class="<?php echo ($type==0?'cur':''); ?>">
                        <a href="<?php echo U('Index/videoList',array('type'=>0, 'search_tg_category'=>$search_tg_category, 'category_id'=>$category_id));?>">全部</a>
                    </li>
                    <li class="<?php echo ($type==1?'cur':''); ?>">
                        <a href="<?php echo U('Index/videoList',array('type'=>1, 'search_tg_category'=>$search_tg_category, 'category_id'=>$category_id));?>">免费</a>
                    </li>
                    <li class="<?php echo ($type==2?'cur':''); ?>">
                        <a href="<?php echo U('Index/videoList',array('type'=>2, 'search_tg_category'=>$search_tg_category, 'category_id'=>$category_id));?>">付费</a>
                    </li>
                </ul>

                <!--推广方式-->
                <ul class="js-ul">
                    <li class="<?php echo ($search_tg_category==0?'cur':''); ?>">
                        <a href="<?php echo U('Index/videoList',array('type'=>$type, 'search_tg_category'=>0, 'category_id'=>$category_id));?>">全部</a>
                    </li>

                    <?php if(is_array($tg_category)): $k = 0; $__LIST__ = $tg_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li class="<?php echo ($k==$search_tg_category?'cur':''); ?>">
                            <a href="<?php echo U('Index/videoList',array('type'=>$type, 'search_tg_category'=>$k, 'category_id'=>$category_id));?>"><?php echo ($v); ?></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

                <!--课程分类-->
                <ul class="js-ul">
                    <li class="<?php echo ($category_id==0?'cur':''); ?>">
                        <a href="<?php echo U('Index/videoList',array('type'=>$type, 'search_tg_category'=>$search_tg_category, 'category_id'=>0));?>">全部</a>
                    </li>

                    <?php if(is_array($video_category)): $k = 0; $__LIST__ = $video_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li class="<?php echo ($v['id']==$category_id?'cur':''); ?>">
                        <a href="<?php echo U('Index/videoList',array('type'=>$type, 'search_tg_category'=>$search_tg_category, 'category_id'=>$v['id']));?>"><?php echo ($v['name']); ?></a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="courList">
            <ul id="courList-ul">

                <!--视频列表-->
                <?php if(is_array($video)): $k = 0; $__LIST__ = $video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; $playAuth = $user_id ? videoPlayAuth($v['id']) : ''; $is_tag = getVideoTag($v['is_tag']); ?>
                    <li id="<?php echo ($v["id"]); ?>">
                        <div class="item">
                            <div class="tp">
                                <a href="<?php echo ($user_id && $playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                    <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="<?php echo ($v["cover_img"]); ?>" alt="" title="">
                                </a>
                                <i data-id="<?php echo ($v['id']); ?>" class="ico icoLove <?php echo ($user_id && $v['shoucang']?'icoLove-hover':''); ?>"></i>
                                <span <?php if($v['is_tag'] == 1): ?>class="lab labNew"
                                <?php elseif($v['is_tag'] == 2): ?>
                                    class="lab labTj"<?php endif; ?>>

                                </span>
                            </div>
                            <div class="txt">
                                <p class="tiName">
                                    <a href="<?php echo ($user_id && $playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>"><?php echo jiequ($v['title'],0,27,'');?></a>
                                </p>

                                <?php if($user_id): ?><div class="bot">
                                        <div class="money fl <?php echo ($playAuth['allow_play']==1?'moneyNo':''); ?> ">
                                            <em class="num"><?php echo ($v['buy_money']); ?></em>学习币
                                        </div>
                                        <div class="handle fr">
                                            <a href="<?php echo ($user_id && $playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>" ><i class="iconfont icon-bofang"></i>
                                                <i class="ico <?php echo ($playAuth['allow_play']==1?'icoPlay':'icoBuy'); ?>"></i>
                                                <span class="ti00"><?php echo ($playAuth['allow_play']==1?'播放':'购买'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="bot">
                                        <div class="money fl">
                                            <em class="num"><?php echo ($v['buy_money']); ?></em>学习币
                                        </div>
                                        <div class="handle fr">
                                            <a href="<?php echo U('Pay/courseConfirm',array('vid'=>$v['id']));?>">
                                                <i class="ico icoBuy"></i>
                                                <span class="ti00">购买</span>
                                            </a>
                                        </div>
                                    </div><?php endif; ?>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>


            </ul>
            <div id="getMore" style="text-align: center; display: none">
                <img src="/Public/Mobile/images/loadingIco.gif" alt="">
                <a href="javascript:;" style="color: #666;">加载中</a>
            </div>
        </div>

        <!--searchNo-->
        <?php if(!$video): ?><div class="searchNo">
                <div class="in">
                    <div class="tp">
                        <img src="/Public/Mobile/images/serNone.png" alt="">
                    </div>
                    <div class="tx">
                        <p>没有查找到您要的内容哦！</p>
                        <p>请更换关键词重新搜索！</p>
                    </div>
                </div>
            </div><?php endif; ?>


    </div>
</section>

<!--footNav-->


<!--footNav-->
<footer class="footNav">
    <div class="in">
        <ul class="nav">
            <li <?php echo ACTION_NAME=='index'?'class="cur"':'';?> >
                <a href="<?php echo U('Index/index');?>" class="item">
                    <img src="/Public/Mobile/images/nav01.png" rel="/Public/Mobile/images/nav01-hover.png" alt="">
                    <span class="ti">首页</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='videoList'?'class="cur"':'';?>>
                <a href="<?php echo U('Index/videoList');?>" class="item">
                    <img src="/Public/Mobile/images/nav02.png" rel="/Public/Mobile/images/nav02-hover.png" alt="">
                    <span class="ti">视频</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='allQuestion'?'class="cur"':'';?> <?php echo ACTION_NAME=='myQuestion'?'class="cur"':'';?>>
                <a href="<?php echo U('Study/allQuestion');?>" class="item">
                    <img <?php echo ACTION_NAME=='allQuestion'?'src="/Public/Mobile/images/nav03-hover.png"':'src="/Public/Mobile/images/nav03.png';?>" rel="/Public/Mobile/images/nav03-hover.png" alt="">
                    <span class="ti">问答</span>
                </a>
            </li>
            <li <?php echo ACTION_NAME=='my'?'class="cur"':'';?>>
                <a href="<?php echo U('User/my');?>" class="item">
                    <img src="/Public/Mobile/images/nav04.png" rel="/Public/Mobile/images/nav04-hover.png" alt="">
                    <span class="ti">我的</span>
                </a>
            </li>
        </ul>
    </div>
</footer>
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
    var user_id = '<?php echo ($user_id); ?>';
    var formActionUrl = "<?php echo U('Video/videoShoucang');?>";
    //收藏和取消视频
    $('#courList-ul').on('click','.icoLove',function(e){
        var this_ = $(this);
        var vid = this_.attr('data-id');
        var Url = "<?php echo U('Login/index');?>";//登录页
        if(!user_id){
            window.location.href=Url;
            return;
        }
        $.ajax({
            url: formActionUrl,
            type: 'POST',
            data: {'vid':vid},
            success: function(data){
                if(data.status==0){
                    this_.removeClass('icoLove-hover');
                }
                else if(data.status==1){
                    this_.addClass('icoLove-hover');
                }
                layer.open({
                    time: 2,
                    skin: "msg",
                    content:data.info
                });
            },
            error:function(data){
                layer.open({
                    time: 2,
                    skin: "msg",
                    content:'网络繁忙请稍后重试'
                });
            }
        });
    });

    //数据不为空才
    <?php if($video): ?>var _pageSize = 1;
    <?php if($user_id): ?>var _user_id = <?php echo ($user_id); ?>;
    <?php else: ?>
        var _user_id = '';<?php endif; ?>

    var _MOBILE = "/Public/Mobile";
    var _PLAY_URL = "<?php echo U('Video/play', '', false);?>";
    var _PAY_URL  = "<?php echo U('Pay/courseConfirm', '', false);?>";
    url = "<?php echo U(MODULE_NAME.'/index/videoListPage');?>";
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                $('#getMore').show();

                $.ajax({
                    type:"get",
                    url:url,
                    data:{'pageSize':_pageSize},
                    dataType:"json",
                    success:function (json) {

                        if (json.status == 1){

                            var str_html = '';

                            $.each(json.data, function (k, v) {

                                str_html += '<li id="'+v.id+'">';
                                str_html += '<div class="item">';
                                str_html += '<div class="tp">';
                                if (_user_id && v.playAuth.allow_play == 1){
                                    str_html += '<a href="'+_PLAY_URL+'/vid/'+ v.id + '">';
                                }else{
                                    str_html += '<a href="'+_PAY_URL+'/vid/'+ v.id + '">';
                                }

                                str_html += '<img class="lazy" src="'+ v.cover_img +'" data-src="'+ v.cover_img +' alt="" title="">';
                                str_html += '</a>';
                                str_html += '<i data-id="'+v.id+'" class="ico icoLove ';
                                if(_user_id && v.shoucang){
                                    str_html += 'icoLove-hover';
                                }
                                str_html += '"></i>';
                                str_html += '<span ';
                                if(v.is_tag == 1){
                                    str_html += 'class="lab labNew"';
                                }else if(v.is_tag == 2){
                                    str_html += 'class="lab labTj"';
                                }
                                str_html += '>';


                                str_html += '</span>';
                                str_html += '</div>';
                                str_html += '<div class="txt">';
                                str_html += '<p class="tiName">';
                                str_html += '<a href="';
                                if (_user_id && v.playAuth.allow_play == 1){
                                    str_html += _PLAY_URL+'/vid/'+ v.id;
                                }else{
                                    str_html += _PAY_URL+'/vid/'+ v.id;
                                }
                                str_html += '">';
                                str_html += v.title;
                                str_html += '</a>';

                                str_html += '</p>';


                                if(_user_id){
                                    str_html += '<div class="bot">';
                                    str_html += '<div class="money fl ';
                                    if (_user_id && v.playAuth.allow_play == 1){
                                        str_html += 'moneyNo';
                                    }
                                    str_html += '">';

                                    str_html += '<em class="num">'+v.buy_money+'</em>学习币';
                                    str_html += '</div>';
                                    str_html += '<div class="handle fr">';
                                    str_html += '<a href="';
                                    if (_user_id && v.playAuth.allow_play == 1){
                                        str_html += _PLAY_URL+'/vid/'+ v.id;
                                    }else{
                                        str_html += _PAY_URL+'/vid/'+ v.id;
                                    }


                                    str_html += '" ><i class="iconfont icon-bofang"></i>';

                                    if (_user_id && v.playAuth.allow_play == 1){
                                        str_html += '<i class="ico icoPlay"></i>';
                                        str_html += '<span class="ti00">播放</span>';
                                    }else{
                                        str_html += '<i class="ico icoBuy"></i>';
                                        str_html += '<span class="ti00">购买</span>';
                                    }


                                    str_html += '</a>';
                                    str_html += '</div>';
                                    str_html += '</div>';
                                }else{
                                    str_html += '<div class="bot">';
                                    str_html += '<div class="money fl">';
                                    str_html += '<em class="num">'+v.buy_money+'</em>学习币';
                                    str_html += '</div>';
                                    str_html += '<div class="handle fr">';
                                    str_html += '<a href="'+_PAY_URL+'/vid/'+ v.id+'">';
                                    str_html += '<i class="ico icoBuy"></i>';
                                    str_html += '<span class="ti00">购买</span>';
                                    str_html += '</a>';
                                    str_html += '</div>';
                                    str_html += '</div>';
                                }


                                str_html += '</div>';
                                str_html += '</div>';
                                str_html += '</li>';
                            });


                            $('#courList-ul').append(str_html);

                            function controlStyle() {
                                var h1 = $('.theMenu').height(),
                                    h2 = $('.theSearch').height();
                                h3 = $('.findSel .tabHd').height();
                                $('.listBd').css("top",(h1+h2+h3)+'px');
                                $('.listBd').height($(window).height()-h1-h2);
                                var  couLi = '.courList li',
                                    couLiWid = ($('body').width()-parseInt($('.courList').css('padding-left'))*2)*0.47,
                                    couLiMr = ($('body').width()-couLiWid*2)/2;
                                $(couLi).css("marginBottom",couLiMr);
                                $(couLi+':nth-of-type(odd)').css("marginRight",couLiMr);
                                $(couLi).width(couLiWid);
                                var couLiHig = couLiWid*1.09;
                                $(couLi).height(couLiHig);
                                var couTpWid = couLiWid*.95;
                                $(couLi+' .tp').width(couTpWid);
                                $(couLi+' .tp').height(couTpWid/1.6);
                            }

                            $(window).on('resize', function () {
                                controlStyle();
                            }).trigger('resize');


                            _pageSize = _pageSize + 1;
                            $('#getMore').hide();
                        }else{
                            $('#getMore').css('color','#999');
                            $('#getMore').html('<span style="color: #c2ccd1;">───────</span>&nbsp&nbsp&nbsp&nbsp我是有底线的&nbsp&nbsp&nbsp&nbsp<span style="color: #c2ccd1;">───────</span>');

                        }
                    }
                })
            }
        });
    });<?php endif; ?>
</script>

</body>
</html>