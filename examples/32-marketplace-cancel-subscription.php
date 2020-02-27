<?php

include __DIR__ . '/../vendor/autoload.php';

use onOffice\SDK\onOfficeSDK;

$pSDK = new onOfficeSDK();
$pSDK->setApiVersion('latest');

$parametersReadEstate = [
	'aboid' =>  '5',
	'cancelationDate' => '2019-10-05'
];

$handleReadEstate = $pSDK->callGeneric(
	onOfficeSDK::ACTION_ID_DO,
	'marketplaceCancelAbo',
	$parametersReadEstate
);

$pSDK->sendRequests('put the token here', 'and secret here');

var_export($pSDK->getResponseArray($handleReadEstate));