<?php
/**
 * Helper que se usa para colocar todas las funciones
 * que se realicen acerca de contador de algun valor o
 * de valores, esto para poder mostrarlo a la vista de
 * los usuario y tambien para obtener algun registro que
 * se use para despues realizar el conteo
 **/

/**
 * Helper que se usa para poder realizar el conteo del numero
 * de pulzos que hay en total en esa categoria, esto para mostrarle
 * al usuario en que categoria hay eventos y en cuales aun no hay
 * algun evento que se publico o esta publicado
 *
 * @params int id de la categoria
 * @return int numero de eventos totales
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_category_pulzos($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioGiro', $id);
    $total_registros = $CI->db->count_all_results();
    return $total_registros;
}

/**
 * Helper que se usa para contar el numero de pulzos que hay
 * en cada subcategria de los giros con los que cuentan, esto
 * para que el usuario pueda conocer cuales subcategorias tienen alguna 
 * oferta o algun pulzo que los usuarios pueden aprovechar
 *
 * @params int id de la subcategoria
 * @return int numero de pulzos en subcategorias
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_subcategory_pulzos($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioSubgiro', $id);
    $total_subcategoria = $CI->db->count_all_results();
    return $total_subcategoria;
}

/**
 * Helper que se usa para poder realizar las consultas del numero
 * de pulzos que se tienen de manera global por categoria, esto para
 * que se puedan mostrar a los usuarios en la parte de actividades del
 * mismo y asi puedan consultarlas sin necesidad de entrar antes a su perfil
 *
 * @params int id de la categoria
 * @params fecha en timestamp o mktime
 *
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_activities_by_day($id, $fecha)
{
    $hoy = unix_to_human(strtotime("+1 day"));
    $cort=explode(' ',$hoy);
    $cor1=explode('-',$cort[0]);
    $anio=$cor1[0];
    $mes=$cor1[1];
    $dia=$cor1[2];
    $hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $between = "pulzoFechaInicio between '$fecha%' and '$hoyStamp%'";
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoCategoria', $id)
           ->where($between, NULL, FALSE);
    
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para contar el total de las subcategorias de los pulzos
 * de los usuarios para que el mismo vea las promociones que hay en los diferentes
 * subcategorias que se tienen en las categorias para que el mismo pueda verlas
 * cuando es por dia
 *
 * @params int id de la subcategoria
 * @params int fecha en timestamp o mktime
 *
 * @return int numero de registros que hay dependiendo al condicion
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_subactivities_by_day($fecha, $id)
{
    $hoy = unix_to_human(strtotime("+1 day"));
    $cort=explode(' ',$hoy);
    $cor1=explode('-',$cort[0]);
    $anio=$cor1[0];
    $mes=$cor1[1];
    $dia=$cor1[2];
    $hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $between = "pulzoFechaInicio between '$fecha%' and '$hoyStamp%'";
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoSubcategoria', $id)
           ->where($between, NULL, FALSE);

    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder realizar las las consultas del numero de pulzos 
 * que se tienen de manera global por categorio, esto para que los usuarios
 * puedan observar todos los pulzos que se tienen por semana, asi consultar
 * las promociones sin necesidad de entrar al perfil de la empresa
 *
 * @params int id de la categoria
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_activities_by_week($id, $fecha)
{
    $hoy = unix_to_human(strtotime("+1 week"));
    $cort=explode(' ',$hoy);
    $cor1=explode('-',$cort[0]);
    $anio=$cor1[0];
    $mes=$cor1[1];
    $dia=$cor1[2];
    $hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $between = "pulzoFechaInicio between '$fecha%' and '$hoyStamp%'";
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoCategoria', $id)
           ->where($between, NULL, FALSE);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder realizar las consultas del numero de pulzos
 * que se tienen actualmente de manera ya especifica para poder saber cuales
 * son los valores que se tienen por cada subcategoria, pero por semana de
 * actividad
 *
 * @params int id de la subcategoria
 * @params int fecha actual en timestamp o mktime
 *
 * @return int total de registros que hay dependiendo la condicion
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_subactivities_by_week($fecha, $id)
{
    $hoy = unix_to_human(strtotime("+1 week"));
    $cort=explode(' ',$hoy);
    $cor1=explode('-',$cort[0]);
    $anio=$cor1[0];
    $mes=$cor1[1];
    $dia=$cor1[2];
    $hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $between = "pulzoFechaInicio between '$fecha%' and '$hoyStamp%'";
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoSubcategoria', $id)
           ->where($between, NULL, FALSE);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder realizar las las consultas del numero de pulzos 
 * que se tienen de manera global por categorio, esto para que los usuarios
 * puedan observar todos los pulzos que se tienen por mes, asi consultar
 * las promociones sin necesidad de entrar al perfil de la empresa
 *
 * @params int id de la categoria
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_all_activities_by_month($id, $fecha)
{
    $hoy = unix_to_human(strtotime("+1 month"));
    $cort=explode(' ',$hoy);
    $cor1=explode('-',$cort[0]);
    $anio=$cor1[0];
    $mes=$cor1[1];
    $dia=$cor1[2];
    $hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $between = "pulzoFechaInicio between '$fecha%' and '$hoyStamp%'";
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoCategoria', $id)
           ->where($between, NULL, FALSE);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder crear todas las actividades que hay pero por 
 * subcategoria al mes, esto para que cuando se despliegue una opcion que
 * tenga subcategorias puedan verse de manera especifica por subcategorias y
 * con un numero que te señalara cuantas ofertas hay en la misma
 *
 * @params int id de la subcategoria
 * @params int fecha en timestamp o mktime
 *
 * @return int numero total de registros
 * @author blackfoxgl <ruben.alonso21@gmail.com>
 **/
