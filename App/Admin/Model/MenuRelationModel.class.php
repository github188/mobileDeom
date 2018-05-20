<?php
namespace Admin\Model;
use Think\Model\RelationModel;

    //导航与节点关联模型
  Class MenuRelationModel extends RelationModel {
    //定义主表名称
    protected $tableName = 'menu';

    //定义一对多关联模型
    protected $_link = array(
        'node' =>array(
            'mapping_type'=>self::HAS_MANY,
            'foreign_key'=>'menu_id',
            'condition'=> 'status=1 AND menu_status=1',
            'mapping_order' => 'sort',
            'mapping_fields'=>'id,name,title,pid,level,menu_id,sort,url',
            'mapping_name'=>'menu'
        )
    );
 }

