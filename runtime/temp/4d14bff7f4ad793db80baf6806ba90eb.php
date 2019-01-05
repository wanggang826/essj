<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:73:"D:\phpStudy\WWW\adminui/public\theme\shop\default\seller_center\cash.html";i:1500431395;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\layout.html";i:1500431396;s:69:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\top_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo_serch.html";i:1500431396;s:66:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\logo.html";i:1500431396;s:79:"D:\phpStudy\WWW\adminui/public\theme\shop\default\seller_center\seller_bar.html";i:1500431395;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_bar.html";i:1500431396;s:72:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\bottom_nav.html";i:1500431396;s:68:"D:\phpStudy\WWW\adminui/public\theme\shop\default\layout\footer.html";i:1500431396;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head><meta charset="UTF-8"><meta name="renderer" content="Webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php echo $title; ?></title><link href="<?php echo $web_static; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="<?php echo $css; ?>headfoot.css" /><link href="<?php echo $web_static; ?>/css/font-awesome.min.css" rel="stylesheet"><link href="<?php echo $web_static; ?>/css/animate.css" rel="stylesheet"><script src="<?php echo $web_static; ?>/js/jquery.min.js"></script><script src="<?php echo $web_static; ?>/plugins/bootstrap/js/bootstrap.min.js"></script><script src="<?php echo $web_static; ?>/plugins/layui/layer/layer.js"></script><!--时间日期插件--><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js"></script><script src="<?php echo $web_static; ?>/js/layer.com.js"></script><link rel="stylesheet" href="<?php echo $css; ?>/icon/iconfont.css"></head><body><div class="d_container-fluid"><div class="container"><div class="row"><div class="col-sm-4 d_padi d_top"><a href="<?php echo url('index/index'); ?>" class="d_redp">商城首页</a><?php $user = session('user');; if($user): ?><a href="<?php echo url('user_center/index'); ?>" class="d_redp">hello <?php echo $user['account']; ?></a><?php else: ?><a href="<?php echo url('user_center/login'); ?>" class="d_redp">请登录 </a><a href="<?php echo url('user_center/reg'); ?>" class="d_huip">免费注册</a><?php endif; ?><a href="" class="d_huip">手机app</a></div><div class="col-sm-8 d_padi d_float"><a href="">帮助中心</a><a href="<?php echo url('seller_center/index'); ?>">卖家中心<img src="<?php echo $img; ?>/jiantou.png" alt="" /></a><div class="activ"></div><a class="shouc" href="<?php echo url('user_center/u_collection'); ?>"><img src="<?php echo $img; ?>/shoucang.png" />我的收藏</a><a href="<?php echo url('cart/index'); ?>"><img src="<?php echo $img; ?>/gouwuche.png" alt="" />我的购物车</a><a href="<?php echo url('user_center/index'); ?>">个人中心 <img src="<?php echo $img; ?>/jiantou.png" /></a></div></div></div></div><?php if(!isset($load_search) || $load_search !== false): ?><form action="" method="post"><div class="container mag-top"><div class="row"><div class="col-sm-4 d_padi"><div class="d_logo"><img src="<?php echo getImg(config($logo='web_logo')); ?>" alt="logo" /></div></div><div class="col-sm-6 d_padi pull-right input"><input class="input1" type="text" name="" id="" placeholder="输入关键字" /><input class="input2" type="button" value="搜索"></div></div></div></form><?php endif; ?><link rel="stylesheet" href="<?php echo $css; ?>/usernew.css"><link rel="stylesheet" href="<?php echo $css; ?>/my_main.css"><link rel="stylesheet" href="<?php echo $static; ?>icon/iconfont.css"><link rel="stylesheet" href="<?php echo $css; ?>/usernew.css"><!--head--><div class="h_concent"><div class="position"><p>您的位置：</p><a href="">首页 ></a><p>卖家中心 ></p><p>发货</p></div><div class="indent_fl"><div class="h_sidebar"><div class="sidebar_centre"><ul><div class="h_square"><img src="<?php echo $img; ?>/dian.png" class="ceimg"/><span>全部功能</span></div><li><a href="<?php echo urldo('seller_center/basic_settings'); ?>">店铺基本信息</a></li><li><a href="<?php echo urldo('seller_center/cash'); ?>">我的钱包</a></li><li><a href="<?php echo urldo('seller_center/s_good_mgr'); ?>">商品管理</a></li><li><a href="<?php echo urldo('seller_center/release_good'); ?>" >发布商品</a></li><li><a href="<?php echo urldo('seller_center/in_application'); ?>">资质认证</a></li><li><a href="">店铺经营许可证</a></li><li><a href="<?php echo urldo('seller_center/logistics'); ?>">物流管理</a></li><li><a href="<?php echo urldo('seller_center/deliver'); ?>">发货</a></li><li><a href="<?php echo urldo('seller_center/manage'); ?>">评价管理</a></li><li><a href="<?php echo urldo('seller_center/s_order'); ?>">订单列表</a></li><li><a href="<?php echo urldo('seller_center/s_nav'); ?>">分类菜单设置</a></li><div class="h_borde"></div></ul></div><script type="text/javascript">
    var url = window.location.href;
    var $a  = $('.sidebar_centre ul li').find('a');
    $a.parent().removeClass('sidebar_lired');
    $a.removeClass('sidebar_red');
    $a.each(function() {
        if($(this).attr('href') == url){
            $(this).addClass('sidebar_red');
        }
    });
