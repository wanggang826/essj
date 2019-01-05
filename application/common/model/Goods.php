<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 商品模型
 * @author  wangang 
 * @version 2017/5/20
 */
class Goods extends Model{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    //商品 品牌关联
    public function brand(){
    	return $this->hasOne('GoodsBrand','brand_id','brand_id');
    }
    //admin关联
    public function admin(){
    	return $this->hasOne('admin','admin_id','admin_id');
    }
    //属性关联
    public function attr(){
        return $this->hasMany('GoodsGoodAttr','goods_id','goods_id');
    }
    //评论关联
    public function comments(){
        return $this->hasMany('GoodsComment','goods_id','goods_id');
    }
    //检测报告关联
    public function checkInfo(){
        return $this->belongsTo('CheckInfo','report_id');
    }

    //关联收藏
    public function Collection(){
        return $this->hasMany('collection','goods_id','goods_id');
    }

    //容量属性(前端attr是关键词)
    public function capacity(){
        return $this->hasMany('GoodsGoodAttr','goods_id','goods_id');
    }
    //属性价格
    public function goodsPrice(){
        return $this->hasMany('GoodsPrice','goods_id','goods_id');
    }
	/**
	 * 商品列表查询
	 */
	public function select_goods($data,$where=array()){
		if(isValue($data,'goods_name')){
			$where['goods_name'] =['like','%'.(string)$data['goods_name'].'%'];
		}
		if(isValue($data,'statr_time') && isValue($data,'end_time')){
			$data['statr_time'] =strtotime($data['statr_time']);
			$data['end_time'] =strtotime($data['end_time']);
			$where['create_time']=['BETWEEN',[$data['statr_time'],$data['end_time']]];
		}
		if(isValue($data,'brand_id')){
			$where['brand_id']=['eq',$data['brand_id']];
		}
		if(isValue($data,'is_sale')){
			$where['is_sale']=['eq',$data['is_sale']];
		}
		if(isValue($data,'goods_sn')){
			$where['goods_sn']=['like','%'.(string)$data['goods_sn'].'%'];
		}
        if(isValue($data,'goods_id')){
            $where['goods_id']=$data['goods_id'];
        }
		// TODO 关联查询 待完善
        $query = $data;
		$list  = $this->where($where)->paginate('',false,['query' => $query]);
		resultToArray($list);
		foreach ($list as $key => $goods) {
			if($goods->brand){
				$list[$key]['brand_name'] = $goods->brand->brand_name;
			}else{
				$list[$key]['brand_name'] ="--";
			}
			if($goods->admin){
				$list[$key]['create_admin'] = $goods->admin->account;
			}else{
				$list[$key]['create_admin'] ="--";
			}
		}
		return $list;
	}

    /**
     * @param 商品goods_id查商品
     * @return array
     */
    public  function getGood($data){
        if(isValue($data,'goods_id')){
            $where['goods_id']=$data['goods_id'];
        }
        $good = $this->where($where)->select();
        foreach ($good as $key => $goods) {
            if($goods->brand){
                $good[$key]['brand_name'] = $goods->brand->brand_name;
            }else{
                $good[$key]['brand_name'] ="--";
            }
            if($goods->cate1){
                $good[$key]['cate_name1'] = $goods->cate1->data['name'];
            }else{
                $good[$key]['cate_name1'] ="--";
            }
            if($goods->cate1){
                $good[$key]['cate_name2'] = $goods->cate1->data['name'];
            }else{
                $good[$key]['cate_name2'] ="--";
            }
            if($goods->cate3){
                $good[$key]['cate_name3'] = $goods->cate3->data['name'];
            }else{
                $good[$key]['cate_name3'] ="--";
            }
            if($goods->shop){
                $good[$key]['shop_name']  = $goods->shop->data['shop_name'];
            }else{
                $good[$key]['shop_name'] ="--";
            }
        }
        return $good;
    }
	/*
	* 页面商品列表
	*/
	public function select_list($cate_id){
		if($cate_id != false){
			$list['goods_list'] = $this->where(['cate_id1|cate_id2|cate_id3'=>['eq',$cate_id]])->order('is_admin_recom desc')->paginate();//商品列表
			$list['goods_rec']   = $this->where(['cate_id1|cate_id2|cate_id3'=>['eq',$cate_id]])->order('rand(),is_admin_recom desc')->limit(3)->select();//推荐商品列表
			$list['goods_count'] = $this->where(['cate_id1|cate_id2|cate_id3'=>['eq',$cate_id]])->count();//商品总数
			$list['cate_name'] = model('GoodsCate')->where('cate_id ='.$cate_id)->value('name');//类别名称
			foreach ($list['goods_list'] as &$v) {
				$v['shop_name'] = $v->shop->shop_name;
			}
			return $list;
		}
	}

