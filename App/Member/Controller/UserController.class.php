<?php
namespace Member\Controller;
use Think\Controller;

//会员资料管理..等控制器
class UserController extends CommonController {

    //用户余额--充值记录
    public function myAccount(){
        $user_id  = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        $user_account  = $user_db->where(array('id'=>$user_id))->field('currency,brokerage')->find();
        $this->assign('user_account',$user_account);

        $count = M('order_pay')->where(array('user_id'=>$user_id))->count();
        $page  = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $this->order_pay  = M('order_pay')->where(array('user_id'=>$user_id))->limit($limit)->order('pay_time DESC')->select();
        $this->pages = $page->show();
        $this->assign('totalPages',$page->totalPages);
        $this->display();
    }

    //用户余额--订单消费记录
    public function myAccountPurchase(){
        $user_id  = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        $order_goods_db = M('order_goods');
        $user_g_db = M('user_group');
        $video_db  = M('video');


        #账户余额
        $user_account  = $user_db->where(array('id'=>$user_id))->field('currency,brokerage')->find();
        #消费记录
            $where = array();
            $where['user_id'] = $user_id;
            //$where['status'] = 1;

        $count = $order_goods_db->where($where)->count();
        $page  = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $data  = $order_goods_db->where($where)->limit($limit)->order('addtime DESC')->select();
        foreach($data as $k=>$v){
            if($v['goods_type']==0){
                $data[$k]['goods_name'] = $user_g_db->where(array('id'=>$v['goods_id']))->getField('name');
            }
            elseif($v['goods_type']==1){
                $data[$k]['goods_name'] = $video_db->where(array('id'=>$v['goods_id']))->getField('title');
            }
        }
        $pages = $page->show();

        $this->assign('user_account',$user_account);
        $this->assign('data',$data);
        $this->assign('pages',$pages);
        $this->assign('totalPages',$page->totalPages);
        $this->display();
    }
    //删除订单
    public function deleteGoodsOrder()
    {
        if(IS_AJAX){
            $order_ids      = I('order_id/a');
            $order_goods_db = M('order_goods');
            $user_id  = session(C('USER_AUTH_UID'));
            foreach($order_ids as $id){
                $order_goods_db->where(array('id'=>intval($id),'user_id'=>$user_id,'status'=>0))->delete();
            }
            $this->success('订单删除成功！');
        }else{
            _404();
        }
    }

    //用户佣金--提现记录
    public function myBrokerage(){
        $user_id  = session(C('USER_AUTH_UID'));
        $user_db  = M('user');
        $user_tixian_db = M('user_brokerage_tixian');

        #用户佣金
        $user_account  = $user_db->where(array('id'=>$user_id))->field('currency,brokerage')->find();
        #提现记录
        $where = array();
        $where['user_id'] = $user_id;


        $count = $user_tixian_db->where($where)->count(); //统计总条数
        $page  = new \Think\Page($count,10); //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data  = $user_tixian_db->where($where)->limit($limit)->order('addtime DESC')->select();

        $pages = $page->show();

        $this->assign('user_account',$user_account);
        $this->assign('data',$data);
        $this->assign('pages',$pages);
        $this->assign('totalPages',$page->totalPages);
        $this->display();
    }

    //用户佣金--佣金记录
    public function myInvite(){
        $user_id  = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        $user_brokerage_db = M('user_brokerage');
        $user_g_db = M('user_group');

        $status = I('get.status',0,'intval');

        #用户佣金
        $user_account  = $user_db->where(array('id'=>$user_id))->field('currency,brokerage')->find();
        #邀请记录
        $where = array();
            $where['user_id'] = $user_id;
            $where['type']    = 0;
            $where['ratify_status']  = $status;

        $count = $user_brokerage_db->where($where)->count(); //统计总条数
        $page  = new \Think\Page($count,10); //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data  = $user_brokerage_db->where($where)->limit($limit)->order('id DESC')->select();

        foreach($data as $k=>$v){
            $userInfo = $user_db->where(array('id'=>$v['user_id_son']))->field('username,reg_time')->find();
            $groupInfo = getUserGroup($v['user_id_son']);
            $data[$k]['username']   = $userInfo['username'];
            $data[$k]['reg_time']   = $userInfo['reg_time'];
            $data[$k]['group_id']   = $groupInfo['group_id'];
            $data[$k]['group_name'] = $groupInfo['group_name'];
        }
        $pages = $page->show();

        $this->assign('user_account',$user_account);
        $this->assign('data',$data);
        $this->assign('pages',$pages);
        $this->assign('totalPages',$page->totalPages);
        $this->display();
    }
    
