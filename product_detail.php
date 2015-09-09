<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koko Tou Product Detail</title>
<script src="ajax/framework.js"> </script>
<script>
function addCart(id) {
	var data = "id=" + id;
	var URL = "add_cart.php";

	ajaxLoad('post', URL, data, "cart");
}

function readCart() {
	ajaxLoad('post', "read_cart.php", null, "cart");
}
</script>
</head>

<body>
<?php include("header.inc.php"); ?>

<table width="600" align="center" style="border: solid 1px #cccccc;">
<tr valign="top">
<td width="430" align="center">

<?php
include("dbconn.inc.php");
$id = $_GET['id'];

$sql = "SELECT * FROM product WHERE pro_id = $id;";
$result = mysql_query($sql); 
$p = mysql_fetch_array($result);
?>

<h3><?php echo $p['pro_name']; ?></h3>

<p />
<img src="read_image.php?pid=<?php echo $p['pro_id']; ?>">

<br />
<div style="width: 80%;">
<?php echo $p['description']; ?>
</div>

<p />
<b>ราคา:</b> <?php echo $p['price']; ?> บาท
		<input type=button value=หยิบใส่รถเข็น onClick="addCart(<?php echo $p['pro_id']; ?>)" />	
		
<p />
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">ย้อนกลับ</a>

</td>

<td id="cart" bgcolor="#eeeeff">
	<script> readCart(); </script>
</td>

</tr>
</table>
<p>&nbsp;</p>
</body>
</html>