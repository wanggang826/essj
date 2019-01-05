<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\ArticleCate;

/*
 * @table   article_cate
 * @Auth weichunfeng
 * @version 2017.05.24
 * */

class ArticleCates extends AdminBase
{
    /*
     * 文章分类列表
     */
    public function index(){
        $lists = $this->cate_index();
        foreach ($lists as &$v){
            $v['pname'] = model('articleCate')->where("cate_id = {$v['pid']}")->value('cate_name');
            if($v['cate_type'] == 0){
                $v['cate_type'] = "系统";
            }elseif ($v['cate_type'] == 1){
                $v['cate_type'] = "普通";
            }
            $v['create_time'] = date('Y-m-d H:i;s',$v['create_time']);
        }
        return view([
            'lists'=>$lists,
        ]);
    }

    /**
     * 类别列表
     */
    public function cate_index(){
        $cates = model('ArticleCate')->select();
        resultToArray($cates);
        $tree  = getTree($cates,['primary_key'=>'cate_id'],'2')->makeTreeForHtml();
        return $tree;
    }
    /**
     * ajax——单字段修改
     */
    public function edit_field(){
        $cate_id =input('cate_id','','trim');
        $cate_name = input('value');
        $data = [
            'cate_id'   =>$cate_id,
            'cate_name'     =>$cate_name,
        ];
        $re = model('ArticleCate')->save($data,['cate_id'=>$cate_id]);
        echo json_encode($re);
    }

    /*
     * 添加文章分类
     */
    public function articleCate_add(){
        //获取分类信息
        $typeInfo = model('ArticleCate')->where("pid = 0")->select();
        resultToArray($typeInfo);
        if(request()->isAjax()){
            $input = input();
            $input['create_time'] = time();
            //限制只能添加二级分类
            $id = input('request.pid');
            if($id == 0){
                $input['level'] = 1;
            }
            $data = model('articleCate')->add_articleCate($input);
            if($data > 0){
                Api()->setApi('url',url('ArticleCates/index'))->ApiSuccess();
            }else{
                Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
            }
        }
        $cate_id = input('cate_id')?input('cate_id'):1;
        $articleCate_info = ArticleCate::get($cate_id)->toArray();
        return view([
            'articleCates' => $typeInfo,
            'articleCate_info'=>$articleCate_info,
        ]);
    }

    /*
     * 修改文章分类
     */
    public function articleCate_edit(){
        $typeInfo = model('ArticleCate')->where("pid = 0")->select();
        resultToArray($typeInfo);
        if(request() -> isAjax()){
            $input = input();
            unset($input['page']);
            $data = model('articleCate')->edit_articleCate($input);
            if($data > 0){
                Api()->setApi('url',url('ArticleCates/index',['page'=>input('page')]))->ApiSuccess();
            }else{
                Api()->setApi('msg',$data)->setApi('url',0)->ApiError();
            }
        }
        $cate_id = input('cate_id');
        $articleCate_info = ArticleCate::get($cate_id)->toArray();
        return view([
            'articleCate_info'=>$articleCate_info,
            'articleCates' => $typeInfo,
        ]);
    }

    /*
     * 删除文章分类
     */
    public function articleCate_del(){
        if(request()->isAjax()){
            $time = time();
            $data = input();
            $obj =$this->setStatus('articleCate',$time,$data['id'],'cate_id','delete_time');
            if(1 == $obj->code){
                Api()->setApi('url',input('location'))->ApiSuccess();
            }else{
                Api()->setApi('url',0)->ApiError();
            }
        }
    }

    /*
	 * 文章分类状态修改
	 */
    public function articleCate_status(){
        $status = input('status');
        $url = input('location',url('ArticleCates/index'));
        $id = input('cate_id');
        $re = $this->setStatus('articleCate',$status,$id,'cate_id');
        if($re->code == 1){
            Api()->setApi('url',$url)->ApiSuccess($re);
        }else{
            Api()->setApi('url',0)->ApiError();
        }
    }

}