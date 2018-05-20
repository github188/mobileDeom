<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

class EchartsController extends CommonController {

    //本控制器公共方法--处理查询的时间
    private function setSearchTime($start_time=null,$end_time=null,$timestr = 7){
        $Ymd  = $md = array();
        //有选择指定日期
        if($start_time && $end_time){
            list($y,$m,$d) = explode('-',$start_time);
            $time_s = mktime(0,0,0,$m,$d,$y);

            list($y,$m,$d) = explode('-',$end_time);
            $time_e = mktime(23,59,59,$m,$d,$y);

            for($i=$time_s;$i<=$time_e;$i=$i+86400)
            {
                $Ymd[] = date('Y-m-d',$i);
                $md[] = date('m-d',$i);
            }

        }
        else{//没有选择指定日期 默认统计最近7天

            for($i=$timestr;$i>=1;$i--)
            {
                $Ymd[] = date('Y-m-d',strtotime("-{$i} day"));
                $md[] = date('m-d',strtotime("-{$i} day"));
            }
        }
        return array('Ymd'=>$Ymd,'md'=>$md);
    }

    //登录统计
    public function  LoginReport(){

        if($_POST){
            $start_time = I('post.start_time','');
            $end_time   = I('post.end_time','');
            $start_time ? cookie('login_start_time',$start_time):cookie('login_start_time',null);
            $end_time   ? cookie('login_end_time',$end_time):cookie('login_end_time',null);
        }
        $start_time = cookie('login_start_time');
        $end_time   = cookie('login_end_time');

        $date = $this->setSearchTime($start_time,$end_time);

        $Ymd = $date['Ymd'];
        $md  = $date['md'];
        //根据时间循环查询
        foreach($Ymd as $day)
        {
            list($y,$m,$d) = explode('-',$day);
            $time_s = mktime(0,0,0,$m,$d,$y);
            $time_e = mktime(23,59,59,$m,$d,$y);

            $login_day = M('user_login_log')->where("logintime>=$time_s and logintime<=$time_e")->select();
            if($login_day){
                $arr = array();
                foreach($login_day as $k=>$v){
                    $arr[] = $v['user_id'];
                }
                $login_day = array_unique($arr);
            }
            $login_num[] = count($login_day);
        }

        $data     = implode(',',$login_num);//数据
        $time_str = "'".implode("','",$md)."'";//时间

        $this->assign('data',$data);
        $this->assign('time_str',$time_str);
        $this -> display();
    }


    //注册统计
    public function  RegReport(){

        if($_POST){
            $start_time = I('post.start_time','');
            $end_time   = I('post.end_time','');
            $start_time ? cookie('reg_start_time',$start_time):cookie('reg_start_time',null);
            $end_time   ? cookie('reg_end_time',$end_time):cookie('reg_end_time',null);
        }
        $start_time = cookie('reg_start_time');
        $end_time   = cookie('reg_end_time');

        $date_time = $this->setSearchTime($start_time,$end_time);
        $Ymd = $date_time['Ymd'];
        $md  = $date_time['md'];

        $reg_count = $reg_count1 = $reg_count2 = '';

        //根据时间循环查询
        foreach($Ymd as $day)
        {
            list($y,$m,$d) = explode('-',$day);
            $time_s = mktime(0,0,0,$m,$d,$y);
            $time_e = mktime(23,59,59,$m,$d,$y);

            $all     = M('user')->where(array('reg_time'=>array(array('GT',$time_s),array('LT',$time_e))))->count();
            $yqoqing = M('user')->where(array('reg_time'=>array(array('GT',$time_s),array('LT',$time_e)),'y_user_id'=>array('NEQ',0)))->count();
            $zhengchang = $all-$yqoqing;

            $reg_count  .= $all.',';       //全部注册
            $reg_count1 .= $yqoqing.',';   //邀请注册
            $reg_count2 .= $zhengchang.',';//正常注册
        }

        $data     = array('reg_count'=>$reg_count,'reg_count1'=>$reg_count1,'reg_count2'=>$reg_count2);//y轴数据
        $time_str = "'".implode("','",$md)."'";//x轴时间

        $this->assign('data',$data);
        $this->assign('time_str',$time_str);
        $this -> display();
    }


