<?php

use Zend\Config\Factory as ZendFactory;

/*
 * def. adresaru
 */
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', __DIR__);

/**
 * autoload
 */
require_once 'vendor/autoload.php';

/**
 * konfigurace
 */
$configFiles = array_merge(
				array(APP_DIR . '/config/config.php'), glob(APP_DIR . '/config/autoload/*.{php}', GLOB_BRACE)
);
$config = ZendFactory::fromFiles($configFiles, true);
$config->setReadOnly();

/**
 * parsovani url
 */
$url = sprintf("http://%s%s", filter_input(INPUT_SERVER, "SERVER_NAME", FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE), filter_input(INPUT_SERVER, "SCRIPT_NAME", FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE));

/**
 * GET ?wsdl
 */
$genwsdl = filter_input(INPUT_GET, 'wsdl', FILTER_SANITIZE_STRING);


if (!is_null($genwsdl)) { // wsdl
	$autodiscover = new Zend\Soap\AutoDiscover();

	$autodiscover->setOperationBodyStyle([
			'use' => 'literal',
			'namespace' => 'http://schemas.xmlsoap.org/soap/http',
	]);

	$autodiscover->setBindingStyle([
			'style' => 'document',
			'transport' => 'http://schemas.xmlsoap.org/soap/http',
	]);

	$autodiscover->setClass('Vrestihnat\SoapServer\SoapClass')
					->setUri($url);
	header('Content-Type: application/soap+xml; charset=utf-8');
	header('Content-Disposition: attachment; filename=test.wsdl');
	echo $autodiscover->toXml(); // print wsdl
	return;
}

/**
 *  primitivni zabezpeceni - basic authorizace
 */
$user = $config->get('ba_user');
$pswd = $config->get('ba_passwd');
$usr = (isset($_SERVER['PHP_AUTH_USER']) ? filter_var($_SERVER['PHP_AUTH_USER']) : null);
$paswd = (isset($_SERVER['PHP_AUTH_PW']) ? filter_var($_SERVER['PHP_AUTH_PW']) : null);
if (!(!is_null($usr) && !is_null($paswd) && $usr == $user && $paswd == $pswd)) {
	Header("WWW-Authenticate: Basic realm=\"SoapTest\"");
	Header("HTTP/1.0 401 Unauthorized");
	echo "You must login to access this service\n";
	exit;
}



//$t = time();
$soap = new Zend\Soap\Server("$url?wsdl", array('cache_wsdl' => WSDL_CACHE_NONE, 'soap_version' => SOAP_1_2, 'encoding' => 'UTF-8', 'trace' => 1, 'exceptions' => true,));
$soap->setClass(new \Zend\Soap\Server\DocumentLiteralWrapper(new Vrestihnat\SoapServer\SoapClass($config)));
$soap->handle();



