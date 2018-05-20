<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

class VideoStudentController extends CommonController {
    public static $admin_answer_id = 4; //后台绑定的回复视频答疑的user_id
    const  VIDEO_TAG_NEW = 1;
    const  VIDEO_TAG_TUIJ = 2;
    public static $video_tag = array(self::VIDEO_TAG_NEW => '最新', self::VIDEO_TAG_TUIJ => '推荐');
    //视频列表
    public function index(){

        if($_POST){
            $title        = I('post.title');
            $where  = array();
            if ($title) {
                $where['v.title'] = array('like',"%{$title}%");
            }
            cookie('title', $title ?: null);
        }

        $videoDb = M('VideoStudent as v');

        $count = $videoDb->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 15);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $video_data = $videoDb->where($where)->limit($limit)->field('v.*')->order('v.sort asc,v.id desc')->select();

        $pages = $page->show();

        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('video_data',$video_data);
        $this -> assign('count',$count);

        $this -> display();
    }




    //审核视频
    public function videoShenhe(){
        $page    = I('get.p',1,'intval');
        $vid     = I('get.vid',0,'intval');
        $status  = I('get.status',0,'intval');

        $result  = M('videoStudent')->where(array('id'=>$vid))->save(array('status'=>$status));
        if ($result){
            $this->success('操作成功！',U(MODULE_NAME.'/VideoStudent/index',array('p'=>$page)));
        }else{
            $this->error('操作失败！');
        }
    }


    //添加视频
    public function videoAdd(){
        if($_POST){
            $info = I('post.info/a');
            $info['addtime']   = time();
            $info['save_time'] = time();
            $info['remark']    = htmlspecialchars($info['remark']);
            $info['video_time'] = api_get_video_info($info['video_code']);
            if (!$info['video_time']){
                $this->error('视频code不正确！');
            }

            // 将视频时长格式时分秒转换为秒数
            $time_arr = explode(':', $info['video_time']);
            $info['video_time'] = $time_arr[0] * 60 *60 + $time_arr[1] * 60 + $time_arr[2];
            // 封面图片
            if($_FILES['cover_img']['size'] > 0){
                $info['cover_img'] = $this->uploadCoverImg();
            }

            $result = M('video_student')->add($info);
            if($result){
                $this->success('视频添加成功！',U(MODULE_NAME.'/VideoStudent/index'));
            }else{
                $this->error('视频添加失败！');
            }

        }else{
            $this -> display();
        }
    }

    //编辑视频
    public function videoEdit(){
        if($_POST){
            $info    = I('post.info/a');
            $vid     = I('post.vid',0,'intval');
            if ($vid){


                $info['save_time'] = time();
                $info['remark']    = htmlspecialchars($info['remark']);
                $info['video_time'] = api_get_video_info($info['video_code']);
//                dump($info['video_time']);die;
                if (!$info['video_time']){
                    $this->error('视频code不正确！');
                }

                // 将视频时长格式时分秒转换为秒数
                $time_arr = explode(':', $info['video_time']);
                $info['video_time'] = $time_arr[0] * 60 *60 + $time_arr[1] * 60 + $time_arr[2];
                // 封面图片
                if($_FILES['cover_img']['size'] > 0){
                    $info['cover_img'] = $this->uploadCoverImg();
                }

                $result = M('video_student')->where(array('id'=>$vid))->save($info);
                if ($result){
                    $this->success('视频编辑成功！',U(MODULE_NAME.'/VideoStudent/index'));
                }else{
                    $this->error('视频编辑失败！');
                }

            }

        }else{
            $vid   = I('get.vid',0,'intval');
            $video_info = M('videoStudent')->where(array('id'=>$vid))->find();
            if(!$video_info)  $this->error('该视频不存在！',U(MODULE_NAME.'/VideoStudent/index',array('p'=>$page)));

            $this -> assign('video_info',$video_info);
            $this -> display();
        }
    }


    //删除视频
    public function videoDelete(){
        $page  = I('get.p',1,'intval');
        $vid   = I('get.vid', '', 'intval');
        if ($vid){
            $result = M('VideoStudent')->where(array('id'=>$vid))->delete();
            if ($result){
                $this->success('删除成功！',U(MODULE_NAME.'/VideoStudent/index',array('p'=>$page)));
            }else{
                $this->error('删除失败！',U(MODULE_NAME.'/VideoStudent/index',array('p'=>$page)));
            }
        }
    }


    //    上传视频封面
    function uploadCoverImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $rootPath = '/Uploads/';
        $upload->rootPath   =    '.' . $rootPath;
        $upload->savePath  =      'VideoStudent/'; // 设置附件上传（子）目录
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $info   =   $upload->uploadOne($_FILES['cover_img']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            return $rootPath . $info['savepath'] . $info['savename'];
        }

    }
}
