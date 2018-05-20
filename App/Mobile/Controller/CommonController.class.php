<?php
namespace Mobile\Controller;
use Think\Controller;

//公共控制器
class CommonController extends EmptyController {

    public function _initialize () {
        parent::_initialize();
        //判断用户是否登录
        if (!session(C('USER_AUTH_UID'))) {
            $this->redirect('Login/index');
        }

    }

}
