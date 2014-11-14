<?php
/**
 * Helper que se encarga de mostrar todas las funciones de los
 * cambios de status dentro del sistema de pulzos.
 * Estos cambios se realizaran ya sea al momento de aceptar una
 * invitacion personal, rechazarla o incluso de ponerla
 * como probable de asistir.
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, June 29, 2011
 * @package Core
 **/

/**
 * Helper que se usa para obtener todos los ids de los
 * usuarios que esten inscritos al evento que se tiene
 * actualmente, ya sea 0, 1, 2, 3. Estos son los valores
 * para conocer en que seccion de la barra lateral derecha
 * se tiene que colocar la informacion
 *
 * @params int id del plan
 * @params int id del status del plan que se encuentra el usuario
 *
 * @return mixed datos de la invitacion personal
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_info_plains($id, $status)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('invitacionpersonal')
           ->where('invitacionPersonalPlanId', $id)
           ->where('invitacionPersonalAceptadoId', $status);
    $info_plains = $CI->db->get();
    return $info_plains->result();
}

/**
 * Helper que se usa para poder obtener si el usuario ya realizo la accion de 
 * pulzar o no pulzar en el evento, en caso de haberlo hecho, se tienen que 
 * ocultar los botones para que ya no pueda realizar esta accion
 *
 * @params int id del usuario
 * @params int id del plan
 *
 * @return int status de la invitacion
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_status_invitation($id, $idP)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('invitacionpersonal')
           ->where('invitacionInvitadoPersonalId', $id)
           ->where('invitacionPersonalPlanId', $idP);
    $query = $CI->db->get();
    return $query->row();
}

/**
 * Helper que se usa para checar quien ha creado
 * el pulzo, puesto que si es el usuario el creador
 * del plan, este no puede pulzar si va o no va, por lo
 * tanto es obligatorio para el mismo ir al evento que ha organizado
 *
 * @params int id del usuario creador del plan
 * @params int id del plan creado
 *
 * @return int checar si el usuario es le creador
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_user_creator($id, $plan)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planUsuarioId',$id)
           ->where('planId',$plan);
    $query = $CI->db->count_all_results();
    return $query;
}

/**
 * Helper que se usa para checar quien ha posteado en el plan
 * del usuario y que es lo que quieren compartir y que se usa tambien
 * para poder mostrar los mismos comentarios, regresara una arreglo de
 * datos que se tendra que buclear para poder mostrar todos los
 * datos.
 *
 * @params int id del plan
 * @return mixed datos de los comentarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_comments_plains($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios_planes')
           ->where('comentarioSimplePlanId', $id)
           ->where('comentarioSimpleSubId', '1')
           ->order_by('comentarioSimpleId', 'DESC');
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Helper que se encarga y nos ayuda a obtener todos los
 * subccomentarios que se han hecho en el comentario de los
 * planes de los usuarios, en este caso se mostraran los
 * subcomentarios de los usuarios en el plan mismo
 *
 * @params int id del plan
 * @params int status '1'
 * @params int id del comentario del plan
 *
 * @return mixed datos de los planes
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_subcomments_plains($id, $status, $cp)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios_planes')
           ->where('comentarioSimplePlanId', $id)
           ->where('comentarioSimpleSubId', $status)
           ->where('subcomentarioComentarioId', $cp);
    $todos = $CI->db->get();
    return $todos->result();
}

/**
 * Metodo que se encarga de obtener todos los datos de los pulzos
 * de los usuarios o negocios con los cuales se pueden mostrar
 * para que se vayan observando las cosas
 *
 * @params int id del plan del pulzo, reto o experiencia
 * @return mixed datos de los comentarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_pulzos_subcomments($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios')
           ->where('comentarioPulzoId', $id)
           ->order_by('comentarioId', 'ASC');
    $comentarios = $CI->db->get();
    return $comentarios->result();
}

/**
 **/
function get_pulzos_subcomments1($idPulzo, $id_last)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios')
           ->where('comentarioId >=', $id_last)
           ->where('comentarioPulzoId', $idPulzo);
    $datos = $CI->db->get();
    return $datos->result();
}

