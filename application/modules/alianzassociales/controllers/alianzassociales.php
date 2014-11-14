<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed');
/**
 * Controlaldor para que el modulo de alianzas y el de resumen en la parte de 
 * los negocios, esto para no saturar la parte de negocios pues ya tienen 
 * muchos archivos y es mejor separalos para que al momento de darle el 
 * mantenimiento sea de una manera mas sencilla
 *
 * @version 1.0
 * @copyright ZavorDigital, Sep 2011, 13
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @package alianzassociales
 **/
class alianzasSociales extends MX_Controller{

    /**
     * Metodo constructor donde se pueden declarar las librerias,
     * helpers y el modelo para que se pueda usar durante toda
     * la clase
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('passworder', 'cyp', 'apipulzos', 'avatar', 'invitacion', 'status', 'url', 'form', 'html', 'date'));
        $this->load->library(array('session', 'user_agent', 'form_validation','email'));
    }

    /**
     * Metodo que se usa para mostrar la pantalla principal de datos con lo que 
     * se refiere alianzas, esto para crear lo que se refiere a las pestañas 
     * que tendra la vista y cargar la informacion dependiendo la pestaña
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $this->load->view('alianzassociales/index');
    }

    /**
     * Metodo que se encarga de cargar todos los datos
     * de la informacion del social media de la empresa, los
     * cuales seran utilizados una vez que se hagan pulzos
     * en el mismo de parte de los seguidores para la difusion
     * de la misma
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function social($id)
    {
        $this->load->view('alianzassociales/social');
    }

    /**
     * Metodo que se usa para cargar la explicacion de lo
     * que son las alianzas y asi el usuario sepa o conosca
     * como las puede usar e incluso como puede hacer una
     * alianza con algun negocio para beneficio de ambos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function explicacion_alianzas()
    {
        $this->load->view('alianzassociales/explicacion_alianzas');
    }

    /**
     * Metodo que se usa para cargar la explicacion de lo que
     * es social media en la parte de los negocios y asi el usuario
     * pueda conocer cual es la forma en como lo puede usar para
     * hacer algo viral en twitter, facebook, foursquare, etc
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function explicacion_social_media()
    {
        $this->load->view('alianzassociales/explicacion_social');
    }

    /**
     * Metodo que se usa para cargar los pasos de la explicacion
     * de lo que se tiene que hacer de parte de la empresa o negocio
     * para que el mismo sepa que proceso se tienen que llevar antes
     * de formar una alianza por completo con otro negocio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function pasos_alianzas()
    {
        $this->load->view('alianzassociales/como_funciona_alianza');
    }

    /**
     * Metodo que se usa para cargar los pasos de como funciona la
     * parte de social media y el usuario propietario del negocio
     * conosca como se deben de realizar los procesos para que esto
     * funcione correctamente
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function pasos_social()
    {
        $this->load->view('alianzassociales/como_funciona_social');
    }
}
