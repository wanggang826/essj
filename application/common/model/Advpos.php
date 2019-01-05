<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;

/**
 * 广告位管理模型
 * @author gucangfa
 * @version 2017/5/13
 */
class Advpos extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /**
    * 关联广告
    */
    public function adv(){
        return $this->hasOne('Adv','adv_pos','advpos_id')->field('adv_id');
    }
    /**
     * 广告位列表查询
    */
    public function select_advpos($data,$where=array()){
        if(isValue($data,'searchText')){
            $where['advpos_name'] = ['like','%'.(string)input('searchText').'%'];
            if(isValue($data,'advpos_type')){
                $where['advpos_type'] = (string)$data['advpos_type']; 
            }  
        }elseif(isValue($data,'advpos_type')){
                $where['advpos_type'] = (string)$data['advpos_type']; 
        }
        $list = $this->where($where)->order('advpos_id desc')->paginate('',false,['query' => $data]);
        // resultToArray($list);
        foreach ($list as $v) {
            if(!empty($v->adv->adv_id)){
                $v['adv'] = '1';//存在广告
            }else{
                $v['adv'] = '-1';//不存在广告
            }
        }
        return $list;
    }

    /**
     * 广告位添加
    */
    public function add_advpos($data){
    	$result = $this->validate('advpos.add')->save($data);
    	if($result === false){
    		return $this->getError();
    	}else{
    		return $result;
    	}
    }

    /**
     * 广告位修改
    */
    public function edit_advpos($data){
    	$result = $this->validate('advpos.edit')->save($data,['advpos_id'=>$data['advpos_id']]);
    	if($result === false){
    		return $this->getError();
    	}else{
    		return $result;
    	}
    }

    /*
    * 获取广告位id
    */
    public function select_id($data){
        $result = $this->where("advpos_ename = ".$data. "AND status = 1")->value('advpos_id');
        if($result === false){
            return $this->getError();
        } else {
            return $result;
        }
    }

}
