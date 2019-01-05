<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\Advpos;
use app\common\Model\Adv;
use extend\Upload;
/**
 * 广告管理控制器
 * @author  gucangfa
 * @version 2017.05.13
 */
class Advers extends AdminBase{

	//=================================广告管理开始====================================//
	/**
	 * 广告列表
	 */
	public function adv(){
        $lists = model('Adv')->select_adv(input());
     	return view([
            'lists'=>$lists,
        ]);
	}

	/**
	 * 添加广告
	 */
	public function adv_add(){
		$advpos = Advpos::get(input('advpos_id'));
		if(request()->isAjax()){
			$data = input();
            if(isset($data['uploadImg'])){//判断是否有图片
            	$year = date('Y/m',time());
                $re  = Upload::uploadImg("adv_pos/$year")->getInfo();
                $adv_img["adv_img"] = "/adv_pos/".$year."/".$re[0];
                unset($data['uploadImg']);
            	$data = $data+$adv_img;
            }
            $data['adv_url'] = $this->getUrl($data['adv_url']);//url处理
			$adv = model('Adv')->add_adv($data);
			if($adv > 0){
				Api()->setApi('url',url('Advers/advpos'))->ApiSuccess();
			}elseif($adv == '-1'){
				if(isset($data['uploadImg'])){//判断是否有图片
					$img = "./upload".$adv_img["adv_img"];
					if(file_exists($img)){
						unlink($img);
					}
				}
				Api()->setApi('msg','此开始日期下的广告数量已足够,请选择其它开始日期')->setApi('url',0)->ApiError();
			}else{
           		Api()->setApi('msg',$adv)->setApi('url',0)->ApiError();
			}
		}
		return view([
			'advpos' => $advpos,
		]);
	}

	/**
	 * 修改广告
	 */
	public function adv_edit(){
        $page =input('page');
		if(request() -> isAjax()){
            $data = input();
            if(isset($data['uploadImg'])){//判断是否有图片
            	$year = date('Y/m',time());
                $re  = Upload::uploadImg("adv_pos/$year")->getInfo();
                $adv_img["adv_img"] = "/adv_pos/".$year."/".$re[0];
            	if(isset($adv_img)){
	            	$year = date('Y/m',time());
	                //若上传新图 依次判断是否有上传  删除原图
	                $old_img = model('Adv')->where('adv_id','eq',$data['adv_id'])->field('adv_img')->find()->toArray();
                	if($old_img['adv_img']){//确认原来图片不为空
                		$old_url = "./upload".$old_img['adv_img'];//原图片文件路径
                		if(file_exists($old_url) && array_key_exists('adv_img', $adv_img)){
                			unlink($old_url);
                		}
                	}
	            }
	            unset($data['uploadImg']);
            	$data = $data+$adv_img;
            }
	        unset($data['page']);
            $data['adv_url'] = $this->getUrl($data['adv_url']);//url处理
            $adv = model('Adv')->edit_adv($data);
            if($adv > 0){
				Api()->setApi('url',url('Advers/adv',['page'=>input('page')]))->ApiSuccess();
			}elseif($adv == '-1'){
				if(isset($data['uploadImg'])){//判断是否有图片
					$img = "./upload".$adv_img["adv_img"];
					if(file_exists($img)){
						unlink($img);//删除已上传的图片
					}
				}
				Api()->setApi('msg','此开始日期的广告数量已足够,请选择其它开始日期')->setApi('url',0)->ApiError();
			}else{
				Api()->setApi('msg',$adv)->setApi('url',0)->ApiError();
			}
          }
        $adv_id = input('adv_id');
        $adv_info = Adv::get($adv_id)->toArray();//广告信息
        $advpos = Advpos::get($adv_info['adv_pos']);//广告位信息
        $adv_info['advpos_name'] = $advpos['advpos_name'];
   		return view([
            'adv_info' => $adv_info,
            'advpos' => $advpos,
            'page'=>$page,
        ]);
	}

	/**
	 * 删除广告
	 */
	public function adv_del(){
		if(request()->isAjax()){
			$time = time();
          	$data = input();
          	$obj =$this->setStatus('adv',$time,$data['id'],'','delete_time');
          	if(1 == $obj->code){
              	Api()->setApi('url',input('location'))->ApiSuccess();
          	}else{
              	Api()->setApi('url',0)->ApiError();
          	}
		}
	}


	//=================================广告管理结束====================================//

	//=================================广告位管理开始====================================//
	/**
	 * 广告位列表
	 */
	public function advpos(){
        $data = input();
        $lists = model('Advpos')->select_advpos($data);
     	return view([
            'lists'=>$lists,
        ]);
	}

	/**
	 * 添加广告位
	 */
	public function advpos_add (){
		if(request()->isAjax()){
			$data = input();
	        $data['advpos_ename'] = strtoupper($data['advpos_ename']);	     
			$data = model('Advpos')->add_advpos($data);
			if($data > 0){
				Api()->setApi('url',url('Advers/advpos'))->ApiSuccess();
			}else{
				Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
			}
		}
		return view();
	}

	/**
	 * 修改广告位
	 */
	public function advpos_edit(){
		$page = input('page');
		if(request() -> isAjax()){
            $data = input();
            unset($data['page']);
            $data = model('Advpos')->edit_advpos($data);
            if($data > 0){
               Api()->setApi('url',url('advers/advpos',['page'=>input('page')]))->ApiSuccess();
            }else{
               Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
            }
          }
        $advpos_id = input('advpos_id');
        $advpos_info = Advpos::get($advpos_id)->toArray();
   		return view([
            'advpos_info'=>$advpos_info,
            'page'=>$page,
        ]);
	}

	/**
	 * 删除广告位
	 */
	public function advpos_del(){
		if(request()->isAjax()){
			$time = time();
          	$data = input();
          	$obj =$this->setStatus('advpos',$time,$data['id'],'','delete_time');
          	if(1 == $obj->code){
          		Adv::destroy(['adv_pos' => ['in',$data['id']]]);//删除该广告位下的所有广告
              	Api()->setApi('url',input('location'))->ApiSuccess();
          	}else{
              	Api()->setApi('url',0)->ApiError();
          	}
		}
	}

	/**
	 * 广告位状态修改
	 */
	public function advpos_status(){
		$status = input('status');
      	$url = input('location',url('advers/advpos'));
      	$id = input('advpos_id');
      	$re = $this->setStatus('advpos',$status,$id);
      	if($re->code == 1){
            $re->setApi('url',$url)->apiEcho();
        }else{
            Api()->setApi('url',0)->ApiError();
        }
    }

	//=================================广告位管理结束====================================//

}