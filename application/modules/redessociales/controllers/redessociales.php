<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Modulo que se usa para obtener los permisos a las diversas
 * redes sociales que se tendran en la plataforma para que
 * se puedan postear lo que se escribe en pulzos a facebook,
 * twitter, foursquare, google + etc
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, Sep 21, 2011
 * @package redessociales
 **/
class redesSociales extends MX_Controller{

    /**
     * Metodo constructor en el cual se dara la inicializacion
     * o la declaracion de las librerias, helpers o modelo que se
     * usaran en este modulo para ciertas funcionalidades
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation', 'user_agent'));
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'status', 'date', 'counters', 'emails'));
        $this->load->model('redSocial', '', TRUE);
    }

    /**
     * Metodo que se usa para poder obtener los datos de los usuarios que
     * quieran ligar su cuenta de pulzos con facebook y asi obtener sus
     * tokens y poder guardarlos en la base de datos
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        redirect('redessociales/red_social/'.$id);
    }

    /**
     * Metodo que se usa para poder guardar las redes sociales, antes era
     * el index pero como facebook es muy delicado pues no nos deja por delicado
     * la mamada
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function red_social($id)
    {

        //SE CARGA LA LIBRERIA DEL PAQUETE

        $this->load->add_package_path(APPPATH.'third_party/social_media_user/');
        $this->load->library('facebooklib2'); //PARTE NUEVA

        //OBTENER AL ACTUAL USUARIO Y GENERAR UN LINK DE SOLICITUD DE EXISTENCIA

        $user_link = $this->facebooklib2->get_user();

        if($this->tweet->logged_in())
        {
            $tokens = $this->tweet->get_tokens();
            $flag = True;
        }
        else
        {
            $tokens = array();
            $flag = False;
        }
        
        $arreglo_pass = array(
            'user_link'=>$user_link,
            'facebook'=>$this->facebooklib2,
            'tokens'=>$tokens,
            'flag'=>$flag,
            'id'=>$id
        );
        
        //se carga la vista
        $this->load->view('redessociales/index');//, $arreglo_pass);
    }

    public function red_social_new($id=null)
    {

        //SE CARGA LA LIBRERIA DEL PAQUETE
        $this->load->add_package_path(APPPATH.'third_party/social_media/');
        $this->load->library('facebooklib');

        //OBTENER AL ACTUAL USUARIO Y GENERAR UN LINK DE SOLICITUD DE EXISTENCIA
        $user_link = $this->facebooklib->get_user();
        if($this->tweet->logged_in())
        {
            $tokens = $this->tweet->get_tokens();
            $flag = True;
        }
        else
        {
            $tokens = array();
            $flag = False;
        }
        
        $arreglo_pass = array(
            'user_link'=>$user_link,
            'facebook'=>$this->facebooklib,
            'tokens'=>$tokens,
            'flag'=>$flag,
            'id'=>$id
        );
        
        //se carga la vista
        $this->load->view('redessociales/pruebas', $arreglo_pass);
    } 

    /**
     * Metodo que se usa para obtener los links de donde se
     * redireccionara el twitter para que el mismo pueda llevarte a la
     * aplicacion y obtener los access tokens que se necesitan para
     * poder ligarlos con la cuenta de pulzos y se postie al momento
     * de que se haga el money back
     *
     * @return string oauths de twitter
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_twitter_tokens()
    {
        if($this->tweet->logged_in())
        {
           
            redirect('negocios/perfil');

        }
        $this->tweet->set_callback(site_url('negocios/perfil'));
        $this->tweet->login();
    }

    /**
     * Metodo que se usa para poder guardar los datos
     * de los usuarios en lo que se refiere a social media
     * para que cuando se ligue su cuenta en lo que se refiere a 
     * sus redes sociales, ademas de que se usa para guardar los datos
     * de las ofertas haciendo el proceso completo en un solo paso
     * para evitar tantas cosas tediosas para el usuario
     *
     * @params int id del negocio
     * @params int bandera conocer si es nuevo o actualizar datos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar($id, $band)
    {
        $post = $this->input->post('Redes');
        $post2 = $this->input->post('Oferta');
        if($band == 0)
        {

                $post['socialEmpresaUsuarioId'] = $id;

                $val = $this->redSocial->save_tokens_company($post);

                //parte para guardar las ofertas
                $post2['idNegocioOferta'] = $id;
                $post2['idMensajeOferta'] = $val;
                $post2['tipoDescuento'] = '1';
                $return = $this->redSocial->save_ofert($post2);
                foreach($_POST['Productos'] as $texto)
                {
                    if($texto != '')
                    {
                        $data = array('product_category'=>$texto,
                                      'idOfertas'=>$return);
                        $this->redSocial->save_products($data);
                    }
                }
        
                if(!empty($_POST['Categorias']))
                {
                    foreach($_POST['Categorias'] as $categorias)
                    {
                        if($categorias != '')
                        {
                            $data = array('product_category'=>$categorias,
                                          'idOfertas'=>$return);
                            $this->redSocial->save_products($data);
                        }
                    }
                }
        }
        else
        {
            //ACTUALIZAR LOS DATOS DE LAS OFERTAS
            $ids_ofertas = $this->redSocial->get_data_current($id);
            $this->redSocial->update_data_company($post, $ids_ofertas->idMensajeOferta);
            $post2['idNegocioOferta'] = $id;
            $post2['idMensajeOferta'] = $ids_ofertas->idMensajeOferta;
            $post2['tipoDescuento'] = '1';
            $this->redSocial->update_data_oferts($post2, $ids_ofertas->ofertaId);
            if($post2['tipoDescuento'] == 1)
            {
                $this->redSocial->delete_products_category($ids_ofertas->ofertaId);
            }
            if($post2['tipoDescuento'] == 2)
            {
                $this->redSocial->delete_products_category($ids_ofertas->ofertaId);
                foreach($_POST['Productos'] as $texto)
                {
                    if($texto != '')
                    {
                        $data = array('product_category'=>$texto,
                                      'idOfertas'=>$ids_ofertas->ofertaId);
                        $this->redSocial->update_products_category($data);
                    }
                }
            }
            if($post2['tipoDescuento'] == 3)
            {
                $this->redSocial->delete_products_category($ids_ofertas->ofertaId);
                foreach($_POST['Categorias'] as $categorias)
                {
                    if($categorias != '')
                    {
                        $data = array('product_category'=>$categorias,
                                      'idOfertas'=>$ids_ofertas->ofertaId);
                        $this->redSocial->update_products_category($data);
                    }
                }
            }
        }
       
    }




    /**
     * Se obtienen los tokens de los usuarios por medio de twitter con la
     * cual los usuarios podran obtener los valores para poder postear en
     * twitter y que aparesca la promocion que se tenga en la parte de los
     * usuarios
     *
     * @return void
     * @author
     **/
    public function get_twitter_tokens_bonficacionU()
    {
        if($this->tweet->logged_in())
        {
            $var = "http://www.pulzos.com/redessociales/";
            redirect($var);

        }
        $var = "http://www.pulzos.com/redessociales/";
        $this->tweet->set_callback($var);
        $this->tweet->login();
    }


