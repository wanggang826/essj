<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:73:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\u_info.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:75:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\side_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><!-- 个人信息 by wanggang  --><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js" charset="utf-8"></script><script type="text/javascript" src="<?php echo $web_static; ?>/js//uploadImg.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/usernew.css"><form class="js-ajax-form" action="<?php echo url('UserCenter/u_info'); ?>" method="post"><div class="h_concent"><div class="position"><p>您的位置：</p><a href="">首页 ></a><p>设置 ></p><p>个人信息</p></div><div class="indent_fl"><div class="h_sidebar"><div class="sidebar_centre"><ul><div class="h_square"><i class="icon i-wodedingdan"></i><span>订单中心</span></div><li><a href="<?php echo urldo('user_center/u_order'); ?>">我的订单</a></li><li><a href="<?php echo urldo('user_center/order_recycle'); ?>">订单回收站</a></li><li><a href="<?php echo urldo('user_center/evaluate'); ?>">评价管理</a></li><li><a href="#">购买过的店铺</a></li><li><a href="#">我的积分</a></li><li><a href="<?php echo urldo('user_center/u_message'); ?>">消息中心</a></li><li><a href="<?php echo urldo('user_center/u_collection'); ?>">我的收藏</a></li><li><a href="#">购物车</a></li><li><a href="#">我的足迹</a></li><div class="h_borde"></div></ul><ul><div class="h_square"><i class="icon i-shezhi"></i><span>设置</span></div><li><a href="<?php echo urldo('user_center/u_info'); ?>">个人信息</a></li><li><a href="<?php echo urldo('user_center/u_safe'); ?>">账户安全</a></li><li><a href="<?php echo urldo('user_center/u_address'); ?>">收货地址</a></li><li><a href="<?php echo urldo('user_center/u_binding'); ?>">账户绑定</a></li><li><a href="<?php echo urldo('user_center/u_changepass'); ?>">修改密码</a></li><div class="h_borde"></div></ul></div><script type="text/javascript">
    var url = window.location.href;
    var $a  = $('.sidebar_centre ul li').find('a');
    $a.parent().removeClass('sidebar_lired');
    $a.removeClass('sidebar_red');
    $a.each(function() {
        if($(this).attr('href') == url){
            $(this).addClass('sidebar_red');
        }
    });
</script></div></div><div class="indent_rirgt"><div class="right_nav">个人信息</div><div class="userimg"><div class="img_cont"><div class="img_prev"></div><input type="file" name="photo" id="photo" value="<?php echo $user_info['photo']; ?>" /><input type="hidden" name="user_id" value="<?php echo $user_info['user_id']; ?>"></div></div><div class="indent_rirgtcont"><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan"><img src="<?php echo $img; ?>/right.png" alt="" class="ceimg">用户名</span><input type="text" class="username" id="account" name="account" js-check="account" value="<?php echo $user_info['account']; ?>"></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan"><img src="<?php echo $img; ?>/right.png" alt="" class="ceimg">昵<span  class="textinde"></span>称</span><input type="text" class="username" id="nickname
                " name="nickname" js-check="nickname" value="<?php echo $user_info['nickname']; ?>"></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan"><img src="<?php echo $img; ?>/right.png" alt="" class="ceimg">性<span  class="textinde"></span>别</span><label for="man" style="font-weight: normal;" class="man"><div class="hui"><div class="hei"></div></div><input type="radio" style="display: none" name="sex" id="man" value="1" {if condition="$user_info.sex = 1"}checked{/}>
                     男
                </label><label for="women" style="font-weight: normal;" class="man"><div class="hui"><div class="hei"></div></div><input type="radio" style="display: none" name="sex" id="women" value="2" {if condition="$user_info.sex = 2"}checked{/}>
                     女
                </label><label for="women" style="font-weight: normal;" class="man"><div class="hui"><div class="hei"></div></div><input type="radio" style="display: none" name="sex" id="baomi" value="0" {if condition="$user_info.sex = 0"}checked{/}>
                     保密
                </label></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan">生<span  class="textinde"></span>日</span><input type="text" class="i-date username" name="birthday" ></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan">邮<span  class="textinde"></span>箱</span><span><?php echo $user_info['email']; ?></span><a class="indent_rirgtcontbtn" href="<?php echo url('u_email',['user_id'=>$user_info['user_id']]); ?>">修改</a></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan"><img src="<?php echo $img; ?>/right.png" alt="" class="ceimg">手机号码</span><span><?php echo $user_info['phone']; ?></span><a class="indent_rirgtcontbtn" href="<?php echo url('u_phone',['user_id'=>$user_info['user_id']]); ?>">修改</a></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan"><img src="<?php echo $img; ?>/right.png" alt="" class="ceimg">真实姓名</span><input type="text" class=" username" name="realname" js-check="realname" value="<?php echo $user_info['realname']; ?>"></div><div class="indent_rirgtcontson"><span class="indent_rirgtcontspan"></span><button class="usersubmit username js-submit-btn">提交</button></div></div></div></div></form><script src="<?php echo $web_static; ?>/js/checkForm.js"></script><script type="text/javascript">
    $('#photo').imgUpload({
        allowedNum:1,//允许上传最大数量
        width:'142',//预览框宽度
        height:'142',//预览框高度
        imgWidth:142,//图片上传宽度
        imgHeight:142,//图片上传高度
        files:{
            1:'<?php echo getImg($user_info['photo']); ?>',
        }
    })
  /*  $('#photo').imgUpload({
        allowedNum:1,//允许上传最大数量
        width:'142',//预览框宽度
        height:'142',//预览框高度
        imgWidth:142,//图片上传宽度
        imgHeight:142,//图片上传高度
        allowedNum:1,//允许上传最大数量
        files:{
            1:'<?php echo getImg($user_info['photo']); ?>',
        }
    })*/
