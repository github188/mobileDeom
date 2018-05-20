<?php
namespace Member\Controller;
use Think\Controller;
//账号登录注册..等控制器
class LoginController extends EmptyController {

    //用户登录
    public function index(){
        if(IS_AJAX){
            $username = trim(I('post.username'));
            $password = trim(I('post.password'));
            $verify_  = trim(I('post.verify'));

            $user_db       = M('user');
            $user_log_db   = M('user_login_log');
            $user_hack_db  = M('user_hack');


            $verify = new \Think\Verify();
            if(!$verify->check($verify_)){
                $this->ajaxReturn(array('msg'=>'验证码不正确','status'=> 0));
            }

            if(isEmail($username))
                $field = 'email';
            elseif(isPhone($username))
                $field = 'mobile';
            else
                $field = 'username';

            $userinfo = $user_db->where(array($field=>$username))->find();
            if(!$userinfo)
                $this->ajaxReturn(array('msg'=>'此用户不存在','status'=> 0));
            $user_password = password_md5($password,$userinfo['encrypt']);
            if($user_password != $userinfo['password']){
                $this->ajaxReturn(array('msg'=>'账号或密码不正确','status'=> 0));

            }
            //判断该用户是否在黑名单
            if($userinfo['is_hack']==1){
                $user_hackInfo = $user_hack_db->where(array('user_id'=>$userinfo['id']))->find();
                if($user_hackInfo and ($user_hackInfo['end_time']>time() or empty($user_hackInfo['end_time']))){
                    $this->ajaxReturn(array('msg'=>'用户被锁定，如有问题可联系客服','status'=> 0));
                }
                elseif($user_hackInfo and $user_hackInfo['end_time']<time()){
                    $user_db->where(array('id'=>$userinfo['id']))->save(array('is_hack'=>2));
                }
            }

            $data = array(
                'user_id'   => $userinfo['id'],
                'username'  => $userinfo['username'],
                'ip'        => get_client_ip(),
                'logintime' => time(),
            );
            $user_log_db->data($data)->add();

            $user_group = getUserGroup($userinfo['id']);

            session(C('USER_AUTH_UID'), $userinfo['id']);
            session(C('USER_AUTH_UNAME'), $userinfo['username']);
            session(C('USER_GROUP_ID'), $user_group['group_id']);
            session(C('USER_GROUP_UNAME'), $user_group['group_name']);
            session(C('USER_FACE'), $userinfo['face']);
            $this->ajaxReturn(array('msg'=>'登录成功！','status'=> 1));

        }else{
            $config = C('WECHAT_CONFIG_1');
            $redirect_uri  = 'http://xue.hitui.com/index.php?m=front_new&c=index&a=login_weixin';//微信登陆回调地址
            //$redirect_uri  = 'http://f.51hitui.com/Login/loginWeixin.html';//微信登陆回调地址

            $this->assign('config',$config);
            $this->assign('redirect_uri',$redirect_uri);
            $this->display();
        }
    }

    //微信登陆--回调地址
    public function loginWeixin()
    {
        $weixin_code = I('get.code','','trim');

        if($weixin_code){
            //微信开放平台申请的应用appid信息
            $config = C('WECHAT_CONFIG_1');
            $weixinObj = new \Lib\Util\Wx($config);
            $Oauth = $weixinObj->getOauthAccessToken($weixin_code);
            $url = U('Login/index');
            if(!$Oauth['access_token'] or !$Oauth['openid']){
                layer_msg('登录异常，请稍后再试',$url);
                return false;
            }
            #获取用户微信信息
            $weixin_userInfo = $weixinObj->getOauthUserinfo($Oauth['access_token'],$Oauth['openid']);
            $weixin_unionid = $weixin_userInfo['unionid'];
            if(!$weixin_unionid){
                layer_msg('登录异常，请稍后再试',$url);
                return false;
            }

            $user_db       = M('user');
            $user_log_db   = M('user_login_log');
            $user_hack_db  = M('user_hack');
            $userinfo = $user_db->where(array('weixin_unionid'=>$weixin_unionid))->find();

            if($userinfo){
                //判断该用户是否在黑名单
                if($userinfo['is_hack']==1){
                    $user_hackInfo = $user_hack_db->where(array('user_id'=>$userinfo['id']))->find();
                    if($user_hackInfo and ($user_hackInfo['end_time']>time() or empty($user_hackInfo['end_time']))){
                        layer_msg('用户被锁定，如有问题可联系客服',$url);
                        return false;
                    }
                    elseif($user_hackInfo and $user_hackInfo['end_time']<time()){
                        $user_db->where(array('id'=>$userinfo['id']))->save(array('is_hack'=>2));
                    }
                }

                $data = array(
                    'user_id'   => $userinfo['id'],
                    'username'  => $userinfo['username'],
                    'ip'        => get_client_ip(),
                    'logintime' => time(),
                );
                $user_log_db->data($data)->add();

                $user_group = getUserGroup($userinfo['id']);

                session(C('USER_AUTH_UID'), $userinfo['id']);
                session(C('USER_AUTH_UNAME'), $userinfo['username']);
                session(C('USER_GROUP_ID'), $user_group['group_id']);
                session(C('USER_GROUP_UNAME'), $user_group['group_name']);
                session(C('USER_FACE'), $userinfo['face']);
                $url = U('Study/index');
                redirect($url);
            }else{
                layer_msg('登陆失败！还没有绑定微信',$url);
            }
        }else{
            $this->display('index');
        }
    }


