<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KOKO TOUR: Order Detail</title>
<link rel="stylesheet"  href="/css/style.css">
</head>
<body>
<br />
<?php 
include("head.inc.php"); ?>
<?php 
$cust_id = $_GET['cid'];
include("../dbconn.inc.php");


$sql = "SELECT *,DATE_FORMAT(order_date,'%d-%m-%Y') AS dt
 			FROM customer
	 		WHERE cust_id  =  $cust_id;";
	
$result = mysql_query($sql) or die(mysql_error());
$cust = mysql_fetch_array($result);

echo "<b>รหัส:</b> {$cust['cust_id']}	<br />
		<b>ชื่อลูกค้า:</b> {$cust['name']}	<br />
		<b>ที่อยู่:</b> {$cust['address']}	<br />
		<b>โทร:</b> {$cust['phone']}  <br />
		<b>อีเมล์:</b> {$cust['email']} <br />
		<b>วันที่สั่งซื้อ:</b> {$cust['dt']}";

$sql = "SELECT * FROM orders
	 		WHERE cust_id = $cust_id;";

$result = mysql_query($sql) or die(mysql_error());
?>
<p />
<table border="1" cellpadding="5" bordercolor="white" style="border-collapse: collapse;">
<tr bgcolor="#eeeeff">
 	<th width="50">ลำดับ</th><th width="250">รายการ</th>
	<th width="60">จำนวน</th><th width="80">ราคา</th><th width="80">รวม</th>
</tr>
<?php
$i = 0;
$gt = 0;
while($ord = mysql_fetch_array($result)) {
	$st = $ord['price'] * $ord['quantity'];
	$gt += $st;
	$i++;
	echo "<tr>
	 			<td align=center> $i </td>
	 			<td> {$ord['pro_name']} </td>
	 			<td align=center> {$ord['quantity']} </td>
	 			<td align=center> {$ord['price']} </td>
	 			<td align=right> $st </td>
	 		</tr>";
}
?>
<tr align=center>
	<td colspan=4 align="right"><b>รวมทั้งหมด</b></td>
	<td align=right><u><?php echo $gt; ?></u></td>
</tr>
</table>
</body>
</html>