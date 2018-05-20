<?php
namespace Admin\Controller;
use Think\Controller;
use Lib\Util\Category;

class MoneyController extends CommonController {

    //邀请佣金列表
    public function index(){

        $where  = array();
        $where['type']   = 0;//0为邀请佣金类型

        $ratify_status = I('ratify_status',0,'intval');//审核状态
        $username      = I('post.username');//用户名

        if($_POST){
            cookie('ratify_status',$ratify_status?$ratify_status:null);
            cookie('username',$username?$username:null);
        }

        $ratify_status  = cookie('ratify_status');
        $username       = cookie('username');

        if($username){
            $userinfo = M('user')->where(array('username'=>$username))->find();
            if(!$userinfo) $this->error('此用户不存在，请输入正确的用户名查询！');
            $where['user_id']   =  $userinfo['id'];
        }
        if($ratify_status)
            $where['ratify_status']  = $ratify_status;


        $count = M('user_brokerage')->where($where)->count(); //统计总条数
        $page  = new \Think\Page($count, 15);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data  = M('user_brokerage')->where($where)->limit($limit)->order('addtime DESC,user_id ASC')->select();
        foreach($data as $k=>$v){
            //D('UserView')->where(array('user.id'=>$v['user_id']))->limit($limit)->order('user_group_ext.end_time DESC,user.id ASC')->group('id')->find();
            $data[$k]['username']      = getUserInfo($v['user_id'],'username');
            $data[$k]['username_son']  = getUserInfo($v['user_id_son'],'username');

            $data[$k]['user_group_name']  = M('user_group')->where(array('id' => $v['type_id']))->cache(true,120)->getField('name');
        }

        $pages = $page->show();


        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('data',$data);
        $this -> assign('count',$count);
        $this -> display();
	}

    //提问佣金列表
    public function answerMoney(){

        $where  = array();
        $where['type']   = 1;//1为提问佣金类型

        $ratify_status = I('ratify_status',0,'intval');//审核状态
        $username      = I('post.username');//用户名

        if($_POST){
            cookie('ratify_status',$ratify_status?$ratify_status:null);
            cookie('username',$username?$username:null);
        }

        $ratify_status  = cookie('ratify_status');
        $username       = cookie('username');

        if($username){
            $userinfo = M('user')->where(array('username'=>$username))->find();
            if(!$userinfo) $this->error('此用户不存在，请输入正确的用户名查询！');
            $where['user_id']   =  $userinfo['id'];
        }
        if($ratify_status)
            $where['ratify_status']  = $ratify_status;


        $count = M('user_brokerage')->where($where)->count(); //统计总条数
        $page  = new \Think\Page($count, 15);         //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data  = M('user_brokerage')->where($where)->limit($limit)->order('addtime DESC,user_id ASC')->select();
        foreach($data as $k=>$v){
            $data[$k]['username']      = getUserInfo($v['user_id'],'username');
            $vid = M('video_question_answer')->where(array('question_id' => $v['type_id']))->getField('vid');
            $data[$k]['video_name']  = M('video')->where(array('id' => $vid))->getField('title');
        }

        $pages = $page->show();


        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('data',$data);
        $this -> assign('count',$count);
        $this -> display();
    }

