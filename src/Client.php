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

	public function checkCustomer(Customer $Customer)
	{
		$ret = $this->call('CheckCustomer', array(
			'customer' => $Customer,
		))->CheckCustomerResult;

		return ClassCaster::Cast(
			$this->doClassCasting($ret),
			'CheckCustomerResult'
		);
	}

	public function placeReservation(Reservation $Reservation)
	{
		$ret = $this->call('PlaceReservation', array(
			'reservation' => $Reservation,
		))->PlaceReservationResult;

		return ClassCaster::Cast(
			$this->doClassCasting($ret),
			'PlaceReservationResult'
		);
	}

	private function doClassCasting($response)
	{
		$classes = array('Customer', 'Reservation');

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
