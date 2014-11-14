<?php
/**
 * Apps controller. Have certain control of third party
 * access to the pulzos coined widgets
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 22 February, 2011
 * @package Apps
 **/

class Apps extends MX_Controller{

    /**
     * Load Session library
     * Load necesary model
     * Load HTML helper
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('app','', true);
        $this->load->helper(array('html', 'form', 'url'));
    }

    public function index()
    {
        redirect('apps/ver');
    }

    /**
     * Dar de alta una nueva app
     *
     * @param integer $id Id del usuario que da de alta la app
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function crear($id=null){
        // Verificar si es un form submit o hay que mostrar el formulario
        if($this->input->post('Apps'))
        {
            if(! $id){
                $id = $this->session->userdata('id');
            }

            //Crear los keys para el sistema
            $post = $this->input->post('Apps');
            $post['appApiKey'] = sha1(time().$id.$post['appNombre']);
            $post['appApiSecret'] = sha1(time().$post['appEmailSoporte'].$id);
            $post['appUsuarioId'] = $id;
            $this->app->save($post);
            redirect('apps/ver');
        }
        $header = $this->load->view('usuarios/header_login', '', true);
        $content = $this->load->view('apps/index', '', true);
        $this->load->view('main/template', 
            array('header'=>$header, 'content'=>$content));
    }

    /**
     * View any given app record. Try to show a table and if 
     * there is a set parameter to show only that users apps
     * TODO: Add logic to allow only a certain users apps to be shown
     *
     * @param integer Id of the user to check
     *
     * @return mixed data on the table
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver($id=Null)
    {
        $model = $this->app->get();
        if(! is_array($model)){
            //Due to PHP horrible ducktyping i have to do this.
            $placeholder[] = $model;
            unset($model);
            $model = $placeholder;
        }
        $content = $this->load->view('view', array('apps'=>$model), true);
        $this->load->view('main/template', array('title'=>'Pulzos', 'content'=>$content));
    }

    /**
     * Edit existing model
     *
     * @param integer Id of model to edit
     *
     * @return bool success flag
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function editar($id)
    {
        $this->form_validation->set_rules('Apps[appNombre]', 'Nombre de Aplicación', 'required');
        $this->form_validation->set_rules('Apps[appDescripcion]', 'Descripción de la App', 'required');
        $this->form_validation->set_rules('Apps[appUrl]', 'URL de la aplicación', 'required');
        $this->form_validation->set_rules('Apps[appEmailSoporte]', 'Email de Soporte Técnico', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if($this->form_validation->run()){
            $post = $this->input->post('Apps');
            $this->app->save($post, 'appId = '.$id);   
            redirect('apps/ver');
        }else{
            $model = $this->_load_model($id);
            $content = $this->load->view('edit', array('app'=>$model, 'appId'=>$id), true);
            $this->load->view('main/template', array('title'=>'Pulzos', 'content'=>$content));
        }
    }

    /**
     * Deletes the record passed as a parameter
     *
     * @param integer id of record to delete
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id)
    {
        $this->app->delete($id);
        redirect('apps/ver');
    }

/**
 * Loads an already existing model into
 * the sistem
 *
 * @param integer primary key of given row
 *
 * @return mixed results
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
    private function _load_model($id){
        return $this->app->get($id);
    }
}