    //佣金提现
    public function myTiXian()
    {
        $user_id       = session(C('USER_AUTH_UID'));
        $user_db       = M('user');
        $user_brokerage_t_db = M('user_brokerage_tixian');
        $user_bank_db  = M('user_bank');
        #用户佣金
        $user_account  = $user_db->where(array('id'=>$user_id))->field('currency,brokerage')->find();
        if(IS_AJAX){
            $bank_card = I('post.bank_card',0,'intval');
            $money     = I('post.money','');
            $money     = sprintf('%.2f', floatval($money));//金额保留2位小数
            $password  = I('post.password','');
            $userBankCard = $user_bank_db->where(array('id'=>$bank_card,'user_id'=>$user_id))->find();
            $bank_card_   = getBankType($bank_card);

            $start_time = date('Y-m-d');
            list($y,$m,$d) = explode('-',$start_time);
            $start_time = strtotime($start_time);
            $end_time   = mktime(23, 59, 59, $m, $d, $y);
            $count = $user_brokerage_t_db->where(array('user_id'=>$user_id,'addtime'=>array(array('EGT',$start_time),array('ELT',$end_time))))->count();

            if(!$money)
                $this->error('请输入正确的提现金额');
            if($money>$user_account['brokerage'])
                $this->error('超出账户可用余额');
            if($money<100)
                $this->error('单次提现金额不能低于100');
            if($count>=3)
                $this->error('申请提现次数已达到当天上限');
            if(!$user_account['brokerage'])
                $this->error('账户可提现余额不足');
            if(empty($bank_card_) or empty($userBankCard))
                $this->error('请选择要提现的银行卡或账户');

            $passwordInfo = $user_db->where(array('id'=>$user_id))->field('password,encrypt')->find();
            $input_pass = password_md5($password,$passwordInfo['encrypt']);
            if($input_pass != $passwordInfo['password'])
                $this->error('密码不正确，请重新输入');

            $data = array();
            $data['user_id'] = $user_id;
            $data['money']   = $money;
            $data['name']    = $userBankCard['name'];
            $data['type']    = $userBankCard['type'];
            $data['number']  = $userBankCard['number'];
            $data['addtime'] = time();
            $insertID = $user_brokerage_t_db->data($data)->add();
            if($insertID){
                $brokerage = $user_account['brokerage']-$money;
                $user_db->where(array('user_id'=>$user_id))->data(array('brokerage'=>$brokerage))->save();
            }else{
                $this->error('提现申请失败，请稍后重试');
            }

            $this->success('提现申请已提交，请耐心等待审核！',U('User/myBrokerage'));
        }else{
            #用户银行卡
            $user_bank = $user_bank_db->where(array('user_id'=>$user_id))->select();

            $this->assign('user_account',$user_account);
            $this->assign('user_bank',$user_bank);
            $this->display();
        }
    }

    //用户7天排名
    public function myRank(){
        $user_id  = session(C('USER_AUTH_UID'));
        for($i=7;$i>=1;$i--)
        {
            $Ymd[] = date('Y-m-d',strtotime("-{$i} day"));
            $md[]  = date('m-d',strtotime("-{$i} day"));
        }
        $db = M('user_ranking');
        $data =  array();
        foreach ($Ymd as $day) {
            $addtime = strtotime($day . ' 00:00:00');
            $count = $db->where(array('user_id'=>$user_id,'addtime'=>$addtime))->getField('ranking');
            $data[] = $count ? $count : 0;
        }

        $data     = implode(',',$data); //数据
        $time_str = "'".implode("','",$md)."'"; //时间
        $this->assign('time_str',$time_str);
        $this->assign('data',$data);
        $this->display();
    }

    //用户已报名的课程
    public function myCourse(){
        $user_g_db     = M('user_group');
        $user_g_ext_db = M('user_group_ext');
        $user_id  = session(C('USER_AUTH_UID'));

        $where = array('user_id'=>$user_id);
        $count = $user_g_ext_db->where($where)->count();
        $page  = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $data  = $user_g_ext_db->where($where)->limit($limit)->order('end_time DESC')->select();
        foreach($data as $k=>$v){
            $group_info = $user_g_db->where(array('id'=>$v['group_id']))->field('id,name')->find();
            $data[$k]['group_name'] = $group_info['name'];
            $data[$k]['group_id']   = $group_info['id'];
        }
        $pages = $page->show();

        $this->assign('data',$data);
        $this->assign('pages',$pages);
        $this->assign('totalPages',$page->totalPages);
        $this->display();
    }

