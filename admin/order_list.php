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
	if(!confirm('ź�����Ţͧ�١�����¹��?')) {
		return;
	}
	
	window.location = 'order_list.php?cid=' + cid;
}

function notifyPayment(cid) {
	if(!confirm('�駡�ê����Թ?')) {
		return;
	}

	open('notify.php?notify=payment&cid=' + cid);
}

function notifyDelivery(cid) {
	if(!confirm('����ѧ�Ѵ���Թ���?')) {
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

//����ա���觢����� id �ͧ�١�������� �ʴ�����繡��ź�����Ţͧ�١���
//�����Ӥ�� id ���������͹䢡��ź�͡�ҡ��駵��ҧ customer ��� orders
if(isset($_GET['cid'])) {
	$cust_id = $_GET['cid'];

	$sql = "DELETE FROM customer, orders 
		 		USING(customer, orders) 
		 		WHERE customer.cust_id = $cust_id AND orders.cust_id = $cust_id;";

	mysql_query($sql);
}

//��ҹ�����Ţͧ�١��ҷ����觫����Թ���
$sql = "SELECT *, DATE_FORMAT(order_date,'%d-%m-%Y') AS dt
	 		FROM customer;";
	
$result = mysql_query($sql);
?>
<p />
<table border="1" cellpadding="3" align="center" style="border-collapse:collapse;">
<tr bgcolor="#ddddff">
 	<th width="50">����</th><th width="180">�����١���</th>
	<th width="80">�ѹ�����觫���</th><th>�Ѵ���Թ���</th><th>���Թ���</th>
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
		 	<a href=\"javascript: viewDetail($cid)\">��������´</a> |
		 	<a href=\"javascript: deleteCustomer($cid)\">ź</a> <br />
		 	<a href=\"javascript: notifyPayment($cid)\">�駡�ê����Թ</a> |
		 	<a href=\"javascript: notifyDelivery($cid)\">����ѧ���Թ���</a>
	 	</td>
	</tr>";
}
?>
</table>
</body>
</html>