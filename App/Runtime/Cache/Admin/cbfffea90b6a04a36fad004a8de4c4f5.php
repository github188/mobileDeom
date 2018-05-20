<?php if (!defined('THINK_PATH')) exit();?><!-- 头部 -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo getConfig('web_name');?> - 管理后台</title>
<!-- 告诉浏览器能够响应屏幕宽度 -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="/Public/AdminLte/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome 图标字体 -->
<link rel="stylesheet" href="/Public/AdminLte/bootstrap/font-awesome/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="/Public/AdminLte/bootstrap/ionicons/ionicons.min.css">
<!-- Theme style 主题风格-->
<link rel="stylesheet" href="/Public/AdminLte/dist/css/AdminLTE.min.css">
<!-- AdminLTE 皮肤. -->
<link rel="stylesheet" href="/Public/AdminLte/dist/css/skins/_all-skins.min.css">
<!-- iCheck-->
<link rel="stylesheet" href="/Public/AdminLte/plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="/Public/AdminLte/plugins/iCheck/all.css">
<!-- DataTables 表格-->
<link rel="stylesheet" href="/Public/AdminLte/plugins/datatables/dataTables.bootstrap.css">
<!--表单验证插件CSS --> 
<link rel="stylesheet" href="/Public/AdminLte/plugins/validator/jquery.validator.css">
<!-- 自定义公共CSS样式 -->
<link rel="stylesheet" href="/Public/Static/css/common.css" />
<!--图片模态窗口-->
<link rel="stylesheet" href="/Public/Static/css/jquery.fancybox.css">
<!-- bootstrap datepicker 日期-->
<link rel="stylesheet" href="/Public/AdminLte/plugins/datepicker/datepicker3.css">
<link rel="shortcut icon" href="/Public/Static/images/favicon.ico" />
<!-- jQuery 2.2.0 -->
<script src="/Public/AdminLte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="/Public/AdminLte/js/html5shiv.min.js"></script>
<script src="/Public/AdminLte/js/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	.box-header .fileSrc-delMsg{
		text-align: center;
		font-size: 16px;
	}
</style>
</head>
<body  style="background-color:#ecf0f5;">


    <style type="text/css">
        .accessApp{
            margin-left: 10px;
            color: red;
        }
        .accessAction{
            margin: 15px 5px 5px 10px;
            font-size: 17px;
            font-weight: 600;
            color: #;
            color: #008d4c;
        }
        .border-app{
            padding: 5px 15px 10px 10px;
            border:1px solid #fff;
        }
        .border-app .accessMethod{
            margin: 5px;
            padding: 5px 15px;
            border:1px solid #fff;
            /*text-align: center;*/
        }
        fieldset{
            margin-bottom: 6px;
        }
        .accessMethod span{
            margin-left: 8px;
        }
    </style>

    <form action="<?php echo U(MODULE_NAME.'/Rbac/access');?>" method="post" class="form-horizontal">
		<div class="portlet-body" style="width:98%;margin:10px;border:1px solid #ddd; background-color: #fff;">
            <input type="hidden" name='rid' value='<?php echo ($rid); ?>'/>
            <?php if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?><h4 class="accessApp">
                    <?php echo ($app["title"]); ?> 
                    <input type="checkbox"  name="access[]" value="<?php echo ($app["id"]); ?>_1" level="1" <?php if($app['access']): ?>checked="checked"<?php endif; ?>/>
                </h4>

                <div class="border-app">
                    <?php if(is_array($app["child"])): $k = 0; $__LIST__ = $app["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($k % 2 );++$k;?><fieldset>
                            <legend class="accessAction">
                                <?php echo ($action["title"]); ?> 
                                <input type="checkbox" name="access[]" value="<?php echo ($action["id"]); ?>_2" level="2" <?php if($action['access']): ?>checked="checked"<?php endif; ?>/>
                            </legend>
                            <span class="accessMethod">
                                <?php if(is_array($action["child"])): $i = 0; $__LIST__ = $action["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><span>
                                        <?php echo ($method["title"]); ?> 
                                        <input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>_3" level="3" <?php if($method['access']): ?>checked="checked"<?php endif; ?>/> &nbsp;
                                    </span><?php endforeach; endif; else: echo "" ;endif; ?>
                            </span>
                        </fieldset><?php endforeach; endif; else: echo "" ;endif; ?>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
        <div align="center"> 
            <button class="btn btn-success" type="button" onclick="ajaxSubmit(this)"><i class="fa fa-check"></i> 确定修改权限</button>
        </div>
    </form>


<!-- 底部 -->

<!-- Bootstrap 3.3.6 -->
<script src="/Public/AdminLte/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/Static/js/bootstrap-switch.js"></script>
<!-- DataTables -->
<script src="/Public/AdminLte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/Public/AdminLte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- FastClick 加速点击-->
<script src="/Public/AdminLte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App  核心-->
<script src="/Public/AdminLte/dist/js/app.min.content.js"></script>
<!--弹窗js 参考 http://layer.layui.com/--> 
<script src="/Public/AdminLte/layer/layer.js"></script>
<!-- icheck插件 --> 
<script src="/Public/AdminLte/plugins/iCheck/icheck.js"></script>

<!--表单验证插件 参考http://niceue.com/validator/--> 
<script src="/Public/AdminLte/plugins/validator/jquery.validator.js?local=zh-CN"></script>
<!-- bootstrap datepicker 日期-->
<script src="/Public/AdminLte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/Public/AdminLte/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js"></script>

<script type="text/javascript">
//Table表格
$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false
  });
});

