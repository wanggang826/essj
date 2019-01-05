<?php
namespace app\common\validate;
use think\Validate;
/**
 * 会员等级验证器
 */
class UserRank extends Validate
{

    protected $rule = [
        ['rank_name',     	'require|unique:UserRank','等级类别不能为空|等级类别已存在'],
        ['start_score',    	'require|number',                          '开始积分不能为空|开始积分只能输入数字'],
        ['end_score',    	'require|number',                          '结束积分不能为空|结束积分只能输入数字'],
        ['sort',       		'number',    						'排序只能输入数字'],
    ];

    protected $scene = [
        'add'   =>  ['rank_name','start_score','end_score','sort'],
        'edit'  =>  ['rank_name','start_score','end_score','sort'],
    ];    
}