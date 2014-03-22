<?php
namespace brajox\PayByBill\Test\PlaceReservationResult;

class NotApproved extends \brajox\PayByBill\PlaceReservationResult
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = false;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $Reservation;
	public $ReservationApproved = false;
	public $TemporaryExternalProblem = false;

	public function __construct()
	{
		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);

		$error = new \stdClass;
		$error->Code = 0;
		$error->ErrorType = 'BusinessLogic';
		$error->ID = 10036;
		$error->Message = 'Reservation is not approved';

		$this->Errors = new \stdClass;
		$this->Errors->ResponseMessageBase = $error;
	}
}
