<?php
namespace Mobile\Controller;
use Think\Controller;
use Lib\Util\Category;
class StudyController extends CommonController {

    public static $replyPageSize = 3; //回复每页条数
    public static $questionPageSize = 5; //问题每页条数
    public static $notePageSize = 12; //笔记每页条数

    //登陆后首页
    public function index(){
        $user_id = session(C('USER_AUTH_UID'));
        #获取左侧视频菜单列表
        $this->leftVideoMenu();
        #网站公告列表
        $db  =  M('article_other');
        $where   =  array('type'=>3,'is_show'=>1);
        $this->notice  =  $db->where($where)->limit(8)->order('sort ASC,id DESC')->field('id,title,addtime')->select();
        #已学习的课程节数统计
        $this->learned = M('video_play_record')->where(array('user_id'=>$user_id))->count();
        #提问统计
        $this->question = M('video_question')->where(array('user_id'=>$user_id))->count();
        #学习排名
        $this->user_ranking = M('user_ranking')->where(array('user_id'=>$user_id))->order('addtime DESC')->getField('ranking');

        $newQuestion = self::getNewQuestion();

        #最新问答
        $this->assign('newQuestion', $newQuestion);
        $this->assign('user_id', session(C('USER_AUTH_UID')));

        $this->display();
    }


    //左侧视频菜单列表
    public function leftVideoMenu(){
        $video_c_db      = M('video_category');
        $video_c_auth_db = M('video_category_auth');
        $video_db        = M('video');
        $video_auth_db   = M('video_auth');
        $video_play_db   = M('video_play_record');
        $user_id = session(C('USER_AUTH_UID'));
        $user_groud = M('user_group_ext')->where(array('user_id'=>$user_id))->field('group_id')->select();

        $video_category = $video_c_db->where(array('status'=>0,'pid'=>0))->select();
        foreach($video_category as $k=>$v){
            $video_category[$k]['children'] = $video_c_db->where(array('status'=>0,'pid'=>$v['id']))->select();
            #循环视频分类
            if($video_category[$k]['children']){
                foreach($video_category[$k]['children'] as $kk=>$vv){

                    #查出该视频分组允许查看的用户组
                    $category_auth = array();
                    $video_category_auth = $video_c_auth_db->where(array('category_id'=>$vv['id']))->field('ugid')->select();
                    foreach($video_category_auth as $_k => $_v){
                        $category_auth[] = $_v['ugid'];
                    }
                    #播放权限  1允许 2不允许
                    $VideoNum1 =$VideoNum2 = 0;
                    foreach($user_groud as $_kk => $_vv){
                        if(in_array($_vv['group_id'],$category_auth)){
                            $can = 1;
                            $VideoNum1 = $video_db->where(array('category_id'=>$vv['id']))->count();

                        }else{
                            $VideoNum2 = $video_auth_db->where(array('user_id'=>$user_id,'end_time'=>array('GT',time())))->count('id');
                            $can = 2;
                        }
                    }
                    #已开通的视频总节数数
                    $video_category[$k]['children'][$kk]['AllowSeeVideo'] = $VideoNum1+$VideoNum2;
                    #统计允许查看的视频组
                    $video_category[$k]['children'][$kk]['allow_play'] = $can;

                    #计算已播放视频进度条
                    $AllvideoTime = $video_db->where(array('category_id'=>$vv['id']))->sum('video_time');
                    $SeevideoTime = $video_play_db->where(array('category_id'=>$vv['id']))->sum('playtime');

                    #已播放时间占总时间的百分比
                    $percent = round($SeevideoTime/$AllvideoTime*100);
                    $video_category[$k]['children'][$kk]['progress'] = $percent<100?$percent:100;
                }
            }
        }

        $this->assign('video_category',$video_category);
    }



//   ———————————————————————— 问答相关代码——————————————————————————————————————————————————————————————

