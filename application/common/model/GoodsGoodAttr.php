<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 商品-属性模型
 * @author 
 * @version wanggang 2017/5/12
 */
class GoodsGoodAttr extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /**
     * 关联属性名称
     */
    public function attr(){
        return $this->hasOne('GoodsAttr','attr_id','attr_id');
    }
    /**
     * 获取商品属性
     * @author wanggang
     * @version 2017/07/4
     */
    public function get_attr($goods_id){
        $lists = $this->where('goods_id',$goods_id)->select();
        foreach ($lists as $key =>$val) {
            $lists[$key]['value']  = unserialize($val['value']);
            if($val->attr->attr_name){
                $lists[$key]['attr_name'] = $val->attr->attr_name;
            }else{
                $lists[$key]['attr_name'] = "--";
            }
        }



        return $lists;
    }


}