<?php
namespace Member\Controller;
use Think\Controller;




//默认首页控制器
class IndexController extends EmptyController {

    const VIDEO_FREE  = 1;  //付款方式 免费
    const VIDEO_CHARGE = 2; //付款方式 收费


    //公共发送手机或邮箱验证码
    public function publicSendCode(){
        if(IS_AJAX){
            $num = I('num','');
            //发送手机验证码
            if(isPhone($num)){
                $result = get_mobile_code($num);
                if($result['status']==1)
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>1));//发送成功
                else
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>0));//发送失败
            }
            //发送邮箱验证码
            elseif(isEmail($num)){
                $result = get_email_code($num);
                if($result['status']==1)
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>1));//发送成功
                else
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>0));//发送失败
            }
            else
                $this->ajaxReturn(array('msg'=>'请输入正确的手机或邮箱','status'=>0));
        }else{
            _404();
        }
    }

    //首页
    public function index(){
        $article_other_db = M('article_other');
        $user_db       = M('user');
        $video_db      = M('video');
        $userGroup_db  = M('user_group');
        $user_id       = session(C('USER_AUTH_UID'));

        $this->user_arr = M('user')->where(array('id'=> $user_id))->field('password,encrypt',true)->find();//用户信息

        $this->coursePrice = $userGroup_db->where(array('allow_buy'=>1))->cache(30)->limit(4)->order('sort ASC,buy_money DESC,id DESC')->select();

        /*
         * 此处配合领导要求--统计结果*2
         */
        $this->userCount  = ($user_db->count('id'))*2;     //会员总人数
        $this->videoCount = ($video_db->count('id'))*2;    //视频总节数
        $this->timeCount  = ceil(($video_db->sum('video_time'))/60)*2;     //时间总长


        $this->banner = M('ad')->where(array('is_show'=>1,'area'=>1))->cache(30)->order('sort DESC,id DESC')->select();//轮播图广告
        $this->videoshow = $video_db->where('status=0')->cache(30)->limit(16)->order('is_tag DESC,id DESC')->select();//热门视频
        $this->student = $article_other_db->where(array('type'=>2,'is_show'=>1))->cache(30)->limit(4)->order('sort ASC,id DESC')->select();//学员介绍
        $this->notice  = $article_other_db->where(array('type'=>3,'is_show'=>1))->cache(30)->limit(7)->order('sort ASC,id DESC')->select();//平台公告
        $this->ganhuo  = $article_other_db->where(array('type'=>4,'is_show'=>1))->cache(30)->limit(7)->order('sort ASC,id DESC')->select();//干货分享
        $this->problem = $article_other_db->where(array('type'=>5,'is_show'=>1))->cache(30)->limit(7)->order('sort ASC,id DESC')->select();//常见问题


        $this->assign('user_id',$user_id);
        $this->display();
    }

    //课程内容
    public function course(){
        $article_other_db  = M('article_other');
        $userGroup_db      = M('user_group');
        $userGroup     = $userGroup_db->where(array('allow_buy'=>1))->cache(30)->order('sort ASC,buy_money DESC,id DESC')->select();
        $userGroupInfo = array();

        foreach($userGroup as $k=>$v){

            $userGroupInfo[] = $article_other_db->where(array('type' => 1, 'title'=>array('LIKE', "%{$v['name']}%")))->find();
        }

        $this->assign('userGroup',$userGroup);
        $this->assign('userGroupInfo',$userGroupInfo);
        $this->display();
    }

    //首页更多视频
    public function videoList()
    {

        $category_id     = I('get.category_id',0,'intval');#视频分类
        $type            = I('get.type',0,'intval');    #收费类型  1免费  2付费
        $key_word        = I('get.key_word','','trim');#视频标题
        $search_tg_category     = I('get.search_tg_category',0,'intval');    #推广标签类型 1推荐 2最新

        $video_c_db      = M('video_category');
        $video_db        = M('video');
        $video_s_db      = M('video_shoucang');
        $user_id = session(C('USER_AUTH_UID'));


//        $category_id?cookie('category',$category_id):cookie('category',null);
//        $type?cookie('type',$type):cookie('type',null);
        $key_word?cookie('key_word',$key_word):cookie('key_word',null);
//
//
//        $category_id     = cookie('category');#视频分类
//        $type            = cookie('type');    #收费类型
        $key_word        = cookie('key_word');#视频标题
//

        $where = array();
        $where['status'] = 0;
        if($category_id){
            $where['category_id'] = $category_id;
        }

        if($key_word){
            $where['title'] = array('LIKE',"%{$key_word}%");
        }
        if($type){
            if ($type == self::VIDEO_FREE){
                $where['_string'] = "buy_money = 0 || buy_money = 0.00";
            }elseif($type == self::VIDEO_CHARGE){
                $where['_string'] = "buy_money <> 0";
            }
        }
        if ($search_tg_category){
            $where['is_tag'] = $search_tg_category;
        }



        $count = $video_db->where($where)->count();
        $page  = new \Think\Page($count,12);
        $limit = $page->firstRow.','.$page->listRows;

//        dump($where);
        $video = $video_db->where($where)->limit($limit)->order('is_tag DESC,id DESC')->select();
//        echo $video_db->getLastSql();die;
        foreach($video as  $k=>$v){
            #判断视频是否被收藏
            $video[$k]['shoucang'] = $video_s_db->where(array('user_id'=>$user_id,'vid'=>$v['id']))->getField('id');
        }
        $pages = $page->show();




        //课程类别
        $video_category = $video_c_db->where('status=0 && pid <> 0')->select();
        //推广方式 视频标签
        $tg_category = \Admin\Controller\VideoController::$video_tag;



        $this->assign('video_category',$video_category);
        $this->assign('type',$type);
        $this->assign('tg_category',$tg_category);
        $this->assign('search_tg_category',$search_tg_category);
        $this->assign('video',$video);
        $this->assign('category_id',$category_id);
        $this->assign('user_id',$user_id);
        $this->assign('pages',$pages);
        $this->assign('totalPages',$page->totalPages);

        $this->display();
    }

}
