$(document).ready(function(){
	var sum=0;
	psum();
	//更新按钮状态
	$(".cart_btn").each(function(){
	 btnchange($(this));
	});
	$(".cart_btn").click(function(){
		var num=$(this).prev().children(".goods_num").val();
		num++;
		$(this).prev().children(".goods_num").val(num);
		var $th=$(this);
		btnchange($th);
		var package = goods_data($th);
		listajax(package);
		changecarbox($th);
		sidcheck();
		car_goods_num();
		psum();
	});
	$(".minus").click(function(){
		var num=$(this).siblings(".goods_num").val();
		num--;
		$(this).siblings(".goods_num").val(num);
		var $th=$(this);
		btnchange($th);
		var package = goods_data($th);
		listajax(package);
		changecarbox($th);
		sidcheck();
		car_goods_num();
		psum();
	});
	$(".plus").click(function(){
		var num=$(this).siblings(".goods_num").val();
		num++;
		$(this).siblings(".goods_num").val(num);
		var $th=$(this);
		btnchange($th);
		var package = goods_data($th);
		listajax(package);
		changecarbox($th);
		sidcheck();
		car_goods_num();
		psum();
	});
	//只允许数字输入
	$(".goods_num").keydown(function(event){
		if(!isNumber(event.which)){
		return false;}
	});
	$(".goods_num").keyup(function(){
		// count();
		var $th=$(this);
		btnchange($th);
		var package = goods_data($th);
		listajax(package);
		changecarbox($th);
		car_goods_num();
		psum();
	});
	//切换到评论窗口
	$('.comment_page').click(function(){
		$('.main').addClass('hidden');
		$('.comment').removeClass('hidden');
	});
	$('.goods_page').click(function(){
		window.history.go();
	});

});
function listdel(obj){

		var gid = $(obj).parents(".carbox_list").find("input").val();
		if($("#SID").val()==$(".CSID").val()){
			var $th=$(".goods_box").each(function(){
				var $th = $(this); 
				var boxid=$th.find(".goods_id").val();
				if(boxid==gid){
					$th.find(".goods_num").val(0);

					btnchange($th.find(".goods_id"));
					var package = goods_data($th.find(".goods_id"));
					listajax(package);
					changecarbox($th.find(".goods_id"));
					car_goods_num();
					psum();	
				}
			});
		}else{
			$.ajax({
				data:{
					gid:gid
				},
				type:"post",
				url:"controller/sidergoodsdel.php"
			});
		$(obj).parents(".carbox_list").remove();
		car_goods_num();
		psum();
		}     
}
function indexlistdel(obj){
	var gid = $(obj).parents(".carbox_list").find("input").val();
	$.ajax({
		data:{
			gid:gid
		},
		type:"post",
		url:"controller/sidergoodsdel.php"
	});
	$(obj).parents(".carbox_list").remove();
	car_goods_num();

	psum();
}


	function isNumber(keyCode) {
		// 数字
		if (keyCode >= 48 && keyCode <= 57 ) return true;
		// 小数字键盘
		if (keyCode >= 96 && keyCode <= 105) return true;
		// Backspace, del, 左右方向键
		if (keyCode == 8 || keyCode == 46 || keyCode == 37 || keyCode == 39) return true;
		return false;
	}
	//计算总价格
	function psum(){
		var psum=0;
		$(".list_price").each(function(){
			psum= parseFloat($(this).text())+psum;
		});
		$(".pricesum").html("共计<b>"+psum+"</b>元");
	}
	//js动态改变购物车物品
	function changecarbox($th){
		var sid=$("#SID").val();
		var goods_num = $th.parents(".goods_box").find('.goods_num').val();
		var goods_id = $th.parents(".goods_box").find('.goods_id').val();
		var goods_price=parseFloat($th.parents(".goods_box").find('.goods_price').text());
		var goods_name = $th.parents(".goods_box").find('.goods_name').text();
		if($("#list_id_"+goods_id+" .list_num").length> 0 ){
			
			if(goods_num<=0){
				$("#list_id_"+goods_id).remove();
			}
			$("#list_id_"+goods_id+" .list_num").text(goods_num);
			$("#list_id_"+goods_id+" .list_price").text(goods_price*goods_num+"元");

		}else{
			$(".order_btn").before("<div class='carbox_list' id='list_id_"+goods_id+"'><input class='CSID' type='hidden'  value='"+sid+"'><input type='hidden' value='"+goods_id+"'><span class='list_name'>"+goods_name+"</span><span class='list_num'>"+goods_num+"</span><span class='list_price'>"+goods_price*goods_num+"元</span><span><button class='list_del' onClick='listdel(this)'>-</button></span></div>");
		}

	}
	//物品信息数量收集
	function goods_data($th){
		pa=$th.parents(".goods_box");
		var package={
			SID:pa.find('.SID').val(),
			shopfee:pa.find('.shopfee').val(),
			goods_id:pa.find('.goods_id').val(),
			goods_name:pa.find('.goods_name').text(),
			goods_num:pa.find('.goods_num').val(),
			goods_price:parseFloat(pa.find('.goods_price').text())
		};
		return package;
	}	
	//储存入session
		function listajax(package){
			$.ajax({
				url:"controller/ordersession.php",
				type:"get",
				data:{
					package:JSON.stringify(package)
				},
				dataType:"json",
				success:function(data){
					alert("ok");
				}
			});
		}
		//物品数量按钮改变
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
		//动态改变红圈数字
		function car_goods_num(){
			if(!$(".car_goods_num").length&&$(".list_num").length){

				$(".carbar-btn").append("<span class='car_goods_num'></span>");
			}
			var dg = 0;
			$(".car_goods_num").animate({
				padding:"2px"
			},80);
			$(".car_goods_num").animate({
				padding:"0px"
			},80);

			$(".list_num").each(function(){
				//减0 将字符串变数字
				dg =$(this).text()-0+dg;
			});
			if(dg>0){
				$(".car_goods_num").text(dg);
			}else{
				$(".car_goods_num").remove();
			}
		}
		function sidcheck(){
			$(".carbox_list").each(function(){
				var th=$(this);
				if($("#SID").val()!=th.find(".CSID").val()){
					th.remove();
				}
			});			
		} 