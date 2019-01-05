<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 管理员模型
 * @author wanggang 2017/5/13
 */
class GoodsCateBrands extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    public function select_brand($id){
    	$result = $this->where('cate_id ='.$id)->select();
    	foreach ($result as &$v) {
    		$v['brand_name'] = model('GoodsBrand')->where('status = 1 AND brand_id ='.$v['brand_id'])->value('brand_name');
    	}
    	return $result;
    } 
    
}