    //观看视频次数统计
    public function  SeeVideoReport(){

        if($_POST){
            $start_time = I('post.start_time','');
            $end_time   = I('post.end_time','');
            $start_time ? cookie('seeVideo_start_time',$start_time):cookie('seeVideo_start_time',null);
            $end_time   ? cookie('seeVideo_end_time',$end_time):cookie('seeVideo_end_time',null);
        }
        $start_time = cookie('seeVideo_start_time');
        $end_time   = cookie('seeVideo_end_time');

        $date_time = $this->setSearchTime($start_time,$end_time);
        $Ymd = $date_time['Ymd'];
        $md  = $date_time['md'];

        $play_count = '';

        //根据时间循环查询
        foreach($Ymd as $day)
        {
            list($y,$m,$d) = explode('-',$day);
            $time_s = mktime(0,0,0,$m,$d,$y);
            $time_e = mktime(23,59,59,$m,$d,$y);

            $count     = M('video_play_record')->where(array('addtime'=>array(array('GT',$time_s),array('LT',$time_e))))->count();

            $play_count  .= $count.',';       //播放次数
        }

        $time_str = "'".implode("','",$md)."'";//x轴时间

        $this->assign('data',$play_count);
        $this->assign('time_str',$time_str);
        $this -> display();
    }


    //提问次数统计
    public function  VideoQusetionReport(){

        if($_POST){
            $start_time = I('post.start_time','');
            $end_time   = I('post.end_time','');
            $start_time ? cookie('question_start_time',$start_time):cookie('question_start_time',null);
            $end_time   ? cookie('question_end_time',$end_time):cookie('question_end_time',null);
        }
        $start_time = cookie('question_start_time');
        $end_time   = cookie('question_end_time');

        $date_time = $this->setSearchTime($start_time,$end_time);
        $Ymd = $date_time['Ymd'];
        $md  = $date_time['md'];

        $question_count = '';

        //根据时间循环查询
        foreach($Ymd as $day)
        {
            list($y,$m,$d) = explode('-',$day);
            $time_s = mktime(0,0,0,$m,$d,$y);
            $time_e = mktime(23,59,59,$m,$d,$y);

            $count  = M('video_question')->where(array('addtime'=>array(array('GT',$time_s),array('LT',$time_e))))->count();

            $question_count  .= $count.',';       //提问数据
        }

        $time_str = "'".implode("','",$md)."'";//x轴时间

        $this->assign('data',$question_count);
        $this->assign('time_str',$time_str);
        $this -> display();
    }

    //笔记数量统计
    public function  VideoNoteReport(){

        if($_POST){
            $start_time = I('post.start_time','');
            $end_time   = I('post.end_time','');
            $start_time ? cookie('note_start_time',$start_time):cookie('note_start_time',null);
            $end_time   ? cookie('note_end_time',$end_time):cookie('note_end_time',null);
        }
        $start_time = cookie('note_start_time');
        $end_time   = cookie('note_end_time');

        $date_time = $this->setSearchTime($start_time,$end_time);
        $Ymd = $date_time['Ymd'];
        $md  = $date_time['md'];

        $note_count = '';

        //根据时间循环查询
        foreach($Ymd as $day)
        {
            list($y,$m,$d) = explode('-',$day);
            $time_s = mktime(0,0,0,$m,$d,$y);
            $time_e = mktime(23,59,59,$m,$d,$y);

            $count     = M('video_note')->where(array('addtime'=>array(array('GT',$time_s),array('LT',$time_e))))->count();

            $note_count  .= $count.',';       //笔记数据
        }

        $time_str = "'".implode("','",$md)."'";//x轴时间

        $this->assign('data',$note_count);
        $this->assign('time_str',$time_str);
        $this -> display();
    }
}