<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/10/30
 * Time: 下午2:13
 */
namespace Common\Model;

use Think\Model;

class UploadImageModel extends Model{
    private $_uploadObj = "";
    private $uploadImageData = "";

    const UPLOAD = "upload";
    public function __construct()
    {
        $this->_uploadObj = new \Think\Upload();
        //类的实例化就是对象

        $this->_uploadObj ->rootPath = './'.self::UPLOAD.'/';
        //rootPath附件上传的根目录

        $this->_uploadObj ->subName =date(Y).'/'.date(m).'/'.date(d);
        //subName附件上传的子目录:年一个文件夹 月一个文件夹
    }
    public function upload(){
        $res = $this->_uploadObj->upload();
        if (!$res){
            return false;
        } else {
            return '/'.self::UPLOAD.'/'.$res['imgFile']['savepath'].$res['imgFile']['savename'];
        }
    }
    public function ImageUpload(){
        $res = $this->_uploadObj->upload();
        if (!$res){
            return false;
        } else {
            return '/'.self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
        }
    }

}