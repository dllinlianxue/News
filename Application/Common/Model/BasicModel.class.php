<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/10/27
 * Time: 下午1:13
 */
namespace Common\Model;

use Think\Model;

class BasicModel extends Model{
    public function __construct(){
    }

    public function save($data=array()){
        if (!$data){
            throw_exception('没有提交的数据');
        }
        $id = F('basic_web_config',$data);
            return $id;
    }

    public function select(){
        $res = F('basic_web_config');
        return $res;
    }


}