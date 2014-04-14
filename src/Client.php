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

	public function cancelReservation($CustomerNo, $OrderNo = null)
	{
		$ret = $this->call('CancelReservation', array(
			'cancelReservation' => array(
				'CustomerNo' => $CustomerNo,
				'OrderNo' => $OrderNo,
			),
		))->CancelReservationResult;

		return ClassCaster::Cast($ret, 'CancelReservationResult');
	}

	public function insertInvoice(Invoice $Invoice)
	{
		$ret = $this->call('InsertInvoice', array(
			'invoice' => $Invoice,
		))->InsertInvoiceResult;

		return ClassCaster::Cast(
			$this->doClassCasting($ret),
			'InsertInvoiceResult'
		);
	}

	public function getAccountTermsAndConditions($CustomerNo)
	{
		$ret = $this->call('GetAccountTermsAndConditions', array(
			'accountTermsAndConditionsRequest' => array(
				'CustomerNo' => $CustomerNo,
			),
		))->GetAccountTermsAndConditionsResult;

		return ClassCaster::Cast(
			$this->doClassCasting($ret),
			'GetAccountTermsAndConditionsResult'
		);
	}

	public function acceptAccountTermsAndConditions($CustomerNo, $AcceptID)
	{
		$ret = $this->call('AcceptAccountTermsAndConditions', array(
			'accountTermsAndConditionsRequest' => array(
				'CustomerNo' => $CustomerNo,
				'AcceptID' => $AcceptID,
			),
		))->AcceptAccountTermsAndConditionsResult;

		return ClassCaster::cast($ret, 'AcceptAccountTermsAndConditionsResult');
	}

	private function doClassCasting($response)
	{
		$classes = array('Customer', 'Reservation', 'Invoice', 'AccountTermsAndConditions');

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
