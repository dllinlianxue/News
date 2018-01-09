<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/2
 * Time: 上午9:34
 */
namespace Home\Controller;

use Think\Controller;

class CatController extends Controller{
    public function index(){

        $res = D('Content')->getContentTitleAndThumb();

        $this->display();

    }
}