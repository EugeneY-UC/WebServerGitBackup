<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['public_data'])){
	$public_data = $_POST['public_data'];
}

if(isset($_POST['mixed_data'])){
	$mixed_data = $_POST['mixed_data'];
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

$id_n = $public_data[0][id_node];
foreach ($mixed_data as $val) {
	$day = $val["day"];
	$arr_mix = array(
					"PublicNode"=>array(
										"NodeID"=>$id_n,
										"From"=>$val["public_from"],
										"To"=>$val["public_to"]
									),
					"PrivateNode"=>array(
										"NodeID"=>$id_n,
										"From"=>$val["private_from"],
										"To"=>$val["private_to"]
									)
	);
	$json->Schedule->PricingSchedule->$day->Mixed[] = $arr_mix;
}


set_json($json);
echo json_encode($mixed_data);
?>