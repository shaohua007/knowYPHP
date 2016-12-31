<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:03
 */

namespace Model;
use db\conn;

require '../db/conn.php';

class userModel
{
    public function reg($uname='',$pwd='') {
        $connection = new conn();
        $mysqli = $connection->conn();
        $sql = 'select uname from single_dog_users where username='.$uname;
        $res = mysqli_query($mysqli, $sql);
    }
}