<?php
/**
 * Created by tiway
 * Date: 2017/9/14
 * Time: 13:48
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class CheckInfo extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    //关联商品
    public function goods()
    {
        return $this->hasMany('Goods','report_id');
    }

    public function selectCheck($data,$where=array()){
        if(isValue($data,'check_name')){
            $where['check_name'] =['like','%'.(string)$data['check_name'].'%'];
        }
        if(isValue($data,'begin_time') && isValue($data,'end_time')){
            $begin_time  = strtotime($data['begin_time' ]);
            $end_time    = strtotime($data['end_time' ]);
            $where['create_time'] = ['BETWEEN',[$begin_time,$end_time]];
        }
        $result = $this
            ->where($where)
            ->order('id desc')
            ->paginate('',false,['query' => $data]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    public function addCheckInfo($data){
        $fun_check = array();
        foreach($data['fun_name'] as $key => $value ){
            foreach ($value as $k => $val){
                if(is_numeric($k) && !empty($val)){
                    $fun_check[$value['name']][$val] = $data['fun_type'][$key][$k] ;
                }
            }
        }
        unset($data['fun_name']);
        unset($data['fun_type']);
        $data['fun_check'] = json_encode($fun_check);
        $data['creator']   = session('islogin');
        $result = $this->validate('checkInfo')->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    public function editCheckInfo($data){
        $fun_check = array();
        foreach($data['fun_name'] as $key => $value ){
            foreach ($value as $k => $val){
                if(is_numeric($k) && !empty($val)){
                    $fun_check[$value['name']][$val] = $data['fun_type'][$key][$k] ;
                }
            }
        }
        $id = $data['id'];
        unset($data['id']);
        unset($data['fun_name']);
        unset($data['fun_type']);
        $data['fun_check'] = json_encode($fun_check);
        $data['creator']   = session('islogin');
        $result = $this->validate('checkInfo')->where('id',$id)->update($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
}