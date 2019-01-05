<?php
namespace app\common\validate;
use think\Validate;

class Shipping extends Validate{
	protected $rule = [
        ['shipping_name',     'require|unique:shipping',                        '物流名称不能为空|物流名称已存在'],
        ['sort',    'regex:^-?\\d+$',                          '排序必须位数字'],
    ];
    protected $scene = [
        'add'   =>  ['shipping_name','sort'], 
    ];    
}