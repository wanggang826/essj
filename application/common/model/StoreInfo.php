<?php
/**
 * Created by tiway
 * Date: 2017/9/13
 * Time: 9:36
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class StoreInfo extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function selectStore($data,$where=array()){
        if(isValue($data,'store_name')){
            $where['store_name'] =['like','%'.(string)$data['store_name'].'%'];
        }
        if(isValue($data,'begin_time') && isValue($data,'end_time')){
            $begin_time  = strtotime($data['begin_time' ]);
            $end_time    = strtotime($data['end_time' ]);
            $where['create_time'] = ['BETWEEN',[$begin_time,$end_time]];
        }
        $result = $this
            ->alias('a')
            ->field('a.id,a.store_name,a.create_time,b.nickname')
            ->join('ui_admin b','a.admin_id = b.admin_id')
            ->where($where)
            ->order('id desc')
            ->paginate('',false,['query' => $data]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

}