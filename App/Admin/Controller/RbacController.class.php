<?php
namespace Admin\Controller;
use Think\Controller;

//RBAC权限管理控制器
class RbacController extends CommonController {

	//管理员列表
	Public function index () {

		$where = array('id' => array('NEQ',session(C('USER_AUTH_KEY'))), 'username' => array('NEQ',C('RBAC_SUPERADMIN')));

		$db = D('ManageRelation');
        $count = $db->where($where)->count('id'); //统计总条数
		$page = new \Think\Page($count, 15); //分页类
		$limit = $page->firstRow .','. $page->listRows;

		$this->user = $db->where($where)->limit($limit)->field('password', true)->relation(true)->select();
		$this->page = $page->show();
		$this->totalPages = $page->totalPages;

		$this->display();
	}

	//添加管理员
	Public function addUser () {
		if(IS_POST){
			if (empty($_POST['user']) || empty($_POST['pass'])) {
				$this->error('账号与密码不能为空!');
			}
			if (empty($_POST['role_id'])) {
				$this->error('所属角色不能为空!');
			}
			$uname = M('manage')->where(array('username' => I('post.user','')))->getField('username');
			if ($uname) {
				$this->error('此用户账号已存在!');
			}

			$user = array(
				'username' => I('post.user'),
				'name' => I('post.name'),
				'password' => I('post.pass', '', 'md5'),
				'type' => 1,
				'sex' => I('post.sex',0,'intval'),
				'email' => I('post.email'),
				'tel' => I('post.tel'),
				'lock' => I('post.lock'),
				'login_time' => time(),
				'login_ip' => get_client_ip(),
				'reg_time' => time(),
				'reg_ip' => get_client_ip()
			);

			//添加管理员与角色
			$role = array();
			if ($uid = M('manage')->add($user)) {
				$role[] = array(
					'role_id' => I('post.role_id','0','intval'),
					'user_id' => $uid
				);
				D('RoleUser')->addAll($role);

				$this->success('添加成功!' ,U(MODULE_NAME.'/Rbac/index'));
			}else{
				$this->error('添加失败!');
			}
		}else{
			$this->role = D('Role')->select(); //角色
			$this->display();
		}
	}


	//修改管理员信息
	public function editUser () {
		if(IS_POST){

			if (!I('post.uid','0','intval')) {
				$this->error('出错了!');
			}
			$user = array(
				'name' => I('post.name'),
				'email' => I('post.email'),
				'tel' => I('post.tel'),
				'sex' => I('post.sex')
			);

			if (I('post.pass')) {
				$user['password'] = I('post.pass', '', 'md5');
			}

			if (I('post.lock','0','intval')) {
				$user['lock'] = I('post.lock','0','intval');
			}

			//修改用户信息
			M('manage')->where(array('id' => I('post.uid','0','intval')))->save($user);

			if (I('post.role_id','0','intval')) {
				//清空原有所属角色
				D('RoleUser')->where(array('user_id' => I('post.uid','0','intval')))->delete();

				$role = array(
					'role_id' => I('post.role_id'),
					'user_id' => I('post.uid','0','intval')
				);
				//修改插入用户所属角色
				D('RoleUser')->add($role);
			}

			$this->success('修改成功!' ,U(MODULE_NAME.'/Rbac/index'));
		}else{
			
			$this->user = D('ManageRelation')->field('password',true)->where(array('id' => I('get.uid','0','intval')))->relation(true)->find();
			$this->role = D('Role')->select();
			$this->assign('super', I('get.super'));
			$this->display();
		}
	}


	//删除管理员信息
	public function userDelete () {
		if (M('manage')->where(array('id' => I('get.uid','0','intval')))->delete()) {
			//清空原有所属角色
			D('RoleUser')->where(array('user_id' => I('get.uid','0','intval')))->delete();

			$this->success('删除成功!' ,U(MODULE_NAME.'/Rbac/index'));
		}else{
			$this->error('删除失败!');
		}	
	}

	//角色列表
	Public function role () {
		$this->role = D('Role')->select();
		$this->display();
	}


	//添加角色
	Public function addRole () {
		if(IS_POST){
			$uname = D('Role')->where(array('name' => I('post.name','')))->getField('name');
			if ($uname) {
				$this->error('此角色名称已存在!');
			}
			$data = array(
				'name' => I('post.name'),
				'status' => I('post.status','0','intval'),
				'remark' => I('post.remark')
			);
			if (D('Role')->add($data)) {

				$this->success('添加成功!' ,U(MODULE_NAME.'/Rbac/role'));
			}else{
				$this->error('添加失败!');
			}
		}else{
			$this->display();
		}
	}


