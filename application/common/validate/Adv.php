<?php
namespace app\common\validate;
use think\Validate;
/**
 * 广告验证器
 */
class Adv extends Validate{

    protected $rule = [
        ['adv_title',     'require|unique:Adv|length:1,50',   '标题不能为空|标题已存在|标题名称长度为1-50个字符'],
        ['adv_url',     'require',   '链接不能为空'],
        ['bg_color',   'require',    '请输入图片背景颜色'],
        ['start_time',  'require|checkEndTime',     '请选择开始时间'],
        ['adv_price',   'require|number',    '请输入价格|价格必须为整数'],
    ];

    protected $scene = [
        'add'   =>  ['adv_title','adv_url','bg_color','start_time','end_time','adv_price'],
        'edit'  =>  ['adv_title','adv_url','bg_color','start_time','end_time','adv_price'],
    ];

    public function checkEndTime($arg,$rule,$data){
        if(!$data['end_time']) return '请选择结束时间'; 
    	if ($arg > $data['end_time']) {
    		return '结束时间必须大于开始时间';
    	}
    	return true;
    }   
}
