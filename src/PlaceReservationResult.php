<?php
namespace brajox\PayByBill;

class PlaceReservationResult extends StrictStruct
{
	public $EndDateTime;
	public $Errors;
	public $InfoMessages;
	public $StartDateTime;
	public $Success;
	public $TransactionID;
	public $Reservation;
	public $ReservationApproved;
	public $TemporaryExternalProblem;

	public function wasApproved()
	{
		return $this->ReservationApproved;
	}
}
