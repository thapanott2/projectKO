<?php
session_start();
$sid = session_id();

$pro_id = "";
if(isset($_POST['id'])) {
	$pro_id = $_POST['id'];
}
else {
	exit;
}

include("dbconn.inc.php");


$sql = "SELECT pro_name, price FROM product
			WHERE pro_id = $pro_id;";

$result = mysql_query($sql);
$pro_name = mysql_result($result, 0, 0);
$price = mysql_result($result, 0, 1);

$sql = "REPLACE INTO cart VALUES
			('$sid', $pro_id, '$pro_name', $price, 1, NOW());";

mysql_query($sql);

header("content-type: text/javascript; charset=utf-8");
echo "alert('������Թ���ŧ��ö��������');
		 readCart();";
?>
