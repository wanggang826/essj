<?php
/**
 * Created by tiway
 * Date: 2017/9/22
 * Time: 9:05
 */

namespace app\common\controller;


use think\Session;

class MobileBase extends Base
{
    protected $user_id;
    public function _initialize(){

        parent::_initialize(); // TODO: Change the autogenerated stub

        Session::init([
            'prefix'         => 'user',
            'type'           => '',
            'auto_start'     => false,//先关闭session
        ]);
        if (input('sid')) {
            session_id(input('sid'));
        }
        session_start();
        $this->user_id = session('user_id');

        header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
        header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With');

    }
}