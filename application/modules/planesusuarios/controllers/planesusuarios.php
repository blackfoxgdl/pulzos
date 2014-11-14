<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Modulo de planes que se usara para poder crear los mismo
 * pero para los usuarios, en este se podran cargar las vistas de
 * que planes se tienen hechos, quien asistira y
 * quien no.
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 21, 2011
 * @package planes
 **/
class planesUsuarios extends MX_Controller
{

    /**
     * Metodo constructor en el cual se declaran los helpers,
     * libraries y el modelo para poder usarse dentro
     * de este modulo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('planUsuario', '', TRUE);
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'date', 'status', 'emails'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
    }

    /**
     * Metodo que se usa para poder cargar el formulario para crear el
     * nuevo evento que se hara pero solo por parte del usuario a usuarios
     * y no las promociones que hara el negocio a los usuarios.
     *
     * Nota: son cosas muy diferentes
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id=null)
    {	if($this->session->userdata('id')==FALSE){$this->load->view('usuarios/volver');}else{
        $post = $this->input->post('Planes');
        if($post)
        {
            $amigos = "";
            if(isset($_POST['amigos'])){
                foreach($_POST['amigos'] as $amigo)
                {
                    $amigos .= $amigo . ',';
                }

                $post['planInvitados'] = $amigos;
            }
            $ano = date('Y');
            $value = strtotime($ano . "-" . $post['planMesInicio'] . "-" . $post['planDiaInicio']);
           
            $post['planFechaInicio'] = $value;
        
            unset($post['planMesInicio']);
            unset($post['planDiaInicio']);
            
            $post['planUsuarioId'] = $id;
            $post['planFechaCreacion'] = time();
            $val = $this->planUsuario->save($post);
            if(isset($post['planImagenId'])){
            $idImagen=$this->planUsuario->get_last_plan($post['planImagenId']);
            $this->planUsuario->update_imagenId($idImagen->planImagenId, $idImagen->planId,$this->session->userdata('id'));
            }
            $val1 = $this->planUsuario->save_invitation($val, $post['planUsuarioId'], $post['planMensaje']);
            redirect('usuarios');
        }
        $usuarios = $this->planUsuario->get_data_user($this->session->userdata('id'));
        $personales = $this->planUsuario->data_profile('usuarioId', $usuarios->id, 'personal');
        
        $datos['usuario'] = $usuarios;
        $datos['inboxT'] = $this->planUsuario->inbox_total($usuarios->id, '1');
        $datos['dias'] = days();
        $datos['meses'] = month();
        $datos['horas'] = hours();
        if($personales->relaciones != ''){
            $datos['personal'] = $this->planUsuario->estado_civil($usuarios->id);
        }else{
            $datos['personal'] = null;
        }
        $datos['edad'] = edad_usuario($usuarios->edad);
        $datos['localidad'] = $this->planUsuario->data_location($usuarios->ciudad);
        $datos['amigos'] = $this->planUsuario->get_friends($usuarios->id);
        $datos['pulzosNuevos'] = $this->planUsuario->new_pulzos($usuarios->id);
        $datos['notificaciones'] = $this->planUsuario->get_all_notifications($usuarios->id);
        // SE COMENTA LA LIENA HASTA PROXIMO AVISO $datos['notificacion'] = $this->planUsuario->get_notifications($usuarios->id);

        $header = $this->load->view('usuarios/header_login2',$datos,TRUE);
        $content = $this->load->view('planesusuarios/index',$datos,TRUE);
        $this->load->view('main/template', array('header'=>$header, 'content'=>$content));
		}
    }
        
    /**
     * Metodo que se usa para poder armar un plan desde
     * el cual se podra armar con una empresa que el usuario
     * elija para que este pueda invitar a sus amigos y asi
     * la empresa pueda tener tambien notificacion de que se
     * piensa armar un plan ahi
     *
     * @params int id del usuario
     * @params int id del negocio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function planes_negocios($idU, $idN)
    {
        $usuario = $this->planUsuario->get_data_user($idU);
        $datos['usuario'] = $usuario;
        $datos['negocios'] = $this->planUsuario->get_data_company($idN);
        $datos['inboxT'] = $this->planUsuario->inbox_total($usuario->id, '1');
        $datos['notificaciones'] = $this->planUsuario->get_all_notifications($usuario->id);
        //SE COMENTA HASTA NUEVO AVISO $datos['notificacion'] = $this->planUsuario->get_notifications($usuario->id);
        $datos['dias'] = days();
        $datos['meses'] = month();
        $datos['horas'] = hours();
        $personales = $this->planUsuario->data_profile('usuarioId', $usuario->id, 'personal');
        if($personales->relaciones != ''){
            $datos['personal'] = $this->planUsuario->estado_civil($usuario->id);
        }else{
            $datos['personal'] = null;
        }
        $datos['edad'] = edad_usuario($usuario->edad);
        $datos['localidad'] = $this->planUsuario->data_location($usuario->ciudad);
        $datos['amigos'] = $this->planUsuario->get_friends($usuario->id);

        $header = $this->load->view('usuarios/header_login2',$datos,TRUE);
        $content = $this->load->view('planesusuarios/crear_plan',$datos,TRUE);
        $this->load->view('main/template', array('header'=>$header, 'content'=>$content));
    }

    /**
     * Metodo que se usa para poder armar y guardar la parte de las reservaciones
     * que se han realizado de un pulzo, reto o experiencia de vida, esto para conocer
     * de parte de la empresa si en realidad estan funcionando sus ofertas
     * y si se tienen algun usuario con reservacion
     *
     * @params int id del usuario
     * @params int id del plan u oferta
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reservacion_promocion($idU, $idPl, $idP)
    {
            $datos['planId'] = $idPl;
            $usuario = $this->planUsuario->get_data_user($idU);
            $datos['usuario'] = $usuario;
            $datos['negocios'] = $this->planUsuario->get_data_general($idP);
            $datos['inboxT'] = $this->planUsuario->inbox_total($usuario->id, '1');
            $datos['notificaciones'] = $this->planUsuario->get_all_notifications($usuario->id);
           
            $datos['dias'] = days();
            $datos['meses'] = month();
            $datos['horas'] = hours();
            $personales = $this->planUsuario->data_profile('usuarioId', $usuario->id, 'personal');
            if($personales->relaciones != ''){
                $datos['personal'] = $this->planUsuario->estado_civil($usuario->id);
            }else{
                $datos['personal'] = null;
            }
            $datos['edad'] = edad_usuario($usuario->edad);
            $datos['localidad'] = $this->planUsuario->data_location($usuario->ciudad);
            $datos['amigos'] = $this->planUsuario->get_friends($usuario->id);
            $content = $this->load->view('planesusuarios/reservacion',$datos,TRUE);
            $header = $this->load->view('usuarios/header_login2',$datos, TRUE);
            $this->load->view('main/template', array('header'=>$header, 'content'=>$content));
    }

    /**
     * Metodo que se usa para guardar las reservaciones de las
     * promociones de las empresas de los usuarios, estas para conocer
     * o que la empresa conosca cuales son los usuarios que han reservado
     * alguna promocion que hayan realizado
     *
     * @params int id del usuario
     * @params int id del plan
     * @params int id de la empresa
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_reservacion($idU, $idP, $idN)
    {
        $valor = $this->input->post('lugarReservacion');
        //echo 'hola: ' . $valor . '<br>' . $idU . '<br>' . $idP . '<br>' . $idN;
        $this->planUsuario->insert_reservation($idU, $idU, $idP, $valor, '0', $idN);
        foreach($_POST['amigos'] as $amigos)
        {
            //echo 'hola amigos: ' . $amigos;
            $this->planUsuario->insert_reservation($idU, $amigos, $idP, $valor, '1', $idN);
        }
        redirect('usuarios/perfil');
    }

    /**
     * Metodo que se encarga de guardar los datos de los planes de usuarios
     * que se hagan ya con una empresa definida y asi el usuario poder
     * mostrarlo a los amigos y que a estos les lleguen las invitaciones
     * que se tienen actualmente
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_plan_con_empresa($id, $id2)
    {
        $post = $this->input->post('PlanN');
        $amigos = "";
        if(isset($_POST['amigos'])){
            foreach($_POST['amigos'] as $amigo)
            {
                $amigos .= $amigo . ',';
            }
            $post['planInvitados'] = $amigos;
        }
        $ano = date('Y');
        $value = strtotime($ano . "-" . $post['planMesInicio'] . "-" . $post['planDiaInicio']);
        $post['planFechaInicio'] = $value;
        unset($post['planMesInicio']);
        unset($post['planDiaInicio']);
        $post['planUsuarioId'] = $id;
        $post['planFechaCreacion'] = time();
        $post['planMensaje'] = 'Reunion en ' . $post['planLugar'];
        $post['planEsEmpresa'] = '1';
        $post['planIdEmpresa'] = $id2;
        $post['planEmpresaPulzoId']=$id;
        $val = $this->planUsuario->save($post);
        $val1 = $this->planUsuario->save_invitation($val, $post['planUsuarioId'], $post['planMensaje']);
        redirect('usuarios/perfil');
        //var_dump($post);
    }

    /**
     * Metodo que se usa para mostrar los planes de los usuarios
     * que han pulzado, estos de manera personal para que se
     * muestre al usuario los pulzos o oportunidades que ha hecho
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mis_planes($id)
    {
        $datos['planes'] = $this->planUsuario->get_plains($id);
        $usuarios = $this->planUsuario->get_data_user($id);//$this->session->userdata('id'));
        $personales = $this->planUsuario->data_profile('usuarioId', $usuarios->id, 'personal');
        if($personales->relaciones != '')
        {
            $datos['personal'] = $this->planUsuario->estado_civil($usuarios->id);
        }
        else
        {
            $datos['personal'] = null;
        }
        $datos['usuarios'] = $usuarios;
        $datos['edad'] = edad_usuario($usuarios->edad);
        if($datos['edad']==date('Y')){ $datos['edad']=false; }else{  }
        $datos['localidad'] = $this->planUsuario->data_location($usuarios->ciudad);
        $datos['usuario'] = $id;
        $this->load->view('planesusuarios/ver_planes', $datos);
    }

    /**
     * Metodo que se usa para mostrar los planes del usuario de manera
     * individual, esto para que se pueda mostrar con mas
     * detalle que es lo que se hara en el plan del usuario
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_plan($id)
    {
        $datos['plan'] = $this->planUsuario->get_simple_plain($id);
        $usuarios = $this->planUsuario->get_data_user($this->session->userdata('id'));
        $datos['usuario'] = $usuarios;
        $datos['inboxT'] = $this->planUsuario->inbox_total($usuarios->id, '1');
        $datos['notificaciones'] = $this->planUsuario->get_all_notifications($usuarios->id);
        $datos['localidad'] = $this->planUsuario->data_location($usuarios->ciudad);
        //SE COMENTA LA LINEA HASTA PROXIMO AVISO 
        $datos['notificacion'] = $this->planUsuario->get_notifications($usuarios->id);
        
        if($usuarios->statusEU==1){
            $dato['usuariosU']=$datos['usuario'];
            $localizacion= $this->planUsuario->get_negocioHubicacion($usuarios->id);
            $dato['localidadN']=$localizacion->nombre;
            $header = $this->load->view('negocios/header_login1',$dato, TRUE);
        }else{
            $header = $this->load->view('usuarios/header_login2', $datos, TRUE);
        }
        $content = $this->load->view('planesusuarios/ver_simple', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo que se usa para mostrar las reservaciones que hacen los
     * usuarios y a los que estan invitando para que el mismo pueda ver
     * si acepta o no la invitacion que se esta haciendo
     *
     * @params int id del plan
     * @params int id del pulzo
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_reservacion($idPl, $idPu, $idU) 
    { 
        $datos['plan'] = $this->planUsuario->get_simple_plain($idPl);
        $datos['pulzo'] = $this->planUsuario->get_simple_pulzo($idPu);
        $usuarios = $this->planUsuario->get_data_user($this->session->userdata('id'));
        $datos['usuario'] = $usuarios;
        $datos['inboxT'] = $this->planUsuario->inbox_total($usuarios->id, '1');
        $datos['notificaciones'] = $this->planUsuario->get_all_notifications($usuarios->id);
        $datos['localidad'] = $this->planUsuario->data_location($usuarios->ciudad);
        $datos['notificacion'] = $this->planUsuario->get_notifications($usuarios->id);

        $header = $this->load->view('usuarios/header_login2', $datos, TRUE);
        $content = $this->load->view('planesusuarios/ver_reservacion', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo que se encarga de mostrar los planes que los amigos
     * han estado realizando en su muro, esot para que el usuario vea
     * lo que sus amigos han estado pulzando
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_amigos($id)
    {
        $datos['usuarios'] = $this->planUsuario->get_data_user($this->session->userdata('id'));
        $datos['amigos'] = $this->planUsuario->get_friends_plains($id);
        $datos['usuario'] = $id;
        $this->load->view('planesusuarios/ver_planes_amigos', $datos);
    }

    /**
     * Metodo que se encarga de actualizar el status de asistencia del
     * plan de usuarios para poder asi decidir si se va a asistir, no
     * se asistira o solo se quedara en 0
     *
     * @params int id del usuario
     * @params int id del status
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function status_planes($id, $tipoId, $idPlan)
    {
   
        $this->planUsuario->update_status_plain($id, $tipoId, $idPlan);
        $datos = $this->planUsuario->get_simple_plain($idPlan);
        //PARTE DE LAS NOTIFICACIONES DE LOS USUARIOS CUANDO PULZAN O NO
        if($tipoId == 1)
        {
            //SE CREA EL PLAN PARA CREAR LA NOTIFICACION
            $post = array('planUsuarioId'=>$id,
                          'planAmigoUsuarioId'=>$datos->planUsuarioId,
                          'planTipo'=>'4',
                          'planMensaje'=>'si ha pulzado en tu plan',
                          'planFechaInicio'=>'0',
                          'planFechaFin'=>'0',
                          'planHoraInicio'=>'0',
                          'planHoraFin'=>'0',
                          'planDescripcion'=>'0',
                          'planFechaCreacion'=>time(),
                          'planLugar'=>'0',
                          'planDireccion'=>'0',
                          'planInvitados'=>'0');
            $idP = $this->planUsuario->insert_pulzo_yes($post);
            $datos_invitacion = $this->planUsuario->get_simple_plain($idP);

            $this->planUsuario->insert_notification($idP, $datos->planUsuarioId);
            $registros = $this->planUsuario->get_all_users_notifications($datos_invitacion->planUsuarioId, $idP);
            foreach($registros as $registro)
            {
                //GUARDA LA NOTIFICACION QUE SE LE MOSTRARA AL USUARIO
                $this->planUsuario->save_new_notification2($registro->notificaUsuarioId, $registro->notificaPlanId, '1', '6', $datos->planId);
            }
        }
        else
        {
            //SE CREA EL PLAN PARA CREAR LA NOTIFICACION
            $post = array('planUsuarioId'=>$id,
                          'planAmigoUsuarioId'=>$datos->planUsuarioId,
                          'planTipo'=>'5',
                          'planMensaje'=>'no ha pulzado en tu plan',
                          'planFechaInicio'=>'0',
                          'planFechaFin'=>'0',
                          'planHoraInicio'=>'0',
                          'planHoraFin'=>'0',
                          'planDescripcion'=>'0',
                          'planFechaCreacion'=>time(),
                          'planLugar'=>'0',
                          'planDireccion'=>'0',
                          'planInvitados'=>'0');
            $idP = $this->planUsuario->insert_pulzo_yes($post);
            $datos_invitacion = $this->planUsuario->get_simple_plain($idP);

            $this->planUsuario->insert_notification($idP, $datos->planUsuarioId);
            $registros = $this->planUsuario->get_all_users_notifications($datos_invitacion->planUsuarioId, $idP);
            foreach($registros as $registro)
            {
                //GUARDA LA NOTIFICACION QUE SE LE MOSTRARA AL USUARIO
                $this->planUsuario->save_new_notification2($registro->notificaUsuarioId, $registro->notificaPlanId, '1', '7', $datos->planId);
            }
        }
        
     
       
    }

    /**
     * Metodo que se encarga de guardar los post nuevos que van
     * haciendo los usuarios acerca del pulzo, esto para que vayan haciendo
     * la interaccion de los comentarios
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function comentarios_plan_simple($id, $id2)
    {
        $comment = $this->input->post('comentarios_planes');
        $post = array('comentarioSimpleUsuarioId'=>$id2,
                      'comentarioSimplePlanId'=>$id,
                      'comentarioSimpleSubId'=>'1',
                      'comentarioSimple'=>$comment,
                      'comentarioFechaCreacion'=>time());
        $this->planUsuario->save_comments($post);
    }

    /**
     * Metodo que se encarga de guardar los datos de los subcomentarios
     * de los planes de los usuarios con los cuales estos pueden
     * comentar el comentario y asi comenzar una discusion o alguna opinion
     *
     * @params int id del plan de usuario
     * @params int id del usuario
     * @params int id del comentario del plan de usuario
     *
     * @return mixed datos de los usuarios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function subcomentarios_plan_simple($id, $id2, $id3)
    {
        $subcomments = $this->input->post('subcomentarios_planes');
        $post = array('comentarioSimpleUsuarioId'=>$id2,
                      'comentarioSimplePlanId'=>$id,
                      'comentarioSimpleSubId'=>'1',
                      'comentarioSimple'=>$subcomments,
                      'subcomentarioComentarioId'=>$id3);
        $this->planUsuario->save_subcomments($post);
    }

    /**
     * Metodo que se encarga de sumar los likes
     * para que el usuario pueda ver cuantos se han dado en total,
     * esto con el fin de que se pueda sumar
     *
     * @params int id del comentario del plan
     * @params int numero de me gusta
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mas_uno($id, $total)
    {
        $total_gustar = $total + 1;
        $val = $this->planUsuario->add_one($id, $total_gustar);
        redirect('planesusuarios/ver_plan/5');
    }

    /**
     * Metodo que se encarga de guardar las cosas que quiera postear el usuario
     * en su muro, o que otros usuarios quieran postear en el muro de los 
     * amigos para comentarle algo
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mi_wall($id)
    {
        if($this->session->userdata('id') == $id)
        {
            $post = $this->input->post('comentarios');
            $anchor = $this->input->post('enlace');
            if(($post == '¿Qué quieres hacer hoy?' && $anchor != 'Enlace'))
            {
                $nombre_usuario = get_name_user($this->session->userdata('id'));
                $post = $nombre_usuario . ' ha compartido un link contigo.';
            }
            if(($post == '¿Qué quieres hacer hoy?' && $_FILES['imagenP']['name'] != ''))
            {
                $nombre_usuario = get_name_user($this->session->userdata('id'));
                $post = $nombre_usuario . ' ha compartido una foto contigo.';
            }
            $data = array('planUsuarioId'=>$id,
                          'planDescripcion'=>$post,
                          'planTipo'=>'1',
                          'planFechaCreacion'=>time());
        }
        else
        {
            $post = $this->input->post('comentarios');
            $anchor = $this->input->post('enlace');
           
            if(($post == '¿Qué quieres hacer hoy?' && $anchor != 'Enlace'))
            {
                $nombre_usuario = get_name_user($this->session->userdata('id'));
                $post = $nombre_usuario . ' ha compartido un link';
            }
            if(($post == '¿Qué quieres hacer hoy?' && $_FILES['imagenP']['name'] != ''))
            {
                $nombre_usuario = get_name_user($this->session->userdata('id'));
                $post = $nombre_usuario . ' ha compartido una foto.';
            }
            $data = array('planUsuarioId'=>$id,
                          'planAmigoUsuarioId'=>$this->session->userdata('id'),
                          'planDescripcion'=>$post,
                          'planTipo'=>'1',
                          'planFechaCreacion'=>time());

          
        }
        $idPlan = $this->planUsuario->insert_comment_wall($data);
        

        if($anchor != 'Enlace')
        {
            $datos_anexos = array('anexosPlanId'=>$idPlan,
                                  'enlace'=>$anchor);
            $this->planUsuario->insert_anexos($datos_anexos);
        }

        if(isset($_FILES['imagenP']['name']))
        {
            //se crea la parter de la imagen del pulzo
            $file_path = './statics/img_muro/'.$id.'/';
            //se crea el directorio
            @mkdir($file_path, 0777, true);
            //preparar propiedades para la carga
            $upload_settings = array(
                    'upload_path'=>$file_path,
                    'allowed_types'=>'gif|jpg|jpeg|png',
                    'max_size'=>'10000',
                    'max_width'=>'3000',
                    'max_height'=>'3000',
                    'remove_spaces'=>true,
                    'encrypt_name'=>true
                );

            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('imagenP'))
            {
                //sacar la informacion sobre el archivo
                $file_info = $this->upload->data();

                //se prepara la informacion a guardar
                $foto = './statics/img_muro/'.$id.'/'.$file_info['file_name'];
                $datos_anexos = array('anexosPlanId'=>$idPlan,
                                      'foto'=>$foto);
                $this->planUsuario->insert_anexos($datos_anexos);
            }
        }
        
        //$val = $this->planUsuario->save_notification($id, $idPlan, '1', '0', '1');
        if($id != $this->session->userdata('id'))
        {
          
                $this->planUsuario->insert_notification($idPlan, $id);
                $this->planUsuario->save_new_notification($id, $idPlan, '1', '8');

              
        }
        else
        {
            $vv = $this->planUsuario->insert_notification($idPlan, $id);
        }
    }

    /**
     * Metodo que se usa para poder comentar en el muro de los
     * usuarios los cuales pueden comentar los comentarios de
     * los usuarios ponen
     *
     * @params int id del plan a comentar
     * @params int id del usuario a comentar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_comentarios_wall($id, $id2)
    {
        $subcomments = $this->input->post('comentar_muro');
        $post = array('comentarioSimpleUsuarioId'=>$id2,
                      'comentarioSimplePlanId'=>$id,
                      'comentarioSimpleSubId'=>'1',
                      'comentarioSimple'=>$subcomments,
                      'comentarioFechaCreacion'=>time());
        $this->planUsuario->save_subcomments_wall($post);

        $scribble = $this->planUsuario->known_is_scribble($id);

        if($scribble->planScribbleId != 0)
        {
            $url = get_thumb_avatar($id2);
            $coded = str_replace('/','-', $url);
            $url_complete = 'http:--www.pulzos.com-' . $coded;
            $insertScribble = array('scribbleUsuarioId'=>$id2,
                                    'scribbleTexto'=>$subcomments,
                                    'scribbleLat'=>'0',
                                    'scribbleLng'=>'0',
                                    'scribbleNombreUsuario'=>get_complete_username($id2),
                                    'scribbleImagenUsuario'=>$url_complete,
                                    'scribbleFatherId'=>$scribble->planScribbleId,
                                    'totalComentarios'=>'0',
                                    'heading'=>'0',
                                    'altura'=>'0',
                                    'atributo'=>'0');

            $this->planUsuario->insert_scribble_from_wall($insertScribble);
            $totales_scribbles = $this->planUsuario->get_total_scribbles($scribble->planScribbleId);
            $suma = $totales_scribbles->totalComentarios + 1;
            $this->planUsuario->update_data_scribble($scribble->planScribbleId, $suma);
        }

        ////////// PARTE DEL CORREO ELECTRONICO EN LOS COMENTARIOS DE LOS POSTEOS ///////
        //METODO QUE SE USA PARA SABER QUE HAN POSTEADO EN UN COMENTARIO POR MEDIO DE CORREO ELECTRONICO
        $datos_planes_comentados = get_data_plain($id);
        if($datos_planes_comentados->planUsuarioId != $id2)
        {//INICIO DEL IF DEL CORREO
            //METODO QUE SE USA PARA SABER EL TIPO DE USUARIO
            $statuses_user = get_status_user($id2);
            if($statuses_user == '0')
            {
                $datos_usuarios_publicacion = get_complete_userdata($id2);
                $nombre_usuario_posteador = get_complete_username($datos_usuarios_publicacion->id);
            }
            else
            {
                $datos_negocios_publicacion = get_data_company($id2);
                $nombre_usuario_posteador = $datos_negocios_publicacion->negocioNombre;
            }

            //METODO PARA SABER EL TIPO DE USUARIO QUE POSTEO LA PUBLICACION
            $statuses_publicacion = get_status_user($datos_planes_comentados->planUsuarioId);
            if($statuses_publicacion == '0')
            {
                $datos_usuario_publicador = get_complete_userdata($datos_planes_comentados->planUsuarioId);
                $nombre_usuario_publicacion = get_complete_username($datos_usuario_publicador->id);
                $email_usuario_publicacion = $datos_usuario_publicador->email;
            }
            else
            {
                $datos_negocio_publicador = get_data_company($datos_planes_comentados->planUsuarioId);
                $nombre_usuario_publicacion = $datos_negocio_publicador->negocioNombre;
                $email_usuario_publicacion = $datos_negocio_publicador->negocioEmail;
            }

            //SE CARGA LA LIBRERIA PARA EL ENVIO DE EMAIL Y SE PONE EL ENVIO
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->email->initialize($config);

            //GET TEMPLATE SEND EMAIL
            $template_email = get_comment_wall_email($nombre_usuario_publicacion,
                                                     $nombre_usuario_posteador,
                                                     $subcomments);

            //TEMPLATE SEND EMAIL
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($email_usuario_publicacion, $nombre_usuario_publicacion);
            $this->email->subject($nombre_usuario_posteador . ' ha comentado en tu publicacion.');
            $this->email->message($template_email);
            $this->email->send();
            //  }//FIN DEL IF DEL CORREO
            //// PARTE DEL ENVIO DE CORREO EN LOS COMENTARIOS FIN /////
        }

        //METODO PARA CONOCER SI SON DIFERENTES LOS USUARIOS QUE POSTEAN EN EL
        //MISMO COMENTARIO Y VER SI INSERTA O NO
        $notificacionesTotal = $this->planUsuario->get_total_notification($id2, $id);
        if($notificacionesTotal != 0)
        {
            //CHECAR SI EL USUARIO YA INSERTO EN NOTIFICACIO O NO
            $number_notification = $this->planUsuario->count_number_notification_user($id, $id2);
            if($number_notification == 0)
            {
                //INSERTA AL USUARIO EN CASO DE QUE NO TENGA REGISTRO CON EL 
                //PLAN QUE ESTA COMENTANDO
                $this->planUsuario->insert_notification($id, $id2);
            }
            else
            {
                //SE BORRA EL REGISTRO Y REINSERTA PARA EVITAR QUE NO ACTUALICE
                //EL VALOR DE LAS NOTIFICACIONES
                $this->planUsuario->delete_notification($id, $id2);
                $this->planUsuario->insert_notification($id, $id2);
            }
            //SE CUENTAN TODOS LOS USUARIOS DIFERENTES AL QUE POSTEO
            $registros = $this->planUsuario->get_all_users_notifications($id2, $id);
            //CHECA SI HAY REGISTRO EN LA TABLA, EN CASO DE QUE SEA ASI 
            //ENTONCES SE ELIMINARAN ANTES DE INSERTAR NUEVOS REGISTROS
            $registros_viejos =  $this->planUsuario->count_all_registros($id);
            if($registros_viejos > 0)
            {
                $this->planUsuario->delete_data($id);
            }
            foreach($registros as $registro)
            {
                //GUARDA LA NOTIFICACION QUE SE LE MOSTRARA AL USUARIO
                $this->planUsuario->save_new_notification($registro->notificaUsuarioId, $registro->notificaPlanId, '1', '1');
            }
        }

        //PART WHERE GET ALL THE USERS THAT COMMENTED THE MAIN COMMENT
        $total_users = $this->planUsuario->count_all_data($id);
        if($total_users != 0)
        {
            if($datos_planes_comentados->planUsuarioId == $id2)
            {
                $datos_completos_usuarios = $this->planUsuario->get_all_users_publication($datos_planes_comentados->planId);
                foreach($datos_completos_usuarios as $dcu)
                {
                    if(($datos_planes_comentados->planUsuarioId != $id2) || ($dcu->comentarioSimpleUsuarioId != $id2))
                    {
                        //INITIALIZE EMAIL LIBRARY
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'utf-8';
                        $this->load->library('email');
                        $this->email->initialize($config);

                        //GET EMAIL TEMPLATE FOR SEND EMAIL TO USERS LIKE NOTIFICATIONS
                        $datos_user1 = get_complete_userdata($id2);
                        $template_mine = get_comment_wall_email_mine(get_complete_username($dcu->id),
                                                                     get_complete_username($datos_user1->id));
                        $this->email->from('atencion@pulzos.com', 'Pulzos');
                        $this->email->to($dcu->email, get_complete_username($dcu->id));
                        $this->email->subject(get_complete_username($datos_planes_comentados->planUsuarioId) . ' ha comentado en su publicación.');
                        $this->email->message($template_mine);
                        $this->email->send();
                    }
                }
            }
            else
            {
                $datos_completos_usuarios = $this->planUsuario->get_all_users_publication($datos_planes_comentados->planId);
                foreach($datos_completos_usuarios as $dcu)
                {
                    if($dcu->comentarioSimpleUsuarioId != $id2)// || ($datos_planes_comentados->planUsuarioId != $dcu->id))
                    {
                        if($datos_planes_comentados->planUsuarioId != $dcu->id)
                        {
                        //INITIALIZE DATA FOR EMAILS
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'utf-8';
                        $this->load->library('email');
                        $this->email->initialize($config);

                        //GET TEMPLATE AND SEND EMAIL
                        $datos_user1 = get_complete_userdata($id2);
                        $datos_user2 = get_complete_userdata($datos_planes_comentados->planUsuarioId);
                        $nombre_completo = get_complete_username($dcu->id);
                        $template_user = get_comment_wall_email_users($nombre_completo,
                                                                      get_complete_username($datos_user1->id),
                                                                      get_complete_username($datos_user2->id));
                        $this->email->from('atencion@pulzos.com', 'Pulzos');
                        $this->email->to($dcu->email, get_complete_username($dcu->id));
                        $this->email->subject(get_complete_username($datos_user1->id) . ' ha comentado en una publicacion de ' . get_complete_username($datos_user2->id));
                        $this->email->message($template_user);
                        $this->email->send();
                        }
                    }
                }
            }
        }
    } 

    /**
     * Metodo que se usa para apuntarse en el plan que esta
     * realizando el usuario imitando un me gusta para
     * el usuario y asi aparecera esto en el comentario del
     * plan
     *
     * @params int id del plan de usuario
     * @params int id del usuario que se apunta
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function me_apunto($idP, $idU)
    {
        $this->planUsuario->save_point($idP, $idU);

        //METODO PARA CONOCER SI SON DIFERENTES LOS USUARIOS QUE POSTEAN EN EL
        //MISMO COMENTARIO Y VER SI INSERTA O NO
        $notificacionesTotal = $this->planUsuario->get_total_notification($idU, $idP);
        //echo "hola: " . $notificacionesTotal;
        if($notificacionesTotal != 0)
        {
            //echo "hola;";
            //CHECAR SI EL USUARIO YA INSERTO EN NOTIFICACIO O NO
            $number_notification = $this->planUsuario->count_number_notification_user($idP, $idU);
            if($number_notification == 0)
            {
                //INSERTA AL USUARIO EN CASO DE QUE NO TENGA REGISTRO CON EL 
                //PLAN QUE ESTA COMENTANDO
                $this->planUsuario->insert_notification($idP, $idU);
            }
            else
            {
                //SE BORRA EL REGISTRO Y REINSERTA PARA EVITAR QUE NO ACTUALICE
                //EL VALOR DE LAS NOTIFICACIONES
                $this->planUsuario->delete_notification($idP, $idU);
                $this->planUsuario->insert_notification($idP, $idU);
            }
            //SE CUENTAN TODOS LOS USUARIOS DIFERENTES AL QUE POSTEO
            $registros = $this->planUsuario->get_all_users_notifications($idU, $idP);
            //CHECA SI HAY REGISTRO EN LA TABLA, EN CASO DE QUE SEA ASI 
            //ENTONCES SE ELIMINARAN ANTES DE INSERTAR NUEVOS REGISTROS
            $registros_viejos =  $this->planUsuario->count_all_registros($idP);
            if($registros_viejos > 0)
            {
                $this->planUsuario->delete_data($idP);
            }
            foreach($registros as $registro)
            {
                //GUARDA LA NOTIFICACION QUE SE LE MOSTRARA AL USUARIO
                $this->planUsuario->save_new_notification($registro->notificaUsuarioId, $registro->notificaPlanId, '1', '2');
            }

            //OBTENER LOS DATOS DEL PLAN DEL USUARIO PARA EL ENVIO DE CORREO
            $datos_plan = get_data_plain($idP);
            $status_user = get_status_user($datos_plan->planUsuarioId);
            if($status_user == '0')
            {
                $data_user_plain = get_complete_userdata($datos_plan->planUsuarioId);
                $nombre_user_plan = get_complete_username($data_user_plain->id);
                $email_user_plan = $data_user_plain->email;
            }
            else
            {
                $data_negocio_plain = get_data_company($datos_plan->planUsuarioId);
                $nombre_user_plan = $data_negocio_plain->negocioNombre;
                $email_user_plan = $data_negocio_plain->negocioEmail;
            }

            $status = get_status_user($idU);
            if($status == '0')
            {
                $data_user = get_complete_userdata($idU);
                $nombre_complete = get_complete_username($data_user->id);
            }
            else
            {
                $negocio_user = get_data_company($idU);
                $nombre_complete = $negocio_user->negocioNombre;
            }

            //PARTE DONDE SE REALIZARA EL PROCESO DEL ENVIO DE CORREO
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->email->initialize($config);

            //GET EMAIL TEMPLATE
            $template_email = get_email_point_comment($nombre_user_plan,
                                                      $nombre_complete,
                                                      $datos_plan->planDescripcion,
                                                      $idP);

            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($email_user_plan, $nombre_user_plan);
            $this->email->subject($nombre_complete . ' se ha apuntado a tu comentario.');
            $this->email->message($template_email);
            $this->email->send();

            //ENVIO DE CORREOS A LOS USUARIOS QUE YA ESTAN APUNTADOS EN EL PLAN PARA
            //NOTIFICARLES QUE SE HA APUNTADO OTRO USUARIO AL MISMO
            $users_point = $this->planUsuario->get_data_point_users($idP);
            $nombre_usuario_apuntado = get_complete_userdata($idU);
            $nombre_completo_usuario_apuntado = get_complete_username($nombre_usuario_apuntado->id);
            foreach($users_point as $point_me)
            {
                if($point_me->meApuntoUsuarioApuntadoId != $idU)
                {
                    //PARTE DE LOS DATOS NECESARIOS PARA QUE SE PUEDAN MANDAR LOS CORREOS
                    //OBTENER LOS DATOS DEL PLAN DEL USUARIO PARA EL ENVIO DE CORREO
                    $datos_plan_1 = get_data_plain($idP);
                    $status_user_1 = get_status_user($datos_plan_1->planUsuarioId);
                    if($status_user_1 == '0')
                    {
                        $data_user_plain_1 = get_complete_userdata($datos_plan_1->planUsuarioId);
                        $nombre_user_plan_1 = get_complete_username($data_user_plain_1->id);
                        $email_user_plan_1 = $data_user_plain_1->email;
                    }
                    else
                    {
                        $data_negocio_plain_1 = get_data_company($datos_plan_1->planUsuarioId);
                        $nombre_user_plan_1 = $data_negocio_plain_1->negocioNombre;
                        $email_user_plan_1 = $data_negocio_plain_1->negocioEmail;
                    }
                
                    $status_1 = get_status_user($point_me->meApuntoUsuarioApuntadoId);
                    if($status_1 == '0')
                    {
                        $data_user_1 = get_complete_userdata($point_me->meApuntoUsuarioApuntadoId);
                        $nombre_complete_1 = get_complete_username($data_user_1->id);
                        $email_user_complete_1 = $data_user_1->email;
                    }
                    else
                    {
                        $negocio_user_1 = get_data_company($point_me->meApuntoUsuarioApuntadoId);
                        $nombre_complete_1 = $negocio_user_1->negocioNombre;
                        $email_user_complete_1 = $negocio_user_1->negocioEmail;
                    }
                    
                    $template_email_friends = get_email_point_comment_users($nombre_complete_1,
                                                                            $nombre_completo_usuario_apuntado,
                                                                            $nombre_user_plan_1,
                                                                            $datos_plan->planDescripcion,
                                                                            $idP);
                    $this->email->from('atencion@pulzos.com', 'Pulzos');
                    $this->email->to($email_user_complete_1, $nombre_complete_1);
                    $this->email->subject($nombre_completo_usuario_apuntado . ' se ha apuntado al comentario de ' . $nombre_user_plan_1);
                    $this->email->message($template_email_friends);
                    $this->email->send();
                }
            }
        }
    }

    /**
     * Metodo que se usa para desapuntarse en el plan que se
     * estaba realizando por medio de un amigo para que este
     * se vea como notificacion del usuario que realiza el plan
     *
     * @params int id del plan de usuario
     * @params int id del usuario que se apunta
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function no_voy($idU, $idP)
    {
        $this->planUsuario->unsave_point($idU, $idP);
    }

    /**
     * Metodo que se encarga de eliminar los comentarios para
     * que estos ya no se puedan ver una vez que el usuario le de eliminar
     * al comentarios. Se quitara de la visualizacion del muro
     * y no lo podra ver mas
     *
     * @params int id del planId
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_comentario($id)
    {
        $total = $this->planUsuario->count_all_data($id);
        if($total != 0)
        {
            $this->planUsuario->delete_comments($id);
        }
        $this->planUsuario->delete_invitation($id);
        $this->planUsuario->delete($id);
        $val = $this->planUsuario->count_notifications($id);
        if($val != 0)
        {
            $this->planUsuario->delete_notification_data($id);
            $this->planUsuario->delete_notifications($id);
        }
    }

    /**
     * Metodo que se usa para poder mostrar todos los comentarios de amigos,
     * personales y demas que se han hecho, pues esto es el volcado de todos los
     * topics o comentarios relacionados al usuario y sus amigos, despues se incluiran
     * tambien empresas
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id)
    {
        $datos['todos_planes'] = $this->planUsuario->get_all_plains($id);
        //echo "haber pinche id: " . $id;
        $d = $this->planUsuario->get_all_plains($id);
        //var_dump($d);
        $usuarios = $this->planUsuario->get_data_user($id);
        $personales = $this->planUsuario->data_profile('usuarioId', $usuarios->id, 'personal');
        if($personales->relaciones != '')
        {
            $datos['personal'] = $this->planUsuario->estado_civil($usuarios->id);
        }
        else
        {
            $datos['personal'] = null;
        }
        $datos['usuarios'] = $usuarios;
        $datos['edad'] = edad_usuario($usuarios->edad);
        //if($datos['edad']==date('Y')){ $datos['edad']=false; }else{  }
        $datos['localidad'] = $this->planUsuario->data_location($usuarios->ciudad);
        $datos['usuario'] = $id;
        $valor = $this->planUsuario->get_last_plains($usuarios->id);
        if($valor == '0') 
        {
            $valor = '1';
            $datos['ultimo_plan'] = $valor;
            //print_r('hola ' . $a)
        }
        else
        {
            $datos['ultimo_plan'] = $valor;
            //print_r('jholas');
        }
        $datos['ultimo_plan_total'] = $this->planUsuario->count_last($usuarios->id);
        $this->load->view('planesusuarios/ver_todos', $datos);
    }

    /**
     * Metodo que se encarga de obtener los registros de los pulzos siguientes
     * a los mas recientes que tienes en tu muro, esto para que el usuario
     * pueda seguir mirando  las publicaciones que le siguen a las mas recuientes
     * que tiene y no solo se quede en las primeras que se muestra
     *
     * @params int id del usuario
     * @params int numero de la ultima publicacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function siguientes_diez($id, $num)
    {
        $datos['siguientes'] = $this->planUsuario->get_all_plain_limit($id, $num);
        $this->load->view('planesusuarios/ver_siguientes', $datos);
    }

    /**
     * Metodo que se usa para poder mostrar los datos de los comentarios
     * personales, puesto que en el muro general solamente se muestran
     * los ultimos 3 comentarios y aqui se mostraran todos los comentarios
     * ya desplegados
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_personal($id)
    {
        $datos['plan'] = $this->planUsuario->get_simple_plain($id); 
        $this->load->view('planesusuarios/ver_personal', $datos);
    }

    /**
     * Metodo que se usa para poder hacer que solo se muestren 10 registros
     * de los usuarios y asi sucesivamente para que no se carguen los
     * chorrocientomil registros que se tienen en la base y hacer
     * mas rapida la carga y dinamica
     *
     * @params int id del plan
     * @params int numero del plan
     *
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_last_comment($id, $num)
    {
        $datos_ultimos = $this->planUsuario->get_all_plain_limit($id, $num);
        $valor = obtain_array($datos_ultimos);
        echo $valor;
    }

    /**
     * Metodo que se usa para poder cargar la vista donde se mostraran
     * los siguientes 10 comentarios de los usuarios para que el
     * mismo no cargue todos al mismo tiempo y sehaga lentisimo esa mamada
     * asi no consumir tantos recursos
     *
     * @params int id del usuario
     * @params int numero de la ultima publicacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_siguientes_diez_mios($id, $num)
    {
        $datos['planes'] = $this->planUsuario->get_mine_plain_limit($id, $num);
        $this->load->view('planesusuarios/ver_siguientes_planes', $datos);
    }

    /**
     * Metodo que se usa para obtener los ultimos comentarios de parte
     * del usuario, esto para poder saber cual es el ultimo posteo que
     * se muestra al usuario para poder  partir de ahi para la sioguiente
     * presion del boton
     *
     * @params int id del usuario
     * @params int numero de posteo
     *
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_last_comment_mine($id, $num)
    {
        $datos_ultimos_mios = $this->planUsuario->get_mine_plain_limit($id, $num);
        $valor = obtain_array($datos_ultimos_mios);
        echo $valor; //json_encode($valor);
    }


    /**
     * Metodo que se usa para poder cargar la vista donde se mostraran
     * los siguientes 10 comentarios de los usuarios para que el
     * mismo no cargue todos al mismo tiempo, y se haga lentisima esta
     * mamada en la parte de amigos
     *
     * @params int id del usuario
     * @params int numero de la ultima publicacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_siguientes_diez_amigos($id, $num)
    {
        $datos['amigos'] = $this->planUsuario->get_friends_plain_limit($id, $num);
        $this->load->view('planesusuarios/ver_siguientes_amigos', $datos);
    }

    /**
     * Metodo que se usa para obtener los ultimos 10 comentariso de los
     * amigos, esto para saber cual es el ultimo que se muestra para saber cual sera
     * o a partir de cual comentario se mostrara una vez que se presione ver mas
     *
     * @params int id del usuario
     * @params int numero de la ultima publicacion
     *
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_last_comment_friends($id, $num)
    {
        $datos_ultimos_amigos = $this->planUsuario->get_friends_plain_limit($id, $num);
        $valor = obtain_array($datos_ultimos_amigos);
        echo json_encode($valor);
    }

    /**
     * Metodo que se usa para cargar todos los comentarios nuevos
     * el en dis que se ira creando dependiendo si es un comentario
     * de usuarios o no lo es, esto para poder actualizar los
     * post que se van poniendo en la pared
     *
     * @params int id del usuario
     * @params int total de comentarios
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function cargar_todos($val, $id)
    {
        $datos['valor'] = $this->planUsuario->get_plains_update($val);
        $datos['todos_planes'] = $this->planUsuario->get_all_plains();
        $datos['usuario'] = $this->planUsuario->get_data_user($id);
        $datos['total'] = $val;
        $this->load->view('planesusuarios/preguntas', $datos);
        //echo json_encode($valor);
    }

    /**
     * Metodo que se usa para actualizar el id del usuario que
     * ha comentado, esto varia dependiendo si es un amigo o no
     * lo es, en caso de que no lo sea no lo tomara en cuenta
     * y no lo posteara
     *
     * @params int id del planusuario
     * @return json encode con datos del id y url
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function actualizar_id($id)
    {

        $datos = $this->planUsuario->get_plain_last_id($id);
        echo json_encode($datos);
    }

    /**
     **/
    public function preguntas($id)
    {
        $datos['usuario'] = $id;
        $datos['usuarios'] = $this->planUsuario->get_data_user($id);
        $this->load->view('planesusuarios/preguntas', $datos);
    }

