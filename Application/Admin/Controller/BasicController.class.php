<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/26
 * Time: 上午10:47
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class BasicController extends Controller
{

    public function index(){
        $res = D('Basic')->select();
        $this->assign('vo',$res);

        $this->display();
    }

    public function add()
    {
        if ($_POST) {

            if (!$_POST['title'] || !isset($_POST['title'])) {
                return show(0, '标题不存在');
            }
            if (!$_POST['description'] || !isset($_POST['description'])) {
                return show(0, '描述不存在');
            }
            if (!$_POST['keywords'] || !isset($_POST['keywords'])) {
                return show(0, '关键词不存在');
            }
            try {
                D('Basic')->save($_POST);
            } catch (Exception $e) {
                return show(0,$e->getMessage());
            }
            return show(1, '存储成功');

        } else {
            return show(0, '缺少数据');
        }

    }
    public function  cache(){
        $this->display();
    }


}