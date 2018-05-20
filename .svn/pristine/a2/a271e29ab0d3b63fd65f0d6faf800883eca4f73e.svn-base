<?php
namespace Admin\Model;
use Think\Model\ViewModel;

//用户与用户组视图模型
Class QuestionViewModel extends ViewModel {

    public $viewFields = array(
        'video_question'=>array('user_id', 'count(user_id)' => 'num','_type' => 'LEFT'),
        'user' => array('username', '_on'=>'video_question.user_id=user.id')
    );
    
}

