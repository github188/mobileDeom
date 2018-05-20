
// 实例化layer对象
var _layerObj;
var _layeditObj;
var _indexObj;
layui.use('layer', function () {
    _layerObj = layer;
})


/**
 * 点击收藏问答
 * @param thisObj 当前对象
 * @param question_id  问答id
 * Created by 雷方明 on 2017/6/7.
 */
function shoucang(thisObj, question_id, is_remove) {
    var url = "/Member/Study/shouCang";
    var u = thisObj.find('em.videoEms').hasClass("active");
    var type = u == false ? 0 : 1;  //0表示收藏  1表示取消
    $.ajax({
        type:"post",
        url:url,
        data:{"type":type, 'question_id':question_id},
        dataType:"json",
        success:function (json) {
            if (json.code == 1){
                if (type == 0){
                    _layerObj.msg('收藏成功！');
                    thisObj.find('em.videoEms').addClass("active");
                    thisObj.find("i").html('取消');
                }else{
                    _layerObj.msg('已取消收藏！');
                    thisObj.find('em.videoEms').removeClass("active");
                    thisObj.find("i").html('收藏');
                    if(is_remove){
                        thisObj.parents('li').slideUp();
                    }
                }
            }else{
                _layerObj.msg('操作失败！');
            }
        }
    })
}


/**
 * 点击回复按钮显示编辑器
 * Created by 雷方明 on 2017/6/7.
 */
function createBox(thisObj){
    // 用于实例化编辑器的id
    var id = thisObj.parents('.txt').find('textarea').attr('id');

    //创建富文本编辑器
    layui.use('layedit', function(){
        _layeditObj = layui.layedit;
        _indexObj   = _layeditObj.build(id, { tool: ['face'],height: 100});

        // 隐藏其他编辑框
        if(thisObj.hasClass('mesIcoBs')){
            var currentObJ = thisObj.parents('.txt').find('.anAreaB');
            currentObJ.toggle(); //当前隐藏显示
            $('.anAreaB').not(currentObJ).hide(); //所有内层其余的隐藏
            // 所有外层其余的隐藏
            $('.anAreaT').hide();
        }else{
            var currentObJ = thisObj.parents('.txt').find('.anAreaT');
            currentObJ.toggle();
            $('.anAreaT').not(currentObJ).hide(); //所有内层其余的隐藏
            $('.anAreaB').hide(); //所有内层其余的隐藏

        }

    })
}


/**
 * 问答回复提交
 * @param obj 当前点击对象
 * @param uid 回复那条问答的uid
 * @param login_user_id  当前登录用户id
 */

function replyMssage(thisObj, uid, login_user_id) {

    var answer      = _layeditObj.getContent(_indexObj);
    var question_id = thisObj.attr('data-question-id');
    var answer_id   = thisObj.attr('data-answer-id');
    var url         = "/Member/Study/replyQuestion";
    if(!question_id){
        _layerObj.msg('question_id为空');
        return false;
    }

    if (isEmpty(answer) === false){
        _layerObj.msg('请输入回复内容！');return;
    }

    $.ajax({
        type: "POST",
        url: url,
        data: {question_id:question_id, answer_id:answer_id,answer:answer},
        dataType: "json",
        success: function(jsondata){

            if (jsondata.code == 1) {
                var data = jsondata.userdata;
                _layerObj.msg('回复成功！');

                var str_html = '<div data-status="1" data-last-answer-id="'+data.answer_id+'" class="item itemX"><div class="tp"><a href="javascript:;"><img src="/Public/Member/images/logo/'+data.face+'.png" alt="">';
                str_html += '</a></div><div class="txt"><div class="txIn txInB"><div class="tHd">';

                if(!data.reply_user_id){
                    str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+data.user_group_id+'.png">';
                    str_html += '<span class="name">'+data.username+'：</span><span class="ask">'+answer+'</span>';
                }else{
                    //二级回复
                    str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+data.user_group_id+'.png" alt="">';
                    str_html += '<span class="name">'+data.username+'：回复#<img style="display: inline-block" src="/Public/Member/images/user_group/'+data.reply_user_group_id+'.png" alt="">';
                    str_html += data.reply_username+'：</span><span class="ask">'+answer+'</span>';
                }

                str_html += '</div><div class="hand"><span class="time">'+data.addtime+'</span>';
                // str_html += '<a onclick="replyMssage($(this),'+data.id+','+login_user_id+')" class="mesIco mesIcoBs"><i></i></a>';
                str_html += '</div></div><div class="anArea anAreaB"><form action="" method="post"><textarea id="e'+data.answer_id+'" class="answer" placeholder=""></textarea><div class="bot">';
                str_html += '<a href="javascript:;" class="cancleBtn cancel">取消</a>';
                str_html += '<a style="background-color: #0b97c4; color: #fff;" data-question-id="'+question_id+'" data-answer-id="'+data.answer_id+'" onclick="replyMssage($(this),'+data.user_id+', '+login_user_id+')">提交</a>';
                str_html += '</div></form></div></div></div>';

                var a = thisObj.parents('.question_list').children('a');
                if(a.length > 0){
                    a.before(str_html);
                }else{
                    thisObj.parents('.question_list').append(str_html);
                }
                // obj.parents('.question_list').children('a').before(str_html);
                var count = thisObj.parents('.question_list').find('.reply_count').text();
                count = parseInt(count) + 1;
                thisObj.parents('.question_list').find('.reply_count').text(count);

                //                输入框隐藏
                $('.cancel').click();
            }else{
                _layerObj.msg(jsondata.msg);
            }
        },
        error:function(){
            _layerObj.msg('网络繁忙，请稍后重试');
        }
    });
}


