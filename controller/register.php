<?php
	session_start();
	include "common.php";
	if(isset($_POST['Email'])){
		$Email = $_POST['Email'];
	}
	if(isset($_POST['password'])){
		$password = $_POST['password'];
	}

	$sql= "INSERT INTO user(Email,password) VALUE('".$Email."','".$password."')";
	if($result = mysqli_query($mysqli,$sql)){
		$_SESSION['userName']=$Email;
		
		echo "注册成功";
	}else{
		echo "服务器出现问题";
	}
	$login_sql = "SELECT * FROM `user` WHERE `Email`='".$Email."'";
	$login_result=mysqli_query($mysqli,$login_sql);
	$login_row=mysqli_fetch_array($login_result);
	$_SESSION['user']=$login_row['UID'];
 ?>