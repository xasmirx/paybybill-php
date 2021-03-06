<?php
namespace brajox\PayByBill;

class AcceptAccountTermsAndConditionsResult extends StrictStruct
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages;
	public $StartDateTime;
	public $Success;
	public $TransactionID;

	public function success()
	{
		return $this->Success;
	}
}
