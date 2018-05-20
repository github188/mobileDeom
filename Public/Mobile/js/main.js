/**
 * Created by Administrator on 2017/5/31.
 */
//listenCourse.html 头部滑动
$(document).ready(function () {
    /*
     1.需要进行滑动的父容器：swipeDom:指需要进行滑动的元素的父元素
     2.方向:swipeType  x/y
     3.弹簧区间 swipeDistance
     * */
    // hua.iScroll({
    //     swipeDom:document.querySelector(".com"),
    //     swipeType:"x",
    //     swipeDistance:50
    // });

//头部的点击事件  此处用click处理
    var li=$("#hUl li"),
        active="active";      //当前的li具有的类

    li.on("click",function () {
        $(this).find("a").addClass(active).parents("li").siblings().find("a").removeClass(active);
    });

//中间的选项卡切换
    var $li=$(".contHear ul li"),
        show="show",    //swipe块的显示
        cur="cur";      // 当前的li的类

    tabContolr(".contHear ul li","cur",".mianCont .swipe","show");
});
// 笔记中修改按钮出现的回复框
function xiugai(obj,active) {
    $.each(obj,function (i,value) {
        var father=obj.parents(".noteItem"),
            p=father.find(".pp"),
            textarea=father.find("textarea"),
            msgFoot=father.find(".noteFoot");
        if(father.hasClass(active)){
            father.removeClass("active");
            p.html(textarea.val());
            msgFoot.show();
            p.show();
        }else{
            father.addClass(active);
            textarea.val(p.text());
            p.hide();
            msgFoot.hide();
        }
        return false;
    });
}

//笔记块  用户点击取消按钮
function cancleBtn(obj,active) {
    $.each(obj,function (i, value) {
        var myfa=obj.parents(".noteItem"),       //当前的父元素
            myp=myfa.find(".pp"),                   //当前父元素下的p
            mynoteFoot=myfa.find(".noteFoot");   //当前的底部

        if(myfa.hasClass(active)){
            myfa.removeClass(active);
            myp.show();
            myp.html();
            mynoteFoot.show();
            return false;
        }
    });
}

//笔记用户点击确认按钮
function subBtn(obj,active) {
    $.each(obj,function (i, value) {
        var myfa=obj.parents(".noteItem"),           //当前的父元素
            myp=myfa.find(".pp"),                     //当前父元素下的p
            mytextarea=myfa.find("textarea"),        //当前元素的textarea
            mynoteFoot=myfa.find(".noteFoot"),       //当前的底部
            dataNoteid=myfa.attr("data-noteid"),    // note_id的值
            content=mytextarea.val();                 //textarea中的值
        var aaa=editNote(dataNoteid,content);
        if(aaa){
            if(myfa.hasClass(active)){
                myfa.removeClass(active);
                myp.html(mytextarea.val());
                myp.show();
                mynoteFoot.show();
                return false;
            }
        }else{
            layer.open({
                content:"修改失败了喔"
                ,skin: 'msg'
                ,time: 2
            });
        }
    });
}

// 笔记块确认删除
function subDel(obj) {
    layer.open({
        content: '您确认删除吗？'
        ,btn: ['确定', '不要']
        ,yes: function(index){
            $.each(obj,function (i, value) {
               var id1=obj.parents(".noteItem").attr("data-noteid");       //id值
                console.log(id1);
                var result=deleteNote(id1);

                if(result){
                    $('#' + id1).remove();
                    layer.open({
                        content:"删除成功"
                        ,skin: 'msg'
                        ,time: 2
                    });
                }else{
                    layer.open({
                        content:"删除失败"
                        ,skin: 'msg'
                        ,time: 2
                    });
                }
            });
            layer.close(index);
        }
    });
}

//笔记块 点击修改按钮，弹出遮罩层
function deletea(obj,delBoxAni) {
    $.each(obj,function (i, value) {
       $("#Hmask").show().find(".maskDel").addClass(delBoxAni);
        var fatherId=obj.parents(".noteItem").attr("data-noteid");      //拿到父级元素的id
        $("#Hmask").find(".Hsubmit").attr("data-noteid",fatherId);           //给确认按钮赋值
    });
}

/*------------------------- learn.html ------------------------*/
$(document).ready(function () {
    var $li=$(".learnTab ul li"),
        show="show",    //swipe块的显示
        cur="cur";      // 当前的li的类

    $li.on("click",function(event){
        $(".learnTab ul li").eq($(this).index()).addClass("cur").siblings().removeClass('cur');
        $(".Hlearn .questionMain").eq($(".learnTab ul li").index(this)).addClass("show").siblings().removeClass('show');
    });

//笔记修改  删除块
    (function () {
        //回复框
        var deletea=$(".noteItem .fr .delete");
        dLength=deletea.length;
        Hmask=$(".Hmask");

        //取消删除
        $(".Hcancel").on("click",function () {
            $(this).parents(".Hmask").hide();
        });
        })();
});

