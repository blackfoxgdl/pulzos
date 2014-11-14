<?php
/**
 * Modelo en el cual se manipularan las funciones que se
 * relacionen con el modulo de las experiencias de los
 * usuarios
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, August 16 2011
 * @package Experiencias
 **/
class Experiencia extends CI_Model{

    /**
     * Constructor donde se declara alguna 
     * variable global o algun valor deseado 
     * a usar en todas las funciones que se creen
     * en esta clase
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Metodo que se encarga de obtener los datos de los negocios
     * que has apadrinado, esto para que el usuario al momento de que
     * ingrese a la seccion donde ve sus negocios apadrinados pueda verlos
     * con informacion completa del mismo
     *
     * @params int id del usuario
     * @return mixed datos del usuario y negocio nuevo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_sponsors($id)
    {
        $resultados = $this->db->query('select * from altanegocio left join apadrinanegocio on altaNegocioId = apadrinaNegocioNegocioId where apadrinaNegocioUserId = '. $id);
        return $resultados->result();
    }

    /**
     * Metodo que se usa para contar el numero de negocios que se 
     * tienen registrados por medio del usuario para que se
     * puedan mostrar
     *
     * @params int id del usuario
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_sponsors($id)
    {
        $this->db->where('apadrinaNegocioUserId', $id);
        $total_negocios = $this->db->count_all_results('apadrinanegocio');
        return $total_negocios;
    }
}
