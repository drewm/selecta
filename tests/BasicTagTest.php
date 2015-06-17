<?php
 
use DrewM\Selecta\Selecta;
 
class BasicTagTest extends PHPUnit_Framework_TestCase 
{
	public function testSimpleTag()
	{
		$result = Selecta::build('div');
		$this->assertEquals('<div></div>', $result);
	}

	public function testSimpleTagWithContent()
	{
		$result = Selecta::build('div', 'Hello');
		$this->assertEquals('<div>Hello</div>', $result);
	}

}