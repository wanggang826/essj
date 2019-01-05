<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\Shop;
use extend\Upload;
/**
 * 店铺控制器
 * @author  wangang 
 * @version 2017/6/2
 */
class Shops extends AdminBase{
	/**
	 * 店铺列表
	 */
	public function index(){
		$data  = input();
		$shops = model('Shop')->select_shop($data,['is_check'=>['eq',1]]);
		// dump($shops);die;
		return view(['shops'=>$shops]);
	}
	/**
	 * 店铺启用|禁用
	 */
	public function changeStatus(){
		$obj =$this->setStatus('Shop',input('status'),input('shop_id'),'shop_id');
    	if(1 == $obj->code){
    		Api()->setApi('url',input('location'))->ApiSuccess();
    	}else{
    		Api()->ApiError();
    	}
	}
	/**
	 * 店铺删除
	 */
	public function del(){
		if(request()->isAjax()){
        $time = time();
        $data = input();
        $obj =$this->setStatus('shop',$time,$data['id'],'','delete_time');
        if(1 == $obj->code){
            $obj->setApi('url',input('location'))->apiEcho();
        }else{
            $obj->setApi('url',0)->apiEcho();
        }
      }
	}

	/**
	 * 店铺编辑
	 */
	public function edit(){
		$shop_id   = input('shop_id');
		$shop_info = model('shop')->get_info($shop_id);
		resultToArray($shop_info);
		$img_url_logo    = "./upload".$shop_info['shop_logo'];
		if(!file_exists($img_url_logo)){
			$shop_info['shop_logo'] = '';
		}
		$img_url_idcard1    = "./upload".$shop_info['idcard1'];
		if(!file_exists($img_url_idcard1)){
			$shop_info['idcard1'] = '';
		}
		$img_url_idcard2    = "./upload".$shop_info['idcard2'];
		if(!file_exists($img_url_idcard2)){
			$shop_info['idcard2'] = '';
		}
		$city =model('city')->where('pid','1')->select();
		resultToArray($city);
		if(request()->isAjax()){
			$data =input();
			$i=0;
            if(isset($data['uploadImg'])){//是否有图片
                foreach ($data['uploadImg'] as $k=>$v){//取出图片的标识字段
                    foreach ($v as $key => $val){
                        $p = '/^http(.*)$/';
                        $verify = preg_match($p,$val);
                        if(!$verify) {
                           $shop_img[]=$k;
                        }else{
                            unset($data['uploadImg'][$k]);
                        }
                    }
                }
            }
            if(isset($shop_img)){
            	$year = date('Y/m',time());
            	//上传图片 返回图片名称 数组
                $re   = Upload::uploadImg("shop/$year")->getInfo();
                //若上传新图 依次判断是否有上传  删除原图
                $old_img = model('Shop')->where('shop_id','eq',$data['shop_id'])->field('shop_logo,idcard1,idcard2')->find()->toArray();
                if($old_img['shop_logo']){//确认原来图片不为空
                	$img_url_logo    = "./upload".$old_img['shop_logo'];
	                if (file_exists($img_url_logo) && in_array('shop_logo',$shop_img)) {
	                    unlink($img_url_logo);
	                }
                }
                if($old_img['idcard1']){
                	$img_url_idcard1 = "./upload".$old_img['idcard1'];
	                if (file_exists($img_url_idcard1) && in_array('idcard1',$shop_img)) {
	                    unlink($img_url_idcard1);
	                }
                }
                if($old_img['idcard2']){
                	$img_url_idcard2 = "./upload".$old_img['idcard2'];
	                if (file_exists($img_url_idcard2) && in_array('idcard2',$shop_img)) {
	                    unlink($img_url_idcard2);
	                }
                }
                $shop_img =array_values($shop_img);
                //处理上传图片数据 便于存数据库
                foreach ($shop_img as $key => $value) {
                	$data[$shop_img[$key]] = "/shop/".$year."/".$re[$key];
                }
            }
            $result = model('shop')->edit_shop($data);
            if($result){
            	Api()->setApi('url',url('shops/index'))->ApiSuccess();
            }else{
            	Api()->setApi('url',0)->ApiError();
            }
		}
		return view(['shop_info'=>$shop_info,'city'=>$city,]);
	}

	/**
	 * 店铺审核信息列表
	 */
	public function check_index(){
		$data  = input();
		$shops = model('Shop')->select_shop($data,['is_check'=>['neq',1]]);
		// dump($shops);die;
		return view(['shops'=>$shops]);
	}

