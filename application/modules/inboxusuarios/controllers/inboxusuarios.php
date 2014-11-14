<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Metodos para los inbox de los usuarios
 * que se usan para mostrar los mensajes a
 * los usuarios y que se pueden crear o ver
 * los mensajes que se han enviado
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @author jorgeLeon <jorge@zavordigital.com>
 * @Copyright ZavorDigital, June 17, 2011
 * @package inboxUsuario
 **/
class inboxUsuarios extends MX_Controller
{

    /**
     * Constructor para poder declarar variables
     * librerias y helpers que nos ayudaran a
     * desarrollar en este modulo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('inboxUsuario', '', TRUE);
        $this->load->library(array('session','form_validation','user_agent'));
        $this->load->helper(array('url','html','cyp','passworder','avatar','apipulzos','date','status','emails','counters'));
    }

    /**
     * Metodo principal con el cual el index se carga
     * para mostrar la primer parte del desarrollo de
     * los inbox de usuarios, los cuales se mostrara
     * la primer parte
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $datos['usuario'] = $this->inboxUsuario->get_data($id);
        $this->load->view('inboxusuarios/index', $datos);
    }

    /**
     * Metodo en el cual el usuario puede ver sus mensajes
     * que tiene en bandeja de entrada para mostrarlos en
     * su perfil
     *
     * @params int id del usuarios
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function bandeja_entrada($id)
    {
        //echo "<h1>".$id."</h1>";
        $datos['inboxes'] = $this->inboxUsuario->get_inbox_recibe($id);
        $this->load->view('inboxusuarios/entrada', $datos);
    }
    /**
     * Metodo en el que se mostraran el volcado de mensajes
     * de los contactos que se tienen, sea empresa
     * o sea usuario.
     *
     * @params int id de usuarios
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function todos_mensajes(){
         $this->load->view('inboxusuarios/todos');
    }
    /**
     * Metodo en el cual se mostraran los mensajes que se
     * han enviado a los otros contactos que se tienen, sea empresa
     * o sea usuario.
     *
     * @params int id de usuarios
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function bandeja_salida($id)
    {
        $datos['recibido'] = $this->inboxUsuario->get_inbox_sent($id);
        $this->load->view('inboxusuarios/salida', $datos);
    }

    /**
     * Metodo en el cual se crea en inbox los amigos del Usuario
     * en una lista autocompletable
     * 
     *
     * @params $id del usuario $nombre de amigo
     * @return void
     * @author JogeLeon <jorge@zavordigital.com>
     **/
    public function autoAmigos($id, $nombre=null)
    {
        if($nombre){
            $unir1=str_replace("_", " ",$nombre);
            $nombres=trim($unir1);
            $datos['amigos']= $this->inboxUsuario->get_amigos_auto($id, $nombres);
            $this->load->view('busqueda', $datos);
        }
    }
    /**
     * Metodo en el cual se crea el inbox o mensaje que se enviara a los
     * usuarios que sean contactos del mismo, estos se mostraran en
     * los inbox de los otros usuarios
     *
     * @params int id del usuario
     * @params int idPara del usuario recibe NULL
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function crear($id, $idPara=NULL)
    {
        $post = $this->input->post('Inbox');
        if($post)
        {
            $post['inboxnUsuarioId'] = $id;
            $post['inboxnStatus'] = '1';
            $post['inboxnFecha'] = time();
            $this->inboxUsuario->save($post);
           

            //PARTE DONDE SE RECUPERAN LOS DATOS DEL USUARIO
            //checar si es empresa o usuario
            $status_user = get_status_user($post['inboxnUsuarioRecibeId']);
            if($status_user == '0')
            {
                $usuarios_datos = get_complete_userdata($post['inboxnUsuarioRecibeId']);
                $nombre_complete = get_complete_username($usuarios_datos->id);
                $emails = $usuarios_datos->email;
            }
            else
            {
                $negocios_datos = get_data_company($post['inboxnUsuarioRecibeId']);
                $emails = $negocios_datos->negocioEmail;
                $nombre_complete = $negocios_datos->negocioNombre;
            }

            //checar si el usuario que envia es empresa o negocio
            $status_user1 = get_status_user($post['inboxnUsuarioId']);
            if($status_user == '0')
            {
                $usuarios_datos2 = get_complete_userdata($post['inboxnUsuarioId']);
                $nombre_complete_2 = get_complete_username($usuarios_datos2->id);
            }
            else
            {
                $negocios_datos2 = get_data_company($post['inboxnUsuarioId']);
                $nombre_complete_2 = $negocios_datos2->negocioNombre;
            }

            //GET TEMPLATE
            $template_message = create_inbox_email($nombre_complete, $nombre_complete_2, $post['inboxnMensaje']);

            //PARTE DEL ENVIO DEL CORREO
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($emails, $nombre_complete);
            $this->email->subject('Has recibido un mensaje privador en Pulzos.'); 
            $this->email->message($template_message);
            $this->email->send();
        }
        $amigos = $this->inboxUsuario->get_amigos($id);
        $datos['idUsuario'] = $id;
        $datos['idPara']=$idPara;
        $numeroAmigos = $this->inboxUsuario->get_total_friends($id);
        if($numeroAmigos != '0')
        {
            $datos['paraMsj'] = create_array_friends($amigos);
            $datos['numeroAmigos'] = $numeroAmigos;
        }
        else
        {
            $datos['numeroAmigos'] = $numeroAmigos;
        }
        if(isset($idPara)){
            $this->load->view('inboxusuarios/index', $datos);
        }else{
            $this->load->view('inboxusuarios/crear', $datos);
        }
        
    }

    /**
     * @autor jorgeLeon <jorge@zavordigital.com>
     **/
    public function crearDefined($id, $idPara=NULL){
        $post = $this->input->post('Inbox');
        if($post)
        {
            $post['inboxnUsuarioId'] = $id;
            $post['inboxnStatus'] = '1';
            $post['inboxnFecha'] = time();
            $this->inboxUsuario->save($post);
        }
        $amigos = $this->inboxUsuario->get_amigos($id);
        $datos['idUsuario'] = $id;
        $datos['idPara']=$idPara;
        $numeroAmigos = $this->inboxUsuario->get_total_friends($id);
        if($numeroAmigos != '0')
        {
            $datos['paraMsj'] = create_array_friends($amigos);
            $datos['numeroAmigos'] = $numeroAmigos;
        }
        else
        {
            $datos['numeroAmigos'] = $numeroAmigos;
        }
         $this->load->view('inboxusuarios/crear', $datos);
    }

