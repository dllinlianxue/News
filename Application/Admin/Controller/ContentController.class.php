<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/26
 * Time: 上午10:49
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Crypt\Driver\Des;

class ContentController extends Controller{
    public function index(){

        $res = D('Content')->getContent();
        $this->assign('news', $res);

        $webSiteMenu = D('Menu')->getMenuIdAndName();
        $this->assign('webSiteMenu',$webSiteMenu);

        $positions= D('Position')->getPositionIdAndName();
        $this->assign('positions',$positions);


        $this->display();
    }

    public function add(){

        if ($_POST){
            if(!isset($_POST['title']) || !$_POST['title']) {
                return show(0,'标题不能为空');
            }
            if(!isset($_POST['small_title']) || !$_POST['small_title']) {
                return show(0,'短标题不能为空');
            }

            if(!isset($_POST['description']) || !$_POST['description']) {
                return show(0,'描述不能为空');
            }
            if(!isset($_POST['keywords']) || !$_POST['keywords']) {
                return show(0,'关键字不能为空');
            }



            $res = D('Content')->ContentAdd($_POST);
            if (!$res){
                return show(0,'添加失败');
            }
            return show(1,'添加成功');

        }

        $titleFontColor = D('Content')->titleColor();
        $webSiteMenu=D('Menu')->getMenuNameByType();
        $copyfrom = D('Content')->copyFrom();

        $this->assign('titleFontColor', $titleFontColor);
        $this->assign('webSiteMenu', $webSiteMenu);
        $this->assign('copyfrom', $copyfrom);


        $this->display();
    }

    public function edit() {
        $id = $_GET['id'];
        $content = D("Content")->ContentFind($id);
        $titleFontColor = D('Content')->titleColor();
        $webSiteMenu=D('Menu')->getMenuNameByType();
        $copyfrom = D('Content')->copyFrom();


        $this->assign('news', $content);
        $this->assign('titleFontColor', $titleFontColor);
        $this->assign('webSiteMenu', $webSiteMenu);
        $this->assign('copyfrom', $copyfrom);


        $this->display();
    }

    public function save($data) {
        $newId = $data['news_id'];
        unset($data['news_id_id']);
        try {
            $id = D("Menu")->updateMenuById($newId, $data);
            if($id === false) {
                return show(0,'更新失败');
            }
            return show(1,'更新成功');
        }catch(Exception $e) {
            return show(0,$e->getMessage());
        }
    }
    public function push(){
        if ($_POST) {
            $news_id=$_POST['news_id'];
            $position_id =$_POST['position_id'];

            $res = D('Positioncontent')->getPositioncontent($position_id);
            $this->assign('res', $res);

            $content = D('Content')->getContent($news_id);
            $this->assign('content', $content);

        }

        $this->display();
    }



}