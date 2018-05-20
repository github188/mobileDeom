function pullDownAction () {
    from_id = parseInt($(".goods-box:first").find(".num").children("span").html());
    $.ajax({
        type: 'GET',
        url: more_url+"&from="+from_id,
        dataType: 'json',
        success: function(json){
            for(i=0;i<json.length;i++){
                goods = json[i];
                var uts = new Date(goods.pushtime * 1000);
                hours = uts.getHours();
                if(hours<10){
                    hours = "0"+hours;
                }
                minut = uts.getMinutes();
                if(minut<10){
                    minut = "0"+minut;
                }
                str = '<div class="goods-box"><div class="publishTime">'+hours+':'+minut+'</div><div class="contentImg"><img class="headPic" src="'+live_head_img+'" /><a href="'+url+'&id='+goods.id+'&pid='+pid+'"><img class="conPic" src="'+goods.pic+'_220x220.jpg" /></a></div><div class="contents"><img class="triangle" src="/Application/Home/View/theme3/statics/images/live/triangle.png" /><img class="headPic" src="'+live_head_img+'" width="72" height="72"/><p>'+goods.title+'原价'+goods.o_price+'元<span style="text-decoration:underline">【券后仅需'+goods.price+'元】</span><br/><span style="font-weight:bold">推荐理由：</span>'+goods.introduce+'</p><div class="purchase"><a href="'+url+'&id='+goods.id+'&pid='+pid+'"><div class="buy">领券购买</div></a><div class="num"><span>'+goods.qid+'</span>号</div></div></div></div>';
                $('#content .goods-box:first').before(str);
            }
            myScroll.refresh();
            myScroll.scrollToElement(document.querySelector('#content div:nth-of-type(11)'),0);
            $('.pullDownLabel').html("");
        },
        error: function(xhr, type){
            $('.pullDownLabel').html("");
        }
    });
}
function loaded() {
    pullDownEl = document.getElementById('content');
    pullDownOffset = pullDownEl.offsetHeight;//表示获取元素自身的高度
    myScroll = new iScroll('wrapper',{
        vScrollbar:false,
        onScrollMove:function(){
            if (this.y > 5 && !pullDownEl.className.match('flip')) {
                pullDownEl.className = 'flip';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手查看更多';
                this.minScrollY = 0;
            }
        },
        onScrollEnd:function(){
            if (pullDownEl.className.match('flip')) {
                pullDownEl.className = 'loading';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
                pullDownAction();
            }

        }
    });
    myScroll.scrollToElement(document.querySelector('#content .goods-box:last-child'),1000);
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

/* * * * * * * *
 *
 * Use this for high compatibility (iDevice + Android)
 *
 */
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
/*
 * * * * * * * */


/* * * * * * * *
 *
 * Use this for iDevice only
 *
 */
//document.addEventListener('DOMContentLoaded', loaded, false);
/*
 * * * * * * * */


/* * * * * * * *
 *
 * Use this if nothing else works
 *
 */
//window.addEventListener('load', setTimeout(function () { loaded(); }, 200), false);
/*
 * * * * * * * */

$(document).ready(function(){
    /*设置红包栏出现的时间*/
    setInterval(function(){
        //hongbaoNews();
    },1000);

    /*点击弹幕barrage触发聊天信息栏侧边显示*/
    $(".barrage").click(function(){
        if (!$(".barrage").hasClass('tan-bg')) {
            $(".barrage").removeClass("no-bg").addClass('tan-bg');
        } else {
            $(".barrage").addClass('no-bg').removeClass('tan-bg');
        }
        if (!$('.dLeft').hasClass('mobile-menu-left')) {
            $('.dLeft').addClass('mobile-menu-left');
        } else {
            $('.dLeft').removeClass('mobile-menu-left');
        }
        /*设置再打开弹幕的N秒后进行聊天动画显示*/
        setTimeout(scrollNews,2000);
    });
    /*
     $('#searchKeywords').focus(function(){
     $('.gift,.share').fadeOut(300);
     setTimeout(function(){$('.sendmsg').fadeIn("fast")},400);
     });
     $('#searchKeywords').focusout(function(){
     $('.sendmsg').fadeOut(300);
     setTimeout(function(){$('.gift,.share').fadeIn("fast")},400);
     });
     */
});
/*判断如果红包下有p标签说明文字，设置红包信息出现函数*/
function hongbaoNews(){
    var $hongbao =$(".hongbao");
    if($hongbao.is(':has(p)')){
        $hongbao.addClass('mobile-menu-left');
    } else {
        $$hongbao.removeClass('mobile-menu-left');
    }
}
/*关于评论显示的函数*/
function scrollNews(){
    /*获得当前评论个数*/
    var lenLI =   $(".dLeft").find("li").length;
    /*获得评论ul下的第一个li*/
    var $firstLi =$(".discuss li:first");
    /*获得评论ul下的第一个li的height --30px*/
    var lineHeightLi = $(".discuss").find("li:first").height();
    /*alert(lineHeightLi);*/
}