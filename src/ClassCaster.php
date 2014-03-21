<?php
namespace brajox\PayByBill;

class ClassCaster
{
	public static function Cast($object, $class_name)
	{
		$fqn = __NAMESPACE__ .'\\'. $class_name;

		return new $fqn((array) $object);
	}

	private function __construct() {}
}
