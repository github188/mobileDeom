<?php
namespace Admin\Model;
use Think\Model\ViewModel;

//用户与用户组视图模型
Class UserViewModel extends ViewModel {

    public $viewFields = array(
        'user'=>array('*', 'id' =>'user_id','_type' => 'INNER'),
        'user_group_ext'=>array('*','id' =>'user_group_ext_id', '_on'=>'user.id=user_group_ext.user_id', '_type' => 'INNER'),
        'user_group' => array('*','id' =>'user_group_id','name' =>'group_name', '_on'=>'user_group_ext.group_id=user_group.id')
    );
    
}