</script></div></div><div class="indent_rirgt_basic"  id="mainnav"><div class="qbgn level1"><div class="navMid fleft "><div class="dpjbxx"><p><span class="jb"></span><span class="dp">我的钱包</span></p><div class="money-ka"><a class="xinZ">新增银行卡</a><ul class="fleft my-ul"><input type="hidden"  id="img_url" value="<?php echo $img; ?>"><input type="hidden" name="usable_money" id="usable_money" value="<?php echo $user_info['money']; ?>"><li><span>可取金额： <span class="user_money"><?php echo $user_info['money']; ?>元</span></span></li><li><span>待到帐金额： <span><?php echo $stay_money; ?>元</span></span></li><li><span>总金额： <span><?php echo $all_money; ?></span></span></li></ul><a class="tiQ">提现</a><ul class="fright my-ul"><?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$banks): $mod = ($i % 2 );++$i;?><li><?php if($key == 0): ?><span>绑定银行卡： <span><?php endif; ?><?php echo $banks['account_name']; ?>（尾号<?php echo $banks['account_end']; ?>）</span></span></li><?php endforeach; endif; else: echo "" ;endif; ?></ul><form id="add_bank" action="<?php echo U('Bank/add_bank'); ?>" method="post" class="js-ajax-form"><div class="yingHang"><p class="my-clear">绑定银行卡<b>×</b></p><div><p>请绑定持卡人本人银行卡</p><ul><input type="hidden" name="user_id" value="<?php echo $user_info['user_id']; ?>"><li><span>持有人</span><input type="text" name="realname" id="realname" value=""/></li><li><span>账号类型</span><select name="account_type" id="account_type" style="width: 210px;height:28px;"><option value="银行卡" selected="selected">银行卡</option><option value="支付宝">支付宝</option></select></li><li><span>账号</span><input type="text" name="account"  id="account" value=""/></li><li><span>手机号码</span><input type="text" name="phone"  id="phone" value=""/></li><li><span>短信验证码</span><input type="text" name="money_code"  id="money_code" value=""/><span><b>20</b>秒重发</span></li></ul></div><a href="javascript:;" class="ding1" onclick="present('bank')">确定</a></div><div class="clear"></div></form></div><div class="money-ka money-qing"><ul class="fleft"><li class="fleft"><form id="cash" action="<?php echo U('SellerCenter/cash'); ?>" method="post" class="js-ajax-form"><div class="yingHang1"><p class="my-clear">取现<b>×</b></p><div><ul style="height:140px"><li style="margin-top: 15px;"><span style="width:112px">请选择转入银行卡</span><select name="account" id="checkbank"><?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$banks): $mod = ($i % 2 );++$i;?><option value="<?php echo $banks['account']; ?>" <?php if($banks['status'] == 1): ?> selected="selected" <?php endif; ?>><?php echo $banks['account_name']; ?>(<?php echo $banks['account']; ?>)</option><?php endforeach; endif; else: echo "" ;endif; ?></select></li><li><span style="width:112px">输入取现金额</span><input type="text" id="money"  name="money"  value="<?php echo input('money'); ?>"/></li><li><span style="width:112px">短信验证码</span><input type="text" name="bank_code" id="bank_code"  value="<?php echo input('bank_code'); ?>" /><span><b>20</b>秒重发</span></li></ul></div><a href="javascript:;" style="margin-left: 200px;" class="queD" onclick="present('cash')">确定</a></div></form><div class="yingHang2"><p class="my-clear">操作成功<b>×</b></p><div><b id="images"></b><p class="add_type">添加成功 !</p><a href="" class="wang1">完成</a></div></div></li><form id="accounts" action="<?php echo U('SellerCenter/cash'); ?>" method="post"><li class="fleft"><span>金额情况:&nbsp;</span><select name="type"  class="quxian" ><option value="">所有情况</option><option value="out">支出</option><option value="in">收入</option></select><span></span></li><li class="fleft xiadan" style="margin-left: 50px;"><span>时间: </span><input type="text" style="width: 137px;height: 28px;margin-top: -4px;" name="statr_time" class="management_rightsoninputone  i-datestart"  placeholder="开始日期" />                                         至
                                        <input type="text" style="width: 137px;height: 28px;margin-top: -4px;" name="end_time" class="management_rightsoninputone  i-dateend" placeholder="结束日期" /></li><li class="fleft" style="margin-left: 218px;"><a href="javascript:;" class="cha" onclick="present('account')">查询</a></li></form><li class="clear"></li></ul><div class="clear"></div></div><div class="money-xin my-relative"><ul class="my-clear"><li class="fleft"><span>时间</span></li><li class="fleft"><span>金额情况</span></li><li class="fleft"><span>金额</span></li><li class="fleft"><span>备注信息</span></li><li class="clear"></li></ul><?php if(is_array($account) || $account instanceof \think\Collection || $account instanceof \think\Paginator): $i = 0; $__LIST__ = $account;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$accounts): $mod = ($i % 2 );++$i;?><ul class="my-clear"><li class="fleft"><span><?php echo $accounts['create_time']; ?></span></li><li class="fleft"><span><?php if($accounts['type'] == 'in'): ?>进账<?php elseif($accounts['type'] == 'out'): ?>支出<?php endif; ?></span></li><li class="fleft"><span><?php echo $accounts['amount']; ?></span></li><li class="fleft"><span><?php echo $accounts['desc']; ?></span><span>金额<?php echo $accounts['amount']; ?>元</span></li><li class="clear"></li></ul><?php endforeach; endif; else: echo "" ;endif; ?></div><div style="text-align: center"><?php echo $page; ?></div></div></div></div></div></div><script src="<?php echo $web_static; ?>/plugins/layui/laydate/laydate.js" charset="utf-8"></script><script type="text/javascript" src="<?php echo $web_static; ?>/js//uploadImg.js"></script><script src="<?php echo $js; ?>/jquery-migrate-1.2.1.min.js"></script><script src="<?php echo $js; ?>/main.js"></script><script>        //提交表单
        function present(type){
            if(type === 'bank'){
                var number       = 1;
                var img_url      = $("#img_url").val();
                var account_type = $("#account_type").val();
                var realname     = $("#realname").val();
                var account      = $("#account").val();
                var money_code   = $("#money_code").val();
                var phone        = $("#phone").val();
                var regex        = /^1[3|4|5|7|8][0-9]{9}$/;
                if(!regex.test(phone) || (phone == "")) {
                    number++;
                    callFun("请填写有效手机号码!","phone");
                }
                if(realname == ""){
                    number++;
                    callFun("请填写持有人!","realname");
                }
                if(account_type == ""){
                    number++;
                }
                if(account == ""){
                    number++;
                    callFun("请填写有效账号!","account");
                }
                if(money_code == ""){
                    number++;
                    callFun("请填写有效验证码!","money_code");
                }
                if(number==1){
                    var url = "<?php echo U('Bank/add_bank'); ?>";
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{'realname':realname,'account_type':account_type,'account':account},
                        dataType:'json',
                        success:function(msg){
                              if(msg === 1){
                                  $(".yingHang").css("display","none");
                                  $(".yingHang2").css("display","block");
                              }else{
                                  $(".yingHang2").find('.my-clear').html("操作失败!");
                                  document.getElementById("images").style.backgroundImage="url(../../theme/shop/default/static/img/dacha.png) ";
                                  $(".yingHang2").find('.add_type').html(msg);
                                  $(".yingHang2").css("display","block");
                                  $("#mainnav").css("marginBottom","129px");
							  }
                        }
                    })
                }

            }else if(type === 'cash'){
                var number       = 1;
                var money        = parseFloat($("#money").val()) ;
                var bank         = $("#checkbank").val();
                var bank_code    = $("#bank_code").val();
                var usable_money =$("#usable_money").val() ;
                if ((money == '') || (usable_money < money) || isNaN(money)) {
                    number++;
                    callFun("请填写有效的取现金额!","money");
                }
                if(bank == ""){
                    number++;
                }
                if(bank_code == ""){
                    number++;
                    callFun("请填写有效验证码!","bank_code");
                }
                if(number==1){
                    var url = "<?php echo U('SellerCenter/cash'); ?>";
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{'money':money,'bank':bank},
                        dataType:'json',
                        success:function(msg){
                            if(msg === 1){
                                $(".user_money").html(usable_money-money+"元");
                                $(".yingHang1").css("display","none");
                                $(".yingHang2").css("display","block");
                                $(".yingHang2").find('.add_type').html("取现成功!");
                            }else{
                                $(".yingHang2").find('.my-clear').html("操作失败!");
                                document.getElementById("images").style.backgroundImage="url(../../theme/shop/default/static/img/dacha.png) ";
                                $(".yingHang2").find('.add_type').html("可能由于可取金额不足的原因导致失败!");
                                $(".yingHang2").css("display","block");
                                $("#mainnav").css("marginBottom","129px");
							}
                        }
                    })
                }
            }else if(type === 'account'){
                $("#accounts").submit();
            }
        }
        //分页样式
        $(function(){
            $(".active").addClass("adcol");
            $(".active").unbind();
        })
        /**
         * 调用弹框
         */
        function  callFun(text,name){
            var tag   = '.js-ajax-form input[name="'+name+'"]';
            layerTips('<span class="msgFont" style="color:#000">'+text+'</span>',tag,'#FCEEF3',115);
            $('.msgFont').css({
                'padding-left': '22px',
                'background':'url(../../static/img/5.png) no-repeat',
            });
        }
        /**
         * 弹框样式
         */
        function layerTips(content,tag,color,offset){
            content = content ? content : '提示：错误';
            offset  = offset  ? offset  : 0;
            var tips_index = layer.open({
                content:[content,tag],
                type:4,
                shade :false,
                tips :[1,color],
                time:0,
                tipsMore: true,
                closeBtn:0,
            });
            var left = $(tag).offset().left + offset;
            $('.layui-layer-tips').css({
                'left':left
            });
            $(tag).data('tips',tips_index);
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