<?php
namespace Mobile\Controller;
use Think\Controller;
/*
 * 账号安全中心控制器
 * ouHai 2017-06-21
 *
 */

class SafeController extends CommonController {

    //安全设置--列表页面
    public function securityList(){
        $user_id = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        $this->bankCard  = M('user_bank')->where(array('user_id'=>$user_id))->cache(1)->find();
        $this->user_info = $user_db->where(array('id'=>$user_id))->cache(1)->find();
        $this->display();
    }

    //发送验证码
    public function sendCode(){
        if(IS_AJAX){
            $mobileORemail = I('post.mobileORemail','');
            $user_db = M('user');
            $user_id = session(C('USER_AUTH_UID'));
            $user_info = $user_db->where(array('id'=>$user_id))->cache(1)->find();
            //发送手机验证码
            if(isPhone($mobileORemail)){
                if($user_info['mobile'] != $mobileORemail)
                    $this->ajaxReturn(array('msg'=>'此手机号与当前账号绑定的手机号不一致','status'=>0));
                $result = get_mobile_code($mobileORemail);
                if($result['status']==1){
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>1));//发送成功
                }
                else
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>0));//发送失败
            }
            //发送手邮箱证码
            elseif(isEmail($mobileORemail)){
                if(!$user_info['email'])
                    $this->ajaxReturn(array('msg'=>'当前账号还没有绑定邮箱','status'=>0));
                if($user_info['email'] != $mobileORemail)
                    $this->ajaxReturn(array('msg'=>'此邮箱与当前账号绑定的邮箱不一致','status'=>0));
                $result = get_email_code($mobileORemail);
                if($result['status']==1){
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>1));//发送成功
                }
                else
                    $this->ajaxReturn(array('msg'=>$result['msg'],'status'=>0));//发送失败
            }
            else{
                $this->ajaxReturn(array('msg'=>'请输入正确的手机或邮箱','status'=>0));
            }
        }else{
            _404();
        }
    }

    //安全设置--修改手机或邮箱先进行验证
    public function verify()
    {
        $type = I('type','');
        if(IS_AJAX){
            $mobileORemail = I('post.mobileORemail','');
            $code   = I('post.code','');

            $nextUrl = '';
            $action  = '';

            $doingAction = cookie('doingAction');
            if($doingAction=='phone')
            {
                $action  = 'phone';
                $nextUrl = U('Safe/phone');
            }
            elseif($doingAction=='email')
            {
                $action  = 'email';
                $nextUrl = U('Safe/email');
            }


            if(!isPhone($mobileORemail) and !isEmail($mobileORemail))
                $this->ajaxReturn(array('msg'=>'请输入正确的手机或邮箱','status'=>0));

            if(isPhone($mobileORemail)){
                $result = validator_Code($mobileORemail,$code);//验证手机号和验证码
                if($result!=1)
                    $this->ajaxReturn(array('msg'=>$result,'status'=>0));
            }
            elseif(isEmail($mobileORemail)){
                $result = validator_Code($mobileORemail,$code,2);//验证邮箱号和验证码
                if($result!=1)
                    $this->ajaxReturn(array('msg'=>$result,'status'=>0));
            }

            session('resetMobileORemail',array('action'=>$action,'time'=>time()));//写入session 作为进行下一步的前提
            $this->ajaxReturn(array('msg'=>'验证成功！','status'=>1,'nextUrl'=>$nextUrl));

        }else{
            if($type=='phone'){
                cookie('doingAction','phone');
            }
            elseif($type=='email'){
                cookie('doingAction','email');
            }
            else
                _404();

            $this->display();
        }
    }
    //安全设置--手机绑定状态
    public function phoneStaus(){
        $user_id = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        $this->user_mobile = $user_db->where(array('id'=>$user_id))->getField('mobile');
        $this->display();
    }

    //安全设置--修改手机绑定
    public function phone()
    {
        $action_info = session('resetMobileORemail');
        if(IS_AJAX){
            $mobile  = I('post.mobile','');
            $code    = I('post.code','');
            $user_db = M('user');
            $user_id = session(C('USER_AUTH_UID'));
            if($action_info and $action_info['time']+15*60<time())
                $this->ajaxReturn(array('msg'=>'长时间没有操作，请重新验证身份','status'=>0,'url'=>U('Safe/securityList')));
            if(!isPhone($mobile))
                $this->ajaxReturn(array('msg'=>'请输入正确手机号','status'=>0));
            if($user_db->where(array('mobile'=>$mobile,'id'=>array('NEQ',$user_id)))->find())
                $this->ajaxReturn(array('msg'=>'此手机号已被绑定','status'=>0));
            $result = validator_Code($mobile,$code);//验证手机号和验证码
            if($result!=1)
                $this->ajaxReturn(array('msg'=>$result,'status'=>0));
            $user_db->where(array('id'=>$user_id))->data(array('mobile'=>$mobile,'mobile_status'=>1))->save();
            session('resetMobileORemail',null);
            $this->ajaxReturn(array('msg'=>'手机号更换成功','status'=>1,'url'=>U('User/my')));

        }else{
            if(empty($action_info) or $action_info['action']!='phone') _404();
            if($action_info and $action_info['time']+15*60<time()) $this->error('长时间没有操作，请重新验证身份',U('Safe/securityList'));

            $this->display();
        }
    }

    //安全设置--邮箱绑定状态
    public function emailStaus(){
        $user_id = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        $this->user_email = $user_db->where(array('id'=>$user_id))->getField('email');
        $this->display();
    }

    //安全设置--修改邮箱绑定
    public function email()
    {
        $action_info = session('resetMobileORemail');
        $user_id = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        if(IS_AJAX){
            $email  = I('post.email','');
            $code    = I('post.code','');
            if($action_info and $action_info['time']+15*60<time())
                $this->ajaxReturn(array('msg'=>'长时间没有操作，请重新验证身份','status'=>0,'url'=>U('Safe/securityList')));
            if(!isEmail($email))
                $this->ajaxReturn(array('msg'=>'请输入正确邮箱','status'=>0));
            if($user_db->where(array('email'=>$email,'id'=>array('NEQ',$user_id)))->find())
                $this->ajaxReturn(array('msg'=>'此邮箱已被绑定','status'=>0));
            $result = validator_Code($email,$code,2);//验证邮箱号和验证码
            if($result!=1)
                $this->ajaxReturn(array('msg'=>$result,'status'=>0));
            $user_db->where(array('id'=>$user_id))->data(array('email'=>$email,'email_status'=>1))->save();
            session('resetMobileORemail',null);
            $this->ajaxReturn(array('msg'=>'邮箱更换成功','status'=>1,'url'=>U('User/my')));

        }else{
            $user_info = $user_db->where(array('id'=>$user_id))->cache(1)->find();
            if($user_info['email'] and (empty($action_info) or $action_info['action']!='email')) _404();
            if($user_info['email'] and (empty($action_info) or $action_info['time']+15*60<time())) $this->error('长时间没有操作，请重新验证身份',U('Safe/securityList'));
            $this->display();
        }
    }

    //安全设置--微信绑定
    public function weixin()
    {
        $user_id = session(C('USER_AUTH_UID'));
        $userinfo = M('user')->where(array('id'=>$user_id))->cache(1)->find();
        if(IS_AJAX){
            $bind = I('post.bind',0,'intval');
            if($bind==1){//检查微信绑定
                $userinfo['weixin_openid'] || $userinfo['weixin_unionid']?$this->success('微信绑定成功'):$this->error();
            }
            elseif($bind==2){//解除微信绑定
                M('user')->where(array('id'=>$user_id))->save(array('weixin_openid'=>'','weixin_unionid'=>''));
                $this->success('解除绑定成功');
            }
        }else{
            $this->assign('userinfo',$userinfo);
            $this->display();
        }
    }

    //生成微信带参数的二维码
    public function weixinErweima()
    {
        header("Content-type: text/html; charset=utf-8");
        $user_id  = session(C('USER_AUTH_UID'));
        if(!$user_id) exit('user_id缺失');
        $weixinObj = new \Lib\Util\Wx(C('WECHAT_CONFIG'));

        $getQRCode = $weixinObj->getQRCode($user_id);//参数1：二维码携带参数=====参数2：临时或者永久二维码

        $ticket = $getQRCode['ticket'];
        $code_url = $weixinObj->getQRUrl($ticket);
        echo @file_get_contents($code_url);
    }

    //安全设置--修改密码
    public function password()
    {
        if(IS_AJAX){
            $old_pwd = I('post.old_pwd','');
            $pwd     = I('post.pwd','');
            $c_pwd   = I('post.confirm_pwd','');

            $user_id = session(C('USER_AUTH_UID'));
            $user_db = M('user');

            $user_info = $user_db->where(array('id'=>$user_id))->find();
            $old_pwd = password_md5($old_pwd,$user_info['encrypt']);
            if($old_pwd != $user_info['password'])
                $this->ajaxReturn(array('msg'=>'原密码不正确，请重新输入','status'=>0));
            if(!isPassword($pwd))
                $this->ajaxReturn(array('msg'=>'新密码不合法，长度应为6~16个字符，并且不包含特殊字符。','status'=>0));
            if($pwd != $c_pwd)
                $this->ajaxReturn(array('msg'=>'两次输入的密码不一致','status'=>0));

            $new_pwd = password_md5($pwd);
            $data    = array(
                'password' => $new_pwd['password'],
                'encrypt'  => $new_pwd['encrypt'],
            );
            $user_db->where(array('id'=>$user_id))->data($data)->save();
            $this->ajaxReturn(array('msg'=>'密码修改成功','status'=>1,'url'=>U('User/my')));
        }else{
            $this->display();
        }
    }



    //用户银行卡--列表展示--和--删除功能
    public function myBankList(){
        $user_id    = session(C('USER_AUTH_UID'));
        $bank_db    = M('user_bank');
        if(IS_AJAX){
            $id = I('post.delID',0,'intval');
            $bank_db->where(array('id'=>$id,'user_id'=>$user_id))->delete();
            $this->ajaxReturn(array('msg'=>'删除成功！','status'=>1));
        }else{
            $where = array('user_id'=>$user_id);
            $count = $bank_db->where($where)->count();
            $page  = new \Think\Page($count,2);
            $page->setConfig('theme','%UP_PAGE% %DOWN_PAGE%');
            $limit = $page->firstRow .','. $page->listRows;
            $data  = $bank_db->where($where)->limit($limit)->order('addtime DESC')->select();
            foreach($data as $k=>$v){
                $data[$k]['bank_type'] = getBankType($v['type']);
            }
            $pages = $page->show();

            $this->assign('data',$data);
            $this->assign('countPage',$page->totalPages);
            $this->assign('pages',$pages);
            $this->display();
        }
    }

    //用户银行卡--添加和编辑功能
    public function myBank(){
        $user_id = session(C('USER_AUTH_UID'));
        $area_db = M('area');
        $bank_db = M('user_bank');
        if(IS_AJAX){
            $count = $bank_db->where(array('user_id'=>$user_id))->count();
            if($count > 10) $this->ajaxReturn(array('msg'=>'账户绑定数量达到上限','status'=>0));

            $name            =  I('post.name','');
            $number          =  I('post.number','');
            $bankType        =  I('post.bankType',0,'intval');
            $province        =  I('post.province',0,'intval');
            $city            =  I('post.city',0,'intval');
            $county          =  I('post.county',0,'intval');
            $address         =  I('post.address','');
            $mobile          =  getUserInfo($user_id,'mobile');
            $code            =  I('post.code','');
            if(!$bankType) $this->ajaxReturn(array('msg'=>'请选择账户类型','status'=>0));
            if(!$name)    $this->ajaxReturn(array('msg'=>'请填写账户本人姓名','status'=>0));
            if(!$number)  $this->ajaxReturn(array('msg'=>'请填写账户号码','status'=>0));

            $verify_res = validator_Code($mobile,$code);
            if($verify_res!=1)  $this->ajaxReturn(array('msg'=>$verify_res,'status'=>0));

            $data = array();
            $data['user_id']    = $user_id;
            $data['name']       = $name;
            $data['number']     = $number;
            $data['type']       = $bankType;
            $data['province']   = $province;
            $data['city']       = $city;
            $data['county']     = $county;
            $data['address']    = htmlspecialchars($address);
            $data['mobile']     = $mobile;
            $data['addtime']    = time();

            $bank_db->data($data)->add();

            $this->ajaxReturn(array('msg'=>'账户绑定成功！','status'=>1,'url'=>U('User/my')));
        }else{
            $this->province = $area_db->where(array('pid'=>1))->order('id ASC')->select();
            $this->display();
        }
    }

}