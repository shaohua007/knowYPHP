<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-03
 * Time: 9:17
 */
//header('content-type:application/json;charset=utf8');
$_DIR_ROOT = $_SERVER['DOCUMENT_ROOT'].'/knowYPHP/';
//header("Location:Api/userApi.php");
require $_DIR_ROOT.'Api/userApi.php';
$userApi = new userApi();
$userApi->index();