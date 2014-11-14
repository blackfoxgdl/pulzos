<?php if(! defined('BASEPATH')) exit('No script Access allowed');
/**
 * Constructor que contendra todos los metodos que
 * se usaran para las conexiones a moviles, esto para poder
 * regresar los datos de una forma propicia por parte del
 * sistema o la plataforma y asi que se puedan conectar correctamente
 * al usuario sin necesidad de que se tenga que meter obligatoriamente
 * al sitio web
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Oct 03, 2011
 * @package Moviles
 **/
class Moviles extends MX_Controller{

    /**
     * Metodo donde se declaran las variables que se usaran de
     * manera global en toda a plataforma para que el mismo pueda
     * usarse y sin necesidad de estar declarando las cosas en cada
     * uno de los metodos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'user_agent'));
        $this->load->helper(array('url', 'form', 'html', 'avatar', 'apipulzos', 'cyp', 'date', 'status', 'passworder', 'emails', 'counters'));
        $this->load->model('Movil', '', TRUE);
    }

    /** ACTUAL USANDO
     * Metodo que se usara para el logueo de los usuarios desde el movil
     * una vez que hayan bajado la aplicacion de los moviles y que se hayan
     * registrado desde la web, asi se sabra si ya estan registrados o si aun
     * no se han registrado en la plataforma. Todos los datos estan codificados
     * y la version es la 1.1
     *
     * @params string email usuario
     * @params string password usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function LGGRPH_LoginUser_v1_1($email, $pass)
    {
        $email_decode = get_decode_string($email);
        $pass_decode = get_decode_string($pass);
        $valor = $this->Movil->count_email_exists($email_decode);
        if($valor == 1)
        {
            $password = encrypt_password($pass_decode, $this->config->item('encryption_key')); 
            $valor2 = $this->Movil->count_pass_exists($password, $email_decode);
            if($valor2 == 1)
            {
                $id_usuario = $this->Movil->login_user($email_decode, $password);
                echo $id_usuario;
            }
            else
            {
                echo "false:La contraseña del usuario es incorrecta.";
            }
        }
        else
        {
            echo "false:El email no existe o es incorrecto.";
        }
    }

    /**
     * Method which going to be use for check all the data of the
     * users that login with Facebook to the platform, this login will be
     * used for make an account
     *
     * @params string first_name
     * @params string last_name
     * @params string gender
     * @params string email
     * @params string token
     * @params string birthday
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function LGGRPH_loginFB_v1($fname1, $lname1, $gender, $email1, $token, $birthday, $idFB)
    {
        $fname = get_decode_string($fname1);
        $lname = get_decode_string($lname1);
        $email = get_decode_string($email1);
        $cut_birth = explode('-', $birthday);
        $date = date($cut_birth[2] . "-" . $cut_birth[1] . "-" . $cut_birth[0]);
        $bday = $date . ' 00:00:00';
        $totalData = $this->Movil->code_facebook_exists($idFB);

        //$this->Movil->count_email_exists($email);
        if($totalData == 0)
        {
            $now = date('Y-m-d H:i:s');
            $users = array('nombre'=>$fname,
                           'apellidos'=>$lname,
                           'email'=>$email,
                           'password'=>'0',
                           'sexo'=>$gender,
                           'edad'=>$bday,
                           'ciudad'=>0,
                           'pais'=>0,
                           'creacion'=>$now,
                           'codigoRecuperacion'=>'0',
                           'statusRecuperacion'=>'1',
                           'statusIngreso'=>'0',
                           'statusEU'=>'0',
                           'usuariosCode'=>'0',
                           'usuariosStatusActivado'=>'0',
                           'usuariosFBuId'=>$idFB);
            $idU = $this->Movil->save_data_fb('usuarios', $users);

            //UPDATE THE DATA OF THE USER FOR GENERATE THE CODE
            $codeUserCreate = $idU.date('s');
            $arrayUsers = array('usuariosCode'=>$codeUserCreate);
            $this->Movil->update_codeUser_creation($idU, $arrayUsers);

            //CREATE THE PERSONAL REGISTER DATA
            $personales = array('usuarioId'=>$idU);
            $this->Movil->new_personal_data_register($personales);

            //PART THAT WILL SAVE THE ALBUMS
            $url1 = "https://graph.facebook.com/".$idFB."/picture?type=normal";
            $url2 = "https://graph.facebook.com/".$idFB."/picture?type=square";
            $date_creation = time();
            $albumMain = array('albumUsuarioId'=>$idU,
                               'albumDefault'=>1,
                               'albumNombre'=>'Mis fotos de Perfil',
                               'albumFechaCreacion'=>$date_creation,
                               'albumLugar'=>'Mi Perfil',
                               'albumDescripcion'=>'Imágenes que he usado como fotos de perfil',
                               'albumFechaModificacion'=>0);
            $ida = $this->Movil->save_data_fb('albums', $albumMain);

            //save the url of picture in the avatar
            $imagenAlbum = array('imagenAlbumId'=>$ida,
                                 'imagenAvatar'=>1,
                                 'imagenNombre'=>'',
                                 'imagenDescripcion'=>'',
                                 'imagenRuta'=>$url1,
                                 'imagenFechaCreacion'=>time(),
                                 'imagenFechaModificacion'=>time());
            $idi = $this->Movil->save_data_fb('imagenes', $imagenAlbum);

            //save imagen thumb avatar
            $albumThumb = array('usuarioThumbName'=>$url2,
                                'thumbUsuarioId'=>$idU);
            $idit = $this->Movil->save_data_fb('imagenes_thumb', $albumThumb);

            //PART WHERE SAVE THE TOKEN FOR POST
            $dataFB = array('tokenFacebook'=>$token,
                            'socialUsuarioId'=>$idU);
            $this->Movil->save_data_fb('social_media', $dataFB);

            if(isset($ida) && isset($idi) && isset($idit))
            {
                echo $idU;
            }
            else
            {
                echo "FALSE";
            }
        }
        else
        {
            $url1 = "https://graph.facebook.com/".$idFB."/picture?type=normal";
            $url2 = "https://graph.facebook.com/".$idFB."/picture?type=square";

            $data = $this->Movil->get_data_by_fbUid($idFB);//get_data_by_emailFB($email);
            $idA = get_album_id($data->id);
            $this->Movil->update_avatar_profile($url1, $idA->albumId);
            $this->Movil->update_avatar_thumb($url2, $data->id);
            $this->Movil->update_tokenFB($token, $data->id);

            echo $data->id;
        }
    }

    /** ACTUAL USANDO
     * Metodo que se usa para obtener los datos del usuario por medio de su id,
     * con el cual el se podran mostrar datos personales referentes a perfiles del
     * mismo y asi poder obtener los datos personales del usuario
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_user($id)
    {
        $datos1 = "";
        $datos = $this->Movil->personal_data_user($id);
        $value = $this->Movil->redes_sociales_count_user($id);
        $valores = array('redes_sociales'=>$value);
        $datos = str_replace('/', '-', $datos);
        $datos1 = array_merge($datos, $valores);
        echo json_encode($datos1);
    }

    /** ACTUAL POSTREAL
     * Metodo que se usa para poder postear en la parte de el muro virtual
     * que se hace por medio de los smartphones, esta funcion ya viene con
     * las cadenas de texto codificadas para que cuando se mande no haya 
     * problema al momento de realizar el posteo y que los usuarios postean con 
     * acentos sin problemas
     *
     * @params string texto a poner
     * @params int id del usuario
     * @params decimal(10,8) latitud
     * @params decimal(10,8) longitud
     * @params string nombre del usuario
     * @params string url de la imagen
     * @params int boolean para publicacion en facebook y twitter (0,1)
     * @params double heading
     * @params double altura
     * @params int atributos (NULL)
     * @params int id del scribble al que se comenta (NULL)
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmaill.com>
     **/
    public function MGRPH_PostReal_v1_1($str, $idUser, $lat, $lng, $name, $imagen, $bandera, $heading, $altura, $attr=null, $intC = null)
    {
        //$str_href = str_replace("-", "/", rawurldecode($imagen));
        /*        $str_decode = html_entity_decode($str);
        $str_decode = replace_characters($str_decode);*/
        //$str_decode = utf8_decode($str_decode1);
        //$str_name = rawurldecode($name);
        $str_decode = get_decode_string(html_entity_decode($str));
        $str_name = get_decode_string($name);
        
        if(empty($intC))
        {
           $datosInsert = array('scribbleUsuarioId'=>$idUser,
                                 'scribbleTexto'=>$str_decode,
                                 'scribbleLat'=>$lat,
                                 'scribbleLng'=>$lng,
                                 'scribbleNombreUsuario'=>$str_name,
                                 'scribbleImagenUsuario'=>$imagen,
                                 'heading'=>$heading,
                                 'altura'=>$altura,
                                 'atributo'=>$attr);
            $valor = $this->Movil->save_scribble($datosInsert);
    
            //PARTE PARA EL MURO
            $datosScribble = array('planUsuarioId'=>$idUser,
                                   'planTipo'=>'8',
                                   'planDescripcion'=>$str_decode,
                                   'planFechaCreacion'=>time(),
                                   'planScribbleId'=>$valor);

            $this->Movil->save_plain($datosScribble);
            
            $total = $this->Movil->count_social_media($idUser);

            if($bandera != 0)
            {//IF BANDERA PARA CONOCER SI SE POSTEA EN REDES SOCIALES
                if($total != 0)
                {//IF CHECAR SI HAY REDES SOCIALES ACTIVAS POR PARTE DEL USUARIO
                    $this->load->add_package_path(APPPATH.'third_party/social_media_user/');
                    $this->load->library('facebooklib2');
                    $social_media = $this->Movil->social_media_data($idUser);
                    //var_dump($social_media);
                    if($social_media->tokenFacebook != '')
                    {
                        /*$str_FB = html_entity_decode($str);
                        $str_FB = replace_characters_FB($str_FB);*/
                        if(!empty($social_media->tokenFacebook))
                        {
                            $this->facebooklib2->post_wall_new($social_media->tokenFacebook, $str_decode);//$str_FB);
                        }
                    }
                   /* if($social_media->uidFacebook != '0' && $social_media->tokenFacebook != '0')
                    {//IF ACTIVAN FACEBOOK
                        if(!empty($social_media->uidFacebook) && !empty($social_media->tokenFacebook))
                        {
                            $posteos_scribble = array('access_token'=>$social_media->tokenFacebook,
                                                      'message'=>$str_decode);
                            $this->facebooklib->post_wall($social_media->uidFacebook, $posteos_scribble);
                        }
                    }//IF ACTIVAN FACEBOOK*/
                    if($social_media->twitter_oauth_secret != '0' && $social_media->twitter_oauth_secret != '0')
                    {//IF ACTIVAN TWITTER
                        if(!empty($social_media->twitter_oauth) && !empty($social_media->twitter_oauth_secret))
                        {
                            $string_complete = $str_decode . ' #Pulzos';
                            $this->tweet->set_tokens(array('oauth_token'=>$social_media->twitter_oauth,
                                                           'oauth_token_secret'=>$social_media->twitter_oauth_secret));
                            $resultados = $this->tweet->call('post', 'statuses/update', array('status'=>$string_complete));
                        }
                    }//IF ACTIVAN TWITTER
                }//IF CHECAR PARA CONOCER SI SE POSTEA EN REDES SOCIALES
            }//IF BANDERA PARA CONOCER SI SE POSTEA EN REDES SOCIALES
            echo $valor;
        }
        else
        {
            $datosInsert = array('scribbleUsuarioId'=>$idUser,
                                 'scribbleTexto'=>$str_decode,
                                 'scribbleLat'=>$lat,
                                 'scribbleLng'=>$lng,
                                 'scribbleNombreUsuario'=>$str_name,
                                 'scribbleImagenUsuario'=>$imagen,
                                 'scribbleFatherId'=>$intC,
                                 'heading'=>$heading,
                                 'altura'=>$altura,
                                 'atributo'=>$attr);
            $valor = $this->Movil->save_scribble($datosInsert);

            $data = $this->Movil->get_plain_insert($intC);
            //PARTE PARA LA PARTE DE COMENTARIO
            $datosScribble = array('comentarioSimpleUsuarioId'=>$idUser,
                                   'comentarioSimplePlanId'=>$data->planId,
                                   'comentarioSimpleSubId'=>'1',
                                   'subcomentarioComentarioId'=>'0',
                                   'comentarioSimple'=>$str_decode,
                                   'comentarioSimpleGusta'=>'0',
                                   'comentarioFechaCreacion'=>time());

            $this->Movil->insert_subcomment_from_scribble($datosScribble);

/*array('planUsuarioId'=>$idUser,
                                   'planTipo'=>'8',
                                   'planDescripcion'=>$str_decode,
                                   'planFechaCreacion'=>time());
             */
//            $this->Movil->save_plain($datosScribble);

            //ACTUALIZAR COMENTARIOS
            $total = $this->Movil->count_all_scribble_comment($intC);
            $tc = $total + 1;
            $this->Movil->update_sons_comments($intC, $tc);

            //PARTE PARA OBTENER DATOS DEL USUARIO
            $fatherId = $this->Movil->mainCommentUser($intC);
            //var_dump($fatherId);
            $status = get_status_user($fatherId->scribbleUsuarioId);
        
            if($status == '0')
            {
                $datos_usuario = get_complete_userdata($fatherId->scribbleUsuarioId);
                $nombre_email_user = $datos_usuario->nombre . " " . $datos_usuario->apellidos;
                //GET THE TEMPLATE
                $template_message = comment_geotagging($nombre_email_user, $str_name, $fatherId->scribbleTexto, $str_decode);
                //LOAD EMAIL
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $this->load->library('email');
                $this->email->initialize($config);
    
                $this->email->from('atencion@pulzos.com', 'Pulzos');
                $this->email->to($datos_usuario->email, $nombre_email_user);
                $this->email->subject($str_name . ' ha comentado en tu GeoEtiqueta.');
                $this->email->message($template_message);
                $this->email->send();
            }
            if($status == '1')
            {
                $datos_usuario = get_data_company($fatherId->scribbleUsuarioId);
                //GET TEMPLATE
                $template_message = comment_geotagging($datos_usuario->negocioNombre, $str_name, $fatherId->scribbleTexto);
                //LOAD EMAIL
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $this->load->library('email');
                $this->email->initialize($config);

                $this->email->from('atencion@pulzos.com', 'Pulzos');
                $this->email->to($datos_usuario->negocioEmail, $datos_usuario->negocioNombre);
                $this->email->subject($str_name . ' ha comentado en tu GeoEtiqueta.');
                $this->email->message($template_message);
                $this->email->send();
            }
            
            //PARTE DONDE SE OBTIENEN LOS DATOS DE LOS USUARIOS QUE HAN COMENTADO EN 
            //LA GEOETIQUETA LA CUAL YA SE HA HECHO POR OTRO USUARIOS
            $geotag_total = $this->Movil->get_all_users_comment_total($intC);
            if($geotag_total->totalComentarios != 0)
            {
                //OBTENER LOS USUARIOS QUE HAN COMENTADO LA GEOETIQUETA PRINCIPAL PARA QUE SE ENVIE
                //UN CORREO EN CASO DE QUE HAYA MAS DE DOS
                $user_comment_geo = $this->Movil->get_all_users_comment_secondary($intC);
                foreach($user_comment_geo as $comment_geo)
                {
                    if($comment_geo->scribbleUsuarioId != $idUser)
                    {
                        //INITIALIZE THE EMAIL DATA FOR SENDING TO USERS
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'utf-8';
                        $this->load->library('email');
                        $this->email->initialize($config);

                        //GET THE TEMPLATE FOR SEND THE EMAIL TO THE USER
                        $datos_scribble_main = $this->Movil->get_data_tagging($intC);
                        $template_email_users_comments = comment_geotagging_secondary($datos_scribble_main->scribbleNombreUsuario,
                                                                                      $comment_geo->nombre . ' ' . $comment_geo->apellidos,
                                                                                      get_complete_username($idUser),
                                                                                      $datos_scribble_main->scribbleTexto,
                                                                                      $str_decode);
                        //SENDING EMAIL
                        $this->email->from('atencion@pulzos.com', 'Pulzos');
                        $this->email->to($comment_geo->email, $comment_geo->scribbleNombreUsuario);
                        $this->email->subject(get_complete_username($idUser) . ' ha comentado una geoetiqueta');
                        $this->email->message($template_email_users_comments);
                        $this->email->send();
                    }
                }
            }
            echo $valor;
        }
    }

