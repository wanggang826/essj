<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\Model\UserAccountLog;

/**
* 资金流水控制器
* @author gucangfa
* @version 2017/05/26
*/
class AccountLogs extends AdminBase
{
	/*
	* 资金流水列表
	*/
	public function index(){
		$lists = model('UserAccountLog')->select_accountLog(input());
		foreach ($lists as &$value) {
			$value['account'] = model('User')->getUserName($value['user_id'],'account');
			$value['realname'] = model('User')->getUserName($value['user_id'],'realname');
		}
		return view([
			'lists' => $lists,
			]);
	}

    /**
     * 资金流水删除
      */
    public function logs_del(){
        if(request()->isAjax()){//多选删除
            $data = input();
            $time = time();
            $del = $this->setStatus('UserAccountLog',$time,$data['id'],'id','delete_time');
            if(1 == $del->code){
                Api()->setApi('url',input('location'))->ApiSuccess();
            }else{
                Api()->setApi('url',0)->ApiError();
            }
        }
    }


	/*
	 * 取现管理
	 * */
	public  function cash(){
	    $data['realname']= input('realname');
        $data['account']= input('account');
        $data['statr_time']= input('statr_time');
        $data['end_time']= input('end_time');
        $data['size']=(input('size')== null) ? 10:input('size');//每页显示条数
        $lists = model('UserAccountLog')->select_cash($data);
       // dump($lists);die;
	    return view(['lists'=>$lists]);
    }
 /*
 * 提现详情
  */
    public function cash_info(){
        $data['id']= input('id');
        $info = model('UserAccountLog')->cash_info($data);
        resultToArray($info);
        return view(['info'=>$info]);
    }
    /*
     * 提现删除
      */
    public function cash_del(){
        if(request()->isAjax()){//多选删除
            $data = input();
            $time = time();
            $del = $this->setStatus('UserAccountLog',$time,$data['id'],'id','delete_time');
            if(1 == $del->code){
                Api()->setApi('url',input('location'))->ApiSuccess();
            }else{
                Api()->setApi('url',0)->ApiError();
            }
        }
    }



}