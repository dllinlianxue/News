<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/26
 * Time: 上午10:50
 */

namespace Admin\Controller;

use Think\Controller;

class PositioncontentController extends Controller
{
    public function index()
    {
        $res = D('Positioncontent')->getContent();
        $this->assign('contents', $res);

        $positions = D('Position')->getPositionIdAndName();
        $this->assign('positions', $positions);


        $this->display();
    }

    public function setStatusPositionContent()
    {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $res = D('Position_content')->updatePosition($id, $status);

                if (!$res) {
                    return show(0, '操作失败');
                } else {
                    return show(1, '操作成功');
                }
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

    }

    public function add()
    {

        if ($_POST) {
            if (!isset($_POST['title']) || !$_POST['title']) {
                return show(0, '标题不能为空');
            }

            if (!isset($_POST['url']) || !$_POST['url']) {
                return show(0, 'url不能为空');
            }

            if ($_GET['id']) {
                return $this->save($_GET);
            }


            $res = D('Positioncontent')->positionContentAdd($_POST);

            if (!$res) {
                return show(0, '添加失败');
            }
            return show(1, '添加成功');

        }

        $positions = D('Position')->getPositionIdAndName();
        $this->assign('positions', $positions);
        $this->display();
    }

    public function edit()
    {
        if ($_GET) {
            $id = $_GET['id'];

            $res = D('Positioncontent')->positioncontentFind($id);

            $positions = D('Position')->getPositionIdAndName();

            $this->assign('positions', $positions);
            $this->assign('vo', $res);
        }
        $this->display();
    }

    public function save($data)
    {
        $ID = $data['id'];
        unset($data['id']);

        try {
            $id = D("Positioncontent")->updatePositioncontentById($ID, $data);

            if ($id === false) {
                return show(0, '更新失败');
            }
            return show(1, '更新成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

    }
}