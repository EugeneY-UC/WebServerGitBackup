<?php

use PHPUnit\Framework\TestCase;

class PowerLineTest extends TestCase
{
    public function testAddPowerLine()
    {
    	$arr = array(	"line_name"		=>	"test",
						"max_amp"		=>	"test");

    	$data = http_build_query($arr);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/add_line.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->PowerLines)-1;

		$js_data = $json->PowerLines[$last_numder];

		if(($js_data->PowerLineName ==  $arr["line_name"]) and ($js_data->MaxAmp == $arr["max_amp"])) {
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

    public function testEditPowerLine(){

    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->PowerLines)-1;
		$tmp_id = $json->PowerLines[$last_numder]->PowerLineID;

    	$arr = array(	"id"					=>  $tmp_id,
    					"line_name"		=>	"test1",
						"max_amp"	=>	"test1");

     	$data = http_build_query($arr);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-Type: application/x-www-form-urlencoded',
		        'content' => $data
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/template-control/edit_line.php', false, $context);

		$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->PowerLines)-1;
		$js_data = $json->PowerLines[$last_numder];

		if(($js_data->PowerLineName ==  $arr["line_name"]) and ($js_data->MaxAmp == $arr["max_amp"])) {
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

    public function testDelPowerLine()
    {
    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		$last_numder = count($json->PowerLines)-1;
		$tmp_id = $json->PowerLines[$last_numder]->PowerLineID;

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

		$result = json_decode(file_get_contents('http://localhost/template-control/del_line.php', false, $context));

    	if($result->mess == "Delete completed"){
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