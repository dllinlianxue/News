<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/21
 * Time: 下午4:44
 */
function show($status,$message,$data=array()){
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' =>$data
    );
    exit(json_encode($result));
}


function GetMd5Password($password){
    return md5($password.C('MD5_PRE'));
}

function getMenuType($type){
    return ($type == 1) ? '后台菜单' : '前端索引';
}

function status($status){
    if($status == 0) {
        $str = '关闭';
    }else if($status == 1) {
        $str = '正常';
    }else if($status == -1) {
        $str = '删除';
    }
    return $str;
}

function getAdminMenuUrl($nav) {
    $url = '/admin.php?c='.$nav['c'].'&a='.$nav['f'];

    return $url;
}

function getActive($navc){
    $c = strtolower(CONTROLLER_NAME);
    if(strtolower($navc) == $c) {
        return 'class="active"';
    }
    return '';
}

function getCatName($catid){
    return D('Menu')->getMenusCat($catid);
}

function getCopyFromById($id){
    return C('COPY_FROM')[$id];
}

function isThumb($thumb){
    return ($thumb) ?'是':'否';
}










