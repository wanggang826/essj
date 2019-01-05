<?php
namespace app\common\validate;
use think\Validate;
/**
 * 菜单验证器
 */
class Nav extends Validate
{
    protected $rule = [
        ['name',        'require',                                        '导航名不能为空'],
        ['url_type',    'require',                                        'URL类型不能为空'],
        ['type',        'require',                                        '导航位置不能为空' ],
        ['open_way',    'require',                                        '打开方式不能为空' ],
        ['module',      'requireIf:url_type,1|regex:^[a-zA-z]+\w+',    '模块不能为空|模块必须以字母开头'],
        ['controller',  'requireIf:url_type,1|regex:^[a-zA-z]+\w+',   '控制器不能为空|控制器必须以字母开头'],
        ['action',      'requireIf:url_type,1|regex:^[a-zA-z]+\w+',   '方法不能为空|方法必须以字母开头'],
        ['url',         'requireIf:url_type,2|unique:menu',             'url不能为空|url地址已存在'],
        ['sort',        'integer',                                        '排序必须为整数'],
    ];

    protected $scene = [
        'add'   =>  ['name','module','controller','action','url','url_type','pid','sort','type','open_way'],
        'edit'  =>  ['name','module','controller','action','url','url_type','sort','pid','type','open_way'],
    ];

}