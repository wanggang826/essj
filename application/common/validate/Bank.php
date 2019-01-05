<?php
namespace app\common\validate;
use think\Validate;

class Bank extends Validate{
	 protected $rule = [
        ['realname',         'require',                        '持有人必填!'],
        ['account',          'require|unique:Bank',            '账号必填!|账号已存在!'],
        ['account_type',     'require',                        '账号类型必选'],
    ];
    protected $scene = [
        'add'   =>  ['realname','account','account_type'],
    ];    
}