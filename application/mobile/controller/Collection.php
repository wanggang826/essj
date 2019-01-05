<?php
/**
 * Created by tiway
 * Date: 2017/9/25
 * Time: 14:08
 */

namespace app\mobile\controller;


use app\common\controller\MobileBase;
use think\Exception;

class Collection extends MobileBase
{

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

    }

    /**
     * @desc 收藏取消/添加
     * @return \think\response\Json
     */
    public function collection_add(){
        if(request()->ispost()){
            try{
                $goods_id = input('goods_id');
                $price_id = input('price_id');
                $collection_status = input('collection_status');
                if(empty($this->user_id))
                    return json(apiSessionFail());
                if(empty($goods_id))
                    throw new Exception('参数错误');
                if(empty($price_id))
                    throw new Exception('参数错误');
                if(!isset($collection_status))
                    throw new Exception('参数错误');

                $data = array(
                    'user_id'   => $this->user_id,
                    'goods_id'  => $goods_id,
                    'price_id'  => $price_id
                );
                if($collection_status == 1){
                    $res = model('Collection')->save($data);
                }elseif ($collection_status == 0){
                    $res = model('Collection')->where($data)->delete();
                }

                if(empty($res))
                    throw new Exception('操作失败');

                return json([
                    'code'  => 200,
                    'msg'   => '操作成功'
                ]);

            }catch (\Exception $e){
                return json($e->getMessage());
            }

        }
    }

    /**
     * @desc 收藏列表
     * @param bool $api
     * @return \think\response\Json|\think\response\View
     */
    public function collection_list($api = false){
        if(request()->isPost()){
            if(empty($this->user_id))
                return json(apiSessionFail());
            //我的收藏
            $collections = model('Collection')->getCollectionList($this->user_id);
            if($api){
                return json(apiSuccess($collections));
            }else{
                return view(['collection'=>$collections]);
            }

        }

    }

    /**
     * @desc
     * @return \think\response\Json
     */
    public function collection_del($api = false){
        if(request()->isPost()){
            try{
                $data = input();
                if(empty($this->user_id))
                    return json(apiSessionFail());
                if(empty($data['collection_id']))
                    throw new Exception('请选择要操作数据');
                $res  = model('Collection')
                    ->where('id',$data['collection_id'])
                    ->delete();
                if(empty($res))
                    throw new Exception('操作失败');

                return json([
                    'code'  => 200,
                    'msg'   => '操作成功'
                ]);

            }catch(\Exception $e){
                return json($e->getMessage());
            }
        }
    }

}