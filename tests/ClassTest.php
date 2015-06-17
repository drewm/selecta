<?php
 
use DrewM\Selecta\Selecta;
 
class ClassTest extends PHPUnit_Framework_TestCase 
{
	public function testSimpleClass()
	{
		$result = Selecta::build('div.foo');
		$this->assertEquals('<div class="foo"></div>', $result);
	}

	public function testDoubleClass()
	{
		$result = Selecta::build('div.foo.bar');
		$this->assertEquals('<div class="foo bar"></div>', $result);
	}


}