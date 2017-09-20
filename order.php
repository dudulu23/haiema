<?php 
	session_start();
	include "controller/common.php";
	if(!isset($_SESSION['user'])){
		header( "Location: index.php" );
	}
	$sql="SELECT * FROM `user` WHERE `UID`=".$_SESSION['user'];
	$result = mysqli_query($mysqli,$sql);
	$row = mysqli_fetch_array($result);	
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>订单信息</title>
 	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/commmon.css">
	<link rel="stylesheet" href="css/order.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
 </head>
 <body>
 	<div class="header">
	<div class="headerBay center">
		
		<div class="topBay-left"> 
			<a class="harbtn" href="index.php"><div class="logo"></div></a>
			<a  class="harbtn" id="index" href="index.php">首页</a>
			<a class="harbtn" href="usercenter.php?position=allorder">我的订单</a>
			<a class="harbtn" href="">加盟合作</a>
		</div>
		<div class="logIco">
				<?php 
				if (isset($_SESSION['user'])) {
					echo "<div class='sueee'><div class='slide'>
					<a href='usercenter.php?position=allorder' title=''><span>我的订单</span></a>
					<a href='usercenter.php?position=data' title=''><span>我的资料</span></a>
					<a href='usercenter.php?position=mycollection' title=''><span>我的收藏</span></a>
				<a href='index.php' class='logout'><span>注销</span></a>

			</div><a  class='logined harbtn' href='usercenter.php?position=center'><span>".$_SESSION['userName']."</span></a></div>";
				}else{
					echo "<a  class='loginico harbtn' href='login.php'><span>登陆/注册</span></a>";
				}
					
				?>

			
		</div>
	</div>
	<div class='order_body container'>
		<div class='order_body_left col-xs-7'>
			<div class='order_title center'>
				<span>确认订单</span>
				<a href="javascript:window.history.back(-1)"><返回继续点餐</a>
			</div>
			<?php
			$sum=0;
			if(isset($_SESSION['list'][0])){
				echo "
			<div class='list_title'>
				<span class='col-xs-7'>商品</span>
				<span class='col-xs-3'>数量</span>
				<span class='col-xs-2'>小计</span>
				<div class='clearfix'></div>
			</div>";
			
				foreach ($_SESSION['list'] as $list){
					$_SESSION['SID']=$list->SID;
					$sum=$sum+$list->goods_num*$list->goods_price;
				echo "
			<div class='order_list'>
				<input class='goods_price' type='hidden' value='".$list->goods_price."'>
				<input class='goods_id' type='hidden' value='".$list->goods_id."'>
				<span class='col-xs-7'>".$list->goods_name."</span>
				<span class='col-xs-3'>
				<button class='minus btn btn-default btn-xs'>-</button><input class='goods_num' type='text' value='".$list->goods_num."'><button class='plus btn btn-default btn-xs'>+</button>
				</span>
				<span class='goods_sum  col-xs-2'>".$list->goods_num*$list->goods_price."</span>
				<div class='clearfix'></div>
			</div>
			"; 
				}
			}
			?>
			<div class='O_words'>
			<p><b>留言</b><p>
			<textarea cols='50' maxlength='200'></textarea>
			</div>
		</div>
		<div class='order_body_right col-xs-5'>
			<div class='order_title center'>
				<span>送达地址</span><a href="usercenter.php?position=add">编辑地址信息</a>
			</div>
			<?php 
			$addbox=json_decode($row['ADD']);
			foreach ($addbox as $key) {
				echo"
					<a class='o_add col-xs-12'>
						<span class='addbox_name'>".$key->name."</span><span class='addbox_sex'>".$key->sex."</span>
						<span class='addbox_position'>".$key->position."</span>
						<span class='addbox_phone'>".$key->phone."</span>
					</a>
				";
			}


			 ?>
			<!-- <a href='' class='o_add col-xs-12'>
					<span class='addbox_name'>老三</span><span class='addbox_sex'>先生</span>
					<span class='addbox_position'>乡下</span>
					<span class='addbox_phone'>66666</span>
			</a> -->
			<div class='clearfix'></div>
		</div>

	</div>
</div>
<div class='o_submit'>
	<button class='btn btn-info pull-right'>下单</button>
	<span class='pull-right'>共计<b><?php echo $sum ?></b>元</span>
	
</div>
<script type="text/javascript" src="js/order.js"></script>
 </body>
</html>