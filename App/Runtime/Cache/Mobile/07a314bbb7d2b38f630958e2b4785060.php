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
<style>
    body{background: #fff;}
    .askList ul .itemX, .collList ul .itemX{
        margin: 0;
    }

    /* 有show类的textarea元素就会显示 */
    .askList ul .item .anArea.show{
        display: block;
    }
</style>

<!--myQuestion-->
<section class="myQuestion">
    <div class="in">
        <div class="tab">
            <ol>
                <li><a href="<?php echo U('study/allQuestion');?>">全部提问</a></li>
                <li class="cur"><a href="javascript:;">我的提问</a></li>
            </ol>
        </div>
        <div class="askList">

            <!--全部提问-->
                <ul id="myQuestion">
                    <?php if(is_array($question["question"])): $i = 0; $__LIST__ = $question["question"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="mt16" data-question-id="<?php echo ($val["id"]); ?>">

                            <div data-last-answer-id="<?php echo ($val["limit_end_id"]); ?>" class="item question_list">
                                <div class="tp fl">
                                    <a href="javascript:;">
                                        <img class="q_userface" src="/Public/Member/images/logo/<?php echo ($val["face"]); ?>.png" alt="">
                                    </a>
                                </div>
                                <div class="txt">
                                    <!--客人提问，主人点击按钮-->
                                    <div class="txIn">
                                        <div class="tHd">
                                            <img class="q_usergroup" style="display: inline-block" src="/Public/Member/images/user_group/<?php echo ($val["user_group_id"]); ?>.png" alt="用户组头像">
                                            <span class="name q_username"><?php echo ($val["username"]); ?></span>
                                        </div>
                                        <p class="wz q_content"><?php echo ($val["question"]); ?></p>
                                        <p class="origin">
                                            <span>
                                                <em>来源：</em>
                                                <a href="<?php echo U(MODULE_NAME.'/Video/play', array('category_id' => $val['category_id']));?>"><?php echo ($val["category_name"]); ?>/</a><a href="<?php echo U(MODULE_NAME.'/Video/play', array('vid' => $val['vid']));?>"><?php echo ($val["video_name"]); ?></a>
                                            </span>
                                        </p>
                                        <div class="hand">
                                            <span class="time q_addtime"><?php echo ($val["addtime"]); ?></span>
                                            <a href="javascript:;" class="mesIco mesIcoT" flag=true onclick="mesIco($(this),'.question_list','.anAreaT', 'show')"><i></i>(<span class="reply_count"><?php echo ($val["count"]); ?></span>)</a>
                                        </div>
                                    </div>

                                    <div class="anArea anAreaT" >
                                        <form action="" method="post">
                                            <textarea class="q_reply_content" placeholder=""></textarea>
                                            <div class="bot">
                                                <a href="javascript:;" class="btn cancleBtn" onclick="fromCancel( $(this),'.question_list','.anAreaT','.mesIcoT','show')">取消</a>
                                                <a href="javascript:;" data-answer-id="0" onclick="replyQuestion($(this))" class="btn subBtn">提交</a>
                                            </div>
                                        </form>
                                    </div>

                                    <!--主人回复内容,客人点击按钮-->
                                    <?php if(is_array($val["answer"])): $i = 0; $__LIST__ = $val["answer"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="item itemX">
                                            <div class="tp fl">
                                                <a href="javascript:;">
                                                    <img src="/Public/Member/images/logo/<?php echo ($v["face"]); ?>.png" alt="">
                                                </a>
                                            </div>
                                            <div class="txt">
                                                <div class="txIn txInB">
                                                    <div class="tHd">
                                                        <img style="display: inline-block" src="/Public/Member/images/user_group/<?php echo ($v["user_group_id"]); ?>.png">
                                                        <span class="name"><?php echo ($v["username"]); ?></span>
                                                        <?php if($v['reply_user_id'] != 0){ echo '回复 <span><img class="reply_user_group" style="display: inline-block" src="/Public/Member/images/user_group/'.$v['reply_user_group_id'].'.png"> <span class="name reply_username">'.$v['reply_username'].'</span></span></span>'; } ?>


                                                        ：<span class="ask"><?php echo ($v["answer"]); ?></span>
                                                    </div>
                                                    <div class="hand">
                                                        <span class="time"><?php echo ($v["addtime"]); ?></span>
                                                        <?php if($v['user_id'] != $user_id){ echo '<a href="javascript:;" flag=true  class="mesIco mesIcoB" onclick="mesIco($(this),\'.itemX\',\'.anAreaB\',\'show\')"><i></i></a>'; } ?>

                                                    </div>
                                                </div>
                                                <div class="anArea anAreaB">
                                                    <form action="" method="post">
                                                        <textarea class="q_reply_content" placeholder=""></textarea>
                                                        <div class="bot">
                                                            <a href="javascript:;" class="btn cancleBtn" onclick="fromCancel( $(this),'.itemX','.anAreaB','.mesIcoB','show')">取消</a>
                                                            <a href="javascript:;" onclick="replyQuestion($(this))" data-answer-id="<?php echo ($v["id"]); ?>" class="btn subBtn">提交</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <!--加载更多-->
                                    <?php if(!empty($val["is_show_more"])): ?><span data-limit-end-id="<?php echo ($val["limit_end_id"]); ?>" onclick="answer_page($(this))">加载更多</span><?php endif; ?>
                                </div>

                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>


                    <!--加载更多-->
                    <?php if(!empty($question["is_show_more"])): ?><div onclick="question_page($(this),2)" class="clickMore">
                            <img src="/Public/Mobile/images/loadingIco.gif" alt="">
                            <a href="javascript:;" style="color: #ccc;">加载更多</a>
                        </div><?php endif; ?>
                    <?php if(empty($question["question"])): ?><!--没有数据：-->
                        <div id="question_noData" class="noData" style="text-align: center;">
                            <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据">
                            <p>数据为空</p>
                        </div><?php endif; ?>

                </ul>
            <!--全部问答E-->



        </div>
    </div>
</section>


<!--回复问题模板-->
<div style="display: none" class="item itemX" id="reply_question_templates">
    <div class="tp fl">
        <a href="javascript:;">
            <img class="q_userface" src="/Public/Member/images/logo/8.png" alt="">
        </a>
    </div>
    <div class="txt">
        <div class="txIn txInB">
            <div class="tHd">
                <img class="q_usergroup" style="display: inline-block" src="/Public/Member/images/user_group/1.png">
                <span class="name q_username"></span>：
                <span class="ask q_content">萨达</span>
            </div>
            <div class="hand">
                <span class="time q_addtime">2017-06-21</span>
                <!--<a href="javascript:;" class="mesIco mesIcoB"><i></i></a>-->
            </div>
        </div>
        <div class="anArea anAreaB">
            <form action="" method="post">
                <textarea class="q_content q_reply_content" placeholder=""></textarea>
                <div class="bot">
                    <a href="javascript:;" class="btn cancleBtn" onclick="fromCancel( $(this),'.itemX','.anAreaB','.mesIcoB','show')">取消</a>
                    <a href="javascript:;" data-answer-id="5028" class="btn subBtn q_answer_id" onclick="replyQuestion($(this))">提交</a>
                    <!--<div class="bot">-->
                        <!--<a href="javascript:;" class="btn cancleBtn">取消</a>-->
                        <!--<a href="javascript:;" class="btn subBtn">提交</a>-->
                    <!--</div>-->
                </div>
            </form>
        </div>
    </div>
</div>


<!--回复评论模板-->
<div style="display: none" class="item itemX" id="reply_answer_templates">
    <div class="tp fl">
        <a href="javascript:;">
            <img class="q_userface" src="/Public/Member/images/logo/8.png" alt="">
        </a>
    </div>
    <div class="txt">
        <div class="txIn txInB">
            <div class="tHd">
                <img class="q_usergroup" style="display: inline-block" src="/Public/Member/images/user_group/1.png">
                <span class="name"><span class="q_username">回复者</span> 回复 <span><img class="reply_user_group" style="display: inline-block" src="/Public/Member/images/user_group/1.png"> <span class="name reply_username">啥的</span></span></span>：
                <span class="ask q_content">萨达</span>
            </div>
            <div class="hand">
                <span class="time reply_addtime">2017-06-21</span>
                <!--<a href="javascript:;" class="mesIco mesIcoB"><i></i></a>-->
            </div>
        </div>
        <div class="anArea anAreaB">
            <form action="" method="post">
                <textarea class="q_content q_reply_content" placeholder=""></textarea>
                <div class="bot">
                    <a href="javascript:;" class="btn cancleBtn" onclick="fromCancel( $(this),'.itemX','.anAreaB','.mesIcoB','show')">取消</a>
                    <a href="javascript:;" data-answer-id="5028" class="btn subBtn q_answer_id" onclick="replyQuestion($(this))">提交</a>
                </div>
            </form>
        </div>
    </div>
</div>
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

<!--提示插件-->
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>

<script>

    var _writeQuestionUrl = "<?php echo U(MODULE_NAME.'/Study/writeQuestion');?>";    //发表问题接口地址
    var _replyQuestionUrl = "<?php echo U(MODULE_NAME.'/Study/replyQuestion');?>";    //回复问题接口地址
    var _myQuestionPageUrl = "<?php echo U(MODULE_NAME.'/Study/myQuestionPage');?>";  //加载更多问题接口地址
    var _questionPageUrl = "<?php echo U(MODULE_NAME.'/Study/questionPage');?>";  //加载更多评论接口地址

    var _MEMBER = "/Public/Member";
    var _MODULE_NAME = "/<?php echo MODULE_NAME;?>";

    var _user_id = <?php echo session(C('USER_AUTH_UID'));?>;  //当前用户id
    var _user_name = "<?php echo session(C('USER_AUTH_UNAME'));?>";  //当前用户名
    var _user_face = "/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png";  //当前用户头像
    var _user_group = "/Public/Member/images/user_group/<?php echo session(C('USER_GROUP_ID'));?>.png";  //当前用户组头像


    //查询出的最后一条问题的id
    <?php if(!empty($question["limit_end_id"])): ?>var _last_question_id = <?php echo ($question["limit_end_id"]); ?>;<?php endif; ?>



</script>

<script src="/Public/Mobile/js/main.js"></script>
<!--问答相关js-->
<script src="/Public/Mobile/js/question.js"></script>

</body>
</html>