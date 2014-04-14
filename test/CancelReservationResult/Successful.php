<?php
namespace brajox\PayByBill\Test\CancelReservationResult;

class Successful extends \brajox\PayByBill\CancelReservationResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = true;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";

	public function __construct()
	{
		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);
	}
}
