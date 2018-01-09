<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/21
 * Time: 下午5:09
 */

 namespace Common\Model;
 use Think\Model;
 class AdminModel extends Model{
     private $_db='';
     function __construct()
     {
         $this->_db= M('admin');
     }


     public function GetUserByUsername($username){
         $res = $this->_db->where("username='".$username."'")->find();
         return $res;
     }

     public function getAdmin(){
         $data['status'] = array('neq', -1);
         $res = $this->_db->select();
         return $res;
     }

     public function insertAdmin($data){
         $res = $this->_db->add($data);
         return $res;
     }

     public function setStatusById($id, $data){
         $res = $this->_db->where('admin_id='.$id)->save($data);
         return $res;
     }

 }
