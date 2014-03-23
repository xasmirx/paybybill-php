<?php
namespace brajox\PayByBill;

class Invoice extends StrictStruct
{
	/** Unknown **/
	public $AccountInfo;
	public $AdditionalInfo;
	public $MerchantID;

	/** In/Out **/
	public $Amount;
	public $CashDiscountDaysToDueDate;
	public $CashDiscountDueDate;
	public $CashDiscountPercent;
	public $CashDiscountTerm;
	public $CrossedInvoiceNo;
	public $CurrencyAmount;
	public $CurrencyCode;
	public $CustNo;
	public $DeliveryAddress;
	public $DeliveryCity;
	public $DeliveryCountry;
	public $DeliveryPostCode;
	public $DiscountProfileNo;
	public $DueDate;
	public $ExchangeRate;
	public $InvoiceDate;
	public $InvoiceLines;
	public $InvoiceNo;
	public $InvoiceProfileNo;
	public $KID;
	public $NetAmount;
	public $Note;
	public $OrderNo;
	public $OurRef;
	public $StatcodeAlphaNum;
	public $StatcodeNum;
	public $VATAmount;
	public $YourRef;

	/** Out **/
	public $AccountingMonth;
	public $AccountingYear;
	public $Balance;
	public $BuyCancelledDate;
	public $BuyDate;
	public $BuyStop;
	public $CashDiscountBalance;
	public $CashDiscountDescription;
	public $CashDiscountUsed;
	public $DirectDebetBankAccountNo;
	public $DirectDebetBankID;
	public $Ins;
	public $InterestStop;
	public $InterestStopDate;
	public $IsBought;
	public $IsInterestNote;
	public $LastEvent;
	public $NextEvent;
	public $ProductionStop;
	public $ReminderStop;
	public $ReminderStopDate;
	public $SentToDebtCollection;
}