/**
 * Helper que se usa para contar los comentarios que se tienen de
 * para poder realizar el conteo de los comentarios que se tienen
 * en el mismo y asi solo mostrar los tres mas recientes
 *
 * @params int id del pulzo
 * @return int total de comentarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_pulzos_comments_data($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios')
           ->where('comentarioPulzoId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para obtener todos los ids que se
 * necesitan para poder obtenerlos y despues buclear en una funcion
 * que se usa y no se que chingados digo nomas se que son para
 * obtener los ids de los comentarios
 *
 * @params int id del pulzo
 * @return mixed datos de los comentarios id
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_ids_pulzo($id)
{
    $CI =& get_instance();
    $CI->db->select('comentarioId')
           ->from('comentarios')
           ->where('comentarioPulzoId', $id);
    $ids = $CI->db->get();
    return $ids->result();
}

/**
 * Helper que se usa para obtener el ultimo id del
 * comentario del pulzo que se tiene en el arreglo de objetos
 * que estamos pasando, esto para que el usuario pueda ver los
 * ultimos comentarios y solo mostrar 3 y noc que chingados dije
 *
 * @params mixed datos de los usuario
 * @params int total de comentarios
 *
 * @return int id del comentario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_last_id_comment_pulzo($id, $val)
{
    $break = $val - 3;
    $i = 0;
    foreach($id as $ultimo)
    {
        if($i == $break)
        {
            return $ultimo->comentarioId;
            break;
        }
        $i++;    
    }
}

/**
 * Helper que ayuda a obtener el total de me gustan o me apunto
 * en la parte de comentarios, esto para poder obtener el total
 * que se tiene de me agrada, gusta o apunto
 *
 * @params int id del comentarios
 * @return int total de comentarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_likes_total($id)
{
    $CI =& get_instance();
    $CI->db->select('comentarioSimpleGusta')
           ->from('comentarios_planes')
           ->where('comentarioSimpleId', $id);
    $query = $CI->db->get();
    $total = $query->row();
    if($total->comentarioSimpleGusta == '0')
    {
        return ;
    }
    else
    {
        return $total->comentarioSimpleGusta;
    }
}

/**
 * Helper que se encarga de obtener todos los comentarios de un comentario 
 * principal en el muro del usuario de donde se obtendra una conversacion
 * para que de ahi puedan subcomentar algun comentario del muro y que el 
 * usuario haya puesto
 *
 * @params int id del plan
 * @params status del comentario
 *
 * @return mixed datos de los comentarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_subcomments_wall($idP, $status)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios_planes as cp')
           ->join('usuarios as u', 'cp.comentarioSimpleUsuarioId = u.id', 'left')
           ->where('cp.comentarioSimplePlanId',$idP)
           ->where('comentarioSimpleSubId',$status)
           ->order_by('comentarioSimpleId','asc');
    $query = $CI->db->get();
    return $query->result();
}

/**
 **/
function get_subcomments_wall1($idP, $status, $idPlan)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios_planes as cp')
           ->join('usuarios as u', 'cp.comentarioSimpleUsuarioId = u.id', 'left')
           ->where('cp.comentarioSimplePlanId',$idP)
           ->where('comentarioSimpleSubId',$status)
           ->where('comentarioSimpleId >=', $idPlan);
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Helper que se usa para contar el numero de comentarios que tienen
 * los planes estos para conocer cuales son el total de comentarios
 * que tiene el plan, esto para mostrar solamente los ultimos 3
 * comentarios que se tienen
 *
 * @params int id del plan
 * @params int status id
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_subcomments($idPlan, $status)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios_planes')
           ->where('comentarioSimplePlanId', $idPlan)
           ->where('comentarioSimpleSubId', $status);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Metodo que se usa para poder obtener los ids de todos los mensajes
 * que se tienen como comentarios de los usuarios para saber a partir
 * de que comentario se comenzara a mostrar al usuario
 *
 * @params int id del plan
 * @params int status del plan
 *
 * @return int id
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_ids($id, $status)
{
    $CI =& get_instance();
    $CI->db->select('comentarioSimpleId')
           ->from('comentarios_planes')
           ->where('comentarioSimplePlanId', $id)
           ->where('comentarioSimpleSubId', $status);
    $ids = $CI->db->get();
    return $ids->result();
}

