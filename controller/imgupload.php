<?php
	include "common.php"; 
	if(isset($_POST['UID'])){
		echo "hhh";
		$UID=$_POST['UID'];
		if($_FILES['file']['error']>0){
			echo "Error";
		}else{
			move_uploaded_file($_FILES["file"]["tmp_name"],
	      "../img/user/".$_POST['UID'].".png");
	    }
	    	$user_sql="UPDATE `user` SET `img`='img/user/".$UID.".png' WHERE `user`.`UID`=".$_POST['UID'];
	    	$user_result=mysqli_query($mysqli,$user_sql);
	    }
    header("location:../usercenter.php?position=data");
 ?>