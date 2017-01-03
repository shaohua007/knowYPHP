<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 17:27
 */

class conn
{
    public function index() {
        $mysql_server_name='web.h55.023b.com'; //mysql数据库服务器
        $mysql_username='a0628143145'; //mysql数据库用户名
        $mysql_password='a2739994'; //mysql数据库密码
        $mysql_database='a0628143145'; //mysql数据库名
        $mysqli = @mysqli_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);//连接数据库
        @mysqli_query($mysqli,"set names utf8");
        if (!$mysqli) {
            die('Connect Error (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
            mysqli_close($mysqli);
        }
        return $mysqli;
    }
}