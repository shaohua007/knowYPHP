<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:02
 */

require $_DIR_ROOT.'Model/userModel.php';

class userController
{
    public function reg($uname='',$password=''){
        $uModel = new userModel();
        $uModel->reg($uname,$password);
    }
    public function login($uname='',$password=''){
        $uModel = new userModel();
        $uModel->login($uname,$password);
    }
}