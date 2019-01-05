<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:76:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\u_address.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:75:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\side_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><!-- 用户收获地址 by wanggang--><link rel="stylesheet" href="<?php echo $css; ?>/usernew.css"><!-- 地区插件 --><link href="<?php echo $web_static; ?>/plugins/citypicker/css/city-picker.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/cache/city.cache.js"></script><script src="<?php echo $web_static; ?>/plugins/citypicker/js/city-picker.js"></script><div class="h_concent"><div class="position"><p>您的位置：</p><a href="">首页 ></a><p>设置 ></p><p>收货地址</p></div><div class="indent_fl"><div class="h_sidebar"><div class="sidebar_centre"><ul><div class="h_square"><i class="icon i-wodedingdan"></i><span>订单中心</span></div><li><a href="<?php echo urldo('user_center/u_order'); ?>">我的订单</a></li><li><a href="<?php echo urldo('user_center/order_recycle'); ?>">订单回收站</a></li><li><a href="<?php echo urldo('user_center/evaluate'); ?>">评价管理</a></li><li><a href="#">购买过的店铺</a></li><li><a href="#">我的积分</a></li><li><a href="<?php echo urldo('user_center/u_message'); ?>">消息中心</a></li><li><a href="<?php echo urldo('user_center/u_collection'); ?>">我的收藏</a></li><li><a href="#">购物车</a></li><li><a href="#">我的足迹</a></li><div class="h_borde"></div></ul><ul><div class="h_square"><i class="icon i-shezhi"></i><span>设置</span></div><li><a href="<?php echo urldo('user_center/u_info'); ?>">个人信息</a></li><li><a href="<?php echo urldo('user_center/u_safe'); ?>">账户安全</a></li><li><a href="<?php echo urldo('user_center/u_address'); ?>">收货地址</a></li><li><a href="<?php echo urldo('user_center/u_binding'); ?>">账户绑定</a></li><li><a href="<?php echo urldo('user_center/u_changepass'); ?>">修改密码</a></li><div class="h_borde"></div></ul></div><script type="text/javascript">
    var url = window.location.href;
    var $a  = $('.sidebar_centre ul li').find('a');
    $a.parent().removeClass('sidebar_lired');
    $a.removeClass('sidebar_red');
    $a.each(function() {
        if($(this).attr('href') == url){
            $(this).addClass('sidebar_red');
        }
    });