function count_all_subactivities_by_month($fecha, $id)
{
    $hoy = unix_to_human(strtotime("+1 month"));
    $cort=explode(' ',$hoy);
    $cor1=explode('-',$cort[0]);
    $anio=$cor1[0];
    $mes=$cor1[1];
    $dia=$cor1[2];
    $hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
    $between = "pulzoFechaInicio between '$fecha%' and '$hoyStamp%'";
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('pulzos')
           ->where('pulzoSubcategoria', $id)
           ->where($between, NULL, FALSE);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Helper que se usa para poder realizar los conteos de los productos que se 
 * tienen por parte de la empresa en cuanto a la oferta que se esta llevando a 
 * cabo y poder mostrarlos antes de poder guardar y hacer la bonificacion 
 * correctamente al usuario
 *
 * @params int id de la oferta
 * @return mixed datos de los productos o categorias
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_producto_category($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('productos_categorias')
           ->where('idOfertas', $id);
    $datos = $CI->db->get();
    return $datos->result();
}

/**
 * Helper uqe se usa para obtener los datos de las redes sociales que la 
 * empresa ha colocado para la promocion de sus productos o compras de
 * la empresa de los usuarios para que los promuevan en sus redes sociales
 *
 * @params int id del negocio como negocio
 * @return mixed datos del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_social_media($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media_empresa')
           ->where('socialEmpresaUsuarioId', $id)
           ->order_by('socialEmpresaId', 'DESC')
           ->limit(1);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se usa para conocer si hay registros en la parte de la tabla de redes
 * sociales de los negocios, esto para que se pueda saber si ya existen los valores
 * de alguna o no y para saber si se transcriben o no
 *
 * @params int id del negocio como negocio
 * @return int valores si existen
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_data_social_media_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media_empresa')
           ->where('socialEmpresaUsuarioId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para poder obtener los datos de las ofertas que la empresa
 * a publicado o ah comenzado a hacer para que sus clientes puedan hacer que
 * les bonifiquen los consumos que tengan dentro de la tienda o en los 
 * restaurantes que esten participando
 *
 * @params int id del negocio como negocio
 * @return mixed datos del negocio de la oferta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_offers_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('ofertas_negocios')
           ->where('idNegocioOferta', $id)
           ->order_by('ofertaId', 'DESC')
           ->limit(1);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se usa para contar el numero de registros que se
 * tienen actualmente en la tabla de ofertas de las empresas, para conocer
 * si se llenan los campos con los registros ya guardados o se creara uno 
 * nuevo con los registros que estaran a disposicion del usuario una vez
 * que haya hecho el proceso de bonificacion
 *
 * @params int id del negocio como negocio
 * @return int numero de registros encontrados
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_number_register_social($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('ofertas_negocios')
           ->where('idNegocioOferta', $id)
           ->order_by('ofertaId', 'DESC');
    $total = $CI->db->count_all_results();
    return $total; 
}

/**
 * Metodo que se usa para poder contar los valores que vamos a tener
 * en la parte de la tabla de los usuarios en social media para que
 * estos puedan contar los valores que hay en la tabla y ya repeti
 * como 3 veces lo mismo
 *
 * @params int id del usuario
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_number_social_data_user($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media')
           ->where('socialUsuarioId', $id);
    $totales = $CI->db->count_all_results();
    return $totales;
}

/**
 * Metodo que se usa para poder contar los valores que vamos a tener
 * en la parte de la tabla de los usuarios en social media para que
 * estos puedan contar los valores que hay en la tabla y ya repeti
 * como 3 veces lo mismo
 *
 * @params int id del usuario
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_user_social($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media')
           ->where('socialUsuarioId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Metodo que se usa para poder extraer los valores de los usuarios con los
 * cuales unos se pueden saber si hay mas de un valor o no hay ninguno,
 * esto para que el usuario pueda ver desplegadas las listas de los usuarios
 *
 * @params int id de la oferta
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_offerts($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('productos_categorias')
           ->where('idOfertas', $id);
    $valores = $CI->db->count_all_results();
    return $valores;
}
/**
 * Metodo que se usa para extraer los valores de los usuarios para
 * conocer todos los datos que hay referentes a la nueva oferta que esta
 * dando de alta el negocio donde el mismo podra despues checar si puede modificar
 * los datos o no
 *
 * @params int id de la oferta
 * @return mixed dato a mostrar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_simple_value($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('productos_categorias')
           ->where('idOfertas', $id)
           ->limit(1);
    $resultado = $CI->db->get();
    return $resultado->row();
}

/**
 * Metodo que se usa para poder obtener todos los demas registros, esto para saber
 * que si hay mas de uno pues entonces mandar el valor al usuario de los demas registros
 * para colocarlos en las cajas de texto una vez que esten ahi llenarlas
 *
 * @params int id de la oferta
 * @return mixed datos a mostrar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_double_value($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('productos_categorias')
           ->where('idOfertas', $id);
    $resultados = $CI->db->get();
    return $resultados->result();
}

/**
 * Helper que se usa para obtener los mensajes que se tienen actualmente en la
 * base de datos por parte de la oferta, estos son los mensajes para que el
 * negocio para ver tambien sus  mensajes de promocion en las diversas redes
 * sociales que estan en para ligar con el usuario
 *
 * @params int id del mensaje
 * @return mixed datos a obtener
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_social_messages($idM)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media_empresa')
           ->where('socialEmpresaId', $idM);
    $resultados = $CI->db->get();
    return $resultados->row();
}

/**
 * Metodo que se encarga de generar el numero de referencia que se tendra
 * por bonificacion que el negocio le haga al cliente, esto para poder obtener
 * todos las especificaciones sean identificadas por un numero unico de referencia
 *
 * @params string nombre de la empresa
 * @params string timestamp fecha actual
 * 
 * @return string cadena codificada
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function reference_number($nombre, $fecha)
{
    $nombre_sin_espacios = str_replace(" ", "", $nombre);
    $numero_referencia = sha1($nombre_sin_espacios.$fecha);
    return $numero_referencia;
}

/**
 * Metodo que se usa para poder obtener todos los datos relacionados con el historial de
 * bonificacion de los usuarios pero de manera individual en el cual se usara para obtener
 * solo los registros que coincidan con la condicion, los cuales seran todos los registros
 * de bonificacion que tienen los usuarios
 *
 * @params int id del historial
 * @return mixed datos a mostrar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_individual_data($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comisionRecibida')
           ->where('comisionRecibidaHistorialId', $id);
    $datos = $CI->db->get();
    return $datos->result();
}

/**
 * Metodo que se usa para poder obtener los datos de los tags en cuanto al id de la promocion
 * para que se pueda activar o desactivar, esto para que se pueda realizar el proceso que se
 * desea en cuanto a la parte de la promocion y asi que el negocio decida si la quiere tener
 * visibles o invisible dependiendo si se quiere o no tener activa
 *
 * @params int id de la oferta
 * @return mixed datos del registro
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_geotag_data($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('geotag_oferta')
           ->where('ofertaOId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Metodo que se usa para poder conocer si hay registros en los datos sociales para conocer
 * si el usuario ya tiene registradas sus redes sociales o si aun no ha dado de alta, esto
 * para conocer si puede realizar las bonificaciones por parte de la empresa y que se puedan
 * publicar los mensajes que deben ir en las redes sociales
 *
 * @params int id del usuario
 * @return int numero de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_datos_socialmedia($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media')
           ->where('socialUsuarioId', $id);
    $datos = $CI->db->count_all_results();
    return $datos;
}

/**
 * Metodo que se encarga de ya obtener los datos del usuario en caso de que si
 * haya algun registro con este id, esto para que el usuario pueda hacer las 
 * cosas que se tienen que hacer al momento de bonificaciones, en caso de que
 * no tenga ninguna red social activa por parte de los usuarios ese es otro
 * choro
 *
 * @params int id del usuario
 * @return mixed datos del usuario
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_datossociales_usuarios($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('social_media')
           ->where('socialUsuarioId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se utiliza para poder realizar la desencriptacion
 * de la cadena que se esta pasando. Al momento de llamar esta 
 * funcion te regresa el token que ya ha sido pasado para verificar
 * si el mismo es valido o si es incorrecto, esto para poder probar que
 * no quieran mandar datos o modificar los mismo para una ganancia
 * propia
 *
 * @params string value encode
 * @return string value decode
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function decode_string($str)
{
    $str = str_replace('.', '=', $str);
    $decode = base64_decode($str);
    $cut = explode('+', $decode);
    $encode = base64_encode($cut[1]);
    return $encode; 
}

/**
 * Helper que se usa para poder realizar las codificaciones de los
 * usuarios con los cuales el codigo se extraer los datos necesarios
 * para poder obtener los datos que se checaran en la base de datos
 * con los cuales despues se extraeran los registros y se veran
 * con las comparaciones del codigo
 *
 * @params string code encode
 * @return string code decode
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function decode_pk($str)
{
    $str = str_replace('.', '=', $str);
    $decode = base64_decode($str);
    $ct = explode('+', $decode);
    return $ct[1];
}

/**
 * Metodo que se usa para poder revisar que el token contenga valores validos
 * en cuanto a los caracteres que se contienen una vez que se ha decodificado
 * para saber si es un token valido o si es un token invalido. En caso de que
 * sea un token invalido, entonces se devolvera automaticamente en un valor
 * no reconocido para seguir con el proceso
 *
 * @params string code encode
 * @return boolean TRUE or FALSE
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function check_validate_code($str)
{
    $str = base64_decode($str);
    $total = substr_count($str, '+');
    if($total == 2)//PRIMER VALIDACION '+'
    {
        $cut1 = explode('+', $str);
        $is_int = is_numeric($cut1[0]);
        if($is_int == 1) //SEGUNDA VALIDACION 'NUMERIC'
        {
            $total2 = substr_count($cut1[1], '_');
            if($total2 == 4) //TERCER VALIDACION '_'
            {
                $cut1[1] = str_replace('_', '', $cut1[1]);
                $is_int2 = is_numeric($cut1[1]);
                if($is_int2 == 1) //CUARTA VALIDACION 'NUMERIC'
                {
                    return TRUE;
                }
                else //CUARTA VALIDACION 'NUMERIC'
                {
                    return FALSE;
                }
            }
            else //ELSE TERCER VALIDACION '_'
            {
                return FALSE;
            }
        }
        else //SEGUNDA VALIDACION 'NUMERIC'
        {
            return FALSE;
        }
    }
    else //ELSE PRIMER VALIDACION '+'
    {
        return FALSE;
    }
}

/**
 * Metodo que se usa para poder realizar el chequeo de los valores
 * del total de dinero que se tiene disponible por parte del 
 * usuario y saber si es mayor al que se tiene como posible pago,
 * esto en caso de que el usuario si tenga registro
 *
 * @params int id del usuario
 * @return mixed user data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function check_disponibility($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('money_total')
           ->where('moneyTotalUsuarioId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Metodo que se usa para obtener todas las ofertas que se tienen
 * en la parte de los negocios, las cuales son las ofertas que
 * estan a la disposicion de los usuario que solicitaran las
 * bonificaciones. Se obtienen todas las bonificaciones todas
 * activas.
 *
 * @params int id del negocio
 * @return mixed data company
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_data_offerts($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->join('ofertas_negocios', 'idPlanUsuarioOfertaNegocio = planId', 'right')
           ->where('idNegocioOferta', $id)
           ->where('ofertaActivacion', '1');
    $datos = $CI->db->get();
    return $datos->result();
}

/**
 * Helper que se usa para obtener los datos de las comisiones y ofertas que
 * tiene actualmente el usuario dependiendo de los tres valores como son
 * su id, el id del negocio y el folio que quiera recuperar, con esto
 * podremos obtener los datos restantes que sean necesarios
 *
 * @params int id del usuario
 * @params int id del negocio
 * @params string folio
 *
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function data_transactions_users($id, $idN, $ff)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('comisionRecibida')
           ->join('historialDeposito', 'comisionRecibidaHistorialId = idHistorial', 'left')
           ->where('comisionRecibidaUsuarioId', $id)
           ->where('comisionRecibidaEmpresaId', $idN)
           ->where('comisionRecibidaFolioTransaccion', $ff);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Metodo que se usa para poder obtener los datos de los mensajes que estan
 * relacionados con las ofertas que tiene el negocio y asi poder realizar la
 * visualizacion para el usuario con el cual podra ver cuales son sus
 * bonificaciones pendientes o pagadas
 *
 * @params int id de oferta
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function bonifications_data_message_offerts($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('ofertas_negocios')
           ->join('planesusuarios', 'idPlanUsuarioOfertaNegocio = planId', 'right')
           ->where('ofertaId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Metodo que se usa para poder obtener solamente los datos
 * de un arreglo que se tienen por parte de la fecha y se crea un
 * arreglo asocitativo con el cual estos datos seran necesarios para
 * despues crear un arreglo simple
 *
 * @params int mes
 * @params int año
 * @params object datos a revisar
 *
 * @return array
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function create_array_transactions($data, $data2)
{
    $p = array();
    $a = array();
    $cont = 0;
    foreach($data as $datas)
    {
        $p['edo_usuario'][$cont] = $datas->transaccionUsuarioId;
        $p['edo_negocio'][$cont] = $datas->transaccionNegocioId;
        $p['edo_total'][$cont] = $datas->transaccionTotalPagar;
        $p['edo_fecha'][$cont] = $datas->transaccionFechaHora;
        $p['edo_numero'][$cont] = $datas->transaccionCodigoVenta;
        $p['edo_status'][$cont] = '5';
        $cont++;
    }

    foreach($data2 as $datas2)
    {
        echo $cont;
        $a['edo_usuario'][$cont] = $datas2->comisionRecibidaUsuarioId;
        $a['edo_negocio'][$cont] = $datas2->comisionRecibidaEmpresaId;
        $a['edo_total'][$cont] = $datas2->comisionRecibidaUsuarioBonificacion;
        $a['edo_fecha'][$cont] = $datas2->comisionRecibidaFechaTransaccion;
        $a['edo_numero'][$cont] = $datas2->comisionRecibidaNumeroReferencia;
        $a['edo_status'][$cont] = '6';
        $cont++;
    }
    
    return array_merge($p, $a);
}

/**
 * Metodo que se usa para poder realizar el corte de la fecha que se hizo
 * la transaccion o la bonificacion, esto para que los usuarios puedan ver
 * el filtro de los estados de cuenta por mes y no se confundan en general
 * con todos los meses
 *
 * @params string date filter
 * @return string cut date
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_date_filter($str)
{
    $primer = explode(' ', $str);
    $filtro = explode('-', $primer[0]);
    $cad = $filtro[1] . '-' . $filtro[2];
    return $cad;
}

/**
 * Helper que se usa para poder contrar si hay algun registro
 * que coincida con la fecha que se esta mandando para consultar
 * los datos que se tienen actualmente en el arreglo y asi saber
 * si hay algun registro o no hay nada
 *
 * @params array data
 * @params int month
 * @parmas int year
 *
 * @return int register number
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_data_outside($data, $month, $year)
{
    $contador = 0;
    $fecha = $month . '-' . $year;
    foreach($data as $datos)
    {
        $corte = explode(' ', $datos->transaccionFechaHora);
        $segundo = explode('-', $corte[0]);
        $tercero = $segundo[1] . '-' . $segundo[2];
        if($fecha == $tercero)
        {
            $contador++;
        }
    }
    return $contador;
}

/**
 * Helper que se usa para poder contrar si hay algun registro
 * que coincida con la fecha que se esta mandando para consultar
 * los datos que se tienen actualmente en el arreglo y asi saber
 * si hay algun registro o no hay nada
 *
 * @params array data to check
 * @params int month
 * @params int day
 *
 * @return int total register
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_data_inside($data, $mes, $ano)
{
    $contador = 0;
    $fecha = $mes . '-' . $ano;
    foreach($data as $datos)
    {
        if($datos->fechaDepositoComisionUsuario != '0')
        {
            $corte = explode('-', $datos->fechaDepositoComisionUsuario);
            $final = $corte[1] . '-' . $corte[2];
            if($final == $fecha)
            {
                $contador++;
            }
        }
    }
    return $contador;
}

/**
 * Helper que se usa para contar el total de registros que se encuentran
 * en la parte de los datos para realizar las transferencias de los 
 * usuarios en las cuales se podran realizar enviando la solicitud de
 * correos electronicos y con lso datos de dicho usuario. Regresa el total
 * de registros
 *
 * @params int id del usuario
 * @return int total de registro
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_total_register_tranfer($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('tranferencias_usuarios')
           ->where('idUsuarioTransferenciaUsuario', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para obtener todos los datos de los usuarios los cuales
 * son necesarios para llenar el area de la parte de los datos de las 
 * transferencias, para que les puedan transferir el dinero que sea necesario
 * o que ellos soliciten sea transferido a su cuenta bancaria
 *
 * @params int id del usuario
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_data_transfers($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('tranferencias_usuarios')
           ->where('idUsuarioTransferenciaUsuario', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se usa para poder obtener los datos de los planes que serian
 * los titulos para las empresas en cuanto a las ofertas y que estas
 * puedan realizar la visualizacion de los titulos en lugar de los textos
 * de promociones de usuarios
 *
 * @params int id del plan
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_title_offert($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('planesusuarios')
           ->where('planId', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper que se usa para poder obtener el nombre del banco dependiendo
 * cual es el id que se esta pasando, esto para que al momento de que se
 * mande el correo electronico se ponga el banco al cual pertenece la
 * clabe del usuario que esta solicitando la transfer
 *
 * @params int id del banco
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_banco($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('bancos')
           ->where('id', $id);
    $datos = $CI->db->get();
    return $datos->row();
}

/**
 * Helper usado para poder obtener los datos de las compañias para que se
 * puedan realizar las operaciones necesarias por medio del usuario con el
 * cual este mismo se usara para manipular pero los datos por medio del
 * correo electronico
 *
 * @params string email company
 * @return mixed array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_email_company_data($str)
{
    $CI =& get_instance();
    $CI->db->where('negocioEmail', $str);
    $datos = $CI->db->get('negocios');
    return $datos->row();
}

/**
 * Metodo que se usa para poder realizar lo de los envios de correos
 * por parte de noc. La neta no me acuerdo para que era la funcion pero creo
 * que era para envios de correos, algun dia saldra para que servia esta
 * funcion por el momento ahorita no
 *
 * @params id noc de que es el id
 * @return array data
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_bonification_data($id)
{
    $CI =& get_instance();
    $CI->db->where('inboxnMoneyUser', $id);
    $datos = $CI->db->get('inboxn');
    return $datos->row();
}

/**
 * Helper que se usa para poder obtener los datos de los registros que ya
 * se hayan dado de alta una vez que el usuario ya haya presionado el 
 * boton de bonificar o de declinar, esto para conocer si ya pulzo o no y
 * que se deshabiliten los botones mientras se arregla la parte de ie
 *
 * @params int id del usuario
 * @params int id de la oferta
 * @params string folio / factura
 * 
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_register_data_accept($idU, $idO, $ff)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('bonificaciones_ie')
           ->where('bonificacionIeUsuario',$idU)
           ->where('bonificacionIePlan',$idO)
           ->where('bonificacionIeFolioFactura',$ff);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para contar el numero de registros que hay
 * con el id del money back esto para que no lance un error en
 * caso de que no haya nada de eso y que no se haya registrado la bonificacion
 *
 * @params int id del money usuario
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_data_offerts($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('money_usuario')
           ->join('money_back', 'usuariosMoneyBackId=moneyBackId', 'left')
           ->where('usuarioMoneyId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para poder realizar u obtener el nombre del negocio
 * de una manera mas especifica para que este se pueda manipular en la parte
 * de la plataforma donde se desee, esto para solo obtener el nombre del negocio
 *
 * @params int id del negocios como usuario
 * @return string nombre del negocio
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_complete_username_company($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('negocios')
           ->where('negocioUsuarioId', $id);
    $datos = $CI->db->get();
    $query = $datos->row();
    return $query->negocioNombre;
}

/**
 * Helper que se usa para poder obtener el numero total de
 * registros que se tienen actualmente guardados, esto para conocer
 * si tienen alguna foto ya asiganada o tiene que ser la foto por
 * defecto la que se asignara en esta parte
 *
 * @params int id del negocio como usuario
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_total_count_thumb($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('imagenes_thumb')
           ->where('thumbUsuarioId', $id);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper que se usa para conocer si el usuario sigue al negocio o
 * no lo sigue, para conocer que boton se va a mostrar que pueda el usuario hacer
 * click y ya sea que quiera seguirlo o dejarlo de seguir, esto
 * va dependiendo la eleccion del usuario
 *
 * @params int id del usuario
 * @params int id del negocio como negocio
 *
 * @return int total de registros
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function know_follow_company($idU, $idN)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('seguidores')
           ->where('seguidorUsuarioId', $idU)
           ->where('seguidorNegocioId', $idN);
    $total = $CI->db->count_all_results();
    return $total;
}
