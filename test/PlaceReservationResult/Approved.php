<?php
namespace brajox\PayByBill\Test\PlaceReservationResult;

class Approved extends \brajox\PayByBill\PlaceReservationResult
{
	public $EndDateTime;
	public $Errors = null;
	public $InfoMessages = null;
	public $StartDateTime;
	public $Success = true;
	public $TransactionID = "01234567-89ab-cdef-0123-456789abcdef";
	public $Reservation;
	public $ReservationApproved = true;
	public $TemporaryExternalProblem = false;

	public function __construct(\brajox\PayByBill\Reservation $Reservation)
	{
		$this->Reservation = $Reservation;

		$this->EndDateTime = $this->StartDateTime = date(\DateTime::ATOM);
	}
}
