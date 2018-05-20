<?php
namespace Admin\Controller;
use Think\Controller;

//公共控制器
class CommonController extends EmptyController {

	public function _initialize () {
		if (!session(C('USER_AUTH_KEY')) && !session('ht_uname')) {
			$this->redirect(MODULE_NAME .'/Login/index');
		}
		$notAuth = in_array(CONTROLLER_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_MODULE')));

        if (C('USER_AUTH_ON')) {
            $Rbac = new \Org\Util\Rbac();
            if (C('USER_AUTH_TYPE') ==2) $Rbac::saveAccessList();
            if (!$Rbac::AccessDecision() && !$notAuth) $this->error('您没有权限！不能操作该功能！');

        }
	}


}