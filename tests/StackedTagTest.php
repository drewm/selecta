<?php
 
use DrewM\Selecta\Selecta;
 
class StackedTagTest extends PHPUnit_Framework_TestCase 
{
	public function testStackedTags()
	{
		$result = Selecta::build('ul li');
		$this->assertEquals('<ul><li></li></ul>', $result);
	}

	public function testStackedTagsWithContent()
	{
		$result = Selecta::build('ul li', 'Hello');
		$this->assertEquals('<ul><li>Hello</li></ul>', $result);
	}


}