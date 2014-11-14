<?php
/**
 * Módulo encargado de las interacciones con otras redes sociales.
 *
 * Este va a ser un módulo muy extendido ya que manejará las credenciales 
 * sociales de cada usuario registrado. Por lo pronto solo inciaremos con 
 * Facebook y con Twitter. Pero después cabe la posibilidad de que abramos un 
 * poco más el scope en esto.
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 03 March, 2011
 * @package Sociales
 **/

class Sociales extends MX_Controller{
    /**
     * @ignore
     * Estructura de DB Sugerida
     * socialId: INT <primaryKey>
     * socialUidFacebook: BIGINT <facebook user number>
     * socialTokenFacebook: VARCHAR 100 <No recuerdo bien la medida>
     * socialTwitterOauth: VARCHAR 100 <tampoco recuerdo bien la medida>
     * socialTwitterOauthSecret: VARCHAR 100 <No recuerdo medida>
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
    }

    public function index()
    {
        redirect('sociales/ver');
    }

    /**
     * ver registros.
     *
     * Esto debe de recibir como parametro la clave de red social. Pero no 
     * estoy seguro todavía de donde las vamos a sacar. Yo creo habrá que 
     * meterlas en una DB con la info de linkeo? La verdad todavía no sé.
     *
     * @return void
     * @author axoloteDeAccion
     **/
	 
	 
	/**
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 **/
	public function nuevo()
    {
        //load facebooklib package path
        $this->load->add_package_path(APPPATH.'third_party/social_media/');
        $this->load->library('facebooklib');

        //Get current user and generate a link according to it's existance. 
        $user_link = $this->facebooklib->get_facebook_user();

        if($this->tweet->logged_in())
        {
            $tokens = $this->tweet->get_tokens();
            $flag = TRUE;
        }else{
            $tokens = array();
            $flag = False;
        }

        //Pass everything to the view
        $view_vars = array(
            'user_link'=>$user_link,
            'facebook'=>$this->facebooklib,
            'tokens'=>$tokens,
            'flag'=>$flag,
        );
        $this->load->view('save', $view_vars);
    }
	
	public function get_twitter_tokens()
    {
        if($this->tweet->logged_in())
        {
            redirect('usuarios/nuevo');
        }
        $this->tweet->set_callback(site_url('usuarios/nuevo'));
        $this->tweet->login();
    }
	  
}
