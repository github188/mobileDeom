<?php
/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2017/5/25
 * Time: 15:54
 */

namespace Admin\Controller;


class ArticlexueController extends CommonController
{
//    文章类型
    public static $articleCategory = array(
        1 => '课程介绍',
        2 => '学员介绍',
        3 => '平台公告',
        4 => '官方资讯',
        5 => '常见问题',
        6 => '公司简介'
    );

    private $pageSize = 10;
    private $db;
    function  __construct()
    {
        parent::__construct();
        $this->db = M('ArticleOther');
    }

    public function index(){
//        $articleDb = M('ArticleOther');
        $where = array();
//        搜索条件
        $request = I('param.');
//        print_r($request);die;
        if ($request['title']){
            $where['title'] = array('LIKE', '%'.urldecode($request['title']).'%');
        }
        if ($request['is_show'] == 1 || $request['is_show'] == 2){
            $where['is_show'] = $request['is_show'];
        }
        if($request['type']){
            $where['type'] = $request['type'];
        }

        $page = 0;
        $field = 'id, type, title, is_show, addtime,pv';
        $count      = $this->db->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count, $this->pageSize);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $totalPages = $Page->totalPages;
        $show       = $Page->show();// 分页显示输出

        $articleList = $this->db->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->field($field)->select();
        foreach ($articleList as $key => $value){
            $articleList[$key]['type'] = self::$articleCategory[$value['type']];
        }

        $this->assign('articleList', $articleList);
        $this->assign('title', $request['title']);
        $this->assign('type', $request['type']);
        $this->assign('articleCategory', self::$articleCategory);
        $this->assign('is_show', $request['is_show']);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('totalPages',$Page->totalPages);// 赋值分页输出
        $this->display();
    }


    //添加文章
    public function addArticle () {

        if (IS_POST) {
            $title = I('post.title');
            $content = I('post.content','','htmlspecialchars');
            $type = I('post.type',1,'intval');
            if (!$title) $this->error('文章标题不能为空!');
            if (!$content) $this->error('文章内容不能为空!');
            if (!$type) $this->error('栏目分类不能为空!');

            // 封面图片
            if($_FILES['image']['size'] > 0){
                $cover_img = $this->uploadCoverImg();
            }

            $data = array(
                'sort' => I('post.sort',0,'intval'),
                'title' => $title,
                'content' => $content,
                'cover_img' => $cover_img,
                'type' => $type,
                'is_show' => I('post.is_show',0,'intval'),
                'addtime' => time(),
                'savetime' => time()
            );
            if ($this->db->add($data)) {
                $this->success('添加成功!', U(MODULE_NAME.'/Articlexue/index'));
            }else{
                $this->error('添加失败!');
            }

        }else{
            //分类
            $this->assign('category', self::$articleCategory);
            $this->display();
        }

    }

    //修改文章
    public function editArticle () {
//        $db = M('Articlexue');
        if (IS_POST) {

            $title = I('post.title');
            $content = I('post.content','','htmlspecialchars');
            $aid = I('post.aid',0,'intval');
            $type = I('post.type',1,'intval');
            if (!$title) $this->error('文章标题不能为空!');
            if (!$content) $this->error('文章内容不能为空!');
            if (!$type) $this->error('栏目分类不能为空!');

            $data = array(
                'sort' => I('post.sort',0,'intval'),
                'title' => $title,
                'content' => $content,
                'type' => $type,
                'is_show' => I('post.is_show',0,'intval'),
                'savetime' => time()
            );
            // 封面图片
            if($_FILES['image']['size'] > 0){
                $data['cover_img'] = $this->uploadCoverImg();
            }

            if ($this->db->where(array('id' => $aid))->save($data)) {
                $this->success('修改成功!', U(MODULE_NAME.'/Articlexue/index'));
            }else{
                $this->error('修改失败，没有变化!');
            }

        }else{

            $aid = I('get.aid','0','intval');
            $arr = $this->db->where(array('id' => $aid))->find();

            $this->arr = $arr;
            //分类
            $this->assign('category', self::$articleCategory);
            $this->display();
        }
    }

    //删除文章
    public function delArticle () {
        $aid = I('get.aid','0','intval');
        if ($this->db->where(array('id' => $aid))->delete()) {
            $this->success('删除成功!' ,U(MODULE_NAME.'/Articlexue/index'));
        }else{
            $this->error('删除失败!');
        }
    }

    //阅读文章内容
    public function readArticle () {
        $aid = I('get.aid','0','intval');
        $articleInfo = $this->db->where(array('id' => $aid))->find();
        $articleInfo['type'] = self::$articleCategory[$articleInfo['type']];
        $this->arr = $articleInfo;
        $this->display();
    }

    //文章编辑器上传方法
    public function uploadArticle(){

        $CONFIG =  C('UEDITOR_CONFIG'); //ueditor编辑器配置文件
        $action = I('get.action');
        $size = I('get.size');
        $start = I('get.start');
        $rootPath = '/Uploads/';  //文件上传根目录

        switch ($action) {
            case 'config':  $result = $CONFIG; break;
            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $upload = new \Think\Upload();
                $upload->maxSize = 3145728;
                $upload->rootPath = '.'.$rootPath;
                $upload->savePath = 'ueditor/';
                $upload->subName = array('date', 'Ymd');
                $upload->exts = $CONFIG['fileAllowFiles'];
                $info = $upload->upload();
                if (!$info) {
                    $result = array('state' => $upload->getError());
                }else{

                    $url = __ROOT__ . $rootPath . $info["upfile"]["savepath"] . $info["upfile"]['savename'];
                    $result = array(
                        'url' => $url,
                        'title' => htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
                        'original' => $info["upfile"]['name'],
                        'state' => 'SUCCESS'
                    );
                }
                break;
            /* 列出图片 */
            case 'listimage':
                $allowFiles = $CONFIG['imageManagerAllowFiles'];
                $listSize = $CONFIG['imageManagerListSize'];
                $path = $CONFIG['imageManagerListPath'];
                $result = getUploadfileList($allowFiles, $listSize, $path, $size, $start);
                break;
            /* 列出文件 */
            case 'listfile':
                $allowFiles = $CONFIG['fileManagerAllowFiles'];
                $listSize = $CONFIG['fileManagerListSize'];
                $path = $CONFIG['fileManagerListPath'];
                $result = getUploadfileList($allowFiles, $listSize, $path, $size, $start);
                break;
            default: $result = array('state' => '请求地址出错');   break;
        }

        if (isset($_GET["callback"])) {
            if(preg_match("/^[\w_]+$/", $_GET["callback"])) {
                $this->ajaxReturn(htmlspecialchars($_GET["callback"]) . '(' . $result . ')', 'json');
            }else{
                $this->ajaxReturn(array('state'=> 'callback参数不合法'), 'json');
            }
        }
        $this->ajaxReturn($result, 'json');

    }

//    上传文章封面
    function uploadCoverImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $rootPath = '/Uploads/';
        $upload->rootPath   =    '.' . $rootPath;
        $upload->savePath  =      'article/'; // 设置附件上传（子）目录
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $info   =   $upload->uploadOne($_FILES['image']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            return $rootPath . $info['savepath'] . $info['savename'];
        }

    }

}