<?php
namespace brajox\PayByBill;

class CheckCustomerResult extends StrictStruct
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages;
	public $StartDateTime;
	public $Success;
	public $TransactionID;
	public $Customer;
	public $TemporaryExternalProblem;

	public function wasFound()
	{
		return $this->Success && ! is_null($this->Customer);
	}
}
