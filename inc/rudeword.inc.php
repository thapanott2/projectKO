<?php
function get_rudewords($str) {

	$rude_words = array("ควย", "เย็ด", "หี", "หมอย", "แตด", "เงี่ยน", "เสือก", "เี้หี้ย", "ดอกทอง", "fuck", "pussy"); 
	
	$rudes = array();
	$len = count($rude_words);
	
	for($i=0; $i<$len; $i++) {
		$r = $rude_words[$i];
		if(eregi($r, $str)) {
			array_push($rudes, $r);
		}
	}
	
	return $rudes;
	
}
?>