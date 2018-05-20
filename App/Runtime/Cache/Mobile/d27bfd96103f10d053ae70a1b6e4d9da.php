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
    <link rel="stylesheet" href="http://at.alicdn.com/t/font_gwe8d2i5nduw61or.css">
    <link rel="stylesheet" href="/Public/Mobile/css/main.css">

<style>
    .origin{
        display: none;
    }
</style>

<!--视频主要内容块-->
<setion class="playVideo  Hlearn">
    <!--视频播放S-->
    <!--<div id="module_basic_player" class="palyV">-->
        <!--<div class="player" id="videoLeft">-->

                <script src="https://player.polyv.net/script/polyvplayer.min.js"></script>
                <!-- 视频播放 -->
                <div id='plv_<?php echo ($videoInfo["video_code"]); ?>'></div>
                <script>
                    //视频播放参数
                    var player = polyvObject('#plv_<?php echo ($videoInfo["video_code"]); ?>').videoPlayer({
//                        'width':'100%',
                        'height':'146',
                        'vid' : '<?php echo ($videoInfo["video_code"]); ?>',
                        //ban_history_time off 记录播放进度并续播  history_video_duration表示视频总时长超过多少分钟时，记录历史播放进度，下次播放时自动续播，默认为5分钟
                        'flashvars':{"ban_history_time":"off", "history_video_duration":1, "autoplay":1}
                    });
                </script>

        <!--</div>-->
    <!--</div>-->
    <!--视频播放E-->

    <div class="Hrow">
        <span class="fl hfont"><?php echo ($videoInfo["title"]); ?></span>
        <span class="fr ke">课程简介 <i class="iconfont icon-xiala"></i></span>
        <div class="introduce">
            <p><?php echo ($videoInfo["remark"]); ?></p>
        </div>
    </div>

 <!--tab栏-->
    <div class="learnTab clearfix">
        <ul>
            <li class="cur"><a href="#">目录</a></li>
            <li><a href="#">问答</a></li>
            <li><a href="#">笔记</a></li>
        </ul>
    </div>

<!--目录S-->
    <div class="questionMain show" style="min-height: 500px">
        <div class="videoItem">
              <ul class="list tab-bd">

                  <!--正在播放-->
                  <li class="itemLi bofang boxShadow">

                      <div class="itemMain clearfix">
                          <a class="pic" href="javascript:;" target="_blank">
                              <img class="img" src="<?php echo ($videoInfo["cover_img"]); ?>" alt="<?php echo ($videoInfo["title"]); ?>" title="<?php echo ($videoInfo["title"]); ?>">
                              <i data-vid="<?php echo ($videoInfo["id"]); ?>" class="iconfont video_shoucang <?php if($videoInfo["is_shoucang"] === true): ?>icon-icon-sel-shixin <?php else: ?> icon-shoucang<?php endif; ?>"></i>

                              <?php if($videoInfo['is_tag'] == 1): ?><div class="sanjiao blueColor">
                                      <span class="ico-lt">最新</span>
                                  </div>
                              <?php elseif($videoInfo['is_tag'] == 2): ?>
                                  <div class="sanjiao redColor">
                                      <span class="ico-lt">推荐</span>
                                  </div><?php endif; ?>
                          </a>

                          <div class="liRight">
                              <p class="wzH"><?php echo ($videoInfo["title"]); ?></p>
                              <p class="fc ft15"><?php echo ($videoInfo["total_question"]); ?>个提问</p>
                              <p class="botm clearfix">
                                  <span class="fl style"><em><?php echo ($videoInfo["buy_money"]); ?></em> 学习币</span>
                                  <span class="fr" style="font-size:13px"><i class="iconfont icon-bofang"></i>播放中</span>
                              </p>
                          </div>
                      </div>
                  </li>

                  <?php if(is_array($categoryVideoList)): $i = 0; $__LIST__ = $categoryVideoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; $playAuth = videoPlayAuth($val['id']); $shoucang = M('video_shoucang')->where(array('user_id'=>session(C('USER_AUTH_UID')),'vid'=>$val['id']))->getField('id'); $url = U('Video/play',array('vid'=>$val['id'])); $is_play = $vid == $val['id'] ? true : false; ?>


                      <?php if($playAuth['allow_play'] == 1): if($is_play === true): ?><li class="itemLi bofang boxShadow">
                          <?php else: ?>
                                <li class="itemLi bofang"><?php endif; ?>

                      <?php else: ?>
                            <li class="itemLi recommend"><?php endif; ?>
                          <div class="itemMain clearfix">
                              <a class="pic" href="<?php echo U('Video/play',array('vid'=>$val['id']));?>">
                                  <img class="img" src="<?php echo ($videoInfo["cover_img"]); ?>" alt="<?php echo ($videoInfo["title"]); ?>" title="<?php echo ($videoInfo["title"]); ?>">
                                  <i data-vid="<?php echo ($val["id"]); ?>" class="iconfont video_shoucang <?php echo ($shoucang? 'icon-icon-sel-shixin' : 'icon-shoucang'); ?>"></i>

                                  <?php if($val['is_tag'] == 1): ?><div class="sanjiao blueColor">
                                          <span class="ico-lt">最新</span>
                                      </div>
                                      <?php elseif($val['is_tag'] == 2): ?>
                                      <div class="sanjiao redColor">
                                          <span class="ico-lt">推荐</span>
                                      </div><?php endif; ?>

                              </a>
                              <div class="liRight">
                                  <p class="wzH"><?php echo ($val["title"]); ?></p>
                                  <p class="fc ft15"><?php echo ($val["total_question"]); ?>个提问</p>
                                  <p class="botm clearfix">
                                      <span class="fl <?php echo ($playAuth['allow_play']==1?'style':''); ?> "><em class="<?php echo ($playAuth['allow_play']==1?'':'cssStyle'); ?>"><?php echo ($val["buy_money"]); ?></em> 学习币</span>
                                      <a href="<?php echo ($playAuth['allow_play'] == 1? U('Video/play',array('vid'=>$val['id'])) : 'javascript:;'); ?>">
                                        <span class="fr" style="font-size: 15px"><?php echo ($playAuth['allow_play'] == 1? '<i class="iconfont icon-bofang"></i>播放' : '<i class="iconfont icon-216"></i>购买'); ?></span>
                                      </a>
                                  </p>
                              </div>
                          </div>
                      </li><?php endforeach; endif; else: echo "" ;endif; ?>

              </ul>
        </div>
    </div>
