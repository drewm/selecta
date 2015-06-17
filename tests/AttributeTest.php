<?php
 
use DrewM\Selecta\Selecta;
 
class AttributeTest extends PHPUnit_Framework_TestCase 
{
	public function testAttributeSelector()
	{
		$result = Selecta::build('div[foo=bar]');
		$this->assertEquals('<div foo="bar"></div>', $result);
	}

	public function testAttributeSelectorNoValue()
	{
		$result = Selecta::build('div[foo]');
		$this->assertEquals('<div foo></div>', $result);
	}

	public function testDoubleAttributeSelector()
	{
		$result = Selecta::build('input[type=text][name=foo]');
		$this->assertEquals('<input type="text" name="foo">', $result);
	}

}