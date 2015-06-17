<?php
 
use DrewM\Selecta\Selecta;
 
class IdTest extends PHPUnit_Framework_TestCase 
{
	public function testSimpleId()
	{
		$result = Selecta::build('div#foo');
		$this->assertEquals('<div id="foo"></div>', $result);
	}

	public function testIdAndClass()
	{
		$result = Selecta::build('div#foo.bar');
		$this->assertEquals('<div id="foo" class="bar"></div>', $result);
	}


}