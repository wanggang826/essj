<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"/var/www/html/ershoushouji/public/theme/admin/good/edit.html";i:1508206116;s:64:"/var/www/html/ershoushouji/public/theme/admin/layout/layout.html";i:1508488280;s:64:"/var/www/html/ershoushouji/public/theme/admin/layout/static.html";i:1500431396;s:60:"/var/www/html/ershoushouji/public/theme/admin/layout/js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><script src="<?php echo $web_static; ?>/js/uploadImg.js"></script><form class="form-horizontal js-ajax-form clearfix" action='<?php echo U('edit'); ?>'><div class="panel panel-default"><div class="panel" style="border-bottom: 1px solid #e7eaec"><p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">基本信息</p></div><div class="form-group" style="margin-top: 20px;"><label for="goods_name" class="col-sm-2 control-label">商品品牌</label><div class="col-sm-4"><select   class="form-control i-select"  name="brand_id" id="brand_id" onchange="get_model(this)"><?php if(is_array($brands) || $brands instanceof \think\Collection || $brands instanceof \think\Paginator): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo $v['brand_id']; ?>" <?php if($goods_info['brand_id'] ==$v['brand_id']): ?>selected<?php endif; ?>><?php echo $v['brand_name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><div class="form-group" style="margin-top: 20px;"><label for="sort" class="col-sm-2 control-label">型号</label><div class="col-sm-8" id="model_list"><?php if(is_array($model) || $model instanceof \think\Collection || $model instanceof \think\Paginator): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="i-lab"><input type="radio" name="model_id" value="<?php echo $vo['model_id']; ?>" class="mgr mgr-primary  mgr-lg" <?php if($vo['model_id'] == $goods_info['model_id']): ?>checked<?php endif; ?>><span><?php echo $vo['name']; ?></span></label><?php endforeach; endif; else: echo "" ;endif; ?></div></div><input type="hidden" name="goods_id" value="<?php echo $goods_info['goods_id']; ?>"><div class="form-group" style="margin-top: 20px;"><label for="goods_name" class="col-sm-2 control-label">商品名称</label><div class="col-sm-4"><input type="text" name="goods_name" class="form-control" id="goods_name" placeholder="商品名称" value="<?php echo $goods_info['goods_name']; ?>"></div></div><div class="form-group" style="margin-top: 20px;"><label for="report_id" class="col-sm-2 control-label">质检报告</label><div class="col-sm-4"><select   class="form-control"  name="report_id" id="report_id"><?php if(is_array($check_info) || $check_info instanceof \think\Collection || $check_info instanceof \think\Paginator): $i = 0; $__LIST__ = $check_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo $v['id']; ?>" <?php if($goods_info['report_id'] == $v['id']): ?>selected<?php endif; ?>><?php echo $v['check_name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><!-- <div class="form-group" style="margin-top: 20px;"><label for="market_price" class="col-sm-2 control-label">商品市场价格</label><div class="col-sm-4"><input type="text" name="market_price" class="form-control" id="market_price" placeholder="商品价格" value="<?php echo $goods_info['market_price']; ?>"></div></div><div class="form-group" style="margin-top: 20px;"><label for="shop_price" class="col-sm-2 control-label">商品店铺价格</label><div class="col-sm-4"><input type="text" name="shop_price" class="form-control" id="shop_price" placeholder="商品价格" value="<?php echo $goods_info['shop_price']; ?>"></div></div> --><div class="form-group" style="margin-top: 20px;"><label for="goods_unit" class="col-sm-2 control-label">商品单位</label><div class="col-sm-4"><input type="text" name="goods_unit" class="form-control" id="goods_unit" placeholder="商品单位" value="<?php echo $goods_info['goods_unit']; ?>"></div></div><div class="form-group" style="border-bottom: 1px solid #e7eaec;margin:5px; "><label for="sort" class="col-sm-2 control-label ">好评标签</label><div class="col-sm-10"><label class="i-lab"><input type="checkbox" name="evaluate[0]" value="很靠谱" class="mgr mgr-primary  mgr-lg attr_value" <?php if(in_array('很靠谱',$evaluate)): ?>checked<?php endif; ?>><span>很靠谱</span></label><label class="i-lab"><input type="checkbox" name="evaluate[1]" value="物流快" class="mgr mgr-primary  mgr-lg attr_value" <?php if(in_array('物流快',$evaluate)): ?>checked<?php endif; ?>><span>物流快</span></label><label class="i-lab"><input type="checkbox" name="evaluate[2]" value="物美价廉" class="mgr mgr-primary  mgr-lg attr_value" <?php if(in_array('物美价廉',$evaluate)): ?>checked<?php endif; ?>><span>物美价廉</span></label><label class="i-lab"><input type="checkbox" name="evaluate[3]" value="服务好" class="mgr mgr-primary  mgr-lg attr_value" <?php if(in_array('服务好',$evaluate)): ?>checked<?php endif; ?>><span>服务好</span></label><label class="i-lab"><input type="checkbox" name="evaluate[4]" value="成色新" class="mgr mgr-primary  mgr-lg attr_value" <?php if(in_array('成色新',$evaluate)): ?>checked<?php endif; ?>><span>成色新</span></label><label class="i-lab"><input type="checkbox" name="evaluate[5]" value="很划算" class="mgr mgr-primary  mgr-lg attr_value" <?php if(in_array('很划算',$evaluate)): ?>checked<?php endif; ?>><span>很划算</span></label></div></div><!-- <div class="form-group" style="margin-top: 20px;"><label for="evaluate" class="col-sm-2 control-label">好评标签</label><div class="col-sm-4"><select   class="form-control"  name="evaluate" id="evaluate"><option value="很靠谱" <?php if($goods_info['evaluate'] == '很靠谱'): ?>selected<?php endif; ?>>很靠谱</option><option value="物流快" <?php if($goods_info['evaluate'] == '物流快'): ?>selected<?php endif; ?>>物流快</option><option value="物美价廉" <?php if($goods_info['evaluate'] == '物美价廉'): ?>selected<?php endif; ?>>物美价廉</option><option value="服务好" <?php if($goods_info['evaluate'] == '服务好'): ?>selected<?php endif; ?>>服务好</option><option value="成色新" <?php if($goods_info['evaluate'] == '成色新'): ?>selected<?php endif; ?>>成色新</option><option value="很划算" <?php if($goods_info['evaluate'] == '很划算'): ?>selected<?php endif; ?>>很划算</option></select></div></div> --><div class="form-group" style="margin-top: 20px;"><label for="sort" class="col-sm-2 control-label">卖场</label><div class="col-sm-10"><?php if(is_array($stores) || $stores instanceof \think\Collection || $stores instanceof \think\Paginator): $i = 0; $__LIST__ = $stores;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="i-lab"><input type="radio" name="store_id" value='<?php echo $v['id']; ?>' class="mgr mgr-primary  mgr-lg" <?php if($goods_info['store_id'] == $v['id']): ?>checked<?php endif; ?>><span><?php echo $v['store_name']; ?></span></label><?php endforeach; endif; else: echo "" ;endif; ?></div></div><div class="form-group" style="margin-top: 20px;"><label for="goods_unit" class="col-sm-2 control-label">商品封面</label><div class="img_cont"><div class="img_prev"></div><input type="file" name="goods_thums" id="goods_thums"></div></div><div class="form-group" style="margin-top: 20px;"><label for="goods_unit" class="col-sm-2 control-label">商品图片</label><div class="img_cont"><div class="img_prev"></div><input type="file" name="goods_img" id="goods_img"/></div></div><div class="form-group" style="margin-top: 20px;"><label for="inventory" class="col-sm-2 control-label">商品库存</label><div class="col-sm-4"><input type="text" name="inventory" class="form-control" id="inventory" placeholder="商品库存" value="<?php echo $goods_info['inventory']; ?>"></div></div><div class="form-group" style="margin-top: 20px;"><label for="giveaway" class="col-sm-2 control-label">赠品</label><div class="col-sm-8"><input type="text" name="giveaway" class="form-control" id="giveaway" placeholder="赠品" value="<?php echo $goods_info['giveaway']; ?>"></div></div><div class="form-group" style="margin-top: 20px;"><label for="sort" class="col-sm-2 control-label">是否上架</label><div class="col-sm-4"><label class="i-lab"><input type="radio" name="is_sale" value='1' class="mgr mgr-primary  mgr-lg" <?php if($goods_info['is_sale'] == 1): ?>checked<?php endif; ?>><span>上架</span></label><label class="i-lab"><input type="radio" name="is_sale" value='0' class="mgr mgr-primary mgr-lg" <?php if($goods_info['is_sale'] == 0): ?>checked<?php endif; ?>><span>下架</span></label></div></div><div class="panel" style="border-bottom: 1px solid #e7eaec;border-top:1px solid #e7eaec; "><p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">商品属性</p></div><?php if(is_array($attrs) || $attrs instanceof \think\Collection || $attrs instanceof \think\Paginator): $key = 0; $__LIST__ = $attrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class="form-group attr" style="border-bottom: 1px solid #e7eaec;margin:5px; "><label for="sort" class="col-sm-2 control-label"><?php echo $vo['attr_name']; ?></label><input type="hidden" name="attr_id" value="<?php echo $vo['attr_id']; ?>" class="attr_id"><div class="col-sm-10"><?php if(is_array($vo['value']) || $vo['value'] instanceof \think\Collection || $vo['value'] instanceof \think\Paginator): $k = 0; $__LIST__ = $vo['value'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($k % 2 );++$k;?><label class="i-lab"><input type="checkbox" name="attrs[<?php echo $vo['attr_id']; ?>][<?php echo $k; ?>]" value="<?php echo $v1['value']; ?>" class="mgr mgr-primary  mgr-lg attr_value"
                 <?php if(in_array($v1['value'],$vo['values'])): ?>checked<?php endif; ?> js-attrid ="<?php echo $vo['attr_id']; ?>"><span><?php echo $v1['value']; ?></span></label><?php endforeach; endif; else: echo "" ;endif; ?></div></div><?php endforeach; endif; else: echo "" ;endif; ?><button type="button" class="btn btn-primary " style="margin-left:450px;" id="submit-attr">确认属性</button></div><div class="table-responsive"><table class="table table-hover table-bordered table-condensed"><thead><tr><?php if(is_array($attrs) || $attrs instanceof \think\Collection || $attrs instanceof \think\Paginator): $i = 0; $__LIST__ = $attrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo $vo['attr_name']; ?></th><?php endforeach; endif; else: echo "" ;endif; ?><th>赠送积分</th><th>活动价格</th><th>默认价格</th></tr></thead><tbody id="goods_price_input"><?php if(is_array($goods_price_list) || $goods_price_list instanceof \think\Collection || $goods_price_list instanceof \think\Paginator): $k1 = 0; $__LIST__ = $goods_price_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k1 % 2 );++$k1;?><tr><?php if(is_array($vo['attrs_values']) || $vo['attrs_values'] instanceof \think\Collection || $vo['attrs_values'] instanceof \think\Paginator): $k2 = 0; $__LIST__ = $vo['attrs_values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($k2 % 2 );++$k2;?><td><?php echo $v1; ?><input type="hidden" name="price_id_value[<?php echo $k1-1; ?>][<?php echo $k2-1; ?>]" class="form-control" value="<?php echo $v1; ?>"><input type="hidden" name="price_id[<?php echo $k1-1; ?>][<?php echo $k2-1; ?>]" class="form-control" value="<?php echo $vo['attrs_ids'][$k2-1]; ?>"></td><?php endforeach; endif; else: echo "" ;endif; ?><td><input type="text" name="integral[<?php echo $k1-1; ?>]" class="form-control" value="<?php echo $vo['integral']; ?>"></td><td  width="100px"><input type="text" name="campaign_price[<?php echo $k1-1; ?>]" class="form-control" value="<?php echo $vo['campaign_price']; ?>"></td><td  width="100px"><input type="text" name="price[<?php echo $k1-1; ?>]" class="form-control" value="<?php echo $vo['price']; ?>"></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody></table></div><div class="form-group" style="margin-top: 20px;"><label for="inputPassword3" class="col-sm-2 control-label"></label><div class="col-sm-4"><button type="submit" class="btn btn-primary js-submit-btn mr_3px button-submit" disabled="disabled">确认</button>&nbsp;&nbsp;&nbsp;
            <button type="reset" class="btn btn-primary">重置</button></div></div></form><script type="text/javascript">function get_cate(data,type){
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
        0:'<?php echo getImg($goods_info['goods_thums']); ?>',
    }
})
$('#goods_img').imgUpload({
    // width:150,//预览宽度
    // height:150,//预览高度
    maxSize: 500,//允许上传最大值(KB)
    allowedNum:5,//允许上传最大数量

    files:{
	    0:'<?php echo getImg($goods_info['goods_img1']); ?>',
	    1:'<?php echo getImg($goods_info['goods_img2']); ?>',
	    2:'<?php echo getImg($goods_info['goods_img3']); ?>',
	    3:'<?php echo getImg($goods_info['goods_img4']); ?>',
	    4:'<?php echo getImg($goods_info['goods_img5']); ?>',
    }
})
function get_model(data){
    var brand_id = data.value;
    $.ajax({
        url:"<?php echo url('good/get_model'); ?>",
        data:{brand_id:brand_id},
        dataType:"json",
        type:"post",
        success:function(msg){
            console.log(msg);
            var html = '';
            $('#model_list').empty();
            for (var i = msg.length - 1; i >= 0; i--) {
                html += '<label class="i-lab"><input type="radio" name="model_id" value="'+msg[i].model_id+'" class="mgr mgr-primary  mgr-lg"><span>'+msg[i].name+'</span></label>';
            }
            $(html).appendTo($("#model_list"));
        },
        error:function(msg){
            alert('no')
        }
    })
}
function doExchange(arr){
    var len = arr.length;
    // 当数组大于等于2个的时候
    if(len >= 2){
        // 第一个数组的长度
        var len1 = arr[0].length;
        // 第二个数组的长度
        var len2 = arr[1].length;
        // 2个数组产生的组合数
        var lenBoth = len1 * len2;
        //  申明一个新数组
        var items = new Array(lenBoth);
        // 申明新数组的索引
        var index = 0;
        for(var i=0; i<len1; i++){
            for(var j=0; j<len2; j++){
                if(arr[0][i] instanceof Array){
                    items[index] = arr[0][i].concat(arr[1][j]);
                }else{
                    items[index] = [arr[0][i]].concat(arr[1][j]);
                }
                index++;
            }
        }
        var newArr = new Array(len -1);
        for(var i=2;i<arr.length;i++){
            newArr[i-1] = arr[i];
        }
        newArr[0] = items;
        return doExchange(newArr);
    }else{
        return arr[0];
    }
}
// $(function(){
//     var aa = $('input[type="checkbox"');
//     var all_attr = $('.attr');
//     var all_attr_list   = [];
//     var all_attr_id     = [];
//     var i = 0;
//     $.each(all_attr,function(k,v){
//         var attr_id = $(v).find('.attr_id').val();
//         var attrs   = $(v).find('.attr_value');
//         var attr_value = [];
//         var attr_value_id    = [];
//         for(key in attrs){
//             if(attrs[key].checked){
//                 attr_value.push(attrs[key].value);
//                 attr_value_id.push($(attrs[key]).attr('js-attrid'));
//             }
//         }
//         all_attr_list[i] = attr_value;
//         all_attr_id[i]   = attr_value_id;
//         i = i+1;
//         // console.log(attr_value)
//     })
//     // console.log(all_attr_list)
//     // console.log(all_attr_id)
    
