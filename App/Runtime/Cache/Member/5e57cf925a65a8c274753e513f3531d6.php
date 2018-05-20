<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>嗨推学院-知名网络推广实战培训平台</title>
    <link rel="shortcut icon" href="/Public/Member/images/favicon.ico">
    <!--<link rel="stylesheet" href="//at.alicdn.com/t/font_lemhis1loyqcwhfr.css">-->
    <link rel="stylesheet" href="//at.alicdn.com/t/font_emcubu7melwn4s4i.css">
    <link rel="stylesheet" href="/Public/Member/pugins/libs/layui-master/css/layui.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.static.runoob.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/Public/Member/css/base.css">
    <link rel="stylesheet" href="/Public/Member/css/common.css">
    <link rel="stylesheet" href="/Public/Member/css/loginAfter.css">
</head>
<body>

<!--[if lt IE 9]>
<div class="chromeframe">您使用的IE浏览器版本过低，本站不再支持，<a href="http://windows.microsoft.com/">升级您的IE浏览器</a>，或使用<a
        href="http://www.google.cn/chrome/">Google Chrome</a>、<a href="http://www.firefox.com.cn/download/">Firefox</a>等高级浏览器，将会得到更好的体验！
</div>
<![endif]-->

<header class="toolBar clearfix" id="toolBar">
    <div class="in w1100 m0a">
        <div class="inL fl">
            <div class="sp app">
                <a href="javascript:;">
                    <i class="iconfont icon-shouji"></i><span>手机APP</span>
                </a>
            </div>
            <div class="sp wx">
                <a href="javascript:;">
                    <i class="iconfont icon-weixin_sel "></i>
                    <span>微信公众号</span>
                </a>

                <div class="ewmPop">
                    <i></i>
                    <div class="con">
                        <a href="javascript:;">
                            <img src="/Public/Member/images/ewmWx.png"  alt="嗨推微信公众号">
                        </a>
                        <p>[微信公众号]</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="inR fr">
            <div class="sp tel">
                <a href="javascript:;">
                    <i class="iconfont icon-telphone"></i>
                    <span>联系电话&nbsp;&nbsp;020-36700550</span>
                </a>
            </div>
            <div class="sp chat">
                <a href="<?php echo U('Content/contactUs');?>">
                    <span>联系我们</span>
                </a>
            </div>
            <div class="sp kf">
                <a href="<?php echo U('Content/problemList');?>">
                    <span>常见问题</span>
                </a>
            </div>
        </div>

    </div>
</header>

