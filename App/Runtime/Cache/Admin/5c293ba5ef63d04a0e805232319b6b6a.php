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
	<!-- 内容标题开始 -->
	<div id="breadcrumbs" class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> 后台首页</a></li>
            <li><a href="#">视频管理</a></li>
            <li class="active">视频列表</li>
		</ol>

	</div>
	<!-- 内容标题结束 -->

	<!-- 主要内容开始 -->
	<section class="content">
		<div class="row">

			<div class="col-xs-12">
				<div class="box box-info"> <!-- box-info天空蓝、 box-primary蓝色、  box-success绿色-->
					<div class="box-header nav-tabs">
						<h4 class="box-title"><i class="fa fa-plus"></i> 添加视频</h4>
						<!-- 返回上一页 -->
						<div class="pull-right" style="margin:-10px -10px 0 0;">
	<a class="btn btn-default" title="返回上一页" onclick="javascript:history.back(-1);" href="#">
		<i class="fa fa-reply"></i>
	</a>
</div>
					</div>
					<!-- 表格开始 -->
					<div class="box-body">
						<form action="<?php echo U(MODULE_NAME.'/Video/videoEdit');?>" method="post">
							<table id="example" class="table table-bordered">
								<tbody>
									<tr>
										<td class="table-td-right"> 视频分组：</td>
										<td>
											<select name="info[vgid]" style="min-width: 406px;max-width: 50%;min-height: 35px;">
												<?php if(is_array($video_group)): foreach($video_group as $k=>$v): ?><option value="0" style="color: red;" disabled>&nbsp;<?php echo ($v["name"]); ?></option>
													<?php $children = $v['children']; ?>
													<?php if(is_array($children)): foreach($children as $kk=>$vv): ?><option <?php echo ($video_info['vgid']==$vv['id']?'selected':''); ?> value="<?php echo ($vv['id']); ?>">&nbsp;╠&nbsp;&nbsp;<?php echo ($vv["name"]); ?></option><?php endforeach; endif; endforeach; endif; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="table-td-right"> 视频标题：</td>
										<td><input type="text" name="info[title]" class="form-control" size="50" data-rule="required" value="<?php echo ($video_info['title']); ?>"></td>
									</tr>
									<tr>
										<td class="table-td-right"> 视频code：</td>
										<td><input type="text" name="info[video_code]" class="form-control" size="50" data-rule="required" value="<?php echo ($video_info['video_code']); ?>"></td>
									</tr>
									<tr>
										<td class="table-td-right"> 缩列图：</td>
										<td>
											<input type="file" name="info[logo]" class="form-control" size="50" style="min-width: 406px;">
											<?php if($video_info['logo']): ?><img src="<?php echo ($video_info['logo']); ?>" alt="缩列图" width="400px" height="200px"><?php endif; ?>
										</td>
									</tr>
									<tr>
										<td class="table-td-right"> 允许提问：</td>
										<td>
											允许 <input type="radio" name="info[allow_reply]" id="iCheck1" value="1" <?php echo ($video_info['allow_reply']==1?'checked':''); ?> > &nbsp;
											禁止 <input type="radio" name="info[allow_reply]" id="iCheck2" value="2" <?php echo ($video_info['allow_reply']==2?'checked':''); ?> >
										</td>
									</tr>
									<tr>
										<td class="table-td-right"> 审核状态：</td>
										<td>
											已审核 <input type="radio" name="info[is_show]" id="iCheck3" value="1" <?php echo ($video_info['is_show']==1?'checked':''); ?> > &nbsp;
											未审核 <input type="radio" name="info[is_show]" id="iCheck4" value="2" <?php echo ($video_info['is_show']==2?'checked':''); ?> >
										</td>
									</tr>
									<tr>
										<td class="table-td-right"> 禁止提问时提示音：</td>
										<td><input type="text" name="info[msg]" value="<?php echo ($video_info['msg']); ?>" class="form-control" size="50" placeholder="例如：该视频暂时不支持提问！"></td>
									</tr>
									<tr>
										<td class="table-td-right"> 视频排序：</td>
										<td><input type="text" name="info[sort]" value="<?php echo ($video_info['sort']); ?>" class="form-control" maxlength="1" size="50" data-rule="required;digits"></td>
									</tr>
									<tr>
										<td class="table-td-right"> 视频简介：</td>
										<td>
											<textarea name="info[remark]" style="width: 406px;min-height: 150px;"><?php echo (html_entity_decode($video_info['remark'])); ?></textarea>
										</td>

									</tr>

									<tr height="60">
										<td colspan="2" align="center">
											<input type="hidden" name="vid" value="<?php echo ($video_info['id']); ?>">
											<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> 提交编辑</button>
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