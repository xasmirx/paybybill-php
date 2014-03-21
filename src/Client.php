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

	private function doClassCasting($response)
	{
		$classes = array('Customer');

		foreach ($classes as $class) {
			if (isset($response->{$class})) {
				$response->{$class} = ClassCaster::Cast($response->{$class}, $class);
			}
		}

		return $response;
	}

	private function call($method_name, array $arguments)
	{
		$arguments['user'] = $this->User;

		return $this->Connector->call($method_name, $arguments);
	}
}
