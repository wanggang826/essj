<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"D:\phpStudy\WWW\adminui/public\theme\admin\good\add.html";i:1500431396;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\layout.html";i:1500431397;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\static.html";i:1500431396;s:57:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><script src="<?php echo $web_static; ?>/js/uploadImg.js"></script><form class="form-horizontal js-ajax-form clearfix" action='<?php echo U('add'); ?>'><div class="form-group"><label for="select-tree" class="col-sm-2 control-label">所属一级类别</label><div class="col-sm-4"><select   class="form-control"  name="cate_id1"  onchange="get_cate(this,'cate1')"><option value="">-- 一级类别 --</option><?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo $vo['cate_id']; ?>" <?php if(input('cate_id1') ==$vo['cate_id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><div class="form-group"><label for="select-tree" class="col-sm-2 control-label">所属二级类别</label><div class="col-sm-4"><select   class="form-control"  name="cate_id2" id="cate_id2" onchange="get_cate(this,'cate2')"></select></div></div><div class="form-group"><label for="select-tree" class="col-sm-2 control-label">所属三级类别</label><div class="col-sm-4"><select   class="form-control"  name="cate_id3" id="cate_id3" onchange="get_cate(this,'cate3')"></select></div></div><div class="form-group"><label for="goods_name" class="col-sm-2 control-label">商品所属店铺</label><div class="col-sm-4"><select   class="form-control"  name="shop_id"><option value="">-- 所属店铺--</option><?php if(is_array($shops) || $shops instanceof \think\Collection || $shops instanceof \think\Paginator): $i = 0; $__LIST__ = $shops;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo $v['shop_id']; ?>" <?php if(input('shop_id') ==$v['shop_id']): ?>selected<?php endif; ?>><?php echo $v['shop_name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><div class="form-group"><label for="goods_name" class="col-sm-2 control-label">商品品牌</label><div class="col-sm-4"><select   class="form-control"  name="brand_id" id="brand_id"><?php if(is_array($brands) || $brands instanceof \think\Collection || $brands instanceof \think\Paginator): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo $v['brand_id']; ?>" <?php if(input('brand_id') ==$v['brand_id']): ?>selected<?php endif; ?>><?php echo $v['brand_name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><div class="form-group"><label for="goods_name" class="col-sm-2 control-label">商品名称</label><div class="col-sm-4"><input type="text" name="goods_name" class="form-control" id="goods_name" placeholder="商品名称"></div></div><div class="form-group"><label for="market_price" class="col-sm-2 control-label">商品市场价格</label><div class="col-sm-4"><input type="text" name="market_price" class="form-control" id="market_price" placeholder="商品价格"></div></div><div class="form-group"><label for="shop_price" class="col-sm-2 control-label">商品店铺价格</label><div class="col-sm-4"><input type="text" name="shop_price" class="form-control" id="shop_price" placeholder="商品价格"></div></div><div class="form-group"><label for="goods_unit" class="col-sm-2 control-label">商品单位</label><div class="col-sm-4"><input type="text" name="goods_unit" class="form-control" id="goods_unit" placeholder="商品单位"></div></div><div class="form-group"><label for="goods_unit" class="col-sm-2 control-label">商品封面</label><div class="img_cont"><div class="img_prev"></div><input type="file" name="goods_thums" id="goods_thums"  value=""/></div></div><div class="form-group"><label for="goods_unit" class="col-sm-2 control-label">商品图片</label><div class="img_cont"><div class="img_prev"></div><input type="file" name="goods_img" id="goods_img"  value=""/></div></div><div class="form-group"><label for="inventory" class="col-sm-2 control-label">商品库存</label><div class="col-sm-4"><input type="text" name="inventory" class="form-control" id="inventory" placeholder="商品库存"></div></div><div class="form-group"><label for="sort" class="col-sm-2 control-label">是否上架</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="is_sale" value='1' class="mgr mgr-primary  mgr-lg" checked><span>上架</span></label><label class="i-lab"><input type="radio" name="is_sale" value='0' class="mgr mgr-primary mgr-lg" ><span>下架</span></label></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-4"><button type="submit" class="btn btn-primary js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-primary">重置</button></div></div></form><script type="text/javascript">function get_cate(data,type){
    cate_id= data.value;
    // console.log(cate_id)
    $.ajax({
        url:"<?php echo url('good/ajax_get_cate'); ?>",
        data:{cate_id:cate_id},
        type:"post",
        dataType:"json",
        success:function(msg){
            console.log(msg)
            var html       = "",
                html_brand = "",
                cates      = msg.cates,
                brands     = msg.brands;
            html        += "<option value='-1' >--请选择--</option>"
            html_brand  += "<option value='' >--请选择--</option>"
            if(type == 'cate1'){
                $('#cate_id2').empty();
                $('#cate_id3').empty();
                for(var i=0;i<cates.length;i++){
                    html += "<option value='"+cates[i].cate_id+"'}selected{/if}>"+cates[i].name+"</option>";
                }
                $(html).appendTo($("#cate_id2"));
            }else if(type == 'cate2'){
                $('#cate_id3').empty();
                for(var i=0;i<cates.length;i++){
                    html += "<option value='"+cates[i].cate_id+"'>"+cates[i].name+"</option>";
                }
                $(html).appendTo($("#cate_id3"));
            }
            $('#brand_id').empty();
            for(var i=0;i<brands.length;i++){
                html_brand += "<option value='"+brands[i].brand_id+"'>"+brands[i].brand_name+"</option>";
            }
            $(html_brand).appendTo($("#brand_id"));
        }
    })
}

$('#goods_thums').imgUpload({
    // width:150,//预览宽度
    // height:150,//预览高度
    maxSize: 500,//允许上传最大值(KB)
    imgWidth:220,//图片上传宽度
    imgHeight:220,//图片上传高度
    allowedNum:1,//允许上传最大数量
    files:{
        1:'{getImg}',
    }
})
$('#goods_img').imgUpload({
    // width:150,//预览宽度
    // height:150,//预览高度
    allowedNum:5,//允许上传最大数量

    files:{
        7:'{getImg}',
    }
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