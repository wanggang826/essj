<?php
/**
 * Created by tiway
 * Date: 2017/10/9
 * Time: 15:52
 */

namespace app\mobile\controller;


use app\common\controller\MobileBase;
use think\Exception;
use think\Request;

class Address extends MobileBase
{

    public function _initialize(){

        parent::_initialize();

    }

    /**
     * @desc 地址列表
     * @param bool $api
     * @return \think\response\Json|\think\response\View
     */
    public function address_list($api = false){
        if(request()->isPost()){
//            //每页条数
//            $per_page = input('per_page','5');
//            //第几页，默认第一页
//            $page  = input('page','1');
            if(empty($this->user_id))
                return json(apiSessionFail());

            $addresses = model('UserAddress')
                ->with('province')
                ->where('user_id',$this->user_id)
                ->order('address_id asc')
//                ->limit($per_page)
//                ->page($page)
                ->select();

            foreach ($addresses as $key=>&$val){
                $addresses[$key]['area_id1'] = $val->province->city_name;
                $addresses[$key]['area_id2'] = $val->city->city_name;
                if($addresses[$key]['area_id3'] != 0){
                    $addresses[$key]['area_id3'] = $val->area->city_name;
                    unset($val->area);
                }else{
                    unset($val['area_id3']);
                }
                unset($val->province);
                unset($val->city);
            }

            if($api){
                return json(apiSuccess($addresses));
            }else{
                return view(['addresses'=>$addresses]);
            }
        }
    }


    //设置默认地址
    public function address_default($api = false){
        if(request()->isPost()){
            try{
                if(empty($this->user_id))
                    return json(apiSessionFail());

                if(empty($this->user_id))
                    return json(apiSessionFail());

                $address_id = input('address_id');
                if(empty($address_id))
                    throw new Exception('请选择默认地址');


                //设置默认地址
                model('user_address')
                   ->where('user_id',$this->user_id)
                   ->update(['is_default'=>0]);
                model('user_address')
                   ->where('user_id',$this->user_id)
                   ->where(['user_id'=>$this->user_id,'address_id'=>$address_id])
                   ->update(['is_default'=>1]);


                if($api){
                    return json(apiSuccess());
                }else{
                    return view(['msg'=>'请求成功']);
                }

            }catch (\Exception $e){
                if($api){
                    return json(apiFail($e->getMessage()));
                }else{
                    return view(['msg'=>$e->getMessage()]);
                }
            }
        }
    }

    //地址删除
    public function address_del($api = false){
        if(request()->isPost()){
            try{
                $address_id = input('address_id');
                if(empty($address_id))
                    throw new Exception('请选择要删除地址');

                $res = model('user_address')->where('address_id',$address_id)->delete();

                if(empty($res))
                    throw new Exception('删除失败');

                if($api){
                    return json(apiSuccess());
                }else{
                    return view(['msg'=>'请求成功']);
                }

            }catch (\Exception $e){
                if($api){
                    return json(apiFail($e->getMessage()));
                }else{
                    return view(['msg'=>$e->getMessage()]);
                }
            }
        }
    }

    //地址新增
    public function address_add($api = false){
        if(request()->isPost()){
            try{
                if(empty($this->user_id))
                    return json(apiSessionFail());

                $data = Request::instance()->except('api,sid');
                if(empty($data['user_name']))
                    throw new Exception('请填写收货人姓名');

                if(!preg_match("/^1[34578]\d{9}$/", $data['user_phone']))
                    throw new Exception('请填写正确手机号码');

                if(empty($data['cities']))
                    throw new Exception('请选择收货地址');

                if(empty($data['address']))
                    throw new Exception('请填写收货人详细地址');

                $address_arr = explode(',',$data['cities']);
                $data['user_id'] = $this->user_id;
                $data['area_id1'] = $address_arr[0];
                $data['area_id2'] = $address_arr[1];
                $data['area_id3'] = isset($address_arr[2]) ? $address_arr[2] : '';
                unset($data['cities']);

                if(isset($data['address_id'])){
                    model('user_address')
                        ->where('address_id',$data['address_id'])
                        ->update($data);
                }else{
                    model('user_address')
                        ->save($data);
                }

                if($api){
                    return json(apiSuccess());
                }else{
                    return view(['msg'=>'添加成功']);
                }

            }catch (\Exception $e){
                if($api){
                    return json(apiFail($e->getMessage()));
                }else{
                    return view(['msg'=>$e->getMessage()]);
                }
            }
        }
    }

    //地址编辑渲染
    public function address_edit($api = false){
        if(request()->isPost()){
            try{
                $address_id = input('address_id');
                if(empty($address_id))
                    throw new Exception("请选择要编辑的地址");

                $address = model('user_address')
                    ->field('address_id,user_name,user_phone,area_id1,area_id2,area_id3,address,create_time')
                    ->where('address_id',$address_id)->find();

                $address['cities']   = $address['area_id1'].','.$address['area_id2'].','.$address['area_id3'];
                $address['area_id1'] = $address->province->city_name;
                $address['area_id2'] = $address->city->city_name;
                if($address['area_id3'] != 0){
                    $address['area_id3'] = $address->area->city_name;
                }else{
                    $address['area_id3'] = '';
                }

                unset($address->province);
                unset($address->city);
                unset($address->area);
                if($api){
                    return json(apiSuccess($address));
                }else{
                    return view(['data'=>$address]);
                }

            }catch (\Exception $e){
                if($api){
                    return json(apiFail($e->getMessage()));
                }else{
                    return view(['msg'=>$e->getMessage()]);
                }
            }
        }
    }
}