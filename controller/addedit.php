<?php 
include "common.php";
echo $_GET['method'];
if(isset($_GET['method'])&&isset($_GET['info'])&&isset($_GET['userid'])){
	$method=$_GET['method'];
	$userid=$_GET['userid'];
	$sql="SELECT `ADD` FROM `user` WHERE `UID`=".$userid;
	$result=mysqli_query($mysqli,$sql);
	$row=mysqli_fetch_array($result);
	//添加
	if($method=='add'){
		echo "jjjj";
		$info=json_decode($_GET['info']);
		$s=1;
		//数据库数据加入数组
		if($row['ADD']!=null){
			$add_ar=json_decode($row['ADD']);
			foreach($add_ar as $key) {
				if($key==$info){
					echo '数据已存在';
					$s=0;
					break;
				}
			}
			if($s==1){
				array_push($add_ar,$info);
			}
		}else{
			$add_ar[0]=$info;
		}
		
	}else if($method=='change'){
		$addid=$_GET['addid'];
		$info=json_decode($_GET['info']);
		$add_ar=json_decode($row['ADD']);
		$add_ar[$addid]=$info;
	}
}else if($_GET['method']=='del'){
	$sql="SELECT `ADD` FROM `user` WHERE `UID`=".$_GET['userid'];
	$result=mysqli_query($mysqli,$sql);
	$row=mysqli_fetch_array($result);
	if(isset($_GET['addid'])){
		$addid=$_GET['addid'];
	}
	$add_ar=json_decode($row['ADD']);
	array_splice($add_ar,$addid);
	
}
$json=json_encode($add_ar,JSON_UNESCAPED_UNICODE);
$update_sql="UPDATE `user` SET `ADD` = '".$json."' WHERE `user`.`UID` = ".$_GET['userid'];
$update_result = mysqli_query($mysqli,$update_sql);
echo '成功';
?>