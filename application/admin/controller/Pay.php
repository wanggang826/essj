<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\PayConfig;
use think\Request;
/**
 * 支付管理控制器
 * @author  wanggang 
 * @version 2017/5/25
 */
class Pay extends AdminBase{
	/**
	 * 支付方式列表
	 */
    public function index(){
    	// echo serialize([
	    // 		'app_id'=>[
	    // 			'name'=>'appid',
	    // 			'desc'=>'绑定支付的APPID',
	    // 			'val' =>'wx426b3015555a46be',
	    // 		],
	    // 		'mch_id'=>[
	    // 			'name'=>'商户号',
	    // 			'desc'=>'商户id',
	    // 			'val' =>'1900009851',
	    // 		],
	    // 		'app_secret'=>[
	    // 			'name'=>'secret',
	    // 			'desc'=>'公众账号secret',
	    // 			'val' =>'7813490da6f1265e4901ffb80afaa36f',
	    // 		],
	    // 		'key'=>[
	    // 			'name'=>'密钥',
	    // 			'desc'=>'商户支付密钥',
	    // 			'val' =>'8934e7d15453e97507ef794cf7b0519d',
	    // 		],
	    // 	]);
    	$data = input();
    	$pays = model('PayConfig')->select_pay($data);
    	return view(['pays'=>$pays]);
    }
    /**
     * 删除支付方式
     */
    public function del(){
    	if(request()->isAjax()){
	        $time = time();
	        $data = input();
	        $obj =$this->setStatus('PayConfig',$time,$data['id'],'id','delete_time');
	        if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
	    }
    }

    /**
     * 启用|禁用
     */
    public function changeStatus(){
    	if(request()->isAjax()){
	        $obj = $this->setStatus('PayConfig',input('status'),input('id'),'id');
	        if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
	    }
    }
    /**
     * 配置
     */
    public function config(){
    	$id = input('id');
    	$pay_config = model('PayConfig')->where('id',$id)->value('pay_config');
    	$pay_config = unserialize($pay_config);
    	if(request()->isAjax()){
	    	$data =input();
	    	$re =model('PayConfig')->edit_payconfig($data);
	    	if($re){
	    		Api()->setApi('url',url('pay/index'))->ApiSuccess($data);
	    	}else{
	    		Api()->setApi('url',0)->ApiError();
	    	}	
    	}
    	return view(['pay_config'=>$pay_config,'id'=>$id]);
    }
}