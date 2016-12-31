<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 17:27
 */

namespace db;


class conn
{
    public function conn() {
        $mysql_server_name='web.h50.023b.com'; //mysql数据库服务器
        $mysql_username='a0628143145'; //mysql数据库用户名
        $mysql_password='2739994'; //mysql数据库密码
        $mysql_database='a0628143145'; //mysql数据库名
        $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);//连接数据库
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            $mysqli->close();
            exit();
        }
    }
}