//模态弹窗
$("a[data-toggle='dialog']").on('click', function(){
    var dataTitle = $(this).attr('data-title');
    var dataUrl = $(this).attr('data-url');
    var dataWidth = $(this).attr('data-width');
    var dataHeight = $(this).attr('data-height');
    layer.open({
        type: 2,
        maxmin: true,
        title: dataTitle ? dataTitle : $(this).text(),
        shadeClose: true,
        shade: 0.8,
        area: [dataWidth, dataHeight],
        content: dataUrl,
    });
});

//icheck插件
$(document).ready(function(){
  $('input[type=radio]').iCheck({
  	checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' 
  });
});

$(document).ready(function(){
  $('input[type=checkbox]').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' 
  });
});

//checkbox勾选判断
$('.data-back-true').on('ifChecked', function(){
  if ($(this).is(':checked')) {
      $(".data-back-checkbox input[type=checkbox]").each(function(){
        $(this).iCheck('check');
      });
  }
});
$('.data-back-true').on('ifUnchecked', function(){
    $(".data-back-checkbox input[type=checkbox]").each(function(){
      $(this).iCheck('uncheck');
    });
});


//删除询问框
$(".delete-msg").on('click', function(){
    var status = confirm('删除后将无法恢复！\n 确定删除吗？？？');
    if(!status){
        return false;
    }
});

//确认框
$(".btnEdit").click(function(){
    var status = confirm("真的确认操作吗？？？");
    if(!status){
        return false;
    }
});

//AJAX提交
function ajaxSubmit(obj){
  formData = $(obj).parents('form').serializeArray();
  formUrl = $(obj).parents('form').attr('action');

  $.ajax({
    type:'post',
    dataType:'json',
    url:formUrl,
    data:formData,
    success:function(data){
      // alert(JSON.stringify(data));
      window.parent.callBack(data); 
    }
  });
}

//回调函数
function callBack(data){
  if(data.status==1){
    layer.alert(data.info,{skin: 'layui-layer-molv'});
    layer.closeAll('iframe');
    window.location.reload();
  }else{
    layer.alert(data.info,{skin: 'layui-layer-lan'});
    layer.closeAll('iframe');
  }
}

</script>

</body>
</html>

<script type="text/javascript">
    //checkbox 模块勾选判断
   /* $('.accessApp input[level=1]').on('ifChecked', function(){
        if ($(this).is(':checked')) {
            $(".border-app input[type=checkbox]").each(function(){
                $(this).iCheck('check');
            });
        }
    });
    $('.accessApp input[level=1]').on('ifUnchecked', function(){
        $(".border-app input[type=checkbox]").each(function(){
            $(this).iCheck('uncheck');
        });
    });
    //控制器勾选判断
    $('.accessAction input[level=2]').on('ifChecked', function(){
        if ($(this).is(':checked')) {

            $(this).parents('fieldset').find('input').each(function(){
                $(this).iCheck('check');
            });
        }
    });
    $('.accessAction input[level=2]').on('ifUnchecked', function(){
        $(this).parents('fieldset').find('input').each(function(){
            $(this).iCheck('uncheck');
        });
    });*/
//父级选中，所有字节点选中
var checkpr=true;
var unchekpr=true;
var uncheckchi=[];
$(".border-app input").on('ifChecked',function(){
var level=$(this).attr("level");
	$(this).iCheck('check');
	var ck_count=0,un_count=0,length;
	if(level==2){
		checkpr&&($(this).parents('fieldset').find('input').iCheck('check'),unchekpr=true),$.each(uncheckchi,function(i,v){$(".border-app input[value="+v+"]").iCheck('uncheck')});
	}else if(level==3){
	var input_dom=$(this).parents('fieldset').find('.accessMethod input');
		length=input_dom.length;
		console.log(input_dom);
		checkpr=false;
		$.each(input_dom,function(){
			var index=$.inArray($(this).val(),uncheckchi);
			if($(this).is(":checked")){
			ck_count++;
			console.log(index);
			if(index>=0)uncheckchi.splice(index,1)
			}else{un_count++;if(index==-1)uncheckchi.push($(this).val())}
		})
		ck_count>0&&$(this).parents('fieldset').find('.accessAction input').iCheck('check');
		ck_count==length&&(checkpr=true);
		console.log(ck_count==length);
	}
})

$(".border-app input").on('ifUnchecked',function(){
var level=$(this).attr("level");
	$(this).iCheck('uncheck');
	var ck_count=0,un_count=0,length;
	if(level==2){
		unchekpr&&$(this).parents('fieldset').find('input').iCheck('uncheck');
	}else if(level==3){
		var input_dom=$(this).parents('fieldset').find('.accessMethod input');
		length=input_dom.length;
		$.each(input_dom,function(){
			if(!$(this).is(":checked"))un_count++
		})
		console.log(un_count);
		un_count==length&&($(this).parents('fieldset').find('.accessAction input').iCheck('uncheck'),checkpr=true)
		console.log(un_count==length);
		console.log(length);
	}
})
//父级取消，所有节点取消
//选中单个字节点父级选中


</script>