    /**
     * 学习助手--最新问答
     */
    public function newQuestion(){
        $user_id = session(C('USER_AUTH_UID'));
        $question = self::getNewQuestion();
        $this->assign('question',$question);
        $this->assign('user_id',$user_id);
        $this->display();
    }


    /**
     * 获取问答列表
     * @param  array  $addwhere  附加条件
     * @return array
     */
    static function getNewQuestion($addwhere = '', $limit = 12){

        $v_question_db  = M('video_question q');
        $v_answer_db    = M('video_question_answer q');
        $v_question_shoucang_db    = M('video_question_shoucang');
        $where = array('q.is_show'=>1);

//        合并附加条件
        if ($addwhere){
            $where = array_merge($where, $addwhere);
        }

//        要获取的字段
        $field = 'q.*, u.username, u.face, vc.id as category_id, v.id as vid, vc.name as category_name, v.title as video_name';

//        问答列表
        $question = $v_question_db->join('ht_video v on q.vid=v.id')->join('ht_video_category vc on v.category_id=vc.id')
            ->join('ht_user u on q.user_id=u.id')->where($where)->field($field)->limit($limit)->order('q.id DESC')->select();

        foreach($question as $k=>$v){
//            获取默认显示的用户组id
            $question[$k]['user_group_id'] = getDefaultUserGroup($v['user_id']);

//            查询对应问答下的回复
            $question[$k]['answer'] = $v_answer_db->join('ht_user u on q.user_id=u.id')->field('q.*, u.username, u.face')->where(array('q.question_id'=>$v['id']))->limit(self::$replyPageSize)->select();

//            查询对应问答下的回复数量
            $question[$k]['count'] = $v_answer_db->join('ht_user u on q.user_id=u.id')->where(array('q.question_id'=>$v['id']))->count();

//            格式化日期
            $question[$k]['addtime'] = date('Y-m-d H:i', $question[$k]['addtime']);

            $shoucang = $v_question_shoucang_db->where(array('question_id' => $v['id'], 'user_id' => session(C('USER_AUTH_UID'))))->getField('id');
            $question[$k]['is_shoucang'] = $shoucang ? 1 : 0;
//            url解码显示
            $question[$k]['question'] = urldecode(htmlspecialchars_decode(stripslashes($question[$k]['question'])));

//            该问答最后一条回复记录id
            $end_id = $v_answer_db->join('ht_user u on q.user_id=u.id')->where(array('q.question_id'=>$v['id']))->order('q.id desc')->limit(1)->getField('q.id');

//            该页最后一条记录id
            $limitEndId = end($question[$k]['answer']);

//            如果该页最后一条记录id不等于该视频最后一条记录的id，则显示查看更多
            if ($end_id != $limitEndId['id']){
                $question[$k]['is_show_more'] = 1;
            }

            $question[$k]['end_id'] = $end_id;
            $question[$k]['limit_end_id'] = $limitEndId['id'];

            //获取回复的回复
            if ($question[$k]['answer']){
                $reply2 = self::getReplyLevel2($question[$k]['answer']);
                $question[$k]['answer'] = $reply2;
            }
        }

        $data['question'] = $question;
//      外层最大id
        $big_end_id = $v_question_db->join('ht_video v on q.vid=v.id')->join('ht_video_category vc on v.category_id=vc.id')
            ->join('ht_user u on q.user_id=u.id')->where($where)->limit(1)->order('q.id')->getField('q.id');

        $big＿limit_end_id = end($question);
//        echo $big＿limit_end_id['id'];die;
        if ($big_end_id != $big＿limit_end_id['id']){
            $data['is_show_more'] = 1;
        }
        $data['end_id'] = $big_end_id;
        $data['limit_end_id'] = $big＿limit_end_id['id'];

//      问答总数
        $data['total'] = $v_question_db->join('ht_video v on q.vid=v.id')->join('ht_video_category vc on v.category_id=vc.id')
            ->join('ht_user u on q.user_id=u.id')->where($where)->order('q.id DESC')->count();

        return $data;
    }


