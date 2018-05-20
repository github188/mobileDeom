<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

class RankingController extends CommonController {

    //会员邀请排行
    public function userInvitation(){
        $where = array();
        $db_user = M('user');

        $username = trim(I('username'));
        if($_POST){
            $username?cookie('yaoqingren_username',$username):cookie('yaoqingren_username',null);
        }
        $username = cookie('yaoqingren_username');
        if($username){
            $where['username'] = $username;
        }

        $where['y_count'] = array('GT',0);

        $count = $db_user->where($where)->count();  //统计总条数
        $page  = new \Think\Page($count, 50);        //分页类
        $limit = $page->firstRow .','. $page->listRows;

        $data = $db_user->where($where)->limit($limit)->field('id,username,y_count')->group('id')->order('y_count DESC')->select();
        $pages = $page->show();

        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('data',$data);
        $this -> display();
    }

    //会员提问排行
    public function userQuestion(){
        $where = array();
        $username = trim(I('username'));
        $db_user  = M('user');
        if($_POST){
            if($username){
                cookie('question_username',$username);
                $user_id = $db_user->where(array('username'=>$username))->getField('id');
                if(!$user_id) $this->error('此用户不存在，请重新输入查询');
            }else{
                cookie('question_username',null);
            }
        }
        $username = cookie('question_username');
        if($username){
            $where['user_id'] = $user_id;
        }

        $db = D('QuestionView');
        $count = $db->where($where)->count('distinct(user_id)');  //统计总条数
        $page  = new \Think\Page($count, 10);        //分页类
        $limit = $page->firstRow .','. $page->listRows;

        $data = $db->where($where)->limit($limit)->group('user_id')->order('count(user_id) DESC')->select();
        foreach($data as $k=>$v){
            $groupinfo = getUserGroup($v['user_id']);
            $data[$k]['group_id'] = $groupinfo['group_id'];
        }




        $this -> assign('page',$page->show());
        $this -> assign('count',$count);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('data',$data);
        $this -> display();
    }

}