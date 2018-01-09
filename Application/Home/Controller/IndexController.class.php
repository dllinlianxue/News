<?php
namespace Home\Controller;
use Think\Controller;
use Think\Storage;
class IndexController extends Controller{

    public function index($type=""){

      $result = D('Content')->getContentTitleAndThumb();
      $this->assign('result',$result);

        $thumb = D('Positioncontent')->getPositioncontentThumbById();
        $this->assign('thumb',$thumb);


      if ($type == 'buildhtml'){
          $this->buildhtml('index',HTML_PATH,'Index/index');

      } else {
          $this->display();
      }

    }
    /**
     *  创建静态页面
     * @access protected
     * @htmlfile 生成的静态文件名称
     * @htmlpath 生成的静态文件路径
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @return string
     */
    protected function buildHtml($htmlfile='',$htmlpath='',$templateFile='') {
        $content    =   $this->fetch($templateFile);
        $htmlpath   =   !empty($htmlpath)?$htmlpath:HTML_PATH;
        $htmlfile   =   $htmlpath.$htmlfile.C('HTML_FILE_SUFFIX');
        Storage::put($htmlfile,$content,'html');
        return $content;
    }
    public function build_html(){
        $this->index('buildhtml');
        return show(1,'首页缓存成功');
    }

    public function crontab_build_html(){
        //crontab定时build_html文件
        $this->index('buildhtml');
    }

}