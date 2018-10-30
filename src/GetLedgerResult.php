<?php
namespace brajox\PayByBill;

class GetLedgerResult extends StrictStruct
{
	public $InvoiceNo;
	public $EndDateTime;
	public $Errors;
	public $InfoMessages;
	public $StartDateTime;
	public $Success;
	public $TransactionID;
	public $Ledger;
}
