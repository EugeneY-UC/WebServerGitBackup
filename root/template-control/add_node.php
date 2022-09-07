<?php
function numberFormat($digit, $width) {
    while(strlen($digit) < $width)
      $digit = '0' . $digit;
      return $digit;
}

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

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
	$node_mode = $_POST['chargerNodeType'];
}
if(isset($_POST['power_line'])){
	$power_line = $_POST['power_line'];
}

$json = get_json();

foreach ($json->PowerLines as $pwl) {
	if($pwl->PowerLineID === $power_line){
		$power_line_name = $pwl->PowerLineName;
	}
}

$last_numder = count($json->Nodes->RegisteredNodes)-1;
$new_id = $json->Nodes->RegisteredNodes[$last_numder]->NodeID+1;

$arr = array(	"NodeID"				=>	"$new_id",
				"ChargerNodeNumber"		=>	"$chargerNodeNumber",
				"ChargerNodeAddress"	=>	"$chargerNodeAddress",
				"ChargerNodeType"		=>	"$chargerNodeType",
				"ChargerNodeStatus"		=>	"$chargerNodeStatus",
				"NodeMode"				=>	" ",
				"PowerLine"				=>	"$power_line"
			);
$json->Nodes->RegisteredNodes[] = $arr;

set_json($json);
$arr["PowerLine_name"]=$power_line_name;
 echo json_encode($arr);
?>