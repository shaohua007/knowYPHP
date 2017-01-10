<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:13
 */
require $_DIR_ROOT.'Controller/userController.php';
require $_DIR_ROOT.'Controller/actionController.php';
require $_DIR_ROOT.'Comment/comment.php';

class userApi
{
    public function index() {
//        var_dump(json_decode(file_get_contents('php://input'),true));
        $tmp = $_POST;
        $reqDatas = $tmp['datas'];
        $type = $tmp['type'];
        switch ($type){
            case 'reg':
                $uname = $reqDatas['uname'];
                $password = $reqDatas['password'];
                $userCtr = new userController();
                $userCtr->reg($uname, $password);
                break;
            case 'login':
                $uname = $reqDatas['uname'];
                $password = $reqDatas['password'];
                $userCtr = new userController();
                $userCtr->login($uname, $password);
                break;
            case 'addDogInfo':
                $userCtr =new userController();
                $userCtr->addInfo($reqDatas);
                break;
            case 'showDogInfo':
                $userCtr = new userController();
                $userCtr->showInfo($reqDatas);
                break;
            case 'addFriends':
                $actionCtr = new actionController();
                $actionCtr->addFriends($reqDatas);
                break;
            case 'addLove':
                $actionCtr = new actionController();
                $actionCtr->addLove($reqDatas);
                break;
            case 'showFriends':
                $actionCtr = new actionController();
                $actionCtr->showFriends($reqDatas);
                break;
            case 'showLove':
                $actionCtr = new actionController();
                $actionCtr->showLove($reqDatas);
                break;
            case 'show_fof': //显示半熟人（朋友的第一级朋友）
                $actionCtr = new actionController();
                $actionCtr->show_fof($reqDatas);
                break;
            default:
                exit('请检查接口后请重试！');
        }
    }
}