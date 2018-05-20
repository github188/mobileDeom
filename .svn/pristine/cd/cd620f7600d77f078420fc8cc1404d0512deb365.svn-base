<?php
namespace Admin\Controller;
use Think\Controller;
//网站配置参数

class ConfigController extends CommonController{

	public function index () {
		$db = M('Config');

		if (IS_POST) {
			$data = I('post.',null);
			if (!$data['web_name'] || !$data['web_domain']) $this->error('配置参数不能为空!');

			$data['save_time'] = time();
			$data['save_uid'] = session(C('USER_AUTH_KEY'));
			$db->where(array('id' =>1))->save($data);
			$this->success('修改成功!' ,U(MODULE_NAME.'/Config/index'));

		}else{

			$this->arr = $db->where(array('id' =>1))->find();
			$this->display();
		}

	}


}

?>