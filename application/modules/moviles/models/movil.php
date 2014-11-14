<?php
/**
 * Modelo para obtener todos los datos de autentificacion
 * de la parte movil, esto se usa para todas las conexiones
 * a las bases de datos sin mezclarlo con la demas plataforma
 * que tengamos en la parte de web para usarios fuera de moviles
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Oct 03, 2011
 * @package Moviles
 **/
class Movil extends CI_Model{

    /**
     * Metodo que se usa para declarar algunas variables o
     * inicializar algun valor que se desee en la parte del
     * modelo para su mas facil manipulacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Metodo que se usa para poder obtener los datos del usuario
     * como lo es el id para saber si el usuario esta registrado o
     * no y asi saber si se loguean o no
     *
     * @params string email del usuario
     * @params string password del usuario
     *
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function login_user($email, $pass)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $pass);
        $query = $this->db->get('usuarios');
        if($query->num_rows() > 0)
        {
            $datos = $query->row();
            return $datos->id;
        }
        else
        {
            return false;
        }
    }

    /**
     * Metodo que se usa para poder obtener los datos del usuario
     * por medio del cual se podran manipular en la plataforma movil,
     * estos se mostraran una vez que se este logueado
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function personal_data_user($id)
    {
        $datos = $this->db->query('select * from usuarios left join imagenes_thumb on id = thumbUsuarioId where id = ' . $id);
       /* $this->db->where('id', $id);
        $datos = $this->db->get('usuarios');*/
       return $datos->row_array();
    }

    /**
     * Metodo que se usa para obtener los datos de las redes sociales
     * que se tienen como un contador, esto para conocer si existen los
     * registros actualmente o solo se tienen valores especificados
     *
     * @params int id del usuario
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function redes_sociales_count_user($id)
    {
        $this->db->where('socialUsuarioId', $id);
        $totales = $this->db->count_all_results('social_media');
        return $totales;
    }

    /**
     * Metodo que se usa para poder guardar los datos del usuario en los
     * cuales se refire a los posteos que se hacen desde el movil en una
     * pared o una empresa
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_scribble($data)
    {
        if($this->db->insert('scribbles_comments', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder obtener el avatar del usuario dependiendo
     * el id, pues con este se podra obtener el avatar que se tienen actualmente
     * solo regresando la url donde esta alojada la imagen, esto para evitar regresar
     * un arsenal de datos que no se usaran
     *
     * @params int id del usuario
     * @return string url del avatar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_avatar($id)
    {
        $this->db->select('imagenes.imagenRuta')
                 ->from('albums')
                 ->join('imagenes', 'imagenes.imagenAlbumId = albums.albumId', 'left')
                 ->where('albums.albumUsuarioId', $id)
                 ->where('imagenes.imagenAvatar = 1');
        $query = $this->db->get();
        if($query->num_rows() == 0)
        {
            return 'statics/img/default/avatar.jpg';
        }
        else
        {
            $avatar = $query->row();
            return $avatar->imagenRuta;
        }
    }

    /**
     * Metodo que se usa para obtener el avatar nuevo del usuario como
     * thumbnail para que el movil pueda recuperar las imagenes de una
     * manera mas sencilla y que se agilice la carga de los usuarios en
     * el mismo dato del proceso
     *
     * @params int id del usuario
     * @return datos de la imagen
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_avatar_thumb($id)
    {
        $this->db->where('thumbUsuarioId', $id);
        $datos = $this->db->get('imagenes_thumb');
        $img = $datos->row();
        return $img->usuarioThumbName;
    }

    /**
     * Metodo que se usa para poder contar todos los comentarios que se
     * tengan en la parte del comentario padre de scribbles para mostrar
     * el numero y despues sumarlo en caso de que haya otro comentario
     * hijo del comentario padre creado
     *
     * @params int id del comentario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_scribble_comment($idC)
    {
        $this->db->where('scribbleId', $idC);
        $totales = $this->db->get('scribbles_comments');
        $querys = $totales->row();
        return $querys->totalComentarios;
    }

    /**
     * Metodo que se usa para actualizar los datos de los
     * comentarios totales que se tienen por parte del usuario
     * con los cuales el mismo podra reescribir los numeros
     * totales de comentarios y noc que vergas dije
     *
     * @params int id del comentario scribble
     * @params int total de comentarios
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_sons_comments($id, $tc)
    {
        $this->db->where('scribbleId', $id);
        $this->db->update('scribbles_comments', array('totalComentarios'=>$tc));
    }

    /**
     * Metodo que se usa para poder obtener los comentarios de un
     * scribble principal, esto para que el usuario pueda obtener o
     * hacer que un comentario una vez que ha visualizado todos los
     * scribbles que se tienen
     *
     * @params int id del scribble principal
     * @return mixed datos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_simple($id)
    {
        $datos = $this->db->query('select * from scribbles_comments left join usuarios on scribbleUsuarioId = id where scribbleId = ' . $id . ' or scribbleFatherId = ' . $id);
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder guardar los datos de los scribbles que
     * se hayan posteado por medio del area de los celulares, que seria
     * el posteo que se tiene en el restaurante de un comentario que se 
     * haya dejado
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_plain($data)
    {
        $this->db->insert('planesusuarios', $data);
    }

    /**
     * Metodo que se usa para consultar los comentarios padres que se tengan por el
     * momento en cierto rango, esto para no traer todas las mengigas etiquetas que
     * se tienen guardadas y asi es mas controlado la obtencion de la informacion
     *
     * @params int longitud
     * @params int latitud
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_tags_limit()
    {
        $this->db->where('scribbleFatherId', '0');
        $this->db->order_by('scribbleId', 'DESC');
        $this->db->limit(10);
        $totales = $this->db->get('scribbles_comments');
        return $totales->result();
    }

    /**
     * Metodo que se usa para consultar los comentarios padres que se tengan por el
     * momento en cierto rango, esto para no traer todas las mengigas etiquetas que
     * se tienen guardadas y asi es mas controlado la obtencion de la informacion
     *
     * @params int longitud
     * @params int latitud
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_tags_limit_new($c1, $c2, $c3, $c4)
    {
        $totales = $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading != 370 order by scribbleId DESC limit 20');
       /* $this->db->where('scribbleFatherId', '0');
        $this->db->order_by('scribbleId', 'DESC');
        $this->db->limit(10);
        $totales = $this->db->get('scribbles_comments');*/
        return $totales->result_array();
    }

    /**
     * Clon de la funcion de arriba
     **/
    public function get_all_tags_limit_new_v2($c1, $c2, $c3, $c4)
    {
        $totales = $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading != 370 and heading < 2000 order by scribbleId DESC limit 10');
       /* $this->db->where('scribbleFatherId', '0');
        $this->db->order_by('scribbleId', 'DESC');
        $this->db->limit(10);
        $totales = $this->db->get('scribbles_comments');*/
        return $totales->result_array();
    }

    /**
     * Method for get all the companies by location, for
     * know what company has pulzos and where can receive
     * money for get check in
     *
     * @params double latitud
     * @params double longitud
     *
     * @return mixed array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_companies_coords($c1, $c2, $c3, $c4)
    {
        $all = $this->db->query('select negocioId, negocioNombre, negocioEsSucursal, negocioEmail from negocios left join usuarios on id = negocioUsuarioId where(negocioLatitud between ' . $c1 . ' and ' . $c2 . ') and (negocioLongitud between ' . $c3 . ' and ' . $c4 . ') and statusEU != 2');
        return $all->result_array();
    }

    /**
     * Metodo que se encarga de extraer los datos de las etiquetas corporativas que
     * haya colocado el negocio tomando en cuenta que el mismo ha creado
     * promociones, estas solo se obtendran si tienen el heading en 370
     *
     * @params double latitudes y longitudes
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_tags_company($c1, $c2, $c3, $c4)
    {
        $totales = $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading = 370 and scribbleStatus = 1 order by scribbleId DESC limit 5');
       /* $this->db->where('scribbleFatherId', '0');
        $this->db->order_by('scribbleId', 'DESC');
        $this->db->limit(10);
        $totales = $this->db->get('scribbles_comments');*/
        return $totales->result_array();
    }

    /**
     * Clon de esta
     **/
    public function get_all_tags_company_v2($c1, $c2, $c3, $c4)
    {
        $totales = $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading = 370 and scribbleStatus = 1 order by scribbleId DESC limit 5');
       /* $this->db->where('scribbleFatherId', '0');
        $this->db->order_by('scribbleId', 'DESC');
        $this->db->limit(10);
        $totales = $this->db->get('scribbles_comments');*/
        return $totales->result_array();
    }

    /**
     * Metodo que se usa para obtener todos los datos de los negocios en cuanto
     * a las imagenes que hayan subido y que coincidan con las coordenadas que
     * se pasen o se envien por medio del equipo celular, esto para que
     * los usuarios puedan visualizar las imagenes en ciertas partes del negocio
     *
     * @params double latitude y longitude
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_tags_company_image_v2($c1, $c2, $c3, $c4)
    {
        $todas = $this->db->query('select * from scribbles_comments right join geo_pictures on geoPictureIdTag = scribbleId where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading > 370 and scribbleStatus = 1 order by scribbleId DESC limit 10');
        return $todas->result_array();
    }

    /**
     * Obtener el id del plan para que el usuario al momento de comentar un scrible este
     * sea ligado automaticamente y aparesca en la plataforma para que el mismo se pueda
     * ver en la computadora como si fuera un comentario normal
     *
     * @params int id del comentario padre del scribble
     * @return mixed datos del comentario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_plain_insert($id)
    {
        $this->db->where('planScribbleId', $id);
        $datos = $this->db->get('planesusuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para guardar en la tabla de los comentarios de los planes o scribles
     * que se han hecho esto para que al momento que se haga un comentario del scribble
     * aparesca como si se hizo en la parte del muro y asi poder mostrar a los usuarios
     * las conversaciones correctas sin necesidad de llevar dos historias diferentes
     * en el mismo comentario o scribble
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_subcomment_from_scribble($data)
    {
        $this->db->insert('comentarios_planes', $data);
    }

    /**
     * Metodo que se usa para poder crear cuentas desde el movil o desde la app de pulzos,
     * con los cuales se hara el registro de usuario nuevo, esto para que no tengan la
     * necesidad de ingresar a un navegador para obligarlos a darse de alta
     *
     * @params mixed datos a insertar
     * @return int id del usuario nuevo o false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function new_user_from_movil($data)
    {
        if($this->db->insert('usuarios', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }

    /**
     * Metodo que se usa para poder realizar la creacion del registro para
     * los datos de los usuarios que han sido registrados como nuevos, esto
     * para conocer mas acerca de su perfil y poder conocer los datos de los
     * usuarios de manera personal, asi saber sus intereses y demas cosas
     *
     * @params mixed datos a insertar
     * @return int id del usuario o false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function new_personal_data_register($data)
    {
        if($this->db->insert('personal', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }

    /**
     * Metodo que se usa para obtener las ciudades que se han dado de alta
     * en la parte de los pulzos, esto para que los usuarios puedan darse de
     * alta y elegir las ciudades correctamente desde las listas desplegables
     *
     * @return mixed arreglo asociativo con ciudades
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function cities_countries_pulzos($datos)
    {
        $this->db->select('id, nombre');
        $datos = $this->db->get($datos);
        return $datos->result();
    }

    /**
     * Metodo que se usa para crear las amistades con los administradores de la
     * plataforma los cuales estan informando todos los eventos para que los
     * usuarios puedan visualizarlos, esto va dependiendo si son de colima o
     * de guadalajara y dependiendo a que ciudad pertenezcan se asiganara el 
     * administrador correspondiente
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_friendly($data)
    {
        $this->db->insert('amigos', $data);
    }

    /**
     * Metodo que se usa para poder realizar la accion de seguir automaticamente
     * a los administradores de la plataforma que son empresas que publican las
     * ofertas o actividades que los usuario pueden tomar en cuenta en sus
     * diversas ciudades
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_follower_company($data)
    {
        $this->db->insert('seguidores', $data);
    }

    /**
     * Metodo que se usa para poder saber si el usuario ya tiene algun registro en
     * sus redes sociales, esto para conocer si se inserta un nuevo registro o para
     * conocer si solo se actualizan los datos del usuario
     *
     * @params int id del usuario
     * @return int numero de registros totales
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_social_media($id)
    {
        $this->db->where('socialUsuarioId', $id);
        $totales = $this->db->count_all_results('social_media');
        return $totales;
    }

    /**
     * Metodo que se usa para poder guardar los datos de las redes sociales que se estan
     * ligando a la aplicacion y la plataforma en general de pulzos, esto para que se
     * puedan guardar y tener acceso general de pulzos
     *
     * @params mixed datos a insertar
     * @return id usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_facebook($data)
    {
        if($this->db->insert('social_media', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa pára actualizar los datos de los usuarios con
     * los cuales se podra especificar a cuales redes sociales estan 
     * ligadas su cuenta de la plataforma pulzos, esto para que puedan
     * pulzar en el muro de facebook desde el movil, asi como dejarlo en
     * la realidad virtual de facebook
     *
     * @params mixed datos a actualizar
     * @params int id del usuario
     * 
     * @return id del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_facebook($data, $id)
    {
        if($this->db->update('social_media', $data, array('socialUsuarioId'=>$id)))
        {
            return $id;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder insertar los tokens validos de twitter
     * para que el usuario pueda ligar su cuenta de pulzos con la cuenta o
     * aplicacion de twitter para que puedan publicar en twitter los comentarios
     * que se esten publicando desde pulzos app movil
     *
     * @params mixed datos a insertar
     * @return int id del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_twitter($data)
    {
        if($this->db->insert('social_media', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder actualizar los datos de los tokens de twitter
     * para que el usuario pueda ligar su cuenta de twitter con la cuenta de pulzos
     * para que el usuario pueda publicar en twitter las publicaciones de aplicacion
     *
     * @params mixed datos a actualizar
     * @params int id del usuario
     *
     * @return id del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_twitter($data, $id)
    {
        if($this->db->update('social_media', $data, array('socialUsuarioId'=>$id)))
        {
            return $id;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder obtener los datos de los usuarios que se
     * tienen con las ligas de las redes sociales, esto para que se puedan postear
     * en los diferentes muros de los usuarios para que el mismo al publicar desde
     * pulzos se publique en facebook y twitter pero solo desde el movil
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function social_media_data($id)
    {
        $this->db->where('socialUsuarioId', $id);
        $datos_social_media = $this->db->get('social_media');
        return $datos_social_media->row();
    }

    /**
     * Metodo que se usa para poder obtener todas las empresas que esten dadas de alta
     * y que tengan un administrador detras de ellas, esto es que si esten correctamente
     * registradas y que no sean restaurantes que el usuario haya dado de alta porque
     * esas no tienen perfil
     *
     * @return mixed datos de los negocios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_restaurants()
    {
        $datos = $this->db->query('select negocioId, negocioNombre from usuarios left join negocios on id = negocioUsuarioId where statusEU = 1');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder contar todos los tags que habra cercanos conforme
     * a las latitudes y longitudes que se reciban en este apartado, esto para que los
     * usuarios puedan conocer si hay mas etiquetas o no
     *
     * @params
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_tags($c1, $c2, $c3, $c4)
    {
        $datos =  $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ')');
      /*  $between = "scribbleLat between '$c1%' and '$c2%'";
        $between1 = "scribbleLng between '$c3%' and '$c4%'";;
        $this->db->where($between, NULL, FALSE);
        $this->db->where($between1, NULL, FALSE);
        $datos = $this->db->count_all_results('scribbles_comments');*/
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder contar los datos del rango de numero de etiquetas que
     * se mandan cada que se haga una solicitud para saber cuantos comentarios lleva visualizados
     * el usuario y asi poder conocer el rango de comentarios que se ha enviado y se estan visualizando
     *
     * @params int id de comentarios
     * @return int total de comentarios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_range_tags($c1, $c2, $c3, $c4)
    {
        $valores = $this->db->query('select scribbleId from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') order by scribbleId ASC limit 20');
       /* $this->db->select('scribbleId');
       $this->db->limit('20');*/
        //$valores = $this->db->get('scribbles_comments');
        return $valores->result();
    }

    /**
     * Metodo usado para poder obtener todos los valores de las etiquetas
     * que siguen o son mayores al parametro que se esta enviando en la
     * url, eso para que vayan apareciendo de un limite a un limte
     * sin necesidad de hacer el volcado de todas y despues cortarlas
     *
     * @params int id del ultimo scribble visto
     * @return mixed siguientes 20
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_range_tags_more($c1, $c2, $c3, $c4, $id)
    {
        $datos = $this->db->query('select scribbleId from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and scribbleId > . ' . $id . ' order by scribbleId ASC limit 20');
       /* $this->db->select('scribbleId');
        $this->db->where('scribbleId >', $id);
        $this->db->limit(20);
        $datos = $this->db->get('scribbles_comments');*/
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder guardar los datos de la imagen que
     * se creo por parte de los usuarios, esto para que el mismo pueda ya desde el ingreso
     * tener si imagen para la parte de moviles
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_thumb($data)
    {
        $this->db->insert('imagenes_thumb', $data);
    }

    /**
     * Metodo que se usa para poder realizar los conteos de numero de registros que va a
     * haber en los tagging para que los usuarios puedan aprovechar las promociones en caso
     * de que haya, o si aun sigue existente
     *
     * @params int id del tagging
     * @return int total de datos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_promotions($id)
    {
        $this->db->where('taggingPromotionId', $id);
        $totales = $this->db->count_all_results('tagging_promotions');
        return $totales;
    }

    /**
     * Metodo que se usa para poder realizar el conteo de los usuarios para conocer
     * si ya ha pasado la voz en la publicacion virtual de la tienda con la cual
     * el usuario puede pasar la voz, pero esta es para evitar para que pasen la voz
     * solo una vez
     *
     * @params int id del tagging
     * @params int id del usuario
     *
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_users_promotions($idS, $idU, $code)
    {
        $this->db->where('pasarVozScribbleId', $idS);
        $this->db->where('pasarVozUsuarioId', $idU);
        $this->db->where('pasarVozCode', $code);
        $total = $this->db->count_all_results('pasar_voz');
        return $total;
    }

    /**
     * Metodo que se usa para poder realizar el conteo de los usuarios para 
     * conocer cuales son los que van a pasar la voz por primera vez en las 
     * promociones que se tienen actualmente como limitadas y asi que el 
     * usuario se vaya apuntando, para que estos se vayan descontando cada vez 
     * que el usuario pase la voz
     *
     * @params int id del tagging
     * @params int id del usuario
     * @params int codigo de promocion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_promotion_100($idS, $idU, $code)
    {
        $datos = array('pasarVozScribbleId'=>$idS,
                       'pasarVozUsuarioId'=>$idU,
                       'pasarVozCode'=>$code);
        $this->db->insert('pasar_voz', $datos);
    }

    /**
     * Metodo que se usa para poder realizar el conteo de los datos del numero 
     * de promociones que hay por parte de los usuarios, para conocer si ya se 
     * cumplieron o aun siguen vigentes las promociones
     *
     * @params int id del tagging
     * @params int codigo de la promocion
     *
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_number_promotions($idS, $code)
    {
        $this->db->where('pasarVozScribbleId', $idS);
        $this->db->where('pasarVozCode', $code);
        $totals = $this->db->count_all_results('pasar_voz');
        return $totals;
    }

    /**
     * Metodo que se usa para poder recuperar todos los datos de la promocion 
     * que se tiene actualmente por parte de la empresa, esta para que se pueda 
     * comparar con la que se tiene actualmente en el contador de usuarios
     *
     * @þarmas int id del tagging
     * @return mixed datos del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_maximum_number($idS)
    {
        $this->db->where('taggingPromotionId', $idS);
        $datos = $this->db->get('tagging_promotions');
        return $datos->row();
    }

    /**
     * Metodo que se encarga de obtener los datos que se usaran por parte del usuario para
     * que se postie en la parte de sus redes sociales y que se pueda mostrar el mensaje de
     * la promocion o de pasa la voz que el usuario ha hecho en el momento, esto para que se
     * pueda visualizar por todos los usuarios
     *
     * @params int id del scribble
     * @return mixed datos del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_tagging($id)
    {
        $this->db->where('scribbleId', $id);
        $datos = $this->db->get('scribbles_comments');
        return $datos->row();
    }

   /**
    * Metodo que se usa para poder saber el total de registros que hay
    * en la parte de redes sociales por parte del usuario, asi conocer si
    * puede o no pasar la voz
    *
    * @params int id del usuario
    * @return int total de registros
    * @author blackfoxgdl <ruben.alonso21@gmail.com>
    **/
    public function count_social_media_data($id) 
    {
        $this->db->where('socialUsuarioId', $id);
        $totales = $this->db->count_all_results('social_media');
        return $totales;
    }

    /**
     * Metodo que se usa para poder consultar los datos de los registros
     * que siguen a partir de los siguientes que tienen los usuarios para
     * que puedan ver los siguientes tags a ver
     *
     * @params string latitud 1
     * @params string latitud 2
     * @params string longitud 3
     * @params string longitud 4
     * @params int numero de siguientes datos
     *
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function obtener_mas_registros($c1, $c2, $c3, $c4, $sig)
    {
        $datos = $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading != 370 and scribbleId < ' . $sig . ' order by scribbleId DESC limit 20');
        return $datos->result_array();
    }

    /**
     * Metodo que se usa para poder obtener las siguientes etiquetas corporativas 
     * con las cuales los usuarios pueden  ver las siguientes 5 etiquetas de las
     * empresas con sus diversas promociones
     *
     * @params string latitud 1
     * @params string longitud 2
     * @params string latitud 3
     * @params string longitud 4
     * @params int id del ultimo comentario
     *
     * @return mixed datos obtenidos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function obtener_mas_corporativas($c1, $c2, $c3, $c4, $num)
    {
        $datos = $this->db->query('select * from scribbles_comments where (scribbleLat between ' . $c1 . ' and ' . $c2 . ') and (scribbleLng between ' . $c3 . ' and ' . $c4 . ') and heading = 370 and scribbleId < ' . $num . ' order by scribbleId DESC limit 5');
        return $datos->result_array();
    }

    /**
     * Metodo que se usa para guardar las bonificaciones de los usuarios los
     * cuales podran realizar el proceso de las bonificaciones de los usuarios
     * los cuales se llevaran a cabo por medio del movil y la aplicacion de los
     * money back de los usuarios
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_money_back($datos)
    {
        $this->db->insert('money_back', $datos);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para poder guardar las bonificaciones por parte
     * del usuario para que el mismo lleve registros en la base de datos
     * para que el usuario pueda visualizar las cosas mismas
     *
     * @params mixed datos del usuario
     * @return int id de la insercion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_money_usuario($data)
    {
        $this->db->insert('money_usuario', $data);
        return $this->db->insert_id();
    }

   /**
    * Metodo que se usa para procesar u obtener los datos de las cuentas de los usuarios
    * con los cuales se obtendran todos los datos de las promociones o promocion activa
    *
    * @params int id del negocio
    * @return mixed datos del registro
    * @author blackfoxgdl <ruben.alonso21@gmail.com>
    **/
    public function offerts_company($id)
    {
        $this->db->where('idNegocioOferta', $id);
        $this->db->where('ofertaActivacion', '1');
        $datos = $this->db->get('ofertas_negocios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para guardar los datos de los usuarios en la parte de las notificaciones
     * de inbox, para que los negocios tengan la oportunidad de ver las bonificaciones que los
     * usuarios les estan solicitando por medio del celular
     *
     * @params mixed datos a insertar
     * @return int id de la insercion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_inbox_message($data)
    {
        $this->db->insert('inboxn', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para actualizar el campo de identificacion de conversacion para
     * conocer algun dato especifico con el cual el usuario en caso de comentar conocer
     * cual es el historial de esa conversacion sin necesidad de que se vaya a hacer
     * un caos. Esto es solo una actualizacion
     *
     * @params int id del inbox
     * @params int id del negocio
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_inbox($id, $idN, $idU)
    {
        $idC = $id.$idN.$idU;
        $this->db->update('inboxn', array('inboxnConversacionId'=>$idC), array('inboxnId'=>$id));
    }

    /**
     * Metodo que se usara para obtener todos los datos de las ofertas de los 
     * negocios esto para que le usuario pueda visualizarlos una vez que estos 
     * se hayan metido a la parte de las bonificaciones pero solo las que esten
     * como activas, pues es solamente una
     *
     * @params int id del negocio
     * @return mixed datos de la oferta
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_offerts($id)
    {
        $this->db->where('idNegocioOferta', $id);
        $this->db->where('ofertaActivacion', '1');
        $datos = $this->db->get('ofertas_negocios');
        return $datos->row();
    }

    /**
     **/
    public function get_data_offerts_two($id)
    {
        $this->db->where('ofertaId', $id);
        $this->db->where('ofertaActivacion', '1');
        $datos = $this->db->get('ofertas_negocios');
        return $datos->row();
    }


    /**
     **/
    public function get_geo_offert($idS)
    {
        $this->db->where('geotagGId', $idS);
        $datos = $this->db->get('geotag_oferta');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar la revision o el chequeo de los usuarios 
     * para que el mismo pueda saber si ya existe el correo electronico que se esta dando
     * o si esta inexistente, para conocer si ya estan registrados o aun no
     *
     * @params string email del usuario
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_email_movil($email)
    {
        $this->db->where('email', $email);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }

    /**
     * Metodo que se usa para poder obtener los datos de la empresa o del negocio con el
     * cual se sabran diversas operaciones que se tienen que hacer en la parte de la bonificacion
     * y asi saber si el negocio realmente tiene bonificaciones activas pendientes
     *
     * @params int id del negocio como usuario
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_company($id)
    {
        $this->db->where('negocioUsuarioId', $id);
        $datos = $this->db->get('negocios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder continuar con el proceso, asi saber si
     * el usuario puede realizar los siguientes pasos de las bonificaciones de los usuarios
     * con los cuales este se podra conocer cual es el proceso que se lleva en esta parte
     * y que son los datos que se recuperaran
     *
     * @params int id del negocio
     * @return int numero de registros totales
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_offerts_company($id)
    {
        $this->db->where('idNegocioOferta', $id);
        $this->db->where('ofertaActivacion', '1');
        $datos = $this->db->count_all_results('ofertas_negocios');
        return $datos;
    }

    /**
     * Metodo que se usa para poder obtener los estados que pertenezcan al 
     * paise que se esta seleccionando dependiendo de cual es el que se
     * quiera mostrar, y asi variara esta parte, pues sera una funcion 
     * completamente dinamica
     *
     * @params int id del pais
     * @return mixed datos de los estados que coincidan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function states_pulzos($id)
    {
        $this->db->select('id, nombre');
        $this->db->where('id_pais', $id);
        $datos = $this->db->get('estado');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder obtener el id del usuario para conocer
     * si al que se mandara el correo electronico sera a un negocio o a 
     * un usuario para conocer de donde se obtendran los datos que se mostraran
     * a los usuarios una vez que hayan comentado en el scribble
     *
     * @params int id del scribble
     * @return id del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mainCommentUser($idS)
    {
        $this->db->where('scribbleId', $idS);
        $datos = $this->db->get('scribbles_comments');
        return $datos->row();
    }

    /**
     * Metodo que se usa para revisar si el email del usuario esta registrado en
     * la base de datos para conocer que si se pueden loguear o para mandar un
     * mensaje con el cual los usuarios se den cuenta que si se puede loguear. En
     * caso de que no se pueda loguear por el email se mostrara el mensaje del error
     *
     * @params int email del usuario
     * @return int 0 o 1
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_email_exists($str)
    {
        $this->db->where('email', $str);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }

    /**
     * Method for check all the data about the user
     * where check if really exists the FB uId, and know
     * if the user has account or is a new user that will
     * be register
     *
     * @params string fb uid
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function code_facebook_exists($FbUid)
    {
        $this->db->where('usuariosFBuId', $FbUid);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }

    /**
     * Metodo que se usa para revisar si el password del usuario es el correcto, esto
     * una vez que el email del usuario se haya validado y que si haya sido el correcto
     * el que esta registrado, pues despues se tienen que checar el password o las credenciales
     * del usuario para conocer si existe o si lo esta escribiendo correctamente, en caso de que
     * sea incorrecto, se muestra un error en pantalla y si es viceversa se muestra el id del
     * usuario que se esta logueando
     *
     * @params string pass del usuario
     * @return int 0 o 1
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_pass_exists($pass, $email)
    {
        $this->db->where('password', $pass);
        $this->db->where('email', $email);
        $datos = $this->db->count_all_results('usuarios');
        return $datos;
    }

    /**
     * Metodo necesario para conocer los datos del negocio por medio del cual
     * estos podran conocer todas las promociones, pues estos datos son
     * clave en cuanto a la obtencion de datos del usuario una vez que se
     * realice una bonificacion por email sin geoetiqueta
     *
     * @params string email company
     * @return mixed array data
     * @auhtor blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_by_email($str)
    {
        $this->db->where('negocioEmail', $str);
        $datos = $this->db->get('negocios');
        return $datos->row();
    }

    /**
     * Metodo necesario para que se puedan obtener los datos necesarios
     * con los cuales se podran mostrar todas las ofertas que tiene el negocio
     * activas sin necesidad de que el usuario que desee la bonificacion escriba
     * cuales son las necesarias o cual es la que le tienen que bonificar
     *
     * @params int id del negocio
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_offert_by_id($id)
    {
        $datos = $this->db->query('select * from negocios,ofertas_negocios left join planesusuarios on idPlanUsuarioOfertaNegocio = planId where idPlanUsuarioOfertaNegocio != 0 and idNegocioOferta = '. $id . ' and ofertaActivacion = 1 and negocioId = ' . $id);
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder realizar la verficiacion de que el email existe en el negocio
     * y sea el mismo con el cual estan registrados en la plataforma pulzos, pues si no
     * es el mismo no se podra verificar los datos y mandara un error en la solicitud de 
     * dicha empresa
     *
     * @params string email company
     * @return int number of data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_email_company($str)
    {
        $this->db->where('negocioEmail', $str);
        $total = $this->db->count_all_results('negocios');
        return $total;
    }

    /**
     * Metodo que se usa para obtener el numero total de usuarios que tiene
     * o que han comentado la geoetiqueta con la cual se podran ver o
     * visualizar a los usuarios que han comentado en la misma y asi poder
     * enviar un correo en caso de que alguien vuelva a comentar la publicacion
     * principal de la geoetiqueta
     *
     * @params int id de la geoetiqueta
     * @return mixed data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_users_comment_total($id)
    {
        $this->db->where('scribbleId', $id);
        $datos = $this->db->get('scribbles_comments');
        return $datos->row();
    }

    /**
     * Metodo que se usa para extraer todos los nombres de los usuarios que ya han
     * comentado la publicacion principal en la cual el usuario puede realizar
     * un comentario para seguir con la dinamica de los usuarios con los cuales
     * se generara un historial de comentarios que podran ver despues otros usuarios
     *
     * @params int id del comentario scribble
     * @returm mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_users_comment_secondary($id)
    {
        $datos = $this->db->query('select * from scribbles_comments left join usuarios on scribbleUsuarioId = id where scribbleFatherId = ' . $id . ' group by scribbleUsuarioId');
        return $datos->result();
    }

    /**
     * Metodo que se encarga de obtener todos los datos de los usuarios con los cuales
     * se podra conocer si tiene realmente el dinero suficiente para pagar su cuenta
     * con paypulzos, pues si no tiene dinero suficiente le llegara un mensaje con el
     * cual el usuario se dara cuenta que tiene que pagar algo menor pues no fue aceptada
     * la transaccion que ha intentado realizar
     *
     * @params int id del usuario
     * @return mixed data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_payment_require($id)
    {
        $this->db->where('moneyTotalUsuarioId', $id);
        $datos = $this->db->get('money_total');
        return $datos->row();
    }

    /**
     * Metodo necesario para realizar la transaccion en caso de que haya pasado las dos 
     * revisiones anteriores de los datos, para que estos sean los correctos y que no
     * vaya a hacer algo incorrecto o que vaya aceptar el pago sin fondos suficientes
     * para que no haya despues problemas futuros
     *
     * @params mixed array to insert
     * @return int id de la insercion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_transaction($data)
    {
        if($this->db->insert('transacciones_pagadas', $data))
        {
            return $this->db->insert_id();        
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder actualizar los datos de los usuarios
     * en cuanto al money total que tengan se reduzca por el monto pagado
     * por parte del usuario a la empresa con paypulzos
     *
     * @params int id del usuario
     * @params double monto a actualizar
     * 
     * @return boolean true or false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_money_usuario($id, $total)
    {
        if($this->db->update('money_total', array('moneyTotalGanadoUsuario'=>$total), array('moneyTotalUsuarioId'=>$id)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Metodo que se usa para poder actualizar la tabla de los pagos que
     * se han realizado una vez que los usuarios tengan la necesidad de 
     * realizar un pago con paypulzos para que se vea reflejado el
     * valor de la transferencia con la cual lo identificaremos el movimiento
     *
     * @params string code
     * @params int id de la transaccion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_payment_code($code, $id)
    {
        $this->db->update('transacciones_pagadas', array('transaccionToken'=>$code), array('transaccionCompletaId'=>$id));
    }

    /**
     * Metodo que se usa para poder realizar la insercion de los mensajes de
     * inbox de la plataforma de pulzos para que la misma pueda tambien
     * mostrarle al usuario del negocio que ha recibido un inbox y que se tiene
     * como evidencia ese mensaje de que ha recibido los datos de quien le pago y
     * cual fue la cantidad que le pago
     *
     * @params mixed array data to insert
     * @return int id de la insercion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_inbox_transfer($data)
    {
        if($this->db->insert('inboxn', $data))
        {
            $id = $this->db->insert_id();
            return $id;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para actualizar la parte de las conversaciones de los mensajes
     * inbox que se le enviaran al negocio notificandole que se ha realizado una transaccion
     * por parte de un pago de un servicio que han realizado los usuarios con el metodo
     * de pago paypulzos
     *
     * @params string data to update
     * @params int id de la conversacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_conversacion_id($data, $id)
    {
        $this->db->update('inboxn', array('inboxnConversacionId'=>$data), array('inboxnId'=>$id));
    }

    /**
     * Method will be use for save all the user's data
     * that login or register by facebook, all this for
     * create a new pulzos account which one the user can use
     * once created and can login anc check the bonifications
     *
     * @params string table name
     * @params array mixed data
     * 
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_data_fb($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    /**
     * Method where the user will update the image
     * of the avatar in facebook once the user was registered
     * in the platform
     *
     * @params string url
     * @params int id
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_avatar_profile($url, $id)
    {
        $this->db->update('imagenes', array('imagenRuta'=>$url), array('imagenAlbumId'=>$id));
    }

    /**
     * Method for check all the data of the users where the
     * system will update the thumb avatar of the users
     * that was registered by facebook
     *
     * @params string url
     * @params int id
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_avatar_thumb($url, $id)
    {
        $this->db->update('imagenes_thumb', array('usuarioThumbName'=>$url), array('thumbUsuarioId'=>$id));
    }

    /**
     * Method for get all the data of the user once
     * login and the user exists in the database, all this
     * for check the data in the table and get it
     *
     * @params string email
     * @return mixed array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_by_emailFB($email)
    {
        $this->db->where('email', $email);
        $data = $this->db->get('usuarios');
        return $data->row();
    }

    /**
     * Method where the system get the data of the
     * user once login via mobile, with that information, the
     * user can login session and then make all the things
     * enabled in the platform
     *
     * @params string FB uid
     * @return mixed array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_by_fbUid($fbId)
    {
        $this->db->where('usuariosFBuId', $fbId);
        $data = $this->db->get('usuarios');
        return $data->row();
    }

    /**
     * Method where the system update the token of the
     * user that get with the connect by facebook, all this
     * for has the token update and the user don't have
     * problems once want to post by pulzos
     *
     * @params string token
     * @params int if
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_tokenFB($token, $id)
    {
        $this->db->update('social_media', array('tokenFacebook'=>$token), array('socialUsuarioId'=>$id));
    }

    /**
     * Method used for activate the account in the part of
     * pulzos. When the user press the button, one company
     * going to have the oportunity of post something in the
     * wall with the message promotion
     *
     * @params int id user
     * @params mixed array
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function active_account($id, $array)
    {
        $this->db->update('usuarios', $array, array('id'=>$id));
    }

    /**
     * Method where the system will update a specific data of
     * the user, like is the code of activation for the company
     * can make all the process of the post
     *
     * @params int id
     * @params mixed array
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_codeUser_creation($id, $array)
    {
        $this->db->update('usuarios', $array, array('id'=>$id));
    }
}
