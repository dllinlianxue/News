<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/10/30
 * Time: 上午11:19
 */
namespace Admin\Controller;

use Think\Controller;

class ImageController extends Controller{
    public function ajaxuploadimage(){

         $upload = D('uploadImage');
         $res = $upload ->ImageUpload();

         if ($res == false){
             return show(0,'上传失败','');
         } else {
             return show(1,'上传成功',$res);
         }
    }

}