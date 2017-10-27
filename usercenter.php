
<?php 
session_start();
include "controller/common.php";
if(!isset($_SESSION['user'])){
	header( "Location: index.php" ); 
}
if(isset($_GET['position'])){
	$p=$_GET['position'];
}
//查询订单
$sql_od="SELECT * FROM `od` WHERE `UID`=".$_SESSION['user']." ORDER BY `od`.`O_time` DESC";
$result_od=mysqli_query($mysqli,$sql_od);
$sql_user="SELECT * FROM `user` WHERE `UID`=".$_SESSION['user'];
$result_user=mysqli_query($mysqli,$sql_user);
$row_user=mysqli_fetch_array($result_user);
if($row_user['img']==''){
	$imgurl="img/common/default-avatar.png";
}else{
	$imgurl=$row_user['img'];
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>个人中心</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/commmon.css">
	<link rel="stylesheet" href="css/usercenter.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class='cover'></div>
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
				if (isset($_SESSION['user'])) {
					echo "<input type=hidden id='userid' value='".$_SESSION['user']."'><div class='sueee'><div class='slide'>
				<a href='index.php' class='logout'><span>注销</span></a>
			</div><a  class='logined harbtn' href='usercenter.php?position=center'><span>".$_SESSION['userName']."</span></a></div>";
				}else{
					echo "<a  class='loginico harbtn' href='login.php'><span>登陆/注册</span></a>";
				}
					
				 ?>

			
		</div>
	</div>
	<div class="mainbody">
		<div class="sidebar">
			<div class="usercenter">
			   <a href="usercenter.php?position=center" class="bold" title="">个人中心</a>
			</div>
			<div class="myorder">
				<span class="bold">我的订单<span>
				<ul>
					<li><a href="usercenter.php?position=allorder" title="">全部订单</a></li>
					<li><a href="usercenter.php?position=noassess" title="">待评价订单</a></li>
					<li><a href="usercenter.php?position=chargeback" title="">退单记录</a></li>
				</ul>		
			</div>
			<div class="mydata">
				<span class="bold">我的资料<span>
				<ul>
					<li><a href="usercenter.php?position=data" title="">个人资料</a></li>
					<li><a href="usercenter.php?position=add" title="">地址管理</a></li>
					<li><a href="usercenter.php?position=safecenter" title="">安全中心</a></li>
					<li><a href="usercenter.php?position=changeps" title="">修改密码</a></li>	
				</ul>		
			</div>
			<div class="mycollection">
				<a href="usercenter.php?position=mycollection" title="" class="bold">我的收藏</a>		
			</div>		
		</div>
		<?php
		function orderboxmaker($user,$mysqli,$type){
			if($type=='no'){
				$sql_od="SELECT * FROM `od` WHERE `UID`=".$user." ORDER BY `od`.`O_time` DESC";
			}else if($type=='noassess'){
				$sql_od="SELECT * FROM `od` WHERE `UID`=".$user." AND `comment_star`=0 AND `O_overtime`!='' ORDER BY `od`.`O_time` DESC";
			}
			//查询订单
			
			$result_od=mysqli_query($mysqli,$sql_od);
			$orderbox="";
			while ($row_od=mysqli_fetch_array($result_od)) {
				$ADD=json_decode($row_od['O_ADD']);
				$list="";
				$detal_list="";
				if($row_od['O_overtime']!=NUll&&$row_od['comment_star']!=0){
					$state="订单完成(已评价)";
				}else if($row_od['O_overtime']!=NUll){
					$state='订单完成(未评价)';
				}else if($row_od['O_t_sellersub']!=NULL){
					$state="商家已接单";
				}else{
					$state="商家未接单";
				}
				foreach (json_decode($row_od['O_list']) as $key) {
					$detal_list=$detal_list."<p>".$key->goods_name."*".$key->goods_num."</p>";
					$list=$list.$key->goods_name."*".$key->goods_num." ";
				};

				$sql_shop="SELECT * FROM `shop` WHERE `SID`=".$row_od['SID'];
				$result_shop=mysqli_query($mysqli,$sql_shop);
				$row_shop=mysqli_fetch_array($result_shop);
				$orderbox=$orderbox."
			<div class='orderbox clearfix'>
				<span class='time col-xs-2'>".$row_od['O_time']."</span>
				<span class='col-xs-4'>
					<a href='shop.php?SID=".$row_od['SID']."'>".$row_shop['shopName']."</a>
					<p class='goods'>".$list."</p>
					<p class='orderid'>订单号:".$row_od['O_id']."</p>
				</span>
				<span class='price col-xs-2'>".$row_od['O_sum']."</span>
				<span class='state col-xs-2'>".$state."</span>
				<span class='op col-xs-2'>
					<button class='btn btn-info'>订单详情</button>
				</span>
			</div>
			<div class='o_detail'>
				<p class='o_datail_title col-xs-12'>订单详情</p>
				<div class='col-xs-6'>
					<span class='col-xs-6'>店名：</span><span class='col-xs-6'>".$row_shop['shopName']."</span>
					<span class='col-xs-6'>店家联系方式：</span><span class='col-xs-6'>".$row_shop['shopphone']."</span>

					<span class='col-xs-6'>订单时间：</span><span class='col-xs-6'>".$row_od['O_time']."</span>
					<span class='col-xs-6'>订单编号：</span><span class='od_id col-xs-6'>".$row_od['O_id']."</span>
					<span class='col-xs-6'>订单状态：</span><span class='col-xs-6'>".$state."</span>
					<span class='col-xs-6'>菜品：</span><span class='col-xs-6'>
						".$detal_list."
					</span>
					<span class='col-xs-6'>总价格：</span><span class='col-xs-6'><b>".$row_od['O_sum']."</b>元</span>
				</div>
				<div class='col-xs-6'>
					<span class='col-xs-6'>联系人：</span><span class='col-xs-6'>".$ADD->name."</span>
					<span class='col-xs-6'>电话：</span><span class='col-xs-6'>".$ADD->phone."</span>
					<span class='col-xs-6'>详细地址：</span><span class='col-xs-6'>".$ADD->position."</span>
					<span class='col-xs-6'>备注：</span><span class='col-xs-12'>".$row_od['O_words']."</p>
				</div>
				<div class='comment col-xs-12 hidden'>
					<span class='col-xs-2'>订单评价</span>
					<div class='ro col-xs-4'>
						<label>5
						<input type='radio' name='star' value='5'></label>
						<label>4
						<input type='radio' name='star' value=4'></label>
						<label>3
						<input type='radio' name='star' value='3'></label>
						<label>2
						<input type='radio' name='star' value='2'></label>
						<label>1
						<input type='radio' name='star'  value='1'></label>
					</div>
					<span class='col-xs-2'>留言</span>
					<textarea></textarea>

					
				</div>
				<div class='col-xs-12'>
					<button class='cf btn btn-info'>确定</button>
					<button class='btn btn-warning'>退单</button>
					<button class='btn btn-success' disabled='true' >确认收货</button>
					<button class='com btn btn-info' disabled='true'>评论订单</button>
				</div>	
			</div>
				";
			}

			return $orderbox;
		}
		//生成地址
		function addboxmaker($adddata){
			
			$add_ar=json_decode($adddata);
			$str="";
			$adi=0;
			foreach ($add_ar as $key) {
				$str = $str."<div class='addbox'>
								<div class='addbox_name'>".$key->name."</div><span class='addbox_sex'>".$key->sex."</span>
								<div class='addbox_btn'>
									<a class='editadd ' href='#' title=''>修改</a>    <a class='deladd' href='#' title=''>删除</a>
								</div>
							<div class='clear'></div>
							<span class='addbox_position'>".$key->position."</span>
							<span class='addbox_phone'>".$key->phone."</span>
						</div>
					<div class='editaddbox addaddbox center'>
						<div class='addaddbox_title'>
							修改地址信息
						</div>
						<input type='hidden' value='".$adi."' class='addid'>
						<span>名字</span><input type='text' class='add_name form-control' value='".$key->name."'>
						<span>
							<label>先生
							<input type='radio' name='sex' value='先生'></label>
							<label>女士
							<input type='radio' name='sex'  value='女士'></label>
						</span>
						<span>详细地址</span><input type='text' class='add_position form-control' value='".$key->position."'>
						<span>联系方式</span><input type='text' class='add_phone form-control' value='".$key->phone."'>
						<button class='cf btn btn-success'>确定</button><button class='cc btn btn-warning'>取消</button>
					</div>
					";
					$adi++;
			}
		return $str;
		}
switch($p){
case 'center':
echo"
	<div class='usercenter-body rightbox'>
				<div class='usercenter-title'>
					<div class='userinfo'>
						<a href='' title=''><img class='userimg' src='".$imgurl."' alt=''></a>
						<p>你好, <b>".$_SESSION['userName']."</b><p>
					</div>
				</div>
				<div class='usercenter-order'>
					<div class='_order_title'>
						<span class='o_title'>最近订单</span><a id='allorder' href='' title=''><span >查看所有订单></span></a>
					</div>
					<div class='_order_main'>
						<div class='o_smsg'>
							<img src='' alt=''>
							<p class='o_sname'></p>
							<span class='o_item'></span>
							<span class='o_item'>共个菜</span>
						</div>
						<div class='o_time'>
							
						</div>
						<div class='o_price'>
							
						</div>
						<div class='o_state'>
							
						</div>
					</div>
				</div>
	</div>";
break;
case "allorder":
$orderbox=orderboxmaker($_SESSION['user'],$mysqli,'no');
echo "<div class='allorder rightbox'>
		<div class='rightbox_title'>
			<span>全部订单</span>		
		</div>
		<div class='rightbox_body'>
			<div class='order_title clearfix'>
				<span class='col-xs-2'>时间</span>
				<span class='col-xs-4'>内容</span>
				<span class='col-xs-2'>金额(元)</span>
				<span class='col-xs-2'>状态</span>
				<span class='col-xs-2'>操作</span>
			</div>
			".$orderbox."
		</div>		
	</div>";
break;
case "noassess":
$orderbox=orderboxmaker($_SESSION['user'],$mysqli,'noassess');
echo "<div class='noassess rightbox'>
<div class='rightbox_title'>
			<span>待评价订单</span>		
		</div>
		<div class='rightbox_body'>
			<div class='order_title clearfix'>
				<span class='col-xs-2'>时间</span>
				<span class='col-xs-4'>内容</span>
				<span class='col-xs-2'>金额(元)</span>
				<span class='col-xs-2'>状态</span>
				<span class='col-xs-2'>操作</span>
			</div>
			".$orderbox."
		</div>
	</div>";
break;
case "chargeback":
echo "<div class='chargeback rightbox'>
<div class='rightbox_title'>
			<span>退单记录</span>		
		</div>
		<div class='rightbox_body'>
					
		</div>
</div>";
break;
case "data":
echo "<div class='data rightbox'>
<div class='rightbox_title'>
			<span>个人资料</span>		
		</div>
		<div class='rightbox_body'>
		<div class='imgupload'>
			<form method='post' action='controller/imgupload.php' enctype='multipart/form-data'>
					<input type='hidden' name='UID' value='".$_SESSION['user']."'>
					<input class='inputfile' type='file' name='file'><input class='btn btn-info' type='submit'value='确认'>
					<input class='can btn btn-warning' type='button'value='取消'>
			</form>
		</div>
		
		<p>头像</p>
		<p><a href='#' class='imgc' title='修改头像'><img class='headimg' src='".$imgurl."'></a></p>	
		<p><span>用户名：</span>   <span>".$row_user['userName']."</span>  <a class='datachange' href= title=>[修改]</a></p>  
		<p><span>我的邮箱：</span>   <span>".$row_user['Email']."</span></p>
		</div>
</div>";
break;
case "add":
$sql="SELECT * FROM `user` WHERE `UID`=".$_SESSION['user'];
$result = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_array($result);
 $addbox=addboxmaker($row['ADD']);
echo "<div class='add rightbox'>
<div class='rightbox_title'>
			<span>地址管理</span>		
		</div>
		<div class='rightbox_body clearfix'>
				".$addbox."
				<div class='addbox'>
					<a  class='addbox_addadd' href='#' title=''>添加新地址</a>
				</div>
				<div class='AD addaddbox center'>
					<div class='addaddbox_title'>
						添加地址信息
					</div>
					<span>名字</span><input type='text' class='add_name form-control'>
					<span>
						<label>先生
						<input type='radio' name='sex' value='先生'></label>
						<label>女士
						<input type='radio' name='sex'  value='女士'></label>
					</span>
					<span>详细地址</span><input type='text' class='add_position form-control'>
					<span>联系方式</span><input type='text' class='add_phone form-control'>
					<button class='cf btn btn-success'>确定</button><button class='cc btn btn-warning'>取消</button>
				</div>	
		</div>
</div>";
break;
case "safecenter":
echo "<div class='safecenter rightbox'>
<div class='rightbox_title'>
			<span>安全中心</span>		
		</div>
		<div class='rightbox_body'>
					
		</div>
</div>";
break;
case "changeps":
echo "<div class='changeps rightbox'>
<div class='rightbox_title'>
			<span>修改密码</span>		
		</div>
		<div class='rightbox_body'>
			<div>
				<span>新密码</span>
				<input class='form-control' type='text' name='' value=''>
				<span>确认新密码</span>
				<input class='form-control' type='text' name='' value=''>
				<input class='btn btn-info' type='button' name='' value='确认修改'>	
			</div>		
		</div>
</div>";
break;
case "mycollection":
echo "<div class='mycollection rightbox'>
<div class='rightbox_title'>
			<span>我的收藏</span>		
		</div>
		<div class='rightbox_body'>
					
		</div>
</div>";
break;
}
		 ?>		
		<div class="clear"></div>
		
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
	<script type="text/javascript" src="js/usercenter.js"></script>
</body>
</html>