/**
 * Helper que se usa para poder colocar todos los ids en un arreglo y
 * despues ir desglosando cada uno de los mismos hasta obtener el id que
 * se desea tener para poder realizar las cosas que uno quiere como son
 * obtener los ultimos tres registros de los usuarios que se mostraran en
 * los comentarios de cada publicacion
 *
 * @params mixed arreglo de ids
 * @params int numero total de comentarios
 *
 * @return int numero a solicitar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_last_id_subcomment($ids, $valor)
{
    $break = $valor - 3;
    $i = 0;
    foreach($ids as $id)
    {
        if($i == $break)
        {
            return $id->comentarioSimpleId;
            break;
        }
        $i++;
    }
}

/**
 * Helper que se encarga de obtener todos los subcomentarios
 * del pulzo de la empresa para que el usuario al momento de
 * presionar sus empresas pueda ver el ultimo pulzo de cada empresa
 * que este siguiendo asi como todos sus comentarios, que a la larga
 * solo se mostraran los ultimos 3
 *
 * @params int id del pulzo
 * @params int id del negocio
 *
 * @return mixed arreglo con datos del comentario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comments_pulzos($idP, $idN)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios as u')
           ->join('comentarios as c', 'c.comentarioUsuarioId = u.id', 'left')
           ->where('comentarioPulzoId', $idP)
           ->where('comentarioNegocioId', $idN)
           ->order_by('comentarioId', 'DESC')
           ->limit(2);
    $resultados = $CI->db->get();
    return $resultados->result();
}

/**
 * Helper que se encarga de obtener todos los subcomentarios
 * del pulzo de la empresa para que el usuario al momento de
 * presionar sus empresas pueda ver el ultimo pulzo de cada empresa
 * que este siguiendo asi como todos sus comentarios, sin limite de 
 * los mismo
 *
 * @params int id del pulzo
 * @params int id del negocio
 *
 * @return mixed arreglo con datos del comentario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comments_Allpulzos($idP, $idN)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios as u')
           ->join('comentarios as c', 'c.comentarioUsuarioId = u.id', 'left')
           ->where('comentarioPulzoId', $idP)
           ->where('comentarioNegocioId', $idN)
           ->order_by('comentarioId', 'DESC');
    $resultados = $CI->db->get();
    return $resultados->result();
}

/**
 * Helper que se usa para poder obtener el id del negocio que este
 * comentando para poder obtener el avatar del negocio con el cual
 * se le mostrara la imagen de los negocios asi como su nombre
 *
 * @params int id del negocio
 * @return mixed datos del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function datos_negocios($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioUsuarioId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se encarga de obtener todos los datos
 * del usuario que se ha apuntado para que este se
 * pueda mostrar en el comentario de que se intereso en
 * el plan
 *
 * @params int id del plan
 * @return mixed datos del me apunto
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_point($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('meapunto')
           ->where('meApuntoPlanId',$id)
           ->order_by('meApuntoId', 'DESC');
    $query = $CI->db->get();
    return $query->result();
}

/**
 * Helper que ayuda a obtener el total de registros que 
 * tienen ese plan de usuario en me apunto, para conocer
 * si se mostrara algun registro o se omitira
 *
 * @params int id del plan de usuario
 * @return int total de registros en el mismo
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function total_register($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('meapunto')
           ->where('meApuntoPlanId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para poder obtener un unico registro en caso
 * de que solamente haya uno en el comentario del usuario, asi ya no
 * se obtienen los arreglos de los usuario para ciclarlos con un
 * foreach
 *
 * @params int id del plan
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_point_simple($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('meapunto')
           ->where('meApuntoPlanId',$id);
    $query = $CI->db->get();
    return $query->row();
}

/**
 * Helper que se usa para poder obtener las urls que se usaran como
 * links para poder mostrar en los muros de los usuarios los enlaces
 * que se usaran para poder transportarse a otras paginas o colocar
 * un link que al presionarse se pueda realizar la accion sin necesidad
 * de copiar y pegarlo en la barra del navegador
 *
 * @params int id del plan
 * @return string enlace a usar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_hipereference($id)
{
    $CI =& get_instance();
    $CI->db->select('enlace')
           ->from('anexos')
           ->where('anexosPlanId', $id);
    $link = $CI->db->get();
    return $link->row();
}

/**
 * Helper que se usa para poder contar registros de las tablas de la base de 
 * datos para conocer si se tiene que imprimir algo o solo se tiene que brincar
 * al siguiente registro, esto para evitar que se impriman errores en la
 * parte de la vista del usuario
 *
 * @params int id del plan
 * @params string nombre de la tabla
 * @return int numero de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_number_register($id, $name)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from($name)
           ->where('anexosPlanId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para conocer cual es el registro que ha posteado
 * el usuario en caso de que el valor haya sido diferente de cero, con
 * esto obtendremos si hay algun texto en fotos o si hay algun texto en 
 * los hipervinculos y poder saber que es lo que se imprimira
 *
 * @params int id del plan
 * @params string nombre de la tabla
 * 
 * @return mixed datos del renglon
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_type_register($id, $tabla)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from($tabla)
           ->where('anexosPlanId', $id);
    $register = $CI->db->get();
    return $register->row();
}

/**
 * Helper que se usa para colocar el numero de usuarios que se apuntan a
 * algun comentario, este en caso de que se haya apuntado ya el usuario
 * al comentario, ya no dejar que se vuelva a apuntar de nueva cuenta,
 * solo se usara para que se apunten una vez
 *
 * @params int id del usuario
 * @params int id del plan del usuario
 *
 * @return int numero de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function number_of_points_user($idU, $idP)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('meapunto')
           ->where('meApuntoPlanId', $idP)
           ->where('meApuntoUsuarioApuntadoId', $idU);
    $resultados = $CI->db->count_all_results();
    return $resultados;
}

/**
 * Helper que se usa para obtener todas las notificaciones que el
 * usuario tenga una vez que se haya comentado en algun posteo que el
 * tenga o en el que ya este participando con algun comentarios, esto para
 * que se puedan obtener todos los datos que se mostraran
 *
 * @params int id del plan
 * @return mixed datos del plan y las notificaciones
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function obtener_todas_notificaciones($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificaciones')
           ->where('notificacionPlanId', $id)
           ->order_by('notificacionId', 'DESC')
           ->limit(1);
    $resultado = $CI->db->get();
    return $resultado->row();
} 

/**
 * Helper que se usa para poder obtener el ultimo pulzo de la empresa a la 
 * cual estoy siguiendo, esto para que el usuario al presionar sus empresas
 * muestre cuales son las que esta siguiendo y cual es su pulzo mas reciente, 
 * ya sea oferta, reto o experiencia de vida
 *
 * @params int id del negocio
 * @return mixed datos del pulzo mas reciente
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_last_pulzo($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoUsuarioId', $id)
           ->where('pulzoTipo !=', '3')
           ->order_by('pulzoId', 'DESC')
           ->limit(1);
    $pulzo = $CI->db->get();
    return $pulzo->row();
}

/**
 * Helper que se utiliza para poder saber si la categoria tiene o no
 * subcategoraias, esto se hace para asi saber si se muestra una ruta mas larga
 * o es mas corta dependiendo el numero de datos que regrese o si el numero es
 * mayor a cero
 *
 * @params int id de la categoria o subcategoria
 * @return string valores a consultar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_id_category($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('subcategorias')
           ->where('id',$id);
    $query = $CI->db->get();
    return $query->row();
}

/**
 * Helper que se usa para contar si hay mas de un registro en la tabla de 
 * subcategorias esa para saber si hay mas de un nivel o es solo una categoria 
 * sin subcategorias en esta
 *
 * @params int id de la categoria
 * @return int numero de datos
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_count_number_subcategories($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('subcategorias')
           ->where('idGiro', $id);
    $total_numeros = $CI->db->count_all_results();
    return $total_numeros;
}

/**
 * Helper que se usa para obtener el nombre del giro de la empresa que tiene 
 * varios subgiros, esta funcion mandara como resultado el puro nombre del giro 
 * al que se esta llamando por medio de su id
 *
 * @params int id del giro
 * @return string nombre del giro
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_giro($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('giro')
           ->where('id', $id);
    $nombre = $CI->db->get();
    return $nombre->row();
}

/**
 * Helper con el cual se obtendran los datos de las empresas que se estan siguiendo por
 * parte del usuario, esto para poder obtener cuales son las principales empresas a las
 * cuales esta siguiendo cada usuario, asi mostrarlo en la barra izquierda en el perfil
 * de cada usuario, esto va personalizado
 *
 * @params int id del negocio
 * @return array datos de los negocios que sigue el usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_bussines_eight($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('seguidores')
           ->where('seguidorUsuarioId', $id)
           ->order_by('seguidorId', 'DESC')
           ->limit(9);
    $negocios = $CI->db->get();
    return $negocios->result();
}

/**
 * Helper que se usa para poder contar todos los registros que
 * se tienen de amigos por parte del usuario, esto para realizar
 * el conteo y que se muestre en el perfil, aunque solo muestre 8 fotos o
 * 6 fotos debe decir cual es el total de amigos que tiene el usuario
 *
 * @params int id del usuario
 * @return int total de usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_userfriends($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId', $id)
           ->where('amigoAceptado', '3')
           ->where('amigoTipo', '0');
    $total_amigos = $CI->db->count_all_results();
    return $total_amigos;
}

/**
 * Helper que se necesita para obtener el total de datos de los
 * negocios, con los cuales al usuario se le mostrara en su
 * perfil el numero de empresas que esta siguiendo sin necesidad
 * de ir a sus empresas y mostrar cuantas son las que sigue
 *
 * @params int id del usuario
 * @return int numero total de negocios que se siguen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_usercompanies($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('seguidores')
           ->where('seguidorUsuarioId', $id);
    $total_companias = $CI->db->count_all_results();
    return $total_companias;
}

/**
 * Helper que se utiliza para obtener los datos de los amigos  que
 * tiene el usuario, esto para revisar si coinciden con el valor que
 * se esta pasando en la vista. El valor que regresa son todos los datos
 * del renglon perteneciente a la tabla de amigos
 *
 * @params int id del usuario que se envia
 * @params int id del amigo
 *
 * @return mixed datos de la tabla amigos
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_info_friends($id, $idA)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId', $id)
           ->where('amigoAmigoId', $idA)
           ->where('amigoAceptado', '3');
    $informacion = $CI->db->get();
    return $informacion->row();
}

/**
 * Helper que se usa para conocer la relacion que hay entre
 * dos usuarios en la plataforma la cual se usa para poder saber
 * si tienen una amistad, asi poder saber si se postea algo en el
 * muro general de pulzos
 *
 * @params int id del usuario logueado
 * @params int id del usuario que comenta
 *
 * @return mixed arreglo de datos de amigos
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_relation_friends($id1, $id2)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId', $id1)
           ->where('amigoAmigoId', $id2)
           ->where('amigoAceptado', '3');
    $total_renglones = $CI->db->count_all_results();
    return $total_renglones;
}

/**
 * Metodo que se usa para contar el total de registros que se encuentran
 * apuntados de acuerdo al plan que se tiene por el momento, asi poder
 * saber si se hace un foreach interno para acomodar todos los nombres de
 * los usuarios que hayan hecho el me apunto
 *
 * @params int id del plan
 * @return int numero de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_count_pointed($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('meapunto')
           ->where('meApuntoPlanId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para obtener todos los registros que se
 * tengan en el plan, a este se le restaran los dos primeros que
 * se muestran ya, por lo tando debe se descendente el limit
 *
 * @params int id del plan
 * @params int numero de registros - 2
 *
 * @return mixed arreglo de datos con los resultados
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_count_remaining($idP, $total)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('meapunto')
           ->where('meApuntoPlanId', $idP)
           ->order_by('meApuntoId', 'desc')
           ->limit($total);
    $resultados = $CI->db->get();
    return $resultados->result();
}

/**
 * Helper que se usa para contar el numero de registros que se tienen
 * actualmente en la base de datos de los negocios que este siguiendo el
 * usuarios, esto para poder mostrarle la ultima promocion del negocio
 * al que esta siguiendo
 *
 * @params int id del usuario
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_pulzos_posted($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoUsuarioId', $id);
    $total_pulzos = $CI->db->count_all_results();
    return $total_pulzos;
}

/**
 * Helper que utilizamos para obtener los datos de los planes que los usuarios 
 * han creado, esto para obtener la informacion especifica del usuario que lo 
 * escribio y para obtener mas informacion de los planes en referencia a las 
 * notificaciones que se hagan de este
 *
 * @params int id del plan
 * @return mixed datos del renglon
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_plain($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planId', $id);
    $resultados = $CI->db->get();
    return $resultados->row();
}

/**
 * Helper usado para poder obtener todas las notificaciones que
 * se tenga el usuario de manera reciente, esto para que el usuario
 * pueda saber cuantas son y obtener la ultima notificacion que se
 * haya hecho por parte de otro usuario que no seala persona que ha
 * posteado ultimamente
 *
 * @params int id del plan
 * @params int id del usuario
 * 
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_notifications_mines($id, $id2)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificaciones')
           ->where('notificacionPlanId', $id)
           ->where('notificacionUsuarioId', $id2);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper usado para pdoer obtener las notificaciones que
 * se tenga el usuario de manera reciente, esto para que el usuario
 * pueda saber cuantas son y obtener la ultima notificacion que se
 * haya hecho por parte de otro usuario en cuanto a apuntarse al comentario
 * de la persona que lo haya hecho ultimamente
 *
 * @params int id del plan
 * @params int id del usuario
 *
 * @return int total de registro
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_notifications_pointer($id, $id2)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificaciones')
           ->where('notificacionPlanId', $id)
           ->where('notificacionUsuarioId', $id2);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para obtener todos los datos del ultimo
 * registro de notificaciones que se tienen dependiendo el
 * plan, asi no se desapareceran las mimas cuando un usuario haya comentado,
 * estas se apareceran  para que vea la ultima notificacion que se hizo
 *
 * @params int id del usuario
 * @params int id del plan
 *
 * @return mixed datos de la ultima notificacion
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function last_data_notification($idU, $idP)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificaciones')
           ->where('notificacionPlanId', $idP)
           ->where('notificacionUsuarioId !=', $idU);
    $registros = $CI->db->get();
    return $registros->row();
}

/**
 * Helper que se usa para obteber los resultados recientes
 * en los cuales la notificacion reciente sera diferente a
 * 1 y debe coinicidir el id del usuario para conocer si hay algun
 * plan ya hecho
 *
 * @params int id del plan
 * @params int id del usuario
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_notificaciones($id, $idU)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificaciones')
           ->where('notificacionPlanId', $id)
           ->where('notificacionReciente !=', '1')
           ->where('notificacionUsuarioId', $idU);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder obtener si hay una
 * amistad o no la hay entre los dos usuarios y 
 * asi ver si se postea algo en el perfil del mismo
 * o no por no tener relacion alguna de esto.
 *
 * @params int id del usuario de sesion
 * @id usuario del plan
 *
 * @return int total de renglones
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_posibility_friends($id, $id2)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('amigos')
           ->where('amigoUsuarioId', $id)
           ->where('amigoAmigoId', $id2)
           ->where('amigoAceptado', '3');
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper para obtener todos los usuarios que han aceptado el plan
 * que se esta viendo, para al momento de darle ver mas se puedan mostrar
 * arriba de la caja de texto, asi poder observar todos los usuarios que
 * ya estan confirmados y que si pulzaran el plan
 *
 * @params int id del plan
 * @return mixed datos de usuarios que aceptaron
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_people_pulzan($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('invitacionpersonal')
           ->where('invitacionPersonalPlanId', $id)
           ->where('invitacionPersonalAceptadoId', '1');
    $resultados = $CI->db->get();
    return $resultados->result();
}

/**
 * Helper que se usa para obtener todos los usuarios qu eno asistiran al evento
 * que se les esta invitando, esto para que el se puedan visualizar las
 * personas que se retiraron o no pueden salir al evento
 *
 * @params int id del plan
 * @return mixed datos de usuarios que rechazan
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_people_no_pulzan($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('invitacionpersonal')
           ->where('invitacionPersonalPlanId', $id)
           ->where('invitacionPersonalAceptadoId', '2');
    $resultados_no = $CI->db->get();
    return $resultados_no->result();
}

/**
 * Helper que se usa para obtener los datos del padrino del negocio para que
 * este pueda mostrarse del lado izquiero para que los visitantes al
 * perfil puedan visualizar quien ha sido el padrino
 *
 * @params int id del padrino
 * @return mixed datos del padrino
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_sponsor_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('apadrinanegocio')
           ->where('apadrinaNegocioNegocioId', $id);
    $resultados = $CI->db->get();
    return $resultados->row();
}

/**
 * Helper que se usa para crear una arreglo asociativo de los valores que se desean
 * tener una vez que se selecciona el giro de la empresa, esto para que los usuarios
 * puedan seleccionar el subgiro del negocio que estan dando de alta
 *
 * @params int id del giro
 * @return mixed arreglo de datos subcategorias
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_subcategory_id($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('subcategorias')
           ->where('idGiro', $id);
    $queryT = $CI->db->get();
    return $queryT->result();
} 

/**
 * Helper que se utiliza para obtener los datos del subgiro del negocio
 * dependiendo de cual sea su id, esto para mostrarlo una vez que se haya
 * definido dependiendo el giro que se tenga
 *
 * @params int id del subgiro
 * @return mixed datos del subgiro
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_subgiro($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('subcategorias')
           ->where('id', $id);
    $registro = $CI->db->get();
    return $registro->row();
}

/**
 * Se obtiene el valor de sexo del usuario que manda el id
 * para que se pueda checar si es una imagen de hombre o de
 * mujer o la imagen por default. esto para mostrarlo en la
 * barra lateral izquierda del usuario
 *
 * @params int id del usuario
 * @return mixed datos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_sex_of_user($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $resultados = $CI->db->get();
    return $resultados->row();
}

/**
 * Helper que se usa para obtener los datos de la tabla de
 * la notificacion para que por medio de este poder obtener
 * los datos que se mostraran en la parte de las notificaciones
 * de los usuarios
 *
 * @params int id del plan
 * @params int id del usuario
 *
 * @return mixed datos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_notificate($idP, $idU)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificacion')
           ->where('notificaPlanId', $idP)
           ->where('notificaUsuarioId !=', $idU)
           ->order_by('notificaId', 'DESC')
           ->limit(1);
    $notifica = $CI->db->get();
    return $notifica->row();
}

function get_data_notificate_comment($idP, $idU)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('notificacion')
           ->where('notificaPlanId', $idP)
           ->where('notificaUsuarioId', $idU)
           ->order_by('notificaId', 'DESC')
           ->limit(1);
    $notifica = $CI->db->get();
    return $notifica->row();
}

/**
 * Helper necesario para poder obtener todos los
 * datos de los comentarios que se haya hecho como
 * principal para que se puedan poner los nombres en
 * las notificaciones
 *
 * @params int id del plan
 * @return mixed datos del cometario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_datas_comments($idP)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planId', $idP);
    $planes = $CI->db->get();
    return $planes->row();
}

/**
 * Helper que se usa para poder obtener si esta invitado
 * al evento o no y asi ver si aparece el boton de si
 * pulzo o no
 *
 * @params int id del usuario
 * @params int id del plan
 *
 * @return int total de numeros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function im_invitated($idU, $idP)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('invitacionpersonal')
           ->where('invitacionPersonalPlanId', $idP)
           ->where('invitacionInvitadoPersonalId', $idU);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para poder observar si hay coincidencias
 * en una cadena especifica o si no lo hay, esto para saber que
 * la url contienen http:// o no lo contiene, y asi saber como
 * se redireccionara el enlace
 *
 * @params string cadena a revisar
 * @return true or false
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function http_request($str)
{
    $checked = "http://";
    $pos = stristr($str, $checked);
    return $pos;
}

/**
 * Metodo que se usa para poder obtener todos los datos del negocios en
 * el sentido de que se tienen que mostrar los servicios que se obtienen
 * por parte del usuario, esto para poder ofrecer a los usuarios un 
 * conocimiento de lso servicios que se tienen
 *
 * @params int id del negocio
 * @return mixed datos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_services($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('servicios')
           ->where('serviciosNegocioId', $id);
    $servicios = $CI->db->get();
    return $servicios->row();
}

/**
 * Metodo con el cual se vera si hay mas de 1 registro
 * en los datos de servicios para que el usuario vea si
 * tiene algun servicio o no
 *
 * @params int id del negocio
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_count_data_services($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('servicios')
           ->where('serviciosNegocioId', $id);
    $serviciosTotal = $CI->db->count_all_results();
    return $serviciosTotal;
}

/**
 * Metodo que se usa para obtener los valores del arreglo
 * que se esta pasando de los 10 registros mas nuevos que le
 * incumben al usuarios ya sean empresas que sigue, amigos o 
 * posteos propios, se obtiene el id del ultimo registro para de
 * ahi partir en cargar mas
 *
 * @params mixed datos del arreglos mas recientes
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function obtain_array($data)
{
    $val = 0;
    foreach($data as $datos)
    {
        $val = $datos->planId;
    }
    return $val;
}

/**u
 * Metodo que se usa para poder obtener el ultimo pulzo que se ha publicado
 * por parte del negocio cuando se hace referencia a las 10 publicaciones que
 * se tienen mas recientes de las empresas y con esta funcion se obtendran
 * el id de la ultima publicacions
 *
 * @params mixed datos del arreglo mas reciente
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function obtain_array_company($data)
{
    $val = 0;
    foreach($data as $datos)
    {
        $val = $datos->pulzoId;
    }
    return $val;
}

/**
 **/
