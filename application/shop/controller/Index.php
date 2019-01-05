<?php
namespace app\shop\controller;
use think\session;
header("Content-type: text/html; charset=utf-8");
class Index extends MallBase{
	/**
	 * 商城首页
	 */
    public function index(){
       echo "前台首页";
    }
}
