<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\phpStudy\WWW\adminui/public\theme\admin\article_cates\index.html";i:1500431396;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\layout.html";i:1500431397;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\static.html";i:1500431396;s:57:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><div class="panel-footer clearfix "><div class="btn-group pull-left hidden-xs"><a href="<?php echo U('ArticleCates/articleCate_add'); ?>" class="btn btn-outline btn-default js-window-load" js-title="新增分类" js-unique="true"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a><a href="<?php echo U('ArticleCates/articleCate_del'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="删除后将无法恢复，请谨慎操作"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;删除
            </a></div></div></div><div class="table-responsive"><table id="cateTree"  class="table table-hover table-bordered table-condensed" style="width:100%"><thead><tr><th width='1'><input type="checkbox" class="my-all-check" name="input[]"></th><th>分类名称</th><th>分类类型</th><th class="hidden-xs">创建时间</th><th width="270">操作</th></tr></thead><tbody><?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo $vo['cate_id']; ?>" <?php if($vo['pid'] != 0): ?>pId="<?php echo $vo['pid']; ?>"<?php endif; ?>><td><input type="checkbox" class="i-checks" name="input[]" value="<?php echo $vo['cate_id']; ?>"></td><td controller="true"><i title="" class="fa fa-fw fa-lg"></i>&nbsp;<input type="text" name="cate_name" value="<?php echo $vo['cate_name']; ?>" class="cate-name" id="<?php echo $vo['cate_id']; ?>" ></td><td><?php echo $vo['cate_type']; ?></td><td><?php echo $vo['create_time']; ?></td><td><span class="btn-group"><?php if($vo['level'] < 1): ?><a href="<?php echo U('ArticleCates/articleCate_add',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" js-title="新增子菜单" js-unique="true"><i class="fa fa-plus fa-fw"></i><span class="hidden-xs">新增子项</span></a><?php else: ?><a href="javascript:;" class="btn btn-outline btn-default btn-xs disabled"><i class="fa fa-plus fa-fw"></i><span class="hidden-xs">新增子项</span></a><?php endif; if($vo['status'] == 0): ?><a href="<?php echo U('ArticleCates/articleCate_status',['cate_id'=>$vo['cate_id'],'status'=>1]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="启用后该分类名称可以正常展示"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">启用</span></a><?php elseif($vo['status'] == 1): ?><a href="<?php echo U('ArticleCates/articleCate_status',['cate_id'=>$vo['cate_id'],'status'=>0]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="禁用后该该分类名称将无法展示！"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">禁用</span></a><?php endif; ?><a href="<?php echo U('ArticleCates/articleCate_edit',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" title="编辑：<?php echo $vo['cate_name']; ?>" js-unique="true" ><i class="fa fa-edit fa-fw" ></i><span class="hidden-xs">编辑</span></a><a href="<?php echo U('ArticleCates/articleCate_del',['id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-danger btn-xs js-del-btn" text="删除：<?php echo $vo['cate_name']; ?>，将同时删除子菜单！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table></div><link id="tree_table_default" href="<?php echo $web_static; ?>/plugins/treetable/default/jquery.treeTable.css" rel="stylesheet" type="text/css" /><script src="<?php echo $web_static; ?>/plugins/treetable/jquery.treeTable.js" type="text/javascript"></script><script type="text/javascript">    $(function(){
        var option = {
            theme:'default',
            column:1,
            expandLevel : 10,
            beforeExpand : function($treeTable, id) {},//展开过后动作
            onSelect : function($treeTable, id) {}//选中时操作
        };
        $('#cateTree').treeTable(option);
    });
    $("input[type='text']").change(function(){
        var field    =$(this).attr('name');
        var value    =$(this).val();
        var cate_id  =$(this).attr('id');
        $.ajax({
            url:"<?php echo U('ArticleCates/edit_field'); ?>",
            data:{value:value,field:field,cate_id:cate_id},
            type:"post",
            dataType:"json",
            beforeSend:function(){
                layer.load(2,{shade:0.2});
            },
            complete:function(){
                layer.closeAll();
                layer.msg('已经修改',{time:2000,shade:0.2});
            }
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