<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:65:"D:\phpStudy\WWW\adminui/public\theme\shop\default\cart\index.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><link rel="stylesheet" href="<?php echo $css; ?>/cart.css" /><link rel="stylesheet" href="<?php echo $css; ?>/usernew.css" /><link rel="stylesheet" href="<?php echo $web_static; ?>/css/reset.css" /><div class="width1200 spcart"><?php if($cart_data): ?><h3>全部商品（<span id="kind_num"><?php echo $cart_data['kind_num']; ?></span>）</h3><ul><li><input type="checkbox" class="checkall"/></li><li>全选</li><li>商品</li><li>单价</li><li>数量</li><li>小计</li><li>操作</li></ul><?php if(is_array($cart_data['shop']) || $cart_data['shop'] instanceof \think\Collection || $cart_data['shop'] instanceof \think\Paginator): $key = 0; $__LIST__ = $cart_data['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><ul class="store-name"><li><input type="checkbox" class="store"/></li><li>店铺：<span><?php echo $key; ?></span></li></ul><?php if(is_array($vo['goods']) || $vo['goods'] instanceof \think\Collection || $vo['goods'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><ul class="shop-detail" id="ul_<?php echo $goods['id']; ?>"><li><input type="checkbox" name="Check[]" value="<?php echo $goods['id']; ?>"/></li><li><img src="<?php echo getImg($goods['good_image']); ?>"/></li><li><p><?php echo $goods['goods_name']; ?></p><?php if(is_array($goods['good_attr']) || $goods['good_attr'] instanceof \think\Collection || $goods['good_attr'] instanceof \think\Paginator): if( count($goods['good_attr'])==0 ) : echo "" ;else: foreach($goods['good_attr'] as $k=>$attr): ?><p><?php echo $k; ?>:<?php echo $attr; ?></p><?php endforeach; endif; else: echo "" ;endif; ?></li><li>￥<?php echo $goods['present_price']; ?></li><li><button class="minus" onclick="change_quantity(this,<?php echo $goods['id']; ?>,'minus')">-</button><input type="text" name="good_count_<?php echo $goods['id']; ?>" id="good_count_<?php echo $goods['id']; ?>"  value="<?php echo $goods['good_count']; ?>" onchange="change_quantity(this,<?php echo $goods['id']; ?>,'change')"/><button class="plus" onclick="change_quantity(this,<?php echo $goods['id']; ?>,'plus')">+</button></li><li id="total_price_<?php echo $goods['id']; ?>">￥<?php echo $goods['total_price']; ?></li><li><p onclick="delete_goods(0,<?php echo $goods['id']; ?>)">删除</p><?php if($goods['collection'] > 0): ?><p onclick="ajax_collection(0,<?php echo $goods['goods_id']; ?>,this)" id="collection_<?php echo $goods['id']; ?>" >取消收藏</p><?php else: ?><p onclick="ajax_collection(0,<?php echo $goods['goods_id']; ?>,this)" id="collection_<?php echo $goods['id']; ?>" sta="-1">加入我的收藏</p><?php endif; ?></li></ul><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?><ul><li><input type="checkbox" class="checkall"/></li><li>全选 </li><li onclick="delete_goods(1)">删除</li><li	onclick="ajax_collection(1)">加入我的收藏夹</li><li class=" fr" onclick="location.href='<?php echo U('order/index'); ?>'">结算</li><li class=" fr">合计(不含运费)：<span id="totalmoney" class="num">￥<?php echo $cart_data['money']; ?></span></li><li class=" fr">已选购 <span id="totalnum" class="num"><?php echo $cart_data['goods_count']; ?></span> 件 <span class="iconfont icon-doubleangleup"></span></li></ul></div><?php else: ?><div class="empty_msg"><p style="font-size:30px ">您购物车没有商品，跳转到<a href="<?php echo U('shop/index/index'); ?>" style="font-size:30px ;color: red">首页</a></p></div><?php endif; ?><script type="text/javascript">			/*
			* 改变购物车商品数量
			* */
            function change_quantity(obj,id,type) {
                var good_count=$("#good_count_"+id).val();
                if(type=='minus'){
                    good_count--;
				}else if(type=='plus'){
					good_count++;
				}
                var url = "<?php echo U('Cart/change_quantity'); ?>";
				var data={'id':id,'good_count':good_count};
				$.post(url,data,function (res) {
					if(res.code==1){
                        $("#good_count_"+id).val(good_count);
						$("#total_price_"+id).html(res.data.total_price);
						$("#totalmoney").html("￥"+res.data.cart_total.total_price);
                        $("#totalnum").html(res.data.cart_total.goods_count);
					}else{
					    layer.msg(res.msg,{shade: 0.3,});
					}
                },"json")
            }
