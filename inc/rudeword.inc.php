<?php
function get_rudewords($str) {

	$rude_words = array("���", "���", "��", "����", "ᵴ", "���¹", "���͡", "�������", "�͡�ͧ", "fuck", "pussy"); 
	
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