<?php
namespace app\shop\controller;
use app\common\controller\ShopApp;
use tests\thinkphp\library\think\cache\driver\memcachedTest;
use think\Session;
use think\Db;
use think\captcha\Captcha;
use extend\Upload;
use extend\UploadImg;
use extend\Encrypt;
header("Content-type: text/html; charset=utf-8");
/**
 * 商城基础类
 */
class UserCenter extends ShopApp
{
    public function index(){
        $this->redirect(url('UserCenter/u_order'));
    }

    /**
     * 订单中心
     */
    public function u_order(){
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 1,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        $data['user_id']  = session('user.user_id');
        $recycle          = model('order')->recycle(['recycle'=>1,'user_id'=>$data['user_id']]);//不同状态的订单量
        $order_list       = $this->order_list();//订单列表
        if(request()->isAjax()){
            return  json($order_list);
        }
        return view([
            'orders'  => $order_list,
            'id'=>input('id')?input('id'):0,
            'recycle' => $recycle,
        ]);
    }
    public function order_list(){
        $data = input();
        $data['user_id']     = session('user.user_id');
        $order_id            = model('Order')->orders(['user_id'=>$data['user_id'],'recycle'=>1]);//查用户所有订单号
        $goods               = model('OrderInfo')->shop_goods($order_id);//查订单详情
        if(isset($data['status'])){
            if($data['status']==0){
                $where['status'] = '';
                $where['id'] = 0;
            }else{
                $where['status'] = $data['status'];
                $where['id'] = $data['id'];
            }
        }
        if(isset($data['page'])){//显示第几页
            $where['page']= $data['page'];
        }
        $where['user_id'] = $data['user_id'];
        $where['recycle'] = 1;
        $orders  =  model('Order')->order_list($where);//用户订单
        $page = $orders->render();//分页
        foreach ($orders as $k =>&$v){
            $orders[$k]['url_info']       = url('UserCenter/u_order_detail');//AJAX订单详情路径
            $orders[$k]['url_money']      = url('Order/index');//AJAX订单付款路径
            $orders[$k]['url_evaluate']   = url('UserCenter/to_evaluate');//AJAX评价路径
            $orders[$k]['good_image']     = $this->var['upload'];
            $v['goods_info']              = $goods[$v['order_id']];
            $orders[$k]['page']           = $page;
        }
        return $orders;
    }

    /**
     * 收货地址
     */
    public function u_address(){
        if(request()->isAjax()){
            $data = input();
            dump($data);
            checkForm($data);//验证表单
            //处理储存数据
            if(input('citys')){
                $citys = getCityIdByNames(input('citys'));
            }else{
                $citys = getCityIdByNames(input('city'));
            }
            $data['area_id1'] = $citys[0];
            $data['area_id2'] = $citys[1];
            $data['area_id3'] = $citys[2];
            unset($data['citys']);unset($data['city']);//去除citys数据表中没有字段
            if(empty($data['address_id'])){ //处理保存还是添加数据
                $data['user_id'] = $_SESSION['shop']['user']['user_id'];
                //限制储存记录数不大于20条
                $res = model('UserAddress')->count('address_id');
                if($res>19){
                    Api()->setApi('msg','保存地址不能超过20条')->setApi('url',0)->ApiError();
                }


                $re = model('UserAddress')->add_address($data);
                if($re){
                    Api()->setApi('url',url('user_center/u_address'))->ApiSuccess();
                }else{
                    Api()->setApi('msg','未提交任何收货地址信息')->setApi('url',0)->ApiError();
                }
            }else{
                $re = model('UserAddress')->edit_address($data);
                if($re){
                    Api()->setApi('url',url('user_center/u_address'))->ApiSuccess();
                }else{
                    Api()->setApi('msg','未修改任何收货地址信息')->setApi('url',0)->ApiError();
                }
            }
        }else{
            $addressInfo = model('UserAddress')->where("user_id = {$_SESSION['shop']['user']['user_id']}")->order('is_default desc')->select();
            foreach ($addressInfo as &$v){
                $v['citys'] = getCityName($v);
            }
            $count = count($addressInfo);
            $remaind_count = 20-$count;
            return view([
                'addressInfo'   =>$addressInfo,
                'count'          =>$count,
                'remaind_count' =>$remaind_count,
            ]);
        }
    }

