<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:65:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\shops\nav_index.html";i:1500431396;s:63:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\layout.html";i:1500431397;s:63:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\static.html";i:1500431396;s:59:"D:\phpStudy\WWW\PhoneShop/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><div class="panel-footer clearfix "><div class="btn-group pull-left hidden-xs"><a href="<?php echo U('nav_add'); ?>" class="btn btn-outline btn-default js-window-load"js-title="新增导航" js-unique="true"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a><a href="<?php echo U('nav_del'); ?>" class="btn btn-outline btn-default del-all" text="删除后将无法恢复，请谨慎操作"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;删除
            </a></div><div class="pull-right"></div></div></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"   id="cateTree" style="width:100%"><thead><tr><th width='1'><input type="checkbox" class="i-checks i-check-all" id="all" name="input[]"></th><th width="200" >导航名称</th><th width="200" class="hidden-xs">导航链接</th><th width="185" class="hidden-xs">导航类型</th><th width="185" >导航位置</th><th width="185"class="hidden-xs">打开方式</th><th width="185" class="hidden-xs">排序</th><th width="150" class="hidden-xs">是否隐藏</th><th width="220">操作</th></tr></thead><tbody id="list"><?php if(is_array($tree) || $tree instanceof \think\Collection || $tree instanceof \think\Paginator): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navs): $mod = ($i % 2 );++$i;?><tr id="<?php echo $navs['id']; ?>" <?php if($navs['pid'] != 0): ?>pId="<?php echo $navs['pid']; ?>"<?php endif; ?>><td width='1'><input type="checkbox" value="<?php echo $navs['id']; ?>" class="i-checks" name="input[]"></td><td controller="true"><?php echo $navs['name']; ?></td><td class="hidden-xs"><?php echo $navs['url']; ?></td><?php if($navs['url_type']  == 1): ?><td class="hidden-xs">内连接</td><?php elseif($navs['url_type'] == 2): ?><td class="hidden-xs">外链接</td><?php endif; if($navs['type']  == 1): ?><td >顶部</td><?php elseif($navs['type'] == 2): ?><td >底部</td><?php endif; if($navs['open_way'] == 1): ?><td class="hidden-xs">窗口打开</td><?php elseif($navs['open_way'] == 2): ?><td class="hidden-xs">跳转打开</td><?php endif; ?><td class="hidden-xs"><?php echo $navs['sort']; ?></td><?php if($navs['status'] == 1): ?><td class="hidden-xs"><a href="<?php echo U('nav_changeStatus',['id'=>$navs['id'],'status'=>0]); ?>"  js-color="#eea236" class="btn btn-danger btn-outline btn-xs js-del-btn" text="将不会在导航中显示" js-btn="<i class='fa fa-check fa-fw'></i>显示"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">隐藏</span></a></td><?php elseif($navs['status'] == 0): ?><td class="hidden-xs"><a href="<?php echo U('nav_changeStatus',['id'=>$navs['id'],'status'=>1]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="将会显示在导航中" js-btn="<i class='fa fa-times fa-fw'></i>隐藏"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">显示</span></a></td><?php endif; ?><td ><span class="btn-group"><?php if($navs['level'] < 1): ?><a href="<?php echo U('nav_add',['pid'=>$navs['id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" js-title="新增子菜单" js-unique="true"><i class="fa fa-plus fa-fw"></i><span class="hidden-xs">新增子项</span></a><?php else: ?><a href="javascript:;" class="btn btn-outline btn-default btn-xs disabled"><i class="fa fa-plus fa-fw"></i><span class="hidden-xs">新增子项</span></a><?php endif; ?><a href="<?php echo U('nav_edit',['id'=>$navs['id'] ,'pid'=>$navs['pid'],'page'=>$nowpage]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="编辑&#45;&#45;<?php echo $navs['name']; ?>"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">编辑</span></a><a href="<?php echo U('nav_del',['id'=>$navs['id'] ,'page'=>$nowpage]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table></div><link id="tree_table_default" href="<?php echo $web_static; ?>/plugins/treetable/default/jquery.treeTable.css" rel="stylesheet" type="text/css" /><script src="<?php echo $web_static; ?>/plugins/treetable/jquery.treeTable.js" type="text/javascript"></script><script type="text/javascript">    //提交分页size
   /* function page_size(){
        $('.pagesize_form').submit();
    }*/
    //全选/反选
    $("#all").click(function(){
        if(this.checked){
            $("#list :checkbox").prop("checked", true);
        }else{
            $("#list :checkbox").prop("checked", false);
        }
    });

    $(function(){
        var option = {
            theme:'default',
            column:1,
            expandLevel : 10,
            beforeExpand : function($treeTable, id) {},//展开过后动作
            onSelect : function($treeTable, id) {}//选中时操作
        };
        $('#cateTree').treeTable(option);
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