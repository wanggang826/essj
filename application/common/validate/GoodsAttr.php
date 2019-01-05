<?php
namespace app\common\validate;
use think\Validate;

class GoodsAttr extends Validate{
	 protected $rule = [
        ['attr_name',     'require|unique:GoodsAttr',                        '属性名称不能为空|属性名称已存在'],
    ];
    protected $scene = [
        'add'   =>  ['attr_name','value'],
    ];    
}