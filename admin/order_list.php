<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Koko Touring: Order List</title>
<link rel="stylesheet" href="../../css/style.css"  />
<script>
function viewDetail(cid) {
	open('order_detail.php?cid=' + cid);
}

function deleteCustomer(cid)  {
	if(!confirm('ลบข้อมูลของลูกค้ารายนี้?')) {
		return;
	}
	
	window.location = 'order_list.php?cid=' + cid;
}

function notifyPayment(cid) {
	if(!confirm('แจ้งการชำระเงิน?')) {
		return;
	}

	open('notify.php?notify=payment&cid=' + cid);
}

function notifyDelivery(cid) {
	if(!confirm('แจ้งหลังจัดส่งสินค้า?')) {
		return;
	}

	open('notify.php?notify=delivery&cid=' + cid);
}
</script>
</head>

<body>
<?php

include("../dbconn.inc.php");
include("head.inc.php");

//ถ้ามีการส่งข้อมูล id ของลูกค้าเข้ามา แสดงว่าเป็นการลบข้อมูลของลูกค้า
//ก็ให้นำค่า id นั้นไปเป็นเงื่อนไขการลบออกจากทั้งตาราง customer และ orders
if(isset($_GET['cid'])) {
	$cust_id = $_GET['cid'];

	$sql = "DELETE FROM customer, orders 
		 		USING(customer, orders) 
		 		WHERE customer.cust_id = $cust_id AND orders.cust_id = $cust_id;";

	mysql_query($sql);
}

//อ่านข้อมูลของลูกค้าที่สั่งซื้อสินค้า
$sql = "SELECT *, DATE_FORMAT(order_date,'%d-%m-%Y') AS dt
	 		FROM customer;";
	
$result = mysql_query($sql);
?>
<p />
<table border="1" cellpadding="3" align="center" style="border-collapse:collapse;">
<tr bgcolor="#ddddff">
 	<th width="50">รหัส</th><th width="180">ชื่อลูกค้า</th>
	<th width="80">วันที่สั่งซื้อ</th><th>จัดส่งสินค้า</th><th>ดำเนินการ</th>
</tr>
<?php
while($cust = mysql_fetch_array($result)) {
	$cid = $cust['cust_id'];
 	echo "
	<tr align=center valign=top>
	 	<td> $cid </td>
		<td align=left> {$cust['name']} </td>
		<td> {$cust['dt']} </td>
	 	<td> {$cust['delivery']} </td>
	 	<td>
		 	<a href=\"javascript: viewDetail($cid)\">รายละเอียด</a> |
		 	<a href=\"javascript: deleteCustomer($cid)\">ลบ</a> <br />
		 	<a href=\"javascript: notifyPayment($cid)\">แจ้งการชำระเงิน</a> |
		 	<a href=\"javascript: notifyDelivery($cid)\">แจ้งหลังส่งสินค้า</a>
	 	</td>
	</tr>";
}
?>
</table>
</body>
</html>