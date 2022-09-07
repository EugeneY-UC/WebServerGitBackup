<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$id = $_POST['id'];
}

$days=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

$json = get_json();
$nods_sch_public = array("Monday"=>array(),"Tuesday"=>array(),"Wednesday"=>array(),"Thursday"=>array(),"Friday"=>array(),"Saturday"=>array(),"Sunday"=>array());

foreach ($days as $day) {
	foreach ($json->Schedule->PricingSchedule->$day->Public as $val) {
		if($val->NodeID === $id){
			$arr = array(	
						"NodeID"	=>	$val->NodeId,
						"From"		=>	$val->From,
						"To"		=>	$val->To,
						"Price"		=>	$val->Price
				);
		array_push($nods_sch_public[$day], $arr);
		}
	}
}



echo json_encode($nods_sch_public);
?>