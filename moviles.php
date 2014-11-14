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
        $this->load->helper(array('url', 'form', 'html', 'avatar', 'apipulzos', 'cyp', 'date', 'status', 'passworder'));
        $this->load->model('Movil', '', TRUE);
    }

    /**
     * Metodo que se usa para poder realizar el logue de los
     * usuarios verificando la cuenta desde la base de datos para
     * conocer si existe el usuario o si no esta dado de alta aun en la
     * plataforma
     *
     * @params string email del usuario
     * @params string password del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function login($email, $pass)
    {
        $password = encrypt_password($pass, $this->config->item('encryption_key'));
        $datos = $this->Movil->login_user($email, $password);
        $arreglo = array('id_usuario'=>$datos);
        echo json_encode($arreglo);
    }

    /**
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
        $datos = $this->Movil->personal_data_user($id);
        echo json_encode($datos);
    }

    /**
     * Metodo que se usa para guardar los datos del usuario en cuanto a las inserciones
     * de la aplicacion movil pulzos scribble, esto para guardarlo en la base de datos
     * y asi una vez que llegue otro usuario a querer pulzar algun comentario, poder hacer
     * que muestre todos los comentarios que ya se han hecho en esa ubicacion
     *
     * @params string texto a poner
     * @params int id del usuario
     * @params decimal(10,8) latitud
     * @params decimal(10,8) longitud
     * @params string nombre del usuario
     * @params string url de la imagen
     * @params double heading
     * @params double altura
     * @params int atributos (NULL)
     * @params int id del scribble al que se comenta (NULL)
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmaill.com>
     **/
    public function insert_scribles($str, $idUser, $lat, $lng, $name, $imagen, $heading, $altura, $attr=null, $intC = null)
    {
        //$str_href = str_replace("-", "/", rawurldecode($imagen));
        $str_decode = rawurldecode($str);
        $str_name = rawurldecode($name);
        
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
            echo $valor;
        }
    }

    /**
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

    /**
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

    /**
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
    public function obtener_root($lat1, $lng1, $lat2, $lng2, $lat3, $lng3, $lat4, $lng4)
    {
        $datos = $this->Movil->get_all_tags_limit();
        echo json_encode($datos);
    }

    /**
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
    public function nuevo_usuario($nombre, $apellido, $email, $pass, $pais, $ciudad, $dia, $mes, $ano)
    {
        $nombre_pila = rawurldecode($nombre);
        $apellido_pila = rawurldecode($apellido);
        $now = date("Y-m-d H:i:s");
        $password = encrypt_password($pass, $this->config->item('encryption_key'));
        $fec_nac = $ano . "-" . $mes . "-" . $dia;
        $creacion = human_to_unix($now);

        $post = array('nombre'=>$nombre_pila,
                      'apellidos'=>$apellido_pila,
                      'email'=>$email,
                      'password'=>$password,
                      'sexo'=>'2',
                      'edad'=>$fec_nac,
                      'pais'=>$pais,
                      'ciudad'=>$ciudad,
                      'creacion'=>$creacion,
                      'statusEU'=>'0');
        $id = $this->Movil->new_user_from_movil($post);

        $personales = array('usuarioId'=>$id);
        $this->Movil->new_personal_data_register($personales);

        if($ciudad == 7)
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
        }

        echo $id;
    }

    /**
     * Metodo que se usa para obtener todas las ciudades que estan habilitadas
     * para la plataforma de pulzos, pues con estas se podran realizar el llenado de
     * las listas desplegables de la seleccion de la ciudad del usuario
     *
     * @return mixed arreglo con datos de las ciudades dadas de alta en pulzos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ciudad_pais_pulzos($tabla)
    {
        $datos = $this->Movil->cities_countries_pulzos($tabla);
        echo json_encode($datos);
    }

    /**
     * Metodo que se usa para guardar los tokens de los usuarios en cuanto a facebook para
     * que el mismo pueda ligar su cuenta de pulzos con la parte de los scribbles y estos
     * se puedan publicar en el muro una vez que se haya posteado en el muro virtual
     * o real de pulzos
     *
     * @params string uid Facebook
     * @params string Token Facebook
     * @params int id del usuario
     *
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function datos_facebook($dato1, $dato2, $id)
    {
        $numero = $this->Movil->count_social_media($id);
        if($numero == 0)
        {
            $datosN = array('uidFacebook'=>$dato1,
                            'tokenFacebook'=>$dato2,
                            'socialUsuarioId'=>$id);

            $valor = $this->Movil->save_facebook($datosN);
            echo $valor;
        }
        else
        {
            $datosA = array('uidFacebook'=>$dato1,
                            'tokenFacebook'=>$dato2,
                            'socialUsuarioId'=>$id);
            $valor = $this->Movil->update_facebook($datosA, $id);
            echo $valor;
        }
    }

    /**
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
    public function datos_twitter($dato1, $dato2, $id)
    {
        $numero = $this->Movil->count_social_media($id);
        if($numero == 0)
        {
            $datosN = array('twitter_oauth'=>$dato1,
                            'twitter_oauth_secret'=>$dato2,
                            'socialUsuarioId'=>$id);

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
}
