<?php
namespace app\shop\controller;
use think\Session;
use think\Cookie;
class Goods extends MallBase
{
    public function index(){
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 3,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        $cate_id = input('cate_id')?input('cate_id'):cookie('cate_id');
        cookie('cate_id',$cate_id);
        if(input('cate_id')){
            $goods = model('goods')->select_list($cate_id);//商品列表(推荐商品与类别商品)
        }else{
            $ajax_type = input();
            $type = input('type');
            $id = input('id');
            $all = input('is_all')?:[];
            $arr = Cookie::has('brands_attr') ? json_decode(Cookie::get('brands_attr'),true) : [];
            Cookie::clear('brands_attr');
            if($type == 'brands'){//品牌
                if(!empty($all)){
                    // Cookie::clear('brands_attr.brands_id');
                    unset($arr['brands_id']);
                }else{
                    $arr = ["brands_id"=>$id] + $arr;
                }
            }elseif($type == 'attr'){//属性+值
                if (input('attr_value') != '不限') {
                    $arr = [$id=>input('attr_value')] + $arr;
                } else {
                    unset($arr[$id]);
                    // Cookie::clear($id);
                }
            }
            Cookie::set('brands_attr',json_encode($arr));
            //============属性处理开始=============//
            $goods_id = []; 
            foreach ($arr as $key => $v) {
                if((int)$key){
                    $result = model('GoodsGoodAttr')->where("attr_id = '".$key."' AND value LIKE '%".$v."%'")->field('goods_id')->column('goods_id');
                    $goods_id[] = $result;
                }
            }
            $c = count($goods_id)>=1?count($goods_id):0;
            $arr['goods_id'] = [];
            $str = '';
            for ($i=0; $i < $c; $i++) {
                if ($str) {
                    $str .= ',';
                } else{
                    $str .= 'return array_intersect(';
                }
                $str .= '$goods_id['.$i.']';
            }
            $str .= ');';
            if ($c > 1) {
                $arr['goods_id'] = eval($str);
            }elseif($c == 1){
                foreach ($goods_id as $value) {
                    $arr['goods_id'] = $value;
                }
            }
            if($c >= 1 && empty($arr['goods_id']) && input('attr_value') != '不限'){
                $arr['goods_id'][] = 0;
            }
            //============属性处理结束=============//
            //===============排序查询开始===============//
            if($type == 'look_num'){//人气
                $arr['order'] = 'look_num desc';
            }elseif($type == 'sale_count'){//销售量
                $arr['order'] = 'sale_count desc';
            }elseif($type == 'shop_price'){//价格
                $arr['order'] = 'shop_price desc';
            }elseif($type == 'is_new'){//新品
                $arr['is_new'] = 'is_new = 1';
            }
            //==============排序查询结束=============//
            $goods = model('goods')->select_list($cate_id);//商品列表(推荐商品与类别商品)
            $goods['goods_list'] = model('goods')->ajax_get_goods($arr,$ajax_type);

        }
        $cate_brands = model('GoodsCateBrands')->select_brand($cate_id);//类别品牌
        $cate_attr = model('GoodsCateAttr')->select_attr($cate_id);//类别属性
        $goods['page'] = $goods['goods_list']->render();
       // Cookie::clear('brands_attr');
        if(request()->isAjax()){
            return json($goods);
        }
        $this->assign('goods', $goods);
        $this->assign('cate', $this->cate_nav());
        $this->assign('top_nav', $this->nav_top());
        return view([
            'cate_brands'=>$cate_brands,
            'cate_attr'=>$cate_attr,
        ]);
    }

    public function good_detail(){
        $this->redirect(url('shop/good_detail',['good_id'=>input('good_id')]));
    }

    /*
    * 品牌+属性搜索商品
    */
    public function get_goods(){

    }

}


