<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

//微信文章管理控制器
class WechatController extends CommonController {

	//微信自动回复消息文章列表
	public function index () {

        $cache = cookie('WechatIndex') ? cookie('WechatIndex') : array('status' => 2);
        $status = I('status',intval($cache['status']),'intval'); 
        $title = filtrationSrt(strip_tags(I('title',$cache['title'])));
        $getArr = array(
        	'title' => $title,
        	'status' => $status
        	);
        if (array_diff_assoc($getArr, $cache)) {
            cookie('ArticleIndex', $getArr);
        }

        $where = array();
        if ($status <2) {
            $where['status'] = $status;
        }

        if ($title) {
            $where['title'] = array('like','%'.$title.'%');
        }
        $this->title = $title;
        $this->status = $status;

		$this->arr = M('wechat_auto', C('OTHER_DB_PREFIX'))->where($where)->order('id desc')->select();
		$this->display();
	}

	//添加自动消息文章
	public function addWechatArticle () {
		$db = M('wechat_auto', C('OTHER_DB_PREFIX'));
		if (IS_POST){
			if (empty($_POST['title'])) {
				$this->error('文章标题不能为空!');
			}
			if (empty($_POST['content'])) {
				$this->error('文章内容不能为空!');
			}
			$arr = array(
				'title' => I('post.title','','strip_tags'),
				'description' => I('post.description',0,'strip_tags'),
				'status' => I('post.status',0,'intval'),
				'url' => I('post.url'),
				'img_url' => I('post.img_url'),
				'content' => I('post.content','','htmlspecialchars'),
				'save_time' => time(),
				'add_time' => time()
			);

			if ($db->add($arr)) {
				$this->success('添加成功!' ,U(MODULE_NAME.'/Wechat/index'));
			}else{
				$this->error('添加失败!');
			}

		}else{

			$this->display();
		}

	}

	//修改自动消息文章
	public function editWechatArticle () {
		$db = M('wechat_auto', C('OTHER_DB_PREFIX'));
		if (IS_POST){
			if (empty($_POST['title'])) {
				$this->error('文章标题不能为空!');
			}
			if (empty($_POST['content'])) {
				$this->error('文章内容不能为空!');
			}
			$arr = array(
				'title' => I('post.title','','strip_tags'),
				'description' => I('post.description',0,'strip_tags'),
				'status' => I('post.status',0,'intval'),
				'url' => I('post.url'),
				'img_url' => I('post.img_url'),
				'content' => I('post.content','','htmlspecialchars'),
				'save_time' => time()
			);

			$db->where(array('id' => I('post.aid',0,'intval')))->save($arr);
			$this->success('修改成功!' ,U(MODULE_NAME.'/Wechat/index'));


		}else{
			$aid = I('get.aid', 0, 'intval');
			$this->arr = $db->where(array('id' => $aid))->find();
			$this->display();
		}

	}

	//删除自动消息文章
	public function delWechatArticle () {
		$aid = I('get.aid', 0, 'intval');
		if (M('wechat_auto', C('OTHER_DB_PREFIX'))->where(array('id' => $aid))->delete()) {
			$this->success('删除成功！', U(MODULE_NAME .'/Wechat/index'));
		}else{
			$this->error('删除失败！');
		}
		
	}

}