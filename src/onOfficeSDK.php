<?php

/**
 *
 * @url http://www.onoffice.de
 * @copyright 2016, onOffice(R) Software AG
 * @license MIT
 *
 */


namespace onOffice\SDK;

use onOffice\SDK\Cache\onOfficeSDKCache;
use onOffice\SDK\internal\ApiCall;

/**
 *
 */

class onOfficeSDK
{
	/** */
	const ACTION_ID_READ = 'urn:onoffice-de-ns:smart:2.5:smartml:action:read';

	/** */
	const ACTION_ID_CREATE = 'urn:onoffice-de-ns:smart:2.5:smartml:action:create';

	/** */
	const ACTION_ID_MODIFY = 'urn:onoffice-de-ns:smart:2.5:smartml:action:modify';

	/** */
	const ACTION_ID_GET = 'urn:onoffice-de-ns:smart:2.5:smartml:action:get';

	/** */
	const ACTION_ID_DO = 'urn:onoffice-de-ns:smart:2.5:smartml:action:do';

	/** */
	const ACTION_ID_DELETE = 'urn:onoffice-de-ns:smart:2.5:smartml:action:delete';

	/** */
	const RELATION_TYPE_BUYER = 'urn:onoffice-de-ns:smart:2.5:relationTypes:estate:address:buyer';

	/** */
	const RELATION_TYPE_TENANT = 'urn:onoffice-de-ns:smart:2.5:relationTypes:estate:address:renter';

	/** */
	const RELATION_TYPE_OWNER = 'urn:onoffice-de-ns:smart:2.5:relationTypes:estate:address:owner';

	/** */
	const MODULE_ADDRESS = 'address';

	/** */
	const MODULE_ESTATE = 'estate';

	/** */
	const MODULE_SEARCHCRITERIA = 'searchcriteria';

	/** */
	const RELATION_TYPE_CONTACT_BROKER = 'urn:onoffice-de-ns:smart:2.5:relationTypes:estate:address:contactPerson';

	/** use with caution: retrieves every contact person, not just brokers! */
	const RELATION_TYPE_CONTACT_PERSON = 'urn:onoffice-de-ns:smart:2.5:relationTypes:estate:address:contactPersonAll';

	/** Units of complex (Immobilienanlage) (complex = parent, estate = child) */
	const RELATION_TYPE_COMPLEX_ESTATE_UNITS = 'urn:onoffice-de-ns:smart:2.5:relationTypes:complex:estate:units';

	/** Owner of estate (estate = parent record, address = child record) */
	const RELATION_TYPE_ESTATE_ADDRESS_OWNER = 'urn:onoffice-de-ns:smart:2.5:relationTypes:estate:address:owner';

	/** @var ApiCall */
	private $apiCall = null;

	/**
	 * @param string $apiVersion
	 * @param string $server
	 * @param array $curlOptions
	 * @param array $cacheInstances
	 * @param ApiCall|null $apiCall
	 */
	public function __construct(
		$apiVersion = 'latest',
		$server = 'https://api.onoffice.de/api/',
		$curlOptions = [],
		array $cacheInstances = [],
		ApiCall $apiCall = null
	) {
		if (null === $apiCall) {
			$apiCall = new ApiCall();
		}
		$this->apiCall = $apiCall;
		$this->apiCall->setServer($server);
		$this->apiCall->setApiVersion($apiVersion);
		$this->apiCall->setCurlOptions($curlOptions);
		array_map(array($this->apiCall, 'addCache'), $cacheInstances);
	}

	/**
	 *
	 * @param string $actionId from constant above
	 * @param string $resourceType
	 * @param array $parameters
	 *
	 * @return int
	 *
	 */

	public function callGeneric($actionId, $resourceType, $parameters)
	{
		return $this->apiCall->callByRawData($actionId, '', '', $resourceType, $parameters);
	}


	/**
	 *
	 * @param string $actionId
	 * @param string $resourceId
	 * @param string $identifier
	 * @param string $resourceType
	 * @param array $parameters
	 * @return int
	 *
	 */

	public function call($actionId, $resourceId, $identifier, $resourceType, $parameters)
	{
		return $this->apiCall->callByRawData
			($actionId, $resourceId, $identifier, $resourceType, $parameters);
	}


	/**
	 *
	 * @param string $token
	 * @param string $secret
	 *
	 */

	public function sendRequests($token, $secret)
	{
		$this->apiCall->sendRequests($token, $secret);
	}


	/**
	 *
	 * @param int $number
	 * @return array
	 *
	 */

	public function getResponseArray($number)
	{
		return $this->apiCall->getResponse($number);
	}


	/**
	 *
	 * @param onOfficeSDKCache $pCache
	 *
	 */

	public function addCache(onOfficeSDKCache $pCache)
	{
		$this->apiCall->addCache($pCache);
	}


	/**
	 *
	 */

	public function removeCacheInstances()
	{
		$this->apiCall->removeCacheInstances();
	}


	/**
	 *
	 * @return array
	 *
	 */

	public function getErrors()
	{
		return $this->apiCall->getErrors();
	}
}
