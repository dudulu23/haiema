<?php 
session_start();
include '../controller/common.php';
if(isset($_POST['useremail'])){
	$useremail = $_POST['useremail'];
}else{}
if(isset($_POST['password'])){
	$password = $_POST['password'];
}
$sql = "SELECT * 
FROM `user` 
WHERE `Email` LIKE '".$useremail."' 
AND `password` LIKE '".$password."'";
echo $sql;
$result = mysqli_query($mysqli,$sql);
$DATA[]=mysqli_fetch_row($result);
if($DATA[0][0]){
	//没用用户名时会使用邮箱当作用户名
	if($DATA[0][1]!=""){
		$_SESSION['userName']=$DATA[0][1];
	}else{
		$_SESSION['userName']=$DATA[0][2];
	}
	$_SESSION['user']=$DATA[0][0];;
	echo $_SESSION['user'];
	Header("Location: ../index.php"); 
}else{
	echo 'false';
}

// makeCookie();
    //生成cookie
function makeCookie($useremail,$password){
	setCookie('useremailCookie',$username,time()+2*7*24*3600,'/');
	setCookie('passwordCookie',$password,time()+2*7*24*3600,'/');
}
	
function delCookie(){
	setCookie('useremailCookie',"",time()-3600);
	setCookie('passwordCookie',"",time()-3600);
}

 ?>