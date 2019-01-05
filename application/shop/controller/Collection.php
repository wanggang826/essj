<?php
namespace app\shop\controller;

/**
* 收藏管理控制器
* @author  gucangfa 2017/6/10
*/
class Collection extends ShopBase{
	
	public function ajax_collection(){
		if(request()->isAjax()){
		    $data=input();
		    if(isset($data['ctype'])){
			    if($data['ctype']==1){
	                $status = model('Collection')->add_all_collection($data);
	            }
		    }else{
                $status = model('Collection')->add_Or_del_collection($data);
            }
			return $status;
		}
	}	
}