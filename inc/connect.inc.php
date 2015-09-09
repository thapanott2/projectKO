<?php

function myconnect($db="mysql") {
	$msg = "<b>MySQL Error:</b><br />";

	$conn = @mysql_connect("localhost", "root", "root");
	if(!$conn) {
		$msg .= mysql_error();
		__show_error($msg);
		return false;
	}

	$use_db = @mysql_query("USE $db;");
	if(!$use_db) {
		 $msg .= mysql_error();
		__show_error($msg);
		return false;
	}

	return $conn;
}

function __show_error($msg) {
	echo "
		<div style=\"width:500px; border:solid 1px red;background-color:#ffffcc;color:red;font-size:10pt;padding:5px;\">$msg</div>
	";
}

?>
