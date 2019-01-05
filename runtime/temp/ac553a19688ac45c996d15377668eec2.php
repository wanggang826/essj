<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:83:"D:\phpStudy\WWW\adminui/public\theme\shop\default\seller_center\release_good_1.html";i:1500431395;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:79:"D:\phpStudy\WWW\adminui/public\theme\shop\default\seller_center\seller_bar.html";i:1500431395;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><link rel="stylesheet" href="<?php echo $css; ?>/usernew.css"><link rel="stylesheet" href="<?php echo $static; ?>icon/iconfont.css"><div class="h_concent"><div class="position"><p>您的位置：</p><a href="">首页 ></a><p>卖家中心 ></p><p>发布商品</p></div><div class="indent_fl"><div class="h_sidebar"><div class="sidebar_centre"><ul><div class="h_square"><img src="<?php echo $img; ?>/dian.png" class="ceimg"/><span>全部功能</span></div><li><a href="<?php echo urldo('seller_center/basic_settings'); ?>">店铺基本信息</a></li><li><a href="<?php echo urldo('seller_center/cash'); ?>">我的钱包</a></li><li><a href="<?php echo urldo('seller_center/s_good_mgr'); ?>">商品管理</a></li><li><a href="<?php echo urldo('seller_center/release_good'); ?>" >发布商品</a></li><li><a href="<?php echo urldo('seller_center/in_application'); ?>">资质认证</a></li><li><a href="">店铺经营许可证</a></li><li><a href="<?php echo urldo('seller_center/logistics'); ?>">物流管理</a></li><li><a href="<?php echo urldo('seller_center/deliver'); ?>">发货</a></li><li><a href="<?php echo urldo('seller_center/manage'); ?>">评价管理</a></li><li><a href="<?php echo urldo('seller_center/s_order'); ?>">订单列表</a></li><li><a href="<?php echo urldo('seller_center/s_nav'); ?>">分类菜单设置</a></li><div class="h_borde"></div></ul></div><script type="text/javascript">
    var url = window.location.href;
    var $a  = $('.sidebar_centre ul li').find('a');
    $a.parent().removeClass('sidebar_lired');
    $a.removeClass('sidebar_red');
    $a.each(function() {
        if($(this).attr('href') == url){
            $(this).addClass('sidebar_red');
        }
    });
</script></div></div><div class="indent_rirgt_basic clearfloat"><div class="indent_rirgt_delive"><input type="text" placeholder="搜索关键词" class="indent_rirgt_delive_input" id="cate1"><div class="indent_rirgt_delive_addddddd" id="cate_id1"><?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="cate_item" data-id="<?php echo $vo['cate_id']; ?>"><?php echo $vo['name']; ?><i class="icon i-xiayibu"></i></p><?php endforeach; endif; else: echo "" ;endif; ?></div></div><div class="indent_rirgt_delive" ><input type="text" placeholder="搜索关键词" class="indent_rirgt_delive_input cate_id2" id="cate2"><div class="indent_rirgt_delive_addddddd" id="cate_id2"><p>----选择一级分类----</p></div></div><div class="indent_rirgt_delive"><input type="text" placeholder="搜索关键词" class="indent_rirgt_delive_input cate_id3" id="cate3"><div class="indent_rirgt_delive_addddddd" id="cate_id3"><p>----选择二级分类----</p></div></div><div class="indent_rirgt_delive_fa"><a href="javascript:void(0);" class="indent_rirgt_delive_faa" onclick="submit_form()">确定商品类型，发布商品</a></div></div></div><script>    $(".hui").click(function () {
        $(".hei").removeClass("adddis")
        $(this).children(".hei").addClass("adddis")

    })

    $(document).on('click','.indent_rirgt_delive p',function () {
        var  phtml     = $(this).text(),
             _this_id  = $(this).data('id'),
             cate_type = $(this).parent('.indent_rirgt_delive_addddddd').attr('id');
        $(this).parents(".indent_rirgt_delive").children(".indent_rirgt_delive_input").val(phtml).data('id',_this_id);
        if (!$(this).hasClass('sidebar_red') && cate_type != 'cate_id3') {
            $.ajax({
                url:"<?php echo url('SellerCenter/ajax_get_cate'); ?>",
                data:{cate_id:_this_id},
                type:"post",
                dataType:"json",
                success:function(msg){
                    var html = "";
                    for (var i = msg.length - 1; i >= 0; i--) {
                       html  += '<p class="cate_item" data-id="'+msg[i].cate_id+'">'+msg[i].name+'<i class="icon i-xiayibu"></i></p>'
                    }
                    if(cate_type == "cate_id1"){
                        $("#cate_id2").empty()
                        $("#cate_id3").empty()
                        $("#cate2").val('').data('id',null);
                        $("#cate3").val('').data('id',null);
                        $("#cate3").val('');
                        $(html).appendTo($("#cate_id2"))
                    }else if(cate_type == "cate_id2"){
                        $("#cate_id3").empty()
                        $("#cate3").val('').data('id',null);
                        $(html).appendTo($("#cate_id3"))
                    }
                },
                error:function(msg){
                    alert(22)
                }
            })
        }
    })

    function submit_form(){
        var cate_id1 = $("#cate1").data('id'),
            cate_id2 = $("#cate2").data('id'),
            cate_id3 = $("#cate3").data('id');
        $('#cate_form').remove();
        var form = '<form method="post" id="cate_form" style="display:none;">'
                 + '<input name="step" value="2">'
                 + '<input name="cate1" value="'+cate_id1+'">'
                 + '<input name="cate2" value="'+cate_id2+'">'
                 + '<input name="cate3" value="'+cate_id3+'">'
                 + '</form>';
        if (cate_id3) {
            $('.h_concent').append(form);
            $('#cate_form').submit();
        } else{
            layer.alert('请选择商品分类');
        }
    }
</script><script type="text/javascript">$(document).on('input', '.indent_rirgt_delive_input', function() {
    var inputText  = $.trim($(this).val()),
        pTag       = $(this).parents('.indent_rirgt_delive').find('p');
    if (inputText.length>0) {
        pTag.css('display', 'none');
    } else {
        pTag.css('display', 'block');
    }
    for (var i = pTag.length - 1; i >= 0; i--) {
        if ($(pTag[i]).text().indexOf(inputText) > -1) {
            $(pTag[i]).css('display', 'block');
        }
    }
});
$(document).on('click', '.cate_item', function() {
    $(this).parents('.indent_rirgt_delive').find('p').css('display', 'block').removeClass('sidebar_red')
    $(this).addClass('sidebar_red');
});
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