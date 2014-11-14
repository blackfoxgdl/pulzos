<?php
/**
 * Helper que obtiene los avatares del usuario cuyo ID ha sido llamado
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 17 March, 2011
 * @package Core
 **/

/**
 * Obtener el avatar del usuario delimitado mediante id
 *
 * @param integer $id ID de usuario del cual obtener avatar
 *
 * @return void
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
function get_avatar($id)
{
	$CI =& get_instance();
    $CI->db->select('imagenes.imagenRuta')
        ->from('albums')
        ->join('imagenes', 'imagenes.imagenAlbumId = albums.albumId', 'left')
        ->where('albums.albumUsuarioId', $id)
        ->where('imagenes.imagenAvatar = 1');
    $Q = $CI->db->get();

    if($Q->num_rows() == 0)
    {
        return 'statics/img/default/avatar.jpg';
    }else{
        $path = $Q->row();
        return $path->imagenRuta;
    }
}

/**
 * Helper que se usa para saber cual es la thumb nail de los
 * usuarios para que estos sean mostrados en todas las partes de 
 * los muros de los usuarios en cuanto a comentarios para que no
 * se vean apachurradas las imagenes
 *
 * @params int id del usuario
 * @return ruta de la thumbnail
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/

/**
 * Helper que se usa para saber si hay registros en la 
 * parte donde se puedan obtener los datos de los usuarios
 * para que este mismo pueda obtener los thumb que se 
 * postearan en la parte de las publicaciones hechas desde el movil
 *
 * @params int id del usuario
 * @return url thumb
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_thumb_avatar($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('imagenes_thumb')
           ->where('thumbUsuarioId', $id);
    $valores = $CI->db->get();
    //$datos = $valores->row();
    //return $datos->usuarioThumbName;
	if($valores->num_rows() == 0)
    {
        return 'statics/img/default/avatarempresas.jpg';
    }else{
        $datos = $valores->row();
    return $datos->usuarioThumbName;
	}
}

/**
 * Helper que se usa para saber si hay registros de que
 * existe una imagen determinada como avatar de parte del
 * usuario para poder ponerla desde el inicio o para saber
 * si se pone la predeterminada por la plataforma
 *
 * @params int id del usuario
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function exists_avatar($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('albums')
           ->join('imagenes', 'imagenAlbumId = albumId', 'left')
           ->where('albumUsuarioId', $id)
           ->where('imagenAvatar', '1');
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para obtener el id de la imagen que
 * se esta usando como avatar, esto para que se pueda resetear
 * el avatar y poder en predeterminado por la plataforma
 *
 * @params int id del avatar
 * @return mixed datos del registro
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function avatar_id($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('albums')
           ->join('imagenes', 'imagenAlbumId = albumId', 'left')
           ->where('albumUsuarioId', $id)
           ->where('imagenAvatar', '1');
    $total = $CI->db->get();
    return $total->row();
}



/**
 * Se obtiene le avatar de las empresas
 * mediante el id
 *
 * @params int id de la empresa
 * @return string ruta de la imagen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
 
function get_avatar_negocios($id)
{
	$CI =& get_instance();
    $result = $CI->db->query("select * from albumsnegocios left join imagennegocios on imagenNegocioAlbumId = albumId where albumNegocioId = " . $id . " and imagenNegocioAvatar = 1");
	
	if($result->num_rows() == '0')
	{
		return 'statics/img/default/avatarempresas.jpg';
	}
	else
	{
		$path = $result->row();
		return $path->imagenNegocioRuta;
	}
}

function get_avatarneg($id)
{
		$CI =& get_instance();
	/*$CI->db->select('imagennegocios.imagenNegocioRuta')
		   ->from('albumsnegocios')
		   ->join('imagennegocios','imagennegocios.imagenNegocioAlbumId = albumsnegocios.albumId', 'left')
		   ->where('albumsnegocios.albumNegocioId = ' . $id)
		   ->where('imagennegocios.imagenNegocioAvatar = 1');
    $result = $CI->db->get();*/
    $result = $CI->db->query("SELECT *
FROM altanegocio
INNER JOIN negocios ON altanegocio.altaNegocioNegocioId = negocios.negocioId
INNER JOIN imagennegocios ON imagennegocios.imagenNegocioAlbumId = negocios.negocioUsuarioId
WHERE altanegocio.altaNegocioNegocioId =".$id."");
	
	//var_dump($result);
	
	if($result->num_rows() == '0')
	{
		return 'statics/img/default/avatarempresas.jpg';
	}
	else
	{
		$path = $result->row();
		return $path->imagenNegocioRuta;
	}
}

