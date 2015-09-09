<?php
session_start();
$sid = session_id();

include("dbconn.inc.php");

//ตรวจสอบสินค้าที่ลูกค้าคนนั้นหยิบใส่รถเข็น
$sql = "SELECT * FROM cart  WHERE sess_id = '$sid';";
$result_cart = mysql_query($sql);
if(mysql_num_rows($result_cart) == 0) {
	die("ท่านไม่เลือกสินค้าไว้ในรถเข็น");
}

//สร้างตัวแปรว่างๆเอาไว้ก่อน เพื่อรอจัดเก็บข้อมูลในขั้นตอนต่อไป
$name = "";
$address = "";
$phone = "";
$email = "";
$errmsg = "";

if($_POST) {
	//ตรวจสอบความถูกต้องของข้อมูล
	foreach($_POST as $k => $v) {
		if(empty($v)) {
			$errmsg = "ท่านยังใส่ข้อมูลไม่ครบ";
			break;
		}
		$v = stripslashes($v);
		$v = htmlspecialchars($v, ENT_QUOTES);
		
		$_POST[$k] = $v;
	}
	
	$name = $_POST['name'];
	$address =$_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	
	//จัดเก็บข้อมูลลูกค้าจัดเก็บลงในตาราง customer
	if($errmsg == "") {
		$sql = "INSERT INTO customer VALUES
					(0, '$name', '$address', '$phone', '$email', NOW(), 'No');";
					
		@mysql_query($sql) or die(mysql_error());
		
		//อ่านค่า id ของลูกค้าที่เพิ่มข้อมูลล่าสุด
		$cust_id = mysql_insert_id();

		//ต่อไปคือการย้ายข้อมูลจากตาราง cart ไปยังตาราง orders
		//เริ่มจากการอ่านข้อมูลจากตาราง cart มาก่อน
		$sql = "SELECT * FROM cart
					WHERE sess_id = '$sid';";
		$result = mysql_query($sql);
		
		//นำข้อมูลที่อ่านมาจากตาราง cart และค่า id ของลูกค้า ไปเพิ่มลงในตาราง orders
		while($cart = mysql_fetch_array($result)) {
			$pro_id = $cart['pro_id'];
			$pro_name = $cart['pro_name'];
			$price = $cart['price'];
			$quantity = $cart['quantity'];
			$sql = "INSERT INTO orders VALUES
					(0, $cust_id, $pro_id, '$pro_name', $price, $quantity);";

			@mysql_query($sql) or die(mysql_error());
		}
		
		//หลังย้ายข้อมูล ให้ลบข้อมูลในตารง cart ทิ้งไป
		$sql = "DELETE FROM cart
			 		WHERE sess_id = '$sid';";
		@mysql_query($sql) or die(mysql_error());
		
		//ถ้าเลือกตัวเลือกจัดเก็บข้อมูลไว้ใช้ครั้งต่อไป
		//ก็จัดเก็บไว้ในแบบคุกกี้
		if($_POST['save_cookie']) {
			$expire = time() + 12*30*24*60*60; 				//เก็บไว้ 1 ปี
			setcookie('name', $_POST['name'], $expire);
			setcookie('address', $_POST['address'], $expire);
			setcookie('phone', $_POST['phone'], $expire);
			setcookie('email', $_POST['email'], $expire);
		} 
		
		//หลังการจัดเก็บข้อมูลทั้งหมด ก็แจ้งรายละเอียดเพิ่มเติม
		//แล้วสิ้นสุดการทำงานของเพจนั้น
		echo "<html><body>";
		include("header.inc.php");
		echo "
			<center>
			<div style=\"width: 300px; font-size: 11pt; text-align: left;\">
			เราได้จัดเก็บข้อมูลการสั่งซื้อของท่านแล้ว<br />
			โดยหลังจากตรวจสอบข้อมูลการสั่งซื้อของท่านแล้ว<br />
			จะแจ้งรายละเอียดวิธีการชำระเงินอีกครั้งทางอีเมล<br />
			โดยสินค้าจะถูกจัดส่ง หลังจากเราได้รับหลักฐานการชำระเงินจากท่านแล้ว<p />
			
			ขอบพระคุณที่เลือกซื้อสินค้าจากเรา<p />
			
			<a href=\"index.php\">กลับไปที่หน้าหลัก</a>
			</div>
			</center>
			</body></html>";
			
		exit;
	}
}
//ถ้ามีการจัดเก็บข้อมูลแบบคุกกี้เอาไว้ ให้อ่านมาเก็บไว้ในตัวแปร
//เพื่อจะนำไปเติมลงในฟอร์ม ในขั้นตอนต่อไป
else if($_COOKIE) {
	$name = $_COOKIE['name'];
	$address = $_COOKIE['address'];
	$phone = $_COOKIE['phone'];
	$email = $_COOKIE['email'];	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Koko Touring Customer Info</title>
<link rel="stylesheet" href="../css/style.css" />
</head>
<?php include("header.inc.php"); ?>
<body>


<h3 align="center">ข้อมูลของผู้ซื้อสินค้า</h3>
<?php
echo "<p align=center><font color=red>$errmsg</font></p>";
?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table border="0" cellspacing="2" cellpadding="3" align="center">
    <tr>
      <td width="50" align="right">ชื่อ</td>
      <td width="300">
        <input name="name" type="text" size="40" value="<?php echo $name; ?>" />
      </td>
    </tr>
    <tr valign="top">
      <td align="right">ที่อยู่</td>
      <td>
        <textarea name="address" cols="37"><?php echo $address; ?></textarea>
      </td>
    </tr>
    <tr>
      <td align="right">โทร</td>
      <td>
        <input name="phone" type="text" size="40" value="<?php echo $phone; ?>" />
      </td>
    </tr>
    <tr>
      <td align="right">อีเมล</td>
      <td>
        <input name="email" type="text" size="40" value="<?php echo $email; ?>" />
      </td>
    </tr>    
    <tr bgcolor="white">
      <td colspan="2" align="center">* วิธีการชำระเงิน จะแจ้งให้ทราบทางอีเมล</td>
    </tr>
	    <tr bgcolor="white">
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr bgcolor="white">
      <td colspan="2" align="center">
	  <input name="button" type="button" onclick="location.href='index.php'" value="ยกเลิก" />
      <input name="Submit" type="submit" value="บันทึกข้อมูลการสั่งซื้อ" /></td>
    </tr>
    <tr bgcolor="white">
      <td colspan="2" align="center">
        <input type="checkbox" name="save_cookie" value="1" />
		เก็บข้อมูลนี้ไว้ใช้ในการสั่งซื้อครั้งต่อไป</td>
    </tr>
  </table>
</form>
<br />

<table border=1 bordercolor=#cccccc cellpadding=3 align=center style="border-collapse: collapse;">
<caption>รายการสินค้าที่สั่งซื้อ</caption>
<tr bgcolor=#ddddff>
	<th align=center width=200>สินค้า</th><th width=50>จำนวน</th>
	<th width=50>ราคา</th><th width=80>รวม</th>
</tr>
<?php
$grand_total = 0;
while($cart = mysql_fetch_array($result_cart)) {
	$sub_total = $cart['quantity'] * $cart['price'] ;

	echo "
	<tr valign=top>
		<td align=left> {$cart['pro_name']} </td>
		<td align=center> {$cart['quantity']} </td>
		<td align=center> {$cart['price']} </td>
		<td align=right> $sub_total </td>
	</tr>";
	
	$grand_total += $sub_total;
}
?>
<tr>
 	<td colspan=3 align=center>รวมทั้งหมด</td>
 	<td align=right><?php echo $grand_total; ?></td>
</tr>
</table>

<p>&nbsp;</p>
</body>
</html>