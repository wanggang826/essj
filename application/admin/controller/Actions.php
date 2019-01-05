<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\Action;
/**
 * 管理员控制器
 * @author  wangang 2017/5/18
 */
class Actions extends AdminBase{
	/**
	 * 操作日志列表
	 */
	public function index(){
		// $data=input();
  //   	$list = model('Admin')->select_action($data);
  		$list =model('action')->select();
  		resultToArray($list);
    	return view([
        'list'=>$list,
        ]);
	}

	public function delAll(){
		$re =model('action')->delAll();
		if($re){
			Api()->setApi('url',url('Admins/index'))->ApiSuccess($re);
		}else{
			Api()->ApiError();
		}
	}

}