<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$id = $_POST['id'];
}
del_schud_for_id($id);
$json = get_json();
$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
foreach ($days as $day) {
	$arr = array(	
					"NodeID"	=>	"$id",
					"From"		=>	"00:00",
					"To"		=>	"23:59"
			);
	$json->Schedule->PricingSchedule->$day->Private[] = $arr;
}


set_json($json);
echo json_encode($arr);
?>