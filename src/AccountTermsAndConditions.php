<?php
namespace brajox\PayByBill;

class AccountTermsAndConditions extends StrictStruct
{
	public $AcceptID;
	public $RequireCustomerConfirmation;
	public $TermsAndConditions;

	public function getID()
	{
		return $this->AcceptID;
	}

	public function getHTML()
	{
		return $this->TermsAndConditions;
	}
}
