<?php
/**
 * Mapas de Google y el manejo de la información de estos
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 29 March, 2011
 * @package Mapas
 **/

class Mapas extends MX_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url', 'apipulzos'));
        $this->load->library(array('session', 'user_agent'));
        $this->load->model('mapa', '', true);
    }

    /**
     * Nada en realidad. Solo probar el google API
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index()
    {
        redirect('mapas/ver');
    }

    /**
     * Mostrar mapas
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver()
    {
        $this->load->view('mapas/view');
    }

    public function empresa($nombre_empresa=null)
    {
        $header = $this->load->view('usuarios/header_login', '', true);
        $content = $this->load->view('mapas/empresa', array('nombre_empresa'=>$nombre_empresa), true);
        $this->load->view('main/template', array('header'=>$header, 'content'=>$content));
    }

    public function pulzar($id_pulzera)
    {
        $this->mapa->save();
        return json_encode('fuckoff');
    }

    public function ajax()
    {
        $num_rows = $this->mapa->get();
        echo json_encode($num_rows);
    }

    /**
     * prueba de envios de correos
     **/
    public function sendmail()
    {
      
    }

    /**
     **/
    public function prueba_dos()
    {
        
        echo '<html>ok</html>';
        $array = array('hola'=>'ok');
        echo json_encode($array);
        print_r($array);
        die();
    }
}
