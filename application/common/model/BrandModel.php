<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 商品模型
 * @author  wangang 
 * @version 2017/5/20
 */
class BrandModel extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
}