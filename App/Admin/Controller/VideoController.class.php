<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

class VideoController extends CommonController {
    public static $admin_answer_id = 4; //后台绑定的回复视频答疑的user_id
    const  VIDEO_TAG_NEW = 1;
    const  VIDEO_TAG_TUIJ = 2;
    public static $video_tag = array(self::VIDEO_TAG_NEW => '最新', self::VIDEO_TAG_TUIJ => '推荐');
    //视频列表
    public function index(){

        if($_POST){
            $title        = I('post.title');
            $is_reply     = I('post.is_reply', 0, 'intval');
            $category_id  = I('category_id',0,'intval');
            $where  = array();
            if ($title) {
                $where['v.title'] = array('like',"%{$title}%");
            }
            if ($is_reply) {
                $where['v.is_reply'] = $is_reply;
            }
            if ($category_id) {
                $where['v.category_id'] = $category_id;
            }

            cookie('category_id', $category_id ?: null);
            cookie('title', $title ?: null);
            cookie('is_reply', $is_reply ?: null);
        }

        $videoDb = M('video as v');
        $videoCategoryDb = M('video_category');
        $count = $videoDb->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 15);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $video_data = $videoDb->join('`ht_video_category` as c on v.category_id = c.id')->where($where)->limit($limit)->field('v.*, c.name as `group`')->order('v.sort asc,v.id desc')->select();