</script></div></div><div class="indent_rirgt"><div class="right_nav">收货地址</div><form action="" method="post" class="js-ajax-form "><div class="indent_rirgt_zhang"><div class="indent_rirgt_passs" style="position: relative;"><div class="indent_rirgt_passcont">所在地区</div><input class="form-control" readonly type="text" id="citys" value="" data-toggle="city-picker" name='citys' style="background: #fff;border: 0"><input type="hidden" name="city" value="" id="city" /></div><div class="indent_rirgt_passs"><div class="indent_rirgt_passcont">详细地址</div><textarea  name="address" id="address" cols="30" rows="3"></textarea></div><div class="indent_rirgt_passs"><div class="indent_rirgt_passcont">邮政编码</div><input type="text" name="post_code" id="post_code" value=""></div><div class="indent_rirgt_passs"><div class="indent_rirgt_passcont">收 货 人</div><input type="text" name="user_name" id="user_name" value=""></div><div class="indent_rirgt_passs"><div class="indent_rirgt_passcont">手机号码</div><input type="text" name="user_phone" id="user_phone" value=""><input type="hidden" name="address_id"  value="" id="address_id" /></div><div class="indent_rirgt_passs"><button type="submit"  class="indent_rirgt_button js-submit-btn">保存</button></div></div></form><div class="indent_rirgt_dizhi"><div class="right_navone">全部地址</div><div class="right_navcont"><span class="right_navcontson">收货人</span><span class="right_navcontson">所在地区</span><span class="right_navcontson">详细地址</span><span class="right_navcontson">手机号码</span></div><div class="right_navbar">已保存了<span><?php echo $count; ?></span>条地址，还能保存<span><?php echo $remaind_count; ?></span>条地址</div><?php if(is_array($addressInfo) || $addressInfo instanceof \think\Collection || $addressInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $addressInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="right_navconts"><span class="right_navcontsons" name="<?php echo $vo['user_name']; ?>"><?php echo $vo['user_name']; ?></span><span class="right_navcontsons"><?php echo $vo['citys']; ?></span><span class="right_navcontsons"><?php echo $vo['address']; ?></span><span class="right_navcontsons"><?php echo $vo['user_phone']; if($vo['is_default'] == 1): ?><div class="right_mo">默认地址</div><?php else: ?><div class="right_navcontsonsdiv" ><span class="right_shemo" onclick="set_addr_default(<?php echo $vo['address_id']; ?>)">设为默认</span><span class="right_bianji edit<?php echo $key; ?>"  onclick="edit_addr(<?php echo $vo['address_id']; ?>)">编辑</span><span class="right_shanchu" onclick="del_addr(<?php echo $vo['address_id']; ?>)">删除</span></div><?php endif; ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div></body><script>
    //侧边栏
    $('.h_sidebar li').click(function(){
        $(this).find('a').parent().parent().parent().find('a').removeClass('sidebar_red');
        $(this).parent().parent().find('li').removeClass('sidebar_lired');
        $(this).find('a').addClass('sidebar_red');
        $(this).addClass('sidebar_lired');
    });

    //设置默认地址
    $('.right_mo').parent().find('.right_navcontsonsdiv').css('display','none');

    $(".right_shemo").each(function(){
        $(this).click(function () {
            $('.right_mo').parents('.right_navconts').addClass('nb001');
            var ab=$('.nb001').find('.right_mo').detach();
            $(this).parent().parent().append(ab);
            $(this).parent().css('display','none');
            $(this).parents('.right_navconts').siblings().find('.right_navcontsonsdiv').css('display','inline-block');
        })
    });

    function set_addr_default(id) {
        doAddress("set_addrDefault",id);
        window.location.href = '';
    }

    //删除当前
    function del_addr(id) {
        layer.alert("是否确定要删除？",{title:'提示信息',closeBtn: 1,icon:7},function () {
            doAddress("del_addr",id);
            window.location.href = '';
        })
    }

    //编辑收货地址
    function edit_addr(id) {
        $.ajax({
            url: '<?php echo U("edit_addr"); ?>',
            type: "post",
            data:{"address_id":id},
            success: function (res){
                console.log(res);
                $('.placeholder')[0].innerHTML = res.citys;
                $('#city').attr('value',res.citys);
                $('#address')[0].innerHTML = res.address;
                $('#post_code').attr('value',res.post_code);
                $('#user_name').attr('value',res.user_name);
                $('#user_phone').attr('value',res.user_phone);
                $('#address_id').attr('value',res.address_id);
            }
        })
    }

    function doAddress(url,id) {
        $.ajax({
            url: '<?php echo U("'+url+'"); ?>',
            type: "post",
            data:{"address_id":id},
            success: function (res){}
        })
    }

    $('.right_navconts').hover(function () {
        $(this).find('.right_navcontsonsdiv').css('display','inline-block');
    },function () {
        $(this).find('.right_navcontsonsdiv').css('display','none');
    })

</script><style type="text/css">
    .city-picker-span{
        display: inline-block;
        margin-left:20px;
    }
    .show{
        display: inline-block;
    }
    .hide{
        display: none;
    }
    .right_navcontsonsdiv{
        display: none;
    }
</style></html><?php if(!isset($bottom_nav) || $bottom_nav !== false): ?><div class="fild"><div class="container"><div class="row d_floarig"><div class="col-sm-2 d_padi "><img src="<?php echo $img; ?>/baozhang.png" /><p>30天退换货保障</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/baoyou.png" /><p>购买满199包运费</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/fukuan.png" /><p>货到付款</p></div><div class="col-sm-2 d_padi flaorigt"><img src="<?php echo $img; ?>/kefu.png" /><p>售后无忧</p></div></div></div></div><div class="container list-style"><?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="ul2"><?php if(is_array($vo['name']) || $vo['name'] instanceof \think\Collection || $vo['name'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['name'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$name): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $name['href']; ?>"><?php echo $name['article_title']; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><?php endforeach; endif; else: echo "" ;endif; ?><div class="ul2"><img src="<?php echo getImg(config($logo='qr_code')); ?>" alt=""  class="qr_code" /></div></div><?php endif; ?><div class="container text"><p><?php echo $webInfo; ?></p><div class="bottom"><a href=""><img src="<?php echo $img; ?>/bottom.png" alt="" /></a></div></div><script type="text/javascript">        //收藏夹图标
        $(".shouc").hover(
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucangh.png")
            },
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucang.png")
            }
        );
    </script></body><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $js; ?>/shop.js"></script></html>