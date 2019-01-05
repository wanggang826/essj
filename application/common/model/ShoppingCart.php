<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * Created by pengqiang.
 * Date: 2017/6/16 0016
 * Time: 下午 2:53
 */
class ShoppingCart extends Model{
    use SoftDelete;
    //店铺关联
    public function shop(){
        return $this->hasOne('Shop','shop_id','shop_id');
    }

    //商品关联
    public function goods(){
        return $this->hasOne('Goods','goods_id','goods_id');
    }
    /*
     * 添加商品到购物车
     * */
    public function add($data){
        $bool = $this->save($data);
        return $bool;
    }
    /*
     * 查看购物车
     * */
    public function select_doods($data){
        $goods = $this->where($data)->select();
        foreach ($goods as $key => &$val){
            $array_id[$key] = $val['shop_id'];
        }
        if(isset($array_id)){
            $array_shop_id = array_unique($array_id);
            foreach($array_shop_id as $ke =>$va){
                foreach ($goods as $k => &$v){
                    if($va == $v['shop_id']){
                        $shop_name  = $v->shop->shop_name;
                        $collection_where['target_id']=$v['goods_id'];
                        $collection_where['user_id']=$v['user_id'];
                        $goods[$k]['collection']=model('Collection')->where($collection_where)->value('collection_id');
                        $v['good_attr'] =$v['good_attr']? unserialize($v['good_attr']):'';
                        $new_orders['shop'][$shop_name]['goods'][] = $goods[$k] ;//某商铺购买的东西
                        $new_orders['shop'][$shop_name]['shop_id'] = $v['shop_id'];
                        if($v['despatch_money']>0) {//某商铺的物流费
                            if(!isset($new_orders['shop'][$shop_name]['despatch_money']) || $new_orders['shop'][$shop_name]['despatch_money']==0){
                                $new_orders['shop'][$shop_name]['despatch_money'] = $v['despatch_money'];
                                $despatch_money[]=$v['despatch_money'];
                            }
                        }else{
                            if(!isset($new_orders['shop'][$shop_name]['despatch_money'])){
                                $new_orders['shop'][$shop_name]['despatch_money'] = $v['despatch_money'];
                                $despatch_money[]=$v['despatch_money'];
                            }
                        }
                    }
                }
            }
            $total=$this->cart_total($data['user_id']);
            $new_orders['money'] = $total['total_price'];
            $new_orders['kind_num']=$total['kind_num'];
            $new_orders['goods_count']=$total['goods_count'];
            return $new_orders;
        }
    }
    /*
     * 查ID
     * */
    public function select_goods_id($data){
        $id = $this->where($data)->field('id,goods_id')->select();
        resultToArray($id);
        $arr = [];
        foreach ($id as $k => $v){
            $arr[$v['goods_id']]  = $v['id'];
        }
        return $arr;
    }

   /*
    * 修改流水号下的所有商品的数量.总价
    * */
   public function  deit_cart($good_arr){
       foreach ($good_arr as $k =>&$v){
           unset($v['goods_count'],$v['price'],$v['deal_price'],$v['delete_time'],$v['update_time'],$v['create_time']);
       }
      return $this->saveAll($good_arr);
   }


    /*
     * 查同一用户是否有相同的商品
     * */
    public function same_good($where=array()){
        unset($where['present_price']);
        if($where['good_attr']==null){
            $where['good_attr']=array('exp', 'IS NULL');
        }
        $same = $this->where($where)->field('id,good_count,total_price,despatch_money')->select();
        if(!empty($same)){
            resultToArray($same);
            return  $same[0];
        }else{
           return false;
        }
    }
   /*
    * 修改商品(同用户加入同一商品同属性)/购物车加减
    * */
     public function update_goods($data,$same=""){
         if(isset($data['ugood_count']) && !empty($data['ugood_count'])){
             $new_data['good_count']=$data['ugood_count'];
         }else{
             $new_data['good_count'] =$data['good_count']+ $same['good_count'];
         }
         $new_data["total_price"]=sprintf("%.2f",$new_data['good_count']*$data["present_price"]);//相乘保留两位小数
         return  $re = $this->save($new_data,['id'=>$same['id']]);
     }


    /*
     * 查询商品是否下架或库存是否足够
     * */
    public function checked_goods($where,$buy_num,$updata_num='')
    {
        $gwhere['goods_id']=$where['goods_id'];
        $gwhere['is_sale']=1;
        $goods_data=model("goods")->where($gwhere)->find();
        $cart_count=$this->where($where)->value("good_count");
        $cart_count=$cart_count?$cart_count:0;
        if(isValue($goods_data)){
            if(!$updata_num){
                $updata_num=$buy_num+$cart_count;
            }
            if($updata_num>$goods_data['book_quantity']){
                return 0;//库存不足
            }else{
                return 1;
            }
        }else{
            return -1;//无产品或已下架
        }
    }

    /*
     * 购物车总数和总价
     * */
    public function cart_total($user_id){
        $where['user_id']=$user_id;
        $where['status']=1;
        $goods = $this->where($where)->select();
        $total['kind_num']=0;//商品样数
        $total['goods_count']=0;
        $total['total_price']=0;
        foreach ($goods as $k=>$v){
            $total['kind_num']+=1;
            $total['goods_count']+=$v['good_count'];
            $total['total_price']+=$v['total_price'];
        }
        $total['total_price']=sprintf("%.2f",$total['total_price']);
        return $total;
    }

    /*
     * 删除购物车商品
     * */
    public function delect_goods($ids){
        $res=$this->where("id",'in',$ids)->delete();
        return $res;
    }
}
