<?php
namespace app\common\validate;
use think\Validate;

class GoodsComment extends Validate{
	 protected $rule = [
        ['comment',     'require',                        '评论不能为空'],
    ];
    protected $scene = [
        'add'   =>  ['comment'],
    ];    
}