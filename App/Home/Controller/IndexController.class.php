<?php
namespace Home\Controller;
use Think\Controller;
use Lib\Util\Category;

//前端默认控制器
class IndexController extends EmptyController {

    public function _initialize () {
        //判断是否关闭网站
        if (getConfig('web')) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<p style="font-size: 18px; text-align: center;margin: 50px;">网站临时关闭维护中，请稍后再试！</p>';
            die;
        }
    }

    //首页方法
    public function index() {

        if(is_mobile()){
            $this->display('Mobile/index');
        }else{
           $this->display(); 
        }

    }

    //搜索列表
    public function searchList(){

        $db = M('Article');
        $cache = cookie('IndexSearchList') ? cookie('IndexSearchList') : array();
        $name = strip_tags(I('name',$cache['name']));
        $getArr = array('name' => $name);
        if (array_diff_assoc($getArr, $cache)) {
            cookie('IndexSearchList', $getArr);
        }

        $where = array('status' => 0);
        $arr_name = array_filter(preg_split("/[ ，。？、！,.;|!\\\]+/u", $name));  //拆分
        if ($name && $arr_name) {
            
            $arr_like = array();
            foreach ($arr_name as $k => $v) {
                if ($v) {
                    $arr_like[] = '%'.trim($v).'%';
                }
            }

            $where['title'] = array('like', $arr_like, 'OR');
        }
        $this->name = $name;

        $count = $db->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 15); //分页类
        $limit = $page->firstRow .','. $page->listRows;

        $this->arr  = $db->where($where)->limit($limit)->order('sort asc')->select();

        $this->page = $page->show();
        $this->totalPages = $page->totalPages;

        if(is_mobile()){
            $this->display('Mobile/searchList');
        }else{
           $this->display(); 
        }
        
    }


    //文章列表
    public function articleList(){

        $db = M('Article');
        $category = M('Category');
        

        $cache = cookie('IndexArticleList') ? cookie('IndexArticleList') : array();
        $cid = I('cid',intval($cache['cid']),'intval');
        $getArr = array('cid' => $cid);
        if (array_diff_assoc($getArr, $cache)) {
            cookie('IndexArticleList', $getArr);
        }

        $where = array('status' => 0);

        if($cid){
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

        $this->article  = $db->where($where)->limit($limit)->order('sort desc,id desc')->select();
        $this->page = $page->show();
        $this->totalPages = $page->totalPages;

        //最新10条文章
        $this->new_article  = $db->limit(10)->order('addtime desc')->select();
        
        //分类
        $cate = $category->where(array('status' => 0))->order('sort asc,id desc')->select();
        $this->cate = Category::unlimitedForLayer($cate);
        $this->pid = $category->where(array('id' =>intval($cid)))->getField('pid');

        if(is_mobile()){
            $this->display('Mobile/articleList');
        }else{
           $this->display(); 
        }

    }



    //文章内容
    public function articleContent(){
        header("Content-Type: text/html;charset=gb2312"); 

        $db = M('Article');
        $category = M('Category');
        // $cid = I('cid',0,'intval');
        $aid = I('aid',0,'intval');
        $where = array('id' =>$aid, 'status' => 0);

        $arr  = $db->where($where)->find();
        $this->cid = $arr['category_id'];
        $this->arr = $arr;  

        //最新10条文章
        $this->new_article  = $db->limit(10)->order('addtime desc')->select();
        //相关分类的文章
        $count = $db->where(array('category_id' => $arr['category_id'], 'status' => 0))->count();
        $limit = mt_rand(0,$count-1).','.'10'; //产生随机数
        $this->correlation_article  = $db->where(array('category_id' => $arr['category_id'], 'status' => 0))->limit($limit)->select();
        $db->where($where)->setInc('pv'); //访问量加1

        //分类
        $cate = $category->where(array('status' => 0))->order('sort asc,id desc')->select();
        $this->cate = Category::unlimitedForLayer($cate);
        $this->pid = $category->where(array('id' =>intval($arr['category_id'])))->getField('pid');

        if(is_mobile()){
            $this->display('Mobile/articleContent');
        }else{
           $this->display(); 
        }

    }

}
