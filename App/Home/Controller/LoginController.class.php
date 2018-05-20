<?php
namespace Home\Controller;
use Think\Controller;

//前台登录控制器
class LoginController extends EmptyController {
    
    public function _initialize () {
        //判断是否关闭网站
        if (getConfig('web')) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<p style="font-size: 18px; text-align: center;margin: 50px;">网站临时关闭维护中，请稍后再试！</p>';
            die;
        }
    }


	//登录方法
    public function index() {

        if(IS_POST){

            $db = M('user', C('OTHER_DB_PREFIX'));
            $user = $db->where(array('username' => I('post.name')))->find();
            $pass = password_md5(I('post.pass','') , $user['encrypt']);

            if (!$user || $user['password'] != $pass){
                $this->error('账号或密码错误！');
            }

            $verify = new \Think\Verify();
            if(!$verify->check(I('post.verify'))){
                $this->error('验证码输入错误！');
            }

            $data = array(
                'uid' => $user['uid'],
                'logintime' => time(),
                'ip' => get_client_ip()
                );
            M('user_login_log', C('OTHER_DB_PREFIX'))->add($data);
            $groupname = M('user_group', C('OTHER_DB_PREFIX'))->where(array('ugid' => $user['ugid']))->getField('name');
            session('ht_kf_uid',$user['uid']);
            session('ht_kf_uname',$user['username']);
            session('ht_kf_face',$user['face']);
            session('ht_kf_groupname',$groupname);

            $this->success('登录成功！', U('Index/index'));
            
        }else{

            if(is_mobile()){
                $this->display('Mobile/login');
            }else{
               $this->display(); 
            }

        }

    }


    //注册方法
    public function register(){
        
        if (getConfig('register')) {
            $this->success('临时关闭 注册新用户，请稍后再试！', U('Index/index'), 4); die;
        }

        if(IS_POST){


            $mobile = I('post.mobile','');
            $mobile_code = I('post.code','');
            
            $db = M('user', C('OTHER_DB_PREFIX'));
            $user = $db->where(array('mobile' => $mobile))->getField('mobile');
            if ($user) {
                $this->error('此手机号已注册过了，无须注册！');
            }

            $get_arr = send_code_info('mobile_'.$mobile);
            if (!$mobile_code || !$get_arr) $this->error('验证码输入错误！');
            $send_time = $get_arr['send_time'] + 300; //设置5分钟失效
            if ($send_time < time()) {
                $this->error('验证码已过期，请重新获取！');
            }

            $today_time = strtotime(date('Y-m-d'));
            if ($get_arr['today_time'] == $today_time  && $get_arr['error_number'] >3) {
                $this->error('验证码输入错误次数已超出限制，请重新获取验证码！');
            }
            if ($get_arr['code'] != $mobile_code) {

                $get_arr['error_number'] = intval($get_arr['error_number']) ? intval($get_arr['error_number']) +1 : 1; //验证码输入错误次数
                $get_arr['error_time'] = time(); //验证码输入错误时间
                send_code_info('mobile_'.$mobile, 2, $get_arr);
                $this->error('验证码输入错误！');
            }

            unset($get_arr['code']);//验证成功清除
            send_code_info('mobile_'.$mobile, 2, $get_arr);

            $tguid = intval(base64_decode(I('post.tguid',cookie('tguid'))));
            $tmpuser = $db->where(array('uid'=>$tguid))->find();
            $name = I('post.name','');
            $pass = I('post.pass','');

            $passwordinfo = password_md5($pass);
            $info['password'] = $passwordinfo['password'];
            $info['encrypt'] = $passwordinfo['encrypt'];
            $info['username'] = $name;
            $info['face'] = 1;
            $info['mobile'] = $mobile;
            $info['regtime'] = time();
            $info['ugid'] = 1;
            $info['tguid'] = $tmpuser ? $tguid : 0;
            $info['mobilestatus'] = 1;

            $tmp = M('user_group', C('OTHER_DB_PREFIX'))->where(array('ugid'=>$info['ugid']))->find();
            $info['gqtime'] = strtotime("+" . $tmp['gqtime'] . " day", $info['regtime']);

            if ($uid = $db->add($info)) {
                if (isset($tguid)) {
                    if ($tmpuser && $tmpuser['ugid'] > 1) {
                        //一级
                        M('user_tg', C('OTHER_DB_PREFIX'))->add(array('main_uid' => $tguid, 'tg_uid' => $uid, 'level' => 1));

                        //二级
                        if ($tmpuser['tguid']) {
                            M('user_tg', C('OTHER_DB_PREFIX'))->add(array('main_uid' => $tmpuser['tguid'], 'tg_uid' => $uid, 'level' => 2));
                        }
                    }
                }

                M('user_login_log', C('OTHER_DB_PREFIX'))->add(array('uid' => $uid, 'ip' => get_client_ip(), 'logintime' => time()));

                cookie('tguid',null);

                $this->success('注册新用户成功！请返回登录！', U(MODULE_NAME .'/Login/index'));
            }else{
                $this->error('注册新用户失败！请稍后再试！');
            }


        }else{
            $tguid = I('get.tguid','','base64_encode'); 
            if($tguid){
                cookie('tguid',$tguid);
            }

            if(is_mobile()){
                $this->display('Mobile/register');
            }else{
               $this->display(); 
            }

        }

    }

    //获取验证码
    public function getMobileCode(){

        if(IS_POST){
            $mobile = I('post.mobile','');

            $db = M('user', C('OTHER_DB_PREFIX'));
            $user = $db->where(array('mobile' => $mobile))->getField('mobile');
            if ($user) {
                $this->error('此手机号已注册过了，无须注册！');
            }

            if (get_mobile_code($mobile)) {
                $this->success('验证码发送成功！请留意手机短信！', U('Index/index'));
            }else{
                $this->error('验证码发送失败！有可能是发送频繁所致，请稍后再试！');
            }

        }else{
            $this->error(0,'非法操作！', U('Index/index'));
        }

    }



    /* 退出登录 */
    public function logout(){

        session('ht_kf_uid',null);
        session('ht_kf_uname',null);
        session('ht_kf_face',null);
        session('ht_kf_groupname',null);
        // session('[destroy]');
        $this->success('退出成功！', U('Login/index'));
    }

    /* 验证码 */    
    public function verify(){
        $config =    array(
            'codeSet'   =>  '0123456789',    // 设置验证码字符为纯数字
            'useImgBg'  =>  false,           // 使用背景图片 false true
            'fontSize'  =>  36,              // 验证码字体大小(px)
            'useCurve'  =>  false,           // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点  
            'imageH'    =>  70,              // 验证码图片高度
            'imageW'    =>  250,             // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        );

        $verify = new \Think\Verify($config);
        $verify->entry();
    }


}
