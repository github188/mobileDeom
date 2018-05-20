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
<div class="wrapper">

	<!-- 主要内容开始 -->
	<section class="content">
		<div class="row">

			<div class="col-xs-12">
				<div class="box box-info">
					<div class="box-header nav-tabs">
						<h4 class="box-title">添加<?php echo ($type); ?></h4>
					</div>
					<!-- 表格开始 -->
					<div class="box-body">
						<form action="<?php echo U(MODULE_NAME.'/Rbac/addNode');?>" method="post">  
							<table id="example" class="table table-bordered">
								<tbody>
									<tr>
										<td class="table-td-right"> <?php echo ($type); ?>名称：</td>
										<td><input type="text" name="name" class="form-control" size="30" data-rule="required"> &nbsp; (*英文区分大小写)</td>
									</tr>
									<tr>
										<td class="table-td-right"> <?php echo ($type); ?>描述：</td>
										<td><input type="text" name="title" class="form-control" size="30" data-rule="required"> &nbsp; (*中文描述)</td>
									</tr>
									<?php if($level == 3): ?><tr>
											<td class="table-td-right"> <?php echo ($type); ?>URL参数：</td>
											<td><input type="text" name="url" class="form-control" size="30">&nbsp; URL传参: 变量1=value1<b>,</b>变量2=value2 &nbsp;(多个以英文<b>,</b>逗号分隔)</td>
										</tr><?php endif; ?>
									<tr>
										<td class="table-td-right"><?php echo ($type); ?>排序：</td>
										<td><input type="text" name="sort" class="form-control" value="100" size="30" data-rule="required"></td>
									</tr>
									<tr>
										<td class="table-td-right">开启状态：</td>
										<td>
						                    开启 <input type="radio" name="status" id="iCheck1" value="1" checked> &nbsp;
						                    关闭 <input type="radio" name="status" id="iCheck2" value="0">
										</td>
									</tr>
									<tr>
										<td class="table-td-right"><?php echo ($type); ?>详细描述：</td>
										<td>
						                    <textarea name="remark"  rows="3" cols="32"></textarea> *可留空
										</td>
									</tr>
									<tr>
										<td class="table-td-right">所属导航栏：</td>
										<td>
											<select name="menu_id">
												<option value="0">&nbsp;未分组</option>
												<?php if(is_array($menu)): foreach($menu as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["title"]); ?>&nbsp;</option><?php endforeach; endif; ?>
											</select>
										</td>
									</tr>
									<tr height="60">
										<td class="table-td-right">在导航栏显示：</td>
										<td>
						                    显示 <input type="radio" name="menu_status" id="iCheck1" value="1"> &nbsp;
						                    隐藏 <input type="radio" name="menu_status" id="iCheck2" value="0" checked>
											<input type="hidden" name='pid' value='<?php echo ($pid); ?>' />
											<input type="hidden" name='level' value='<?php echo ($level); ?>' />
										</td>
									</tr>
									<tr height="60">
										<td colspan="2" align="center">
											<button class="btn btn-success" type="button" onclick="ajaxSubmit(this)"><i class="fa fa-check"></i> 确定添加</button>
										</td>
									</tr>
								</tbody>
							</table>
						</form>	
					</div>
					<!-- 表格结束 -->

				</div>
			</div>

		</div>
	</section>
	<!-- 主要内容结束 -->
</div>
<!-- ./wrapper结束 -->

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