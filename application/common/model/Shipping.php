<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 物流模型
 * @author 
 * @version wanggang 2017/7/8
 */
class Shipping extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    public function select_ship($data,$where=array()){
    	if(isValue($data,'shipping_name')){
			$where['shipping_name'] =['like','%'.(string)$data['shipping_name'].'%'];
		}
		if(isValue($data,'status')){
			$where['status']=['eq',$data['status']];
		}
        $query =$data;
		$list=$this->where($where)->order('sort desc')->paginate('',false,['query' => $query]);
		resultToArray($list);
		return $list;
    }
    public function add_ship($data){
    	$re = $this->validate('shipping.add')->save($data);
    	if($re === false){
    		return $this->getError();
    	}else{
    		return $re;
    	}
    }
}
