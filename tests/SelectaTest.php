<?php
 
use DrewM\Selecta\Selecta;
 
class SelectaTest extends PHPUnit_Framework_TestCase 
{
	public function testHelloWorld()
	{
		$selecta = new Selecta;
		$this->assertTrue(is_object($selecta));
	}

}