<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

//栏目分类管理控制器
class CategoryController extends CommonController {
	//分类栏目列表
	public function index () {

		$db = M('Category');
		$gid = I('get.gid', 0, 'intval');
		$cate = $db->where(array('group' => $gid))->order('sort ASC')->select();

		$article = M('Article');
		foreach ($cate as $k => $v) {
			$cate[$k]['count_article'] = $article->where(array('category_id' => $v['id']))->count();
		}

		$cate = Category::unlimitedForLevel($cate);
		$this->assign('cate', $cate);

		//栏目分组 0问题文章 1关于我们 
		$this->group_list = getGroupCategory();
		$this->gid = $gid;

		$this->display();
	}

	//添加分类栏目
	public function addCate () {
		$gid = I('get.gid', 0, 'intval');
		if (IS_POST){
			$name = I('post.name','','trim');
			if (empty($name)) {
				$this->error('栏目名称不能为空!');
			}

			$cate = array(
				'name' => $name,
				'sort' => I('post.sort',0,'intval'),
				'group' => $gid,
				'status' => I('post.status',0,'intval'),
				'pid' => I('post.pid',0,'intval')
			);

			if (M('Category')->add($cate)) {
				$this->success('添加成功!' ,U(MODULE_NAME.'/Category/index', array('gid' => $gid)));
			}else{
				$this->error('添加失败!');
			}

		}else{
			$this->gid = $gid;
			$this->pid = I('get.pid', 0, 'intval');
			$this->display();
		}

	}

	//修改分类栏目
	public function editCate () {
		$db = M('Category');
		$gid = I('get.gid', 0, 'intval');

		if (IS_POST){
			if (I('get.sortCate',0,'intval')) {
				foreach (I('post.sortArr') as $id => $sort) {
					$db->where(array('id' => intval($id), 'group' => $gid))->setField('sort', intval($sort));
				}

			}else{

				$name = I('post.name','','trim');
				if (empty($name)) {
					$this->error('栏目名称不能为空!');
				}

				$data = array(
					'name' => $name,
					'sort' => I('post.sort',0,'intval'),
					'status' => I('post.status',0,'intval')
					);
				$db->where(array('id' => I('post.cid',0,'intval')))->save($data);
			}
			$this->success('修改成功', U(MODULE_NAME .'/Category/index', array('gid' => $gid)));
		}else{
			
			$this->gid = $gid;
			$this->cate = $db->where(array('id' => I('get.pid', 0, 'intval'), 'group' => $gid))->find();
			$this->list = $db->where(array('pid' => 0, 'group' => $gid))->select();
			$this->display();
		}

	}

	//删除分类栏目
	public function delCate () {
		$gid = I('get.gid', 0, 'intval');
		$pid = M('Category')->where(array('pid' => I('get.pid', 0, 'intval'), 'group' => $gid))->getField('pid');
		if (!$pid) {
			M('Category')->where(array('id' => I('get.pid', 0, 'intval'), 'group' => $gid))->delete();
			$this->success('删除成功', U(MODULE_NAME .'/Category/index', array('gid' => $gid)));
		}else{
			$this->error('删除失败，请先删除下级分类栏目');
		}
		
	}

}