    //用户基本信息
    public function myInfo(){
        $user_id = session(C('USER_AUTH_UID'));
        $user_db = M('user');
        if(IS_AJAX){
            $setMyInfoTime   = cookie('setMyInfoTime');
            if($setMyInfoTime && $setMyInfoTime+1>time())
                $this->ajaxReturn(array('msg'=>'资料修改的太频繁啦','status'=>0));
            $uc_username     = I('post.uc_username');
            $uc_password     = I('post.uc_password');
            $realname        = I('post.realname');
            $company         = I('post.company');
            $trade           = I('post.trade');
            $qq              = I('post.qq');
            $weixin_username = I('post.weixin_username');

            $data = array(
                'realname'=> $realname,
                'company' => $company,
                'trade'   => $trade,
                'qq'      => $qq,
                'weixin_username' => $weixin_username,
            );
            $user_db->where(array('id'=>$user_id))->data($data)->save();
            cookie('setMyInfoTime',time());
            $this->ajaxReturn(array('msg'=>'资料修改成功','status'=>1));
        }else{
            $this->user_info = $user_db->where(array('id'=>$user_id))->cache(1)->find();
            $this->display();
        }
    }


    //用户头像
    public function myLogo(){
        if(IS_AJAX){
            $user_id = session(C('USER_AUTH_UID'));
            $user_db = M('user');
            $face    = I('post.face',1,'intval');
            $user_db->where(array('id'=>$user_id))->data(array('face'=>$face))->save();
            session(C('USER_FACE'),$face);
            $this->ajaxReturn(array('msg'=>'头像修改成功','status'=>1));
        }else{
            $this->display();
        }
    }

    //用户收货地址--列表展示--和--删除地址功能
    public function myAddressList(){
        $user_id    = session(C('USER_AUTH_UID'));
        $address_db = M('user_address');
        $area_db    = M('area');
        if(IS_AJAX){
            $id = I('post.delID',0,'intval');
            $address_db->where(array('id'=>$id,'user_id'=>$user_id))->delete();
            $this->ajaxReturn(array('msg'=>'删除成功！','status'=>1));
        }else{
            $where = array('user_id'=>$user_id);
            $count = $address_db->where($where)->count();
            $page  = new \Think\Page($count,10);
            $limit = $page->firstRow .','. $page->listRows;
            $data  = $address_db->where($where)->limit($limit)->order('addtime DESC')->select();
            foreach($data as $k=>$v){
                $data[$k]['province'] = $area_db->where(array('id'=>$v['province']))->cache(1)->getField('name');
                $data[$k]['city']     = $area_db->where(array('id'=>$v['city']))->cache(1)->getField('name');
                $data[$k]['county']   = $area_db->where(array('id'=>$v['county']))->cache(1)->getField('name');
            }
            $pages = $page->show();

            $this->assign('data',$data);
            $this->assign('countPage',$page->totalPages);
            $this->assign('page',$pages);
            $this->display();
        }
    }

    //用户收货地址-获取下拉框地址
    public function getSelectAddress(){
        if(IS_AJAX){
            $area_db  = M('area');
            $pid = I('post.pid',0,'intval');
            $data = $area_db->where(array('pid'=>$pid))->field('id,name')->select();
            //p(M()->getLastSql());
            $this->ajaxReturn(array('area'=>$data,'status'=>1));
        }else
            _404();
    }

