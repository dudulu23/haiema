<?php 
//订单推送
	include "common.php";
	if(isset($_POST['SID'])){
		$SID=$_POST['SID'];
		$sql="SELECT * FROM `od` WHERE `SID`=".$SID;
		$result=mysqli_query($mysqli,$sql);
		while($row=$result->fetch_assoc()){
			$O_words='无';
			if($row['O_words']!=""){
				$O_words=$row['O_words'];
			}
			$add=json_decode($row['O_ADD']);
			//把O_list字符串变成对象
			$list=json_decode($row['O_list']);
			$row['O_list']=$list;
			//打印菜品
			$menum=menumaker($row['O_list']);
			//打印菜品（详细）
			$menumDT=menumakerDT($row['O_list']);
			$sql_username="SELECT * FROM `user` WHERE `UID`=".$row['UID'];
			$result_username=mysqli_query($mysqli,$sql_username);
			$row_user=$result_username->fetch_assoc();
			$username=$row_user['userName'];
			if($row['O_t_sellersub']==NULL){
				$sta="未接单";
				$cla="";
			}else{
				$cla="remove";
			}
			if($row['O_t_sellersub']!=NULL&&$row['O_overtime']==NULL){
				$sta="买家未接受";
			}else if($row['O_overtime']!=NULL){
				$sta="订单完成";
			}
			echo "<div class='orderlist_box ".$cla."'>
					<a class='list' href='##' onClick='detail(this)'>
						<span class='col-xs-3'>".$menum."</span>
						<span class='col-xs-2'>".$username."</span>
						<span class='col-xs-2'>".$add->phone."</span>
						<span class='col-xs-3'>".$add->position."</span>
						<span class='times col-xs-2'>".$row['O_time']."</span>
					</a>
					<div class='detail hidden'>
						<span>订单详情</span>
						<div>	
							<div class='clearfix'><span class='detali_left col-xs-3'>订单编号:</span><span class='orderid col-xs-9'>".$row['O_id']."</span></div>
							<div class='clearfix'><span class='detali_left col-xs-3'>订单状态:</span><span class='orderst col-xs-9'>".$sta."</span></div>
							<div class='clearfix'><span class='detali_left col-xs-3'>用户名:</span><span class='col-xs-9'>".$username."</span></div>
							<div class='clearfix'><span class='detali_left col-xs-3'>地址信息</span><span class='col-xs-9'><p>姓名：".$add->name."</p>详细地址：".$add->position."<p></p><p>电话：".$add->phone."</p></span></div>
							<div class='clearfix'><span class='detali_left col-xs-3'>菜品:</span>
								".$menumDT."
							</div>
							<div class='clearfix'><span class='detali_left col-xs-3'>总金额:</span><span class='col-xs-9'>".$row['O_sum']."元</span></div>
							<div class='clearfix'><span class='detali_left col-xs-3'>订单时间:</span><span class='col-xs-9'>".$row['O_time']."</span></div>
							<div class='clearfix'><span class='detali_left col-xs-3'>订单留言:</span><span class='col-xs-9'><p>".$O_words."</p></div>
						</div>
						<button onClick='check(this)' class='cl btn btn-info'>确定</button><button onClick='accept(this)' class='accept btn btn-info'>接单</button><button class='revise btn btn-warning'>修改订单</button>
					</div>
				</div>
			";
		}
	}
	function  menumaker($obj){
		$ar='';
		foreach ($obj as $item) {
			$ar=$ar.$item->goods_name."*".$item->goods_num." ";
		}
		return $ar;
	}
	function menumakerDT($obj){
		$ar='';
		foreach ($obj as $item) {
			$ar=$ar."<span class='col-xs-9 pull-right'>".$item->goods_name."*".$item->goods_num."</span>";
		}
		return $ar;
	}
	
 ?>