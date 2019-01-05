<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * @param  状态信息类
 * @param by pengqiang.
 * Date: 2017/5/24 0024
 */
class  OrderStatus extends  Model{
    use SoftDelete;
    /*
     *状态列表
     * */
     public function get_status($data,$where=array(),$base=array()){
         if(isValue($data,'size')) {
             $page_size = $data['size'];
         }
         if(isValue($data,'id')){
             $where['id']=['eq',$data['id']];
         }
         $query =$data;
         unset($query['size']);
         $where = array_merge( (array)$base, /*$REQUEST,*/ (array)$where);
         $list=$this->where($where)->order('id asc')->paginate('',false,['query' => $query]);
         resultToArray($list);
         return $list;
     }
     /*
      * 添加状态
      * */
    public function add($data){
        $status =    $this->validate('OrderStatus.add')->save($data) ;
        if($status === false){
            return $this->getError();
        }else{
            return $status;
        }
    }
    /*
     * 修改状态
     * */
    public function edit($data){
     return  $this->save($data,['id'=>$data['id']]);
    }



}