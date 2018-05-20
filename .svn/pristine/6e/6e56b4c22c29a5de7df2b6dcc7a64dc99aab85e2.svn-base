$(document).ready(function () {
    //记住密码，input的checkbox隐藏域
    ~function () {
        var h = 'hover';
        $('.js-che').on("click",function () {
            var $e = $(this);
            $e.toggleClass(h);
            if($e.hasClass(h)){
                $('.cheBox').attr('checked',true);
            }else{
                $('.cheBox').attr('checked',false);
            }
        });
    }();

    // 随机生成背景
    +function () {
        function ranBg() {
            var random_bg=Math.floor(Math.random()*5+1);
            var bg='url(../img/bg0'+random_bg+'.jpg)';
            $("body").css("background-image",bg);
        }
        ranBg();
        $('.renew').on('click',function () {
            ranBg();
        });
    }();
});


// IE 兼容处理
//登录背景框及input框
+function () {
    var ua = navigator.userAgent;
    if ((ua.indexOf('compatible') > -1 && (ua.indexOf('MSIE 8') > -1 || ua.indexOf('MSIE 9') > -1))) {
        $('.logo').css("background-image","url(../img/loginBg.png)");
        $('.logo .inp input').css("background","url(../img/inpBg.png)");
    }
}();

//input placeholder属性兼容
var JPlaceHolder = {
    //检测
    _check : function(){
        return 'placeholder' in document.createElement('input');
    },
    //初始化
    init : function(){
        if(!this._check()){
            this.fix();
        }
    },
    //修复
    fix : function(){
        jQuery(':input[placeholder]').each(function(index, element) {
            var self = $(this), txt = self.attr('placeholder');
            self.wrap($('<div></div>').css({position:'relative', zoom:'1', border:'none', background:'none', padding:'none', margin:'none'}));
            var pos = self.position(), h = self.outerHeight(true), paddingleft = self.css('padding-left');
            var holder = $('<span></span>').text(txt).css(
                {position:'absolute', left:pos.left, top:pos.top, height:h, lienHeight:h, paddingLeft:paddingleft, color:'#fff',fontSize:'14px'}
            ).appendTo(self.parent());
            self.focusin(function(e) {
                holder.hide();
            }).focusout(function(e) {
                if(!self.val()){
                    holder.show();
                }
            });
            holder.click(function(e) {
                holder.hide();
                self.focus();
            });
        });
    }
};
//执行
jQuery(function(){
    JPlaceHolder.init();
});
