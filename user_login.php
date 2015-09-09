<?php
session_start();
include("dbconn.inc.php");

if(session_id() == "" ){
        session_start();
    }
if($_POST)  {
	$login = $_POST['login'];
	$pswd = $_POST['pswd'];



	$sql = "SELECT * FROM user WHERE login = '$login' AND password = '$pswd';";
	$result = mysql_query($sql);

	
	if(mysql_num_rows($result) != 1) {
		echo "<font size=5 color=red> Login not Correct <p />
				 <a href=\"javascript: history.back()\"> Back </a></font>";
	}
	else {
		$_SESSION['user_name'] = mysql_result($result, 0, "user_name");
		$_SESSION['user_id'] =  mysql_result($result, 0, "user_id");

	 	header("Refresh: 3; url=index.php");
	 	echo "Welcome to KOKO Chiangmai Touring ";
	}

	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<link rel="stylesheet" href="/css/style.css"  />
</head>
<body>
<?php
?>
<p  />
<h3 align="center">USER LOGIN</h3>

<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table border="0" cellspacing="3" cellpadding="0" align="center">
    <tr>
      <td><strong>USER</strong>:</td>
      <td><label>
        <input name="login" type="text" id="login" />
      </label></td>
    </tr>
    <tr>
      <td><strong>PASS:</strong></td>
      <td><label>
        <input name="pswd" type="password" id="pswd" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="เข้าสู่ระบบ" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
