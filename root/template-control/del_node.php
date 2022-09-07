<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$line_id = $_POST['id'];
}

del_schud_for_id($line_id);

$json = get_json();
$i=0;

foreach ($json->Nodes->RegisteredNodes as $line) {  
	if($line->NodeID == $line_id){
		unset($json->Nodes->RegisteredNodes[$i]);
		break;
	}
	$i++;
}

$json->Nodes->RegisteredNodes = array_values($json->Nodes->RegisteredNodes);

$i=0;

foreach ($json->RegisteredCustomers as $line) {
	if($line->chargerNodeID === $line_id){
		$line->chargerNodeID = "";
	}
	$i++;
}

set_json($json);
echo "Delete completed";



?>