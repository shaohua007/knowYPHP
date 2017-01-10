<?php
/**
 * Created by PhpStorm.
 * User: 少华
 * Date: 2017/1/6
 * Time: 21:10
 */
//require $_DIR_ROOT.'db/conn.php';
require $_DIR_ROOT.'DataModel/resDataModel.php';

class actionModel {
    public function addFriends($reqDatas) {
        $connection = new conn();
        $mysqli = $connection->index();
        $params = array();
        $resDataModel = new resDataModel();
        $resData = $resDataModel->resJson;
//        $params['status'] = 202;
        $dog1 = $reqDatas['dog1'];
        $dog2 = $reqDatas['dog2'];
        try {
            $res = mysqli_query($mysqli,"select * from dog_request where dog_req01 = '$dog2' and dog_req02 = '$dog1' and f_tag = 0");
            $res01 = mysqli_query($mysqli,"select * from dog_request where dog_req01 = '$dog1' and dog_req02 = '$dog2'");
            $res02 = mysqli_query($mysqli,"select * from dog_request where dog_req01 = '$dog2' and dog_req02 = '$dog1' and f_tag = 1");
            //如果之前没被对方申请则新建一条记录，如果已申请则标记为好友；
            if($res && $res01){
                if(mysqli_num_rows($res01)) {
                    $resData['status'] = 201;
                    $resData['datas'] = array('朋友申请数据已存在');
                    echo json_encode($resData);
                }else if(mysqli_num_rows($res)){
                    //当对方也申请且f_tag好友标记为0时加入通知数据更新f_tag；
                    $sql03 = "update dog_request set f_tag = 1 where dog_req01 = '$dog2' and dog_req02 = '$dog1';";
                    $sql03 .= "insert into dog_vs_dog (dog1, dog2) values ('$dog1','$dog2'),('$dog2','$dog1');";
                    $sql03 .= "insert into dog_notice (uname, notice) values ('$dog1', '您与{$dog2}已成为好友'),('$dog2', '您与{$dog1}已成为好友')";
//                    var_dump(@mysqli_multi_query($mysqli, $sql03));
                    if(mysqli_multi_query($mysqli, $sql03)) {
                        $resData['status'] = 200;
                        $resData['datas'] = array('插入朋友标记跟通知数据成功');
                        echo json_encode($resData);
                    }else {
                        $resData['status'] = 202;
                        $resData['datas'] = array('插入朋友标记跟通知数据失败');
                        echo json_encode($resData);
                    }
                }else if(!mysqli_num_rows($res02)){
                    $query = @mysqli_query($mysqli, "insert into dog_request (dog_req01, dog_req02) values ('$dog1','$dog2')");
                    if($query) {
                        $resData['status'] = 200;
                        $resData['datas'] = array('插入朋友申请数据成功');
                        echo json_encode($resData);
                    }
                }else {
                    $resData['status'] = 201;
                    $resData['datas'] = array('朋友申请数据已存在');
                    echo json_encode($resData);
                }
//                $res01 = mysqli_query($mysqli,"select * from dog_request where dog_req01 = '$dog1' and dog_req02 = '$dog2'");

            }
        }catch(Exception $e) {
            $resData['status'] = 500;//服务器运行错误
            $resData['datas'] = array($e->getMessage());
            echo json_encode($resData);
        }
        mysqli_close($mysqli);
    }
    public function addLove($reqDatas) {
        $connection = new conn();
        $mysqli = $connection->index();
        $resDataModel = new resDataModel();
        $resData = $resDataModel->resJson;
        $love1 = $reqDatas['love1'];
        $love2 = $reqDatas['love2'];
        try {
            $res = mysqli_query($mysqli,"select * from love_request where love1 = '$love2' and love2 = '$love1'");
            //如果之前没被对方申请则新建一条记录，如果已申请则标记为好友；
            if($res){
                if(!mysqli_num_rows($res)) {
                    $sql01 = "insert into love_request (love1, love2) values ('$love1','$love2')";
                    if(@mysqli_query($mysqli, $sql01)) {
                        $resData['status'] = 200;
                        $resData['datas'] = array('插入love请求数据成功');
                        echo json_encode($resData);
                    }else {
                        $resData['status'] = 202;
                        $resData['datas'] = array('插入love请求数据失败');
                        echo json_encode($resData);
                    }
                }else{
                    $sql02 = "update love_request set love_tag = 1 where love1 = '$love2' and love2 = '$love1';";
                    $sql02 .= "insert into dog_notice (uname, notice) values ('$love1', '您与{$love2}已成为lover'),('$love2', '您与{$love1}已成为lover')";
//                    var_dump(@mysqli_multi_query($mysqli, $sql02));
                    if(mysqli_multi_query($mysqli, $sql02)) {
                        $resData['status'] = 200;
                        $resData['datas'] = array('插入lover标记跟通知数据成功');
                        echo json_encode($resData);
                    }else {
                        $resData['status'] = 202;
                        $resData['datas'] = array('插入lover标记跟通知数据失败');
                        echo json_encode($resData);
                    }
                }
            }
        }catch(Exception $e) {
            $resData['status'] = 500;//服务器运行错误
            $resData['datas'] = array($e->getMessage());
            echo json_encode($resData);
        }
        mysqli_close($mysqli);
    }
    public function showFriends($reqDatas) {
        $connection = new conn();
        $mysqli = $connection->index();
        $resDataModel = new resDataModel();
        $resData = $resDataModel->resJson;
        $uname = $reqDatas['uname'];
        try {
            if($res = mysqli_query($mysqli,"select * from dog_vs_dog where dog1 = '$uname'")){
                while($row = mysqli_fetch_assoc($res)) {
                    $resData['datas'][] = $row['dog2'];
                }
            }
            if(count($resData['datas'])) {
                $resData['status'] = 202;//数据为空
                echo json_encode($resData);
            }else{
                $resData['status'] = 200;
                echo json_encode($resData);
            }

        }catch(Exception $e) {
            $resData['status'] = 500;//服务器运行错误
            $resData['datas'] = array($e->getMessage());
            echo json_encode($resData);
        }
        mysqli_close($mysqli);
    }
    public function showLove($reqDatas) {
        $connection = new conn();
        $mysqli = $connection->index();
        $resDataModel = new resDataModel();
        $resData = $resDataModel->resJson;
        $uname = $reqDatas['uname'];
        try {
            if($res = mysqli_query($mysqli,"select * from love_request where love_tag= 1 and love1 = '$uname'")){
                while($row = mysqli_fetch_assoc($res)) {
                    $resData['datas'][] = $row['love2'];
                }
            }
            if($res = mysqli_query($mysqli,"select * from love_request where love_tag= 1 and love2 = '$uname'")){
                while($row = mysqli_fetch_assoc($res)) {
                    $resData['datas'][] = $row['love1'];
                }
            }
            if(count($resData['datas'])) {
                $resData['status'] = 202;//数据为空
                echo json_encode($resData);
            }else{
                $resData['status'] = 200;
                echo json_encode($resData);
            }

        }catch(Exception $e) {
            $resData['status'] = 500;//服务器运行错误
            $resData['datas'] = array($e->getMessage());
            echo json_encode($resData);
        }
        mysqli_close($mysqli);
    }
    public function show_fof($reqDatas) {
        $connection = new conn();
        $mysqli = $connection->index();
        $resDataModel = new resDataModel();
        $resData = $resDataModel->resJson;
        $uname = $reqDatas['uname'];
        $array1 = array();
        $array2 = array();
        $sql_arr = array();
        try {
            if($res = mysqli_query($mysqli,"select * from dog_vs_dog where dog1 = '$uname'")){
                while($row = mysqli_fetch_assoc($res)) {
                    $array1[] = $row['dog2'];
                }
            }
//            $length = count($array1);
            $sql = "select * from dog_vs_dog where";
            foreach($array1 as $value) {
                $sql .= "or dog1 = '$value' ";  //遍历查询所有的朋友
            }
            $sql = str_replace("whereor","where",$sql);
            $res1 = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_assoc($res1)) {
                $array2[] = $row['dog2'];
            }
//            var_dump($array2);
            $array2 = array_unique($array2);//将数组中重复值合并
            $array = array_diff($array2, $array1); //将$array2与$array1中相同的值去掉
            $array = array_values($array);//将键值重置为数字序列
            $array = array_splice($array,1);//将第一个数组值删除
//            var_dump($array);
            $resData['datas'] = $array;
            if(!count($resData['datas'])) {
                $resData['status'] = 202;//数据为空
                $resData['datas'][] = '数据为空';
                echo json_encode($resData);
            }else{
                $resData['status'] = 200;
                echo json_encode($resData);
            }

        }catch(Exception $e) {
            $resData['status'] = 500;//服务器运行错误
            $resData['datas'] = array($e->getMessage());
            echo json_encode($resData);
        }
        mysqli_close($mysqli);
    }
} 