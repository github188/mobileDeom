<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 数据库备份控制器
*/
class DataController extends CommonController {

  public function _initialize () {
    ini_set('memory_limit', '1024M');
    set_time_limit(180); 
  }


    public function index(){

      $dbName=C('DB_NAME');
      $this->rem = M()->query('SHOW TABLE STATUS FROM '.$dbName);

      $this->display();
    }

    //执行备份
    public function back(){
      
      if (IS_POST) {
          if(!I('post.myBack')) {
            $table=$this->getTable();
          }else{
            $table=I('post.myBack');
          }
            $sqls=$this->bakStruct($table);
            $dir="./Data/backup/".date("Y-m-d__His")."-".mt_rand(1500,3000).".sql";
            file_put_contents($dir,$sqls);
            if(file_exists($dir)){

            $this->success('备份数据库成功！请在Data目录里自行下载文件!' ,U(MODULE_NAME.'/Data/index'),5);
          }else{
            $this->error('备份数据库失败!');
          }
      }


    }

     
    protected function getTable(){

      $dbName=C('DB_NAME');
      $result=M()->query('show tables from '.$dbName);

      foreach ($result as $v){
        $tbArray[]=$v['tables_in_'.C('DB_NAME')];
      }
      return $tbArray;

    }

     //备份数据库
    protected function bakStruct($array){

        $sess = C('DB_PREFIX').'session';
      
        foreach ($array as $v){
          $tbName=$v;

          //备份数据表结构
          $result=M()->query('show create table '.$tbName);
          $sql.="\r\n\r\n-- ------------\r\n";
          $sql.="-- 数据表结构: `$tbName`\r\n";
          $sql.="-- ------------\r\n\r\n";
          $sql.="DROP TABLE IF EXISTS `$tbName`;\r\n";
              
          foreach ($result as $k=>$v){
            $sql.= $v['create table'].";\r\n\r\n";
             
          }

          //备份数据表中的数据
          $rs=M()->query('select * from '.$tbName);
          if(count($rs)<=0){
          continue;
          }
          $sql.="-- ------------\r\n";
          $sql.="-- 数据表中的数据: `$tbName`\r\n";
          $sql.="-- ------------\r\n\r\n";


          if ($tbName != $sess) {

            foreach ($rs as $k=>$v){

              $sql.="INSERT INTO `$tbName` VALUES (";

              foreach ($v as $key=>$value){

                if($value==''){
                  $value='null';
                }

                  // $type=gettype($value);
                  if($value != 'null'){
                    $value="'".addslashes($value)."'";
                  }else{
                    $value=addslashes($value);
                  }
                

                $sql.="$value," ;

              }
              $sql.=");\r\n\r\n";
            }

          }

        }
        return str_replace(',)',')',$sql); //返回备份结构和数据
    }

     
    //优化修复数据库
    public function click(){

        $do = I('get.do','');
        $table = I('get.name','');

        switch($do){
        case optimize://优化
          $rs =M()->Query("OPTIMIZE TABLE `$table` ");
        if($rs){
          $this->success('执行优化表: '.$table.' 成功 OK!' ,U(MODULE_NAME.'/Data/index'));
        }else{
          $this->error('执行优化表失败: '.$table.' 原因是: '.M()->GetError());
        }

        break;
        case repair://修复
        $rs = M()->Query("REPAIR TABLE `$table` ");

        if($rs){
          $this->success('执行修复表: '.$table.' 成功 OK!' ,U(MODULE_NAME.'/Data/index'));
        }else{
          $this->error('执行修复表失败: '.$table.' 原因是: '.M()->GetError());
        }

        break;
        default://结构
        $dsql=M()->Query("SHOW CREATE TABLE ".$table);
          foreach($dsql as $k=>$v){
            foreach($v as $k1=>$v1){
              $rs=$v1;
            }

          }

          $this->success(''.$table.' 表的结构:<br/><br/> '.trim($rs),U(MODULE_NAME.'/Data/index'),15);
        }

    }
}