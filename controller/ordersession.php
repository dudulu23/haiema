<?php
session_start();
if(isset($_GET['package'])){ 
	$package = $_GET['package'];
	$obj=json_decode($package);
}
if(!isset($_SESSION['list'])){
	$_SESSION['list']=[$obj];
}else{
	//数组为空则添加项
	if(!isset($_SESSION['list'][0])){
		array_push($_SESSION['list'],$obj);
	}
	//当加入的SID不同时覆盖旧对象
	if($_SESSION['list'][0]->SID!=$obj->SID){
		$_SESSION['list']=[$obj];
	}
	$sit=0;
	//数量不同id相同的项则改变数量
	foreach($_SESSION['list'] as $list){
		$sit=0;
		if($list->goods_id==$obj->goods_id){
			$list->goods_num=$obj->goods_num;
		}else if($obj->goods_num!=0){
			$sit=1;
		}
		
	}
	//不同id的项则加入数组
	if($sit==1){
		array_push($_SESSION['list'],$obj);
	}

	//删除数量为0项
	$i=0;
	while(isset($_SESSION['list'][$i])){
		if($_SESSION['list'][$i]->goods_num==0)
		{array_splice($_SESSION['list'],$i);}
		$i++;
	}
}
// session_destroy();

 ?>