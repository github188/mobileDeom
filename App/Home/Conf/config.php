<?php
return array(
	
    //伪静态后缀名
    'URL_HTML_SUFFIX' => 'html',  

	'USER_AUTH_UID' => 'xue_uid', //用户SESSION识别号
	'USER_AUTH_UNAME' => 'xue_uname',

    
    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => C('DB_PREFIX').'ht_', //session前缀
    'COOKIE_PREFIX'  => C('DB_PREFIX').'ht_', // Cookie前缀 避免冲突

    'URL_PATHINFO_DEPR' => '_',

 
	// 开启路由
	'URL_ROUTER_ON'   =>  true,   
	// 默认路由规则 针对模块
	'URL_ROUTE_RULES' =>  array(
		'list/:cid\d' => 'Home/Index/articleList',
		'c/:aid\d' => 'Home/Index/articleContent',

	), 

	// URL映射定义规则
	// 'URL_MAP_RULES'   =>  array(
	// 	'list/:cid\d' => 'Home/Index/articleList',
	// 	'c/:aid\d' => 'Home/Index/articleContent',
	// ), 


);