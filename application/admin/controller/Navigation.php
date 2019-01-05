<?php
namespace  app\admin\controller;
use app\common\controller\AdminBase;
/**
 * 导航类
 * Created by pengqiang
 * Date: 2017/5/27 0027
 */
class Navigation extends AdminBase{
    /*
     * 导航管理_列表
     * */
    public  function  nav_index(){
        $nav    = model('Nav')->select_nav();
        return  view(['nav'=>$nav]);

    }
    /*
     * 添加导航
     * */
    public  function nav_add(){
        if(request()->isAjax()){
            $data          = input();
            $data['pid']   = 0;
            $re            = model('Nav')->nav_add($data)  ;
            if($re>0){
                Api()->setApi('url',url('Navigation/nav_index'))->ApiSuccess($re);
            }else{
                Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
            }
        }
        return  view();
    }
    /*
     * 修改导航
     **/
    public  function nav_edit(){
        if(request()->isAjax()){
            $data     = input();
            $edit     = model('Nav')->edit($data);
            if($edit>0){
                Api()->setApi('url',url('Navigation/nav_index'))->ApiSuccess($edit);
            }else{
                Api()->setApi('msg',$edit)->setApi('url',0)->ApiError();
            }
        }else{
            $pid      = input('pid',0);
            $id       = input('id');
            $tree     = $this->getNavTree($pid);
            $info     = model('Nav')->where(['id'=>$id])->find();
            $nao_info = $info ->toArray($info);
        }
        return  view(['nao_info'=>$nao_info ,'tree'=>$tree]);
    }
    /*
     * 删除导航信息
     **/
    public  function nav_del(){
        $data    = input();
        $re      = model('Nav')->del($data);
        if($re>0){
            Api()->setApi('url',url('Navigation/nav_index'))->ApiSuccess($re);
        }else{
            Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
        }
    }

    /*
     * 切换导航状态
     * */
    public  function  nav_status(){
        $data    = input();
        unset($data['location']);
        $re      = model('Nav')->edit_status($data);
        if($re){
            Api()->setApi('url',url('Navigation/nav_index'))->ApiSuccess($re);
        }else{
            Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
        }
    }
    /*
     * 获取店铺分类导航树形列表
     * */
    public  function getNavTree($pid){
        $id      = $pid ? $pid : 0;
        $tree    = model('Nav')->select();
        resultToArray($tree);
        $select  = getTree($tree,['primary_key'=>'id','class_name'=>'form-control i-select','form_name'=>'pid'],1)->makeSelect($id,'name',"顶级导航");
        return $select;
    }

}

