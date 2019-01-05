<?php
namespace app\common\validate;
use think\Validate;
/**
 * 广告验证器
 */
class ArticleCates extends Validate{

    protected $rule = [
        ['cate_name',     'require',   '标题不能为空'],
    ];

    protected $scene = [
        'add'   =>  ['cate_name'],
        'edit'  =>  ['cate_name'],
    ];
}