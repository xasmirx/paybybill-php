<?php
namespace brajox\PayByBill\Test\CheckCustomerResult;

class NotFound extends \brajox\PayByBill\CheckCustomerResult
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = false;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $Customer = null;
	public $TemporaryExternalProblem = false;

	public function __construct()
	{
		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);

		$errors = array(new \stdClass, new \stdClass);

		$errors[0]->Code = 0;
		$errors[0]->ErrorType = 'BusinessLogic';
		$errors[0]->ID = 10006;
		$errors[0]->Message = 'Customer not found in external DB';

		$errors[1]->Code = 0;
		$errors[1]->ErrorType = 'BusinessLogic';
		$errors[1]->ID = 10004;
		$errors[1]->Message = 'Customer not found: ';

		$this->Errors = new \stdClass;
		$this->Errors->ResponseMessageBase = $errors;
	}
}
