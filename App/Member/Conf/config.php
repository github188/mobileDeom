<?php
return array(
	//'配置项'=>'配置值'

    //伪静态后缀名
    'URL_HTML_SUFFIX'  => 'html',
    
    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => C('DB_PREFIX').'ht_', //session前缀
    'COOKIE_PREFIX'  => C('DB_PREFIX').'ht_', // Cookie前缀 避免冲突

);