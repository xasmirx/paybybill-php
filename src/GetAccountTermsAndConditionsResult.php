<?php
namespace brajox\PayByBill;

class GetAccountTermsAndConditionsResult extends StrictStruct
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages;
	public $StartDateTime;
	public $Success;
	public $TransactionID;
	public $AccountTermsAndConditions;

	public function success()
	{
		return $this->Success;
	}

	public function getTerms()
	{
		return $this->AccountTermsAndConditions;
	}
}
