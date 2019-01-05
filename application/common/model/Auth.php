<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;

class Auth extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

}