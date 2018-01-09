<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/26
 * Time: 下午3:59
 */

namespace Common\Model;


use Think\Model;

class PositionModel extends Model{
    private $_db = '';

    function __construct()
    {
        $this->_db = M('position');
    }

    public function getPositions($Page){
        $data['status']=array('neq',-1);
        $res = $this->_db->limit($Page->firstRow.','.$Page->listRows)->select();
        return $res;
    }

    public function getPositionsCount($data){
        $data['status']=array('neq',-1);
        $count = $this->_db->where($data)->count();
        return $count;
    }
    public function addPosition($data){
        $res = $this->_db->add($data);
        return $res;
    }
    public function updatePosition($id,$status){
        if (!is_numeric($id) || !$id){
            throw_exception('ID不合法');
        }
        if (!is_numeric($status) || !$status){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;
        $res = $this->_db->where('id='.$id)->save($data);
        return $res;
    }
    public function getPositionIdAndName(){
        $res = $this->_db->field('id,name')->select();
        return $res;
    }

    public function getPositionDescription(){
        $res = $this->_db->where()->field('id,description')->select();
        return $res;
    }







}