    /*
     * 删除收货地址
     */
    public function del_addr(){
        $id = input('address_id');
        model('UserAddress')->where("address_id = {$id}")->setField('delete_time',time());
    }

    /*
    * 设置默认收货地址
    */
    public function set_addrDefault(){
        $id = input('address_id');
        $user_id = $_SESSION['shop']['user']['user_id'];
        model('UserAddress')->where("user_id = {$user_id}")->setField('is_default',0);
        model('UserAddress')->where("address_id = {$id} and user_id = {$user_id}")->setField('is_default',1);
    }

    /*
     * 编辑收货地址
     */
    public function edit_addr(){
        if(request()->isAjax()){
            $id = input('address_id');
            $user_id = $_SESSION['shop']['user']['user_id'];
            $addrInfo = model('UserAddress')->field("create_time,update_time,user_id,is_default",true)->where("address_id = {$id} and user_id = {$user_id}")->find();

            $addrInfo['citys'] = str_replace(' ','/',getCityName($addrInfo));

            return $addrInfo;
        }
    }

    /**
     *消息中心
     * @author pengqiang
     * @version 2017/7/9
     */
    public function u_message(){
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 1,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        $user_id = session('user.user_id');
        $data = input();
        if(isset($data['message_type'])){
            if($data['message_type'] ==='message'){
                $where['receive_uid'] = $user_id;
                $where['page']        = $data['page'] ;
                $where['status']      = $data['message_status'];
                $shop['messages']     = model('Message')->message_list($where);
            }elseif($data['message_type'] ==='article'){
                $where['page']        = $data['page'] ;
                $where['cate_id']     = $data['message_status'];
                $shop['article']      = model('article')->select_article($where);
            }
        }else{
            $unread_num        = model('Message')->where(['receive_uid'=>$user_id,'status'=>0])->select();//未读消息
            $shop['unread_num'] = count($unread_num);
            $shop['messages']         = model('Message')->message_list(['receive_uid'=>$user_id]);
            $shop['article']          = model('article')->select_article(['cate_id'=>120] );
        }
        if(request()->isAjax()){
            if(isset($shop['messages'])){
                foreach ($shop['messages'] as $k =>&$v){
                    $v['message_url'] =url('Index/article_detail');
                }
                return json($shop['messages']);
            }elseif (isset($shop['article'])){
                foreach ($shop['article'] as $key =>&$val){
                    $val['article_url'] =url('Index/article_detail');
                }
                return json($shop['article']);
            }
        }
        return view([
            'shop'=>$shop,
            ]);
    }

    /**
     *个人信息
     * @author wanggang
     * @version 2017/6/24
     */
    public function u_info(){
        $user_info = session('user');
        if(request()->isAjax()){
            $data = input();
            if(isset($data['uploadImg'])){//判断是否修改头像
                $year = date('Y/m',time());
                //上传图片 返回图片名称 数组
                $re = UploadImg::upload("user/$year")->getMsg();
                $data['photo'] = "/user/".$year."/".$re['info']['photo'][0];
                unset($data['uploadImg']);
            }
            $re   = model('User')->save($data,['user_id'=>$data['user_id']]);
            if($re){
                Api()->setApi('url',url('user_center/u_info'))->ApiSuccess();
            }else{
                Api()->setApi('msg','未提交任何评论信息')->setApi('url',0)->ApiError();
            }
        }
        return view(['user_info'=>$user_info]);
    }
    /**
     * 修改手机
     */
    public function u_phone(){
        return view();
    }

