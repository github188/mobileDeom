$(document).ready(function(){
    $("#close").click(function(){
        $("#main").hide();
        $(".hongbao").show();
        $(".dLeft").show();
        $("body").addClass("body-bg ");
    });
    $("#open").click(function(){
        $("#mainOpen").show();
        $("#product").hide();
        $("#main").hide();
        chaihongbao();
    });
    $("#goback").click(function(){
        $("#main").show();
        $("#product").show();
        $("#mainOpen").hide();
    })
});

function chaihongbao(){
    url = "/index.php?m=home&c=user&a=chaihongbao";
    $.get(url,{goods_id:goods_id},function(json){
        if(json.state){
            $('.hongbao_result0').hide();
            $('.hongbao_result1 span').html(json.money/100);
            $('.hongbao_result1').show();
            users = json.users;
            var i;
            var max_money = 0;
            var max_id = 0;
            $('#users .users_li').remove();
            for(i=0;i<users.length;i++){
                if(users[i]["money"]>max_money){
                    max_id = i;
                    max_money = users[i]["money"];
                    console.log(i+"--"+max_money);
                }
                money = users[i]["money"]/100;
                str = '<div class="users_li" id="users'+i+'"><img src="'+users[i]["avatar"]+'" class="avatar" /><div class="nick"><span class="t1">'+users[i]["nick"]+'</span><br/><span class="t2">'+users[i]["ctime"]+'</span></div><div class="money"><span class="t1">'+money+'元</span><br/><span class="t2"></span></div><div style="clear:both"></div></div>';
                $("#users").append(str);
                myScroll2.refresh();
            }
            myScroll2.refresh();
            //$('#users'+max_id).find(".money").children(".t2").html("手气最佳");
        }else{
            $('.hongbao_result1').hide();
            $('.hongbao_result0').html(json.msg).show();
            myScroll2.refresh();
        }
    });
}


