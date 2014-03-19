<?php
require __DIR__ .'/ConcreteStrictStruct.php';

use brajox\PayByBill\StrictStruct;

class StrictStructTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException DomainException
	 */
	public function testUndeclared()
	{
		$strictStruct = new \ConcreteStrictStruct;

		$strictStruct->undeclared = "property doesn't exist";
	}

	public function testDeclared()
	{
		$strictStruct = new \ConcreteStrictStruct;

		$strictStruct->declared = "property exists";

		$this->assertTrue(true);
	}

	/**
	 * @expectedException DomainException
	 */
	public function testPassedUndeclared()
	{
		$values = array(
			'also_undeclared' => "that doesn't exist",
		);

		new \ConcreteStrictStruct($values);
	}

	public function testPassedValues()
	{
		$values = array(
			'foo' => 1337,
			'bar' => 'FooBar',
			'baz' => 3.14159265,
		);

		$strictStruct = new \ConcreteStrictStruct($values);

		foreach ($values as $key => $value) {
			$this->assertEquals($value, $strictStruct->{$key});
		}

		$this->assertNull($strictStruct->declared);
	}
}
