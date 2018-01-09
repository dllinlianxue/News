<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/23
 * Time: 上午11:46
 */

namespace Admin\Controller;

use Think\Controller;

use Think\Exception;

class MenuController extends Controller{
    /*$User = M('User'); // 实例化User对象
      $count = $User->where('status=1')->count();// 查询满足要求的总记录数
      $Page  = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
      $show  = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
$list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
  $this->assign('list',$list);// 赋值数据集
  $this->assign('page',$show);// 赋值分页输出
  $this->display(); // 输出模板
*/

    public function index(){

        $data = array();
        if(isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0,1))) {
            $data['type'] = intval($_REQUEST['type']);
            $this->assign('type',$data['type']);
        }else{
            $this->assign('type',-100);
        }


        $count = D('Menu')->getMenusCount($data['type']);
        $page = new \Think\Page($count,3);

        $show = $page->show();
        $res = D('Menu')->getMenus($data['type'],$page);


        $this->assign('menus', $res);
        $this->assign('pageRes',$show);


        $this->display();
    }




    public function add(){


        if ($_POST){
            if(!isset($_POST['name']) || !$_POST['name']) {
                return show(0,'菜单名不能为空');
            }
            if(!isset($_POST['m']) || !$_POST['m']) {
                return show(0,'模块名不能为空');
            }
            if(!isset($_POST['c']) || !$_POST['c']) {
                return show(0,'控制器不能为空');
            }
            if(!isset($_POST['f']) || !$_POST['f']) {
                return show(0,'方法名不能为空');
            }

            if($_POST['menu_id']) {

                return $this->save($_POST);

            }


            $res = D('Menu')->insert($_POST);
            if (!$res){
                return show(0,'插入失败');
            }
            return show(1,'插入成功');

        }

        $this->display();
    }

    public function setStatus(){
        try{
            if ($_POST){
                $id = $_POST['id'];
                $status = $_POST['status'];

                $res = D('Menu')->updateStatusById($id, $status);

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

    public function edit() {

        $menuId = $_GET['id'];

        $menu = D("Menu")->find($menuId);

        $this->assign('menu', $menu);

        $this->display();
    }

    public function save($data) {
        $menuId = $data['menu_id'];
        unset($data['menu_id']);

        try {
            $id = D("Menu")->updateMenuById($menuId, $data);
            if($id === false) {
                return show(0,'更新失败');
            }
            return show(1,'更新成功');
        }catch(Exception $e) {
            return show(0,$e->getMessage());
        }
    }

    public function listorder() {
        $listorder = $_POST['listorder'];

        $jumpUrl = $_SERVER['HTTP_REFERER'];


        $errors = array();

        if($listorder) {
            try {
                foreach ($listorder as $menuId => $v) {
                    // 执行更新
                    $id = D("Menu")->updateMenuListorderById($menuId, $v);
                    if ($id === false) {
                        $errors[] = $menuId;
                    }
                }
            }catch(Exception $e) {
                return show(0,$e->getMessage(),array('jump_url'=>$jumpUrl));
            }


            if($errors) {
                return show(0,'排序失败-'.implode(',',$errors),array('jump_url'=>$jumpUrl));
            }
            return show(1,'排序成功',array('jump_url'=>$jumpUrl));
        }

        return show(0,'排序数据失败',array('jump_url'=>$jumpUrl));
    }

}

