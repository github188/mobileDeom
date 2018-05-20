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

<style>
    @media screen and (max-width:1920px){


    }
    @media screen and (max-width:1680px){


    }
    @media screen and (max-width:1440px){
          .newTd{
              padding: 14px 0 !important;
              padding-left: 1% !important;
          }
        .newTd a{
            padding: 2px 10px !important;
            float: left;
            margin-right: 1%;
            width: 18%;
        }
    }


</style>

<div class="wrapper" style="font-family: '微软雅黑';">

    <!-- 内容标题开始 -->
    <div id="breadcrumbs" class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> 后台首页</a></li>
            <li><a href="#">用户管理</a></li>
            <li class="active">用户列表</li>
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
                    <form style="margin:15px 0px 10px 0px;" class="form-inline display-inline" method="post" action="<?php echo U(MODULE_NAME.'/User/userList');?>">
                        <div class="form-group inlineForm display-inline">
                            <label><b>用户组：</b></label>
                            <select class="form-control inlineSelect" name="group_id">
                                <option value="0" >  全部 </option>
                                <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($condition[group_id] == $v[id]): ?>selected="selected"<?php endif; ?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>&nbsp; &nbsp;&nbsp;
                        <div class="form-group inlineForm display-inline">
                            <label><b>用户名：</b></label>
                            <input type="text" class="form-control" name="username" value="<?php echo ($condition[username]); ?>" >
                        </div>

                        <div class="form-group inlineForm display-inline">
                            <label><b>qq号码：</b></label>
                            <input type="text" class="form-control" name="qq" value="<?php echo ($condition[qq]); ?>" >
                        </div>&nbsp; &nbsp;
                      <div class="form-group inlineForm display-inline">
                            <label><b>手机号码：</b></label>
                            <input type="text" class="form-control" name="mobile" value="<?php echo ($condition[mobile]); ?>">
                      </div>&nbsp; &nbsp;


                         <div class="form-group inlineForm display-inline">
                            <label><b>时间类型：</b></label>
                            <input name="time_type" type="radio" value="0" <?php echo ($condition[time_type] ==0?'checked=checked':''); ?>>全部
                            <input name="time_type" type="radio" value="1" <?php echo ($condition[time_type] ==1?'checked=checked':''); ?>>即将过期
                            <input name="time_type" type="radio" value="2" <?php echo ($condition[time_type] ==2?'checked=checked':''); ?>>已经过期
                        </div>&nbsp; &nbsp;
                        <button type="submit" class="btn btn-success inlineSearch display-inline">提交查询</button>
                        <div class="pull-right" style="display:block;margin:15px 0px 10px 0px;">
                        <a class="btn btn-info" href="<?php echo U(MODULE_NAME.'/User/userAdd');?>" >
                            <i class="fa fa-plus"></i> 添加新会员
                        </a>
                    </div>

                    </form>
                    <h6>会员统计：总计[<font color="red"><?php echo ($count); ?></font>]名会员</h6>
                    <table id="example" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>分组</td>
                                <td>会员</td>
                                <td>qq</td>
                                <td>手机</td>
                                <td>注册</td>
                                <!--<td>邀请人</td>-->
                                <!--<td>开通时间</td>-->
                                <td>过期时间</td>
                                <td>学习币</td>
                                <td>总佣金(元)</td>
                                <td>积分</td>
                                <td>状态</td>
                                <td>操作</td>
                            </tr>
                        </thead>
                        <tbody>
                             <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($v["user_id"]); ?></td>
                                        <td><img src="/Public/Static/images/user_group/<?php echo ($v["user_group_id"]); ?>.png" alt="会员组"><?php echo ($v['group_name']); ?></td>
                                        <td><?php echo ($v["username"]); ?></td>
                                        <td><?php echo ($v["qq"]); ?></td>
                                        <td><?php echo ($v["mobile"]); ?></td>
                                        <td title="<?php echo date('Y-m-d H:i',$v['reg_time']);?>"><?php echo date('Y-m-d',$v['reg_time']);?></td>
                                        <!--<td><?php echo ($v["username_a"]); ?></td>-->
                                        <!--<td><?php echo date('Y-m-d',$v['start_time']);?></td>-->
                                        <td><?php echo date('Y-m-d',$v['end_time']); echo ($v['end_time'] < time()?'<font color="#FF0000">已过期</font>':''); ?></td>
                                        <td><?php echo ($v["currency"]); ?></td>
                                        <td><?php echo ($v["brokerage"]); ?></td>
                                        <td><?php echo ($v["integral"]); ?></td>
                                        <td>
                                            <?php if($v['is_hack']==1): ?><font style="border-radius: 5px;padding:2px 3px;">锁定</font>
                                            <?php else: ?>
                                                <font style="border-radius: 4px;padding:2px 3px;">正常</font><?php endif; ?>
                                        </td>
                                        <td style="border-bottom:1px dotted #EDEDED" class="newTd">
                                            <?php $curr_page = I('get.p',1,'intval'); ?>
                                            <a class="btn btn-sm btn-primary" href="<?php echo U(MODULE_NAME.'/User/userEdit',array('user_id'=>$v['user_id'],'page'=>$curr_page));?>" title="编辑">
                                               <!--<i class="fa fa-pencil"></i>-->
                                                编辑
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="<?php echo U(MODULE_NAME.'/User/userHackAdd',array('user_id'=>$v['user_id'],'page'=>$curr_page));?>" title="拉黑">
                                               <!--<i class="fa fa-hacker-news"></i>-->
                                                拉黑
                                            </a>
                                            <a class="btn btn-sm btn-danger" onclick="Delete(this,<?php echo ($v['user_id']); ?>,<?php echo ($curr_page); ?>)" href="javascript:;" title="删除">
                                               <!--<i class="fa fa-times"></i>-->
                                                删除
                                            </a>
                                             <a class="btn btn-sm btn-info"  target="_black" href="http://xue.quan5fen.com/?m=front_new&c=index&a=login_admin&username=<?php echo ($v['username']); ?>&password=<?php echo ($v['password']); ?>&encrypt=<?php echo ($v['encrypt']); ?>"  title="登录平台">
                                               <!--<i class="fa fa-laptop"></i>-->
                                                 登录
                                            </a>
                                              <a class="btn btn-sm btn-success" href="<?php echo U(MODULE_NAME.'/User/send_message',array('user_id'=>$v['user_id']));?>"  title="测试模板消息">
                                               <!--<i class="fa fa-send"></i>-->
                                                  消息
                                            </a>
                                            
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                            <?php if(!$info): ?><tr>
                                    <td colspan="12" align="center"> 没有数据！</td>
                                </tr><?php endif; ?>
                            <?php if($totalPages > 1): ?><tr>
                                    <td colspan="12" align="center"><div class="pages"><?php echo ($page); ?></div> </td>
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
<script type="text/javascript">
    //删除功能
    function Delete(obj,id,page){

        var url = "<?php echo U(MODULE_NAME.'/User/userDelete','',true,true);?>"+'?user_id='+id+'&p='+page;
        //console.log(url);return;
        //询问框
        var index = layer.confirm('确定要删除该会员吗？该会员下的所有信息也会被删除，不可恢复！请慎重选择', {
            shade:0.6,
            icon:2,
            offset:['200px'],
            skin: 'layui-layer-molv', //样式类名
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(index);
            location.href = url;
        }, function(){
            layer.close(index);
        });
    }

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