<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\GoodsAttr;
/**
 * 属性控制器
 * @author  wangang 2017/5/21
 */
class Attrs extends AdminBase{
	public $input_type  = ['text','radio','textarea','checkbox','select',];
	/**
	 * 属性列表查询
	 */
	public function index(){
		$data = input();
		$attrs =model('GoodsAttr')->select_attr($data);
		dump($attrs);
		return view(['attrs'=>$attrs,]);
	}
	/**
     * 新增属性
     */
    public function add(){
    	$input_type  = ['text','radio','textarea','checkbox','select',];
    	if (request()->isAjax()) {
    		$data =input();
    		$type_name = $data['type_name'];
            $type_val  = $data['type_val'];
            if($data['type'] =='select'|| $data['type'] =='checkbox' || $data['type'] =='radio'){//控件类型
                if(!empty($data['type_name'][0]) || !empty($data['type_val'][0])){//控件值键值对
                    foreach ($type_val as $k => $v) {
                        $type_value[$k]['name']  = $type_name[$k];
                        $type_value[$k]['value'] = $v;
                    }
                    sort($type_value);
                    $data['value'] = serialize($type_value);
                }else{//控件值键值对为空或者不完整
                    Api()->setApi('msg','控件值不能为空!')->setApi('url',0)->ApiError();
                }
            }
            unset($data['type_val'],$data['type_name']);
       	    $re =model('GoodsAttr')->add_attr($data);
           	if($re >0){
           		Api()->setApi('url',url('Attrs/index'))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view(['input_type'=>$input_type,]);
    }
    /**
     * 编辑属性
     */
    public function edit(){
    	$input_type  = ['text','radio','textarea','checkbox','select',];
    	$attr_id=input('attr_id');
    	$attr_info = GoodsAttr::get($attr_id)->toArray();
    	$attr_info['value']=unserialize($attr_info['value']);
        $page =input('page');
    	if (request()->isAjax()) {
            $data=input();
            $type_name = $data['type_name'];
            $type_val  = $data['type_val'];
            if($data['type'] =='select'|| $data['type'] =='checkbox' || $data['type'] =='radio'){//控件类型
                if(!empty($data['type_name'][0]) || !empty($data['type_val'][0])){//控件值键值对
                    foreach ($type_val as $k => $v) {
                        $type_value[$k]['name']  = $type_name[$k];
                        $type_value[$k]['value'] = $v;
                    }
                    sort($type_value);
                    $data['value'] = serialize($type_value);
                }else{//控件值键值对为空或者不完整
                    Api()->setApi('msg','控件值不能为空!')->setApi('url',0)->ApiError();
                }
            }
            unset($data['type_val'],$data['type_name'],$data['page']);
           	$re =model('GoodsAttr')->edit_attr($data);
           	if($re >0){
           		Api()->setApi('url',url('Attrs/index',['page'=>input('page')]))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view(
    		['attr_info'=>$attr_info,'page'=>$page,'input_type'=>$input_type,]
    	);
    }
     /**
     * 删除属性
     */
    public function del(){
      if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('GoodsAttr',$time,$data['id'],'attr_id','delete_time');
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
        $obj =$this->setStatus('GoodsAttr',input('status'),input('attr_id'),'attr_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
}