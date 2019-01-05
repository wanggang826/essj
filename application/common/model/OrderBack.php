<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 退货模型
 * @author 
 * @version wanggang 2017/9/11
 */
class OrderBack extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    //关联订单
    public function order(){
        return $this->hasOne('order','order_id','order_id');
    }

    //关联用户
    public function user(){
        return $this->hasOne('user','user_id','user_id');
    }
    //关联订单详情
    public function order_info(){
    	return $this->hasOne('orderInfo','order_id','order_id');
    }
    //退款记录查询 
    public function select_order_back($data,$where=array()){
    	if(isValue($data,'back_no')){
            $where['back_no']     = ['like','%'.$data['back_no' ].'%'];
        }
        if(isValue($data,'nickname')){
            $map['nickname']     = ['like','%'.$data['nickname' ].'%'];
            $user_ids            = model('user')->where($map)->column('user_id');
            $where['user_id']   = ['in',$user_ids];
        }
        if(isValue($data,'tel')){
            $map['phone']     = ['like','%'.$data['tel' ].'%'];
            $user_ids             = model('user')->where($map)->column('user_id');
            $where['user_id']     = ['in',$user_ids];
        }
        if(isValue($data,'status')){
            $where['status']     = $data['status'];
        }
        if(isValue($data,'statr_time') && isValue($data,'end_time')){
            $statr_time = strtotime($data['statr_time']);
            $end_time   = strtotime($data['end_time']);
			$where['create_time'] =['BETWEEN',[$statr_time,$end_time]];
		}
		$query  = $data;
		$list=$this->where($where)->order('create_time desc')->paginate('',false,['query' => $query]);
		resultToArray($list);
		foreach ($list as $key => $value) {
			if($value->order){
				$list[$key]['order_info'] = $value->order->data;
			}else{
				$list[$key]['order_info'] = array();
			}
			if($value->order_info){
				$order_info = model('orderInfo')->where('order_id',$value['order_id'])->find();
				if($order_info){
					$list[$key]['order_info1'] = $order_info->toArray();
				}else{
					$list[$key]['order_info1'] = array();
				}
			}else{
				$list[$key]['order_info1'] = array();
			}
			if($value->user){
				$list[$key]['user_info']  = $value->user->data;
			}else{
				$list[$key]['user_info']  = array();
			}
		}
		return $list;
    } 
    
}