    //佣金和回答问题  统一审核和取消
    public function yongJinShenHe(){
        $type    = I('type',0,'intval');//佣金类型：0邀请 1提问
        $url     = $type?'answerMoney':'index';
        $page    = I('page',1,'intval');
        $id      = I('id',0,'intval');

        $info    = M('user_brokerage')->where(array('id'=>$id))->find();
        if(!$info) $this->error('请选择要审核的佣金！');

        if($_POST){
            $ratify_remark = I('post.ratify_remark','','htmlspecialchars');
            $userinfo = M('user')->where(array('id'=>$info['user_id']))->find();
            $data  = array();
            $data1 = array();
            $data['ratify_remark'] = $ratify_remark;
            $data['ratify_time']   = time();
            $data['ratify_status'] = $info['ratify_status']==1 ? 2 : 1 ;
            $brokerage = $userinfo['brokerage'] ;
            //审核-给用户加上对应佣金
            if($data['ratify_status']==1){
                $data1['brokerage'] = $brokerage+$info['amount'];
            }else{//取消审核-给用户减去对应佣金
                $now_brokerage = $brokerage-$info['amount'];
                $data1['brokerage'] = $now_brokerage<0 ? 0 : $now_brokerage;
            }

            M('user')->where(array('id'=>$info['user_id']))->save($data1);
            M('user_brokerage')->where(array('id'=>$info['id']))->save($data);
            $this->success('操作成功！',U(MODULE_NAME.'/Money/'.$url,array('p'=>$page)));

        }else{
            $this -> assign('info',$info);
            $this -> assign('page',$page);
            $this -> assign('type',$type);
            $this -> display();
        }
    }
    //提现审核--提现列表
    public function tixianList()
    {
        $where  = array();

        $ratify_status = I('ratify_status',0,'intval'); //审核状态
        $username      = I('username','','trim');       //用户名
        $tixian_name   = I('tixian_name','','trim'); //账户名
        $tixian_number = I('tixian_number','','trim'); //提现账户

        if($_POST){
            cookie('ratify_status',$ratify_status?$ratify_status:null);
            cookie('username',$username?$username:null);
            cookie('tixian_name',$tixian_name?$tixian_name:null);
            cookie('tixian_number',$tixian_number?$tixian_number:null);
        }

        $ratify_status  = cookie('ratify_status');
        $username       = cookie('username');
        $tixian_name    = cookie('tixian_name');
        $tixian_number  = cookie('tixian_number');

        if($username){
            $userinfo = M('user')->where(array('username'=>$username))->find();
            if(!$userinfo) {
                $userinfo = M('user')->where(array('username'=>array('LIKE',"%{$username}%")))->find();
            };
            if(!$userinfo) $this->error('此用户不存在，请输入正确的用户名查询！');
            $where['user_id']   =  $userinfo['id'];
        }
        if($tixian_name)
            $where['name']    =  $tixian_name;
        if($tixian_number)
            $where['number']  =  $tixian_number;

            $where['ratify_status']  = $ratify_status?$ratify_status:0;


        $count = M('user_brokerage_tixian')->where($where)->count(); //统计总条数
        $page  = new \Think\Page($count, 15);          //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data  = M('user_brokerage_tixian')->where($where)->limit($limit)->order('addtime DESC')->select();
        $USER_MODEL = D('UserView');
        foreach($data as $k=>$v){
            $userinfo = $USER_MODEL->where(array('id'=>$v['user_id']))->field('username,group_name,user_group_id')->find();
            $data[$k]['userinfo'] = $userinfo;
        }

        $pages = $page->show();


        $this -> assign('totalPages',$page->totalPages);
        $this -> assign('page',$pages);
        $this -> assign('data',$data);
        $this -> assign('count',$count);
        $this -> display();
    }
    //提现管理--通过审核
    public function tixianShenheTg()
    {
        $page    = I('page',1,'intval');
        $id      = I('id',0,'intval');

        $info    = M('user_brokerage_tixian')->where(array('id'=>$id))->find();
        if(!$info) $this->error('请选择要审核的提现申请！');
        if($info['ratify_status']==2) $this->error('该提现申请已经拒绝审核！禁止操作');
        if($_POST){
            $ratify_remark = I('ratify_remark','','htmlspecialchars');
            $this->tixianShenhe($info,1,$ratify_remark,$page);
        }else{
            $this -> assign('info',$info);
            $this -> assign('page',$page);
            $this -> display('tixianShenhe');
        }
    }
    //提现管理--拒绝审核
    public function tixianShenheQx()
    {
        $page    = I('page',1,'intval');
        $id      = I('id',0,'intval');

        $info    = M('user_brokerage_tixian')->where(array('id'=>$id))->find();
        if(!$info) $this->error('请选择要审核的提现申请！');
        if($info['ratify_status']==2) $this->error('该提现申请已经拒绝审核！禁止操作');

        if($_POST){
            $ratify_remark = I('ratify_remark','','htmlspecialchars');
            $this->tixianShenhe($info,2,$ratify_remark,$page);
        }else{
            $this -> assign('info',$info);
            $this -> assign('page',$page);
            $this -> display('tixianShenhe');
        }
    }

