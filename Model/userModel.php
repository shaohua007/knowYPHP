<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:03
 */
require '../db/conn.php';

class userModel
{
    public function reg($uname='',$pwd='') {
        $connection = new conn();
        $mysqli = $connection->conn();
        $sql = "select uname from single_dog_users where username=.$uname";
        $res = mysqli_query($mysqli, $sql);
        if(!$res) {
            $sql = "insert into single_dog_users values ($uname,$pwd)";
            $res = mysqli_query($mysqli, $sql);
            echo json_encode($res ? '200':'201');
        }else {
            echo json_encode('202');//表示用户名已存在
        }
        mysqli_close($mysqli);
    }
    public function login($uname='',$pwd='') {
        $connection = new conn();
        $mysqli = $connection->conn();
        $sql = "select uname from single_dog_users where username=.$uname";
        $res = mysqli_query($mysqli, $sql);
        if(!$res) {
            echo json_encode($res ? '200':'201');
        }else {
            echo json_encode('202');//表示用户名已存在
        }
        mysqli_close($mysqli);
    }
}