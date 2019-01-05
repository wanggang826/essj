<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\orders\do_back.html";i:1508480787;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1508488281;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><div class="panel-heading hidden-xs">条件搜索</div><form role="form" action="<?php echo url('orders/do_back'); ?>" class="form-inline panel-body hidden-xs"><div class="form-group"><label for="ex1" class="sr-only">退货单号</label><input type="text" placeholder="退货单号" id="ex1" class="form-control" name="back_no" value="<?php echo input('back_no'); ?>"></div><div class="form-group"><label for="ex1" class="sr-only">昵称</label><input type="text" placeholder="昵称" id="ex1" class="form-control" name="nickname" value="<?php echo input('nickname'); ?>"></div><div class="form-group"><label for="ex1" class="sr-only">手机号</label><input type="text" placeholder="手机号" id="ex1" class="form-control" name="tel" value="<?php echo input('tel'); ?>"></div><div class="form-group"><label for="ex3" class="sr-only">状态</label><select id="ex3" class="form-control"  name="status"><option value="">状态</option><option value="1" <?php if(input('status') ==1): ?>selected<?php endif; ?>>申请退货</option><option value="2" <?php if(input('status') ==2): ?>selected<?php endif; ?>>退货中</option><option value="3" <?php if(input('status') ==3): ?>selected<?php endif; ?>>拒绝退货</option><option value="4" <?php if(input('status') ==4): ?>selected<?php endif; ?>>退款</option></select></div><div class="form-group group1"><input type="text" name="statr_time" class="form-control i-datestart" id="date3" placeholder="退货开始日期" value="<?php echo input('statr_time'); ?>"></div><div class="form-group gruop2"><input type="text" name="end_time" class="form-control i-dateend" placeholder="退货结束日期" value="<?php echo input('end_time'); ?>"></div><div class="form-group pull-right"><div class="btn-group"><button class="btn btn-primary btn-outline btn-w-m btn-rec"><i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span></button><a href="<?php echo url(''); ?>" class="btn btn-default btn-outline btn-rec"><i class="fa fa-refresh"></i><span class="btn-desc">&nbsp;重置</span></a></div></div></form><div class="panel-footer clearfix "><div class="pull-left btn-group hidden-xs" ><a href="<?php echo url('orders/agree_back',array('status'=>2)); ?>" class="btn btn-default btn-outline del-all" text="确认同意退货"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;批量同意
            </a><a href="<?php echo url('orders/agree_back',array('status'=>3)); ?>" class="btn btn-danger btn-outline del-all" text="确认拒绝退货"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;批量拒绝
            </a><a href="<?php echo url('orders/back_moeny'); ?>" class="btn btn-default btn-outline del-all" text="确认退款"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;批量退款
            </a></div><div class="pull-right"><?php echo $lists->render(); ?></div></div></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><th width='1'><input type="checkbox" class="my-all-check" name="input[]"></th><th >订单号</th><th >退单号</th><th >物流单号</th><th >昵称</th><th >手机号</th><th >退货商品</th><th >价格</th><th >退货原因</th><th >状态</th><th >创建时间</th><th >操作</th></tr></thead><tbody><?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td width='1'><input type="checkbox" value="<?php echo $vo['id']; ?>" class="i-checks" name="input[]"></td><?php if(count($vo['order_info']) != 0): ?><td><?php echo $vo['order_info']['order_sn']; ?></td><td class=""><?php echo $vo['back_no']; ?></td><td><?php echo $vo['order_info']['waybill_sn']; ?></td><?php else: ?><td>--</td><td class=""><?php echo $vo['back_no']; ?></td><td>--</td><?php endif; if(count($vo['user_info']) != 0): ?><td><?php echo $vo['user_info']['nickname']; ?></td><td><?php echo $vo['user_info']['phone']; ?></td><?php else: ?><td>--</td><td>--</td><?php endif; if(count($vo['order_info1']) != 0): ?><td><?php echo $vo['order_info1']['goods_name']; ?></td><td><?php echo $vo['order_info1']['price']; ?></td><?php else: ?><td>--</td><td>--</td><?php endif; ?><td class=""><?php echo $vo['cause']; ?></td><td class=""><?php echo get_back_status($vo['status']); ?></td><td><?php echo $vo['create_time']; ?></td><td><?php if($vo['status'] == 1): ?><a href="<?php echo url('orders/agree_back',array('id'=>$vo['id'],'status'=>2)); ?>" class="btn btn-default btn-outline btn-xs js-del-btn" text="确认同意退货"><i class="fa fa fa-wrench fa-fw"></i><span class="hidden-xs">同意</span></a>&nbsp;
                    <a href="<?php echo url('orders/agree_back',array('id'=>$vo['id'],'status'=>3)); ?>" class="btn btn-danger btn-outline btn-xs js-del-btn" text="确认拒绝退货"><i class="fa fa fa-times fa-fw"></i><span class="hidden-xs">拒绝</span></a><?php elseif($vo['status'] == 2): ?><a href="<?php echo url('orders/back_moeny',array('id'=>$vo['id'])); ?>" class="btn btn-default btn-outline btn-xs js-del-btn" text="确认退款"><i class="fa fa fa-wrench fa-fw"></i><span class="hidden-xs">退款</span></a><?php endif; ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table><!-- <div class="cleanfix"><div class="pull-left pagination hidden-xs" ></div><div class="pull-left"></div></div> --></div></div></div></body><!-- 全局js --><script src="<?php echo $web_static; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script><!-- 第三方插件，加载进度条 --><script src="<?php echo $web_static; ?>/plugins/pace/pace.min.js"></script><!-- layui --><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><!-- 自定义js --><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $web_static; ?>/js/vue.js"></script><script src="<?php echo $js; ?>/hplus.js?v=4.1.0"></script><script src="<?php echo $js; ?>/contabs.js"></script></html><style type="text/css">    .panel-heading{
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