<?php
namespace Admin\Controller;
use Think\Controller;

//后台首页控制器
class IndexController extends CommonController {

    public function index(){
        $uid = session(C('USER_AUTH_KEY'));
        if (session(C('ADMIN_AUTH_KEY'))) {
            $role_remark = '超级管理员';
        }else{
            $role_id = D('RoleUser')->where('user_id='.$uid)->getField('role_id');
            $role_remark = D('Role')->where('id='.$role_id)->getField('remark');
        }

        $this->assign('role_remark',$role_remark);
    	$this->assign('left',$this->menuLeft());
    	$this->display();
	}

    //导航菜单处理
    protected function menuLeft () {

        //读取并组合所有导航与节点权限
        $where = array('status' => 1);
        $field = array('id','name','title','pid','menu_id','menu_status');
        $left =  D('MenuRelation')->where($where)->relation(true)->order('sort')->select();
        $cate = M('node')->field($field)->select();

        foreach ($left as $key => $value) {
            foreach ($left[$key]['menu'] as $k => $v) {
                $cids = self::getParents($cate, $v['id']);
                $left[$key]['menu'][$k]['left'] = $cids;
            } 
        }


        //判断是否是超级管理员，如果是即加载显示全部导航菜单
        if (!session(C('ADMIN_AUTH_KEY'))) {

            //取出当前登陆用户的所有操作权限
            $accessList = session('_ACCESS_LIST');
            
            foreach ($accessList as $key => $value) {
                foreach ($value as $key1 => $value1) {

                    $controller = ','.$key1;
                    foreach ($value1 as $key => $v) {
                        $action_id = $action_id.$v.',';
                    }
                }
            }

            //去除没有权限的节点
            foreach ($left as $ko => $vo) {
                foreach ($left[$ko]['menu'] as $key => $v) {
                    $valuek = strtoupper($v['name']);
                    if (!in_array($v['id'], explode(',', $action_id))) {

                        if ($left[$ko]['menu'][$key]['level'] == 3) {
                            unset($left[$ko]['menu'][$key]);

                        }elseif ($left[$ko]['menu'][$key]['level'] == 2) {

                            if (!in_array($valuek, explode(',', $controller))) {
                                unset($left[$ko]['menu'][$key]);
                            }

                        }else{
                            unset($left[$ko]['menu'][$key]);
                        }
                        

                    }
                }
            }

            foreach ($left as $key => $value) {
                if (!$value['menu']) {
                    unset($left[$key]);
                }
            }
            
        }

        return $left; 

    }

    //传递一个子分类ID 返回所有父级分类
    static public function getParents ($cate, $id) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['id'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v['pid']), $arr);
            }
        }
        return $arr;
    }


    //一键清除缓存
    public function allrun() {

        if(IS_POST){
            $file_name = I('post.type','');
            //清除文件缓存
            foreach($file_name as $v) {
                //得到文件的绝对路径  
                $abs_dir=dirname(dirname(dirname(dirname(__FILE__))));
                $dirs = $abs_dir.RUNTIME_PATH.$v;
                @mkdir(RUNTIME_PATH,0777,true);
                rmdirr($dirs);
            }

            $this->success('清除缓存完成!' ,U(MODULE_NAME.'/Index/allrun'));
        }else{
            $this->display();
        }
    }

    public function welcome () {

        if(function_exists("gd_info")){
            $gd = gd_info();
            $gdinfo = $gd['GD Version'];
        }else {
            $gdinfo = "未知";
        }
        $free = @disk_free_space(".");
        $total = @disk_total_space(".");
        $Model = new \Think\Model(); 
        $myInfo = $Model->query("select VERSION()");

        $info = array(
            '操作系统：' => PHP_OS,
            '运行环境：' => $_SERVER["SERVER_SOFTWARE"],
            '服务器运行方式：' => php_sapi_name(),
            'PHP版本：' => PHP_VERSION,
            'MYSQL版本：' => $myInfo[0]['version()'],
            '程序版本：' => 'V'.C('HITUI_VERSION'),
            '域名/服务器IP：' => $_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '服务器时间：' => date("Y年n月j日 H:i:s"),
            '总/可用/已用磁盘空间：' => admin_formatsize($total).' / '.admin_formatsize($free).' / '.admin_formatsize($total-$free),
            '北京时间：' => gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '上传附件限制：' => ini_get('upload_max_filesize'),
            'POST数据限制：' => ini_get('post_max_size'),
            '表单数量限制：' => ini_get('max_input_vars').'个',
            '内存消耗限制：' => ini_get('memory_limit'),
            '执行时间限制：' => ini_get('max_execution_time').'秒',
            '安全模式：' => (boolean) ini_get('safe_mode') ? '是' : '否',
            'GD库版本：' => $gdinfo,
            'Zlib支持：' => function_exists('gzclose') ? '是' : '否',
            'Curl支持：' => function_exists('curl_init') ? '是' : '否',
            '注册全局变量：' => get_cfg_var("register_globals")=="1" ? "是" : "否"
            );
        $this->assign('info',$info);

        $this->user = M('user')->count(); //统计用户总数
        $this->article = M('article')->count(); //统计文章总数
        $this->video = M('video')->count(); //统计视频总数
        $this->display();
    }


}