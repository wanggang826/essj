<?php
/**
 * Created by tiway
 * Date: 2017/10/19
 * Time: 13:42
 */

namespace app\mobile\controller;


use app\common\controller\MobileBase;
use vendor\sendAPI\sendAPI;

class SendSms extends MobileBase
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

    }

    /**
     * 发送短信验证码
     * @param  [string] $tel     手机号
     * @param  [type] $content   短信内容
     * @return [type]            发送状态
     */
    public function sendMessage($api = false){
        if(request()->isPost()){
            try{
                $mobile = input('mobile');
                if(!preg_match("/^1[34578]\d{9}$/", $mobile))
                    throw new Exception('请填写正确手机号码');
                if($api == false)
                    throw new Exception('非法入口');

               $code = rand(100000,999999);
                $sms = array(
                    'code'  => $code,
                    'mobile'=> $mobile
                );

                //为后期验证手机和验证码
                session('smscode',$sms);
               $content = '您的验证码为'.$code;
               $url 		= config('sms.url');//提交地址
               $username 	= config('sms.user_name');//用户名
               $password 	= config('sms.password');//原密码
               $sendAPI = new sendAPI($url, $username, $password);
               $data = array(
                   'content' 	=> $content.' 【手机商城】',//短信内容
                   'mobile' 	=> $mobile,//手机号码
                   'productid' => '676767',//产品id
                   'xh'		=> ''//小号
               );
               $sendAPI->data = $data;//初始化数据包
               $res = $sendAPI->sendSMS('POST');//GET or POST

               $result = explode(',',$res);

               if($result[0] == 1){
                   return json([
                       'code'  => 200,
                       'msg'   =>'发送成功',
                       'sid'   => session_id()
                   ]);
               }else{
                   throw new Exception('短信发送错误');
               }
                return json([
                        'code'  => 200,
                        'msg'   =>'发送成功',
                        'sid'   => session_id()
                    ]);

            }catch (\Exception $e){
                return json(apiFail($e->getMessage()));
            }
        }

    }
}