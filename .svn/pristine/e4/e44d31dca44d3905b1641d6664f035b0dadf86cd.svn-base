<?php
namespace Member\Controller;
use Think\Controller;
//默认首页控制器
class WeixinController extends EmptyController
{
    protected  $config;//微信配置信息

    public function _initialize(){
        $this->config = C('WECHAT_CONFIG');
    }


    //接受响应微信服务器发来的消息--首页
    public function index()
    {
        //@file_put_contents(ROOT_PATH.'public/log/text.txt',var_export($_GET,true),FILE_APPEND);
        $weixinObj = new \Lib\Util\Wx($this->config);
        //$weixinObj->valid(); #微信配置身份验证
        $type = $weixinObj->getRev()->getRevType();

        switch($type)
        {
            //文本消息
            case $type=='text':
                $text = $weixinObj->getRev()->getRevContent();
                $weixinObj->text($text)->reply();
                break;
            //语音消息
            case $type=='voice':


                break;
            //图片消息
            case $type=='image':

                break;
            //视频消息
            case $type=='video':

                break;
            //短视频消息
            case $type=='shortvideo':

                break;
            //发送位置消息
            case $type=='location':
                $weizhi = $weixinObj->getRevGeo();
                //@file_put_contents(ROOT_PATH.'public/log/weixin_event.txt',var_export($weizhi,true),FILE_APPEND);
                $weixinObj->text(
                    '经度：'.$weizhi['x']."\r\n".
                    '维度：'.$weizhi['y']."\r\n".
                    '位置：'.$weizhi['label']
                )->reply();
                break;
            //事件处理
            default:
                $event = $weixinObj->getRevEvent();
                $openid = $weixinObj->getRevFrom();
                $getRevEventGeo = $weixinObj->getRevEventGeo();//地理位置信息
                //@file_put_contents(ROOT_PATH.'public/log/wx_info.txt',var_export($event,true)."\r\n",FILE_APPEND);
                //关注事件
                if($event['event'] == 'subscribe'){
                    $weixinObj->text('欢迎关注嗨推学院的公众号，官方网站<a href="xue.hitui.com">xue.hitui.com</a>')->reply();

                    if(strpos($event['key'],'qrscene_') !== false)
                    {
                        $user_id = str_replace('qrscene_', '', $event['key']);
                        $this->updateUserWeixin($openid,$user_id);
                    }
                }
                //取消关注事件
                elseif($event['event'] == 'unsubscribe'){
                    M('user')->where(array('weixin_openid'=>$openid))->save(array('weixin_openid'=>'','weixin_unionid'=>''));
                }
                //已经关注扫码或者进入公众号
                elseif($event['event'] == 'SCAN'){
                    $user_id = $event['key'];
                    $this->updateUserWeixin($openid,$user_id);
                }
                //上报地理位置
                elseif($event['event'] == 'LOCATION'){
                    $weizhi_sendtime = S('weizhi_sendtime');
                    if(!empty($weizhi_sendtime) && $weizhi_sendtime > time()){//没隔30分钟 才发送一次位置
                        return false;
                    }
                    $weizhi = $weixinObj->getRevEventGeo();

                    $result = @file_get_contents("http://restapi.amap.com/v3/geocode/regeo?output=json&location={$weizhi['y']},{$weizhi['x']}&key=6bc8cc66762a510a9a9e7ed99ff76658&radius=500&extensions=all");
                    $result = json_decode($result,true);
                    //@file_put_contents(ROOT_PATH.'public/log/weixin_event.txt',var_export(array($result,$weizhi),true)."\r\n",FILE_APPEND);
                    $reply_str = '' ;
                    $fujin_area_count = count($result['regeocode']['pois']);
                    for($i=0;$i<intval($fujin_area_count/3);$i++){
                        $reply_str .= '服务名称：'.$result['regeocode']['pois'][$i]['name']."\r\n" ;
                        $reply_str .= '服务类型：'.$result['regeocode']['pois'][$i]['type']."\r\n" ;
                        $reply_str .= '经度：'.$result['regeocode']['pois'][$i]['location']."\r\n" ;
                        $reply_str .= '维度：'.$result['regeocode']['pois'][$i]['distance']."\r\n" ;
                        $reply_str .= '区域：'.$result['regeocode']['pois'][$i]['businessarea']."\r\n";
                    }

                     $weixinObj->text(
                        '您的位置：'.$result['regeocode']['formatted_address']."  附近。。\r\n".
                        '经度：'.$weizhi['x']."\r\n".
                        '维度：'.$weizhi['y']."\r\n".
                        '精确度：'.$weizhi['precision']."\r\n".
                        '您附近还有这些地方：'."\r\n".$reply_str
                    )->reply();
                    S('weizhi_sendtime',time()+30*60);
                }
                else
                {
                    //@file_put_contents(ROOT_PATH.'public/log/weixin_event.txt',$event['event']."\r\n",FILE_APPEND);
                }
        }

    }

