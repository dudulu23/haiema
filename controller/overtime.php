<?php 
//买家收货
include "common.php";
if (isset($_GET['od_id'])) {
	$od_id=$_GET['od_id'];
	date_default_timezone_set("Asia/Shanghai");
	$date= date('Y-m-d H:i:s',time());
	$od_sql="UPDATE `od` SET `O_overtime` = '".$date."' WHERE `O_id`=".$od_id;
	$od_result=mysqli_query($mysqli,$od_sql);
	//增加物品数量
	$O_list_spl="SELECT `O_list` FROM `od` WHERE `O_id`=".$od_id;
	$O_list_result=mysqli_query($mysqli,$O_list_spl);
	$O_list_row=mysqli_fetch_array($O_list_result);
	$ar=json_decode($O_list_row['O_list']);
	print_r($ar);
	foreach ($ar as $ls) {
		
		$goods_sql="SELECT `sell_num` FROM `goods` WHERE `goods_id`=".$ls->goods_id;
		$goods_result=mysqli_query($mysqli,$goods_sql);
		$sellnum=mysqli_fetch_array($goods_result)['sell_num'];
		$sellnum=$sellnum+$ls->goods_num;
		$add_num_sql="UPDATE `goods` SET `sell_num`=".$sellnum." WHERE `goods_id`=".$ls->goods_id;
		echo $add_num_sql;
		$add_num_sql=mysqli_query($mysqli,$add_num_sql);
	}

}
 ?>