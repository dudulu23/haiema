<?php 
session_start();
if(!isset($_SESSION['sid'])){
	Header("Location:index.php"); 
}
include "controller/common.php";
if(isset($_GET['position'])){
	$p=$_GET['position'];
}else{
	$p='shop';
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>还饿吗商家版</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/seller.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<?php echo "<input type='hidden' id='sid' value='".$_SESSION['sid']."'>"; ?>
<div class='cover hidden'></div>
<div class='orderwarn'>
	<div class='orderwarn_title'>
		<p>订单提醒</p>
	</div>
	<div class='orderwarn_body'>
		<p>有新订单</p>
		<a href="seller.php?position=order_check">查看</a>
	</div>
</div>
<div class='hidbox hidden'>
	
</div>
<div class='header'>
	<div class='seller_title'>
		<span><b>还饿吗</b>商家版</span>
	</div>
</div>
<div class='seller_body container'>
	<div class='seller_siderbar col-xs-2'>
		<a href="seller.php?position=shop" title="">状态</a>
		<a href="seller.php?position=order_check" title="">订单处理</a>
		<a href="seller.php?position=order_select" title="">订单查询</a>
		<a class='side_btn' href="#">管理</a>
		<div class='side_exlist'>
			<a href="seller.php?position=menu" title="">菜品</a>
			<a href="seller.php?position=comment" title="">评价</a>			
		</div>
		<a href="seller.php?position=option" title="">设置</a>			
	</div>
	<?php 
switch ($p) {
	case 'shop':
	$shop_sql="SELECT * FROM `shop` WHERE `SID`=".$_SESSION['sid'];
	$shop_result=mysqli_query($mysqli,$shop_sql);
	$shop_row=mysqli_fetch_array($shop_result);
	if($shop_row['open']==0){
		$st="休息中";
		$cbt="<button class='cbt btn btn-info'>开店</button>";
	}else{
		$st="营业中";
		$cbt="<button class='cbt btn btn-warning'>关店</button>";
	}
		echo "
	
	
<div class='seller_body_left col-xs-10 right'>
	<div class='shop_title'>
		<img class='col-xs-2' src='img/shop/".$_SESSION['sid'].".png' alt=''>
		<div class='col-xs-5'>
			<p>".$shop_row['shopName']."</p>
			<p>状态:<b>".$st."</b></p>
		</div>
		<div class='col-xs-2 right'>
			".$cbt."
		</div>
		<div class='clearfix'></div>
	</div>
</div>
		";
		break;
	case 'order_check':
		echo "
	<div class='seller_body_left col-xs-10 right'>
		<div class='order_check'>
			<div class='rightbox_title'><span>未处理订单</span></div>
			<div class='rightbox_body'>
				<div class='orderlist_title'>
					<span class='col-xs-3'>菜品</span>
					<span class='col-xs-2'>用户名</span>
					<span class='col-xs-2'>电话</span>
					<span class='col-xs-3'>地址</span>
					<span class='col-xs-2'>时间</span>
					<div class='clearfix'></div>
				</div>
				<div class='listmark nocheck'></div>			
			</div>
			<div class='nothing hidden'>
				<span>没有未处理的订单</span>		
			</div>	
		</div>	
	</div>

		";
		break;
	case 'order_select':
		echo "
		<div class='seller_body_left col-xs-10 right'>
			<div class='order_select'>
				<div class='rightbox_title'><span>订单查询</span></div>
				<div class='rightbox_body'>
					
					<div class='orderlist_title'>
						<span class='col-xs-3'>菜品</span>
						<span class='col-xs-2'>用户名</span>
						<span class='col-xs-2'>电话</span>
						<span class='col-xs-3'>地址</span>
						<span class='col-xs-2'>时间</span>
						<div class='clearfix'></div>
					</div>
					<div class='listmark'></div>
				</div>
			</div>
		</div>
		";

		break;
	case 'menu':
	$class_sql="SELECT * FROM `shop` WHERE `SID`=".$_SESSION['sid'];
	$class_result=mysqli_query($mysqli,$class_sql);
	$class_row=mysqli_fetch_array($class_result);
	$class_str="";
	$detail_class_str="";
	$goods_box_str="";
	if($class_row['shop_class']!=""){
		$shop_class=json_decode($class_row['shop_class']);
		$class_str=goodsclassview($shop_class);
		$detail_class_str=detailselect($shop_class,"");
	}
	if(isset($shop_class)){
	$goods_box_str=goodsbox($mysqli,$shop_class,$detail_class_str);
	}
	echo "
		<div class='addnewgoods goods_detail'>
			<form method='post' action='controller/seller_goodsedit.php' enctype='multipart/form-data'>
				<p>
					<a href='' title=''><img src='img/common/default-avatar.png' alt=''></a>
					<input class='inputfile' type='file' name='file'>
				</p>
				<p><span>菜品名字</span>
					<input type='text' class='goods_name' name='goods_name' value=''></p>
				<p><span>菜品类别</span>
					<select name='goods_class'>
						".$detail_class_str."
					</select></p>
				<p><span>菜品简介</span>
					<input type='text' class='goods_note' name='goods_note' value=''></p>
				<p><span>菜品价格</span>
					<input type='text' class='goods_price' name='goods_price' value=''></p>
					<input type='hidden' name='method' value='add'>
					<input type='hidden' name='sid' value='".$_SESSION['sid']."'>
				<input class='cf btn btn-info' type='submit' value='确定'>
				<span class='can btn btn-warning'>取消</span>
			</form>
		</div>
		<div class='addnewclass'>
			<h4>类别管理</h4>
			<div>".$class_str."
				<div class='addinput hidden'>
					<input type='text' value=''>
					<button class='btn btn-info'>确认</button>
				</div>
				<span><a href='#' class='addclass'>+</a></span>
			</div>
			
			<button class='cf btn btn-info'>确定</button>
			<button class='can btn btn-warning'>取消</button>
		</div>
		<div class='seller_body_left col-xs-10 right'>
			<div class='menu'>
				<div class='rightbox_title'><span>菜品管理</span></div>
				<div class='rightbox_body'>
					<div class='tool'>
						<button class='addc btn btn-info'>+管理类别</button>
						<button class='addm btn btn-info' onClick=''>+添加新菜品</button>
					</div>
					<div class='goods'>
						".$goods_box_str."
					</div>
				</div>
			</div>
		</div>
		";
		break;
	case 'comment':
	function comment_li($mysqli,$SID){
		$od_sql="SELECT * FROM `od` WHERE `SID`='".$SID."' AND `comment_star`!=0";
		$od_result=mysqli_query($mysqli,$od_sql);
		$st="";
		while($od_row=mysqli_fetch_array($od_result)){
			$user_sql="SELECT `userName` FROM `user` WHERE `UID`='".$od_row['UID']."'";
			$uesr_result=mysqli_query($mysqli,$user_sql);
			$name_row=mysqli_fetch_array($uesr_result);
			$st=$st."<li>
				<div class='comment_box clearfix'>
					<div class='user_img'>
						<img src='img/user/".$od_row['UID'].".png' alt=''>
					</div>
					<div class='comment_main'>
						<p><span>用户名:".$name_row['userName']."</span> <span>评分:".$od_row['comment_star']."/5</span></p>
						<span>评论:</span>
						<p class='comment_text'>".$od_row['comment_text']."</p>
						
					</div>
					<span class='comment_time'>".$od_row['comment_time']."</span>	
				</div>
			</li>";
		}
		return $st;
	}
	$li_st=comment_li($mysqli,$_SESSION['sid']);
	echo "
		<div class='seller_body_left col-xs-10 right'>
			<div class='comment'>
				<div class='rightbox_title'><span>评价</span></div>
				<div class='rightbox_body'>
					<div class='comment_ul'>
						<ul>
							".$li_st."
						</ul>
					</div>
				</div>
			</div>
		</div>
		";
		break;
	case 'option':
	$shop_sql="SELECT * FROM `shop` WHERE `SID`=".$_SESSION['sid'];
	$shop_result=mysqli_query($mysqli,$shop_sql);
	$shop_row=mysqli_fetch_array($shop_result);
	echo "
		<div class='seller_body_left col-xs-10 right'>
			<div class='option'>
				<div class='rightbox_title'><span>设置</span></div>
				<div class='rightbox_body'>		
					<form method='post' action='controller/seller_edit.php' enctype='multipart/form-data'>
						<p>店铺图片<img src='img/shop/".$_SESSION['sid'].".png'>
						<input type='hidden' name='SID' value='".$_SESSION['sid']."'>
						<input class='inputfile' type='file' name='file'></p>
						<p><span>店铺名称：</span><input type='text' name='shopName' value='".$shop_row['shopName']."'></p>
						<p><span>起送价：</span><input type='text' name='min_price' value='".$shop_row['min_price']."'></p>
						<p><span>派送费：</span><input type='text' name='shopFee' value='".$shop_row['shopFee']."'></p>
						<p><span>地址：</span><input type='text' name='ADD' value='".$shop_row['ADD']."'></p>
						<p><span>电话：</span><input type='text' name='shopphone' value='".$shop_row['shopphone']."'></p>
						<button class='btn btn-info'>保存</button>
					</form>
				</div>
			</div>
		</div>
		";
		break;
	default:
		# code...
		break;
}
//类别管理生成
function goodsclassview($shop_class){
	$class_str="";
	foreach ($shop_class as $cl) {
		$class_str=$class_str."<span><b>".$cl."</b><a href='#' onClick='delclass(this)'>x</a></span>";
	}
	return $class_str;
}
//菜品详细窗口选单
function detailselect($shop_class,$cll){
	$detail_class_str="";
	if($cll==""){
		foreach($shop_class as $cl){
			$detail_class_str=$detail_class_str."<option value='".$cl."'>".$cl."</option>";
		}
	}else{
		//默认选项为物品原选项
		foreach($shop_class as $cl){
			if($cl==$cll){
				$detail_class_str=$detail_class_str."<option value='".$cl."' selected = 'selected'>".$cl."</option>";
			}else{
				$detail_class_str=$detail_class_str."<option value='".$cl."'>".$cl."</option>";
			}
			
		}
	}
	return $detail_class_str;
}
//菜单生成
function goodsbox($mysqli,$shop_class){
	$goodsbox_str="";
	foreach ($shop_class as $cl) {
		$detail_class_str=detailselect($shop_class,$cl);
		$goodsbox_str=$goodsbox_str."<div class='cl_b'><h4>".$cl."</h4>";
		$goods_sql="SELECT * FROM `goods` WHERE `SID` = ".$_SESSION['sid']." AND `goods_class`='".$cl."'";
		$goods_result=mysqli_query($mysqli,$goods_sql);
		while ($goods_row=mysqli_fetch_array($goods_result)) {
			
			$goodsbox_str=$goodsbox_str."
						<div class='goods_box'>
							<a href='#' class='op_goods_detail'>
								<img src='img/goods/".$goods_row['goods_id'].".png' alt=''>
								<div class='col-xs-7'>
									<p class='goods_name'>名称:<b>".$goods_row['goods_name']."</b></p>
									<p class='goods_note'>备注:<b>".$goods_row['goods_note']."</b></p>
									<p class='goods_price'>价格:<b>".$goods_row['goods_price']."</b></p>
								</div>
							</a>	
						</div>
						<div class='goods_detail mddd'>
							<form method='post' action='controller/seller_goodsedit.php' enctype='multipart/form-data'>
								
								<p>
									<a href='' title=''><img src='img/goods/".$goods_row['goods_id'].".png' alt=''></a>
									<input class='inputfile' type='file' name='file'>
								</p>
								<p><span>菜品名字</span>
									<input type='text' class='goods_name' name='goods_name' value=''></p>
								<p><span>菜品类别</span>
									<select value='".$cl."' name ='goods_class'>
										".$detail_class_str."
									</select></p>
								<p><span>菜品简介</span>
									<input type='text' class='goods_note' name='goods_note' value=''></p>
								<p><span>菜品价格</span>
									<input type='text' class='goods_price' name='goods_price' value=''></p>
									<input type='hidden' name='method' value='change'>
									<input class='goods_id' name='goods_id' type='hidden' value='".$goods_row['goods_id']."'>
									<input type='hidden' name='sid' value='".$_SESSION['sid']."'>
								<button class='cf btn btn-info'>确定</button>
								<span class='can btn btn-warning'>取消</span>
								<span class='del btn btn-danger'>删除此菜品</span>
							</form>
						</div>";
		}
		$goodsbox_str=$goodsbox_str."</div>";
	}
	return $goodsbox_str;
}
	 ?>	

<div class="footer">
	<div class="footer-left">
		<div class="footerLink">
			<p>用户帮助</p>
			<a href="">服务中心</a>
			<a href="">常见问题</a>
		</div>
		<div class="footerLink">
			<p>商务合作</p>
			<a href="">我要开店</a>
			<a href="">加盟指南</a>
			<a href="">市场合作</a>
			<a href="">开放平台</a>
		</div>
		<div class="footerLink">
			<p>关于我们</p>
			<a href="">还饿吗介绍</a>
			<a href="">加入我们</a>
			<a href="">联系我们</a>
			<a href="">规则中心</a>
		</div>
		<div class="clear"></div>
	</div>

	<div class="footerPhone">
		<div><p>24小时客服热线 : 666-6666</p></div>
		<div><p>意见反馈 : 123@qq.com</p></div>
		<div><p>关注我们 : 123456</p></div>
	</div>
	<div class="clear"></div>
</div>
<script src="js/seller.js" type="text/javascript"></script>
</body>
</html>