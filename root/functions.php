<?php

function get_json_file_name(){
  $file_url_name = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/json_url.json');
  $name = json_decode($file_url_name);
  $url = $_SERVER['DOCUMENT_ROOT'].'/data/'.$name->URL;
  return $url;
}

function get_json(){
	$file_url_name = file_get_contents(get_json_file_name());
	$json =	json_decode($file_url_name);
	return $json;
}

function get_json_url(){
	$file_url_name = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/json_url.json');
  	$name = json_decode($file_url_name);
  	return $_SERVER['HTTP_HOST'].'/data/'.$name->URL;
}


function set_json($json){
	file_put_contents(get_json_file_name(),json_encode($json,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function search_node_to_power_line($id){
	$json = get_json();
	$node_amp_sum=0;
	$node_amp = 40;
	foreach ($json->Nodes->RegisteredNodes as $node) {
		if($node->PowerLine === $id){
			$node_amp_sum+=$node_amp;
		}
	}
	return $node_amp_sum;
}

function get_power_data($id){
	$data = array();
	$json = get_json();
	 foreach ($json->PowerLines as $pwl) {
		if($pwl->PowerLineID === $id){
			$data["MaxAmp"] = $pwl->MaxAmp;
			break;
		}
	 }
	$data["AmpNodes"] = search_node_to_power_line($id);
	return $data;
}

function del_schud_for_id($id){
	$json_g = get_json();
	$shc = $json_g->Schedule->PricingSchedule;
	

	$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

	foreach ($days as $day) {
		$i=0;
		foreach ($shc->$day->Public as $line){
			if($line->NodeID === $id){
				unset($json_g->Schedule->PricingSchedule->$day->Public[$i]);
				$json_g->Schedule->PricingSchedule->$day->Public = array_values($json_g->Schedule->PricingSchedule->$day->Public);
			}else
				$i++;
		};
		

		$i=0;
		foreach ($shc->$day->Private as $line) {
			if($line->NodeID === $id){
				unset($json_g->Schedule->PricingSchedule->$day->Private[$i]);
				$json_g->Schedule->PricingSchedule->$day->Private = array_values($json_g->Schedule->PricingSchedule->$day->Private);
			}else
				$i++;
		};
		

		$i=0;
		foreach ($shc->$day->Mixed as $line) {
			if($line->PublicNode->NodeID === $id){
				unset($json_g->Schedule->PricingSchedule->$day->Mixed[$i]);
				$json_g->Schedule->PricingSchedule->$day->Mixed 	= array_values($json_g->Schedule->PricingSchedule->$day->Mixed);	
			}else
				$i++;
		};
	}
	set_json($json_g);
}

?>