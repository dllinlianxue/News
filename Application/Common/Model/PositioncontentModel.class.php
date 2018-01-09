<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/10/27
 * Time: 下午1:14
 */
namespace Common\Model;

use Think\Model;

class PositioncontentModel extends Model{
    private $_db="";
    function __construct()
    {
        $this ->_db=M('position_content');
    }
    public function getContent(){
        $res = $this->_db->order('listorder desc')->select();
        return $res;
    }
    public function updatePositionContent($id,$status){
        if (!is_numeric($id) || !$id){
            throw_exception('ID不合法');
        }
        if (!is_numeric($status) || !$status){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;
        $res = $this->_db->where('news_id='.$id)->save($data);
        return $res;
    }

    public function positionContentAdd($data){
        $data['create_time'] = time();
        return $this->_db->add($data);
    }
    public function positioncontentFind($id){
        return $this->_db->where('id='.$id)->find();

    }
    public function updatePositioncontentById($id,$data){

        return $this->_db->where('id='.$id)->save($data);

    }
    public function getPositioncontentThumbById(){
        $data['position_id']=5;
        return $this->_db->where($data)->select();
    }

    public function getPositioncontent(){
        $data['status']=1;
        return $this->_db->select();
    }

}