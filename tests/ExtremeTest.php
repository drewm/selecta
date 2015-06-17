<?php
 
use DrewM\Selecta\Selecta;
 
class ExtremeTest extends PHPUnit_Framework_TestCase 
{
	public function testBigSelector()
	{
		$result = Selecta::build('ul#list.mr-list li[required] div.foo.bar input[type=radio]');
		$this->assertEquals('<ul id="list" class="mr-list"><li required><div class="foo bar"><input type="radio"></div></li></ul>', $result);
	}



}