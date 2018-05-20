<?php
namespace Admin\Controller;
use Think\Controller;

//导航栏菜单控制器
class MenuController extends CommonController {

	public function index () {
		$this->menu = M('Menu')->order('sort')->select();
		$this->display();
	}

	//添加导航栏
	public function addMenu () {
		if (IS_POST) {
			if (M('menu')->add(I('post.',''))) {
				$this->success('添加成功', U(MODULE_NAME .'/Menu/index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->display();
		}

	}

	//修改导航栏
	public function editMenu () {
		if (IS_POST) {
			M('menu')->save(I('post.'));

			$this->success('修改成功', U(MODULE_NAME .'/Menu/index'));

		}else{
			$this->menu = M('menu')->where(array('id' => I('get.mid','0','intval')))->find();
			$this->display();
		}
	}

	//删除导航栏
	public function delete () {
		$menu_id = M('node')->where(array('menu_id' => I('get.mid','0','intval')))->find();
		if (!$menu_id) {
			M('menu')->where(array('id' => I('get.mid','0','intval')))->delete();

			$this->success('删除成功', U(MODULE_NAME .'/Menu/index'));
		}else{
			$this->error('删除失败，请先在节点管理取消所属该导航栏！');
		}
	}

}