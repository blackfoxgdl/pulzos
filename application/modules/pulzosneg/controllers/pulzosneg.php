<?php if(! defined('BASEPATH')) exit('No direct Script Allowed Access.');
/**
 * Controlador de los pulzos del negocio para 
 * que puedan agregar las ofertas que veran en sus perfiles en
 * la barra lateral el usuario, en la cual podra consultarla
 * y si le interesa podra hacer invitaciones a sus amigos
 * para poder aprovechar la misma.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 30 April, 2011
 * @package Pulzos de Negocios
 **/
class Pulzosneg extends MX_Controller
{
    /**
     * Constructor donde se declaran todos los
     * helpers y las librerias que se usaran
     * en el modulo o en el paquete de
     * los pulzos de los negocios.
     * Asi tambien se declara el modelo
     * que se usara
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pulzoneg','',TRUE);
        $this->load->helper(array('url', 'form', 'html', 'avatar'));
        $this->load->library(array('session', 'user_agent'));
    }

    /**
     * Metodo inicial que cargara al llamar la
     * funcion ver, esto en caso de que exista un registro y 
     * solo se llame al puro nombre del paquete
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        redirect('pulzosneg/ver/' . $id);
    }

    /**
     * Metodo que crea el nuevo pulzo u oferta
     * que se utilizara para que la empresa o el
     * negocio promocione sus servicio
     *
     * @params int id de usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function crear($id)
    {
        //obtener pulzo desde el muro
        $post = $this->input->post('Pulzos');
        if($post)
        {
            //preparar datos para insercion
            $post['pulzosnegNegocioId'] = $id;
            $post['pulzosnegFechaCreacion'] = time();

            //realizar insercion
            $this->pulzoneg->save($post);
            redirect('pulzosneg/ver/' . $id);
        }

        //cargar vista por default cuando no hay informacion a procesar o mostrar
        $content = $this->load->view('crear', array('pulzosnegNegocioId'=>$id), TRUE);
        $this->load->view('main/template', array('content'=>$content));
    }

    /**
     * Metodo para poder ver todos los pulzos que ha realizado
     * la empresa o negocio promocionando sus servicio, esto
     * en caso de que exista. Este Metodo tambien es llamado
     * por el metodo index.
     *
     * @params int id de usuario NO ES REQUERIDO
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id = null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        //obtener los pulzos que pertenecen a este negocio
        $negocios = $this->pulzoneg->get_bussines_data($id);
        $pulzos['negocios'] = $negocios;
        $pulzos['pulzosNeg'] = $this->pulzoneg->get('pulzosnegNegocioId = ' . $id);
        $pulzos['pais'] = $this->pulzoneg->get_location($negocios->negocioPais, 'pais');
        $pulzos['ciudad'] = $this->pulzoneg->get_location($negocios->negocioCiudad, 'ciudad');
        $pulzos['giro'] = $this->pulzoneg->get_location($negocios->negocioGiro, 'giro');
        $header = $this->load->view('negocios/header_login', '', TRUE);
        $content = $this->load->view('pulzosneg/ver', $pulzos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo que borra el pulzos de la empresa
     * o negocio en caso de que se quiera modificar
     * la oferta o el negocio
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $this->pulzoneg->delete($id);
        redirect($this->agent->referrer());
    }

    /**
     * Se visualiza un pulzo especifico, en el cual solo se vera
     * que ofrecen, la foto de la empresa, el nombre, y tambine los
     * enlaces para poder postear o realizar la invitacion.
     *
     * @params int id del pulzo
     * @params int id del usuario
     *
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_pulzo($id, $idU)
    {
        $negocios = $this->pulzoneg->get_pulzo_negocio($id);
        $datos['pulzos'] = $negocios;
        $datos['pais'] = $this->pulzoneg->get_location($negocios->negocioPais, 'pais');
        $datos['ciudad'] = $this->pulzoneg->get_location($negocios->negocioCiudad, 'ciudad');
        $datos['giro'] = $this->pulzoneg->get_location($negocios->negocioGiro, 'giro');
        $header = $this->load->view('negocios/header_login', '', TRUE);
        $content = $this->load->view('pulzosneg/ver_pulzo', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }
}
