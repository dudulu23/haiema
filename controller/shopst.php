<?php 
	//店铺开关
include 'common.php';
session_start();
	if(isset($_POST['f'])&&isset($_SESSION['sid'])){
		echo '66';
		if($_POST['f']=='close'){
			$shop_sql="UPDATE `shop` SET `open`=0 WHERE `SID`=".$_SESSION['sid'];
		}else if($_POST['f']=='open'){
			$shop_sql="UPDATE `shop` SET `open`=1 WHERE `SID`=".$_SESSION['sid'];
		}
		$shop_result=mysqli_query($mysqli,$shop_sql);
	}
 ?>