<?php
include("dbconn.inc.php");

$pid = $_GET['pid'];
$sql = "SELECT img FROM product WHERE pro_id = $pid;";
$result = mysql_query($sql);
$data = mysql_result($result, 0, "img");
echo $data;
?>