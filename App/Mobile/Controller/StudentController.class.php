<?php
namespace Mobile\Controller;
use Think\Controller;
use Lib\Util\Category;
class StudentController extends EmptyController {


    public function index(){

//      学员介绍
        $db  =  M('article_other');
        $where       =  array('type'=>2,'is_show'=>1);
        $studentRemark  =  $db->where($where)->limit(4)->order('sort ASC,id DESC')->select();

//        学员视频
        $videoStudent = M('video_student')->where(array('status' => 0))->order('sort desc')->select();


        $this->assign('studentRemark', $studentRemark);
        $this->assign('videoStudent', $videoStudent);
        $this->display();
    }


    //播放视频
    public function openVideoPlay()
    {
        $videoCode = I('code','');
        $vid       = I('vid',0,'intval');
        $w       = I('w');

        $id = M('video_student')->where(array('id'=>$vid,'code'=>$videoCode,'status'=>0))->getField('id');

        if(!$id)  _404();

        $this->assign('video_code', $videoCode);
        $this->assign('w', $w);
        $this->display();
    }

}
