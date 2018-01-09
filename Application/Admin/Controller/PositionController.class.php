<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/26
 * Time: 上午10:49
 */

namespace Admin\Controller;


use Think\Controller;

class PositionController extends Controller{
    public function index(){

        $count = D('Position')->getPositionsCount();
        $Page = new \Think\Page($count,9);

        $show = $Page->show();
        $res = D('Position')->getPositions($Page);
        $this->assign('positions',$res);
        $this->assign(' pageRes',$show);

        $this->display();
    }

    public function add(){


        if ($_POST){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $status = $_POST["status"];

            $data = array(
                'name' => $name,
                'description' => $description,
                'status' => $status
            );

            $res = D('Position')->addPosition($data);
            if (!$res){
                return show(0, '添加失败');
            }
            return show(1, '添加成功');
        }

        $this->display();
    }


    public function setStatusPosition(){
        try{
            if ($_POST){
                $id = $_POST['id'];
                $status = $_POST['status'];

                $res = D('Position')->updatePosition($id,$status);

                if (!$res){
                    return show(0, '操作失败');
                } else {
                    return show(1, '操作成功');
                }
            }
        } catch (Exception $e){
            return show(0, $e->getMessage());
        }

    }
}