<?php
namespace app\shop\controller;
use think\Cookie;
/**
* 广告管理类
*/
class AdvPos{

	/*
	* 广告查询
	* $advpos_ename 广告位标识
	*/
	public function adv_all(){
		return model('adv')->select_all();
	}
	
	/*
	* 累加广告点击次数
	*/
	public function adv_click_num(){
		if(request()->isAjax()){
			$adv_id = input('adv_id');
			if(!Cookie::get($adv_id)){//防止用户恶意刷点击数
				model('adv')->where('adv_id ='.$adv_id)->setInc('click_num');
				cookie($adv_id,$adv_id);
			}
		}
	}
}