function obtain_array_last_scribble($data)
{
    $val = 0;
    foreach($data as $datos)
    {
        $val = $datos->scribbleId;
    }
    return $val;
}

/**
 * Metodo que se usa para obtener la informacion de las urls que
 * se ponen como envio de datos en la parte donde el usuario publica, esto
 * para que el usuario que quiera leerlo pueda enviarlo hacia donde esta
 * el articulo de interes
 *
 * @params string url
 * @return mixed datos a mostrar de la nota informativa
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function http_information($url)
{
    $data = file_get_contents($url);
    return $data;
}

/**
 * Metodo que se usa para obtener la informacion de los usuarios que 
 * iran el dia de 'hoy' a algun restaurant
 * @params 
 * @return mixed datos a mostrar de la nota informativa
 * @author jorge Leon
 **/

function get_invitedToday($id)
{
    $hoyStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $CI =& get_instance();
    $CI->db->select('*')
            ->from('planesusuarios')
            ->join('invitacionpersonal', 'invitacionPersonalPlanId = planId', 'left')
            ->where('planFechaInicio',$hoyStamp)
            ->where('planEmpresaPulzoId',$id)
            ->group_by('invitacionInvitadoPersonalId');
    $invitedHoy = $CI->db->get();
    return $invitedHoy->result(); 
}
/**
 * Metodo que se usa para obtener toda la informacion de los usuarios que 
 * iran el en la 'semana' a algun restaurant
 * @params 
 * @return mixed datos a mostrar de la nota informativa
 * @author jorge Leon
 **/
