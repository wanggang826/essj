<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\Menu;
use app\common\Model\City;
use extend\Auths;
use extend\Upload;
use think\Session;
class Layouts extends AdminBase
{
    public function index()
    {
        $cates =model('GoodsCate')->field('cate_id as id,pid,name,sort')->select();
        resultToArray($cates);
        if($cates){
            $tree  = getTree($cates,['primary_key'=>'id','children_key'=>'children'])->makeTreeForHtml();
        }else{
            $tree  = array();
        }
        return json($tree);
        return view();
    }
    public function forms(){
        $menus = Menu::all(function($db){
            $db->where(['status'=>['<>',-1]])->order('sort', 'asc');
        });
        resultToArray($menus);
        $select = getTree($menus,['primary_key'=>'menu_id','class_name'=>'form-control i-select'])->makeSelect(0,'menu_name');
        $this->assign('select',$select);
        if (Request()->isAjax()){
            Api()->ApiSuccess(intput());
        }
        return view();
    }
    public function treetable(){
        $menus = model('menu')->where(['status'=>['<>',-1]])->order('sort', 'asc')->paginate();
        resultToArray($menus);
        $this->assign('tree',$menus);
        return view();
    }
    public function ztree(){
        if (Request()->isAjax()){
            $year = date('Y/m',time());
			  $re = Upload::uploadImg("config/$year/")->getInfo();
            Api()->ApiSuccess($re);
		}
        return view();
	}
    public function bootstraptable(){

        return view();
    }

    public function pic(){
        if (request()->isAjax()) {
            $type = input();
            Api()->setApi('url',0)->ApiSuccess($type);
        }
        return view();
    }

    public function texts(){
        if ($_FILES) {
            // dump($_FILES);
                // errno 即错误代码，0 表示没有错误。
                //       如果有错误，errno != 0，可通过下文中的监听函数 fail 拿到该错误码进行自定义处理
                // data 是一个数组，返回若干图片的线上地址
            return json([
                'errno'=> 0,
                'data'=> [
                    $this->var['upload'].'config/1496900831_DEFAULT_IMG1.jpeg',
                    $this->var['upload'].'config/1496904403_WEB_LOGO1.png',
                ]
            ]);
        }
        return view();
    }
    public function text(){
        if ($_FILES) {
//             dump($_FILES);
            // errno 即错误代码，0 表示没有错误。
            //       如果有错误，errno != 0，可通过下文中的监听函数 fail 拿到该错误码进行自定义处理
            // data 是一个数组，返回若干图片的线上地址
            return json([
                'errno'=> 0,
                'data'=> [
                    $this->var['upload'].'article/'.$this->upload(),
                ]
            ]);
        }
        return view();
    }

    public function upload()
    {
        $file = request()->file('image');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload'. DS .'article');
        if($info){
            return $info->getSaveName();
        }else{
            return $file->getError();
        }
    }


    public function showview(){
        $menus = Menu::all(function($db){
            $db->where(['status'=>['<>',-1]])->order('sort', 'asc');
        });
        resultToArray($menus);
        $select = getTree($menus,['primary_key'=>'menu_id','class_name'=>'form-control','form_name'=>'pid'])->makeTree();
        $lists = Menu::paginate();
        if (request()->isAjax()) {
            $data = input();
            $data['citys'] = getCityIdByNames($data['citys']);
            sleep(1);//演示加载状态
            Api()->setApi('url',0)->ApiSuccess($data);
        }
        return view([
            'lists'=>$lists,
            'select'=>$select,
        ]);
    }

}