<section class="header clearfix" id="header">
    <div class="in w1100 m0a ">
        <div class="inL fl">
            <div class="logo">
                <h1>
                    <a href="<?php echo U('Index/index');?>" title="嗨推学院"></a>
                </h1>
            </div>
        </div>
        <div class="inR fr">
            <nav class="nav fl">
                <ul>
                    <li><a href="<?php echo session(C('USER_AUTH_UID'))?U('Study/index'):U('Index/index');?>" class="ti">首页</a><span></span></li>
                    <li><a href="<?php echo U('Index/videoList');?>" class="ti">热门视频</a><span></span></li>
                    <li class="down">
                        <a href="<?php echo U('Index/course');?>" class="ti">课程介绍</a><span></span>
                         <div class="Hlist">
                             <ul>
                                 <li><a href="#">推广精英</a></li>
                                 <li><a href="#">微信引流与变现</a></li>
                                 <li><a href="#">社交电商</a></li>
                                 <li><a href="#">淘宝客项目</a></li>
                                 <li><a href="#">试听会员</a></li>
                             </ul>
                         </div>
                    </li>
                    <li><a href="<?php echo U('Study/newQuestion');?>" class="ti">学习助手</a><span></span></li>
                    <li class="mes">
                    <a href="<?php echo U('User/myNews');?>" class="ti">消息</a><span></span>
                    <?php $getUserMessageCount = getUserMessageCount(session(C('USER_AUTH_UID'))); ?>
                        <?php if($getUserMessageCount): ?><i class="mesNum"><?php echo ($getUserMessageCount); ?></i><?php endif; ?>
                    
                    </li>
                </ul>
            </nav>
            <div class="rCon fr">
                <div class="sel fl">
                    <form id="key_word_form" action="<?php echo U('Index/videoList');?>">
                        <input type="text" name="key_word" value="<?php echo cookie('key_word');?>" placeholder="视频名称">
                        <a onclick="$('#key_word_form').submit();" class="ico iconfont icon-sousuo"></a>
                    </form>

                </div>

                <?php if(session(C('USER_AUTH_UID'))): ?><!--已登录 start-->
                    <div class="myTx fl">
                        <div class="tx">
                            <a href="javascript:;"><img src="/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png" alt="个人头像"></a>
                        </div>

                        <div class="myList">
                            <i></i>
                            <ul>
                                <li><a href="<?php echo U('User/myAccount');?>">个人中心</a></li>
                                <li><a href="<?php echo U('Safe/securityList');?>">安全设置</a></li>
                                <li><a href="<?php echo U('User/myInfo');?>">用户信息</a></li>
                                <li><a href="<?php echo U('Login/loginOut');?>">退出</a></li>
                            </ul>
                        </div>

                    </div>
                <!--已登录 end-->
                <?php else: ?>
                    <!--未登录 start-->
                    <div class="loginBtn fl">
                        <a href="<?php echo U('Login/index');?>">登录</a>
                    </div>
                    <!--未登录 end--><?php endif; ?>

            </div>
        </div>
    </div>
</section>


