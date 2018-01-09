<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/21
 * Time: 下午3:57
 */
 namespace Admin\Controller;
 use Think\Controller;


 class LoginController extends Controller {


     public function index(){
         if(session('adminUser')) {
             redirect('/admin.php');
         }
         // admin.php?c=index
         $this->display();
     }

     public function check(){
         $username = $_POST['username'];
         $password = $_POST['password'];
         if (!trim($username)) {
             show(0,'用户名为空');
         }
         if(!trim($password)) {
             show(0,'密码为空');
         }
         $res = D('Admin')->GetUserByUsername($username);
         if (!$res || $res['username' != $username]) {
             show(0,'用户名不存在');
         }
         if ($res['password'] != GetMd5Password($password)) {
             show(0,'密码错误');
         }
         session('adminUser', $res);
         show(1,'登陆成功');
     }

     public function logout(){
         session('adminUser', null);
         redirect('/admin.php?c=login');
     }


 }