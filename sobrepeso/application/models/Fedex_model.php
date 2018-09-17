<?php

use FedEx\TrackService,
    FedEx\TrackService\ComplexType,
    FedEx\TrackService\SimpleType;

class Fedex_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		require_once APPPATH.'/libraries/fedex.php';	
	}

	public function config()
	{
		return array(
			'key' => 'VDcptYMyyET3QZGL',
			'password' => '3sET3ECzhTLcVGltPcpR5sKpv',
			'account_number' => '510087429',
			'meter_number' => '118729277'
		);
	}

	public function auth($key, $pwd)
	{
		$user_credential = new ComplexType\WebAuthenticationCredential();
		$user_credential->setKey($key)
						->setPassword($pwd);

       return $user_credential;
	}

	public function auth_detail($user_credential)
	{
		$web_authentication_detail = new ComplexType\WebAuthenticationDetail();
		$web_authentication_detail->setUserCredential($user_credential);

		return $web_authentication_detail;
	}

	public function client_detail($account_number, $meter_number)
	{
		$client_detail = new ComplexType\ClientDetail();
		$client_detail->setAccountNumber($account_number)
					  ->setMeterNumber($meter_number);

		return $client_detail;
	}

	public function version()
	{
		$version = new ComplexType\VersionId();
		$version->setMajor(5)
		        ->setIntermediate(0)
		        ->setMinor(0)
		        ->setServiceId('trck');

		return $version;
	}

	public function identifier($tracking_number)
	{
		$identifier = new ComplexType\TrackPackageIdentifier();
		$identifier->setType(SimpleType\TrackIdentifierType::_TRACKING_NUMBER_OR_DOORTAG)
		           ->setValue($tracking_number);

		return $identifier;
	}

	public function package_details($web_authentication_detail, $client_detail, $version, $identifier)
	{
		$request = new ComplexType\TrackRequest();
		$request->setWebAuthenticationDetail($web_authentication_detail)
		        ->setClientDetail($client_detail)
		        ->setVersion($version)
		        ->setPackageIdentifier($identifier);

		$response = (new TrackService\Request())->getTrackReply($request);

		$res = (array) $response;

		$resultados = array(
			'paquete_peso_unidad' => $res['values']['TrackDetails'][0]->values['PackageWeight']->values['Units'],
			'paquete_peso_valor' => ceil($res['values']['TrackDetails'][0]->values['PackageWeight']->values['Value']),
			'paquete_largo' => $res['values']['TrackDetails'][0]->values['PackageDimensions']->values['Length'],
			'paquete_ancho' => $res['values']['TrackDetails'][0]->values['PackageDimensions']->values['Width'],
			'paquete_alto' => $res['values']['TrackDetails'][0]->values['PackageDimensions']->values['Height'],
			'paquete_unidad' => $res['values']['TrackDetails'][0]->values['PackageDimensions']->values['Units'],
			'peso_envio_unidad' => $res['values']['TrackDetails'][0]->values['ShipmentWeight']->values['Units'],
			'peso_envio_valor' => ceil($res['values']['TrackDetails'][0]->values['ShipmentWeight']->values['Value'])
		);

		return $resultados;
	}

	// $this->config
// $this->auth
// $this->auth_detail
// $this->client_detail
// $this->version
// $this->identifier
// $this->package_details
}

?>