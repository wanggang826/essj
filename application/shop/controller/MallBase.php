<?php
namespace app\shop\controller;
use app\common\controller\ShopApp;
/**
 * 商城基础类
 */
class MallBase extends ShopApp
{
    public function _initialize(){
        parent::_initialize();
        // $this->getFriendLink();
    }

    /*
     * 顶部导航
     * by pengqiang 2017/6/10
     * */
    final protected function nav_top(){
        $where   = "`status`=1 AND `type`=1";
        $top_nav = model('Nav')->select_nav($where);
        return $top_nav;
    }

    /**
     * 商品分类 侧边导航
     * @author wanggang
     * @version 2017/6/10
     */
    final protected function cate_nav($force = false){
        if ($force && Request::instance()->isAjax()) { return false; }
        $file = CACHE_PATH.'/cate_nav.cache.php';
        !is_dir(dirname($file)) && mkdir(dirname($file),'0777',true);
        !file_exists($file)     && $force = true;
        //判断是否强制重写
        if (!$force) {//非强制重写
            $time = getFileTime($file);
            $compare =  time()-$time;
            if ($compare <= config('cache.expire')){//文件更新时间小于设置时间
                $cate = include($file);
                return $cate;
            }
        }
        $cate = model('GoodsCate')->select();
        resultToArray($cate);
        $cate = getTree($cate,['primary_key'=>'cate_id','class_name'=>'form-control'])->makeTree();
        $data = "<?php //此文件由系统生成，修改无效\n return ".var_export($cate,true).';';
        $f = fopen($file, 'w+');
        fwrite($f, $data);
        fclose($f);
        return $cate;
    }
}