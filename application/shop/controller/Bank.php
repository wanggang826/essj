<?php
namespace app\shop\controller;
use app\common\controller\ShopApp;
use think\Session;
/**
 * Created by pengqiang.
 * Date: 2017/7/12 0012
 * Time: 上午 9:43
 */
class Bank extends ShopApp{
    /**
     * 添加银行卡
     */
    public function add_bank(){
        $data            = input();
        $data['user_id'] = session('user.user_id');
        $bank            = model('bank')->addBank($data);
        if(request()->isAjax()){
            return json($bank);
        }
    }


}