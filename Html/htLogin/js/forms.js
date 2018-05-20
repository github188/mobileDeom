//全局配置
var Apis  = {
    main       : '',            //主链接
    success    : 1,             //返回成功标识
};

//json字符串处理
function parseData(d) {
    return typeof(d) == 'string' ? JSON.parse(d) : d;
}

//定义变量
var forms = ".forms",       //表名
    $tip1 = $("#tip01"),    //提示
    $tip2 = $("#tip02"),
    $tip3 = $("#tip03");

//提示文字
function fadeTip(o) {
    var speed =2e3;
    o.tipBox.html(o.tipText).fadeIn(speed, function () {
        o.tipBox.fadeOut(speed, function () {
            if (o.refresh) {
                location.href = o.href || location.href;    //判断页面跳转
            }
            if (o.closePage) {
                window.close();         //关闭窗口
            }
        });
    });
}

+function () {
    $('.loginBtn').on('click',function (e) {
        e.preventDefault();
        var v0 = $("#username").val(),
            v1 = $("#password").val(),
            v2 = $("#verCode").val();
        $.ajax( {
            type        : 'get',
            url         :  'json/test.json',
            data        :'',
            dataType   :'json',
            beforeSend  :function () {
                if($.trim(v0)=="") {
                    fadeTip({tipBox: $tip1, tipText: '用户名不能为空'});
                    return false;
                }
                if($.trim(v1)=="") {
                   fadeTip({tipBox: $tip2, tipText: '原密码不能为空'});
                    return false;
                }
                if($.trim(v2)=="") {
                    fadeTip({tipBox: $tip3, tipText: '验证码不能为空'});
                    return false;
                }
            },
            success     :function (data) {
                var d = parseData(data);
                console.log(d);
                if(d.ret==Apis.success){
                    console.log(d.msg);
                }else{

                }
            }
        })
    });
}();