    //提现管理--复原审核
    public function tixianShenheFy()
    {
        $page    = I('page',1,'intval');
        $id      = I('id',0,'intval');

        $info    = M('user_brokerage_tixian')->where(array('id'=>$id))->find();
        if(!$info) $this->error('请选择要审核的提现申请！');
        if($info['ratify_status']==2) $this->error('该提现申请已经拒绝审核！禁止操作');

        if($_POST){
            $ratify_remark = I('ratify_remark','','htmlspecialchars');
            $this->tixianShenhe($info,0,$ratify_remark,$page);
        }else{
            $this -> assign('info',$info);
            $this -> assign('page',$page);
            $this -> display('tixianShenhe');
        }
    }


    //公共--提现审核公共方法
    private function tixianShenhe($info,$ratify_status,$ratify_remark,$page)
    {
        $data  = array();
        $data['ratify_remark'] = $ratify_remark;
        $data['ratify_time']   = time();
        $data['ratify_status'] = $ratify_status;
        if($ratify_status==2){#拒绝审核  把佣金恢复
            $user_db = M('user');
            $userbrokerage = $user_db->where(array('id'=>$info['user_id']))->getField('brokerage');
            $brokerage = $userbrokerage+$info['money'];
            $user_db->where(array('id'=>$info['user_id']))->data(array('brokerage'=>$brokerage))->save();
        }

        M('user_brokerage_tixian')->where(array('id'=>$info['id']))->data($data)->save();
        $this->success('操作成功！',U(MODULE_NAME.'/Money/tixianList',array('p'=>$page)));
    }

    //优惠券
    public function userGroupTicket() {

        $type     = I('type',0,'intval');
        $username = trim(I('username'));
        $where = array();
        if($_POST){
            $type ? cookie('type',$type) : cookie('type',null);
            $username ? cookie('username',$username) : cookie('username',null);
            $username = cookie('username');

            if($username){
                $userinfo = M('user')->where(array('username'=>$username))->find();
                if(!$userinfo) $userinfo = M('user')->where(array('username'=>array('LIKE',"%{$username}%")))->find();
                if(!$userinfo) $this->error('此用户名不存在，请重新输入查询！');
                $where = array('ht_ticket.user_id'=>$userinfo['id']);
            }
        }

        $type = cookie('type');
        if(!$type) $where = array('ht_ticket.status'=>0);//默认显示未使用优惠券

        if($type == 1){//已使用优惠券
            $where = array('ht_ticket.status'=>1);
        }else if($type==2){//未使用优惠券
            $where = array('ht_ticket.status'=>0);
        }else if($type==3){//已过期优惠券
            $where = array(
                'ht_ticket.status'=>0,
                'ht_ticket.end_time'=>array('LT',time()),
            );
        }

        $count = M('ticket')->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 15); //分页类

        $limit = $page->firstRow .','. $page->listRows;



        $info = M('ticket')
            ->join('LEFT JOIN ht_user ON ht_user.id = ht_ticket.user_id')
            ->join('LEFT JOIN ht_user_group ON ht_user_group.id = ht_ticket.group_id')
            ->join('LEFT JOIN (select GROUP_CONCAT(ht_user_group.name)'
                . ' as group_name,ht_ticket_ext.ticket_id'
                . ' as ticket_id from ht_ticket_ext,ht_user_group where '
                . 'ht_ticket_ext.group_id = ht_user_group.id '
                . 'group by ticket_id)A '
                . 'ON ht_ticket.id = ticket_id')
            ->field('ht_ticket.*,ht_user.username,ht_user_group.name as good_name,group_name')
            ->limit($limit)->where($where)->select();

        $count_money = M('ticket')->where($where)->sum('price');
        $this->page = $page->show();
        $this->totalPages = $page->totalPages;

