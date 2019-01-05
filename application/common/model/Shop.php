<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 商品模型
 * @author  wangang 
 * @version 2017/6/3
 */
class Shop extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    // 店铺 地区关联
    public function area1(){
    	return $this->hasOne('City','city_id','area_id1');
    }
    public function area2(){
    	return $this->hasOne('City','city_id','area_id2');
    }
    public function area3(){
    	return $this->hasOne('City','city_id','area_id3');
    }
    //店铺 用户关联
    public function user(){
    	return $this->hasOne('User','user_id','user_id');
    }
    /**
     * 店铺列表查询
     */
    public function select_shop($data,$where=array()){
    	if(isValue($data,'account')){
    		$user_ids =model('user')->where(['account'=>['like','%'.(string)$data['account'].'%']])->column('user_id');
			$where['user_id'] =['in',$user_ids];
		}
		if(isValue($data,'shop_name')){
			$where['shop_name'] =['like','%'.(string)$data['shop_name'].'%'];
		}
		if(isValue($data,'phone')){
			$where['phone'] =['like','%'.(string)$data['phone'].'%'];
		}
		if(isValue($data,'status')){
			$where['status']=['eq',$data['status']];
		}
		if(isValue($data,'is_check')){
			$where['is_check']=['eq',$data['is_check']];
		}
		$query = $data;
		$list  = $this->where($where)->paginate('',false,['query' => $query]);
		resultToArray($list);
		// $aa =array();
		foreach ($list as $key => $shop) {
			if($shop->user){
                $list[$key]['account']  = $shop->user->data['account'];
            }else{
                 $list[$key]['account'] = '--';
            }
			if($shop->area1){
                $list[$key]['cate_name1'] = $shop->area1->data['city_name'];
            }else{
                $list[$key]['cate_name1'] = '--';
            }
			if($shop->area2){
                $list[$key]['cate_name2'] = $shop->area2->data['city_name'];
            }else{
                $list[$key]['cate_name2'] = '--';
            }
			if($shop->area1){
                $list[$key]['cate_name3'] = $shop->area1->data['city_name']; 
           }else{
                $list[$key]['cate_name2'] = '--';
           }
			
		}
		return $list;
    }
    /**
     * 获取商铺信息(shop_id查询)
     */
    public function get_info($shop_id){
    	$info = $this->where('shop_id',$shop_id)->find();
        if($info->user){
            $info['account'] = $info->user->data['account'];
        }else{
            $info['account'] = '--';
        }
        if($info->user){
            $info['money'] = $info->user->data['money'];
        }else{
            $info['money'] = '--';
        }
    	if($info->area1){
            $info['area_name1'] = $info->area1->data['city_name'];
        }else{
            $info['area_name1'] = '--';
        }
        if($info->area2){
            $info['area_name2'] = $info->area2->data['city_name'];
        }else{
            $info['area_name2'] = '--';
        }
    	if($info->area3){
            $info['area_name3'] = $info->area3->data['city_name'];
        }else{
            $info['area_name3'] = '--';
        }
    	return $info;
    }
    /** 
     * 申请成为卖家
     */
    public function apply_seller($data){
        if($data['shop_id'] != false){
            $data['is_check'] = '0';
            $result = $this->save($data,['shop_id'=>$data['shop_id']]);
        }else{
            $data['shop_sn'] = getUniqueStr(12,rand(),'S');//店铺编码
            $result = $this->validate('shop.apply_seller')->save($data);
        }
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    /**
     * 编辑店铺信息
     */
    public function edit_shop($data){
    	extract($data);
    	unset($data['uploadImg']);
        $city_ids = getCityIdByNames($data['citys']);
        $data['area_id1'] = $city_ids['0'];
        $data['area_id2'] = $city_ids['1'];     
        $data['area_id3'] = $city_ids['2'];
    	unset($data['citys']);
    	$result = $this->save($data,['shop_id'=>$data['shop_id']]);
    	return $result;
    }

    /*
    * 查询店铺热销产品
    */
    public function select_goods_is_hot($data){
        $goods = model('goods')->where('is_hot = 1 AND shop_id ='.$data)->order('rand()')->limit(5)->field('goods_id,goods_name,goods_thums,shop_price')->select();
        foreach ($goods as &$v) {
            $v['goods_thums'] = getImg($v['goods_thums']);
        }
        return $goods;
    }
}