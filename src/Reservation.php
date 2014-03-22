<?php
namespace brajox\PayByBill;

class Reservation extends StrictStruct
{
	/** In/Out **/
	public $AccountOfferType = 'NoAccountOffer';
	public $Amount;
	public $CurrencyCode;
	public $CustomerNo;
	public $OrderNo;

	/** Out **/
	public $ReservationID;
}
