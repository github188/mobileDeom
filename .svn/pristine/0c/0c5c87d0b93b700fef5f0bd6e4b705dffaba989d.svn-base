<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台登陆控制器
 */
class LoginController extends EmptyController {

    public function index(){
        $this->display('login');
    }

      //后台登录处理
    public function login(){
        if(IS_AJAX){
            $db = M('Manage');
            $user = $db->where(array('username' => I('post.name')))->find();
            if (!$user || $user['password'] != I('post.pass','','md5')){
                $this->error('账号或密码错误！');
            }

            $verify = new \Think\Verify();
            if(!$verify->check(I('post.verify'))){
                $this->error('验证码输入错误！');
            }

            if ($user['lock']) $this->error('用户被锁定！');

            $data = array(
                'id' => $user['id'],
                'login_time' => time(),
                'login_ip' => get_client_ip(),
                'login_count' => $user['login_count']+1
                );
            $db->save($data);

            session(C('USER_AUTH_KEY'),$user['id']);
            session('ht_type',$user['type']);
            session('ht_uname',$user['username']);
            session('ht_logintime',date('Y-m-d H:i:s',$user['login_time']));
            session('ht_loginip',$user['login_ip']);

            if ($user['username'] == C('RBAC_SUPERADMIN')) {
                session(C('ADMIN_AUTH_KEY'), true);
            }

            $Rbac = new \Org\Util\Rbac();
            $Rbac::saveAccessList(); 

            $this->success('登录成功！', U(MODULE_NAME .'/Index/index'));
            

        }else{
            _404();
        }
    }

    /* 退出后台登录 */
    public function logout(){

        session(C('USER_AUTH_KEY'),null);
        session('ht_uname',null);
        session('ht_logintime',null);
        session('ht_loginip',null);
        session('_ACCESS_LIST',null);
        session(C('ADMIN_AUTH_KEY'),null);
        // session('[destroy]');
        $this->success('退出成功！', U(MODULE_NAME .'/Login/index'));
    }

    /* 验证码 */    
    public function verify(){
        $config =    array(
            'codeSet'   =>  '0123456789',    // 设置验证码字符为纯数字
            'useImgBg'  =>  false,           // 使用背景图片 false true
            'fontSize'  =>  25,              // 验证码字体大小(px)
            'useCurve'  =>  false,           // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点  
            'imageH'    =>  50,              // 验证码图片高度
            'imageW'    =>  230,             // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        );

        $verify = new \Think\Verify($config);
        $verify->entry();
    }
}