PayByBill
=========

A PHP library to communicate with [PayByBill](www.paybybill.com)'s web service API.

Example
-------

```php
<?php

use brajox\PayByBill;

// Set up
$SoapClient = new SoapClient(
	'https://clienttesthorizon.gothiagroup.com/AFSServices/AFSService.svc?wsdl'
);
$User = new PayByBill\User([
	'Username' => 'FooBar',
	'Password' => 'secretpass123',
	'ClientID' => 1234,
]);
$PayByBill = new PayByBill\Client(
	new PayByBill\SoapConnector($SoapClient),
	$User
);

// Check customer
$Customer = new PayByBill\Customer;
$Customer->Organization_PersonalNo = '5108143333';

$CheckedCustomer = $PayByBill->checkCustomer($Customer);
if ( ! $CheckedCustomer->wasFound()) {
	die('Customer not found.');
}

// Update $Customer with retrieved customer information
$Customer = $CheckedCustomer->Customer;

// Place reservation
$Reservation = new PayByBill\Reservation([
	'Amount' => 200,
	'CurrencyCode' => 'SEK',
	'OrderNo' => 2345,
	'CustomerNo' => $Customer->CustNo,
]);
$PlacedReservation = $PayByBill->placeReservation($Reservation);

if ( ! $PlacedReservation->wasApproved()) {
	die('Could not approve reservation.');
}

// Insert invoice
$Invoice = new PayByBill\Invoice([
	'Amount' => 200,
	'CustNo' => $Customer->CustNo,
	'OrderNo' => 2345,
	'InvoiceLines' => array(
		new PayByBill\InvoiceLine([
			'ItemID' => 1001,
			'ItemDescription' => 'Example Code',
			'GrossAmount' => 200,
			'NetAmount' => 160,
			'UnitPrice' => 80,
			'TaxAmount' => 20,
			'TaxPercent' => 25,
			'Quantity' => 2,
		]),
	),
]);
$InsertedInvoice = $PayByBill->insertInvoice($Invoice);

if ( ! $PlacedReservation->wasApproved()) {
	die('Could not approve invoice.');
}

echo "Request for monies has been sent!";
```