    //用户收货地址--添加和编辑功能
    public function myAddress(){
        $user_id = session(C('USER_AUTH_UID'));
        $area_db = M('area');
        $address_db = M('user_address');
        $id   =  I('edit',0,'intval');//需要修改地址的ID
        if(IS_AJAX){
            if(!$id){
                $address_count = $address_db->where(array('user_id'=>$user_id))->count();
                if($address_count > 20) $this->ajaxReturn(array('msg'=>'收货地址数量达到上限','status'=>0));
            }else{
                $info = $address_db->where(array('user_id'=>$user_id,'id'=>$id))->find();
                if(!$info) $this->ajaxReturn(array('msg'=>'此收货地址不存在','status'=>0));
            }

            $name            =  I('post.name','');
            $province        =  I('post.province',0,'intval');
            $city            =  I('post.city',0,'intval');
            $county          =  I('post.county',0,'intval');
            $address         =  I('post.address','');
            $mobile          =  I('post.mobile','');
            $postalcode      =  I('post.postalcode','');

            if(!$name)    $this->ajaxReturn(array('msg'=>'请填写收货人姓名','status'=>0));
            if(!$mobile)  $this->ajaxReturn(array('msg'=>'请填写收货人姓名手机号','status'=>0));
            if(!$address) $this->ajaxReturn(array('msg'=>'请填写收货人详细地址','status'=>0));

                $data = array();
                $data['name']       = $name;
                $data['province']   = $province;
                $data['city']       = $city;
                $data['county']     = $county;
                $data['address']    = htmlspecialchars($address);
                $data['postalcode'] = $postalcode;
                $data['mobile']     = $mobile;
            if($id){
                $data['save_time']  = time();
                $address_db->where(array('user_id'=>$user_id,'id'=>$id))->data($data)->save();
            }
            else{
                $data['user_id'] = $user_id;
                $data['addtime'] = time();
                $address_db->data($data)->add();
            }

            $msg = $id?'收货地址修改成功':'收货地址添加成功';
            $this->ajaxReturn(array('msg'=>$msg,'status'=>1));
        }else{
            $this->province = $area_db->where(array('pid'=>1))->order('id ASC')->select();
            if($id){//修改地址-读取原地址信息
                $info              = $address_db->where(array('user_id'=>$user_id,'id'=>$id))->find();
                if(!$info) _404();
                $info['province_'] = $area_db->where(array('id'=>$info['province']))->cache(1)->getField('name');
                $info['city_']     = $area_db->where(array('id'=>$info['city']))->cache(1)->getField('name');
                $info['county_']   = $area_db->where(array('id'=>$info['county']))->cache(1)->getField('name');
                $this->assign('info',$info);
                $this->assign('id',$id);
            }
            $this->display();
        }
    }


    //用户消息
    public function myNews(){
        $message_db      = M('message');
        $message_user_db = M('message_user');
        $user_id    = session(C('USER_AUTH_UID'));

        if(IS_AJAX){

            $is_read = I('post.is_read',2,'intval');
            $msg_id  = I('post.msg_id/a');
            //更新用户的消息状态
            if($is_read==1){
                $id = intval($msg_id[0]);
                $msg_user = $message_user_db->where(array('id'=>$id,'recipient_id'=>$user_id))->find();
                if(!$msg_user) $this->ajaxReturn(array('msg'=>'此消息不存在','status'=>0));
                if($msg_user['is_read'] != 1)//把消息设置为已读
                $message_user_db->where(array('id'=>$id,'recipient_id'=>$user_id))->data(array('is_read'=>1,'read_time'=>time()))->save();
                $this->ajaxReturn(array('status'=>1));
            }
            //用户删除消息
            if(!$msg_id)
                $this->ajaxReturn(array('msg'=>'请选择要删除的消息！','status'=>0));
            foreach($msg_id as $id){
                $id = intval($id);
                $message_user_db->where(array('id'=>$id,'recipient_id'=>$user_id))->data(array('is_show'=>2))->save();
            }
            $this->ajaxReturn(array('msg'=>'删除成功！','status'=>1));

        }else{

            $cache = cookie('MemberUserMyNews') ? cookie('MemberUserMyNews') : array('is_read' => 2);
            $is_read = I('get.read',intval($cache['is_read']),'intval');
            $getArr = array(
                'is_read' => $is_read
                );
            if (array_diff_assoc($getArr, $cache)) {
                cookie('MemberUserMyNews', $getArr);
            }


            $where = array('recipient_id' => $user_id, 'is_show' => 1);
            if($is_read != 2) $where['is_read']  = $is_read;//全部消息

            $count = $message_user_db->where($where)->count(); //统计总条数
            $page  = new \Think\Page($count,10);
            $limit = $page->firstRow .','. $page->listRows;
            $data  = $message_user_db->where($where)->limit($limit)->order('is_read ASC, id DESC')->select();
            foreach($data as $k=>$v){
                $messageInfo = $message_db->where(array('id'=>$v['message_id']))->find();
                $data[$k]['title']   = $messageInfo['title'];
                $data[$k]['content'] = $messageInfo['content'];
                $data[$k]['addtime'] = $messageInfo['addtime'];
            }
            $pages = $page->show();

            $this->assign('countPage',$page->totalPages);
            $this->assign('page',$pages);
            $this->assign('data',$data);
            $this->is_read = $is_read;
            $this->display();

        }
    }
}
