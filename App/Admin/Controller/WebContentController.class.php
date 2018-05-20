<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

class WebContentController extends CommonController {

    //友情链接
    public function friendsLink(){
        $where = array();

        $count = M('link')->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 10,$where); //分页类

        $limit = $page->firstRow .','. $page->listRows;
        $data = M('link')->where($where)->limit($limit)->order('sort asc,id desc')->select();
        $pages = $page->show();

        $this -> assign('page',$pages);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('data',$data);
        $this -> display();
    }

    //添加友情链接
    public function friendsLinkAdd(){
        if($_POST){
            $link_db = M('link');
            $name    = I('post.name');
            $url     = htmlspecialchars(I('post.url'));
            $is_show = I('post.is_show',1,'intval');
            $sort    = I('post.sort',0,'intval');
            if($link_db->where(array('name'=>$name))->find())
                $this->error('此链接名字已存在！');
            $data = array(
                'name'    => $name,
                'url'     => $url,
                'is_show' => $is_show,
                'sort'    => $sort,
                'addtime' => time(),
            );
            $link_db->strict()->add($data);

            $this->success('添加成功！',U(MODULE_NAME.'/WebContent/friendsLink'));
        }else{
            $this -> display();
        }
    }

    //添加友情链接
    public function friendsLinkEdit(){
        $id   = I('id',0,'intval');
        $page = I('page',1,'intval');
        $link_db = M('link');

        if($_POST){
            $name    = I('post.name');
            $url     = htmlspecialchars(I('post.url'));
            $is_show = I('is_show',1,'intval');
            $sort    = I('sort',0,'intval');
            if($link_db->where(array('name'=>$name,'id'=>array('NEQ',$id)))->find())
                $this->error('此链接名字已存在！');
            $data = array(
                'name'    => $name,
                'url'     => $url,
                'is_show' => $is_show,
                'sort'    => $sort,
            );
            $link_db->where(array('id'=>$id))->strict()->save($data);

            $this->success('编辑成功！',U(MODULE_NAME.'/WebContent/friendsLink',array('p'=>$page)));
        }else{
            $info = $link_db->where(array('id'=>$id))->find();
            $this -> assign('info',$info);
            $this -> assign('page',$page);
            $this -> display();
        }
    }


    //删除友情链接
    public function friendsLinkDelete(){
        $page  = I('page',1,'intval');
        $ids   = I('id/a');
        if(!$ids)
            $this->error('请选择要删除的记录！');
        foreach($ids as $id){
            M('link')->where(array('id'=>$id))->delete();
        }
        $this->success('删除成功！',U(MODULE_NAME.'/WebContent/friendsLink',array('p'=>$page)));
    }


    //消息管理-列表
    public function messageList(){
        $where = array();
        $type         = I('post.type',0,'intval');
        $is_public    = I('post.is_public',0,'intval');
        $content      = trim(I('post.content'));

        if($_POST){
            cookie('message_type',$type?$type:null);
            cookie('message_is_public',$is_public?$is_public:null);
            cookie('message_content',$content?$content:null);
        }

        $search_type        = cookie('message_type');
        $search_is_public   = cookie('message_is_public');
        $search_content     = cookie('message_content');

        if($search_type)         $where['type']          =  $search_type==100 ? 0 : $search_type;
        if($search_is_public)    $where['is_public']     =  $search_is_public;
        if($search_content)      $where['content']       =  array('like',"%{$search_content}%");

        $count = M('message')->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 30); //分页类

        $limit = $page->firstRow .','. $page->listRows;
        $data = M('message')->where($where)->limit($limit)->order('type ASC,is_public DESC,id DESC')->select();
        foreach($data as $k=>$v){
            $count_is_read = M('message_user')->where(array('message_id'=>$v['id'],'is_read'=>1))->count();
            $data[$k]['count_is_read'] = $count_is_read;
        }

        $pages = $page->show();

        $count_user = M('user')->count();

        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('count_user',$count_user);
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('data',$data);
        $this -> display();
    }
    //添加新消息
    public function messageAdd(){
        if($_POST){
            $type       = I('post.type',0,'intval');
            $title      = I('post.title');
            $content    = htmlspecialchars(I('post.content'));
            $data = array(
                'type'      => $type,
                'type_id'   => 0,
                'title'     => $title,
                'content'   => $content,
                'is_public' => 1,
                'addtime'   => time(),
            );
            M('message')->data($data)->add();
            $this->success('操作成功！',U(MODULE_NAME.'/WebContent/messageList'));
        }else{
            $this -> display();
        }
    }

    //编辑消息
    public function messageEdit(){
        $page  = I('page',1,'intval');
        $id    = I('id',0,'intval');

        $message_db = M('message');
        $info = $message_db->where(array('id'=>$id))->find();
        if(!$info) $this->error('不存在的记录，请选择要管理的消息！');

        if($_POST){
            $title      = I('post.title');
            $content    = htmlspecialchars(I('post.content'));
            $data = array(
                'title'      => $title,
                'content'    => $content,
                'updatetime' => time(),
            );
            $message_db->data($data)->where(array('id'=>$id))->save();
            $this->success('操作成功！',U(MODULE_NAME.'/WebContent/messageList',array('p'=>$page)));
        }else{
            $this -> assign('info',$info);
            $this -> assign('page',$page);
            $this -> display();
        }
    }

    //删除消息
    public function messageDelete(){
        $page  = I('page',1,'intval');
        $ids   = I('id/a');

        if(!$ids)
            $this->error('请选择要删除的记录！');
        foreach($ids as $id){
            $id = intval($id);
            M('message')->where(array('id'=>$id))->delete();
            M('message_user')->where(array('message_id'=>$id))->delete();
        }
        $this->success('删除成功！',U(MODULE_NAME.'/WebContent/messageList',array('p'=>$page)));
    }
}