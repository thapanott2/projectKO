<?php
session_start();
$sid = session_id();

include("dbconn.inc.php");

//��Ǩ�ͺ�Թ��ҷ���١��Ҥ������Ժ���ö��
$sql = "SELECT * FROM cart  WHERE sess_id = '$sid';";
$result_cart = mysql_query($sql);
if(mysql_num_rows($result_cart) == 0) {
	die("��ҹ������͡�Թ�������ö��");
}

//���ҧ�������ҧ��������͹ �����ͨѴ�红�����㹢�鹵͹����
$name = "";
$address = "";
$phone = "";
$email = "";
$errmsg = "";

if($_POST) {
	//��Ǩ�ͺ�����١��ͧ�ͧ������
	foreach($_POST as $k => $v) {
		if(empty($v)) {
			$errmsg = "��ҹ�ѧ�����������ú";
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
	
	//�Ѵ�红������١��ҨѴ��ŧ㹵��ҧ customer
	if($errmsg == "") {
		$sql = "INSERT INTO customer VALUES
					(0, '$name', '$address', '$phone', '$email', NOW(), 'No');";
					
		@mysql_query($sql) or die(mysql_error());
		
		//��ҹ��� id �ͧ�١��ҷ����������������ش
		$cust_id = mysql_insert_id();

		//���令�͡�����¢����Ũҡ���ҧ cart ��ѧ���ҧ orders
		//������ҡ�����ҹ�����Ũҡ���ҧ cart �ҡ�͹
		$sql = "SELECT * FROM cart
					WHERE sess_id = '$sid';";
		$result = mysql_query($sql);
		
		//�Ӣ����ŷ����ҹ�Ҩҡ���ҧ cart ��Ф�� id �ͧ�١��� �����ŧ㹵��ҧ orders
		while($cart = mysql_fetch_array($result)) {
			$pro_id = $cart['pro_id'];
			$pro_name = $cart['pro_name'];
			$price = $cart['price'];
			$quantity = $cart['quantity'];
			$sql = "INSERT INTO orders VALUES
					(0, $cust_id, $pro_id, '$pro_name', $price, $quantity);";

			@mysql_query($sql) or die(mysql_error());
		}
		
		//��ѧ���¢����� ���ź������㹵�ç cart ����
		$sql = "DELETE FROM cart
			 		WHERE sess_id = '$sid';";
		@mysql_query($sql) or die(mysql_error());
		
		//������͡������͡�Ѵ�红������������駵���
		//��Ѵ������Ẻ�ء���
		if($_POST['save_cookie']) {
			$expire = time() + 12*30*24*60*60; 				//����� 1 ��
			setcookie('name', $_POST['name'], $expire);
			setcookie('address', $_POST['address'], $expire);
			setcookie('phone', $_POST['phone'], $expire);
			setcookie('email', $_POST['email'], $expire);
		} 
		
		//��ѧ��èѴ�红����ŷ����� ������������´�������
		//��������ش��÷ӧҹ�ͧྨ���
		echo "<html><body>";
		include("header.inc.php");
		echo "
			<center>
			<div style=\"width: 300px; font-size: 11pt; text-align: left;\">
			�����Ѵ�红����š����觫��ͧ͢��ҹ����<br />
			����ѧ�ҡ��Ǩ�ͺ�����š����觫��ͧ͢��ҹ����<br />
			������������´�Ըա�ê����Թ�ա���駷ҧ�����<br />
			���Թ��Ҩж١�Ѵ�� ��ѧ�ҡ������Ѻ��ѡ�ҹ��ê����Թ�ҡ��ҹ����<p />
			
			�ͺ��Фس������͡�����Թ��Ҩҡ���<p />
			
			<a href=\"index.php\">��Ѻ价��˹����ѡ</a>
			</div>
			</center>
			</body></html>";
			
		exit;
	}
}
//����ա�èѴ�红�����Ẻ�ء��������� �����ҹ�������㹵����
//���ͨй�����ŧ㹿���� 㹢�鹵͹����
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


<h3 align="center">�����Ţͧ�������Թ���</h3>
<?php
echo "<p align=center><font color=red>$errmsg</font></p>";
?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table border="0" cellspacing="2" cellpadding="3" align="center">
    <tr>
      <td width="50" align="right">����</td>
      <td width="300">
        <input name="name" type="text" size="40" value="<?php echo $name; ?>" />
      </td>
    </tr>
    <tr valign="top">
      <td align="right">�������</td>
      <td>
        <textarea name="address" cols="37"><?php echo $address; ?></textarea>
      </td>
    </tr>
    <tr>
      <td align="right">��</td>
      <td>
        <input name="phone" type="text" size="40" value="<?php echo $phone; ?>" />
      </td>
    </tr>
    <tr>
      <td align="right">�����</td>
      <td>
        <input name="email" type="text" size="40" value="<?php echo $email; ?>" />
      </td>
    </tr>    
    <tr bgcolor="white">
      <td colspan="2" align="center">* �Ըա�ê����Թ ��������Һ�ҧ�����</td>
    </tr>
	    <tr bgcolor="white">
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr bgcolor="white">
      <td colspan="2" align="center">
	  <input name="button" type="button" onclick="location.href='index.php'" value="¡��ԡ" />
      <input name="Submit" type="submit" value="�ѹ�֡�����š����觫���" /></td>
    </tr>
    <tr bgcolor="white">
      <td colspan="2" align="center">
        <input type="checkbox" name="save_cookie" value="1" />
		�红����Ź�������㹡����觫��ͤ��駵���</td>
    </tr>
  </table>
</form>
<br />

<table border=1 bordercolor=#cccccc cellpadding=3 align=center style="border-collapse: collapse;">
<caption>��¡���Թ��ҷ����觫���</caption>
<tr bgcolor=#ddddff>
	<th align=center width=200>�Թ���</th><th width=50>�ӹǹ</th>
	<th width=50>�Ҥ�</th><th width=80>���</th>
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
 	<td colspan=3 align=center>���������</td>
 	<td align=right><?php echo $grand_total; ?></td>
</tr>
</table>

<p>&nbsp;</p>
</body>
</html>