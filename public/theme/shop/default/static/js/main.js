jQuery(function($){
    var countHeight=function(ts){
        if(!!ts){
            $("#mainnav").height((parseInt($(ts).find(".dpjbxx").height())+38)+"px");
        }else{
            $("#mainnav").height((parseInt($(".dpjbxx").height())+38)+"px");
        }

        $("#mainnav").css("marginBottom","20px")
    }
    countHeight();
});

//新增银行卡
    var tanC=$(".xinZ");
    var tan1=$(".yingHang");
    var b1=$(".yingHang>p>b");
    var bank_length = $(".fright li").length;//该用户银行卡张数
    var yangshi  = $(".yingHang2 div b");
    tanC.click(function(){
        $(".yingHang1").hide();
        if(bank_length<3){
            tan1.css("display","block")
            $("#mainnav").css("marginBottom","129px");
        }else{
            $(".yingHang2").find('.my-clear').html("操作失败!");
            document.getElementById("images").style.backgroundImage="url(../../theme/shop/default/static/img/dacha.png) ";
            $(".yingHang2").find('.add_type').html("最多3张卡!");
            $(".yingHang2").css("display","block");
            $("#mainnav").css("marginBottom","129px");
        }
    });
    b1.click(function(){
        $(".layui-layer").remove();
    	tan1.css("display","none");
        $("#mainnav").css("marginBottom","20px");
    })
    //点击提取后
    var tiQ=$(".tiQ");
    var tiQ1=$(".yingHang1");
	var tiQ2=$(".yingHang1>p>b");
	var ding=$(".ding1");
    tiQ.click(function(){
    	$(tan1).hide();
    	tiQ1.css("display","block")
    	$(this).css('border:0');
        $("#mainnav").css("marginBottom","129px");
    })
    tiQ2.click(function(){
        $(".layui-layer").remove();
    	tiQ1.css("display","none")
        $("#mainnav").css("marginBottom","20px");
    })
    // ding.click(function(e){
    // 	e.preventDefault();
    // 	tan1.css("display","none")
    // })
//  点击确定后跳转成功
	var chengG=$(".queD");
	var que1=$(".yingHang2");
	var wan1=$(".wang1");
	var wan2=$(".yingHang2>p>b");
	// chengG.click(function(e){
	// 	e.preventDefault();
	// 	que1.css("display","block");
	// 	tiQ1.css("display","none");
	// });
	wan1.click(function(e){
		e.preventDefault();
		que1.css("display","none");
	});
	wan2.click(function(){
		que1.css("display","none");
	})