<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class importar_M extends CI_Model {
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
     * @param Array $p_datos
     * @return boolean
     */
    public function insertarDepartamentos($p_datos){
    	if($this->db->insert('departamentos', $p_datos)){
    		return $this->db->insert_id();
    	}
    	return false;
    }

    /**
     *
     * @param Array $p_datos
     * @return boolean
     */
    public function insertarMontos($p_datos){
    	if($this->db->insert('montos', $p_datos)){
    		return $this->db->insert_id();
    	}
    	return false;
    }
}
/* End of importar_m.php */
