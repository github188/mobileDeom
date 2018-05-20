/**
 * Created by Administrator on 2017/6/19.
 */
var reg={
    mobile : /^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\d{8}$/,
    email       :   /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/  //邮箱
};

/* -------------- 用户登录 ------------------------------*/
$("#a .myBtn").bind("click",function () {
    var $that=$(this);
    var username=$("#username").val(),         //用户名
        password=$("#password").val(),         //密码
        checkbox=$("#a .setChe");             //复选框


    if($.trim(username)==""){
        //提示
        layer.open({
            content: "请输入用户名"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }else if($.trim(password)==""){
        //提示
        layer.open({
            content: "请输入密码"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }else if(checkbox.attr("checked")==false){
        layer.open({
            content: "请同意用户协议"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }

    $.ajax({
        url:url,
        type:'POST',
        data:{"username":username,"password":password},
        dataType:"json",
        success:function (data) {
            console.log(data.status);
            if(data.status==1){
               $(".myBtn").find("a").text("正在登录中...");
                setTimeout(function(){
                    location.href =Aurl;
                },1000);
                return false;
           }else{
                //提示
                layer.open({
                    content:data.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                $('input[name="username"]').val('');
                $('input[name="password"]').val('');
            }
        }
    });
});


/* --------------------- 验证手机号码 -----------------*/
$("#b").on("click",".getCode",function (e) {
    var that=$(this);
    e.preventDefault();
    var phoneVal=$("#mobile").val();

    if($.trim(phoneVal)==""){
        //提示
        layer.open({
            content:"手机号不能为空"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }else if(!reg.mobile.test(phoneVal)){
        //提示
        layer.open({
            content:"请填写正确的手机号"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }

    $.ajax({
       url:phoneUrl,
       type:'POST',
       data:{"mobile":phoneVal},
       dataType:"json",
       success:function (data) {
          if(data.status==1){     //成功
              //提示
              layer.open({
                  content:data.msg
                  ,skin: 'msg'
                  ,time: 2 //2秒后自动关闭
              });
              // 倒计时的处理
              var mstime = 60;
              function emailColok(obj){
                  $(obj).css("disabled",true);
                  $(obj).css("cursor", "not-allowed");
                  var clock=setInterval(function(){
                      $(obj).attr("disabled", "disabled");
                      $(obj).attr({"disabled":"disabled"});
                      $(obj).text(mstime+"s后重新获取");
                      mstime--;
                      if(mstime<=1){
                          $(obj).css("disabled",false);
                          $(obj).css("cursor", "default");
                          clearInterval(clock);
                          $(obj).text("获取验证码");
                      }
                  },1000);
              };
              emailColok(that);
          }else{
              //失败提示
              layer.open({
                  content:data.msg
                  ,skin: 'msg'
                  ,time: 2 //2秒后自动关闭
              });
          }
       }

    });
});


/* ------------------------- 用户注册 -------------------------- */
$("#b .myBtn").on("click",function () {
    var uname = $('form#b input[name=username]').val(),            //用户名
        moblie=$('form#b input[name=mobile]').val(),              //手机号码
        moblieCode=$('form#b input[name=mobile_mobile]').val(),   //手机验证码
        password=$('form#b input[name=password]').val(),          //用户密码
        checkbox=$("#b .setChe");                                 //复选框
    if(uname==""||password==""){
        //提示信息
        layer.open({
            content:"账号名或密码不能为空"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }else if(checkbox.attr("checked")==false){
        layer.open({
            content: "请同意用户协议"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }
    if(moblieCode==""){
        //提示信息
        layer.open({
            content:"请填写验证码"
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
        return false;
    }
    $.ajax({
        url:regUrl,
        type:'POST',
        data:{ "username":uname,password:password,"mobile": moblie,"mobile_code":moblieCode},
        dataType:"json",
        success:function (data) {
          if(data.status==0){
              //提示信息
              layer.open({
                  content:data.msg
                  ,skin: 'msg'
                  ,time: 2 //2秒后自动关闭
              });
           }else if(data.status){
              $(".myBtn").find("a").text("正在注册中...");
              setTimeout(function(){
                  location.href =Aurl;
              },1000);
              return false;
          }
        }
    });
});


/*-------------------------- 点击刷新验证码--------------------------------*/
var URL = $("#captcha_img").attr("src");
$("#captcha_img").on('click',function(){
    $("#captcha_img").attr("src",URL+'?r='+Math.random());
});

/* -------------- 找回密码---验证方式 ------------------------- */
$("#myBtn").on("click",function () {
      var that=$(this),
          urseMsg=$("#c input[name=urseMsg]").val();     //用户输入的邮箱或手机号的值
          imgMsg=$("#c input[name=imgMsg]").val();      //图片的验证码

    if($.trim(urseMsg)==""){
          //提示信息
          layer.open({
              content:"请输入手机号/邮箱"
              ,skin: 'msg'
              ,time: 2 //2秒后自动关闭
          });
          return false;
      }

      $.ajax({
         url: yzsfUrl,
         type:'POST',
         data:{"mobileORemail":urseMsg,code:imgMsg},
         success:function (data) {
            if(data.status==0){
                //失败的提示信息
                layer.open({
                    content:data.msg
                    ,skin: 'msg'
                    ,time: 2
                });
            }else if(data.status==1){
                //成功的提示信息
                layer.open({
                    content:"成功"
                    ,skin: 'msg'
                    ,time: 2
                });
                setTimeout(function(){
                    location.href =page2;
                },1000);
            }
         },
          error:function(data){
              show_msg('网络繁忙请稍后重试','error');
          }
      });
});

/*----------       重置密码       ----------------------*/
$(".confirPsd").on("click",function () {
     var Psd1=$("#oldPsd").val(),     //第一次密码
         Psd2=$("#newPsd").val();     //确认密码
         codeMsg=$("#code").val();      //短信验证码

     if(Psd1!==Psd2){
         layer.open({
             content:"两次输入的密码不一致"
             ,skin: 'msg'
             ,time: 2
         });
     }

     $.ajax({
        url:backPsdUrl,
        type:'POST',
        data:{"pwd1":Psd1,"pwd2":Psd2,"code":codeMsg},
        success:function (data) {
           if(data.status==0){
               layer.open({
                   content:data.msg
                   ,skin: 'msg'
                   ,time: 2
               });
           }else if(data.status==1){
               layer.open({
                   content:"重置成功"
                   ,skin: 'msg'
                   ,time: 2
               });
               setTimeout(function(){
                   location.href =page3Url;
               },1000);
           }
        }
     });
});