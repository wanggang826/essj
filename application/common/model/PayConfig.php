<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 支付模型
 * @author 
 * @version wanggang 2017/5/25
 */
class PayConfig extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    /**
     * 支付方式列表查询
     */
    public function select_pay($data,$where=array()){
        if(isValue($data,'pay_name')){
            $where['pay_name']=['like','%'.(string)$data['pay_name'].'%'];
        }
        if(isValue($data,'status')){
            $where['status']=['eq',$data['status']];
        }
        $query =$data;
        $list=$this->where($where)->order('id asc')->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;
    }
    /**
     * 支付配置编辑
     */
    public function edit_payconfig($data){
        $id =$data['id'];
        // unset($data['id']);
        $config =$this->field('pay_config')->find($data['id']);
        return $config['pay_config'];
        /*$config =unserialize($config);
        foreach ($data as $key => $v) {
            $config[$key]['val'] = $v; 
        }
        $info['pay_config'] = serialize($config);
        return $this->save($info,['id'=>$id]);*/
    }
}