<?php
namespace  app\common\model;
use think\Model;
use traits\model\SoftDelete;

/**
 * 用户消费流水类
 * User: Administrator
 * Date: 2017/5/23 0023
 *by  pengqiang
 */
class UserAccountLog extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    /*
     * 关联user数据表用户真实姓名
     * */
    public function user(){
        return $this->hasOne('User','user_id','user_id');
    }
    /*
     * @param 退款列表
     * */
    public function refund_list($data){
        if(isValue($data['user_id'])){
            $where['user_id']     = $data['user_id'];
        }
        if(isValue($data['account_sn'])){
            $where['account_sn']  = $data['account_sn'];
        }
        if(isValue($data['datestart']) && isValue($data['dateend'])){
            $datestart            = strtotime($data['datestart']);
            $dateend              = strtotime($data['dateend']);
            $where['create_time'] = ['BETWEEN',[$datestart,$dateend]];
        }
        $where['type']='out';
        unset($data['size']);
        $query = $data;
        $list = $this->where($where)->order('create_time desc')->paginate('',false,['query'=>$query]);
       foreach ($list as $k=>&$v){
           $v['user_id']=$v->user->account;
       }
        resultToArray($list);
        return $list;

    }

    /*
    * 资金流水列表查询
    */
    public function select_accountLog($data,$where=array()){
        $uid=array();
        if($data){
            if(isValue($data,'realname')){
                $realname = model('user')->where('realname',$data['realname'])->field('user_id')->select();
                resultToArray($realname);
                foreach ($realname as $key => $value) {
                    $uid[] = $value['user_id'];
                }
                $where['user_id'] = ['in',$uid];
            }
            if(isValue($data,'account')){
                $account = model('user')->where('account',$data['account'])->find();
                if($account != false){
                    $where1 = 'user_id='.$account['user_id'];
                }else{
                    $where['user_id'] = 0;
                }
            }
            if(isValue($data,'statr_time') && isValue($data,'end_time')){
                $where['create_time']=['BETWEEN',[strtotime($data['statr_time']),strtotime($data['end_time'])]];
            }
            if(isset($data['user_id']) && !empty($data['user_id'])){
                $where['user_id'] = $data['user_id'];
            }
            if(isset($data['target_type']) && !empty($data['target_type'])){
                $where['target_type'] = $data['target_type'];
            }
            if(isset($data['type']) && !empty($data['type'])){
                $where['type'] = $data['type'];
            }
        }
        if(isset($data['page'])){//显示页数
            $page = $data['page'];
        }else{
            $page = 1;
        }
        if (isset($where1)) {
            $this->where($where1);
        }
        unset($data['page']);
        unset($data['size']);
        $result = $this->where($where)->order('update_time desc')->paginate('',false,['page'=>$page,'query' => $data]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /*
    * 取现列表
    */
    public function select_cash($data){
        if(isValue($data,'account')){
            $account = model('user')->where('account',$data['account'])->field('user_id')->find();
            $where['user_id'] = $account['user_id' ];
        }
        if(isValue($data,'realname')){
            $realname = model('user')->where('realname',$data['realname'])->column('user_id');
            $where['user_id'] = ['in',$realname];
        }
        if(isValue($data,'realname') && isValue($data,'account')){
           if(in_array($account['user_id'],$realname)){
               $where['user_id'] = $account['user_id' ];
           }else{
               $where['user_id'] =false;
           }
        }
        if(isValue($data,'statr_time') && isValue($data,'end_time')){
            $datestart = strtotime($data['statr_time' ]);
            $dateend   = strtotime($data['end_time' ]);
            $where['create_time'] = ['BETWEEN',[$datestart,$dateend]];;
        }
        $where['target_type']   =  'user';
        $where['type']           =  'out';
        unset($data['size']);
        $query = $data;
        $cash =$this->where($where)->order('create_time desc')->paginate('',false,['query' => $query]);
        resultToArray($cash);
        foreach ($cash as $key=>$val){
            $cash[$key]['account']=$val->user->data['account'];
            $cash[$key]['realname']=$val->user->data['realname'];
        }
        return $cash;
    }
/*
 * 取现详情
 * */
public function cash_info($data){
    $id = $data['id'];
    $info = $this->where(['id'=>$id])->find();
    $info['account'] = $info->user->data['account'];
    $info['realname'] = $info->user->data['realname'];
    return $info;
}
}