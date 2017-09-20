$(document).ready(function(){
	var emailsign=0;
	var passwordsign=0;
	$("#Emali").blur(function(){
		var str = $(this).val();
		if(str!=""){
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(str.match(reg)==null){
				$(".warning").text("邮箱格式不正确");
			}else{
				$.ajax({
					url: "controller/emailCheck.php",
					data : {
						email: str
					},
					type: "post",
					success: function(data){
						$(".warning").text(data);
					}
				});
			} 
		}
	});


	$(".password").blur(function(){
		var pw=$("#password").val();
		var rpw=$("#repassword").val();
		if(pw!=""){
			if((6<=pw.length)&&(pw.length<=15)){
				$(".pw").text("正确");
				if(rpw!=""){
					if(pw==rpw){
						$(".rpw").text("正确");
					}else{
						$(".rpw").text("两次密码不一致");	
					}
				}else{
					$(".rpw").text("请再输入一次密码");
				}
			}else{
				$(".pw").text("密码长度错误，请输入6-15长度的密码");
			}
		}else{
			$(".rpw").text("");
		}

	});
	$("#submit").click(function(){
		// var wa=$(".warning").text();
		// var pw=$(".pw").text();
		// var pw
		if(($(".warning").text()=="正确")&&($(".pw").text()=="正确")&&($(".rpw").text()=="正确")){
			$.ajax({
						url: "controller/register.php",
						type: "post",
						data:{
							password: $("#password").val(),
							Email:$("#Emali").val()
						},
						success: function(data){
							alert(data);
							if(data=="注册成功"){
								 window.location.href="index.php";
							}
						}
					});
		}else{
			alert("信息填写不正确");
		}
	});
	
});