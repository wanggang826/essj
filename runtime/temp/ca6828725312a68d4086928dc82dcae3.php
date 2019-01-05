<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\good\index.html";i:1505699464;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1508488281;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><div class="panel panel-default"><form role="form" action="<?php echo url('good/index'); ?>" class="panel-body hidden-xs form-inline"><div class="form-group"><input type="text" placeholder="商品名称" id="ex1" class="form-control" name="goods_name" value="<?php echo input('goods_name'); ?>"></div><div class="form-group group1"><input type="text" name="statr_time" class="form-control i-datestart" id="date3" placeholder="发布开始时间" js-icon='false' value="<?php echo input('statr_time'); ?>"></div><div class="form-group group2"><input type="text" name="end_time" class="form-control i-datestart" id="date3" placeholder="发布结束时间" value="<?php echo input('end_time'); ?>"></div><div class="form-group"><select  class="form-control"  name="brand_id"><option value="">-- 品牌查询 --</option><?php if(is_array($brands) || $brands instanceof \think\Collection || $brands instanceof \think\Paginator): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo $vo['brand_id']; ?>" <?php if(input('brand_id') ==$vo['brand_id']): ?>selected<?php endif; ?>><?php echo $vo['brand_name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div><div class="form-group"><select   class="form-control"  name="is_sale"><option value="">-- 状态 --</option><option value="1" <?php if(input('is_sale') ==1): ?>selected<?php endif; ?>>上架</option><option value="0" <?php if(input('is_sale') ==0 && input('is_sale')!=null): ?>selected<?php endif; ?>>下架</option></select></div><div class="form-group pull-right"><div class="btn-group"><button class="btn btn-primary btn-outline btn-w-m btn-rec"><i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span></button><a href="<?php echo url(''); ?>" class="btn btn-default btn-outline btn-rec"><i class="fa fa-refresh"></i><span class="btn-desc">&nbsp;重置</span></a></div></div></form><div class="panel-footer clearfix "><div class="pull-left btn-group hidden-xs" ><a href="<?php echo U('add'); ?>" class="btn btn-default js-window-load" js-title="新增商品" js-unique="true" js-width="65%" js-height="90%"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a><a href="<?php echo U('good/del'); ?>" class="btn btn-default del-all" text="删除后将无法恢复，请谨慎操作"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;删除
            </a></div><div class="pull-right"><?php echo $goods->render(); ?></div></div></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><th width='1'><input type="checkbox" class="my-all-check" name="input[]"></th><th width="200">商品名称</th><th width="150" class="hidden-xs">商品编码</th><th width="150" class="hidden-xs">商品品牌</th><th width="50" class="hidden-xs">商品价格</th><th width="50" class="hidden-xs">销量</th><th width="100" class="hidden-xs">创建人</th><th width="150" class="hidden-xs">创建时间</th><th width="50" class="hidden-xs">上|下架</th><th width="100">操作</th></tr></thead><tbody><?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td width='1'><input type="checkbox" value="<?php echo $vo['goods_id']; ?>" class="i-checks" name="input[]"></td><td><?php echo $vo['goods_name']; ?></td><td class="hidden-xs"><?php echo $vo['goods_sn']; ?></td><td class="hidden-xs"><?php echo $vo['brand_name']; ?></td><td class="hidden-xs"><?php echo $vo['shop_price']; ?></td><td class="hidden-xs"><?php echo $vo['sale_count']; ?></td><td class="hidden-xs"><?php echo $vo['create_admin']; ?></td><td class="hidden-xs"><?php echo $vo['create_time']; ?></td><td class="hidden-xs"><?php if($vo['is_sale'] == 1): ?><a href="<?php echo U('changeStatus',['goods_id'=>$vo['goods_id'],'is_sale'=>0]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="下架后商品不可见" js-btn="<i class='fa fa-times fa-fw'></i>下架"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">上架</span></a><?php elseif($vo['is_sale'] == 0): ?><a href="<?php echo U('changeStatus',['goods_id'=>$vo['goods_id'],'is_sale'=>1]); ?>" js-color="#eea236" class="btn btn-danger btn-outline btn-xs js-del-btn" text="上架后前台可见" js-btn="<i class='fa fa-check fa-fw'></i>上架"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">下架</span></a><?php endif; ?></td><td ><span class="btn-group"><a href="<?php echo U('edit',['goods_id'=>$vo['goods_id'],'page'=>$nowpage]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="详情--<?php echo $vo['goods_name']; ?>"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">编辑</span></a><a href="<?php echo U('del',['id'=>$vo['goods_id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table></div><!-- <script type="text/javascript">    function get_cate(data,type){
        cate_id= data.value;
        // console.log(cate_id)
        $.ajax({
            url:"<?php echo url('good/ajax_get_cate'); ?>",
            data:{cate_id:cate_id},
            type:"post",
            dataType:"json",
            success:function(msg){
                console.log(msg)
                var html ="";
                html +="<option value='-1' ></option>"
                if(type == 'cate1'){
                    $('#cate_id2').empty();
                    $('#cate_id3').empty();
                    for(var i=0;i<msg.length;i++){
                        html += "<option value='"+msg[i].cate_id+"'}selected{/if}>"+msg[i].name+"</option>";
                    }
                    $(html).appendTo($("#cate_id2"));
                }else if(type == 'cate2'){
                    $('#cate_id3').empty();
                    for(var i=0;i<msg.length;i++){
                        html += "<option value='"+msg[i].cate_id+"'>"+msg[i].name+"</option>";
                    }
                    $(html).appendTo($("#cate_id3"));
                }
            }
        })
    }
    </script> --></div></div></body><!-- 全局js --><script src="<?php echo $web_static; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script><!-- 第三方插件，加载进度条 --><script src="<?php echo $web_static; ?>/plugins/pace/pace.min.js"></script><!-- layui --><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><!-- 自定义js --><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $web_static; ?>/js/vue.js"></script><script src="<?php echo $js; ?>/hplus.js?v=4.1.0"></script><script src="<?php echo $js; ?>/contabs.js"></script></html><style type="text/css">    .panel-heading{
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