	//修改角色
	public function editRole () {

		if(IS_POST){
			$data = array(
				'name' => I('post.name'),
				'status' => I('post.status','0','intval'),
				'remark' => I('post.remark')
			);
			D('Role')->where(array('id' => I('post.rid','0','intval')))->save($data);

			$this->success('修改成功!' ,U(MODULE_NAME.'/Rbac/role'));
		}else{
			$this->role = D('Role')->where(array('id' => I('get.rid','0','intval')))->find();
			$this->display();
		}
	}


	//删除角色
	public function roleDelete () {
		$role =D('RoleUser')->field(role_id)->where(array('role_id' => I('get.rid','0','intval')))->select();
		if (!$role) {
			D('Role')->where(array('id' => I('get.rid','0','intval')))->delete();

			$this->success('删除成功!' ,U(MODULE_NAME.'/Rbac/role'));
		}else{
			$this->error('删除失败，请先取消正在使用中的用户所属该角色!');
		}	
	}



	//节点列表
	Public function node () {

		$db = D('NodeRelation');
		$field = array('id','name','title','pid','sort','status','menu_id','menu_status');
		$node = $db->field($field)->relation(true)->select();
		$this->node = node_merge($node);

		$this->display();
	}

	//添加节点
	Public function addNode (){
		if(IS_POST){
			if (D('Node')->add(I('post.'))) {
				$this->success('添加成功!' ,U(MODULE_NAME.'/Rbac/node'));
			}else{
				$this->error('添加失败!');
			}
		}else{
			//查找全部导航栏
			$this->menu = M('menu')->order('sort')->select();

			$this->pid = I('get.pid',0,'intval');
			$this->level = I('get.level',1,'intval');

			switch($this->level){
				case 1 :
				$this->type = '应用模块';
				break;

				case 2 :
				$this->type = '控制器';
				break;

				case 3 :
				$this->type = '动作方法';
				break;
			}

			$this->display();
		}
	}


	//修改节点信息
	public function editNode () {
		if(IS_POST){
			D('Node')->where(array('id' => I('post.nid',0,'intval')))->save(I('post.'));

			$this->success('修改成功!' ,U(MODULE_NAME.'/Rbac/node'));
		}else{
			//查找全部导航栏
			$this->menu = M('menu')->order('sort')->select();

			$field = array('id','name','title','status','remark','sort','menu_id','menu_status','level','url');
			$this->node = D('Node')->field($field)->where(array('id' => I('get.pid',0,'intval')))->find();
			$level = I('get.level',1,'intval');
			switch($level){
				case 1 :
				$this->type = '应用模块';
				break;

				case 2 :
				$this->type = '控制器';
				break;

				case 3 :
				$this->type = '动作方法';
				break;
			}
			$this->display();
		}
	}


	//删除节点信息
	public function nodeDelete () {
		$node =D('Node')->field('pid')->where(array('pid' => I('get.pid',0,'intval')))->select();
		if (!$node) {
			D('Node')->where(array('id' => I('get.pid',0,'intval')))->delete();
			//清空用户所属的权限
			D('Access')->where(array('node_id' => I('get.pid',0,'intval')))->delete();
			$this->success('删除成功!' ,U(MODULE_NAME.'/Rbac/node'));
		}else{
			$this->error('删除失败,需先删除下级!');
		}	
	}

	//配置权限
	Public function access () {
		if(IS_POST){
			// p($_POST['access']);die;
			$rid = I('post.rid',0,'intval');
			$db = D('Access');
			$accessPost = I('post.access');

			//清空原权限
			$db -> where(array('role_id' => $rid))->delete();

			//组合新权限
			$data = array();
			foreach ($accessPost as $v) {
				$tmp = explode('_', $v);
				$data[] = array(
					'role_id' => $rid,
					'node_id' => $tmp[0],
					'level' => $tmp[1]
					);
			}
			// p($data);die;
			//插入新权限
			if ($db->addAll($data)) {
				$this->success('修改权限成功!' ,U(MODULE_NAME.'/Rbac/role'));

			}else{
				$this->error('修改权限失败!');
			}
		}else{
			$rid = I('get.rid',0,'intval');
			$field = array('id','name','title','pid');
			$node = D('Node')->order('id, sort')->field($field)->select();

			//原有权限
			$access = D('Access')->where(array('role_id' => $rid))->getField('node_id', true);
			
			$this->node = node_merge($node, $access);
			$this->rid = $rid;
			$this->display();
		}
	}

}