<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商家登陆</title>
	<link rel="stylesheet" type="text/css" href="css/commmon.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="bg">
		<form  class="form-group center" action="controller/seller_login.php" method="post">
			商家邮箱<input  class="form-control" name="seller_email" type="text"><br>
			商家密码<input class="form-control" name="seller_password" type="password"><br>
			<input  class="logbtn btn btn-primary" type="submit" value="登陆">
		</form>
		
	</div>
</body>
</html>