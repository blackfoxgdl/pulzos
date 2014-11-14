<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed.');
/**
 * Pulzos invitaciones con tus amigos
 *
 * La idea de este controlador es manejar todas las 'invitaciones' que haces 
 * a tus amigos para reunirse en algún lugar en especial. El chiste es 
 * contabilizar toda la cosa bien para saber a quien asignar puntos y todos los 
 * beneficios de estos. 
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 02 March, 2011
 * @package Invitaciones
 **/

class Invitaciones extends MX_Controller{


    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'user_agent'));
        $this->load->helper(array('url', 'avatar', 'html', 'form', 'cyp'));
        $this->load->model('invitacion', '', TRUE);
    }

    /**
     * Dividir en dos: Las invitaciones hechas y la recibidas. Porner en dos 
     * "Pestañas". De golpe mostrar las recibidas con opción a navegar a las 
     * hechas
     *
     * @param integer $id ID del usuario cuyas invitaciones queremos ver
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index($id)
    {
        redirect('invitaciones/ver/' . $id);
    }

    /**
     * Ver las invitaciones pendientes del usuario y también las que este ha 
     * hecho. esto no debe de ser muy dificil de ligar
     *
     * @return void
     * @author axolotedeaccion <mario.r.vallejo@gmail.com>
     * @uthor blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id)
    {
        $datos['contador'] = $this->invitacion->count_invitations_request($this->session->userdata('id'), 'invitacionInvitadoId','invitacionAceptado','0');
        $datos['contador_hechas'] = $this->invitacion->count_invitations_request($this->session->userdata('id'),'invitacionUsuarioId');
        $datos['contador_aceptadas'] = $this->invitacion->count_invitations_request($this->session->userdata('id'),'invitacioninvitadoId','invitacionAceptado','1');
        $datos['eventos'] = $this->invitacion->get_invitations($id);
        $usuarios = $this->invitacion->get_user_data($this->session->userdata('id'));
        $datos['usuario'] = $usuarios;
        $datos['pais'] = $this->invitacion->get_location_user($usuarios->pais, 'pais');
        $datos['ciudad'] = $this->invitacion->get_location_user($usuarios->ciudad, 'ciudad');
        $datos['edad'] = edad_usuario($usuarios->edad);
        $header = $this->load->view('usuarios/header_login', '', TRUE);
        $content = $this->load->view('invitaciones/eventos', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));;
    }

    /**
     * crear una nueva invitación
     *
     * autoexplicatoria. no debe de haber problemas en esto.
     *
     * @return void
     * @author axolotedeaccion <mario.r.vallejo@gmail.com>
     **/

    public function crear_invitacion()
    {
        $post = $this->input->post('Invitacion');
        $post['invitacionPulzoId'] = $this->session->userdata('idP');
        $post['invitacionUsuarioId'] = $this->session->userdata('id');
        $post['invitacionAceptado'] = 0;
        $this->invitacion->save($post);
        redirect('usuarios/');
    }

    public function crear($id_pulzo,$id_negocio)
    {
        $post = $this->input->post('Invitacion');
        if($post)
        {
            $post['invitacionUsuarioId'] = $this->session->userdata('id');
            $post['invitacionEmpresaId'] = $id_negocio;
            $post['invitacionPulzoId'] = $id_pulzo;
            $return = $this->invitacion->save($post);
            redirect('invitaciones/ver/'.$this->session->userdata('id'));
        }
        else
        {
            $datos['ids'] = $id_pulzo.'/'.$id_negocio;
            $datos['pulzoComment'] = $this->invitacion->get_pulzosNeg($id_pulzo);
            $datos['amigos'] = $this->invitacion->get_friends($this->session->userdata('id'));
            $negocios = $this->invitacion->get_bussines_data($id_negocio);
            $datos['negocios'] = $negocios;
            $datos['pais'] = $this->invitacion->get_location($negocios->negocioPais, 'pais');
            $datos['ciudad'] = $this->invitacion->get_location($negocios->negocioCiudad, 'ciudad');
            $datos['giro'] = $this->invitacion->get_location($negocios->negocioGiro, 'giro');
            $header = $this->load->view('negocios/header_login', '', TRUE);
            $content = $this->load->view('invitaciones/crear', $datos, TRUE);
            $this->load->view('main/template',array('header'=>$header,
                                                    'content'=>$content));
        }
    }

    /**
     * borrar invitación hecha
     *
     * en caso de equivocarse o x o y se puede borrar la invitación 
     * completamente y hacer como que nunca pasó. el parametro es el id de 
     * la invitación.
     *
     * @param integer $id id de la invitación
     *
     * @return void
     * @author axolotedeaccion <mario.r.vallejo@gmail.com>
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $this->invitacion->delete($id);
        redirect('invitaciones/ver/'.$this->session->userdata('id'));
    }

    /**
     * Metodo para mostrar la solicitud de invitacion a los
     * usuarios que han sido invitados por un amigo
     * para asistir a una promocion o pulzos de
     * las empresas
     *
     * @params int id de la solicitud de invitacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function solicitud($id)
    {
        $datos['request'] = $this->invitacion->get_request($id);
        $usuarios = $this->invitacion->get_user_data($this->session->userdata('id'));
        $datos['usuario'] = $usuarios;
        $datos['pais'] = $this->invitacion->get_location_user($usuarios->pais, 'pais');
        $datos['ciudad'] = $this->invitacion->get_location_user($usuarios->ciudad, 'ciudad');
        $datos['edad'] = edad_usuario($usuarios->edad);
        $header = $this->load->view('usuarios/header_login', '', TRUE);
        $content = $this->load->view('invitaciones/solicitud', $datos, TRUE);
        $this->load->view('main/template',array('header'=>$header,
                                                'content'=>$content));
    }

    /**
     * Metodo que muestra todas las invitaciones que tiene el
     * usuario aceptadas para asistir a un evento.
     *
     * @return mixed datos de las invitaciones
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
/*    public function eventos()
    {
        $datos['eventos'] = $this->invitacion->get_invitations($this->session->userdata('id'));
        $header = $this->load->view('usuarios/header_login', '', TRUE);
        $content = $this->load->view('invitaciones/eventos', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }*/

    /**
     * Metodo para mostrar las invitaciones que ha
     * realizado el usuario a sus amigos, ademas
     * de saber cual es el pulzos que se selecciono
     *
     * @params  int id del usuario
     * @return mixed datos de la invitacion hecha
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function invitaciones_hechas($id)
    {
        $datos['hechas'] = $this->invitacion->get_made_invitations($id);
        $usuarios = $this->invitacion->get_user_data($this->session->userdata('id'));
        $datos['usuario'] = $usuarios;
        $datos['pais'] = $this->invitacion->get_location_user($usuarios->pais, 'pais');
        $datos['ciudad'] = $this->invitacion->get_location_user($usuarios->ciudad, 'ciudad');
        $datos['edad'] = edad_usuario($usuarios->edad);
        $header = $this->load->view('usuarios/header_login', '', TRUE);
        $content = $this->load->view('invitaciones/invitacioneshechas', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo para manejar las invitaciones aceptas, con el
     * cual actualizara el registro del usuario una vez que
     * este haya aceptado la invitacion del pulzo.
     *
     * @parasm int id de la invitacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function aceptar($id)
    {
        $val = array('invitacionAceptado'=>'1');
        $condicion = array('invitacionInvitadoId'=>$this->session->userdata('id'),
                           'invitacionId'=>$id);
        $this->invitacion->save($val, $condicion);
        redirect('invitaciones/ver/'.$this->session->userdata('id'));
    }

    /**
     * Metodo para ignorar o rechazar la invitacion
     * en caso de que no le interese al usuario
     * invitado
     *
     * @params int id de la invitacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function rechazar($id)
    {
        $this->invitacion->refuse($id, $this->session->userdata('id'));
        redirect('invitaciones/ver/'.$this->session->userdata('id'));
    }

    /**
     * Metodo el cual muestra los detalles del evento,
     * como lo es la ubicacion, lugar, fecha y hora del
     * mismo, comentarios que hagan.
     *
     * @params int id de la invitacion
     * @return mixed datos la invitacion, negocios y usuarios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function detalles_invitacion($id,$idU,$idP)
    {
        $datosGenerales = $this->invitacion->details($id, $idU, $idP);
        $datos['empresa'] = $datosGenerales;
        $datos['giro'] = $this->invitacion->get_location($datosGenerales->negocioGiro, 'giro');
        $datos['ciudad'] = $this->invitacion->get_location($datosGenerales->negocioCiudad, 'ciudad');
        $datos['country'] = $this->invitacion->get_location($datosGenerales->negocioPais, 'pais');
        $datos['usuarios'] = $this->invitacion->get_data_users($id, $idU, $idP);
        $usuarios = $this->invitacion->get_user_data($this->session->userdata('id'));
        $datos['usuario'] = $usuarios;
        $datos['pais'] = $this->invitacion->get_location_user($usuarios->pais, 'pais');
        $datos['ciudad'] = $this->invitacion->get_location_user($usuarios->ciudad, 'ciudad');
        $datos['edad'] = edad_usuario($usuarios->edad);
        $header = $this->load->view('usuarios/header_login', '', TRUE);
        $content = $this->load->view('invitaciones/detalles', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo para controlar la parte de la organizacion de eventos
     * personales, sin acudir a una empresa o negocio registrado en
     * pulzos
     *
     * @params
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function organizar($id)
    {
        $post = $this->input->post('Invitacion');
        if($post)
        {
            $pulzoNuevo = array('pulzoUsuarioId'=>$this->session->userdata('id'),
                                'pulzoAccion'=>$post['invitacionPersonalMensaje'],
                                'pulzoFechaCreacion'=>time());
            $idPulzos = $this->invitacion->get_id_save($pulzoNuevo);
            
            $post['invitacionUsuarioPersonalId'] = $this->session->userdata('id');
            $post['invitacionPersonalPulzoId'] = $idPulzos;
            $post['invitacionPersonalAceptadoId'] = 0;
            $this->invitacion->save_personal_invitacion($post);
            redirect('invitaciones/ver/'.$this->session->userdata('id'));
        }
        else
        {
            $usuarios = $this->invitacion->get_user_data($id);
            $datos['usuario'] = $usuarios;
            $datos['amigos'] = $this->invitacion->get_friends($id);
            $datos['pais'] = $this->invitacion->get_location_user($usuarios->pais, 'pais');
            $datos['ciudad'] = $this->invitacion->get_location_user($usuarios->ciudad, 'ciudad');
            $datos['edad'] = edad_usuario($usuarios->edad);
            $header = $this->load->view('usuarios/header_login', '', TRUE);
            $content = $this->load->view('invitaciones/organizacion', $datos, TRUE);
            $this->load->view('main/template', array('header'=>$header,
                                                     'content'=>$content));
        }
    }

    /**
     * Se usara este metodo para mostrar todas las invitaciones 
     * que se han realizado de manera personal sin
     * recurrir a un restaurant en un principio, despues se
     * le haran recomendaciones de como poder ligar invitaciones
     * personales con lso restaurnts
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_invitaciones_organizadas($id)
    {
        $usuarios = $this->invitacion->get_user_data($id);
        $datos['usuario'] = $usuarios;
        $datos['pais'] = $this->invitacion->get_location_user($usuarios->pais, 'pais');
        $datos['ciudad'] = $this->invitacion->get_location_user($usuarios->ciudad, 'ciudad');
        $datos['edad'] = edad_usuario($usuarios->edad);
        $datos['amigosA'] = $this->invitacion->invitaciones_organizadas($this->session->userdata('id'));
        $header = $this->load->view('usuarios/header_login', '', TRUE);
        $content = $this->load->view('invitaciones/view', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Este metodo eliminara las invitaciones personales
     * en las que el usuario no quiera asistir por x o
     * y razon, se eliminan de la base de datos
     *
     * @params int id de la invitacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_invitacion_personal($id)
    {
        $val = $this->invitacion->borrar_personal($id);
        redirect('invitaciones/ver/'.$this->session->userdata('id'));
    }

    /**
     * Se usara este metodo para rechazar la invitacion mas no
     * para eliminarla de la base de datos, este metodo cambiara
     * de status la invitacion a 2 en caso de que lña rechace
     *
     * @params int id del usuario
     * @params int id de la invitacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function rechazar_invitacion_personal($id, $idU)
    {
        $val = $this->invitacion->refuse_personal_invitacion($id, $idU);
        redirect('invitacions/ver/'.$this->session->userdata('id'));
    }

    /**
     * Metodo el cual cambiara el status de la invitacion del invitado
     * a aceptado, asi confirmando de que puede ir a alguna reunion
     * y podra ver los detalles de la misma en detalles de la invitacion
     * organizada
     *
     * @params int id del usuario
     * @params int i de la invitacion personal
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function aceptar_invitacion_personal($id, $idU)
    {
        $val = $this->invitacion->acept_personal_invitation($id, $idU);
        redirect('invitaciones/ver/' . $this->session->userdata('id'));
    }

    /**
     * Metodo que mostrara todas las invitaciones pendientes
     * que se tienen por parte del amigo del creador. Esta opcion sera
     * visible solamente si hay alguna invitacion o solicitud pendiente
     *
     * @params int id del usuario
     *
     * @return mixed datos de la invitacion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_invitaciones_pendientes($id)
    {
        $header = $this->load->view();
        $content = $this->load->view();
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }
}
