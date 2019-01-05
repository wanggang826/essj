<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:64:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\users\index.html";i:1505272068;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1500431397;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><form role="form" action="<?php echo url('users/index'); ?>" class="panel-body hidden-xs form-inline"><div class="form-group"><input type="text" placeholder="用户名" id="ex1" class="form-control" name="account" value="<?php echo input('account'); ?>"></div><div class="form-group"><input type="text" placeholder="昵称" id="ex1" class="form-control" name="nickname" value="<?php echo input('nickname'); ?>"></div><div class="form-group"><input type="text" placeholder="手机" id="ex1" class="form-control" name="phone" value="<?php echo input('phone'); ?>"></div><div class="form-group"><input type="text" placeholder="邮箱" id="ex1" class="form-control" name="email" value="<?php echo input('email'); ?>"></div><div class="form-group pull-right"><div class="btn-group"><button class="btn btn-primary btn-outline btn-w-m btn-rec"><i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span></button><a href="<?php echo url(''); ?>" class="btn btn-default btn-outline btn-rec"><i class="fa fa-refresh"></i><span class="btn-desc">&nbsp;重置</span></a></div></div></form><div class="panel-footer clearfix "><div class="btn-group pull-left hidden-xs"><a href="<?php echo U('users/add'); ?>" class="btn btn-outline btn-default js-window-load"js-title="新增用户" js-unique="true"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
        </a><a href="<?php echo U('Users/del'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="删除后将无法恢复，请谨慎操作"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;删除
        </a></div><div class="pull-right"><?php echo $lists->render(); ?></div></div></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><th width='1'><input type="checkbox" class="my-all-check" name="input[]"></th><th width="50">ID</th><th>用户名</th><th class="hidden-xs">昵称</th><th width="50" class="hidden-xs">性别</th><th class="hidden-xs">手机</th><th class="hidden-xs">邮箱</th><th class="hidden-xs">会员地址</th><th width="160" class="hidden-xs">注册日期</th><th width="160" class="hidden-xs">最后登录时间</th><th>操作</th></tr></thead><tbody><?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td width='1'><input type="checkbox" class="i-checks" value="<?php echo $vo['user_id']; ?>" name="input[]"></td><td><?php echo $vo['user_id']; ?></td><td><?php echo $vo['account']; ?></td><td class="hidden-xs"><?php echo $vo['nickname']; ?></td><td class="hidden-xs"><?php switch($vo['sex']): case "1": ?>男<?php break; case "2": ?>女<?php break; default: ?>未知
                <?php endswitch; ?></td><td class="hidden-xs"><?php echo $vo['phone']; ?></td><td class="hidden-xs"><?php echo $vo['email']; ?></td><td><a href="<?php echo U('users/address_detail',['user_id'=>$vo['user_id'],'page'=>$nowpage]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="编辑--<?php echo $vo['account']; ?>"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">查看地址</span></a></td><td class="hidden-xs"><?php echo $vo['create_time']; ?></td><td class="hidden-xs"><?php echo date("Y-m-d H:i:s",$vo['last_login_time']); ?></td><td><span class="btn-group"><a href="<?php echo U('users/edit',['user_id'=>$vo['user_id'],'page'=>$nowpage]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="编辑--<?php echo $vo['account']; ?>"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">编辑</span></a><?php if($vo['status'] == 0): ?><a href="<?php echo U('users/status',['user_id'=>$vo['user_id'],'status'=>1]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="启用后该用户可以正常登录"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">启用</span></a><?php elseif($vo['status'] == 1): ?><a href="<?php echo U('users/status',['user_id'=>$vo['user_id'],'status'=>0]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="禁用后该用户将无法登录,请谨慎操作！"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">禁用</span></a><?php endif; ?><a href="<?php echo U('users/del',['id'=>$vo['user_id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table></div><script type="text/javascript">    function page_size(){
        $('.pagesize_form').submit();
    }
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