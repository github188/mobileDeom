<?php
/**
 * 后台配置文件
 */
return array(

    //RBAC权限认证配置
    'RBAC_SUPERADMIN' => 'admin',           //指定超级管理员账号
    'ADMIN_AUTH_KEY' => 'superadmin',       //指定超级管理员识别号
    'USER_AUTH_ON' => true,                 //是否开启RBAC权限认证
    'USER_AUTH_TYPE' => 1,                  //验证类型：( 1: 为登陆验证,  2: 为时时验证 )
    'USER_AUTH_KEY' => 'ht_uid',               //管理员认证识别号
    'NOT_AUTH_MODULE' => 'Index',           //无须验证的控制器
    'NOT_AUTH_ACTION' => 'readArticle,uploadArticle',     //无须验证的动作方法
    'REQUIRE_AUTH_MODULE'  => '',          // 默认需要认证控制器
    'REQUIRE_AUTH_ACTION'  => '',          // 默认需要认证动作方法
    'USER_AUTH_GATEWAY' => 'Login/index',   // 默认登陆认证网关
    'USER_AUTH_MODEL'  =>  'manage',        // 默认验证数据用户表模型
    'AUTH_PWD_ENCODER' =>  'md5',           // 用户认证密码加密方式
    'GUEST_AUTH_ON'    =>  false,           // 是否开启游客授权访问
    'GUEST_AUTH_ID'   =>  0,                // 游客的用户ID
    'RBAC_ROLE_TABLE' => C('DB_PREFIX').'role',      //角色表名称
    'RBAC_USER_TABLE' => C('DB_PREFIX').'role_user', //角色与管理员的中间表名称
    'RBAC_ACCESS_TABLE' => C('DB_PREFIX').'access',  //权限表名称
    'RBAC_NODE_TABLE' => C('DB_PREFIX').'node',      //节点表名称

    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => C('DB_PREFIX').'ht_super_', //session前缀
    'COOKIE_PREFIX'  => C('DB_PREFIX').'ht_super_', // Cookie前缀 避免冲突
);