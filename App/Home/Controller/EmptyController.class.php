<?php
namespace Home\Controller;
use Think\Controller;

//空控制器处理
class EmptyController extends Controller {
    //空操作
    public function  _empty(){
        $this->display('Member@Public:404');
    }

}