    /* 验证码 */
    public function verify(){
        $config =    array(
            'codeSet'   =>  '0123456789',    // 设置验证码字符为纯数字
            'useImgBg'  =>  false,           // 使用背景图片 false true
            'fontSize'  =>  33,              // 验证码字体大小(px)
            'useCurve'  =>  false,           // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  70,              // 验证码图片高度
            'imageW'    =>  250,             // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        );

        $verify = new \Think\Verify($config);
        $verify->entry();
    }


    //退出登录
    public function loginOut(){

        session(C('USER_AUTH_UID'),null);
        session(C('USER_AUTH_UNAME'),null);
        session(C('USER_GROUP_ID'),null);
        session(C('USER_GROUP_UNAME'),null);
        session(C('USER_FACE'),null);
        $this->success('退出成功！',U('Index/index'));
    }

    //注册--发送手机验证码
    public function getMobileCode(){
        if(IS_AJAX){
            $mobile      = trim(I('post.mobile'));

            if(isPhone($mobile)==false)
                $this->ajaxReturn(array('msg'=>'请输入正确的手机号码','status'=>0));

            if(M('user')->where(array('mobile'=>$mobile))->find())
                $this->ajaxReturn(array('msg'=>'此手机号已被注册','status'=>0));

            $send_result = get_mobile_code($mobile);
            if($send_result['status']==1){
                $this->ajaxReturn(array('msg'=>$send_result['msg'],'status'=>1));//发送成功
            }
            else
                $this->ajaxReturn(array('msg'=>$send_result['msg'],'status'=>0));//发送失败
        }else
            _404();
    }

    //用户注册
    public function register(){
        if(IS_AJAX){
            $username    = trim(I('post.username'));
            $password    = trim(I('post.pwd'));
            $confirm_pwd = trim(I('post.confirm_pwd'));
            $mobile      = trim(I('post.mobile'));
            $mobile_code = trim(I('post.mobile_code'));
            $y_user_id   = base64_decode(cookie('y_user_id'));//邀请人ID

            $user_db     = M('user');

            if(isUsername($username)==false)
                $this->ajaxReturn(array('msg'=>'用户名不合法','status'=>0));

            if(isPassword($password)==false)
                $this->ajaxReturn(array('msg'=>'密码不合法','status'=>0));

            if($password!=$confirm_pwd)
                $this->ajaxReturn(array('msg'=>'两次输入的密码不一致','status'=>0));

            if(isPhone($mobile)==false)
                $this->ajaxReturn(array('msg'=>'请输入正确的手机号码','status'=>0));

            if($user_db->where(array('username'=>$username))->find())
                $this->ajaxReturn(array('msg'=>'此用户已被注册','status'=>0));

            if($user_db->where(array('mobile'=>$mobile))->find())
                $this->ajaxReturn(array('msg'=>'此手机号已被注册','status'=>0));

            $validator_mobileCode = validator_Code($mobile,$mobile_code);//验证手机号和验证码
            if($validator_mobileCode!=1)
                $this->ajaxReturn(array('msg'=>$validator_mobileCode,'status'=>0));
            //邀请注册
            if($y_user_id){
                $y_userInfo  = $user_db->where(array('id'=>$y_user_id))->find();//邀请人信息
                $y_userGroup = getUserGroup($y_userInfo['id']);                 //邀请人用户组
            }
            //写入会员注册信息
            $password_info = password_md5($password);
            $data = array(
                'username'      => $username,
                'password'      => $password_info['password'],
                'encrypt'       => $password_info['encrypt'],
                'y_user_id'     => isset($y_userGroup) && $y_userGroup['group_id']>1 ? $y_user_id : 0,//邀请人ID
                'reg_time'      => time(),
                'reg_ip'        => get_client_ip(),
                'mobile'        => $mobile,
                'mobile_status' => 1,
            );
            $insert_id = $user_db->data($data)->add();

            if($insert_id){
                $user_group_db      = M('user_group');
                $user_group_ext_db  = M('user_group_ext');
                $user_log_db        = M('user_login_log');

                //写入会员注册信息--用户分组
                $group = $user_group_db->where(array('id'=>1))->find();//试听会员组
                $data_ = array(
                    'user_id'     => $insert_id,
                    'group_id'    => 1,
                    'start_time'  => $data['reg_time'],
                    'end_time'    => strtotime("+{$group['gqtime']} day")+24*60*60-1,
                    'addtime'     => time(),
                );
                $user_group_ext_db->data($data_)->add();

                //写入会员登录日志
                $data = array(
                    'user_id'   => $insert_id,
                    'username'  => $username,
                    'ip'        => get_client_ip(),
                    'logintime' => time(),
                );
                $user_log_db->data($data)->add();

                session(C('USER_AUTH_UID'),$insert_id);
                session(C('USER_AUTH_UNAME'),$username);
                session(C('USER_GROUP_ID'),1);
                session(C('USER_GROUP_UNAME'),'试听会员');
                session(C('USER_FACE'),1);
                $this->ajaxReturn(array('msg'=>'注册成功','status'=>1));
            }else{
                $this->ajaxReturn(array('msg'=>'注册失败，请重新提交信息','status'=>0));
            }
        }else{
            $y_user_id = I('y_id');
            if($y_user_id)
                cookie('y_user_id',$y_user_id);
            $this->display();
        }
    }

    //找回密码--验证方式
    public function passwordWay(){
        if(IS_AJAX){
            $mobileORemail = trim(I('post.mobileORemail'));
            $code          = trim(I('post.code'));
            $user_db       = M('user');

            $verify = new \Think\Verify();
            if(!$verify->check($code)){
                $this->ajaxReturn(array('msg'=>'验证码不正确','status'=> 0));
            }

            //发送手机验证码
            if(isPhone($mobileORemail)){
                if(!$user_db->where(array('mobile'=>$mobileORemail))->find())
                    $this->ajaxReturn(array('msg'=>'此手机号不存在','status'=>0));
                $result = get_mobile_code($mobileORemail);
                if($result['status']==1){
                    if(session('getPasssword_email')) session('getPasssword_mobile',null);
                    session('getPasssword_mobile',array('mobile'=>$mobileORemail,'time'=>time()));//发送验证码成功，设置session进行下一步验证
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>1));//发送成功
                }
                else
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>0));//发送失败
            }
            //发送手邮箱证码
            elseif(isEmail($mobileORemail)){
                if(!$user_db->where(array('email'=>$mobileORemail))->find())
                    $this->ajaxReturn(array('msg'=>'此邮箱不存在','status'=>0));
                $result = get_email_code($mobileORemail);
                if($result['status']==1){
                    if(session('getPasssword_mobile')) session('getPasssword_mobile',null);
                    session('getPasssword_email',array('email'=>$mobileORemail,'time'=>time()));
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>1));//发送成功
                }
                else
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>0));//发送失败
            }
            else{
                $this->ajaxReturn(array('msg'=>'请输入正确的手机或邮箱','status'=>0));
            }

        }else{
            $this->display();
        }
    }

    //找回密码--重新设置密码
    public function password(){
        $mobile = session('getPasssword_mobile');
        $email  = session('getPasssword_email');

        if(IS_AJAX){
            $code        = trim(I('post.code'));
            $password    = trim(I('post.pwd'));
            $user_db       = M('user');

            if(($mobile and $mobile['time']+5*60<time()) or ($email and $email['time']+15*60<time())){
                $this->ajaxReturn(array('msg'=>'验证码已过期，请返回上一步重新获取！','status'=>0));
            }

            if($mobile){
                $result = validator_Code($mobile['mobile'],$code);//验证手机号和验证码
                if($result!=1)
                    $this->ajaxReturn(array('msg'=>$result,'status'=>0));
                if(isPassword($password)==false)
                    $this->ajaxReturn(array('msg'=>'密码不合法','status'=>0));
                $new_password = password_md5($password);
                $user_db->where(array('mobile'=>$mobile['mobile']))->data(array('password'=>$new_password['password'],'encrypt'=>$new_password['encrypt']))->save();
            }
            elseif($email){
                $result = validator_Code($email['email'],$code,2);//验证手机号和验证码
                if($result!=1)
                    $this->ajaxReturn(array('msg'=>$result,'status'=>0));
                $new_password = password_md5($password);
                $user_db->where(array('email'=>$email['email']))->data(array('password'=>$new_password['password'],'encrypt'=>$new_password['encrypt']))->save();
            }
            session('getPasssword_mobile',null);
            session('getPasssword_email',null);
            $this->ajaxReturn(array('msg'=>'密码修改成功','status'=>1));
        }else{
            $url = U('Login/passwordWay');
            if(!$mobile && !$email)
            {
                redirect($url);
            }
            if(($mobile and $mobile['time']+5*60<time()) or ($email and $email['time']+15*60<time())){
                $msg =<<<AAA
                <script>
                    window.onload = function(){
                        layer.msg('验证超时！请重新发送验证码');
                        setTimeout(function(){
                            window.location.href = "{$url}";
                        },1500);
                    }
                </script>
AAA;
                echo $msg;
            }
            $this->display();
        }
    }


    //找回密码--重新设置密码--成功提示页面
    public function passwordSuccess(){
        $this->display();
    }

}