<!-- Font Awesome 图标字体 -->
<link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
<!--orderConfirm-->
<section class="order orderConfirm" id="orderConfirm">
    <div class="in w1100 m0a">
        <div class="hd">
            <a href="javascript:;" class="a1">个人中心</a>
            <i></i>
            <a href="javascript:;" class="a2">确认课程</a>
        </div>
        <div class="com accPay accPay02">
            <div class="payPlan" id="payPlan02">
                <div class="planIn">
                    <div class="inLine" style="width:426px"></div>
                    <ol>
                        <li class="li01 cur">
                            <div class="item">
                                <i></i>
                                <span class="ti">充值学习币</span>
                            </div>
                        </li>
                        <li class="li02">
                            <div class="item">
                                <i></i>
                                <span class="ti">选择课程</span>
                            </div>
                        </li>
                        <li class="li03">
                            <div class="item">
                                <i></i>
                                <span class="ti">确认课程</span>
                            </div>
                        </li>
                        <li class="li04">
                            <div class="item">
                                <i></i>
                                <span class="ti">报名成功</span>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="ordCon">
                <!--
                <div class="adr">
                    <h6 class="tit">收货地址</h6>
                    <ul>
                        <li class="li01">
                            <i class="radio"></i>
                        </li>
                        <li class="li02">
                            <span class="name">麦兜兜</span>
                        </li>
                        <li class="li03">
                            <p class="ad">广东省深圳市滨河大道2018号沙浦头康乐中心</p>
                        </li>
                        <li class="li04">
                            <span class="ph">12345678910</span>
                        </li>
                        <li class="li05">
                            <a href="javascript:;"><i></i><span>修改</span></a>
                        </li>
                    </ul>
                </div>
                -->
                <div class="cours" style="margin: 100px 0 0 0;">
                    <h6 class="tit"></h6>
                    <form action="" method="post" name="myForm">
                    <div class="coursInf">
                        <div class="infHd">
                            <ol>
                                <li class="li01">
                                    <span>课程类型</span>
                                </li>
                                <li class="li02">
                                    <span>数量</span>
                                </li>
                                <li class="li02">
                                    <span>有效期(天)</span>
                                </li>
                                <li class="li02">
                                    <span>单价(学习币)</span>
                                </li>
                            </ol>
                        </div>
                        <div class="infBd">
                            <ul>
                                <li>
                                    <div class="item li01">
                                        <p class="tiName"><a href="javascript:;"><?php echo ($goods_type==0?$data['name']:$data['title']); ?></a></p>
                                    </div>
                                    <div class="item li02">
                                        <span class="">×1</span>
                                    </div>
                                    <div class="item li02">
                                        <span class=""><?php echo ($goods_type==0?$data['gqtime']:$data['gqtime']); ?></span>
                                    </div>
                                    <div class="item li02">
                                        <span><em><?php echo ($goods_type==0?$data['buy_money']:$data['buy_money']); ?></em></span>
                                    </div>
                                </li>
                            </ul>
                            <div class="cheap">
                                <div class="it">
                                    <div class="fl yy">
                                        <i class="js-switch"></i>
                                        <span>使用优惠卷</span>
                                        <p class="pp">
                                            <input type="text" placeholder="" id="ticket" name="ticket_code">
                                            <em class="ticket-msg" style="font-size: 13px;"></em>
                                        </p>
                                    </div>
                                    <div class="fr mm">
                                        <span style="font-size: 13px;">-￥<em class="ticket-money">0</em></span>
                                    </div>
                                </div>
                                <div class="it">
                                    <div class="fl yy">
                                        <i class="js-switch"></i>
                                        <span>使用佣金</span>
                                        <p class="pp">
                                            <input type="text" placeholder="" id="expRell" name="brokerage">
                                            <span>可使用佣金：￥<em class="brokerage"><?php echo ($user_account['brokerage']); ?></em>&nbsp;&nbsp;<em class="brokerage-msg" style="font-size: 13px;"></em></span>
                                        </p>
                                    </div>
                                    <div class="fr mm">
                                        <span style="font-size: 12px;">-￥<em class="yongjin-money">0</em></span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="group_id" value="<?php echo I('group_id',0,'intval');?>">
                            <input type="hidden" name="vid" value="<?php echo I('vid',0,'intval');?>">
                            <div class="infHandle">
                                <div class="fr">
                                    <div class="tot fl">
                                        <div class="ti fl">已选：x<span class="num">1</span>个</div>
                                        <div class="ti fl">合计：<span class="allCost"><?php echo ($goods_type==0?$data['buy_money']:$data['buy_money']); ?></span>学习币</div>
                                    </div>
                                    <div class="fr">
                                        <button type="button" class="buyBtn" >去结算</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="payExp payExp02">
                <h6>报名课程中遇到问题：</h6>
                <p>* 报名课程成功后，系统将自动为您开通该学习课程的权限</p>
                <p>* 如您在报名课程后遇到问题，请<a href="javascript:;">联系我们&gt;&gt;</a> </p>
                <p>* 最终解释权归嗨推学院所有</p>
            </div>
        </div>
    </div>
</section>

