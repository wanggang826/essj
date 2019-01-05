<?php
namespace app\common\validate;
use think\Validate;
/**
 * 广告位验证器
 */
class Advpos extends Validate{

    protected $rule = [
        ['advpos_name',     'require|unique:Advpos|length:1,50',   '名称不能为空|名称已存在|名称长度为1-50个字符'],
        ['advpos_type',     'require',                          '请选择类型'],
        ['advpos_ename',     'require|unique:Advpos|regex:^[a-zA-z]+\w+',   '标识不能为空|标识已存在|标识只能为字母数字加下划线且以字母开头'],
        ['advpos_width',    'number',    '广告位宽度必须为整数'],
        ['advpos_height',   'number',    '广告位高度必须为整数'],
        ['img_num',         'require|number|lt:6',    '请输入可放置图片个数|可放置图片个数必须为整数|可放置图片个数最多为5个'],
    ];

    protected $scene = [
        'add'   =>  ['advpos_name','advpos_type','advpos_ename','advpos_width','advpos_height','img_num'],
        'edit'  =>  ['advpos_name','advpos_type','advpos_width','advpos_height','img_num'],
    ];    
}
