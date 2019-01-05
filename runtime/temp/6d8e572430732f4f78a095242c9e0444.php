<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\good\cate_index.html";i:1500431396;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1500431397;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="table-responsive"><div class="btn-group pull-left hidden-xs"><a href="<?php echo U('add_cate'); ?>" class="btn btn-outline btn-default js-window-load" js-title="新增" js-unique="true" js-width="45%" js-height="70%"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
        </a><!-- <a href="<?php echo U('del_cate'); ?>" class="btn btn-outline btn-default del-all" text="删除后将无法恢复，请谨慎操作"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;删除
        </a> --></div><div class="pull-right col-sm-3 search"></div><table id="cateTree"  class="table table-hover table-bordered table-condensed" style="width:100%"><thead><tr><th js-order='name' class="js-order">类别名称</th><th class="hidden-xs">排序</th><th class="hidden-xs" width="120">类别banner</th><th class="hidden-xs">状态&nbsp;<i class="fa fa-hand-pointer-o"></i></th><th class="hidden-xs" width="100">是否首页显示</i></th><th  width="400">操作</th></tr></thead><!--  <tbody><?php if(is_array($tree) || $tree instanceof \think\Collection || $tree instanceof \think\Paginator): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo $vo['cate_id']; ?>"<?php if($vo['pid'] != 0): ?>pId="<?php echo $vo['pid']; ?>"<?php endif; ?>><td><input type="checkbox" class="i-checks" name="input[]" value="<?php echo $vo['cate_id']; ?>"></td><td controller="true"><i title="" class="fa fa-fw fa-lg"></i>&nbsp;<input type="text" name="name" value="<?php echo $vo['name']; ?>" class="cate-name" id="<?php echo $vo['cate_id']; ?>" style=""></td><td class="hidden-xs"><input type="text" name="sort" value="<?php echo $vo['sort']; ?>" style="width: 30px;text-align: center;" id="<?php echo $vo['cate_id']; ?>"></td><td class="hidden-xs"><a href="<?php echo U('addBanner',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" title="banner新增：<?php echo $vo['name']; ?>" js-unique="true" ><i class="fa fa-edit fa-fw" ></i><span class="hidden-xs">新增</span></a><a href="<?php echo U('cateBanner',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" title="banner详情：<?php echo $vo['name']; ?>" js-unique="true" ><i class="fa fa-edit fa-fw" ></i><span class="hidden-xs">详情</span></a></td><td class="hidden-xs"><?php if($vo['status'] == 0): ?><a href="<?php echo U('changeStatus_cate',['cate_id'=>$vo['cate_id'],'status'=>1]); ?>" js-color="#eea236" class="btn btn-danger btn-outline btn-xs js-del-btn" text="启用后分类可用" js-btn="<i class='fa fa-check fa-fw'></i>启用"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">禁用</span></a><?php elseif($vo['status'] == 1): ?><a href="<?php echo U('changeStatus_cate',['cate_id'=>$vo['cate_id'],'status'=>0]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="禁用后分类不可用" js-btn="<i class='fa fa-times fa-fw'></i>禁用"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">启用
                        </span></a><?php endif; ?></td><td class="hidden-xs"><?php if($vo['is_show'] == 0): ?><a href="<?php echo U('isShow',['cate_id'=>$vo['cate_id'],'is_show'=>1]); ?>" js-color="#eea236" class="btn btn-danger btn-outline btn-xs js-del-btn" text="显示后平台页面商品分类单独显示" js-btn="<i class='fa fa-check fa-fw'></i>显示"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">隐藏</span></a><?php elseif($vo['is_show'] == 1): ?><a href="<?php echo U('isShow',['cate_id'=>$vo['cate_id'],'is_show'=>0]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="隐藏后平台页面商品分类不会单独显示" js-btn="<i class='fa fa-times fa-fw'></i>隐藏"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">显示</span></a><?php endif; ?></td><td><span class="btn-group"><?php if($vo['level'] < 2): ?><a href="<?php echo U('add_cate',['pid'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" js-title="新增子菜单" js-unique="true"><i class="fa fa-plus fa-fw"></i><span class="hidden-xs">新增子项</span></a><?php else: ?><a href="javascript:;" class="btn btn-outline btn-default btn-xs disabled"><i class="fa fa-plus fa-fw"></i><span class="hidden-xs">新增子项</span></a><?php endif; ?><a href="<?php echo U('setAttr',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" title="设置属性：<?php echo $vo['name']; ?>" js-unique="true" ><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">设置属性</span></a><a href="<?php echo U('setBrand',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" title="设置品牌：<?php echo $vo['name']; ?>" js-unique="true"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">设置品牌</span></a><a href="<?php echo U('edit_cate',['cate_id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-default btn-xs js-window-load" title="编辑：<?php echo $vo['name']; ?>" js-unique="true" ><i class="fa fa-edit fa-fw" ></i><span class="hidden-xs">编辑</span></a><a href="<?php echo U('del_cate',['id'=>$vo['cate_id']]); ?>" class="btn btn-outline btn-danger btn-xs js-del-btn" text="删除：<?php echo $vo['name']; ?>，将同时删除子菜单！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?> --></tbody></table><ul id="goodCate" class="ztree"></ul><div class="cleanfix"><div class="pull-left"></div></div></div><link rel="stylesheet" type="text/css" href="<?php echo $web_static; ?>/plugins/ztree/goodcate.css"/><link id="tree_table_default" href="<?php echo $web_static; ?>/plugins/treetable/default/jquery.treeTable.css" rel="stylesheet" type="text/css" /><script src="<?php echo $web_static; ?>/plugins/treetable/jquery.treeTable.js" type="text/javascript"></script><script src="<?php echo $web_static; ?>/plugins/ztree/jquery.ztree.all.min.js" type="text/javascript"></script><script type="text/javascript">// $(function(){
//     var option = {
//         theme:'default',
//         column:1,
//         expandLevel : 1,
//         beforeExpand : function($treeTable, id) {},//展开过后动作
//         onSelect : function($treeTable, id) {}//选中时操作
//     };
//     $('#cateTree').treeTable(option);
// });
$(document).on('change',"input[type='text']",function(){
    var field    =$(this).attr('name');
    var value    =$(this).val();
    var cate_id  =$(this).attr('id');
    console.log(cate_id);
    $.ajax({
        url:"<?php echo url('edit_field'); ?>",
        data:{value:value,field:field,cate_id:cate_id},
        type:"post",
        dataType:"json",
        beforeSend:function(){
                layer.load(2,{shade:0.2});
        },
        success:function(msg){
            console.log(msg)
        },
        complete:function(){
            layer.closeAll();
            layer.msg('已经修改',{time:2000,shade:0.2});
        }
    })
})
</script><script>    var zTreeNodes;
    var setting = {
        view: {
            showLine: false,
            showIcon: false,
            addDiyDom: addDiyDom,
            dblClickExpand:false,
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "cate_id",
                pIdKey: "pid",
                rootPId: 0
            }
        },
        callback: {
            onClick: onClick
        }
    };

    /**
     * 自定义DOM节点
     */
    function addDiyDom(treeId, treeNode) {
        console.log(treeNode)
        var aObj = $("#" + treeNode.tId+ '_a');
        if ($("#diyBtn_"+treeNode.id).length>0) return;
        var sortSpan    = "<span style='width: 50px;' id='sort_span_" +treeNode.cate_id+ "' >"
                        + '<input style="text-align: center;" type="text" name="sort" value="'+treeNode.sort+'" id="'+treeNode.cate_id+'">'
                        + '</span>',
            bannerSpan  = '<span style="width: 200px;" id="banner_span_' +treeNode.cate_id+ '">'
                        + '<button data-href="<?php echo urldo("addBanner"); ?>?cate_id='+treeNode.cate_id+'"class="btn btn-outline btn-default btn-xs js-window-load" title="banner新增：'+treeNode.name+'" js-unique="true" ><i class="fa fa-edit fa-fw"></i>新增</button><button data-href="<?php echo urldo("cateBanner"); ?>?cate_id='+treeNode.cate_id+'" class="btn btn-outline btn-default btn-xs js-window-load" title="banner详情：'+treeNode.name+'"js-unique="true" ><i class="fa fa-edit fa-fw" ></i>详情</button>'
                        + '</span>',
            statusSpan  = '<span style="width: 80px;" id="status_span_' +treeNode.cate_id+ '">'
            if(treeNode.status == 0){
                statusSpan  += '<button data-href="<?php echo urldo("changeStatus_cate"); ?>?cate_id='+treeNode.cate_id+'&status=1" js-color="#eea236" class="btn btn-danger btn-outline btn-xs js-del-btn" text="启用后分类可用" js-btn="'+"<i class='fa fa-check fa-fw'></i>启用'"+' "><i class="fa fa-times fa-fw"></i>禁用</button>'
            }else{
                statusSpan  += '<button data-href="<?php echo urldo("changeStatus_cate"); ?>?cate_id='+treeNode.cate_id+'&status= 0" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="禁用后分类不可用" js-btn="'+"<i class='fa fa-times fa-fw'></i>禁用'"+' "><i class="fa fa-check fa-fw"></i>启用</button>'
            } 
            statusSpan  += '</span>',
            indexSpan   = '<span style="width: 100px;" id="status_span_' +treeNode.cate_id+ '">'
            if(treeNode.is_show == 0){
                indexSpan   += '<button data-href="<?php echo urldo("isShow"); ?>?cate_id='+treeNode.cate_id+'&is_show=1" js-color="#eea236" class="btn btn-danger btn-outline btn-xs js-del-btn" text="显示后平台页面商品分类单独显示" js-btn="'+"<i class='fa fa-check fa-fw'></i>显示'"+' "><i class="fa fa-times fa-fw"></i>隐藏</button>'
            }else{
                indexSpan   += '<button data-href="<?php echo urldo("isShow"); ?>?cate_id='+treeNode.cate_id+'&is_show=0" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="隐藏后平台页面商品分类不会单独显示" js-btn="'+"<i class='fa fa-times fa-fw'></i>隐藏'"+' "><i class="fa fa-check fa-fw"></i>显示</button>'
            }        
            indexSpan       += '</span>',
            opSpan      = '<span style="width: 400px;" id="op_span_' +treeNode.cate_id+ '">'
            if(treeNode.level < 2){
                opSpan      += '<button data-href="<?php echo urldo("add_cate"); ?>?pid='+treeNode.cate_id+'" class="btn btn-outline btn-default btn-xs js-window-load" js-title="新增子菜单" js-unique="true"><i class="fa fa-plus fa-fw"></i>新增子项</button>'
            }else{
                opSpan      += '<button  class="btn btn-outline btn-default btn-xs disabled"><i class="fa fa-plus fa-fw"></i>新增子项</button>'
            }
            opSpan          += '<button data-href="<?php echo urldo("setAttr"); ?>?cate_id='+treeNode.cate_id+'" class="btn btn-outline btn-default btn-xs js-window-load" title="设置属性：'+treeNode.name+'" js-unique="true" ><i class="fa fa-edit fa-fw"></i>设置属性</button><button data-href="<?php echo urldo("setBrand"); ?>?cate_id='+treeNode.cate_id+'" class="btn btn-outline btn-default btn-xs js-window-load" title="设置品牌：'+treeNode.name+'" js-unique="true"><i class="fa fa-edit fa-fw"></i>设置品牌</button><button data-href="<?php echo urldo("edit_cate"); ?>?cate_id='+treeNode.cate_id+'" class="btn btn-outline btn-default btn-xs js-window-load" title="编辑：'+treeNode.name+'" js-unique="true" ><i class="fa fa-edit fa-fw" ></i>编辑</button><button data-href="<?php echo urldo("del_cate"); ?>?id='+treeNode.cate_id+'" class="btn btn-outline btn-danger btn-xs js-del-btn" text="删除：'+treeNode.name+'，将同时删除子菜单！"><i class="fa fa-trash-o fa-fw"></i>删除</button>'
                        
            opSpan          +='</span>'
        var editStr = sortSpan + bannerSpan + statusSpan + indexSpan + opSpan
        aObj.append(editStr);
    }
    /**
     * 查询数据
     */
    function query() {
        zTreeNodes = <?php echo $tree; ?>;
        //初始化树
        $.fn.zTree.init($("#goodCate"), setting, zTreeNodes)//.expandAll(true);
    }

    function
    onClick(e,treeId, treeNode) {
        if (!$(e.target).is('input') && $(e.target).hasClass('node_name')) {
            var zTree = $.fn.zTree.getZTreeObj("goodCate");
            zTree.expandNode(treeNode);
        }
    }
    $(function () {
        //初始化数据
        query();
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