<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 分类banner模型
 * @author wanggang 2017/6/11
 */
class CateBanner extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /**
     * 查询
     */
    public function select_banner($where=array()){
    	$list = $this->where($where)->select();
    	resultToArray($list);
    	return $list;
    }
    /**
     * 新增
     */
    public function add_banner_set($data){
        $data['start_time']   = strtotime($data['start_time']);
        $data['end_time']   = strtotime($data['end_time']);
    	$re = $this->save($data);
    	return $re;
    }

    public function edit_banner($data){
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time']   = strtotime($data['end_time']);
        $result = $this->save($data,['banner_id'=>$data['banner_id']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    
}