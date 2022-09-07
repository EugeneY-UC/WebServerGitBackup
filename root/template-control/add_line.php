<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['line_name'])){
	$PowerLineName = $_POST['line_name'];
}
if(isset($_POST['max_amp'])){
	$MaxAmp = $_POST['max_amp'];
}
$json = get_json();

$last_id = count($json->PowerLines)-1;
$new_id = $json->PowerLines[$last_id]->PowerLineID+1;

$arr = array(	"PowerLineID"	=>	"$new_id",
				"PowerLineName"	=>	"$PowerLineName",
				"MaxAmp"		=>	"$MaxAmp"
			);
$json->PowerLines[] = $arr;

set_json($json);
 echo json_encode($arr);
?>