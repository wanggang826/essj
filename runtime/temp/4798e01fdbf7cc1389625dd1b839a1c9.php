<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\basedata\check_add.html";i:1505470885;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\layout.html";i:1500431397;s:66:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\static.html";i:1500431396;s:62:"D:\phpStudy\WWW\ershoushouji/public\theme\admin\layout\js.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="renderer" content="webkit"><title><?php echo $admin_title; ?></title><meta name="keywords" content=""><meta name="description" content=""><!-- 引入公共css/js --><!-- 字体图标 --><link rel="shortcut icon" href="<?php echo $web_public; ?>favicon.ico"><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><!-- JQuery --><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/metisMenu/jquery.metisMenu.js"></script><!-- bootstrap --><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><!-- 自定义样式 --><link href="<?php echo $css; ?>/animate.css" rel="stylesheet"><link href="<?php echo $css; ?>/style.css" rel="stylesheet"><!-- checkbox 和radio 美化 --><link href="<?php echo $web_static; ?>/css/input.css" rel="stylesheet"><!-- <link href="<?php echo $web_static; ?>/css/checkbox.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/checkbox.js"></script> --><!-- select 美化 --><link href="<?php echo $web_static; ?>/css/select.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/jquery/scrollbar.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/plugins/jquery/scrollbar.js"></script><script src="<?php echo $web_static; ?>/js/select.js"></script><link href="<?php echo $web_static; ?>/css/common.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/plugins/editor/wangEditor.min.css" rel="stylesheet"><style>        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style></head><body class="gray-bg  animated fadeIn"><div class="wrapper wrapper-content ibox float-e-margins" ><div class="ibox-title visible-lg"><!-- <h5> --><ul class="breadcrumb inline pull-left" ><li><?php echo $menu['pmenu']; ?></li><li><?php echo $menu['menu_name']; ?></li></ul><!-- </h5> --><a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a></div><div class="ibox-content"><style type="text/css">	.right-border{border: 1px solid lightgrey; }
	.left{width:49%;border-right: 1px solid lightgrey;float: left;margin-top: 10px}
	.right{width:49%;  float: right;margin-top: 10px}
	.check{margin-top: 10px;}
	.check li{list-style: none}
	.right-border table{margin:4px 10px;width: 97%;text-align:center;}
	.right-border tr{height: 30px}
	.check-content{height: 7rem;position: relative;bottom: 0;width: 97%;margin: 10px  ;overflow-y: show;border:1px solid lightgrey;}
	.add-point{margin-right: 7px}
	.grey-point{color:grey;}
	.dis-btn{color:grey;}
