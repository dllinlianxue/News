<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/2
 * Time: 下午4:02
 */
namespace Home\Controller;

use Think\Controller;

class CronController extends Controller{
    public function dumpmysql(){
        $shell = 'mysql -uroot -p news_cms > /Library/WebServer/news.sql
';
        exec($shell);
        //执行的脚本 返回的数据
    }
}