/**
 * 回复内容里的查看更多
 * @param thisObj  当前点击对象
 * @param question_id 问答id
 * @param login_user_id  当前登录用户id
 */
function answer_page(thisObj, question_id, login_user_id) {
    var url = "/Member/Study/questionPage";
    var last_answer_id = thisObj.parents('.question_list').attr('data-last-answer-id');
    var limit_end_id = thisObj.attr('data-limit-end-id');
    if (!limit_end_id){
        _layerObj.msg('limit_end_id为空！');return;
    }

    $.ajax({
        type: "get",
        url: url,
        data: {question_id: question_id, limit_end_id: limit_end_id},
        dataType: "json",
        success: function (json) {
            if (json.code == 1) {
                var data = json.data.answerList;
                var str_html = '';
                $.each(data, function (k,v) {
                    var str_html = '<div data-last-answer-id="'+v.id+'" class="item itemX"><div class="tp"><a href="javascript:;"><img src="/Public/Member/images/logo/'+v.face+'.png" alt="">';
                    str_html += '</a></div><div class="txt"><div class="txIn txInB"><div class="tHd">';

                    if(v.reply_user_id == 0){
                        str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+v.user_group_id+'.png">';
                        str_html += '<span class="name">'+v.username+'：</span><span class="ask">'+v.answer+'</span>';
                    }else{
                        //二级回复
                        str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+v.user_group_id+'.png" alt="">';
                        str_html += '<span class="name">'+v.username+'：回复#<img style="display: inline-block" src="/Public/Member/images/user_group/'+v.reply_user_group_id+'.png" alt="">';
                        str_html += v.reply_username+'：</span><span class="ask">'+v.answer+'</span>';
                    }

                    str_html += '</div><div class="hand"><span class="time">'+v.addtime+'</span>';
                    if(login_user_id != v.user_id){
                        str_html += '<a iid="'+v.id+'" onclick="createBox($(this))" class="mesIco mesIcoBs"><i></i></a>';
                    }

                    str_html += '</div></div><div class="anArea anAreaB"><form action="" method="post"><textarea id="e'+v.id+'" class="answer" placeholder=""></textarea><div class="bot">';
                    str_html += '<a href="javascript:;" class="cancleBtn cancel">取消</a>';
                    str_html += '<a style="background-color: #0b97c4; color: #fff;" data-question-id="'+question_id+'" data-answer-id="'+v.id+'" onclick="replyMssage($(this),'+v.user_id+', '+login_user_id+')">提交</a>';
                    str_html += '</div></form></div></div></div>';

                    thisObj.before(str_html);

                })
                if(!json.data.is_show_more){
                    thisObj.hide();
                }else{
                    thisObj.attr('data-limit-end-id', json.data.limit_end_id);
                }

                // 更新last-answer-id
                thisObj.parents('.question_list').attr('data-last-answer-id', json.data.limit_end_id);
            }else{
                thisObj.html(json.msg).attr('disabled','disabled');
            }
        }
    })



}