        $pages = $page->show();
        $video_group = M('video_category')->where(array('pid'=>array('gt',0)))->field('name, id')->select();

        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('video_data',$video_data);
        $this -> assign('count',$count);
        $this -> assign('video_tag',self::$video_tag);
        $this -> assign('video_group',$video_group);
        $this -> display();
    }


    //删除视频
    public function videoDelete(){
        $ids   = I('id/a');
        $page  = I('page',1,'intval');

        if (!$ids)
            $this->error('请选择要删除的视频！');

        foreach($ids as $id){
            $id = intval($id);
            M('video_auth')->where(array('vid'=>$id))->delete();
            M('video_note')->where(array('vid'=>$id))->delete();
            M('video_play_record')->where(array('vid'=>$id))->delete();
            M('video_question')->where(array('vid'=>$id))->delete();
            M('video_question_answer')->where(array('vid'=>$id))->delete();
            M('video_question_shoucang')->where(array('vid'=>$id))->delete();
            M('video_remark')->where(array('vid'=>$id))->delete();
            M('video_shoucang')->where(array('vid'=>$id))->delete();
            M('video')->where(array('id'=>$id))->delete();
        }
        $this->success('删除成功！',U(MODULE_NAME.'/Video/index',array('p'=>$page)));
    }

    //视频分组
    public function videoGroup(){

        $categoryDb = M('video_category');
        $videoDb = M('video');
        $video_group = $categoryDb->order('sort asc,id desc')->select();

        //统计分类下的视频数量
        $parentSum = array(); //父级分类下的视频数量

        foreach($video_group as $k => $v){
            if ($v['pid']){
                //查找当前分类下的视频数量
                $video_group[$k]['count_article'] = $videoDb->where(array('category_id' => $v['id']))->count();
                //记录数量
                $parentSum[$video_group[$k]['pid']] += $video_group[$k]['count_article'];
            }
        }

        //将统计的数量数量加到父级分类
        foreach ($video_group as $k => $v){
            if ($v['pid'] == 0){
                $video_group[$k]['count_article'] = $parentSum[$v['id']];
            }
        }

        $video_group = Category::unlimitedForLevel($video_group);
        $this -> assign('video_group',$video_group);
        $this -> display();
    }

    //添加视频分组
    public function videoGroupAdd(){
        if($_POST){
            $info        = I('post.info/a');
            $ugid_array  = I('post.ugid/a');
            $category_id = M('video_category')->add($info);
            if($category_id && $ugid_array){
                $data = array();
                foreach($ugid_array as $k){
                    $data['category_id'] = $category_id;
                    $data['ugid'] = $k;
                    M('video_category_auth')->add($data);
                }
            }

            $this->success('添加成功！',U(MODULE_NAME.'/Video/videoGroup'));
        }else{
            $video_group = M('video_category')->where(array('pid'=>0))->field('id, name')->select();
            $user_group  = M('user_group')->field('id, name')->select();

//            添加指定分组下的分类
            $p_category_id = I('get.category_id');
            $this -> assign('p_category_id',$p_category_id);
            $this -> assign('user_group',$user_group);
            $this -> assign('video_group',$video_group);
            $this -> display();
        }
    }

    //编辑视频分类
    public function videoGroupEdit(){
        $videoCategoryAuthDb = M('video_category_auth');
        $category_id         = I('id',0,'intval');
        $category_info       = M('video_category')->where(array('id'=>$category_id))->find();

        if($_POST){
            $info = I('post.info/a');
            $ugid = I('post.ugid/a','','intval');

            $result = M('video_category')->where(array('id'=>$category_id))->save($info);
            if ($result !== false){
                if($category_info['pid']>0){
                    $status = true;
                    if($ugid){
                        $result = $videoCategoryAuthDb->where(array('category_id'=>$category_id))->delete();
                        if ($result === false){
                            $status = false;
                        }
                        $data = array();
                        $kk = 0;//addALL需要k从0开始
                        foreach($ugid as $k){
                            $data[$kk]['category_id'] = $category_id;
                            $data[$kk]['ugid'] = $k;
                            $kk ++;
                        }
                        $result = $videoCategoryAuthDb->addAll($data);
                        if (!$result){
                            $status = false;
                        }
                    }else{
                        $result = $videoCategoryAuthDb->where(array('category_id'=>$category_id))->delete();
                        if ($result === false){
                            $status = false;
                        }
                    }
                }
            }else{
                $status = false;
            }

            if ($status){
                $this->success('编辑成功！',U(MODULE_NAME.'/Video/videoGroup'));
            }else{
                $this->error('编辑失败！');
            }

        }else{
            $video_group = M('video_category')->where(array('pid'=>0))->field('id, name')->select();
            $user_group  = M('user_group')->field('id, name')->select();

            $user_group_ext  = $videoCategoryAuthDb->where(array('category_id'=>$category_id))->select();
            $is_checked = array();
            foreach($user_group_ext as $k=>$v){
                $is_checked[] = $v['ugid'];
            }

            $this -> assign('category_info',$category_info);
            $this -> assign('is_checked',$is_checked);
            $this -> assign('user_group',$user_group);
            $this -> assign('video_group',$video_group);
            $this -> display();
        }
    }

    //删除视频分类
    public function videoGroupDelete(){
        $page = I('get.p',1,'intval');
        $pid  = I('get.pid',1,'intval');
        $category_id  = I('get.category_id','','intval');
        M('video')->where(array('category_id'=>$category_id))->delete();
        M('video_category_auth')->where(array('category_id'=>$category_id))->delete();
        M('video_category')->where(array('id'=>$category_id))->delete();
        $this->success('删除成功！',U(MODULE_NAME.'/Video/videoGroup',array('pid'=>$pid,'p'=>$page)));
    }


    //审核视频
    public function videoShenhe(){
        $page    = I('get.p',1,'intval');
        $vid     = I('get.vid',0,'intval');
        $status  = I('get.status',0,'intval');

        $result  = M('video')->where(array('id'=>$vid))->save(array('status'=>$status));
        if ($result){
            $this->success('操作成功！',U(MODULE_NAME.'/Video/index',array('p'=>$page)));
        }else{
            $this->error('操作失败！');
        }
    }


    //添加视频
    public function videoAdd(){
        if($_POST){
            $info = I('post.info/a');

            $info['video_time'] = api_get_video_info($info['video_code']);
            if (!$info['video_time']){
                $this->error('视频code不正确！');
            }

            // 将视频时长格式时分秒转换为秒数
            $time_arr = explode(':', $info['video_time']);
            $info['video_time'] = $time_arr[0] * 60 *60 + $time_arr[1] * 60 + $time_arr[2];

            $info['addtime']   = time();
            $info['is_tag']   = intval($info['is_tag']);
            $info['save_time'] = time();
            $info['buy_money'] = floatval($info['buy_money']);
            $info['gqtime']    = intval($info['gqtime']);
            $info['remark']    = htmlspecialchars($info['remark']);
//            if (!$info['buy_money']) {
//                $this->error('单独购买价格不能为空！');
//            }
            $info['gqtime']    = intval($info['gqtime']);
            if(!$info['gqtime']){
                $this->error('有效期不能为空！');
            }
            // 封面图片
            if($_FILES['cover_img']['size'] > 0){
                $info['cover_img'] = $this->uploadCoverImg();
            }

            $result = M('video')->add($info);
            if($result){
                $this->success('视频添加成功！',U(MODULE_NAME.'/Video/index'));
            }else{
                $this->error('视频添加失败！',U(MODULE_NAME.'/Video/index'));
            }

        }else{
            $videoCategoryDb = M('video_category');
            $video_group = $videoCategoryDb->where(array('pid'=>0))->select();
            foreach($video_group as $k=>$v){
                $video_group[$k]['children'] = $videoCategoryDb->where(array('pid'=>$v['id']))->order('sort asc,id asc')->select();
            }

            $this -> assign('video_group',$video_group);
            $this -> assign('video_tag',self::$video_tag);
            $this -> display();
        }
    }

    //编辑视频
    public function videoEdit(){
        if($_POST){
            $info    = I('post.info/a');
            $vid     = I('post.vid',0,'intval');
            if ($vid){
                $info['video_time']  = api_get_video_info($info['video_code']);
                if (!$info['video_time']){
                    $this->error('视频code不正确！');
                }
                // 将视频时长格式时分秒转换为秒数
                $time_arr = explode(':', $info['video_time']);
                $info['video_time'] = $time_arr[0] * 60 *60 + $time_arr[1] * 60 + $time_arr[2];

                $info['save_time'] = time();
                $info['remark']    = htmlspecialchars($info['remark']);
                $info['is_tag']   = intval($info['is_tag']);
                $info['buy_money'] = floatval($info['buy_money']);
//                if (!$info['buy_money']) {
//                    $this->error('单独购买价格不能为空！');
//                }
                $info['gqtime']    = intval($info['gqtime']);
                if(!$info['gqtime']){
                    $this->error('有效期不能为空！');
                }
                // 封面图片
                if($_FILES['cover_img']['size'] > 0){
                    $info['cover_img'] = $this->uploadCoverImg();
                }

                $result = M('video')->where(array('id'=>$vid))->save($info);
                if ($result){
                    $this->success('视频编辑成功！',U(MODULE_NAME.'/Video/index'));
                }else{
                    $this->error('视频编辑失败！');
                }

            }

        }else{
            $vid   = I('get.vid',0,'intval');
            $page  = I('get.p',1,'intval');
            $videoCategoryDb = M('video_category');
            $video_info = M('video')->where(array('id'=>$vid))->find();
            if(!$video_info)  $this->error('该视频不存在！',U(MODULE_NAME.'/Video/index',array('p'=>$page)));

            $video_group = $videoCategoryDb->where(array('pid'=>0))->select();
            foreach($video_group as $k=>$v){
                $video_group[$k]['children'] =$videoCategoryDb->where(array('pid'=>$v['id']))->order('sort asc,id asc')->select();
            }

            $this -> assign('video_info',$video_info);
            $this -> assign('video_group',$video_group);
            $this -> assign('video_tag',self::$video_tag);
            $this -> display();
        }
    }



    //视频笔记
    public function videoNote(){
        $where  = array();
        $listsRows = 50;
        if (IS_POST){
            $username     = trim(I('post.username'));
            $video_title  = trim(I('post.video_title'));
            $content      = trim(I('post.content'));
            if ($username){
                $where['u.username'] =  array('like',"%{$username}%");
            }
            if ($video_title){
                $where['v.title']    =  array('like',"%{$video_title}%");
            }
            if ($content){
                $where['n.content']  =  array('like',"%{$content}%");
            }

            cookie('username',$username?:null);
            cookie('video_title',$video_title?:null);
            cookie('content',$content?:null);
        }

        $videoNoteDb = M('VideoNote as n');
        $field = 'n.id, v.title, u.username, n.content, n.playtime, n.addtime';
        $join_user = 'left join `ht_user` as u on u.id = n.user_id';
        $join_video = 'left join `ht_video` as v on v.id = n.vid';
        $count = $videoNoteDb->join($join_user)->join($join_video)->where($where)->count();
        $page = new \Think\Page($count, $listsRows);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $video_note_data = $videoNoteDb->join($join_user)->join($join_video)->limit($limit)->where($where)->field($field)->select();
        $pages = $page->show();
        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('video_note_data',$video_note_data);

        $this -> display();
    }

    //删除视频笔记
    public function videoNoteDelete(){
        $page  = I('get.p',1,'intval');
        $ids   = I('get.id/a');
        $where['id'] = array('in', $ids);
        $result = M('video_note')->where($where)->delete();
        if ($result){
            $this->success('笔记删除成功！',U(MODULE_NAME.'/Video/videoNote',array('p'=>$page)));
        }else{
            $this->error('笔记删除失败！',U(MODULE_NAME.'/Video/videoNote',array('p'=>$page)));
        }
    }

    //视频收藏
    public function videoShoucang(){

        $listsRows = 50;
        $where  = array();
        if (IS_POST){
            $username    = trim(I('post.username'));
            $video_title = trim(I('post.video_title'));
            if ($username){
                $where['u.username'] = array('like',"%{$username}%");
            }
            if ($video_title){
                $where['v.title']    = array('like',"%{$video_title}%");
            }

             cookie('username',$username?:null);
             cookie('video_title',$video_title?:null);
        }

        $shouCangDb = M('VideoShoucang as s');
        $field      = 's.id, c.name as group_name, v.title as video_title, u.username, s.addtime';
        $join_user  = 'left join `ht_user` as u on u.id = s.user_id';
        $join_video = 'left join `ht_video` as v on v.id = s.vid';
        $join_video_category = 'left join `ht_video_category` as c on v.category_id = c.id';
        $count = $shouCangDb->join($join_user)->join($join_video)->where($where)->count();
        $page  = new \Think\Page($count, $listsRows);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $video_shoucang = $shouCangDb->join($join_user)->join($join_video)->join($join_video_category)->limit($limit)->where($where)->field($field)->select();
        $pages = $page->show();

        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('video_shoucang',$video_shoucang);

        $this -> display();
    }


    //删除视频收藏
    public function videoShoucangDelete(){
        $page  = I('get.p',1,'intval');
        $ids   = I('get.id/a');

        $where['id'] = array('in', $ids);
        $result = M('video_shoucang')->where($where)->delete();
        if ($result){
            $this->success('收藏删除成功！',U(MODULE_NAME.'/Video/videoShoucang',array('p'=>$page)));
        }else{
            $this->error('收藏删除失败！',U(MODULE_NAME.'/Video/videoShoucang',array('p'=>$page)));
        }
    }


    //视频播放记录
    public function videoPlayRecord(){

        $listsRows = 50;
        $where  = array();
        if (IS_POST){
            $username    = trim(I('post.username'));
            $video_title = trim(I('post.video_title'));
            if ($username){
                $where['u.username'] = array('like',"%{$username}%");
            }
            if ($video_title){
                $where['v.title']    = array('like',"%{$video_title}%");
            }

             cookie('username',$username?:null);
             cookie('video_title',$video_title?:null);
        }

        $videoPlayRecordDb = M('video_play_record as r');
        $field      = 'r.id, c.name as video_group, v.title as video_title, u.username, r.playtime, r.addtime';
        $join_user  = 'left join `ht_user` as u on u.id = r.user_id';
        $join_video = 'left join `ht_video` as v on v.id = r.vid';
        $join_video_category = 'left join `ht_video_category` as c on v.category_id = c.id';
        $count = $videoPlayRecordDb->join($join_user)->join($join_video)->where($where)->count();
        $page  = new \Think\Page($count, $listsRows);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $video_play_record = $videoPlayRecordDb->join($join_user)->join($join_video)->join($join_video_category)->limit($limit)->where($where)->field($field)->select();
        $pages = $page->show();

        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('video_play_record',$video_play_record);

        $this -> display();
    }

    //删除视频播放记录
    public function videoPlayRecordDelete(){
        $page  = I('get.p',1,'intval');
        $ids   = I('get.id/a');

        $where['id'] = array('in', $ids);
        $result = M('video_play_record')->where($where)->delete();
        if ($result){
            $this->success('删除成功！',U(MODULE_NAME.'/Video/videoPlayRecord',array('p'=>$page)));
        }else{
            $this->error('删除失败！',U(MODULE_NAME.'/Video/videoPlayRecord',array('p'=>$page)));
        }
    }


    //视频答疑-提问管理
    public function videoQuestion(){
        $listsRows = 50;
        $where  = array('u.username <> ""'); //不显示用户为空的记录
        if (IS_POST){
            $username = trim(I('post.username'));
            $question = trim(I('post.question'));
            if ($username){
                $where['u.username'] = array('like',"%{$username}%");
            }
            if ($question){
                $where['q.question'] = array('like',"%{$question}%");
            }

             cookie('username',$username?:null);
             cookie('question',$question?:null);
        }

        //是否有传入视频ID
        $vid     = I('get.vid','','intval');
        $user_id = I('get.user_id',0,'intval');
        if ($vid) $where['vid'] = $vid;
        if ($user_id) $where['user_id'] = $user_id;

        $videoQuestionDb = M('video_question as q');
        $field      = 'q.id, c.name as video_group, v.title as video_title, u.username, q.question, q.is_reply, q.addtime, q.is_show';
        $join_user  = 'left join `ht_user` as u on u.id = q.user_id';
        $join_video = 'left join `ht_video` as v on v.id = q.vid';
        $join_video_category = 'left join `ht_video_category` as c on v.category_id = c.id';
        $count = $videoQuestionDb->join($join_user)->join($join_video)->where($where)->count();
        $page  = new \Think\Page($count, $listsRows);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $video_question = $videoQuestionDb->join($join_user)->join($join_video)->join($join_video_category)->limit($limit)->where($where)->field($field)->select();
        $pages = $page->show();

        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('count',$count);
        $this -> assign('video_question',$video_question);

        $this -> display();
    }

    // 修改问题显示状态
    public function changeShow(){
        if (IS_POST) {
            $question_id = I('post.question_id');
            $is_show = I('post.is_show');
            if ($question_id) {
                $result = M('video_question')->where(array('id' => $question_id))->setField(array('is_show' => $is_show));
                if ($result) {
                    $this->ajaxReturn(array('code' => 1));
                }else{
                    $this->ajaxReturn(array('code' => 0));
                }
            }
        }
    }


    //视频答疑-查看问题弹窗
    public function videoQuestionShow(){

        // 回复答疑
        if(IS_POST){
            $question_id   = I('post.question_id',0,'intval');
            $answer_id   = I('post.answer_id',0,'intval');
            $answer      = I('post.answer');
            if (!$question_id) {
                $this->ajaxReturn(array('code'=>0, 'msg'=>'question_id为空！'));
            }
            if(!$answer){
                $this->ajaxReturn(array('code'=>0, 'msg'=>'回复内容不能为空！'));
            }

            $time = time();
            $VideoQuestionAnswerDb = M('VideoQuestionAnswer');
            $VideoQuestionDb = M('VideoQuestion');
            $vid = $VideoQuestionDb->where(array('id' => $question_id))->getField('vid');
            $data = array('question_id' => $question_id, 'user_id' => self::$admin_answer_id, 'vid' => $vid,'answer' => $answer, 'addtime' => $time);
            $userdata = array(); //AJAX返回的用户信息
            if ($answer_id) {
                $data['pid'] = $answer_id;
                $reply_user = M('VideoQuestionAnswer as a')
                                  ->join('ht_user u on u.id = a.user_id')
                                  ->where(array('a.id' => $answer_id))->field('u.id, u.username')->find();
                $userdata['reply_user_id'] = $data['reply_user_id'] = $reply_user['id'];
                $userdata['reply_username'] = $reply_user['username'];
                $userdata['reply_user_group_id'] = getDefaultUserGroup($userdata['reply_user_id']);
            }
            $result = $VideoQuestionAnswerDb->add($data);
            if ($result) {
              $is_reply_res = $VideoQuestionDb->where(array('id' => $question_id))->setField(array('is_reply' => 1));
              if ($is_reply_res !== false) {
                //   后台绑定的用于回复的用户信息
                $bind_reply_user = M('User as a')->where(array('id' => self::$admin_answer_id))->field('id, username, face')->find();
                  $userdata['answer_id'] = $result;
                  $userdata['username'] = $bind_reply_user['username'];
                  $userdata['face'] = $bind_reply_user['face'];
                  $userdata['id'] = self::$admin_answer_id;
                  $userdata['addtime'] = date('m-d H:i', $time);
                  $userdata['group_id'] = getDefaultUserGroup(self::$admin_answer_id);
                  $this->ajaxReturn(array('code' => 1, 'userdata' => $userdata));
              }else{
                  $this->ajaxReturn(array('code' => 0, 'msg' => '回复失败'));
              }
            }else{
              $this->ajaxReturn(array('code' => 0, 'msg' => '回复失败'));
            }
        }else{
            $userBb = M('User');
            // 回复列表
            $question_id = I('get.question_id',0,'intval');
            $db = D('UserView');
            //问题详细信息
            $question_info = M('video_question')->where(array('id'=>$question_id))->find();
//            提问用户详细信息
            $question_info['userinfo'] = $userBb->where(array('id'=>$question_info['user_id']))->field('face,username,id')->find();
            $question_info['userinfo']['group_id'] = getDefaultUserGroup($question_info['user_id']);

//            此条问题的所有回复
            $answer = M('video_question_answer')->where(array('question_id'=>$question_info['id']))->order()->select();

            if($answer){
                // 查询每条回复的用户信息

                foreach($answer as $k=>$v){

                    // 回复的用户信息
                        // $a_userinfo = $userBb->where(array('id'=>$v['user_id']))->field('face,username,id')->find();
                        $answer[$k]['a_userinfo'] = $userBb->where(array('id'=>$v['user_id']))->field('face,username,id')->find();
                        $answer[$k]['a_userinfo']['group_id'] = getDefaultUserGroup($v['user_id']);
                    if ($v['reply_user_id']) {
                         // 回复的回复
                        $answer[$k]['b_userinfo'] = $userBb->where(array('id'=>$v['reply_user_id']))->field('face,username,id')->find();
                        $answer[$k]['b_userinfo']['group_id'] = getDefaultUserGroup($v['reply_user_id']);

                    }


                }

                $question_info['answer'] = $answer;
            }
            $this -> assign('question_info',$question_info);
            $this -> assign('bind_reply_id',self::$admin_answer_id);
            $this -> display();
        }
    }


    //删除视频提问
    public function videoQuestionDelete(){
        $page  = I('get.p',1,'intval');
        $ids   = I('get.id/a');

        $answer_where['question_id'] = $question_where['id'] = array('in', $ids);

        $answer_result = M('video_question_answer')->where($answer_where)->delete();
        $question_result = M('video_question')->where($question_where)->delete();

        if ($answer_result && $question_result){
            $this->success('删除成功！',U(MODULE_NAME.'/Video/videoQuestion',array('p'=>$page)));
        }else{
            $this->error('删除失败！',U(MODULE_NAME.'/Video/videoQuestion',array('p'=>$page)));
        }

    }

    //删除回答
    public function videoAnswerDelete(){
        if($_POST){
            $answer_id   = I('post.answer_id',0,'intval');
            // if(!M('video_question_answer')->where(array('id'=>$answer_id))->find())
            //     exit(json_encode(array('error'=>1,'msg'=>'此回复不存在')));
            if ($answer_id) {
                $result = M('video_question_answer')->where(array('id'=>$answer_id))->delete();
                if ($result) {
                    $this->ajaxReturn(array('code'=>1,'msg'=>'删除成功！'));
                }else{
                    $this->ajaxReturn(array('code'=>0,'msg'=>'删除失败！'));
                }
            }


        }
    }


    //    上传视频封面
    function uploadCoverImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $rootPath = '/Uploads/';
        $upload->rootPath   =    '.' . $rootPath;
        $upload->savePath  =      'video/'; // 设置附件上传（子）目录
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
