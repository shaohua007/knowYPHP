<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:03
 */
require $_DIR_ROOT.'db/conn.php';

class userModel
{
    public function reg($uname='',$password='') {
        $connection = new conn();
        $mysqli = $connection->index();
        $sql = "select uname from single_dog_users where uname=$uname";
        $res = mysqli_query($mysqli,$sql);
        if(!$res) {
            $sql01 = "insert into single_dog_users values ('$uname','$password')";
            $res01 = mysqli_query($mysqli, $sql01);
            echo json_encode($res01 ? 200: 201);
        }else {
            echo json_encode(202);//表示用户名已存在
        }
        @mysqli_close($mysqli);
    }
    public function login($uname='',$password='') {
        $connection = new conn();
        $mysqli = $connection->index();
        $sql01 = "select '$uname' from single_dog_users";
        $res01 = mysqli_query($mysqli, $sql01);
        if($res01){
            $sql02 = "select password from single_dog_users where uname='$uname'";
            $res02 = mysqli_query($mysqli, $sql02);
            echo json_encode($password == $res02 ? 200:201);//201 密码错误
        }else{
            echo json_encode(202);//202 用户名不存在
        }
        mysqli_close($mysqli);
    }
}