//video.html
$(document).ready(function () {
    //点击收藏小心心
    var $heart=$("i.icon-shoucang");
    $heart.on("click",function () {
        if($(this).hasClass("icon-shoucang")){
            $(this).removeClass("icon-shoucang").addClass("icon-icon-sel-shixin");
            return false;
        }else{
            $(this).removeClass("icon-icon-sel-shixin").addClass("icon-shoucang");
            return false;
        }
    });
});

//buyVideo.html
$(document).ready(function () {
   var pp=$(".classify .firstP"),              //要点击的对象
       $videoMsg=$(".classify .videoMsg"),      //视频分类信息
       iconTop="icon-icon-back-copy",        //默认向上的箭头
       iconDowm="icon-icon-back-copy-copy";   //向下的箭头
    pp.on("click",function () {
       var $i=$(this).find("i");
       if($i.hasClass(iconTop)){
           $i.removeClass(iconTop).addClass(iconDowm);
           $videoMsg.show();
           return false;
       }else{
           $i.removeClass(iconDowm).addClass(iconTop);
           $videoMsg.hide();
           return false;
       }
    });

    //视频分类下拉中的点击事件
     var li=$(".videoMsg li"),     //拿到点击的每一个li
         cur="cur";                //当前li具有的颜色
    li.on("click",function () {
         $(this).addClass(cur).siblings().removeClass(cur);
    });
});

/* index.html */
$(document).ready(function() {
    //首页中的轮播图
    function bannerAnimation() {
        //首页中的轮播图
        var banner=$(".banner"),
            banWidth=banner.width(),     //大盒子的宽度
            dotUl=$(".banner .dotUl"),
            index=0;                     //标识一个索引
        //让图片自动轮播
         var setTime =setInterval(function() {
                (index < 4) ? (index++) : (index = 0);
                $(".dotUl li").eq(index).addClass("now").siblings().removeClass("now");
                $(".imgUl img").eq(index).show().parents("li").siblings().find("img").hide();
            }, 4000);
    };
    bannerAnimation();

    //热门视频中的轮播图
    (function () {
        var $left=$(".Harr .icon-icon-back-left"),      //左边的箭头
            $right=$(".Harr .icon-icon-back-right");    //右边的箭头
            $ul=$(".listVideo .NEW ul"),               //ul块
            $li=$(".NEW ul li"),                      //ul中的li
            lenght=$li.size(),                       //li的长度
            width=$li.width(),                      //每个li的宽度
            index=0;                                //定义一个索引
        $ul.css({width:width*lenght});
        //用户点击右边按钮
        function moveR(){
            if (index < lenght - 2) {
                index++;
            }
          $ul.animate({ left:-(width * index)+'px' });
          return false;
        }
       //用户点击右边的按钮
        $right.on("click",function () {
            moveR();
        });
        //用户点击左边的按钮
        function moveL() {
            if(index>0){
                index--;
            }
           $ul.animate({left:-(width * index)+'px'});
        };
      //用户点击左边按钮
        $left.on("click",function () {
            moveL();
        });
    })();
});

/* 选项卡切换  obj1是tab的头部，style1是当前头部某个元素选中后的样式；obj2是主体内容，style2是控制当前内容显示的类     */
function tabContolr(obj1,style1,obj2,style2) {
    $(obj1).on("click",function () {
        $(obj1).eq($(this).index()).addClass(style1).siblings().removeClass(style1);
        $(obj2).eq($(obj1).index(this)).addClass(style2).siblings().removeClass(style2);
    })
};

$(document).ready(function () {
    /* commonQuestion.html */
    tabContolr(".contHear ul li","cur",".mianCont .comQuestion","Hshow");

    /* guangfang.html */
    tabContolr(".contHear ul li","cur",".mianCont .company","Hshow");

    /* student.html */
    tabContolr(".HcontHeard ul li","cur",".mianCont .matter","show");
    /*-----------------------------------------------------------------------------------*/
    var $more=$(".video .more"),            //点击更多
        down="icon-xiala",                //向下
        up="icon-icon-back-copy",       //向上
        show="show";

    $more.on("click",function () {
       var $detail=$(this).parents(".stuVideo").find(".detail"),
           icon=$(this).find("i");
       if($detail.hasClass(show)){
           $detail.removeClass(show);
           icon.removeClass(up).addClass(down);
       }else{
           $detail.addClass(show).parents(".stuVideo").siblings("").find(".detail").removeClass(show);
           icon.removeClass(down).addClass(up);
       }
    });

   /*-------------------------------------  学员介绍  ------------------------------------------------*/
     var introduction=$(".mianCont .introduction"),                //学员介绍块
         $txt02=introduction.find("ul li").find(".txt02"),      //用户点击的文字
         hover="hover";
     $txt02.on("click",function () {
        var $Li=$(this).parents("li");
        if($Li.hasClass(hover)){
           $Li.removeClass(hover);
        }else{
           $Li.addClass(hover);
        }
    });
});