<!--footer-->
<footer class="footer clearfix mt20" id="footer">
    <div class="footHd w1100 m0a">
        <div class="hdL fl">
            <div class="log">
                <a href="<?php echo U('Index/index');?>">
                    <img src="/Public/Member/images/htsLogo.png"  alt="嗨推学院">
                </a>
            </div>
            <div class="telTime">
                <div class="tel">
                    <p class="p1">公司电话</p>
                    <p class="p2">020-36700550</p>
                </div>
                <div class="time">
                    <p>工作日&nbsp;&nbsp;9:00-18:00&nbsp;&nbsp;周一至周六</p>
                </div>
            </div>
        </div>
        <div class="hdM fl">

            <div class="item">
                <h6>联系我们</h6>
                <ol>
                    <li><a href="<?php echo U('Content/index');?>">公司简介</a></li>
                    <li><a href="<?php echo U('Content/contactUs');?>">在线留言</a></li>
                    <li><a href="<?php echo U('Content/contactUs');?>">联系方式</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>帮助中心</h6>
                <ol>
                    <li><a href="<?php echo U('Content/problemList');?>">常见问题</a></li>
                    <li><a href="<?php echo U('Content/goodShareList');?>">干货分享</a></li>
                    <li><a href="<?php echo U('Home/Index/index');?>">客服中心</a></li>
                </ol>
            </div>
            <div class="item">
                <h6>关于我们</h6>
                <ol>
                    <li><a href="<?php echo U('Index/course');?>">课程介绍</a></li>
                    <li><a href="<?php echo U('Content/studentSay');?>">精英学员</a></li>
                    <li><a href="<?php echo U('Content/openVideo');?>">学员视频</a></li>
                </ol>
            </div>
        </div>
        <div class="hdR fr">
            <div class="ewm" id="ewmApp">
                <p>扫码下载APP</p>
                <a href="javascript:;">
                    <img src="/Public/Member/images/ewmApp.png"  alt="嗨推APP">
                </a>
            </div>
            <div class="ewm" id="ewmWx">
                <p>关注微信公众号</p>
                <a href="javascript:;">
                    <img src="/Public/Member/images/ewmWx.png"  alt="微信公众号">
                </a>
            </div>
        </div>
    </div>
    <div class="links">
        <div class="in w1100 m0a">
            <div class="tit fl">
                <h5>友情链接</h5>
            </div>
            <ul>
                <?php if(is_array($friends)): $i = 0; $__LIST__ = $friends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($val["url"]); ?>" target="_blank"><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <div class="in w1100 m0a">
            <p><a href="javascript:">粤ICP备14026621号</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;Copyright © 2013-2017 hitui.com 嗨推学院 ALL Rights Reserved.</p>
            <ul>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy01.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy02.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy03.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy04.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy05.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy06.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:;"><img src="/Public/Member/images/copy07.png" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
</footer>

<!--sidebar-->
<section class="sidebar" id="sidebar">
    <div class="in">
        <ul>
            <li class="li01">
                <a href="<?php echo U('Pay/courseChoose');?>">
                    <i id="shopCarNum">1</i>
                </a>
            </li>
            <li class="li02">
                <a href="javascript:;"></a>
                <div class="lePop" id="lePop01">
                    <img src="/Public/Member/images/ewmx.png" alt="">
                    <span>微信公众号关注</span>
                    <em class="arr"></em>
                </div>
            </li>
            <li class="li03">
                <a href="<?php echo U('Index/index');?>"></a>
                <div class="lePop" id="lePop02">
                    <img src="/Public/Member/images/ewmx.png" alt="">
                    <span>APP下载</span>
                    <em class="arr"></em>
                </div>
            </li>
            <li class="li04">
                <a href="<?php echo U('Index/course');?>"></a>
            </li>
            <li class="li05 backTop">
                <a href="javascript:;"></a>
            </li>
        </ul>
    </div>
</section>
<script src="/Public/Member/js/jquery-1.11.2.min.js"></script>
<script src="/Public/Member/js/common.js"></script>
<script src="/Public/Member/js/from.js"></script>

<script src="/Public/Member/js/HloginAftert.js"></script>

<script src="/Public/Member/js/myForm.js"></script>
<script src="/Public/Member/js/loginAfter.js"></script>
<script src="/Public/Member/js/loginBefore.js"></script>
<script src="/Public/Member/pugins/libs/layui-master/layui.js"></script>
<script src="/Public/Member/pugins/libs/validator/dist/jquery.validator.js?local=zh-CN"></script>

<script>
    var URL = $("#captcha_img").attr("src");
    //刷新验证码
    $("#captcha_img").on('click',function(){
        $("#captcha_img").attr("src",URL+'?r='+Math.random());
    });

</script>
</body>
</html>

