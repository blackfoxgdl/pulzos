<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed.');
/**
* Add and remove friends for the user.
* Expose some external API to achieve this
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 25 February, 2011
 * @package Amigos
 **/

class Amigos extends MX_Controller{
    /**
     * @ignore
     * amigoId
     * amigoUsuarioId
     * amigoAmigoId
     * amigoFechaCreacion
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('html', 'url', 'form', 'avatar', 'cyp', 'apipulzos', 'counters', 'emails', 'status'));
        $this->load->library(array('session', 'user_agent'));
        $this->load->model('amigo', '', true);
    }

    /**
     * just redirect to the view method
     * 
     * @param integer $id Id del usuario cuyos amigos queremos ver
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index($id=null)
    {
        if($id)
        {
            $datos['amigos'] = $this->amigo->get($id, '0', '3');
            $id_usuario = $id;
            $datos['id'] = $id;
            $datos['no_autorizados'] = $this->amigo->get($id_usuario, '0', '2');
            $datos['total_recibidas'] = $this->amigo->count_pending_applications($id, '0', '2');
            $datos['total_enviadas'] = $this->amigo->count_pending_applications($id, '0', '1');
            $datos['pendientes'] = $this->amigo->get($id, '0', '1');
        }
        else
        {
            $datos['amigos'] = $this->amigo->get($this->session->userdata('id'), '0', '3');
            $id_usuario = $this->session->userdata('id');
            $datos['id'] = $id;
            $datos['no_autorizados'] = $this->amigo->get($id_usuario, '0', '2');
            $datos['pendientes'] = $this->amigo->get($id, '0', '1');        
        }

        $this->load->view('amigos/ver', $datos);
    }

    /**
     * return all of the logged in users friends
     * TODO: Ajax return
     * TODO: Verificar si ver un solo amigo es necesario
     *
     * @param integer $id Si no es null, obtener solo el id de ese amigo?
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver($id=null)
    {
        $datos['amigos'] = $id;
        // renderizar vistas
        $this->load->view('amigos/view', $datos);
    }
    
    /**
     * Metodo que se encarga de mostrar a los amigos
     * que se tienen dentro de la plataforma, los que 
     * han aceptado tu solicitud de amistad
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function amigos_ver($id)
    {
        if($id)
        {
            $datos['amigos'] = $this->amigo->get($id, '0', '3');
        }
        else
        {
            $datos['amigos'] = $this->amigo->get($this->session->userdata('id'), '0', '3');
        }
        $this->load->view('amigos/ver', $datos);
    }

    /**
     * adds a new 'friendship' to a user
     * TODO: Add validation for logged in user
     *
     * @param integer $id Id af friend to add.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function agregar($id)
    {
        //get logged in user
        $loggedin_user = $this->session->userdata('id');

        //SE INICIALIZA EL CORREO CON SUS VALORES POR DEFECTO
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->load->library('email');
        $this->email->initialize($config);

        //prepare data to store
        $data = array(
            'amigoUsuarioId' => $loggedin_user,
            'amigoAmigoId' => $id,
            'amigoAceptado' => '1',
            'amigoFechaCreacion' => time(),
        );

        $data2 = array(
            'amigoUsuarioId' => $id,
            'amigoAmigoId' => $loggedin_user,
            'amigoAceptado' => '2',
            'amigoFechaCreacion' => time(),
        );
        //store data
        $this->amigo->save($data);
        $this->amigo->save($data2);
        //CORREO A ENVIAR 2
        
        //FUNCION PARA OBTENER LOS DATOS
        $user2_email = get_complete_userdata($id);
        $name_add_friend = get_complete_username($user2_email->id);
        $email_add_friend = $user2_email->email;
        //FUNCION PARA ENVIAR LOS DATOS Y REGRESE EL TEMPLATE A ENVIAR EN HTML
        $template = email_friends(get_complete_username($loggedin_user),
                                  get_complete_username($id));

        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to($email_add_friend, $name_add_friend);
        $this->email->subject(get_complete_username($loggedin_user) . ' te ha enviado una solicitud de amistad');
        $this->email->message($template);
        $this->email->send();

        //CREAR LA NOTIFICACION DE AMIGOS EN ESTA LINEA
        $post = array('planUsuarioId'=>$loggedin_user,
                      'planAmigoUsuarioId'=>$id,
                      'planTipo'=>'3',
                      'planMensaje'=>'quiere ser tu amigo',
                      'planFechaInicio'=>'0',
                      'planFechaFin'=>'0',
                      'planHoraInicio'=>'0',
                      'planHoraFin'=>'0',
                      'planDescripcion'=>'0',
                      'planFechaCreacion'=>time(),
                      'planLugar'=>'0',
                      'planDireccion'=>'0',
                      'planInvitados'=>'0');
        $idPlan = $this->amigo->save_saludo_plan($post);
        $datos = $this->amigo->get_plain_saludo($idPlan);

        //METODO PARA CONOCER SI SON DIFERENTES LOS USUARIOS QUE POSTEAN EN EL
        //MISMO COMENTARIO Y VER SI INSERTA O NO
        
        //INSERTA AL USUARIO EN CASO DE QUE NO TENGA REGISTRO CON EL 
        //PLAN QUE ESTA COMENTANDO
        $this->amigo->insert_notification($datos->planId, $datos->planAmigoUsuarioId);
            
        //SE CUENTAN TODOS LOS USUARIOS DIFERENTES AL QUE POSTEO
        $registros = $this->amigo->get_all_users_notifications($loggedin_user, $datos->planId);
        //CHECA SI HAY REGISTRO EN LA TABLA, EN CASO DE QUE SEA ASI 
        //ENTONCES SE ELIMINARAN ANTES DE INSERTAR NUEVOS REGISTROS
           
        foreach($registros as $registro)
        {
            //GUARDA LA NOTIFICACION QUE SE LE MOSTRARA AL USUARIO
            $this->amigo->save_new_notification($registro->notificaUsuarioId, $registro->notificaPlanId, '1', '5');
        }
    }

    /**
     * Metodo que se usa para poder enviar un saludo a un amigo con el
     * cual se daran cuenta que estan visitando el perfil o que esta
     * constantemente viendo o pensando en ti, jajajajja
     *
     * @parmas int id del usuario a enviar saludo
     * @params int id del usuario que envia saludo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function enviar_saludo($idA, $idU)
    {
        $post = array('planUsuarioId'=>$idU,
                      'planAmigoUsuarioId'=>$idA,
                      'planTipo'=>'2',
                      'planMensaje'=>'te ha enviado un saludo',
                      'planFechaInicio'=>'0',
                      'planFechaFin'=>'0',
                      'planHoraInicio'=>'0',
                      'planHoraFin'=>'0',
                      'planDescripcion'=>'0',
                      'planFechaCreacion'=>time(),
                      'planLugar'=>'0',
                      'planDireccion'=>'0',
                      'planInvitados'=>'0');
        $idPlan = $this->amigo->save_saludo_plan($post);
        $datos = $this->amigo->get_plain_saludo($idPlan);

        //PARTE DEL ENVIO DEL EMAIL
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);

        //GET DATA USER
        $datos_usuario = get_complete_usertdata($idA); 

        //GET EMAIL TEMPLATE
        $template_email = get_hello_email_template();
        
        //EMAIL FORMAT
        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to($datos_usuario->email, get_complete_username($datos_usuario->id));
        $this->email->subject(get_complete_username($idU) . ' te ha enviado un saludo');
        $this->email->message($template_email);
        $this->email->send();

        //METODO PARA CONOCER SI SON DIFERENTES LOS USUARIOS QUE POSTEAN EN EL
        //MISMO COMENTARIO Y VER SI INSERTA O NO
        
        //INSERTA AL USUARIO EN CASO DE QUE NO TENGA REGISTRO CON EL 
        //PLAN QUE ESTA COMENTANDO
        $this->amigo->insert_notification($datos->planId, $datos->planAmigoUsuarioId);
           
        //SE CUENTAN TODOS LOS USUARIOS DIFERENTES AL QUE POSTEO
        $registros = $this->amigo->get_all_users_notifications($idU, $datos->planId);
        //CHECA SI HAY REGISTRO EN LA TABLA, EN CASO DE QUE SEA ASI 
        //ENTONCES SE ELIMINARAN ANTES DE INSERTAR NUEVOS REGISTROS
            
        foreach($registros as $registro)
        {
            //GUARDA LA NOTIFICACION QUE SE LE MOSTRARA AL USUARIO
            $this->amigo->save_new_notification($registro->notificaUsuarioId, $registro->notificaPlanId, '1', '3');
        }
    }

    /**
     * Solución al problema de replicación. Aceptar amistad
     * De esta manera evitamos flags. Repetimos el registro al revés si la 
     * amistad está aceptada. En verdad hay que granular esto, porque no 
     * podemos dejar a alguien de amistad cuando no lo quiere cerca. You read 
     * me?
     * 
     * TODO: Validar todas estas acciones
     *
     * @param integer $id_aceptado Id del usuario aceptado
     * @param integer $id_acepta Id del usuario que acepta
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function autorizar($id_aceptado, $id_acepta=null)
    {
        // Si $id_acepta no está setteado, jalarlo de session
        if(! $id_acepta)
        {
            $id_acepta = $this->session->userdata('id');
        }

        $this->amigo->update($id_aceptado, $id_acepta);
        $this->amigo->update($id_acepta, $id_aceptado);
    }

    /**
     * Acepta o rechaza la invitación de amistad
     *
     * @param integer $id_rechazado Id de la persona que se rechaza
     * @param integer $id_rechaza Id de quien ejerce la acción
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function rechazar($id_rechazado, $id_rechaza=null)
    {
        if(! $id_rechaza)
        {
            $id_rechaza = $this->session->userdata('id');
        }
        $this->amigo->delete($id_rechazado, $id_rechaza);
        $this->amigo->delete($id_rechaza, $id_rechazado);

        //METODO PARA OBTENER DATOS CON LOS CUALES SE ELIMINARAN EN CASO
        //DE QUE SE RECHACEN LOS VALORES
        $post = $this->amigo->get_plains_friends($id_rechaza, $id_rechazado, '3');

        //BORAR LOS DATOS DE PLANESUSUARIOS, NOTIFICACION Y NOTIFICACIONES
        $this->amigo->delete_from($post->planId, 'planesusuarios', 'planId');
        $this->amigo->delete_from($post->planId, 'notificaciones', 'notificacionPlanId');
        $this->amigo->delete_from($post->planId, 'notificacion', 'notificaPlanId');
    }

    /**
     * Ver las solicitudes enviadas al usuario
     * Lo que vamos a hacer es un flag dentro de la tabla.
     * De esta manera ya sabemos que solicitudes tiene un usuario solo por 
     * checar estos campos
     *
     * @param integer $id ID de usuario de quien checar solicitudes.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver_no_autorizados($id=null)
    {
        if($id)
        {
            $id_usuario = $id;
        }
        else
        {
            $id_usuario = $this->session->userdata('id');
        }
        $datos['no_autorizados'] = $this->amigo->get($id_usuario, '0', '2');
        $this->load->view('amigos/request', $datos);
    }

    /**
     * Borrar amistad
     * TODO: Validar
     *
     * @param integer $id_borrador Usuario que inicia la acción
     * @param integer $id_borrado Usuario que recibe la acción
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id_borrado, $id_borrador=null)
    {
        if(! $id_borrador)
        {
            $id_borrador = $this->session->userdata('id');
        }
        $this->amigo->delete($id_borrado, $id_borrador);
        $this->amigo->delete($id_borrador, $id_borrado);
    }

    /**
     * muestra a los amigos para selecciona si lo quieres invitar
     * a alguna reunion
     *
     * PARAMS int id del usuario
     **/
    public function ver_amigos($id)
    {
        $datos['amigos'] = $this->amigo->get_amigos_usuario($this->session->userdata('id'),'1');
        $datos['idE'] = $id;
        $this->load->view('amigos/ver_amigos', $datos);
    }

    /**
     * Metodo en el cual se obtienen los datos de la busqueda que ha
     * solicitado el usuario como parametros para buscar a sus amigos
     * desde el modulo de amigos
     *
     * @params string cadena a buscar coincidencias
     * @return array datos de devolucion de la busqueda
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function buscar_amigos($id)
    {
        $datos['pendientes'] = $this->amigo->get($id, '0', '1');
        $this->load->view('amigos/buscar_amigos', $datos); 
    }

    /**
     * Manda los resultados de la busqueda que se esta
     * generando desde el modulo de amigos, en la pestaña 
     * que se tiene, aparecera debajo del cuadro de texto
     *
     * @return mixed datos que coincidan con cadena enviada
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function buscar_amigo()
    {
        $post = $this->input->post('Buscar');
        $datos['hola'] = "que pedo cabron";
        $datos['hola1'] = $post['buscar-amigos']; 
        $datos['results'] = $this->amigo->get_search_friends($this->session->userdata('id'), $post['buscar-amigos']);
        $this->load->view('amigos/resultados', $datos);
    }
}
