<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/23
 * Time: 下午2:54
 */

namespace Common\Model;


use Think\Model;

class MenuModel extends Model{

    private $_db = '';

    function __construct()
    {
        $this->_db = M('menu');
    }
//
    public function getMenus($type,$page){
        $data['status'] = array('neq', -1);
        $data['type'] = $type;

        $res = $this->_db->where($data)->order('listorder desc')->limit($page->firstRow.','.$page->listRows)->select();
        return $res;
    }

    public function getMenusCount($type){
        $data['status'] = array('neq', -1);
        $data['type']=$type;
        $count = $this->_db->where($data)->count();
        return $count;

    }

    public function insert($data){

        if (!$data || !is_array($data)){
            return 0;
        }

        return $this->_db->add($data);
    }

    public function updateStatusById($id, $status){
        if (!is_numeric($id) || !$id){
            throw_exception('ID不合法');
        }
        if (!is_numeric($status) || !$status){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;

        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function find($id){
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('menu_id='.$id)->find();
    }

    public function updateMenuById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }

        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function updateMenuListorderById($id, $listorder) {

        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }

        $data = array(
            'listorder' => intval($listorder),
        );

        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function getAdminMenus() {
        $data['status'] = array('neq', -1);
        $data['type'] = 1;

        return $this->_db->where($data)->order('listorder desc')->select();

    }

    public function getNames(){
        $data['type']=0;
        $data['status']=1;
        $res = $this->_db->where($data)->select();
        return $res;
    }

    public function getMenusCat($catid){
         $data['type']= array('eq',0);
         $data['menu_id']=$catid;
        $res = $this->_db->where($data)->getField('name');
        return $res;

    }

    public function getIdAndName(){
        return $this->_db->find('menu_id,name')->select();
    }

    public function getMenuNameByType(){
        $data['type'] = array('eq',0);
        $res = $this->_db->where($data)->select();
        return $res;
    }

    public function getMenuIdAndName(){
        return $this->_db->where()->field('menu_id,name')->select();
    }
    public function getBarMenus(){
        $data['type']=0;
        $data['status']=1;
        return $this->_db->where($data)->select();
    }




}