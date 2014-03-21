<?php
namespace brajox\PayByBill\Test\CheckCustomerResult;

class Found extends \brajox\PayByBill\CheckCustomerResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = true;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $Customer;
	public $TemporaryExternalProblem = false;

	public function __construct(\brajox\PayByBill\Customer $Customer)
	{
		$this->Customer = $Customer;

		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);
	}
}
