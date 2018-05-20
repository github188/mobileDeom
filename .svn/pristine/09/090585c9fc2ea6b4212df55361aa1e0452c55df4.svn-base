<?php
namespace Admin\Model;
use Think\Model\RelationModel;

//管理员与角色关联模型
Class ManageRelationModel extends RelationModel {

	//定义主表名称
	Protected $tableName = 'manage';

	//定义关联关系
	Protected $_link = array(
		'role' => array(
			'mapping_type' => self::MANY_TO_MANY,  //多对多关系
			'foreign_key' => 'user_id',   //主表在中间表字段名称
			'relation_foreign_key' => 'role_id',  //副表在中间表字段名称
			'relation_table' => 'ht_role_user',  //中间表名称
			'mapping_fields' => 'id, name, remark'
			)
		);
}