<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST["pin"])){
	$pin = $_POST["pin"];
}

if(isset($_POST["id"])){
	$id = $_POST["id"];
}


$json = get_json();
$resp = "success";
foreach ($json->RegisteredCustomers as $customer) {
	if(($customer->pin === $pin) && ($customer->customerID !== $id )){
			$resp = "unsuccess";
	}	
}

echo $resp;
?>