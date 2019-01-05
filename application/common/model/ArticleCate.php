<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;

/*
 * @table   article_cate
 * @Auth weichunfeng
 * @version 2017.05.24
 * */


class ArticleCate extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
//    protected $auto = ['status'=>1];//自动完成

    public function select_articleCate($data){
        $list = $this->order('create_time desc')->paginate('',false,['query' => $data]);
        resultToArray($list);
        return $list;
    }

    public function add_articleCate($data){
        $result = $this->validate('articleCates.add')->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    public function edit_articleCate($data){
        $result = $this->validate('articleCates.edit')->save($data,['cate_id'=>$data['cate_id']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
}
