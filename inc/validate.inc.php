<?php
function check_rude_words($str) {
	$rudes = array("xxx", "yyy", "zzz");
	$a = array();
	foreach($rudes as $r) {
		$pattern = ".*$r.*"; 
		if(eregi($pattern, $str)) {
			array_push($a, $r);
		}
	}
	return $a;
}

function is_valid_url($url) {
	 if(filter_var($url, FILTER_VALIDATE_URL)) {
   		return true;
	 }
	else {
		return false;
	}
}

function is_valid_email($email) {
	 if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
   		return true;
	 }
	else {
		return false;
	}
}

function link_in_str($str) {
	$url_pattern = "(http(s?):\/\/)([a-z0-9\-]+\.)+[a-z]{2,4}(\.[a-z]{2,4})*(\/[^ ]+)*";
	$replace_pattern = "<a href=\"\\0\">\\0</a>";
	$str = ereg_replace($url_pattern, $replace_pattern, $str);

	$email_pattern = "[a-z]([a-z0-9_\.])+([a-z0-9])+@([a-z0-9\-]+\.)+([a-z]{2,4})(\.[a-z]{2,4})*";
	$replace_pattern = "<a href=\"mailto:\\0\">\\0</a>";
	$str = ereg_replace($email_pattern, $replace_pattern, $str);
	
	return $str;
}

function valid_html_str($str) {
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	$str =  htmlspecialchars($str);
	$str = nl2br($str);
	
	return $str;
}
?>