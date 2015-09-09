<?php
session_start();
unset($_SESSION['user_id'], $_SESSION['user_name']);

header("Refresh: 3; url=index.php");
echo "Logout Compleate. <br />Thank you ";
exit;
?>