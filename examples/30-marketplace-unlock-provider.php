<?php

include __DIR__ . '/../vendor/autoload.php';

use onOffice\SDK\onOfficeSDK;

$pSDK = new onOfficeSDK();
$pSDK->setApiVersion('latest');

$parametersReadEstate = [
	'parameterCacheId' => '',
	'isRegularCustomer' => 0,
];

$handleReadEstate = $pSDK->callGeneric(
	onOfficeSDK::ACTION_ID_DO,
	'unlockProvider',
	$parametersReadEstate
);

$pSDK->sendRequests('put the token here', 'and secret here');

var_export($pSDK->getResponseArray($handleReadEstate));