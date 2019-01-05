<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;

class Collection extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    public function goods(){
    	return $this->hasOne('goods','goods_id','id');
    }

    /**
     * @desc 关联商品
     * @create tiway
     * @return \think\model\relation\BelongsTo
     */
    public function collectionGood(){
        return $this->belongsTo('goods','goods_id','goods_id');
    }

    public function getTotalCollections($user_id){
        return $this->field('id,count(id) as total_collection')->where('user_id',$user_id)->find();
    }

    public function getCollectionList($user_id){

        $result = $this->alias('C')
            ->field('G.goods_id,G.goods_name,G.is_sale,G.goods_thums,GP.id as price_id,GP.campaign_price,GP.price,GP.attrs_values,C.id as collection_id')
            ->join('ui_goods_price GP ',' C.price_id = GP.id')
            ->join('ui_goods G ',' G.goods_id = C.goods_id')
            ->where('C.user_id',$user_id)
            ->select();
        return $result;
    }
}