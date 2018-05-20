/**
 * Created by Administrator on 2017/5/22.
 */
//左侧下拉
$(document).ready(function () {
    +function () {
        var  $li=$(".Hlist li .leftTab"),    //当前点击的li的a
            a="active" ,          //有active存在的时候则dl为打开状态
            b="icon-xiala-c-tio-copy";     //向上的箭头

        $li.on("click",function () {
            if( $(this).siblings("dl").hasClass(a) ){
                $(this).siblings("dl").removeClass(a);
                $(this).find("i").addClass(b);
            }else{
                $(this).siblings("dl").addClass(a);
                $(this).find("i").removeClass(b);
            }
        })
    }();

    //单选框按钮
    $(".Hradio input[type='radio']").click(function() {
        $(this).siblings("div").children("span").addClass("active");
        $(this).parents("div").siblings("div").find("span").removeClass("active");
    });

    //contactUs.html  左侧栏
    +function () {
        var $notLi=$('.noticeLeft ul li');
        for (var i = 0; i < $notLi.length; i++) {
            $li=$notLi.eq(i),
                $a=$li.find('a');
            if (location.href.match($a.attr('href'))) {
                console.log($li);
                $li.addClass('cur').siblings().removeClass('cur');
                break;
            }
        }
    }();
});

$(function(){
    $('body').addClass('has-js');
    $('.label_check,.label_radio').click(function(){
        setupLabel();
    });
    setupLabel();
});

function setupLabel(){
    if($('.label_check input').length) {
        $('.label_check').each(function(){
            $(this).removeClass('c_on');
        });
        $('.label_check input:checked').each(function(){
            $(this).parent('label').addClass('c_on');
        });
    };
    if($('.label_radio input').length) {
        $('.label_radio').each(function(){
            $(this).removeClass('r_on');
        });
        $('.label_radio input:checked').each(function(){
            $(this).parent('label').addClass('r_on');
        });
    };
}







