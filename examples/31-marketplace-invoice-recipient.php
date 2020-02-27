<?php

include __DIR__ . '/../vendor/autoload.php';

use onOffice\SDK\onOfficeSDK;

$pSDK = new onOfficeSDK();
$pSDK->setApiVersion('latest');

$parametersReadEstate = [
	'transactionid' => '<id of transaction>',
	'userid'=> '<id of paying customer>'
];

$handleReadEstate = $pSDK->callGeneric(
	onOfficeSDK::ACTION_ID_GET,
	'getMarketplaceInvoiceRecipient',
	$parametersReadEstate
);

$pSDK->sendRequests('put the token here', 'and secret here');

var_export($pSDK->getResponseArray($handleReadEstate));