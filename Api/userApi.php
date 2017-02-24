<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-30
 * Time: 11:13
 */
require $_DIR_ROOT.'Controller/userController.php';
require $_DIR_ROOT.'Controller/actionController.php';
require $_DIR_ROOT.'Comment/comment.php';

/*userModel.php中返回数据模型为：{status:200，datas:''}
actionModel.php中返回数据模型为：{ status:200, datas:{ @@:“@@”，**：“**”}}
具体可见reDataModel.php类模型，所有数组都转为JSON格式返回给客户端
*/
class userApi
{
    public function index() {
//        var_dump(json_decode(file_get_contents('php://input'),true));
        $reqDatas = $_POST;
        $type = $reqDatas['typeApi'];
        $myPic = $_FILES;
//        $reqDatas = $tmp['datas'];
        switch ($type){
            /*注册接口 POST请求，参数typeApi：reg，uname：用户名，password：密码*/
            case 'reg':
                $uname = $reqDatas['uname'];
                $password = $reqDatas['password'];
                $userCtr = new userController();
                $userCtr->reg($uname, $password);
                break;
            /*登录接口 POST请求，参数typeApi：login，uname：用户名，password：密码*/
            case 'login':
                $uname = $reqDatas['uname'];
                $password = $reqDatas['password'];
                $userCtr = new userController();
                $userCtr->login($uname, $password);
                break;
            /*添加用户信息接口， POST请求，参数typeApi：addDogInfo，接收数据库表single_dog_info中不定个数字段参数*/
            case 'addDogInfo':
                $userCtr =new userController();
                $userCtr->addInfo($reqDatas);
                break;
            /*展示用户信息接口， POST请求，参数typeApi：showDogInfo，uid：用户ID*/
            case 'showDogInfo':
                $userCtr = new userController();
                $userCtr->showInfo($reqDatas);
                break;
            /*添加朋友请求接口， POST请求，参数typeApi：addFriends，dog1：发起请求的用户名，dog2：被请求的用户名*/
            case 'addFriends':
                $actionCtr = new actionController();
                $actionCtr->addFriends($reqDatas);
                break;
            /*申请加lover接口， POST请求，参数typeApi：addLove，love1：发起请求的用户名，love2：被请求的用户名*/
            case 'addLove':
                $actionCtr = new actionController();
                $actionCtr->addLove($reqDatas);
                break;
            /*显示朋友列表接口， POST请求，参数typeApi：showFriends，uname:用户名*/
            case 'showFriends':
                $actionCtr = new actionController();
                $actionCtr->showFriends($reqDatas);
                break;
            /*显示lover列表接口， POST请求，参数typeApi：showLove，uname:用户名*/
            case 'showLove':
                $actionCtr = new actionController();
                $actionCtr->showLove($reqDatas);
                break;
            /*显示半数人列表接口， POST请求，参数typeApi：show_fof，uname:用户名*/
            case 'show_fof': //显示半熟人（朋友的朋友）
                $actionCtr = new actionController();
                $actionCtr->show_fof($reqDatas);
                break;
            case 'pic': //上传图片
                $userCtr =new userController();
                $userCtr->upPic($myPic,$reqDatas);
                break;
            default:
                exit('请检查接口后请重试！');
        }
    }
}