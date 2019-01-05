<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"D:\phpStudy\WWW\adminui/public\theme\admin\advers\adv_add.html";i:1500431396;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\layout.html";i:1500431397;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\static.html";i:1500431396;s:57:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><script src="<?php echo $web_static; ?>/js/uploadImg.js"></script><form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('advers/adv_add'); ?>" method='post' enctype=multipart/form-data><!-- 自定义大小 --><div class="form-group"><label for="adv_title" class="col-sm-2 control-label">广告标题</label><div class="col-sm-4"><input type="text" name="adv_title" class="form-control" id="adv_title" placeholder="广告标题"></div></div><div class="form-group"><label for="" class="col-sm-2 control-label">广告位置</label><div class="col-sm-4"><input type="hidden" name="adv_pos" value="<?php echo $advpos['advpos_id']; ?>"><input type="hidden" name="pos_type" value="<?php echo $advpos['advpos_type']; ?>"><p class="form-control-static"><?php echo $advpos['advpos_name']; ?></p></div></div><div class="form-group"><label for="adv_url" class="col-sm-2 control-label" >广告链接</label><div class="col-sm-4"><input type="text" name="adv_url" class="form-control" id="adv_url" placeholder="广告链接"></div></div><div class="form-group"><label for="menu_name" class="col-sm-2 control-label">广告图片</label><div class="img_cont col-sm-10"><div class="img_prev"></div><input type="file" name="adv_img" id="adv_img" /></div></div><div class="form-group"><label for="adv_price" class="col-sm-2 control-label">广告图片背景色</label><div class="col-sm-4"><input type="color" name="bg_color" class="form-control" id="bg_color"></div></div><div class="form-group"><label for="date2" class="col-sm-2 control-label">广告日期</label><div class="col-sm-3 form-inline col-md-4"><input type="text" name="start_time" class="form-control i-datestart" id="date2" placeholder="开始日期"><input type="text" name="end_time" class="form-control i-dateend" id="date2" placeholder="结束日期"></div></div><div class="form-group"><label for="adv_price" class="col-sm-2 control-label">总价格</label><div class="col-sm-4"><input type="text" name="adv_price" class="form-control" id="adv_price" placeholder="总价格"></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-3"><button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-info">重置</button></div></div></form><script type="text/javascript">    $('#adv_img').imgUpload({
        width:200,//预览宽度
        height:200,//预览高度
        imgWidth:<?php echo $advpos['advpos_width']; ?>,//图片上传宽度
        imgHeight:<?php echo $advpos['advpos_height']; ?>,//图片上传高度
        isCut:false,//是否裁剪
        maxSize: 10240,//允许上传最大值(KB)
        allowedNum:1,//允许上传最大数量
    });
</script></div></div></body><!-- 全局js --><script src="<?php echo $web_static; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script><!-- 第三方插件，加载进度条 --><script src="<?php echo $web_static; ?>/plugins/pace/pace.min.js"></script><!-- layui --><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><!-- 自定义js --><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $web_static; ?>/js/vue.js"></script><script src="<?php echo $js; ?>/hplus.js?v=4.1.0"></script><script src="<?php echo $js; ?>/contabs.js"></script></html><style type="text/css">    .panel-heading{
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