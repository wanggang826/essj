<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\User;
use app\common\Model\UserAddress;
use app\common\Model\UserRank;
/**
 * 用户管理控制器
 * @author  gucangfa
 * @version 2017.05.10
 */
class Users extends AdminBase{

    //=======================================用户管理开始================================================//
   	/**
	* 用户列表
   	*/
   	public function index(){
        $searchText = input('searchText');
        $type = input('type');
        $users = model('User')->select_user(input(),$searchText,$type);
     	  return view([
               'lists'=>$users,
               'type'=>$type,
          ]);
   	}
    public function defaults(){
        $this->redirect(url('users/index'));
    }
   	/**
	* 新增用户
   	*/
   	public function add(){
   		if (request() -> isAjax()){
   			$data = model('User')->add_user(input());
   			if($data > 0){
           		Api()->setApi('url',url('Users/index'))->ApiSuccess();
           	}else{
           		Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
           	}
   		}
   		return view();
   	}

   	/**
	* 编辑用户
   	*/
   	public function edit(){
        $page = input('page');
        if(request() -> isAjax()){
            $data = input();
            unset($data['page']);
            $data = model('User')->edit_user($data);
            if($data > 0){
               Api()->setApi('url',url('Users/index',['page'=>input('page')]))->ApiSuccess();
            }else{
               Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
            }
        }
        $user_id = input('user_id');
        $users = User::get($user_id)->toArray();
        if($users['province'] != false){
            $areas['province'] =$users['province'];
            $areas['city'] =$users['city'];
            $areas['area'] =$users['area'];
            $area_arr = model('city')->get_city($areas);
            $users['province']=$area_arr['province'];//省
            $users['city']=$area_arr['city'];//市
            $users['area']=$area_arr['area'];//区
        }
        $users['qrcode'] = getQrcode();
        return view([
            'user_info'=>$users,
            'page'=>$page,
        ]);
   	}

   	/**
	 * 删除用户
   	*/
   	public function del(){
   		if(request()->isAjax()){
          $time = time();
          $data = input();
          $obj =$this->setStatus('user',$time,$data['id'],'','delete_time');
          if(1 == $obj->code){
              Api()->setApi('url',input('location'))->ApiSuccess();
          }else{
              Api()->setApi('url',0)->ApiError();
          }
      }
   	}

    /**
      * 用户状态修改
      */
    public function status(){
      $status = input('status');
      $url = input('location',url('users/index'));
      $id = input('user_id');
      $re = $this->setStatus('user',$status,$id);
      if($re->code == 1){
             Api()->setApi('url',$url)->ApiSuccess($re);
          }else{
             Api()->setApi('url',0)->ApiError();
          }
    }

    /**
     * 会员头像
     * */
    public function user_img(){
        if(request()->isAjax()){
            $user_id = input('user_id');
            $photo   = model('user')->getUserName($user_id,'photo');
            $info    = upload_img('avatar_file','user');
            if($info){
                if(!empty($photo)){
                    $pash = './upload/'.$photo;
                    if(file_exists($pash)){//删除原图片
                        unlink($pash);
                    }
                }
                $data['photo'] = $info;
                $re = model('user')->edit_photo($user_id,$data);
                if($re){
                    Api()->setApi('url', url('Users/edit', ['page' => input('page')]))->ApiSuccess(config('static_url').'/upload/'.$info);
                }else{
                    Api()->ApiError();
                }
            }else{
                Api()->setApi('msg', '上传失败,请查看格式和大小!')->setApi('url', 0)->ApiError();
            }
        }
    }

    //=======================================用户管理结束================================================//

    //=======================================用户收货地址开始================================================//
    /**
     * 用户收货地址列表
     */
    public function address(){
      $address = model('UserAddress')->select_address(input());
      foreach ($address as $value) {
          $value['account'] = model('User')->getUserName($value['user_id']);
          $areas['province'] =$value['area_id1'];
          $areas['city'] =$value['area_id2'];
          $areas['area'] =$value['area_id3'];
          $area_arr = model('city')->get_city($areas);
          $value['area_id1']=$area_arr['province'];//省
          $value['area_id2']=$area_arr['city'];//市
          $value['area_id3']=$area_arr['area'];//区
      }
      return view([
               'lists'=>$address,
          ]);
    }

    /**
     * 用户地址详情
     */
    public function address_detail(){
      $address = model('UserAddress')->detail_address(input());
      foreach ($address as $value) {
          $value['account'] = model('User')->getUserName($value['user_id']);
          $areas['province'] =$value['area_id1'];
          $areas['city'] =$value['area_id2'];
          $areas['area'] =$value['area_id3'];
          $area_arr = model('city')->get_city($areas);
          $value['area_id1']=$area_arr['province'];//省
          $value['area_id2']=$area_arr['city'];//市
          $value['area_id3']=isset($area_arr['area']) ? $area_arr['area'] : '';//区
      }
      return view([
          'lists'=>$address,
      ]);
    }

    /**
     * 用户地址删除
     */
    public function address_del(){
      if(request()->isAjax()){
        dump(input('location'));
          $time = time();
          $data = input();
          $obj =$this->setStatus('UserAddress',$time,$data['id'],'address_id','delete_time');
          if(1 == $obj->code){
              Api()->setApi('url',input('location'))->ApiSuccess();
          }else{
              Api()->setApi('url',0)->ApiError();
          }
      }
    }

    //=======================================用户地址结束================================================//
    //=======================================会员等级开始================================================//
    /**
     * 会员等级列表
     */
    public function rank(){
      $rank = model('UserRank')->select_rank();
      return view([
          'lists' => $rank,
        ]);
    }

    /**
     * 会员等级添加
     */
    public function rank_add(){
      if (request() -> isAjax()){
        $data = model('UserRank')->add_rank(input());
        if($data > 0){
              Api()->setApi('url',url('Users/rank'))->ApiSuccess();
            }else{
              Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
            }
      }
      return view();
    }

    /**
     * 会员等级编辑
     */
    public function rank_edit(){
        $page = input('page');
        if(request() -> isAjax()){
            $data = input();
            unset($data['page']);
            $data = model('UserRank')->edit_rank($data);
            if($data > 0){
               Api()->setApi('url',url('Users/rank',['page'=>input('page')]))->ApiSuccess();
            }else{
               Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
            }
        }
        $rank_id = input('rank_id');
        $rank_info = UserRank::get($rank_id)->toArray();
        return view([
            'rank_info' => $rank_info,
            'page' => $page,
        ]);
    }

    /**
     * 会员等级删除
     */
    public function rank_del(){
      if(request()->isAjax()){
          $time = time();
          $data = input();
          $obj =$this->setStatus('UserRank',$time,$data['id'],'rank_id','delete_time');
          if(1 == $obj->code){
              Api()->setApi('url',input('location'))->ApiSuccess();
          }else{
              Api()->setApi('url',0)->ApiError();
          }
      }
    }

    /**
     * 会员等级状态
     */
    public function rank_status(){
      $status = input('status');
      $url = input('location',url('users/rank'));
      $id = input('rank_id');
      $re = $this->setStatus('UserRank',$status,$id,'rank_id');
      if($re->code == 1){
             Api()->setApi('url',$url)->ApiSuccess($re);
          }else{
             Api()->setApi('url',0)->ApiError();
          }
    }

    
   //=======================================会员等级结束================================================//

}