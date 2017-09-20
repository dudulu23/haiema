<?php
//
include "common.php"; 
	if(isset($_POST['method'])){
		if($_POST['method']=='del'){
			if(isset($_POST['goods_id'])){
				$goods_del_sql="DELETE FROM `goods` WHERE `goods`.`goods_id` =".$_POST['goods_id'];
				$goods_del_result=mysqli_query($mysqli,$goods_del_sql);
				echo "ok";
			}
		}else{
			$sid=$_POST['sid'];
			$goods_name=$_POST['goods_name'];
			$goods_class=$_POST['goods_class'];
			$goods_note=$_POST['goods_note'];
			$goods_img="img/goods/".$goods_id.".png";
			$goods_price=$_POST['goods_price'];
			if($_POST['method']=='add'){
				
				$goods_sql="INSERT INTO `goods` (`goods_name`, `goods_img`, `SID`, `goods_price`, `goods_note`, `goods_class`) VALUES ('".$goods_name."','".$goods_img."', '".$sid."', '".$goods_price."', '".$goods_note."', '".$goods_class."')";
				$goods_result=mysqli_query($mysqli,$goods_sql);
				$newID=mysqli_insert_id($mysqli);
				if($_FILES['file']['error']==0){
					move_uploaded_file($_FILES["file"]["tmp_name"],"../img/goods/".$newID.".png");
				}
			}else if($_POST['method']=='change'){
				if(isset($_POST['goods_id'])){
					$goods_id=$_POST['goods_id'];
					if($_FILES['file']['error']==0){
						move_uploaded_file($_FILES["file"]["tmp_name"],"../img/goods/".$goods_id.".png");
					}
					$goods_change_sql="UPDATE `goods` SET `goods_name` = '".$goods_name."', `goods_img` = '".$goods_img."',`goods_class` = '".$goods_class."', `goods_price` = '".$goods_price."', `goods_note` = '".$goods_note."' WHERE `goods`.`goods_id` = ".$_POST['goods_id'];
					$goods_change_result=mysqli_query($mysqli,$goods_change_sql);
				}
			}
			header("location:../seller.php?position=menu");
		}
		
	}
	
?>