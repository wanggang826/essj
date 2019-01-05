<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 品牌模型
 * @author wanggang 2017/5/21
 */
class GoodsBrand extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    //关联品牌类型
    public function brandModel()
    {
        return $this->hasMany('BrandModel','brand_id','brand_id');
    }
	/**
	 * 商品列表查询
	 */
	public function select_brand($data,$where=array()){
		if(isValue($data,'brand_name')){
			$where['brand_name'] =['like','%'.(string)$data['brand_name'].'%'];
		}
		if(isValue($data,'status')){
			$where['status']=['eq',$data['status']];
		}
        $query =$data;
		$list=$this->where($where)->order('brand_id desc')->paginate('',false,['query' => $query]);
		resultToArray($list);
		return $list;
	}
	/**
     * 新增品牌 
     */
    public function add_brand($data){
    	$result = $this->validate('GoodsBrand.add')->save($data);
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
    }
    /**
     * 编辑品牌
     */
    public function edit_brand($data){
        unset($data['page']);
    	$result = $this->validate('GoodsBrand.edit')->save($data,['brand_id'=>$data['brand_id']]);
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
    }
}