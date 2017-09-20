<?php
//将类别数组添加到数据库
include "common.php"; 
	if(isset($_POST['classlist'])&&isset($_POST['sid'])){
		$classlist=$_POST['classlist'];
		$class_ar=json_decode($_POST['classlist']);
		$sid=$_POST['sid'];
		$goods_sql="SELECT * FROM `goods` WHERE `SID`=".$sid;
		$goods_result=mysqli_query($mysqli,$goods_sql);
		$sit=1;
		while($goods_row=mysqli_fetch_array($goods_result)) {
			$sit=0;
			foreach ($class_ar as $list) {
				if($goods_row['goods_class']==$list){
					$sit=1;
				}
			}
			if($sit==0){
				break;
			}	
		}
		if($sit!=0){
		$shop_sql="UPDATE `shop` SET `shop_class` = '".$classlist."' WHERE `shop`.`SID` = ".$sid;
		$shop_result=mysqli_query($mysqli,$shop_sql);
		}else{
			echo "类别必须为空才能删除";
		}
	}
 ?>