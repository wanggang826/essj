<?php
namespace app\common\validate;
use think\Validate;

class Shop extends Validate{
	 protected $rule = [
        ['user_id',         'unique:Shop',                      '一个用户只能注册一家店铺'],
        ['shop_sn',         'unique:Shop',                      '店铺编码重复,请重新提交数据'],
        ['idcard_sn',       'unique:Shop',                      '身份证号码已存在'],
        ['phone',           'unique:Shop',                      '手机号码已存在'],
    ];
    protected $scene = [
        'apply_seller'       =>          ['user_id','shop_sn','idcard_sn','phone'],//卖家审核
        'edit'	             =>	         ['idcard_sn','phone'],
    ];  

}