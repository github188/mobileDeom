<?php
namespace Member\Controller;
use Think\Controller;
use Lib\Util\Category;
use Think\Think;

/*  视频方面 控制器
 *
 *  OuHai 2017-06-01
 */
class VideoController extends CommonController {

    //视频分类列表
    public function showList(){
        $category = I('get.category',0,'intval');
        if(!$category) _404();
        #获取左侧视频菜单列表
        R('Study/leftVideoMenu');
        $video_db       = M('video');
        $video_c_db     = M('video_category');
        $categoryinfo   = $video_c_db->where(array('id'=>$category,'status'=>0))->find();
        $categoryPinfo  = $video_c_db->where(array('id'=>$categoryinfo['pid'],'status'=>0))->find();

        $where = array('category_id'=>$category,'status'=>0);
        $count = $video_db->where($where)->count();
        $page  = new \Think\Page($count,2);
        $limit = $page->firstRow.','.$page->listRows;

        $category_video = $video_db->where($where)->limit($limit)->select();

        $pages = $page->show();

        $this->assign('category_video',$category_video);
        $this->assign('categoryinfo',$categoryinfo);
        $this->assign('categoryPinfo',$categoryPinfo);
        $this->assign('pages',$pages);
        $this->assign('totalPages',$page->totalPages);
        $this->display();
    }


    //视频播放页
    public function play(){
        $vid       = I('get.vid',0,'intval');
        $user_id = session(C('USER_AUTH_UID'));
        $videoInfo = M('video as v')->join('ht_video_category as c on c.id = v.category_id')->field('v.*, c.name as category_name')->where(array('v.id'=>$vid))->find();
        if(!$videoInfo) _404();

        $play_auth = videoPlayAuth($vid);
        if($play_auth['allow_play']==2){
            ps($play_auth['msg']);
        }

//        如果记录未存在，添加一条播放记录
        $is_play = M('video_play_record')->where(array('vid' => $vid, 'user_id' => $user_id))->field('id, playtime')->find();
        if (!$is_play){
            $add = array('category_id' => $videoInfo['category_id'], 'vid' => $vid, 'user_id' => $user_id, 'addtime' => time(), 'updatetime' => time());

//          添加播放记录
            M('video_play_record')->add($add);
        }else{
            $playtime = $is_play['playtime'];
        }



//      全部笔记
        $nwhere = array('n.vid' => $vid);
        $noteList = \Member\Controller\StudyController::getNote($nwhere);

//      全部问答
        $qwhere = array('q.vid' => $vid);
        $question = \Member\Controller\StudyController::getNewQuestion($qwhere);

        $this->assign('noteList', $noteList);
        $this->assign('question', $question);
        $this->assign('user_id',$user_id);
        $this->assign('playtime',$playtime);
        $this->assign('videoInfo',$videoInfo);
        $this->assign('vid',$videoInfo['id']);
        $this->assign('video_name',$videoInfo['title']);
        $this->assign('category_id',$videoInfo['category_id']);
        $this->assign('category_name',$videoInfo['category_name']);
        $this->display();
    }


    /**
     * 用户离开播放页面时记录播放进度
     * @param  int  $vid  视频id
     * @param  int  $playtime  播放时长
     */
    function videoPlayRecord(){
        if (IS_AJAX){
            $vid = I('post.vid','','intval');
            $playtime = I('post.playtime','','intval');
            if ($vid && $playtime){
                M('video_play_record')->where(array('user_id' => session(C('USER_AUTH_UID')), 'vid' => $vid))->setField(array('playtime' => $playtime, 'updatetime' => time()));
            }
        }
    }

    //收藏和取消视频
    public function videoShoucang()
    {
        if(IS_AJAX){
            $vid      = I('post.vid',0,'intval');
            $user_id  = session(C('USER_AUTH_UID'));
            $db       = M('video_shoucang');
            if(!M('video')->where(array('id'=>$vid))->find()) $this->error('此视频不存在');
            $infoID = $db->where(array('user_id'=>$user_id,'vid'=>$vid))->getField('id');
            if($infoID){
                $db->where(array('user_id'=>$user_id,'vid'=>$vid))->delete();
                $this->error('已取消收藏');
            }else{
                $db->data(array('vid'=> $vid,'user_id' => $user_id,'addtime' => time()))->add();
                $this->success('收藏成功');
            }
        }else{
            _404();
        }
    }

}