    /**
     * 问答内的回复的点击加载更多
     * @param int  $last_question_id  当前页最后一条记录id
     * @param  int  $question_id  问答id
     */
    function questionPage(){
        if (IS_AJAX){
            $limit_end_id = I('get.limit_end_id','','intval');
            $question_id = I('get.question_id','','intval');
            if (!$limit_end_id){
                $this->error('last_answer_id为空');
            }
            if (!$question_id){
                $this->error('question_id为空');
            }
            $videoQuestionAnswerDb = M('video_question_answer q');
            $where = array('q.question_id' => $question_id);
            $where['q.id'] = array('GT', $limit_end_id);
            $data['answerList'] = $videoQuestionAnswerDb->join('ht_user u on q.user_id=u.id')->field('q.*, u.username, u.face')->where($where)->limit(self::$replyPageSize)->select();

            //是否是该最后一条回复，用于判断是否显示查看更多
            $end_id = $videoQuestionAnswerDb->join('ht_user u on q.user_id=u.id')->where($where)->limit(1)->order('q.id desc')->getField('q.id');
            $limit_end_id = end($data['answerList']);
            if ($end_id != $limit_end_id['id']){
                $data['is_show_more'] = 1;
            }

            $data['limit_end_id'] = $limit_end_id['id'];

            if ($data['answerList']){
                //获取回复的回复得用回信息
                $data['answerList'] = self::getReplyLevel2($data['answerList']);

                $this->ajaxReturn(array('code' => 1, 'data' => $data));
            }else{
                $this->ajaxReturn(array('code' => 0, 'msg' => '_______________________没有更多了________________________'));
            }

        }
    }



    /**
     * 问答列表点击加载更多
     * @param  int  $last_question_id  当前页最后一条记录id
     */
    function questionListPage(){
        if (IS_AJAX){
            $user_id = session(C('USER_AUTH_UID'));

//          我收藏的问答
            $myShouwCang = M('video_question_shoucang')->where(array('user_id' => $user_id))->field('question_id')->select();

//            提取出我收藏的问答的id，组装成数组，作为查询条件获取问答详细信息
            $shoucang_id_str = '';
            foreach ($myShouwCang as $k => $v){
                $shoucang_id_str .= $v['question_id'].',';
            }
            $shoucang_id_str = substr($shoucang_id_str, 0, strlen($shoucang_id_str)-1);


            $last_question_id = I('get.last_limit_id', '', 'intval');
            $is_shoucang = I('get.is_shoucang', '', 'intval');

            if($is_shoucang){
                $addwhere['_string'] = "(q.id < {$last_question_id} and q.id in ({$shoucang_id_str}))";
            }else{
                $addwhere['q.id'] = array('LT', $last_question_id);
            }



            $questionList = self::getNewQuestion($addwhere);
            if ($questionList['question']){
                //获取回复的回复
                $this->ajaxReturn(array('code' => 1, 'data' => $questionList));
            }else{
                $this->ajaxReturn(array('code' => 0, 'msg' => '___________没有更多了___________'));
            }

        }
    }


    function myQuestionPage(){
        if (IS_AJAX){
            $user_id = session(C('USER_AUTH_UID'));

//          我收藏的问答
            $myShouwCang = M('video_question_shoucang')->where(array('user_id' => $user_id))->field('question_id')->select();

//            提取出我收藏的问答的id，组装成数组，作为查询条件获取问答详细信息
            $shoucang_id_str = '';
            foreach ($myShouwCang as $k => $v){
                $shoucang_id_str .= $v['question_id'].',';
            }
            $shoucang_id_str = substr($shoucang_id_str, 0, strlen($shoucang_id_str)-1);


            $last_question_id = I('get.last_limit_id', '', 'intval');
            $is_shoucang = I('get.is_shoucang', '', 'intval');

            if($is_shoucang){
                $addwhere['_string'] = "(q.id < {$last_question_id} and q.id in ({$shoucang_id_str}))";
            }else{
                $addwhere['q.id'] = array('LT', $last_question_id);
            }

            $addwhere['q.user_id'] = $user_id;


            $questionList = self::getNewQuestion($addwhere);
            if ($questionList['question']){
                //获取回复的回复
                $this->ajaxReturn(array('code' => 1, 'data' => $questionList));
            }else{
                $this->ajaxReturn(array('code' => 0, 'msg' => '___________没有更多了___________'));
            }

        }
    }


