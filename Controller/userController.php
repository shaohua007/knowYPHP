<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:02
 */

require '../Model/userModel.php';

class userController
{
    public function reg($uname='',$pwd=''){
        $uModel = new userModel();
        $uModel->reg($uname,$pwd);
    }
    public function login($uname='',$pwd=''){
        $uModel = new userModel();
        $uModel->login($uname,$pwd);
    }
}