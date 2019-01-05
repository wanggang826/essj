<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 管理员模型
 * @author wanggang 2017/5/13
 */
class GoodsCateAttr extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    public function attr(){
        return $this->HasOne('GoodsAttr','attr_id','attr_id');
    }

    public function select_attr($id){
    	$attr_id = $this->where('cate_id ='.$id)->column('attr_id');
        $attr = model('GoodsAttr')->where(['attr_id'=>['in',$attr_id]])->order('sort asc')->select();
        foreach ($attr as &$v) {
            $v['value'] = unserialize($v['value']);
        }
    	return $attr;
    }
}