    /**
     * 获取一级回复的二级回复
     * @param  array  $answer  所有一级回复
     * @return array
     */
    function getReplyLevel2($answer){

        $user_db = M('user');
        foreach ($answer as $key => $val){
//                    获取用户默认显示的用户组id
            $answer[$key]['user_group_id'] = getDefaultUserGroup($val['user_id']);
            $answer[$key]['addtime'] = date('Y-m-d', $answer[$key]['addtime']);
            $answer[$key]['answer'] = urldecode(htmlspecialchars_decode(stripslashes($answer[$key]['answer'])));
            if ($val['reply_user_id']){
                $reply2 = $user_db->where(array('id' => $val['reply_user_id']))->field('username as reply_username, face as reply_face')->find();
                $answer[$key]['reply_user_group_id'] = getDefaultUserGroup($val['reply_user_id']);
                $answer[$key]['reply_username'] = $reply2['reply_username'];
                $answer[$key]['reply_face'] = $reply2['reply_face'];
            }
        }

        return $answer;
    }



    /**
     * 学习助手--我的课程
     */
    public function myCourse(){

        $time = time();
        $Model = M();
        $pageSize = 12;
        $xin_user_id = session(C('USER_AUTH_UID'));
        $field = 'v.id, v.title, v.cover_img, v.buy_money, v.is_tag';

//        如果是AJAX請求
        if (IS_AJAX){
            $category_id = I('get.category_id');
            $union_one_where = " ug.user_id = {$xin_user_id} and v.status = 0"; //第一个联合查询的条件
            $union_one_where .= " and ug.start_time < {$time} and ug.end_time > {$time}"; //第二个联合查询的条件

            $union_two_where = " auth.start_time < {$time} and auth.end_time > {$time}";

            if ($category_id){
                $union_one_where .= " and v.category_id = {$category_id}";
                $union_two_where .= " and v.category_id = {$category_id}";
            }

        }else{
            $union_one_where = " ug.user_id = {$xin_user_id} and v.status = 0 and ug.start_time < {$time} and ug.end_time > {$time}";
            $union_two_where = "auth.start_time < {$time} and auth.end_time > {$time}";
        }

//      组合查询按用户组购买的视频和单独购买的视频
        $countSql = "select count(*) from(select {$field} from ht_user_group_ext as ug 
                        left join ht_video_category_auth as auth on auth.ugid = ug.group_id 
                        left join ht_video as v on v.category_id = auth.category_id 
                        where {$union_one_where}
                        union all select {$field} from ht_video_auth as auth 
                        join ht_video as v on v.id = auth.vid where $union_two_where) v";

//      分页
        $count = $Model->query($countSql);
        $page  = new \Think\Page(current(current($count)), $pageSize);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $pages = $page->show();

//      视频列表
        $dataSql   = strtr($countSql, array('count(*)' => $field));
        $dataSql  .= ' order by v.is_tag';
        $dataSql  .= ' limit '.$limit;
        $videoList = $Model->query($dataSql);

//      排序，將0排到最後
        foreach ($videoList as $k => $v){
            if ($v['is_tag'] == 0){
                $videoList[] = $videoList[$k];
                unset($videoList[$k]);
            }
        }

