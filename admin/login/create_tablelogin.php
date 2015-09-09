<?php
@mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("store");

$sql = "CREATE TABLE user(
				user_id  INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				login VARCHAR(100) UNIQUE,
				password VARCHAR(20),
				user_name VARCHAR(50) UNIQUE);";
				
@mysql_query($sql) or die(mysql_error());			
?>