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
             <li><a href="#">用户管理</a></li>
            <li class="active">添加会员</li>
        </ol>
    </div>
    <!-- 内容标题结束 -->

    <!-- 主要内容开始 -->
    <div class="col-md-12">

        <!-- 自定义标签开始 -->
        <div class="nav-tabs-custom">
            <style>
                .table img {
                    margin-top: 8px;
                    margin-left: 2px;
                }
            </style>
            <!-- 标签内容开始 -->
            <div class="tab-content">
                <div id="tab_1" class="tab-pane active">
                   <form method="post" action="<?php echo U(MODULE_NAME.'/User/userAdd');?>" enctype="multipart/form-data" id="form1">
                    <table id="example" class="table table-bordered table-hover" align="center" cellpadding="4" cellspacing="1" width="100%">
                        <tbody>

                            <tr>
                                <td bgcolor="#F8F8F8" colspan="3">会员分组:</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><strong>用户组</strong></td>
                                <td>
                                    <input type="text" disabled value="开通时间">----
                                    <input type="text" disabled value="过期时间"><font color="red">(注意：若填写则选择填写的时间。不填写则默认选择对应用户组的时间。只需要打一个勾即可！)</font>
                                </td>
                            </tr>
                             <?php if(is_array($user_groups)): $i = 0; $__LIST__ = $user_groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cg): $mod = ($i % 2 );++$i;?><tr>
                                        <td></td>
                                        <td  width="10%">
                                            <input type="checkbox" name="group_ext[id][<?php echo ($cg['id']); ?>]" value="<?php echo ($cg['id']); ?>"> <img src="/Public/Static/images/user_group/<?php echo ($cg['id']); ?>.png" style="vertical-align: top;" alt="会员组"><?php echo ($cg['name']); ?>
                                        </td>
                                        <td>
                                            <input type="text" name="group_ext[start_time][<?php echo ($cg['id']); ?>]" class="date-time" data-date-format="yyyy-mm-dd" value="">----
                                            <input type="text" name="group_ext[end_time][<?php echo ($cg['id']); ?>]"   class="date-time" data-date-format="yyyy-mm-dd" value="">
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td></td>
                                <td width="10%">用户名:</td>
                                <td>
                                    <input name="info[username]" type="text" value="" data-rule="required">
                                </td>
                            </tr>
                            <tr>
                               <td >&nbsp;</td>
                                <td width="10%">密码:</td>
                                <td>
                                    <input name="info[password]" id="password" type="password" value="" autocomplete="off" data-rule="required">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">确认密码:</td>
                                <td>
                                    <input name="info[passwordok]" id="passwordok" type="password" value="" data-rule="required">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">头像:</td>
                                <td width="66%">
                                    <?php $__FOR_START_28454__=1;$__FOR_END_28454__=20;for($i=$__FOR_START_28454__;$i < $__FOR_END_28454__;$i+=1){ ?><label for="logo_<?php echo ($i); ?>">
                                            <img src="/Public/Static/images/logo/<?php echo ($i); ?>.png" width="50px" height="50px" style="cursor: pointer;">
                                        </label>
                                        <input type="radio" name="info[face]" value="<?php echo ($i); ?>" id="logo_<?php echo ($i); ?>" ><?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">真实姓名:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[realname]" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">QQ号:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[qq]" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">微信号:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[weixin_username]" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">城市:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[city]" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">行业:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[trade]" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">公司:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[company]" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="10%">手机:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[mobile]" type="text" value="" data-rule="required">
                                </td>
                            </tr>
                              <!--以下为地址信息-->
                            <tr>
                                <td></td>
                                <td width="10%">email:</td>
                                <td width="66%">
                                    <input style="width:200px;" name="info[email]" type="text" value="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                   <br>
                  <center>
                      <button class="btn btn-success inlineSearch display-inline"  type="submit">提 交</button>
                  </center>
                   </form>
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

<script type="text/javascript">
    //日期插件
    $('.date-time').datepicker({
        weekStart: 1,
        autoclose: true
    });
    //删除询问框
    $(".delete-msg-find").on('click', function(){
        var status = confirm('确定删除本条文章？\n \n 删除后将无法恢复！\n 确定删除吗？？？\n \n ');
        if(!status){
            return false;
        }
    });

</script>