<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed.');
/**
 * Clase en la cual se daran de alta los metodos y datos
 * de las apis y todos los esquemas referentes a estas
 * partes para que los usuarios puedan visualizar toda la
 * documentacion necesaria para la implementacion del 
 * metodo de pago de pulzos, los cuales es una alternativa
 * de pago de parte de PULZOS.
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Jan 16, 2011
 * @package developers
 **/
class Developers extends MX_Controller{

    /**
     * Constructor donde se definen los valores y las
     * variables que se utilizaran de manera global
     * durante toda la clase. Se declaran librerias y demas...
     *
     * @return void
     * @author blackfoxgdl <ruben.alosno21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('passworder','cyp','apipulzos','avatar','invitacion','status','url','form','html','date','emails'));
        $this->load->model('Developer', '', TRUE);
        $this->load->library(array('session', 'user_agent', 'form_validation','email'));
    }

    /**
     * Metodo principal a donde se redireccionara para mostrar la
     * primer pantalla en la cual el usuario pueda visualizar la parte
     * de los desarrolladores donde se inicializaria la parte para
     * que conoscan la API DE pulzos
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index()
    {
        $header = $this->load->view('developers/header', '', TRUE);
        $content = $this->load->view('developers/index', '', TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo que se usara para poder mostrar los datos de la documentacion
     * en donde el usuario podra visualizar los datos de la api
     * que se utilizara para los metodos de pago con pulzos. Esta parte
     * solamente es para una breve introduccion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_documentos()
    {
        $this->load->view('developers/documentos');
    }

    /**
     * Metodo que se usa para poder mostrar los datos de los metodos que se
     * usaran para darle a conocer al usuario como se tiene que usar la clase
     * con la que se podra conectar a la plataforma de pago de pulzos, esto para que
     * los usuarios puedan pagar sus compras con pulzos. Es la parte de explicacion
     * de uso de la clase
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_metodos()
    {
        $this->load->view('developers/metodos');
    }

    /**
     * Metodo que se usa para poder mostrar los ejemplos que se tienen para que 
     * se usen estos ejemplos a favor de los usuarios como se tiene que usar la
     * clase con la que se podra conocer la forma en como se usa la clase de 
     * pulzos para poder habilitar los datos necesarios y se acepten pagos con
     * pay-pulzos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_ejemplos()
    {
        $this->load->view('developers/ejemplos');
    }
}
