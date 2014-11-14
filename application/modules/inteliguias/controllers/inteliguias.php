<?php if(! defined('BASEPATH')) exit('No script access allowed');
/**
 * Controller for check all the information of the inteliguia
 * where the user can scaner the QR Code and this can show some
 * list where can watch every kind of restaurants where he can
 * go.
 *
 * There are some information about diferents section where the
 * user can check depending the poster on the wall
 *
 * @platformName Inteliguias
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com> 
 **/
class Inteliguias extends MX_Controller
{

    /**
     * Method where the user can load all the view
     * where the platform can check the library,
     * helpers and model
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html','avatar'));
        $this->load->model('Inteliguia', '', TRUE);
    }

    /**
     * Method where the user will be redirect to a page of the 
     * sponsor of the poster, with that the people know the
     * website of this company
     *
     * @params int id 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function patrocinadores($id, $la1=null, $lo1=null, $la2=null, $lo2=null, $la3=null, $lo3=null, $la=null, $lo4=null)
    {
        if(isset($id))
        {
            $redirect = $this->Inteliguia->get_by_id($id);
            redirect($redirect->nombreInteliguia);
        }
        else
        {
            redirect('');
        }
    }

    /**
     * Method where the code will send once read
     * the QR Code, where the user can check a full
     * list of business
     *
     * @params int id
     * @params decimal lat
     * @params decimal long
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function subcategorias($id, $lat1 = null, $long1 = null, $lat2 = null, $long2 = null, $lat3 = null, $long3 = null, $lat4 = null, $long4 = null)
    {
        if(isset($id) && isset($lat1) && isset($long1) && isset($lat2) && isset($long2) && isset($lat3) && isset($long3) && isset($lat4) && isset($long4))
        {
            $id = $this->Inteliguia->get_by_id($id);
            $result['totales'] = $this->Inteliguia->get_by_coords_subcategory($id->idSubcategoriaInteliguia);//$lat1, $lat2, $long3, $long4, $id->idSubcategoriaInteliguia);
            $content = $this->load->view('inteliguias/results', $result, TRUE);
            $this->load->view('main/inteliguia', array('content'=>$content));

        }
        else
        {
            $resultados = $this->Inteliguia->get_by_id($id);
            $todos['totales'] = $this->Inteliguia->get_all_business_by_subcategory($resultados->idSubcategoriaInteliguia);
            $content = $this->load->view('inteliguias/results', $todos);
            $this->load->view('main/inteliguia', array('content'=>$content));
        }
    }

    /**
     * Method where the code will send once read
     * the QR Code, where the user can check a full
     * list of business
     *
     * @params int id
     * @params decimal lat
     * @params decimal long
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function categorias($id, $lat1 = null, $long1 = null, $lat2 = null, $long2 = null, $lat3 = null, $long3 = null, $lat4 = null, $long4 = null)
    {
        if(isset($id) && isset($lat1) && isset($long1) && isset($lat2) && isset($long2) && isset($lat3) && isset($long3) && isset($lat4) && isset($long4))
        {
            $resultados = $this->Inteliguia->get_by_id($id);
            $todos['results'] = $this->Inteliguia->get_all_business_by_category($resultados->idCategoriaInteliguia);
            $content = $this->load->view('inteliguias/category', $todos, TRUE);
            $this->load->view('main/inteliguia', array('content'=>$content));

            /*$id = $this->Inteliguia->get_by_id($id);
            $result['totales'] = $this->Inteliguia->get_by_coords_category($id->idCategoriaInteliguia);//$lat1, $lat2, $long3, $long4, $id->idCategoriaInteliguia);
            $content = $this->load->view('inteliguias/results', $result, TRUE);
            $this->load->view('main/inteliguia', array('content'=>$content));*/
        }
        else
        {
            $resultados = $this->Inteliguia->get_by_id($id);
            $todos['results'] = $this->Inteliguia->get_all_business_by_category($resultados->idCategoriaInteliguia);
            $content = $this->load->view('inteliguias/category', $todos, TRUE);
            $this->load->view('main/inteliguia', array('content'=>$content));
        }
    }

    /**
     * Method where the user can check the specifics
     * companies, where the user can check restaurants
     * specific where the user view all them
     *
     * @params int id
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function obtener_negocios_especificos($id)
    {
        if(isset($id))
        {
            $header=$this->Inteliguia->get_name_subCatego($id);
            $data['data'] = $this->Inteliguia->get_just_business($id);
            $content = $this->load->view('inteliguias/subresults', $data, TRUE);
            $this->load->view('main/inteliguia', array('content'=>$content, 'header'=>$header->nombre));
        }
    }

    /**
     * metodo para mostrar los datos del negocio
     *
     * @params int id
     * @return void
     * @author jalomo <jalomo@hotmail.es>
     **/
    public function obtener_negocios_personal($id){
	if(isset($id))
        {
            $head = $this->Inteliguia->get_name_negocio($id);
            $data['data'] = $this->Inteliguia->get_negocios($id);
            $content = $this->load->view('inteliguias/personal', $data, TRUE);
            $this->load->view('main/inteliguia', array('content'=>$content, 'header'=>$head->negocioNombre));
        }
	
    }

    /**
     * Method for load the finestra demo view
     *  
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function finestra()
    {
        $content = $this->load->view('inteliguias/finestra', '', TRUE);
        $header = "Inteliguia";//Finestra";
        $this->load->view('main/inteliguia', array('content'=>$content,
                                                   'header'=>$header));
    }

    /**
     * Method for load the telcel demo view
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function telcel()
    {
        $content = $this->load->view('inteliguias/telcel', '', TRUE);
        $header = "Guía de Mi Colonia";//Telcel";
        $this->load->view('main/inteliguia', array('content'=>$content,
                                                    'header'=>$header));
    }
}
