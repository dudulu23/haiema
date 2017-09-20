<?php
	session_start();
	include "controller/common.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>还饿吗</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/commmon.css">
	<link rel="stylesheet" href="css/index.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="carbar">
	<div class="carbar-btn">
	<a href="##" title="">购物车</a>
		<?php
		    
			if(isset($_SESSION['list'])){
				if(count($_SESSION['list'])>0){
					$gds=0;
					foreach ($_SESSION['list'] as $list){
						$gds=$list->goods_num+$gds;
					}
					echo "<span class='car_goods_num'>".$gds."</span>";
				} 	
			}	
		 ?>
		
	</div>
	<div class="carbox">
		<?php 
			$psum=0;
			if(isset($_SESSION['list'][0])){
				foreach ($_SESSION['list'] as $list) {
					$psum=$list->goods_num*$list->goods_price+$psum;
					echo"
						<div class='carbox_list' id='list_id_".$list->goods_id."'><input type='hidden'  value='".$list->goods_id."'><span class='list_name'>".$list->goods_name."</span><span class='list_num'>".$list->goods_num."</span><span class='list_price'>".$list->goods_num*$list->goods_price."元</span><span><button class='list_del' onClick='indexlistdel(this)'>-</button></span></div>
					";
				}
			}
		 ?>
		
		<!-- <div class="carbox_list">
			<span class="list_name">烤翅</span>
			<span class="list_num">1</span>
			<span class="list_price">20元</span>
			<span><button class="list_del">-</button></span>
		</div> -->
		<div class="order_btn">
		<?php  echo "<span class='pricesum'>共<b>".$psum."</b>元</span>";?>		
			<button href='order.php'>下单</button>
		</div>
	</div>
</div>	
<div class="header">
	<div class="headerBay center">
		
		<div class="topBay-left"> 
			<a class="harbtn" href="index.php"><div class="logo"></div></a>
			<a  class="harbtn" id="index" href="index.php">首页</a>
			<a class="harbtn" href="usercenter.php?position=allorder">我的订单</a>
			<a class="harbtn" href="sellerlogin.php">加盟合作</a>
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
</div>
<div class="mainBody">
	<div class="searchBar">
		<div class="position">
			<span>当前位置:</span>
			<span>     </span>
			<a href=""><span>[切换地址](未实现)</span></a>
		</div>
		<div class="searchBox">
			<form action="" method="get">
				<input type="text" name="kw" value=<?php if(isset($_GET['kw'])){$kw=$_GET['kw'];echo $kw;}?>><button>搜索</button>
			</form>
		</div>
	</div>
	<div class="classify">
		<span>商家分类:</span>
		<div>
			<span><a href="">全部商家</a></span>
			<span><a href="">美食</a></span>
			<span><a href="">美食</a></span>
			<span><a href="">美食</a></span>
			<span><a href="">美食</a></span>
			<span><a href="">美食</a></span>
			<span><a href="">特色菜系</a></span>
			<span><a href="">特色菜系</a></span>
			<span><a href="">特色菜系</a></span>
			<span><a href="">特色菜系</a></span>
			<span><a href="">特色菜系</a></span>
			<span><a href="">特色菜系</a></span>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="shop">
	<?php
		function shopBox($row,$mysqli){
			if($row['open']==0){
				$cover="<div class='shop_cover'>
					<span>本店打烊了</span>
				</div>";
			}else{
				$cover="";
			}
			// 计算订单数
			$sellnum_sql="SELECT * FROM `od` WHERE `SID`=".$row['SID']." AND `O_overtime` IS NOT NULL";
			$sellnum_result=mysqli_query($mysqli,$sellnum_sql);
			$sellnum=mysqli_num_rows($sellnum_result);
			//计算平均分
			$avgstar_sql="SELECT AVG(comment_star) AS avgstar FROM `od` WHERE `SID`=".$row['SID']." AND `comment_star`!=0";
			$avgstar_result=mysqli_query($mysqli,$avgstar_sql);
			$avgstar=mysqli_fetch_array($avgstar_result);
			echo "
			<div class='shopBox'>".$cover."
				<a href='shop.php?SID=".$row['SID']."'>
					<div class='shopIco'><img src='img/shop/".$row['SID'].".png' alt=''></div>
					<div class='shopMsg'>
						<div class='shopName'>".$row['shopName']."</div>
						<span class='shopStar'>评分:".round($avgstar['avgstar'],1)."/5</span>
						<span class='shopSales'>销量:".$sellnum."单</span>
						<span class='shopFee'>配送费￥".$row['shopFee']."</span>
					</div>
				</a>
				<div class='shophover'>
					<span class='shopName-hover'>".$row['shopName']."</span>
					<div>
						<span>配送费￥".$row['shopFee']."</span>
					</div>
				</div>
			</div>
		";
		} 
		
		if(isset($_GET['kw'])){
			$sql_open = "SELECT `SID`, `shopName`, `shopImg`, `shopFee`,`ADD`,`open` FROM `shop` WHERE `open`=1 AND `shopName` LIKE  '%".$_GET['kw']."%'";
			$sql = "SELECT `SID`, `shopName`, `shopImg`, `shopFee`,`ADD`,`open` FROM `shop` WHERE `open`=0  AND `shopName` LIKE  '%".$_GET['kw']."%'";
		}else{
			$sql_open = "SELECT `SID`, `shopName`, `shopImg`, `shopFee`,`ADD`,`open` FROM `shop` WHERE `open`=1";
			$sql = "SELECT `SID`, `shopName`, `shopImg`, `shopFee`,`ADD`,`open` FROM `shop` WHERE `open`=0";
		}
		
		$result_open = mysqli_query($mysqli,$sql_open);
		while($row = mysqli_fetch_array($result_open)){
			shopBox($row,$mysqli);	
		}
		
		$result = mysqli_query($mysqli,$sql);
		while($row = mysqli_fetch_array($result)){
			shopBox($row,$mysqli);	
		}
		
	 ?>

		<div></div>
		<div class="clear"></div>
	</div>
</div>
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

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/shop.js"></script>
</script>
</body>
</html>