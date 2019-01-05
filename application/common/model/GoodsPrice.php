<?php
namespace app\common\model;
use think\Model;
/**
 * 商品 属性 价格 模型
 * @author  wangang 
 * @version 2017/10/12
 */
class GoodsPrice extends Model{

    //关联商品
    public function goods(){
        return $this->belongsTo('Goods','goods_id','goods_id');
    }
}