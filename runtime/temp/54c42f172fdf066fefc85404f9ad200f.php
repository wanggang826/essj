<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\navigation\nav_edit.html";i:1500431396;s:63:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\layout.html";i:1500431397;s:63:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\static.html";i:1500431396;s:59:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('Navigation/nav_edit'); ?>"><input type="hidden" name="id" value="<?php echo $nao_info['id']; ?>"><div class="form-group"><label for="menu_name" class="col-sm-2 control-label">导航名称</label><div class="col-sm-4"><input type="text" name="name" class="form-control" id="name" placeholder="导航名称" value="<?php echo $nao_info['name']; ?>"></div></div><div class="form-group"><label for="sort" class="col-sm-2 control-label">状态</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary mgr-lg" <?php if($nao_info['status'] == 1): ?>checked<?php endif; ?>><span>显示</span></label><label class="i-lab"><input type="radio" name="status" value='0' class="mgr mgr-primary mgr-lg" <?php if($nao_info['status'] == 0): ?>checked<?php endif; ?>><span>隐藏</span></label></div></div><div class="form-group"><label for="type" class="col-sm-2 control-label">导航位置</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="type" id="type" value='1' class="mgr mgr-primary mgr-lg" <?php if($nao_info['type'] == 1): ?>checked<?php endif; ?>><span>顶部</span></label><label class="i-lab"><input type="radio" name="type" id="type" value='2' class="mgr mgr-primary mgr-lg" <?php if($nao_info['type'] == 2): ?>checked<?php endif; ?>><span>底部</span></label></div></div><div class="form-group"><label for="open_way" class="col-sm-2 control-label">打开方式</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="open_way" id="open_way" value='1' class="mgr mgr-primary mgr-lg" <?php if($nao_info['open_way'] == 1): ?>checked<?php endif; ?>><span>窗口</span></label><label class="i-lab"><input type="radio" name="open_way" id="open_way" value='2' class="mgr mgr-primary mgr-lg" <?php if($nao_info['open_way'] == 2): ?>checked<?php endif; ?>><span>跳转</span></label></div></div><div class="form-group"><label for="menu_des" class="col-sm-2 control-label">导航描述</label><div class="col-sm-4"><input type="text" name="des" class="form-control" id="menu_des" placeholder="导航描述" value="<?php echo $nao_info['des']; ?>"></div></div><div class="form-group"><label for="" class="col-sm-2 control-label">URL类型</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="url_type" value='1' text="内链接" class="mgr mgr-primary mgr-lg" <?php if($nao_info['url_type'] == 1): ?>checked<?php endif; ?>><span>内链接</span></label><label class="i-lab"><input type="radio" name="url_type" value='2' text="外链接" class="mgr mgr-primary mgr-lg" <?php if($nao_info['url_type'] == 2): ?>checked<?php endif; ?>  ><span>外链接</span></label></div></div><div class="form-group"><label for="sort" class="col-sm-2 control-label">排序</label><div class="col-sm-2"><input type="text" js-test="" name="sort" class="form-control" id="sort" placeholder="排序"><i id="sortwarning" style="color: red" value="<?php echo $nao_info['sort']; ?>"></i></div></div><div id="in"><div class="form-group"><label for="module" class="col-sm-2 control-label">模块</label><div class="col-sm-4"><input type="text" name="module" class="form-control" id="module" placeholder="" value="<?php echo $nao_info['module']; ?>"></div></div><div class="form-group"><label for="controller" class="col-sm-2 control-label" >控制器</label><div class="col-sm-4"><input type="text" name="controller" class="form-control" id="controller" placeholder="" value="<?php echo $nao_info['controller']; ?>"></div></div><div class="form-group"><label for="action" class="col-sm-2 control-label">方法</label><div class="col-sm-4"><input type="text" name="action" class="form-control" id="action" placeholder="" value="<?php echo $nao_info['action']; ?>"></div></div></div><div id="out"><div class="form-group"><label for="url" class="col-sm-2 control-label">链接地址</label><div class="col-sm-4"><input type="text" name="url" class="form-control" id="url" placeholder="" value="<?php echo $nao_info['url']; ?>"></div></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-4"><button type="submit" class="btn btn-primary js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-primary">重置</button></div></div></form><script type="text/javascript">    $(document).ready(function(){
        $('input[name="url_type"]').each(function(){
            if (this.checked) {
                $(this).val()==1 && $('#in').css('display','block') && $('#out').css('display','none');
                $(this).val()==2 && $('#in').css('display','none') && $('#out').css('display','block');
            }
        })
        $('input[name="url_type"]').click(function(){
            $(this).val()==1 && $('#in').css('display','block') && $('#out').css('display','none');
            $(this).val()==2 && $('#in').css('display','none') && $('#out').css('display','block');
        })
    })
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