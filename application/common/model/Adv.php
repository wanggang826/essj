<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 广告管理模型
 * @author gucangfa
 * @version 2017/5/13
 */
class adv extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    protected $type = [
        'start_time' => 'timestamp:Y-m-d',//转换时间戳
        'end_time' =>  'timestamp:Y-m-d',//转换时间戳
    ];

    /**
     * 广告列表查询
     */
    public function select_adv($data,$where=array()){
        if(isValue($data,'searchText')){
            $where['adv_title'] = ['like','%'.(string)$data['searchText'].'%'];
            if(isValue($data,'pos_type')){
                $where['pos_type'] = (string)$data['pos_type']; 
            }
        }elseif(isValue($data,'pos_type')){
                $where['pos_type'] = (string)$data['pos_type']; 
        }
    	$list = $this->where($where)->order('adv_id desc')->paginate('',false,['query' => $data]);
        foreach ($list as &$value) {
            $value['adv_pos'] = model('advpos')->where('advpos_id ='.$value['adv_pos'])->value('advpos_name');
        }
    	resultToArray($list);
    	return $list;
    }

    /**
     * 广告添加
     */
    public function add_adv($data){
        $advpos = model('Advpos')->where('advpos_id ='.$data['adv_pos'])->find();
        if($data['start_time'] != false){
            $map['start_time'] = array('elt',strtotime($data['start_time']));
            $map['end_time'] = array('gt',strtotime($data['start_time']));
            $num = model('adv')->where('adv_pos ='.$advpos['advpos_id'])->where($map)->count();//统计该时间段内的广告数量
            if($num >= $advpos['img_num']){
                return '-1';die;
            }
        }
        $data['pos_type'] = $advpos['advpos_type'];
    	$result = $this->validate('adv.add')->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /**
     * 广告修改
     */
    public function edit_adv($data){
        $advpos = model('Advpos')->where('advpos_id ='.$data['adv_pos'])->find()->toArray();
        $adv = model('adv')->where('adv_id ='.$data['adv_id'])->find()->toArray();
        
            //只修改结束时间
            if($adv['start_time'] == $data['start_time'] && $adv['end_time'] != $data['end_time']){
                $time['start_time'] = array('elt',strtotime($data['end_time']));
                $time['end_time'] = array('egt',strtotime($data['end_time']));
                $num = model('adv')->where('adv_pos ='.$advpos['advpos_id'])->where($time)->count();//统计该时间段内的广告数量
                if($num >= $advpos['img_num']){
                    return '-1';die;
                }
            }
            //修改时间
            if($adv['start_time'] != $data['start_time'] && $adv['end_time'] != $data['end_time']){
                $map['start_time'] = array('elt',strtotime($data['start_time']));
                $map['end_time'] = array('egt',strtotime($data['start_time']));
                $num = model('adv')->where('adv_pos ='.$advpos['advpos_id'])->where($map)->count();//统计该时间段内的广告数量
                if($num >= $advpos['img_num']){
                    return '-1';die;
                }
            }

        $data['pos_type'] = $advpos['advpos_type'];
     	$result = $this->validate('adv.edit')->save($data,['adv_id'=>$data['adv_id']]);
    	if($result === false){
    		return $this->getError();
    	}else{
    		return $result;
    	}
    }

    /**
    * 商城广告展示查询
    */
    public function select_AdvPos($data){
        $map['start_time'] = array('elt',time());
        $map['end_time'] = array('egt',time());//结束时间>=当前时间
        $result = $this->where('adv_pos ='.$data)->where($map)->select();
        resultToArray($result);
        // dump($result);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /**
    * 关联广告位模型
    */
    public function advpos(){
        return $this->hasOne('Advpos','advpos_id','adv_pos')->field('advpos_ename');
    }

    /**
    *　商城广告位
    */
    public function select_all(){
        $map['start_time'] = array('elt',time());//开始时间<=当前时间
        $map['end_time'] = array('egt',time());//结束时间>=当前时间
        $adv = $this->where($map)->where("pos_type = 'PC'")->select();
        foreach ($adv as $v) {
            $ename = $v->advpos->advpos_ename;
            $advs[$ename][] = $v->toArray();
        }
        return $advs;
    }

}
