<?php
//商店信息编辑
include "common.php"; 
if(isset($_POST['SID'])){
	echo "ddd";
	$SID=$_POST['SID'];
	$shopName=$_POST['shopName'];
	$min_price=$_POST['min_price'];
	$shopFee=$_POST['shopFee'];
	$shopphone=$_POST['shopphone'];
	$ADD=$_POST['ADD'];
	if($_FILES['file']!=0){
		move_uploaded_file($_FILES["file"]["tmp_name"],"../img/shop/".$SID.".png");
	}
	$shop_sql="UPDATE `shop` SET `shopName` = '".$shopName."', `ADD` = '".$ADD."', `min_price`= '".$min_price."',`shopFee` = '".$shopFee."', `shopphone` = '".$shopphone."' WHERE `shop`.`SID` = ".$SID;
	$shop_result=mysqli_query($mysqli,$shop_sql);
	header("location:../seller.php?position=option");
}
?>
