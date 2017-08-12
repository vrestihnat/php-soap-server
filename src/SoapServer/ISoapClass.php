<?php

namespace Vrestihnat\SoapServer;

use Vrestihnat\SoapServer\Model\HashResponse;

interface ISoapClass {

	/**
	 * Testovaci rfc, vraci aktualni datum a cas
	 * 
	 * @return DateTime
	 */
	public function getDateTime();

	/**
	 * Testovaci rfc, vraci ukazkovy model HashResponse
	 * 
	 * @return Vrestihnat\SoapServer\Model\HashResponse
	 */
	public function getHash();
}
