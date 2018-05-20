<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;


//用户管理控制器

class UserController extends CommonController {

    //用户查询
    public function index(){

        $condition['qq']       = I('qq','','trim');
        $condition['mobile']   = I('mobile','','trim');
        $condition['username'] = I('username','','trim');
        $condition['realname'] = I('realname','','trim');

        $where = array();
        if(!empty($condition['qq']))
            $where['qq'] = $condition['qq'];
        if(!empty($condition['mobile']))
            $where['mobile'] = $condition['mobile'];
        if(!empty($condition['username']))
            $where['username'] = $condition['username'];
        if(!empty($condition['realname']))
            $where['realname'] = $condition['realname'];

        if(!empty($where)){

            $count = M('user')->where($where)->count(); //统计总条数
            $page = new \Think\Page($count, 15,$condition); //分页类

            $limit = $page->firstRow .','. $page->listRows;

            $this->info = D('UserView')->where($where)->limit($limit)->order('user_group_ext.end_time DESC,user.id ASC')->group('user.id')->select();

            $this->page = $page->show();
            $this->totalPages = $page->totalPages;

            $this->assign('condition', $condition);
        }
        $this -> display();
	}
    //AJAX获取更多用户组
    public function getUserGroup(){
        if(IS_AJAX){
            $user_id   = I('user_id',0,'intval');          //用户ID
            $group = getUserGroup($user_id,2);
            $group?$this->success($group):$this->error('获取信息失败，请稍后重试！');
        }
    }

    //用户列表
    public function userList(){
        $where     = $condition = array();
        if(IS_POST){
            $user_id   = I('user_id',0,'intval');          //用户ID
            $username  = I('username','','trim');             //用户名
            $mobile    = I('mobile','','trim');          //手机号

            $group_id  = I('group_id',0,'intval');     //用户组ID
            $time_type = I('time_type',0,'intval');   //过期时间类型
            if($user_id)
                $where['id'] = $user_id;
            if($username)
                $where['username'] = $username;
                $condition['username'] = $username;
            if($mobile)
                $where['mobile']  = $mobile;
                $condition['mobile'] = $mobile;
            if($group_id)
                $where['group_id'] = $group_id;
                $condition['group_id'] = $group_id;

            if($time_type)
                $condition['time_type'] = $time_type;

            if($time_type == 1)
            {
                list($y, $m, $d) = explode('-', date('Y-m-d', strtotime("+14 day")));
                $time_s = mktime(0, 0, 1, $m, $d, $y);
                $time_e = mktime(23, 59, 59, $m, $d, $y);
                $where['end_time']   = array(array('EGT',$time_s),array('ELT',$time_e));
            }
            if($time_type == 2){
                $where['end_time'] = array('ELT', time());
            }
        }
        $y_user_id = I('get.y_user_id',0,'intval');     //邀请人ID
        if($y_user_id)
            $where['y_user_id'] = $y_user_id;
            $condition['y_user_id'] = $y_user_id;

        $count = D('UserView')->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 50,$condition); //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $info = D('UserView')->where($where)->limit($limit)->order('user.id ASC')->group('user.id')->select();
        foreach($info as $k=>$v){
            $info[$k]['y_username'] = M('user')->where(array('id'=>$v['y_user_id']))->getField('username');
        }

        $this->page = $page->show();
        $this->totalPages = $page->totalPages;

        $this->group = M('user_group')->select();

