<?php 
	include 'common.php';
	session_start();
	if(isset($_SESSION['user'])){
		if(isset($_POST['star'])&&isset($_POST['o_id'])){
			echo 'sss';
			$star=$_POST['star'];
			$o_id=$_POST['o_id'];
			$text=$_POST['text'];
			date_default_timezone_set("Asia/Shanghai");
			$date=date('Y-m-d H:i:s',time());
			echo $date;
			$comment_sql="UPDATE `od` SET `comment_star` = '".$star."', `comment_text` = '".$text."',`comment_time`='".$date."' WHERE `O_id`='".$o_id."'";
			echo $comment_sql;
			$comment_result=mysqli_query($mysqli,$comment_sql);


		}
	}else{

	}
 ?>