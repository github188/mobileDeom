<?php
/**
 * Created by ouHai.
 * User: lxl
 * Date: 2017/6/14
 * Time: 11:13
 */

namespace Admin\Controller;


class AdController extends CommonController
{
    //广告区域
    static public $area = array(
        1 => 'PC登陆前广告',
        2 => 'PC登陆后广告',
        3 => '手机端登录前',
        4 => '手机端登陆后',
    );
    //广告列表
    public function adList(){

        $ad_db = M('ad');
        $where = array();
        #搜索条件
        $area = I('area',1,'intval');

        if ($area){
            $where['area'] = $area;
            #$where['area'] = array('LIKE', '%'.urldecode($area).'%');
        }

        $count = $ad_db->where($where)->count();// 查询满足要求的总记录数
        $page  = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $limit = $page->firstRow.','.$page->listRows;
        $data  = $ad_db->where($where)->order('sort DESC,id DESC')->limit($limit)->select();
        foreach ($data as $key => $value){
            $data[$key]['area'] = self::$area[$value['area']];
        }
        $pages  = $page->show();// 分页显示输出
        $this->assign('data',$data);
        $this->assign('area',self::$area);
        $this->assign('self_area',$area);
        $this->assign('pages',$pages);// 赋值分页输出
        $this->assign('totalPages',$page->totalPages);// 赋值分页输出
        $this->display();
    }


    //添加新广告
    public function adAdd () {

        if (IS_POST) {
            $link_url = I('post.link_url','');
            $area     = I('post.area',0,'intval');
            $is_show  = I('post.is_show',0,'intval');
            $is_alert = I('post.is_alert',0,'intval');
            $sort     = I('post.sort',0,'intval');
            $end_time = I('post.end_time','');

            if (!$link_url) $this->error('请填写广告链接!');
            if (!$area) $this->error('请选择广告区域!');

            // 封面图片
            if($_FILES['image']['size'] > 0){
                $cover_img = $this->uploadCoverImg();
            }

            $data = array(
                'img_url'  => $cover_img,
                'link_url' => $link_url,
                'area'     => $area,
                'is_alert' => $is_alert,
                'end_time' => $end_time?strtotime($end_time):0,
                'is_show'  => $is_show,
                'sort'     => $sort,
                'addtime'  => time(),
            );
            if (M('ad')->data($data)->add()) {
                $this->success('添加成功!', U(MODULE_NAME.'/Ad/adList'));
            }else{
                $this->error('添加失败!');
            }

        }else{
            //分类
            $this->assign('area', self::$area);
            $this->display();
        }

    }

    //编辑广告
    public function adEdit () {
        $id   = I('id',0,'intval');
        $page = I('page',1,'intval');
        $db = M('ad');
        $info = $db->where(array('id'=>$id))->find();
        if(!$id or !$info)
            $this->error('请选择要编辑的广告!');

        if (IS_POST) {
            $link_url = I('post.link_url','');
            $area     = I('post.area',0,'intval');
            $is_show  = I('post.is_show',0,'intval');
            $is_alert = I('post.is_alert',0,'intval');
            $sort     = I('post.sort',0,'intval');
            $end_time = I('post.end_time','');
            $cover_img= '';
            if (!$link_url) $this->error('请填写广告链接!');
            if (!$area) $this->error('请选择广告区域!');

            // 封面图片
            if($_FILES['image']['size'] > 0){
                $cover_img = $this->uploadCoverImg();
                if($cover_img){
                    $delete_file = $_SERVER['DOCUMENT_ROOT'].$info['img_url'];
                    @file_exists($delete_file)?@unlink($delete_file):'';
                }
            }
            $data = array(
                'link_url'   => $link_url,
                'area'       => $area,
                'is_alert'   => $is_alert,
                'end_time'   => $end_time?strtotime($end_time):0,
                'is_show'    => $is_show,
                'sort'       => $sort,
                'updatetime' => time(),
            );
            if($cover_img)
                $data['img_url'] = $cover_img;

            $db->where(array('id'=>$info['id']))->data($data)->save();
            $this->success('编辑成功!', U(MODULE_NAME.'/Ad/adList',array('p'=>$page)));
        }else{
            $this->assign('area', self::$area);
            $this->assign('info',$info);
            $this->assign('page',$page);
            $this->display();
        }

    }


    //删除广告
    public function adDelete () {
        $ids = I('get.id/a');
        $page = I('get.page',1,'intval');
        if(!$ids) $this->error('请选择要删除的广告!');
        $db = M('ad');

        foreach($ids as $k => $id){
            $id = intval($id);
            $info = $db->where(array('id'=>$id))->field('id,img_url')->find();
            $delete_file = $_SERVER['DOCUMENT_ROOT'].$info['img_url'];
            if(@file_exists($delete_file)){
                @unlink($delete_file);
            }
            $db->where(array('id'=>$id))->delete();
        }
        $this->success('删除成功!', U(MODULE_NAME.'/Ad/adList',array('p'=>$page)));
    }


    //    上传图片
   private function uploadCoverImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $rootPath = '/Uploads/';
        $upload->rootPath  =    '.' . $rootPath;
        $upload->savePath  =    'ad/'; // 设置附件上传（子）目录
        $upload->subName   =    array('date','Ymd'); //子目录创建方式
        $upload->saveName  =    array('time'); // 文件名
        $upload->maxSize   =    5*1024*1024 ;// 设置附件上传大小
        $upload->exts      =    array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $info   =   $upload->uploadOne($_FILES['image']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            return $rootPath . $info['savepath'] . $info['savename'];
        }

    }

}