<?php
/**
 * Model where the section or platform inteliguia
 * can send all the results and then get data of the
 * diferent kind of sections or depending of the request
 * that make the user, once selected a QR Code
 *
 * @platformName Inteliguia
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/

class Inteliguia extends CI_Model
{

    /**
     * Function where can declare some variables or
     * anything that need to use of global form and
     * more
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method where get all the data
     * that need to show for the user can
     * watch all the data
     *
     * @params int id
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_by_id($id)
    {
        $this->db->where('idInteliguia', $id);
        $dta = $this->db->get('inteliguia');
        return $dta->row();
    }

    /**
     * Method where the platform will get all the
     * data of the users where pass the coord of the 
     * business where the user can get all the company
     *
     * @params double latitudes y longitudes
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_by_coords_subcategory($id)//$c1, $c2, $c3, $c4, $id)
    {
        /*$totales = $this->db->query('select * from negocios where (negocioLatitud between ' . $c1 . ' and ' . $c2 . ') and (negocioLongitud between ' . $c3 . ' and ' . $c4 . ') and negocioSubgiro = ' . $id);*/
        $totales = $this->db->query('select * from negocios where negocioSubgiro = ' . $id);
        return $totales->result();
    }

    /**
     * Method where the platform will get all the
     * data of the users where the pass coord of the
     * business where the user can get all the company
     *
     * @params double latitudes y longitudes
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_by_coords_category($id)//$c1, $c2, $c3, $c4, $id)
    {
        /*$totales = $this->db->query('select * from negocios where (negocioLatitud between ' . $c1 . ' and ' . $c2 . ') and (negocioLongitud between ' . $c3 . ' and ' . $c4 . ') and negocioGiro = ' . $id);*/
        $totales = $this->db->query('select * from negocios where negocioGiro = ' . $id);
        return $totales->result();
    }

    /**
     * Method where the user can check all the data of the
     * subcategory, but just the business with the 
     * value of the subcategory
     *
     * @params int id
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_business_by_subcategory($id)
    {
        $this->db->where('negocioSubgiro', $id);
        $datos = $this->db->get('negocios');
        return $datos->result();
    }

    /**
     * Method where the user can check all the data of the 
     * categories where the user can check all the divisions
     * of the categories, where the platform will show all the
     * sections or subcategories
     *
     * @params int id
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_business_by_category($id)
    {
        $this->db->where('idGiro', $id);
        $datos = $this->db->get('subcategorias');
        return $datos->result();
    }

    /**
     * Method where the user can check specific data
     * of the restaurant, depending where the user
     * click or the option that the user can select
     * in the list
     *
     * @params int id 
     * @return mixed array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_just_business($id)
    {
        $this->db->where('negocioSubgiro', $id);
        $datos = $this->db->get('negocios');
        return $datos->result();
    }
	/**
     * metodo que se usa para mostrar los datos
     * del negocio segun su id
     *
     * @params int id 
     * @return mixed array
     * @author jalomo <jalomo@hotmail.es>
     **/
	public function get_negocios($id)
    {
        $this->db->where('negocioId', $id);
        $datos = $this->db->get('negocios');
        return $datos->row();
    }
    
    /**/
    public function get_name_negocio($id){
        $this->db->where('negocioId', $id);
        $datos = $this->db->get('negocios');
        return $datos->row();
    }
    /**/
    public function get_name_subCatego($id){
    $this->db->where('id', $id);
    $datos = $this->db->get('subcategorias');
    return $datos->row();
    }
}