    public function post_social_media($id, $id_oferta, $id_bonificacion)
    {
        echo "hola porque no entra: " . $id . ' ' . $id_oferta . ' ' . $id_bonificacion;
        $datos = $this->redSocial->get_data_post($id);
        $ofertas = $this->redSocial->get_data_offerts($id_oferta);
        $mensajes = $this->redSocial->get_data_promotion($ofertas->idMensajeOferta);

        //POST TO FACEBOOK
        $this->load->add_package_path(APPPATH.'third_party/social_media_user/');
       
        $this->load->library('facebooklib2');

        /** INICIO A LA NUEVA FORMA DE POSTEAR **/
        if(!empty($datos->tokenFacebook))
        {
            $val_geotag = get_geotag_data($id_oferta);
            $link_post = $this->redSocial->get_data_links_socialmedia($val_geotag->geotagGId);
            if($link_post->scribbleAnexos != '0')
            {
                $this->facebooklib2->post_wall_new($datos->tokenFacebook, $mensajes->mensajeFacebook, $link_post->scribbleAnexos);
            }
            else
            {
                $this->facebooklib2->post_wall_new($datos->tokenFacebook, $mensajes->mensajeFacebook);
            }
        }
        /** FIN A LA NUEVA FORMA DE POSTEAR **/

        //TWITTER POST
        if(!empty($datos->twitter_oauth) && !empty($datos->twitter_oauth_secret))
        {
            $mensaje_complete_twitter = $mensajes->mensajeTwitter . ' #Pulzos';
            $this->tweet->set_tokens(array('oauth_token'=>$datos->twitter_oauth,
                                           'oauth_token_secret'=>$datos->twitter_oauth_secret));
            $resultados = $this->tweet->call('post', 'statuses/update', array('status'=>$mensaje_complete_twitter));
        }
        $mensaje_complete = $mensajes->mensajeTwitter . ' #Pulzos';
        $this->redSocial->update_bonifications_status($id_bonificacion);

        //PARTE DE VALIDACION DE MENSAJES
        if($mensajes->mensajeFacebook != '')
        {
            $mensajePulzos = $mensajes->mensajeFacebook;
        }
        else
        {
            $mensajePulzos = $mensajes->mensajeTwitter;
        }

        //PARTE DE PUBLICACION EN MURO DE PULZOS
        $valoresPublicacion = array('planUsuarioId'=>$id,
                                    'planTipo'=>'1',
                                    'planDescripcion'=>$mensajePulzos,
                                    'planFechaCreacion'=>time());

        $this->redSocial->insert_post_in_wall($valoresPublicacion);
       
        $comisionesRecibidas = $this->redSocial->get_all_data_bonifications_company($id_bonificacion);

        $valor1 = $comisionesRecibidas->moneyBackOtorgado * 2.8;
        $valor2 = $valor1/100;
        $fechaTransaccion = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $timestamp = date('dmYHis');
        $nombre_empresa = get_name_company($comisionesRecibidas->moneyNegocioId);
        $transaccion = reference_number($nombre_empresa->negocioNombre,$timestamp);

        //INSERTAR O ACTUALIZAR EN LA PARTE DEL HISTORIAL
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        if($mes == '02') //FEBRERO
        {
            $ab = date('L');
            if($ab == '1')
            {
                $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
                $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin1 = mktime(0, 0, 0, date('m'), 29, date('Y'));
            }
            else
            {
                $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
                $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin1 = mktime(0, 0, 0, date('m'), 28, date('Y'));
            }
        }
        if(($mes == '04') || ($mes == '06') || ($mes == '09') || ($mes == '11')) //ABRIL, JUNIO, SEPTIEMBRE, NOVIEMBRE
        {  
            $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
            $fechaFin1 = mktime(0, 0, 0, date('m'), 30, date('Y'));
        }
        if(($mes == '01') || ($mes == '03') || ($mes == '05') || ($mes == '07') || ($mes == '08') || ($mes == '10') || ($mes == '12'))
        { //ENERO, MARZO, MAYO, JULIO, AGOSTO, OCTUBRE, DICIEMBRE
            $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
            $fechaFin1 = mktime(0, 0, 0, date('m'), 31, date('Y'));
        }
    
        if($dia >= 0 && $dia <= 15)
        {
            $contador = $this->redSocial->count_all_register_history($ofertas->idNegocioOferta, $fechaIni, $fechaFin);
            if($contador != 0)
            {
                $registros_history = $this->redSocial->get_data_history_row($ofertas->idNegocioOferta, $fechaIni, $fechaFin);
                $valor_id = $registros_history->idHistorial;
                $totalUpdate = $registros_history->historialTotalQuincenal + $comisionesRecibidas->moneyBackOtorgado;
                $this->redSocial->update_data_history($totalUpdate,$valor_id);//$id
            }
            else
            {
                $new_history = array('historialEmpresaId'=>$ofertas->idNegocioOferta,
                                     'historialTotalQuincenal'=>$comisionesRecibidas->moneyBackOtorgado,
                                     'historialStatusDeposito'=>'0',
                                     'historialFechaInicio'=>$fechaIni,
                                     'historialFechaFin'=>$fechaFin);
                $valor_id = $this->redSocial->saveNew_history($new_history);
            }
        }
        elseif($dia >= 16 && $dia <=30)
        {
            $contador = $this->redSocial->count_all_register_history($ofertas->idNegocioOferta, $fechaIni1, $fechaFin1);
            if($contador != 0)
            {
                $registros_history = $this->redSocial->get_data_history_row($ofertas->idNegocioOferta, $fechaIni1, $fechaFin1);
                $valor_id = $registros_history->idHistorial;
                $totalUpdate = $registros_history->historialTotalQuincenal + $comisionesRecibidas->moneyBackOtorgado;
                $this->redSocial->update_data_history($totalUpdate,$valor_id);//$id);
            }
            else
            {
                $new_history = array('historialEmpresaId'=>$ofertas->idNegocioOferta,
                                     'historialTotalQuincenal'=>$comisionesRecibidas->moneyBackOtorgado,
                                     'historialStatusDeposito'=>'0',
                                     'historialFechaInicio'=>$fechaIni1,
                                     'historialFechaFin'=>$fechaFin1);
                $valor_id = $this->redSocial->saveNew_history($new_history);
            }
        }

        //PARTE DE LA COMISION
        $comisiones = array('comisionRecibidaEmpresaId'=>$comisionesRecibidas->moneyNegocioId,
                            'comisionRecibidaUsuarioId'=>$comisionesRecibidas->usuarioMoneyUsuarioId,
                            'comisionRecibidaFolioTransaccion'=>$comisionesRecibidas->moneyFolioFactura,
                            'comisionRecibidaUsuarioBonificacion'=>$comisionesRecibidas->usuarioMoneyTotal,
                            'comisionRecibidaBonificacionZavor'=>$valor2,
                            'comisionRecibidaNumeroReferencia'=>$transaccion,
                            'comisionRecibidaFechaTransaccion'=>$fechaTransaccion,
                            'comisionRecibidaHistorialId'=>$valor_id,
                            'fechaDepositoComisionUsuario'=>'0');
        $comision_usuario = $this->redSocial->insert_revenues($comisiones);

        //OBTENER LOS DATOS DE LA PRIMER BITACORA
        $bitacoraUnoData = $this->redSocial->get_bitacora_data($id_bonificacion);
        //PARTE DONDE SE GUARDA LA INFORMACION DE LA BITACORA DE PUBLICACION
        $public_bita = array('bitacoraDosUsuarioAcepta'=>$bitacoraUnoData->bitacoraUsuarioEnviaId,
                             'bitacoraDosUsuarioPublica'=>$bitacoraUnoData->bitacoraUsuarioRecibeId,
                             'bitacoraDosMsjFb'=>$mensajes->mensajeFacebook,
                             'bitacoraDosMsjTw'=>$mensaje_complete,
                             'bitacoraDosOfertaId'=>$id_oferta,
                             'bitacoraDosMoneyUsuario'=>$id_bonificacion,
                             'bitacoraDosBitacoraUno'=>$bitacoraUnoData->bitacoraId,
                             'bitacoraDosFechaPublicacion'=>date('Y-m-d H:i:s'),
                             'BitacoraDosComisionRecibidaUsuario'=>$comision_usuario);
        $this->redSocial->save_bitacora_dos($public_bita);

        //SEND THE EMAIL FOR THE COMPANY AND THE EMPLOYEE
        $bonificacion_datos = get_data_bonification_data($id_bonificacion);
        $check = get_status_user($bonificacion_datos->inboxnUsuarioRecibeId);
        if($check == 0) //THE STATUS IS FOR USER
        {
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET DATA FOR SEND EMAIL EMPLOYEE AND COMPANY
            $datos_company_email = get_data_company($bonificacion_datos->inboxnUsuarioId); 
            $template_email_company = notificate_user_to_company($datos_company_email->negocioNombre,
                                                                 get_complete_username($bonificacion_datos->inboxnUsuarioRecibeId),
                                                                 $comisionesRecibidas->moneyFolioFactura,
                                                                 $comisionesRecibidas->moneyMontoConsumo,
                                                                 $comisionesRecibidas->moneyBackOtorgado);

            //SEND EMAIL TO COMPANY
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_company_email->negocioEmail, $datos_company_email->negocioNombre);
            $this->email->subject('Bonificacion aceptada.');
            $this->email->message($template_email_company);
            $this->email->send();
        }
        else //THE STATUS IS FOR COMPANY
        {
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET DATA FOR SEND EMAIL USERS AND EMPLOYEE
            $datos_company_email_send = get_data_company($bonificacion_datos->inboxnUsuarioRecibeId);
            $datos_usuarios_email_send = get_complete_userdata($bonificacion_datos->inboxnUsuarioId);
            $template_email_users = notificate_company_to_user(get_complete_username($bonificacion_datos->inboxnUsuarioId),
                                                               get_complete_username($bonificacion_datos->inboxnUsuarioRecibeId), 
                                                               $comisionesRecibidas->moneyFolioFactura,
                                                               $comisionesRecibidas->moneyMontoConsumo,
                                                               $comisionesRecibidas->moneyBackOtorgado);

            //SEND EMAIL TO USER
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_usuarios_email_send->email, get_complete_username($datos_usuarios_email_send->id));
            $this->email->subject('Bonificacion aceptada.');
            $this->email->message($template_email_users);
            $this->email->send();
        }

        //SAVE DATA FOR IE
        $data_ie = array('bonificacionIeUsuario'=>$id,
                         'bonificacionIePlan'=>$id_oferta,
                         'bonificacionIeFolioFactura'=>$comisionesRecibidas->moneyFolioFactura);
        $this->redSocial->save_bonification_ie($data_ie);


    }

    /**
     * Metodo que se encarga de redireccion y cargar las vistas de las
     * redes sociales las cuales se haran en un archivo externo a la maquetacion
     * inicial para evitar que tengamos problemas cuando se acepta facebook y
     * twitter
     *
     * @return pagina anterior
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function redes_sociales_usuarios($id1=null)
    {
        $id = $this->session->userdata('id');
        $data_type = $this->redSocial->data_name($this->session->userdata('id'));
        //SE CARGA LA LIBRERIA DEL PAQUETE

            $this->load->add_package_path(APPPATH.'third_party/social_media_user/');

            $this->load->library('facebooklib2'); //PARTE NUEVA

        //OBTENER AL ACTUAL USUARIO Y GENERAR UN LINK DE SOLICITUD DE EXISTENCIA
        $user_link = $this->facebooklib2->get_user();
        if($this->tweet->logged_in())
        {
            $tokens = $this->tweet->get_tokens();
            $flag = True;
        }
        else
        {
            $tokens = array();
            $flag = False;
        }
        
        //NOTIFICACIONES DE LOS USUARIOS EN EL HEADER
        $datos['inboxT'] = $this->redSocial->inbox_total($this->session->userdata('id'), '1');
        $datos['notificaciones'] = $this->redSocial->get_all_notifications($this->session->userdata('id'));
        // SE COMENTAR POR EL MOMENTO ESTA LINEA HASTA PROXIMO AVISO   
        $datos['notificacion'] = $this->redSocial->get_notifications($this->session->userdata('id'));
        //PARA EL HEADER QUE NO CAMBIE USUARIO
        $usuarioSesion = $this->redSocial->data_name($this->session->userdata('id'));
        $datos['usuarios2'] = $usuarioSesion;
        $datos['localidades2'] = $this->redSocial->data_location($usuarioSesion->ciudad);  

        $arreglo_pass = array(
            'user_link'=>$user_link,
            'facebook'=>$this->facebooklib2,
            'tokens'=>$tokens,
            'flag'=>$flag,
            'id'=>$id,
            'tipo_usuario'=>$data_type
        );
		$redes = $this->redSocial->get_data_user($this->session->userdata('id'));
		if($redes->statusEU == 0)
		{
			$header = $this->load->view('usuarios/header_login4', $datos, TRUE);
            $content = $this->load->view('redessociales/social_user', $arreglo_pass, TRUE);
		}
		else
		{

            $header = $this->load->view('negocios/header_login2',$datos, TRUE);
            $content = $this->load->view('redessociales/social_user', $arreglo_pass, TRUE);
        }
        //se carga la vista
        $this->load->view('main/template', array('header'=>$header,
            'content'=>$content));
    }

    /**
     * Metodo que se usa para guardar los datos de los 
     * tokens que se tienen de parte del usuario para que
     * este pueda guardarlos al momento de aceptar las aplicaciones
     * de las redes sociales
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/

    public function guardar_t1($id)
    {
        $post = $this->input->post('Redes');
        $post['socialUsuarioId'] = $id;
        var_dump($post);
        $total = count_number_social_data_user($id);
        echo "hello: " . $total;
        if($total != 0)
        {
            echo "hola";
            $this->redSocial->update_data_user($post, $id);
        }
    }

    public function guardar_tokens($id)
    {	
        $post = $this->input->post('Redes');
        $post['socialUsuarioId'] = $id;
        $total = count_number_social_data_user($id);
        if($total == 0)
        {
            // forma nueva de guardar tokens de facebook
            if(empty($post['tokenFacebook']))
            {
                $post['uidFacebook'] = '';
                $post['tokenFacebook'] = '';
            }
            if(!empty($post['tokenFacebook']))
            {
                $post['uidFacebook'] = '';
            }
            //forma nueva en estado fin
            if(empty($post['twitter_oauth']) && empty($post['twitter_oauth_secret']))
            {
                $post['twitter_oauth'] = '';
                $post['twitter_oauth_secret'] = '';
            }
            $this->redSocial->save_tokens_user($post);
		    redirect(''.base_url().'index.php/usuarios/perfil#'.base_url().'index.php/money/index/'.$this->session->userdata('id'));
        }
        else
        {
            $this->redSocial->update_data_user($post, $id);
			redirect(''.base_url().'index.php/usuarios/perfil#'.base_url().'index.php/money/index/'.$this->session->userdata('id'));
        }
    }

    /**
     * Metodo que se usa para guardar los tokens de los negocios, esto para añadirlo com
     * una nueva red social ligada a su perfil, pues en un futuro a la mejor se podra postear
     * en sus muros directamente de pulzos pero por ahora se hace para poder habilitar sus
     * promociones, en caso de que no agreguen red social no podran habilitar sus promociones
     *
     * @params int id del negocio como negocio
     * @return void
     * @author bkackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_company_tokens($id)
    {
        $post = $this->input->post('Redes');
        if($post)
        {
            $valor = $this->redSocial->count_number_register($id);
            if($valor == 0)
            {
                $post['socialEmpresaUsuarioId'] = $id;
                $this->redSocial->save_tokens_company($post);
				redirect(''.base_url().'index.php/negocios/perfil');
            }
            else
            {
                $this->redSocial->update_data_company($post, $id);
				redirect(''.base_url().'index.php/negocios/perfil');
            }
        }
    }

    /**
     * Metodo que se usa para poder realizar los datos que se
     * necesitan para mostrar el formulario de los mensajes en
     * las redes sociales y las ofertas que se llevaran acabo
     * para las promociones que haran
     *
     * @params int id de los comentarios (NULL)
     * @params int id la oferta (NULL)
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function primer_formulario($id1 = null, $id2 = null)
    {
        if(empty($id1) && empty($id2))
        {
            $datos['band'] = 0;
            $this->load->view('redessociales/creacion_datos', $datos);
        }
        else
        {
            $datos['band'] = 1;
            $datos['social_media'] = $this->redSocial->get_data_socialMedia($id1);
            $datos['oferta_negocio'] = $this->redSocial->get_data_socialOferta($id2);
            $this->load->view('redessociales/creacion_datos', $datos);
        }
    }

    /**
     * Metodo que se usa para la vista de los datos que se
     * han ingresado para darle la vista al usuario una vez
     * que ya haya llenado todos los campos del mismo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function segunda_vista()
    {
        $this->load->view('redessociales/vista_forma');
    }

    /**
     * Metodo que se usa para actualizar los valores de la activacion
     * de la oferta que esta creando el usuario una vez que este lo
     * haya aceptado como la dejo, en caso de que quede en cero, la oferta
     * no estara activa para que los clientes puedan hacer sus bonificaciones
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function actualizar_datos($id)
    {
        $this->redSocial->update_all_status_promo($this->session->userdata('idN'), '2');
        $this->redSocial->update_status_promo($id, '1');
    }

    /**
     * Metodo que se usa para poder realizar la vista de todas las ofertas activas que se
     * tienen actualmente por la empresa, esto para que vea cuales son las bonificaciones que
     * tendra que dar o por si quiere eliminar una promocion que ya no este vigente o que
     * la quiera cambiar
     *
     * @params int id del negocio como negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ofertas_activas($id)
    {
        $datos['informacion'] = $this->redSocial->get_information_promotions($id);
        $this->load->view('redessociales/ofertas_activas', $datos);
    }

    /**
     * Metodo que se usa para poder eliminar todos los registros de las ofertas con los cuales
     * ya no se podran ver pues en lugar de eliminar solo se cambiara por el momento de status
     * a 2 para que estos puedan despues mostrar en estadisticas de los negocios y asi desde el
     * inicio tener sus promociones
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function eliminar_oferta($id)
    {
        $valores = $this->redSocial->get_data_geooffert($id);
        $valores2 = $this->redSocial->get_data_planusergeo($valores->geotagGId);
        $this->redSocial->delete_data_showing('planesusuarios', 'planId', $valores2->planId);
        $this->redSocial->delete_data_showing('scribbles_comments', 'scribbleId', $valores2->planScribbleId);
        $this->redSocial->delete_data_showing('pulzos', 'pulzoId', $valores2->planEmpresaPulzoId);
        $this->redSocial->delete_offert($id);

    }

    /**
     * Metodo que se usa para poder obtener los datos de las ofertas que han sido creadas por parte 
     * del negocio desde el pulzos geotagging, por este medio se podra saber si se activa una oferta
     * de nueva cuenta, se desactiva, o se elimina la misma por parte de la cual se puede realizar
     * este proceso de administracion de ofertas activas
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ofertas($id)
    {
        $datos['ofertas'] = $this->redSocial->get_all_data_promotions($id);
        $this->load->view('redessociales/ofertas', $datos);
    }

    /**
     * Metodo que se usa para poder actualizar las ofertas de los negocios en las cuales seran desactivadas
     * para que los usuarios ya dejen de visualizar la oferta, mas bien que deje de estar activa la oferta que
     * el negocio ya no desea tener activa y por lo tanto no se podran hacer bonificaciones con la misma
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function desactivar_oferta($id)
    {
        $geotag = get_geotag_data($id);
        $this->redSocial->update_ofert_desactivate($id);
        $this->redSocial->update_status_scribble($geotag->geotagGId, '2');
    }

    /**
     * Metodo que se usa para poder actualizar las ofertas de los negocios en las cuales sera activadas de
     * nueva cuenta para que los usuarios puedan volver a visualizar la oferta, mas bien que deje de estar
     * desactivada la oferta que el negocio ya no la desea tener desactivada y por lo tanto ya podran hacer las
     * bonificaciones necesarias los usuarios
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function activar_oferta($id)
    {
        $geotag = get_geotag_data($id);
        $this->redSocial->update_ofert_activate($id);
        $this->redSocial->update_status_scribble($geotag->geotagGId, '1');
    }

    /**
     * Metodo que se usa para poder eliminar los tokens de facebook y asi
     * el usuario pueda desligar su facebook de la plataforma pulzos y esta
     * dejar de publicar ofertas en la misma
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_facebook($id)
    {
        
        $this->redSocial->delete_facebook_tokens($id);
    }

    /**
     * Metodo que se usa para poder realizar el proceso de borrar los
     * datos de twitter que esten ligados del usuario, esto para que
     * los usuarios eviten que se publiquen mensajes en twitter
     * desde la plataforma pulzos
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_twitter($id)
    {
        $this->redSocial->delete_twitter_tokens($id);
    }

    
    /**
     * Method where the system call once type all the data required
     * by the user and send some data for post in the part of the
     * socil network the promotion message. This part is necesary for
     * finish all the data
     *
     * @params int id
     * @params int id oferta
     * @params int id bonificacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function post_social_media_2($id, $id_oferta, $id_bonificacion)
    {
        //echo "hola porque no entra: " . $id . ' ' . $id_oferta . ' ' . $id_bonificacion;
        $datos = $this->redSocial->get_data_post($id);
        //var_dump($datos);
        $ofertas = $this->redSocial->get_data_offerts($id_oferta);
        /*echo "<br />";
        var_dump($ofertas);*/
        $mensajes = $this->redSocial->get_data_promotion($ofertas->idMensajeOferta);
        /*echo "<br />";
        var_dump($mensajes);*/

        //GET THE COMPANY DATA
        $dataBitacoraCompany = $this->redSocial->get_data_company_by_id($ofertas->idNegocioOferta); 
        //PART WHERE SAVE THE INBOX OF THE USER
        $inbox = array('inboxnUsuarioId'=>$ofertas->idNegocioOferta,
                       'inboxnUsuarioRecibeId'=>$id,
                       'inboxnMensaje'=>'Your discount was apply to your total.',
                       'inboxnAsunto'=>'Discount',
                       'inboxnStatus'=>'0',
                       'inboxnFecha'=>time(),
                       'inboxnMoneyUser'=>0,//'variable del deuscuetno a aplicar',
                       'inboxnOfertaId'=>$ofertas->ofertaId,
                       'inboxnConversacionId'=>'0',
                       'inboxnMoneyStatus'=>1);
        $idInboxId = $this->redSocial->save_inbox_default($inbox);

        //POST TO FACEBOOK
        $this->load->add_package_path(APPPATH.'third_party/social_media_user/');
       
        $this->load->library('facebooklib2');

        /** INICIO A LA NUEVA FORMA DE POSTEAR **/
    /*    if(!empty($datos->tokenFacebook))
        {
            $val_geotag = get_geotag_data($id_oferta);
            //var_dump($val_geotag);
            @$link_post = $this->redSocial->get_data_links_socialmedia($val_geotag->geotagGId);
            //var_dump($link_post);
            if(@$link_post->scribbleAnexos != '0')
            {
                $this->facebooklib2->post_wall_new($datos->tokenFacebook, $mensajes->mensajeFacebook, @$link_post->scribbleAnexos);
            }
            else
            {
               // echo $mensajes->mensajeFacebook;
                $this->facebooklib2->post_wall_new($datos->tokenFacebook, $mensajes->mensajeFacebook);
            }
        }   */
        /** FIN A LA NUEVA FORMA DE POSTEAR **/

        //TWITTER POST
      /*  if(!empty($datos->twitter_oauth) && !empty($datos->twitter_oauth_secret))
        {
            $mensaje_complete_twitter = $mensajes->mensajeTwitter . ' #Pulzos';
            $this->tweet->set_tokens(array('oauth_token'=>$datos->twitter_oauth,
                                           'oauth_token_secret'=>$datos->twitter_oauth_secret));
            $resultados = $this->tweet->call('post', 'statuses/update', array('status'=>$mensaje_complete_twitter));
        } */
        $mensaje_complete = $mensajes->mensajeTwitter . ' #Pulzos';
        $this->redSocial->update_bonifications_status($id_bonificacion);

        //PARTE DE VALIDACION DE MENSAJES
        if($mensajes->mensajeFacebook != '')
        {
            $mensajePulzos = $mensajes->mensajeFacebook;
        }
        else
        {
            $mensajePulzos = $mensajes->mensajeTwitter;
        }

        //PARTE DE PUBLICACION EN MURO DE PULZOS
        $valoresPublicacion = array('planUsuarioId'=>$id,
                                    'planTipo'=>'1',
                                    'planDescripcion'=>$mensajePulzos,
                                    'planFechaCreacion'=>time());

        $this->redSocial->insert_post_in_wall($valoresPublicacion);

        //UPDATE THE STATUS OF THE USER FOR PERMISSION OF POST
        $valueToUpdate = 0;
        $this->redSocial->update_status_post_user($id, $valueToUpdate);
       
        $comisionesRecibidas = $this->redSocial->get_all_data_bonifications_company($id_bonificacion);

        $valor1 = $comisionesRecibidas->moneyBackOtorgado * 2.8;
        $valor2 = $valor1/100;
        $fechaTransaccion = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $timestamp = date('dmYHis');
        $nombre_empresa = get_name_company($comisionesRecibidas->moneyNegocioId);
        $transaccion = reference_number($nombre_empresa->negocioNombre,$timestamp);

        //INSERTAR O ACTUALIZAR EN LA PARTE DEL HISTORIAL
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        if($mes == '02') //FEBRERO
        {
            $ab = date('L');
            if($ab == '1')
            {
                $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
                $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin1 = mktime(0, 0, 0, date('m'), 29, date('Y'));
            }
            else
            {
                $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
                $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin1 = mktime(0, 0, 0, date('m'), 28, date('Y'));
            }
        }
        if(($mes == '04') || ($mes == '06') || ($mes == '09') || ($mes == '11')) //ABRIL, JUNIO, SEPTIEMBRE, NOVIEMBRE
        {  
            $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
            $fechaFin1 = mktime(0, 0, 0, date('m'), 30, date('Y'));
        }
        if(($mes == '01') || ($mes == '03') || ($mes == '05') || ($mes == '07') || ($mes == '08') || ($mes == '10') || ($mes == '12'))
        { //ENERO, MARZO, MAYO, JULIO, AGOSTO, OCTUBRE, DICIEMBRE
            $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
            $fechaFin1 = mktime(0, 0, 0, date('m'), 31, date('Y'));
        }
    
        if($dia >= 0 && $dia <= 15)
        {
            $contador = $this->redSocial->count_all_register_history($ofertas->idNegocioOferta, $fechaIni, $fechaFin);
            if($contador != 0)
            {
                $registros_history = $this->redSocial->get_data_history_row($ofertas->idNegocioOferta, $fechaIni, $fechaFin);
                $valor_id1 = $registros_history->idHistorial;
                $totalUpdate = $registros_history->historialTotalQuincenal + $comisionesRecibidas->moneyBackOtorgado;
                $this->redSocial->update_data_history($totalUpdate,$valor_id);//$id
            }
            else
            {
                $new_history = array('historialEmpresaId'=>$ofertas->idNegocioOferta,
                                     'historialTotalQuincenal'=>$comisionesRecibidas->moneyBackOtorgado,
                                     'historialStatusDeposito'=>'0',
                                     'historialFechaInicio'=>$fechaIni,
                                     'historialFechaFin'=>$fechaFin);
                $valor_id1 = $this->redSocial->saveNew_history($new_history);
            }
        }
        elseif($dia >= 16 && ($dia <=30 || $dia == 31))
        {
            $contador = $this->redSocial->count_all_register_history($ofertas->idNegocioOferta, $fechaIni1, $fechaFin1);
            if($contador != 0)
            {
                $registros_history = $this->redSocial->get_data_history_row($ofertas->idNegocioOferta, $fechaIni1, $fechaFin1);
                $valor_id1 = $registros_history->idHistorial;
                $totalUpdate = $registros_history->historialTotalQuincenal + $comisionesRecibidas->moneyBackOtorgado;
                $this->redSocial->update_data_history($totalUpdate,$valor_id1);//$id);
            }
            else
            {
                $new_history = array('historialEmpresaId'=>$ofertas->idNegocioOferta,
                                     'historialTotalQuincenal'=>$comisionesRecibidas->moneyBackOtorgado,
                                     'historialStatusDeposito'=>'0',
                                     'historialFechaInicio'=>$fechaIni1,
                                     'historialFechaFin'=>$fechaFin1);
                $valor_id1 = $this->redSocial->saveNew_history($new_history);
            }
        }

        //PARTE DE LA COMISION
        $comisiones = array('comisionRecibidaEmpresaId'=>$comisionesRecibidas->moneyNegocioId,
                            'comisionRecibidaUsuarioId'=>$comisionesRecibidas->usuarioMoneyUsuarioId,
                            'comisionRecibidaFolioTransaccion'=>$comisionesRecibidas->moneyFolioFactura,
                            'comisionRecibidaUsuarioBonificacion'=>$comisionesRecibidas->usuarioMoneyTotal,
                            'comisionRecibidaBonificacionZavor'=>$valor2,
                            'comisionRecibidaNumeroReferencia'=>$transaccion,
                            'comisionRecibidaFechaTransaccion'=>$fechaTransaccion,
                            'comisionRecibidaHistorialId'=>$valor_id1,
                            'fechaDepositoComisionUsuario'=>'0');
       // var_dump($comisiones);
        $comision_usuario = $this->redSocial->insert_revenues($comisiones);
        //echo "hola: " . $comision_usuario;

        //INSERTAR EN BITACORA UNO
        $bitacoraUno = array('bitacoraIbxnId'=>$idInboxId,
                             'bitacoraUsuarioRecibeId'=>$id,
                             'bitacoraUsuarioEnviaId'=>$ofertas->idNegocioOferta,
                             'bitacoraIbxMsj'=>'Discount in the total.',
                             'bitacoraIbxOferta'=>$ofertas->ofertaId,
                             'bitacoraMoneyUsuario'=>0,//variable a usar del descuento,
                             'bitacoraIbxStatus'=>1);
        $idBitacora1 = $this->redSocial->saveBitacoraUno($bitacoraUno);
        //echo 'hola bitacora 1: ' . $idBitacora1;

        //OBTENER LOS DATOS DE LA PRIMER BITACORA
        $bitacoraUnoData = $this->redSocial->get_bitacora_data($idBitacora1);
        //var_dump($bitacoraUnoData);
        //PARTE DONDE SE GUARDA LA INFORMACION DE LA BITACORA DE PUBLICACION
        $public_bita = array('bitacoraDosUsuarioAcepta'=>$bitacoraUnoData->bitacoraUsuarioEnviaId,
                             'bitacoraDosUsuarioPublica'=>$bitacoraUnoData->bitacoraUsuarioRecibeId,
                             'bitacoraDosMsjFb'=>$mensajes->mensajeFacebook,
                             'bitacoraDosMsjTw'=>$mensaje_complete,
                             'bitacoraDosOfertaId'=>$id_oferta,
                             'bitacoraDosMoneyUsuario'=>$id_bonificacion,
                             'bitacoraDosBitacoraUno'=>$bitacoraUnoData->bitacoraId,
                             'bitacoraDosFechaPublicacion'=>date('Y-m-d H:i:s'),
                             'BitacoraDosComisionRecibidaUsuario'=>$comision_usuario);
        $this->redSocial->save_bitacora_dos($public_bita);

        //SEND THE EMAIL FOR THE COMPANY AND THE EMPLOYEE
       /* $bonificacion_datos = get_data_bonification_data($id_bonificacion);
        $check = get_status_user($bonificacion_datos->inboxnUsuarioRecibeId);
        if($check == 0) //THE STATUS IS FOR USER
        {
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET DATA FOR SEND EMAIL EMPLOYEE AND COMPANY
            $datos_company_email = get_data_company($bonificacion_datos->inboxnUsuarioId); 
            $template_email_company = notificate_user_to_company($datos_company_email->negocioNombre,
                                                                 get_complete_username($bonificacion_datos->inboxnUsuarioRecibeId),
                                                                 $comisionesRecibidas->moneyFolioFactura,
                                                                 $comisionesRecibidas->moneyMontoConsumo,
                                                                 $comisionesRecibidas->moneyBackOtorgado);

            //SEND EMAIL TO COMPANY
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_company_email->negocioEmail, $datos_company_email->negocioNombre);
            $this->email->subject('Bonificacion aceptada.');
            $this->email->message($template_email_company);
            $this->email->send();
        }
        else //THE STATUS IS FOR COMPANY
        {
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET DATA FOR SEND EMAIL USERS AND EMPLOYEE
            $datos_company_email_send = get_data_company($bonificacion_datos->inboxnUsuarioRecibeId);
            $datos_usuarios_email_send = get_complete_userdata($bonificacion_datos->inboxnUsuarioId);
            $template_email_users = notificate_company_to_user(get_complete_username($bonificacion_datos->inboxnUsuarioId),
                                                               get_complete_username($bonificacion_datos->inboxnUsuarioRecibeId), 
                                                               $comisionesRecibidas->moneyFolioFactura,
                                                               $comisionesRecibidas->moneyMontoConsumo,
                                                               $comisionesRecibidas->moneyBackOtorgado);

            //SEND EMAIL TO USER
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_usuarios_email_send->email, get_complete_username($datos_usuarios_email_send->id));
            $this->email->subject('Bonificacion aceptada.');
            $this->email->message($template_email_users);
            $this->email->send();
        }*/

        //SAVE DATA FOR IE
        $data_ie = array('bonificacionIeUsuario'=>$id,
                         'bonificacionIePlan'=>$id_oferta,
                         'bonificacionIeFolioFactura'=>$comisionesRecibidas->moneyFolioFactura);
        $this->redSocial->save_bonification_ie($data_ie);


    }





    /**
     * DEMO POST TOKEN
     **/
        public function post_social_demo()//$id, $id_oferta, $id_bonificacion)
    {
        //. $id . ' ' . $id_oferta . ' ' . $id_bonificacion;
  /*      $datos = $this->redSocial->get_data_post($id);
        $ofertas = $this->redSocial->get_data_offerts($id_oferta);
        $mensajes = $this->redSocial->get_data_promotion($ofertas->idMensajeOferta);
*/
        //POST TO FACEBOOK
        $this->load->add_package_path(APPPATH.'third_party/social_media_user/');
       
        $this->load->library('facebooklib2');

        /** INICIO A LA NUEVA FORMA DE POSTEAR **/
      /*  if(!empty($datos->tokenFacebook))
        {
            $val_geotag = get_geotag_data($id_oferta);
            $link_post = $this->redSocial->get_data_links_socialmedia($val_geotag->geotagGId);
            if($link_post->scribbleAnexos != '0')
            {
                $this->facebooklib2->post_wall_new($datos->tokenFacebook, $mensajes->mensajeFacebook, $link_post->scribbleAnexos);
            }
            else
            {*/
        //AAAAANAZBMkHcBAMae1RS0YZBja56V1zd0uMN0JmVwMo2y85oalmrF3KDOfsfDSj5ljR9M23yGGekZBoYM7omaQsT62qdcIZD
         $this->facebooklib2->post_wall_new('AAAAANAZBMkHcBAMae1RS0YZBja56V1zd0uMN0JmVwMo2y85oalmrF3KDOfsfDSj5ljR9M23yGGekZBoYM7omaQsT62qdcIZD', 'demo prueba nueva offline access scope javascript sdk');//$datos->tokenFacebook, $mensajes->mensajeFacebook);
            echo "prueba de post sin conexion a facebook"; 
           /* }
        }*/
        /** FIN A LA NUEVA FORMA DE POSTEAR **/

        //TWITTER POST
   /*     if(!empty($datos->twitter_oauth) && !empty($datos->twitter_oauth_secret))
        {
            $mensaje_complete_twitter = $mensajes->mensajeTwitter . ' #Pulzos';
            $this->tweet->set_tokens(array('oauth_token'=>$datos->twitter_oauth,
                                           'oauth_token_secret'=>$datos->twitter_oauth_secret));
            $resultados = $this->tweet->call('post', 'statuses/update', array('status'=>$mensaje_complete_twitter));
        }
        $mensaje_complete = $mensajes->mensajeTwitter . ' #Pulzos';
        $this->redSocial->update_bonifications_status($id_bonificacion);

        //PARTE DE VALIDACION DE MENSAJES
        if($mensajes->mensajeFacebook != '')
        {
            $mensajePulzos = $mensajes->mensajeFacebook;
        }
        else
        {
            $mensajePulzos = $mensajes->mensajeTwitter;
        }

        //PARTE DE PUBLICACION EN MURO DE PULZOS
        $valoresPublicacion = array('planUsuarioId'=>$id,
                                    'planTipo'=>'1',
                                    'planDescripcion'=>$mensajePulzos,
                                    'planFechaCreacion'=>time());

        $this->redSocial->insert_post_in_wall($valoresPublicacion);
       
        $comisionesRecibidas = $this->redSocial->get_all_data_bonifications_company($id_bonificacion);

        $valor1 = $comisionesRecibidas->moneyBackOtorgado * 2.8;
        $valor2 = $valor1/100;
        $fechaTransaccion = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $timestamp = date('dmYHis');
        $nombre_empresa = get_name_company($comisionesRecibidas->moneyNegocioId);
        $transaccion = reference_number($nombre_empresa->negocioNombre,$timestamp);

        //INSERTAR O ACTUALIZAR EN LA PARTE DEL HISTORIAL
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        if($mes == '02') //FEBRERO
        {
            $ab = date('L');
            if($ab == '1')
            {
                $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
                $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin1 = mktime(0, 0, 0, date('m'), 29, date('Y'));
            }
            else
            {
                $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
                $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin1 = mktime(0, 0, 0, date('m'), 28, date('Y'));
            }
        }
        if(($mes == '04') || ($mes == '06') || ($mes == '09') || ($mes == '11')) //ABRIL, JUNIO, SEPTIEMBRE, NOVIEMBRE
        {  
            $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
            $fechaFin1 = mktime(0, 0, 0, date('m'), 30, date('Y'));
        }
        if(($mes == '01') || ($mes == '03') || ($mes == '05') || ($mes == '07') || ($mes == '08') || ($mes == '10') || ($mes == '12'))
        { //ENERO, MARZO, MAYO, JULIO, AGOSTO, OCTUBRE, DICIEMBRE
            $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
            $fechaFin1 = mktime(0, 0, 0, date('m'), 31, date('Y'));
        }
    
        if($dia >= 0 && $dia <= 15)
        {
            $contador = $this->redSocial->count_all_register_history($ofertas->idNegocioOferta, $fechaIni, $fechaFin);
            if($contador != 0)
            {
                $registros_history = $this->redSocial->get_data_history_row($ofertas->idNegocioOferta, $fechaIni, $fechaFin);
                $valor_id = $registros_history->idHistorial;
                $totalUpdate = $registros_history->historialTotalQuincenal + $comisionesRecibidas->moneyBackOtorgado;
                $this->redSocial->update_data_history($totalUpdate,$valor_id);//$id
            }
            else
            {
                $new_history = array('historialEmpresaId'=>$ofertas->idNegocioOferta,
                                     'historialTotalQuincenal'=>$comisionesRecibidas->moneyBackOtorgado,
                                     'historialStatusDeposito'=>'0',
                                     'historialFechaInicio'=>$fechaIni,
                                     'historialFechaFin'=>$fechaFin);
                $valor_id = $this->redSocial->saveNew_history($new_history);
            }
        }
        elseif($dia >= 16 && $dia <=30)
        {
            $contador = $this->redSocial->count_all_register_history($ofertas->idNegocioOferta, $fechaIni1, $fechaFin1);
            if($contador != 0)
            {
                $registros_history = $this->redSocial->get_data_history_row($ofertas->idNegocioOferta, $fechaIni1, $fechaFin1);
                $valor_id = $registros_history->idHistorial;
                $totalUpdate = $registros_history->historialTotalQuincenal + $comisionesRecibidas->moneyBackOtorgado;
                $this->redSocial->update_data_history($totalUpdate,$valor_id);//$id);
            }
            else
            {
                $new_history = array('historialEmpresaId'=>$ofertas->idNegocioOferta,
                                     'historialTotalQuincenal'=>$comisionesRecibidas->moneyBackOtorgado,
                                     'historialStatusDeposito'=>'0',
                                     'historialFechaInicio'=>$fechaIni1,
                                     'historialFechaFin'=>$fechaFin1);
                $valor_id = $this->redSocial->saveNew_history($new_history);
            }
        }

        //PARTE DE LA COMISION
        $comisiones = array('comisionRecibidaEmpresaId'=>$comisionesRecibidas->moneyNegocioId,
                            'comisionRecibidaUsuarioId'=>$comisionesRecibidas->usuarioMoneyUsuarioId,
                            'comisionRecibidaFolioTransaccion'=>$comisionesRecibidas->moneyFolioFactura,
                            'comisionRecibidaUsuarioBonificacion'=>$comisionesRecibidas->usuarioMoneyTotal,
                            'comisionRecibidaBonificacionZavor'=>$valor2,
                            'comisionRecibidaNumeroReferencia'=>$transaccion,
                            'comisionRecibidaFechaTransaccion'=>$fechaTransaccion,
                            'comisionRecibidaHistorialId'=>$valor_id,
                            'fechaDepositoComisionUsuario'=>'0');
        $comision_usuario = $this->redSocial->insert_revenues($comisiones);

        //OBTENER LOS DATOS DE LA PRIMER BITACORA
        $bitacoraUnoData = $this->redSocial->get_bitacora_data($id_bonificacion);
        //PARTE DONDE SE GUARDA LA INFORMACION DE LA BITACORA DE PUBLICACION
        $public_bita = array('bitacoraDosUsuarioAcepta'=>$bitacoraUnoData->bitacoraUsuarioEnviaId,
                             'bitacoraDosUsuarioPublica'=>$bitacoraUnoData->bitacoraUsuarioRecibeId,
                             'bitacoraDosMsjFb'=>$mensajes->mensajeFacebook,
                             'bitacoraDosMsjTw'=>$mensaje_complete,
                             'bitacoraDosOfertaId'=>$id_oferta,
                             'bitacoraDosMoneyUsuario'=>$id_bonificacion,
                             'bitacoraDosBitacoraUno'=>$bitacoraUnoData->bitacoraId,
                             'bitacoraDosFechaPublicacion'=>date('Y-m-d H:i:s'),
                             'BitacoraDosComisionRecibidaUsuario'=>$comision_usuario);
        $this->redSocial->save_bitacora_dos($public_bita);

        //SEND THE EMAIL FOR THE COMPANY AND THE EMPLOYEE
        $bonificacion_datos = get_data_bonification_data($id_bonificacion);
        $check = get_status_user($bonificacion_datos->inboxnUsuarioRecibeId);
        if($check == 0) //THE STATUS IS FOR USER
        {
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET DATA FOR SEND EMAIL EMPLOYEE AND COMPANY
            $datos_company_email = get_data_company($bonificacion_datos->inboxnUsuarioId); 
            $template_email_company = notificate_user_to_company($datos_company_email->negocioNombre,
                                                                 get_complete_username($bonificacion_datos->inboxnUsuarioRecibeId),
                                                                 $comisionesRecibidas->moneyFolioFactura,
                                                                 $comisionesRecibidas->moneyMontoConsumo,
                                                                 $comisionesRecibidas->moneyBackOtorgado);

            //SEND EMAIL TO COMPANY
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_company_email->negocioEmail, $datos_company_email->negocioNombre);
            $this->email->subject('Bonificacion aceptada.');
            $this->email->message($template_email_company);
            $this->email->send();
        }
        else //THE STATUS IS FOR COMPANY
        {
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET DATA FOR SEND EMAIL USERS AND EMPLOYEE
            $datos_company_email_send = get_data_company($bonificacion_datos->inboxnUsuarioRecibeId);
            $datos_usuarios_email_send = get_complete_userdata($bonificacion_datos->inboxnUsuarioId);
            $template_email_users = notificate_company_to_user(get_complete_username($bonificacion_datos->inboxnUsuarioId),
                                                               get_complete_username($bonificacion_datos->inboxnUsuarioRecibeId), 
                                                               $comisionesRecibidas->moneyFolioFactura,
                                                               $comisionesRecibidas->moneyMontoConsumo,
                                                               $comisionesRecibidas->moneyBackOtorgado);

            //SEND EMAIL TO USER
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_usuarios_email_send->email, get_complete_username($datos_usuarios_email_send->id));
            $this->email->subject('Bonificacion aceptada.');
            $this->email->message($template_email_users);
            $this->email->send();
        }

        //SAVE DATA FOR IE
        $data_ie = array('bonificacionIeUsuario'=>$id,
                         'bonificacionIePlan'=>$id_oferta,
                         'bonificacionIeFolioFactura'=>$comisionesRecibidas->moneyFolioFactura);
        $this->redSocial->save_bonification_ie($data_ie);
*/
    }
}