     /**
     * Crear una nueva imágen
     *
     * Hacer el registro en la DB y subir la imágen al filesystem
     *
     * @param integer $id Id del album al cual agregar la imágen
     * @param bool $flag Si hacerla avatar inmediatamente o no
     *
     * @return void
     * @author JorgeLeon 
     **/
    public function crearImagen()
    {
        // verificar si el formulario ha sido mandado.
        $values = $this->input->post('Planes');
        if($_FILES['imagen']!= '')
        {
            $file_path = './statics/img_eventos/'.$this->session->userdata('id').'/';
            //create directory

            @mkdir($file_path, 0777, true);

            //prepare file upload
            $upload_settings = array(
                'upload_path'=>$file_path,
                'allowed_types'=>'gif|jpg|jpeg|png',
                'max_size'=>'10000',
                'max_width'=>'3000',
                'max_height'=>'3000',
                'remove_spaces'=>true,
                'encrypt_name'=>true,
            );
            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('imagen'))
                {
                //sacar información sobre el archivo
                $file_info = $this->upload->data();
                // preparar la información antes de guardar
                $post['idUsuario']=$this->session->userdata('id');
                $post['imagenRuta'] = 'statics/img_eventos/'.$this->session->userdata('id').'/'.$file_info['file_name'];
                $post['imagenFechaCreacion'] = time();
                $post['imagenFechaModificacion'] = time();
                $insert_id = $this->planUsuario->save_image($post);
                $usuarios = $this->planUsuario->get_data_user($this->session->userdata('id'));
                $personales = $this->planUsuario->data_profile('usuarioId', $usuarios->id, 'personal');
                $datos['flag']=1;
                $datos['imagenRuta'] = 'statics/img_eventos/'.$this->session->userdata('id').'/'.$file_info['file_name'];
                $datos['usuario'] = $usuarios;
                $datos['inboxT'] = $this->planUsuario->inbox_total($usuarios->id, '1');
                // Variables values
                $datos['planMensaje']=$values['planMensaje'];
                $datos['planDiaInicio']=$values['planDiaInicio'];
                $datos['planMesInicio']=$values['planMesInicio'];
                $datos['planHoraInicio']=$values['planHoraInicio'];
                $datos['planLugar']=$values['planLugar'];
                $datos['planDireccion']=$values['planDireccion'];
                $datos['planDescripcion']=$values['planDescripcion'];
                $datos['planRadio']=$values['planRadio'];
                // Fin
                $datos['idImagen']=json_encode($insert_id);
                $datos['dias'] = days();
                $datos['meses'] = month();
                $datos['horas'] = hours();
                $datos['amigos'] = $this->planUsuario->get_friends($usuarios->id);
                $datos['edad'] = edad_usuario($usuarios->edad);
                $datos['localidad'] = $this->planUsuario->data_location($usuarios->ciudad);
                if($personales->relaciones != ''){
                    $datos['personal'] = $this->planUsuario->estado_civil($usuarios->id);
                }else{
                    $datos['personal'] = null;
                }
                
                echo "<img src=".base_url().$datos['imagenRuta']."  width='140' height='140'/>";
                echo "<input type='hidden' name='Planes[planImagenId]' id='planImagen' value='".$datos['idImagen']."'/>";
                }
        }
    }

    /**
     * Metodo que se usa para eliminar los comentarios subsecuentes del
     * post principal, con el cual el usuario podra eliminar los posts
     * que ya no quieran en su comentario
     *
     * @params int id del plan
     * @parmas int id del subcomentario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments($idP)
    {
        $this->planUsuario->delete_subcomments($idP);
    }
    
    public function calendario_usuarios($id=null)
    {   
        if(!isset($id)){
          $id=$this->session->userdata('id');  
        }
        //Año Mes anterior!
        if(isset ($_POST['antMes']) && $_POST['anioA'] ){
           
            if($_POST['antMes']<1){

                $_POST['antMes']=12;
                $_POST['anioA']=$_POST['anioA']-1;
             }

            $datos['anioNuevo']=$_POST['anioA']; 
            $datos['mesNuevo']=$_POST['antMes'];
            $datos['id_usuario'] = $id;
            if($id==$this->session->userdata('id')){
               //$datos['eventosCU']=$this->planUsuario->get_plan_calendarioUsuario($id);
               $datos['eventosC']=$this->planUsuario->get_plan_calendarioYo($id);
                foreach($datos['eventosC'] as $cumple):
                    $cort=explode('-', $cumple->planfechaCalendario);
                    $cumple->planfechaCalendario = date('Y').'-'.$cort[1].'-'.$cort[2];
                endforeach;
            }else{
            $datos['eventosC']=$this->planUsuario->get_plan_calendario($id);//$this->session->userdata('id'));
            }
            $this->load->view('planesusuarios/calendario',$datos);
        
            
        //Año Me Siguiente!    
        }else if(isset ($_POST['sigMes']) && $_POST['anioS']){
                
            if($_POST['sigMes']>12){

                $_POST['sigMes']=1;
                $_POST['anioS']=$_POST['anioS']+1;
            }
            $datos['anioNuevo']=$_POST['anioS'];
            $datos['mesNuevo']=$_POST['sigMes'];
            $datos['id_usuario'] = $id;
            if($id==$this->session->userdata('id')){
               //$datos['eventosCU']=$this->planUsuario->get_plan_calendarioUsuario($id);
               $datos['eventosC']=$this->planUsuario->get_plan_calendarioYo($id);
                foreach($datos['eventosC'] as $cumple):
                    $cort=explode('-', $cumple->planfechaCalendario);
                    $cumple->planfechaCalendario = date('Y').'-'.$cort[1].'-'.$cort[2];
                endforeach;
            }else{
            $datos['eventosC']=$this->planUsuario->get_plan_calendario($id);//$this->session->userdata('id'));
            }
            $this->load->view('planesusuarios/calendario',$datos);
                
        }else{
            $datos['id_usuario'] = $id;
            if($id==$this->session->userdata('id')){
                //$datos['eventosCU']=$this->planUsuario->get_plan_calendarioUsuario($id);
                $datos['eventosC']=$this->planUsuario->get_plan_calendarioYo($id);
                foreach($datos['eventosC'] as $cumple):
                    $cort=explode('-', $cumple->planfechaCalendario);
                    $cumple->planfechaCalendario = date('Y').'-'.$cort[1].'-'.$cort[2];
                endforeach;
            }else{
            $datos['eventosC']=$this->planUsuario->get_plan_calendario($id);//$this->session->userdata('id'));
            }
            $this->load->view('planesusuarios/calendario',$datos);
        }
    }

    /**
     * Metodo que se usa para poder guardar los comentarios de un pulzo, reto 
     * o de una experiencia de vida para que el usuario o la empresa puedan 
     * comenzar a debatir sobre las promociones que este mismo esta creado para 
     * que los usuarios las aprovechen
     *
     * @params int id del pulzo, reto, experiencia del negocio
     * @params int id del usuario que esta posteando
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function subcomentarios_pulzos_post($idP, $idN, $idU)
    {
        $comentarios = $this->input->post('comentar_muro');
        $post = array('comentarioTexto'=>$comentarios,
                      'comentarioNegocioId'=>$idN,
                      'comentarioUsuarioId'=>$idU,
                      'comentarioPulzoId'=>$idP,
                      'comentarioFechaCreacion'=>time());
        $this->planUsuario->save_subcomment_datas($post);
    }

    /**
     * Metodo que se usa para poder eliminar los datos pulzos,
     * junto con todos los registros que tenga el mismo como
     * son comentarios, planes y pulzos
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_pulzos($id)
    {
        $this->planUsuario->delete_pulzos($id);
        $this->planUsuario->delete_planes($id);
        $this->planUsuario->delete_comments_one($id);
    }

    /**
     * Metodo que se usa para borrar los comentarios de los pulzos, los
     * cuales ya no sirven una vez que se elimina el post principal y 
     * solo nos generaria basura
     *
     * @params int id del pulzo comentario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_comentarios_pulzos($id, $idPlan)
    {
        $this->planUsuario->delete_pulzos($id);
        $this->planUsuario->delete_planes($id);
        $this->planUsuario->delete_subcomments_one($idPlan);
    }

    /**
     * Metodo que se usa para poder recargar la parte de comentarios
     * esto para que no se recargue toda la pagina sino solo los comentarios
     * que se tienen de la publicacion en la cual se esta llevando la
     * accion
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_comment($id_plan)
    {
        $datos['planes'] = $this->planUsuario->get_simple_plain($id_plan);
        $this->load->view('planesusuarios/reload_comments', $datos);
    }

    /**
     * Metodo que se us apara poder recargar la parte de comentarios
     * esto para que no se recargue toda la pagina sino solo los comentarios
     * que se tienen en la publicacion en la cual se esta llevando la accion
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_comment_company($id_plan)
    {
        $datos['planes'] = $this->planUsuario->get_simple_plain($id_plan);
        $this->load->view('planesusuarios/reload_comments_company', $datos);
    }

    /**
     * Metodo que se usa para borrar los comentarios del muro del usuario asi como
     * del scribble que es de donde originalmente provienen, esto para que si el usuario
     * no quiere tener un comentario en su muro que haya puesto solo lo elimina y lo
     * elimina tambien del lugar donde lo haya posteado asi como los comentarios hijos
     * que el mismo tenga
     *
     * @params int id del plan
     * @params int id del comentarioScr
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_comentario_negocio($idP, $idS)
    {
        $total = $this->planUsuario->count_all_data($idP);
        if($total != 0)
        {
            $this->planUsuario->delete_comments($idP);
        }
        $this->planUsuario->delete($idP);
        $this->planUsuario->delete_scribble_main($idS);
        $this->planUsuario->delete_scribble_son($idS);
    }
}

