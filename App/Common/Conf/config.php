<?php
return array(

	//开启独立模块
    'MODULE_ALLOW_LIST' => array('Home','Admin','Member','Mobile','Api'),
    'DEFAULT_MODULE' => 'Member', //默认模块
	'MODULE_DENY_LIST'    =>  array('Common','Runtime','Lib'),

	//加载配置文件
	'LOAD_EXT_CONFIG' => array('mysql','ueditor_config'),


	//点语法默认解析
	'TMPL_VAR_IDENTIFY' => 'array',

	//自定义session 数据库存储
	'SESSION_TYPE' => 'Db',
    'SESSION_EXPIRE' => 3600*72, //3600秒=1小时后 session过期

    //注册命名空间
	'AUTOLOAD_NAMESPACE' => array(
	    'Lib'     => APP_PATH.'Lib'
	),
	
	//默认参数过滤方法 用于I函数...
	'DEFAULT_FILTER' => 'htmlspecialchars',  

	//URL访问地址不区分大小写
	'URL_CASE_INSENSITIVE' => false,

	// URL访问模式设置 0 (普通模式); 1 (PATHINFO模式); 2 (REWRITE 模式); 3 (兼容模式) 
	'URL_MODEL' => 2,  
	'URL_PATHINFO_DEPR' => '/',

	//显示程序运行信息
	'SHOW_PAGE_TRACE' => false,

    //模板路径相关配置 
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/Public',
        '__STATIC__' => __ROOT__ . '/Public/Static',
        '__ADMIN__'    => __ROOT__ . '/Public/AdminLte',
        '__HOME__'    => __ROOT__ . '/Public/Home',
        '__MEMBER__'  => __ROOT__ . '/Public/Member',
        '__MOBILE__'  => __ROOT__ . '/Public/Mobile',
    ),

	//自定义标签配置
	'TAGLIB_LOAD' => true,	//加载自定义标签库
	'APP_AUTOLOAD_PATH' => '@.TagLib',	//自动加载
	//'TAGLIB_BUILD_IN' => 'Cx,Common\TagLib\Showtags',	//加入系统标签库

    'TMPL_TEMPLATE_SUFFIX' => '.html',  //模板文件的默认后缀
    //sessionID的提交变量
    'VAR_SESSION_ID' =>  'session_id',
    
    //前台用户 SESSION存储的KEY
	'USER_AUTH_UID'    => 'xin_user_id', //用户ID识别号
	'USER_AUTH_UNAME'  => 'xin_username', //用户名称
	'USER_GROUP_ID'    => 'xin_user_group_id', //用户组ID
	'USER_GROUP_UNAME' => 'xin_user_group_name',
	'USER_FACE' => 'xin_user_face',  //用户头像

    // 配置动态缓存方式: File(文件缓存) 或Memcache 或Redis
    'DATA_CACHE_PREFIX' => 'thinkIIS_', // 缓存前缀
    'DATA_CACHE_TIME' => 0,  // 数据缓存有效期 0表示永久缓存
    'DATA_CACHE_SUBDIR' =>  true,    // 使用子目录缓存 (自动根据缓存标识的哈希创建子目录)
    'DATA_PATH_LEVEL'   =>  1,        // 子目录缓存级别
	'DATA_CACHE_TYPE' => 'File',

	'HITUI_VERSION' => '1.0', //WEB程序版本号
	'HITUI_VERSION_IOS' => '1.0', //IOS程序版本号
	'HITUI_VERSION_ANDROID' => '1.0', //Android程序版本号
	'OTHER_DB_PREFIX' => 'v5_',
 
	// Memcache缓存配置参数 
	'MEMCACHE_HOST' => '127.0.0.1',
	'MEMCACHE_PORT' => 11211,

	//Redis缓存配置参数 
	'REDIS_HOST' => '127.0.0.1',
	'REDIS_PORT' => 6379,

	//嗨推学院--微信公众号配置
	'WECHAT_CONFIG' => array(
			//'token'=>'v5php',
			//'appid'=>'wxf2563269021303f0',                    //嗨推正式号
			//'appsecret'=>'cb06e5e74d41fca6b746d2c474ba64f3',  //嗨推正式号
			//'encodingaeskey'=>'flauCL1zTX3xpjGo2WENMayAbpPPd4yTvZxPWu1ZWPm', //填写加密用的EncodingAESKey
			'token'=>'weixin', 								   //个人测试号
			'appid'=>'wx06eac275bfb8ed67',                     //个人测试号
			'appsecret'=>'a242aa44c3059c45c8a9b3dc9a8c7697',   //个人测试号
			'debug'=>true,
			'logcallback'=>'logdebug'
		),
	//嗨推--微信登陆公众号配置
	'WECHAT_CONFIG_1' => array(
			'token'=>'v5php',
			'appid'=>'wx966b03751a92324f',
			'appsecret'=>'807f8cf2b26724e7f7c5cafb1425c4a9',
			'debug'=>true,
			'logcallback'=>'logdebug'
		),
	//--微信登陆公众号配置
		'WECHAT_CONFIG_2' => array(
				'token'=>'wei',
				'appid'=>'wx24bc9a20cbcf6395',
				'appsecret'=>'361edbca360468097d507427d1c330da',
				'encodingaeskey'=>'NTqTQ7OXFNnLG5XGUyJarA9XhExT5JujxZZWs0lI3sN', //填写加密用的EncodingAESKey
				'debug'=>true,
				'logcallback'=>'logdebug'
		),


	//微信、支付宝回调通知域名, 结尾不带'/'
	'PUBLIC_DOMAIN_NAME' => 'http://f.ihitui.com', 

	//微信支付回调通知地址
	'WECHAT_PAY_CONFIG' => array(

		//绑定支付的APPID（必须配置，开户邮件中可查看）
		'appid' => 'wxf2563269021303f0',  

		//商户号（必须配置，开户邮件中可查看）
		'mchid' => '1273049101',

		//商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
		'key' => 'Ygm880106Ygm880106Ygm88010612345',

		//公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）
		'appsecret' => 'cb06e5e74d41fca6b746d2c474ba64f3',

		//证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
		'sslcert_path' => './cert/apiclient_cert.pem',
		'sslkey_path' => './cert/apiclient_key.pem',

		//PC版异步通知地址
		'notify_url_pc' => '/wechatSuccessPc',

		//WAP版异步通知地址
		'notify_url_wap' => '/wechatSuccessWap',

	),

    //支付宝配置
	'ALIPAY_PAY_CONFIG' => array(	
		//应用ID, 您的APPID
		'app_id' => '2017060507424573',

		//商户私钥
		'merchant_private_key' => 'MIIEowIBAAKCAQEAmeYbyEiyjNneVFsv6AKjnIY0o8DBVVe5Du2ucYMRCp7WrWr770FkoThHmNAydS8TSYcnm1cx+8HiSuU+XZecjtIYLNx8Ff3DhCuHKg3ucBIKGVj8rFqJMdW9lf0r2qspdFpBwfRxlCtEalUPDBJfoMRn4V3R+rIB/48uKGrh22x1AYAnJd1eXa+r6lJ2s/53drD6eov079q16l5uxEZPcrvcVJt4I5R7mQaI7kGCy1mZdYvilsHSwzHw4wc+QL08JI4fvv6RNDm8Xm2zw6lM04q4WSFkwsbyFTjeCVjSoesnPuAUBKAo88i3Cxo4gASYlJRqQPdFZMk97bncihGLzwIDAQABAoIBAE+t5pZ0pRTtvAF60LvTmffxOBHMO4y/BU4oWtfkXw9bm5Rfvp5qAfrCk7cXm/g17kt0UVpI89T/1fSm6fo1A9aiCeg4I3qTTwYAL1PjsJ6PiHEFNJTbrwqBOk4MrQbi9WyLSl5r+94V5K8U6Nx8Ksymw43YMF4WiZhR/jjo1ZTvrb4KtwxXaxjn/fqH934ElP9jCZiRunDzlLEjJ4NXn6R7eP1PiHZAUke0aZNlRxz6AnHKaeF+0eIeJzRaAZlUl21g2fgsZVLeNdt5fAWqpioVZKGTMlhNnkfhQSKrSQrLxWAz0XrGPQyX6clZPXhs77/XhP8t+On3p+3YJic45tECgYEAyCJEV/sJC8EIjD5ALWzoSfdbjPSzAuCT5ztl312fPdIkcQS2dZjKggdl3Eb/aAsx+sDcgJpqMDY9EZuPlobMosC94dTPgjBFfzEHXOg5TcK9mdhzjvtKRO7DHlkfUqhGh9E4/4VUJMdf4laT/o6f45qcIQKyvtDERTsX8Ao6fDcCgYEAxNvZovo5Br9OGMuCvXtLqYKfeMwxJpxwLYH3w1e4d5QPD1Inb3Wa4l5fAMdJY4w3SYMlww6K3kpKhHeSKu8fBCIDiSpox5KNhvWmM51Yzh4TZJIb0KruNmZrimh6iZ/POA7rbhvnpnJXgV07TwC2sbI3r4WStgE5mMFb9i0sESkCgYBbMPH/PM2kY3KnpH3NtQArI+C9W4pt1zLNfA0xOBGlM6mTLdiNwO8VTJWnR1p9aAx/+3z9xF56VVyCN2W36vg3eKeMzVE4OxKPoCGAvffObNvDzBLrpajzu++AVo+lNDPfEwBrva7Xi1kvYs/Qf+Bu7zYQ/I/BzpKAESsZHzADBQKBgQCSTJUMows4cXoXwT7zlKrhWhssCgxJFp/joiBAw3NrItSiXTrDgdJOgzX1fSWUXsND1bx9ntQjaXDBy58MW1NgneqkyKjAELEvaGZRG5HA9OcSqecUB8QrF6i6XvUaTHMSxTvAQ+q/b2CK2n/WMcCUhM8PmaQzsOteE+1FIcMLKQKBgCea8fme1iW+thsf/v5vJfjC99nPnRFhh1NTn1MOhY51H0QFz45OZcrt41Qj+FhkHJeDTgLkzZI64a4zMurgDU+qF51i8YcpJ07oykO+jfi07ELOIdwBRIyA7MoEJVNvybjKSTPJCzgFhl16/vfGYS5zcPW1F69IAK8eQ9endglk',
		
		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArVcjPwcSCgsxFYMLYlFZ9MWfVo59kimHTHVJaugljn6uHQw2M16w/p3WWtnKExMRV/HhHeahrUbU3a+owUhI2rrSdSM0wNThqJkPsdPaupOrKItdzkXkSK8QWrumEaP8osRsZXBxQg38FiS8TLV0CjlwYpRIxMixkMMPf8vd0vsVYooWbQVvv0gYfUYtFsLsQM1XesjqkbCLJwX+WyRulJS3SavSG9gTZZVdedSnjkRaoCV38vDtI/yJRBnUP2xSWMiDA2B9b7QgN6AvwSWn6yh6ACuD6e2zZXaFwFilsjykRKR4C4GgDvSDCaGnLKo3kErenLuP1ztA7VBonXpDLQIDAQAB',

		//PC版异步通知地址
		'notify_url_web' => '/alipaySuccessPc',
		
		//PC版同步跳转
		'return_url_web' => '/alipayCallbackPc',

		//WAP版异步通知地址
		'notify_url_wap' => '/alipaySuccessWap',

		//WAP版同步跳转
		'return_url_wap' => '/alipayCallbackWap',

		//编码格式
		'charset' => 'UTF-8',

		//签名方式
		'sign_type'=> 'RSA2',

		//支付宝网关
		'gatewayUrl' => 'https://openapi.alipay.com/gateway.do',
	),


	// 开启路由
	'URL_ROUTER_ON'   =>  true,   
	// 默认路由规则
	'URL_ROUTE_RULES' =>  array(
		'alipayCallbackPc' => 'Member/PayNotify/payCallbackReturn',
		'alipaySuccessPc' => 'Member/PayNotify/alipaySuccess',
		'wechatSuccessPc' => 'Member/PayNotify/weixinSuccess',
		'alipayCallbackWap' => 'Mobile/PayNotify/payCallbackReturn',
		'alipaySuccessWap' => 'Mobile/PayNotify/alipaySuccess',
		'wechatSuccessWap' => 'Mobile/PayNotify/weixinSuccess',
		'jspayWeixinWap' => 'Mobile/Pay/payWeixin', //微信jsPay
		'weixinOpenApi' => 'Member/Weixin/index',  //微信公众号接口回调
	), 



	// 域名部署
    'APP_SUB_DOMAIN_DEPLOY'   => 1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    => array(   
    	'admin.hitui.com'  => 'Admin',  // 域名指向Admin模块
        'xue.hitui.com'  => 'Member',  // 域名指向Member模块
        'kf.hitui.com'   => 'Home',  // 域名指向Home模块
        'wap.xue.hitui.com'   => 'Mobile',  // 域名指向Mobile模块
        'api.hitui.com'   => 'Api',  // 域名指向Api模块
    ),


);
