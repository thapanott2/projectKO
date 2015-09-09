<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Customer</title>
</head>
<?php include("head.inc.php") ?>
<body>
<?php
mysql_connect("localhost","root","root");
mysql_select_db("store");

$sql = "SELECT *  FROM user;";
$result = mysql_query($sql);
if(!$result) {
	echo "เกิดข้อผิดพลาดในการอ่านข้อมูล";
}
else if(mysql_num_rows($result) == 0) {
	echo "ไม่มีข้อมูลในตาราง";
}
else {
	echo "<table border=1 cellpadding=3>";

	//��ҹ�����ŷ������Ǩҡ result set ��Ẻ��������
	while(list($id,$name,$email) = mysql_fetch_row($result)) {
		echo "<h2>Customer</h2> No:$id Email:$name <br />Pass:$email";
	}


	echo "</table>";
}
?>
</body>
</html>
