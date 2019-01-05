<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 邮箱验证码模型
 * @author wanggang 2017/6/11
 */
class EmailCode extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
}