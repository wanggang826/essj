<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 首页导航类
 * Created by pengqiang.
 * Date: 2017/5/27 0027
 */
class Nav extends Model {
    use SoftDelete;
    /**
     * 获取导航信息
     */
    public  function select_nav($where=''){
        if(!empty($where)){
            $re = $this->where($where)->order('sort')->select();
        }else{
            $re = $this->select();
        }
        resultToArray($re);
        return $re;
    }
/*
 * 添加导航信息
 * */
   public function nav_add($data){
       if(array_key_exists('url_type', $data) && $data['url_type'] == 1){
           $data['url'] =url($data['module']."/".$data['controller']."/".$data['action']);
       }
       $result = $this->validate('nav.add')->save($data);
       if($result === false){
           return $this->getError();
       }else{
           return $result;
       }
   }
/*
 * 修改导航信息
 * */
public  function edit($data){
    if(array_key_exists('url_type', $data) && $data['url_type'] == 1){
        $data['url'] =url($data['module']."/".$data['controller']."/".$data['action']);
    }
    $result = $this->validate('nav.edit')->save($data,['id'=>$data['id']]);
    if($result === false){
        return $this->getError();
    }else{
        return $result;
    }
}

/*
 * 删除导航
 * */
public  function del($data){
    if(!is_array($data['id'])){
        $id[0]=$data['id'];//被选中的id
    }else{
        $id=$data['id'];//被选中的id
    }
    $id_arr = $id;
    return  $re = $this->destroy($id_arr);
}
/*
 * 切换(显示|隐藏)状态
 * */
public function  edit_status($data){
      return  $this->save($data,['id'=>$data['id']]);
}
}
