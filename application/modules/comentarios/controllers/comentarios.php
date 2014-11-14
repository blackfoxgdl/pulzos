<?php
/**
 * Adaptar el código de Rubén al API que tenemos para módulos y hacerlo un poco 
 * más standarizado. El chiste es mantener la comunicación entre todos los 
 * módulos de la misma manera. Asi no tenemos que aprendernos versiones 
 * diferentes por módulo.
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 02 March, 2011
 * @package Comentarios
 **/

class Comentarios extends MX_Controller{

    private $apiKey = '560fdebfba0c1478d8c68dea10888bfe1081ccfe';
    private $secretApiKey = '4e07e406b45402e4b9ed7163df9d1f0c7cc7513b';

    /**
     * @ignore
     * comentarioId: INT <primaryKey>
     * comentarioTexto: VARCHAR 400 <Contenido del comentario>
     * comentarioUsuarioId: INT <ID del usuario que genera>
     * comentarioAppApiKey: VARCHAR 140 <API Key de la app que recibe>
     * comentarioElementoId: INT <ID del elemento de App que recibe>
     **/
    public function __construct()
    {
        // Cargar todas las bibliotecas/modelos/helpers necesarios
        $this->load->library(array('session', 'user_agent'));
        $this->load->helper(array('url', 'html', 'form', 'avatar', 'cyp'));
        $this->load->model('comentario', '', true);
    }

    /**
     * Redirigir a view
     *
     * Por lo pronto redirigimos a view. No creo que haya otra necesidad en 
     * index antes de la presentación de los comentarios
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index()
    {
        redirect('comentarios/view');
    }

    /**
     * Ver comentarios por contenido.
     *
     * Por la inherente manera en la que funcionan los comentarios acepta 
     * parametros diferentes. El chiste es utilizar este mismo módulo para 
     * todas las cosas que se pueden comentar. Entonces el parámetro que se 
     * pasa aqui es una concatenación en el siguiente orden:
     * idContenido_idDestino para poder obtener los datos
     *
     * @param string $api api key de la app a verificar
     * @param integer $id_elemento Id del elemento a checar sus comentarios
     * @param integer id ID del contenido a checar
     * @param bool $json True si retornar json, false si no
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver($api, $id_elemento, $id=null, $json=false)
    {
        if($id)
        {
            $comentarios = $this->comentario
                ->get('comentarioAppApiKey = "'
                .$api.'" AND comentarioElementoId = '
                .$id_elemento.' AND comentarioId = '.$id);
        }else{
            $comentarios = $this->comentario
                ->get('comentarioAppApiKey = "'
                .$api.'" AND comentarioElementoId = '.$id_elemento);
        }

        if($json){
            echo json_encode($comentarios);
        }
        $idU = $this->session->userdata('id');
        $usuarios = $this->comentario->get_user_data($idU);
        $pais = $this->comentario->get_location($usuarios->pais, 'pais');
        $ciudad = $this->comentario->get_location($usuarios->ciudad, 'ciudad');
        $edad = edad_usuario($usuarios->edad);
        $header = $this->load->view('usuarios/header_login', '', true);
        $this->load->view('comentarios/view', 
            array(
                'comentarios'=>$comentarios,
                'id_elemento'=>$id_elemento,
                'api'=>$api,
                'usuario'=>$usuarios,
                'pais'=>$pais,
                'ciudad'=>$ciudad,
                'edad'=>$edad,
            ));
    }

    /**
     * Crear un nuevo comentario
     *
     * Revisar bien la estructura de la DB para fijarte bien como utilizar este 
     * metodo ya que hay varios parametritos que se tienen que pasar desde post 
     * para que se pueda guardar efectivamente la información. Sino este módulo 
     * se vuelve redundante.
     *
     * @param integer $idContenido ID del contenido que taggear
     * @param string $apiKey API key de la app a la cual se le agrega contenido
     * @param integer $id ID del usuario que requiere asignación
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function crear($idContenido, $apiKey, $id=null)
    {
        // Obtener post data ya limpio
        $post = $this->input->post('Comentarios');
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        if($post)
        {
            
            $post['comentarioAppApiKey'] = $apiKey;
            $post['comentarioElementoId'] = $idContenido;
            $post['comentarioUsuarioId'] = $id;

            $this->comentario->save($post);
            redirect('comentarios/ver/'.$apiKey.'/'.$idContenido);
        }
        $appData = array(
            'idContenido'=>$idContenido,
            'apiKey'=>$apiKey,
            'id'=>$id,
        );
        
        $usuarios = $this->comentario->get_user_data($id);
        $pais = $this->comentario->get_location($usuarios->pais, 'pais');
        $ciudad = $this->comentario->get_location($usuarios->ciudad, 'ciudad');
        $edad = edad_usuario($usuarios->edad);
        $this->load->view('comentarios/crear', array('appData'=>$appData, 'usuario'=>$usuarios, 'edad'=>$edad, 'pais'=>$pais, 'ciudad'=>$ciudad));
    }

    /**
     * Editar comentario
     *
     * Supongo que tampoco se necesita un método de edición en este módulo
     *
     * @return void
     * @author Me
     **/
    public function editar()
    {
        // código aquí
    }

    /**
     * Borrar un comentarios
     *
     * Este método recibe el id del comentario a borrar. Solo hay uno con 
     * ese id entonces supongo que no habrá problemas en las tablas
     * TODO: Validaciones
     *
     * @param integer $id id del comentario a borrar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id)
    {
        $this->comentario->delete($id);
        redirect($this->agent->referrer());
    }
}
