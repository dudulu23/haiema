
<?php
//商家登陆 
session_start();
include '../controller/common.php';
if(isset($_POST['seller_email'])){
	$seller_email = $_POST['seller_email'];
}else{}
if(isset($_POST['seller_password'])){
	$seller_password = $_POST['seller_password'];
}
$sql = "SELECT * 
FROM `seller` 
WHERE `seller_email` LIKE '".$seller_email."' 
AND `seller_password` LIKE '".$seller_password."'";
echo $sql;
$result = mysqli_query($mysqli,$sql);
$DATA=mysqli_fetch_array($result);
$_SESSION['sid']=$DATA['SID'];
Header("Location: ../seller.php"); 
 ?>