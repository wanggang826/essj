<?php
namespace app\common\validate;
use think\Validate;
/**
 * 广告验证器
 */
class Articles extends Validate{

    protected $rule = [
        ['article_title',     'require',        '文章标题不能为空'],
        ['href',               'require|unique:article',        '文章链接不能为空|该链接已存在'],
    ];

    protected $scene = [
        'add'   =>  ['article_title','href'],
        'edit'  =>  ['article_title'],
    ];
    
}