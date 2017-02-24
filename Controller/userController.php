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
    public function reg($uname,$password){
        $uModel = new userModel();
        $uModel->reg($uname,$password);
    }
    public function login($uname,$password){
        $uModel = new userModel();
        $uModel->login($uname,$password);
    }
    public function addInfo($reqDatas){
        $uModel = new userModel();
        $uModel->addInfo($reqDatas);
    }
    public function showInfo($reqDatas) {
        $uModel = new userModel();
        $uModel->showInfo($reqDatas);
    }
    public function upPic($myPic,$reqDatas) {
        $uModel = new userModel();
        $pathArr = array();
        foreach( $myPic as $key => $pic ) {
            //判断是否上传成功（是否使用post方式上传）
            if(is_uploaded_file($pic['tmp_name'])) {
                //把文件转存到你希望的目录（不要使用copy函数）
                $uploaded_file=$pic['tmp_name'];
                //我们给每个用户动态的创建一个文件夹
                $user_path=$_SERVER['DOCUMENT_ROOT']."/knowYPHP/upload/upPic/".$reqDatas['uid'];
                //判断该用户文件夹是否已经有这个文件夹
                if(!file_exists($user_path)) {
                    mkdir($user_path);
                }
                //$move_to_file=$user_path."/".$_FILES['myfile']['name'];
                $file_true_name=$pic['name'];
                $move_to_file=$user_path."/".$file_true_name;
//                $move_to_file=$user_path."/".time().rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));
                $pathArr[$key] = 'http://shaohua.h50.023b.com/knowYPHP/upload/upPic/'.$reqDatas['uid'].'/'.$file_true_name;
                //echo "$uploaded_file   $move_to_file";
                if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {
//                    echo $pic['name']."上传成功;";
                } else {
//                    echo "上传失败;";
                }
            } else {
//                $pathArr[$key] = '666';
            }
//            echo json_encode($part);
//            $uModel->upPic($pic);
        }
        $uModel->upPic($pathArr,$reqDatas,$myPic);
    }

}