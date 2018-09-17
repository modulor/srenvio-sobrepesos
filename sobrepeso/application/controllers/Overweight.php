<?php

class Overweight extends CI_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model('Overweight_model');
		$this->load->model('Fedex_model');
	}	
	
	public function index()
	{
		// configuracion para utlizar la libreria de fedex

		$config = $this->Fedex_model->config();

		$user_credential = $this->Fedex_model->auth($config['key'], $config['password']);

		$web_authentication_detail = $this->Fedex_model->auth_detail($user_credential);

		$client_detail = $this->Fedex_model->client_detail($config['account_number'], $config['meter_number']);

		$version = $this->Fedex_model->version();

		// leer archivo json con los paquetes a analizar

		$data['json'] = json_decode(file_get_contents(base_url('json/labels.json')));		

		// analizar cada uno de los paquetes

		foreach($data['json'] as $j)
		{			
			// informacion del paquete proporcionado por el cliente
			
			$tracking_number = $j->tracking_number;
			
			$largo = $j->parcel->length;
			
			$ancho = $j->parcel->width;
			
			$alto = $j->parcel->height;
			
			$data['peso'][$tracking_number] =  ceil($j->parcel->weight);
			
			$unidad_distancia = $j->parcel->distance_unit;

			$unidad_peso = $j->parcel->mass_unit;

			$data['peso_volumetrico'][$tracking_number] = $this->Overweight_model->peso_volumetrico($largo, $ancho, $alto, $unidad_distancia);

			$data['peso_total'][$tracking_number] = ($data['peso'][$tracking_number] >= $data['peso_volumetrico'][$tracking_number]) ? $data['peso'][$tracking_number] : $data['peso_volumetrico'][$tracking_number];

			// obtener informacion del paquete por parte de fedex

			$identifier = $this->Fedex_model->identifier($tracking_number);
			
			$package_details = $this->Fedex_model->package_details($web_authentication_detail, $client_detail, $version, $identifier);			

			$data['peso_fedex'][$tracking_number] = $this->Overweight_model->peso_en_kilogramos($package_details['peso_envio_valor'], $package_details['peso_envio_unidad']);

			$data['peso_fedex_volumetrico'][$tracking_number] = $this->Overweight_model->peso_volumetrico($package_details['paquete_largo'], $package_details['paquete_ancho'], $package_details['paquete_alto'], $package_details['paquete_unidad']);

			$data['peso_fedex_total'][$tracking_number] = ($data['peso_fedex'][$tracking_number]['valor'] >= $data['peso_fedex_volumetrico'][$tracking_number]) ? $data['peso_fedex'][$tracking_number]['valor'] : $data['peso_fedex_volumetrico'][$tracking_number];			

			$data['sobrepeso'][$tracking_number] = $data['peso_fedex_total'][$tracking_number] - $data['peso_total'][$tracking_number];
		}

		$this->load->view('overweight_view', $data);		
	}	
}

?>