    /**
     * 验证码修改邮箱
     * @author wanggang
     * @version 2017/6/29
     */
    public function u_email(){
        if(request()->isAjax()){
            $tomail      = trim(input('tomail'),' ');
            $code        = trim(input('code'),' ');
            $valid_time  = model('config')->where(['config_mark'=>'EMAIL_CODE_TIME'])->value('config_value');
            $code_info   = model('EmailCode')->where(['user_id'=>session('user.user_id')])->find();
            if($code_info){
                $code_info = $code_info->toArray();
                $end_time      = strtotime($code_info['create_time']) + $valid_time;
                if(time() > $end_time || $code != $code_info['code_content']){
                    Api()->setApi('msg','验证码有误')->setApi('url',0)->ApiError();
                }else{
                    $data ['email'] = $tomail;
                    if(model('user')->save($data,['user_id'=>session('user.user_id')])){
                         Api()->setApi('msg','修改成功')->setApi('url',url('user_center/u_info'))->ApiSuccess();
                    }else{
                        Api()->setApi('msg','修改失败请重试')->setApi('url',0)->ApiError();
                    }          
                }
            }
        }
        return view();
    }
    /**
     * 生成邮箱验证码发送并存数据库
     * @author wanggang
     * @version 2017/6/28
     */
    public function send_code(){
        $tomail      = input('toemail');
        $action      = input('action');
        $action_name = input('action_name');
        $user_id     = session('user.user_id');
        $code        = make_code(6);
        $valid_time  = model('config')->where(['config_mark'=>'EMAIL_CODE_TIME'])->value('config_value');
        $code_info   =[
            'user_id'=>$user_id,'code_content'=>$code,'send_time'=>time(),
            'sendto_email'=>$tomail,'valid_time'=>$valid_time,'action'=>$action,'action_name'=>$action_name,
        ];
        //查找数据库中是否已有该用户的验证码，是否过期
        $data = model('EmailCode')->where(['user_id'=>$user_id])->find();
        if($data){
            $data = $data->toArray();
            $end_time = strtotime($data['create_time']) + $valid_time;
            if(time()> $end_time){
                model('EmailCode')->where(['user_id'=>$user_id])->delete();
                model('EmailCode')->save($code_info);
            }else{
                $code = $data['code_content'];
            }
        }
        $body_info = ['action'=> $action,'action_name'=>$action_name,'code'=>$code];
        $send_info = controller('SendEmail')->send_mail($tomail,$tomail,'邮箱验证码',$body_info);
        echo json_encode($send_info);
    }
    /**
     * 发送给用户邮箱的链接方法
     * @author wanggang
     * @version 2017/6/28
     */
    public function check_code(){
        $user_id = input('user_id'); //解密;
        $action  = model('EmailCode')->where(['user_id' =>$user_id])->value('action');
        $url     = config('STATIC_URL').url("UserCenter/{$action}",['user_id'=>$user_id]);
        $this->redirect($url);
    }
    /**
     * 链接修改邮箱
     * @author wanggang
     * @version 2017/6/28
     */
    public function update_email(){
        $user_id     = Encrypt::authcode(input('user_id'),'DECODE');

        $update_info = model('EmailCode')->where(['user_id'=>$user_id])->find();
        if($update_info){
            $update_info   = $update_info->toArray();
            $end_time = strtotime($update_info['create_time']) + $update_info['valid_time'];
            if(time() > $end_time){
                Api()->setApi('msg','操作过期')->setApi('url',url('user_center/u_info'))->ApiError();
            }else{
                $data['email'] = $update_info['sendto_email'];
                $re = model('user')->save($data,['user_id'=>$user_id]);
                if($re){
                    Api()->setApi('msg','邮箱修改成功')->setApi('url',url('user_center/u_info'))->ApiSuccess();
                }else{
                    Api()->setApi('msg','操作有误')->setApi('url',url('user_center/u_info'))->ApiError();
                }
            }
        }else{
            Api()->setApi('msg','操作有误')->setApi('url',url('user_center/u_info'))->ApiError();
        }
    }


