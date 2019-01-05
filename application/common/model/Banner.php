<?php
/**
 * Created by tiway
 * Date: 2017/9/15
 * Time: 9:37
 */

namespace app\common\model;


use extend\UploadImg;
use think\Model;
use traits\model\SoftDelete;

class Banner extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function selectBanner($data,$where = array()){
        if(isValue($data,'title')){
            $where['title'] =['like','%'.(string)$data['title'].'%'];
        }
        if(isValue($data,'begin_time') && isValue($data,'end_time')){
            $begin_time  = strtotime($data['begin_time' ]);
            $end_time    = strtotime($data['end_time' ]);
            $where['create_time'] = ['BETWEEN',[$begin_time,$end_time]];
        }

        $result = $this
            ->alias('a')
            ->field('a.id,a.title,a.is_using,a.rank,a.banner,a.create_time,b.type_name')
            ->join('ui_banner_type b','a.type_id = b.id')
            ->where($where)
            ->order('id desc')
            ->paginate('',false,['query' => $data]);

        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    public function bannerAdd($data){
        $year = date('Y/m',time());
        $re   = UploadImg::upload("banners/$year")->getMsg();
        $data['banner'] = "/banners/".$year."/".$re['info']['banner'][0];
        unset($data['uploadImg']);
        $result = $this->save($data);
        if($result == 1){
            return $result;
        }else{
            return $this->getError();
        }
    }
}