<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";


if(isset($_POST['chargerNodeID'])){
	$chargerNodeID = $_POST['chargerNodeID'];
}
if(isset($_POST['parkingSlotID'])){
	$parkingSlotID = $_POST['parkingSlotID'];
}
if(isset($_POST['addressID'])){
	$addressID = $_POST['addressID'];
}
if(isset($_POST['userName'])){
	$userName = $_POST['userName'];
};
if(isset($_POST['firstName'])){
	$firstName = $_POST['firstName'];
}
if(isset($_POST['lastName'])){
	$lastName = $_POST['lastName'];
}
if(isset($_POST['phone'])){
	$phone = $_POST['phone'];
}
if(isset($_POST['email'])){
	$email = $_POST['email'];
}
if(isset($_POST['pin'])){
	$pin = $_POST['pin'];
}
if(isset($_POST['password'])){
	$password = $_POST['password'];
}

if(isset($_POST['status'])){
	$status = $_POST['status'];
}

$json = get_json();

$last_numder = count($json->RegisteredCustomers)-1;
$new_id = $json->RegisteredCustomers[$last_numder]->customerID+1;

$arr = array(
			"customerID"		=>"$new_id",
			"chargerNodeID"		=>$chargerNodeID,
			"parkingSlotID"		=>$parkingSlotID,
			"addressID"			=>$addressID,
			"userName"			=>$userName,
			"firstName"			=>$firstName,
			"lastName"			=>$lastName,
			"phone"				=>$phone,
			"email"				=>$email,
			"rfIDCard"			=> "",
			"pin"				=>$pin,
			"password"			=>$password,
			"tempChargerNode"	=>"",
			"status"			=>$status
		);

$json->RegisteredCustomers[] = $arr;

set_json($json);
echo json_encode($arr);
?>