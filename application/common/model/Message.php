<?php
namespace app\common\model;
use think\Model;
/**
 * @param 消息类
 * Created by pengqiang.
 * Date: 2017/7/9 0026
 */
class Message extends Model{
    /**
     *消息列表
     */
    public  function  message_list($data){
        if(isset($data['receive_uid'])){
           $where['receive_uid'] = $data['receive_uid'];
        }
        if(isset($data['status'])){
            if(!empty($data['status'])){
                $where['status'] = $data['status'];
            }
        }

        if(isset($data['page'])){
            $page = $data['page'];
            unset($data['page']);
        }else{
            $page =1;
        }
        //dump($where);
        $list = $this->where($where)->order('status')->paginate('',false,['page'=>$page,'query' => $data]);
        resultToArray($list);
        //dump($list);die;
        return $list;
    }

    /*
     * 添加消息
     * */
    public function add_message($data){
      $message =   $this->validate('Message.add')->save($data);
      if($message === false){
          return $this->getError();
      }else{
          return $message;
      }
    }
}
