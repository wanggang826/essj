<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 店铺分类导航类
 * Created by pengqiang.
 * Date: 2017/6/9 0027
 */
class GoodsShopcate extends Model {
    use SoftDelete;
    /**
     * 获取店铺分类导航信息
     */
    public  function select_nav(){
        $re = $this->order('id,sort')->select();
        resultToArray($re);
        return $re;
    }
/*
 * 添加店铺分类导航信息
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
 * 修改店铺分类导航信息
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
 * 删除店铺分类导航
 * */
public  function del($data){
    if(!is_array($data['id'])){
        $id[0]=$data['id'];//被选中的id
    }else{
        $id=$data['id'];//被选中的id
    }
    $pid = $this->where('pid','in',$id)->field('id')->select();//查出用被选中的id作为PID的信息,
    resultToArray($pid);
    if(!empty($pid)){
        $pid2 = array_map('reset',$pid);//转换为一位数组
        $id_arr= array_merge($id,$pid2);//被选中的ID 和 查出的id 合并
    }else{
        $id_arr = $id;
    }
    return  $re = $this->destroy($id_arr);
}
/*
 * 切换(显示|隐藏)状态
 * */
public function  edit_status($data){
      return  $this->save($data,['id'=>$data['id']]);
}
}
