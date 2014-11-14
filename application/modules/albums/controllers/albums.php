<?php
/**
 * Maneja la administración de albums de la plataforma.
 * Yo no estoy de acuerdo con esto porque no es nada
 * novedoso.
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 01 March, 2011
 * @package Albums
 **/

class Albums extends MX_Controller{

        /**
         * Carga todas las librerías necesarias para la correcta
         * operación de este modulo
         *
         * @return void
         * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
         **/
        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('html', 'url', 'form', 'cyp', 'avatar', 'apipulzos'));
                $this->load->library(array('session'));
                $this->load->model('album', '', true);
        }

        /**
         * Redirigir a ver cuando la raiz del controlador
         * sea llamada
         *
         * @return void
         * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
         **/
        public function index()
        {
                redirect('albums/ver/');
        }

        /**r
         * Recibe el parametro opcional $id. En caso de este
         * tener un valor solo retornar los albumes que pertenecen
         * al usuario delimitado. Sino se encuentra retornar todos 
         * los albumes existentes.
         *
         * TODO: Agregar sistema de autorización para no permitir el 
         * acceso a los albumes a todos.
         *
         * @param integer $idAlbum Id del album a sacar
         * @param integer $idUsuario Id del usuario de quien sacar albumes
         *
         * @return void
         * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
         **/
        public function ver($idUsuario=null)
        {
            if(! $idUsuario)
            {
                $idUsuario = $this->session->userdata('id');
            }
            $this->load->view('albums/ver');
        }

        /**
         * Obtener todos los albumes del usuario al cargar la página
         *
         * @return void
         * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
         **/
        public function ver_albums($idUsuario=null)
        {
            if(! $idUsuario)
            {
                $idUsuario = $this->session->userdata('id');
            }
            $albums = $this->album->get('albumUsuarioId = '.$idUsuario);
            $this->load->view('albums/ver_inline', array('albums'=>$albums));
        }

        /**
         * Create a new album
         * TODO: Add validation
         *
         * @return void
         * @author axoloteDeAccion
         **/
        public function crear()
        {
                $loggedin_user = $this->session->userdata('id');
                $post = $this->input->post('Albums');
                if($post)
                {
                        $post['albumUsuarioId'] = $loggedin_user; 
                        $post['albumFechaCreacion'] = time();
                        $post['albumFechaModificacion'] = time();
                        $result = $this->album->save($post);
                        echo $result;
						
                }

                $this->load->view('albums/crear');
        }

        /**
         * Edit an album metadata
         *
         * @param integer $id ID of album to edit
         *
         * @return void
         * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
         **/
        public function editar($id)
        {
                //check if form was submitted
                $post = $this->input->post('Albums');
                if($post)
                {
                        $this->album->save($post, 'albumId = '.$id);
                        redirect(''.base_url().'index.php/usuarios/perfil#'.base_url().'index.php/albums/ver_albums/'.$this->session->userdata('id'));
                }
                //get relevant model
                $album = $this->album->get('albumId = '.$id);

                $this->load->view('albums/editar', array('album'=>$album));
        }

        /**
         * delete an album with all of it's contents
         *
         * @return void
         * @author axoloteDeAccion
         **/
        public function borrar($id)
        {
                $this->album->delete($id);
				redirect(''.base_url().'index.php/usuarios/perfil#'.base_url().'index.php/albums/ver_albums/'.$this->session->userdata('id'));
				
        }
}
