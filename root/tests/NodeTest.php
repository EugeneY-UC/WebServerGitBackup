<?php

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testAddNode()
    {
    	$arr = array(	"chargerNodeNumber"		=>	"test",
						"chargerNodeAddress"	=>	"test",
						"chargerNodeType"		=>	"test",
						"chargerNodeStatus"		=>	"test",
						"node_mode"				=>	" ",
						"power_line"			=>	"test");

    	$data = http_build_query($arr);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/add_node.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->Nodes->RegisteredNodes)-1;

		$js_data = $json->Nodes->RegisteredNodes[$last_numder];


		if(($js_data->ChargerNodeNumber ==  $arr["chargerNodeNumber"]) and ($js_data->ChargerNodeAddress == $arr["chargerNodeAddress"]) and ($js_data->ChargerNodeType == $arr["chargerNodeType"]) and ($js_data->ChargerNodeStatus == $arr["chargerNodeStatus"]) and ($js_data->NodeMode == $arr["node_mode"]) and ($js_data->PowerLine == $arr["power_line"]) ) {
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

    public function testEditNode(){

    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->Nodes->RegisteredNodes)-1;
		$tmp_id = $json->Nodes->RegisteredNodes[$last_numder]->NodeID;

    	$arr = array(	"id"					=>  $tmp_id,
    					"chargerNodeNumber"		=>	"test1",
						"chargerNodeAddress"	=>	"test1",
						"chargerNodeType"		=>	"test1",
						"chargerNodeStatus"		=>	"test1",
						"node_mode"				=>	" ",
						"power_line"			=>	"test1");

     	$data = http_build_query($arr);


		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/edit_node.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->Nodes->RegisteredNodes)-1;
		$js_data = $json->Nodes->RegisteredNodes[$last_numder];

		if(($js_data->ChargerNodeNumber ==  $arr["chargerNodeNumber"]) and ($js_data->ChargerNodeAddress == $arr["chargerNodeAddress"]) and ($js_data->ChargerNodeType == $arr["chargerNodeType"]) and ($js_data->ChargerNodeStatus == $arr["chargerNodeStatus"]) and ($js_data->NodeMode == $arr["node_mode"]) and ($js_data->PowerLine == $arr["power_line"]) ) {
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

    public function testDelNode()
    {
    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->Nodes->RegisteredNodes)-1;
		$tmp_id = $json->Nodes->RegisteredNodes[$last_numder]->NodeID;

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

		$result = file_get_contents('http://localhost/template-control/del_node.php', false, $context);

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