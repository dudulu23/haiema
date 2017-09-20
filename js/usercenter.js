$(document).ready(function(){
	//订单详细信息
	$('.orderbox .op button').click(function(){
		$(this).parents('.orderbox').next().fadeIn('normal');
		$('.cover').fadeIn('normal');
		//按钮失效
		if($(this).parent().parent().find('.state').text()=='订单完成(已评价)'&&$(this).parent().parent().find('.state').text()=='订单完成(未评价)'){
			$(this).parent().parent().next().find('.urge').attr('disabled','1');
		}
		if($(this).parent().parent().find('.state').text()=='订单完成(未评价)'){
			$(this).parent().parent().next().find('.com').attr('disabled',false);
		}
		if($(this).parent().parent().find('.state').text()=='商家已接单'){
			$(this).parent().parent().next().find('.btn-success').attr('disabled',false);
			//添加收货事件
			$('.o_detail .btn-success').click(function(){
					if(confirm('确认收货？')){
						var od_id=$(this).parent().parent().find('.od_id').text()-0;
						$.ajax({
							url:'controller/overtime.php',
							data:{
								od_id:od_id
							},
							type:'get',
							success:function(){
								location.reload();
							}
						});
					}
				});
			}
	});
	$('.o_detail .cf').click(function(){
		$(this).parents('.o_detail').fadeOut('normal');
		$('.cover').fadeOut('normal');
	});
	//收到物品
	//打开评价订单
	$('.com').click(function(){

		var pa=$(this).parent().parent().find('.comment');
		if(pa.hasClass('hidden')){
			pa.removeClass('hidden');
		}else{
			if(commentcheck(pa)){
				commentajax(pa);
				pa.addClass('hidden');
				alert('评价完成');
				window.history.go();
			}
			
		}
		

	});
	//删除地址
	$('.deladd').click(function(){
		if(confirm('是否删除该地址？')){
			var userid=$('#userid').val();
			var pa=$(this).parent();
			var addid=pa.parent().next().find('.addid').val();
			$.ajax({
				url:'controller/addedit.php',
				data:{
					userid:userid,
					method:'del',
					addid:addid
				},
				type:'get',
				success:function(data){
					window.location.reload(true);
				}
			});
		}
		
	});
	//添加新地址窗口
	$('.addbox_addadd').click(function(){
		$(this).parent().next().fadeIn();
		$('.cover').fadeIn('normal');
	});
	//添加新地址确定
	$('.AD .cf').click(function() {
		var pa=$(this).parent();
		if(info_cf(pa)){
			var userid=$('#userid').val();
			var addid = pa.find('.addid').val();
			var info={
					name:pa.find('.add_name').val(),
					sex:pa.find('input[type="radio"][name="sex"]:checked').val(),
					position:pa.find('.add_position').val(),
					phone:pa.find('.add_phone').val()
			};
			$.ajax({
				url:'controller/addedit.php',
				data:{
					userid:userid,
					method:'add',
					info:JSON.stringify(info)
				},
				type:'get',
				datatype:'json',
				success:function(data){
					//刷新页面
					window.location.reload(true);
				}
			});
		}
		
	});
	//添加新窗口取消
	$('.AD .cc').click(function(){
		$(this).parent().fadeOut();
		$('.cover').fadeOut();
	});
	//修改地址窗口
	$('.editadd').click(function(){
		$(this).parent().parent().next().fadeIn('normal');
		var sex=$(this).parent().parent().find('.addbox_sex').text();
		if(sex=='先生'){
			$(this).parent().parent().next().find("input[type='radio'][name='sex'][value='先生']").attr('checked','checked');
		}else{
			$(this).parent().parent().next().find("input[type='radio'][name='sex'][value='女士']").attr('checked','checked');
		}
		$('.cover').fadeIn('normal');
	});
	
	//修改地址窗口确定
	$('.editaddbox .cf').click(function(){
		$th=$(this).parent();
		if(info_cf($th)){
			if(confirm('是否修改信息？')){
				var pa=$(this).parent();
				var userid=$('#userid').val();
				var addid = pa.find('.addid').val();
				var info={
						name:pa.find('.add_name').val(),
						sex:pa.find('input[type="radio"][name="sex"]:checked').val(),
						position:pa.find('.add_position').val(),
						phone:pa.find('.add_phone').val()
				};
				$.ajax({
					url:'controller/addedit.php',
					data:{userid:userid,
						addid: addid,
						method:'change',
						info:JSON.stringify(info),
						
					},
					type:'get',
					datatype:'json',
					success:function(){
						location.reload(); 
					}
				});
			}
		}
		
		
	});
	//修改地址窗口取消
	$('.editaddbox .cc').click(function() {
		$(this).parent().fadeOut('normal');
		$('.cover').fadeOut('normal');
	});


	//打开头像图片上传窗口
	$('.imgc').click(function(){
		$('.cover').fadeIn('normal');
		$('.imgupload').fadeIn('normal');
	});
	//关闭头像图片上传窗口
	$('.imgupload .can').click(function(){
		$('.cover').fadeOut('normal');
		$('.imgupload').fadeOut('normal');
	});
	
});
//验证信息完整
function info_cf($th){
	if($th.find('.add_name').val()==''){
		alert('信息不完整');
		return false;
	}
	if($th.find('.add_position').val()==''){
		alert('信息不完整');
		return false;
	}
	if($th.find('.add_phone').val()==''){
		alert('信息不完整');
		return false;
	}
	if($th.find('input[type="radio"][name="sex"]:checked').val()==null){
		alert('信息不完整');
		return false;
	}
	return true;
}
function commentcheck($th){
	var rd=$th.find("input[type='radio']:checked").val();
	if(rd==undefined){
		alert('请选择星级');
		return false;
	}else{
		return true;
	}
}
function commentajax($th){
	var text;
	var star=$th.find("input[type='radio']:checked").val();
	if($th.find('textarea').val()){
		text=$th.find('textarea').val();
	}else{
		text="未评论";
	}
	
	var o_id=$th.parent().find('.od_id').html();
	$.ajax({	
		url:'controller/comment.php',
		data:{
			star:star,
			text:text,
			o_id:o_id
		},
		success:function(data){
			console.log(data);
		},
		type:'post'
	});
}
