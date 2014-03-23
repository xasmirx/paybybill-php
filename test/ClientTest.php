<?php
namespace brajox\PayByBill\Test;

use brajox\PayByBill;

class ClientTest extends \PHPUnit_Framework_TestCase
{
	public $SoapMock;
	public $SoapConnector;
	public $User;
	public $Client;

	public function setUp()
	{
		$this->SoapMock = $this->getMockFromWsdl(__DIR__. '/paybybill.wsdl', 'PayByBill');
		$this->SoapConnector = new PayByBill\SoapConnector($this->SoapMock);

		$this->User = new PayByBill\User(array(
			'Username' => 'FooBar',
			'Password' => 'secretpass1234',
			'ClientID' => 2345,
		));

		$this->Client = new PayByBill\Client($this->SoapConnector, $this->User);
	}

	public function testCustomerNotFound()
	{
		$Customer = new PayByBill\Customer;
		$Customer->Organization_PersonalNo = 4205292222;

		$CheckCustomerResponse = $this->makeCheckCustomerResponse(
			new CheckCustomerResult\NotFound
		);

		$this->SoapMock->expects($this->once())
			->method('CheckCustomer')
			->with($this->makeCheckCustomer($Customer))
			->will($this->returnValue($CheckCustomerResponse));

		$ret = $this->Client->checkCustomer($Customer);

		$this->assertInstanceOf('brajox\\PayByBill\\CheckCustomerResult', $ret);
		$this->assertFalse($ret->wasFound());
	}

	public function testCustomerFound()
	{
		$Customer = new PayByBill\Customer;
		$Customer->Organization_PersonalNo = 4203271111;

		$CheckCustomerResponse = $this->makeCheckCustomerResponse(
			new CheckCustomerResult\Found($Customer)
		);

		$this->SoapMock->expects($this->once())
			->method('CheckCustomer')
			->with($this->makeCheckCustomer($Customer))
			->will($this->returnValue($CheckCustomerResponse));

		$ret = $this->Client->checkCustomer($Customer);

		$this->assertInstanceOf('brajox\\PayByBill\\CheckCustomerResult', $ret);
		$this->assertTrue($ret->wasFound());
	}

	public function testReservationNotApproved()
	{
		$Reservation = new PayByBill\Reservation([
			'Amount'       => 3141,
			'CurrencyCode' => 'SEK',
			'OrderNo'      => 2345,
			'CustomerNo'   => 100001,
		]);

		$PlaceReservationResponse = $this->makePlaceReservationResponse(
			new PlaceReservationResult\NotApproved
		);

		$this->SoapMock->expects($this->once())
			->method('PlaceReservation')
			->with($this->makePlaceReservation($Reservation))
			->will($this->returnValue($PlaceReservationResponse));

		$ret = $this->Client->placeReservation($Reservation);

		$this->assertInstanceOf('brajox\\PayByBill\\PlaceReservationResult', $ret);
		$this->assertFalse($ret->wasApproved());
	}

	public function testReservationApproved()
	{
		$Reservation = new PayByBill\Reservation([
			'Amount'       => 1337,
			'CurrencyCode' => 'SEK',
			'OrderNo'      => 1234,
			'CustomerNo'   => 100002,
		]);

		$PlaceReservationResponse = $this->makePlaceReservationResponse(
			new PlaceReservationResult\Approved($Reservation)
		);

		$this->SoapMock->expects($this->once())
			->method('PlaceReservation')
			->with($this->makePlaceReservation($Reservation))
			->will($this->returnValue($PlaceReservationResponse));

		$ret = $this->Client->placeReservation($Reservation);

		$this->assertInstanceOf('brajox\\PayByBill\\PlaceReservationResult', $ret);
		$this->assertTrue($ret->wasApproved());
	}

	public function testInvoiceNotApproved()
	{
		$Customer = new PayByBill\Customer;
		$Customer->CustNo = 100002;

		$Invoice = new PayByBill\Invoice([
			'Amount' => 85000,
			'CustNo' => $Customer->CustNo,
			'OrderNo' => 2345,
			'InvoiceLines' => array(
				new PayByBill\InvoiceLine([
					'ItemID' => 1005,
					'ItemDescription' => 'Esoteric Scripting Language Web Framework',
					'GrossAmount' => 85000,
					'NetAmount' => 68000,
					'UnitPrice' => 68000,
					'TaxAmount' => 17000,
					'TaxPercent' => 25,
					'Quantity' => 1,
				]),
			),
		]);

		$InsertInvoiceResponse = $this->makeInsertInvoiceResponse(
			new InsertInvoiceResult\NotApproved($Invoice, $Customer)
		);

		$this->SoapMock->expects($this->once())
			->method('InsertInvoice')
			->with($this->makeInsertInvoice($Invoice))
			->will($this->returnValue($InsertInvoiceResponse));

		$ret = $this->Client->insertInvoice($Invoice);

		$this->assertInstanceOf('brajox\\PayByBill\\InsertInvoiceResult', $ret);
		$this->assertFalse($ret->wasApproved());
	}

	public function testInvoiceApproved()
	{
		$Customer = new PayByBill\Customer;
		$Customer->CustNo = 100002;

		$Invoice = new PayByBill\Invoice([
			'Amount' => 200,
			'CustNo' => $Customer->CustNo,
			'OrderNo' => 1234,
			'InvoiceLines' => array(
				new PayByBill\InvoiceLine([
					'ItemID' => 1001,
					'ItemDescription' => 'Extensive Unit Testing',
					'GrossAmount' => 200,
					'NetAmount' => 160,
					'UnitPrice' => 80,
					'TaxAmount' => 20,
					'TaxPercent' => 25,
					'Quantity' => 2,
				]),
			),
		]);

		$InsertInvoiceResponse = $this->makeInsertInvoiceResponse(
			new InsertInvoiceResult\Approved($Invoice, $Customer)
		);

		$this->SoapMock->expects($this->once())
			->method('InsertInvoice')
			->with($this->makeInsertInvoice($Invoice))
			->will($this->returnValue($InsertInvoiceResponse));

		$ret = $this->Client->insertInvoice($Invoice);

		$this->assertInstanceOf('brajox\\PayByBill\\InsertInvoiceResult', $ret);
		$this->assertTrue($ret->wasApproved());
	}

	private function makeCheckCustomerResponse(PayByBill\CheckCustomerResult $Result)
	{
		$Response = new \stdClass;
		$Response->CheckCustomerResult = $Result;
		return $Response;
	}

	private function makePlaceReservationResponse(PayByBill\PlaceReservationResult $Result)
	{
		$Response = new \stdClass;
		$Response->PlaceReservationResult = $Result;
		return $Response;
	}

	private function makeInsertInvoiceResponse(PayByBill\InsertInvoiceResult $Result)
	{
		$Response = new \stdClass;
		$Response->InsertInvoiceResult = $Result;
		return $Response;
	}

	private function makeCheckCustomer(PayByBill\Customer $Customer)
	{
		return array(
			'user' => $this->User,
			'customer' => $Customer,
		);
	}

	private function makePlaceReservation(PayByBill\Reservation $Reservation)
	{
		return array(
			'user' => $this->User,
			'reservation' => $Reservation,
		);
	}

	private function makeInsertInvoice(PayByBill\Invoice $Invoice)
	{
		return array(
			'user' => $this->User,
			'invoice' => $Invoice,
		);
	}
}
