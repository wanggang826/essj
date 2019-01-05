<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 类别模型
 * @author wanggang 2017/5/22
 */
class GoodsCate extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    // //分类 商品关联
    // public function goods(){
    //     return $this->hasMany('goods','goods_id','goods_id');
    // }
    /**
	 * 新增类别
	 */
	public function add_cate($data){
		$result = $this->validate('GoodsCate.add')->save($data);
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
	}

	/**
	 * 编辑类别
	 */
	public function edit_cate($data){
		$result = $this->validate('GoodsCate.edit')->save($data,['cate_id'=>$data['cate_id']]);
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
	}
}