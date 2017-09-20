<?php	
	header("Content-Type: text/html; charset=utf-8");
	$host = "127.0.0.1";
	$username = "root";
	$password = "root";
	$db = "haiema";
		
	//连接数据库
	$mysqli = new mysqli($host,$username,$password,$db);
	if(mysqli_connect_error()){
    		echo mysqli_connect_error();
	}
	// mysqli_select_db($db);
	// mysqli_query("SET NAMES 'UTF8'");
	$mysqli->set_charset("utf8");

?>