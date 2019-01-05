<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use extend\UploadImg;
use think\Exception;
use think\Log;

/**
 * 基本数据控制器
 */
class  Basedata extends AdminBase{

    //卖场维护列表
    public function store_info()
    {
        $data = input();
        $stores = model('StoreInfo')->selectStore($data);
        return view([
            'lists'=>$stores,
        ]);
    }

    //卖场添加
    public function store_add(){
	    if(request()->isAjax()){
	        $data = input();
            try{
                $is_exist = model('StoreInfo')->where('store_name',$data['store_name'])->find();
                if(!empty($is_exist))
                    throw new Exception('卖场名称已存在');
                if(empty($data['store_name']))
                    throw new Exception('请输入卖场名称');
                $data['admin_id'] = session('islogin');
                model('StoreInfo')->save($data);
                Api()->setApi('url',url('basedata/store_info'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }
        }
        return view();
    }

    //卖场删除
    public function store_del(){
        if(request()->isAjax()){
            try{
                $data = input();
                if(empty($data['id']))
                    throw new Exception('请选择要操作数据');
                $time = time();
                $res  = model('StoreInfo')
                    ->where('id','in',$data['id'])
                    ->update(['delete_time'=>$time]);
                if(empty($res))
                    throw new Exception('操作失败');
                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }

        }
    }

    //质检报告列表
    public function check_info(){
        $data = input();
        $checks = model('CheckInfo')->selectCheck($data);
        return view([
            'lists'=>$checks,
        ]);
    
    }

    //质检报告添加/编辑
    public function check_add($id = ''){
        //质检添加/编辑
        if(request()->isAjax()){
            $data = input();
            if(empty($data['fun_name']))
                Api()->setApi('msg','请减价功能检测节点')->setApi('url',0)->ApiError();
            if(!empty($data['id'])){
                if(isset($data['uploadImg'])){
                    //删除原来的图片
                    $check_photo = model('CheckInfo')->field('checker_photo')->find($data['id']);
                    $photo    = ROOT_PATH."public/upload".$check_photo['checker_photo'];
                    @unlink($photo);
                    $year = date('Y/m',time());
                    //上传图片 返回图片名称 数组
                    $re   = UploadImg::upload("user/$year")->getMsg();
                    $data['checker_photo'] = "/user/".$year."/".$re['info']['edit_photo'][0];
                    unset($data['uploadImg']);
                }else{
                    $data['checker_photo'] = "/user/QC_img.jpg";
                }
                $re  = model('CheckInfo')->editCheckInfo($data);
            }else{
                if(isset($data['uploadImg'])){
                    $year = date('Y/m',time());
                    //上传图片 返回图片名称 数组
                    $re   = UploadImg::upload("user/$year")->getMsg();
                    $data['checker_photo'] = "/user/".$year."/".$re['info']['checker_photo'][0];
                    unset($data['uploadImg']);
                }else{
                    $data['checker_photo'] = "/user/QC_img.jpg";
                }

                $re  = model('CheckInfo')->addCheckInfo($data);
            }
            if($re == 1){
                Api()->setApi('url',url('basedata/check_info'))->ApiSuccess();
            }else{
                Api()->setApi('msg',$re)->setApi('url',0)->ApiError();
            }
        }
        //显示编辑页面
        if(request()->isGet() && !empty($id)){
            $check = model('CheckInfo')->find($id);
            $fun_check = json_decode($check['fun_check'],true);
            return view([
                'check'     => $check,
                'fun_check' => $fun_check
                ]);
        }

        //显示新增页面
        return view();
    }

    //质检删除
    public function check_del(){
        if(request()->isAjax()){
            try{
                $data = input();
                if(empty($data['id']))
                    throw new Exception('请选择要操作数据');
                $time = time();
                $res  = model('CheckInfo')
                    ->where('id','in',$data['id'])
                    ->update(['delete_time'=>$time]);
                if(empty($res))
                    throw new Exception('操作失败');
                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }

        }
    }

    //banner列表
    public function banner_info(){
        $data = input();
        $banners = model('Banner')->selectBanner($data);
        return view([
            'banners'=>$banners,
        ]);
    }

    //banner图片查看
    public function banner_pic($id){
        $banner = model('Banner')->field('banner')->find($id);
        return view(['banner'=>$banner]);
    }

    //banner添加/编辑
    public function banner_add($id = ''){
        if(request()->isAjax()){
            try{
                $data = input();
                if(empty($data['title']))
                    throw new Exception("请输入标题");
                if(empty($data['type_id']))
                    throw new Exception("请选择类型");
                if(!empty($data['id'])){#编辑banner图片
                    if(isset($data['uploadImg'])){
                        //删除原来的图片
                        $banner = model('Banner')->field('banner')->find($data['id']);
                        $banner    = ROOT_PATH."public/upload".$banner['banner'];
                        @unlink($banner);
                        $year = date('Y/m',time());
                        $re   = UploadImg::upload("banners/$year")->getMsg();
                        $data['banner'] = "/banners/".$year."/".$re['info']['edit_banner'][0];
                        unset($data['uploadImg']);
                    }
                    $res = model('Banner')->where('id',$data['id'])->update($data);
                }else{#新增banner图片
                    if(!isset($data['uploadImg']))
                        throw new Exception("请上传banner图");
                    $res = model('Banner')->bannerAdd($data);
                }
                if(empty($res))
                    throw new Exception('操作失败');
                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }
        }
        //编辑页面
        $types = model('BannerType')->all();
        if(request()->isGet() && !empty($id)){
            $banner = model('Banner')->find($id);
            return view([
                'banner'  => $banner,
                'types'=>$types
                ]);
        }
        //添加页面
        return view(['types'=>$types]);
    }

    //获得banner在选择的类型中的最大排序+1
    public function getRank(){
        if(request()->isAjax()){
            $type_id = input('type_id');
            $rank = model('Banner')->field('rank')->where('type_id',$type_id)->order('rank desc')->find();
            $rank = $rank['rank'] + 1;

            return $state = array(
                'status'   => true,
                'data'     => $rank
            );
        }
    }

    //banner删除
    public function banner_del(){
        if(request()->isAjax()){
            try{
                $data = input();
                if(empty($data['id']))
                    throw new Exception('请选择要操作数据');
                $time = time();
                $res  = model('Banner')
                    ->where('id','in',$data['id'])
                    ->update(['delete_time'=>$time]);
                if(empty($res))
                    throw new Exception('操作失败');
                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }

        }
    }

    //头条列表
    public function article_info(){
        $data      = input();
        $articles = model('Article')->selectArticle($data);
        return view([
            'lists'     => $articles,
            'type_id'   => $data['type_id']
        ]);
    }

    //头条添加/编辑
    public function article_add($type_id,$id = ''){
        //头条添加/编辑
//        $type_id = input('type_id');
        if(request()->isAjax()){
            try{
                $data = input();
                if(empty($data['title']))
                    throw new Exception('请输入头条标题');
                if(empty($data['content']))
                    throw new Exception('请输入头条内容');
                if(empty($data['id'])){
                    $data['admin_id'] = session('islogin');
                    unset($data['id']);
                    $res  = model('Article')->save($data);
                }else{
                    $data['admin_id'] = session('islogin');
                    $res  = model('Article')->where('id',$data['id'])->update($data);
                }
                if(empty($res))
                    throw new Exception('操作失败');
                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }
        }
        //编辑页面显示
        if(request()->isGet() && !empty($id)){
            $article = model('Article')->find($id);
            return view([
                'article'  => $article,
                'type_id'  => $type_id
            ]);
        }
        return view(['type_id'=>$type_id]);
    }

    //头条删除
    public function article_del(){
        if(request()->isAjax()){
            try{
                $data = input();
                if(empty($data['id']))
                    throw new Exception('请选择要操作数据');
                if(empty($data['type_id']))
                    throw new Exception('操作不合法');
                $time = time();
                $res  = model('Article')
                    ->where('id','in',$data['id'])
                    ->where('type_id',$data['type_id'])
                    ->update(['delete_time'=>$time]);
                if(empty($res))
                    throw new Exception('操作失败');
                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch(\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }

        }
    }
}
	