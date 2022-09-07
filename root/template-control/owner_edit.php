<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";;

if(isset($_POST['first_name'])){
	$first_name = $_POST['first_name'];
}
if(isset($_POST['last_name'])){
	$last_name = $_POST['last_name'];
}
if(isset($_POST['emailto'])){
	$emailto = $_POST['emailto'];
}
if(isset($_POST['country'])){
	$country = $_POST['country'];
}
if(isset($_POST['state'])){
	$state = $_POST['state'];
}
if(isset($_POST['address'])){
	$address = $_POST['address'];
}
if(isset($_POST['phone'])){
	$phone = $_POST['phone'];
}

$json = get_json();

$json->{"General Settings"}->PCPH->{"PCPH Owner"}->firstName = $first_name;
$json->{"General Settings"}->PCPH->{"PCPH Owner"}->lastName = $last_name;
$json->{"General Settings"}->PCPH->{"PCPH Owner"}->addressID = $country.'/'.$state.' '.$address;
$json->{"General Settings"}->PCPH->{"PCPH Owner"}->phone = $phone;
$json->{"General Settings"}->PCPH->{"PCPH Owner"}->email = $emailto;


set_json($json);

?>