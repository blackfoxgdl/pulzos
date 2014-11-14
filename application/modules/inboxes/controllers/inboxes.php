<?php
/**
 * Conversaciones entre usuarios
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright ZavorDigita;, 17 May, 2011
 * @package inbox
 **/
class Inboxes extends MX_Controller
{
     public function __construct()
     {
         parent::__construct();
         $this->load->helper(array('form', 'url', 'html', 'apipulzos', 'avatar'));
         $this->load->library(array('session'));
         $this->load->model('inbox', '', TRUE);
     }

     /**
      * Don't know what to write here.
      *
      * @return void
      * @author axoloteDeAccion
      **/
     public function index($id)
     {
         $datos['usuarios'] = $this->inbox->get_data_company($id);
         $this->load->view('inboxes/', $datos);
     }

     /**
      * Crear nuevo mensaje
      *
      * @return void
      * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
      **/
     public function crear()
     {
         if($this->input->post('Inbox'))
         {
             $post = $this->input->post('Inbox');
             $post['inboxUsuarioId'] = $this->session->userdata('id');
             $post['inboxFecha'] = time();
             $this->inbox->save($post);
             redirect('inboxes/salida');
         }
         $amigos = get_amigos_usuario_combo($this->session->userdata('id'));
         $this->load->view('inboxes/crear', array('amigos'=>$amigos));
     }

     /**
      * Ver buzon de entrada
      *
      * @return void
      * @author axoloteDeAccion
      **/
     public function entrada($id)
     {
        /*$id = $this->session->userdata('id');
        $convos = $this->inbox->get_entrada('inboxUsuarioRecibeId = '.$id);*/
        //$datos[] = 
        $this->load->view('inboxes/entrada');
     }

     /**
      * Ver buzón salida
      *
      * @return void
      * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
      **/
     public function salida()
     {
         $id = $this->session->userdata('id');
         $convos = $this->inbox->get_salida('inboxUsuarioId = '.$id);
         $this->load->view('inboxes/salida', array('convos'=>$convos));
     }

     /**
      * Borrar el inbox deseado
      *
      * @return void
      * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
      **/
     public function borrar($id)
     {
         $this->inbox->delete($id);
     }

     /**
      * cambiar el status a leido
      *
      *`@param integer $id Id del mensaje a cambiar
      *
      * @return void
      * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
      **/
     public function marcar($id)
     {
         $this->inbox->leido($id);
     }
 }
