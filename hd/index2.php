<!DOCTYPE HTML>
<html>
<head>
<title>KO Return Chiang Mai Touring</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style3.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/form.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!--start slider -->
    <link rel="stylesheet" href="css/fwslider.css" media="all">
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/css3-mediaqueries.js"></script>
    <script src="js/fwslider.js"></script>
<!--end slider -->
<script src="js/jquery.easydropdown.js"></script>

	<style>
		.add_cart {font-size:10px; background-color:#CCBBFF; color:brown;}
		.line_dot {border-top: dotted 1px gray;}
	</style>

<script src="ajax/framework.js"> </script>
<script>
function addCart(id) {
	 	var data = "id=" + id;
		var URL = "add_cart.php";

		ajaxLoad('post',URL,data,"cart");
 }

function readCart() {
	ajaxLoad('post',"read_cart.php",null,"cart");
}
</script>

</head>
<body>

<?php include("header.inc.php");?>

<!-- start slider -->
	<div id="fwslider" style="height: 500px;padding-top: 0px;padding-bottom:
	0px;margin-top: 50px;margin-left: 0px;border-right-width:
	50px;border-bottom-width: 0px;margin-bottom: 50px;margin-right:
	50px;top: 50px;bottom: 50px;left: 50px;right: 50px;width: 1360px;">

			<div class="slider_container">
					<div class="slide">
							<!-- Slide image -->
									<img src="images/banner.jpg" alt=""/>
							<!-- /Slide image -->
							<!-- Texts container -->
							<div class="slide_content">
									<div class="slide_content_wrap">
											<!-- Text title -->
											<h4 class="title">The Dhara Dhevi Chiang Mai </h4>
											<!-- /Text title -->

											<!-- Text description -->
											<p class="description">Luxury in Chiang Mai</p>
											<!-- /Text description -->
									</div>
							</div>
							 <!-- /Texts container -->
					</div>
					<!-- /Duplicate to create more slides -->
					<div class="slide">
							<img src="images/banner1.jpg" alt=""/>
							<div class="slide_content">
									<div class="slide_content_wrap">
											<h4 class="title">Khun Chang Khian Highland  </h4>
											<p class="description">Research Station</p>
									</div>
							</div>
					</div>
					<div class="slide">
							<img src="images/banner2.jpg" alt=""/>
							<div class="slide_content">
									<div class="slide_content_wrap">
											<h4 class="title">Mon Cham</h4>
											<p class="description">Just the WAY you are </p>
									</div>
							</div>
					</div>
					<div class="slide">
							<img src="images/banner3.jpg" alt=""/>
							<div class="slide_content">
									<div class="slide_content_wrap">
											<h4 class="title">Doi Inthanon National Park </h4>
											<p class="description">Best Way Best Friend</p>
									</div>
							</div>
					</div>
					<!--/slide -->
			</div>
			<div class="timers"></div>
			<div class="slidePrev"><span></span></div>
			<div class="slideNext"><span></span></div>
	</div>
	<!--/slider -->

	<!-- ตารางที่ใช้วางโครงสินค้าและรถเข็น-->

<?php	include("./inc/paging.inc.php");
 include("dbconn.inc.php");

$current_page = 1;
if(isset($_GET['page'])) {
	$current_page = $_GET['page'];
}
$row_per_page = 5;
$start_row = paging_start_row($current_page,$row_per_page);

$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM product LIMIT $start_row,$row_per_page;";

$result = mysql_query($sql)or die(mysql_error());
$found_rows = mysql_query("SELECT FOUND_ROWS();");
$total_rows = mysql_result($found_rows,0,0);

if($total_rows == 0) {
	echo"<caption><b>Product Not Found</b></caption>";
}
	else {
		$stop_row = paging_stop_row($start_row,$row_per_page,$total_rows);
		echo"<caption><b>Product No:" .($start_row+1).
		" - " ."$stop_row Total $total_rows </b></caption>";
}

while($p = mysql_fetch_array($result) or die(mysql_error())) {
	$id = $p['pro_id'];
	//คำอธิบายสินค้า แสดงเพียง 100 อักขระแรก

	$descr = substr($p['description'], 0, 80) . "...";
	echo "
	<tr valign=top>
		<td rowspan=2 align=center>
			<img width=250 src=read_image.php?pid=$id />
		</td>
		<td colspan=2>
			<a href=product_detail.php?id=$id><b>{$p['pro_name']}</b></a> <br />
			$descr
		</td>
	</tr>
	<tr valign=bottom>
		<td>
			ราคา: {$p['price']} บาท
		</td>
		<td align=right>

			<input type=button class=grey value=หยิบใส่รถเข็น class=add_cart
			 	onClick=\"addCart($id)\" />
		</td>
	</tr>
	<tr><td colspan=3 class=line_dot>&nbsp;</td></tr>";
}
?>
</table></td>

<td id="cart" bgcolor="#eeeeff">
 <script> readCart();</script></td>
 </tr>
 </table>
<?php include("footer.inc.php");?>

</body>
</html>
