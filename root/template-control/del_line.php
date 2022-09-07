<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$line_id = $_POST['id'];
}

$json = get_json();
$i=0;
$bool = false;
foreach ($json->Nodes->RegisteredNodes as $val) {
	if($val->PowerLine === $line_id){
		$bool = true;
	}
}

if(!$bool){
	foreach ($json->PowerLines as $line) {  
		if($line->PowerLineID == $line_id){
			unset($json->PowerLines[$i]);
			break;
		}
		$i++;
	}
	$json->PowerLines = array_values($json->PowerLines);

 	set_json($json);
 	$res = array("mess" => "Delete completed", "bool"=>$bool);
	echo json_encode($res);
}else{
	$res = array("mess" => "Please untie all Nodes from this line", "bool"=>$bool);
	echo json_encode($res);
}
?>