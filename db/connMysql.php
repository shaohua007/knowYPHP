<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-7
 * Time: 15:14
 */

class connMysql
{
    public function index() {
        $mysql_server_name='web.h55.023b.com'; //mysql数据库服务器
        $mysql_username='a0628143145'; //mysql数据库用户名
        $mysql_password='a2739994'; //mysql数据库密码
        $mysql_database='a0628143145'; //mysql数据库名
        $mysql = @mysql_connect($mysql_server_name, $mysql_username, $mysql_password);//连接数据库
        @mysql_query($mysql,"set names utf8");
        if (!$mysql) {
            die('Connect Error (' . mysql_error() . ') ');
            mysql_close($mysql);
        }
        return $mysql;
    }
}