<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$id = $_POST['id'];
}
if(isset($_POST['chargerNodeNumber'])){
	$chargerNodeNumber = $_POST['chargerNodeNumber'];
}
if(isset($_POST['chargerNodeAddress'])){
	$chargerNodeAddress = $_POST['chargerNodeAddress'];
}
if(isset($_POST['chargerNodeType'])){
	$chargerNodeType = $_POST['chargerNodeType'];
}
if(isset($_POST['chargerNodeStatus'])){
	$chargerNodeStatus = $_POST['chargerNodeStatus'];
}
if(isset($_POST['node_mode'])){
	$node_mode = $_POST['node_mode'];
}
if(isset($_POST['power_line'])){
	$power_line = $_POST['power_line'];
}

del_schud_for_id($id);


$json = get_json();

foreach ($json->PowerLines as $pwl) {
	if($pwl->PowerLineID === $power_line){
		$power_line_name = $pwl->PowerLineName;
	}
}

foreach ($json->Nodes->RegisteredNodes as $line) {  
	if($line->NodeID == $id){
		$line->ChargerNodeNumber = $chargerNodeNumber;
		$line->ChargerNodeAddress = $chargerNodeAddress;
		$line->ChargerNodeType = $chargerNodeType;
		$line->ChargerNodeStatus = $chargerNodeStatus;
		$line->PowerLine = $power_line;
		
		$arr = array(
			"id"=>$id,
			"chargerNodeNumber"=>$chargerNodeNumber,
			"chargerNodeAddress"=>$chargerNodeAddress,
			"chargerNodeType"=>$chargerNodeType,
			"chargerNodeStatus"=>$chargerNodeStatus,
			"PowerLine"=>$power_line
		);
	}
	
}

set_json($json);
$arr["PowerLine_name"]=$power_line_name;
echo json_encode($arr);
?>