/**
 * 问答内容的查看更多
 * @param thisObj  当前点击对象
 * @param login_user_id  当前登录用户id
 */
function question_page(thisObj, login_user_id) {
    var url = "/Member/Study/questionListPage";
    var last_question_id = $('#questionlist').attr('data-last-question-id');
    var last_limit_id = thisObj.attr('data-last-limit-id');
    var is_shoucang = thisObj.attr('data-is-shoucang');
    if (!last_limit_id){
        _layerObj.msg('last_limit_id为空！');return;
    }

    $.ajax({
        type: "get",
        url: url,
        data: {"last_limit_id":last_limit_id, 'is_shoucang':is_shoucang},
        dataType: "json",
        success: function (json) {
            if (json.code == 1) {
                var data = json.data.question;
                var str_html = '';

                $.each(data, function (k,val) {

                    str_html += '<li data-last-question-id="'+val.id+'">';
                    str_html += '<div data-last-answer-id="'+val.limit_end_id+'" class="item question_list">';
                    str_html += '<div class="tp">';
                    str_html += '<a href="javascript:;"><img src="/Public/Member/images/logo/'+val.face+'.png" alt=""></a>';
                    str_html += '</div><div class="txt"><div class="txIn"><div class="tHd">';
                    str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+val.user_group_id+'.png" alt="">';
                    str_html += '<span class="name">'+val.username+'</span>';
                    str_html += '</div><p class="wz">'+val.question+'</p><p class="from"><span><em>来源：</em>';
                    str_html += '<a href="/Member/Video/showList/category/'+val.category_id+'">'+val.category_name+'/</a><a href="/Member/Video/play/vid/'+val.vid+'">'+val.video_name+'</a>';
                    str_html += '</span></p>';
                    str_html += '<div class="hand handLi clearfix">';
                    str_html += '<span class="time">'+val.addtime+'</span>';
                    if(val.is_shoucang){
                        str_html += '<span class="sc1 fr ml110" onclick="shoucang($(this), '+val.id+')"><em class="videoEms active"></em><i class="fonts14"><i>取消</i></i></span>';
                    }else{
                        str_html += '<span class="sc1 fr ml110" onclick="shoucang($(this), '+val.id+')"><em class="videoEms"></em><i class="fonts14"><i>收藏</i></i></span>';
                    }

                    str_html += '<a onclick="createBox($(this))" class="mesIco mesIcoT"><i></i>(<span class="reply_count">'+val.count+'</span>)</a>';


                    str_html += '</div>';
                    str_html += '</div>';
                    str_html += '<div class="anArea anAreaT">';
                    str_html += '<form action="" method="post">';
                    str_html += '<textarea placeholder="" id="q'+val.id+'"></textarea>';
                    str_html += '<div class="bot">';
                    str_html += '<a href="javascript:;" class="cancleBtn cancel">取消</a>';
                    str_html += '<a data-question-id="'+val.id+'" onclick="replyMssage($(this),'+val.user_id+', '+login_user_id+')" style="background-color: #0b97c4; color: #fff;">提交</a>';
                    str_html += '</div>';
                    str_html += '</form>';
                    str_html += '</div>';
                    str_html += '</div>';

                    if (val.answer){
                        $.each(val.answer, function (kk,v) {
                            str_html += '<div data-last-answer-id="'+v.id+'" class="item itemX"><div class="tp"><a href="javascript:;"><img src="/Public/Member/images/logo/'+v.face+'.png" alt="">';
                            str_html += '</a></div><div class="txt"><div class="txIn txInB"><div class="tHd">';

                            if(v.reply_user_id == 0){
                                str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+v.user_group_id+'.png">';
                                str_html += '<span class="name">'+v.username+'：</span><span class="ask">'+v.answer+'</span>';
                            }else{
                                //二级回复
                                str_html += '<img style="display: inline-block" src="/Public/Member/images/user_group/'+v.user_group_id+'.png" alt="">';
                                str_html += '<span class="name">'+v.username+'：回复#<img style="display: inline-block" src="/Public/Member/images/user_group/'+v.reply_user_group_id+'.png" alt="">';
                                str_html += v.reply_username+'：</span><span class="ask">'+v.answer+'</span>';
                            }

                            str_html += '</div><div class="hand"><span class="time">'+v.addtime+'</span>';
                            if (login_user_id != v.user_id){
                                str_html += '<a onclick="createBox($(this))" class="mesIco mesIcoBs"><i></i></a>';
                            }

                            str_html += '</div></div><div class="anArea anAreaB"><form action="" method="post"><textarea id="e'+v.id+'" class="answer" placeholder=""></textarea><div class="bot">';
                            str_html += '<a href="javascript:;" class="cancleBtn cancel">取消</a>';
                            str_html += '<a style="background-color: #0b97c4; color: #fff;" data-question-id="'+val.id+'" data-answer-id="'+v.id+'" onclick="replyMssage($(this),'+v.user_id+', '+login_user_id+')">提交</a>';
                            str_html += '</div></form></div></div></div>';
                        })
                        if(val.is_show_more){
                            str_html += '<a data-limit-end-id="'+val.limit_end_id+'" onclick="answer_page($(this),'+ val.id +','+login_user_id+')" style="display:block; text-align: left; margin-left: 80px; margin-top:25px;cursor:pointer;color: rgba(102, 102, 102, 0.65);"> 查看更多</a>';
                        }
                    }

                    str_html += '</div></li>';
                })

                thisObj.parent().before(str_html);

                if(!json.data.is_show_more){
                    thisObj.hide();
                }else{
                    thisObj.attr('data-last-limit-id', json.data.limit_end_id);
                }

            }else{
                thisObj.html(json.msg).attr('disabled','disabled');
            }
        }
    })
}


