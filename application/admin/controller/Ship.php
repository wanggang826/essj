<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Request;
use think\Session;
use extend\Encrypt;
/**
 * 物流控制器
 * @author  wanggang
 * @version 2017/7/8
 */
class Ship extends AdminBase{
	public function defaluts(){
		$this->redirect(url('Admins/index'));
	}
	/**
	 * 物流列表
	 */
	public function index(){
		$data  = input();
		$ships = model('Shipping')->select_ship($data);
		return view(['ships'=>$ships]);
	}
    /**
     * 新增物流
     */
    public function add(){
        if(request()->isAjax()){
            $data = input();
            $re   = model('shipping')->add_ship($data);
            if($re > 0){
                Api()->setApi('url',url('ship/index'))->ApiSuccess($re);
            }else{
                Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
            }
        }
        return view();
    }
	/**
     * 改变状态：启用|禁用
     */
    public function changeStatus(){
        $obj =$this->setStatus('Shipping',input('status'),input('shipping_id'),'shipping_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
     /**
     * 删除物流
     */
    public function del(){
      if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('Shipping',$time,$data['id'],'Shipping','delete_time');
        if(1 == $obj->code){
            Api()->setApi('url',input('location'))->ApiSuccess();
        }else{
            Api()->setApi('url',0)->ApiError();
        }
      }
    }
}
