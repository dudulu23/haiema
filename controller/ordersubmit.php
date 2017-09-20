<?php 
	session_start();
	include "common.php";
	if(isset($_POST['addinfo'])&&isset($_POST['words'])){
		echo 'hh';
		date_default_timezone_set("Asia/Shanghai");
		$sum=0;
		$date= date('Y-m-d H:i:s',time());
		$SID=$_SESSION['SID'];
		echo $date;
		$userid=$_SESSION['user'];
		$list=json_encode($_SESSION['list'],JSON_UNESCAPED_UNICODE);
		foreach ($_SESSION['list'] as $li){
			$sum=$sum+$li->goods_num*$li->goods_price;
		}
		$sql="INSERT INTO `od` (`O_list`, `UID`,`SID`, `O_time`, `O_ADD`,`O_sum`,`O_words`) VALUES ('".$list."', '".$userid."', '".$SID."', '".$date."', '".$_POST['addinfo']."','".$sum."','".$_POST['words']."')";
		$result = mysqli_query($mysqli,$sql);
		//清除session
		unset($_SESSION['list']);
	}
	
	
 ?>