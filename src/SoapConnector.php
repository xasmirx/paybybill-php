<?php
namespace brajox\PayByBill;

class SoapConnector implements Connector
{
	private $SoapClient;

	public function __construct(\SoapClient $SoapClient)
	{
		$this->SoapClient = $SoapClient;
	}

	public function call($method_name, $arguments)
	{
		return $this->SoapClient->{$method_name}($arguments);
	}
}
