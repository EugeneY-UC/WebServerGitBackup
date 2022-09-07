<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['public_data'])){
	$public_data = $_POST['public_data'];
}

del_schud_for_id($public_data[0][id_node]);
$json = get_json();

foreach ($public_data as $val) {
	$day = $val["day"];
	$price = str_replace(',','.', $val[price_sch]);
	$arr = array(	
					"NodeID"	=>	"$val[id_node]",
					"From"		=>	"$val[time_fr]",
					"To"		=>	"$val[time_to]",
					"Price"		=>	"$price"
			);
	$json->Schedule->PricingSchedule->$day->Public[] = $arr;
}

set_json($json);
echo json_encode($arr);
?>