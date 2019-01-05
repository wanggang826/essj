<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\orders\index.html";i:1500431396;s:63:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\layout.html";i:1500431397;s:63:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\static.html";i:1500431396;s:59:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><form role="form" action="<?php echo U('Orders/index'); ?>" class="panel-body hidden-xs form-inline"><div class="form-group"><input type="text" name="order_sn" class="form-control" id="order_sn" placeholder="订单编号" value="<?php echo input('order_sn'); ?>"></div><div class="form-group"><input type="text" name="user_id" class="form-control" id="user_id" placeholder="买家账号" value="<?php echo input('user_id'); ?>"></div><div class="form-group group1"><input type="text" name="datestart" class="form-control i-datestart" id="date3" placeholder="开始时间"  value="<?php echo input('datestart'); ?>"></div><div class="form-group group2"><input type="text" name="dateend" class="form-control i-dateend" id="date3" placeholder="结束时间" value="<?php echo input('dateend'); ?>"></div><div class="form-group"><select   class="form-control"  name="status"><option value="">-- 状态 --</option><?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo $type['id']; ?>" <?php if(input('status') ==$type['id']): ?>selected<?php endif; ?>><?php echo $type['name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div><div class="form-group pull-right"><div class="btn-group"><button class="btn btn-primary btn-outline btn-w-m btn-rec"><i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span></button><a href="<?php echo url(''); ?>" class="btn btn-default btn-outline btn-rec"><i class="fa fa-refresh"></i><span class="btn-desc">&nbsp;重置</span></a></div></div></form><div class="panel-footer clearfix "><div class="btn-group pull-left hidden-xs"><a href="<?php echo U('Orders/del'); ?>" class="btn btn-outline btn-default del-all" text="删除后将无法恢复，请谨慎操作"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;删除
            </a></div><div class="pull-right"><?php echo $orders->render(); ?></div></div></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><th width='1'><input type="checkbox" class="i-checks i-check-all my-all-check" id="all" name="input[]"></th><th width="200">订单编号</th><th width="150" class="hidden-xs">下单时间</th><th width="150" class="hidden-xs">买家账号</th><th width="100" class="hidden-xs">省</th><th width="100" class="hidden-xs">市</th><th width="100" class="hidden-xs">区</th><th width="100" class="hidden-xs">状态</th><th width="150">操作</th></tr></thead><tbody id="list"><?php if(is_array($orders) || $orders instanceof \think\Collection || $orders instanceof \think\Paginator): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr><td width='1'><input type="checkbox" class="i-checks" name="input[]" value="<?php echo $order['order_id']; ?>"></td><td><?php echo $order['order_sn']; ?></td><td class="hidden-xs"><?php echo $order['create_time']; ?></td><td class="hidden-xs"><?php echo $order['user_id']; ?></td><td class="hidden-xs"><?php echo $order['province']; ?></td><td class="hidden-xs"><?php echo $order['city']; ?></td><td class="hidden-xs"><?php echo $order['area']; ?></td><td class="hidden-xs"><?php echo $order['status']; ?></td><td ><span class="btn-group"><a href="<?php echo U('Orders/edit',['order_sn'=>$order['order_sn']]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="详情--<?php echo $order['serial_sn']; ?>"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">详情</span></a><a href="<?php echo U('Orders/del',['id'=>$order['order_id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table></div><link id="tree_table_default" href="<?php echo $web_static; ?>/plugins/treetable/default/jquery.treeTable.css" rel="stylesheet" type="text/css" /><script src="<?php echo $web_static; ?>/plugins/treetable/jquery.treeTable.js" type="text/javascript"></script><script type="text/javascript">    //提交分页size
    function page_size(){
        $('.pagesize_form').submit();
    }
    //全选/反选
    $("#all").click(function(){
        if(this.checked){
            $("#list :checkbox").prop("checked", true);
        }else{
            $("#list :checkbox").prop("checked", false);
        }
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