/**
 * Se obtienen las imagenes a mostrar de los
 * albums para las empresas, las cuales por
 * el momento solo mostrara tres
 *
 * @params int id del negocio
 * @return mixed datos de las imagenes
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_images_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('albumsnegocios')
           ->join('imagennegocios','imagennegocios.imagenNegocioAlbumId = albumsnegocios.albumId', 'left')
           ->where('albumsnegocios.albumNegocioId = ' .$id)
           ->limit(5);
    $query = $CI->db->get();
    if($query->num_rows == 0)
    {
        return 'statics/img/default/avatar.jpg';
    }
    else
    {
        return $query->result();
    }
}

/**
 * Helper que se usa para poder obtener la imagen del plan que se haya
 * armardo por parte del usuario para que al momento de que se llame
 * se pueda mostrar la imagen del plan que arme el usuario
 *
 * @params int id del planImagenId
 * @return string ruta de la imagen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_avatar_plan($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('imageneventos')
           ->join('planesusuarios', 'planId = planesusuariosId', 'left')
           ->where('planId', $id);
    $query = $CI->db->get();
    if($query->num_rows != 0)
    {
        $ruta_imagen = $query->row();
        return $ruta_imagen->imagenRuta;
    }
}

/**
 * Se obtiene el nombre del usuario dependiendo
 * el id que se pasa para sacarlo.
 *
 * @params int id del usuario
 * @return string nombre del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_user($id)
{
    $CI =& get_instance();
    $query = $CI->db->where('id',$id)
                    ->get("usuarios");
    $renglon = $query->row();
    return $renglon->nombre;
}

/**
 * Se obtiene el nombre completo del usuario con solo
 * pasando su id, esto para poder mostrarlo en la
 * parte que mas se desee.
 *
 * @params int id del usuario
 * @return string nombre completo del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_complete_username($id)
{
    $CI =& get_instance();
    $CI->db->select('nombre, apellidos')
           ->from('usuarios')
           ->where('id',$id);
    $query = $CI->db->get();
    $nombre = $query->row();
    return $nombre->nombre . " " . $nombre->apellidos;
}

/**
 * Funcion que se usa para obtener solamente el nombre principal
 * del usuario y asi poder mostrarlo en los seguidores de los usuario
 * de las empresas, para que no se desfasen las cosas del mismo
 *
 * @params int id del usuario
 * @return nombre principal
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_first_name($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $datos = $CI->db->get();
    $renglon = $datos->row();
    return $renglon->nombre;
}

/**
 * Funcion para obtener el avatar del pulzo, dependiendo
 * el que se este guardando en la base de datos, con esta
 * funcion se recuperara la ruta para poder pasando el
 * id del pulzo
 *
 * @params int id del pulzo
 * @return ruta de la imagen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_avatar_pulzo($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoId',$id);
    $query = $CI->db->get();
    $valor = $query->row();
    return $valor->pulzoImagenRuta;
}

/**
 * Helper que ayuda a obtener la imagen de los
 * planes que van creando los usuarios para mostrar en
 * caso de que sea una imagen por defecto una imagen
 * de la fiesta que desee subir el usuario
 *
 * @params int id del usuario
 * @return mixed datos de la imagen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_image_plan($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planUsuarioId',$id);
    $query = $CI->db->get();
    $valor = $query->row();
    return $valor;
}

/**
 * Se obtiene el banner dependiendo si se
 * actualiza o se sube uno nuevo, variando
 * dependiendo de los negocioos
 *
 * @params int id del negocio
 * @return string ruta del banner
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_banner_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('datosExtraNegocios')
           ->where('extraNegocioId',$id);
    $query = $CI->db->get();
    if($query->num_rows() == 0)
    {
        return 'statics/img/banner.jpg';
    }
    else
    {
        $ruta = $query->row();
        return $ruta->extraRutaImagen;
    }
}

/**
 * Helper que se usa para obtener los datos del
 * usuario para en caso de que uno se requiera para evaluar
 * algun valor pues con esto obtenerlo y asui validarlo
 * las veces que sea necesario
 *
 * @params int id del usuario ó negocio
 * @return mixed datos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_complete_userdata($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('usuarios')
           ->where('id', $id);
    $total = $CI->db->get();
    return $total->row();
}

/**
 * Helper where the system check if the user has a albums
 * once login, in case true, the user just update the profile
 * image where will be the image that show in the profile
 *
 * @params int id
 * @return int total
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_albums($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('albums')
           ->where('albumUsuarioId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper that helps to get all the data of the album
 * of specific user that login with facebook, all this for
 * recover the profile picture and update in case that change
 * the picture
 *
 * @params int id
 * @return mixed array
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_album_id($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
        ->from('albums')
        ->where('albumUsuarioId', $id)
        ->where('albumDefault', '1');
    $data = $CI->db->get();
    return $data->row();
}
