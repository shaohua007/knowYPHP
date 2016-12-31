<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:02
 */

namespace Controller;
use Model\userModel;

require '../Model/userModel.php';

class userController
{
    public function reg($uname='',$pwd=''){
        $uModel = new userModel();
        $uModel->reg($uname,$pwd);
    }
}