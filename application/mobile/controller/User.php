<?php
/**
 * Created by tiway
 * Date: 2017/9/22
 * Time: 9:25
 */
namespace app\mobile\controller;

use extend\UploadImg;

class User extends \app\common\controller\MobileBase
{

    private $attr_like,$attr_capacity,$attr_color,$attr_net;

    public function _initialize(){

        parent::_initialize();
        $this->attr_capacity = 3;//容量
        $this->attr_color    = 2;//颜色
        $this->attr_like     = 4;//新旧
        $this->attr_net      = 1;//新旧

    }

    /**
     * @desc 个人中心
     * @param bool $api
     * @return \think\response\Json|\think\response\View
     */
    public function user_index($api = false){
        if(request()->isGet()){
            if(empty($this->user_id))
                return json(apiSessionFail());
            //个人信息
            $personal = model('User')->field('nickname,photo')->find($this->user_id);
            //我的积分
            $integrals = model('Integral')->getTotalIntegrals($this->user_id);
            //我的收藏
            $collections = model('Collection')->getTotalCollections($this->user_id);

            $data = array(
                'personal'  => $personal,
                'integrals' => $integrals,
                'collection'=> $collections
            );

            if($api){
                return json(apiSuccess($data));
            }else{
                return view(['data'=>$data]);
            }

        }


        
    }

    /**
     * @desc 个人
     * @param bool $api
     * @return \think\response\Json|\think\response\View
     */
    public function user_detail($api = false){
        if(request()->isGet()){
            if(empty($this->user_id))
                return json(apiSessionFail());
            //个人资料
            $personal = model('User')->find($this->user_id);
            if($api){
                return json(apiSuccess($personal));
            }else{
                return view(['personal'=>$personal]);
            }
        }
    }

    /**
     * @desc 收藏列表
     * @param bool $api
     * @return \think\response\Json|\think\response\View
     */
    public function user_collect($api = false){
        if(request()->isPost()){
            //每页条数
            $per_page = input('per_page','5');
            //第几页，默认第一页
            $page  = input('page','1');

            $goods = model('Collection')
                ->with(['collectionGood'=>function($query){
                    $query->field('goods_id,goods_thums,goods_name,market_price,shop_price,is_sale');
                }])
                ->limit($per_page)->page($page)->select();

            if($api){
                return json(apiSuccess($goods));
            }else{
                return view(['goods'=>$goods]);
            }
        }
    }

    /**
     * @desc 更新用户信息
     * @param bool $api
     * @return \think\response\Json
     */
    public function user_update($api = false){
        if(request()->isPost()){
            try{
                $data = input();
                if($api == true && empty($this->user_id))
                    return json(apiSessionFail());

                if(isset($data['imgs'])){
                    if(empty($data['imgs']))
                        throw new Exception('请上传个人图片');
                    $img_arr = array();
                    $img_arr['uploadImg']['user_img'][] = $data['imgs'];
                    $year = date('Y/m',time());
                    //上传图片 返回图片名称 数组
                    $res  = UploadImg::upload("user/$year",'time',$img_arr)->getMsg();
                    $user_imgs = "/user/".$year."/".$res['info']['user_img'][0];
                    unset($data['imgs']);

                    $re = model('User')->where('user_id',$this->user_id)->update(['photo'=>$user_imgs]);
                    if(empty($re))
                        throw new Exception('操作失败');
                }

                if(isset($data['nick_name'])){
                    if(empty($data['nick_name']))
                        throw new Exception('请填写昵称');

                    model('User')->where('user_id',$this->user_id)->update(['nickname'=>$data['nick_name']]);

                }

                if(isset($data['sex'])){
                    if(empty($data['sex']))
                        throw new Exception('请选择性别');

                    model('User')->where('user_id',$this->user_id)->update(['sex'=>$data['sex']]);

                }

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
     * @desc 邀请好友注册页面
     * @param bool $api
     * @return \think\response\Json
     */
    public function share_view($api = false){
        if(request()->isGet()){
            try{
                if($api == true && empty($this->user_id))
                    return json(apiSessionFail());
                //邀请好友获得积分
                $integral = model('config')->get_register_integral();

                $data =  array(
                    'integral'  => $integral,
                    'user_id'   => $this->user_id
                );

                return json(apiSuccess($data));

            }catch (\Exception $e){

                return json(apiFail($e->getMessage()));
            }
        }
    }


}