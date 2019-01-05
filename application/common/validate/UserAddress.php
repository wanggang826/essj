<?php
namespace app\common\validate;
use think\Validate;
/**
 * 用户管理验证器
 */
class UserAddress extends Validate
{

    protected $rule = [
        ['user_name',       'require',          '用户名不能为空'],
        ['address',         'require',          '地址不能为空'],

    ];
    protected $scene = [
        'add'    =>  ['user_name','address'],
    ];
}