        if (IS_AJAX){
            $this->ajaxReturn(array('code' => 1, 'content' => $videoList, 'pages' => $pages, 'totalPages' => $page->totalPages));
        }else{
            // 视频分组tag栏
            $videoCategoryDb = M('video_category');
            $category = $videoCategoryDb->where(array('status' => 0, 'pid' => 0))->field('id,name')->order('sort desc')->select();
            foreach ($category as $key => $value) {
                $category[$key]['son'] = $videoCategoryDb->where(array('pid' => $value['id']))->field('id,name')->select();
            }

            $this->assign('pages',$pages);
            $this->assign('totalPages',$page->totalPages);
            $this->assign('video',$videoList);
            $this->assign('category', $category);
            $this->display('myCourse');
        }

    }


    /**
     * 发表问答
     * @param  int  $vid  视频id
     * @param  string  $content   发表的内容
     * @param  int  $category_id  视频分组id
     */
    function writeQuestion(){
        if (IS_POST){
            $user_id = session(C('USER_AUTH_UID'));
            $vid = I('post.vid');
            $content = I('post.content');
            $time = time();

            if (!$vid){
                $this->error('vid不能为空！');
            }
            if (self::isEmpty($content) === false){
                $this->error('发布内容不能为空！');
            }

//          查询视频所属分组category_id
            $category_id = M('video')->where(array('id' => $vid))->getField('category_id');
            $question_id = M('video_question')->add(array('user_id' => $user_id, 'vid' => $vid, 'question' => $content, 'addtime' => $time, 'category_id' => $category_id));
            if ($question_id){
                $data['status'] = 1;
                $data['data'] = array('question_id' => $question_id, 'content' => $content, 'username' => session(C('USER_AUTH_UNAME')), 'addtime' => date('Y-m-d H:i',$time), 'face' => session(C('USER_FACE')), 'user_group_id' => session(C('USER_GROUP_ID')));
                $this->ajaxReturn($data);
            }else{
                $this->ajaxReturn(array('status' => 0, 'msg' => '发表失败'));
            }
        }
    }


    /**
     * 学习助手--我的提问
     */
    public function myQuestion(){

        $user_id = session(C('USER_AUTH_UID'));
        $where = array('q.user_id' => $user_id);

//      获取我的提问列表
        $question = self::getNewQuestion($where);

        $this->assign('question',$question);

        $this->assign('user_id',$user_id);
        $this->display();

    }

    /**
     * 学习助手--所有提问
     */
    public function allQuestion(){

        $user_id = session(C('USER_AUTH_UID'));


//      获取所有提问列表

        $allquestion = self::getNewQuestion();


        $this->assign('allquestion',$allquestion);

        $this->assign('user_id',$user_id);
        $this->display();

    }


    /**
     * 学习助手--问答收藏
     */
    public function faqQuestion(){
            $user_id = session(C('USER_AUTH_UID'));

//          我收藏的问答
            $myShouwCang = M('video_question_shoucang')->where(array('user_id' => $user_id))->field('question_id')->select();

//            提取出我收藏的问答的id，组装成数组，作为查询条件获取问答详细信息
            $shoucang_id_str = '';
            foreach ($myShouwCang as $k => $v){
                $shoucang_id_str .= $v['question_id'].',';
            }
            $shoucang_id_str = substr($shoucang_id_str, 0, strlen($shoucang_id_str)-1);
            $shoucang_id_arr = explode(',', $shoucang_id_str);

            $where = array('q.is_show'=>1);
            $where['q.id'] = array('IN',$shoucang_id_arr);

//          获取收藏列表
            $question = self::getNewQuestion($where);
            $this->assign('question',$question);
            $this->assign('user_id',$user_id);
            $this->display();
        }


    /**
     * 学习助手--课程收藏
     */
    public function faqCourse(){
        $user_id = session(C('USER_AUTH_UID'));
        $video_shoucang_db = M('video_shoucang s');
        //分页
        $count = $video_shoucang_db->join('ht_video v on v.id = s.vid')->field('s.id, v.id as vid,v.title,s.addtime')->where(array('s.user_id' => $user_id))->count();
        $page  = new \Think\Page($count, 10);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $pages = $page->show();


        $dataList = $video_shoucang_db->join('ht_video v on v.id = s.vid')->field('s.id, v.id as vid,v.title,s.addtime')->limit($limit)->where(array('s.user_id' => $user_id))->select();
        $this->assign('dataList', $dataList);
        $this->assign('pages', $pages);
        $this->assign('totalPages', $page->totalPages);
        $this->display();
    }



    /**
     * 回复问答
     * @param  int  $question_id  问答id
     * @param  int  $answer_id  被回复的回复内容的id  为空时为直接回复问答
     * @param  string  $answer  回复的内容
     */
    function replyQuestion(){
        if(IS_POST){
            $user_id = session(C('USER_AUTH_UID'));
            // 回复提问
            $question_id   = I('post.question_id',0,'intval');
            $answer_id   = I('post.answer_id',0,'intval');
            $content      = I('post.content');

            if (!$question_id) {
                $this->ajaxReturn(array('status'=>0, 'msg'=>'question_id为空！'));
            }
            if(self::isEmpty($content) === false){
                $this->ajaxReturn(array('status'=>0, 'msg'=>'回复内容不能为空！'));
            }

            $time = time();
            $VideoQuestionShoucangDb = M('VideoQuestionShoucang');
            $VideoQuestionAnswerDb  = M('VideoQuestionAnswer');
            $VideoQuestionDb = M('VideoQuestion');
            $userdata = array(); //AJAX返回的用户信息
//          当前用户信息
            $userdata = M('user')->where(array('id' => $user_id))->field('id as user_id, username, face')->find();

//          当前问答的视频ID
            $question_info = $VideoQuestionDb->where(array('id' => $question_id))->Field('vid, user_id')->find();
            $user_son_id = $question_info['user_id'];
            $data = array('question_id' => $question_id, 'user_id' => $user_id, 'vid' => $question_info['vid'],'answer' => $content, 'addtime' => $time);

            if ($answer_id) {
                $reply_user = M('VideoQuestionAnswer as a')
                    ->join('ht_user u on u.id = a.user_id')
                    ->where(array('a.id' => $answer_id))->field('u.id, u.username')->find();

                if ($user_id == $reply_user['user_id']){
                    $this->ajaxReturn(array('status' => 0, 'msg' => '不能回复自己哦'));
                }

                $data['pid'] = $answer_id;

                $user_son_id = $userdata['reply_user_id'] = $data['reply_user_id'] = $reply_user['id'];
                $userdata['reply_username'] = $reply_user['username'];
                $userdata['reply_user_group_id'] = getDefaultUserGroup($reply_user['id']);
            }

            $result = $VideoQuestionAnswerDb->add($data);
            if ($result) {
//                添加用户佣金记录
                $add_result = self::addBrokerage($user_id, $user_son_id, $question_id);
                if (!$add_result){
                    $this->ajaxReturn(array('status' => 0, 'msg' => '增加佣金记录失败'));
                }
                $userdata['answer_id'] = $result;
                $userdata['user_group_id'] = getDefaultUserGroup($user_id);
                $userdata['addtime'] = date('Y-m-d H:i', $time);
                $userdata['content'] = $content;
                $this->ajaxReturn(array('status' => 1, 'data' => $userdata));

            }else{
                $this->ajaxReturn(array('status' => 0, 'msg' => '回复失败'));
            }

        }
    }



    /**
     *点击 收藏/取消收藏 问答
     * @param  int  $type  0收藏  1取消
     * @param  int  $question_id  问答id
     */
    function shouCang(){
        if (IS_AJAX){
            $user_id = session(C('USER_AUTH_UID'));
            $type = I('post.type','','intval');
            $question_id = I('post.question_id','','intval');
            $videoQuestionShoucangDb = M('video_question_shoucang');
            $videoQuestionDb = M('video_question');
            $status = true;

            if ($type == 0){
                $vid = $videoQuestionDb->where(array('id' => $question_id))->getField('vid');
                if ($vid){
                    $is_seet = $videoQuestionShoucangDb->where(array('user_id' => $user_id, 'question_id' => $question_id))->getField('id');
                    if ($is_seet){
                        $status = false;
                    }else{
                        $status = $videoQuestionShoucangDb->add(array('vid' => $vid, 'question_id' => $question_id, 'user_id' => $user_id, 'addtime' => time()));
                    }
                }
            }elseif($type == 1){
                $status = $videoQuestionShoucangDb->where(array('user_id' => $user_id, 'question_id' => $question_id))->delete();
            }

            if ($status){
                $this->ajaxReturn(array('code' => 1));
            }else{
                $this->ajaxReturn(array('code' => 0));
            }
        }
    }


    /**
     * 回复问答时增加用户佣金记录
     * @param  int $user_id  用户id
     * @param  int $user_son_id  被回复的用户的id
     * @param $question_id  问答id
     * @return bool
     */
    function addBrokerage($user_id, $user_son_id, $question_id){

        //is_brokerage回复时是否赚取佣金。brokerage用户佣金回扣 (金额、元)  暂时写死为100%
        $userBrokerage = M('user')->where(array('id' => $user_id))->field('is_brokerage, brokerage')->find();

//        如果没有权限或者回复的是自己，不增加佣金
        if (!$userBrokerage['is_brokerage'] || $user_id == $user_son_id){
            return true;
        }

        $type_money = 100;
        $type_unit = 100;

//      高精度函数进行浮点数计算
        $amount = bcmul($type_money, $type_unit/100, 2);
        $add = array(
            'user_id' => $user_id,
            'user_id_son' => $user_son_id,
            'type' => 1,
            'type_id' => $question_id,
            'type_money' => $type_money,
            'type_unit' => $type_unit,
            'amount' => $amount,
            'addtime' => time()
        );
        $result = M('user_brokerage')->add($add);
        if (!$result){
            return false;
        }

        return true;
    }




