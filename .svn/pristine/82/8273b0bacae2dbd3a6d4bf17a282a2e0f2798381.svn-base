<?php
namespace Mobile\Controller;
use Think\Controller;

//空控制器处理
class EmptyController extends Controller {

    public function _initialize () {
        // 友情链接
        $friends = M('link')->where(array('is_show' => 1))->order('sort desc')->select();
        $this->assign('friends', $friends);
        //判断是否为手机访问
        // if(!is_mobile()){
        //     $this->redirect('Member/Index/index');
        // }
    }
    //空操作
    public function  _empty(){

        $this->display('Public:404');
    }

}
