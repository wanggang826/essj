<?php
namespace app\shop\controller;
use think\session;
header("Content-type: text/html; charset=utf-8");
class Order extends MallBase
{
    function getGoodsNum (&$val,$key,&$arg){
        $id= $val['goods_id'];
        $val['status']       =  2;
        $val['deal_price']   = $arg[$id]['market_price']*$val['good_count'];
        $val['total_price']  = $arg[$id]['shop_price']*$val['good_count'];
        $val['goods_count'] = $val['good_count'] ;
        $val['price'] = $arg[$id]['shop_price'] ;
    }
    function getOrderId(&$aa,$key,&$order){//订单详情插入orderID
        $aa['order_id']      = $order[$aa['shop_id']];
    }
    function  getOrderImage(&$val,$key,&$image){
        //dump($val);
        $val['good_image']   = $image[$val['goods_id']];
    }
    public function index(){
        $steps = ['填写核对订单信息','订单提交成功','支付成功'];
        $step  = 'step'.input('step',1,'int');
        $this->$step();
        return view($step,[
            'load_search'    =>false,
            'steps'          =>$steps,
        ]);
    }
    protected function step1(){
        $serial_sn           = input('serial_sn');//购物车商品是否有生成流水
        $assign['step']      = 1;
        $user_info = session::get('user');
        $data['user_id']     = $user_info['user_id'];
        $areas               = model('UserAddress')->address_all($data);//用户地址
        $data['status']      = 1;
        $goods               = model('ShoppingCart')->select_doods($data);//用户购物车
        $pay_type            = model("PayConfig")->where(['status'=>1])->select();//支付方式
        $this->assign("serial_sn",$serial_sn);
        $this->assign("pay_type",$pay_type);
        $this->assign("shop_list",$goods);
        $this->assign("areas",$areas);
        $this->assign($assign);
    }
    protected function step2(){
        if($_POST){//购物车去付款
            $good_id=[]; $goods=[]; $order_id_arr=[];
            $data              = input();
            !array_key_exists('paytype',$data)       && Api()->setApi('msg','请选择支付方式!')->ApiError();
            !array_key_exists('user_address',$data)  && Api()->setApi('msg','请选择物流地址!')->ApiError();
            $user_id           = session('user.user_id');
            $address           = model('userAddress')->where('address_id',$data['user_address'])->find()->toArray();
            $address['user_id'] != $user_id && Api()->setApi('msg','物流地址不存在!')->ApiError();
            $good_arr          = array();//订单详情
            $cart_goods_info   = array();
            if(empty($data['serial_sn'])){
                $serial_sn     = getUniqueStr(20,rand(),'O');
            }else{
                $serial_sn     = $data['serial_sn'];
                $order_num_arr = model('order')->order_sn($data);
            }
            foreach ($data['good'] as $shop_id => $shop_good) {
                $cart_id                      = array_keys($shop_good);
                $cart_info                    = model('ShoppingCart')->where(['id'=>['in',$cart_id]])->select();//购物车ID去查商品ID
                resultToArray($cart_info);
                foreach ($cart_info as $k =>&$v){
                    $v['good_count']           = $shop_good[$v['id']];
                    $good_id[$k]               =$v['goods_id'];
                }
                $shop_goods                    = model('Goods')->where(['goods_id'=>['in',$good_id]])->field("goods_id,goods_name,shop_price,market_price,shop_id")->select();
                resultToArray($shop_goods);
                foreach ($shop_goods as $n =>$i){
                    $goods[$i['goods_id']]=$i;
                }
                $shop_good['deal_price']       = 0;$shop_good['total_price'] = 0;$shop_good['shop_id']=0;
                array_walk($cart_info,'self::getGoodsNum',$goods);
                foreach ($cart_info as $key => $val){
                    $shop_good['shop_id']      =  $val['shop_id'];
                    $shop_good['dess']         =  $data['shop'][$val['shop_id']];
                    $shop_good['deal_price']   += $val['deal_price'];
                    $shop_good['total_price']  += $val['total_price'];
                }
                $good_arr = array_merge($good_arr,$cart_info);//订单详情
                if(empty($data['serial_sn'])){
                    $order_sn      = getUniqueStr(20,$shop_id,'B');
                }else{
                    $order_sn      = $order_num_arr['order_sn'][$shop_id];
                }
                $order_sn_arr[]    = $order_sn;//订单编号
                $arr[] = [
                    'serial_sn'    => $serial_sn,
                    'order_sn'     => $order_sn,
                    'user_id'      => $user_id,
                    'shop_id'      => $shop_good['shop_id'],
                    'province'     => $address['area_id1'],
                    'city'         => $address['area_id2'],
                    'area'         => $address['area_id3'],
                    'address'      => $address['address'],
                    'user_name'    => $address['user_name'],
                    'user_phone'   => $address['user_phone'],
                    'paytype'      => $data['paytype'],
                    'despatch_money'=>$data['despatch'][$shop_good['shop_id']],
                    'method'       => '顺丰快递',//物流方式 以后再修正
                    'deal_price'   => sprintf("%.2f",$shop_good['total_price']+$data['despatch'][$shop_good['shop_id']]),
                    'total_price'  => sprintf("%.2f",$shop_good['deal_price']+$data['despatch'][$shop_good['shop_id']]),
                    'status'       => 2,
                    'dess'         => $shop_good['dess'],
                ];
            }
           /*存order表开始*/
            if(empty($data['serial_sn'])){//添加
                $order   = model('order')->saveAll($arr);
            }else{//修改
                $order   = model('order')->edit_order($arr,$order_num_arr['order_id']);
            }
            /*存order表结束*/
            if($order){
                $orderId         =  model('order')->where('serial_sn',$serial_sn)->field('order_id,shop_id')->select();
                $serial_sn_goods =  model('OrderInfo')->orderinfo_id($orderId);
                resultToArray($orderId);
                foreach ($orderId as $id =>$order_sn){
                    $order_id_arr[$order_sn['shop_id']] = $order_sn['order_id'];
                }
                foreach ($good_arr as $f =>$g){
                    $cart_goods_info[] = $good_arr[$f];
                    unset($good_arr[$f]['despatch_money'],$good_arr[$f]['user_id'],$good_arr[$f]['id'],$good_arr[$f]['present_price'],$good_arr[$f]['good_count'],$good_arr[$f]['method'],$good_arr[$f]['create_time'],$good_arr[$f]['update_time'],$good_arr[$f]['delete_time']);
                }
                array_walk($good_arr,'self::getOrderId',$order_id_arr);
                array_walk($good_arr,'self::getOrderImage',$data['image']);
                /*存orderInfo表开始*/
                if(empty($data['serial_sn'])) {//添加
                    $orderinfo = model('orderInfo')->saveAll($good_arr);
                }else{
                    $orderinfo = model('OrderInfo')->edit_info($serial_sn_goods,$good_arr);
                }
                /*存orderInfo表结束*/
                if($orderinfo){
                    /*存shoppingCart表开始*/
                   $shopping        = model('ShoppingCart')->deit_cart($cart_goods_info);
                    /*存shoppingCart表结束*/
                    if($shopping){
                        foreach ($good_arr as $s => $good_info){
                            $good['good_name'][]    =   $good_info['goods_name'];
                        }
                        $good['deal_price']=0;
                        foreach ($arr as $der => $me){
                            $good['deal_price']     +=  $me['deal_price'];
                            $good['deal_price']     =   sprintf("%.2f",$good['deal_price']);
                        }
                        $good['time']               =   date("Y-m-d",time());
                        $good['serial_sn']          =  $serial_sn;
                        $good['areas']              =   $address;
                        $area_arr                   =    model('city')->get_city(['province'=>$address['area_id1'],'city'=>$address['area_id2'],'area'=>$address['area_id3']]);
                        $good['areas']['province']  =    $area_arr['province'];
                        $good['areas']['city']      =    $area_arr['city'];
                        $good['areas']['area']      =    $area_arr['area'];
                        $this->assign('good',$good);
                        $paytype               = input('paytype');
                        $paytype_inc           = $this->theme.'/pay_html/'.$paytype;
                        if (!htmlFileExists($paytype_inc)) {
                            $this->error('支付方式不存在');
                        }
                        $assign['step']        = 2;
                        $assign['paytype_inc'] = $paytype_inc;
                        $this->assign($assign);
                    }
                }else{
                    Api()->setApi('msg','提交订单失败,请重试!')->ApiError();
                }
            }
        }else if(request()->isGet()){//个人中心去付款
            $order_id  = input('order_id');
            $goods     = model('OrderInfo')->new_price($order_id);
            $order     = model('order')->where(['order_id'=>$order_id])->find()->toArray();
            $area_arr  = model('city')->get_city(['province'=>$order['province'],'city'=>$order['city'],'area'=>$order['area']]);
            $order['areas']               = $area_arr;
            $order['areas']['address']    = $order['address'];
            $order['areas']['user_name']  = $order['user_name'];
            $order['areas']['user_phone'] = $order['user_phone'];
            $order['time']                = $order['create_time'];
            $order['deal_price']          = $order['despatch_money'];
            $order['good_name']           = [];
            foreach ($goods as $good => $name){
                $order['good_name'][$good]= $name['goods_name'];
                $order['deal_price']      +=$name['price']*$name['goods_count'];
                $order['deal_price']      = sprintf("%.2f",$order['deal_price']);
            }
            $paytype                      = input('paytype');
            $paytype_inc                  = $this->theme.'/pay_html/'.$paytype;
            if (!htmlFileExists($paytype_inc)) {
                $this->error('支付方式不存在');
            }
            $assign['step']        = 2;
            $assign['paytype_inc'] = $paytype_inc;
            $this->assign('good',$order);
            $this->assign($assign);
        }
    }
    protected function step3(){
        $assign['step']        = 3;
        $this->assign($assign);
    }
}