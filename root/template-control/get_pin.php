<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST["pin"])){
	$pin = $_POST["pin"];
}

$json = get_json();
$resp = "success";
foreach ($json->RegisteredCustomers as $customer) {
	if($customer->pin === $pin){
			$resp = "unsuccess";
	}	
}

echo $resp;
?>