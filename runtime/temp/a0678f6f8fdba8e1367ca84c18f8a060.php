<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:64:"D:\phpStudy\WWW\adminui/public\theme\admin\mallconfig\index.html";i:1500431396;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\layout.html";i:1500431397;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\static.html";i:1500431396;s:57:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><script src="<?php echo $web_static; ?>/js/uploadImg.js"></script><div class="clearfix"><div class="col-sm-12 "><div class="tabs-container"><ul class="nav nav-tabs"><?php $_59ae4b6466100=config('mall_config_type'); if(is_array($_59ae4b6466100) || $_59ae4b6466100 instanceof \think\Collection || $_59ae4b6466100 instanceof \think\Paginator): if( count($_59ae4b6466100)==0 ) : echo "" ;else: foreach($_59ae4b6466100 as $i=>$val): ?><li class=""><a data-toggle="tab" href="#<?php echo $i; ?>" aria-expanded="true"><?php echo $val; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('Mallconfig/index'); ?>" method='post' enctype="multipart/form-data"><div class="tab-content"><?php $_59ae4b6465d18=config('mall_config_type'); if(is_array($_59ae4b6465d18) || $_59ae4b6465d18 instanceof \think\Collection || $_59ae4b6465d18 instanceof \think\Paginator): if( count($_59ae4b6465d18)==0 ) : echo "" ;else: foreach($_59ae4b6465d18 as $j=>$c_type): ?><div id="<?php echo $j; ?>" class="tab-pane"><div class="panel-body"><?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): if( count($configs)==0 ) : echo "" ;else: foreach($configs as $key=>$config): if($config['group'] == $j): if($config['type'] == 'file'): ?><div class="form-group imgUpload" js-img="<?php echo $config['id']; ?>" ><label  class="col-sm-2 control-label"><?php echo $config['config_name']; ?></label><div class="img_cont col-sm-4"><div class="img_prev"></div><input type="file" name="<?php echo $config['config_mark']; ?>" id="<?php echo $config['config_mark']; ?>" /></div><div class="col-sm-4"><?php echo $config['config_des']; ?></div><script>
                                                $("#<?php echo $config['config_mark']; ?>").imgUpload({
                                                    allowedNum:1,//允许上传最大数量
                                                    files:{1:"<?php echo getImg($config['config_value']); ?>",}
                                                })
                                            </script></div><?php else: ?><div class="form-group " ><label  class="col-sm-2 control-label"><?php echo $config['config_name']; ?></label><div class="col-sm-4"><?php if($config['type'] == 'select'): ?><select class="form-control"  name="<?php echo $config['id']; ?><?php echo $config['config_mark']; ?>"><?php if(is_array($config['type_value']) || $config['type_value'] instanceof \think\Collection || $config['type_value'] instanceof \think\Paginator): if( count($config['type_value'])==0 ) : echo "" ;else: foreach($config['type_value'] as $key=>$val): if($config['config_value'] == $val['value']): ?><option value="<?php echo $val['value']; ?>" selected="selected"><?php echo $val['value']; ?></option><?php else: ?><option value="<?php echo $val['value']; ?>" ><?php echo $val['value']; ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?></select><?php endif; if($config['type'] == 'textarea'): ?><textarea class="form-control" name="<?php echo $config['id']; ?><?php echo $config['config_mark']; ?>" id="" cols="53" rows="5"><?php echo $config['config_value']; ?></textarea><?php endif; if($config['type'] == 'checkbox'): if(is_array($config['type_value']) || $config['type_value'] instanceof \think\Collection || $config['type_value'] instanceof \think\Paginator): if( count($config['type_value'])==0 ) : echo "" ;else: foreach($config['type_value'] as $k=>$box): ?><label class="i-lab"><input  class="mgc mgc-primary"  type="checkbox" name="<?php echo $config['id']; ?><?php echo $config['config_mark']; ?>[<?php echo $k; ?>]" value="<?php echo $box['value']; ?>"
                                                                   <?php if(in_array($box['value'],(array)$config['config_value'])): ?> checked="checked"<?php endif; ?>><span><?php echo $box['value']; ?></span></label><?php endforeach; endif; else: echo "" ;endif; endif; if($config['type'] == 'radio'): if(is_array($config['type_value']) || $config['type_value'] instanceof \think\Collection || $config['type_value'] instanceof \think\Paginator): if( count($config['type_value'])==0 ) : echo "" ;else: foreach($config['type_value'] as $k=>$box): ?><label class="i-lab"><input class="mgr mgr-primary mgr-lg" type="radio" name="<?php echo $config['id']; ?><?php echo $config['config_mark']; ?>" value="<?php echo $box['value']; ?>" <?php if($config['config_value'] == $box['value']): ?>checked="checked"<?php endif; ?> class="mgr"><?php if($box['value'] == 0 and $config['id'] == 3): ?><span>关闭</span><?php elseif($box['value'] == 1 and $config['id'] == 3): ?><span>开启</span><?php else: ?><span><?php echo $box['value']; ?></span><?php endif; ?></label><?php endforeach; endif; else: echo "" ;endif; endif; if($config['type'] == 'text'): ?><input type="<?php echo $config['type']; ?>" class="form-control" name="<?php echo $config['id']; ?><?php echo $config['config_mark']; ?>"  id="<?php echo $config['config_mark']; ?>" value="<?php echo $config['config_value']; ?>"><?php endif; ?></div><div class="col-sm-4"><p class="form-control-static"><?php echo $config['config_des']; ?></p></div></div><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?></div></div><?php endforeach; endif; else: echo "" ;endif; ?></div><div class="panel-footer clearfix fixed"><div class="form-group"><label  class="col-sm-2 control-label"></label><div class="col-sm-4"><button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button><a href="<?php echo url(''); ?>" class="btn btn-info">重置</a></div></div></div></form></div></div></div><script type="text/javascript">
    $(function(){
        $('ul.nav.nav-tabs li').first().addClass('active');
        $('.tab-content .tab-pane').first().addClass('active')
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