<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\model\Config;
use extend\Upload;

class Mallconfig extends AdminBase{

    public function defaults(){
        $this->redirect(url('Mallconfig/index'));
    }
    /**
     * 商城配置
     */
    public function index(){
        if(request()->isAjax()) {
            $data = input();
            if(isset($data['uploadImg'])){//判断是否有图片
                foreach ($data['uploadImg'] as $k=>$v){//取出上传图片的ID
                    $arr_mark[] = $k;
                }
            }
            if(isset($arr_mark)){//判断是否有新图片上传      
                $re  = Upload::uploadImg("config")->getInfo();
                $del =  model('Config')->where('config_mark','in',$arr_mark)->field(['config_value','id'])->select();//查出需要上传图片的id有没图片
                resultToArray($del);
                foreach($del as $k=>&$v){//删除图片并获取新图片数据
                    if($v['config_value'] != ''){
                        @unlink("./upload".$v['config_value']);
                    }
                    $arr['id']=$v['id'];
                    $arr['config_value']="/config/$re[$k]";
                    $data1[] = $arr;
                    unset($arr);
                }
            }
            foreach ($data as $key => &$val){//获取非图片数据
                if($key !=='uploadImg'){
                    if(is_array($val)){
                        $val     = serialize($val);
                    }else{
                        $one     = strrpos($val,"'");
                        $two     = strrpos($val,'"');
                        if($one !== false  || $two !== false){
                            Api()->setApi('msg',"$val 一栏不能有单/双引号!")->setApi('url',0)->ApiError();
                        }
                    }
                    $config_id   = intval($key);
                    $arr['id']   = $config_id;
                    $arr['config_value']=$val;
                    $arr['update_time']=time();
                    $data1[]    = $arr;
                    unset($arr);
                }
            }
            $set_mall= model('config')->set_mall($data1);
            if($set_mall>0){
                Api()->setApi('url',url('Mallconfig/index'))->ApiSuccess('设置成功!');
            }else{
                Api()->setApi('msg','设置失败或者是您没有任何修改!')->setApi('url',0)->ApiError();
            }
        }else{//打开页面展示的内容
            $configs = model('config')->order('sort')->select();
            resultToArray($configs);
            foreach($configs as &$v){
                if(!empty($v['type_value'])){//反序列化type_value
                    $v['type_value']= unserialize($v['type_value']);
                }
                if(!empty($v['config_value']) &&  $v['type'] =='checkbox'){//反序列化config_value
                   $v['config_value'] = unserialize($v['config_value']);
                }
                if(!empty($v['config_value']) &&  $v['type'] =='file'){//检测图片
                    $companyUrl ="./upload".$v['config_value'];//检测文件是否存在的路径
                    if (!file_exists($companyUrl)) {//检测文件
                        $v['config_value'] ='' ;//不存在就返回空，在去v层判断。
                    }
                }
            }
            return view([ 'configs'=>$configs ,'name'=>'mallconfig/base']);
        }
    }




}