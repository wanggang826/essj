<?php
namespace app\shop\controller;
use think\Cookie;
use think\session;
header("Content-type: text/html; charset=utf-8");
class Cart extends MallBase
{
    public function index()
    {
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 1,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        $data['user_id']  = session('user.user_id');
        $data['status']      = 1;
        $cart_data=model('ShoppingCart')->select_doods($data);
        return view(['cart_data'=>$cart_data]);
    }

    /*
     * 加入购物车
     * */
    public function shopping_cart(){
        if($_POST){
            $user= session::get('user');
            $data = input();
            foreach ($data as $key => $val){//将商品属性转成数组
                $number = strrpos($key,'_attr');
                if($number){
                    $attr_name  = substr($key,0,$number);
                    $data['good_attr'][$attr_name] = $val;
                    unset($data[$key]);
                }
            }
            $data['user_id']        = $user['user_id'];
            $data['total_price']    = $data['present_price']*$data['good_count'];//单价乘以数量加运费
            $where=[];
            if(!empty($data['good_attr'])){//商品有属性
                $data['good_attr']  = serialize($data['good_attr']);//将商品属性序列化
                $where['good_attr'] = $data['good_attr'];
            }else{
                $where['good_attr']=array('exp', 'IS NULL');;
            }
            $where += [//查看是否之前有加入同样商品
                "user_id"           => $data["user_id"],
                "shop_id"           => $data["shop_id"],
                "goods_id"          => $data["goods_id"],
                "status"            => 1 ,
            ];
            $this->change_quantity($where,$data);
        }
    }


    /*
     * 改变商品数量
     * */
    public function change_quantity($where='',$data='')
    {
        $id=input("post.id",0);
        if($id){
            $id=input("post.id",0);
            $data=model('shopping_cart')->where("id={$id}")->find();
            $data['good_count']=input("post.good_count",'1');
            $data['ugood_count']=$data['good_count'];//直接改变的数值
            $where=[];
            if(!empty($data['good_attr'])){//商品有属性
                $where['good_attr'] = $data['good_attr'];
            }else{
                $where['good_attr']=array('exp', 'IS NULL');;
            }
            $where += [//查看是否之前有加入同样商品
                "user_id"           => $data["user_id"],
                "shop_id"           => $data["shop_id"],
                "goods_id"          => $data["goods_id"],
                "status"            => 1 ,
            ];
        }
        $ugood_count=isset($data['ugood_count'])?$data['ugood_count']:"";
        $validate = model('ShoppingCart')->checked_goods($where,$data['good_count'],$ugood_count);
        switch ($validate){
            case 1:
                $same = model('ShoppingCart')->same_good($where);//查是否存在同一商品
                if($same){//购物车有同样商品,作修改
                    $re = model('ShoppingCart') ->update_goods($data,$same);
                }else{//添加
                    $data['status'] = 1;
                    $re = model('ShoppingCart')->add($data);
                }
                if($re){
                    $cart_goods = model('ShoppingCart')->where($where)->find();
                    $cart_goods['cart_total']=model('ShoppingCart')->cart_total($data["user_id"]);
                    Api()->setApi('msg',"添加成功！")->setApi('url',0)->setApi('data',$cart_goods)->ApiSuccess();
                }else{
                    Api()->setApi('msg','添加失败!')->ApiError();
                }
                break;

            case 0://库存不足
                Api()->setApi('msg','商品库存不足!')->setApi('url',0)->ApiError();
                break;
            case -1://商品不存在或者已下架
                Api()->setApi('msg','商品不存在或者已下架!')->ApiError();
                break;
        }
    }

    /*
     * 删除购物车商品
     * */
    public function delect_goods($ids){
        $res=model('ShoppingCart')->delect_goods($ids);
        if($res){
            $user= session::get('user');
            $cart_total=model('ShoppingCart')->cart_total($user["user_id"]);
            Api()->setApi('msg',"删除成功！")->setApi('url',0)->setApi('data',$cart_total)->ApiSuccess();
        }else{
            Api()->setApi('msg','删除失败!')->ApiError();
        }
    }

}
