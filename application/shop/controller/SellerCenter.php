<?php
namespace app\shop\controller;
use app\common\controller\ShopApp;
use extend\Encrypt;
use extend\Upload;
//use function PHPSTORM_META\map;
use think\Session;
use think\Config;
use think\Db;
use extend\UploadImg;
use app\common\Model\GoodsCate;
/**
 *
 */
class SellerCenter extends ShopApp
{

    public function apply_seller(){
        $user_id = session('user.user_id');
        $shop = model('shop')->where('user_id ='.$user_id)->field('shop_id,phone,idcard_sn,idcard1,idcard2,idcard3,is_check')->find();
        if(!empty($shop) && ($shop['is_check'] == '-1')){
            $this->assign('shop_seller',$shop);
        }
        return view();
    }

    public function index(){
        $month            =  mktime(0,0,0,date('m'),1,date('Y'));//月初时间戳
        $data['user_id']  =  session('user.user_id');
        $shop = model('Shop')->where('user_id ='.$data['user_id'])->count();
        if($shop == false){
            $this->redirect(url('SellerCenter/apply_seller'));
        }
        $shop_id          =  model('Shop')->where(['user_id'=>$data['user_id']])->field('shop_id')->find()->toArray();//店铺ID
        $shop_info        =  model('Shop')->get_info($shop_id['shop_id'])->toArray();//店铺资料详情
        $recycle          =  model('order')->recycle(['recycle'=>1,'user_id'=>$data['user_id']]);//不同状态的订单量
        $order_order      =  model('order')->shop_order_info($month,$shop_id['shop_id']);//商铺本月订单数量,总金额
        $shop_comment     =  model('GoodsComment')->shop_comment($month,$shop_id['shop_id']);//商铺本月评价详情数量
        $article          =  getArticle();//文章分类
        return view([
            'shop_info'   => $shop_info,
            'recycle'     => $recycle,
            'article'     => $article,
            'order_order' => $order_order,
            'shop_comment'=> $shop_comment,
        ]);
    }
    /**by  pengqinag
     *卖家取现
     */
    public function cash(){
        config(['paginate'=>['type' => 'bootstrap1','list_rows' =>1,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        $user_id   = Session('user.user_id');
        $user_info         = model('User')->where(['user_id'=>$user_id])->find();//用户详情
        $bank              = model('Bank')->bank_list(['user_id'=>$user_id]);//用户银行账号信息
        $stay_order        = model('order') ->where(['status'=>['in',[4,5]]])->select();//用户待到账订单
        if(request()->isAjax()){//提现
            $data = input();
           if($data['money'] <= $user_info['money']){
               $money = $user_info['money'] - $data['money'];
               $user_money =  model('User')->save(['money'=>$money],['user_id'=>$user_info['user_id']]);
              if($user_money){
                  return  json($user_money) ;
              }
           }
        }
        $data = input();
        $data['user_id'] =$user_id;
        $user_account_log  = model('UserAccountLog')->select_accountLog($data);
        $page              = $user_account_log->render();//分页
        $stay_money=0;
        foreach ($stay_order as $k=>$v){
            $stay_money    += $v['deal_price']+$v['despatch_money'];
        }
        $stay_money        = sprintf("%.2f",$stay_money);//待到账的钱
        $all_money         = sprintf("%.2f",($stay_money+$user_info['money']));//总金额
        return  view([
            'user_info'    => $user_info,
            'bank'         => $bank,
            'account'      => $user_account_log,
            'stay_money'   => $stay_money,
            'all_money'    => $all_money,
            'page'         => $page,
        ]);
    }

    public function basic_settings(){
        if(request()->isAjax()){
                $data = input();
                $data['user_id'] = session('user.user_id');
                if(isset($data['uploadImg'])){//判断是否有图片
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
                    $old_img = model('Shop')->where('user_id','eq',$data['user_id'])->field('shop_logo,shop_banner')->find();
                    if($old_img['shop_logo']){//确认原来图片不为空
                        $img_url_logo    = "./upload".$old_img['shop_logo'];
                        if (file_exists($img_url_logo) && in_array('shop_logo',$shop_img)) {
                            unlink($img_url_logo);
                        }
                    }
                    if($old_img['shop_banner']){
                        $img_url_idcard1 = "./upload".$old_img['shop_banner'];
                        if (file_exists($img_url_idcard1) && in_array('shop_banner',$shop_img)) {
                            unlink($img_url_idcard1);
                        }
                    }
                    //处理上传图片数据 便于存数据库
                    foreach ($shop_img as $key => $value) {
                        $data[$shop_img[$key]] = "/shop/".$year."/".$re[$key];
                    }
                }
            $data['shop_id'] = model('shop')->where(['user_id'=>$data['user_id']])->value('shop_id');
            $result = model('shop')->edit_shop($data);
            if ($result > 0) {
                Api()->setApi('url', url('seller_center/basic_settings'))->ApiSuccess();
            } else {
                Api()->setApi('msg', $result)->setApi('url', 0)->ApiError();
            }
        }else{
            $user_id = session('user.user_id');
            $shop_info = model('Shop')->where(['user_id'=>$user_id])->find();
            if($shop_info['area_id1'] != false){
                $areas['province'] =$shop_info['area_id1'];
                $areas['city'] =$shop_info['area_id2'];
                $areas['area'] =$shop_info['area_id3'];
                $area_arr = model('city')->get_city($areas);
                $shop_info['area_id1']=$area_arr['province'];//省
                $shop_info['area_id2']=$area_arr['city'];//市
                $shop_info['area_id3']=$area_arr['area'];//区
            }
            $this->assign('shop_info',$shop_info);
            return view();
        }
    }
    /**
     *卖家中心商品管理
     * @author  wanggang
     * @version 2017/07/4
     */
    public function s_good_mgr(){
        _pageconfig(3);
        $shop_id = model('shop')->where('user_id',session('user.user_id'))->value('shop_id');
        $goods   = model('goods')->shop_goods_select($shop_id,input());
        foreach ($goods as $key => $value) {
           $goods[$key]['attrs'] = model('GoodsGoodAttr')->get_attr($value['goods_id']);
        }
        // dump($goods);
        $cates   = model('GoodsCate')->where('pid',0)->select();    
        return view(['cates'=>$cates,'goods'=>$goods,]);
    }
    /**
     * ajax 编辑商品库存
     * @author  wanggang
     * @version 2017/07/5
     */
    public function edit_inventory(){
        $info =input();
        extract($info);
        $data[$field]=trim($value);
        $re =model('goods')->save($data,['goods_id'=>$goods_id]);
        echo json_encode($re);
    }
    /**
     * 商品上架|下架
     * @author  wanggang
     * @version 2017/07/4
     */
    public function is_sale(){
       if(request()->isAjax()){
            $data = input();
            $obj  = $this->setStatus('goods',$data['is_sale'],$data['id'],'','is_sale',['is_check'=>1]);
            if(1 == $obj->code){
                $obj->setApi('url',input('location'))->apiEcho();
            }else{
                $obj->setApi('url',0)->apiEcho();
            }          
       }
    }
    /**
     * 删除商品
     * @author  wanggang
     * @version 2017/07/4
     */
    public function del_goods(){
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
     * 商品推荐|取消推荐
     * @author  wanggang
     * @version 2017/07/4
     */
    public function is_recom(){
        if(request()->isAjax()){
            if(request()->isAjax()){
                $data    = input();
                $obj     = $this->setStatus('goods',$data['is_recom'],$data['id'],'','is_recom');
                if(1 == $obj->code){
                    $obj->setApi('url',input('location'))->apiEcho();
                }else{
                    $obj->setApi('url',0)->apiEcho();
                }
            }
       }
    }
    /**
     * 获取店铺树状类别列表
     * @author  wanggang
     * @version 2017/07/4
     */
    public function getCateTree($shop_id,$id = 0){
        $cates = model('GoodsShopcate')->where(['status'=>['<>',-1],'shop_id'=>$shop_id])->order('sort', 'asc')->select();
        resultToArray($cates);
        $select = getTree($cates,['primary_key'=>'id','class_name'=>'right_nav_basic_goodsinput i-select','form_name'=>'cate_id'],2)->makeSelect($id,'name',"顶级分类");
        return $select;
    }
    /**
     * 商品发布
     * @author  wanggang
     * @version 2017/07/4
     */
    public function release_good(){
        $step     = 'release_good_'.input('step',1,'int');
        $this->$step();
        $this->release_good_1();
        $this->release_good_2();
        return view($step);
        
    }
    /**
     * 发布商品第一步
     * @author  wanggang
     * @version 2017/07/5
     */
    protected function release_good_1(){
        $cates    = model('GoodsCate')->where('pid',0)->select();
        $shop_id = model('shop')->where('user_id',session('user.user_id'))->value('shop_id');
        //查询2级树状店铺分类
        $this->assign('select',$this->getCateTree($shop_id));
        $attr_ids = model('GoodsCateAttr')->where(['cate_id'=>['in',[input('cate1'),input('cate2'),input('cate3')]]])->column('attr_id');
        //查询属性列表，处理数据（反序列化）页面判断类型遍历
        $attrs = model('GoodsAttr')->where(['status'=>['<>',-1],'attr_id'=>['in',$attr_ids]])->order('sort', 'asc')->select();
        resultToArray($attrs);
        foreach ($attrs as $key => $value) {
            $attrs[$key]['value'] = unserialize($value['value']);
        }
        if(input('step') && input('cate1') && input('cate2') && input('cate3')){
            $this->assign('cate_id1',input('cate1'));
            $this->assign('cate_id2',input('cate2'));
            $this->assign('cate_id3',input('cate3'));
        }
        $this->assign('cates',$cates);
        $this->assign('attrs',$attrs);
    }
    /**
     * 发布商品第二步
     * @author  wanggang
     * @version 2017/07/5
     */
     protected function release_good_2(){
        if(request()->isAjax()){
            $data = input();
            $year      = date('Y/m',time());
            $color_val   = $data['color_val'];
            $goods_color = array();
            if(isset($data['uploadImg'])){
                //上传图片 返回图片名称 数组
                $up_info   = UploadImg::upload("goods/$year")->getMsg();
                if(isset($up_info['info']['file1'])){
                    if ($up_info['info']['file1'][0]) {
                        $good_info['goods_thums']   = "/goods/".$year."/".$up_info['info']['file1'][0];
                    } else {
                        $good_info['goods_thums']   = "";
                    }
                    unset($up_info['info']['file1'][0]);
                    $good_imgss = $up_info['info']['file1'];
                    foreach ($good_imgss as $k => $v) {
                        $good_info['goods_img'.$k] = "/goods/".$year."/".$v;
                    }
                }
                foreach ($color_val as $k => $val) {
                    if(isset($color_val[$k])){
                        if(isset($up_info['info'][$k])){
                            $goods_color[$k]['val']  = $val;
                            $goods_color[$k]['des']  = $data['color_des'][$k];
                            $goods_color[$k]['img']  = "/goods/".$year."/".$up_info['info'][$k][0];
                        }else{
                            $goods_color[$k]['val']  = $val;
                            $goods_color[$k]['des']  = $data['color_des'][$k];
                        }
                    }  
                }
            }else{
                foreach ($color_val as $k => $val) {
                    if(isset($color_val[$k])){
                        $goods_color[$k]['val']  = $val;
                        $goods_color[$k]['des']  = $data['color_des'][$k];
                    }
                }
            }
            $good_info = array();
            $good_info['goods_name'] = $data['goods_name'];
            $shop_cate_pid          = model('GoodsShopcate')->where('id',$data['cate_id'])->value('pid');
            if($shop_cate_pid != 0){
                $good_info['shop_cate1'] = $shop_cate_pid;
                $good_info['shop_cate2'] = $data['cate_id'];
            }else{
                $good_info['shop_cate1'] = $data['cate_id'];
                $good_info['shop_cate2'] = '';
            }
            $shop_id = model('shop')->where('user_id',session('user.user_id'))->value('shop_id');
            $good_info['goods_color_attr'] = serialize($goods_color);
            $good_info['cate_id1']       = $data['cate_id1'];
            $good_info['cate_id2']       = $data['cate_id2'];
            $good_info['cate_id3']       = $data['cate_id3'];
            $good_info['shop_price']     = $data['shop_price'];
            $good_info['inventory']      = $data['inventory'];
            $good_info['courier_fees']   = $data['courier_fees'];
            $good_info['recom_desc']     = $data['recom_desc'];
            $good_info['shop_id']        = $shop_id;
            $goods_add_re = model('Goods')->save($good_info);
            $add_goods_id = model('Goods')->goods_id;
            $add_attrs = array();
            if(isset($data['value'])){
                $goods_attrs = $data['value'];
                foreach ($goods_attrs as $key   => $value) {
                        $add_attrs[$key]['attr_id']  = $key;
                        $add_attrs[$key]['goods_id'] = $add_goods_id;
                        foreach ($value as $k => $v) {
                            if($v == ''){
                                unset($value[$k]);
                            }
                        }
                        $add_attrs[$key]['value']    = serialize(array_values($value));
                }
            }
            $goods_attrs = array_values($add_attrs);
            $add_goods_attr_re = model('GoodsGoodAttr')->saveAll($goods_attrs);
            if($goods_add_re){
                 Api()->setApi('msg','发布成功')->setApi('url',url('SellerCenter/s_good_mgr'))->ApiSuccess();
            }else{
                Api()->setApi('msg','发布失败')->setApi('url',0)->ApiError();
            }  
        }
    }

    /**
     * 编辑商品页面
     * @author  wanggang
     * @version 2017/07/4
     */
    public function edit_goods(){
        $goods_id  = input('goods_id');
        $goods_ids = model('Goods')->column('goods_id');
        $this->submit_edit_goods();
        if(in_array($goods_id,$goods_ids)){//商品id是否存在
            $good_info = $this->get_goods_info($goods_id);
            $attrs     = $this->get_goods_attrs($good_info);
            $shop_id   = model('shop')->where('user_id',session('user.user_id'))->value('shop_id');
            if($good_info['shop_cate2'] != ''){
                $shop_cate = $good_info['shop_cate2'];
            }else{
                $shop_cate = $good_info['shop_cate1'];
            }
            $this->assign('select',$this->getCateTree($shop_id,$shop_cate));
            return view(['good_info'=>$good_info,'attrs'=>$attrs,'goods_color_attr'=>$good_info['goods_color_attr']]);
        }else{//不存在跳往商品发布
            $step = 'release_good_'.input('step',1,'int');
            $this->$step();
            return view($step);
        }


    }
    /**
     * 查询商品信息
     * @author  wanggang
     * @version 2017/07/6
     */
    public function get_goods_info($goods_id){
        $good_info = model('goods')->where('goods_id',$goods_id)->find()->toArray();
        $good_info['goods_color_attr'] = unserialize($good_info['goods_color_attr']);
        return $good_info;
    }
    /**
     * @author  wanggang
     * @version 2017/07/6
     * 查询商品属性
     */
    public function get_goods_attrs($good_info){
        $attr_ids = model('GoodsCateAttr')->where(['cate_id'=>['in',[$good_info['cate_id1'],$good_info['cate_id1'],$good_info['cate_id1'],]]])->column('attr_id');
        $attrs = model('GoodsAttr')->where(['status'=>['<>',-1],'attr_id'=>['in',$attr_ids]])->order('sort', 'asc')->select();
        foreach ($attrs as $key => $value) {
            $attrs[$key]['value'] = unserialize($value['value']);
        }
        return $attrs;
    }
    /**
     * 提交编辑商品
     * @author  wanggang
     * @version 2017/07/6
     */
    public function submit_edit_goods(){
        if(request()->isAjax()){
            $data = input();
            $year      = date('Y/m',time());
            $color_val   = $data['color_val'];
            $goods_color = array();
            if(isset($data['uploadImg'])){
                $up_info   = UploadImg::upload("goods/$year")->getMsg();
                if(isset($up_info['info']['file1'])){
                    if ($up_info['info']['file1'][0]) {
                        $good_info['goods_thums']   = "/goods/".$year."/".$up_info['info']['file1'][0];
                    } else {
                        $good_info['goods_thums']   = "";
                    }
                    if(isset($up_info['info']['file1'][0])){
                        unset($up_info['info']['file1'][0]);
                    }
                    $good_imgss = $up_info['info']['file1'];
                    foreach ($good_imgss as $k => $v) {
                        $good_info['goods_img'.$k] = "/goods/".$year."/".$v;
                    }
                }
                foreach ($color_val as $k => $val) {
                    if(isset($color_val[$k]) && isset($up_info['info'][$k][0])){
                        $goods_color[$k]['val']  = $val;
                        $goods_color[$k]['des']  = $data['color_des'][$k];
                        $goods_color[$k]['img']  = "/goods/".$year."/".$up_info['info'][$k][0];
                    }else{
                        $goods_color[$k]['val']  = $val;
                        $goods_color[$k]['des']  = $data['color_des'][$k];
                    }
                }
            }else{
                foreach ($color_val as $k => $val) {
                    $goods_color[$k]['val']  = $val;
                    $goods_color[$k]['des']  = $data['color_des'][$k];
                }
            }
            $shop_id = model('shop')->where('user_id',session('user.user_id'))->value('shop_id');
            $good_info['goods_color_attr'] = serialize($goods_color);
            $good_info['shop_price']       = $data['shop_price'];
            $good_info['inventory']        = $data['inventory'];
            $good_info['courier_fees']     = $data['courier_fees'];
            $good_info['recom_desc']       = $data['recom_desc'];
            $goods_edit_re = model('Goods')->save($good_info,['goods_id'=>$data['goods_id']]);
            model('GoodsGoodAttr')->where('goods_id',$data['goods_id'])->delete();
            if(isset($data['value'])){
               $goods_attrs = $data['value'];
                $new_attrs = array();
                foreach ($goods_attrs as $key   => $value) {
                   $new_attrs[$key]['attr_id']  = $key;
                   $new_attrs[$key]['goods_id'] = $data['goods_id'];
                   foreach ($value as $k => $v) {
                       if($v == ''){unset($value[$k]);}
                   }
                   $new_attrs[$key]['value']    = serialize(array_values($value));
                }
                $goods_attrs = array_values($new_attrs);
                $edit_goods_attr_re = model('GoodsGoodAttr')->saveAll($goods_attrs); 
            }else{
                $edit_goods_attr_re = true;
            }
            if($goods_edit_re && $edit_goods_attr_re){
                 Api()->setApi('msg','修改成功')->setApi('url',url('SellerCenter/s_good_mgr'))->ApiSuccess();
            }else{
                Api()->setApi('msg','修改失败')->setApi('url',0)->ApiError();
            }  
        }
    }
    /**
     * ajax 获取分类
     * @author  wanggang
     * @version 2017/07/5
     */
    public function ajax_get_cate(){
        $cate_id = input('cate_id');
        $cates   = model('GoodsCate')->where('pid',$cate_id)->select();
        resultToArray($cates);
        echo json_encode($cates);
    }
    public function in_application(){
        if(request()->isAjax()){
            $data = input();
            if(isset($data['uploadImg'])){//判断是否有图片
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

                if($data['shop_id'] != false){//判断卖家修改资料
                //若上传新图 依次判断是否有上传  删除原图
                    $old_img = model('Shop')->where('shop_id','eq',$data['shop_id'])->field('shop_logo,idcard1,idcard2,idcard3')->find()->toArray();
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
                    if($old_img['idcard3']){
                        $img_url_idcard3 = "./upload".$old_img['idcard3'];
                        if (file_exists($img_url_idcard3) && in_array('idcard3',$shop_img)) {
                            unlink($img_url_idcard3);
                        }
                    }
                }
                
                $shop_img =array_values($shop_img);
                //处理上传图片数据 便于存数据库
                foreach ($shop_img as $key => $value) {
                    $data[$shop_img[$key]] = "/shop/".$year."/".$re[$key];
                }
            }    
            unset($data['uploadImg']);unset($data['box']);
            $data['user_id'] = session('user.user_id');
            $result = model('shop')->apply_seller($data);
            if ($result > 0) {
                Api()->setApi('url', url('seller_center/in_application'))->ApiSuccess();
            } else {
                Api()->setApi('msg', $result)->setApi('url', 0)->ApiError();
            }
        }else{
            $user_id = session('user.user_id');
            $shop = model('shop')->where('user_id ='.$user_id)->field('shop_id,is_check,check_des')->find();
            return view([
                'shop_seller' => $shop,
            ]);
        }
    }

    public function logistics(){
        $data = input();
        $data['status'] = input('status')?input('status'):['in',[4,5,6]];
        $nickname = getUserNickName();
        $status   = [4=>'待发货',5=>'已发货',6=>'已完成'];
        _pageconfig(4);
        $orderInfo = model('Order')->order_list($data);
        resultToArray($orderInfo);
        foreach ($orderInfo as &$v){
            $v['orders'] = model('order_info')->order_list($v['order_id']);
        }
        return view([
            'status'        =>$status,
            'nickname'      =>$nickname,
            'orderInfo'     =>$orderInfo,
        ]);
    }

    public function editor_addrs(){
        if(request()->isAjax()){
            $data = input();
            $addressInfo = model('Order')->field('order_id,province,city,area,address,user_phone')->where("user_id = {$_SESSION['shop']['user']['user_id']} and order_id = {$data['order_id']}")->order('update_time desc')->find();
            $addressInfo['citys'] = getCityNames($addressInfo);
            $addressInfo['user_name'] = session('user.account');

            return $addressInfo;
        }
    }

    public function deliver(){
        if(request()->isAjax()){
            $data = input();
            //处理储存数据
            if(input('citys')){
                $citys = getCityIdByNames(input('citys'));//添加
            }else{
                $citys = getCityIdByNames(input('city'));//编辑
            }
            unset($data['city']);
            $data['province'] = $citys[0];
            $data['city'] = $citys[1];
            $data['area'] = $citys[2];
            unset($data['citys']);//去除citys数据表中没有字段

            $rs = model('Order')->save($data,['order_id'=>$data['order_id']]);
            if($rs > 0){
                Api()->setApi('url',url('SellerCenter/deliver',['order_id'=>$data['order_id']]))->ApiSuccess();
            }else{
                Api()->setApi('msg','未修改任何地址信息')->setApi('url',0)->ApiError();
            }

        }else{
            $data = input();
            //物流方式
            $delivers = model('Shipping')->column('shipping_name','shipping_id');
            $data['status'] = 4;//查询条件-》待发货
            $orderInfo = model('Order')->order_list($data);
            resultToArray($orderInfo);
            foreach ($orderInfo as &$v){
                $v['orders'] = model('order_info')->order_list($v['order_id']);
            }
//            dump($orderInfo);
            return view([
                'orderInfo'     =>$orderInfo,
                'delivers'      =>$delivers,
            ]);
        }
    }

    //确认发货
    public function delivers(){
        if(request()->isAjax()){
            $data = input();
            if($data['switch'] == 1){
                unset($data['switch']);
            }else{
                unset($data);
                $data['order_id'] = input('order_id');
            }
            $data['status'] = 5;$data['update_time'] = time();
            $rs = model('Order')->save($data,['order_id'=>$data['order_id']]);
            if($rs > 0){
                Api()->setApi('url',url('SellerCenter/logistics'))->ApiSuccess();
            }else{
                Api()->setApi('msg','发货失败！')->setApi('url',0)->ApiError();
            }
        }
    }

    /**
     * 评价管理
     * @author wanggang
     * @version 2017/7/5
     */
    public function manage(){
        $user_id = session('user.user_id');
        $data = input();
        if(request()->isAjax()){
            $data = input();
            $data['user_id'] = $user_id;

            $rs = model('GoodsComment')->add_comment($data);
            return $rs;
        }else{
            //个人评价统计查询
            $now     = time();
            $week    = strtotime("-7 day");
            $month   = strtotime("-1 month");
            $month6  = strtotime("-6 month");
            //非常不满意
            $sql_1 ="select (select count(*) from ui_goods_comment where user_id = $user_id and create_time between $week and $now and score=1) as w,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month and $now and score=1) as m,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month6 and $now and score=1) as lm,(select count(*) from ui_goods_comment where user_id = $user_id and score=1) as z ;";
            $data1 =Db::query($sql_1);
            //不满意
            $sql_2 ="select (select count(*) from ui_goods_comment where user_id = $user_id and create_time between $week and $now and score=2) as w,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month and $now and score=2) as m,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month6 and $now and score=2) as lm,(select count(*) from ui_goods_comment where user_id = $user_id and score=2) as z ;";
            $data2 =Db::query($sql_2);
            //一般
            $sql_3 ="select (select count(*) from ui_goods_comment where user_id = $user_id and create_time between $week and $now and score=3) as w,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month and $now and score=3) as m,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month6 and $now and score=3) as lm,(select count(*) from ui_goods_comment where user_id = $user_id and score=3) as z ;";
            $data3 =Db::query($sql_3);
            //满意
            $sql_4 ="select (select count(*) from ui_goods_comment where user_id =  $user_id and create_time between $week and $now and score=4) as w,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month and $now and score=4) as m,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month6 and $now and score=4) as lm,(select count(*) from ui_goods_comment where user_id = $user_id and score=4) as z ;";
            $data4 =Db::query($sql_4);
            //非常满意
            $sql_5 ="select (select count(*) from ui_goods_comment where user_id = $user_id and create_time between $week and $now and score=5) as w,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month and $now and score=5) as m,(select count(*) from ui_goods_comment where user_id = $user_id and create_time between $month6 and $now and score=5) as lm,(select count(*) from ui_goods_comment where user_id = $user_id and score=5) as z ;";
            $data5 =Db::query($sql_5);
            //以上个人评价统计
            $id = input('id')?input('id'):0;

            if($id ==1){
                $where['score'] = ['in',[4,5]];
            }elseif ($id ==2){
                $where['score'] = 3;
            }elseif ($id ==3){
                $where['score'] = ['in',[1,2]];
            }
            $where['user_id'] = $user_id;
            $where['reply_id'] = 0;

            $data  = array();
            $data['id'] = $id;//传递查询参数id->好评，中评，差评
            //评价列表查询 按下单时间排序
            _pageconfig(1);
            $comments = model('GoodsComment')->select_comment($data,$where);
            foreach ($comments as &$v){
                $v['comment_new'] =  model('GoodsComment')->where("order_id = {$v['order_id']} and goods_id = {$v['goods_id']} and reply_id = {$v['comment_id']}")->value('comment');
            }
            return view([
                'data1'=>$data1[0],'data2'=>$data2[0],'data3'=>$data3[0],
                'data4'=>$data4[0],'data5'=>$data5[0],'comments'=>$comments,'id'=>$id,
            ]);
        }
    }

    public function s_order(){
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 1,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        $data = input();
        $shop_user_id    = session('user.user_id');
        $shop_id             = model('Shop')->where(['user_id'=>$shop_user_id])->field('shop_id')->find()->toArray();//店铺ID
        $order_id            = model('Order')->orders(['shop_id'=>$shop_id['shop_id'],'recycle'=>1]);//查用户所有订单号
        $goods               = model('OrderInfo')->shop_goods($order_id);//查订单详情
        $status              = model('OrderStatus')->where(['status'=>1])->order('order')->select();
        if(isset($data['user_id']) && !empty($data['user_id'])){
            $user  = model('User')->where(['account'=>$data['user_id']])->field('user_id')->find();//查买家ID
            if($user){
                $data['user_id']=$user['user_id'];
            }else{
                $data['user_id']=-1;
            }
        }
        if(isset($data['goods_id'])){
            if(!is_array($data['goods_id'])){
                $good_id = model('goods')->where(['goods_name'=>$data['goods_id'],'shop_id'=>
                    $shop_id['shop_id']])->field('goods_id')->find();
                $order_info = model('OrderInfo')->order_id($good_id['goods_id']);
                $data['goods_id'] = $order_info;
            }
        }
        if(isset($data['status'])){
            if($data['status']==0){
                $data['status'] = '';
            }
        }
        $data['shop_id'] = $shop_id ['shop_id'];
        $data['recycle'] = 1;
        $orders  =  model('Order')->order_list($data);//用户订单
        $page = $orders->render();//分页
        foreach ($orders as $k =>$v){
            $orders[$k]['url_info']       = url('seller_center/order_detail');//AJAX物流订单详情
            $orders[$k]['good_image']     = $this->var['upload'];
            $v['goods_info']              = $goods[$v['order_id']];
            $orders[$k]['page']           =$page;
        }
        if(request()->isAjax()){
           return json($orders);
        }
        return view([
            'orders' => $orders,
            'status' => $status,
        ]);

    }




    public function order_detail(){
        $data = input();
        $deliverInfo = model('Order')->where("order_id = {$data['order_id']}")->find();
        $deliverInfo['user_name'] = session('user.account');
        $deliverInfo['shop_name'] = model('shop')->where("shop_id = {$deliverInfo['shop_id']}")->value('shop_name');
        $deliverInfo['shipping_code'] = model('Shipping')->where("shipping_name = '{$deliverInfo['method']}'")->value('shipping_code');
        $deliverInfo['citys'] = str_replace('/',' ',getCityNames($deliverInfo));
        $deliverInfo["pay_price"]=sprintf("%.2f",($deliverInfo['deal_price']+$deliverInfo["despatch_money"]));//实付款保留两位小数

        $user_id = session('user.user_id');
        $addressInfo = model('UserAddress')->where("user_id = {$user_id}")->find();
        $addressInfo['citys'] = str_replace('/',' ',getCityName($addressInfo));

        $goodsInfo = model('OrderInfo')->where("order_id = {$data['order_id']}")->select();
        foreach ($goodsInfo as &$v){
            $v['recom_desc'] = model('Goods')->where("goods_id = {$v['goods_id']}")->value('recom_desc');
            $v['good_attr'] = unserialize($v['good_attr']);
            $v['status'] = model('Order')->status($v['status']);
        }
       // dump($deliverInfo);
        return view([
            'deliverInfo'   =>$deliverInfo,
            'goodsInfo'     =>$goodsInfo,
            'addressInfo'   =>$addressInfo,
        ]);
    }

    /**
     * 分类菜单设置
     * @author weichunfeng
     * @version 2017/7/4
     */
    public function s_nav(){
        if(request()->isAjax()){
            $data = input();
            if($data['pid']==0){
                $re = model('GoodsShopcate')->where("pid = 0")->count('pid');
                if($re>6){
                    return '最多可设置7个菜单！';
                }
            }else{
                $re = model('GoodsShopcate')->where("pid = {$data['pid']}")->count('pid');
                if($re>2){
                    return '最多可设置3个子菜单！';
                }
            }
            $data['shop_id'] = model('Shop')->where('user_id',$_SESSION['shop']['user']['user_id'])->value('shop_id');
            model('GoodsShopcate')->save($data);

        }else{
            $sellerCenter = model('GoodsShopcate')->select_nav();
            if($sellerCenter){
                $tree  = getTree($sellerCenter,['primary_key'=>'id'])->makeTreeForHtml();
            }else{
                $tree  = array();
            }
            return  view(['tree'=>$tree]);
        }
    }
    //删除分类菜单
    public function del_nav(){
        $data = input();
        model('GoodsShopcate')->del($data);
    }
    //编辑分类菜单名
    public function edit_nav(){
        $data = input();
        model('GoodsShopcate')->save($data,['id'=>$data['id']]);
    }

}