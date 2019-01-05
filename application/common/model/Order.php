<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/*
 * @param 订单类
 *@param  pengqiang 2017-05-20
 */
class Order extends Model{
   use SoftDelete;
    
    //关联地址-省
    public function province1(){
        return $this->hasOne('city','city_id','province');
    }
    //关联地址-市
    public function city1(){
        return $this->hasOne('city','city_id','city');
    }
    //关联地址-区
    public function area1(){
        return $this->hasOne('city','city_id','area');
    }
    //关联用户
    public function user(){
        return $this->hasOne('user','user_id','user_id');
    }
    //关联订单商品
    public function orderInfo(){
        return $this->hasMany('orderInfo','order_id','order_id');
    }
    //生成订单号
    public function createOrderSn(){
        return 'Order'.date('YmdHis').rand(1000,9999);
    }
    //获取订单状态
    public function getStatusAttr($value,$data)
    {
        return $this->belongsTo('OrderStatus','status','id')->where('id',$value)->value('name');
    }

    /*
     * 订单列表
     * */
    public function order_list($data){
        $where =[];
        if(isValue($data,'order_id')){
            if(is_array($data['order_id'])){
                $where['order_id']     = ['in',$data['order_id' ]];
            }else{
                $where['order_id']     = $data['order_id' ];
            }
        }
        if(isValue($data,'user_id')){
            $where['user_id']     = $data['user_id' ];
        }
        if(isValue($data,'user_name')){
            $where['user_name']     = $data['user_name' ];
        }
        if(isValue($data,'order_sn')){
            $where['order_sn']    = $data['order_sn' ];
        }
        if(isValue($data,'datestart') && isValue($data,'dateend')){
            $datestart            = strtotime($data['datestart' ]);
            $dateend              = strtotime($data['dateend' ]);
            $where['create_time'] = ['BETWEEN',[$datestart,$dateend]];
        }
        if(isset($data['goods_id'])){
            if(!empty($data['goods_id'])){
                $where['order_id']   =['in',$data['goods_id']] ;
            }
        }
        if(isValue($data,'status')){
            $where['status']      = $data['status' ];
            if($data['status']==4){
                $order_status=4;
            }
        }
         if(isset($data['recycle'])){//回收站
             $where['recycle']   = $data['recycle'];
         }
        if(isset($data['page'])){//显示页数
            $page                 = $data['page'];
        }else{
            $page                 = 1;
        }
        unset($data['page']);
        unset($data['size']);
        $query  = $data;
        $orders = $this->where($where)->order('update_time desc')->paginate('',false,['page'=>$page,'query' => $query]);
        foreach ($orders as $k => &$v){
            if(isset($order_status)){
                $v['order_status'] =$order_status;
            }
            $v['user_id']          = $v->user->account;
            $v['nickname']         = $v->user->nickname;
            if($v->province1->city_name){
                $v['province']        = $v->province1->city_name;
            }else{
                $v['province']        = '-----';
            }
            
            $v['city']            = $v->city1->city_name;
            $v['area']             = $v->area1->city_name;
            $v['statusText']      = $this->status($v['status']);
        }
        return $orders;
    }
    /*
     * 订单id
     * */
    public  function orders_id($data){
        if(isValue($data,'user_id')){
            $where['user_id']     = $data['user_id' ];
        }
        $where['status']          = 2;
        $array_id = $this->where($where)->field('order_id')->order('create_time desc')->select();
        resultToArray($array_id);
        foreach ($array_id as $key => &$val){
           $array_id[$key]        = $val['order_id'];
        }
        return $array_id;
    }
    /*
     * 订单详情
     * */
    public  function oder_info($order_sn){
          if($order_sn){
              $where['order_sn']  = $order_sn;
              $order = $this->where($where)->hasWhere('shop',['shop_id'=>5])->find();
              $order['shop_id']   = $order->shop->shop_name;
              $order['user_id']   = $order->user->account;
              $order['province']  = $order->province1->city_name;
              $order['city']      = $order->city1->city_name;
              $order['area']      = $order->area1->city_name;
              $order['statusText']    = $this->status($order['status']);
              $order['all_price'] = bcadd($order['despatch_money'],$order['deal_price'],2);
              dump($order);
              return  $order->toArray();
          }
    }
    /*
     * 客户修改订单
     * **/
    public function edit_order($arr,$order_id){
        foreach ($arr as $key => &$val){
            $val['order_id']      = $order_id[$val['order_sn']];
        }
        return $this->saveAll($arr);
    }
    /*
     * 用户ID查所有订单ID
     * */
    public  function orders($user){
        if(isset($user['user_id'])){
            $where['user_id'] = $user['user_id'];
        }
        if(isset($user['shop_id'])){
            $where['shop_id'] = $user['shop_id'];
        }
        if(isset($user['recycle'])){
            $where['recycle'] = $user['recycle'];
        }
        $orders = $this->where($where)->field('order_id')->select();
        resultToArray($orders);
        foreach ($orders as $k =>$v){
            $orders[$k]           = $v['order_id'];
        }
        return $orders;
    }
    /*
     * 流水号查订单编号
     * */
    public function order_sn($data){
        if(isValue($data,'serial_sn')){
            $where['serial_sn']   = $data['serial_sn' ];
        }
        $order_sn_arr  = $this->where($where)->field('order_id,order_sn,shop_id')->select();
        resultToArray($order_sn_arr);
        $arr = [];
        foreach ($order_sn_arr as $key =>$val){
            $arr['order_sn'][$val['shop_id']]  = $val['order_sn'];
            $arr['order_id'][$val['order_sn']] = $val['order_id'];
        }
        return  $arr;
    }
    /*
     *不同状态下的订单数量
     * */
    public  function recycle($data){
        if(isValue($data['recycle'])){
            $where['recycle'] = $data['recycle'];
        }
        if(isValue($data['user_id'])){
            $where['user_id'] = $data['user_id'];
        }
        $status = $this ->where($where)->field('status')->select();
        resultToArray($status);
        $status['all']=count($status);$status['money']=0;$status['delivery']=0;$status['evaluation']=0;$status['momentum']=0;$status['reimburse']=0;
        foreach ($status as $key =>&$val){
            if($val['status']==2){
                $status['money'] +=1;//未付款
            }elseif ($val['status']==4){
                $status['momentum']+=1;//待发货
            }elseif ($val['status']==5){
                $status['delivery']+=1;//已发货/待收货
            }elseif ($val['status']==7){
                $status['reimburse']+=1;//申请退款
            }elseif ($val['status']==11){
                $status['evaluation']+=1;//未评价
            }
        }
        return $status;
    }
    /**
     *商铺本月订单数量,购买人数以及总金额
     */
    public function shop_order_info($month,$shop_id){
        $order['money']=0;$order['order_num']=0;$order['t_money_num']=0;$order['user_num']=0;$user=[];
        $shop_order = $this->where(['create_time'=>['>=',$month],'shop_id'=>$shop_id])->select();
        $order['order_num']= count($shop_order);//订单量
        foreach ($shop_order as $k => $v){
            $user[] = $v['user_id'];
            $order['money'] += ($v['deal_price']+$v['despatch_money']);//订单总额
            if($v['status']==9){
                $order['t_money_num'] +=  1;//退款订单数量
            }
        }
        $order['money']= sprintf("%.2f",$order['money']);//订单总额保留2未小数
        $order['user_num']=count(array_unique($user)) ;//不同买家数量
        return $order;
    }
    /**
     * 待发货订单
     * by wanggang 2017/9/12
     */
    public function shipping_order($data,$where=array()){
        if(isValue($data,'order_sn')){
            $where['order_sn']     = ['like','%'.$data['order_sn' ].'%'];
        }
        if(isValue($data,'status')){
            $where['status']     = $data['status'];
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
        if(isValue($data,'statr_time') && isValue($data,'end_time')){
            $statr_time = strtotime($data['statr_time']);
            $end_time   = strtotime($data['end_time']);
            $where['create_time'] =['BETWEEN',[$statr_time,$end_time]];
        }
        $query  = $data;
        $list=$this->where($where)->order('create_time desc')->paginate('',false,['query' => $query]);
        resultToArray($list);
        foreach ($list as $key => $value) {
            $order_info = model('orderInfo')->where('order_id',$value['order_id'])->find();
            if($order_info){
                $list[$key]['order_info1'] = $order_info->toArray();
            }else{
                $list[$key]['order_info1'] = array();
            }
            if($value->user){
                $list[$key]['user_info']  = $value->user->data;
            }else{
                $list[$key]['user_info']  = array();
            }
            $list[$key]['status_name']    = $this->status($value['status']);
            $list[$key]['paytype']        = model('payConfig')->where('id',$value['paytype'])->value('pay_name');
        }
        return $list;
    }

    /**
     *订单状态
     *by wanggang 2017/9/13
     */
    public function status($val){
        $all_status = model('OrderStatus')->select();
        $status = array();
        foreach ($all_status as $key => $value) {
            $status[$value['status_value']] = $value['name'];
        }
        return $status[$val];
    }
    /**
     * 订单详情
     * by wanggang 2017/9/13
     */
    public function get_order_info($order_id){
        $info = $this->where('order_id',$order_id)->find();
        if($info){
            $info = $info->toArray();
            $order_info = model('orderInfo')->where('order_id',$order_id)->find();
            if($order_info){
                $info['order_info'] = $order_info->toArray();
            }else{
                $info['order_info'] = array();
            }
            $user_info = model('user')->where('user_id',$info['user_id'])->find();
            if($user_info){
                $info['user_info']  = $user_info->toArray();
            }else{
                $info['user_info']  = array();
            }
            $info['status_name']   = $this->status($info['status']);
            $info['paytype']       = model('payConfig')->where('id',$info['paytype'])->value('pay_name');
            $info['province_name'] = $this->get_city_name($info['province']);
            $info['city_name']     = $this->get_city_name($info['city']);
            $info['area_name']     = $this->get_city_name($info['area']);
        }else{
            $info = array();
        }
        return $info;
    }

    public function get_city_name($city_id){
        $city_name = model('city')->where('city_id',$city_id)->value('city_name');
        return $city_name;
    }

    //销售额统计 绘图
    public function get_earnings_data(){
        $arr = array();
        for ($i=0; $i <date("j") ; $i++) { 
            $time = strtotime(date('Y').'-'.date('m').'-'.($i+1));
            $end_time = $time+86400;
            $day_price = model('order')->where(['status'=>6,'create_time'=>['BETWEEN',[$time,$end_time]]])->column('deal_price');
            // dump($day_price);
            $arr[$i] = array_sum($day_price);
        }
        return  $arr;
    }

    //订单详情
    public function get_order_detail($order_id){
        $order = $this->field('order_id,order_sn,create_time,user_name,total_price,deal_price,user_phone,despatch_money,province,city,area,address,status,create_time')
        ->with([
            'orderInfo'=>function($query){
                $query->field('order_id,goods_id,goods_name,good_image,good_attr,goods_count,market_price,price');
            },
            'province1'=>function($query){
                $query->field('city_id,city_code,city_name');
            },
            'city1'=>function($query){
                $query->field('city_id,city_code,city_name');
            },
            'area1'=>function($query){
                $query->field('city_id,city_code,city_name');
            },
            
        ])
        ->find($order_id);

        $address = '';
        if(!empty($order->province1)){
            $address .= $order->province1->city_name.' ';
            unset($order->province1);
            unset($order->province);
        }
        if(!empty($order->city1)){
            $address .= $order->city1->city_name.' ';
            unset($order->city1);
            unset($order->city);
        }
        if(!empty($order->area1)){
            $address .= $order->area1->city_name.' ';
            unset($order->area1);
            unset($order->area);
        }
        $order['addr'] = $address;

        if(!empty($order['order_info'])){
            foreach ($order['order_info'] as $key => $value) {
                $value['good_attr'] = unserialize($value['good_attr']);
            }
        }


        return $order;
    }


}