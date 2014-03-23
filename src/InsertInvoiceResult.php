<?php
namespace brajox\PayByBill;

class InsertInvoiceResult extends StrictStruct
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages;
	public $StartDateTime;
	public $Success;
	public $TransactionID;
	public $Customer;
	public $Invoice;
	public $PurchaseStatus;

	public function wasApproved()
	{
		return $this->Success;
	}
}