//   笔记相关代码——————————————————————————————————————————————————————————————————————————————————————————————————————————————

    /**
     * 学习助手--我的笔记
     */
    public function myNote(){
        $user_id = session(C('USER_AUTH_UID'));
        $noteList = self::getNote(array('n.user_id' => $user_id));
//        dump($noteList);die;
        $this->assign('noteList',$noteList);
        $this->display();
    }


    /**
     * 获取笔记
     * @param array $addwhere  附加查询条件
     * @return array
     */
    static function getNote($addwhere = ''){
        $where = array('n.is_show' => 1 );
        if ($addwhere){
            $where = array_merge($where, $addwhere);
        }
        $data['noteList'] = M('video_note n')->join('ht_video v on n.vid=v.id')
            ->join('ht_video_category vc on v.category_id=vc.id')
            ->where($where)
            ->order('n.id desc')
            ->limit(self::$notePageSize)
            ->field('n.id,n.content, n.user_id, n.addtime, n.playtime, vc.id as category_id, v.id as vid,vc.name as category_name, v.title as video_name')->select();
        foreach ($data['noteList'] as $k => $v){
            $data['noteList'][$k]['addtime'] = date('Y.m.d H:i',$v['addtime']);
            $data['noteList'][$k]['playtime'] = video_time_change($v['playtime']);
            $data['noteList'][$k]['content'] = htmlspecialchars_decode(stripslashes($v['content']));
        }


//      是否显示分页
        $end_id = M('video_note n')->join('ht_video v on n.vid=v.id')
            ->join('ht_video_category vc on v.category_id=vc.id')
            ->where($where)
            ->getField('n.id');
        $limit_end_id = end($data['noteList']);
        $limit_end_id = $limit_end_id['id'];
        if ($end_id != $limit_end_id){
            $data['is_show_more'] = 1;
        }

//        笔记总数
        $data['total'] = M('video_note n')->join('ht_video v on n.vid=v.id')
            ->join('ht_video_category vc on v.category_id=vc.id')
            ->where($where)
            ->count();

        $data['limit_end_id'] = $limit_end_id;
        return $data;
    }


    /**
     * 笔记点击加载更多
     * @param  int $last_ note_id  当前显示的最后一条笔记的ID
     * @param int $vid  视频ID
     */
    function notePage(){
        if (IS_GET){
            $last_note_id = I('get.last_note_id','','intval');
            $vid = I('get.vid','','intval');
            if ($vid){
                $addwhere['n.vid'] = $vid;
            }
            $addwhere['n.id'] = array('LT', $last_note_id);
            $addwhere['n.user_id'] = session(C('USER_AUTH_UID'));
            $noteList = self::getNote($addwhere);

            if ($noteList['noteList']){

                $this->ajaxReturn(array('status' => 1, 'data' => $noteList));
            }else{
                $this->ajaxReturn(array('status' => 0, 'msg' => '_____没有更多了_____'));
            }

        }
    }


    /**
     * 发表笔记
     * @param  int  $vid 视频id
     * @param  string  $content 发表内容
     * @param  string  $playtime 播放进度 秒
     */
    function writeNote(){
        if (IS_POST){
            $user_id = session(C('USER_AUTH_UID'));
            $vid = I('post.vid','','intval');
            $content = I('post.content');
            $playtime = I('post.playtime');
            $time = time();
            if (!$vid){
                $this->ajaxReturn(array('status' => 0, 'msg' => 'vid不能为空！'));
            }
            if (self::isEmpty($content) === false){
                $this->ajaxReturn(array('status' => 0, 'msg' => '发布内容不能为空！'));
            }
            if (!$playtime){
                $this->ajaxReturn(array('status' => 0, 'msg' => '请播放视频后再发表笔记！'));
            }

            $note_id = M('video_note')->add(array('user_id' => $user_id, 'vid' => $vid, 'content' => $content, 'addtime' => $time, 'playtime' => $playtime));
            if ($note_id){
                $data['status'] = 1;
                $data['data'] = array( 'note_id' => $note_id, 'content' => $content,'addtime' => date('Y-m-d H:i',$time), 'playtime' => video_time_change($playtime));
                $this->ajaxReturn($data);
            }else{
                $this->ajaxReturn(array('status' => 0, 'msg' => '发表失败'));
            }
        }
    }


    /**
     * 修改笔记
     * @param  int  $note_id  笔记id
     * @param  string  $content  修改后的内容
     */
    function editNote(){
        if (IS_AJAX){
            $note_id = I('post.note_id','','intval');
            $user_id = session(C('USER_AUTH_UID'));
            $content = I('post.content');
            if (!$note_id){
                $this->ajaxReturn(array('code' => 0, 'msg' => '笔记id不能为空！'));
            }
            if (self::isEmpty($content) === false){
                $this->ajaxReturn(array('code' => 0, 'msg' => '笔记内容不能为空！'));
            }

            $result = M('video_note')->where(array('user_id' => $user_id, 'id' => $note_id))->setField(array('content' => $content));
            if ($result === false){
                $this->ajaxReturn(array('status' => 0, 'msg' => '修改失败！'));
            }
            $this->ajaxReturn(array('status' => 1, 'msg' => '修改成功！'));
        }
    }


    /**
     * 删除笔记
     * @param  int  $note_id  笔记id
     */
    function deleteNote(){
        if (IS_AJAX){
            $note_id = I('post.note_id','','intval');
            $user_id = session(C('USER_AUTH_UID'));

            if (!$note_id){
                $this->ajaxReturn(array('status' => 0, 'msg' => '笔记id不能为空！'));
            }

            $result = M('video_note')->where(array('user_id' => $user_id, 'id' => $note_id))->delete();
            if (!$result){
                $this->ajaxReturn(array('status' => 0, 'msg' => '删除失败！'));
            }
            $this->ajaxReturn(array('status' => 1, 'msg' => '删除成功！'));
        }
    }


    /**
     * 判断编辑器输入内容是否为空
     *@param $content string
     *@return bool
     */
    function isEmpty($content){
        $content = trim(strtr($content, array('&amp;nbsp;' => '')));
        if ($content){
            return true;
        }

        return false;
    }


}