     /**
     *
     */
    public function u_changepass(){
        if(request()->isAjax()){
            $pwd = I('password','','trim');
            $password_new_1 = I('password_new_1','','trim');
            $password_new_2 = I('password_new_2','','trim');
            //验证是否为空
            if($pwd == ''){
                Api()->setApi('msg','请输入原密码')->setApi('url',0)->ApiError();
            }if($password_new_1 ==''){
                Api()->setApi('msg','请输入新密码')->setApi('url',0)->ApiError();
            }elseif($password_new_2 ==''){
                Api()->setApi('msg','确认密码不能为空')->setApi('url',0)->ApiError();
            }

            $password        = Encrypt::authcode(session('user.password'),'DECODE');
            if($pwd != $password){
                Api()->setApi('msg','原密码输入不正确')->setApi('url',0)->ApiError();
            }
            if($password_new_1 != $password_new_2){
                Api()->setApi('msg','两次密码不一致')->setApi('url',0)->ApiError();
            }
            //修改新密码
            $password_new_1        = Encrypt::authcode($password_new_1,'ENCODE');
            $data = [
                'password'      =>$password_new_1,
                'update_time'   =>time(),
            ];
            $re = model('User')->edit_pwd(session('user.user_id'),$data);
            if ($re > 0) {
                Api()->setApi('msg', "密码修改成功！")->setApi('url', url('user_center/login'))->ApiSuccess();
                $this->is_login();//TODO 检测登录状态还是销毁session强制下线？
            } else {
                Api()->setApi('msg', $re)->setApi('url', 0)->ApiError();
            }
        }else{
            return view();
        }
    }

    public function u_safe(){
        // TODO
        return view();
    }
    /**
     * 账户绑定
     */
    public function u_binding(){
        // TODO
        return view();
    }
    /**
     * 订单回收站
     */
    public function order_recycle(){
        $data = input();
        $data['user_id']    = session('user.user_id');
        $recycle            = model('order')->recycle(['recycle'=>0,'user_id'=>$data['user_id']]);//不同状态的订单量
        $order_id           = model('Order')->orders(['user_id'=>$data['user_id'],'recycle'=>0]);//查用户所有订单号
        $goods              = model('OrderInfo')->shop_goods($order_id);//查订单详情
        if(isset($data['status'])){
            if($data['status']==0){
                $where['status'] = '';

            }else{
                $where['status'] = $data['status'];
                $where['id'] = $data['id'];
            }
        }
        if(isset($data['page'])){//显示第几页
            $where['page']= $data['page'];
        }
        $where['user_id'] = $data['user_id'];
        $where['recycle'] = 0;
        $orders  =  model('Order')->order_list($where);//用户订单
        $page = $orders->render();//分页
        foreach ($orders as $k =>&$v){
            $orders[$k]['good_image'] =$this->var['upload'];
            $v['goods_info'] = $goods[$v['order_id']];
            $orders[$k]['page']=$page;
        }
        if(request()->isAjax()){
            return  json($orders);
        }

        return view([
            'orders'  => $orders,
            'id'      => input('id'),
            'recycle' => $recycle,
        ]);

    }

