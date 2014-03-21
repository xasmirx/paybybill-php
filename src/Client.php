<?php
namespace brajox\PayByBill;

class Client
{
	private $Connector;
	private $User;

	public function __construct(Connector $Connector, User $User)
	{
		$this->Connector = $Connector;
		$this->User = $User;
	}

	private function call($method_name, array $arguments)
	{
		$arguments['user'] = $this->User;

		return $this->Connector->call($method_name, $arguments);
	}
}