    /**
     * Method where the mobile call for return all
     * the companies that will be in the range of the
     * coords of companies for check in and get the
     * bonification of the company
     **/
    public function GAGRPH_Companies($lat1, $lng1, $lat2, $lng2, $lat3, $lng3, $lat4, $lng4)
    {
        //make the query
        $result = $this->Movil->get_all_companies_coords($lat1, $lat2, $lng3, $lng4);
        if(empty($result))
        {
            echo "No matches";
        }
        else
        {
            echo json_encode($result); 
        }
    }

    /** PENDIENTES
     * Metodo que se usa para obtener el avatar del usuario que se
     * tiene actualmente logueado en pulzos, en caso de cambiarlo
     * esta url cambiaria en un valor para que se actualice el
     * avatar del usuario
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_image($id)
    {
        $valor = $this->Movil->get_avatar($id);
        echo 'www.pulzos.com/'.$valor;
    }

    /** PENDIENTES
     * Metodo que se usa para obtener las imagenes de los avatars perpo de forma ya
     * reducida por parte del usuario que tiene esta parte hecha, pero para esto se
     * necesita que el usuario haya ya subido una foto de perfil y que se cheque si
     * existe la foto para saber si se pone al tumbnail o se necesita aun redimensionar
     * las imagenes
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_thumb_image($id)
    {
        $valor = $this->Movil->get_avatar_thumb($id);
        echo 'www.pulzos.com/'.$valor;
    }

    /** ACTUAL USANDO
     * Metodo que se usa para poder obtener todos los valores o datos de
     * los comentarios de los scribbles que el usuario ha puesto en sus
     * negocios para que el mismo pueda visualizar los datos una vez que este tenga
     * o quiera ver solo el principal del scribbles
     *
     * @params int id del scribble principal
     * @return mixed datos del mismo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function scribble_comment_simple($id)
    {
        $valores = $this->Movil->get_data_simple($id);
        echo json_encode($valores);
    }
 
    /** ACTUAL CARGA SIGUIENTES
     * Metodo que se usa para obtener los padres mandando a llamar
     * esta funcion se obtendran todos dentro de un rango determinado
     * en el parametro que se ingrese, estos son longitud y latitud
     * que se tienen
     *
     * @params decimal longitud
     * @params decimal latitud
     *
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function obtener_tags_principales($lat1, $lng1, $lat2, $lng2, $lat3, $lng3, $lat4, $lng4, $val_limit = null)
    {
        //$datos_main = array();
        $datos = $this->Movil->get_all_tags_limit_new($lat1, $lat2, $lng3, $lng4);
        $datos_corporativos = $this->Movil->get_all_tags_company($lat1, $lat2, $lng3, $lng4);
        //var_dump($datos_corporativos);
        $todos = array();
        $todos = array_merge($datos_corporativos, $datos);
        /*$totales1 = $this->Movil->count_all_tags($lat1, $lat2, $lng3, $lng4);
        $totales = obtain_array_last_scribble($totales1);
        if(empty($val_limit))
        {
            $rangos = $this->Movil->get_range_tags($lat1, $lat2, $lng3, $lng4);
            //var_dump($rangos);
            $ultimo = obtain_array_last_scribble($rangos);
            $rangos_valores = "1 - " . $ultimo;
            //var_dump($ultimo);
        }
        else
        {
            $rangos = $this->Movil->get_range_tags_more($lat1, $lat2, $lng3, $lng4, $val_limit);
            $ultimos = obtain_array_last_scribble($rangos);
            $uno_mas = $val_limit + 1;
            $rangos_valores = $uno_mas . ' - ' . $ultimos;
        }
        
        $datos_main[0] = array('totalScribbles'=>$totales);
        $datos_main[1] = array('rangoScribble'=>$rangos_valores);
        $datos_main[2] = array('promociones'=>'0');
        $datos_main[3] = array('moneyBack'=>'0');
        $datos_main[4] = array('publicaciones'=>$datos);*/
        echo json_encode($todos);//_main);
    }

    /** ACTUAL CARGA INICIAL
     * Metodo encargado de obtener los tags principales que se veran en la parte de los
     * celulares, esto para que el usuario pueda visualzar las fotos que se tengan por parte
     * del negocio o que esten dentro de las coordenadas que se estan dando actualmente.
     *
     * @params string lat1, lat2, lat3, lat4
     * @params string lng1, lng2, lng3, lng4
     *
     * @return json encode data arrays
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function obtener_tags_principales_v2($lat1, $lng1, $lat2, $lng2, $lat3, $lng3, $lat4, $lng4, $val_limit = null)
    {
        //$datos_main = array();
        $datos = $this->Movil->get_all_tags_limit_new_v2($lat1, $lat2, $lng3, $lng4);
        $datos_corporativos = $this->Movil->get_all_tags_company_v2($lat1, $lat2, $lng3, $lng4);
        $datos_imagenes = $this->Movil->get_all_tags_company_image_v2($lat1, $lat2, $lng3, $lng4);
        //var_dump($datos_corporativos);
        $todos = array();
        $todos = array_merge($datos_corporativos, $datos, $datos_imagenes);
        echo json_encode($todos);
        /*$totales1 = $this->Movil->count_all_tags($lat1, $lat2, $lng3, $lng4);
        $totales = obtain_array_last_scribble($totales1);
        if(empty($val_limit))
        {
            $rangos = $this->Movil->get_range_tags($lat1, $lat2, $lng3, $lng4);
            //var_dump($rangos);
            $ultimo = obtain_array_last_scribble($rangos);
            $rangos_valores = "1 - " . $ultimo;
            //var_dump($ultimo);
        }
        else
        {
            $rangos = $this->Movil->get_range_tags_more($lat1, $lat2, $lng3, $lng4, $val_limit);
            $ultimos = obtain_array_last_scribble($rangos);
            $uno_mas = $val_limit + 1;
            $rangos_valores = $uno_mas . ' - ' . $ultimos;
        }
        
        $datos_main[0] = array('totalScribbles'=>$totales);
        $datos_main[1] = array('rangoScribble'=>$rangos_valores);
        $datos_main[2] = array('promociones'=>'0');
        $datos_main[3] = array('moneyBack'=>'0');
        $datos_main[4] = array('publicaciones'=>$datos);*/
        //echo json_encode($todos);//_main);
    }

    /**
     *  PROXIMAMENTE SOLO PRUEBAS
     **/
    public function obtener_root($lat1, $lng1, $lat2, $lng2, $lat3, $lng3, $lat4, $lng4)
    {
        $datos = $this->Movil->get_all_tags_limit();
        echo json_encode($datos);
    }


    /** ACTUAL
     * Metodo que se usa para poder crear una nueva cuenta de algun usuario que
     * quiera usar el pulzos scribble para que el mismo no tenga que irse
     * directamente a la parte web para registrarse y hacerlo de forma sencilla
     * en esta parte del usuario y asi puedan tambine crear cuenta desde su
     * aplicacion movil
     *
     * @params string nombre del usuario
     * @params string apellido del usuario
     * @params string correo electronico
     * @params string password
     * @params int id del pais
     * @params int id de la ciudad
     * @params int dia
     * @params int mes
     * @params int año
     *
     * @return json con el id del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function NWGRPH_NewUser_V1_1($nombre, $apellido, $email, $pass, $dia, $mes, $ano)// $ciudad, $pais, 
    {
        $nombre_pila = get_decode_string($nombre);//rawurldecode($nombre);
        $apellido_pila = get_decode_string($apellido);//rawurldecode($apellido);
        $email_decode = get_decode_string($email);
        $pass_decode = get_decode_string($pass);

        $now = date("Y-m-d H:i:s");
        $password = encrypt_password($pass_decode, $this->config->item('encryption_key'));
        $fec_nac = $ano . "-" . $mes . "-" . $dia;
        $creacion = human_to_unix($now);
        $datos_emails = $this->Movil->check_email_movil($email_decode);
        if($datos_emails == 0)
        {
            $post = array('nombre'=>$nombre_pila,
                      'apellidos'=>$apellido_pila,
                      'email'=>$email_decode,
                      'password'=>$password,
                      'sexo'=>'2',
                      'edad'=>$fec_nac,
                      'pais'=>'0',//$pais,
                      'ciudad'=>'0',
                      'creacion'=>$creacion,
                      'statusEU'=>'0');
            $id = $this->Movil->new_user_from_movil($post);

            $personales = array('usuarioId'=>$id);
            $this->Movil->new_personal_data_register($personales);

            /*if($ciudad == 7)
            {
                //AMIGOS COMO AMIGOS CON PULZOS COLIMA
                $amigosempresa = array('amigoUsuarioId'=>$id,
                                       'amigoAmigoId'=>'946',
                                       'amigoAceptado'=>'3',
                                       'amigoFechaCreacion'=>time(),
                                       'amigoTipo'=>'1');
                $this->Movil->save_friendly($amigosempresa);
    
                $empresaamigos = array('amigoUsuarioId'=>'946',
                                       'amigoAmigoId'=>$id,
                                       'amigoAceptado'=>'3',
                                       'amigoFechaCreacion'=>time(),
                                       'amigoTipo'=>'1');
                $this->Movil->save_friendly($empresaamigos);
    
                //METODO QUE SE USA PARA PODER REALIZAR AUTOMATICAMENTE SEGUIDOR DE PULZOS COLIMA
                $seguidores = array('seguidorUsuarioId'=>$id,
                                    'seguidorNegocioId'=>'892',
                                    'seguidorFechaCreacion'=>time());
                $this->Movil->save_follower_company($seguidores);
            }
            elseif(($ciudad == 1) || ($ciudad == 2) || ($ciudad == 3) || ($ciudad == 4) || ($ciudad == 5) || ($ciudad == 6))
            {   
                //AMIGOS COMO AMIGOS
                $amigosempresa = array('amigoUsuarioId'=>$id,
                                       'amigoAmigoId'=>'822',
                                       'amigoAceptado'=>'3',
                                       'amigoFechaCreacion'=>time(),
                                       'amigoTipo'=>'1');
                $this->Movil->save_friendly($amigosempresa);
        
                $empresaamigos = array('amigoUsuarioId'=>'822',
                                       'amigoAmigoId'=>$id,
                                       'amigoAceptado'=>'3',
                                       'amigoFechaCreacion'=>time(),
                                       'amigoTipo'=>'1');
                $this->Movil->save_friendly($empresaamigos);
            
                //PARTE PARA GUARDAR LOS SEGUIDORES DE LOS USUARIOS
                $seguidores = array('seguidorUsuarioId'=>$id,
                                    'seguidorNegocioId'=>'796',
                                    'seguidorFechaCreacion'=>time());
                $this->Movil->save_follower_company($seguidores);
            }*/

            //PARTE DE LA CREACION DEL THUMB DEL USUARIO POR DEFECTO
            $this->load->library('image_lib');
    
            //se crea el directorio para el thumbnail
            $file_path1 = './statics/img_usuarios/'.$id.'/thumb/';
            //create directory
            @mkdir($file_path1, 0777, true);
    
            $name_short1 = cut_name_user($nombre_pila);
    
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'statics/img/default/avatar.jpg';
            $config['create_thumb'] = 'TRUE';
            $config['maintain_ratio'] = 'TRUE';
            $config['width'] = 45;
            $config['height'] = 55;
            $config['new_image'] = './statics/img_usuarios/'.$id.'/thumb/'.strtolower($name_short1).'.jpg';
    
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            //GUARDAR EN LA BASE DE DATOS
            $ruta_imagen = './statics/img_usuarios/'.$id.'/thumb/'.strtolower($name_short1).'_thumb.jpg';//.$corte[1];
            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                 'thumbUsuarioId'=>$id
                                );
            //var_dump($datos_thumb);
            $this->Movil->save_thumb($datos_thumb);

            //PARTE DEL ENVIO DEL CORREO
            //SE OBTIENEN LOS DATOS DE LA LIBRERIA EMAIL Y LA CONFIGURACION
            $this->load->library('email');
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            //TEMPLATE PARA EL CUERPO DEL MENSAJE
            $nombre_completo_user = $nombre_pila . ' ' . $apellido_pila;
            $template_email = email_welcome($nombre_completo_user);

            //PARTE DE LA CONFIGURACION DEL USUARIO
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($email_decode, $nombre_completo_user);
            $this->email->subject('Bienvenido a Pulzos.com');
            $this->email->message($template_email);
            $this->email->send();

            echo $id;
        }
        else
        {
            echo "false:El correo electronico ya esta registrado.";
        }
    }

    /** ACTUAL USANDO
     * Metodo que se usa para guardar los tokens de los usuarios en cuanto a facebook para
     * que el mismo pueda ligar su cuenta de pulzos con la parte de los scribbles y estos
     * se puedan publicar en el muro una vez que se haya posteado en el muro virtual
     * o real de pulzos
     *
     * @params string Token Facebook
     * @params int id del usuario
     *
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function RSGRPH_Facebook($dato, $id)
    {
        $numero = $this->Movil->count_social_media($id);
        if($numero == 0)
        {
            if(!empty($dato))
            {
                $datosN = array('uidFacebook'=>'',
                                'tokenFacebook'=>$dato,
                                'socialUsuarioId'=>$id);
            }
           /* else
            {
                $datosN = array('uidFacebook'=>'',
                                'tokenFacebook'=>'',
                                'socialUsuarioId'=>$id);
            }*/

            $valor = $this->Movil->save_facebook($datosN);
            echo $valor;
        }
        else
        {
            $datosA = array('uidFacebook'=>'',
                            'tokenFacebook'=>$dato,
                            'socialUsuarioId'=>$id);
            $valor = $this->Movil->update_facebook($datosA, $id);
            echo $valor;
        }
    }

    /** ACTUAL USANDO
     * Metodo que se usa para guardar los tokens de los usuarios en cuanto a la red social
     * de twitter para que el mismo pueda ligar su cuenta de pulzos con los scribbles y ya
     * que quede en general las publicaciones en el timeline de twitter y que se hayan posteado
     * en el muro virtual
     *
     * @params string Token Twitter
     * @params string Secret Twitter
     * @params int id del usuario
     *
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function RSGRPH_Twitter($dato1, $dato2, $id)
    {
        $numero = $this->Movil->count_social_media($id);
        if($numero == 0)
        {
            if(!empty($dato1) && !empty($dato2))
            {
                $datosN = array('twitter_oauth'=>$dato1,
                                'twitter_oauth_secret'=>$dato2,
                                'socialUsuarioId'=>$id);
            }
            /*else
            {
                $datosN = array('twitter_oauth'=>'',
                                'twitter_oauth_secret'=>'',
                                'socialUsuarioId'=>$id);
            }*/

            $valor = $this->Movil->save_twitter($datosN);
            echo $valor;
        }
        else
        {
            $datosA = array('twitter_oauth'=>$dato1,
                            'twitter_oauth_secret'=>$dato2,
                            'socialUsuarioId'=>$id);
            $valor = $this->Movil->update_twitter($datosA, $id);
            echo $valor;
        }
    }

    /** ACTUAL USANDO
     * Metodo que se usa par apoder guardar los pasa la voz de los usuarios que se han apuntado al comentario
     * o la promocion que esta disponible por parte de la empresa para los usuarios que estan escaneando los
     * datos de los posteos virtuales
     *
     * @params int idS
     * @params int idU
     * @params string code
     *
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function VGRPH_PassVoice_v1($idS, $idU, $code)
    {
        //CONTAR SI AUN ESTA LA PROMOCION
        $totalPromotions = $this->Movil->count_all_promotions($idS);
        if($totalPromotions != 0)
        {
            if($code == -100)
            {
                //CONTAR SI EL USUARIO EXISTE CON ESA PROMOCION
                $userPromotion = $this->Movil->count_all_users_promotions($idS, $idU, $code);
                //echo "promotion: " . $userPromotion;
                if($userPromotion == 0)
                {
                    //echo "hhh";
                    //VERIFICAR EL TIPO DE PROMOCION
                    if($code == -100)
                    {
                        //VALIDAR DATOS DE CONTAR NUMERO DE PROMOCIONES
                        $total = $this->Movil->count_number_promotions($idS, $code);
                        $totalP = $this->Movil->get_maximum_number($idS);
                        //echo "total1: " . $total . " total2:" . $totalP->taggingFinishPromotion;
                        if($total == $totalP->taggingFinishPromotion)
                        {
                            //$message_json = "ya se acabo la promocion de las ofertas";
                            $porcentaje_oferta = 0;
                            $minimoConsumo = 0;
                            $oferta_identificador = 0;
                            $link_globo = 'http:--www.pulzos.com-statics-globos_movil-scribbleGloboOnAzul.png';
                            $cadena_respuesta = "La duracion de la promocion ha finalizado";
                            $link_img_vid = '';
                            $status_type_bonification = '';
                        }
                        else
                        {
                            //GUARDAR LOS DATOS
                            $this->Movil->save_promotion_100($idS, $idU, $code);
    
                            $data_post = $this->Movil->get_data_tagging($idS);
                            //revision del archivo de posteo de video
                            //var_dump($data_post);
                            if($data_post->scribbleAnexos == '0')
                            {
                                $link = '';
                            }
                            else
                            {
                                $link = $data_post->scribbleAnexos;
                            }
                            
                            $this->load->add_package_path(APPPATH.'third_party/social_media_user/');
                            $this->load->library('facebooklib2');
                            $totales = $this->Movil->count_social_media_data($idU);
                            //var_dump($data_post);
                            //var_dump($social_media);
                            if($totales != 0)
                            {
                                $social_media = $this->Movil->social_media_data($idU);
                                //POSTEO FACEBOOK
                                if(!empty($social_media->tokenFacebook))
                                {
                                    $this->facebooklib2->post_wall_new($social_media->tokenFacebook, 
                                                                       $data_post->scribbleTexto, 
                                                                       $link);
                                }
                               /* if(!empty($social_media->uidFacebook) && !empty($social_media->tokenFacebook))// != '0')
                                {
                                    $posteos_sociales = array('access_token'=>$social_media->tokenFacebook,
                                                              'message'=>$data_post->scribbleTexto);
                                    $this->facebooklib->post_wall($social_media->uidFacebook, $posteos_sociales);
                                }*/
                                //POSTEO TWITTER
                                if(!empty($social_media->twitter_oauth) && !empty($social_media->twitter_oauth_secret))
                                {
                                    $string_code = $data_post->scribbleTexto . " #Pulzos";
                                    $this->tweet->set_tokens(array('oauth_token'=>$social_media->twitter_oauth,
                                                                   'oauth_token_secret'=>$social_media->twitter_oauth_secret));
                                    $resultados = $this->tweet->call('post', 'statuses/update', array('status'=>$string_code));
                                }
    
                                //$message_json = "Gracias por pasar la voz";
                                $porcentaje_oferta = 0;
                                $minimoConsumo = 0;
                                $oferta_identificador = 0;
                                $link_globo = 'http:--www.pulzos.com-statics-globos_movil-scribbleGloboOnAzul.png';
                                $cadena_respuesta = "Gracias por pasar la voz";
                                $link_img_vid = '';
                                $status_type_bonification = '';

                                //INICIA LA PARTE DEL CORREO ELECTRONICO AL USUARIO
                                //DATOS USER Y NEGOCIO
                             /*   $fatherIdScribble = $this->Movil->mainCommentUser($idS);
                                $usuario_data_email = get_complete_userdata($idU);
                                $nombre_completo_email = $usuario_data_email->nombre . ' ' . $usuario_data_email->apellidos;
                                $negocio_data_email = get_data_company($fatherIdScribble->scribbleUsuarioId);

                                //GET TEMPLATE
                                $template_message = comment_pass_voice($negocio_data_email->negocioEmail,
                                                                       $nombre_completo_email,
                                                                       $fatherIdScribble->scribbleTexto);
                                //ENVIAR A LOS NEGOCIOS UN EMAIL
                                $config['mailtype'] = 'html';
                                $config['charset'] = 'utf-8';
                                $this->load->library('email');
                                $this->email->initialize($config);

                                $this->email->from('atencion@pulzos.com', 'Pulzos');
                                $this->email->to($negocio_data_email->negocioEmail, $negocio_data_email->negocioNombre);
                                $this->email->subject($nombre_completo_email . ' se ha apuntado en tu promocion.');
                                //$cuerpo = 'Hola ' . $negocio_data_email->negocioEmail . '<br />'.
                                  //        $nombre_completo_email . ' se ha apuntado a la promocion "' . $fatherIdScribble->scribbleTexto . '"';
                                $this->email->message($template_message);//$cuerpo);
                                $this->email->send();*/
                            }
                        }
                    }
                }
                else
                {
                    //MENSAJE DE ERROR
                    //$message_json = "ya has pasado al voz en esta promocion";
                    $porcentaje_oferta = 0;
                    $minimoConsumo = 0;
                    $oferta_identificador = 0;
                    $link_globo = 'http:--www.pulzos.com-statics-globos_movil-scribbleGloboOnAzul.png';
                    $cadena_respuesta = "Ya haz pasado la voz en esta promocion.";
                    $link_img_vid = '';
                    $status_type_bonification = '';
                }
            }
            elseif($code == -200)
            {
                $data_post_tag = $this->Movil->get_data_tagging($idS);
                $data_company = $this->Movil->get_data_company($data_post_tag->scribbleUsuarioId);
                $count_data = $this->Movil->count_all_offerts_company($data_company->negocioId);
                if($count_data != 0)
                {
                    $datos_oferta = $this->Movil->get_data_offerts($data_company->negocioId);
                    $val_geo_ofer = $this->Movil->get_geo_offert($idS);
                    $datos_oferta2 = $this->Movil->get_data_offerts_two($val_geo_ofer->ofertaOId);
                    $porcentaje_oferta = $datos_oferta2->bonificaPorcentaje;//$datos_oferta->bonificaPorcentaje;
                    $minimoConsumo = $datos_oferta2->consumoMinimo;//$datos_oferta->consumoMinimo;
                    $oferta_identificador = $val_geo_ofer->ofertaOId;
                    $link_globo = 'http:--www.pulzos.com-statics-globos_movil-scribbleGloboOnVerde.png';
                    $cadena_respuesta = 'La bonificacion esta en tramite';
                    $link_img_vid = '';
                    $status_type_bonification = $datos_oferta2->statusTipoBonificacion;
                    //var_dump($datos_oferta);
                   /* $datos_pass_movil = array('porcentaje_bonificacion'=>$datos_oferta->consumoMinimo,
                                              'minimo_consumido'=>$datos_oferta->bonificaPorcentaje,
                                              'link_globo'=>'http:--www.pulzos.com-statics-globos_movil-scribbleGloboOnVerde.png',
                                              'cadena_respuesta'=>'La bonificacion esta en tramite',
                                              'link_img_vid'=>'');
                    //var_dump($datos_pass_movil);
                    echo json_encode($datos_pass_movil);*/
                }
                else
                {
                    $porcentaje_oferta = 0;
                    $minimoConsumo = 0;
                    $oferta_identificador = 0;
                    $link_globo = 'http:--www.pulzos.com-statics-globos_movil-scribbleGloboOnVerde.png';
                    $cadena_respuesta = "No hay ofertas activas";
                    $link_img_vid = '';
                    $status_type_bonification = '';
                }
            }

            $datos_pass_movil = array('porcentaje_bonificacion'=>$porcentaje_oferta,
                                      'minimo_consumido'=>$minimoConsumo,
                                      'oferta_identificador'=>$oferta_identificador,
                                      'link_globo'=>$link_globo,
                                      'cadena_respuesta'=>$cadena_respuesta,
                                      'link_img_vid'=>$link_img_vid,
                                      'status_tipo_bonifica'=>$status_type_bonification);
            echo json_encode($datos_pass_movil);
        }
        else
        {
            echo "la oferta ya no esta activa";
        }
    }

    /** ACTUAL
     * Metodo que se usara para poder obtener los valores que se necesitan de los 
     * siguientes 20 o anteriores 20 para que el usuario pueda visualizar mas
     * etiquetas de las cuales se enviaran dependiendo la bandera que se pase al
     * mismo valor
     *
     * @params string latitud 1
     * @params string longitud 1
     * @params string latitud 2
     * @params string longitud 2
     * @params string latitud 3
     * @params string longitud 3
     * @params string latitud 4
     * @params string longitud 4
     * @params int id del comentario
     * @params int bandera de busqueda
     *
     * @return mixed datos a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mostrar_mas($lat1, $lng1, $lat2, $lng2, $lat3, $lng3, $lat4, $lng4, $num, $corp)
    {
        $arreglo = array();
        $datos_corporativos = $this->Movil->obtener_mas_corporativas($lat1, $lat2, $lng3, $lng4, $corp);
        $datos = $this->Movil->obtener_mas_registros($lat1, $lat2, $lng3, $lng4, $num);
        $arreglo = array_merge($datos_corporativos, $datos);
        echo json_encode($arreglo);
    }

    /** ACTUAL USANDO
     * Metodo que se usara para la version 2 de pulzos con la cual se podran realizar
     * las bonificaciones en cuanto a guardar los datos sin necesidad de realizar
     * un proceso via web. Se crea la funcion debido a que no se quiere quitar la
     * funcionalidad por algun error en versiones anteriores
     *
     * @params int id del negocio
     * @params int id del usuario
     * @params string numero de factura
     * @params double monto total
     * @params double monto fijo o por porcentaje
     * @params int id de la oferta
     *
     * @return string true or false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function RBGRPH_MakeBonification_v2($idN, $idU, $monto_bon, $ofertaID, $folio_factura_user=null, $monto_total=null)
    {
        if($folio_factura_user == '')
        {
            echo "Ingrese el folio o factura obtenido.";
        }
        else if($monto_total == '')
        {
            echo "Ingrese el monto total gastado.";
        }
        else
        {
            $folio_factura = get_decode_string($folio_factura_user);
            $datos = get_type_of_user($idU);

            $datos_money_back = array('moneyNegocioId'=>$idN,
                                      'moneyUsuarioEmail'=>$datos->email,
                                      'moneyFolioFactura'=>$folio_factura,
                                      'moneyMontoConsumo'=>$monto_total,
                                      'moneyBackOtorgado'=>$monto_bon,
                                      'moneyCategoriaDescuento'=>'todo,');

            $val = $this->Movil->save_money_back($datos_money_back);

            $datos_money_usuarios = array('usuarioMoneyUsuarioId'=>$idU,
                                          'usuarioMoneyTotal'=>$monto_bon,
                                          'usuarioMoneyStatus'=>'0',
                                          'usuariosMoneyBackId'=>$val);
            $val2 = $this->Movil->save_money_usuario($datos_money_usuarios);
            
            $datos_empresa = get_data_company($idN);//get_name_company($idN); 
            
            $descuentos = $this->Movil->offerts_company($datos_empresa->negocioId);
            
            $inbox = array('inboxnUsuarioRecibeId'=>$datos_empresa->negocioUsuarioId,
                           'inboxnUsuarioId'=>$idU,
                           'inboxnAsunto'=>'Solicitud de bonificación',
                           'inboxnMensaje'=>'Usuario: <strong>'.get_complete_username($idU).'</strong><br/>
                                             Folio: <strong>'.$folio_factura.'</strong><br />
                                             Monto Consumido: <strong>$'.$monto_total.' Pesos<br />
                                             Bonificacion: <strong>$'.$monto_bon.' Pesos<br />',
                           'inboxnStatus'=>'1',
                           'inboxnFecha'=>time(),
                           'inboxnMoneyUser'=>$val2,
                           'inboxnOfertaId'=>$ofertaID,//$descuentos->ofertaId,
                           'inboxnMoneyStatus'=>'2');
            
            //var_dump($inbox);
            $val = $this->Movil->save_inbox_message($inbox);
            $this->Movil->update_inbox($val, $datos_empresa->negocioUsuarioId, $idU);

            //SAVE DATA OF BONIFICATION
            $bitacora = array('bitacoraIbxnId'=>$val,
                              'bitacoraUsuarioRecibeId'=>$idN,
                              'bitacoraUsuarioEnviaId'=>$idU,
                              'bitacoraIbxMsj'=>$inbox['inboxnMensaje'],
                              'bitacoraIbxOferta'=>$ofertaID,
                              'bitacoraMoneyUsuario'=>$val2,
                              'bitacoraIbxStatus'=>$inbox['inboxnMoneyStatus']);

            //INICIA LA PARTE DE LAOS ENVIOS DE CORREOS
            //GET TEMPLATE
            $template_message = bonification_email_template($datos_empresa->negocioNombre,
                                                            get_complete_username($idU),
                                                            $folio_factura,
                                                            $monto_total,
                                                            $monto_bon);

            //ENVIO DE EMAIL
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);
         
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_empresa->negocioEmail, $datos_empresa->negocioNombre);
            $this->email->subject(get_complete_username($idU) . ' ha realizado una bonificacion!');
            $this->email->message($template_message);
            $this->email->send();

            if(!empty($val) && !empty($val2))
            {
                echo "TRUE";
            }
            else
            {
                echo "FALSE";
            }
        }
    }

    /** ACTUAL USANDO
     * Metodo que se usa para poder obtener los datos necesarios para realizar una
     * bonificacion sin necesidad de que el usuario cache una geoetiqueta, con estas
     * se podran realizar las bonificaciones con solo pasar el correo del negocio
     * con el cual estan registrados en pulzos, esto para que se puedan estraer
     * la oferta y conocer si es una oferta fija o una por porcentaje
     *
     * @params string email del negocio
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function SBGRPH_requetsData($str1=null)
    {
        if($str1 == '')
        {
            echo 'Ingresa un correo electronico.';
        }
        else
        {
            $str = get_decode_string($str1);
            $total = $this->Movil->check_email_company($str);
            if($total != 0)
            {
                $datosNegocio = $this->Movil->get_data_by_email($str);
                //var_dump($datosNegocio);
                if($datosNegocio->negocioEsSucursal == '0')
                {
                    $datosOfertas = $this->Movil->get_data_offert_by_id($datosNegocio->negocioId);
                    if(empty($datosOfertas))
                    {
                        echo "There are no promotions.";
                    }
                    else
                    {
                        echo json_encode($datosOfertas);
                    }
                }
                else
                {
                    $datosOfertas = $this->Movil->get_data_offert_by_id($datosNegocio->negocioId);
                    $datosOfertas1 = $this->Movil->get_data_offert_by_id($datosNegocio->negocioEsSucursal);
                    $array = array_merge($datosOfertas, $datosOfertas1);
                    if(empty($array))
                    {
                        echo "There are no promotions.";
                    }
                    else
                    {
                        echo json_encode($array);
                    }
                }
            }
            else
            {
                echo "El correo no esta asociado a un negocio.";
            }
        }
    }

    /** ACTUAL DATOS
     * Metodo que se usa para poder cobrar la parte de paypulzos en cuanto al usuario que
     * tenga un pago que realizar y lo quiera hacer por medio de su celular y su cuenta de
     * pulzos lo pueda realizar y que se le descuente virtualmente el dinero que tenia disponible
     * y se conosca la causa de porque se desconto por parte de los administradores de la plataforma
     *
     * @params string email company
     * @params int id del usuario
     * @params double monto a pagar
     *
     * @return string cadena a imprimir
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function PPGRPH_paymentPulzos($email, $idU, $total_monto)
    {
        $str = get_decode_string($email);
        //CHECK EMAIL EXISTS
        $total = $this->Movil->check_email_company($str);
        if($total != 0)
        {
            //CHECK DATA IS HIGHER THAN REQUIRED
            $total2 = $this->Movil->check_payment_require($idU);
            if($total2->moneyTotalGanadoUsuario >= $total_monto)
            {
                $datos_user = get_complete_userdata($idU);
                $datos_company = get_email_company_data($str);
                $dta_folio_trans = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
                $folio_trans = 'P-'.$dta_folio_trans;
                $fecha_hora = date('d-m-Y H:i:s');
                //DATA FOR INSERT TRANSACTION
                $transaccion = array('transaccionUsuarioId'=>$idU,
                                     'transaccionNombreUsuario'=>$datos_user->nombre . ' ' . $datos_user->apellidos,
                                     'transaccionEmailUsuario'=>$datos_user->email,
                                     'transaccionNegocioId'=>$datos_company->negocioId,
                                     'transaccionNombreEmpresa'=>$datos_company->negocioNombre,
                                     'transaccionTotalPagar'=>$total_monto,
                                     'transaccionCodigoVenta'=>$folio_trans,
                                     'transaccionFechaHora'=>$fecha_hora,
                                     'transaccionToken'=>'0');
                $return = $this->Movil->save_transaction($transaccion);

                $total_descontar = $total2->moneyTotalGanadoUsuario - $total_monto;
                $return2 = $this->Movil->update_money_usuario($idU, $total_descontar);
                $valor_decode = $return.'_'.$datos_company->negocioId.'_'.$datos_company->negocioUsuarioId.'_1_'.$dta_folio_trans;
                $decode = base64_encode($valor_decode);
                $this->Movil->update_payment_code($decode, $return);

                //SEND THE INBOX TO THE COMPANY
                $message_array = 'Felicidades has recibido una transferencia como pago de un servicio por parte de ' . $datos_user->nombre
                                 . ' ' . $datos_user->apellidos . ' por una cantidad de $' . $total_monto . 'MX.';
                $inbox_array = array('inboxnUsuarioRecibeId'=>$datos_company->negocioUsuarioId,
                                     'inboxnUsuarioId'=>$datos_user->id,
                                     'inboxnAsunto'=>'Transferencia de pagos de servicio.',
                                     'inboxnStatus'=>'1',
                                     'inboxnFecha'=>time(),
                                     'inboxnMoneyUser'=>'0',
                                     'inboxnConversacionId'=>'0',
                                     'inboxnOfertaId'=>'0',
                                     'inboxnMoneyStatus'=>'4',
                                     'inboxnMensaje'=>$message_array);
                $val_inbox = $this->Movil->save_inbox_transfer($inbox_array);
                $data_conversacion = $val_inbox.$datos_user->id.$datos_company->negocioUsuarioId; 
                $this->Movil->update_conversacion_id($data_conversacion, $val_inbox);

                //INITIALIZE THE DATA FOR THE EMAIL
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $this->load->library('email');
                $this->email->initialize($config);

                //SEND EMAIL TO USER FOR NOTIFICATE TRANSACTION CORRECT
                $name_complete_user = $datos_user->nombre . ' ' . $datos_user->apellidos;
                $template_user = email_transaction_user_accept($name_complete_user, $datos_company->negocioNombre, $total_monto);
                $this->email->from('atencion@pulzos.com', 'Pulzos');
                $this->email->to($datos_user->email, $name_complete_user);
                $this->email->subject('Transferencia aceptada');
                $this->email->message($template_user);
                $this->email->send();

                //SEND EMAIL TO COMPANY ABOUT THE TRANSACTION
                $template_company = email_transaction_company_accept($datos_company->negocioNombre, $name_complete_user, $total_monto);
                $this->email->from('atencion@pulzos.com', 'Pulzos');
                $this->email->to('alberto@divestis.com', 'Alberto');//$datos_company->negocioEmail, $datos_company->negocioNombre);
                $this->email->subject('Transferencia realizada');
                $this->email->message($template_company);
                $this->email->send();

                echo "Tu transaccion se ha realizado correctamente.";
            }
            else
            {
                echo "No hay dinero suficiente para realizar el pago.";
            }
        }
        else
        {
            echo "El correo no esta asociado a un negocio.";
        }
    }

    /**
     * Method for set the status value activate and the
     * company can do the promotion to the user. Once the user
     * has activate, the function return true for verificate
     * that don't have any problems
     *
     * @params int id
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function AAGRPH_ActivateAccount($id)
    {
        $datas = check_account_status_post($id);
        if($datas->usuariosStatusActivado == 0)
        {
            $array = array('usuariosStatusActivado'=>'1');
            $this->Movil->active_account($id, $array);
            echo "TRUE";
        }
        else
        {
            echo "FALSE";
        }
    }
}
