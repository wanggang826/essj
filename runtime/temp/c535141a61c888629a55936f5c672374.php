<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\orders\order_detail.html";i:1505293312;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1500431397;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><div class="panel" style="border-bottom: 1px solid #e7eaec"><p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">基本信息</p></div><form role="form" action="<?php echo url('user/index'); ?>" class="form-inline panel-body"><div class="form-group"><p class="form-control" style="width: 260px;">订单号:<?php echo $info['order_sn']; ?></p></div><div class="form-group"><p class="form-control" style="width: 260px;">下单时间：<?php echo $info['create_time']; ?></p></div><div class="form-group"><p class="form-control" style="width: 260px;">订单状态：<?php echo $info['status_name']; ?></p></div><div class="form-group"><p class="form-control" style="width: 250px;">支付方式：<?php echo $info['paytype']; ?></p></div></form></div><div class="panel panel-default" style="margin-top: 40px;: "><div class="panel" style="border-bottom: 1px solid #e7eaec"><p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">商品信息</p></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><th >商品名称</th><th >商品图片</th><th >数量</th><th >金额</th></tr></thead><tbody><tr><td><?php echo $info['order_info']['goods_name']; ?></td><td><?php if($info['order_info']['good_image'] != ''): ?><img src="<?php echo $web_public; ?>upload/<?php echo $info['order_info']['good_image']; ?>" width="170" height="140"><?php else: ?><img src="<?php echo $static_path; ?>img/default1.png" width="170" height="140"/><?php endif; ?></td><td><?php echo $info['order_info']['goods_count']; ?></td><td><?php echo $info['order_info']['total_price']; ?></td></tr></tbody></table></div></div><div class="panel panel-default" style="margin-top: 40px;: "><div class="panel" style="border-bottom: 1px solid #e7eaec"><p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">收件人信息</p></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><th >收货人</th><th >联系电话</th><th >收货地址</th></tr></thead><tbody><tr><td><?php echo $info['user_name']; ?></td><td><?php echo $info['user_phone']; ?></td><td><?php echo $info['province']; ?><?php echo $info['city_name']; ?><?php echo $info['area_name']; ?><?php echo $info['address']; ?></td></tr></tbody></table></div></div></div></div></body><!-- 全局js --><script src="<?php echo $web_static; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script><!-- 第三方插件，加载进度条 --><script src="<?php echo $web_static; ?>/plugins/pace/pace.min.js"></script><!-- layui --><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><!-- 自定义js --><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $web_static; ?>/js/vue.js"></script><script src="<?php echo $js; ?>/hplus.js?v=4.1.0"></script><script src="<?php echo $js; ?>/contabs.js"></script></html><style type="text/css">    .panel-heading{
        display: none;
    }
    .panel-footer{
        background-color: #fff;
        border: none
    }
    .panel-body.form-inline .form-group{
        margin-right: 10px!important;
        margin-bottom: 10px!important;

    }
    .panel-body.form-inline .form-group .form-control{
        width: 200px;
    }
    .panel-body.form-inline .form-group.group1 .form-control,
    .panel-body.form-inline .form-group.group2 .form-control
    {
        width: 205px;
    }
    .panel-body.form-inline{
        padding-bottom: 0;
    }
    .panel-body.form-inline .form-group.pull-right {
        margin: 0!important;
    }
    .panel-body.form-inline .form-group.group1{
        margin-right: 0px!important;
    }
</style><script type="text/javascript">    // 页面初始化
    $(function(){
        $('a').click(function(){
            $(this).blur();
        })
        $('.city-picker-span').css('width', '');
    })

</script>