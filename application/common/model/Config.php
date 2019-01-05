<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
class Config extends Model{
    use SoftDelete;
    /**
     * 配置列表查询
     */
    public function select_config($data,$where=array()){
        if(isValue($data,'config_mark' )){
            $where['config_mark'] =['like','%'.(string)$data['config_mark'].'%'];
        }
        if(isValue($data,'config_name' )){
            $where['config_name'] =['like','%'.(string)$data['config_name'].'%'];
        }
        if(isValue($data,'config_des')){
            $where['config_des'] =['like','%'.(string)$data['config_des'].'%'];
        }
        if(isValue($data,'group')){
            $where['group']=['eq',$data['group']];
        }
        if(isValue($data,'type')){
            $where['type']=['eq',$data['type']];
        }
        $query =$data;
        $list=$this->where($where)->order('sort')->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;
    }
    /*
     * 添加配置
     * */
    public function add_config($data){
        $result = $this->validate('config.add')->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    /*
     * 修改配置
      */
    public function edit_config($data){
        $result = $this->validate('config.edit')->save($data,['config_mark'=>$data['config_mark']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /*
    *删除配置
    */
    public  function del_config($data){
        $config_mark =$data['config_mark'];
        if(is_array($config_mark)){
            $config_mark = implode(',',$config_mark);
        }
        return $re =$this->destroy($config_mark);
    }
    /*
     * 商城设置
     * */
    public  function set_mall($data){
       $val=  model('Config')->saveAll($data);
       if($val){
           return   $val;
       }
    }
    /*
     *积分规则
     */
/*    public function addrule($data){
        $arr['group'] = 'integral';
        $result = $this->validate('Integral.add')->where($arr)->update(['config_value'=>serialize($data)]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }

    }*/

    //邀请注册积分
    public function get_register_integral(){
        $integral = model('config')->where(['config_mark'=>'INTEGRAL_REGISTER','group'=>'integral'])->value('config_value');
        return $integral;
    }

    //新用户积分
    public function get_newuser_integral(){
        $integral = model('config')->where(['config_mark'=>'INTEGRAL_NEWUSER','group'=>'integral'])->value('config_value');
        return $integral;
    }

    //好评积分
    public function get_praise_integral(){
        $integral = model('config')->where(['config_mark'=>'INTEGRAL_PRAISE','group'=>'integral'])->value('config_value');
        return $integral;
    }

    //中评积分
    public function get_commonly_integral(){
        $integral = model('config')->where(['config_mark'=>'COMMONLY','group'=>'integral'])->value('config_value');
        return $integral;
    }

    //差评积分
    public function get_bad_integral(){
        $integral = model('config')->where(['config_mark'=>'INTEGRAL_BAD','group'=>'integral'])->value('config_value');
        return $integral;
    }

}