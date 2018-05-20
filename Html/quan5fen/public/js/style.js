
$(document).ready(function () {
// 共用部分html
    +function () {
        //toolBar.html
        $.ajax({
            url: "../public/common/toolBar.html",
            cache: false,
            async: false,
            success: function (html) {
                $(html).insertAfter("#myToolBar");
                $("#myToolBar").remove();
            }
        });
        //header.html
        $.ajax({
            url: "../public/common/header.html",
            cache: false,
            async: false,
            success: function (html) {
                $(html).insertAfter("#myHeader");
                $("#myHeader").remove();
            }
        });
        //nav.html
        $.ajax({
            url: "../public/common/nav.html",
            cache: false,
            async: false,
            success: function (html) {
                $(html).insertAfter("#myNav");
                $("#myHeader").remove();
            }
        });
        // footer.html
        $.ajax({
            url: "../public/common/footer.html",
            cache: false,
            async: false,
            success: function (html) {
                $(html).insertAfter("#myFooter");
                $("#myFooter").remove();
            }
        });
        // myLeft.html
        $.ajax({
            url: "../public/common/myLeft.html",
            cache: false,
            async: false,
            success: function (html) {
                $(html).insertAfter("#myLeft");
                $("#myLeft").remove();
            }
        });

        // contactUs.html  左侧栏
        $.ajax({
            url: "../public/common/contantLeft.html",
            cache: false,
            async: false,
            success: function (html) {
                $(html).insertAfter("#contantLeft");
                $("#contantLeft").remove();
            }
        });


    }();

// 侧边栏Fn
    +function () {
        // 点击标题切换
        var hdTit = ".Hlist .leftTab",                   //标题栏
            hdTitNum = $(hdTit).length,                  //标题数
            li = ".Hlist ul li",                        //标题li
            s = 'cur',                                  //li经过类
            o = 'open';                              //c类 切换标题栏箭头状态，展示状态
        for(var i = 0; i<hdTitNum ;i++){
            (function () {
                var bl = true;
                $(hdTit)[i].onclick = function (e) {
                    var $e = $(this);
                    $e.parents('li').toggleClass(o);
                    bl ? $e.parents('li').removeClass(o):$e.parents('li').addClass(o) ;
                    bl = !bl;
                }
            })(i);
        }
        //鼠标经过每个dl a
        $(".Hlist dl a ").hover(function () {
            $(this).toggleClass(s);
        });
    }();

});

// orderList.html
// 公告文字滚动
function timer(opj){
    $(opj).find('ul').animate({
        marginTop : "-56px"
    },500,function(){
        $(this).css({marginTop : "0"}).find("li:first").appendTo(this);
    })
}
$(function(){
    var $gfNot = $('.gfNot'),
        num = $gfNot .find('li').length,
        speed = 3500;
    if(num > 1){
        var time=setInterval('timer(".gfNot")',speed);
        $gfNot.mousemove(function(){
            clearInterval(time);
        }).mouseout(function(){
            time = setInterval('timer(".gfNot")',speed);
        });
    }
});

// pidManage.html
+function () {
    // 设置q群，微信功能
    var setQQ ='.js-qq',
        setWx='.js-wx',
        qx = '.js-cancle',
        item = '.js-item',
        c = 'chg',
        sp = '.sp',
        arrTxt =[];
    arrTxt=['Q群专用','微信专用','设为Q群专用','设为微信专用'];
    jQuery.fn.extend({
       staus01:function () {
           var $e = $(this);
           $e.parents(item).addClass(c);
           $e.siblings(sp).hide();
       },
        staus02:function () {
            var $e = $(this);
            $e.parents(item).removeClass(c);
            $e.siblings(sp).show();
        }
    });
    for (var i = 0; i < $(item).length; i++) {
        $(setQQ).eq(i).on('click',{x:i},function (event) {
            $(this).staus01();
            $(this).html(arrTxt[0]);
        });
        $(setWx).eq(i).on('click',{x:i},function (event) {
            $(this).staus01();
            $(this).html(arrTxt[1]);
        });
        $(qx).eq(i).on('click',{x:i},function (event) {
            $(this).staus02();
            $(this).parents(item).find(setQQ).html(arrTxt[2]);
            $(this).parents(item).find(setWx).html(arrTxt[3]);
        });
    }
}();

//orderList.html
+function () {
    // 弹窗（补券，备注）
    var coupBtn ='.js-coupon',
        remarkBtn = '.js-remark',
        pop = '.myPop',
        coupPop = '#couponPop',
        remPop = '#remarksPop',
        fadeSpeed = null;
    var ua = navigator.userAgent;
    if ((ua.indexOf('compatible') > -1 && (ua.indexOf('MSIE 8') > -1 || ua.indexOf('MSIE 9') > -1))) {
        fadeSpeed = 0;
    }else {
        fadeSpeed = .3e3;
    }
    $(coupBtn).on('click',function () {
        $(coupPop).fadeIn(fadeSpeed);
    });
    $(remarkBtn).on('click',function () {
        $(remPop).fadeIn(fadeSpeed);
    });
    $(pop+' .close').on('click',function () {
       $(pop).hide();
    });
}();


$(function () {
    //toolBar.html   个人中心下拉
    $(".headMleft .personMsg").hover(function(){
        $(this).find('.login-option').show();
        $(this).find("span").css({"color":"#ff6666"});
    },function(){
        $(this).find('.login-option').hide();
        $(this).find("span").css({"color":"#666"});
    });
});


