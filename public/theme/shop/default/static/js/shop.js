//广告点击数量
$(".adv_click_num").click(function(){
    var adv_id = $(this).data('id');
    var url = $(this).data('url');
    $.ajax({
    	type:"post",
    	url:url,
    	data:{adv_id:adv_id},
    })
})

//商品或店铺收藏
$(".ajax_collection").click(function(){
	var target_id = $(this).data('id');
	var type = $(this).data('type');
	var url = $(this).data('url');
	var look = $(this).data('look');
	$.ajax({
		type:"post",
		url:url,
		data:{id:target_id,type:type},
		dataType:'json',
		success:function(re){
			if(type == 'shop'){
				$("#collection_shop").empty();
				if(re == '1'){
					goods = "<a href='#'>取消店铺收藏</a>";
				}else if(re == '-1'){
					goods = "<a href='#'>收藏店铺</a>";
				}
				$(goods).appendTo("#collection_shop");
			}else if(type == 'goods'){
				$("#collection_goods").empty();
				if(re == '1'){
					goods = "<p><i class='icon i-shoucang' style='color:yellow'></i>取消收藏("+look+"人气)</p>";
				}else if(re == '-1'){
					goods = "<p><i class='icon i-shoucang'></i>收藏商品("+look+"人气)</p>";
				}
				$(goods).appendTo("#collection_goods");
			}
		} 
	});
})