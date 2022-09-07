<?php

use PHPUnit\Framework\TestCase;

class OwnerTest extends TestCase
{
    public function testEditOwner(){

    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$js_data = $json->{"General Settings"}->PCPH->{"PCPH Owner"};
		$first_name = $js_data->firstName;
		$last_name = $js_data->lastName ;
		$adress = $js_data->addressID;
		$phone = $js_data->phone;
		$emailto = $js_data->email;

    	$arr = array(	"first_name" 	=>	"test1",
    					"last_name"		=>	"test1",
						"emailto"		=>	"test1",
						"country"		=>	"test1",
						"state"			=>	"test1",
						"address"		=>	"test1",
						"phone"			=>	"test1");

    	$data = http_build_query($arr);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/owner_edit.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		unset($js_data);
		$js_data = $json->{"General Settings"}->PCPH->{"PCPH Owner"};

		$addr = $arr["country"].'/'.$arr["state"].' '.$arr["address"];

		if(($js_data->firstName ==  $arr["first_name"]) and ($js_data->lastName == $arr["last_name"]) and ($js_data->addressID == $addr) and ($js_data->phone == $arr["phone"]) and ($js_data->email == $arr["emailto"])) {
			$resp = true;
		}else{
			$resp = false;
		}

		$this->assertTrue($resp);

		$json->{"General Settings"}->PCPH->{"PCPH Owner"}->firstName = $first_name;
		$json->{"General Settings"}->PCPH->{"PCPH Owner"}->lastName = $last_name;
		$json->{"General Settings"}->PCPH->{"PCPH Owner"}->addressID = $adress;
		$json->{"General Settings"}->PCPH->{"PCPH Owner"}->phone = $phone;
		$json->{"General Settings"}->PCPH->{"PCPH Owner"}->email = $emailto;

		file_put_contents('data/cashhubsetup.json',json_encode($json,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

  
}
?>