        $this->assign('info',$info);
        $this->assign('count',$count);
        $this->assign('count_money',$count_money);
        $this->assign('type',$type);
        $this->display();


    }
    //添加优惠券
    public function userGroupTicketAdd() {

        if ($_POST) {
            $group_id = I('post.group_id/a');
            $info = I('post.info');
            if (!$group_id)
                $this->error('优惠券可用范围没有选择！');
            if (!$info['num'])
                $this->error('优惠券数量不正确！');
            if (!$info['price'])
                $this->error('优惠券价格没有填写！');
            if ($info['num']==1)
                if(!$info['code']==1) $this->error('优惠券口令没有填写！');

            $info['creat_time'] = time();
            if($info['end_time']){
                list($y, $m, $d) = explode('-', $info['end_time']);
                $info['end_time'] = mktime(23, 23, 59, $m, $d, $y);
            }

            for($i=1;$i<=intval($info['num']);$i++){
                if($info['num']>1) $info['code']  = getRandCore(10);
                $ticket_id = M('ticket')->strict()->add($info);
                if($ticket_id){
                    foreach ($group_id as $v){
                        M('ticket_ext')->add(array('ticket_id'=>$ticket_id,'group_id'=>$v));
                    }
                }
            }

            $this->success('操作成功!',  U(MODULE_NAME.'/Money/userGroupTicket'));
        } else {

            $this->user_group = M('user_group')->where(array('allow_buy'=>1))->select();
            $this->display();
        }

    }
    //编辑优惠券
    public function userGroupTicketEdit() {
        if ($_POST) {
            $group_id = I('post.group_id/a');
            $info = I('post.info');
            $id = I('post.id');

            if (!$group_id)
                $this->error('优惠券可用范围没有选择！');
            if (!$info['price'])
                $this->error('优惠券价格没有填写！');
            if (!$info['code'])
                $this->error('优惠券口令没有填写！');

            if($info['end_time']){
                list($y, $m, $d) = explode('-', $info['end_time']);
                $info['end_time'] = mktime(23, 23, 59, $m, $d, $y);
            }


            M('ticket_ext')->where(array('ticket_id'=>$id))->delete();
            foreach ($group_id as $v){
                M('ticket_ext')->add(array('ticket_id'=>$id,'group_id'=>$v));
            }
            M('ticket')->where(array('id'=>$id))->strict()->save($info);

            $this->success('操作成功!',U(MODULE_NAME.'/Money/userGroupTicket'));
        }
        else {
            $id = I('get.id',0,'intval');

            $this->info = M('ticket')->where(array('id'=>$id))->find();
            $ticket_ext = M('ticket_ext')->where(array('ticket_id'=>$id))->select();

            $is_checked = array();
            foreach($ticket_ext as $v){
                $is_checked[] = $v['group_id'];
            }

            $this->user_group = M('user_group')->where(array('allow_buy'=>1))->select();
            $this->assign('is_checked',$is_checked);
            $this->display();
        }
    }
    //删除优惠券
    public function userGroupTicketDelete() {
        $ids   = I('id/a');
        $page  = I('page',1,'intval');

        foreach($ids as $id)
        {
            $id = intval($id);
            M('ticket_ext')->where(array('ticket_id'=>$id))->delete();
            M('ticket')->where(array('id'=>$id))->delete();
        }
        $this->success('操作成功!',U(MODULE_NAME.'/Money/userGroupTicket',array('p'=>$page)));
    }

    //生成优惠券口令
    public function TicketCode(){
        if(I('post.code/d')){
            exit(json_encode(array('code'=>getRandCore(10))));
        }
    }

    //充值订单
    public function rechargeOrder()
    {
        $status     = I('status',2,'intval');//支付状态
        $username   = I('username','','trim');
        $trade_no   = I('trade_no','','trim');
        $order_db   = M('order_pay');
        $user_db    = M('user');
        $where = array();
        if($_POST){
            $status ? cookie('status',$status) : cookie('status',null);
            $username ? cookie('username',$username) : cookie('username',null);
            $trade_no ? cookie('trade_no',$trade_no) : cookie('trade_no',null);

            if($username){
                $userinfo = $user_db->where(array('username'=>$username))->find();
                if(!$userinfo) $userinfo = $user_db->where(array('username'=>array('LIKE',"%{$username}%")))->find();
                if(!$userinfo) $this->error('此用户名不存在，请重新输入查询！',U('Money/rechargeOrder'));
                $where['user_id'] = $userinfo['id'];
            }
        }

        $status   = cookie('status');
        $trade_no = cookie('trade_no');



        if($status == 1){//支付失败
            $where['status'] = 1;
        }else if($status==2){//支付成功
            $where['status'] = 2;
        }else if($status==3){//等待支付
            $where['status'] = 0;
        }
        if(!$status)
            $where['status'] = 2;#默认显示成功订单
        if($trade_no)
            $where['trade_no'] = $trade_no;


        $count = $order_db->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 50); //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data = $order_db->limit($limit)->where($where)->order('pay_time DESC,add_time ASC')->select();

        $this->page = $page->show();

        $this->assign('data',$data);
        $this->assign('totalPages',$page->totalPages);
        $this->assign('status',$where['status']);
        $this->display();
    }
    //删除充值订单
    public function rechargeOrderDelete()
    {
        $ids   = I('id/a');
        $page  = I('page',1,'intval');
        $db = M('order_pay');
        foreach($ids as $id)
        {
            $id = intval($id);
            $db->where(array('id'=>$id,'status'=>array('NEQ',2)))->delete();
        }
        $this->success('操作成功!',U(MODULE_NAME.'/Money/rechargeOrder',array('p'=>$page)));
    }


    //用户消费订单
    public function consumerOrder()
    {
        $status     = I('status',1,'intval');//支付状态
        $goods_type = I('goods_type',0,'intval');//支付状态
        $username   = I('username','','trim');

        $order_db   = M('order_goods');
        $user_g_db  = M('user_group');
        $video_db   = M('video');
        $user_db    = M('user');
        $where = array();
        if($_POST){
            $status   ? cookie('goods_status',$status) : cookie('goods_status',null);
            $goods_type ? cookie('goods_type',$goods_type) : cookie('goods_type',null);
            $username ? cookie('username',$username) : cookie('username',null);

            if($username){
                $userinfo = $user_db->where(array('username'=>$username))->find();
                if(!$userinfo) $userinfo = $user_db->where(array('username'=>array('LIKE',"%{$username}%")))->find();
                if(!$userinfo) $this->error('此用户名不存在，请重新输入查询！',U('Money/consumerOrder'));
                $where['user_id'] = $userinfo['id'];
            }
        }

        $status     = cookie('goods_status');
        $goods_type = cookie('goods_type');



        if($status == 1){//支付成功
            $where['status'] = 1;
        }else if($status==2){//支付失败
            $where['status'] = 0;
        }
        if(!$status)
            $where['status'] = 1;#默认显示成功订单

        if($goods_type == 1){//单个视频
            $where['goods_type'] = 1;
        }else if($goods_type==2){//用户组
            $where['goods_type'] = 0;
        }
        if(!$goods_type)
            $where['goods_type'] = 0;#默认显示成功订单


        $count = $order_db->where($where)->count(); //统计总条数
        $page = new \Think\Page($count, 50); //分页类
        $limit = $page->firstRow .','. $page->listRows;
        $data = $order_db->limit($limit)->where($where)->select();
        foreach($data as $k=>$v){
            if($v['goods_type']==0){#用户组
                $data[$k]['goods_name'] = $user_g_db->where(array('id'=>$v['goods_id']))->getField('name');
            }elseif($v['goods_type']==1){#单个视频
                $data[$k]['goods_name'] = $video_db->where(array('id'=>$v['goods_id']))->getField('title');
            }
        }
        $this->page = $page->show();

        $this->assign('data',$data);
        $this->assign('totalPages',$page->totalPages);
        $this->assign('status',$where['status']);
        $this->assign('goods_type',$where['goods_type']);
        $this->display();
    }
    //删除充值订单
    public function consumerOrderDelete()
    {
        $ids   = I('id/a');
        $page  = I('page',1,'intval');
        $db = M('order_goods');
        foreach($ids as $id)
        {
            $id = intval($id);
            $db->where(array('id'=>$id,'status'=>array('NEQ',1)))->delete();
        }
        $this->success('操作成功!',U(MODULE_NAME.'/Money/consumerOrder',array('p'=>$page)));
    }
}