// 点击输入框的取消按钮，隐藏输入框
$('.newsAsk').on('click','.cancel',function () {
    $(this).parents('.anAreaB,.anAreaT').hide();

});



//    笔记
var __note_id = '';//笔记id

//        点击修改，
function editNote(obj, id) {

    //富文本编辑器
    layui.use('layedit', function(){
        var layedit = layui.layedit;
        var index = layedit.build(id, {
            hideTool: ['image'],
            height: 180
        });

        $.each(obj,function (i,value) {
            //   console.log(obj);
            var father=obj.parents("li"),
                p=father.find("div.fonts16"),
                textarea=father.find("textarea"),
                msgFoot=father.find(".msgFoot");

            if(father.hasClass("active")){
                father.removeClass("active");
                p.html(textarea.val());

                msgFoot.show();
                p.show();

            }else{
                father.addClass("active");
                textarea.val(p.text());
                // 将原来内容添加到编辑器
                var __OldContentObj = obj.parents('.Hpd').find('div.fonts16').html();
                layedit.setContent(index,__OldContentObj);

                p.hide();
                msgFoot.hide();
            }
            return false;
        });


        //点击提交
        $('.HsubBtn').unbind('click').click(function () {
            var thisObj = $(this);
            var note_id = thisObj.attr('data-note-id');
            var content = layedit.getContent(index);          //拿到编辑框中的内容
            var contentP = thisObj.parents("li").find('div.fonts16');

            if (!note_id){
                layer.msg('笔记id不能为空！');return;
            }

            if (isEmpty(content) === false){
                layer.msg('输入内容不能为空！');return;
            }
            $.ajax({
                type:'post',
                url: '/Member/Study/editNote',
                data:{'note_id':note_id, 'content':content},
                dataType:'json',
                success:function (obj) {
                    if (obj.code == 1){
                        layer.msg('修改成功！');
                        //  隐藏输入框
                        $('.HcancleBtn').click();

                        //   填充新内容

                        thisObj.parents('.Hpd').find('.msgFoot').show();
                        contentP.html(content);

                    }else{
                        layer.msg(obj.msg);
                    }
                }
            })
        })
    });
}

//点击删除的时候记录下当前操作节点的note_id
$('#notelist').on('click','.delete',function () {
    __note_id = $(this).attr('data-note-id');
    layui.use('layer', function(){
        layer.confirm('您确定要删除吗？', {icon: 3, title:'提示信息'}, function(index){
            layer.close(index);
            // 执行删除方法
            Hsubmit();
        });
    })



})

