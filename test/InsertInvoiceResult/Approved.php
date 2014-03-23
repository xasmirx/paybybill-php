<?php
namespace brajox\PayByBill\Test\InsertInvoiceResult;

class Approved extends \brajox\PayByBill\InsertInvoiceResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = true;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $Customer;
	public $Invoice;
	public $PurchaseStatus = null;

	public function __construct(\brajox\PayByBill\Invoice $Invoice, \brajox\PayByBill\Customer $Customer)
	{
		$this->Invoice = $Invoice;
		$this->Customer = $Customer;

		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);
	}
}
