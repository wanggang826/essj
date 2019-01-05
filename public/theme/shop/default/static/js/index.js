//菜单
//二进制的正负表示是在最高位，1表示负，0表示正，抑或运算是仅当对应的2位有一位为1时才返回1,反过来如果抑或运算返回的结果是0（正），则一定是2个1，或者2个0.反之，则是一个0，一个1
  function sameSign(a,b){
    return (a^b)>=0;
  }
  //向量的定义
  function vector(a,b){
    return {
      x:b.x-a.x,//终点的坐标减去起点的坐标
      y:b.y-a.y
    }
  }
  //向量叉乘公式
  function vectorProduct(v1,v2){
    return v1.x*v2.y-v2.x*v1.y
  }
  //叉乘判断方法
  function isPointInTrangle(p,a,b,c){//p：鼠标当前点的坐标，a:鼠标上一次的坐标，b,c：二级菜单上下边缘坐标
    var pa=vector(p,a);
    var pb=vector(p,b);
    var pc=vector(p,c);
    var t1=vectorProduct(pa,pb);
    var t2=vectorProduct(pb,pc);
    var t3=vectorProduct(pc,pa);
    return sameSign(t1,t2)&&sameSign(t2,t3);
  }
  function needDelay(elem,leftCorner,currMousePos){//用offset方法获取上下边缘
    var offset=elem.offset();
    var topLeft={
      x:offset.left,
      y:offset.top
    };
    var bottomLeft={
      x:offset.left,
      y:offset.top+elem.height()
    };
    return isPointInTrangle(currMousePos,leftCorner,topLeft,bottomLeft)
  }
