<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\index\main.html";i:1505724653;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1508488281;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default" style="margin-top: 40px;border: 0px; "><div class="table-responsive" ><table class="table " style="border: 0"><tbody><tr ><td align="center" style="border: 0px"><a href="<?php echo url('user/apply_list'); ?>"><div style="width: 220px;height: 160px;background-color: #33ccff;margin-top: 30px;margin-bottom:30px;border-radius: 10px;"><p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">会员总人数</p><p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $user_count; ?></p></div></a></td><td align="center" style="border: 0px"><a href="<?php echo url('user/index'); ?>"><div style="width: 220px;height: 160px;background-color: #ffcc66;border-radius: 10px;" ><p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">待发货金额</p><p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $total_price; ?></p></div></a></td><td align="center" style="border: 0px"><a href="<?php echo url('data/invest_list'); ?>"><div style="width: 220px;height: 160px;background-color: #009900;border-radius: 10px;" ><p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">待发货提醒</p><p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $order_count; ?></p></div></a></td><td align="center" style="border: 0px"><a href="<?php echo url('data/borrow_list'); ?>"><div style="width: 220px;height: 160px;background-color: #cc3333;border-radius: 10px;" ><p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">退货待处理笔数</p><p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $order_back_count; ?></p></div></a></td></tr></tbody></table></div></div><div class="panel panel-default" style="margin-top: 40px;padding-bottom:40px "><div class="panel" style="border-bottom: 1px solid #e7eaec;border-top: 1px solid #e7eaec"><p style="margin:10px;font-size: 14px;color: #1ab394;font-weight:bold">近一个月销售额统计</p></div><div class="table-responsive" ><p class="pull-right" style="margin:10px;padding:10px;font-weight:bold;font-size: 14px;">日期：<?php echo $date; ?></p><div style="height: 350px;margin-left:50px;margin-right:50px;margin-top:40px;margin-bottom: 30px;text-align: center;"><img src="__ROOT__/graph.png"></div></div></div></div></div></body><!-- 全局js --><script src="<?php echo $web_static; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script><!-- 第三方插件，加载进度条 --><script src="<?php echo $web_static; ?>/plugins/pace/pace.min.js"></script><!-- layui --><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><!-- 自定义js --><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $web_static; ?>/js/vue.js"></script><script src="<?php echo $js; ?>/hplus.js?v=4.1.0"></script><script src="<?php echo $js; ?>/contabs.js"></script></html><style type="text/css">    .panel-heading{
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