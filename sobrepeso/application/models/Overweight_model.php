<?php

class Overweight_model extends CI_Model
{
	public function peso_volumetrico($largo, $ancho, $alto, $unidad)
	{
		if($unidad == "IN")
		{
			$largo = $this->distancia_en_cm($largo);
			$ancho = $this->distancia_en_cm($ancho);
			$alto = $this->distancia_en_cm($alto);
		}

		return ceil(($ancho * $alto * $largo) / 5000);
	}

	public function peso_en_kilogramos($valor, $unidad)
	{
		if($unidad == "LB")
		{
			$valor = $valor/2.2046;
			$unidad = "KG";
		}

		return array(
			'valor' => ceil($valor),
			'unidad' => $unidad
		);

	}

	public function distancia_en_cm($in)
	{
		return $in * 2.54;
	}
}

?>