    /**
     * Metodo que se encarga de mostrar de forma personalizada
     * el inbox que haya enviado la empresa o el usuarios y asi
     * saber que dice observando el mensaje completo
     *
     * @params int id del inbox 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id)
    {
        $this->inboxUsuario->change_status($id);
        $datos['inboxN'] = $this->inboxUsuario->get_data_message($id, $this->session->userdata('id'));
        $datos['respuestas'] = $this->inboxUsuario->ver_respuesta($id, $this->session->userdata('id'));
        $this->load->view('inboxusuarios/ver', $datos);
    }
    
    /**
     * Metodo que se encarga de mostrar las respuestas
     * de los mensajes segun el id de conversacion por usuario 
     *
     * @params int idConversasion del inbox
     * @return void
     * @author JorgeLeon 
     **/
    public function ver_respuestas(){
       $post = $this->input->post("idConversacion");
       $respuestas=$this->inboxUsuario->ver_respuesta($post);
       //var_dump($respuestas);
       $this->load->view('inboxusuarios/ver', $respuestas);
    }

    /**
     * Metodo que se encarga de eliminar el mensaje que se este 
     * seleccionando, esto pasando su id por medio del parametro
     * Se redireccion una vez eliminado
     *
     * @params int id del inbox
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $val = $this->inboxUsuario->delete($id);
    }
     /**
     * Metodo que se encarga de eliminar una conversacion que se este 
     * seleccionando, esto pasando su envio y el qe recivio
     *  por medio del parametro
     * Se redireccion una vez eliminado
     *
     * @params int $e y $r del inbox
     * @return void
     * @author jorge Leon
     **/
    public function borrarConversacion($idC){
        $val = $this->inboxUsuario->deleteC($idC);
      
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
    public function responder($idT, $idR=null, $idC=null)
    {
        
        $post = $this->input->post("Respuesta");
        
        if($post)
        {
            $post['inboxnUsuarioId'] = $idT;
            $post['inboxnUsuarioRecibeId'] = $idR;
            $post['inboxnStatus'] = "1";
            $post['inboxnFecha'] = time();
            $post['inboxnConversacionId']=$idC;
            $val = $this->inboxUsuario->save($post);

            //PARTE DE LOS DATOS DE LOS USUARIOS O NEGOCIOS
            $status_user = get_status_user($idR);
            if($status_user == '0')
            {
                $usuarios_datos = get_complete_userdata($idR); 
                $nombre_complete = get_complete_username($usuarios_datos->id);
                $emails = $usuarios_datos->email;
            }
            else
            {
                $negocios_datos = get_data_company($idR);
                $emails = $negocios_datos->negocioEmail;
                $nombre_complete = $negocios_datos->negocioNombre;
            }

            $status_response = get_status_user($idT);
            if($status_response == '0')
            {
                $nombre_complete_u1 = get_complete_username($idT);
            }
            else
            {
                $negocios_u1 = get_data_company($idT);
                $nombre_complete_u1 = $negocios_u1->negocioNombre;
            }

            //GET TEMPLATE FOR THE EMAIL
            $template_message = response_inbox_email($nombre_complete, $nombre_complete_u1, $post['inboxnMensaje']);
            //PARTE DEL EMAIL HACIA EL USUARIO
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($emails, $nombre_complete);
            $this->email->subject('Has recibido una respuesta de un mensaje privado');
            $this->email->message($template_message);
            $this->email->send();
        }
        else
        {
            $datos['datosUserInbox'] = $this->inboxUsuario->get_data_coment($idT);//que usuarios va
            $datos['datosInbox'] = $this->inboxUsuario->request($idT);//de quien va
            $this->load->view('inboxusuarios/respuesta', $datos);
        }
    }

    /**
     **/
    public function recibidos($id=null){    
        $datos['recibido'] = $this->inboxUsuario->get_inbox_recibe($id);
        $this->load->view('inboxusuarios/recibidos', $datos);
    }

    /**
     **/
     public function sinLeer($id){
        $datos['recibido'] = $this->inboxUsuario->get_sin_leer($id);
        $this->load->view('inboxusuarios/sinLeer', $datos);
    }

    /**
     * Funcion que sirve para guardar o declinar las solicitudes 
     * de los usuarios a los negocios cuando los usuarios insertan 
     * el money consumido
     * 
     * @params inboxId -> identificador del inbox a actualizar
     * @params status -> tipo de status: aceptado, rechazado
     * 
     * @author JorgeLeon
     */
    public function moneyEmpresa(){
        $post = $this->input->post('inboxId');
        $status=$this->input->post('status');
        $idUsuario=$this->input->post('idUsuario');
        $idRecibe=$this->input->post('idRecibe');
        $razon=$this->input->post('razon');
        $click=$this->input->post('click');
        $idMoneyU=$this->inboxUsuario->request($post);
        //*datos del inbox
        $inboxMoney['inboxnUsuarioId']=$idRecibe;
        $inboxMoney['inboxnUsuarioRecibeId']=$idUsuario;
        $inboxMoney['inboxnAsunto']='Re:Solicitud de bonificación';
        $inboxMoney['inboxnStatus']='1';
        $inboxMoney['inboxnFecha']=time();

        //Opciones de botones de Aceptar o declinar de el inbox de Empresa
        //Boton de acepar
        foreach($idMoneyU as $moneys){ $idMoneyU=$moneys->inboxnMoneyUser; }
        if(isset($click) && $click!=''){
            $this->inboxUsuario->actualizarMoney($post, $idMoneyU, $status);
            unset($status);
        }else{
            if($status=='aceptar'){
                $inboxMoney['inboxnMensaje']='FELICIDADES TU SOLICITUD DE BONIFICACION FUE APROBADA, MANTENTE AL PENDIENTE DEL TU DEPOSITO';
                $this->inboxUsuario->save($inboxMoney);
                $this->inboxUsuario->actualizarMoney($post, $idMoneyU, $status);
                
            }else if($status=='rechazado'){

                if(isset($razon)){
                    $inboxMoney['inboxnMensaje']='Lo sentimos tu solicitud de bonificación no fue aprobada por la siguiente razon : '.$razon;
                }else{
                    $inboxMoney['inboxnMensaje']='Lo sentimos tu solicitud de bonificación no fue aprobada';
                }

                $this->inboxUsuario->actualizarMoney($post, $idMoneyU, $status); 
                $this->inboxUsuario->save($inboxMoney);
            }
        }
    }

    /**
     **/
    public function chequeoDatosFactura($id, $mu)
    {
        $data_offert = get_data_by_money_user($mu);
        $datos = $this->inboxUsuario->check_data_folio_user($id, $data_offert->moneyFolioFactura, $data_offert->moneyBackOfertaId);
        echo $datos;
        //echo '1';
    }
}
