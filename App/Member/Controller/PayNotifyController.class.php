<?php
namespace Member\Controller;
use Think\Controller;
use Lib\Pay\Wxpay\WxPayConfig;
use Lib\Pay\Wxpay\WxPayApi;
use Lib\Pay\Wxpay\NativePay;
use Lib\Pay\Wxpay\WxLib\WxPayUnifiedOrder;
use Lib\Pay\Alipay\Web\AlipayTradeService;
// use Lib\Pay\Alipay\Web\Buildermodel\AlipayTradePagePayContentBuilder;

//在线支付 回调结果处理控制器
class PayNotifyController extends Controller {

    //充值学习币--支付宝充值结果处理
    public function alipaySuccess(){

        if(IS_POST){

            $db = M('order_pay');
            $arr = $_POST;
            $config = C('ALIPAY_PAY_CONFIG');
            @file_put_contents("./alipay_pc_log.txt", var_export($arr, true) . "\r\n", FILE_APPEND); //写入日记

            $alipaySevice = new AlipayTradeService($config); 
            $result = $alipaySevice->check($arr);

            $order = $db->where(array('trade_no' => trim($arr['out_trade_no']), 'status' => array('NEQ',2), 'pay_type' => 1))->find();
            $data = array(
                'order_no' => trim($arr['trade_no']),
                'buyer_pay_money' => trim($arr['buyer_pay_amount']),
                'status' => 2,
                'pay_time' => $arr['gmt_payment'] ? strtotime($arr['gmt_payment']) : time()
                );

            if($result && $arr['trade_status'] == 'TRADE_SUCCESS' && $order) { //验证成功
                
                $db->where(array('trade_no' => trim($arr['out_trade_no']), 'status' => array('NEQ',2), 'id' => $order['id']))->save($data);
                M('user')->where(array('id' => $order['user_id']))->setInc('currency',floatval($order['currency']));
                //写入佣金提成
                $this->addUserBrokerage($order, $data['buyer_pay_money']);
      
            }else{

                $data['status'] = 1; //验证失败
                $db->where(array('trade_no' => trim($arr['out_trade_no']), 'status' => array('NEQ',2)))->save($data);
            }
            
        }else{
            _404();
        }

    }


    //充值学习币--微信充值结果处理
    public function weixinSuccess(){
        $db = M('order_pay');
        $wx_str = trim(file_get_contents("php://input"));
        $arr = (array) simplexml_load_string($wx_str, 'SimpleXMLElement', LIBXML_NOCDATA); //转换成数组
        @file_put_contents("./weixin_pc_log.txt", var_export($arr, true) . "\r\n", FILE_APPEND);

        $order = $db->where(array('trade_no' => trim($arr['out_trade_no']), 'status' => array('NEQ',2), 'pay_type' => 2))->find();
        $data = array(
            'order_no' => trim($arr['transaction_id']),
            'buyer_pay_money' => floatval($arr['total_fee']/100),
            'status' => 2,
            'pay_time' => time()
            );

        if ((trim($arr['result_code']) == 'SUCCESS')  &&  (trim($arr['return_code']) == 'SUCCESS') && $order) { //验证成功

            $db->where(array('trade_no' => trim($arr['out_trade_no']), 'status' => array('NEQ',2), 'id' => $order['id']))->save($data);
            M('user')->where(array('id' => $order['user_id']))->setInc('currency',floatval($order['currency']));
            //写入佣金提成
            $this->addUserBrokerage($order, $data['buyer_pay_money']);

            echo $this->strToXml('SUCCESS', 'OK');

        }else{

            $data['status'] = 1; //验证失败
            $db->where(array('trade_no' => trim($arr['out_trade_no']), 'status' => array('NEQ',2)))->save($data);
            echo $this->strToXml('FAIL', '付款失败！如有疑问请联系客服！');
        }

    }

    protected function strToXml($return_code, $return_msg) {

        header('Content-type: text/xml');
        $xml = "<xml>";
        $xml.="<return_code><![CDATA[{$return_code}]]></return_code>";
        $xml.="<return_msg><![CDATA[{$return_msg}]]></return_msg>";
        $xml.="</xml>";

        return $xml;
    }

    //写入佣金提成
    protected function addUserBrokerage($order, $buyer_pay_money=0) {
        
        $y_user_id = M('user')->where(array('id' => $order['user_id']))->getField('y_user_id');
        $groupInfo = getUserGroup($y_user_id);
        $brokerage = floatval(getConfig('brokerage'));
        if ($groupInfo['group_id'] && $groupInfo['group_name'] != '试听用户') {
            
            $y_user_brokerage = floatval(floatval($order['currency']) * $brokerage)/100+2;
            if ($brokerage && $y_user_brokerage >= 0.01) {
                $arr_brokerage = array(
                    'user_id_son' => $y_user_id,
                    'user_id' => $order['user_id'],
                    'type' => 0,
                    'type_id' => $order['id'],
                    'type_money' => $buyer_pay_money,
                    'type_unit' => $brokerage,
                    'amount' => $y_user_brokerage,
                    'ratify_status' => 0,
                    'addtime' => time()
                );
                M('user_brokerage')->add($arr_brokerage);
            }

        }

    }

    //充值学习币--充值返回 显示结果
    public function payCallbackReturn() {

        $db = M('order_pay');
        $uid = session(C('USER_AUTH_UID'));
        $trade_no = I('get.out_trade_no','','trim');
        $this->arr = $db->where(array('trade_no' => $trade_no, 'user_id' => $uid))->find(); //查询订单
        $this->display('Pay/paySuccess');
        
    }

    //充值学习币--获取充值结果
    public function getPayStatus() {

        $db = M('order_pay');
        $uid = session(C('USER_AUTH_UID'));
        $trade_no = I('get.out_trade_no','','trim');

        $arr = $db->where(array('trade_no' => $trade_no, 'user_id' => $uid))->find(); //查询订单

        if (!$arr || !$trade_no) {
            $this->ajaxReturn(array('status' => 3, 'info' => '未知错误，请稍后重试'), 'json');
        }else{
            $this->ajaxReturn(array('status' => $arr['status'], 'info' => '操作完成'), 'json');
        }

        
    }


}