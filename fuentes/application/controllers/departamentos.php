<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class departamentos extends CI_Controller {

	/**
	 *
	 * @author josego
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('departamentos_m', 'departamentos');
	}

	/**
	 *
	 */
	public function index(){
	}

    public function listarDepartamentos_jsonp(){
		$r = $this->departamentos->getDepartamentos();
		$v_geojson = $this->listar_departamentos($r);
		if(isset($_GET['callback'])){
			header("Content-Type: application/json");
			echo $_GET['callback']."(".json_encode($v_geojson).")";
		}
	}


	/*
	 * Metodos Privados.
	*/
	private function listar_departamentos($p_r){
		// Marcadores en formato GeoJSON.
		$v_geojson = array(
			'type' => 'FeatureCollection',
			'features' => array()
		);

		if($p_r->num_rows() > 0){
			$v_departamentos = $p_r->result();

			foreach($v_departamentos as $departamento) {
				$v_depto = array(
					'type' => 'Feature',
					'geometry' => array(
					    'type' => 'Point',
						'coordinates' => array($departamento->departamento_longitud, $departamento->departamento_latitude)
					),
					'properties' => array(
					    'Departamento' => $departamento->departamento_nombre,
						'monto total transferido' => $departamento->monto_valor
					)
				);
				array_push($v_geojson['features'], $v_depto);
			};
		}
		return $v_geojson;
	}
}
/* End of file departamentos.php */
