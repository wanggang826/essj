<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;

/**
 * 会员等级模型
 * @author  gucangfa
 * @version 2015/5/23
 */
class UserRank extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /*
   	 * 会员等级列表查询
     */
	public function select_rank(){
		$result = $this->order('sort asc')->paginate();
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
	}

	/*
   	 * 会员等级添加
     */
	public function add_rank($data){
		$result = $this->validate('UserRank.add')->save($data);
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
	}

	/*
   	 * 会员等级修改
     */
	public function edit_rank($data){
        $result = $this->validate('UserRank.edit')->save($data,['rank_id'=>$data['rank_id']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
      
    }

}