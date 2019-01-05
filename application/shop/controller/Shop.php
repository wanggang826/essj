<?php
namespace app\shop\controller;
use think\Cookie;
use think\session;
header("Content-type: text/html; charset=utf-8");
class Shop extends ShopBase
{
    public function index()
    {
        return view();
    }

    /*
     * 商品详情
     * */
    public function good_detail(){
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' =>2,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        if(request()->isAjax()){
            $data               = input();
            $goods_comment      = model('GoodsComment')->good_comment($data);//查评价,
            $page               = $goods_comment->render();
            if(isset($goods_comment[0])){
                $goods_comment[0]['headimg_url']  = $this->var['upload'];//图片路径
                $goods_comment[0]['page']         = $page;//分页
            }
            return  json($goods_comment);
        }else{
            $data = input();
            $goods_comment     = model('GoodsComment')->good_comment($data);//查评价,
            if(isset($goods_comment[0])){
                if(isset($data['page'])) {
                     array_key_exists('type',$data) && $goods_comment[0]['css'] = $data['type'] ;//样式
                    !array_key_exists('type',$data) && $goods_comment[0]['css'] = "all" ;//样式
                }
                !array_key_exists('page',$data) && $goods_comment[0]['css'] = "kong" ;//样式
            }
        }
        //Ip查用户地址开始
        $user_ip            = "118.255.255.255";//get_client_ip(0);//用户IP
        $url                = "http://ip.taobao.com/service/getIpInfo.php?ip=".$user_ip;//调用淘宝接口获取信息
        $interface          = file_get_contents($url);
        $area               = json_decode($interface,true);
        //Ip查用户地址结束
        if(!Cookie::get($data['goods_id'])){//防止用户恶意刷点击数
            model('Goods')->where('goods_id ='.$data['goods_id'])->setInc('look_num');//人气添加
            cookie($data['goods_id'],$data['goods_id']);
        }
        $nav                = model('GoodsShopcate')->where("pid = 0")->order('id,sort')->select();
        $good_info          = model('Goods')->getGood(['goods_id'=>$data['goods_id']]);//商品基本资料
        $shop_info          = model('shop')->get_info($good_info[0]['shop_id']);//商户详情
        $goods_good_attr    = model('GoodsGoodAttr')->get_attr($data['goods_id']);//商品属性attr_id
        $comment_info       = model('GoodsComment')->comment_info(['goods_id'=>$data['goods_id']]);//商品评价
        $good_info[0]['goods_comment']=$comment_info['all_num'];
        $images_arr         = ['goods_thums','goods_img1','goods_img2','goods_img3','goods_img4','goods_img5'];//图片字段
        for($i = 0; $i<count($images_arr);$i++ ){//检测图片是否存在
            $image_name     = $images_arr[$i];
            $name           = $good_info[0][$image_name];
            $url            = "./upload/$name";
            !file_exists($url) && $good_info[0][$image_name] = '';
        }
        $shop_id            = model('Goods')->where('goods_id ='.$data['goods_id'])->value('shop_id');//店铺id
        $sale_goods         = model('Goods')->where('shop_id ='.$shop_id.' AND goods_id !='.$data['goods_id'])->field('goods_id,goods_thums,goods_name,shop_price,sale_count,recom_desc')->order('sale_count desc')->limit(5)->select();//销售排行榜
        $user_id = session('user.user_id');
        if(isset($user_id)){//判断用户是否登录
            $where1                  = "user_id = {$user_id} AND collection_type = 'goods' AND target_id = {$good_info['0']['goods_id']}";
            $where2                  = "user_id = {$user_id} AND collection_type = 'shop' AND target_id = {$good_info['0']['shop_id']}";
            $good_info[0]['c_goods'] = model('Collection')->where($where1)->count();//商品收藏
            $good_info[0]['c_shop']  = model('Collection')->where($where2)->count();//店铺收藏
        }
        return view([
            'title'        =>'商品详情',
            'good_info'    =>$good_info[0],
            'shop_info'    =>$shop_info,
            'goods_attrs'  =>$goods_good_attr,
            'nav'          =>$nav,
            'sale_goods'   =>$sale_goods,
            'area'         =>$area['data'],
            'goods_comment'=>$goods_comment,
            'comment_info' =>$comment_info,
        ]);
    }


}