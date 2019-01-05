<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
class Action extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    public function delAll(){
    	return $this->execute($sql = 'TRUNCATE table `ui_action`');
    }
}
