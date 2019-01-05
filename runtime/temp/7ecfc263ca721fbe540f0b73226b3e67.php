<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:79:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\u_collection.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:75:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\side_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>/shoucang.css" /><div class="navx container"><div class="row"><div class="position"><p>您的位置：</p><a href="">首页 ></a><a href="">订单中心 ></a><p>收藏的商品</p></div><div class="indent_fl"><div class="h_sidebar"><div class="sidebar_centre"><ul><div class="h_square"><i class="icon i-wodedingdan"></i><span>订单中心</span></div><li><a href="<?php echo urldo('user_center/u_order'); ?>">我的订单</a></li><li><a href="<?php echo urldo('user_center/order_recycle'); ?>">订单回收站</a></li><li><a href="<?php echo urldo('user_center/evaluate'); ?>">评价管理</a></li><li><a href="#">购买过的店铺</a></li><li><a href="#">我的积分</a></li><li><a href="<?php echo urldo('user_center/u_message'); ?>">消息中心</a></li><li><a href="<?php echo urldo('user_center/u_collection'); ?>">我的收藏</a></li><li><a href="#">购物车</a></li><li><a href="#">我的足迹</a></li><div class="h_borde"></div></ul><ul><div class="h_square"><i class="icon i-shezhi"></i><span>设置</span></div><li><a href="<?php echo urldo('user_center/u_info'); ?>">个人信息</a></li><li><a href="<?php echo urldo('user_center/u_safe'); ?>">账户安全</a></li><li><a href="<?php echo urldo('user_center/u_address'); ?>">收货地址</a></li><li><a href="<?php echo urldo('user_center/u_binding'); ?>">账户绑定</a></li><li><a href="<?php echo urldo('user_center/u_changepass'); ?>">修改密码</a></li><div class="h_borde"></div></ul></div><script type="text/javascript">
    var url = window.location.href;
    var $a  = $('.sidebar_centre ul li').find('a');
    $a.parent().removeClass('sidebar_lired');
    $a.removeClass('sidebar_red');
    $a.each(function() {
        if($(this).attr('href') == url){
            $(this).addClass('sidebar_red');
        }
    });
