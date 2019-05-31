<?php


namespace Home\Model;
use Think\Model\ViewModel;
class MessageViewModel extends ViewModel
{
    public $viewFields = array(
        'message' => array('message_id', 'content', 'created_at'),
        'user' => array('user_id', 'username', '_on' => 'User.user_id=Message.user_id')
    );
    //user表和message表
}