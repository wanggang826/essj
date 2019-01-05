<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:76:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\u_message.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:75:"D:\phpStudy\WWW\adminui/public\theme\shop\default\user_center\side_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>/xiaoxi.css" /><div class="container"><div class="position"><p>您的位置：</p><a href="">首页 ></a><a href="">订单中心 ></a><p>消息中心</p></div><div class="indent_fl"><div class="h_sidebar"><div class="sidebar_centre"><ul><div class="h_square"><i class="icon i-wodedingdan"></i><span>订单中心</span></div><li><a href="<?php echo urldo('user_center/u_order'); ?>">我的订单</a></li><li><a href="<?php echo urldo('user_center/order_recycle'); ?>">订单回收站</a></li><li><a href="<?php echo urldo('user_center/evaluate'); ?>">评价管理</a></li><li><a href="#">购买过的店铺</a></li><li><a href="#">我的积分</a></li><li><a href="<?php echo urldo('user_center/u_message'); ?>">消息中心</a></li><li><a href="<?php echo urldo('user_center/u_collection'); ?>">我的收藏</a></li><li><a href="#">购物车</a></li><li><a href="#">我的足迹</a></li><div class="h_borde"></div></ul><ul><div class="h_square"><i class="icon i-shezhi"></i><span>设置</span></div><li><a href="<?php echo urldo('user_center/u_info'); ?>">个人信息</a></li><li><a href="<?php echo urldo('user_center/u_safe'); ?>">账户安全</a></li><li><a href="<?php echo urldo('user_center/u_address'); ?>">收货地址</a></li><li><a href="<?php echo urldo('user_center/u_binding'); ?>">账户绑定</a></li><li><a href="<?php echo urldo('user_center/u_changepass'); ?>">修改密码</a></li><div class="h_borde"></div></ul></div><script type="text/javascript">
    var url = window.location.href;
    var $a  = $('.sidebar_centre ul li').find('a');
    $a.parent().removeClass('sidebar_lired');
    $a.removeClass('sidebar_red');
    $a.each(function() {
        if($(this).attr('href') == url){
            $(this).addClass('sidebar_red');
        }
    });
