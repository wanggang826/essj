<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"D:\phpStudy\WWW\adminui/public\theme\admin\shops\edit.html";i:1500431396;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\layout.html";i:1500431397;s:61:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\static.html";i:1500431396;s:57:"D:\phpStudy\WWW\adminui/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><!-- 地区插件 --><link href="<?php echo $web_static; ?>/plugins/citypicker/css/city-picker.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/cache/city.cache.js"></script><script src="<?php echo $web_static; ?>/plugins/citypicker/js/city-picker.js"></script><script src="<?php echo $web_static; ?>/js/uploadImg.js"></script><form class="form-horizontal js-ajax-form clearfix" action='<?php echo U('shops/edit'); ?>' name="form0" id="form0"><input type="hidden" name="shop_id" value="<?php echo $shop_info['shop_id']; ?>"><div class="form-group"><label for="shop_name" class="col-sm-2 control-label">店铺名称</label><div class="col-sm-6"><input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="店铺名称" value="<?php echo $shop_info['shop_name']; ?>"></div></div><div class="form-group"><label for="account" class="col-sm-2 control-label">关联帐号</label><div class="col-sm-6"><p class="form-control-static"><?php echo $shop_info['account']; ?></p><!-- <input type="text" name="account" class="form-control" id="account" placeholder="关联帐号" value="<?php echo $shop_info['account']; ?>"> --></div></div><!-- <div class="form-group imgUpload" js-img="shop_logo"><label  class="col-sm-2 control-label">店铺图标</label><div class="col-sm-6" id="crop-avatar"><input id="shop_logo" name="shop_logo" type="file" data="<?php echo $web_public; ?>upload<?php echo $shop_info['shop_logo']; ?>" ></div></div> --><div class="form-group imgUpload" js-img="shop_logo"><label  class="col-sm-2 control-label">店铺图标</label><div class="img_cont"><div class="img_prev"></div><input type="file" name="shop_logo" id="shop_logo"  value="<?php echo $web_public; ?>upload<?php echo $shop_info['shop_logo']; ?>"/></div></div><div class="form-group"><label class="col-sm-2 control-label">所在地</label><div class="col-sm-6"><input  class="form-control" readonly type="text" value="<?php echo $shop_info['area_name1']; ?>/<?php echo $shop_info['area_name2']; ?>/<?php echo $shop_info['area_name3']; ?>" data-toggle="city-picker" name='citys'></div></div><div class="form-group"><label for="shop_intro" class="col-sm-2 control-label">店铺简介</label><div class="col-sm-6"><textarea class="form-control" name="shop_intro" id="shop_intro" cols="53" rows="3"><?php echo $shop_info['shop_intro']; ?></textarea></div></div><div class="form-group"><label for="shop_des" class="col-sm-2 control-label">店铺介绍</label><div class="col-sm-6"><textarea class="form-control" name="shop_des" id="shop_des" cols="53" rows="6"><?php echo $shop_info['shop_des']; ?></textarea></div></div><div class="form-group" ><label  class="col-sm-2 control-label">身份证</label><div class="col-sm-8" id="crop-avatar"><div class="img_cont"><div class="img_prev"></div><input type="file" name="idcard1" id="idcard1"  value="<?php echo $web_public; ?>upload<?php echo $shop_info['idcard1']; ?>"/></div><div class="img_cont"><div class="img_prev"></div><input type="file" name="idcard2" id="idcard2"  value="<?php echo $web_public; ?>upload<?php echo $shop_info['idcard2']; ?>"/></div><!-- <div class="col-sm-6 imgUpload" js-img="idcard1"><input id="idcard1" name="idcard1" type="file" data="<?php echo $web_public; ?>upload<?php echo $shop_info['idcard1']; ?>" ></div><div class="col-sm-6 imgUpload" js-img="idcard2"><input id="idcard2" name="idcard2" type="file" data="<?php echo $web_public; ?>upload<?php echo $shop_info['idcard2']; ?>" ></div> --></div></div><div class="form-group"><label for="" class="col-sm-2 control-label">状态</label><div class="col-sm-6"><label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary" <?php if($shop_info['status'] ==1): ?>checked<?php endif; ?>><span>正常</span></label><label class="i-lab"><input type="radio" name="status" value='0' class="mgr mgr-primary" <?php if($shop_info['status'] ==0): ?>checked<?php endif; ?>><span>禁用</span></label></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-6"><button type="submit" class="btn btn-primary js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-primary">重置</button></div></div></form><script>    $('#shop_logo').imgUpload({
    // width:150,//预览宽度
    // height:150,//预览高度
    imgWidth:150,//图片上传宽度
    imgHeight:150,//图片上传高度
    allowedNum:1,//允许上传最大数量
    files:{
        1:'<?php echo getImg($shop_info['shop_logo']); ?>',
    }
    })
    $('#idcard1').imgUpload({
    width:180,//预览宽度
    height:150,//预览高度
    imgWidth:180,//图片上传宽度
    imgHeight:150,//图片上传高度
    allowedNum:1,//允许上传最大数量
    files:{
        1:'<?php echo getImg($shop_info['idcard1']); ?>',
    }
    })
    $('#idcard2').imgUpload({
    width:180,//预览宽度
    height:150,//预览高度
    imgWidth:180,//图片上传宽度
    imgHeight:150,//图片上传高度
    allowedNum:1,//允许上传最大数量
    files:{
        1:'<?php echo getImg($shop_info['idcard2']); ?>',
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