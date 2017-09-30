$(document).ready(function(){
	
	var addinfo;
	min_check();
	
	$('.o_add:first').addClass('add_chose');
	addinfo=info();
	$(".o_submit button").click(function(){
		var words=$('.O_words textarea').val();
		if(words==''){
			words='无';
		}
		if(check()){
			if(confirm('是否下单？')){
					$.ajax({
						url:"controller/ordersubmit.php",
						type:'post',
						data:{
							addinfo:JSON.stringify(addinfo),
							words:words
						},
						datatype:'json',
						success:function(){
							alert("下单完成");
							window.location.href='usercenter.php?position=allorder';
						}
					});
				
			}
		}
		
	});
	$('.o_add').click(function(){
		$('.o_add').removeClass('add_chose');
		$(this).addClass('add_chose');
		addinfo=info();
	});
	$(".goods_num").keydown(function(event){
		if(!isNumber(event.which)){
		return false;}
	});
	$(".goods_num").keyup(function(){
		// count();
		var $th=$(this);
		numchange($th);
		goods_sum($th);
		sum();
		if($th.val()<=0){
			$th.parents('.order_list').remove();
		}
	});
	$(".minus").click(function(){
		var num=$(this).siblings(".goods_num").val();
		num--;
		//数量为0时删除该条
		if(num<=0){
			$(this).parents('.order_list').remove();
		}
		$(this).siblings(".goods_num").val(num);
		var $th=$(this);
		numchange($th);
		goods_sum($th);
		sum();
		min_check();

	});
	$(".plus").click(function(){
		var num=$(this).siblings(".goods_num").val();
		num++;
		$(this).siblings(".goods_num").val(num);
		var $th=$(this);
		numchange($th);
		goods_sum($th);
		sum();
		min_check();
	});
});
//收集信息
function info(){
	var pa=$('.add_chose');
	addinfo={
		name:pa.find('.addbox_name').text(),
		sex:pa.find('.addbox_sex').text(),
		position:pa.find('.addbox_position').text(),
		phone:pa.find('.addbox_phone').text()
	};
	return addinfo;
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
//改变单品价格
function goods_sum($th){
	var price=$th.parents('.order_list').find('.goods_price').val();
	var num=$th.parents('.order_list').find('.goods_num').val();
	$th.parents('.order_list').find('.goods_sum').html(price*num);
}
//改变总价格
function sum(){
	var sum=0;
	$('.goods_sum').each(function(){
		sum=sum+($(this).html()-0)+($('.shopfee b').html()-0);
	});
	$('.o_submit .pull-right b').html(sum);
}
function numchange($th){
	var a_goods_id=$th.parents('.order_list').find('.goods_id').val();
	var a_num=$th.parents('.order_list').find('.goods_num').val();
	$.ajax({
		url:'controller/order_change.php',
		type:'post',
		data:{
			id:a_goods_id,
			num:a_num
		}
	});
}
function check(){
	if($('.order_list').length<=0){
		alert('购物车里没东西了！');
		return false;
	}else{
		return true;
	}
}
//检测是否
function min_check(){

	var min_price=($(".min_price b").html()-0);
	var sum=($(".sum b").html()-0);
	var shopfee=($('.shopfee b').html()-0);
	if(min_price>(sum-shopfee)){
		$('.OR').attr('disabled',true);
	}else{
		$('.OR').attr('disabled',false);
	}
}
