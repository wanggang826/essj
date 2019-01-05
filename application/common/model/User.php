<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
use extend\Encrypt;
/**
 * 用户管理模型
 * @author  gucangfa 
 * @version 2017/5/10
 */
class User extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /*
     * 用户列表查询
     */
    public function select_user($data,$searchText,$type,$where=array()){
        if(isValue($data,'account')){
            $where['account'] =['like','%'.(string)$data['account'].'%'];
        }
        if(isValue($data,'nickname')){
            $where['nickname'] =['like','%'.(string)$data['nickname'].'%'];
        }
        if(isValue($data,'phone')){
            $where['phone'] =['like','%'.(string)$data['phone'].'%'];
        }
        if(isValue($data,'email')){
            $where['email'] =['like','%'.(string)$data['email'].'%'];
        }
        $result = $this->where($where)->order('user_id desc')->paginate('',false,['query' => $data]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    /*
     * 新用户注册
    */
    public function reg($data){
        $re = $this->validate('user.reg')->save($data);
        if($re === false){
            return $this->getError();
        }else{
            return $re;
        }
    }

    /*
     * 用户添加
     */
    public function add_user($data){
    	if($data['password'] != false){
    		$data['password'] = Encrypt::authcode($data['password'],'ENCODE');
    	}
        $data['citys'] = getCityIdByNames($data['citys']);
        $data['province'] = $data['citys'][0];
        $data['city'] = $data['citys'][1];
        $data['area'] = $data['citys'][2];
        unset($data['citys']);
		$result = $this->validate('user.add')->save($data);
		if($result === false){
			return $this->getError();
		}else{
			return $result;
		}
    }
    /*
     * 用户修改
     */
    public function edit_user($data){
        $data['citys'] = getCityIdByNames($data['citys']);
        $data['province'] = $data['citys'][0];
        $data['city'] = $data['citys'][1];
        $data['area'] = $data['citys'][2];
        unset($data['citys']);
        $result = $this->validate('user.edit')->save($data,['user_id'=>$data['user_id']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
      
    }

    /*
     * 获取用户账号单个字段信息
     */
    public function getUserName($id,$field='account'){
        $name = $this->where('user_id ='.$id)->value($field);
        if($name){
            return $name;
        }else{
            return $this->getError();
        }
    }

    /*
    *用户修改头像
     */
    public function edit_photo($id,$photo){
        $result = $this->save($photo,['user_id'=>$id]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /*
    * 用户修改密码
     */
    public function edit_pwd($id,$data){
        $result = $this->save($data,['user_id'=>$id]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

}