<script src="/Public/AdminLte/layer/layer.js"></script>
<script>
    //var reg = /^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$/ ;

    var FormUrl      = "<?php echo U('Pay/courseConfirm');?>";
    var TicketUrl    = "<?php echo U('Pay/checkedTicket');?>";
    var brokerageUrl = "<?php echo U('Pay/checkedBrokerage');?>";
    //课程原总金额
    var FirstallMoney = $('.allCost').text();
    //账户原总佣金
    var Firstbrokerage = $('.brokerage').text();

    var kecheng = "<?php echo ($goods_type==0?$data['name']:$data['title']); ?>";
    var kecheng = '<em style="color: #ff6100;">'+kecheng+'</em>';

    //检查佣金是否可用
    $('#expRell').on('keyup',function(){
        var this_ = $(this);
        if(this_.val().length > 0){
            $.post(brokerageUrl,{'brokerage':this_.val()},function(data){
                if(data.status==0){
                    $('.brokerage-msg').css({'color':'red'}).attr('class','brokerage-msg fa fa-exclamation-circle').text(data.info);
                    if($('.allCost').text()==FirstallMoney){
                        resetMoney();
                    }
                }else if(data.status==1){
                    $('.brokerage-msg').css({'color':'#51c44e'}).attr('class','brokerage-msg').text('');

                    //账户总金额
                    $('.brokerage').text(Firstbrokerage-parseFloat(this_.val()));
                    //减去的金额
                    $('.yongjin-money').text(this_.val());

                    var nowAllMoney = $('.allCost').text()-parseFloat(this_.val());
                    var nowAllMoney = nowAllMoney>0?nowAllMoney:0;
                    $('.allCost').text(nowAllMoney);
                }
            },'json');
        }else{
            resetMoney();
            $('.brokerage-msg').css({'color':'#51c44e'}).attr('class','brokerage-msg').text('');
        }
    });

    //检查优惠券
    $('#ticket').on('paste',function(){
        var this_ = $(this);
        setTimeout(function() {
            if(this_.val().length >= 10){
                checkedTicket(this_);
            }else{
                this_.next('.ticket-msg').attr('class','ticket-msg').text('');
                resetMoney();
            }
        }, 10);
    });
    //检查优惠券
    $('#ticket').on('keyup',function(){
        var this_ = $(this);
        if(this_.val().length >= 10){
            checkedTicket(this_);
        }else{
            this_.next('.ticket-msg').attr('class','ticket-msg').text('');
            resetMoney();
        }
    });
    //复原原来价格
    function resetMoney(){
        $('.allCost').text(FirstallMoney);
        $('.brokerage').text(Firstbrokerage);
        $('.ticket-money , .yongjin-money').text(0);
    }

    //检查优惠券是否可用
    function checkedTicket(obj){
        $.post(TicketUrl,{'ticket_code':obj.val()},function(data){
            if(data.status==0){
                obj.next('.ticket-msg').css({'color':'red'}).attr('class','ticket-msg fa fa-exclamation-circle').text(data.info);
                resetMoney();
            }else if(data.status==1){
                obj.next('.ticket-msg').css({'color':'#51c44e'}).attr('class','ticket-msg fa fa-check-circle').text('可以使用');
                //优惠券金额
                var ticket_money = data.info.price;

                $('.ticket-money').text(ticket_money);
                var nowAllMoney = $('.allCost').text()-ticket_money;
                var nowAllMoney = nowAllMoney>0?nowAllMoney:0;
                $('.allCost').text(nowAllMoney);
            }
        },'json');
    }




    //结算按钮
    $('.buyBtn').on('click',function(){
        var this_ = $(this);
        var countMoney = this_.parents('.infHandle').find('.allCost').text();
        var countMoney = '<em style="color: #ff6100;">'+countMoney+'</em>';
        //询问框
        var popup = layer.confirm('从账户中扣除'+countMoney+'学习币购买《'+kecheng+'》课程,确认支付吗？', {
            //icon:3,
            title:'提示信息',
            shade:0.4,
            btn: ['确定支付','取消'] //按钮
        }, function(e){
            $.post(FormUrl,$('form[name="myForm"]').serialize(),function(data){
                if(data.status==0){
                    show_msg(data.info,'error');
                }else if(data.status==1){
                    show_msg(data.info);
                }
                if(data.url != ''){
                    setTimeout(function(){
                        location.href = data.url;
                    },1500);
                }
            },'json');
            layer.close(popup);
        }, function(e){
            layer.close(popup);
        });
    });
</script>