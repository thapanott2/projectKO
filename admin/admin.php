<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koko Touring: Add New Product</title>
</head>
<?php include("head.inc.php"); ?>
<body>
<h3 align="center">Add New Cart</h3>
<p align="center">

<?php
if($_POST) {
	include("dbconn.inc.php");

	$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
	$code = nl2br(htmlspecialchars($_POST['code'], ENT_QUOTES));
	$desc = $_POST['desc'];
	$price = $_POST['price'];
  $image = $_FILES['image'];

	$sql = "INSERT INTO tblproduct VALUES
				(0, '$name', '$code', '$image', '$price');";

	@mysql_query($sql) or die(mysql_error());

	echo "Save to Database Compleate";
}
?>

</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table align="center">
<tr><td><strong>Product Name:</strong></td><td><input name="name" type="text" id="name" size="30"></td></tr>
<tr><td><strong>Code-Product:</strong></td><td><input name="code" type="text" size="15"></td></tr>
<tr><td><strong>Description:</strong></td><td><input name="desc" type="text" size="30"></td></tr>
<tr><td><strong>Price-Product:</strong></td><td><input name="price" type="text" size="15"></td></tr>
<tr><td><strong>Insert Pic:</strong></td><td><input type="file" name="image" size=""></td></tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td align="center"><input type="submit" name="Submit" value="Save" /></td>
</tr>
</table>
</form>
<p>
</body>
</html>
