<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:13
 */
require '../Controller/userController.php';
require '../Comment/comment.php';

class userApi
{
    public function index() {
        $lib_replace_end_tag = new comment();
        $type = $lib_replace_end_tag->lib_replace_end_tag(trim('reg <>'));
        $uname = $lib_replace_end_tag->lib_replace_end_tag(trim('少华0 1 '));
        $password = md5('123123');
        switch ($type){
            case 'reg':
                $userCtr = new userController();
                $userCtr->reg($uname, $password);
                break;
            case 'login':
                $userCtr = new userController();
                $userCtr->login($uname, $password);
                break;
            default:
                exit(json_encode('注册失败，请重试'));
        }
    }
}