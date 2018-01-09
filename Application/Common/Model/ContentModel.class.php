<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/10/27
 * Time: 下午1:03
 */
namespace Common\Model;

use Think\Model;

class ContentModel extends Model{
    private $_db = '';

    function __construct()
    {
        $this->_db = M('news');
    }

    public function getContent(){
        $res = $this->_db->order('listorder desc')->select();
        return $res;
    }
    //文章管理的添加下拉选项

    public function insertContent($data){

        if (!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }
    public function titleColor(){
        return C('title_font_color');
    }
    public function copyFrom(){
        return C('COPY_FROM');
    }

    public function ContentAdd($data){
        $data['username']='admin';
        $data['create_time'] = time();
        return $this->_db->add($data);
    }

    public function ContentFind($id){

        $res =$this->_db->where('news_id='.$id)->find();
        return $res;
    }

    public function getContentTitleAndThumb(){
        $data['status']=1;
        return $this->_db->where($data)->select();
    }




}