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
<style>
    .askList ul .item .anArea.show{
        display: block;
    }
</style>
<body style="background-color: #fff;">

<!--header-->
<header class="header">
    <div class="in">
        <div class="com">
            <div class="logo">
                <h1><a href="javascript:;" title="嗨推学院">嗨推学院</a></h1>
            </div>
            <div class="txt">
                <?php if(session(C('USER_GROUP_ID'))): ?><a href="<?php echo U('User/my');?>" class="ti loginLink"><?php echo session(C('USER_AUTH_UNAME'));?></a>
                    <a href="javascript:;" onclick="loginOut();" class="ti regLink">[退出]</a>
                 <?php else: ?>
                    <a href="<?php echo U('Login/index');?>" class="ti loginLink">登录</a>
                    <a href="<?php echo U('Login/register');?>" class="ti regLink">注册</a><?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!--banner-->
<section class="banner">
    <div id="slideBox" class="slideBox">
        <div class="bd">
            <?php if($banner): ?><ul>
                <?php if(is_array($banner)): $k = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                        <a href="<?php echo ($v['link_url']); ?>" class="pic" >
                            <img src="<?php echo ($v['img_url']); ?>" alt="海报展示图">
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            <?php else: ?>
                <p style="text-align: center;font-size: 20px;color: red;line-height: 200px;background-color: #0aabf5;">正在上传中..</p><?php endif; ?>
        </div>
        <div class="hd hor_center">
            <ul></ul>
        </div>
    </div>
</section>

