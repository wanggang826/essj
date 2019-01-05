<?php
namespace app\common\controller;
use extend\Auths;
use think\Cookie;
use think\Session;
use think\Url;
/**
 * Shop模块基础类
 * by chick 2017-06-08
 */
class ShopApp extends Base{
    protected $allowed = [
        'shop'=>[
            'index.*',
        ],
    ];
    public function __construct(){
        $this->theme = config('web_theme')?:(config('template.view_theme')?:'default');
        config(['paginate'=>['type'      => 'bootstrap1','list_rows' => 3,'var_page'  => 'page',]]);
        Session::set('pageSize', config('paginate.list_rows'));
        config('template.view_theme',$this->theme);
        config('template.layout_name',$this->theme.'/'.config('template.layout_name'));
        parent::__construct();
    }

    public function _initialize(){
        parent::_initialize();
        $this->is_close();
        $this->set_shop_var();
        $this->getFriendLink();
        $this->get_shop_adv();
        $this->getWebInfo();
        session('isLogin',1);
        $user= array(
            "user_id" =>1,
            "account" => "admin",
            "realname" =>"王总",
            "money" => NULL,
            "nickname" => "总管",
            "photo" =>"user/1496888873.jpg",
            "password" => "cda6V4BovYb49ecoBCnSSlIFaTXrWgV3VAmumxFlG5GY1pM",
            "phone" => "13912345678",
            "email" => "admin@163.COM",
            "sex" => 1,
            "province" => NULL,
            "city" => NULL,
            "area" => NULL,
            "user_group" =>1,
            "status" =>0,
            "reg_ip" => NULL,
            "reg_time" => NULL,
            "last_login_ip" => "127.0.0.1",
            "last_login_time" =>1498187303,
            "delete_time" => NULL,
            "create_time" => "2017-05-10 10:52:26",
            "update_time" => "2017-06-23 11:08:23",
            "headimg" => NULL
        );
        session('user',$user);
    }

    protected function is_close(){
        if(config('web_status') == 0){
            $this->error('站点已关闭',0);
        }
    }

    protected function set_shop_var(){
        $this->shop_var['public']       = WEB_PUBLIC;
        $this->shop_var['static']       = WEB_PUBLIC .'/theme/'.MODULE_NAME.'/'.$this->theme.'/static/';
        $this->shop_var['img']          = $this->shop_var['static'].'/img/';
        $this->shop_var['css']          = $this->shop_var['static'].'/css/';
        $this->shop_var['js']           = $this->shop_var['static'].'/js/';
        $this->assign($this->shop_var);
    }

    /*
    * 友情链接
    * by weichunfeng 2017/6/19
    * */
    protected function getFriendLink(){
        $links = model('articleCate')->field('cate_id,cate_name')->where("status = 1 and pid = 1")->order("cate_id asc")->limit(6)->select();
        foreach ($links as &$v){
            $v['name'] = model('article')->field('article_title,href')->where("cate_id = {$v['cate_id']}")->limit(5)->select();
        }
        $this->assign('links',$links);
    }
    //获取备案信息
    protected function getWebInfo(){
        $cateId = model('articleCate')->where("cate_name = '网站备案'")->value('cate_id');
        $webInfo = model('article')->where("cate_id = {$cateId}")->value('article_content');
        $this->assign('webInfo',$webInfo);
    }

    /*
    * 广告展示
    * by gucangfa 2017/6/20
    */
    protected function get_shop_adv(){
        $adv = controller('Shop/AdvPos');//调用广告控制器
        $adv = $adv->adv_all();
        $this->assign('adv',$adv);
    }

    /**
     * 判断前台是否登陆
     */
    
   
}