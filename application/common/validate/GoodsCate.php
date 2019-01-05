<?php
namespace app\common\validate;
use think\Validate;

class GoodsCate extends Validate{
	 protected $rule = [
        ['name',     'require',                        '种类名称不能为空'],
        ['sort',    'regex:^-?\\d+$',                          '排序必须位数字'],
    ];
    protected $scene = [
        'add'   =>  ['name','sort'],
        'edit'	=>	['name','sort'],	 
    ];    
}