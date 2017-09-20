<?php 
	include "common.php";
	if(isset($_GET['orderid'])){
		$orderid=$_GET['orderid'];
		date_default_timezone_set("Asia/Shanghai");
		$date= date('Y-m-d H:i:s',time());
		$sql_accept="UPDATE `od` SET `O_t_sellersub` = '".$date."' WHERE `od`.`O_id` =".$orderid;
		$result_accept=mysqli_query($mysqli,$sql_accept);
	}
 ?>