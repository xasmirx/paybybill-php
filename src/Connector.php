<?php
namespace brajox\PayByBill;

interface Connector
{
	public function call($method_name, $arguments);
}
