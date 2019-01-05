<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\GoodsBrand;
/**
 * 品牌控制器
 * @author  wangang 2017/5/21
 */
class Brands extends AdminBase{
	/**
	 * 品牌列表
	 */
	public function index(){
		$data = input();
		$brands =model('GoodsBrand')->select_brand($data);
		return view(['brands'=>$brands,]);
	}
	/**
     * 新增品牌
     */
    public function add(){
    	if (request()->isAjax()) {
    		$data =input();
       	    $re =model('GoodsBrand')->add_brand($data);
           	if($re >0){
           		Api()->setApi('url',url('Brands/index'))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view();
    }
    /**
     * 编辑管理员
     */
    public function edit(){
    	$brand_id=input('brand_id');
    	$brand_info = GoodsBrand::get($brand_id)->toArray();
        $page =input('page');
    	if (request()->isAjax()) {
            $data=input();
           	$re =model('GoodsBrand')->edit_brand($data);
           	if($re >0){
           		Api()->setApi('url',url('Brands/index',['page'=>input('page')]))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view(
    		['brand_info'=>$brand_info,'page'=>$page,]
    	);
    }
     /**
     * 删除品牌
     */
    public function del(){
      if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('GoodsBrand',$time,$data['id'],'brand_id','delete_time');
        if(1 == $obj->code){
            Api()->setApi('url',input('location'))->ApiSuccess();
        }else{
            Api()->setApi('url',0)->ApiError();
        }
      }
    }
    /**
     * 改变状态：启用|禁用
     */
    public function changeStatus(){
        $obj =$this->setStatus('GoodsBrand',input('status'),input('brand_id'),'brand_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
    /**
     * 设置型号
     */
	public function set_model(){

    }
}