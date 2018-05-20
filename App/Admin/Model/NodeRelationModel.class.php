<?php
namespace Admin\Model;
use Think\Model\RelationModel;

    //节点与导航关联模型
  Class NodeRelationModel extends RelationModel {
    //定义主表名称
    protected $tableName = 'node';

    //定义一对一关联模型
    protected $_link = array(
        'menu' =>array(
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'menu_id',
            'mapping_fields'=>'title',
            'mapping_name'=>'menu'
        )
    );
 }

