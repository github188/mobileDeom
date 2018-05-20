<?php
namespace Member\Model;
use Think\Model\RelationModel;

//用户与用户组关联模型
Class UserRelationModel extends RelationModel {
	//定义主表名称
	protected $tableName = 'user';

    //定义一对多关联模型
    protected $_link = array(
		'user_group' => array(
			'mapping_type' => self::MANY_TO_MANY,  //多对多关系
			'foreign_key' => 'user_id',   //主表在中间表字段名称
			'relation_foreign_key' => 'group_id',  //副表在中间表字段名称
			'relation_table' => 'ht_user_group_ext',  //中间表名称
			'mapping_name'=>'group_name', //关联的映射名称
			'mapping_order'=>'',//排序
			// 'as_fields' => 'name:name',
			'mapping_fields' => ''
			)
    	);
	}

