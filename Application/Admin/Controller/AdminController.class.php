<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/26
 * Time: 上午10:51
 */

namespace Admin\Controller;


use Think\Controller;

class AdminController extends Controller{

    public function index(){

        $res = D('Admin')->getAdmin();

        $this->assign('admins', $res);

        $this->display();
    }

    public function add(){


        if ($_POST){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $realname = $_POST['realname'];

            if (!trim($username)){
                return show(0, '用户名为空');
            } else if (!trim($password)){
                return show(0, '密码为空');
            } else if (!trim($realname)){
                return show(0, '真实姓名为空');
            }


            $data = array(
                'username' => $username,
                'password' => GetMd5Password($password),
                'realname' => $realname
            );

            $res = D('Admin')->insertAdmin($data);

            if (!$res){
                return show(0, '添加失败');
            }
            return show(1, '添加成功');
        }
        $this->display();
    }

    public function setStatus(){

        $id = $_POST['id'];
        $status = $_POST['status'];

        $data = array(
            'status' => $status
        );

        $res = D('Admin')->setStatusById($id, $data);

        if (!$res){
            return show(0, '删除失败');
        }
        return show(1, '删除成功');

    }
}