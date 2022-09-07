<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$id = $_POST['id'];
}
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
}
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

foreach ($json->RegisteredCustomers as $line) {  
	if($line->customerID == $id){
		$line->chargerNodeID = $chargerNodeID;
		$line->parkingSlotID = $parkingSlotID;
		$line->addressID = $addressID;
		$line->userName = $userName;
		$line->firstName = $firstName;
		$line->lastName = $lastName;
		$line->phone = $phone;
		$line->email = $email;
		$line->rfIDCard = "";
		$line->pin = $pin;
		$line->password = $password;
		$line->status = $status;
		
		$arr = array(
			"id"=>$id,
			"chargerNodeID"=>$chargerNodeID,
			"parkingSlotID"=>$parkingSlotID,
			"addressID"=>$addressID,
			"userName"=>$userName,
			"firstName"=>$firstName,
			"lastName"=>$lastName,
			"phone"=>$phone,
			"email"=>$email,
			"pin"=>$pin,
			"password"=>$password,
			"tempChargerNode"=>$tempChargerNode,
			"status"=>$status
		);
	}
	
}

set_json($json);
 echo json_encode($arr);
?>