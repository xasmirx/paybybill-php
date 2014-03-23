<?php
namespace brajox\PayByBill;

class InvoiceLine extends StrictStruct
{
	/** In/Out **/
	public $GrossAmount;
	public $ItemDescription;
	public $ItemID;
	public $LeftText;
	public $LineNumber;
	public $NetAmount;
	public $Quantity;
	public $RightText;
	public $TaxAmount;
	public $TaxPercent;
	public $UnitCode;
	public $UnitPrice;
}
