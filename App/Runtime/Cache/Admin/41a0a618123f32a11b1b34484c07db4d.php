<?php if (!defined('THINK_PATH')) exit();?>
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

	<!-- 内容标题开始 -->
	<div id="breadcrumbs" class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> 后台首页</a></li>
			<li><a href="#">系统设置</a></li>
			<li class="active">数据库备份</li>
		</ol>
	</div>

	<!-- 内容标题结束 -->

	<!-- 主要内容开始 -->
	<section class="content">
		<div class="row">
			<form action="<?php echo U(MODULE_NAME.'/Data/back');?>" method="post">
				<div class="col-xs-12">
					<div class="box box-info">
						<div class="box-header">
							<button class="btn btn-success" type="submit"><i class="fa fa-folder-open-o"></i> 备份数据库</button>
						</div>

						<!-- 表格开始 -->
						<div class="box-body">
							<table id="example" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="80" height="25">
											<input type="checkbox" class="data-back-true" value="0"> 勾选
										</th>
										<th >数据库表名</th>
										<th >记录数</th>
										<th >存储大小 KB</th>
										<th >引擎类型</th>
										<th >编码</th>
										<th >最后操作时间</th>
										<th >操作数据库</th>
									</tr>
								</thead>
								<tbody class="data-back-checkbox">
									<?php if(is_array($rem)): $i = 0; $__LIST__ = $rem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
											<td>
												&nbsp; <input type="checkbox" data-toggle="icheck" name="myBack[]" value="<?php echo ($v['name']); ?>">
											</td>
											<td><?php echo ($v['name']); ?></td>
											<td>&nbsp;<?php echo ($v["rows"]); ?> </td>
											<td><?php $data_a = round(($v['data_length']+$v['index_length'])/1024,0); ?> &nbsp;<?php echo ($data_a); ?>K</td>
											<td><?php echo ($v["engine"]); ?></td>
											<td><?php echo ($v["collation"]); ?></td>
											<td><?php echo ($v["update_time"]); ?></td>
											<td>
												<a href="<?php echo U(MODULE_NAME .'/Data/click',array('do' => 'optimize','name'=>$v['name']));?>" class="btnEdit">优化表</a> &nbsp;
												<a href="<?php echo U(MODULE_NAME .'/Data/click',array('do' => 'repair','name'=>$v['name']));?>" class="btnEdit">修复表</a> &nbsp;
												<!-- <a href="<?php echo U(MODULE_NAME .'/Data/click',array('do' => 'viewinfo','name'=>$v['name']));?>" class="btnEdit">结构</a> -->
											</td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
						</div>
						<!-- 表格结束 -->

					</div>
				</div>
			</form>

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