</script><script>
    //侧边栏
        $('.h_sidebar li').click(function(){
        $(this).find('a').parent().parent().parent().find('a').removeClass('sidebar_red')
        $(this).parent().parent().find('li').removeClass('sidebar_lired');
        $(this).find('a').addClass('sidebar_red');
        $(this).addClass('sidebar_lired');
       });
    $(".hui").click(function () {
        $(".hei").removeClass("adddis")
      $(this).children(".hei").addClass("adddis")

    })

</script><script>
$('.i-date').focus(function(e){
    var id = 'date-' +parseInt(e.timeStamp);
    $(this).attr('id',id).attr('value',laydate.now('',date.format));
    date.format = $(this).attr('istime') ? 'YYYY-MM-DD hh:mm:ss' : 'YYYY-MM-DD';
    date.istime = $(this).attr('istime') ? true : false;
    date.elem = '#'.id;
    laydate(date);
    delete  date;
})

var date= {
    format: 'YYYY-MM-DD',
    // min: laydate.now(-7),
    // max: laydate.now(),
    istime: false, //是否开启时间选择
    isclear: false, //是否显示清空
    istoday: true, //是否显示今天
    issure: true, //是否显示确认
}
// function eler() {
//     var userval = $("#suername").val();
//     var uservni = $("#suerni").val();
// //    帐号验证
//     if (userval == "") {
//         $("#suername").parents(".indent_rirgtcontson").append('<div class="alert"><div class="box2"><img src="<?php echo $img; ?>/5.png" alt="" class="img5">用户名不能为空</div></div>');
       
//     }
//     if (uservni == "") {
//         $("#suerni").parents(".indent_rirgtcontson").append('<div class="alert"><div class="box2"><img src="<?php echo $img; ?>/5.png" alt="" class="img5">昵称不能为空</div></div>');
        
//     }
//     $('input').bind('input propertychange', function() {
//         $(this).parent(".indent_rirgtcontson").children(".alert").remove();
        

//     });
// }


</script><script type="text/javascript">
    //验证用户名
    function account(e){
      var account = $(e).val();
      if (account == '') {
          return '请填写用户名!';
      }
      return true;
    }
    //验证昵称
    function nickname(e){
      var nickname = $(e).val();
      if (nickname == '') {
          return '请填写昵称!';
      }
      return true;
    }
    //验证姓名
    function realname(e){
      var realname = $(e).val();
      if (realname == '') {
          return '请填写姓名!';
      }
      return true;
    }
</script></html><?php if(!isset($bottom_nav) || $bottom_nav !== false): ?><div class="fild"><div class="container"><div class="row d_floarig"><div class="col-sm-2 d_padi "><img src="<?php echo $img; ?>/baozhang.png" /><p>30天退换货保障</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/baoyou.png" /><p>购买满199包运费</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/fukuan.png" /><p>货到付款</p></div><div class="col-sm-2 d_padi flaorigt"><img src="<?php echo $img; ?>/kefu.png" /><p>售后无忧</p></div></div></div></div><div class="container list-style"><?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="ul2"><?php if(is_array($vo['name']) || $vo['name'] instanceof \think\Collection || $vo['name'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['name'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$name): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $name['href']; ?>"><?php echo $name['article_title']; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><?php endforeach; endif; else: echo "" ;endif; ?><div class="ul2"><img src="<?php echo getImg(config($logo='qr_code')); ?>" alt=""  class="qr_code" /></div></div><?php endif; ?><div class="container text"><p><?php echo $webInfo; ?></p><div class="bottom"><a href=""><img src="<?php echo $img; ?>/bottom.png" alt="" /></a></div></div><script type="text/javascript">        //收藏夹图标
        $(".shouc").hover(
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucangh.png")
            },
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucang.png")
            }
        );
    </script></body><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $js; ?>/shop.js"></script></html>