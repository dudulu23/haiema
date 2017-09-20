$(document).ready(function(){
	var timer;
	Polling();
	//
	$('.close').click(function(){
		if($(this).hasClass('btn-warning')){
			$.ajax({
				url:'',
				type:'post',
				data:{
					f:'close'
				}
			});
		}else if($(this).hasClass('btn-info')){
			$.ajax({
				url:'',
				type:'post',
				data:{
					f:'open'
				}
			});
		}
	});
	 //侧边栏二级选单
	$('.side_btn').click(function(){
		$(this).next().slideToggle('normal');
	});
	//添加新菜品按钮
	$('.addm').click(function(){
		$('.addnewgoods').fadeIn('normal');
		$('.cover').removeClass('hidden');
	});
	//类别管理按钮
	$('.addc').click(function(){
		$('.addnewclass').fadeIn('normal');
		$('.cover').removeClass('hidden');
	});
	$('.addnewgoods .cf').click(function(){
		$th=$(this);
		var result=goodsedit("add",$th);
		return result;
		// location.reload();
	});
	$('.addnewgoods .can').click(function(){
		$(this).parents('.addnewgoods').fadeOut();
		$('.cover').addClass('hidden');
	});
	//类别管理确定
	$('.addnewclass .cf').click(function(){
		var sid=$('#sid').val();
		//类别数组
		var classlist=[];
		$('.addnewclass b').each(function(){
			classlist.push($(this).html());
		});
		var J_classlist=JSON.stringify(classlist);
		$.ajax({
			url:'controller/seller_class.php',
			data:{
				sid:sid,
				classlist:J_classlist
			},
			type:'post',
			success:function(data){
				if(data=='类别必须为空才能删除'){
					alert(data);
				}
			}
		});
		setTimeout(function(){
				location.reload(); 
		},200);
		
	});

	$('.addnewclass .can').click(function(){
		$(this).parents('.addnewclass').fadeOut();
		$('.cover').addClass('hidden');
		location.reload();
	});

	$('.op_goods_detail').click(function(){
		var detailbox=$(this).parents('.goods_box').next();
		detailbox.fadeIn();
		$('.cover').removeClass('hidden');
		var goods_name = $(this).find('.goods_name>b').html();
		var goods_note = $(this).find('.goods_note>b').html();
		var goods_price = $(this).find('.goods_price>b').html();
		detailbox.find('.goods_name').val(goods_name);
		detailbox.find('.goods_note').val(goods_note);
		detailbox.find('.goods_price').val(goods_price);
	});
	//修改菜品
	$('.mddd .cf').click(function(){
		if(confirm("确认修改此菜品？")){
			$th=$(this);
			var result=goodsedit('change',$th);
			return result;
		}
	});
	$('.mddd .can').click(function(){
		$(this).parents('.mddd').fadeOut();
		$('.cover').addClass('hidden');
	});
	//删除菜品
	$('.mddd .del').click(function(){
		if(confirm("是否删除此菜品？")){
			var $th = $(this);
			var method='del';
			var goods_id=$th.parent().find('.goods_id').val();
			$.ajax({
				type:'post',
				url:'controller/seller_goodsedit.php',
				data:{
					method:method,
					goods_id:goods_id
				},
				success:function(data){
					if(data=='ok'){
						location.reload();
					}
				}
			});
		}
		
	});
	//添加新类别出现输入框
	$('.addclass').click(function(){
		$('.addinput').removeClass('hidden');
	});
	//新类别点击确定
	$('.addinput button').click(function(){
		var newclass=$('.addinput input').val();
		if(newclass!=""){
			$('.addinput').before("<span><b>"+newclass+"</b><a href='#' onClick='delclass(this)'>x</a></span>");
		}
		$('.addinput').addClass('hidden');
	});	
});
//订单栏空时显示信息
function nothing(){
	if($('.order_check .orderlist_box').length<=0){
		$('.nothing').removeClass('hidden');
		$('.order_check .rightbox_body').addClass('hidden');
	}else{
		$('.nothing').removeClass('hidden');
	}
}

function Polling(){
	sellerajax();
	timer=setInterval(sellerajax,5000);
}

function sellerajax(){
	var sid=$('#sid').val();
	$.ajax({
		type:'post',
		datatype:'json',
		data:{
			SID:sid
		},
		url:'controller/sellerpolling.php',
		success:function(data){
			$('.hidbox').html(data);
			$('.listmark').html(data);
			if($('.hidbox .orderlist_box').length>0){
				$('.orderwarn_body p').text("有"+$('.hidbox .orderlist_box').length+"个新订单");
				$('.orderwarn').animate({
					bottom:'0px'
				});
			}else{
				$('.orderwarn').animate({
					bottom:'-200px'
				});
			}
		}
	});
}
//打开详细订单
function detail($th){
	clearInterval(timer);
	$($th).parent().find('.detail').removeClass('hidden');
	$('.cover').removeClass('hidden');
}
//确定按钮
function check($th){
	$($th).parent().addClass('hidden');
	$('.cover').addClass('hidden');
	Polling();
}
function accept($th){
	if(confirm('是否接受订单？')){
		var orderid=$($th).parents('.detail').find('.orderid').text();
		$.ajax({
			url:'controller/acceptorder.php',
			data:{
				orderid:orderid
			},
			type:'get',
		});
		location.reload();
		check($th);
		
	}
}
function delclass($th){
	$($th).parent('span').remove();
}
//检测菜品信息是否完整
function goodsedit(method,$th){
	var sid=$('#sid').val();
	var pa = $th.parent();
	// var goods_img=pa.find('.inputfile').val();
	var goods_name=pa.find('.goods_name').val();
	var goods_class=pa.find('select').val();
	var goods_note=pa.find('.goods_note').val();
	var goods_price=pa.find('.goods_price').val();
	var goods_id=pa.find(".goods_id").val();
	if(goods_name&&goods_class&&goods_note&&goods_price){
	}else{
		alert('信息不完整');
		return false;
	}
	
}