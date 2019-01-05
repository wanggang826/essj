<?php
namespace app\common\validate;
use think\Validate;

class GoodsBrand extends Validate{
	 protected $rule = [
        ['brand_name',     'require|unique:GoodsBrand',                        '品牌名称不能为空|品牌名称已存在'],
        ['des',    'length:0,240',                          '备注长度不可大于240个字符'],
    ];
    protected $scene = [
        'add'   =>  ['brand_name','des'],
        'edit'	=>	['brand_name','des'],	 
    ];    
}