function get_invitedWeek($id){ 
    $fechaHoy=strftime("%Y-%m-%d");
    $hoy=unix_to_human(strtotime("$fechaHoy+1 day"));$cort=explode(' ',$hoy);$cor1=explode('-',$cort[0]);$anio=$cor1[0];$mes=$cor1[1];$dia=$cor1[2];$hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $fechaWeek=explode(' ',unix_to_human(strtotime("+1 week +1 day")));$corte=explode('-',$fechaWeek[0]);
    $semanaStamp = mktime(0, 0, 0, $corte[1], $corte[2], $corte[0]);
    $CI =& get_instance();
    $CI->db->select('*')
             ->from('planesusuarios')
             ->join('invitacionpersonal', 'invitacionpersonal.invitacionPersonalPlanId = planesusuarios.planId', 'inner')
             ->where('planEmpresaPulzoId',$id)
             ->where('planFechaInicio BETWEEN "'.$hoyStamp.'" AND "'.$semanaStamp.'"')
             ->group_by('planFechaInicio');
    $invitedWeek = $CI->db->get();
    return $invitedWeek->result();
}

/**
 * Metodo que se usa para obtener la informacion de los usuarios 
 * extraido por partes, esto es por el dia como unidad, acomodandolo 
 * como un arreglo por dia completando la semana!
 * @params $plan que la obtiene de get_invitedWeek()
 * @return mixed datos a mostrar de la nota informativa
 * @author jorge Leon
 **/
