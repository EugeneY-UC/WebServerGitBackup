<?php

use PHPUnit\Framework\TestCase;

class RegCustomerTest extends TestCase
{
    public function testAddRegCustomer()
    {
    	$arr = array(	"chargerNodeID"		=>	"test",
						"parkingSlotID"		=>	"test",
						"addressID"			=>	"test",
						"userName"			=>	"test",
						"firstName"			=>	"test",
						"lastName"			=>	"test",
						"phone"				=>	"test",
						"email"				=>	"test",
						"pin"				=>	"test",
						"password"			=>	"test",
						"tempChargerNode"	=>	"",
						"status"			=>  "test");

    	$data = http_build_query($arr);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/add_customer.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->RegisteredCustomers)-1;

		$js_data = $json->RegisteredCustomers[$last_numder];

		if(($js_data->chargerNodeID ==  $arr["chargerNodeID"]) and ($js_data->parkingSlotID == $arr["parkingSlotID"]) and ($js_data->addressID == $arr["addressID"]) and ($js_data->userName == $arr["userName"]) and ($js_data->firstName == $arr["firstName"]) and ($js_data->lastName == $arr["lastName"]) and ($js_data->phone == $arr["phone"]) and ($js_data->email == $arr["email"]) and ($js_data->pin == $arr["pin"]) and ($js_data->password == $arr["password"]) and ($js_data->tempChargerNode == $arr["tempChargerNode"])) {
			$resp = true;
		}else{
			$resp = false;
		}
		unset($arr);
		unset($json);
		unset($js_data);
		unset($result);
		$this->assertTrue($resp);
		        
    }

    public function testEditRegCustomer(){

    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->RegisteredCustomers)-1;
		$tmp_id = $json->RegisteredCustomers[$last_numder]->customerID;

    	$arr = array(	"id" 				=>	$tmp_id,
    					"chargerNodeID"		=>	"test1",
						"parkingSlotID"		=>	"test1",
						"addressID"			=>	"test1",
						"userName"			=>	"test1",
						"firstName"			=>	"test1",
						"lastName"			=>	"test1",
						"phone"				=>	"test1",
						"email"				=>	"test1",
						"pin"				=>	"test1",
						"password"			=>	"test1",
						"tempChargerNode"	=>	"",
						"status"			=>  "test1");

    	$data = http_build_query($arr);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/edit_customer.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->RegisteredCustomers)-1;

		$js_data = $json->RegisteredCustomers[$last_numder];

		if(($js_data->chargerNodeID ==  $arr["chargerNodeID"]) and ($js_data->parkingSlotID == $arr["parkingSlotID"]) and ($js_data->addressID == $arr["addressID"]) and ($js_data->userName == $arr["userName"]) and ($js_data->firstName == $arr["firstName"]) and ($js_data->lastName == $arr["lastName"]) and ($js_data->phone == $arr["phone"]) and ($js_data->email == $arr["email"]) and ($js_data->pin == $arr["pin"]) and ($js_data->password == $arr["password"]) and ($js_data->tempChargerNode == $arr["tempChargerNode"])) {
			$resp = true;
		}else{
			$resp = false;
		}
		unset($arr);
		unset($json);
		unset($js_data);
		unset($result);
		$this->assertTrue($resp);
    }

    public function testDelRegCustomer()
    {
    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->RegisteredCustomers)-1;
		$tmp_id = $json->RegisteredCustomers[$last_numder]->customerID;

    	$arr = array("id"=> $tmp_id);

     	$data = http_build_query($arr);


		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/del_customer.php', false, $context);

    	if($result == "Delete completed"){
    		$resp = true;
    	}else{
    		$resp = false;
    	}
    	unset($arr);
		unset($json);
		unset($js_data);
		unset($result);
		$this->assertTrue($resp);
		        
    }
}
?>