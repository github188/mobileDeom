<?php
namespace Mobile\Controller;
use Think\Controller;

/*
 * 内容管理控制器
 * ouHai  2017-05-20
 *
 */
class ContentController extends EmptyController {

    static public $articleCategory = array(
        1 => '课程介绍',
        2 => '学员介绍',
        3 => '平台公告',
        4 => '官方资讯',
        5 => '常见问题',
        6 => '公司简介'
    );

    //公司简介
    public function index(){
        $data = M('article_other')->where(array('type'=>6,'is_show'=>1))->order('sort ASC,id DESC')->cache(2)->find();
        M('article_other')->where(array('id'=>$data['id'],'type'=>6))->setInc('pv',1); // 文章阅读数加1
        $this->assign('data',$data);
        $this->display();
    }
    //适用于数据表ht_article_other 列表公共--分页
    private function commonSetPage($type,$limit_=10){
        $db  =  M('article_other');
        $where       =  array('type'=>$type,'is_show'=>1);
        $count       =  $db->where($where)->count();
        $page        =  new \Think\Page($count,$limit_);
        $limit       =  $page->firstRow.','.$page->listRows;
        $this->data  =  $db->where($where)->limit($limit)->order('sort ASC,id DESC')->select();
        $this->pages =  $page->show();
        $this->assign('totalPages',$page->totalPages);
    }
    //适用于数据表ht_article_other 列表公共--显示文章内容
    private function commonShowContent($type=0){
        $id = I('main',0,'intval');
        $this->data = M('article_other')->where(array('id'=>$id,'type'=>$type,'is_show'=>1))->order('sort ASC,id DESC')->cache(2)->find();
        M('article_other')->where(array('id'=>$id,'type'=>$type))->setInc('pv',1); // 文章阅读数加1
        if(!$this->data) _404();
    }

    //课程简介--课程列表
    public function courseList(){
        $this->position_name = '课程简介';
        $this->commonSetPage(1);
        $this->display();
    }

    //课程简介--课程列表
    public function course(){
        $this->position_name = '课程简介';
        $this->commonShowContent(1);
        $this->display('content');
    }

    //干货分享-列表
    public function goodShareList(){
        $this->position_name = '干货分享';
        $this->commonSetPage(4);
        $this->display();
    }

    //干货分享-详情页
    public function goodShare(){
        $this->position_name = '干货分享';
        $this->commonShowContent(4);
        $this->display('content');
    }

    //网站公告-列表
    public function webNoticeList(){
        $this->position_name = '网站公告';
        $this->commonSetPage(3);
        $this->display();
    }

    //网站公告-详情页
    public function webNotice(){
        $this->position_name = '网站公告';
        $this->commonShowContent(3);
        $this->display('content');
    }

    //常见问题-列表
    public function problemList(){
        $this->position_name = '常见问题';
        $this->commonSetPage(5);
        $this->display();
    }

    //常见问题-详情页
    public function problem(){
        $this->position_name = '常见问题';
        $this->commonShowContent(5);
        $this->display('content');
    }

    //学员介绍-列表
    public function studentSay(){
        $this->position_name = '学员介绍';
        $this->commonSetPage(2,6);
        $this->display();
    }

    //学员介绍-视频列表
    public function openVideo(){
        $videoStudent = M('video_student')->where(array('status' => 0))->order('sort desc')->select();

        $this->assign('videoStudent', $videoStudent);
        $this->display();
    }

    //播放视频
    public function openVideoPlay()
    {
        $videoCode = I('code','');
        $vid       = I('vid',0,'intval');

        $id = M('video_student')->where(array('id'=>$vid,'code'=>$videoCode,'status'=>0))->getField('id');

        if(!$id)  _404();

        $this->assign('video_code', $videoCode);
        $this->display();
    }


    //联系我们
    public function contactUs(){

        if(IS_AJAX){
            $user_id = session(C('USER_AUTH_UID'));
            $ip      = get_client_ip();
            $name = I('post.name', '', 'trim');
            $mobile = I('post.mobile', '', 'trim');
            $email = I('post.email', '', 'trim');
            $content = I('post.content', '', 'trim');
            if (!$name) $this->error('请填写您的姓名！');
            if (!isPhone($mobile)) $this->error('请填写您的真实手机号码，方便联系您！');
            if (!$content) $this->error('请填写您要反馈的内容！');

            $db = M('guestbook');
            $today_end = strtotime(date('Y-m-d'))+24*60*60-1;
            $count = $db->where(array('ip'=>$ip,'addtime'=>array('ELT',$today_end)))->count();
            if($count >= 5)
                $this->error('当天留言已经达到上限！');
            $count = $db->where(array('user_id'=>$user_id,'addtime'=>array('ELT',$today_end)))->count();
            if($count >= 5)
                $this->error('当天留言已经达到上限！');



            $data = array(
                'user_id' => $user_id?$user_id:0,
                'ip'      => $ip,
                'name'    => $name,
                'mobile'  => $mobile,
                'email'   => $email,
                'content' => $content,
                'is_read' => 0,
                'addtime' => time()
            );

            if ($db->add($data)) {
                $this->success('留言成功，谢谢您留下宝贵的意见！');
            }else{
                $this->error('留言失败，请稍后再试！');
            }

        }else{
            $db = M('article_other');
            $about = $db->where(array('type'=>6,'is_show'=>1))->order('sort ASC,id DESC')->cache(2)->find();
            $db->where(array('id'=>$about['id'],'type'=>6))->setInc('pv',1); // 文章阅读数加1
            $this->assign('about',$about);#关于我们
            $this->display();
        }

    }


}