        $this->assign('condition', $condition);
        $this->assign('count', $count);
        $this->assign('info', $info);
        $this -> display();
    }
    //添加会员
    public function userAdd() {

//        $user_shouhuo =  M('user_shouhuoadd');
        $user = M('user');
        $user_group = M('user_group');
        $user_group_ext = M('user_group_ext');

        if ($_POST) {
            $info = I('post.info/a');
            $ex   = I('post.group_ext/a');

            if (!$info['username'])
                $this->error('用户名称没有提供！');
            if (!$info['password'])
                $this->error('用户密码没有提供！');
            if (!$info['passwordok'])
                $this->error('确认密码没有提供！');
            if ($info['password'] != $info['passwordok'])
                $this->error('两次密码输入不一致！');
            if (!isUsername($info['username']))
                $this->error('用户名不合法！');
            if (!isPassword($info['password']))
                $this->error('密码不合法！');
            unset($info['passwordok']);

            if ($user->where(array('username'=>$info['username']))->find()) {
                $this->error('此会员已经存在');
            }

            $passwordinfo         = password_md5($info['password']);
            $info['password']     = $passwordinfo['password'];
            $info['encrypt']      = $passwordinfo['encrypt'];
            $info['reg_time']     = time();
            $info['reg_ip']       = get_client_ip();
            $info['mobile_status']= 1;
            $info['email_status'] = 1;


            $user_id = $user->strict()->add($info);

            if ($user_id) {
                if ($ex['id']) {
                    //先删除拓展用户表用户的等级
                   $user_group_ext->where(array('user_id'=>$user_id))->delete();

                    foreach ($ex['id'] as $id => $val) {
                        $start_time = $ex['start_time'][$id];
                        $start_time = $start_time?strtotime($start_time):time();
                        $end_time   = $ex['end_time'][$id];

                        if(!$end_time){
                            $group  = $user_group->where(array('id'=>$id))->find();
                            $end_time = date('Y-m-d',strtotime("+ {$group['gqtime']} day"));
                        }
                        list($y, $m, $d) = explode('-', $end_time);
                        $end_time = mktime(0, 0, 1, $m, $d, $y);

                        $user_group_ext->add(array('user_id' => $user_id, 'group_id' => $id, 'start_time' => $start_time,'end_time' => $end_time,'addtime'=>time()));
                    }
                }

                $this->success('操作成功', U(MODULE_NAME.'/User/userList'));
            }
        } else {
            $this->user_groups = $user_group->select();
            $this->display();
        }
    }


    //编辑会员
    public function userEdit() {

        $user = M('user');
        $user_group = M('user_group');
        $user_group_ext = M('user_group_ext');

        $user_id    = I('user_id',0,'intval');
        $page       = I('page',0,'intval');

        if ($_POST) {
            $info = I('post.info/a');
            $ex   = I('post.group_ext/a');

            if (!$info['username'])
                $this->error('用户名称没有提供！');
            if (!isUsername($info['username']))
                $this->error('用户名不合法！');
            if ($user->where(array('username'=>$info['username'],'id'=>array('NEQ',$user_id)))->find()) {
                $this->error('此会员已经存在');
            }

            if($info['password']){
                if (!isPassword($info['password']))
                        $this->error('密码不合法！');
                if (!$info['passwordok'])
                        $this->error('确认密码没有提供！');
                if ($info['password'] != $info['passwordok'])
                        $this->error('两次密码输入不一致！');

                $passwordinfo         = password_md5($info['password']);
                $info['password']     = $passwordinfo['password'];
                $info['encrypt']      = $passwordinfo['encrypt'];
            }else{
                unset($info['password']);
            }

            $info['mobile_status'] = 1;
            $info['email_status']  = 1;


            $user->where(array('id'=>$user_id))->strict()->data($info)->save();

            if ($ex['id']) {
                //先删除拓展用户表用户的等级
                $user_group_ext->where(array('user_id'=>$user_id))->delete();

                foreach ($ex['id'] as $id => $val) {
                    $start_time = $ex['start_time'][$id];
                    $start_time = $start_time?strtotime($start_time):time();
                    $end_time   = $ex['end_time'][$id];

                    if(!$end_time){
                        $group  = $user_group->where(array('id'=>$id))->find();
                        $end_time = date('Y-m-d',strtotime("+ {$group['gqtime']} day"));
                    }
                    list($y, $m, $d) = explode('-', $end_time);
                    $end_time = mktime(0, 0, 1, $m, $d, $y);

                    $user_group_ext->add(array('user_id' => $user_id, 'group_id' => $id, 'start_time' => $start_time,'end_time' => $end_time));
                }
            }else{
                $user_group_ext->where(array('user_id'=>$user_id))->delete();
            }

            $this->success('操作成功', U(MODULE_NAME.'/User/userList',array('p'=>$page)));

        } else {
            $userinfo   = D('UserRelation')->where(array('id'=>$user_id))->relation(true)->find();
            $user_groups  = $user_group->select();

            //重构数组  如果用户在当前有用户组权限就重构信息
            foreach($user_groups  as $k => $v){
                $ext = M('user_group_ext')->where(array('group_id'=>$v['id'], 'user_id' => $user_id))->field('id,start_time,end_time')->find();
                if($ext){
                    $user_groups[$k]['ext_id']          = $ext['id'];
                    $user_groups[$k]['gq_str']          = $ext['end_time'] <= time() ? '已过期' : '';
                    $user_groups[$k]['user_end_time']   = $ext['end_time'];
                    $user_groups[$k]['user_start_time'] = $ext['start_time'];
                }
            }


            $this->assign('userinfo',$userinfo);//用户信息
            $this->assign('user_groups',$user_groups);
            $this->assign('page',$page);
            $this->display();
        }
    }
    //删除会员
    public function userDelete() {
        $ids   = I('get.user_id/a');
        $page  = I('get.page',1,'intval');

        if (!$ids)
            $this->error('请选择要管理的会员！');

        foreach($ids as $user_id){
            $user_id = intval($user_id);
            M('user')->where(array('id'=>$user_id))->delete();
            M('user_group_ext')->where(array('user_id'=>$user_id))->delete();
        }

        $this->success('删除成功！', U(MODULE_NAME.'/User/userList',array('p'=>$page)));
    }


    //会员分组
    public function userGroup(){
        $where = array();

        $count = M('user_group')->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 10,$where); //分页类

        $limit = $page->firstRow .','. $page->listRows;

        $user_group = M('user_group')->where($where)->limit($limit)->order('sort asc,buy_money asc,id desc')->select();

        $pages = $page->show();

        $this -> assign('page',$pages);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('user_group',$user_group);
        $this -> display();
    }

    //删除会员
    public function userGroupDelete() {
        $ids   = I('get.id/a');
        $page  = I('get.page',1,'intval');

        if (!$ids)
            $this->error('请选择要删除的会员组！');
        $user_g_db = M('user_group');
        $user_g_ext_db = M('user_group_ext');

        foreach($ids as $id){
            $id = intval($id);
            if($user_g_ext_db->where(array('group_id'=>$id))->count()) $this->error('该会员组已有会员，禁止删除！');
            $user_g_db->where(array('id'=>$id))->delete();
        }

        $this->success('删除成功！', U(MODULE_NAME.'/User/userGroup',array('p'=>$page)));
    }

    //添加会员分组
    public function userGroupAdd(){
        if($_POST){
            $user_group_db = M('user_group');

            $name       = I('post.name');
            $remark     = I('post.remark');
            $percent    = I('post.percent');
            $gqtime     = I('post.gqtime',0,'intval');
            $buy_money  = I('post.buy_money',0,'intval');
            $allow_buy  = I('post.allow_buy',0,'intval');
            $sort       = I('post.sort',0,'intval');

            if($user_group_db->where(array('name'=>$name))->find())
                $this->error('此会员分组已存在！');

            $data =array(
                'name'      => $name,
                'remark'    => $remark,
                'percent'   => $percent,
                'gqtime'    => $gqtime,
                'buy_money' => $buy_money,
                'allow_buy' => $allow_buy,
                'sort'      => $sort,
            );
            $user_group_db->add($data);
            $this->success('添加成功！',U(MODULE_NAME.'/User/userGroup'));
        }else{
            $this -> display();
        }
    }

    //编辑会员分组
    public function userGroupEdit(){
        $user_group_db  = M('user_group');
        $group_id       = I('group_id',0,'intval');
        $page           = I('page',0,'intval');

        if($_POST){
            $name       = I('post.name');
            $remark     = I('post.remark');
            $percent    = I('post.percent');
            $gqtime     = I('post.gqtime',0,'intval');
            $buy_money  = I('post.buy_money',0,'floatval');
            $allow_buy  = I('post.allow_buy',0,'intval');
            $sort       = I('post.sort',0,'intval');

            if($user_group_db->where(array('name'=>$name,'id'=>array('NEQ',$group_id)))->find())
                $this->error('此会员分组已存在！');

            $data =array(
                'name'      => $name,
                'remark'    => $remark,
                'percent'   => $percent,
                'gqtime'    => $gqtime,
                'buy_money' => $buy_money,
                'allow_buy' => $allow_buy,
                'sort'      => $sort,
            );
            $user_group_db->where(array('id'=>$group_id))->strict()->save($data);
            $this->success('编辑成功！',U(MODULE_NAME.'/User/userGroup',array('p'=>$page)));
        }else{
            $info = $user_group_db->where(array('id'=>$group_id))->find();
            $this->assign('info', $info);
            $this->assign('page', $page);
            $this -> display();
        }
    }


    //会员黑名单
    public function userHack(){
        $where = array();

        $count = M('user_hack')->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 20,$where); //分页类

        $limit = $page->firstRow .','. $page->listRows;

        $data = M('user_hack')->where($where)->limit($limit)->order('addtime desc,id desc')->select();

        $pages = $page->show();

        $this -> assign('page',$pages);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('data',$data);
        $this -> display();
    }

    //添加会员黑名单
    public function userHackAdd(){
        $user_id  = I('user_id',0,'intval');
        $page     = I('page',1,'intval');
        $user_hack_db = M('user_hack');
        $user_db  = M('user');

        $is_hack = $user_hack_db->where(array('user_id'=>$user_id))->find();
        if($is_hack or $is_hack['end_time']>time())
            $this->error('此会员已经被拉黑，请勿重复操作！');

        if($_POST){
            $user_name  = I('post.username');
            $start_time = I('post.start_time');
            $end_time   = I('post.end_time');
            $remark     = I('post.remark');

            $data =array(
                'user_id'      => $user_id,
                'username'     => $user_name,
                'start_time'   => $start_time ? strtotime($start_time) : 0,
                'end_time'     => $end_time   ? strtotime($end_time) : 0,
                'remark'       => htmlspecialchars($remark),
                'addtime'      => time(),
            );
            $user_hack_db->add($data);
            $user_db->where(array('id'=>$user_id))->save(array('is_hack'=>1));
            $this->success('操作成功！',U(MODULE_NAME.'/User/userList',array('p'=>$page)));
        }else{
            $user_info = $user_db->where(array('id'=>$user_id))->find();
            $this -> assign('user_info',$user_info);
            $this -> display();
        }
    }

    //编辑会员黑名单
    public function userHackEdit(){
        $user_id  = I('user_id',0,'intval');
        $page     = I('page',1,'intval');
        $user_hack_db = M('user_hack');
        $user_db  = M('user');


        if($_POST){
            $user_name  = I('post.username');
            $start_time = strtotime(I('post.start_time'));
            $end_time   = strtotime(I('post.end_time'));
            $remark     = I('post.remark');

            $data =array(
                'user_id'      => $user_id,
                'username'     => $user_name,
                'start_time'   => $start_time ? $start_time : 0,
                'end_time'     => $end_time   ? $end_time : 0,
                'remark'       => $remark,
                'addtime'      => time(),
            );

            $user_hack_db->where(array('user_id'=>$user_id))->save($data);
            if($end_time && $end_time<time()){
                $is_hack = array('is_hack'=>2);
            }else{
                $is_hack = array('is_hack'=>1);
            }
            $user_db->where(array('id'=>$user_id))->save($is_hack);
            $this->success('操作成功！',U(MODULE_NAME.'/User/userHack',array('p'=>$page)));
        }else{
            $user_info = $user_db->where(array('id'=>$user_id))->find();
            $hack_info = $user_hack_db->where(array('user_id'=>$user_id))->find();
            $this -> assign('hack_info',$hack_info);
            $this -> assign('user_info',$user_info);
            $this -> display();
        }
    }

    //把会员从黑名单移除
    public function userHackDelete() {
        $ids   = I('user_id/a');
        $page  = I('page',1,'intval');

        if (!$ids)
            $this->error('请选择要移出黑名单的会员！');

        foreach($ids as $user_id){
            $user_id = intval($user_id);
            M('user_hack')->where(array('user_id'=>$user_id))->delete();
            M('user')->where(array('id'=>$user_id))->save(array('is_hack'=>2));
        }

        $this->success('操作成功！', U(MODULE_NAME.'/User/userHack',array('p'=>$page)));
    }



    //会员登录日志
    public function userLoginLog(){
        $where = array();
        /*
        $old_data = M('user_login_log','v5_')->limit(500,1500)->select();
        $insert_data = array();
        foreach($old_data as $k=>$v){
            $insert_data['user_id']   = $v['uid'];
            $insert_data['username']  = M('user','v5_')->where(array('uid'=>$v['uid']))->getField('username');
            $insert_data['ip']        = $v['ip'];
            $insert_data['logintime'] = $v['logintime'];
            M('user_login_log')->add($insert_data);
        }
        die;*/
        $user_id   = I('user_id',0,'intval');
        $username  = I('post.username');

        if($_POST){
            $username ? cookie('username',$username) : cookie('username',null) ;
        }

        if($user_id){
            $where['user_id']  = $user_id;
        }
        $username = cookie('username');
        $username ? $where['username'] = $username : '';

        $count = M('user_login_log')->where($where)->count(); //统计总条数
        $page  = new \Think\Page($count, 50,$where); //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data = M('user_login_log')->where($where)->limit($limit)->order('logintime DESC,user_id ASC')->select();

        $Ip = new \Org\Net\IpLocation('qqwry.dat'); // 实例化类 参数表示IP地址库文件
        foreach($data as $k=>$v){
            $ip_info = $Ip->getlocation($v['ip']); // 获取某个IP地址所在的位置
            $data[$k]['address'] = array_iconv($ip_info['country'].' '.$ip_info['area']);
        }
        $pages = $page->show();

        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('data',$data);
        $this -> display();
    }

    //删除会员登录记录
    public function userLoginLogDelete() {
        $ids   = I('id/a');
        $page  = I('page',1,'intval');

        if (!$ids)
            $this->error('请选择要管理的登录记录！');

        foreach($ids as $id){
            $id = intval($id);
            M('user_login_log')->where(array('id'=>$id))->delete();
        }

        $this->success('操作成功！', U(MODULE_NAME.'/User/userLoginLog',array('p'=>$page)));
    }

}
