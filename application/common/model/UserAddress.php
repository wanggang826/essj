<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 用户地址管理模型
 * @author gucangfa
 * @version 2015/5/23
 */
class UserAddress extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /*
     * 用户地址列表查询(默认地址)
     */
    public function select_address($data,$where=array()){
        if(isValue($data,'account')){
            $user = model('user')->where('account|nickname',$data['account'])->find();
            $where['user_id'] = $user['user_id'];
        }
        if(isValue($data,'user_phone')){
            $where['user_phone'] = ['like','%'.(string)$data['user_phone'].'%'];//电话
        }
        if(isValue($data,'user_name')){
            $where['user_name'] = ['like','%'.(string)$data['user_name'].'%'];
        }
        $where['is_default'] = 1;
        $result = $this->where($where)->order('address_id asc')->paginate('',false,['query'=>$data]);
        resultToArray($result);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    //省市关联
    public function province(){
        return $this->hasOne('City','city_id','area_id1');
    }
    public function city(){
        return $this->hasOne('City','city_id','area_id2');
    }
    public function area(){
        return $this->hasOne('City','city_id','area_id3');
    }
    /*
     * 用户地址列表查询(所有)
     * */
    public function address_all($data,$where=array()){
        if(isValue($data,'user_id')){
            $where['user_id'] = $data['user_id'];
        }
        $result = $this->where($where)->order('address_id asc')->paginate('',false,['query'=>$data]);
        foreach ($result as $key=>&$val){
            $result[$key]['area_id1'] = $val->province->city_name;
            $result[$key]['area_id2'] = $val->city->city_name;
            $result[$key]['area_id3'] = $val->area->city_name;
        }
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    /*
     * 用户地址详情查询
     */
    public function detail_address($data){
        $result = $this->where('user_id ='.$data['user_id'])->order('address_id asc')->select();
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
      
    }

    /*
    * 添加收货地址
    */
    public function add_address($data){
        $result = $this->validate('UserAddress.add')->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /*
    * 编辑收货地址
    */
    public function edit_address($data){
        $result = $this->validate('UserAddress.edit')->save($data,['address_id'=>$data['address_id']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

}