<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed');
/**
 * Controlador con el que se manejaran las
 * notificaciones que se envien del usuario 
 * a la empresa. Estas se mostraran solamente
 * dependiendo de la empresa a la que pertenezcan las
 * notificaciones.
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 11, 2011
 * @package notificaciones
 **/
class Notificaciones extends MX_Controller
{
    /**
     * Constructor del controlador para
     * inicializar todas las funciones
     * que se cargaran la iniciar este
     * modulo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'avatar', 'text', 'cyp', 'date', 'status', 'apipulzos', 'emails'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
        $this->load->model('Notificacion', '', true);
    }

    /**
     * Metodo que se iniciara para mostrar todas
     * las notificaciones que se tienen en el restaurant
     * de parte de los clientes. Todas las que se han enviado
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <rubne.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $datos['notificaciones'] = $this->Notificacion->get_notificaciones($id);
        $datos['id'] = $id;
        $this->load->view('notificaciones/index', $datos);
    }

    /**
     * Se usa para mostrar las notificaciones de forma personalizada
     * asi el usuario que tenga las notificaciones podra observar lo
     * que se ha posteado o quienes se han apuntado al mismo
     *
     * @params int id de la notificacion
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id, $idP)
    {
        $idUpdate = $this->Notificacion->get_last_notification_update($this->session->userdata('id'), $idP);
        $this->Notificacion->update_status($idUpdate->notificacionPlanId, $idUpdate->notificacionUsuarioId);
        $datos['notificacion'] = $this->Notificacion->get_notification_data($id);
        $this->load->view('notificaciones/ver', $datos);
    }

    /**
     * Metodo que se usa para mostrar la vista de los comentarios en
     * el perfil del usuario, esto se muestra como advertencia, para que
     * el usuario pueda ver el mismo
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_notificacion($id, $idP)
    {
        $idUpdate = $this->Notificacion->get_last_notification_update($this->session->userdata('id'), $idP);
        $this->Notificacion->update_status($idUpdate->notificacionPlanId, $idUpdate->notificacionUsuarioId);
        $datos['notificacion'] = $this->Notificacion->get_notification_data($id);
        $this->load->view('notificaciones/ver_amigos', $datos);
    }

    /**
     * Metodo que eliminara las notificaciones que ya no desee el dueño
     * del negocio ver y que esten canceladas
     * 
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function eliminar($idU, $idP)
    {
        $valor = $this->Notificacion->delete($idU, $idP);   
    }

    /**
     * Metodo que se usa para poder realizar las eliminaciones de los
     * saludos de los usuarios para que los mismo ya no puedan ver las notificaciones
     * y asi no tengan un monton en esta area, el usuario podra si quiere ver el
     * perfil del usuario o no
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function eliminar_saludo($idU, $idP)
    {
        $this->Notificacion->delete_notification_hello($idP, $idU);
        $this->Notificacion->delete_plain_hello($idP, $idU);
        $this->Notificacion->delete_notify_hello($idP, $idU);
    }

    /**
     * Metodo que se encarga de borrar el comentario de las notificaciones, con esto
     * se borraran tambien todas las notificaciones, los subcomentarios y los me
     * apunto que haya relacionados de este comentario, puesto que no es necesario tenerlos guardados
     * si ya no se tiene el comentario
     *
     * @params int id del plan
     * @params int id de la notificacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_comentario($plan, $id)
    {
        $this->Notificacion->delete_comments($plan);
        $this->Notificacion->delete_subcomments($plan);
        $this->Notificacion->delete_point_user($plan);
        $val = $this->Notificacion->delete_notification($id);
    }

    /**
     * Metodo que se encarga de actualizar las solicitudes de amistades esto 
     * para que el usuario ya no vea la notificacion en la barra donde aparecen 
     * y asi poder desaparecerlas sin problemas
     *
     * @params int id de la notificacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_friendly($id)
    {
        $this->Notificacion->update_friendlys($id);
    }

    /**
     * Metodo que se encarga de actualizar los datos de los usuarios para
     * que no les aparescan las solicitudes de un saludo de los amigos
     * con los cuales se puede borrar la notificacion con un status a '0'
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_hello_friend($idN)//P, $idU)
    {
        $this->Notificacion->update_friendlys($idN);
        //$this->Notificacion->update_hello_friends($idP, $idU);
    }

    /**
     *
     *
     *
     *
     * CHECAR ESTAS FUNCIONES PARA ALGO SERVIRAN 
     *
     *
     *
     *
     **/
    /**
     * Se muestran los pulzos pero ya personalizado
     * por cada usuario del que se tengan notificaciones,
     * del cual se mostrara sus datos personales,
     *
     * @params int id del negocio
     * @params int id del usuario
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com> 
     **/
    public function ver1($idN, $id, $idP)
    {
        $datosNotificacion = $this->Notificacion->get_data_notification($idN, $id, $idP);
        $datos['datosUsuario'] = $this->Notificacion->get_user_data($datosNotificacion->planUsuarioId);
        $datos['datosN'] = $this->Notificacion->get_company_data($idN);
        $datos['datosP'] = $datosNotificacion;
        $datos['planInvitacion'] = $this->Notificacion->get_user_invitation($datosNotificacion->planId);
        $this->load->view("notificaciones/ver", $datos);
    }

    /**
     * Se muestran las notificaciones que han sido canceladas
     * por el usuario o los usuarios
     *
     * @params int id del negocio
     * @params int id del usuario
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com> 
     **/
    public function ver_canceladas($idN, $id, $idP)
    {
        $datosNotificacion = $this->Notificacion->get_data_notification($idN, $id, $idP);
        $datos['datosUsuario'] = $this->Notificacion->get_user_data($datosNotificacion->planUsuarioId);
        $datos['datosN'] = $this->Notificacion->get_company_data($idN);
        $datos['datosP'] = $datosNotificacion;
        $datos['planInvitacion'] = $this->Notificacion->get_user_invitation($datosNotificacion->planId);
        $this->load->view("notificaciones/ver_canceladas", $datos);
    }

    /**
     * Metodo que muestra las notificaciones canceladas
     * de parte de los usuarios y asi poder evitar la
     * posible reservacion que se haria
     *
     * @int id del negocio
     * @return mixed datos notificaciones canceladas
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function canceladas($id)
    {
        $datos['notificacion'] = $this->Notificacion->get_notificaciones_canceladas($id);
        $datos['datosNegocio'] = $this->Notificacion->get_datos_negocio($id);
        $this->load->view("notificaciones/canceladas",$datos);
    }

    /**
     * Metodo que se usara para poder cargar la vista de ayuda para los usuarios
     * la cual contendra una serie de preguntas y respuestas hechas como las
     * faqs para que los usuarios puedan orientarse en lo que es la plataforma
     * de pulzos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ayuda($id)
    {
        $this->load->view('notificaciones/ayuda_pulzos');
    }
}
