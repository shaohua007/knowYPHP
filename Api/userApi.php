<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:13
 */
require $_DIR_ROOT.'Controller/userController.php';
require $_DIR_ROOT.'Comment/comment.php';

class userApi
{
    public function index() {
        $reqDatas = $_POST['json_datas'];
        $type = $_POST['type'];
        var_dump($type);
        switch ($type){
            case 'reg':
                $uname = trim('少华06');
                $password = md5('123123');
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
//                $reqDatas = $_POST['datas'];
                echo $reqDatas;
//                $userCtr = new userController();
//                $userCtr->addInfo($reqDatas);
                break;
            case 'editDogInfo':
                $userCtr = new userController();
                $userCtr->editInfo($uname, $password);
                break;
            case 'showDogInfo':
                $userCtr = new userController();
                $userCtr->showInfo($uname, $password);
                break;
            case 'addFriends':
                $userCtr = new userController();
                $userCtr->addFriends($uname, $password);
                break;
            case 'showFriends':
                $userCtr = new userController();
                $userCtr->showFriends($uname, $password);
                break;
            default:
                exit(json_encode('请检查接口后请重试！'));
        }
    }
}