<?php
namespace brajox\PayByBill\Test\AcceptAccountTermsAndConditionsResult;

class Incorrect extends \brajox\PayByBill\AcceptAccountTermsAndConditionsResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = false;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";

	public function __construct()
	{
		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);

		$error = new \stdClass;
		$error->Code = 0;
		$error->ErrorType = 'BusinessLogic';
		$error->ID = 10076;
		$error->Message = 'No open account terms and conditions found';

		$this->Errors = new \stdClass;
		$this->Errors->ResponseMessageBase = $error;
	}
}
