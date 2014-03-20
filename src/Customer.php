<?php
namespace brajox\PayByBill;

class Customer extends StrictStruct
{
	/** In/Out **/
	public $Address;
	public $CountryCode;
	public $CurrencyCode;
	public $CustNo;
	public $CustomerCategory = CustomerCategory::NOT_SET;
	public $DirectPhone;
	public $DistributionBy;
	public $DistributionType;
	public $Email;
	public $Fax;
	public $FirstName;
	public $LastName;
	public $MobilePhone;
	public $Organization_PersonalNo;
	public $Phone;
	public $PostalCode;
	public $PostalPlace;
	public $SocialTitle;
	public $StatCodeAlphaNumeric;
	public $StatCodeNumeric;
	public $Title;

	/** Out **/
	public $BankAccount;
	public $CI_Address;
	public $CI_FirstName;
	public $CI_LastName;
	public $CI_Organization_PersonalNo;
	public $CI_PaymentExperience;
	public $CI_PostalCode;
	public $CI_PostalPlace;
	public $Country;
	public $CreditLimit;
	public $CurrencyDescription;
	public $CustomerBalance;
	public $CustomerBalanceBought;
	public $CustomerBalanceOverDue;
	public $DirectDebetStatus;
	public $InterestStop;
	public $InterestStopDate;
	public $InvalidOrganization_PersonalNo;
	public $LoanStop;
	public $PurchaseStop;
	public $Rating;
	public $RatingDate;
	public $ReminderStop;
	public $ReminderStopDate;
	public $AdditionalInfo;
}
