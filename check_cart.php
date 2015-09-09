<?php
session_start();
$sid = session_id();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Y-Commerce: Check Cart</title>
<link rel="stylesheet" href="../css/style.css"  />
<script>
function deleteCart(pid) {
	if(!confirm('ลบสินค้านี้ ?')) {
		return;
	}
	
	location = "<?php echo $_SERVER['PHP_SELF']; ?>?pid=" + pid;
}
</script>
</head>

<body>
<?php 
include("header.inc.php"); 
include("dbconn.inc.php");
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<?php
if($_POST) {
	foreach($_POST as $pid => $qtt) {
		if(!is_numeric($qtt) || $qtt <= 0) {
			continue;
		}
		$sql = "UPDATE cart SET quantity = $qtt
					WHERE pro_id = $pid AND sess_id = '$sid';";
		@mysql_query($sql);
	}
}
else if($_GET['pid']) {
	$pid = $_GET['pid'];
	$sql = "DELETE FROM cart WHERE pro_id = $pid AND sess_id = '$sid';";
	mysql_query($sql);
}

$sql = "SELECT * FROM cart
			WHERE sess_id = '$sid';";
$result = mysql_query($sql);

if(mysql_num_rows($result) == 0) {
	echo "<p align=center>ไม่พบสินค้าในรถเข็น</p>";
	echo "</form></body></html>";
	exit;
}

?>

<table border=1 bordercolor=#cccccc cellpadding=3 align=center style="border-collapse: collapse;">
	<caption>รายการสินค้าในรถเข็น</caption>
<tr bgcolor=#ddddff>
<th align=center width=220>สินค้า</th><th width=50>จำนวน</th><th width=50>ราคา</th><th width=80>รวม</th>
</tr>

<?php
$grand_total = 0;
while($cart = mysql_fetch_array($result)) {
	$sub_total = $cart['quantity'] * $cart['price'] ;
	$pid = $cart['pro_id'];
	echo "
	<tr valign=top>
		<td>
			[<a href=\"javascript: deleteCart($pid)\" title=ลบรายการนี้>x</a>]
			{$cart['pro_name']}
 		</td>
		<td align=center>
			<input type=text size=3 name=$pid value={$cart['quantity']} />
		</td>
		<td align=center>{$cart['price']}</td>
		<td align=right>$sub_total</td>
	</tr>";
	
	$grand_total += $sub_total;
}
?>

<tr>
	<td colspan=3 align=center>รวมทั้งหมด</td>
	<td align=right><?php echo $grand_total ?></td>
</tr>
</table>
<p align=center>

<input type=button value="&laquo;&nbsp;ย้อนกลับ" onclick="location='index.php'" />
&nbsp;&nbsp;&nbsp;&nbsp;

<input type=submit value=คำนวณใหม่ />
&nbsp;&nbsp;&nbsp;&nbsp;

<input type=button value="สั่งซื้อ&nbsp;&raquo;" onclick="location='customer_info.php'" />

</p>
</form>
</body>
</html>