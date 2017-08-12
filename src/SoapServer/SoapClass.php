<?php

namespace Vrestihnat\SoapServer;

use Vrestihnat\SoapServer\Model\HashResponse;

/**
 * Obsluhujici trida, na zaklade ktere generuje soap server wsdl
 *
 */
class SoapClass implements ISoapClass {

	/**
	 *
	 * @var Zend\Config\Config
	 */
	private $config = null;

	/**
	 * 
	 * @param Zend\Config\Config $config
	 */
	public function __construct($config) {
		$this->config = $config;
	}

	/**
	 * Testovaci rfc, vraci aktualni datum a cas
	 * 
	 * @return string
	 */
	public function getDateTime() {
		return (new \DateTime())->format('c');
	}

	/**
	 * Testovaci rfc, vraci ukazkovy model HashResponse
	 * 
	 * @return Vrestihnat\SoapServer\Model\HashResponse
	 */
	public function getHash() {

		$salt = 'fdsfsdfewebwe'; // sul pro gen hash
		$res = new HashResponse();
		$res->hash = hash_hmac('sha256', microtime(), $salt);
		$res->createdBy = $this->config->get('createdBy');
		$res->url = $this->config->get('baseUrl');

		return $res;
	}

}
