<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

//文章管理控制器
class ArticleController extends CommonController {
    //文章列表
    public function index(){

        $db = M('Article');
        $category = M('Category');

        $cache = cookie('ArticleIndex') ? cookie('ArticleIndex') : array('status' => 0);
        $aid = I('aid',0,'intval');
        $cid = I('cid',intval($cache['cid']),'intval');
        $status = I('status',intval($cache['status']),'intval'); 
        $title = filtrationSrt(strip_tags(I('title',$cache['title'])));
        $getArr = array(
            'status' => $status,
            'title' => $title,
            'cid' => $cid
            );
        if (array_diff_assoc($getArr, $cache)) {
            cookie('ArticleIndex', $getArr);
        }

        $where = array();
        if ($status <2) {
            $where['status'] = $status;
        }
        if ($title) {
            $where['title'] = array('like','%'.$title.'%');
        }
        $this->title = $title;
        $this->status = $status;

        if ($aid) {
            $where['id'] = $aid;
            $this->aid = $aid;
        }

        //分类条件组合
        if ($cid) {
            $this->cid = $cid;
            $cate_pid = $category->where(array('id' => $cid))->getField('pid');
            if ($cate_pid) {
                $where['category_id'] = $cid;
            }else{
                $cateId_arr = $category->where(array('pid' => $cid))->field('id')->select();
                $in_str = '';
                if ($cateId_arr) {
                    $in_str .= $cid;
                    foreach ($cateId_arr as $k => $v) {
                        $in_str .= ','.$v['id'];
                    }
                }
                $where['category_id'] = $in_str != '' ? array('IN',$in_str) : $cid;
            }
        }


        $count = $db->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 15); //分页类
        $limit = $page->firstRow .','. $page->listRows;

        $this->arr = $db->where($where)->limit($limit)->order('sort desc,id desc')->select();
        $this->page = $page->show();
        $this->totalPages = $page->totalPages;
        //分类
        $cate = $category->where(array('group' => 0))->order('sort ASC')->select();
        $this->cate = Category::unlimitedForLevel($cate);
        
        $this -> display();

	}

    //添加文章
    public function addArticle () {
        $db = M('Article');
        if (IS_POST) {

            $title = I('post.title');
            $content = I('post.content','','htmlspecialchars');
            $category_id = I('post.category_id',0,'intval');

            if (!$title) $this->error('文章标题不能为空!');
            if (!$content) $this->error('文章内容不能为空!');
            if (!$category_id) $this->error('栏目分类不能为空!');

            $data = array(
                'sort' => I('post.sort',0,'intval'),
                'title' => $title,
                'content' => $content,
                'category_id' => $category_id,
                'status' => I('post.status',0,'intval'), 
                'seo_keyword' => I('post.seo_keyword'),
                'seo_description' => I('post.seo_description'),
                'addtime' => time(),
                'savetime' => time()
                );
            if ($db->add($data)) {
                $this->success('添加成功!', U(MODULE_NAME.'/Article/index'));
            }else{
                $this->error('添加失败!');
            }
            
        }else{
            //分类
            $cate = M('Category')->where(array('group' => 0))->order('sort ASC')->select();
            $this->cate = Category::unlimitedForLevel($cate);
            $this->display();
        }

    }

    //修改文章
    public function editArticle () {
        $db = M('Article');
        if (IS_POST) {

            $title = I('post.title');
            $content = I('post.content','','htmlspecialchars');
            $category_id = I('post.category_id',0,'intval');
            $aid = I('post.aid',0,'intval');

            if (!$title) $this->error('文章标题不能为空!');
            if (!$content) $this->error('文章内容不能为空!');
            if (!$category_id) $this->error('栏目分类不能为空!');

            $data = array(
                'sort' => I('post.sort',0,'intval'),
                'title' => $title,
                'content' => $content,
                'category_id' => $category_id,
                'status' => I('post.status',0,'intval'), 
                'seo_keyword' => I('post.seo_keyword'),
                'seo_description' => I('post.seo_description'),
                'savetime' => time()
                );

            if ($db->where(array('id' => $aid))->save($data)) {
                $this->success('修改成功!', U(MODULE_NAME.'/Article/index'));
            }else{
                $this->error('修改失败，没有变化!');
            }
            

        }else{
            //分类
            $cate = M('Category')->where(array('group' => 0))->order('sort ASC')->select();
            $this->cate = Category::unlimitedForLevel($cate);
            $aid = I('get.aid','0','intval');
            $arr = $db->where(array('id' => $aid))->find();
            
            $this->arr = $arr;
            $this->display();
        }
    }

    //删除文章
    public function delArticle () {
        $db = M('Article');
        $aid = I('get.aid','0','intval');
        if ($db->where(array('id' => $aid))->delete()) {
            $this->success('删除成功!' ,U(MODULE_NAME.'/Article/index'));
        }else{
            $this->error('删除失败!');
        }     
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

    //阅读文章内容
    public function readArticle () {
        $db = M('Article');
        $aid = I('get.aid','0','intval');
        $this->arr = $db->where(array('id' => $aid))->find();
        $this->display();

    }




}