<?php
	include "common.php";
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	} 
	$sql="SELECT * FROM `user` WHERE `Email` LIKE '".$email."'";
	$result = mysqli_query($mysqli,$sql);

	//计算数据条数
	$num = mysqli_num_rows($result);
	if($num){
		echo "该邮箱已被注册，请使用其他邮箱";
	}else{
		echo "正确";
	}
 ?>