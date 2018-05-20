<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
            <li><a href="#">后台用户</a></li>
            <li class="active">节点管理</li>
        </ol>
    </div>
    <!-- 内容标题结束 -->

    <!-- 主要内容开始 -->
    <div class="col-md-12">

        <!-- 自定义标签开始 -->
        <div class="nav-tabs-custom">

            <!-- 标签内容开始 -->
            <div class="tab-content">
                <div id="tab_<?php echo ($gid); ?>" class="tab-pane active">
                    <div class="pull-right" style="display:block;">
                        <a  style="display:block;" class="btn btn-info" href="<?php echo U(MODULE_NAME.'/Rbac/addNode');?>" >
                            <i class="fa fa-plus"></i> 添加应用模块
                        </a>
                    </div>
                    <h4 align="center"><i class="fa fa-list-ul"></i> 后台节点权限管理</h4>
                    <table id="example" class="table table-bordered table-hover">
                        <thead>
                            <tr>
			                	<th>ID</th>
								<th>应用名称</th>
								<th>应用描述</th>
								<th>状态</th>
								<th>排序</th>
								<th>所属导航</th>
								<th>显示</th>
								<th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
									<td ><?php echo ($v['id']); ?></td>
									<td><span style="float:left;margin-left:10px;"><?php echo ($v['name']); ?></span></td>
									<td><span style="float:left;margin-left:10px;"><?php echo ($v['title']); ?></span></td>
									<td><?php if(!$v["status"]): ?>&nbsp;关闭<?php else: ?>开启<?php endif; ?></td>
									<td><?php echo ($v['sort']); ?></td>
									<td><?php if(!$v['menu']['title']): ?>未分组<?php else: echo ($v['menu']['title']); endif; ?></td>
									<td><?php if(!$v["menu_status"]): ?>隐藏<?php else: ?>显示 <i class="icon-ok"></i><?php endif; ?></td>
									<td>
										<span style="float:left;margin-left:5px;">
											<a data-url="<?php echo U(MODULE_NAME .'/Rbac/addNode',array('pid' => $v['id'],'level' =>2 ));?>" href="#" data-toggle="dialog" data-width="80%" data-height="80%" data-title="<i class='fa fa-plus'></i> 添加控制器 - [所属上级：<?php echo ($v['name']); ?> (<?php echo ($v['title']); ?>) ]" class="btn btn-info"><i class="fa fa-plus"></i> 添加控制器</a>&nbsp;
							                <a data-url="<?php echo U(MODULE_NAME .'/Rbac/editNode',array('pid' => $v['id'],'level' =>1));?>" href="#" data-toggle="dialog" data-width="80%" data-height="80%" data-title="<i class='fa fa-pencil'></i> 修改应用模块" class="btn btn-primary"><i class="fa fa-pencil"></i> 改</a>&nbsp;
							                <a href="<?php echo U(MODULE_NAME .'/Rbac/nodeDelete',array('pid' => $v['id']));?>" class="btn btn-danger delete-msg"><i class="fa fa-times"></i> 删</a>
						                </span>
									</td>

									<?php if(is_array($v["child"])): $i = 0; $__LIST__ = $v["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><tr>
										<td height="25"><?php echo ($action['id']); ?></td>
										<td>
											<span style="float:left;margin-left:20px;">╚&nbsp; &nbsp;<?php echo ($action['name']); ?></span>
										</td>
										<td>
											<span style="float:left;margin-left:20px;">╚&nbsp; &nbsp;<?php echo ($action['title']); ?></span>
										</td>
										<td><?php if(!$action["status"]): ?>&nbsp;关闭<?php else: ?>开启<?php endif; ?></td>
										<td><?php echo ($action['sort']); ?></td>
										<td><?php if(!$action['menu']['title']): ?>未分组<?php else: echo ($action['menu']['title']); endif; ?></td>
										<td><?php if(!$action["menu_status"]): ?>隐藏<?php else: ?>显示 <i class="icon-ok"></i><?php endif; ?></td>
										<td>
											<span style="float:left;margin-left:10px;">╚&nbsp;
												<a data-url="<?php echo U(MODULE_NAME .'/Rbac/addNode',array('pid' => $action['id'],'level' =>3 ));?>" href="#" data-toggle="dialog" data-width="80%" data-height="80%" data-title="<i class='fa fa-plus'></i> 添加动作方法 - [所属上级：<?php echo ($action['name']); ?> (<?php echo ($action['title']); ?>) ]" class="btn btn-info"><i class="fa fa-plus"></i> 添加方法</a>&nbsp;
								                <a data-url="<?php echo U(MODULE_NAME .'/Rbac/editNode',array('pid' => $action['id'],'level' =>2));?>" href="#" data-toggle="dialog" data-width="80%" data-height="80%" data-title="<i class='fa fa-pencil'></i> 修改控制器 - [所属上级：<?php echo ($v['name']); ?> (<?php echo ($v['title']); ?>) ]" class="btn btn-primary"><i class="fa fa-pencil"></i> 改</a>&nbsp;
								                <a href="<?php echo U(MODULE_NAME .'/Rbac/nodeDelete',array('pid' => $action['id']));?>" class="btn btn-danger delete-msg"><i class="fa fa-times"></i> 删</a>
							                </span>
										</td>

											<?php if(is_array($action["child"])): $i = 0; $__LIST__ = $action["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><tr>
												<td height="25"><?php echo ($method['id']); ?></td>
												<td >
													<span style="float:left;margin-left:45px;">╠&nbsp; &nbsp;<?php echo ($method['name']); ?></span>
												</td>
												<td>
													<span style="float:left;margin-left:45px;">╠&nbsp; &nbsp;<?php echo ($method['title']); ?></span>
												</td>
												<td><?php if(!$method["status"]): ?>&nbsp;关闭<?php else: ?>开启<?php endif; ?></td>
												<td><?php echo ($method['sort']); ?></td>
												<td><?php if(!$method['menu']['title']): ?>未分组<?php else: echo ($method['menu']['title']); endif; ?></td>
												<td><?php if(!$method["menu_status"]): ?>隐藏<?php else: ?>显示 <i class="icon-ok"></i><?php endif; ?></td>
												<td>
													<span style="float:left;margin-left:35px;">╠&nbsp;
										                <a data-url="<?php echo U(MODULE_NAME .'/Rbac/editNode',array('pid' => $method['id'],'level' =>3));?>" href="#" data-toggle="dialog" data-width="80%" data-height="85%" data-title="<i class='fa fa-pencil'></i> 修改动作方法 - [所属上级：<?php echo ($action['name']); ?> (<?php echo ($action['title']); ?>) ]" class="btn btn-primary"><i class="fa fa-pencil"></i> 改</a>&nbsp;
										                <a href="<?php echo U(MODULE_NAME .'/Rbac/nodeDelete',array('pid' => $method['id']));?>" class="btn btn-danger delete-msg"><i class="fa fa-times"></i> 删</a>
									                </span>
												</td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>

									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php if(!$node): ?><tr>
										<td colspan="8" align="center"> 没有数据！</td>
									</tr><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- 标签内容结束 -->
        </div>
        <!-- 自定义标签结束 -->
    </div>
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