
//定义ajax全局变量开始
var htmlobj = $('.indent_list .h_details').eq(0).clone();//克隆的部分模板
var good =  htmlobj.find('.details_butdiv1').eq(0).clone();//克隆的部分模板
//定义ajax全局变量结束
        $(document).ready(function() {
            //点击删除
            $(".dustbin").click(function(){
                $(this).parent().parent().remove();
            })
           //头部收藏
            $(".shouc").hover(function() {
                $(".shouc img").attr("src", "img/shoucangh.png")
            },function() {
                $(".shouc img").attr("src", "img/shoucang.png")
            });
            //全部状态的下拉列表
        $(".modhearsp4box li").bind('click', function(){
            $(".clickdddddd").html($(this).html());
        });
        $(".clickdddddd").click(function(){
                $(".modhearsp4box").toggle();
                $(this).parent().toggleClass("h_spdivbor");
                $(this).addClass("h_spdivborsp");
                $(".modhear_spimg").attr('src','img/jian2.png');
                $(".h_spdiv").css({"border":"0"});
                if($(".modhearsp4box").css("display")==="none"){
                    $(".clickdddddd").removeClass("h_spdivborsp");
                    $(".h_spdiv").css({"border":"1px solid #FFF","border":"0"});
                    $(".modhear_spimg").attr('src','img/jian.png');
                }
            })
          }).click (function (e){
            e = e || window.event;
            if (e.target != $ ('.clickdddddd')[0] && e.target != $ ('.modhearsp4box')[0])
            {
                $('.modhearsp4box').hide();
                $(".modhear_spimg").attr('src','img/jian.png');
                $(".clickdddddd").removeClass("h_spdivborsp");
                $(".h_spdiv").css({"border":"1px solid #fff","border":"0"});
            }
          });
         //选项卡
            window.onload=function(){
                //全部订单
            var titles=document.getElementById('notice-tit').getElementsByTagName('li');
            var divs=document.getElementById('notice-con').getElementsByClassName('mod');
            if(titles.length!=divs.length)
                return;
                for(var i=0;i<titles.length;i++){
                    titles[i].id=i;
                    titles[i].onclick=function(){
                            for(var j=0;j<titles.length;j++){
                            titles[j].className='';
                            divs[j].style.display='none';
                        }
                            titles[this.id].className='select';
                            divs[this.id].style.display='block';
                        //AJAX切换数据
                        var status;
                        if(this.id==0){
                            status=0;
                        }else if(this.id==1){
                            status=2;
                        }else if(this.id==2){
                            status=5;
                        }else if(this.id==3){
                            status=11;
                        }
                        status_Ajax(status);
                    }
                }
                //为你推荐
                function tab(){
                    var index=0;
                    var timer=null;
                    var commoditys=document.getElementById('h_commodity');
                    var recommendTopli=document.getElementById('h_recommendtopli').getElementsByTagName('li');
                    var commodity=document.getElementById('h_commodity').getElementsByClassName('commodity_particulars');
                    var prev = document.getElementById('hrecommendtopli_fl');
                    var next = document.getElementById('hrecommendtopli_ri');
                    for(var i=0;i<recommendTopli.length;i++){
                        recommendTopli[i].id=i;
                        recommendTopli[i].onmouseover=function(){
                        clearInterval(timer);
                        changeOption(this.id);
                    }
                        recommendTopli[i].onmouseout=function(){
                        timer=setInterval(autoPlay,4000);
                    }
                }
                    commoditys.onmouseover=function(){
                        clearInterval(timer);
                    }
                    commoditys.onmouseout=function(){
                        timer=setInterval(autoPlay,4000);
                    }
                        next.onclick = function() {
                            if(index >=3) {
                             index = 0;
                           } else {
                             index += 1;
                        }
                           changeOption(index);
                        }
                        prev.onclick = function() {
                            if(index <= 0) {
                             index = 3;
                           } else {
                             index -= 1;
                        }
                           changeOption(index);
                        }
                        if(timer){
                           clearInterval(timer);
                           timer=null;
                        }
                        timer=setInterval(autoPlay,4000);
                          function autoPlay(){
                              index++;
                              if(index>=recommendTopli.length){
                              index=0;
                           }
                           changeOption(index);
                       }
                 function changeOption(curIndex){
                    for(var j=0;j<recommendTopli.length;j++){
                       recommendTopli[j].className='';
                       commodity[j].style.display='none';
                   }
                    recommendTopli[curIndex].className='backradius';
                    commodity[curIndex].style.display='block';
                    index=curIndex;
                }
            }
                tab();
        }
//分页
$(function(){
    $(".active").addClass("adcol")
})

function status_Ajax(status,url) {

    alert(url);

    var  status = status;
    $.ajax({
        url:url,
        type:'post',
        data:{'status':status},
        dataType:'json',
        success:function(order){
            var data    = order.data;
            var length  = data.length;
            htmlobj.find('.details_butdiv1').remove();
            $(".indent_list").empty();
            $(".page1").empty();
            if(length){
                for (i=0;i<length;i++){
                    var html = htmlobj.clone();
                    //头部循环开始
                    html.find('.order_create_time').html(data[i].create_time);
                    html.find('.order_sn').html(data[i].order_sn);
                    html.find('.order_shop_id').html(data[i].shop_id);
                    //头部循环结束
                    for(j=0;j<data[i].goods_info.length;j++){
                        //商品循环开始
                        var goods =good.clone();
                        goods.find('.good_image').attr('src',data[i].good_image+data[i].goods_info[j].good_image);
                        goods.find('.goods_name').html(data[i].goods_info[j].goods_name);
                        goods.find('.goods_count').html("x"+data[i].goods_info[j].goods_count);
                        html.find('.details_butdiv').append(goods[0].outerHTML);
                        //商品循环结束
                    }
                    html.find('.user_name').html(data[i].user_name);
                    html.find('.total_price').html(data[i].total_price);
                    html.find('.deal_price').html(data[i].deal_price);
                    $(html).appendTo(".indent_list");
                }
                $(data[0].page).appendTo(".page1");
                $(".active").addClass("adcol");
            }else{

            }
        },

    })

}
