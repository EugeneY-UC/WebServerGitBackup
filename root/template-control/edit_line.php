<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$line_id = $_POST['id'];
}
if(isset($_POST['line_name'])){
	$PowerLineName = $_POST['line_name'];
}
if(isset($_POST['max_amp'])){
	$MaxAmp = $_POST['max_amp'];
}

$json = get_json();

foreach ($json->PowerLines as $line) {  
	if($line->PowerLineID == $line_id){
		$line->PowerLineName = $PowerLineName;
		$line->MaxAmp = $MaxAmp;
		$arr = array("id"=>$line_id,"PowerLineName"=>$PowerLineName,"MaxAmp"=>$MaxAmp);
	}
	
}

set_json($json);
 echo json_encode($arr);
?>