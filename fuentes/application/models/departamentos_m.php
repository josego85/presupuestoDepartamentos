<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class departamentos_M extends CI_Model {
    /**
     * Modelo para manejo de los utilitarios.
     * @author josego
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Recupera la cantidad de filas (reales si se uso sql_calc_found_rows) de la ultima consulta que se haya ejecutado
     * @return integer
     */
    public function get_cantidad_resultados(){
    	return $this->db->query('select FOUND_ROWS() as found_rows')->row()->found_rows;
    }

    /**
     *
     * @return boolean
     */
    public function getDepartamentos(){
        $this->db->select("d.departamento_nombre, d.departamento_longitud, d.departamento_latitude, m.monto_valor");
        $this->db->join('montos m', 'm.departamentos_departamento_id = d.departamento_id', 'left');
    	$v_consulta = $this->db->get('departamentos d');
    	return $v_consulta;
    }
}
/* End of importar_m.php */
