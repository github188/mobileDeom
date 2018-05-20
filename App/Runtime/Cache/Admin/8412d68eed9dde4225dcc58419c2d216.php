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
            <li class="active">编辑会员</li>
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
                   <form method="post" action="" enctype="multipart/form-data" id="form1">
                    <table id="example" class="table table-bordered table-hover" align="center" cellpadding="4" cellspacing="1" width="100%">
                        <tbody>
                            <tr class="header">
                                <td bgcolor="#e6e6e6 " colspan="2"><?php echo $position_name; ?></td>
                            </tr>
                             <tr>
                                <td width="40%">所属会员分组:</td>
                                <td align="left"  width="58%">
                                    <select name="info[ugid]" class='select' >
                                        <?php if(is_array($user_groups)): $i = 0; $__LIST__ = $user_groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cg): $mod = ($i % 2 );++$i;?><option value='<?php echo ($cg["ugid"]); ?>' <?php if($info[ugid] == $cg[ugid]): ?>selected<?php endif; ?>><?php echo ($cg['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="2"><font color="#FF0000">扩展会员分组:</font></td>
                            </tr>
                            <tr>
                                <td><strong>用户组</strong></td>
                                <td><strong>有效期</strong></td>
                            </tr>
                              
                                    
                                    <?php if(is_array($user_groups)): $i = 0; $__LIST__ = $user_groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cg): $mod = ($i % 2 );++$i; if ($ext_datas[$cg['ugid']]) { $checkstr = ' checked'; $updatetime = date('Y-m-d', $ext_datas[$cg['ugid']]['updatetime']); if($updatetime<date('Y-m-d',time())){ $e_gqstr = '<font color="#FF0000">已过期</font>'; } } else { $checkstr = ''; $updatetime = ''; $e_gqstr = ''; } ?>
                                    <tr>
                                        <td  width="10%">
                                            <input type="checkbox" name="ex[ugid][<?php echo ($cg["ugid"]); ?>]" <?php echo ($checkstr); ?>><?php echo ($cg['name']); ?>
                                        </td>
                                        <td align="left"  width="88%">
                                            <input type="text" name="ex[updatetime][<?php echo ($cg["ugid"]); ?>]" value="<?php echo ($updatetime); ?>"><?php echo ($e_gqstr); ?>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <tr>
                                        <td width="10%">会员名称:</td>
                                        <td>
                                            <input style="width:200px;" name="info[username]" type="text" value="<?php echo ($info["username"]); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">密码:</td>
                                        <td>
                                            <input name="info[password]" id="password" type="password" value="<?php echo ($info["password"]); ?>" autocomplete="off">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">确认密码:</td>
                                        <td>
                                            <input name="info[passwordok]" id="passwordok" type="password" value="<?php echo ($info["passwordok"]); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">头像:</td>
                                        <td bgcolor="#FFFFFF" width="66%">
                                       
                                            <?php $__FOR_START_3992__=1;$__FOR_END_3992__=20;for($i=$__FOR_START_3992__;$i < $__FOR_END_3992__;$i+=1){ ?><img src="/Public/images/face/<?php echo ($i); ?>.png">
                                                <input type="radio" name="info[face]" value="<?php echo ($i); ?>" <?php if($info['face'] == $i): ?>checked<?php endif; ?>><?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">真实姓名:</td>
                                        <td width="66%">
                                            <input style="width:200px;" name="info[realname]" type="text" value="<?php echo $info['realname']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">qq:</td>
                                        <td  width="66%">
                                            <input style="width:200px;" name="info[qq]" type="text" value="<?php echo $info['qq']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">城市:</td>
                                        <td width="66%">
                                            <input style="width:200px;" name="info[city]" type="text" value="<?php echo $info['city']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td idth="10%">行业:</td>
                                        <td width="66%">
                                            <input style="width:200px;" name="info[hangye]" type="text" value="<?php echo $info['hangye']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">公司:</td>
                                        <td  width="66%">
                                            <input style="width:200px;" name="info[company]" type="text" value="<?php echo $info['company']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">手机:</td>
                                        <td width="66%">
                                            <input style="width:200px;" name="info[mobile]" type="text" value="<?php echo $info['mobile']; ?>">
                                        </td>
                                    </tr>
                            
                                      <!--以下为地址信息-->
                                    <?php if(!empty($address)): ?><tr>
                                        <td width="10%">收货地址:</td>
                                        <td width="66%">
                                            <?php echo ($address["name"]); ?>&nbsp;&nbsp;<?php echo ($address["mobile"]); ?><br/>
                                            <?php echo ($address["province_name"]); echo ($address["city_name"]); echo ($address["county_name"]); echo ($address["address"]); ?>
                                        </td>
                                    </tr><?php endif; ?>
                                    <tr>
                                        <td width="10%">email:</td>
                                        <td width="66%">
                                            <input style="width:200px;" name="info[email]" type="text" value="<?php echo ($info["email"]); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="34%">过期时间:</td>
                                        <td width="66%">
                                            <input name="info[gqtime]" type="text" value="<?php echo ($info["gqtime"]); ?>"><?php echo ($gqstr); ?>
                                            &nbsp;&nbsp;&nbsp;例：<?php echo date('Y-m-d'); ?>
                                        </td>
                                    </tr>
                        </tbody>
                    </table>
                   <br>
                  <center>
                      <button class="btn btn-success inlineSearch display-inline" name='dosubmit' type="submit">提 交</button>
                  </center>
                    <input type="hidden" name="info[uid]" value="<?php echo ($info["uid"]); ?>">
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
<script type="text/javascript">
  //删除询问框
$(".delete-msg-find").on('click', function(){
    var status = confirm('确定删除本条文章？\n \n 删除后将无法恢复！\n 确定删除吗？？？\n \n ');
    if(!status){
        return false;
    }
});  

</script>
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