<!--目录E-->


<!--问答S-->
    <div class="questionMain " style="min-height: 500px">
        <!--表单S-->
        <div class="Hfrom">
            <form action="" method="post">
                <textarea id="questionContent" placeholder=""></textarea>
                <div class="tijiao">
                    <a href="javascript:;" onclick="writeQuestion()" class="subBtn">发表问题</a>
                </div>
            </form>
        </div>
        <!--表单E-->
        <ul id="questionList">
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

                                <div class="hand">
                                    <span class="time q_addtime"><?php echo ($val["addtime"]); ?></span>
                                    <a href="javascript:;" class="mesIco mesIcoT" flag=true onclick="mesIco($(this),'.question_list','.anAreaT', 'show')"><i></i>(<span class="reply_count"><?php echo ($val["count"]); ?></span>)</a>
                                </div>
                            </div>

                            <div class="anArea anAreaT" >
                                <form action="" method="post">
                                    <textarea class="q_reply_content" placeholder=""></textarea>
                                    <div class="bot">
                                        <a href="javascript:;" class="cancleBtn" onclick="fromCancel( $(this),'.question_list','.anAreaT','.mesIcoT','show')">取消</a>
                                        <a href="javascript:;" data-answer-id="0" onclick="replyQuestion($(this))" class="subBtn">提交</a>
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
                                                    <a href="javascript:;" class="cancleBtn" onclick="fromCancel( $(this),'.itemX','.anAreaB','.mesIcoB','show')">取消</a>
                                                    <a href="javascript:;" onclick="replyQuestion($(this))" data-answer-id="<?php echo ($v["id"]); ?>" class="subBtn">提交</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <!--加载更多-->
                            <?php if(!empty($val["is_show_more"])): ?><div data-limit-end-id="<?php echo ($val["limit_end_id"]); ?>" onclick="answer_page($(this))">加载更多</div><?php endif; ?>
                        </div>

                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>


            <!--加载更多-->
            <?php if(!empty($question["is_show_more"])): ?><div onclick="question_page($(this))" class="clickMore">
                    <img src="/Public/Mobile/images/loadingIco.gif" alt="">
                    <a href="javascript:;" style="color: #ccc;">加载更多</a>
                </div><?php endif; ?>
            <?php if(empty($question["question"])): ?><!--没有数据：-->
                <div id="question_noData" class="noData" style="text-align: center;">
                    <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据">
                    <p>数据为空</p>
                </div><?php endif; ?>

        </ul>
    </div>
<!--问答E-->



<!--笔记S-->
    <div class="questionMain" id="noteMain" style="min-height: 500px">
        <div class="Hfrom">
            <form action="" method="post">
                <textarea id="noteContent" placeholder=""></textarea>
                <div class="tijiao">
                    <a href="javascript:;" onclick="writeNote()" class="subBtn">发表笔记</a>
                </div>
            </form>
        </div>