    public function t()
    {
        $weixinObj = new \Lib\Util\Wx($this->config);
        //自定义菜单
        $arr = array (
      	    'button' => array (
      	      0 => array (
      	        'name' => '扫码',
      	        'sub_button' => array (
      	            0 => array (
      	              'type' => 'scancode_waitmsg',
      	              'name' => '扫码带提示',
      	              'key' => 'rselfmenu_0_0',
      	            ),
      	            1 => array (
      	              'type' => 'scancode_push',
     	              'name' => '扫码推事件',
      	              'key' => 'rselfmenu_0_1',
      	            ),
      	        ),
      	      ),
      	      1 => array (
      	        'name' => '发图',
      	        'sub_button' => array (
      	            0 => array (
      	              'type' => 'pic_sysphoto',
      	              'name' => '系统拍照发图',
      	              'key' => 'rselfmenu_1_0',
      	            ),
      	            1 => array (
      	              'type' => 'pic_photo_or_album',
      	              'name' => '拍照或者相册发图',
      	              'key' => 'rselfmenu_1_1',
      	            )
      	        ),
      	      ),
      	      2 => array (
      	        'type' => 'location_select',
      	        'name' => '发送位置',
      	        'key' => 'rselfmenu_2_0'
     	      ),
      	    ),
      	);
        //$a = $weixinObj->createMenu($arr);
        $a = $weixinObj->getMenu();
        p($a);
    }

    //更新用户的微信绑定情况
    public function updateUserWeixin($openid,$user_id)
    {
        $weixinObj = new \Lib\Util\Wx($this->config);
        $user_info = M('user')->where(array('id'=>$user_id))->find();
        //@file_put_contents(ROOT_PATH.'public/log/weixin_event.txt',var_export(array($user_info,'获取用户信息'),true)."\r\n",FILE_APPEND);
        if(!$user_info['weixin_openid'] or !$user_info['weixin_unionid'])
        {
            $wx_info = $weixinObj->getUserInfo($openid);
            $data = array(
                'weixin_openid'   => $openid,
                'weixin_unionid'  => isset($wx_info['unionid'])?$wx_info['unionid']:'',
                'weixin_username' => htmlspecialchars($wx_info['nickname']),
                'logo'            => $wx_info['headimgurl'],
            );
            M('user')->where(array('id'=>$user_id))->data($data)->save();
        }
        return true;
    }

    //生成微信带参数的二维码
    public function weixinErweima()
    {
        header("Content-type: text/html; charset=utf-8");
        $user_id  = session(C('USER_AUTH_UID'));
        if(!$user_id) exit('user_id缺失');
        $weixinObj = new \Lib\Util\Wx($this->config);

        $getQRCode = $weixinObj->getQRCode($user_id);//参数1：二维码携带参数=====参数2：临时或者永久二维码

        $ticket = $getQRCode['ticket'];
        $code_url = $weixinObj->getQRUrl($ticket);
        echo @file_get_contents($code_url);
    }




}