    /**
     * 订单详情
     */
    public function u_order_detail(){
        $order_sn        = input('order_sn');
        $order_id        = input('order_id');
        $order           = model('Order')->oder_info($order_sn);//订单信息
        $order_info      = model('OrderInfo')->order_list($order_id);//订单商品信息
        return view([
            'order_info' => $order,
            'goods' => $order_info,
        ]);
    }
    /**
     * 收藏
     */
    public function u_collection(){
        if(request()->isAjax()){
            $data['type'] = input('type');
            $data['user_id'] = session('user.user_id');
            $collection = model('Collection')->ajax_collection($data);
            if(isset($collection)){
                if($data['type'] == 'goods'){
                    foreach ($collection as &$v) {//获取商品评价数量
                        $v['goods']['comment'] = model('GoodsComment')->where('goods_id ='.$v['goods']['goods_id'])->count();
                        $v['goods']['goods_thums'] = getImg($v['goods']['goods_thums']);
                    }
                }
                if($data['type'] == 'shop'){
                    foreach ($collection as &$v) {//获取店铺热门商品
                        $v['shop']['goods_is_hot'] = model('shop')->select_goods_is_hot($v['shop']['shop_id']);
                        $v['shop']['shop_logo'] = getImg($v['shop']['shop_logo']);
                    }
                }
            }
            $collection[0]['page'] = $collection->render();
            return $collection;   
        }else{
            config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 8,'var_page'  => 'page',]]);
            Session::set('pageSize', config('paginate.list_rows'));
            $user_id['user_id'] = session('user.user_id');
            $collection = model('Collection')->select_user($user_id);
            if(isset($collection)){
                foreach ($collection as &$v) {//获取商品评价数量
                    if($v['goods']){
                        $v['goods']['comment'] = model('GoodsComment')->where('goods_id ='.$v['goods']['goods_id'])->count();
                    }
                }
            }
            $count['shop_count'] = model('Collection')->where('user_id = '.$user_id['user_id']." AND collection_type = 'shop'")->count();
            $count['goods_count'] = model('Collection')->where('user_id = '.$user_id['user_id']." AND collection_type = 'goods'")->count();
        
            return view([
                'collection'=>$collection,
                'count'=>$count,
            ]);
        }

        
    }
    /**
     * 评价订单
     * @author wanggang
     * @version 2017/6/24
     */
    public function to_evaluate(){
        //订单相关信息
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 3,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
         $order_sn = input('order_sn');
         // dump($order_sn);
       // $order_sn   = 'B314981280354824062';
        $order      = model('Order')->where(['order_sn'=>$order_sn])->find();
        if($order){
            $order = $order->toArray();
        }
        $order_info = model('OrderInfo')->where('order_id', $order['order_id'])->select();
        $user_id    = session('user.user_id');
        resultToArray($order_info);
        //提交评价
        if(request()->isAjax()){
            $data   = input();
            $inData = array();
            if(isset($data['uploadImg'])){
                $year = date('Y/m',time());
                //上传图片 返回图片名称 数组
                $re   = UploadImg::upload("shop/$year")->getMsg();
                // 处理数据 方便存储
                foreach ($data['goods_id'] as $key => $value) {
                    $inData[$key]['goods_id']     = $data['goods_id'][$key];
                    $inData[$key]['user_id']      = $data['user_id'];
                    $inData[$key]['order_id']     = $data['order_id'];
                    $inData[$key]['shop_id']      = $data['shop_id'];
                    $inData[$key]['score']        = $data['score'][$key];
                    $inData[$key]['comment']      = $data['comment'][$key];
                    $inData[$key]['is_anonymous'] = $data['is_anonymous'];
                    if(array_key_exists($key,$re['info']) && count($re['info'])>0){
                       foreach ($re['info'][$key] as $k => $v) {
                            $inData[$key]['com_img'.($k+1)] = "/shop/".$year."/".$v;
                        } 
                    }   
                }
            }
            if(count($inData) != 0){
                $inData = array_values($inData);
                $result = model('GoodsComment')->saveAll($inData);
                if(count($result) > 0){
                    Api()->setApi('url',url('user_center/evaluate'))->ApiSuccess();
                }
            }else{
                Api()->setApi('msg','未提交任何评论信息')->setApi('url',0)->ApiError();
            }
        }
        return view(['order_info'=>$order_info,'order'=>$order,'user_id'=>$user_id]);
    }
    /**
     * 评价管理
     * @author wanggang
     * @version 2017/6/23
     */
    public function evaluate(){
        $user_id = session('user.user_id');
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 3,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
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
        $data  = array();
        $where['user_id'] = $user_id;
        $where['reply_id'] = 0;
        //评价列表查询 按下单时间排序
        $comments = model('GoodsComment')->select_comment($data,$where);
        foreach ($comments as &$v){
            $v['comment_reply'] =  model('GoodsComment')->where("order_id = {$v['order_id']} and goods_id = {$v['goods_id']} and reply_id = {$v['comment_id']}")->value('comment');
        }
        return view([
            'data1'=>$data1[0],'data2'=>$data2[0],'data3'=>$data3[0],
            'data4'=>$data4[0],'data5'=>$data5[0],'comments'=>$comments,
            ]);
    }

    /*
     * 用户登录
     * */
    public function login(){
    if(request()->isAjax()){
        $data['username'] = I('username','','trim');
        $data['password'] = I('password','','trim');
        $data['entry']    = I('entry','','trim');
        /* 检测验证码 */
        $Verify = new \think\captcha\Captcha();
        $bool = $Verify->check($data['entry'] );
        if($bool){
            $pass     = model('User')->where(['account'=>$data['username']])->field('user_id,password')->find()->toArray();
            $password =  Encrypt::authcode($pass['password'],'DECODE');
            $new_data = array(
                'last_login_time'       => time(),
                'last_login_ip'         => get_client_ip(),
            );
            if($password==$data['password']){
                $re =  model('User')->save($new_data,['user_id'=>$pass['user_id']]);
                if($re){
                    $user = model('User')->where(['account'=>$data['username']])->find()->toArray();
                    session::set('user',$user);//保存session
                    $username = $data['username'];//页面显示
                    Api()->setApi('msg',"登录成功！")->setApi('url',url('Index/index'))->ApiSuccess();
                }
            }else{
                Api()->setApi('msg', "账号或密码有误！")->setApi('url', 0)->ApiError();
            }
        }else{
            Api()->setApi('msg', "验证码有误！")->setApi('url', 0)->ApiError();
        }
    }
        return view([
            'load_search'=>false,
            'bottom_nav'=>false,
        ]);
    }
    /**
     * 用户注册
     */
    public function reg(){
        if(request()->isAjax()){
            $data['account']  = I('username','','trim');
            $data['password'] = I('password','','trim');
            $data['phone']    = I('phone','','trim');
            $data['entry']    = I('entry','','trim');
            /* 检测验证码 */
            $Verify = new \think\captcha\Captcha();
            $bool = $Verify->check($data['entry'] );
            if($bool) {
                unset($data['entry']);
                $data['password']        = Encrypt::authcode($data['password'],'ENCODE');
                $data['last_login_ip']   = get_client_ip();
                $data['last_login_time'] = time();
                $re = model('User')->reg($data);
                if ($re > 0) {
                    Api()->setApi('msg', "注册成功！")->setApi('url', url('Index/index'))->ApiSuccess();
                } else {
                    Api()->setApi('msg', $re)->setApi('url', 0)->ApiError();
                }
            }else{
                Api()->setApi('msg', "验证码有误！")->setApi('url', 0)->ApiError();
            }
        }
        return view(['load_search'=>false,'bottom_nav'=>false]);
    }
    /**
	 * 验证码，用于登录和注册
	 */
   public function verify(){
       $config =    array(
           'fontSize'  =>  26,    // 验证码字体大小
           'useCurve'  => true,  // 是否画混淆曲线
           'imageH'    => 50,    // 验证码图片高度
           'imageW'    => 190,   // 验证码图片宽度
           'length'    => 4,     // 验证码位数
           'useNoise'  => false, // 关闭验证码杂点
       );
       $captcha = new \think\captcha\Captcha($config);
       return $captcha->entry();
   }
   /**
    * 验证验证码
    */
   protected function check_entry(){
       $data['entry'] = I('entry','','trim');
       $Verify = new \think\captcha\Captcha();
       return $bool = $Verify->check($data['entry'] );

   }


}