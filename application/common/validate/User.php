<?php
namespace app\common\validate;
use think\Validate;
/**
 * 用户管理验证器
 */
class User extends Validate
{

    protected $rule = [
        ['account',     'require|unique:User|alphaDash|length:5,50|regex:^[a-z][a-z0-9_]{4,20}$',                        '用户名不能为空|用户名已存在|用户名只允许字母、数字和下划线 破折号|用户名长度为5-20个字符|用户名必须以字母开头'],
        ['password',    'require',                           '密码不能为空'],
        ['phone',       ['regex'=>'/^1[3|4|5|7|8][0-9]{9}$/','unique:User'],    '手机格式错误|手机号码已存在'],
        ['email',       'unique:User|email',                            '此用户邮箱已存在|邮箱格式错误'],
    ];

    protected $scene = [
        'add'    =>  ['account','password','phone','email'],
        'edit'	 =>	['phone','email'],
        'login' =>  ['account','password'],
        'reg'   =>  ['account','password','phone'],
    ];

    public function checkPass($arg){
        $reg = '/^\w+$/';
        if (preg_match($reg,$arg)){
            return true;
        }
        return '密码格式用户名只允许字母、数字组合';
    }
}