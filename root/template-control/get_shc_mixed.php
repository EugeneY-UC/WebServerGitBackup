<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$id = $_POST['id'];
}

$days=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

$json = get_json();
$nods_sch_day = array("Monday"=>array(),"Tuesday"=>array(),"Wednesday"=>array(),"Thursday"=>array(),"Friday"=>array(),"Saturday"=>array(),"Sunday"=>array());



foreach ($days as $day ) {
	$nods_sch_public = array();
	$nods_sch_timeline = array();
	foreach ($json->Schedule->PricingSchedule->$day->Public as $val) {
		if($val->NodeID === $id){
			$arr = array(	
						"NodeID"	=>	$val->NodeID,
						"From"		=>	$val->From,
						"To"		=>	$val->To,
						"Price"		=>	$val->Price
				);
		array_push($nods_sch_public, $arr);
		}
		
	}

	foreach ($json->Schedule->PricingSchedule->$day->Mixed as $val) {
		if($val->PublicNode->NodeID === $id)
		{
			break;
		}
		
	}

	$nods_sch_day[$day] = array("Public_items"	=>$nods_sch_public,
								 "Timline"		=>$val
								);
}



echo json_encode($nods_sch_day);
?>