$(function(){
    var sub=$('#sub');
    var activeRow;//选中的行
    var activeMenu;//选中的行对应的二级菜单
    var timer;//setTimeout返回的计时器id
    var mouseInSub=false;//当前鼠标是否在子菜单里
    sub.on('mouseenter',function(e){
      mouseInSub=true;
    }).on('mouseleave',function(e){
      mouseInSub=false;
    });
    //创建数组，记录
    var mouseTrack=[];//数组跟踪记录鼠标的位置
    var moveHandler=function(e){//鼠标离开菜单时，需要对绑定在document上的mousemove事件解绑,以免影响页面中其他组件，所以将事件监听函数独立出来，方便后续解绑操作
      mouseTrack.push({
        x:e.pageX,
        y:e.pageY
      });
      if(mouseTrack.length>3){
        mouseTrack.shift();
      }
    };
    $('#test')
      .on('mouseenter',function(e){
        //sub.removeClass('none');
        $(document).bind('mousemove',moveHandler);//mousemove事件一般绑定在document上
      })
      .on('mouseleave',function(e){
        sub.addClass('none');//鼠标移动到一级菜单时，二级菜单隐藏

        if(activeRow){//鼠标离开一级菜单，如果存在激活的行，样式要去掉，并把变量置空
          activeRow.removeClass('hctive');
          activeRow=null;
        }
        if(activeMenu){
          activeMenu.addClass('none');
          activeMenu=null;
        }
        $(document).unbind('mousemove',moveHandler);
      })
      .on('mouseenter','li',function(e){//一级菜单的列表项绑定事件
        sub.removeClass('none');//鼠标移动到一级菜单时，二级菜单显示
        if(!activeRow){//移过去没有激活的一级菜单
          activeRow=$(e.target);
          activeRow.addClass('hctive');

          activeMenu=$('#'+activeRow.data('id'));
          activeMenu.removeClass('none');
          return;
        }
        //debounce:mouseenter频繁触发时，只执行最后一次
        if(timer){
          clearTimeout(timer);
        }
        var currMousePos=mouseTrack[mouseTrack.length-1];
        var leftCorner=mouseTrack[mouseTrack.length-2];
        var delay=needDelay(sub,leftCorner,currMousePos);//是否需要延迟
        if(delay){//如果在三角形内，需要延迟
          timer=setTimeout(function(){
            if(mouseInSub){
              return;
            }
            activeRow.removeClass('hctive');
            activeMenu.addClass('none');
            activeRow=$(e.target);
            activeRow.addClass('hctive');
            activeMenu=$('#'+activeRow.data('id'));
            activeMenu.removeClass('none');
            timer=null;//事件触发时，如果计时器并没有执行，就把它清掉，这样能保证事件触发停止时，会执行最后一次，而其他的都会被忽略
          },300);
        }else{
          var prevActiveRow=activeRow;
          var prevActiveMenu=activeMenu;
          activeRow=$(e.target);
          activeMenu=$('#'+activeRow.data('id'));
          prevActiveRow.removeClass('hctive');
          prevActiveMenu.addClass('none');//上一次二级菜单隐藏
          activeRow.addClass('hctive');
          activeMenu.removeClass('none');//上一次二级菜单显示
        }
      });
  });
  //轮播
   window.onload = function () {
            var container = document.getElementById('container');
            var list = document.getElementById('list');
            var buttons = document.getElementById('buttons').getElementsByTagName('span');
            var prev = document.getElementById('prev');
            var next = document.getElementById('next');
            var index = 1;
            var len = 5;
            var animated = false;
            var interval = 3000;
            var timer;
            function animate (offset) {
                if (offset == 0) {
                    return;
                }
                animated = true;
                var time = 300;
                var inteval = 10;
                var speed = offset/(time/inteval);
                var left = parseInt(list.style.left) + offset;

                var go = function (){
                    if ( (speed > 0 && parseInt(list.style.left) < left) || (speed < 0 && parseInt(list.style.left) > left)) {
                        list.style.left = parseInt(list.style.left) + speed + 'px';
                        setTimeout(go, inteval);
                    }
                    else {
                        list.style.left = left + 'px';
                        if(left>-650){
                            list.style.left = -650 * len + 'px';
                        }
                        if(left<(-650 * len)) {
                            list.style.left = '-650px';
                        }
                        animated = false;
                    }
                }
                go();
            }
            function showButton() {
                for (var i = 0; i < buttons.length ; i++) {
                    if( buttons[i].className == 'on'){
                        buttons[i].className = '';
                        break;
                    }
                }
                buttons[index - 1].className = 'on';
            }
            function play() {
                timer = setTimeout(function () {
                    next.onclick();
                    play();
                }, interval);
            }
            function stop() {
                clearTimeout(timer);
            }
            next.onclick = function () {
                if (animated) {
                    return;
                }
                if (index == 5) {
                    index = 1;
                }
                else {
                    index += 1;
                }
                animate(-650);
                showButton();
            }
            prev.onclick = function () {
                if (animated) {
                    return;
                }
                if (index == 1) {
                    index = 5;
                }
                else {
                    index -= 1;
                }
                animate(650);
                showButton();
            }
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].onclick = function () {
                    if (animated) {
                        return;
                    }
                    if(this.className == 'on') {
                        return;
                    }
                    var myIndex = parseInt(this.getAttribute('index'));
                    var offset = -650 * (myIndex - index);
                    animate(offset);
                    index = myIndex;
                    showButton();
                }
            }
            container.onmouseover = stop;
            container.onmouseout = play;
            play();
               //选项卡
            $(".databon_sp1 span").bind('mouseover', function(){
          		$(this).addClass('bonsp1').siblings().removeClass();
         });
			var titles = document.getElementById('databon_sp1').getElementsByTagName('span');
			var divs = document.getElementsByClassName('databon_p');
			if(titles.length != divs.length)
				return;
			for(var i = 0; i < titles.length; i++) {
				titles[i].id = i;
				titles[i].onmouseover = function() {
					for(var j = 0; j < titles.length; j++) {
						divs[j].style.display = 'none';
					}
					divs[this.id].style.display = 'block';
				}
			}
            }




