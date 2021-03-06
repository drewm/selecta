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

	public function testDoubleEqualsAttributeSelector()
	{
		$result = Selecta::build('a[href=?page=1]');
		$this->assertEquals('<a href="?page=1"></a>', $result);
	}

	public function testPathWithQueryAttributeSelector()
	{
		$result = Selecta::build('a[href=/foo/bar/?page=1&sort=abc]');
		$this->assertEquals('<a href="/foo/bar/?page=1&amp;sort=abc"></a>', $result);		
	}

	public function testAttributeSelectorWithDot()
	{
		$result = Selecta::build('a[href=bar.html]');
		$this->assertEquals('<a href="bar.html"></a>', $result);
	}

	public function testAttributeSelectorWithFQDN()
	{
		$result = Selecta::build('a[href=https://secure.gaug.es/dashboard#/foo]');
		$this->assertEquals('<a href="https://secure.gaug.es/dashboard#/foo"></a>', $result);
	}

	public function testCheckedSelector()
	{
		$result = Selecta::build('input[type=checkbox]:checked');
		$this->assertEquals('<input type="checkbox" checked>', $result);
	}

	public function testDisabledSelector()
	{
		$result = Selecta::build('input[type=text]:disabled');
		$this->assertEquals('<input type="text" disabled>', $result);
	}


}