//type 1:删除checked选中 0：删除点击
            function delete_goods(type,id) {
                layer.confirm('您确定要删除选择的商品？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    var ids;
                    (typeof(id) != "undefined")?ids=id:ids='';
                    if(ids==''){
                        ids=get_checked();
					}

					var url = "<?php echo U('Cart/delect_goods'); ?>";
					$.post(url,{'ids':ids},function (res) {
						if(res.code==1){
						    $("#kind_num").html(res.data.kind_num)
                            $("#totalmoney").html("￥"+res.data.total_price);
                            $("#totalnum").html(res.data.goods_count);
                            if(type==0){
                                $("#ul_"+id).remove();
							}else {
                                $("input[name='Check[]']:checkbox:checked").each(function(){
                                    $("#ul_"+$(this).val()).remove();
                                });
							}
                            //当店铺商品全部删除，删除店铺
                            $(".store-name").each(function () {
                                if($(this).next().attr("class")!='shop-detail'){
                                    this.remove();
                                }
                            });
						}
                        layer.msg(res.msg,{shade: 0.3,});
                    },"json")
                }, function(){

                });
            }

            //商品或店铺收藏
			//ctype 1:收藏checked选中 0：收藏点击
            function ajax_collection(ctype,id,obj){
                var target_id;
                var type = 'goods';
                var url = "<?php echo U('collection/ajax_collection'); ?>";
                (typeof(id) != "undefined")?target_id=id:target_id='';
                if(target_id==''){
                    target_id=get_checked();
                }
                $.ajax({
                    type: "post",
                    url: url,
                    data: {id: target_id, type: type,ctype:ctype},
                    dataType: 'json',
                    success: function (re) {
                        if (ctype == 1) {
                            $("input[name='Check[]']:checkbox:checked").each(function(k,v){
                                $("#collection_"+$(v).val()).html("取消收藏");
                            })

                        }else {
                            if (re == '1') {
                                $(obj).html('取消收藏');
                            } else if (re == '-1') {
                                $(obj).html('加入我的收藏');
                            }
						}
                    }
                })
            }
			$(function(){
				$(".checkall").on("click",function(){
					var self=this;
					$(":checkbox").prop("checked",self.checked);					
				})
				$(".store").on("click",function(){
					var self=this;
					$(self).parent().parent().parent().find(":checkbox").prop("checked",self.checked);					
				})
			})

			function get_checked() {
                var ids='';
                    $("input[name='Check[]']:checkbox:checked").each(function(k,v){
                        if(k==0){
                            ids+=$(v).val();
                        }else{
                            ids+=","+$(v).val();
                        }
                    })
                return ids;
            }
		</script></body></html></div><?php if(!isset($bottom_nav) || $bottom_nav !== false): ?><div class="fild"><div class="container"><div class="row d_floarig"><div class="col-sm-2 d_padi "><img src="<?php echo $img; ?>/baozhang.png" /><p>30天退换货保障</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/baoyou.png" /><p>购买满199包运费</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/fukuan.png" /><p>货到付款</p></div><div class="col-sm-2 d_padi flaorigt"><img src="<?php echo $img; ?>/kefu.png" /><p>售后无忧</p></div></div></div></div><div class="container list-style"><?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="ul2"><?php if(is_array($vo['name']) || $vo['name'] instanceof \think\Collection || $vo['name'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['name'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$name): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $name['href']; ?>"><?php echo $name['article_title']; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><?php endforeach; endif; else: echo "" ;endif; ?><div class="ul2"><img src="<?php echo getImg(config($logo='qr_code')); ?>" alt=""  class="qr_code" /></div></div><?php endif; ?><div class="container text"><p><?php echo $webInfo; ?></p><div class="bottom"><a href=""><img src="<?php echo $img; ?>/bottom.png" alt="" /></a></div></div><script type="text/javascript">        //收藏夹图标
        $(".shouc").hover(
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucangh.png")
            },
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucang.png")
            }
        );
    </script></body><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $js; ?>/shop.js"></script></html>