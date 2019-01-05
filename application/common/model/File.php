<?php
namespace app\common\model;
use think\Model;
/**
 * @param 文件上传类
 * Created by pengqiang.
 * Date: 2017/5/26 0026
 */
class File extends Model{
    /*
     * 上传文件
     * */
    public function upload($data){
      return  $re = $this->saveAll($data);
    }
}
