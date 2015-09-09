<?php
session_start();

if($_POST)  {
	$name = $_POST['name'];
	$login = $_POST['login'];
	$pswd = $_POST['pswd'];
	$pswd2 = $_POST['pswd2'];

	if(empty($name)) {
		$errmsg = "ท่านยังไม่ได้กำหนดชื่อ";
	}
	else if(!filter_var($login, FILTER_VALIDATE_EMAIL)) {
		$errmsg = "อีเมลไม่ถูกต้องตามรูปแบบ";
	}
	else if($pswd != $pswd2) {
		$errmsg = "ท่านใส่รหัสผ่านสองครั้งไม่ตรงกัน";
	}
	else if(!eregi("[a-z0-9]{4,10}", $pswd)) {
		$errmsg = "รหัสผ่านต้องประกอบด้วย a-z หรือ 0-9 จำนวน 4-10 ตัว";
	}

	if($errmsg != "") {
 		echo "<font size=5 color=red>$errmsg<p />
				 <a href=\"javascript: history.back()\">ย้อนกลับไปแก้ไข</a></font>";
	}
	else {
		include("dbconn.inc.php");
		$sql = "INSERT INTO user VALUES
					(0, '$login', '$pswd', '$name');";
		@mysql_query($sql) or die(mysql_error());

		header("Refresh: 3; url=index.php");
		echo "ข้อมูลถูกจัดเก็บแล้ว จะกลับสู่หน้าหลักใน 3 วินาที";
	}

	exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>KOKO TOUR</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />

<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="web/js/jquery.easydropdown.js"></script>
</head>
<?php
include("header.inc.php");
?>
<body>
<div class="register_account">
	<div class="wrap">
<h4 class="title">Create an Account</h4>
	<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="col_1_of_2 span_1_of_2">
				<div>Input Your Name:<input name="name" type="text" id="name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}"></div>
				<div>Input User Name:<input name="login" type="text" id="login" value="E-Mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}"></div>
				<div>Insert Password:<input name="pswd" 	type="text" id="pswd" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"></div>
				<div>Insert PassAgain:<input name="pswd2" type="text" id="pswd2" value="password again" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"></div>
				<div><input class="grey" type="submit" name="Submit" value="SUBMIT" /> </div>
	</form>
					<br /><br />	<p> 	  ชื่อและล็อกอินต้องไม่ซ้ำกับของสมาชิกท่านอื่นและกรุณาใช้อีเมลจริงของท่าน <br />เพราะทาง Web Master จะแจ้งผลการประมูลผ่านทางอีเมลล์</p>


				</div>
		</div>
</div>
</body>
</html>
