<?php
namespace Admin\Model;
use Think\Model\ViewModel;

//用户组扩展与用户组视图模型
Class UserGroupViewModel extends ViewModel {

    public $viewFields = array(
        'user_group_ext'=>array('user_id', 'group_id', 'start_time', 'end_time', '_type' => 'LEFT'),
        'user_group' => array('name' =>'group_name', '_on'=>'user_group_ext.group_id=user_group.id')
    );
    
}

