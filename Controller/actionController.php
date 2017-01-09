<?php
/**
 * Created by PhpStorm.
 * User: 少华
 * Date: 2017/1/6
 * Time: 21:11
 */
require $_DIR_ROOT.'Model/actionModel.php';
class actionController {
    public function addFriends($reqDatas) {
        $uModel = new actionModel();
        $uModel->addFriends($reqDatas);
    }
    public function addLove($reqDatas) {
        $uModel = new actionModel();
        $uModel->addLove($reqDatas);
    }
    public function showFriends($reqDatas) {
        $uModel = new actionModel();
        $uModel->showFriends($reqDatas);
    }
} 