//     var new_data = doExchange(all_attr_list);
//     var new_attrids = doExchange(all_attr_id);
//     console.log(new_attrids);
//     var html = '';
//     $('#goods_price_input').empty();
//     for (var i = 0; i < new_data.length; i++) {
//         html += '<tr>';
//         for (var j = 0; j < new_data[i].length; j++) {
//             html += '<td>'+new_data[i][j]+'<input type="hidden" name="price_id_value['+i+']['+j+']" class="form-control" value="'+new_data[i][j]+'"><input type="hidden" name="price_id['+i+']['+j+']" class="form-control" value="'+new_attrids[i][j]+'"></td>';
//         }
//         html += '<td  width="100px"><input type="text" name="integral['+i+']" class="form-control"></td><td  width="100px"><input type="text" name="campaign_price['+i+']" class="form-control"></td><td  width="100px"><input type="text" name="price['+i+']" class="form-control"></td>'
//         html += '</tr>'
//     }
//     $('#goods_price_input').append(html);
// })
$("#submit-attr").click(function(){
    var aa = $('input[type="checkbox"');
    var all_attr = $('.attr');
    var all_attr_list   = [];
    var all_attr_id     = [];
    var i = 0;
    $.each(all_attr,function(k,v){
        var attr_id = $(v).find('.attr_id').val();
        var attrs   = $(v).find('.attr_value');
        var attr_value = [];
        var attr_value_id    = [];
        for(key in attrs){
            if(attrs[key].checked){
                attr_value.push(attrs[key].value);
                attr_value_id.push($(attrs[key]).attr('js-attrid'));
            }
        }
        all_attr_list[i] = attr_value;
        all_attr_id[i]   = attr_value_id;
        i = i+1;
        // console.log(attr_value)
    })
    // console.log(all_attr_list)
    // console.log(all_attr_id)
    
    var new_data = doExchange(all_attr_list);
    var new_attrids = doExchange(all_attr_id);
    console.log(new_attrids);
    var html = '';
    $('#goods_price_input').empty();
    for (var i = 0; i < new_data.length; i++) {
        html += '<tr>';
        for (var j = 0; j < new_data[i].length; j++) {
            html += '<td>'+new_data[i][j]+'<input type="hidden" name="price_id_value['+i+']['+j+']" class="form-control" value="'+new_data[i][j]+'"><input type="hidden" name="price_id['+i+']['+j+']" class="form-control" value="'+new_attrids[i][j]+'"></td>';
        }
        html += '<td  width="100px"><input type="text" name="integral['+i+']" class="form-control"></td><td  width="100px"><input type="text" name="campaign_price['+i+']" class="form-control"></td><td  width="100px"><input type="text" name="price['+i+']" class="form-control"></td>'
        html += '</tr>'
    }
    $('#goods_price_input').append(html);
    $('.button-submit').removeAttr("disabled");
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