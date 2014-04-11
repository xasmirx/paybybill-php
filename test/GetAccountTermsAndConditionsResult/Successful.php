<?php
namespace brajox\PayByBill\Test\GetAccountTermsAndConditionsResult;

class Successful extends \brajox\PayByBill\GetAccountTermsAndConditionsResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = true;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $AccountTermsAndConditions;

	public function __construct()
	{
		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);

		$this->AccountTermsAndConditions = new \brajox\PayByBill\AccountTermsAndConditions([
			'AcceptID' => '01234567-89ab-cdef-0123-456789abcdef',
			'RequireCustomerConfirmation' => true,
			'TermsAndConditions' => '<div>A whole bunch of ugly HTML.</div>',
		]);
	}
}
