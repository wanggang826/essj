<?php if (!defined('THINK_PATH')) exit(); /*a:16:{s:71:"D:\phpStudy\WWW\adminui/public\theme\shop\default\shop\good_detail.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\shop\shop_nav.html";i:1500431396;s:76:"D:\phpStudy\WWW\adminui/public\theme\shop\default\goods\good_detail_pic.html";i:1500431395;s:81:"D:\phpStudy\WWW\adminui/public\theme\shop\default\goods\good_detail_left_bar.html";i:1500431395;s:80:"D:\phpStudy\WWW\adminui/public\theme\shop\default\goods\good_detail_content.html";i:1500431395;s:77:"D:\phpStudy\WWW\adminui/public\theme\shop\default\goods\good_detail_attr.html";i:1500431395;s:76:"D:\phpStudy\WWW\adminui/public\theme\shop\default\goods\good_detail_com.html";i:1500446650;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\page.html";i:1500431396;s:81:"D:\phpStudy\WWW\adminui/public\theme\shop\default\adv_pos\good_detail_bottom.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><link type="text/css" rel="stylesheet" href="<?php echo $css; ?>/good_detail.css" /><style type="text/css">	#magnifier{
		width:350px;
		height:350px;
		font-size:0;
		border:1px solid #000;
	}
	#img{
		width:350px;
		height:350px;
	}

	#mag{
		border:1px solid #000;
		overflow:hidden;
		z-index:100;
	}
</style><script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":[]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script><link type="text/css" rel="stylesheet" href="<?php echo $css; ?>/shop_nav.css" /><div class="container mag-top1"><div class="row"><div class="d_banner"><a href=""><img src="" alt="shop_banner" /></a></div></div></div><div class="d_container-fluid1"><div class="container public"><div class="row"><div class="d_nav"><?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a><?php endforeach; endif; else: echo "" ;endif; ?></div><input class="input4" type="button" value="搜索"><input class="input3" type="text" name="" id="" value="" placeholder="输入关键字" /></div></div></div><div class="h_concent"><div class="h_glass"><div class="glass_lf"><div class="lanrenzhijia"><!-- 大图begin 800*800 --><!--<div  id="preview" class="spec-preview">&lt;!&ndash;id="content"&ndash;&gt;
		<a href="<?php echo $upload; ?><?php echo $good_info['goods_thums']; ?>" class="jqzoom" ><img  src="<?php echo $upload; ?><?php echo $good_info['goods_thums']; ?>" /></a></div>--><div ><div id="magnifier" class="spec-preview"><img jqimg="" src="<?php echo $upload; ?><?php echo $good_info['goods_thums']; ?>" id="img" /><div id="Browser"></div></div></div><div id="mag"><img id="magnifierImg" /></div><!-- 大图end 350*350 --><!-- 缩略图begin 50*50 --><div class="spec-scroll"><a class="prev"><img src="<?php echo $img; ?>/detali_lf.png"/></a><a class="next"><img src="<?php echo $img; ?>/detali_ri.png"/></a><div class="items"><ul ><!-- bimg大图 --><?php if($good_info['goods_img1'] != ''): ?><li><img bimg="" class="jane_img" src="<?php echo $upload; ?><?php echo $good_info['goods_img1']; ?>" onmousemove="preview(this);"></li><?php endif; if($good_info['goods_img2'] != ''): ?><li><img bimg="" class="jane_img" src="<?php echo $upload; ?><?php echo $good_info['goods_img2']; ?>" onmousemove="preview(this);"></li><?php endif; if($good_info['goods_img3'] != ''): ?><li><img bimg="" class="jane_img" src="<?php echo $upload; ?><?php echo $good_info['goods_img3']; ?>" onmousemove="preview(this);"></li><?php endif; if($good_info['goods_img4'] != ''): ?><li><img bimg="" class="jane_img" src="<?php echo $upload; ?><?php echo $good_info['goods_img4']; ?>" onmousemove="preview(this);"></li><?php endif; if($good_info['goods_img5'] != ''): ?><li><img bimg="" class="jane_img" src="<?php echo $upload; ?><?php echo $good_info['goods_img5']; ?>" onmousemove="preview(this);"></li><?php endif; ?><!--<li><img bimg="" src="" onmousemove="preview(this);"></li><li><img bimg="" src="" onmousemove="preview(this);"></li><li><img bimg="" src="" onmousemove="preview(this);"></li>--></ul></div></div></div><div class="h_share"><div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"><img src="<?php echo $img; ?>/share.png" class="h_share_img"/> 分享商品
			        		</a><p  class="h_share_atwo ajax_collection" id='collection_goods'  data-id="<?php echo $good_info['goods_id']; ?>" data-type="goods" data-look="<?php echo $good_info['look_num']; ?>" data-url="<?php echo url('Collection/ajax_collection'); ?>" ><?php if($good_info['c_goods'] == 1): ?><i class='icon i-shoucang' style='color:yellow'></i>取消收藏(<?php echo $good_info['look_num']; ?>人气)
			        		<?php else: ?><i class='icon i-shoucang'></i>收藏商品(<?php echo $good_info['look_num']; ?>人气)
			        		<?php endif; ?></p><p  class="h_share_athree">举报</p></div></div></div><div class="glass_ri"><p class="glass_title"><a href="#"><?php echo $good_info['goods_name']; ?></a></p><div class="h_price"><div class="price_lf"><div class="price_sp1"><span>价格：</span><span>￥<?php echo $good_info['market_price']; ?></span></div><div class="price_sp2"><span>促销：</span><span class="aaa">￥<?php echo $good_info['shop_price']; ?></span></div></div><div class="price_ri"><span>累计销售：<?php echo $good_info['sale_count']; ?></span><span>累计评价：<?php echo $good_info['goods_comment']; ?></span></div></div><form id="good_detail" action="<?php echo U('Cart/shopping_cart'); ?>"  method="post" class="js-ajax-form"><input class="inputclass" name="shop_id"       type='hidden' value="<?php echo $good_info['shop_id']; ?>"><!--商品id--><input class="inputclass" name="goods_name"    type='hidden' value="<?php echo $good_info['goods_name']; ?>"><!--商品名称--><input class="inputclass" name="goods_id"      type='hidden' value="<?php echo $good_info['goods_id']; ?>"><!--商品id--><input class="inputclass" name="market_price"  type='hidden' value="<?php echo $good_info['market_price']; ?>"><!--商品原价--><input class="inputclass" name="present_price" type='hidden' value="<?php echo $good_info['shop_price']; ?>"><!--商品成交价--><input class="inputclass" name="good_image"    type='hidden' value="<?php echo $good_info['goods_thums']; ?>"><!--图片名称--><input class="inputclass" name="despatch_money"type='hidden' value="0"><!--快递费--><div class="h_detail"><div class="detail_sp1"><span class="first_sp">运费</span><span><?php echo $shop_info['area_name1']; ?><?php echo $shop_info['area_name2']; ?><?php echo $shop_info['area_name3']; ?>至<?php echo $area['region']; ?><?php echo $area['city']; ?><img src="<?php echo $img; ?>/jiantou.png"></span><span>快递免邮</span></div><?php if(is_array($goods_attrs) || $goods_attrs instanceof \think\Collection || $goods_attrs instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_attrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attrs): $mod = ($i % 2 );++$i;?><div class="detail_sp1 addbackgroudone <?php echo $attrs['attr_name']; ?>" ><span class="first_sp"><?php echo $attrs['attr_name']; ?></span><?php if(is_array($attrs['value']) || $attrs['value'] instanceof \think\Collection || $attrs['value'] instanceof \think\Paginator): $i = 0; $__LIST__ = $attrs['value'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$values): $mod = ($i % 2 );++$i;?><input class="inputclass" name="<?php echo $attrs['attr_name']; ?>_attr" id="<?php echo $attrs['attr_name']; ?>" type='hidden' value=""><button id="<?php echo $attrs['attr_name']; ?><?php echo $values; ?>" style="" type="button" onclick='check("<?php echo $values; ?>","<?php echo $attrs['attr_name']; ?>")'><?php echo $values; ?></button><?php endforeach; endif; else: echo "" ;endif; ?></div><?php endforeach; endif; else: echo "" ;endif; ?><div class="detail_sp1"><span class="first_sp">数量</span><input class="inputclass" id="input2" type='button' value="-"><input class="inputclass" id="input0" type='text' min="1" max="<?php echo $good_info['book_quantity']; ?>" onkeyup="count(this.value)" name='good_count' value="1" ><input class="inputclass" id="input1" type='button'  value="+"></div></div><div class="h_button"><button type="button" onclick="buy(<?php echo $good_info['goods_id']; ?>)">立即购买</button><button type="button"  class="js-submit-btn">加入购物车</button></div></form></div></div><div class="detail_show"><div class="detailshow_lf"><div class="detailshow_lftop"><span><?php echo $good_info['shop_name']; ?></span></div><div class="detailshow_lfbut"><button><a href="#">进入店铺</a></button><button class="ajax_collection" id='collection_shop'  data-id="<?php echo $good_info['shop_id']; ?>" data-type="shop" data-url="<?php echo url('Collection/ajax_collection'); ?>"><?php if($good_info['c_shop'] == 1): ?><a href="#">取消店铺收藏</a><?php else: ?><a href="#">收藏店铺</a><?php endif; ?></button></div><div class="detailshow_center"><div class="call"><span>客服中心</span></div><div class="service"><div class="call_list"><span><a href="#">客服001</a></span><img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=3246316512&o=im.qq.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:3246316512:10 alt="点击这里给我发消息"></div><div class="call_list"><span><a href="#">客服002</a></span><img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=3246316512&o=im.qq.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:3246316512:10 alt="点击这里给我发消息"></div><div class="call_list"><span><a href="#">客服003</a></span><img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=3246316512&o=im.qq.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:3246316512:10 alt="点击这里给我发消息"></div></div><div class="work_time"><span>工作时间</span><span>周一至周五:8:30-24:00</span><span>周六至周日:8:30-24:00</span></div></div><div class="detailshow_center"><div class="call"><span>销售排行榜</span></div><?php if(isset($sale_goods)): if(is_array($sale_goods) || $sale_goods instanceof \think\Collection || $sale_goods instanceof \think\Paginator): $i = 0; $__LIST__ = $sale_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="ranking_list"><a href="<?php echo U('Shop/good_detail',['id'=>$vo['goods_id']]); ?>"><img src="<?php echo getImg($vo['goods_thums']); ?>"/></a><p><a href="<?php echo U('Shop/good_detail',['id'=>$vo['goods_id']]); ?>"><?php echo $vo['goods_name']; ?>&nbsp;<?php echo $vo['recom_desc']; ?></a></p><span>￥<?php echo $vo['shop_price']; ?></span><span>已销售<?php echo $vo['sale_count']; ?></span><div class="clear"></div></div><?php endforeach; endif; else: echo "" ;endif; endif; ?></div></div><div class="detailshow_ri"><div id="h_sp3"><span class="red">商品详情</span><span>规格参数</span><span>商品评价<b>(1222222)</b></span></div><div id="h_xxk"><div class="stencil_img">						good_detail_content.html
					</div><div class="stencil_img"><p>相关规格参数</p><div class="parameter"><div class="parameter1"><span>材质成分：聚酯纤维90%</span><span>风格：甜美</span><span>领型：圆领</span><span>款式：其他/other</span></div><div class="parameter1"><span>销售渠道类型：纯电商(只在线上销售)</span><span>学院组合形式：单件</span><span>袖型：其他</span><span>袖长：短袖/other</span></div><div class="parameter1"><span>货号：HGDE6443</span><span>裙长：中裙</span><span>元素/工艺：印花</span><span>裙型：其他</span></div><div class="clear"></div></div></div><div class="stencil_img"><div class="xing"><img src="<?php echo $img; ?>/xing.jpg"/><img src="<?php echo $img; ?>/qingjia.png"/><img src="<?php echo $img; ?>/qin5.png"/><div class="clear"></div></div><div class="evaluate"><div class="evaluate_top"><div class="h_radio"><input type="radio" name="radio" onclick="radio(this.value,'<?php echo $good_info['goods_id']; ?>')"  value="all" checked /><span>全部评价<span>(12122212)</span></span></div><div class="h_radio"><input type="radio" name="radio" onclick="radio(this.value,'<?php echo $good_info['goods_id']; ?>')"  value="img" /><span>晒图<span>(121212)</span></span></div><div class="clear"></div></div><div class="evaluate_list"><!--<div class="evaluate_div"><div class="evaluate_img"><img src=""/><span>j***4</span><span>铜牌等级</span></div><div class="evaluate_quality"><img src=""/><p>布料不错，做工精细，非常不错</p><span>颜色：xxx</span><span>规格：xxx</span><span>2017-05-10 09：40</span></div><div class="clear"></div></div>--><?php if(is_array($goods_comment) || $goods_comment instanceof \think\Collection || $goods_comment instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><div class="add"><div class="evaluate_div"><div class="evaluate_img"><img class="headimg" src="<?php echo $upload; ?><?php echo $comment['headimg']; ?>"/><span class="nickname"><?php echo $comment['nickname']; ?></span><!--<span>铜牌等级</span>--></div><div class="evaluate_quality"><p class="comment"><?php echo $comment['comment']; ?></p><div class="quality_img"><?php if($comment['com_img1'] != ''): ?><img src="<?php echo $upload; ?><?php echo $comment['com_img1']; ?>"/><?php endif; if($comment['com_img2'] != ''): ?><img src="<?php echo $upload; ?><?php echo $comment['com_img2']; ?>"/><?php endif; if($comment['com_img3'] != ''): ?><img src="<?php echo $upload; ?><?php echo $comment['com_img3']; ?>"/><?php endif; if($comment['com_img4'] != ''): ?><img src="<?php echo $upload; ?><?php echo $comment['com_img4']; ?>"/><?php endif; if($comment['com_img5'] != ''): ?><img src="<?php echo $upload; ?><?php echo $comment['com_img5']; ?>"/><?php endif; ?><div class="clear"></div></div><div class="quality_sp"><div class="attr"><?php if($comment['good_attr'] != ''): if(is_array($comment['good_attr']) || $comment['good_attr'] instanceof \think\Collection || $comment['good_attr'] instanceof \think\Paginator): $i = 0; $__LIST__ = $comment['good_attr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i;?><span><?php echo $key; ?>：<?php echo $attr; ?></span><?php endforeach; endif; else: echo "" ;endif; endif; ?></div><!--<span>颜色：xxx</span><span>规格：xxx</span>--><span class="time"><?php echo $comment['create_time']; ?></span></div><div class="tail"><?php if($comment['reply'] != ''): ?><span>[买家回复: ]</span><p><?php echo $comment['reply']['comment']; ?></p><?php endif; ?><!--<span>[购买5天后追评]</span><p>布料不错，做工精细，非常不错</p>--></div></div><div class="clear"></div></div></div><?php endforeach; endif; else: echo "" ;endif; ?><div class="page"><div class="page1" style="text-align: center"><?php echo $goods_comment->render(); ?></div></div><!--<div class="page"><div class="page1"><input class="pagefy" type="button" name="" id="" value="首页" /><input class="pagefy" type="button" name="" id="" value="上一页" /><input class="pagefy" type="button" name="" id="" value="1" /><input class="pagefy" type="button" name="" id="" value="2" /><input class="pagefy" type="button" name="" id="" value="3" /><input class="pagefy" type="button" name="" id="" value="..." /><input class="pagefy" type="button" name="" id="" value="20" /><input class="pagefy" type="button" name="" id="" value="末页" /><input class="pagefy" type="button" name="" id="" value="下一页" /><span class="gon">共20页</span><span>跳转至</span><input class="tiaoz" type="text" name="" id="" value="" /><span>页</span><input class="pagefy" type="button" name="" id="" value="确定" /></div></div>--></div></div><script>        var htmlobj = $(".evaluate_div").eq(0).clone();
        htmlobj.find(".quality_img").empty();//图片
		htmlobj.find(".attr").empty();//属性
		htmlobj.find(".tail").empty();//回复
        var imgobj  = htmlobj.find(".quality_img").eq(0).clone();
        //分页
        $(function(){
            $(".active").addClass("adcol")
        })
		function radio(type,id){
		    var url = "<?php echo U('Shop/good_detail'); ?>";
		    $.ajax({
				url:url,
				type:'post',
				data:{type:type,goods_id:id},
				dataType:'json',
				success:function(msg){
                    console.log(htmlobj.find('img'));
				    var data   = msg.data;
				    var length = data.length;
                    $(".add").empty();
				    if(length){
						for(var i=0;i<length;i++){
						    var img  = "";//图片
						    var attr = "";//属性
							var tail ="";//回复
						    var html = htmlobj.clone();
                            html.find(".nickname").html(data[i].nickname);
                            html.find(".comment").html(data[i].comment);
                            html.find(".headimg").attr('src',data[0].headimg_url+data[i].headimg);
							html.find(".time").html(data[i].create_time);
                            if(data[i].com_img1 !=''){
                                img += '<img src='+data[0].headimg_url+data[i].com_img1+'>';
                            }
                            if(data[i].com_img2 !=''){
                                img += '<img src='+data[0].headimg_url+data[i].com_img2+'>';
                            }
                            if(data[i].com_img3 !=''){
                                img += '<img src='+data[0].headimg_url+data[i].com_img3+'>';
                            }
                            if(data[i].com_img4 !=''){
                                img += '<img src='+data[0].headimg_url+data[i].com_img4+'>';
                            }
                            if(data[i].com_img5 !=''){
                                img += '<img src='+data[0].headimg_url+data[i].com_img5+'>';
                            }
                            html.find('.quality_img').append(img);
                            if(data[i].good_attr !=''){
                                var good_attr = data[i].good_attr;
                                for (var l in good_attr){
                                    var attr ="";
                                    attr =" <span>"+l+':'+good_attr[l]+"</span>"
                                    html.find('.attr').append(attr);
                                }
                            }

                            if(data[i].reply !=''){
                                tail += "<span>[买家回复: ]</span>";
                                tail += "<p><?php echo $comment['reply']['comment']; ?></p>";
                            }
                            html.find('.tail').append(tail);
						}
                        $(html).appendTo('.add');
					}
				}
			})
		}


	</script></div></div></div></div><div class="h_sponsor"><?php if(isset($adv['GOOD_DETAIL_BOTTOM'])): $vo=$adv['GOOD_DETAIL_BOTTOM']['0']; ?><a href="<?php echo $vo['adv_url']; ?>" class='adv_click_num' data-id='<?php echo $vo['adv_id']; ?>' data-url="<?php echo U('AdvPos/adv_click_num'); ?>"><img src="<?php echo getImg($vo['adv_img']); ?>" alt='商品详情页广告位good_detail_bottom'/></a><?php endif; ?></div></div><script src="<?php echo $js; ?>/vue.js"></script><script src="<?php echo $web_static; ?>/plugins/jquery.jqzoom.js"></script><script>        function change_pic(){
            var imgObj = document.getElementById("caocao_pic");
            var Flag=(imgObj.getAttribute("src",2)=="img/shoucangh.png");
            imgObj.src=Flag?"img/shoucang.png":"img/shoucangh.png";
            return false;
        }
        /*
         * 点击选中商品属性并改变选中样式
         * */
		function  check(val,type){
			$('#'+type).val(val);
            $("."+type).find('button').css('border-color','');
			$("#"+type+val).css('border-color','#ed145b');
		}
		/*
		* 立即购买
		* */
		function buy(id){
		    var url = "<?php echo U('Shop/good_detail'); ?>?id="+id;
            var obj = window.parent.document;
            $(obj).find('#good_detail').attr('action',url);
            $("#good_detail").submit();
		}
        /**
		 * 手动输入商品数量
         */
        function count(count){
            var  par = /^[1-9]\d*$/;
            if(!par.test(count)){
            	$("#input0").val(1);
            }
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