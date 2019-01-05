<?php
/**
 * Created by tiway
 * Date: 2017/9/22
 * Time: 9:48
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class Integral extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    protected $type = [
        'create_time' =>  'timestamp:Y/m/d H:i:s',//转换时间戳
    ];

    /**
     * $desc 获得用户的积分总数
     * @param $user_id
     * @return array|false|\PDOStatement|string|Model
     */
    public function getTotalIntegrals($user_id){
        return $this->field('id,sum(integral) as total_integral')->where(['user_id'=>$user_id,'is_effect'=>'Y'])->find();
    }

    /**
     * @desc 根据输入类型（支出/收入）得到积分列表
     * @param $user_id
     * @param $type
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getIntegralList($user_id,$type = ''){
        if($type == 1 || empty($type)){#默认为收入积分列表
            return $this->field('remark,integral,create_time')->where('integral','>',0)->where(['user_id'=>$user_id,'is_effect'=>'Y'])->order('create_time desc')->select();
        }elseif ($type == 2){#支出积分列表
            return $this->field('remark,integral,create_time')->where('integral','<',0)->where(['user_id'=>$user_id,'is_effect'=>'Y'])->order('create_time desc')->select();
        }
    }

    public function getProductIntegral($goods_id,$price_id)
    {
        $integral = model('Goods_price')->where(['goods_id'=>$goods_id,'id'=>$price_id])->value('integral');
        return $integral;
    }

}