</script></div></div><div class="dsystem"><div class="notice"><div class="notice1"><img src="<?php echo $img; ?>/xiaoxi1.png" /><div class="tongzhi"><p class="tongzhi1">系统消息</p><p class="tongzhi2"><?php if($shop['unread_num'] > 0): ?><?php echo $shop['unread_num']; ?>条读消息<?php else: ?>无未读消息<?php endif; ?></p></div></div><div class="notice1"><img src="<?php echo $img; ?>/gonggao.png" /><div class="tongzhi"><p class="tongzhi1" >系统公告</p></div></div></div><div class="pack"><div class="posih"><div class="messages"><?php if(is_array($shop['messages']) || $shop['messages'] instanceof \think\Collection || $shop['messages'] instanceof \think\Paginator): $i = 0; $__LIST__ = $shop['messages'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><div class="message" ><p class="centerx"><?php echo $message['create_time']; ?></p><div class="textx"><img class="guanbi" src="<?php echo $img; ?>/XX_03.png" alt="" /><div class="textmag"><p class="textp"><?php echo $message['title']; ?></p><p class="textp1"><?php echo $message['content']; ?></p><p class="textp2"><a class="url" href="<?php echo U('Index/article_detail',['message_id'=>$message['msg_id']]); ?>">查看详情<img class="dayus" src="<?php echo $img; ?>/shuangdayu_03.png" alt="" /></a></p></div></div></div><?php endforeach; endif; else: echo "" ;endif; ?></div><div class="chakans"><span class="chakan message_next" >查看更多消息</span><input type="hidden"  id ="message_page" value="1"><input type="hidden"  id ="message_type" value="message"></div></div><div class="posih"><div class="article"><?php if(is_array($shop['article']) || $shop['article'] instanceof \think\Collection || $shop['article'] instanceof \think\Paginator): $i = 0; $__LIST__ = $shop['article'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$articles): $mod = ($i % 2 );++$i;?><div><p class="centerx"><?php echo $articles['create_time']; ?></p><div class="textx"><img class="guanbi" src="<?php echo $img; ?>/XX_03.png" alt="" /><div class="textmag"><p class="textp"><?php echo $articles['article_title']; ?></p><p class="textp1"><?php echo $articles['article_content']; ?></p><p class="textp2"><a class="url" href="<?php echo U('Index/article_detail',['article_id'=>$articles['article_id']]); ?>">查看详情<img class="dayus" src="<?php echo $img; ?>/shuangdayu_03.png" alt="" /></a></p></div></div></div><?php endforeach; endif; else: echo "" ;endif; ?></div><div class="chakans"><span class="chakan article_next">查看更多消息</span><input type="hidden"  id ="article_page" value="1"></div></div></div></div></div><script src="<?php echo $js; ?>/myjs.js" type="text/javascript" charset="utf-8"></script><script>			var messageobj = $(".posih").find('.message').eq(0).clone();
			$(".article_next").click(function(){
                var dataId = $("#article_page").val();
                dataId++
                $("#message_page").val(dataId);
                message_ajax(dataId,'article',120);
			})
			$(".message_next").click(function(){
				var message_type =  $("#message_type").val();
				var dataId = $("#message_page").val();
				dataId++
				$("#message_page").val(dataId);
				message_ajax(dataId,message_type,'');

			})
			function message_ajax(dataId,message_type,message_status) {
				var url = "<?php echo U('UserCenter/u_message'); ?>";
				$.ajax({
					url:url,
					type:'post',
					data:{'page':dataId,'message_type':message_type,'message_status':message_status},
					dataType:'json',
					success:function(msg){
						var data = msg.data;
						var length = data.length;
						if(length){
							for (var i=0;i<length;i++){
								var html = messageobj.clone();
								if(data[i].article_id){
									html.find('.centerx').html(data[i].create_time);
									html.find('.textp').html(data[i].article_title);
									html.find('.textp1').html(data[i].article_content);
									html.find('.url').attr('href',data[i].article_url+"?article_id="+data[i].article_id);
                                    $('.article').append(html[0].outerHTML);
								}else if(data[i].msg_id){
									html.find('.centerx').html(data[i].create_time);
									html.find('.textp').html(data[i].title);
									html.find('.textp1').html(data[i].content);
									html.find('.url').attr('href',data[i].message_url+"?message_id="+data[i].msg_id);
                                    $('.messages').append(html[0].outerHTML);
								}
							}
						}
					}
				})
			}
		</script><?php if(!isset($bottom_nav) || $bottom_nav !== false): ?><div class="fild"><div class="container"><div class="row d_floarig"><div class="col-sm-2 d_padi "><img src="<?php echo $img; ?>/baozhang.png" /><p>30天退换货保障</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/baoyou.png" /><p>购买满199包运费</p></div><div class="col-sm-2 d_padi magleft"><img src="<?php echo $img; ?>/fukuan.png" /><p>货到付款</p></div><div class="col-sm-2 d_padi flaorigt"><img src="<?php echo $img; ?>/kefu.png" /><p>售后无忧</p></div></div></div></div><div class="container list-style"><?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="ul2"><?php if(is_array($vo['name']) || $vo['name'] instanceof \think\Collection || $vo['name'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['name'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$name): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $name['href']; ?>"><?php echo $name['article_title']; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><?php endforeach; endif; else: echo "" ;endif; ?><div class="ul2"><img src="<?php echo getImg(config($logo='qr_code')); ?>" alt=""  class="qr_code" /></div></div><?php endif; ?><div class="container text"><p><?php echo $webInfo; ?></p><div class="bottom"><a href=""><img src="<?php echo $img; ?>/bottom.png" alt="" /></a></div></div><script type="text/javascript">        //收藏夹图标
        $(".shouc").hover(
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucangh.png")
            },
            function() {
                $(".shouc img").attr("src", "<?php echo $img; ?>/shoucang.png")
            }
        );
    </script></body><script src="<?php echo $web_static; ?>/js/common.js"></script><script src="<?php echo $js; ?>/shop.js"></script></html>