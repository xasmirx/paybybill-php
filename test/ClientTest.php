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

	private function makeCheckCustomerResponse(PayByBill\CheckCustomerResult $Result)
	{
		$Response = new \stdClass;
		$Response->CheckCustomerResult = $Result;
		return $Response;
	}

	private function makeCheckCustomer(PayByBill\Customer $Customer)
	{
		return array(
			'user' => $this->User,
			'customer' => $Customer,
		);
	}
}