</style><form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('check_add'); ?>" method='post'><input type="hidden" name="id" value="<?php echo isset($check) ? $check['id'] :  ''; ?>"><!-- 自定义大小 --><div class="form-group"><label  class="col-sm-3 control-label">质检报告名称</label><div class="col-sm-4"><input type="text" name="check_name" class="form-control" placeholder="质检报告名称" value="<?php echo isset($check) ? $check['check_name'] :  ''; ?>"></div></div><div class="form-group"><label class="col-sm-3 control-label">质检人</label><div class="col-sm-4"><select class="form-control"  name="admin_id"><option value="">请选择质检人</option><?php if(is_array($checkers) || $checkers instanceof \think\Collection || $checkers instanceof \think\Paginator): $i = 0; $__LIST__ = $checkers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo $vo['admin_id']; ?>" <?php if(isset($check) && $check['admin_id'] == $vo['admin_id']){echo "selected=selected";}?> ><?php echo $vo['nickname']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></div></div><div class="form-group"><label class="col-sm-3 control-label">质检描述</label><div class="col-sm-7"><textarea name="check_desc" id="des" placeholder="备注长度不可大于240个字符" class="form-control"><?php echo isset($check) ? $check['check_name'] :  ''; ?></textarea></div></div><div class="form-group"><label class="col-sm-3 control-label">外观检测</label><div class="col-sm-7 "><div class="right-border"><div class="left"><ul class="check"><li><label class="col-sm-3 control-label">背部</label><label class="i-lab"><input type="radio" name="backside" value='Y' <?php if(isset($check) && $check['backside'] == 'Y'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>有划痕</span></label><label class="i-lab"><input type="radio" name="backside" value='N' <?php if(!isset($check)){echo "checked='checked'";}if(isset($check) && $check['backside'] == 'N'){echo "checked='checked'"; }?>  class="mgr mgr-primary mgr-lg" ><span>无划痕</span></label></li><li><label class="col-sm-3 control-label">侧边</label><label class="i-lab"><input type="radio" name="broadside" value='Y' <?php if(isset($check) && $check['broadside'] == 'Y'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>有划痕</span></label><label class="i-lab"><input type="radio" name="broadside" value='N' <?php if(!isset($check)){echo "checked='checked'";}if(isset($check) && $check['broadside'] == 'N'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>无划痕</span></label></li><li><label  class="col-sm-3 control-label">顶部</label><label class="i-lab"><input type="radio" name="top" value='Y' <?php if(isset($check) && $check['top'] == 'Y'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>有划痕</span></label><label class="i-lab"><input type="radio" name="top" value='N' <?php if(!isset($check)){echo "checked='checked'";}if(isset($check) && $check['top'] == 'N'){echo "checked='checked'"; }?>  class="mgr mgr-primary mgr-lg" ><span>无划痕</span></label></li></ul></div><div class="right"><ul class="check"><li><label  class="col-sm-3 control-label">四角</label><label class="i-lab"><input type="radio" name="quadrangle" value='Y' <?php if(isset($check) && $check['quadrangle'] == 'Y'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>有划痕</span></label><label class="i-lab"><input type="radio" name="quadrangle" value='N' <?php if(!isset($check)){echo "checked='checked'";}if(isset($check) && $check['quadrangle'] == 'N'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>无划痕</span></label></li><li><label class="col-sm-3 control-label">屏幕</label><label class="i-lab"><input type="radio" name="screen" value='Y' <?php if(isset($check) && $check['screen'] == 'Y'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>有划痕</span></label><label class="i-lab"><input type="radio" name="screen" value='N' <?php if(!isset($check)){echo "checked='checked'";}if(isset($check) && $check['screen'] == 'N'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>无划痕</span></label></li><li><label  class="col-sm-3 control-label">底部</label><label class="i-lab"><input type="radio" name="bottom" value='Y' <?php if(isset($check) && $check['bottom'] == 'Y'){echo "checked='checked'"; }?> class="mgr mgr-primary mgr-lg" ><span>有划痕</span></label><label class="i-lab"><input type="radio" name="bottom" value='N' <?php if(!isset($check)){echo "checked='checked'";}if(isset($check) && $check['bottom'] == 'N'){echo "checked='checked'"; }?>  class="mgr mgr-primary mgr-lg" ><span>无划痕</span></label></li></ul></div><div class="bottom"><textarea class="check-content" name="appearance_desc" placeholder="请输入外感检测说明"><?php echo isset($check) ? $check['appearance_desc'] :  ''; ?></textarea></div></div></div></div><div class="form-group"><label for="email" class="col-sm-3 control-label">功能检测</label><div class="col-sm-7"><div class="right-border" style="padding: 17px 10px"><table class="table table-hover table-bordered table-condensed"><tbody><tr><td width="14%" >根节点</td><td width="14%" ></td><td width="25%" ></td><td width="25%" >状态</td><td width="30%" ><span class="add-point first_add"><a href="javascript:void(0)">添加节点</a></span><span class="del-point dis-btn">删除节点</span></td></tr><?php if(isset($fun_check)){$first_num = 100;foreach($fun_check as $key => $values): ?><tr><td width="14%" ></td><td width="14%" ><input type="text" name="fun_name[<?php echo $first_num; ?>][name]" value="<?php echo $key; ?>" class="form-control" placeholder="节点名称"></td><td width="25%" ></td><td width="25%" ></td><td width="30%" ><span class="add-point sec_add" first_num="<?php echo $first_num; ?>"><a href="javascript:void(0)">添加节点</a></span><span class="del-point"><a href="javascript:void(0)">删除节点</a></span></td></tr><?php $sec_num = 1000;foreach($values as $k => $v): ?><tr><td width="14%" ></td><td width="14%" ></td><td width="25%" ><input type="text" name="fun_name[<?php echo $first_num; ?>][<?php echo $sec_num; ?>]" value="<?php echo $k; ?>" class="form-control" placeholder="节点名称"></td><td width="25%" ><select class="form-control"  name="fun_type[<?php echo $first_num; ?>][<?php echo $sec_num; ?>]"><option value="1" <?php if($v == 1){echo "selected='selected'";}?>>合格</option><option value="2" <?php if($v == 2){echo "selected='selected'";}?>>不合格</option></select></td><td width="30%" ><span class="add-point dis-btn">添加节点</span><span class="del-point del_btn"><a href="javascript:void(0)">删除节点</a></span></td></tr><?php $sec_num ++ ; endforeach; $first_num ++ ; endforeach; }?><!-- <tr><td width="14%" ></td><td width="14%" ><input type="text" name="check_name" class="form-control" placeholder="节点名称"></td><td width="25%" ></td><td width="25%" ></td><td width="30%" ><span class="add-point sec_add"><a href="javascript:void(0)">添加节点</a></span><span class="del-point"><a href="javascript:void(0)">删除节点</a></span></td></tr><tr><td width="14%" ></td><td width="14%" ></td><td width="25%" ><input type="text" name="check_name" class="form-control" placeholder="节点名称"></td><td width="25%" ><select class="form-control"  name="type"><option value="1">合格</option><option value="2">不合格</option></select></td><td width="30%" ><span class="add-point dis-btn">添加节点</span><span class="del-point"><a href="javascript:void(0)">删除节点</a></span></td></tr> --></tbody></table></div></div></div><div class="form-group"><label for="inputPassword3" class="col-sm-4 control-label"></label><div class="col-sm-3"><button type="submit" id="sub_btn" class="btn btn-info js-submit-btn mr_3px">确认</button><button type="reset" class="btn btn-info">重置</button></div></div></form><script type="text/javascript">	$(function(){
		var num = 0;
		$('table .first_add').on('click',function(){
			var tr = '';
			tr +='<tr>'+
        		'<td width="14%" ></td>'+
        		'<td width="14%" ><input type="text" name="fun_name['+num+'][name]" class="form-control" placeholder="节点名称"></td>'+
        		'<td width="25%" ></td>'+
        		'<td width="25%" ></td>'+
        		'<td width="30%" >'+
    			'<span class="add-point sec_add" first_num ='+num+'><a href="javascript:void(0)">添加节点</a></span>'+
    			'<span class="del-point del_btn"><a href="javascript:void(0)">删除节点</a></span>'+
        		'</td>'+
        		'</tr>';
			$('tbody').append(tr);
			num ++;
		})

		var click_num = 0;
		$('table').on('click','.sec_add',function(){
			var parent_num = $(this).attr('first_num');
			var tr = '';
			$(this).siblings('span').removeClass('del_btn');
			tr +='<tr>'+
        		'<td width="14%" ></td>'+
        		'<td width="14%" ></td>'+
        		'<td width="25%" >'+
    			'<input type="text" name="fun_name['+parent_num+']['+click_num+']" class="form-control" placeholder="节点名称33">'+
        		'</td>'+
        		'<td width="25%" >'+
    			'<select class="form-control"  name="fun_type['+parent_num+']['+click_num+']">'+
				'<option value="1">合格</option>'+
				'<option value="2">不合格</option>'+
	            '</select>'+
        		'</td>'+
        		'<td width="30%" >'+
    			'<span class="add-point dis-btn">添加节点</span>'+
    			'<span class="del-point del_btn"><a href="javascript:void(0)">删除节点</a></span>'+
        		'</td>'+
        		'</tr>';
			$(this).closest('tr').after(tr);
			click_num ++;
		})

		$('table').on('click','.del_btn',function(){
			$(this).closest('tr').remove();
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