<?php
namespace  app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * @param  订单详情类
 * by  pengqianag
 * Date: 2017/5/23
 */
class OrderInfo extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    //商品 店铺关联
    public function shop(){
        return $this->hasOne('shop','shop_id','shop_id');
    }
    //商品 关联
    public function goods(){
        return $this->hasOne('goods','goods_id','goods_id');
    }
    //订单关联
    public function order(){
        return $this->belongsTo('order','order_id','order_id');
    }
    //订单状态
    public function orderStatus(){
        return $this->belongsTo('orderStatus','status','id');
    }
    /*
     * 订单详情
     * @param  string $order_sn 订单编号
     * @param  return arr  $list  返回值
     * */
    public  function order_list($order_sn){
        $list = $this->where(['order_id'=>$order_sn])->select();
        foreach ($list as $k => &$v){
            $v['shop_id'] = $v->shop->shop_name;
            $v['goods_color_attr'] = $v->goods->goods_color_attr;
            $v['goods_color_attr'] = unserialize($v['goods_color_attr']);
            $v['statusText']   = $this->status($v['status']);
            $v['good_attr'] = unserialize($v['good_attr']);
        }
        resultToArray($list);
        return $list;
    }
    /*
     *订单分类
     * */
    public function shop_goods($order_id){
        $goods = $this->where(['order_id'=>['in',$order_id]])->select();
        resultToArray($goods);
        $goods_info=[];
        foreach ($goods as $k=>&$v){
            if(in_array($v['order_id'],$order_id)){
                $v['good_attr'] = unserialize($v['good_attr']);
                $v['statusText']= $this->status($v['status']);
                $goods_info[$v['order_id']][] =$goods[$k];
            }
        }
       return $goods_info;
    }

    /*
     * 未付款订单详情(ID查)
     * */
    public function orders_info($orders){
        $where['order_id'] =['in',$orders];
        $orders = $this->where($where)->order('order_id')->select();
        foreach ($orders as $key => &$val){
            $array_id[$key] = $val['shop_id'];
        }
       $array_shop_id = array_unique($array_id);
        foreach($array_shop_id as $ke =>$va){
            foreach ($orders as $k => &$v){
                $aa = $v;
                if($va == $v['shop_id']){
                    $v['shop_id'] = $v->shop->shop_name;
                    $new_orders[$ke][] = $orders[$k] ;
                }
            }
       }
        return $new_orders;
    }
    /*
     * 订单ID查所有商品  更新单价
     * */
    public function new_price($orders){
        $where['order_id'] =['in',$orders];
        $orders = $this->where($where)->order('order_id')->select();
        foreach ($orders as $k => &$v){
            $v['price'] = $v->goods->shop_price;
        }
       return  $orders;
    }

    /*
     * 流水号查order_info ID
     * */
    public  function  orderinfo_id($data){
        foreach ($data as $key=> $val){
            $id[] =$val['order_id'];
        }
        $where['order_id']=['in',$id] ;
        $id_arr = $this->where($where)->field("id,goods_id")->select();
        resultToArray($id_arr);
        $arr = [];
        foreach ($id_arr as $k=> $v){
            $arr[$v['goods_id']] =$v['id'];
        }
       return $arr;
    }
    /*
     * 商品ID查订单ID
     * */
    public function order_id($data){
        $order_id=[];
        $orders = $this->where(['goods_id'=>['in',$data]])->field('order_id')->select();
        foreach ($orders as $k=>$v){
            $order_id[$k] = $v['order_id'];
        }
        $order_id = array_unique($order_id);
        return  $order_id;
    }

    /*
     * 修改流水号下的所有商品
     * */
    public  function  edit_info($goods_id,$goods_arr){
       foreach ($goods_arr as $k => &$v){
           $v['id'] = $goods_id[$v['goods_id']];
       }
        return $this->saveAll($goods_arr);
    }

    /**
     *订单状态
     */
    public function status($val){
        $status = [2=>'未付款',3=>'已付款',4=>'待发货',5=>'待收货',6=>'已完成',7=>'申请退款',8=>'同意退款',9=>'完成退款',10=>'拒绝退款',11=>'待评价'];
        return $status[$val];
    }
}
