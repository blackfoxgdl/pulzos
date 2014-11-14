<?php
/**
 * Helper para obtener comentarios de algún elemento y asi presentarlos inline 
 * sin problemas
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 29 March, 2011
 * @package Core
 **/

function get_comentarios($api, $id_elemento)
{
    $CI =& get_instance();
    $CI->load->model('comentarios/comentario');

    $comentarios = $CI->comentario
        ->get('comentarioAppApiKey = "'
        .$api.'" AND comentarioElementoId = '.$id_elemento);

    return $comentarios;
}

/**
 * Se obtienen los comentarios de los pulzos que
 * han sido hechos por el usuario interesado
 * o el que quiera comentar. Solo se mostraran
 * 3 comentarios en la parte de pulzos
 *
 * @params int id del pulzos
 * @return mixed datos del comentario del pulzo
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comment_pulzo($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios')
           ->where('comentarioPulzoId',$id)
           ->order_by('comentarioId','desc')
           ->limit(3);
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Se usa para mostrar todos los comentarios
 * de los pulzos personalizados
 *
 * @params int id del pulzo
 * @return mixed datos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comment_pulzo_personal($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios')
           ->where('comentarioPulzoId',$id);
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Helper que cuenta si hay comentarios en el 
 * pulzo que realizo el negocio o no, en caso de que
 * haya ingresa a la condicion
 * 
 * @params int id del pulzo
 * @return int numero de renglones en que haya
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_count_comments($id)
{
    $CI =& get_instance();
    $CI->db->where('comentarioPulzoId', $id);
    $query = $CI->db->count_all_results('comentarios');
    return $query;
}

/**
 * Helper que ayudara a conocer si es empresa o usuario el
 * que este comentando el pulzo, esto para evitar que solo
 * muestre uno u otro
 *
 * @params int id del usuario o negocio
 * @return int 0 o 1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_status_user($id)
{
    $CI =& get_instance();
    $CI->db->where('id', $id);
    $query = $CI->db->get('usuarios');
    $val = $query->row();
    return $val->statusEU;
}

/**
 * Helper que sirve para extraer los datos de la tabla de 
 * los negocios que se han dado de alta por un usuario
 * es decir cuando se apadrina una empresa
 *
 * @param int id_negocio
 * @return datos negocio alta
 * @author jorge Leon
 */
 function get_data_newCompany($id){
     $CI=& get_instance();
     $CI->db->select('*')
           ->from('altaNegocio')
           ->where('altaNegocioNegocioId',$id);
    $query = $CI->db->get();
    return $query->row();
 }

/**
 * Helper que ayuda a obtener todos los datos del negocio
 * por medio de su id de usuario, con este podremos obtener
 * los datos del negocio que esta posteando
 *
 * @params int id del negocio
 * @return mixed datos del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioUsuarioId',$id);
    $query = $CI->db->get();
    return $query->row();
}

/**
 **/
function get_pulzos($id_usuario)
{
    $CI =& get_instance();
    $CI->load->model('pulzos/pulzo');
    return $CI->pulzo->get('pulzos.pulzoUsuarioId = '.$id_usuario);
}

/**
 * Get info if the user is friends with anotherone
 *
 * @return string string to display when called
 * @author axoloteDeAccion
 **/
function is_friend($id_usuario, $id_amigo)
{
    if($id_usuario == $id_amigo)
    {
        return "";
    }
    $CI =& get_instance();
    $CI->load->model('amigos/amigo');
    $CI->load->helper('url');
    $relation = $CI->amigo->is_friend($id_usuario, $id_amigo);
    if($relation)
    {
        //Check what is the status of the relationship among this users.   
        if($relation->amigoAceptado == 3)
        {
            return; //"Ya son amigos";
        }else{
            return 2;//"Invitación pendiente";
        }
    }
    return 1;
}

