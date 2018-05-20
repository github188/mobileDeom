<?php
namespace Member\Controller;
use Think\Controller;

//ignore_user_abort(); //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(0); // 执行时间为无限制，php默认执行时间是30秒，可以让程序无限制的执行下去
ini_set('display_errors',1);
/* ouHai 2017-06-15
 * 定时任务控制器
 */
class CrontabController extends EmptyController {
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    //定时执行-用户排名
    public function userRank(){
        $t = date('Y-m-d H:i:s');
        @file_put_contents("./Public/crontab.txt",  "执行排名任务--开始时间：{$t}\r\n", FILE_APPEND);
        $count = M('user')->count('id');
        $limit = 1000 ; //每次查询处理1000条数据
        $total = ceil($count/$limit);
        $start = 0 ;
        for($i=1;$i<=$total;$i++){
            $max = $i==$total?1:0;
            self::user_ranking($start*$limit,$limit,$max);
            $start += 1 ;
            sleep(30);
        }

    }

    //统计 写入数据 用户前一天排名
    static private function user_ranking($i,$limit,$max=0){
        $addtime  = strtotime(date("Y-m-d") .' 00:00:00')-86400;
        $user_db  = M('user');
        $users    = $user_db->limit($i,$limit)->field('id,username')->order('id ASC')->select();
        $video_q_db   = M('video_question');
        $video_q_a_db = M('video_question_answer');
        $video_n_db   = M('video_note');
        $video_p_r_db = M('video_play_record');
        $user_r_db    = M('user_ranking');

        foreach($users as $user){
            $user_id 	= $user['id'];
            $username 	= $user['username'];

            $user_point = 0;

            //提问数
            $num_tiwen  = $video_q_db->where(array('user_id'=>$user_id))->count('id');
            $user_point = $user_point + $num_tiwen;
            //回答别人问题的次数*4
            $num_tiwen_answer = $video_q_a_db->where(array('user_id'=>$user_id))->count('id');
            $user_point = $user_point + $num_tiwen_answer * 2;
            //笔记数*2
            $num_biji   = $video_n_db->where(array('user_id'=>$user_id))->count('id');
            $user_point = $user_point + $num_biji * 2;
            //已学习节数
            $num_xue_video = $video_p_r_db->where(array('user_id'=>$user_id))->count('id');
            $user_point    = $user_point + $num_xue_video;

            $user_ranking = $user_r_db->where(array('user_id'=>$user_id,'addtime'=>$addtime))->getField('id');
            if(!$user_ranking){
                $data = array(
                    'user_id'=>$user_id    , 'username'=>$username,
                    'score'  =>$user_point , 'ranking' =>0, 'addtime' =>$addtime,
                );
                $user_r_db->data($data)->add();
            }
        }

        if($max){
            self::updateRanking($addtime);
        }
    }

    //更新当天排名名次
    static private function updateRanking($addtime){
        $user_r_db    = M('user_ranking');
        $user_count   = M('user')->count();
        $count = $user_r_db->where(array('addtime'=>$addtime))->count();
        $limit = 1000 ; //每次查询处理1000条数据
        $total = ceil($count/$limit);
        $start =$sort=$flag= 0 ;
        for($i=1;$i<=$total;$i++){
            $ranking  = $user_r_db->where(array('addtime'=>$addtime))->limit($start*$limit,$limit)->field('id,score')->order('score DESC')->select();
            $start += 1;
            foreach($ranking as $v){
                $sort += 1;
                $user_r_db->where(array('id'=>$v['id']))->data(array('ranking'=>$v['score']?$sort:$user_count))->save();
            }
            if($i==$total) $flag=1;
            sleep(30);
        }
        //删除一个星期前的排名数据
        if($flag){
            $del_time = strtotime("-8 day", strtotime(date('Y-m-d')));
            $user_r_db->where(array('addtime'=>array('ELT',$del_time)))->delete();
            $t = date('Y-m-d H:i:s');
            @file_put_contents("./Public/crontab.txt",  "=====结束时间：{$t}\r\n", FILE_APPEND);
        }
    }


}