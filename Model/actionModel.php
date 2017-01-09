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
//        $sql = "insert into dog_request values (null,'$uid1','$uid2');";
//        $sql .= "select * from dog_request";
//        $res = mysqli_multi_query($mysqli,$sql);
//        do {
//            /* store first result set */
//            if ($result = mysqli_store_result($mysqli)) {
//                var_dump($result);
//                printf("-----------------\n");
//                while ($row = mysqli_fetch_row($result)) {
//                    printf("%s\n", $row[0]);
//                    var_dump($row);
//                }
//                mysqli_free_result($result);
//            }
//            /* print divider */
//            if (mysqli_more_results($mysqli)) {
//                printf("-----------------\n");
//            }
//        } while (mysqli_next_result($mysqli));
        try {
            $res = mysqli_query($mysqli,"select * from dog_request where dog_req01 = '$dog2' and dog_req02 = '$dog1'");
            //如果之前没被对方申请则新建一条记录，如果已申请则标记为好友；
            if($res){
                if(!mysqli_num_rows($res)) {
                    $sql01 = "insert into dog_request (dog_req01, dog_req02) values ('$dog1','$dog2')";
//                    @mysqli_query($mysqli, $sql01);
//                    $params['status'] = 200;
                    if(@mysqli_query($mysqli, $sql01)) {
                        $resData['status'] = 200;
                        $resData['datas'] = array('插入好友请求数据成功');
                        echo json_encode($resData);
                    }else {
                        $resData['status'] = 202;
                        $resData['datas'] = array('插入好友请求数据失败');
                        echo json_encode($resData);
                    }
                }else{
                    $sql02 = "update dog_request set f_tag = 1 where dog_req01 = '$dog2' and dog_req02 = '$dog1';";
                    $sql02 .= "insert into dog_notice (uname, notice) values ('$dog1', '您与{$dog2}已成为好友'),('$dog2', '您与{$dog1}已成为好友')";
//                    var_dump(@mysqli_multi_query($mysqli, $sql02));
                    if(mysqli_multi_query($mysqli, $sql02)) {
                        $resData['status'] = 200;
                        $resData['datas'] = array('插入朋友标记跟通知数据成功');
                        echo json_encode($resData);
                    }else {
                        $resData['status'] = 202;
                        $resData['datas'] = array('插入朋友标记跟通知数据失败');
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
        $uid = $reqDatas['uid'];
        $uname = $reqDatas['uname'];
        try {
            $res = mysqli_query($mysqli,"select * from love_request where  = '' and love2 = ''");
            //如果之前没被对方申请则新建一条记录，如果已申请则标记为好友；
            if($res){
                if(!mysqli_num_rows($res)) {
                    $sql01 = "insert into love_request (love1, love2) values ('','')";
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
} 