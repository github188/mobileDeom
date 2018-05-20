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
	/*系统环境信息的CSS*/
	.table-td-right{
		width: 20%;
		font-weight: 600;
		color: #555;
 	    letter-spacing: 0em;
	}

</style>
<div class="wrapper">
	<!-- 内容标题开始 -->
	<div id="breadcrumbs" class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> 后台首页</a></li>
			<li><a href="#">系统设置</a></li>
			<li class="active">默认主页</li>
		</ol>
	</div>
	<!-- 内容标题结束 -->


	<!-- 主要内容开始 -->
	<section class="content">
		<div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
 			   <div class="info-box">
	                <span class="info-box-icon bg-aqua"><i class="fa fa-cogs"></i></span>
	                <div class="info-box-content">
	                    <span class="info-box-text">用户总数</span>
	                    <span class="info-box-number"><?php echo ($user); ?></span>
	                </div>
	            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
	            <div class="info-box">
	                <span class="info-box-icon bg-green"><i class="fa fa-bell"></i></span>
	                <div class="info-box-content">
	                    <span class="info-box-text">文章总数</span>
	                    <span class="info-box-number"><?php echo ($article); ?></span>
	                </div>
	            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
	            <div class="info-box">
	                <span class="info-box-icon bg-red"><i class="fa fa-user-plus"></i></span>
	                <div class="info-box-content">
	                    <span class="info-box-text">课程视频总数</span>
	                    <span class="info-box-number"><?php echo ($video); ?></span>
	                </div>
	            </div>
            </div>
			<div class="col-xs-12">
				<div class="box box-success">
					<div class="box-header nav-tabs">
						<h4 class="box-title"><i class="fa fa-desktop"></i> 系统环境信息</h4>
					</div>

					<!-- 表格开始 -->
					<div class="box-body">
						<table id="example" class="table table-bordered">
							<tbody>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,0,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,2,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,4,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,6,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,8,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,10,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,12,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,14,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,16,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,18,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
								<tr>
									<?php if(is_array($info)): $i = 0; $__LIST__ = array_slice($info,20,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td class="table-td-right"><?php echo ($key); ?></td>
										<td><?php echo ($v); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- 表格结束 -->

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