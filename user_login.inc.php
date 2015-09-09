<?php
if($_POST)  {
	$login = $_POST['login'];
	$pswd = $_POST['pswd'];

	include("dbconn.inc.php");

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
<?php
?>
<p  />
<h2 class="txt-heading3">USER LOGIN</h2>

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
        <input type="submit" name="Submit" value="Login" />
      </label></td>
    </tr>
  </table>
</form>
