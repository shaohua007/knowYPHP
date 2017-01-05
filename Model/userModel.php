<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:03
 */
require $_DIR_ROOT.'db/conn.php';
require $_DIR_ROOT.'DataModel/dogInfo.php';

class userModel
{
    public function reg($uname,$password) {
        $connection = new conn();
        $mysqli = $connection->index();
        $sql = "select * from single_dog_users where uname='$uname'";
//        $res = mysqli_query($mysqli,$sql);
        $res = mysqli_num_rows(mysqli_query($mysqli,$sql));
        $params = array();
        if(!$res) {
            $sql01 = "insert into single_dog_users values ('$uname','$password')";
            $sql02 = "insert into single_dog_info (uname) values ('$uname')";
            $res01 = mysqli_query($mysqli, $sql01);
            $res02 = mysqli_query($mysqli, $sql02);
//            $status = $res01&&$res02 ? 200: 201;
            if($res01&&$res02){
                $params['status'] = 200;
                $params['datas'] = '登录成功';
            }else{
                $params['status'] = 201;
                $params['datas'] = '登录失败';
            }
            echo json_encode($params);
        }else {
            $params['status']= 202;
            $params['datas']= '用户名已存在';
            echo json_encode($params);//表示用户名已存在
        }
        mysqli_close($mysqli);
    }
    public function login($uname,$password) {
        $connection = new conn();
        $mysqli = $connection->index();
        $sql01 = "select * from single_dog_users where uname='$uname'";
        $res01 = mysqli_query($mysqli, $sql01);
        $params = array();
        if($res01){
            $sql02 = "select password from single_dog_users where uname='$uname'";
            $res02 = mysqli_fetch_assoc(mysqli_query($mysqli, $sql02));
            if($password == $res02['password']){
                $sql03 = "select uid from single_dog_info where uname='$uname'";
//                $uid = mysqli_query($mysqli, $sql03);
                $uid = mysqli_fetch_assoc(mysqli_query($mysqli, $sql03));
//                var_dump(mysqli_query($mysqli, $sql03));
                $params['status'] = 200;
                $params['uid'] = $uid['uid'];
                echo json_encode($params);
            }else{
                $params['status'] = 201;
                $params['datas'] = '密码错误';
                echo json_encode($params);
            }
        }else{
            $params['status']=202;
            $params['datas']='';
            echo json_encode($params);//202 用户名不存在
        }
        mysqli_close($mysqli);
    }
    public function addInfo($reqDatas) {
//        var_dump($reqDatas);
        $connection = new conn();
        $mysqli = $connection->index();
        $dogInfo = new dogInfo(); //实例化数据模型
        foreach($reqDatas as $_key => $_value){
            switch($_key){
                case 'uid':  $dogInfo->uid = $_value;break;
                case 'sex':  $dogInfo->sex = $_value;break;
                case 'age':  $dogInfo->age = $_value;break;
                case 'edu':  $dogInfo->edu = $_value; break;
                case 'addr':  $dogInfo->addr = $_value;break;
                case 'sports':  $dogInfo->sports = $_value;break;
                case 'reading':  $dogInfo->reading = $_value;break;
                case 'daily':  $dogInfo->daily = $_value;break;
                default: exit('接口参数有误');
            }
        }
//        var_dump($dogInfo->edu);
//        $uid = $reqDatas[0];
//        $sex = $reqDatas['sex'];
//        $age = $reqDatas['age'];
//        $edu = $reqDatas['edu'];
//        var_dump($edu);
//        $addr = $reqDatas['addr'];
//        $sports = $reqDatas['sports'];
//        $reading = $reqDatas['reading'];
//        $daily = $reqDatas['daily'];
        $sql01 = "update single_dog_info set sex='$dogInfo->uid',age='$dogInfo->age',edu='$dogInfo->edu',addr='$dogInfo->addr',sports='$dogInfo->sports',reading='$dogInfo->reading',daily='$dogInfo->daily'  where uid = '$dogInfo->uid'";
        $res = mysqli_query($mysqli,$sql01);
        if($res){
            $params['status'] = 200;
            $params['datas'] = '更新成功';
            echo json_encode($params);
        }else{
            $params['status'] = 201;
            $params['datas'] = '更新失败';
            echo json_encode($params);
        }
        mysqli_close($mysqli);
    }
}