function get_invitedWeeCont($plan){
    $CI =& get_instance();
    $CI->db->select('invitacionInvitadoPersonalId, invitacionPersonalPlanId, planFechaInicio')
            ->from('planesusuarios')
            ->join('invitacionpersonal', 'invitacionpersonal.invitacionPersonalPlanId = planesusuarios.planId', 'inner')
            ->where('planFechaInicio = ' .$plan)
            ->group_by('invitacionInvitadoPersonalId');
    $invitedWeekC = $CI->db->get();
    return $invitedWeekC->result();
}

/**
 * Metodo que se usa para obtener la informacion las empresas 
 * cuando algun uusuario les postea algo 
 * mostrando unicamente el ultimio registro
 * @params $id idEmpresa como Usuario $idE idEmpresa como empresa
 * @return mixed datos a mostrar de la nota informativa
 * @author jorge Leon
 **/
function get_emperiencias($id,$idE){
    $CI =& get_instance();
    $CI->db->select('*')
            ->from('comentarios')
            ->where('comentarioNegocioId',$id)
            ->where('comentarioUsuarioId !='.$idE)
            ->order_by('comentarioId','desc')
            ->limit('1');
    $idEmpresa = $CI->db->get();
    return $idEmpresa->row();
    
}

/**
 * Helpers que se usa para poder obtener el total de etiquetas
 * que pueda tener el usuario y asi poder saber cuantas etiquetas
 * hay del mismo nombre, esto para que se puedan mostrar las palabras
 * dependiendo el numero de similitudes, se crecera la palabra
 *
 * @params string nombre de la etiqueta
 * @return numero
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_tags_experience($str)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('etiquetas')
           ->where('nombre', $str);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder obtener el total de comentarios que
 * se tienen en los diferentes post de los usuarios, esto son restados
 * a 3 comentarios que son los que ya se muestran en la publicacion
 *
 * @params int id del plan
 * @return int numero de comentarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_comments_post($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comentarios_planes')
           ->where('comentarioSimplePlanId', $id);
    $total_comentarios = $CI->db->count_all_results();
    return $total_comentarios;
}

/**
 * Helper que se usa para poder obtener los datos del negocio como 
 * usuario para poder obtener los datos de del tipo de status que
 * estan teniendo para saber si es un negocio dado de alta o es un
 * negocio registrado correctamente
 *
 * @params int id del negocio como usuario
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_by_user_bussiness($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se usa para obtener los datos del negocio para
 * que se puedan obtener ciertos datos de los negocios pero
 * que estan teniendo para saber la informacion especifica
 * de los negocios
 *
 * @params int id del negocio 
 * @return mixed datos del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_by_id_bussiness($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se usa para obtener los datos de los eventos  
 * que el administrador esta dando de alta en su vista!
 *
 * @params int id del usuario de administrador
 * @return void
 * @author jorgeLeon
 **/