<!-- 每一块S -->
        <?php if(empty($noteList["noteList"])): ?><!--没有数据：-->
            <div id="note_noData" class="noData" style="text-align: center;">
                <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据"  width="" height="">
                <p>数据为空</p>
            </div><?php endif; ?>

        <?php if(is_array($noteList["noteList"])): $i = 0; $__LIST__ = $noteList["noteList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="noteItem" id="<?php echo ($val["id"]); ?>" data-noteid=<?php echo ($val["id"]); ?>>
                <a href="javascript;" class="noteA">
                    <p class="pp"><?php echo ($val["content"]); ?></p>
                </a>
                <!--文本框S-->
                <div class="anArea mt0 bgColor ">
                    <form action="" method="post">
                        <textarea placeholder="" ></textarea>
                        <div class="bot mt20 mr42 mb25">
                            <a href="javascript:;" class="cancleBtn subBtn1" onclick="cancleBtn($(this),'active')">取消</a>
                            <a href="javascript:;" class="subBtn subBtn1" onclick="subBtn($(this),'active')">提交</a>
                        </div>
                    </form>
                </div>
                <!--文本框E-->
                <div class="noteFoot fc clearfix mt4">
                    <span class="fl "><?php echo ($val["addtime"]); ?></span>
                    <div class="fr operate">
                        <span class="revise" onclick="xiugai($(this),'active');"><i class="iconfont icon-bianxie"></i>修改</span>
                        <span class="delete" onclick="subDel($(this))"><i class="iconfont icon-del"></i>删除</span>
                        <span><i class="iconfont icon-bofang"></i><em><?php echo ($val["playtime"]); ?></em></span>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--加载更多-->
        <?php if(!empty($noteList["is_show_more"])): ?><div onclick="notePage($(this))" class="clickMore"><img src="/Public/Mobile/images/loadingIco.gif" alt=""> 加载更多</div><?php endif; ?>

<!-- 每一块E -->

        <!-- 遮罩层 -->
        <div class="Hmask" id="Hmask">
            <div class="maskDel">
                <p class="deleWZ">您确定删除吗？</p>
                <div class="maskFrom">
                    <a href="#" class="Hcancel mr15">取消</a>
                    <a href="#" class="Hsubmit" onclick="subDel($(this));">确定</a>
                </div>
            </div>
        </div>

    </div>
<!--笔记E-->



<!--模板HTML start-->

    <!--发表问题模板-->
    <li style="display: none;" class="mt16" data-question-id="3885" id="question_templates">
        <div data-last-answer-id="<?php echo ($val["limit_end_id"]); ?>" class="item question_list">
            <div class="tp fl">
                <a href="javascript:;">
                    <img class="q_userface" src="/Public/Member/images/logo/8.png" alt="">
                </a>
            </div>
            <div class="txt">
                <!--客人提问，主人点击按钮-->
                <div class="txIn">
                    <div class="tHd">
                        <img class="q_usergroup" style="display: inline-block" src="/Public/Member/images/user_group/1.png" alt="用户组头像">
                        <span class="name q_username">111aaa</span>
                    </div>
                    <p class="wz q_content">撒打算</p>

                    <div class="hand">
                        <span class="time q_addtime">2017-06-21 11:44</span>
                        <a href="javascript:;" class="mesIco mesIcoT" flag=true onclick="mesIco($(this),'.question_list','.anAreaT','show')"><i></i></a>
                    </div>
                </div>

                <div class="anArea anAreaT">
                    <form action="" method="post">
                        <textarea class="q_reply_content" placeholder=""></textarea>
                        <div class="bot">
                            <a href="javascript:;" class="cancleBtn" onclick="fromCancel( $(this),'.question_list','.anAreaT','.mesIcoT','show')">取消</a>
                            <a href="javascript:;" data-answer-id="0" onclick="replyQuestion($(this))" class="subBtn">提交</a>
                        </div>
                    </form>
                </div>

                <!--主人回复内容,客人点击按钮-->
            </div>
        </div>
    </li>


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
                        <a href="javascript:;" class="cancleBtn" onclick="fromCancel( $(this),'.itemX','.anAreaB','.mesIcoB','show')">取消</a>
                        <a href="javascript:;" data-answer-id="5028" class="subBtn q_answer_id" onclick="replyQuestion($(this))">提交</a>
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
                        <a href="javascript:;" class="cancleBtn" onclick="fromCancel( $(this),'.itemX','.anAreaB','.mesIcoB','show')">取消</a>
                        <a href="javascript:;" data-answer-id="5028" class="subBtn q_answer_id" onclick="replyQuestion($(this))">提交</a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--笔记加载更多模板-->
    <div style="display: none" class="noteItem" id="note_templates" data-noteid="21204">
        <a href="javascript;" class="noteA">
            <p class="pp q_content">111阿斯达萨达asd </p>
        </a>
        <!--文本框S-->
        <div class="anArea mt0 bgColor ">
            <form action="" method="post">
                <textarea placeholder=""></textarea>
                <div class="bot mt20 mr42 mb25">
                    <a href="javascript:;" class="cancleBtn subBtn1" onclick="cancleBtn($(this),'active')">取消</a>
                    <a href="javascript:;" class="subBtn subBtn1" onclick="subBtn($(this),'active')">提交</a>
                </div>
            </form>
        </div>
        <!--文本框E-->
        <div class="noteFoot fc clearfix mt4">
            <span class="fl q_addtime">2017-06-21 12:45</span>
            <div class="fr operate">
                <span class="revise" onclick="xiugai($(this),'active');"><i class="iconfont icon-bianxie"></i>修改</span>
                <span class="delete" onclick="subDel($(this))"><i class="iconfont icon-del"></i>删除</span>
                <span><i class="iconfont icon-bofang"></i><em class="q_playtime">00:00:02</em></span>
            </div>
        </div>
    </div>
<!--模板HTML END-->



</setion>
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
<script src="/Public/Mobile/js/touch.js"></script>
<script src="/Public/Mobile/js/base.js"></script>


<script src="/Public/Mobile/js/main.js"></script>
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


<script src="/Public/Mobile/js/swipe.js"></script>
<!--提示插件-->
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>

<script>
    var _writeNoteUrl = "<?php echo U(MODULE_NAME.'/Study/writeNote');?>";    //发表笔记接口地址
    var _editNoteUrl = "<?php echo U(MODULE_NAME.'/Study/editNote');?>";    //修改笔记接口地址
    var _deleteNoteUrl = "<?php echo U(MODULE_NAME.'/Study/deleteNote');?>";  //删除笔记接口地址
    var _notePageUrl = "<?php echo U(MODULE_NAME.'/Study/notePage');?>";  //加载更多笔记接口地址

    var _writeQuestionUrl = "<?php echo U(MODULE_NAME.'/Study/writeQuestion');?>";    //发表问题接口地址
    var _replyQuestionUrl = "<?php echo U(MODULE_NAME.'/Study/replyQuestion');?>";    //回复问题接口地址
    var _questionListPageUrl = "<?php echo U(MODULE_NAME.'/Study/questionListPage');?>";  //加载更多问题接口地址
    var _questionPageUrl = "<?php echo U(MODULE_NAME.'/Study/questionPage');?>";  //加载更多评论接口地址

    var _MEMBER = "/Public/Member";
    var _MODULE_NAME = "/<?php echo MODULE_NAME;?>";
    var _vid = <?php echo ($vid); ?>;  //视频id

    var _user_id = <?php echo session(C('USER_AUTH_UID'));?>;  //当前用户id
    var _user_name = "<?php echo session(C('USER_AUTH_UNAME'));?>";  //当前用户名
    var _user_face = "/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png";  //当前用户头像
    var _user_group = "/Public/Member/images/user_group/<?php echo session(C('USER_GROUP_ID'));?>.png";  //当前用户组头像

    //查询出的最后一条笔记的id
    <?php if(!empty($noteList["limit_end_id"])): ?>var _last_note_id = <?php echo ($noteList["limit_end_id"]); ?>;<?php endif; ?>

    //查询出的最后一条问题的id
    <?php if(!empty($question["limit_end_id"])): ?>var _last_question_id = <?php echo ($question["limit_end_id"]); ?>;<?php endif; ?>



</script>

<!--笔记相关js-->
<script src="/Public/Mobile/js/note.js"></script>

<script src="/Public/Mobile/js/main.js"></script>
<!--问答相关js-->
<script src="/Public/Mobile/js/question.js"></script>

<script>
    $('.video_shoucang').unbind('click').click(function () {
        var url = "<?php echo U(MODULE_NAME.'/Video/videoShoucang');?>";
        var thisObj = $(this);
        var vid = thisObj.attr('data-vid');


        $.ajax({
            type:"post",
            url:url,
            data:{"vid":vid},
            dataType:"json",
            success:function (data) {

                if(data.status==1){
                    thisObj.addClass('icon-icon-sel-shixin').removeClass('icon-shoucang');
                    showMsg('收藏成功');
                }else if(data.status==0){
                    thisObj.addClass('icon-shoucang').removeClass('icon-icon-sel-shixin');
                    showMsg('已取消收藏');
                }
            }
        })
    });

    $(document).ready(function () {
        var $ke=$(".Hrow .ke"),
            Hicon=$(".Hrow .ke .icon-xiala"),
            introduce=$(".Hrow .introduce");    //介绍的内容块

        $ke.on("click",function () {
            if(Hicon.hasClass("icon-xiala")){

                Hicon.removeClass("icon-xiala").addClass("icon-guanbi");
                introduce.show();
                return false;
            }else{

                Hicon.removeClass("icon-guanbi").addClass("icon-xiala");
                introduce.hide();
                return false;
            }
        });
    });
</script>
</body>
</html>