	/*
	* ajax查询商品
	*/
	public function ajax_get_goods($data,$ajax_type){
		$data['cate_id'] = cookie('cate_id');
		$where = '1=1';
		if(!empty($data['brands_id'])){
			$where .= ' and brand_id = "'.$data['brands_id'].'"';
		}
		if(!empty($data['goods_id'])){
			$goods_id = implode(',',$data['goods_id']);
			$where .= " and goods_id in ({$goods_id})";
		}
		if(isValue($data,'order')){/*人气/销售/价格排序*/
			$this->order($data['order']);
		}
		if(isValue($data,'is_new')){
			$where .= ' and is_new = 1';
		}
		if(isset($ajax_type['page'])){
		    $page = $ajax_type['page'];
        }else{
		    $page = 1;
        }
		//$query = $data;
        $query = $ajax_type;
		$goods = $this->where($where)->where(['cate_id1|cate_id2|cate_id3'=>['eq',$data['cate_id']]])->paginate('',false,['page'=>$page,'path' => url('Goods/index'),'query' => $query]);
		// dump($this->getLastSql());
			foreach ($goods as &$v) {
				$v['shop_name'] = $v->shop->shop_name;
				$v['detail_url'] = url('Shop/good_detail',['goods_id'=>$v['goods_id']]);
				$v['shop_url'] = url('Shop/index',['shop_id'=>$v['shop_id']]);
				$v['goods_thums'] = getImg($v['goods_thums']);
				unset($v['shop']);
			}
			return $goods;
	}

	public function add_goods($data){
		$result = $this->validate('goods.add')->save($data);
		if($result === false){
			return array('result'=>$this->getError(),'goods_id'=>'');
		}else{
			$add_goods_id = $this->goods_id;
			return array('result'=>$result,'goods_id'=>$add_goods_id);
		}
	}
	public function edit_goods($data){
		$result = $this->save($data,['goods_id'=>$data['goods_id']]);
		if($result === false){
			return $this->getError();
		}else{
			return array('result'=>$result,'goods_id'=>$data['goods_id']);
		}
	}
	/**
	 * 卖家中心商品查询
	 * @author wanggang 
	 * 2017/07/04
	 */
	public function shop_goods_select($shop_id,$data){
		$where['shop_id'] = $shop_id;
		if(isValue($data,'cate_id1')){
			$where['cate_id1']=['eq',$data['cate_id1']];
		}
		if(isValue($data,'statr_price') && isValue($data,'end_price')){
			$data['statr_price']  = (float)$data['statr_price'];
			$data['end_price']    = (float)$data['end_price'];
			$where['shop_price']  = ['BETWEEN',[$data['statr_price'],$data['end_price']]];
		}
		if(isValue($data,'goods_name')){
			$where['goods_name'] =['like','%'.(string)$data['goods_name'].'%'];
		}
		if(isValue($data,'is_check')){
			$where['is_check']=['eq',$data['is_check']];
		}
		if(isValue($data,'is_recom')){
			$where['is_recom']=['eq',$data['is_recom']];
		}
		$query = $data;
		$list  = $this->where($where)->paginate('',false,['query' => $query]);
		return $list;
	}

	//商品添加属性和价格
    public function get_attr_goods($data){
        if(!empty($data)){
            $new_data = array();
            foreach ($data as $k => $v){
                $new_data[$k] = $v;
                $attr_arr = $this->get_four_attr($v['goods_price'][0]['attrs_values']);
                $new_data[$k]['goodsPrice'] = $v['goods_price'][0];
                $new_data[$k]['goodsPrice']['attrs_values'] = $attr_arr;
                unset($v['goods_price']);
            }
            return $new_data;
        }
    }

    //获得前四个属性
    public function get_four_attr($attr_str){
        $attr = explode(',',$attr_str);
        $attr_arr = array();
        for($i=0;$i<4;$i++){
            $attr_arr[$i+1] = $attr[$i];
        }
        return $attr_arr;
    }

}