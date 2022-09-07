<?php

include $_SERVER['DOCUMENT_ROOT']."/functions.php";

if(isset($_POST['id'])){
	$line_id = $_POST['id'];
}


$json = get_json();

$i=0;

foreach ($json->RegisteredCustomers as $line) {  
	if($line->customerID == $line_id){
		unset($json->RegisteredCustomers[$i]);
		break;
	}
	$i++;
}
$json->RegisteredCustomers = array_values($json->RegisteredCustomers);

set_json($json);
echo "Delete completed";



?>