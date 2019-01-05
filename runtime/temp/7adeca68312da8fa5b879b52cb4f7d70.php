<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\good\edit_attr.html";i:1507527232;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1500431397;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><form class="form-horizontal js-ajax-form clearfix" action='<?php echo U('edit_attr'); ?>' method='post'><!-- 自定义大小 --><input type="hidden" name="attr_id" value="<?php echo $attr_info['attr_id']; ?>"><input type="hidden" name="page" value="<?php echo $page; ?>"><div class="form-group"><label for="attr_name" class="col-sm-2 control-label">属性名称</label><div class="col-sm-4"><input type="text" name="attr_name" class="form-control" id="attr_name" placeholder="品牌名称长度为6-45个字符" value="<?php echo $attr_info['attr_name']; ?>"></div></div><div class="form-group"><label for="sort" class="col-sm-2 control-label">属性排序</label><div class="col-sm-3"><input type="text" name="sort" class="form-control" id="sort" placeholder="数字越小越靠前" value="<?php echo $attr_info['sort']; ?>"></div></div><div class="form-group"><label  class="col-sm-2 control-label">属性类型</label><div class="col-sm-4"><select class="form-control"  name="type" id="type"><?php if(is_array($input_type) || $input_type instanceof \think\Collection || $input_type instanceof \think\Paginator): $i = 0; $__LIST__ = $input_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo $type; ?>" <?php if($type ==$attr_info['type']): ?>selected<?php endif; ?>><?php echo $type; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><div id="value" class="form-group" ><label for="type_value" class="col-sm-2 control-label">属性值</label><div class="col-sm-2"><a href="#attr_type_input" class="btn btn-primary btn-m-w js-window-load">查看/编辑属性值</a></div></div><div class="form-group"><label for="" class="col-sm-2 control-label">状态</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary" checked><span>正常</span></label><label class="i-lab"><input type="radio" name="status" value='0' class="mgr mgr-primary" ><span>禁用</span></label></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-4"><button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-info">重置</button></div></div><div id="attr_type_input" class="display-none"><table class="table table-hover table-bordered table-condensed"><thead><tr><th colspan="3">关闭该窗口自动保存</th></tr></thead><?php if($attr_info['value'] != ''): if(is_array($attr_info['value']) || $attr_info['value'] instanceof \think\Collection || $attr_info['value'] instanceof \think\Paginator): if( count($attr_info['value'])==0 ) : echo "" ;else: foreach($attr_info['value'] as $k=>$attr): ?><tr><td><input type="text" name="type_val[<?php echo $k; ?>]" class="form-control" value="<?php echo $attr['value']; ?>" placeholder="属性值"></td><td><?php if($k == 0): ?><a href="" class="btn btn-danger add_type"><i class="fa fa-plus"></i></a><?php else: ?><a href="" class="btn btn-default close_type"><i class="fa fa-minus"></i></a><?php endif; ?></td></tr><?php endforeach; endif; else: echo "" ;endif; else: ?><tr><td><input type="text" name="type_val[0]" class="form-control" value=""></td><td><a href="" class="btn btn-danger add_type"><i class="fa fa-plus"></i></a></td></tr><?php endif; ?></table></div></form><script>    $(document).ready(function(){
        var type_val = $("#type").val();
        if(type_val == 'checkbox'|| type_val == 'select' ||type_val == 'radio'){
            $("#value").css('display','block');
        }else{
            $("#value").css('display','none');
        }
    })
    $('select[name="type"]').click(function(){
       var type_val = $(this).val();
       if(type_val == 'checkbox'|| type_val == 'select' ||type_val == 'radio'){
           $("#value").css('display','block');
        }else{
           $('.close_type').parents('tr').remove();
           $('input[name^="type_"]').val('');
           $("#value").css('display','none');
       }
    })
    var num  = $('input[name^="type_val"]').length;
    $(document).on('click','.add_type',function(){
        num++;
        var html = '<tr><td><input type="text" name="type_val['+num+']" class="form-control" placeholder="属性值"></td>'
                 + '<td><a href="" class="btn btn-default close_type"><i class="fa fa-minus"></i></a></td></tr>'
        $(this).parents('table').append(html)
        return false;
    })
    $(document).on('click','.close_type',function(){
        $(this).parents('tr').remove();
        return false;
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