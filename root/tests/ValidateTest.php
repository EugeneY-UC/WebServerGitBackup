<?php

use PHPUnit\Framework\TestCase;

class ValidateJsonTest extends TestCase
{
    public function testValidateJson(){

    	$file = file_get_contents('data/cashhubsetup.json');
		$json = json_decode($file);
		if($json){
			$resp = true;
		}else{
			$resp = false;
		}
		$this->assertTrue($resp);
    }

  
}
?>