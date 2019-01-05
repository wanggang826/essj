<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 头条模型
 * @author 
 * @version wanggang 2017/9/12
 */
class Headlines extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    protected $type = [
        'create_time' => 'timestamp',//转换时间戳
    ];

    public function admin(){
    	return $this->hasOne('admin','admin_id','admin_id');
    }
    public function selectHeadline($data,$where=array()){
    	if(isValue($data,'title')){
            $where['title']     = ['like','%'.$data['title' ].'%'];
        }
        if(isValue($data,'begin_time') && isValue($data,'end_time')){
            $begin_time  = strtotime($data['begin_time' ]);
            $end_time    = strtotime($data['end_time' ]);
            $where['create_time'] = ['BETWEEN',[$begin_time,$end_time]];
        }

        $result = $this
            ->alias('a')
            ->field('a.id,a.title,a.content,a.create_time,b.nickname')
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