//删除笔记
function Hsubmit(){
    $.ajax({
        type:'post',
        url: '/Member/Study/deleteNote',
        data:{'note_id':__note_id},
        dataType:'json',
        success:function (obj) {

            if (obj.code == 1){
                layui.use('layedit', function(){
                    layer.msg('删除成功！');
                    $('#note'+__note_id).slideUp();
                })
            }else{
                layui.use('layedit', function(){
                    layer.msg(obj.msg);
                })
            }
        }
    })
}


// 查看更多（外层）
function note_page(obj, login_user_id) {
    var url = "/Member/Study/notePage";
    var last_note_id = obj.parent().prev().children('ul').attr('data-last-note-id');
    var vid = $('#vid').val();
    if (!last_note_id){
        _layerObj.msg('last_note_id为空！');return;
    }

    $.ajax({
        type: "get",
        url: url,
        data: {"last_note_id": last_note_id, "vid":vid},
        dataType: "json",
        success: function (json) {
            if (json.code == 1) {
                var data = json.data.noteList;
                var str_html = '';

                $.each(data, function (k,val) {
                    str_html += '<li class="Hpd clearfix">';
                    str_html += '<div class="fonts16 ft16Color" flag="true" style="display: block;">'+val.content+'</div>';
                    str_html += '<div class="source">来源: <a href="/Member/Video/showList/category/'+val.category_id+'" class="sorC">'+val.category_name+'</a>/ ';
                    str_html += '<a class="sorC" href="/Member/Video/play/vid/{$val.vid}">'+val.video_name+'</a></div>';
                    str_html += '<div class="anArea mt0 bgColor">';
                    str_html += '<form action="" method="post" class="nice-validator n-simple" novalidate="novalidate">';
                    str_html += '<textarea placeholder="" id="demo'+val.id+'" class="pl15 pt15"></textarea>';
                    str_html += '<div class="bot mt20 mr42 mb25">';
                    str_html += '<a onclick="quxiao($(this))" class="HcancleBtn subBtn1">取消</a>';
                    str_html += '<a data-note-id="'+val.id+'" class="HsubBtn subBtn1">提交</a>';
                    str_html += '</div>';
                    str_html += '</form>';
                    str_html += '</div>';

                    str_html += '<div class="msgFoot clearfix" style="display: block;">';
                    str_html += '<div class="timeL fl mb25 fonts14 mt10">'+val.addtime+'</div>';
                    str_html += '<div class="fr mb25 fonts15">';
                    str_html += '<span class="mr25 revise bb" flag="true" onclick="editNote($(this), \'demo'+val.id+'\')"><i class="iconfont icon-bianxie iconNote"></i>修改</span>';
                    str_html += '<span class="mr25 delete" data-note-id="'+val.id+'"><i class="iconfont icon-del iconNote"></i>删除</span>';
                    str_html += '<span class="HpdSpan"><i class="iconfont icon-shipin-copy"></i> <i class="Htime">'+val.playtime+'</i></span>';
                    str_html += '</div>';
                    str_html += '</div>';
                    str_html += '</li>';
                })

                obj.parent().prev().find('ul').append(str_html);
                if(!json.is_show_more){
                    obj.hide();
                }

            }else{
                obj.html(json.msg).attr('disabled','disabled');
            }
        }
    })
}


//取消操作.
function quxiao(obj) {
      var father=obj.parents("li"),                //当前父元素li
          $p=father.find("div.fonts16"),          //当前父元素li下的
          $msgFoot=father.find(".msgFoot");      //当前父元素li下的底部

        if(father.hasClass("active")){
           father.removeClass("active");
           $p.show();
           $p.html();
           $msgFoot.show();
       }

    // obj.parents('.anArea').hide();
    // obj.parents('.Hpd').find('.msgFoot').show();
}


// 判断输入是否为空
function isEmpty(content){

    content = content.replace(/&nbsp;/ig, "");  //将所有空格替换为空字符串
    content = $.trim(content);  //去除首尾空格
    if(content.length > 0){
        return true;
    }else{
        return true;
    }
}