<!--mainCom-->
<section class="mainCom">
    <div class="gfNot">
        <?php if($notice): ?><div class="tit">
                <i></i><h6>公告：</h6>
            </div>
            <ul>
                <?php if(is_array($notice)): $k = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                        <a href="<?php echo U('Content/webNotice',array('main'=>$v['id']));?>">
                            <p class="ti"><?php echo jiequ($v['title'],0,13,'..');?></p>
                            <span class="date"><?php echo date('Y/m/d',$v['addtime']);?></span>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <a href="<?php echo U('Content/webNoticeList');?>" class="more">&gt;&gt;</a>
        <?php else: ?>
            <p style="text-align:center;line-height: .6rem; ">^-^ 还没有新公告呦。。</p><?php endif; ?>
    </div>
    <div class="affList">
       <ul>
           <li>
               <div class="tp">
                   <img src="/Public/Mobile/images/aff01.png" alt="">
               </div>
               <div class="txt">
                   <p class="p1">
                       <span class="num"><?php echo ($userCount); ?></span>人
                   </p>
                   <p class="p2">
                       <span>学员人数</span>
                   </p>
               </div>
           </li>
           <li>
               <div class="tp">
                   <img src="/Public/Mobile/images/aff02.png" alt="">
               </div>
               <div class="txt">
                   <p class="p1">
                       <span class="num"><?php echo ($videoCount); ?></span>节
                   </p>
                   <p class="p2">
                       <span>专业课程</span>
                   </p>
               </div>
           </li>
           <li>
               <div class="tp">
                   <img src="/Public/Mobile/images/aff03.png" alt="">
               </div>
               <div class="txt">
                   <p class="p1">
                       <span class="num"><?php echo ($timeCount); ?></span>分
                   </p>
                   <p class="p2">
                       <span>课程时间</span>
                   </p>
               </div>
           </li>
       </ul>
    </div>
    <div class="column">
        <ol>
            <li>
                <a href="<?php echo U('Index/videoList');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco01.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">课程视频</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Video/videoCategory');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco02.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">我的课程</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Content/courseList');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco03.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">课程简介</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Study/allQuestion');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco04.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">最新回答</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Content/webNoticeList');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco05.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">官方资讯</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Student/index');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco06.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">精英学员</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco07.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">客服中心</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Content/problemList');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco08.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">常见问题</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Content/contactUs');?>" class="item">
                    <div class="tp">
                        <img src="/Public/Mobile/images/mIco09.png" alt="">
                    </div>
                    <div class="txt">
                        <span class="ti">联系我们</span>
                    </div>
                </a>
            </li>
        </ol>
    </div>
    <div class="content">
        <div class="hdTit">
            <p class="line"></p>
            <h4 class="tit">课程推荐</h4>
        </div>
        <div class="kcIn">
            <div class="kcL" style="background-image: url(/Public/Mobile/images/kfTp01.png)">
                <p class="tx">权威课程 坏坏主讲</p>
                <a href="javascript:;" class="linkDet">
                    <span>课程详情</span>
                </a>
            </div>
            <div class="kcR">
                <div class="kcList">
                    <ul>
                        <?php if(is_array($coursePrice)): $k = 0; $__LIST__ = $coursePrice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
                                <a href="<?php echo U('Pay/courseConfirm',array('group_id'=>$v['id']));?>" class="item">
                                    <div class="cName"><?php echo ($v['name']); ?></div>
                                    <div class="cTime">
                                        <?php $qgtime = floor($v['gqtime']/365); ?>
                                        <span class="sp1 time">
                                            <?php if($qgtime > 0): echo ($qgtime); ?>年
                                            <?php else: ?>
                                                <?php echo ($v['gqtime']); ?>天<?php endif; ?>
                                        </span>
                                        <span class="sp2">期限</span>
                                    </div>
                                    <div class="cGold">
                                        <span class="sp1 num"><?php echo ($v['buy_money']); ?></span>
                                        <span class="sp2">学习币</span>
                                    </div>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="hdTit">
            <p class="line"></p>
            <h4 class="tit">热门视频</h4>
        </div>
        <div class="courList courLists" id="myCourList">
            <ul>
                <?php if(is_array($videoshow)): $k = 0; $__LIST__ = $videoshow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; $playAuth = $user_id ? videoPlayAuth($v['id']) : ''; if($user_id){ $v['shoucang'] = M('video_shoucang')->where(array('user_id'=>$user_id,'vid'=>$v['id']))->getField('id'); } ?>
                    <li>
                        <div class="item">
                            <div class="tp">
                                <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                    <?php if($v['cover_img']): ?><img class="lazy" src="/Public/Mobile/images/loading.gif"   data-src="<?php echo ($v['cover_img']); ?>" alt="封面图" title="">
                                    <?php else: ?>
                                        <img class="lazy" src="/Public/Mobile/images/loading.gif"   data-src="/Public/Mobile/images/courTp01.png" alt="封面图" title=""><?php endif; ?>
                                </a>
                                <i data-id="<?php echo ($v["id"]); ?>" class="ico icoLove <?php echo ($user_id && $v['shoucang']?'icoLove-hover':''); ?>"></i>
                                <span class="lab"></span>
                            </div>
                            <div class="txt">
                                <p class="tiName">
                                    <a href="javascript:;"><?php echo jiequ($v['title'],0,20,'');?></a>
                                </p>
                                <div class="bot">
                                    <div class="money fl  <?php echo ($playAuth['allow_play']==1?'moneyNo':''); ?>">
                                        <em class="num"><?php echo ($v['buy_money']); ?></em>学习币
                                    </div>
                                    <div class="handle fr">
                                        <a href="<?php echo ($playAuth['allow_play']==1 ? U('Video/play',array('vid'=>$v['id'])):U('Pay/courseConfirm',array('vid'=>$v['id']))); ?>">
                                            <i class="ico <?php echo ($playAuth['allow_play']==1?'icoPlay':'icoBuy'); ?>"></i>
                                            <span class="ti00"><?php echo ($playAuth['allow_play']==1?'播放':'购买'); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>
        </div>
    </div>
    <div class="content">
        <div class="hdTit">
            <p class="line"></p>
            <h4 class="tit">最新问答</h4>
        </div>
        <div class="askList">
            <ul id="allquestion">
                <?php if(is_array($allquestion["question"])): $i = 0; $__LIST__ = $allquestion["question"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="mt16" data-question-id="<?php echo ($val["id"]); ?>">

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
                                            <a href="javascript:;" class="cancleBtn btn" onclick="fromCancel( $(this),'.question_list','.anAreaT','.mesIcoT','show')">取消</a>
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
                                <?php if(!empty($val["is_show_more"])): ?><div data-limit-end-id="<?php echo ($val["limit_end_id"]); ?>" onclick="answer_page($(this))" style="color: #999">点击查看更多</div><?php endif; ?>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>


                <!--加载更多-->
                <?php if(!empty($allquestion["is_show_more"])): ?><div class="clickMore" style="text-align: center;margin-bottom: 0.1rem">
                        <img src="/Public/Mobile/images/loadingIco.gif" alt="">
                        <a href="<?php echo U('Study/allQuestion');?>" style="color: #ccc;">加载更多</a>
                    </div><?php endif; ?>
                    <?php if(empty($allquestion["question"])): ?><!--没有数据：-->
                    <div id="question_noData" class="noData" style="text-align: center;">
                        <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据">
                        <p>数据为空</p>
                    </div><?php endif; ?>

            </ul>
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
        </div>
    </div>
    <div class="content">
        <div class="notBanCom">
            <div class="notBan">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4 class="tit">授课方式</h4>
                </div>
                <div class="banIn">
                    <a href="javascript:;" class="tp">
                        <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="/Public/Mobile/images/home-banner04.png" alt="">
                    </a>
                </div>
            </div>
            <div class="notBan">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4 class="tit">常见问题</h4>
                </div>
                <div class="banIn">
                    <a href="javascript:;" class="tp">
                        <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="/Public/Mobile/images/home-banner05.png" alt="">
                    </a>
                </div>
            </div>
            <div class="notBan">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4 class="tit">推广技能</h4>
                </div>
                <div class="banIn">
                    <a href="javascript:;" class="tp">
                        <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="/Public/Mobile/images/home-banner06.png" alt="">
                    </a>
                </div>
            </div>
            <div class="notBan">
                <div class="hdTit">
                    <p class="line"></p>
                    <h4 class="tit">干货分享</h4>
                </div>
                <div class="banIn">
                    <a href="javascript:;" class="tp">
                        <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="/Public/Mobile/images/home-banner07.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="ewmCom">
            <ul class="ewmList">
                <li>
                    <a href="javascript:;" class="item">
                        <div class="pic">
                            <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="/Public/Mobile/images/ewpTp.jpg" alt="嗨推学院微信公众号">
                        </div>
                        <span class="ti">嗨推学院微信公众号</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="item">
                        <div class="pic">
                            <img class="lazy" src="/Public/Mobile/images/loading.gif" data-src="/Public/Mobile/images/ewpTp.jpg" alt="嗨推APP客户端下载">
                        </div>
                        <span class="ti">嗨推APP客户端下载</span>
                    </a>
                </li>
            </ul>
            <p class="copyright">Copyright©2013-2017嗨推学院在线教育学习平台版权所有</p>
        </div>
    </div>
</section>


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
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>
<script src="/Public/Mobile/js/TouchSlide.js"></script>
<script type="text/javascript">
    TouchSlide({
        slideCell:"#slideBox",
        titCell:".hd ul",
        mainCell:".bd ul",
        effect:"leftLoop",
        delayTime:400,
        interTime:3000,
        autoPage:true,
        autoPlay:true
    });
</script>
<!--questionjs-->
<script src="/Public/Mobile/js/question.js"></script>
<script>
    var _writeQuestionUrl = "<?php echo U(MODULE_NAME.'/Study/writeQuestion');?>";    //发表问题接口地址
    var _replyQuestionUrl = "<?php echo U(MODULE_NAME.'/Study/replyQuestion');?>";    //回复问题接口地址
    var _questionListPageUrl = "<?php echo U(MODULE_NAME.'/Study/questionListPage');?>";  //加载更多问题接口地址
    var _questionPageUrl = "<?php echo U(MODULE_NAME.'/Study/questionPage');?>";  //加载更多评论接口地址
    var _MEMBER = "/Public/Member";
    var _MODULE_NAME = "/<?php echo MODULE_NAME;?>";
    var _user_id = "<?php echo session(C('USER_AUTH_UID'));?>";  //当前用户id
    var _user_name = "<?php echo session(C('USER_AUTH_UNAME'));?>";  //当前用户名
    var _user_face = "/Public/Member/images/logo/<?php echo session(C('USER_FACE'));?>.png";  //当前用户头像
    var _user_group = "/Public/Member/images/user_group/<?php echo session(C('USER_GROUP_ID'));?>.png";  //当前用户组头像
    //查询出的最后一条问题的id
    <?php if(!empty($allquestion["limit_end_id"])): ?>var _last_question_id = <?php echo ($allquestion["limit_end_id"]); ?>;<?php endif; ?>

    var formActionUrl = "<?php echo U('Video/videoShoucang');?>";
    //收藏和取消视频
    $('.icoLove').click(function(e){
        var this_ = $(this);
        var vid = this_.attr('data-id');
        var Url = "<?php echo U('Login/index');?>";//登录页
        if(!_user_id){
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

</script>