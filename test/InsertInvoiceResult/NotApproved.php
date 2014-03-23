<?php
namespace brajox\PayByBill\Test\InsertInvoiceResult;

class NotApproved extends \brajox\PayByBill\InsertInvoiceResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = false;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $Customer = null;
	public $Invoice = null;
	public $PurchaseStatus = null;

	public function __construct()
	{
		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);

		$error = new \stdClass;
		$error->Code = 0;
		$error->ErrorType = 'BusinessLogic';
		$error->ID = 10031;
		$error->Message = 'Invoice not purchable';

		$this->Errors = new \stdClass;
		$this->Errors->ResponseMessageBase = $error;
	}
}
