<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Koko Touring: Add New Product</title>
<link rel="stylesheet" href="../../css/style.css"  />
</head>
<body>
<?php include("head.inc.php");
?>
<h3 align="center">Add New Cart</h3>
<p align="center">
<?php
if($_POST) {
	include("../dbconn.inc.php");
	

	$pro_name = htmlspecialchars($_POST['pro_name'], ENT_QUOTES);
	$descr = nl2br(htmlspecialchars($_POST['descr'], ENT_QUOTES));
	$price = $_POST['price'];
	
	$img_data = "";
	if($_FILES['img']['error'] == 0) {
		$file = $_FILES['img']['tmp_name'];
		$f = fopen($file, "r");
		$img_data = fread($f, filesize($file));
		$img_data = addslashes($img_data);
		fclose($f);
	}

	$sql = "INSERT INTO product VALUES
				(0, '$pro_name', $price, '$descr', '$img_data');";

	@mysql_query($sql) or die(mysql_error());
	
	echo "ข้อมูลได้รับการบันทึกแล้ว";
}
?>
</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table align="center">
<tr><td>ชื่อสินค้า:</td><td><input name="pro_name" type="text" id="pro_name" size="30"></td></tr>
<tr valign="top"><td>คำอธิบาย:</td><td><textarea name="descr" cols="37" rows="2"></textarea></td></tr>
<tr><td>ราคา:</td><td><input name="price" type="text" size="10"></td></tr>
<tr><td>ภาพสินค้า:</td><td><input type="file" name="img" size="30"></td></tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td align="center"><input type="submit" name="Submit" value="ส่งข้อมูล" /></td>
</tr>
</table>
</form>
<p>
</body>
</html>