</script></div></div><div class="scshop"><div class="schead"><p class="schead1" onClick="collection('goods')">收藏商品<span class="scleft"><?php echo $count['goods_count']; ?></span></p><p class="schead2 schead1" onClick="collection('shop')">收藏店铺<span class="scleft"><?php echo $count['shop_count']; ?></span></p></div><div class="scshopp"><div class="ovflod" id="c_goods"><!--收藏商品开始--><?php if(isset($collection)): if(is_array($collection) || $collection instanceof \think\Collection || $collection instanceof \think\Paginator): $i = 0; $__LIST__ = $collection;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="tap col-lg-3 col-md-4 col-sm-6"><div class="tapmengban"><a href="<?php echo U('Shop/good_detail',['id'=>$vo['goods']['goods_id']]); ?>"><img src="<?php echo getImg($vo['goods']['goods_thums']); ?>" /></a><div class="tapmbdiv"><a class="tapjinu" href="">进入店铺</a><a class="tapquxiao" href="">取消订单</a></div></div><p class="scp1">￥<?php echo $vo['goods']['shop_price']; ?></p><a href="<?php echo U('Shop/good_detail',['id'=>$vo['goods']['goods_id']]); ?>" class="scp2"><?php echo $vo['goods']['goods_name']; ?> &nbsp;<?php echo $vo['goods']['recom_desc']; ?></a><div class="pays"><p class="pays1"><?php echo $vo['goods']['comment']; ?>人评价</p><p class="pays2">销量：<?php echo $vo['goods']['sale_count']; ?></p></div><div class="gohome"><div class="widsc"><a class="gohome1" href="">加入购物车</a></div><div class="widsc"><a class="gohome2" href="">立即购买</a></div></div></div><?php endforeach; endif; else: echo "" ;endif; endif; ?><!--收藏商品结束--></div><div class="page" ><div class="page1" id='goods_page'><?php echo $collection->render(); ?></div></div></div><div class="scshopp"><div class="ovflod" id="c_shop"><!--收藏店铺开始--><!-- <?php if(isset($collection['shop'])): if(is_array($collection['shop']) || $collection['shop'] instanceof \think\Collection || $collection['shop'] instanceof \think\Paginator): $i = 0; $__LIST__ = $collection['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="taps"><div class="tapsimg"><img src="<?php echo getImg($vo['shop_logo']); ?> " alt="" /><p class="tapsp"><?php echo $vo['shop_name']; ?></p><div class="tapsdiv"><div class="tapsdiv1"><a href="">进入店铺</a></div><div class="tapsdiv2"><p>关注店铺</p></div></div></div><div class="tapsshop"><div class="tapspading"><p class="tapsshopp">热销产品</p><?php if(is_array($vo['goods_is_hot']) || $vo['goods_is_hot'] instanceof \think\Collection || $vo['goods_is_hot'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['goods_is_hot'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="tapshopimg"><div class="mengban"><a href=""><img src="<?php echo getImg($v['goods_thums']); ?>" /></a><div class="tapsposition"><a href=""><?php echo $v['goods_name']; ?></a></div></div><p>￥<?php echo $v['shop_price']; ?></p></div><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div><?php endforeach; endif; else: echo "" ;endif; endif; ?> --><!--收藏店铺结束--></div><div class="page"><div class="page1" id='shop_page'></div></div></div></div></div></div><script src="<?php echo $js; ?>/myjs.js" type="text/javascript" charset="utf-8"></script><script>
            function collection(type){
                $.ajax({
                    url:"<?php echo url('UserCenter/u_collection'); ?>",
                    type:'post',
                    data:{type:type},
                    dataType:"json",
                    success:function(data){
                        console.log(data);
                        var collection = data.data
                        if(collection != null){
                            if(type == 'goods'){
                                $('#c_goods').empty();
                                $('#goods_page').empty();
                                var goods = '';
                                for (var i = 0; i < collection.length;  i++) {
                                    goods += '<div class="tap col-lg-3 col-md-4 col-sm-6">';
                                    goods += '<div class="tapmengban">';
                                    goods += '<a href=""><img src="'+collection[i]['goods'].goods_thums+'" /></a>';
                                    goods += '<div class="tapmbdiv">';
                                    goods += '<a class="tapjinu" href="">进入店铺</a>';
                                    goods += '<a class="tapquxiao" href="">取消订单</a>';
                                    goods += '</div></div>';
                                    goods += '<p class="scp1">￥'+collection[i]['goods'].shop_price+'</p>';
                                    goods += '<a href="" class="scp2">'+collection[i]['goods'].goods_name+' '+collection[i]['goods'].recom_desc+'</a>';
                                    goods += '<div class="pays">';
                                    goods += '<p class="pays1">'+collection[i]['goods'].comment+'人评价</p>';
                                    goods += '<p class="pays2">销量：'+collection[i]['goods'].sale_count+'</p>';
                                    goods += '</div>';
                                    goods += '<div class="gohome">';
                                    goods += '<div class="widsc">';
                                    goods += '<a class="gohome1" href="">加入购物车</a>';
                                    goods += '</div>';
                                    goods += '<div class="widsc">';
                                    goods += '<a class="gohome2" href="">立即购买</a>';
                                    goods += ' </div></div></div>';
                                    
                                }
                                $(collection[0].page).appendTo("#goods_page");
                                $(goods).appendTo('#c_goods');
                            }else if(type == 'shop'){
                                $('#c_shop').empty();
                                $('#shop_page').empty();
                                var shop = '';
                                for (var i = 0; i < collection.length ; i++) {
                                    shop += '<div class="taps">';
                                    shop += '<div class="tapsimg">';
                                    shop += '<img src="'+collection[i]['shop'].shop_logo+'" alt="" />';
                                    shop += '<p class="tapsp">'+collection[i]['shop'].shop_name+'</p>';
                                    shop += '<div class="tapsdiv">';
                                    shop += '<div class="tapsdiv1">';
                                    shop += '<a href="">进入店铺</a>';
                                    shop += '</div>';
                                    shop += '<div class="tapsdiv2">';
                                    shop += '<p>关注店铺</p>';
                                    shop += '</div></div></div>';
                                    shop += '<div class="tapsshop">';
                                    shop += '<div class="tapspading">';
                                    shop += '<p class="tapsshopp">热销产品</p>';
                                        for (var a = 0; a < collection[i]['shop']['goods_is_hot'].length ; a++) {
                                            shop += '<div class="tapshopimg">';
                                            shop += '<div class="mengban">';
                                            shop += '<a href=""><img src="'+collection[i]['shop']['goods_is_hot'][a].goods_thums+'" /></a>';
                                            shop += '<div class="tapsposition">';
                                            shop += '<a href="">'+collection[i]['shop']['goods_is_hot'][a].goods_name+'</a></div>';
                                            shop += '</div>';
                                            shop += '<p>￥'+collection[i]['shop']['goods_is_hot'][a].shop_price+'</p>';
                                            shop += '</div>';
                                        }
                                    shop += '</div></div></div>';
                                }
                                $(shop).appendTo('#c_shop');
                                $(collection[0].page).appendTo("#shop_page");
                            }
                        }
                    $(".active").addClass("adcol");
                    $(".active").unbind();  
                    }
                })
            }
        </script><script>
    $(function(){
        // $('.star1').initStar({
        //     score   : 1
        // });
        // $('.star2').initStar({
        //     score   : 2
        // })
        // $('.star3').initStar({
        //     score   : 3
        // });
        // $('.star4').initStar({
        //     score   : 4
        // })
        // $('.star5').initStar({
        //     score   : 5
        // });
        // $(".pagefy").eq(2).addClass("adcol");
        //     $(".pagefy").click(function(){
        //     $(this).addClass("adcol").siblings().removeClass("adcol")
        // })
        $(".active").addClass("adcol");
        $(".active").unbind();
    })

    </script><?php if(!isset($bottom_nav) || $bottom_nav !== false): ?><div class="fild"><div class="container"><div class="row d_floarig"><div class="col-sm-2 d_padi "><img src="<?php echo $img; ?>/baozhang.png" /><p>30天退换货保障</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/baoyou.png" /><p>购买满199包运费</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/fukuan.png" /><p>货到付款</p></div><div class="col-sm-2 d_padi flaorigt"><img src="<?php echo $img; ?>/kefu.png" /><p>售后无忧</p></div></div></div></div><div class="container list-style"><?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="ul2"><?php if(is_array($vo['name']) || $vo['name'] instanceof \think\Collection || $vo['name'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['name'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$name): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $name['href']; ?>"><?php echo $name['article_title']; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><?php endforeach; endif; else: echo "" ;endif; ?><div class="ul2"><img src="<?php echo getImg(config($logo='qr_code')); ?>" alt=""  class="qr_code" /></div></div><?php endif; ?><div class="container text"><p><?php echo $webInfo; ?></p><div class="bottom"><a href=""><img src="<?php echo $img; ?>/bottom.png" alt="" /></a></div></div><script type="text/javascript">        //收藏夹图标
        $(".shouc").hover(
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucangh.png")
            },
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucang.png")
            }
        );
    </script></body><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $js; ?>/shop.js"></script></html>