/**
 * Helper que se usara para poder obtener los datos de las amistades y asi dependiendo
 * cual status se tenga de amistad, se podra mostrar el mensaje que se tiene en caso
 * de no haber aceptado al invitacion aun
 *
 * @int id del usuario del que se ve el perfil
 * @return string datos del mensaje
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function status_friend($id_usuarios, $id_amigo)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId',$id_usuarios)
           ->where('amigoAmigoId', $id_amigo);
    $amigos = $CI->db->get();
    return $amigos->row();
}

/**
 * Helper que ayuda a obtener los status de los amigos
 * con los cuales se puede contar si hay algun registro
 * pendiente en el cual el usuario mostrara un mensaje de
 * que ya se envio al invitacion o un mensaje de que se
 * invite al amigo
 *
 * @params int id del usuario a invitar
 * @params int id del usuario que invita
 *
 * @return int numero de registros que se tienen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_data($id_usuario, $id_amigo)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId', $id_usuario)
           ->where('amigoAmigoId', $id_amigo);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se encarga de obtener los status de los
 * mensajes de status de los amigos dependiendo cual
 * sea su situacion con la persona que les envio al situacion
 *
 * @params int id del status
 * @return string mensaje a mostrar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_message_status($statusId)
{
    if($statusId == 1)
    {
        return $msg = "Invitacion Pendiente";
    }
    if($statusId == 2)
    {
        return $msg = "Responde la Invitacion";
    }
    if($statusId == 3)
    {
        return $msg = "";
    }
}

/**
 **/
function get_pulzos_api()
{
    $CI =& get_instance();
    $CI->load->model('pulzo');
    return $CI->pulzo->apiKey;
}

