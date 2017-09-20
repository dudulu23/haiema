<?php
	session_start(); 
	if(isset($_POST['gid'])){
		$gid = $_POST['gid'];
		if(isset($_SESSION['list'][0])){
			$i=0;
			while(isset($_SESSION['list'][$i])){
				if($_SESSION['list'][$i]->goods_id==$gid){
					array_splice($_SESSION['list'],$i);
				}
				$i++;
			}
		}
	}
 ?>