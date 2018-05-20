<?php if (!defined('THINK_PATH')) exit();?>﻿<!-- 后台首页模板 -->

<!-- 头部 -->
<!DOCTYPE>
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
<!-- AdminLTE 皮肤. Choose a skin from the css/skinsfolder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="/Public/AdminLte/dist/css/skins/_all-skins.min.css">
<!-- DataTables 表格-->
<link rel="stylesheet" href="/Public/AdminLte/plugins/datatables/dataTables.bootstrap.css">
<!-- iCheck-->
<link rel="stylesheet" href="/Public/AdminLte/plugins/iCheck/flat/blue.css">
<link rel="shortcut icon" href="/Public/Static/images/favicon.ico" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="/Public/AdminLte/js/html5shiv.min.js"></script>
<script src="/Public/AdminLte/js/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	/*头部右侧导航二级菜单*/
	.pull-center{
		text-align:center;
	}
	.pull-center a{
		margin: 0px 8px;
	}
	/*body{
	overflow-y:auto !important
	}*/

</style>
</head>
<body class="skin-blue-light sidebar-mini" style="overflow-y:hidden;overflow-x:hidden;margin-bottom:50px">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo U(MODULE_NAME.'/Index/index');?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>嗨推</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><img src="/Public/Static/images/logo.png" width="40" height="30">&nbsp;&nbsp;<b>嗨推</b></span>
			</a>
	        <!-- 头部导航 header.less -->
	        <nav class="navbar navbar-static-top" role="navigation">
		        <!-- 侧边栏切换按钮-->
		        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			        <span class="sr-only">Toggle navigation</span>
		        </a>
		        <!--头部菜单-->                          
		        <div class="navbar-custom-menu">
		            <ul class="nav navbar-nav">
			            <li>
			            	<a href="<?php echo U(MODULE_NAME.'/Index/allrun');?>"  target="rightContent">
			                    <i class="glyphicon glyphicon-refresh"></i>
			                    <span>清除缓存</span>
			                </a>
			            </li> 
			            <li>
			                <a href="/" target="_blank">
			                    <i class="glyphicon glyphicon-home"></i>
			                    <span>网站前台</span>
			                </a>
			            </li>
			            <li class="dropdown user user-menu">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				                <i class="glyphicon glyphicon-user"></i>
				                <span class="hidden-xs">欢迎你：<?php echo session('cg_uname');?>  <?php echo ($role_remark); ?></span>
			                </a>
			                <ul class="dropdown-menu">
				                <li class="user-footer">
					                <div class="pull-center">
					                   	<a href="<?php echo U(MODULE_NAME.'/Rbac/editUser', array('uid' => session(C('USER_AUTH_KEY'))));?>" target="rightContent" class="btn btn-default btn-flat">修改密码</a>
					                   	<a href="<?php echo U(MODULE_NAME.'/Login/logout');?>" class="btn btn-default btn-flat">安全退出</a>
					                </div>
				                </li>
				            </ul>
			            </li>
			            <!-- 换肤控制栏 -->
			            <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-tree"></i> 换肤</a></li>
		            </ul>
		        </div>
		    </nav>
		</header>

<!-- 左侧导航 -->
    <!-- 左侧导航 -->
    <aside class="main-sidebar">
        <section class="sidebar"> 
            <ul class="sidebar-menu"> 
                <!-- 数据库读取导航菜单开始  style="overflow-y:auto;"-->
                <?php if(is_array($left)): foreach($left as $k=>$v): ?><li class="treeview">
                        <a href="javascript:void(0)">
                            <i class="fa <?php echo ($v["attr"]); ?>"></i> 
                            <span><?php echo ($v["title"]); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if($v["menu"]): if(is_array($v["menu"])): $i = 0; $__LIST__ = $v["menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$var): $mod = ($i % 2 );++$i; $last = count($var['left']); parse_str(str_replace(',',htmlspecialchars_decode('&amp;'),$var['url']),$url); ?>
                                    <li>
                                        <a href="<?php if($last == 3): echo U($var['left'][1]['name'].'/'.$var['left'][2]['name'],$url); else: echo U($var['left'][0]['name'].'/'.$var['left'][1]['name'].'/index',$url); endif; ?>" target='rightContent'>
                                            <i class="fa fa-circle-o"></i><?php echo ($var["title"]); ?>
                                        </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php else: ?>
                                <li><a href="#">暂没有菜单！</a></li><?php endif; ?>
                        </ul>
                    </li><?php endforeach; endif; ?>     
            </ul>
        </section>
    </aside>


<!-- 工作区scrolling="no" -->
<section class="content-wrapper right-side" id="riframe">
    <iframe id='rightContent' name='rightContent' src="<?php echo U(MODULE_NAME .'/Index/welcome');?>" width='100%' height='100%' frameborder="0" style="margin-top:51px"></iframe>
</section>

<!-- 底部 -->
		<!-- 底部 -->
<!-- 		<footer class="main-footer">
		    <div class="pull-right hidden-xs">
		    	代理商程序版本：V1.0
		    </div>
		    <strong>Copyright &copy; 2016 <a href="http://www.caigecp.com" target="_blank">代理商</a>.</strong> 版权所有。
		</footer> -->
	    
	    <!-- 换肤控制栏 -->
	    <aside class="control-sidebar control-sidebar-dark">
	        <!-- 创建选项卡 -->
	        <!--
	        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
	            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-at"></i></a></li>
	            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	        </ul>
	        -->
	        <!-- 创建选项卡 -->
	        <div class="tab-content">
		      	<!-- 默认标签内容 -->
		        <div class="tab-pane" id="control-sidebar-home-tab"></div>
		        <!-- 数据选项卡内容 -->
		        <div class="tab-pane" id="control-sidebar-stats-tab">数据选项卡内容</div>
		        <!-- 设置选项卡内容 -->
		        <div class="tab-pane" id="control-sidebar-settings-tab"></div>
	        </div>
	    </aside>
	    <div class="control-sidebar-bg"></div>

	</div>

<!-- jQuery 2.2.0 -->
<script src="/Public/AdminLte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/Public/AdminLte/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.6 -->
<script src="/Public/AdminLte/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/Public/AdminLte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- FastClick -->
<script src="/Public/AdminLte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/Public/AdminLte/dist/js/app.min.js"></script>
<!-- DataTables表格 -->
<script src="/Public/AdminLte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/Public/AdminLte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/Public/AdminLte/dist/js/demo.js"></script>

 <!--弹窗js 参考文档 http://layer.layui.com/--> 
<script src="/Public/AdminLte/layer/layer.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("body").css("overflow-y","auto !important");
    //$('.main-sidebar').height($(window).height()-50);
//    $('.main-sidebar').css('marginTop',"56px");
    $('.main-sidebar').height($(document).height());
	$(".treeview-menu li").on("click",function(){
		$(".menu-open li").removeClass("active"),$(this).addClass("active")
	})
});

var tmpmenu = 1;
function makecss(obj,mod_id){
	$('#menu_'+tmpmenu).removeClass('active');
	$(obj).addClass('active');
	tmpmenu = mod_id;
}

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
</script>

</body>
</html>