/**
 * Helper que se usa para obtener los datos del nombre del usuario
 * el cual se usara para sacarlo dependiendo del id del usuario y con
 * esto se podra obtener el nombre del mismo
 *
 * @params int id del usuario
 * @return string nombre del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_user_name($id)
{
    $CI =& get_instance();
    $CI->load->model('usuarios/usuario', '', true);
    $usuario = $CI->usuario->data_name($id);
    if($usuario != Null)
    {
        $nombre = (string) $usuario->nombre;
        return $nombre;
    }else{
        return "No tiene";
    }
}

/**
 * Helper que se usa para obtener los negocios de los usuarios con los 
 * segidores con los cuales se sabra cuales son los negocios que estas
 * siguiendo y poder mostrarlos en el perfil del negocio para que se puedan
 * mostrar los seguidores a vista de todos
 * 
 * @params int id del negocio
 * @return mixed datos a mostrar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_negocios_usuario($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
        ->from('negocios')
        ->join('seguidores', 'negocios.negocioId = seguidores.seguidorNegocioId', 'left')
        ->where('seguidores.seguidorUsuarioId', $id);
    $Q = $CI->db->get();
    return $Q->result();
}

/**
 * Helper que se usa para obtener todos los amigos de los usuario para
 * que el mismo pueda obtener todos sus amigos y poder mostrarlos en el perfil
 * de cada uno de los usuarios
 *
 * @params int id del usuario
 * @return mixed datos de los amigos
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_amigos_usuario($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
        ->from('usuarios')
        ->join('amigos', 'usuarios.id = amigos.amigoAmigoId', 'left')
        ->where(array('amigos.amigoUsuarioId'=>$id, 'amigos.amigoAceptado'=>'1'));
    $Q = $CI->db->get();
    return $Q->result();
}

/**
 * Trae el URL de la última foto agregada a ese album
 *
 * @return void
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
function get_ultima_imagen_album($id)
{
    $CI =& get_instance();
    $CI->db->select("imagenes.imagenRuta")
        ->from('imagenes')
        ->where('imagenes.imagenAlbumId = '.$id)
        ->limit(10);
    $Q = $CI->db->get();
    if($Q->num_rows())
    {
        $img = $Q->row();
        $img = $img->imagenRuta;
    }else{
        $img = "statics/img/default/avatar.png";
    }
    return $img;
}

function get_amigos_usuario_combo($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
        ->from('usuarios')
        ->join('amigos', 'usuarios.id = amigos.amigoAmigoId', 'left')
        ->where(array('amigos.amigoUsuarioId'=>$id, 'amigos.amigoAceptado'=>'1'));
    $Q = $CI->db->get();
    $amigos = $Q->result();
    $data = array();
    foreach($amigos as $amigo)
    {
        $data[$amigo->id] = $amigo->nombre;
    }
    return $data;
}

/**
 * Funcion que sirve para obtener el nombre del negocio
 * simplemente pasando el id del mismo, asi solo se manda
 * a llamar con su parametro y problema resuelto
 *
 * @params int id del negocio
 * @return string datos del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioId',$id);
    $query = $CI->db->get();
    return $query->row();
}

/**
 * Funcion que se usa para obtener la ultima imagen
 * del album de los negocios, esto para que se muestre
 * en los albums
 *
 * @params int id del negocio
 * @return img
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_ultima_imagen_albumN($id)
{
    $CI =& get_instance();
    $CI->db->select("imagennegocios.imagenNegocioRuta")
        ->from('imagennegocios')
        ->where('imagennegocios.imagenNegocioAlbumId = '.$id)
        ->limit(10);
    $Q = $CI->db->get();
    if($Q->num_rows())
    {
        $img = $Q->row();
        $img = $img->imagenNegocioRuta;
    }else{
        $img = "statics/img/default/avatar.png";
    }
    return $img;
}

/**
 * Se obtienen el tipo de evento que sera el pulzo
 * esto para mostrarlo al momento de que se vean los eventos
 * de forma simultanea o incluso individualmente
 *
 * @params int tipo de evento
 * @return string nombre a asignar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_tipo_reto($id)
{
    if($id == '1')
    {
        $tipoEvento = "De consumo";
    }
    elseif($id == '2')
    {
        $tipoEvento = "De tiempo";
    }
    elseif($id == '3')
    {
        $tipoEvento = "De actividad";
    }
    elseif($id == '4')
    {
        $tipoEvento = "De grupo";
    }
    else
    {
        $tipoEvento = "Otro";
    }
    return $tipoEvento;
}

/**
 * Helper que ayudara a obtener todos los seguidores que
 * tiene la empresa para poder mostrarlos en la parte lateral
 * izquierda, con esto poder mostrar las imagenes
 *
 * @params int id del negocio
 * @return mixed conjunto de datos a buclear en la view
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_followers_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('seguidores')
           ->where('seguidorNegocioId', $id)
           ->order_by('seguidorId', 'DESC')
           ->limit(9);
    $query = $CI->db->get();
    if($query->num_rows())
    {
        return $query->result();
    }
    else
    {
        return;
    }
}

/**
 * Helper que se usa para obtener el primer nombre
 * del usuario para solo mostrar este, se tiene
 * que pasar como parametro el nombre completo y asi
 * checar si hay dos partes del nombre cortarlo
 *
 * @params string nombre del usuario
 * @return nombre cortado
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function cut_name_user($str)
{
    $primer = explode(" ", $str);
    return $primer[0];
}

/**
 * Helper que se usa para poder obtener las subcategorias de
 * las categorias para mostrarlas una vez que el usuario seleccione
 * una de las categorias que deseen ver los pulzos de los usuarios.
 *
 * @params int id de la categoria
 * @return mixed datos de las subcategorias
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_subcategories($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('subcategorias')
           ->where('idGiro',$id);
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Helper que se usa para obtener los datos de la categorias
 * que no tienen subcategorias, esto para poder mostrar los
 * pulzos que las empresas han hecho para los usuarios
 *
 * @params int id de la categoria
 * @return mixed datos de la categoria
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_categories($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('subcategorias')
           ->where('idGiro', $id);
    $query = $CI->db->get();
    return $query->row();
}

/**
 * Helper que ayuda a obtener los pulzos del negocio,
 * es una funcion que tambien se podra usar desde el
 * api para los desarrolladores, esta se pasa como
 * parametro el id del negocio y le tipo de pulzo
 *
 * @params int id del negocio
 * @params int tipo de pulzo
 *
 * @return mixed datos de los pulzos
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_pulzo_data($id, $tipo)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoUsuarioId', $id)
           ->where('pulzoTipo', $tipo);
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Helper que se usara para obtener los amigos del usuario,
 * estos son los doce amigos mas recientes que se hayan
 * hecho amistad, esto para que el usuario pueda observar
 * quienes son sus amigos
 *
 * @params int id del usuario
 * @return mixed datos con la informacion
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_friends_recently($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId', $id)
           ->where('amigoAceptado', '3')
           ->where('amigoTipo', '0')
           ->order_by('amigoId', 'DESC')
           ->limit(9);
    $resultado = $CI->db->get();
    return $resultado->result();
}

/**
 * Helper creado para poder obtener todos los datos de los planes
 * usuarios que se tienen ligados con los pulzos, esto para que en
 * el perfil del negocio puedan aparecer con una correcta maquetacion
 * los datos que se tienen al momento
 *
 * @params int id del pulzo
 * @return mixed datos a retornar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_planesusuarios($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planEmpresaPulzoId', $id);
    $planes = $CI->db->get();
    return $planes->row();
}

/**
 * Helper que se usa para poder obtener los datos de los pulzos de los
 * negocios que se tienen ligados a los planes de los usuarios para poder
 * mostrar los datos con el mismo y asi el usuario pueda ver las ofertas
 * de los negocios que siguen
 *
 * @params int id de planesusuarios
 * @params int id del negocio
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_pulzos($idPlan, $idEmpresa)
{
    $CI =& get_instance();
    $CI->db->select('*')
          ->from('pulzos')
          ->where('pulzoId', $idPlan)
          ->where('pulzoUsuarioId', $idEmpresa);
    $pulzos_datos = $CI->db->get();
    return $pulzos_datos->row();
}

/**
 * Metodo que se usa para obtener el tipo de usuario que
 * esta visitando el perfil, para conocer si se muestra el
 * menu de la izquierda completo o limitado por ser empresa
 * pues estas no pueden ver muchos de los datos del usuario
 *
 * @params int id del usuario
 * @return mixed datos del usuario como "Usuario"
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_type_of_user($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $resultados = $CI->db->get();
    return $resultados->row();
}

/**
 * Helper que se usa para obtener todos los datos de los negocios
 * que ya estan registrados con alguna red social, para poder cargarlos
 * en la parte de redes sociales, sin necesidad de que se sobreescriba y quede
 * de una manera vacia, esto para evitar problemas con las actualizaciones
 *
 * @params int id del negocios-negocio
 * @return mixed datos del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_social_empresa($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media_empresa')
           ->where('socialEmpresaUsuarioId', $id);
    $valores = $CI->db->get();
    return $valores->row();
}

/**
 * Helper que se usa para contar el numero de registros que se
 * tienen en la parte de redes sociales por medio de la empresa,
 * esto para que el mismo pueda observar lo que ya coloco o si se
 * muestran los datos o no
 *
 * @params int id del negocio negocio
 * @return int numero de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_results($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media_empresa')
           ->where('socialEmpresaUsuarioId', $id);
    $valores = $CI->db->count_all_results();
    return $valores;
}

/**
 * Helper que se usa para obtener los datos de la tabla
 * planesusuarios, estos por medio del id del pulzo de la
 * empresa. los datos obtenidos se podran manipular para poder
 * usarlos al momento de hacer la reservacion de parte del usuario
 * con la promocion de la empresa
 *
 * @params int id del pulzo
 * @return mixed datos de la tabla planesusuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_planusuario_by_pulzo($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planEmpresaPulzoId', $id);
    $planes = $CI->db->get();
    return $planes->row();
}

/**
 * Helper que se usa para conocer el numero total de pulzos
 * que se tienen en la tabla y asi saber si se promociona la ultima
 * oferta en el directorio de mi ciudad o se publica solo la direccion
 * del mismo
 *
 * @params int id del pulzo
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_pulzo($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoUsuarioId', $id);
    $query = $CI->db->count_all_results();
    return $query;
}
