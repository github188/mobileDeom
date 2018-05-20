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
<link rel="stylesheet" href="/Public/Mobile/css/main.css">

<style>
    body{background-color: #fff;}
    .clickMore{
        margin-top: 0.2rem;
        text-align: center;
        color: #999999;
    }
</style>
<!--myNotes-->
<section class="myNotes">
    <div class="in">
        <div class="notes">
            <ul id="noteMain">

                <?php if(is_array($noteList["noteList"])): $i = 0; $__LIST__ = $noteList["noteList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li id="<?php echo ($val["id"]); ?>" class="noteItem" data-noteid=<?php echo ($val["id"]); ?>>
                    <div class="item">
                        <div class="tit">
                            <p class="wz js-wz"><?php echo ($val["content"]); ?></p>
                        </div>
                        <div class="originate">
                            <span>来源：</span>
                            <a href="<?php echo U('Video/play', array('category_id' => $val['category_id']));?>" class="link"><?php echo ($val["category_name"]); ?></a>/
                            <a href="<?php echo U('Video/play', array('vid' => $val['vid']));?>" class="link"><?php echo ($val["video_name"]); ?></a>
                        </div>
                        <div class="bot">
                            <span class="fl date"><?php echo ($val["addtime"]); ?></span>
                            <div class="fr han">
                                <span class="chg">
                                    <i class="ico"></i><em class="ti js-chg">修改</em>
                                </span>
                                <span class="del">
                                    <i class="ico"></i><em class="ti js-del">删除</em>
                                </span>
                                <a href="<?php echo U('Video/play',array('vid'=>$val['vid']));?>" class="time">
                                    <i class="ico"></i>
                                    <em class="num"><?php echo ($val["playtime"]); ?></em>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="txtArea js-txtArea">
                        <textarea  class="area js-area"></textarea>
                        <div class="btns">
                            <a href="javascript:;" class="btn canBtn js-canBtn">取消</a>
                            <a href="javascript:;" class="btn subBtn js-subBtn">提交</a>
                        </div>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>

                <!--加载更多-->
                <?php if(!empty($noteList["is_show_more"])): ?><div onclick="myNotePage($(this))" class="clickMore" style="text-align: center;margin-bottom: 0.1rem">
                        <img src="/Public/Mobile/images/loadingIco.gif" alt="">
                        <a href="javascript:;" style="color: #ccc;">加载更多</a>
                    </div><?php endif; ?>

                <?php if(empty($noteList["noteList"])): ?><!--没有数据：-->
                    <div id="note_noData" class="noData" style="text-align: center;">
                        <img style="margin: 0 auto;" src="/Public/Member/images/errorTp.png" alt="没有数据"  width="" height="">
                        <p>数据为空</p>
                    </div><?php endif; ?>
            </ul>
        </div>
    </div>
</section>


<!--笔记加载更多模板-->

<li style="display: none" id="note_templates" class="noteItem" data-noteid="笔记id">
    <div class="item">
        <div class="tit">
            <p class="wz js-wz q_content">笔记内容</p>
        </div>
        <div class="originate">
            <span>来源：</span>
            <a href="视频分类url" class="link category_name">分类名</a>/
            <a href="视频播放url" class="link video_name">视频名</a>
        </div>
        <div class="bot">
            <span class="fl date q_addtime">添加时间</span>
            <div class="fr han">
                                <span class="chg">
                                    <i class="ico"></i><em class="ti js-chg">修改</em>
                                </span>
                <span class="del">
                                    <i class="ico"></i><em class="ti js-del">删除</em>
                                </span>
                <a href="视频播放链接" class="time">
                    <i class="ico"></i>
                    <em class="num q_playtime">播放时长</em>
                </a>
            </div>
        </div>
    </div>
    <div class="txtArea js-txtArea">
        <textarea class="area js-area"></textarea>
        <div class="btns">
            <a href="javascript:;" class="btn canBtn js-canBtn">取消</a>
            <a href="javascript:;" class="btn subBtn js-subBtn">提交</a>
        </div>
    </div>
</li>

<!--模板HTML END-->



<script src="/Public/Mobile/js/zepto_plus.js"></script>
<script src="/Public/Mobile/js/base.js"></script>


<!--提示插件-->
<script src="/Public/Mobile/pugins/layer-mobile-2.0/layer.js"></script>

<!--笔记相关js-->
<script src="/Public/Mobile/js/note.js"></script>


<script>

    //查询出的最后一条笔记的id 用于分页
    <?php if(!empty($noteList["limit_end_id"])): ?>var _last_note_id = <?php echo ($noteList["limit_end_id"]); ?>;<?php endif; ?>

    var _writeNoteUrl = "<?php echo U(MODULE_NAME.'/Study/writeNote');?>";    //发表笔记接口地址
    var _editNoteUrl = "<?php echo U(MODULE_NAME.'/Study/editNote');?>";    //修改笔记接口地址
    var _deleteNoteUrl = "<?php echo U(MODULE_NAME.'/Study/deleteNote');?>";  //删除笔记接口地址
    var _notePageUrl = "<?php echo U(MODULE_NAME.'/Study/notePage');?>";  //加载更多笔记接口地址
    var _videoCategoryUrl = "<?php echo U(MODULE_NAME.'/Video/showlist','',false);?>";  //视频分类url地址
    var _videoPlayUrl = "<?php echo U(MODULE_NAME.'/Video/play','',false);?>";  //视频播放url地址
    var _vid = 0;


    // 笔记点击加载更多
    function myNotePage(thisObj) {
        $.ajax({
            type:'get',
            url: _notePageUrl,
            data:{'last_note_id':_last_note_id, 'vid':_vid},
            dataType:'json',
            success:function (json) {
                if (json.status == 1){
                    var note_templates = $('#note_templates').clone();
                    var html = '';
                    $.each(json.data.noteList, function (k,val) {
                        var note_templates2 = note_templates;

                        note_templates2.css('display','block');
                        note_templates2.removeAttr('id');
                        note_templates2.attr('data-noteid', val.id);
                        note_templates2.find('.q_content').html(val.content);
                        note_templates2.find('.category_name').text(val.category_name);
                        note_templates2.find('.category_name').attr("href",_videoCategoryUrl+'/category/'+val.category_id);
                        note_templates2.find('.video_name').text(val.video_name);
                        note_templates2.find('.video_name').attr("href",_videoPlayUrl +'/vid/'+ val.vid);
                        note_templates2.find('.q_playtime').html(val.playtime);
                        note_templates2.find('.q_addtime').html(val.addtime);

                        html += note_templates2.prop("outerHTML");

                    })

                    thisObj.before(html);
                    _last_note_id = json.data.limit_end_id;
                }else{
                    thisObj.text(json.msg);
                }
            }
        })
    }

//    删除笔记
    $('#noteMain').on('click','.del',function () {

        var $e = $(this),
            $eLi =$e.parents('li');

        layer.open({
            content: '您确认删除吗？'
            ,btn: ['确定', '不要']
            ,yes: function(index){
                var dataNoteid = $eLi.attr("data-noteid");

            //      发送请求
                var is_success=deleteNote(dataNoteid);
                if (is_success === true){
                    showMsg('删除成功');
                    $eLi.remove();
                }else{
                    showMsg('删除失败,请刷新后重试！');
                }
                layer.close(index);
            }
        });

//        if(confirm("确认删除吗？") === false){
//            return;
//        };
    });


//    修改笔记
    $('#noteMain').on('click','.chg',function () {
        var $e = $(this),
            //笔记编辑
            wzs = '.js-wz',
            txtAreas = '.js-txtArea',
            areas ='.js-area',
            $eLi =$e.parents('li');

        $(txtAreas).hide();
        $eLi.find(txtAreas).show();
        var theTxt = $eLi.find(wzs).text();
        $eLi.find(areas).val(theTxt);
    })

    //点击确认按钮
    $('#noteMain').on('click','.js-subBtn',function () {
        var $e = $(this),
            txtAreas = '.js-txtArea',
            areas ='.js-area',
            wzs = '.js-wz',
            $eLi =$e.parents('li');
        var dataNoteid = $eLi.attr("data-noteid");
        var content = $eLi.find("textarea").val();

//                  发送请求
        var is_success=editNote(dataNoteid,content);
        if (is_success === true){
            showMsg('修改成功');
            $eLi.find(txtAreas).hide();
            var txVal =$eLi.find(areas).val();
            $eLi.find(wzs).text(txVal);
        }else{
            showMsg('修改失败,请刷新后重试！');
        }
    })

//    点击取消
    $('#noteMain').on('click','.js-canBtn',function () {
        var $e = $(this),
            txtAreas = '.js-txtArea',
            $eLi =$e.parents('li');
        $eLi.find(txtAreas).hide();
    })
</script>

</body>
</html>