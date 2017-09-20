$(document).ready(function(){
	var timer1=0;
	var timer2=0;
	$(".list_del").click(function(){
		
	});
	$(".carbar-btn a").click(function(){
		if($(".carbar").css("right")=="-200px"){
			$(".carbar").animate({right:"0px"});
		}
		if($(".carbar").css("right")=="0px"){
			$(".carbar").animate({right:"-200px"});
		}
	});
	$(".sueee").mouseover(function(){
		$(".slide").stop().slideDown("fast");
		//使鼠标短时间重新移动回下拉菜单时不触发菜单上拉
		clearTimeout(timer1);

	});
	$(".sueee").mouseout(function(){
		timer1=setTimeout(function(){
			$(".slide").slideUp("fast");
		},500);
	});

	$(".slide>.logout").click(function() {
		if(confirm("确认要注销？")){
		$.post('controller/delsession.php');}
	});
	$(".shopBox>a").hover(function(){
		
		var $th=$(this);
			timere($th,'fadeIn');
			
	},
	function(){
		var $th=$(this);
			timere($th,'fadeOut');
			clearTimeout(timer2);
	});
	$(".order_btn button").click(function(){
		if($(".sueee").length<=0){
			if(confirm("先登陆再点餐把")){
				window.location.href="login.php";
			}
		}else{
			if($(".carbox_list").length>0){
			window.location.href="order.php";
			}else{
				alert("您还没点餐呢");
			}
		}
		
	});





	function timere($th,method){
		if(method=="fadeIn"){
			timer2=setTimeout(function(){$th.parent().children('.shophover').stop().fadeIn('fast');},250);

		}else if(method=="fadeOut"){
			$th.parent().children('.shophover').css('display','none');
		}
	}

	//更新物品数量按钮状态
	function btnchange($th){
		pa=$th.parents(".goods_box");
		if(pa.find(".goods_num").val()!=0){
			pa.find(".cart_btn").addClass('none');
			pa.find(".cart_count").removeClass('none');
		}else{
			pa.find(".cart_btn").removeClass('none');
			pa.find(".cart_count").addClass('none');
		}
	}

});
// $(".shopBox").mouseenter(
// 	function(){ var $th=$(this);
// 		timer=setTimeout(timere($th,'show'),50);
		
// 	});
// $(".shopBox").mouseout(
// 	function(){
// 		var $th=$(this);
// 		timer=setTimeout(timere($th,'hide'),50);
// 	});
