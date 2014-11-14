<?php if(! defined('BASEPATH')) exit('No Direct Script Access Allowed');
/**
 * Controlador de inboxnegocios, es con el cual
 * se manipularan las vistas, los envios y revision
 * de los mensajes que envie el usuario al negocio,
 * asi mismo este le puede contestar su pregunta
 * de forma privada. NOTA EN ESTE MODULO SE USA EL
 * ID DEL USUARIO PARA NO REPETIR DATOS SI SE USA EL 
 * ID DEL NEGOCIO CON USUARIO USUARIO
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 4, 2011
 * @package inboxnegocios
 **/
class inboxNegocios extends MX_Controller
{
    /**
     * Constructor del
     * controlador de los ibnbox de negocios
     * donde declaramos valores para que se
     * inicien en al momento de cargar este controlador
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'cyp', 'date', 'avatar'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
        $this->load->model('inboxNegocio', '', TRUE);
    }

    /**
     * Metodo que muestra todos los inbox que
     * se han enviado al dueño del negocio, esto
     * mostrara los que se han leido o los que
     * estan sin leer
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {

        $datos['datosNegocio'] = $this->inboxNegocio->get_data_bussines($id);
        //$datos['inboxes'] = $this->inboxNegocio->get($id);
        $this->load->view('inboxnegocios/index', $datos);
    }

    /**
     * Se crea un nuevo mensaje que se hara llegar
     * al usuario por inbox, esto para que sea
     * una comunicacion privada entre el usuario
     * que envia y el o los que reciben
     *
     * @params int id del negocio que envia
     * @params int id del usuario que recibe
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function crear($id)
    {
        $post = $this->input->post("Inbox");
        if($post)
        {
            $post['inboxnUsuarioId'] = $id;
            $post['inboxnStatus'] = '1';
            $post['inboxnFecha'] = time();
            $return = $this->inboxNegocio->save($post);
        }
        else
        {
            $negocios = $this->inboxNegocio->get_data_bussines($id);
            $totalFollowers = $this->inboxNegocio->get_total_follows($negocios->negocioId);
            if($totalFollowers == '0')
            {            
                $datos['paraMsj'] = "0";
            }
            else
            {
                $seguidores = $this->inboxNegocio->get_data_follower($negocios->negocioId);
                $datos['paraMsj'] = create_array_followers($seguidores);
            }
            $datos['idNegocio'] = $id;
            $this->load->view('inboxnegocios/crear', $datos);
        }
    }

    /**
     * Metodo para mostrar todos los mensajes que se han enviado
     * por medio de los usuarios hacia los negocios
     *
     * @params int id del negocios
     * @return mixed datos de los mensajes
     * @author blackfoxgdl
     **/
    public function ver($id)
    {
        $this->inboxNegocio->change_status($id);
        $datos['inbox'] = $this->inboxNegocio->get_data_message($id);
        $this->load->view('inboxnegocios/ver', $datos);
    }

    /**
     * Metodo para cambiar el mensaje a leido o como no leido dependiendo
     * de como este el status del mensaje
     *
     * @params int id del mensaje inbox de la empresa
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function marcar_leido($id)
    {
        $v = $this->inboxNegocio->read_message($id);
    }

    /**
     * Metodo que se encarga de marcar el mensaje como no
     * leido asi el usuario podra cambiarlos de estatus en
     * caso de que quiera recordar ese mensaje
     *
     * @params int id del mensaje de la empresa
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function marcar_no_leido($id)
    {
        $var = $this->inboxNegocio->no_read_message($id);
    }

    /**
     * Se usa este metodo para borrar los inbox que ya no se
     * deseen tener en la bandeja por asi decir de cada cosa
     *
     * @params int id del inbox
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $val = $this->inboxNegocio->delete($id);
    }

    /**
     * Metodo que se usa para responder los inbox al usuario que
     * esta solicitando alguna informacion, resolucion de alguna
     * duda u otra cosa
     *
     * @params int id del usuario transmisor
     * @params int id del usuario receptor
     *
     * @return mixed datos del inbox
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function responder($idT, $idR=null)
    {
        $post = $this->input->post("Respuesta");
        if($post)
        {
            $post['inboxnUsuarioId'] = $idT;
            $post['inboxnUsuarioRecibeId'] = $idR;
            $post['inboxnStatus'] = "1";
            $post['inboxnFecha'] = time();

            $val = $this->inboxNegocio->save($post);
        }
        else
        {
            $datos['datosUserInbox'] = $this->inboxNegocio->get_data_message($idT);//que usuarios va
            $datos['datosInbox'] = $this->inboxNegocio->request($idT);//de quien va
            $this->load->view('inboxnegocios/respuesta', $datos);
        }
    }

    /**
     * Metodo que se usara para responder notificaciones
     * del usuario que quiera asistir a cierto negocio
     * ya sea con amigos, pareja o inclusive solo. Es el
     * medio por el cual se pondran de acuerdo
     *
     * @params int id del negocio
     * @params int id del usuario que envio notificacion
     *
     * @return mixed datos en general
     * @author blackfoxgdl <ruben.alonso21@gmail.com
     **/
    public function responder_solicitud($id, $idU)
    {
        $post = $this->input->post('RespuestaN');
        if($post)
        {
            $post['inboxnUsuarioId'] = $id;
            $post['inboxnUsuarioRecibeId'] = $idU;
            $post['inboxnFecha'] = time();
            $post['inboxnStatus'] = '1';

            $val = $this->inboxNegocio->save($post);
        }
        else
        {
            $datos['negocio'] = $this->inboxNegocio->get_data_bussines($id);
            $datos['usuario'] = $this->inboxNegocio->get_data_user($idU);
            $this->load->view('inboxnegocios/responderNotificacion', $datos);
        }
    }

    /**
     * Metodo que se encarga de cargar todos los mensajes que han sido
     * recibidos por el usuario, es la primer parte que se tendra que 
     * visualizar una vez que entre a los mensajes o inbox
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_mensajes($id)
    {
        $datos['datosNegocio'] = $this->inboxNegocio->get_data_bussines($id);
        $datos['inboxes'] = $this->inboxNegocio->get($id);
        $this->load->view('inboxnegocios/ver_inbox', $datos);
    }

    /**
     * Metodo que se encarga de mostrar todos los mensajes que se han enviado
     * por parte del usuario, estos pueden eliminarse pero mientras tanto se tendra
     * un registro con el cual se veran los mensajes enviados a los diferentes usuarios
     * de la plataforma
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_enviados($id)
    {
        $datos['recibidos'] = $this->inboxNegocio->ver_enviados($id);
        $datos['datosNegocio'] = $this->inboxNegocio->get_data_bussines($id);
        $this->load->view('inboxnegocios/ver_enviados', $datos);
    }
}
