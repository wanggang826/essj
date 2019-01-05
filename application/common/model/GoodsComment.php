<?php
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;
/**
 * 商品评价模型
 * @author wanggang
 * @version  2017/5/24
 */
class GoodsComment extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    /**
     * 评论 商品 关联
     */
    public function goods(){
    	return $this->hasOne('Goods','goods_id','goods_id');
    }
    /**
     * 评论 用户 关联
     */
    public function user(){
    	return $this->hasOne('User','user_id','user_id');
    }
    /**
     * 评论 admin 关联
     */
    public function admin(){
        return $this->hasOne('admin','admin_id','user_id');
    }
    /**
     * 评论列表查询
     */
    public function select_comment($data=array(),$where=array()){
    	// TODO 关联查询
    	// if(isValue($data,'shop_name')){
  //           $shop_ids = model('shop')->where(['shop_name'=>['like','%'.(string)$data['shop_name'].'%']])->column('shop_id');
		// 	$where['shop_id'] =['in',$shop_ids];
		// }
		// if(isValue($data,'goods_name')){
		// 	$goods_ids = model('goods')->where(['goods_name'=>['like','%'.(string)$data['goods_name'].'%']])->column('goods_id');
		// 	$where['goods_id'] =['in',$goods_ids];
		// }
		// if(isValue($data,'account')){
		// 	$user_ids = model('user')->where(['account'=>['like','%'.(string)$data['account'].'%']])->column('user_id');
		// 	$where['user_id'] =['in',$user_ids];
		// }
		if(isValue($data,'statr_time') && isValue($data,'end_time')){
			$data['statr_time'] =strtotime($data['statr_time']);
			$data['end_time']   =strtotime($data['end_time']);
			$where['create_time']=['BETWEEN',[$data['statr_time'],$data['end_time']]];
		}
        if(isValue($data,'goods_id')){
            $where['goods_id'] = $data['goods_id'];
        }
        if(isValue($data,'score')){
            $where['score'] = $data['score'];
        }
        $query =$data;
		$list=$this->where($where)->order('create_time desc')->paginate('1',false,['query' => $query]);
		resultToArray($list);
		foreach ($list as $key => $comments) {
            if($comments->goods !=null){
                $list[$key]['goods_name']  = $comments->goods->data['goods_name'];
                $list[$key]['goods_price'] = $comments->goods->data['shop_price'];
            }else{
                $list[$key]['goods_price'] = '--';
                $list[$key]['goods_name']  = '--';
            }
            if($comments['type'] == 1){
                if($comments->user !=null){
                    if($comments->user->data['nickname'] != null){
                        $list[$key]['nickname'] = $comments->user->data['nickname'];
                    }else{
                        $list[$key]['nickname'] = $comments->user->data['account'];
                    }
                    if($comments->user->data['phone'] != null){
                        $list[$key]['tel'] = $comments->user->data['phone'];
                    }else{
                        $list[$key]['tel'] = '--';
                    }
                }else{
                    $list[$key]['nickname'] = '--';
                    $list[$key]['tel'] = '--';
                }
            }elseif($comments['type']==2){
                if($comments->admin !=null){
                    if($comments->admin->data['nickname'] != null){
                        $list[$key]['nickname'] = $comments->admin->data['nickname'];
                    }else{
                        $list[$key]['nickname'] = $comments->admin->data['account'];
                    }
                    if($comments->admin->data['phone'] != null){
                        $list[$key]['tel'] = $comments->admin->data['phone'];
                    }else{
                        $list[$key]['tel'] = '--';
                    }
                }else{
                    $list[$key]['nickname'] = '--';
                    $list[$key]['tel'] = '--';
                }
            }
            	
		}
		return $list;
    }

    /**
     * 商品详情页的评价列表(同时返回商家回复)
     */
    public  function good_comment($data){
        //dump($data);
        $reply=[];
        $comment_id=[];//评论ID
        $where['goods_id'] = $data['goods_id'];
        $where['reply_id'] =array('EQ','NULL');
        if(isset($data['page'])){
            $page =$data['page'];

        }else{
            $page =1;
        }
        unset($data['page']);
        $query =$data;
        //dump($where);die;
        if(isset($data['type'])){
            if($data['type'] == 'img'){
                $where['com_img1'] =array('NEQ','NULL');
                $comment=$this->where($where)->order('create_time desc')->paginate('',false,['page'=>$page,'query' => $query]);
            }else{
                $comment=$this->where($where)->order('create_time desc')->paginate('',false,['page'=>$page,'query' => $query]);
            }
        }else{
            $comment=$this->where($where)->order('create_time desc')->paginate('',false,['page'=>$page,'query' => $query]);
        }
        foreach ($comment as $k =>&$v){//将comment_id取出,用作查询对应的回复;
            $comment_id[]=$v['comment_id'];
        }
        $reply_arr =$this->where(['reply_id'=>['in',$comment_id]])->select();//所有的回复

        foreach ($reply_arr as $comment_id =>&$value) {//将reply_id作为数组的键,方便下面把回复插里面
            $reply[$value['reply_id']] = $value;
        }
        foreach ($comment as $ke =>&$va){//将把回复插里面
            if($va->user !=null){
                $va['nickname'] =$va->user->nickname;
                $va['headimg'] =$va->user->headimg;
            }
            if(isset($reply[$va['comment_id']])){
                $va['reply'] =$reply[$va['comment_id']];
            }else{
                $va['reply'] ="" ;
            }
            $attr = model('OrderInfo')->where(['order_id'=>$va['order_id'],'goods_id'=>$va['goods_id']])->select();
            if($attr){
                if($attr[0]['good_attr']){
                    $va['good_attr']=unserialize($attr[0]['good_attr']);
                }else{
                    $va['good_attr']="" ;
                }

            }

        }
        return $comment;
    }
    /**
     * 商品评价详情(总数,带图数量,星数)
     */
    public function comment_info($data){
        $info = [];
        $where['reply_id'] =array('EQ','NULL');
        if(isValue($data,'goods_id')){
            $where['goods_id'] = $data['goods_id'];
        }
        $comment = $this->where($where)->select();
        resultToArray($comment);
        $info['all_num'] = count($comment);//总条数
        if($info['all_num']){
            $info['average'] = round(array_sum(array_column($comment,'score'))/count($comment),1);//星数平均数
        }else{
            $info['average'] =0;
        }
        $img_num = 0;
        foreach ($comment as $k =>$v){
            if($v['com_img1'] !=''){
                $img_num++;
            }
        }
        $info['img_num']=$img_num;
        return $info;
    }
    /**
     * 新增评价
     */
    public function add_comment($data){
        $result = $this->validate('GoodsComment.add')->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }
    /**
     *商铺的不同评价数量
     */
    public function shop_comment($month,$shop_id){
        $num['optimal']=0;$num['good']=0;$num['poor']=0;
        $comments = $this->where(['create_time'=>['>=',$month],'shop_id'=>$shop_id])->select();
        foreach ($comments as $k =>$v) {
            if ($v['score'] < 2) {
                $num['poor'] += 1;
            } elseif ($v['score'] < 5 && $v['score'] > 1) {
                $num['good'] += 1;
            } elseif ($v['score'] > 4) {
                $num['optimal'] += 1;
            }
        }
      return $num;
    }

    //好评率计算
     public function getPraisePercentage($good_id){
         $good_comment_sum = $this
             ->where('goods_id',$good_id)
             ->where('score','in',[2,3])
             ->count('comment_id');

         $comment_sum = $this
             ->where('goods_id',$good_id)
             ->count('comment_id');

         $praisePercentage = round($good_comment_sum/$comment_sum,2);

         return $praisePercentage*100;


     }



}