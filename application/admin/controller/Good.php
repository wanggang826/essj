<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\Goods;
use app\common\Model\GoodsCate;
use app\common\Model\GoodsBrand;
use app\common\Model\GoodsAttr;
use app\common\Model\CateBanner;
use extend\Upload;
use extend\UploadImg;
/**
 * 商品后台控制器
 * @author  wangang 
 * @version 2017/5/20
 */
class Good extends AdminBase{

	public function defaults(){
        $this->redirect(url('Good/index'));
    }
	/**
	 * 商品列表首页
	 */
	public function index(){
		// TODO 关联查询
		$brands = model('GoodsBrand')->select();
		resultToArray($brands);
		$data   = input();
		$goods  = model('Goods')->select_goods($data);
		return view(['goods'=>$goods,'brands'=>$brands]);
	}
	/**
	 * 获取树状类别列表
	 */
	public function getCateTree($id = 0){
        $cates = GoodsCate::all(function($db){
            $db->where(['status'=>['<>',-1]])->order('sort', 'asc');
        });
        resultToArray($cates);
        $select = getTree($cates,['primary_key'=>'cate_id','class_name'=>'form-control i-select','form_name'=>'pid'],2)->makeSelect($id,'name',"顶级分类");
        return $select;
    }
	/**
	 * 新增商品
	 */
	public function add(){
		$brands = model('GoodsBrand')->select();
		resultToArray($brands);
		$attrs  = model('GoodsAttr')->select();
		resultToArray($attrs);
		foreach ($attrs as $key => $value) {
			$attrs[$key]['value'] = unserialize($value['value']);
		}
		$check_info = model('CheckInfo')->select();
		resultToArray($check_info);
		$stores = model('StoreInfo')->select();
		resultToArray($stores);
		$model  = model('BrandModel')->where('brand_id',$brands[0]['brand_id'])->select();
		resultToArray($model);
		if(request()->isAjax()){
			$data = input();
			$data['evaluate'] = array_filter($data['evaluate']);
			$data['evaluate'] = implode(',',$data['evaluate']);
			if(isValue($data,'attrs')){
				$submit_attrs = $data['attrs'];
			}else{
				$submit_attrs = array();
			}
			if(isValue($data,'price_id')){
				$submit_price_ids = $data['price_id'];
			}else{
				$submit_price_ids = array();
			}
			if(isValue($data,'price_id_value')){
				$price_id_value = $data['price_id_value'];
			}else{
				$price_id_value = array();
			}
			// dump($submit_price_ids);die;
			//积分价格
			if(isValue($data,'integral')){
				$submit_integral = $data['integral'];
			}else{
				$submit_integral = array();
			}
			//活动价格
			if(isValue($data,'campaign_price')){
				$submit_campaign_price = $data['campaign_price'];
			}else{
				$submit_campaign_price = array();
			}
			//默认价格
			if(isValue($data,'price')){
				$submit_price = $data['price'];
			}else{
				$submit_price = array();
			}
			$attrs_list = array();
			$i = 0;
			$data['admin_id'] = session('islogin');
			$data['goods_sn']  = getUniqueStr(12);
			if(isset($data['uploadImg'])){
				$year = date('Y/m',time());
                //上传图片 返回图片名称 数组
                $re   = UploadImg::upload("goods/$year")->getMsg();
                $data['goods_thums'] = "/goods/".$year."/".$re['info']['goods_thums'][0];
                if(isset($re['info']['goods_img'])){
                	foreach ($re['info']['goods_img'] as $k => $v) {
	                	$data['goods_img'.($k+1)] =  "/goods/".$year."/".$v;
	                }
                }
                unset($data['uploadImg']);
			}
			// dump($data['price_id']);die;
			unset($data['attr_id']);
			unset($data['attrs']);
			unset($data['price_id']);
			unset($data['price_id_value']);
			unset($data['integral']);
			unset($data['campaign_price']);
			unset($data['price']);

			$result = model('Goods')->add_goods($data);
			$gooods_id = $result['goods_id'];
			if($submit_attrs){
				foreach ($submit_attrs as $key => $value) {
					// $attrs_list[$i]['value']    = $value;
					foreach ($value as $k => $v) {
						if($v != ''){
							$attrs_list[$i]['attr_id']  = $key;
							$attrs_list[$i]['goods_id'] = $gooods_id;
							$attrs_list[$i]['value']    = $v;
							$i++;
						}
					}
				}
				// dump($price_id_value);die;
				// dump($attrs_list);die;
				// model('GoodsGoodAttr')->where('goods_id',$data['goods_id'])->delete();
				$add_goods_attr_re = model('GoodsGoodAttr')->saveAll($attrs_list);
				$insert_data = array();
				foreach ($submit_integral as $key => $value) {
					if($value || $submit_price[$key] || $submit_campaign_price[$key]){
						if($value && $submit_price[$key] && $submit_campaign_price[$key]){
							$idss = model('GoodsGoodAttr')->where(['goods_id'=>$gooods_id,'attr_id'=>['in',$submit_price_ids[$key]]])->column('id');
							foreach ($submit_price_ids[$key] as $k => $v) {
								$ids[] = model('GoodsGoodAttr')->where(['goods_id'=>$gooods_id,'attr_id'=>$v])->column('id');
								// $ids = $this->getArrSet($ids);
							}
							$insert_data[$key]['attrs_ids']       = implode(',', $submit_price_ids[$key]);
							$insert_data[$key]['attrs_values']    = implode(',', $price_id_value[$key]);
							$insert_data[$key]['goods_id']       = $gooods_id;
							$insert_data[$key]['campaign_price']  = $submit_campaign_price[$key];
							$insert_data[$key]['price']    = $submit_price[$key];
							$insert_data[$key]['integral']        = $submit_integral[$key];
						}else{
							Api()->setApi('msg','价格参数不全')->setApi('url',0)->ApiError();
						}
					}
				}
				$re = model('GoodsPrice')->saveAll($insert_data);
				// dump($re);die;
			}else{
				Api()->setApi('msg','未选择任何属性')->setApi('url',0)->ApiError();
			}
			if($result['result'] > 0){
				Api()->setApi('url',url('index'))->ApiSuccess();
			}else{
				Api()->setApi('msg',$result['result'])->setApi('url',0)->ApiError();
			}
		}
		return view(['brands'=>$brands,'attrs'=>$attrs,'check_info'=>$check_info,'stores'=>$stores,'model'=>$model]);
	}
	public function get_model(){
		if(request()->isAjax()){
			$model = model('BrandModel')->where('brand_id',input('brand_id'))->select();
			resultToArray($model);
			echo json_encode($model);
		}
	}
	/**
	 * 商品编辑
	 */
	public function edit(){
		// TODO 商品编辑
		$goods_info   = model('goods')->where('goods_id',input('goods_id'))->find()->toArray();
		$evaluate     = explode(',',$goods_info['evaluate']);
		$goods_attrs  = model('GoodsGoodAttr')->where('goods_id',input('goods_id'))->select();
		resultToArray($goods_attrs);
		$new_goods_attrs = array();
		$brands = model('GoodsBrand')->select();
		resultToArray($brands);
		$check_info = model('CheckInfo')->select();
		resultToArray($check_info);
		$stores = model('StoreInfo')->select();
		resultToArray($stores);
		$attrs  = model('GoodsAttr')->select();
		resultToArray($attrs);
		foreach ($attrs as $key => $value) {
			$attrs[$key]['value'] = unserialize($value['value']);
			$attrs[$key]['values'] = model('GoodsGoodAttr')->where(['goods_id'=>input('goods_id'),'attr_id'=>$value['attr_id']])->column('value');
		}
		$goods_price_list = model('GoodsPrice')->where(['goods_id'=>input('goods_id')])->select();
		resultToArray($goods_price_list);
		foreach ($goods_price_list as $key => $value) {
			$goods_price_list[$key]['attrs_ids']    = explode(',', $value['attrs_ids']);
			$goods_price_list[$key]['attrs_values'] = explode(',', $value['attrs_values']);
		}
		// dump($goods_price_list);
		// dump($attrs);
		// dump($new_goods_attrs);
		$this->edit_goods();
		$model  = model('BrandModel')->where('brand_id',$goods_info['brand_id'])->select();
		resultToArray($model);
		return view(['brands'=>$brands,'attrs'=>$attrs,'goods_info'=>$goods_info,'goods_attrs'=>$new_goods_attrs,'check_info'=>$check_info,'stores'=>$stores,'model'=>$model,'goods_price_list'=>$goods_price_list,'evaluate'=>$evaluate]);
	}
	/**
	 * 编辑商品提交
	 */
	public function edit_goods(){
		if(request()->isAjax()){
			$data = input();
			$data['evaluate'] = array_filter($data['evaluate']);
			$data['evaluate'] = implode(',',$data['evaluate']);
			if(isValue($data,'attrs')){
				$submit_attrs = $data['attrs'];
			}else{
				$submit_attrs = array();
			}
			if(isValue($data,'price_id')){
				$submit_price_ids = $data['price_id'];
			}else{
				$submit_price_ids = array();
			}
			if(isValue($data,'price_id_value')){
				$price_id_value = $data['price_id_value'];
			}else{
				$price_id_value = array();
			}
			// dump($submit_price_ids);die;
			//积分价格
			if(isValue($data,'integral')){
				$submit_integral = $data['integral'];
			}else{
				$submit_integral = array();
			}
			//活动价格
			if(isValue($data,'campaign_price')){
				$submit_campaign_price = $data['campaign_price'];
			}else{
				$submit_campaign_price = array();
			}
			//默认价格
			if(isValue($data,'price')){
				$submit_price = $data['price'];
			}else{
				$submit_price = array();
			}
			$attrs_list = array();
			$i = 0;
			$data['goods_sn']  = getUniqueStr(12);
			if(isset($data['uploadImg'])){
				$year = date('Y/m',time());
                //上传图片 返回图片名称 数组
                $re   = UploadImg::upload("goods/$year")->getMsg();
                $data['goods_thums'] = "/goods/".$year."/".$re['info']['goods_thums'][0];
                if(isset($re['info']['goods_img'])){
                	foreach ($re['info']['goods_img'] as $k => $v) {
	                	$data['goods_img'.($k+1)] =  "/goods/".$year."/".$v;
	                }
                }
                unset($data['uploadImg']);
			}
			unset($data['attr_id']);
			unset($data['attrs']);
			unset($data['price_id']);
			unset($data['price_id_value']);
			unset($data['integral']);
			unset($data['campaign_price']);
			unset($data['price']);
			$result = model('Goods')->edit_goods($data);
			foreach ($submit_attrs as $key => $value) {
				// $attrs_list[$i]['value']    = $value;
				foreach ($value as $k => $v) {
					if($v != ''){
						$attrs_list[$i]['attr_id']  = $key;
						$attrs_list[$i]['goods_id'] = $data['goods_id'];
						$attrs_list[$i]['value']    = $v;
						$i++;
					}
				}
			}
			// dump($price_id_value);die;
			// dump($attrs_list);die;
			model('GoodsGoodAttr')->where('goods_id',$data['goods_id'])->delete();
			$add_goods_attr_re = model('GoodsGoodAttr')->saveAll($attrs_list);
			$insert_data = array();
			foreach ($submit_integral as $key => $value) {
				if($value || $submit_price[$key] || $submit_campaign_price[$key]){
					if($value && $submit_price[$key] && $submit_campaign_price[$key]){
						$idss = model('GoodsGoodAttr')->where(['goods_id'=>$data['goods_id'],'attr_id'=>['in',$submit_price_ids[$key]]])->column('id');
						foreach ($submit_price_ids[$key] as $k => $v) {
							$ids[] = model('GoodsGoodAttr')->where(['goods_id'=>$data['goods_id'],'attr_id'=>$v])->column('id');
							// $ids = $this->getArrSet($ids);
						}
						$insert_data[$key]['attrs_ids']       = implode(',', $submit_price_ids[$key]);
						$insert_data[$key]['attrs_values']    = implode(',', $price_id_value[$key]);
						$insert_data[$key]['goods_id']        = $data['goods_id'];
						$insert_data[$key]['campaign_price']  = $submit_campaign_price[$key];
						$insert_data[$key]['price']    = $submit_price[$key];
						$insert_data[$key]['integral']        = $submit_integral[$key];
					}else{
						Api()->setApi('msg','价格参数不全')->setApi('url',0)->ApiError();
					}
				}
			}
			model('GoodsPrice')->where('goods_id',$data['goods_id'])->delete();
			$re = model('GoodsPrice')->saveAll($insert_data);
			if($result['result'] > 0){
				Api()->setApi('url',url('index'))->ApiSuccess();
			}else{
				Api()->setApi('msg',$result)->setApi('url',0)->ApiError();
			}
		}
	}
	/**
	 * 商品|审核信息 删除
	 */
	public function del(){
	  if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('goods',$time,$data['id'],'','delete_time');
        if(1 == $obj->code){
            $obj->setApi('url',input('location'))->apiEcho();
        }else{
            $obj->setApi('url',0)->apiEcho();
        }
      }
	}
	/**
	 * 商品商城推荐设置
	 */
	public function admin_recom(){
		if(request()->isAjax()){
			$data =input();
			$obj =$this->setStatus('goods',1,$data['id'],'','is_admin_recom');
			if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
		}	
	}
	/**
	 * 取消推荐
	 */
	public function admin_norecom(){
		if(request()->isAjax()){
			$data =input();
			$obj =$this->setStatus('goods',0,$data['id'],'','is_admin_recom');
			if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
		}
	}

	/**
	 * ajax 获取 类别
	 */
	public function ajax_get_cate(){
		$cate_id = input('cate_id');
		$cates   = model('GoodsCate')->where('pid',$cate_id)->field('cate_id,pid,name')->select();
		resultToArray($cates);
		$brands  = model('GoodsCateBrands')->where('cate_id',$cate_id)->select();
		resultToArray($brands);
		foreach ($brands as $key => $value) {
			$brand_name = model('GoodsBrand')->where(['brand_id'=>$value['brand_id']])->value('brand_name');
			$brands[$key]['brand_name'] = $brand_name;
		}
		$arr     = ['cates'=>$cates,'brands'=>$brands];
		echo json_encode($arr);
	}

	/**
	 * ajax 获取 类别下面的品牌 
	 */
	public function ajax_get_brand(){

	}


	/**
	 * 显示隐藏设置
	 */
	 public function changeStatus(){
        $obj =$this->setStatus('Goods',input('is_sale'),input('goods_id'),'goods_id','is_sale');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
    /**
     * 商品详情
     */
    public function details(){
    	$goods_id = input('goods_id');
    	//商品表中基本信息
    	$goods_info = model('goods')->where('goods_id',$goods_id)->find()->toArray();
    	// 商品所拥有属性
    	$attr_ids = model('GoodsGoodAttr')->where('goods_id',$goods_id)->column('attr_id');
    	$attrs = model('GoodsAttr')->where(['attr_id'=>['in',$attr_ids]])->select();
    	resultToArray($attrs);
    	//属性值反序列化处理
    	foreach ($attrs as $key => $value) {
			if($value['value']){
				$item =unserialize($value['value']);
				if(is_array($item)){
					foreach ($item as $k => $v) {
						$item[$k]=$v['value'];	
					}
					$item =implode(',',$item);
				}
				$attrs[$key]['value']=$item;
			}		
		}
    	return view(['goods_info'=>$goods_info,'attrs'=>$attrs]);
    }
    //=======================================商品审核开始================================================//
    /**
	 * 商品待审核首页
	 */
	public function check_index(){
		$brands = model('GoodsBrand')->select();
		resultToArray($brands);
		$cates  = model('GoodsCate')->where('pid',0)->select();
		resultToArray($cates);
		$data   = input();
		$goods  = model('Goods')->select_goods($data,['is_check'=>['neq',1]]);
		return view(['goods'=>$goods,'brands'=>$brands,'cates'=>$cates]);
	}
	/**
	 * 商品审核通过
	 */
	public function check_agree(){
		if(request()->isAjax()){
	        $data = input();
	        $obj =$this->setStatus('goods',1,$data['id'],'','is_check');
	        if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
	    }
	}
	/**
	 * 商品审核不通过
	 */
	public function check_disagree(){
		if(request()->isAjax()){
	        $data = input();
	        $obj =$this->setStatus('goods','-1',$data['id'],'','is_check');
	        if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
	    }
	}
	//=======================================商品审核结束================================================//
	//=======================================商品分类开始================================================//
	
	/**
	 * 类别列表
	 */
	public function cate_index(){
		$cates =model('GoodsCate')->select();
		resultToArray($cates);
		if($cates){
			$tree  = getTree($cates,['primary_key'=>'cate_id'])->makeTreeForHtml();
			// dump($tree);
		}else{
			$tree  = array();
		}
        return view([
            'tree'=>json_encode($tree),
        ]);
	}
	public function cates_json(){
		$cates =model('GoodsCate')->select();
		resultToArray($cates);
		$tree  = getTree($cates,['primary_key'=>'cate_id'])->makeTreeForHtml();
		echo json_encode($tree);
	}
	/**
	 * ajax——单字段修改
	 */
	public function edit_field(){
	 	$info =input();
	 	$cate_id = $info['cate_id'];
	 	extract($info);
	 	$data[$field]=trim($value);
	 	$re = model('GoodsCate')->save($data,['cate_id'=>$cate_id]);
	 	echo json_encode($re);
	}
	/**
	 * 新增分类
	 */
	public function add_cate(){
		$pid = input('pid',0);
		$select =$this->getCateTree($pid);
        $this->assign('select',$select);
        if (request()->isAjax()) {
			$data =input();
           	$re =model('GoodsCate')->add_cate($data);
           	if($re >0){
           		Api()->setApi('url',url('cate_index'))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
		return view();
	}
	/**
	 * 编辑分类
	 */
	public function edit_cate(){
		$cate_id=input('cate_id');
		$pid    =GoodsCate::get($cate_id)->pid;
		$select =$this->getCateTree($pid);
		$cate_info = GoodsCate::get($cate_id)->toArray();
		$this->assign('cate_info',$cate_info);
		$this->assign('select',$select);
		if(request()->isAjax()){
			$data =input();
			$re =model('GoodsCate')->edit_cate($data);
			if($re >0 ){
				Api()->setApi('url',url('cate_index'))->ApiSuccess($re);
			}else{
				Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
			}
		}
		return view();
	}
	/**
	 * 设置分类属性
	 */
	public function setAttr(){
		$cate_id = input('cate_id');
		//种类已有的属性
		$has_attr_ids = model('GoodsCateAttr')->where(['cate_id'=>['eq',$cate_id]])->column('attr_id');
		$has_attrs = model('GoodsAttr')->where(['status'=>['eq','1'],'attr_id'=>['in',$has_attr_ids]])->select();
		resultToArray($has_attrs);
		//种类没有的属性
		$attrs = model('GoodsAttr')->where(['status'=>['eq','1'],'attr_id'=>['not in',$has_attr_ids]])->select();
		resultToArray($attrs);
		//ajax 提交改变种类属性
		if(request()->isAjax()){
			$info = input();
			extract($info);
			model('GoodsCateAttr')->where(['cate_id'=>$cate_id])->delete();
			$attr = array();
			if(array_key_exists('ids', $info)){
				foreach ($ids as $key => $value) {
					$attr[$key]['cate_id'] = $cate_id;
		        	$attr[$key]['attr_id'] = $value;
				}
			}
			$re = model('GoodsCateAttr')->saveAll($attr);
			if($re){
				Api()->setApi('msg','属性设置成功')->ApiSuccess();
			}else{
				Api()->setApi('msg','属性设置失败')->ApiError();
			}
		}else{
			return view(['cate_id'=>$cate_id,'attrs'=>$attrs,'has_attrs'=>$has_attrs]);
		}
	}
	/**
	 * 设置分类品牌
	 */
	public function setBrand(){
		$cate_id=input('cate_id');
		//种类已有品牌
		$has_brand_ids = model('GoodsCateBrands')->where(['cate_id'=>['eq',$cate_id]])->column('brand_id');
		$has_brands = model('GoodsBrand')->where(['status'=>['eq','1'],'brand_id'=>['in',$has_brand_ids]])->select();
		resultToArray($has_brands);
		//种类pid 
		$pid = model('GoodsCate')->where('cate_id',$cate_id)->value('pid');
		//种类 可选 未有品牌
		if($pid != 0){
			$brand_ids = model('GoodsCateBrands')->where(['cate_id'=>['eq',$pid]])->column('brand_id');
			$brands = model('GoodsBrand')->where(['status'=>['eq','1'],'brand_id'=>['in',$brand_ids,'not in',$has_brand_ids]])->select();
			resultToArray($brands);
		}else{
			$brands = model('GoodsBrand')->where(['status'=>['eq','1'],'brand_id'=>['not in',$has_brand_ids]])->select();
			resultToArray($brands);
		}
		$nbsp = '&nbsp;';
		$brands[1000] = [
			'brand_id'  => 1000,
			'brand_name'=> '华硕Ausa',
			'des' => '华硕Au电脑',
		];
		foreach ($brands as $key => $value) {
			// echo mb_strlen($value['brand_name'],'utf8');
			// echo '---'.strlen($value['brand_name']);
			// echo '---'.$value['brand_name'];
			// echo '<br>';
			if (mb_strlen($value['brand_name'],'utf8') == strlen($value['brand_name'])) {
				$count = (45 - strlen($value['brand_name'])*2);
			} else {
				$count = (45 - mb_strlen($value['brand_name'],'utf8')*3);
			}
			$repeat = str_repeat($nbsp, $count);
			$brands[$key]['option'] = $value['brand_name'].$repeat.$value['des'];

		}
		//ajax 提交改变品牌
		if(request()->isAjax()){
			$info = input();
			extract($info);
			//改变之前删除分类原有的品牌  关联表中的
			model('GoodsCateBrands')->where(['cate_id'=>$cate_id])->delete();
			$attr = array();
			if(array_key_exists('ids', $info)){
				foreach ($ids as $key => $value) {
					$attr[$key]['cate_id']= $cate_id;
		        	$attr[$key]['brand_id']= $value;
				}
			}
			$re = model('GoodsCateBrands')->saveAll($attr);//批量添加
			if($re){
				Api()->setApi('msg','品牌设置成功')->ApiSuccess();
			}else{
				Api()->setApi('msg','品牌设置失败')->ApiError();
			}
		}else{
			return view(['cate_id'=>$cate_id,'has_brands'=>$has_brands,'brands'=>$brands]);
		}
		
	}
	/**
     * 删除类别
     */
    public function del_cate(){
      if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('GoodsCate',$time,$data['id'],'cate_id','delete_time');
        if(1 == $obj->code){
            Api()->setApi('url',input('location'))->ApiSuccess();
        }else{
            Api()->setApi('url',0)->ApiError();
        }
      }
    }
    /**
     * 改变状态：启用|禁用
     */
    public function changeStatus_cate(){
        $obj =$this->setStatus('GoodsCate',input('status'),input('cate_id'),'cate_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
    /**
	 * 一级商品分类图标图标
	 */
    public function fontawesome(){
        return view();
    }
    /**
     * 商品分类是否平台显示
     */
    public function isShow(){
    	$obj =$this->setStatus('GoodsCate',input('is_show'),input('cate_id'),'cate_id','is_show');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
    /**
     * 分类banner编辑
     */
    public function editbanner(){
		$banner_id=input('banner_id');
		$banner_info = model('CateBanner')->where(['banner_id'=>['eq',$banner_id]])->find()->toArray();
		$banner_img    = "./upload".$banner_info['banner_img'];
		if(!file_exists($banner_img)){
			$banner_info['banner_img'] = '';
		}
		if(request()->isAjax()){
			$data =input();
        	$year = date('Y/m',time());
        	//上传图片 返回图片名称 数组
        	if(isset($data['uploadImg'])){
        		$re   = Upload::uploadImg("shop/$year")->getInfo();
        		$old_img = model('CateBanner')->where('banner_id','eq',$data['banner_id'])->field('banner_img')->find()->toArray();
	            if($old_img['banner_img']){//确认原来图片不为空
	            	$banner_img_url    = "./upload".$old_img['banner_img'];
	                if (file_exists($banner_img_url) && isset($data['uploadImg'])) {
	                    unlink($banner_img_url);
	                }
	            }
	            $data['banner_img'] = "/shop/".$year."/".$re[0];
        	}
        	unset($data['uploadImg']);
            //若上传新图  删除原图
			$re =model('CateBanner')->edit_banner($data);
			if($re >0 ){
				Api()->ApiSuccess();
			}else{
				Api()->ApiError();
			}
		}
    	return view(['banner_info'=>$banner_info]);
    }
    /**
     * 新增分类banner
     */
    public function addBanner(){
    	$cate_id   = input('cate_id');
    	$cate_info = GoodsCate::get($cate_id)->toArray();
    	if($cate_info['is_show'] ==1 ){
    		if(request()->isAjax()){
				$data =input();
	        	$year = date('Y/m',time());
	        	//上传图片 返回图片名称 数组
	        	if(isset($data['uploadImg'])){
	        		$re   = Upload::uploadImg("shop/$year")->getInfo();
		            $data['banner_img'] = "/shop/".$year."/".$re[0];
	        	}
	        	unset($data['uploadImg']);
	            //若上传新图  删除原图
				$re =model('CateBanner')->add_banner_set($data);
				if($re >0 ){
					Api()->setApi('url',url('cate_index'))->ApiSuccess($re);
				}else{
					Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
				}
			}
	    	return view(['cate_id'=>$cate_id]);
    	}else{
    		Api()->setApi('msg','分类在前台不显示，请先设置该类显示')->setApi('url',0)->ApiError();
    	}
		
    }

    /**
     * banner列表
     */
    public function cateBanner(){
    	$cate_id = input('cate_id');
    	$list    = model('CateBanner')->select_banner(['cate_id'=>['eq',$cate_id]]);
    	return view(['list'=>$list]);
    }
    /**
     * 查看banner图片
     */
    public function bannerimg(){
    	if(input('banner_id')){
    		$banner_id = input('banner_id');
    		$bannerimg = model('CateBanner')->where('banner_id',$banner_id)->value('banner_img');
    		return view(['bannerimg'=>$bannerimg]);
    	}
    }
    /**
     * 删除过期分类banner
     */
    public function delbanner(){
    	if(request()->isAjax()){
	        $time = time();
	        $data = input();
	        $obj =$this->setStatus('CateBanner',$time,$data['id'],'banner_id','delete_time');
	        if(1 == $obj->code){
	            Api()->ApiSuccess();
	        }else{
	            Api()->ApiError();
	        }
	    }
    }
	//=======================================商品分类结束================================================//
	
	//=======================================商品品牌开始================================================//
	
	/**
	 * 品牌列表
	 */
	public function brand_index(){
		$data = input();
		$brands =model('GoodsBrand')->select_brand($data);
		return view(['brands'=>$brands,]);
	}
	/**
     * 新增品牌
     */
    public function add_brand(){
    	if (request()->isAjax()) {
    		$data =input();
    		if(isset($data['uploadImg'])){
    			$year = date('Y/m',time());
    			$result   = UploadImg::upload("brand/$year")->getMsg();
    			$data['brand_logo'] = "/brand/".$year."/".$result['info']['brand_logo'][0];
    			unset($data['uploadImg']);
    		}
       	    $re =model('GoodsBrand')->add_brand($data);
           	if($re >0){
           		Api()->setApi('url',url('brand_index'))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view();
    }

    /**
     * 编辑品牌
     */
    public function edit_brand(){
    	$brand_id=input('brand_id');
    	$brand_info = GoodsBrand::get($brand_id)->toArray();
        $page =input('page');
    	if (request()->isAjax()) {
            $data=input();
            if(isset($data['uploadImg'])){
    			$year = date('Y/m',time());
    			$result   = UploadImg::upload("brand/$year")->getMsg();
    			$data['brand_logo'] = "/brand/".$year."/".$result['info']['brand_logo'][0];
    			unset($data['uploadImg']);
    		}
           	$re =model('GoodsBrand')->edit_brand($data);
           	if($re >0){
           		Api()->setApi('url',url('brand_index',['page'=>input('page')]))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view(
    		['brand_info'=>$brand_info,'page'=>$page,]
    	);
    }
     /**
     * 删除品牌
     */
    public function del_brand(){
      if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('GoodsBrand',$time,$data['id'],'brand_id','delete_time');
        if(1 == $obj->code){
            Api()->setApi('url',input('location'))->ApiSuccess();
        }else{
            Api()->setApi('url',0)->ApiError();
        }
      }
    }
    /**
     * 改变状态：启用|禁用
     */
    public function changeStatus_brand(){
        $obj =$this->setStatus('GoodsBrand',input('status'),input('brand_id'),'brand_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
    /**
     * 设置型号
     */
	public function set_model_brand(){
		$models = model('BrandModel')->where('brand_id',input('brand_id'))->select();
		resultToArray($models); 
		if(request()->isAjax()){
			$list   = array();
			$data   = input();
			foreach ($data['type_val'] as $key => $value) {
				$list[$key]['name'] = $value;
				$list[$key]['brand_id'] = $data['brand_id'];
			}
			model('BrandModel')->where('brand_id',$data['brand_id'])->delete();
			$re = model('brandModel')->saveAll($list);
			if($re>0){
				Api()->setApi('url',url('brand_index',['page'=>input('page')]))->ApiSuccess($re);
			}else{
				Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
			}
		}
		return view(['brand_id'=>input('brand_id'),'models'=>$models]);
        
    }
	//=======================================商品品牌结束================================================//
	//=======================================商品属性开始================================================//
	public $input_type  = ['text','radio','textarea','checkbox','select',];
	/**
	 * 属性列表查询
	 */
	public function attr_index(){
		$data = input();
		$attrs =model('GoodsAttr')->select_attr($data);
		return view(['attrs'=>$attrs,]);
	}
	/**
     * 新增属性
     */
    public function add_attr(){
    	$input_type  = ['text','radio','textarea','checkbox','select',];
    	if (request()->isAjax()) {
    		$data =input();
            $type_val  = $data['type_val'];
            if($data['type'] =='select'|| $data['type'] =='checkbox' || $data['type'] =='radio'){//控件类型
                if(!empty($data['type_val'][0])){//控件值键值对
                    foreach ($type_val as $k => $v) {
	                    $type_value[$k]['value'] = $v;
                    }
                    // sort($type_value);
                    $data['value'] = serialize($type_value);
                }else{//控件值键值对为空或者不完整
                    Api()->setApi('msg','控件值不能为空!')->setApi('url',0)->ApiError();
                }
            }
            unset($data['type_val']);
       	    $re =model('GoodsAttr')->add_attr($data);
           	if($re >0){
           		Api()->setApi('url',url('attr_index'))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view(['input_type'=>$input_type,]);
    }
    /**
     * 编辑属性
     */
    public function edit_attr(){
    	$input_type  = ['text','radio','textarea','checkbox','select',];
    	$attr_id=input('attr_id');
    	$attr_info = GoodsAttr::get($attr_id)->toArray();
    	$attr_info['value']=unserialize($attr_info['value']);
        $page =input('page');
    	if (request()->isAjax()) {
            $data=input();
            $type_val  = $data['type_val'];
            if($data['type'] =='select'|| $data['type'] =='checkbox' || $data['type'] =='radio'){//控件类型
                if(!empty($data['type_val'][0])){//控件值键值对
                    foreach ($type_val as $k => $v) {
                        $type_value[$k]['value'] = $v;
                    }
                    // sort($type_value);
                    // dump($type_value);
                    $data['value'] = serialize($type_value);
                }else{//控件值键值对为空或者不完整
                    Api()->setApi('msg','控件值不能为空!')->setApi('url',0)->ApiError();
                }
            }
            unset($data['type_val'],$data['page']);
           	$re =model('GoodsAttr')->edit_attr($data);
           	if($re >0){
           		Api()->setApi('url',url('attr_index',['page'=>input('page')]))->ApiSuccess($re);
           	}else{
           		Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
           	}
        }
    	return view(
    		['attr_info'=>$attr_info,'page'=>$page,'input_type'=>$input_type,]
    	);
    }
     /**
     * 删除属性
     */
    public function del_attr(){
      if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('GoodsAttr',$time,$data['id'],'attr_id','delete_time');
        if(1 == $obj->code){
            Api()->setApi('url',input('location'))->ApiSuccess();
        }else{
            Api()->setApi('url',0)->ApiError();
        }
      }
    }
    /**
     * 改变状态：启用|禁用
     */
    public function changeStatus_attr(){
        $obj =$this->setStatus('GoodsAttr',input('status'),input('attr_id'),'attr_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
    }
	//=======================================商品属性结束================================================//
	//=======================================商品评价开始================================================//
	/**
	 * 商品评价列表
	 */
    public function comment_index(){
    	$data =input();
    	// TODO 关联查询
    	$comments =model('GoodsComment')->select_comment($data);
    	// dump($comments);die;
    	return view(['comments'=>$comments]);
    }

    /**
     * 评价图片
     */
    public function comment_img(){
    	// TODO 评价图片
    	$comment_id   = input('comment_id');
    	$comment_info = model('GoodsComment')->where(['comment_id'=>$comment_id])->find()->toArray();
    	// dump($comment_info);die;
    	$imgs =array();
    	if($comment_info['com_img1']){
    		$imgs[1] = $comment_info['com_img1'];
    	}
    	if($comment_info['com_img2']){
    		$imgs[2] = $comment_info['com_img2'];
    	}
    	if($comment_info['com_img3']){
    		$imgs[3] = $comment_info['com_img3'];
    	}
    	if($comment_info['com_img4']){
    		$imgs[4] = $comment_info['com_img4'];
    	}
    	if($comment_info['com_img5']){
    		$imgs[5] = $comment_info['com_img5'];
    	}
    	$imgs = array_values($imgs);
    	return view(['imgs'=>$imgs]);
    }

    /**
     * 删除评价
     */
    public function del_comment(){
    	if(request()->isAjax()){
	        $time = time();
	        $data = input();
	        $obj =$this->setStatus('GoodsComment',$time,$data['id'],'comment_id','delete_time');
	        if(1 == $obj->code){
	            $obj->setApi('url',input('location'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
	    }
    }
    public function add_comment(){

    }
	//=======================================商品评价结束================================================//
	
	// function doExchange($arr){
 //        $len = count($arr);
 //        // 当数组大于等于2个的时候
 //        if($len >= 2){
 //            // 第一个数组的长度
 //            $len1 = count($arr[0]);
 //            // 第二个数组的长度
 //            $len2 = count($arr[1]);
 //            // 2个数组产生的组合数
 //            $lenBoth = $len1 * $len2;
 //            //  申明一个新数组
 //            $items = array();
 //            // 申明新数组的索引
 //            $index = 0;
 //            for($i=0; $i<$len1; $i++){
 //                for($j=0; $j<$len2; $j++){
 //                    if(is_array($arr[0][$i])){
 //                        $items[$index] = array_merge($arr[0][$i],$arr[1][$j]);
 //                    }else{
 //                        $items[$index] = array_merge([$arr[0][$i]],$arr[1][$j]);
 //                    }
 //                    $index++;
 //                }
 //            }
 //            // newArr = new Array(len -1);
 //            $newArr = array();
 //            for($i=2;$i<count($arr);$i++){
 //                $newArr[$i-1] = $arr[$i];
 //            }
 //            $newArr[0] = $items;
 //            return $this->doExchange($newArr);
 //        }else{
 //            return $arr[0];
 //        }
 //    }

 //    function getArrSet($arrs,$_current_index=-1){
	// 	//总数组
	// 	static $_total_arr;//总数组下标计数
	// 	static $_total_arr_index;//输入的数组长度
	// 	static $_total_count;//临时拼凑数组
	// 	static $_temp_arr;
	// 	//进入输入数组的第一层，清空静态数组，并初始化输入数组长度
	// 	if($_current_index<0){
	// 		$_total_arr=array();
	// 		$_total_arr_index=0;
	// 		$_temp_arr=array();
	// 		$_total_count=count($arrs)-1;
	// 		$this->getArrSet($arrs,0);
	// 	}else{
	// 	//循环第$_current_index层数组
	// 		foreach($arrs[$_current_index] as $v){
	// 	//如果当前的循环的数组少于输入数组长度
	// 			if($_current_index<$_total_count){
	// 				//将当前数组循环出的值放入临时数组
	// 				$_temp_arr[$_current_index]=$v;
	// 				//继续循环下一个数组
	// 				$this->getArrSet($arrs,$_current_index+1);
	// 			}else if($_current_index==$_total_count){//如果当前的循环的数组等于输入数组长度(这个数组就是最后的数组)
	// 				//将当前数组循环出的值放入临时数组
	// 				$_temp_arr[$_current_index]=$v;
	// 				//将临时数组加入总数组
	// 				$_total_arr[$_total_arr_index]=$_temp_arr;
	// 				//总数组下标计数+1
	// 				$_total_arr_index++;
	// 			}
	// 		}
	// 	}
	// 	return $_total_arr;
	// }
}