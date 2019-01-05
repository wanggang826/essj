<?php
/**
 * Created by tiway
 * Date: 2017/9/14
 * Time: 14:20
 */

namespace app\common\validate;


use think\Validate;

class CheckInfo extends Validate
{
    protected $rule = [
        ['check_name',   'max:120',                     '质检报告名称长度需在3-120个字符之间'],
        ['checker',      'require',                     '请输入质检人'],
        ['check_desc',   ['require','max:255'],         '请填写质检描述|长度不能超过255个字符'],

    ];
    protected $scene = [
        'add'   =>  ['check_name','checker','check_desc'],
    ];
}