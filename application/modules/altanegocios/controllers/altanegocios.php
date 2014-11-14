<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Modulo para mostrar la informacion de las empresas
 * que se acaban de dar de alta, esto para poder tener
 * un registro mas controlado y asi saber que empresas 
 * estan dadas de alta y cuales no
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, August 15 2011
 * @pachage AltaNegocios
 **/
class altaNegocios extends MX_Controller{

    /**
     * Constructor que se usa para iniciar todas
     * las variables como son los helpers, libraries,
     * la carga del modelo y si hay necesidad de una variable
     * global aqui se declara
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('passworder', 'cyp', 'apipulzos', 'avatar', 'invitacion', 'status', 'url', 'form', 'html', 'date'));
        $this->load->library(array('session', 'user_agent', 'form_validation', 'email'));
        $this->load->model('altaNegocio', '', TRUE);
    }

    /**
     * Metodo que se usa para poder visualizar el perfil del negocio que
     * se ha dado de alta, asi los usuarios podran visualizarlo
     * pero como negocio con la persona que la dio de alta
     *
     * @params int id del negocio dado de alta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $altasNegocios = $this->altaNegocio->data_company($id);
        $datos['altaN'] = $altasNegocios;
        $datos['numeroSeguidor'] = $this->altaNegocio->get_count_follower($altasNegocios->altaNegocioNegocioId);
        $usuario = $this->altaNegocio->data_name($this->session->userdata('id'));
        $datos['usuarios2'] = $usuario;
        $datos['localidades2'] = $this->altaNegocio->data_location($usuario->ciudad);
        $datos['edad'] = edad_usuario($usuario->edad);
        $datos['inboxT'] = $this->altaNegocio->inbox_total($this->session->userdata('id'), '1');
        $datos['notificaciones'] = $this->altaNegocio->get_all_notifications($this->session->userdata('id'));
        $datos['notificacion'] = $this->altaNegocio->get_notifications($this->session->userdata('id'));
        $header = $this->load->view('usuarios/header_login3', $datos, TRUE);
        $content = $this->load->view('altanegocios/index', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content,
                                                 'included_file'=>array('statics/js/usuarios/perfil.js')));
    }
}