    /**
     * 店铺审核详情
     */
    public function check_detail(){
        $shop_id   = input('shop_id');
        $shop_info = model('shop')->get_info($shop_id);
        resultToArray($shop_info);
        $img_url_logo    = "./upload".$shop_info['shop_logo'];
        if(!file_exists($img_url_logo)){
            $shop_info['shop_logo'] = '';
        }
        $img_url_idcard1    = "./upload".$shop_info['idcard1'];
        if(!file_exists($img_url_idcard1)){
            $shop_info['idcard1'] = '';
        }
        $img_url_idcard2    = "./upload".$shop_info['idcard2'];
        if(!file_exists($img_url_idcard2)){
            $shop_info['idcard2'] = '';
        }
        $city =model('city')->where('pid','1')->select();
        resultToArray($city);
        return view(['shop_info'=>$shop_info,'city'=>$city,]);
    }
	/**
	 * 店铺审核通过
	 */
	public function check_agree(){
		if(request()->isAjax()){
	        $data = input();
	        $obj  = $this->setStatus('shop',1,$data['id'],'','is_check');
	        if(1 == $obj->code){
	            $obj->setApi('url',url('shops/check_index'))->apiEcho();
	        }else{
	            $obj->setApi('url',0)->apiEcho();
	        }
	    }
	}
	/**
	 * 店铺审核不通过
	 */
	public function check_disagree(){
		if(request()->isAjax()){
            $id = input('id');
            $where['is_check'] = '-1';
            $where['check_des'] = input('check_des');
            $obj = model('shop')->save($where,['shop_id'=>$id]);
	        if(1 == $obj){
	            Api()->setApi('url',input('location'))->ApiSuccess();
	        }else{
	            Api()->setApi('url',0)->ApiError();
	        }
	    }
	}

	/*
     * 店铺分类导航列表
     * */
    public function nav_index(){
        $nav = model('GoodsShopcate')->select_nav();
        if($nav){
            $tree  = getTree($nav,['primary_key'=>'id'])->makeTreeForHtml();
        }else{
            $tree  = array();
        }      
        return  view(['tree'=>$tree]);
    }
    /*
     * 获取店铺分类导航树形列表
     * */
     public  function getNavTree($pid){
          $id = $pid ? $pid : 0;
          $tree  = model('GoodsShopcate')->select();
          resultToArray($tree);
          $select = getTree($tree,['primary_key'=>'id','class_name'=>'form-control i-select','form_name'=>'pid'],1)->makeSelect($id,'name',"顶级导航");
          return $select;
    }
    /*
     * 添加店铺分类导航
     * */
    public  function nav_add(){
        $pid = input('pid',0);
        $tree = $this->getNavTree($pid);
        if(request()->isAjax()){
            $data = input();
            $re = model('GoodsShopcate')->nav_add($data)  ;
            if($re>0){
                Api()->setApi('url',url('nav_index'))->ApiSuccess($re);
            }else{
                Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
            }
        }
        return  view(['tree'=>$tree]);
    }
    /*
      * 修改店铺分类导航
      * */
    public  function nav_edit(){
        if(request()->isAjax()){
           $data= input();
           $edit = model('GoodsShopcate')->edit($data);
           if($edit>0){
               Api()->setApi('url',url('nav_index'))->ApiSuccess($edit);
           }else{
               Api()->setApi('msg',$edit)->setApi('url',0)->ApiError();
           }
        }else{
            $pid = input('pid',0);
            $id=input('id');
            $tree = $this->getNavTree($pid);
            $info = model('GoodsShopcate')->where(['id'=>$id])->find();
            $nao_info = $info ->toArray($info);
        }
        return  view(['nao_info'=>$nao_info ,'tree'=>$tree]);
    }
    /*
     * 删除店铺分类导航信息
     * */
    public  function nav_del(){
        $data = input();
        $re = model('GoodsShopcate')->del($data);
         if($re>0){
             Api()->setApi('url',url('nav_index'))->ApiSuccess($re);
         }else{
             Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
         }
    }

    /*
     * 店铺分类导航状态切换
     * */
    public  function  nav_changeStatus(){
        $data=input();
        unset($data['location']);
        $re= model('GoodsShopcate')->edit_status($data);
        if($re){
            Api()->setApi('url',url('nav_index'))->ApiSuccess($re);
        }else{
            Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
        }
    }








}