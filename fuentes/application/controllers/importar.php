<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class importar extends CI_Controller {

	/**
	 *
	 * @author josego
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('importar_m', 'importar');
	}

	/**
	 *
	 */
	public function index(){
	}

	/**
	 *
	 */
	public function csv(){
		$v_delimitador = ',';
        $v_cerca = '"';

        // Abrimos el archivo en modo lectura.
        $f = fopen('departamentos1.csv', 'r');
        if ($f) {
        	// Ler cabecalho do arquivo
        	$cabecalho = fgetcsv($f, 0, $v_delimitador, $v_cerca);

        	// Enquanto nao terminar o arquivo
        	while (!feof($f)) {
                 // Linea por archivo.
                 $v_fila = fgetcsv($f, 0, $v_delimitador, $v_cerca);

	             $v_datos1 = array(
	        		 'departamento_nombre' => $v_fila[1],
	        		 'departamento_numero' => $v_fila[0]
	        	 );
                // Insertar en la base de datos.
                $v_departamento_id = $this->importar->insertarDepartamentos($v_datos1);

				$v_datos2 = array(
					'monto_descripcion' => "Total transferencias",
					'monto_valor' => $v_fila[2],
					'departamentos_departamento_id' => $v_departamento_id,
				);
			   // Insertar en la base de datos.
			   $this->importar->insertarMontos($v_datos2);
            }
            fclose($f);
        }
	}
}
/* End of file importar.php */
