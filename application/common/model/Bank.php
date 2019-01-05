<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 *银行类
 * @author 彭强
 * @version 2017/7/7
 */
class Bank extends Model{
	use SoftDelete;
	/**
	 *用户银行卡列表
     */
    //public function bank_list($data){
    public function bank_list(){
        $bank_arr = $this
                    ->alias('a')
                    ->field('a.bank_id,a.user_id,a.realname,a.account,a.account_name,a.create_time,bankaddress,b.nickname')
                    ->join('ui_admin b','a.user_id = b.admin_id')
                    ->order('create_time desc')
                    ->paginate(10);
        return $bank_arr;
    }
    /**
     * 
     */
   




}