function get_all_admin($id){
    $CI =& get_instance();
    $CI->db->select('*')
        ->from('planesusuarios')
        ->where('planUsuarioId',$id)
        ->order_by('planFechaFin', 'ASC');
    $datos = $CI->db->get();
    return $datos->result();
}

/**
 * Metodo que se usa para poder cambiar ciertos caracteres en la cual
 * los posteos o cadenas de los usuarios sean cambiadas de forma que
 * al postear se haga correctamente en facebook y en twitter
 *
 * @params string cadena a revisar
 * @return mixed cadena con reemplazo
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function replace_characters($str)
{
    $str = str_replace("%20", " ", $str);
    $str = str_replace("%3F", "?", $str);
    $str = str_replace("%23", "#", $str);
    $str = str_replace("%3A", ":", $str);
    $str = str_replace("%3B", ";", $str);
    $str = str_replace("%28", "(", $str);
    $str = str_replace("%29", ")", $str);
    $str = str_replace("%24", "$", $str);
    $str = str_replace("%2E%2E%2E", "...", $str);
    $str = str_replace("%FA", "ú", $str);
    $str = str_replace("%F3", "ó", $str);
    $str = str_replace("%ED", "í", $str);
    $str = str_replace("%E9", "é", $str);
    $str = str_replace("%E1", "á", $str);
    $str = str_replace("%D1", "Ñ", $str);
    $str = str_replace("%F1", "ñ", $str);

    return $str;
}

/**
 * Metodo que se usa para poder cambiar los valores de los parametros, esta
 * funcion solo aplica para Facebook, puesto que es la unica a la que se le
 * tiene que mandar a llamar sin acentos en las letras para poder postear correctamente
 * y que no me mande simbolos raros
 *
 * @params string cadena a modificar
 * @return string cadena con cambio de caracteres
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function replace_characters_FB($str)
{
    $str = str_replace("%20", " ", $str);
    $str = str_replace("%3F", "?", $str);
    $str = str_replace("%23", "#", $str);
    $str = str_replace("%3A", ":", $str);
    $str = str_replace("%3B", ";", $str);
    $str = str_replace("%28", "(", $str);
    $str = str_replace("%29", ")", $str);
    $str = str_replace("%24", "$", $str);
    $str = str_replace("%2E%2E%2E", "...", $str);
    $str = str_replace("%FA", "u", $str);
    $str = str_replace("%F3", "o", $str);
    $str = str_replace("%ED", "i", $str);
    $str = str_replace("%E9", "e", $str);
    $str = str_replace("%E1", "a", $str);
    $str = str_replace("%D1", "N", $str);
    $str = str_replace("%F1", "n", $str);
    return $str;
}



/**
 * Metodo que se usa para decodificar la cadena que se manda del movil para el 
 * servidor, con el cual el usuario asi podra observar todos los datos que sean
 * necesarios para que el mismo pueda verlos publicados una ves que los haya 
 * enviado desde el celular
 *
 * @params string cadena a decodificar
 * @return string cadena decodificada
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_decode_string($str)
{
    $str = str_replace("%28", "(", $str);
    $str = str_replace("%29", ")", $str);
    $str = str_replace("%24", "$", $str);
    $str = str_replace("%FA", "ú", $str);
    $str = str_replace("%F3", "ó", $str);
    $str = str_replace("%ED", "í", $str);
    $str = str_replace("%E9", "é", $str);
    $str = str_replace("%E1", "á", $str);
    $str = str_replace("%C1", "Á", $str);
    $str = str_replace("%C9", "É", $str);
    $str = str_replace("%CD", "Í", $str);
    $str = str_replace("%D3", "Ó", $str);
    $str = str_replace("%DA", "Ú", $str);
    $str = str_replace("%D1", "Ñ", $str);
    $str = str_replace("%F1", "ñ", $str);
    $str = str_replace("%E4", "ä", $str);
    $str = str_replace("%EB", "ë", $str);
    $str = str_replace("%EF", "ï", $str);
    $str = str_replace("%F6", "ö", $str);
    $str = str_replace("%FC", "ü", $str);
    $str = str_replace("%C4", "Ä", $str);
    $str = str_replace("%CB", "Ë", $str);
    $str = str_replace("%CF", "Ï", $str);
    $str = str_replace("%D6", "Ö", $str);
    $str = str_replace("%DC", "Ü", $str);
    $tamano = strlen($str);
    $decode = '';
    $i = 0;
    while($i < $tamano)
    {
        if($str[$i] == '%')
        {
            $cut = substr($str, $i+1, 2);
            $hextodec = hexdec($cut);
            $final_string = chr($hextodec);
            $decode.= $final_string;
            $i = $i + 3;
        }
        else
        {
            $decode.= $str[$i];
            $i++;
        }
    }
    return $decode;
}

/**
 **/
