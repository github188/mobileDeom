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

<div class="wrapper" style="font-family: '微软雅黑';">

    <!-- 内容标题开始 -->
    <div id="breadcrumbs" class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> 后台首页</a></li>
            <li><a href="#">视频管理</a></li>
            <li class="active">答疑管理</li>
        </ol>
    </div>
    <!-- 内容标题结束 -->

    <!-- 主要内容开始 -->
    <div class="col-md-12">

        <!-- 自定义标签开始 -->
        <div class="nav-tabs-custom">

            <!-- 标签内容开始 -->
            <div class="tab-content">
                <div id="tab_1" class="tab-pane active">

                    <h4 align="center"><i class="fa fa-list-ul"></i> 视频答疑管理</h4>

                    <form style="margin:15px 0px 10px 0px;" class="form-inline display-inline" method="post" action="<?php echo U(MODULE_NAME.'/Video/videoQuestion');?>">
                        <div class="form-group inlineForm display-inline">
                            <label><b>用户名：</b></label>
                            <input type="text" class="form-control" name="username" value="<?php echo cookie('username');?>">
                        </div>&nbsp; &nbsp;
                        <div class="form-group inlineForm display-inline">
                            <label><b>问题关键词：</b></label>
                            <input type="text" class="form-control" name="question" value="<?php echo cookie('question');?>">
                        </div>&nbsp; &nbsp;
                        <button type="submit" class="btn btn-success inlineSearch display-inline">查找</button>

                    </form>
                    <h6>数据统计：总计[<font color="red"><?php echo ($count); ?></font>]条记录</h6>
                    <table id="example" class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <td align="center">ID</td>
                                <td align="center">视频组</td>
                                <td align="center">视频标题</td>
                                <td align="center">用户名</td>
                                <td align="center">问题</td>
                                <td align="center">状态</td>
                                <td align="center">日期</td>
                                <td align="center">操作</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  ?>
                             <?php if(is_array($video_question)): $k = 0; $__LIST__ = $video_question;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr>
                                        <td><?php echo ($v["id"]); ?></td>
                                        <td><?php echo ($v["video_group"]); ?></td>
                                        <td><?php echo ($v["video_title"]); ?></td>
                                        <td><?php echo ($v["username"]); ?></td>
                                        <td><?php echo (jiequ($v["question"],0,40,'')); ?></td>
                                        <td><?php echo ($v['is_reply']==1?'已回复':'待回复'); ?></td>
                                        <td><?php echo (date("Y-m-d H:i",$v["addtime"])); ?></td>
                                        <td>
                                            <?php $curr_page = I('get.p',1,'intval'); ?>
                                            <a onclick="videoQuestionShow(this,<?php echo ($v['id']); ?>,'<?php echo ($v['video_title']); ?>');" href="javascript:;" class="btn btn-info">
                                                <i class="fa fa-eye"></i>查看
                                            </a>
                                            <a onclick="Delete(this,<?php echo ($v['id']); ?>,<?php echo ($curr_page); ?>)" href="javascript:;" class="btn btn-danger">
                                                <i class="fa fa-remove"></i>删除
                                            </a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                            <?php if(!$video_question): ?><tr>
                                    <td colspan="9" align="center"> <i class="fa fa-info-circle" aria-hidden="true" style="font-size: 18px;color: red;">  暂无数据!</i></td>
                                </tr><?php endif; ?>
                            <?php if($totalPages > 1): ?><tr>
                                    <td colspan="9" align="center"><div class="pages"><?php echo ($page); ?></div> </td>
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

<script>
    //显示问题弹窗
    function videoQuestionShow(obj,id,title){
        var url = "<?php echo U(MODULE_NAME.'/Video/videoQuestionShow','',true,true);?>"+'?question_id='+id;
        //iframe窗
        layer.open({
            type: 2,
            title: '问题来源视频：'+title,
            maxmin: true, //开启最大化最小化按钮
            closeBtn: 1, //不显示关闭按钮
            shade: [0.5],
            shadeClose:1,
            area: ['800px', '700px'],
            offset: ['50px'], //右下角弹出
            //time: 2000, //2秒后自动关闭
            anim: 3,
            content: [url], //iframe的url，no代表不显示滚动条
            end: function(){ //关闭的时候执行的函数
                
            }
        });
    }

    //删除功能
    function Delete(obj,id,page){

        var url = "<?php echo U(MODULE_NAME.'/Video/videoQuestionDelete','',true,true);?>"+'?id='+id+'&p='+page;
        //console.log(url);return;
        //询问框
        var index = layer.confirm('确定要删除该提问吗？该提问下的回答也会被删除，不可恢复！', {
            shade:0.6,
            skin: 'layui-layer-molv', //样式类名
            btn: ['确定','取消']       //按钮
        }, function(){
            layer.close(index);
            location.href = url;
        }, function(){
            layer.close(index);
        });
    }

</script>