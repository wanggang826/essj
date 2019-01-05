<?php
namespace app\common\validate;
use think\Validate;

class OrderStatus extends Validate{
	 protected $rule = [
        ['name',               'require|unique:OrderStatus',            '状态名称不能为空|状态名称已存在'],
        ['order',              'regex:^-?\\d+$',                        '排序必须位数字'],
        ['status',             'require' ,                              '状态必选']
    ];
    protected $scene = [
        'add'   =>  ['name','order','status_value'],
        'edit'	=>	['name','order','status_value'],
    ];    
}