<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\users\add.html";i:1500431396;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1500431397;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><link href="<?php echo $web_static; ?>/plugins/citypicker/css/city-picker.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/cache/city.cache.js"></script><script src="<?php echo $web_static; ?>/plugins/citypicker/js/city-picker.js"></script><form class="form-horizontal js-ajax-form clearfix" action='<?php echo U('add'); ?>' method='post'><!-- 自定义大小 --><div class="form-group"><label for="account" class="col-sm-2 control-label">用户名</label><div class="col-sm-4"><input type="text" name="account" class="form-control" id="account" placeholder="用户名以字母开头，只允许字母、数字和下划线"></div></div><div class="form-group"><label for="nickname" class="col-sm-2 control-label">昵称</label><div class="col-sm-4"><input type="text" name="nickname" class="form-control" id="nickname" placeholder="用户昵称"></div></div><div class="form-group"><label for="Password" class="col-sm-2 control-label">密码</label><div class="col-sm-4"><input type="password" name="password" class="form-control" id="Password" placeholder="用户密码"></div></div><div class="form-group"><label for="phone" class="col-sm-2 control-label">手机</label><div class="col-sm-4"><input type="tel" name="phone" class="form-control" id="phone" placeholder="用户手机"></div></div><div class="form-group"><label for="email" class="col-sm-2 control-label">邮箱</label><div class="col-sm-4"><input type="email" name="email" class="form-control" id="email" placeholder="用户邮箱"></div></div><div class="form-group"><label for="" class="col-sm-2 control-label">性别</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="sex" value='1' class="mgr mgr-primary mgr-lg" ><span>男</span></label><label class="i-lab"><input type="radio" name="sex" value='2' class="mgr mgr-primary mgr-lg" ><span>女</span></label></div></div><div class="form-group"><label class="col-sm-2 control-label">选择城市</label><div class="col-sm-4"><input  class="form-control" readonly type="text" value="" name="citys" data-toggle="city-picker"></div></div><div class="form-group"><label for="" class="col-sm-2 control-label">状态</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary mgr-lg" checked><span>正常</span></label><label class="i-lab"><input type="radio" name="status" value='0' class="mgr mgr-primary mgr-lg" ><span>禁用</span></label></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-3"><button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-info">重置</button></div></div></form></div></div></body><!-- 全局js --><script src="<?php echo $web_static; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script><!-- 第三方插件，加载进度条 --><script src="<?php echo $web_static; ?>/plugins/pace/pace.min.js"></script><!-- layui --><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><!-- 自定义js --><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $web_static; ?>/js/vue.js"></script><script src="<?php echo $js; ?>/hplus.js?v=4.1.0"></script><script src="<?php echo $js; ?>/contabs.js"></script></html><style type="text/css">    .panel-heading{
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