<?php  
session_start();
include "controller/common.php";
$SID=$_GET['SID'];
$sql = "SELECT * FROM `shop` WHERE `SID` =".$SID;
$result=mysqli_query($mysqli,$sql);
$DATA=mysqli_fetch_array($result);
$src="img/shop/".$DATA['SID'].".png";
$avgstar_sql="SELECT AVG(comment_star) AS avgstar FROM `od` WHERE `SID`=".$SID." AND `comment_star`!=0";
$avgstar_result=mysqli_query($mysqli,$avgstar_sql);
$avgstar=mysqli_fetch_array($avgstar_result);
$sellnum_sql="SELECT * FROM `od` WHERE `SID`=".$SID." AND `O_overtime` IS NOT NULL";
$sellnum_result=mysqli_query($mysqli,$sellnum_sql);
$sellnum=mysqli_num_rows($sellnum_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" href="css/commmon.css">
<link rel="stylesheet" href="css/shop.css">
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
			if(isset($_SESSION['list'][0])){
				foreach ($_SESSION['list'] as $list) {
					echo"
						<div class='carbox_list' id='list_id_".$list->goods_id."'><input type='hidden'  value='".$list->goods_id."'><input class='CSID' type='hidden'  value='".$list->SID."'><span class='list_name'>".$list->goods_name."</span><span class='list_num'>".$list->goods_num."</span><span class='list_price'>".$list->goods_num*$list->goods_price."元</span></div>
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
			<span class="pricesum">共计</span>
			<button>下单</button>
		</div>
	</div>
</div>
<div class="header">
	<div class="headerBay center">
		<div class="topBay-left"> 
			<a class="harbtn LOGO" href="index.php"><div class="logo">还饿吗     </div></a>
			<a  class="harbtn" id="index" href="index.php">首页</a>
			<a class="harbtn" href="usercenter.php?position=allorder">我的订单</a>
			<a class="harbtn" href="sellerlogin.php">加盟合作</a>
		</div>
		<div class="logIco">
				<?php
				echo "<input id='SID' type='hidden' value='".$SID."'>
				<input id='min_price' type='hidden' value='".$DATA['min_price']."'>
				<input id='shopfee' type='hidden' value='".$DATA['shopFee']."'>";
				if (isset($_SESSION['user'])) {
					echo "<div class='sueee'><div class='slide'>
					<a href='usercenter.php?position=allorder' title=''><span>我的订单</span></a>
					<a href='usercenter.php?position=data' title=''><span>我的资料</span></a>
					<a href='usercenter.php?position=mycollection' title=''><span>我的收藏</span></a>
				<a href='index.php' class='logout'><span>注销</span></a>
			</div><a  class='logined harbtn' href='usercenter.php?position=center'><span>".$_SESSION['userName']."</span></a></div>";
				}else{
					echo "<a class='loginico harbtn' href='login.php'><span>登陆/注册</span></a>";
				}
					
				 ?>

			
		</div>
	</div>
</div>
<div class="shopBay">
	<div>
		<div class="shopBay-left">
			<?php echo "<img src='".$src."'' alt=''>" ?>
			<div class="shop-info">
				<span class="shopName"><?php echo $DATA['shopName']; ?></span>
				<span>评价</span>
				<span><?php echo round($avgstar['avgstar'],1); ?>/5</span>
				<span>月销</span>
				<span><?php echo $sellnum; ?>单</span>
				<div class="clear"></div>
			</div>
		</div>
		<div class="shopBay-right">
		
			<span class="minPri">起送价</span>
			<span class="sendPir">配送费</span>
			<br>
			<span><?php echo $DATA['min_price']; ?>元</span><span><?php echo $DATA['shopFee']; ?>元</span>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php 
	$li_st=comment_li($mysqli,$SID);
	echo "<div class='comment hidden'>
			<div class='shopnav'>
				<div class='shopnav_left'>
					<a href='' class='goods_page'><span>所有商品</span></a>
					<a href='' class='comment_page' title=''><span>评价</span></a>
				</div>	
			</div>
			<div class='comment_ul'>
				<ul>
					".$li_st."
				</ul>
			</div>
		</div>";
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
 ?>
<div class="main">
	<div class="shopnav">
		<div class="shopnav_left">
			<a href="#" class='goods_page'><span>所有商品</span></a>
			<a href="#" class='comment_page' ><span>评价</span></a>
			<div class="goods_sort">
				<a href="" title=""><span>默认排序</span></a>
				<a href="" title=""><span>评分</span></a>
				<a href="" title=""><span>销量</span></a>
				<a href="" title=""><span>价格</span></a>
				
			</div>
		</div>
		<div class="goods_search">
			<form method="get" action="">
			<input type="hidden" name="SID" value=<?php echo $SID;?>>
				<input  class="text" type="text" name="kw" value=<?php if(isset($_GET['kw'])){$kw=$_GET['kw'];echo $kw;}?>><input  class="submit" type="submit" value="搜索">
			</form>
			
		</div>
	</div>
	<div class="goods_class">
		<div>
		<?php
		//菜品类别栏
		 	$class_ar=json_decode($DATA['shop_class']);
		 	if($class_ar){
		 		foreach ($class_ar as $c) {
		 			echo "<a href='#".$c."'>".$c."</a>";
		 		}
		 	}
		 	
		 ?>
		</div>
	</div>
	<div class="goods">
		<div>
			<?php
				function addnum($id){
					if(isset($_SESSION['list'])){
						foreach($_SESSION['list'] as $list){
							if($id==$list->goods_id){
								return $list->goods_num;
							}
						}
					}
					return 0;
				}
				$goods="";
			if(isset($_GET['kw'])&&$_GET['kw']!=''){
				$goods_sql = "SELECT * FROM `goods` WHERE `SID`=".$SID." AND `goods_name` LIKE '%".$_GET['kw']."%'";
				$goods_result = mysqli_query($mysqli,$goods_sql);
						while($goods_row = mysqli_fetch_array($goods_result)){
							$num=addnum($goods_row['goods_id']);
							echo "
						<div class='goods_box'>
						<input type='hidden' class='SID' value='".$SID."'>
						<input class='shopfee' type='hidden' value='".$DATA['shopFee']."'>
						<input  class='goods_id' type='hidden' value='".$goods_row['goods_id']."'>
						<a href='' title=''>
						<img class='goods_img' src='img/goods/".$goods_row['goods_id'].".png'>
						</a>
						<div class='goods_inf'>
							<span class='goods_name'>".$goods_row['goods_name']."</span>
							<span class='goods_note'>
								".$goods_row['goods_note']."
							</span>
							<span class='sellnum'>
								月销".$goods_row['sell_num']."份
							</span>
							<span class='goods_price'>".$goods_row['goods_price']."元</span>
						</div>
						<div class='cart_count none'>
							<button class='minus'>-</button><input class='goods_num' type='text' value='".$num."'><button class='plus'>+</button>	
						</div>
						<div class='cart_btn'>
							<a href='##' title=''>加入购物车</a>
						</div>		
						</div>
							";
						}
			}else{
				if($class_ar){
					foreach ($class_ar as $c) {
						$goods=$goods."<div><span class='class_name' name='".$c."' id='".$c."'>".$c."</span>";
						$goods_sql = "SELECT * FROM `goods` WHERE `SID`=".$SID." AND `goods_class`='".$c."'";
						$goods_result = mysqli_query($mysqli,$goods_sql);
						while($goods_row = mysqli_fetch_array($goods_result)){
							$num=addnum($goods_row['goods_id']);
							$goods=$goods."
						<div class='goods_box'>
						<input type='hidden' class='SID' value='".$SID."'>
						<input class='shopfee' type='hidden' value='".$DATA['shopFee']."'>
						<input  class='goods_id' type='hidden' value='".$goods_row['goods_id']."'>
						<a href='' title=''>
						<img class='goods_img' src='img/goods/".$goods_row['goods_id'].".png'>
						</a>
						<div class='goods_inf'>
							<span class='goods_name'>".$goods_row['goods_name']."</span>
							<span class='goods_note'>
								".$goods_row['goods_note']."
							</span>
							<span class='sellnum'>
								月销".$goods_row['sell_num']."份
							</span>
							<span class='goods_price'>".$goods_row['goods_price']."元</span>
						</div>
						<div class='cart_count none'>
							<button class='minus'>-</button><input class='goods_num' type='text' value='".$num."'><button class='plus'>+</button>	
						</div>
						<div class='cart_btn'>
							<a href='##' title=''>加入购物车</a>
						</div>		
						</div>
							";
						}
						$goods=$goods."<div class='clear'></div></div>";
					} 
				}
				echo $goods;
			}
			 ?>
			<div class="clear"></div>
		</div>
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
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/shop.js">
	</script>
</div>
</body>
</html>