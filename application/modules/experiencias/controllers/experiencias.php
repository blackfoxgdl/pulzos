<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed');
/**
 * Modulo para obtener la informacion que es referente a los
 * usuarios en cuanto a las experiencias de los mismos,
 * medallas y a los negocios que apadrinan
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @package Experiencias
 * @copyright August 16, 2011
 **/
class Experiencias extends MX_Controller{

    /**
     * Constructor, donde se declararan todas las librerias,
     * helpers y el modelo para obtener datos de la base de
     * datos. Ademas alguna variable qeu se necesite de tipo
     * global
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('passworder', 'cyp', 'apipulzos', 'avatar', 'invitacion', 'status', 'url', 'form', 'html', 'date'));
        $this->load->library(array('session', 'user_agent', 'form_validation', 'email'));
        $this->load->model('Experiencia', '', TRUE);
    }

    /**
     * Metodo principal que se usara para mostrar la informacion de pulzos
     * como lo es las empresas que apadrinan y las medalas o los pulzos que se
     * tienen por el momento
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $datos['padrino'] = $this->Experiencia->get_all_sponsors($id);
        $datos['contar'] = $this->Experiencia->count_all_sponsors($id);
        $this->load->view('experiencias/index', $datos);
    }
}
