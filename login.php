<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户登陆</title>
	<link rel="stylesheet" type="text/css" href="css/commmon.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="bg">
		<form  class="form-group center" action="controller/login-con.php" method="post">
			用户邮箱<input  class="form-control" name="useremail" type="text"><br>
			用户密码<input class="form-control" name="password" type="password"><br>
			<input  class="logbtn btn btn-primary" type="submit" value="登陆">
			<a href="#">忘记密码</a>
			<a href="register.php">没有账号</a>
		</form>
		
	</div>
</body>
</html>