function decode_utf8($data)
{
    foreach($data as $datos)
    {
        $val = utf8_decode($datos->scribbleTexto);
    }
}

/**
 * Metodo que se usa para poder obtener todos los datos de los usuarios
 * en cuanto a las coordenadas de los usuarios para que el mismo pueda revisar
 * en la plataforma la ubicacion de donde esta el scribble que se coloco en
 * el muro virtual de la plataforma
 *
 * @params int id del scribble
 * @return mixed datos del scribble
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_of_coordenade($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('scribbles_comments')
           ->where('scribbleId', $id);
    $resultados = $CI->db->get();
    return $resultados->row();
}

/**
 * Metodo que se usa para obtener el ultimo nombre del usuario, el cual es
 * el apellido del mismo para que el usuario pueda obtener solamente el apellido
 * y de ahi hacer lo que se quiera con el apellido del usuario, pero
 * es para eso esta funcion
 *
 * @params int id del usuario
 * @return apellidos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_last_user_name($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $datos = $CI->db->get();
    $last_name = $datos->row();
    return $last_name->apellidos;
}

/**
 * Helper que se usa para obtener los datos de la bonificacion y de los pagos para 
 * poder conocerlos y asi manipularlos al gusto. Se usa para obtener los datos de
 * las facturas y validar diferentes cosas
 *
 * @params int id del money usuario
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_by_money_user($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('money_usuario')
           ->join('money_back', 'usuariosMoneyBackId=moneyBackId', 'left')
           ->where('usuarioMoneyId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper where the system will check if the user can
 * change his password, all this just for know if the user
 * register and loggin with FB or not
 *
 * @params int id
 * @return mixed array
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function checkLoginFB($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper that use the system for know if the user
 * has activate the account for post in social network.
 * If the account is 0, the user receive a true, in another
 * case the user receive the message that account is activate
 * for post in the social network
 *
 * @params int id
 * @return int value
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function check_account_status_post($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $data = $CI->db->get();
    return $data->row();
}
