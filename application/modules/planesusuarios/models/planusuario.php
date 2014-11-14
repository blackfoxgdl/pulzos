<?php
/**
 * Modelo que se usara para realizar todas las operaciones
 * a las bases de datos con los cuales se podran obtener o
 * guardar datos que posteriormente se podran usar
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 21, 2011
 * @package planesusuarios
 **/
class planUsuario extends CI_Model
{

    /**
     * Metodo constructor donde se podran declarar ciertas cosas
     * como son algunas variables que se vayan a usar dentro de
     * esta clase
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table = "planesusuarios";
    }

    /**
     * Metodo que se usa para poder guardar los datos
     * de los planes del usuario, en este se creara tambien
     * el metodo para poder guardar los inbox que les llegaran
     * a los usuarios una vez que hayan sido invitados
     *
     * @params mixed arreglo de datos a insertar
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($post)
    {
        if($this->db->insert($this->table, $post))
        {
            $valor = $this->db->insert_id();
            return $valor;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Se obtienen los datos de los usuarios con los cuales
     * se tienen que mostrar en la parte del header y de 
     * los contenidos
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_user($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

    /**
     * Metodo que se usa para obtener los datos de los mensajes que hay en
     * la bandeja de entrada que no se han leido, para esto se tiene que
     * hacer la consulta de todos los mensajes que tengan status 1
     *
     * @params int id del usuario
     * @params int status del mensaje
     *
     * @return int total de mensajes en el inbox
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function inbox_total($id, $status)
    {
        $this->db->where('inboxnUsuarioRecibeId',$id);
        $this->db->where('inboxnStatus',$status);
        $query = $this->db->count_all_results('inboxn');
        return $query;
    }

    /**
     * Metodo que se usa para poder obtener todos los datos
     * de los amigos del usuario que vaya a realizar un
     * pulzo para un evento y asi mostrar los amigos
     * para que pueda invitar
     *
     * @params int id del usuario
     * @return mixed datos de los amigos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_friends($id)
    {
        $query = $this->db->query("select * from amigos left join usuarios on amigoAmigoId = id where amigoUsuarioId = " . $id . " and amigoTipo = 0 AND amigoAceptado=3");
        return $query->result();
    }

    /**
     * Metodo que se usa para poder mostrar los pulzos personales
     * en la barra derecha, los cuales tendran una breve descripcion,
     * el nombre del pulzo, y su imagen
     *
     * @params int id del usuario
     * @return mixed datos del pulzo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function new_pulzos($id)
    {
        $this->db->where('planUsuarioId',$id);
        $this->db->order_by('planId', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Metodo que se usa para poder obtener los datos de los usuarios
     * con los cuales se mostraran lo que el usuario ha posteado
     * para que el mismo vea sus datos
     *
     * @params int id del usuario
     * @return mixed datos del usuario de los planes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_plains($id)
    {
        $this->db->where('planUsuarioId',$id);
        $this->db->order_by('planId', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Metodo que se usa para poder ver el plan de 
     * del usuario de forma individual con el cual
     * se veran con mas detalle
     *
     * @params int id del plan
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_simple_plain($id)
    {
        $this->db->where('planId', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Metodo que se usa para obtener un simple pulzo
     * por medio del is del mismo, para obtener todos
     * los datos necesarios para que se muestren en el usuario
     *
     * @params int id del pulzo
     * @return mixed datos del pulzo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_simple_pulzo($id)
    {
        $this->db->where('pulzoId', $id);
        $query = $this->db->get('pulzos');
        return $query->row();
    }

    /**
     * Metodo que se encarga de obtener todos los pulzos de los amigos del
     * usuario que tienen la sesion abierta, esto para ver los planes de los
     * amigos. Que estan haciendo mis amigos o que estan pulzando
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_friends_plains($id)
    {
        $query = $this->db->query("select * from amigos right join planesusuarios on amigoAmigoId = planUsuarioId where amigoUsuarioId = " . $id . " and amigoAceptado = 3 and amigoTipo = 0 order by planId DESC limit 10");
        return $query->result();
    }

    public function get_friends_only($id)
    {
        $query = $this->db->query('select * from amigos where amigoUsuarioId = ' . $id);
        return $query->result();
    }

    /**
     * Metodo que se encarga de obtener todas las invitaciones que se
     * tienen de parte del usuario, notificando cuales son las que que
     * se mostraran como nuevas
     *
     * @params int id del plan
     * @params int id del usuario que invita
     * 
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_invitation($id_plan, $id_user, $mensaje)
    {
        if(isset($_POST['amigos'])){
        foreach($_POST['amigos'] as $amigos)
        {
            $this->db->set('invitacionUsuarioPersonalId', $id_user);
            $this->db->set('invitacionInvitadoPersonalId', $amigos);
            $this->db->set('invitacionPersonalPlanId', $id_plan);
            $this->db->set('invitacionPersonalAceptadoId','0');
            $this->db->set('invitacionPersonalMensaje', $mensaje);
            $this->db->set('invitacionPersonalStatus', '1');
            $this->db->insert('invitacionpersonal');
        }
        return TRUE;
        }else{
            return FALSE;
        }
        
    }

    /**
     * Metodo que se usa para poder guardar las invitaciones con
     * la reservacion integrada y que la empresa conosca cual es el
     * usuario que asistira pero con una reservacion ya hecha y asi
     * saber a quien se le da preferencia
     *
     * @params int id del usuario
     * @params int id del amigo o usuario que reservo
     * @params int id del plan
     * @params int id del mensaje
     * @params int id del status
     * @params int id del pulzo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_reservation($idU, $idAoU, $idPl, $strM, $idS, $idP)
    {
        $this->db->insert('invitacionpersonal', array('invitacionUsuarioPersonalId'=>$idU, 
                                                      'invitacionInvitadoPersonalId'=>$idAoU, 
                                                      'invitacionPersonalPlanId'=>$idPl, 
                                                      'invitacionPersonalAceptadoId'=>'0', 
                                                      'invitacionPersonalMensaje'=>$strM, 
                                                      'invitacionPersonalStatus'=>$idS, 
                                                      'invitacionPersonalPlanReservacion'=>$idP));
    }

   /**
    * Metodo que se encarga de mostrar las notificaciones
    * en el header de los usuarios para que estos puedan
    * observar si hay notificaciones pendientes
    * 
    * @params int id del usuario
    * @return int total de notificaciones
    * @author blackfoxgdl <ruben.alonso21@gmail.com>
    **/
    public function get_all_notifications($id)
    {
        $this->db->where('invitacionInvitadoPersonalId', $id);
        $this->db->where('invitacionUsuarioPersonalId !=', $id);
        $this->db->where('invitacionPersonalStatus', '1');
        $query = $this->db->count_all_results('invitacionpersonal');
        return $query;
    }

    /**
     * Metodo que se usa para poder actualizar los status de los
     * planes de los usuarios con los cuales se tienen que
     * ver si el usuario acepta o no
     *
     * @params int id del usuario
     * @params int tipo de usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status_plain($id, $idTipo, $idP)
    {
        $this->db->where('invitacionInvitadoPersonalId', $id);
        $this->db->where('invitacionPersonalPlanId', $idP);
        $this->db->update('invitacionpersonal', array('invitacionPersonalAceptadoId'=>$idTipo));
    }

    /**
     * Metodo que se encarga de guardar todos los datos de los
     * comentarios del plan del usuario, esto para que esten posteando
     * los usuarios cosas en el mismo plan
     *
     * @params string params
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_comments($post)
    {
        $this->db->insert('comentarios_planes',$post);
    }

    /**
     * Metodo que se encarga de guardar todos los subcomentarios
     * de algun comentario que se haya hecho. Esto para tener un
     * registro en las tablas de los mismos
     *
     * @params array datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_subcomments($post)
    {
        $this->db->insert('comentarios_planes', $post);
    }

    /**
     * Metodo que se encarga de actualizar los datos de me gusta
     * o me apunto para que al momento de que lean los comentarios se muestre
     * en el mismo el total de me gusta que hay
     *
     * @params int id a actualizar
     * @params int dato a actualizar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function add_one($id, $total)
    {
        if($this->db->update("comentarios_planes", array('comentarioSimpleGusta'=>$total), array('comentarioSimpleId'=>$id)))
        {
            return "hola";
        }
        else
        {
            return "hola2";
        }
    }

    /**
     * Metodo que se usa para postear en el muro de la persona, el cual 
     * se comunicaran pero con menos campos que los planes de usuarios,
     * asi que se guardara en la base de datos para mantener un registro
     *
     * @params string datos del posteo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_comment_wall($data)
    {
        $this->db->insert($this->table, $data);
        $val = $this->db->insert_id();
        return $val;
    }

    /**
     * Metodo que se encarga de comentar los comentarios que el usuario
     * ha puesto en el muro, asi mostraran los comentarios que se han
     * hecho y poder realizar una conversacion
     *
     * @params string arreglo de datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_subcomments_wall($post)
    {
        $this->db->insert('comentarios_planes',$post);
    }

    /**
     * Metodo que se usa para guardar los datos de me apunto
     * en la tabla para saber a quien le gusta el plan o quien
     * se apunta para el mismo
     *
     * @params int id del plan de usuario
     * @params int id del usuario a apuntarse
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_point($id, $id2)
    {
        $this->db->insert('meapunto', array('meApuntoPlanId'=>$id,
                                            'meApuntoUsuarioApuntadoId'=>$id2));
    }

    /**
     * Metodo que se usa para eliminar los datos de me apunto
     * en la tabla para saber a que usuarios les gusta el plan y
     * les interesa que se arme algo o ir al evento armado
     *
     * @params int id del plan del usuario
     * @params itn id del usuarios a desapuntarse
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function unsave_point($id, $id2)
    {
        $this->db->where('meApuntoPlanId', $id2);
        $this->db->where('meApuntoUsuarioApuntadoId', $id);
        $this->db->delete('meapunto');
    }

    /**
     * Metodo que se encarga de eliminar los planes que el usuario
     * ya no desee tener en su muro para asi poder ir eliminandolos
     * dependiendo el id que se pase
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->where('planId', $id);
        $this->db->delete($this->table);
    }

    /**
     * Metodo que se encarga de borrar los comentarios que se tengan
     * registrados, pues si ya se elimino el plan que se creo no
     * hay necesidad de que se tenga un comentario relacionado al
     * registro eliminado
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_comments($id)
    {
        $this->db->where('comentarioSimplePlanId', $id);
        $this->db->delete('comentarios_planes');
    }

    /**
     * Metodo que se encarga de eliminar el comentario subsecuente
     * del post principal, esto en caso de que el usuario no desee que
     * aparescan los subcomentarios en su post o que le moleste uno
     *
     * @params int id del subcomentario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments($id)
    {
        $this->db->where('comentarioSimpleId', $id);
        $this->db->delete('comentarios_planes');
    }

    /**
     * Metodo que se encarga de eliminar todos los registros que se tengan
     * en la parte de las invitaciones para todos los usuarios que esten
     * registrados y tengan la invitacion, como ya no existe pues no hay necesidad
     * de tener guardados los registros
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_invitation($id)
    {
        //$this->db->where('invitacionPersonalPlanId', $id);
        $this->db->delete('invitacionpersonal', array('invitacionPersonalPlanId'=>$id));
    }

    /**
     * Metodo que se usa para poder saber si hay algun registro en 
     * notificaciones de los usuarios, asi saber si entra a borrar algun
     * dato de los mismo o solo borra los comentarios y planes
     *
     * @params int id del plan
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_notifications($id)
    {
        $this->db->where('notificacionPlanId', $id);
        $valor = $this->db->count_all_results('notificaciones');
        return $valor;
    }

    /**
     * Metodo que se usa para borrar las notificaciones que se tienen
     * de partr de la tabla de notificaciones, que se encarga de que todos
     * los usuarios reciban los los datos de las publicaciones
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_notification_data($id)
    {
        $this->db->delete('notificacion', array('notificaPlanId'=>$id));
    }

    /**
     * Metodo que se usa para borrar las notificaciones que se tiene
     * de la tabla de notificaciones que se encarga de que todos los usuarios
     * se reciben y muestra los diversos mensajes que se tienen
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_notifications($id)
    {
        $this->db->delete('notificaciones', array('notificacionPlanId'=>$id));
    }

    /**
     * Metodo que se encarga de contar todos los registros de comentarios
     * y subcomentarios que se hayan hecho con referencia al plan que se ha
     * comentado para poder ver si se elimina comentarios en caso de que haya
     * o no se eliminan mas que el puro plan
     *
     * @params int id del plan
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_data($id)
    {
        $this->db->where('comentarioSimplePlanId', $id);
        $total = $this->db->count_all_results('comentarios_planes');
        return $total;
    }

    /**
     * Metodo que se encarga de ingresar los datos de un ancla o
     * una foto que el usuario quiera anexar a las publicaciones 
     * de su muro, con esto asi se podra tener un dato especifico
     * con los cuales se podra postear en el muro
     *
     * @params array datos a ingresar en la tabla anexos
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_anexos($data)
    {
        $this->db->insert('anexos', $data);
    }

    /**
     * Metodo que se encarga de obtener los datos de la ciudad en la
     * cual radica el usuario para que se puedan mostrar los datos una
     * vez que el mismo inicie sesion, esto checando en la tabla de los
     * ciudades
     *
     * @params int id de la ciudad
     * @return string datos de la ciudad
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_location($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('estado');//ciudad');
        return $query->row();
    }

    /**
     * Metodo que se usa para poder administrar los datos personales
     * del usuario con los cuales se podra ver si tiene alguna relacion
     * sentimental y asi poder mostrar el estatus de la misma, la cual sera
     * obtenida de la base de datpos
     *
     * @params string valor del
     * @params int id del usuario
     * @params string nombre de la tabla
     *
     * @return array datos del usuario con referencia a la tabla
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_profile($valor, $id, $tabla)
    {
        $this->db->where($valor,$id);
        $query = $this->db->get($tabla);
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo para obtener el estado civil del usuario y asi poder
     * dar a conocer a los demas cual es su status en este sentido,
     * para que no pueda ocultar las cosas despues
     *
     * @params int id del usuario
     * @return mixed datos de la relacion del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function estado_civil($id)
    {
        $query = $this->db->query("select * from personal right join estadocivil on id = relaciones where usuarioId = " . $id);
        return $query->row();
    }

    /**
     * Metodo que se usa para poder checar si hay mas de un
     * tipo de usuario en notificaciones, para saber si se
     * escribe en una notificacion o no en el perfil del usuario
     * que hizo el comentario y los demas que sean diferentes a su id
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_total_notification($idU, $idP)
    {
        $this->db->where('notificaPlanId', $idP);
        $this->db->where('notificaUsuarioId !=', $idU);
        $total = $this->db->count_all_results('notificacion');
        return $total;
    }

    /**
     * Metodo que se usa para llevar un registro donde se podra
     * observar quienes son los usuarios que recibiran las notificaciones
     * que se tengan en el comentarios ya sea que se hayan apuntado o en el
     * que hayan comentado
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_notification($plan, $id)
    {
        $this->db->set('notificaPlanId', $plan);
        $this->db->set('notificaUsuarioId', $id);
        $this->db->insert('notificacion');
        return "1";
    }

    /**
     * Metodo que se usa para poder elminar las notificaciones, asi
     * el usuario podra ver actualizados sus datos de notificaciones
     * y que no quede sin actualizar por el proceso que se lleva para
     * estos pasos
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_notification($plan, $id)
    {
        $this->db->where('notificaPlanId', $plan);
        $this->db->where('notificaUsuarioId', $id);
        $this->db->delete('notificacion');
    }

    /**
     * Metodo que se usa para poder obtener todas las notificaciones
     * de los usuarios diferentes al id para que este se pueda postear o
     * mostrar en las notificaciones de los usuarios, este metodo para
     * despues poder insertarlas en la tabla
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return mixed datos de todos los usuarios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_users_notifications($idU, $idP)
    {
        $this->db->where('notificaPlanId', $idP);
        $this->db->where('notificaUsuarioId !=', $idU);
        $registros = $this->db->get('notificacion');
        return $registros->result();
    }

    /**
     * Metodo que se usa para crear las notificaciones de los
     * usuarios los cuales se podran guardar y mostrar posteriormente
     * las notificaciones de los comentarios en los que haya participado 
     * o en la que los usuarios hayan comentado
     *
     * @params int id del usuario
     * @params int id del plan
     * @params int status leido
     * @params int status tipo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_new_notification($idU, $idP, $idL, $idT)
    {
        $data = array('notificacionUsuarioId'=>$idU,
                      'notificacionPlanId'=>$idP,
                      'notificacionLeido'=>$idL,
                      'notificacionTipo'=>$idT);
        $this->db->insert('notificaciones', $data);
    }

    /**
     * Metodo que se usa para crear las notificaciones de los
     * usuarios los cuales se podran guardar y mostrar posteriormente
     * las notificaciones de los comentarios en los que haya participado 
     * o en la que los usuarios hayan comentado
     *
     * @params int id del usuario
     * @params int id del plan
     * @params int status leido
     * @params int status tipo
     * @params int id notificacion del comentario principal
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_new_notification2($idU, $idP, $idL, $idT, $idPC)
    {
        $data = array('notificacionUsuarioId'=>$idU,
                      'notificacionPlanId'=>$idP,
                      'notificacionLeido'=>$idL,
                      'notificacionTipo'=>$idT,
                      'notificacionPrincipalComentario'=>$idPC);
        $this->db->insert('notificaciones', $data);
    }


    /**
     * Metodo que se usa para conocer si el usuario ya ha posteado un 
     * comentario en el comentario principal esto para saber si se tiene
     * que insertar de nuevo o no en caso de que ya este el registro
     * guardado en la tabla
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return int numero de registros que se tienen
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_number_notification_user($idP, $idU)
    {
        $this->db->where('notificaPlanId', $idP);
        $this->db->where('notificaUsuarioId', $idU);
        $query_total = $this->db->count_all_results('notificacion');
        return $query_total;
    }

    /**
     * Metodo que se usa para conocer si ya hay registros en la tabla de 
     * notificaciones, esto para no repetirlos, en caso de que asi sea se 
     * tendran que eliminar primero y despues se insertaran los nuevos 
     * registros que se mostraran como notificaciones
     *
     * @params int id del plan
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_registros($id)
    {
        $this->db->where('notificacionPlanId', $id);
        $total_notificaciones = $this->db->count_all_results('notificaciones');
        return $total_notificaciones;
    }

    /**
     * Metodo que se usa para poder crear los registros nuevos de los usuarios, 
     * pues con este se eliminaran todos los que coincidan con el plan del 
     * usuario y despues se insertaran los que se mostraran en las 
     * notificaciones, asi no se repetiran los registros
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_data($id)
    {
        $this->db->where('notificacionPlanId', $id);
        $this->db->delete('notificaciones');
    }

    /**
     * Metodo que se usa para poder crear la insercion de las notificaciones
     * de parte de los usuario que si pulzaran en el plan al que los han
     * invitado, con esto se dara cuenta quienes han pulzado y quienes no
     *
     * @params mixed datos del plan
     * @return int id del plan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_pulzo_yes($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para guardar los datos de los usuarios que
     * postien en los pulzos, retos, experiencias de vida de los usuarios,
     * asi ellos desde su muro podran postear a las empresas
     *
     * @params mixed datos del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_subcomment_datas($data)
    {
        $this->db->insert('comentarios', $data);
    }

    /**
     * Metodo que se usa para eliminar los registros de los pulzos en la
     * parte de pulzos pues son todos los registros que se tienen una vez
     * que se crea y se comienza a eliminar estos
     *
     * @params int id del pulzos
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_pulzos($id)
    {
        $this->db->delete('pulzos', array('pulzoId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar los registros de los planes de usuarios
     * en cuanto a los datos de los pulzos para que este mismo se elimine de los registros
     * y ya no aparesca en la plataforma
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_planes($id)
    {
        $this->db->delete('planesusuarios', array('planEmpresaPulzoId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar los registros de los comentarios que se tengan
     * con referencia a este pulzo, esto para evitar basura en la base de datos,
     * pues los comentarios que se tengan de pulzos eliminados ya no serviran
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_comments_one($id)
    {
        $this->db->delete('comentarios', array('comentarioPulzoId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar los registros de los comentarios que tengan
     * con referencia a este pulzo, como son comentarios se tienen en otro lado aparte
     * y con esta funcion evitamos que se tenga basura como registro
     *
     * @params int id del planusuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments_one($id)
    {
        $this->db->delete('comentarios_planes', array('comentarioSimplePlanId'=>$id));
    }

/************* A DESCARTAR LAS FUNCIONES *******************/

    /**
     * Metodo que se usa para mostrar las notificaciones y guardar las
     * notificaciones a los usuarios que hayan posteado algo y que se hayan
     * apuntado algun amigo de los mismo, esta recibira tres parametros que
     * se recibiran para guardar
     *
     * @params int id del plan
     * @params int id del usuario que se apunta
     * @params int id del usuario que hizo el comentario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_notification($id_user, $id_plan, $status, $tipo, $tipoC)
    {
        $this->db->set('notificacionUsuarioId', $id_user);
        $this->db->set('notificacionPlanId', $id_plan);
        $this->db->set('notificacionStatus', $status);
        $this->db->set('notificacionLeido', '1');
        $this->db->set('notificacionTipo', $tipo);
        $this->db->set('notificacionReciente', '1');
        $this->db->set('notificacionPrincipalComentario', $tipoC);
        $this->db->insert('notificaciones');
        return $this->db->insert_id();
    }

    /**
     * Metodo que se encarga de guardar las notificaciones para los usuarios 
     * que esten inscritos en el comentario o que se hayan apuntado, esto para 
     * que se den cuenta de que hay un nuevo comentario en donde ya habian 
     * comentado
     *
     * @params int id del usuario
     * @params int id del plan
     * @params int status del plan
     * @params int tipo del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_notification_another($id_user, $id_plan, $status, $tipo)
    {
        $this->db->set('notificacionUsuarioId', $id_user);
        $this->db->set('notificacionPlanId', $id_plan);
        $this->db->set('notificacionStatus', $status);
        $this->db->set('notificacionLeido', '1');
        $this->db->set('notificacionTipo', $tipo);
        $this->db->set('notificacionReciente', '0');
        $this->db->set('notificacionPrincipalComentario', '0');
        $this->db->insert('notificaciones');
    }

    /**
     * Metodo que se encarga de actualizar los comentarios de publicacion
     * del usuario para que se use como notificacion para el usuario que
     * ha publicado el comentario principal.
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_comment_post($id1)
    {
        $this->db->where('notificacionPlanId', $id1);
        $this->db->update('notificaciones', array('notificacionPrincipalComentario'=>'0'));
    }

    /**
     * Metodo que se encarga de actualizar las notificaciones de los usuarios, 
     * para que en caso de que haya alguna que no haya sido leido la cambie 
     * a cero y deje la nueva en uno y asi siga apareciendo solo una 
     * notificacion
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_users_notifications($id, $id2)
    {
        $this->db->where('notificacionPlanId', $id);
        $this->db->where('notificacionUsuarioId', $id2);
        $this->db->update('notificaciones', array('notificacionLeido'=>'0'));
    }

    /**
     * Metodo que se encarga de actualizar los registros de las
     * notificaciones para conocer quien ha sido el ultimo en actualizarlos
     * para que aparesca en las notificaciones y no se ciclen y aparescan
     * repetidas las mismas
     *
     * @params int id del plan
     * @params int id de la notificacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_notification($id1, $id2)
    {
        $this->db->where('notificacionId !=',$id2);
        $this->db->where('notificacionPlanId', $id1);
        $this->db->update('notificaciones', array('notificacionReciente'=>'0'));
    }

    /**
     * Checa los datos de los usuarios para ver si en la tabla
     * de las notificacion con las cuales se veran si ya hay registros en el mismo
     * comentarios o plan, pues no se puede repetir con el mismo plan el usuario
     *
     * @params int id del plan
     * @params int id del usuario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_data_notification($id1, $id2)
    {
        $this->db->where('notificaPlanId', $id1);
        $this->db->where('notificaUsuarioId', $id2);
        $total = $this->db->count_all_results('notificacion');
        return $total;
    }

    /**
     * Metodo que se encarga de contar cuantos registros hay en la tabla de 
     * notificaciones para saber si un usuario hay registros ya de ese plan
     * para que se vea si se actualiza o no
     *
     * @params int id del plan
     * @params int id del usuarios
     * @params int status leido del usuario
     *
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_number_of_notifications($idP, $idU, $status)
    {
        $this->db->where('notificacionPlanId', $idP);
        $this->db->where('notificacionUsuarioId', $idU);
        $this->db->where('notificacionLeido', '1');
        $total = $this->db->count_all_results('notificaciones');
        return $total;
    }

    /**
     * Metodo que se encarga de actualizar el valor de leido en caso de que ya 
     * haya un registro con el mismo plan, para que solo salga uno en la 
     * notificacion, con esto se tiene que actualizar el registro en el campo 
     * leido a 0 y que el mas nuevo vaya quedando con el 1 asi solo se 
     * notificara que hay un registro nuevo y no todos lo que se vean
     *
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_old_notifications($idP, $idU)
    {
        $this->db->where('notificacionPlanId', $idP);
        $this->db->where('notificacionUsuarioId', $idU);
        $this->db->update('notificaciones', array('notificacionLeido'=>'0'));
    }

    /**
     * Metodo que se encarga de contar las personas que estan en las 
     * notificaciones para saber si hay mas de una y asi poder
     * ver si se mandan notificaciones o no a los otros usuarios que se 
     * inscribieron o que se apuntaron
     *
     * @params int id del plan
     * @return int total de usuarios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_number_people($id)
    {
        $this->db->where('notificaPlanId', $id);
        $query = $this->db->count_all_results('notificacion');
        return $query;
    }


/**************************** HASTA AQUI SE USA  ************************************/

    /**
     * Metodo que se encarga de obtener el numero de registros de los usuarios 
     * que se tienen diferente al usuario que esta posteando o se esta 
     * apuntando, esto para que se pueda postear la nueva notificacion donde 
     * avisara a todos los involucrados en el comentario
     *
     * @params int id del usuario que postea
     * @params int id del plan
     *
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all($id, $id2)
    {
        $this->db->where('notificaPlanId', $id);
        $this->db->where_not_in('notificaUsuarioId', $id2);
        $total = $this->db->count_all_results('notificacion');
        return $total;
    }

    /**
     * Metodo que se usara para extraer todos los datos de los usuarios que 
     * deban de recibir las notificaciones que tendran cuando un usuario se 
     * involucre en el comentario o cuando un usuario se apunte
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return mixed arreglo de datos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    /*public function get_all_users_notifications($id, $id2)
    {
        $this->db->where('notificaPlanId', $id);
        $this->db->where_not_in('notificaUsuarioId', $id2);
        $resultado = $this->db->get('notificacion');
        return $resultado->result();
    }*/

    /**
     * Metodo que se encarga de contar todos los registros que
     * se tienen como pendientes o status no leidos de las notificaciones
     * para que el usuario puedan observar quienes se han apuntado o comentado
     * en algun comentarios que hayas puesto
     *
     * @params int id del usuario
     * @return int numero de notificaciones pendientes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_notifications($id)
    {
        $this->db->select('*')
                          ->from('notificaciones')
                          ->join('notificacion', 'notificaPlanId = notificacionPlanId', 'left')
                          ->where('notificaUsuarioId', $id)
                          ->where('notificacionUsuarioId', $id)
                          ->where('notificacionLeido', '1')
                          ->where_not_in('notificacionReciente', '1');
        $total = $this->db->count_all_results();
        return $total;
    }

    /**
     * Metodo que se usa para poder obtener todos los planes que hay
     * en la base de datos, estos para poder mostrarlos en el muro del
     * usuario una vez que ingrese a su cuenta
     *
     * @params int id del usuario
     * @return mixed datos de los planes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_plains($id)
    {
        //$this->db->order_by('planId','DESC');
        //$this->db->limit(10);
       //$query = $this->db->get('planesusuarios');
        $query = $this->db->query('select * from planesusuarios left join amigos on amigoUsuarioId = planUsuarioId or amigoAmigoId = planUsuarioId where amigoUsuarioId = planUsuarioId and amigoAmigoId = ' . $id . ' and amigoAceptado=3 or amigoAmigoId = planAmigoUsuarioId and amigoUsuarioId = ' . $id . ' and amigoAceptado=3 or planUsuarioId = ' . $id . ' or planUsuarioId = amigoAmigoId and amigoAceptado = 3 and amigoTipo = 1 group by planId order by planId desc limit 10');
        return $query->result();
    }

    /**
     * Metodo que se usara para obtener los siguientes 10 despues de mostrar los
     * comentarios mas recientes, digase los primeros 10 comentarios de los
     * usuarios en general y si presiona el link ver mas se mostraran los
     * siguientes 10 registros
     *
     * @params int numero principal
     * @params int numero 10 veces menor al principal
     * 
     * @return mixed datos con los 10 registros a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_plain_limit($id, $num)
    {
        $mostrar_sig = $this->db->query('select * from planesusuarios left join amigos on amigoUsuarioId = planUsuarioId or amigoAmigoId = planUsuarioId where amigoUsuarioId = planUsuarioId and amigoAmigoId = ' . $id . ' and amigoAceptado=3 and planId < ' . $num . ' or amigoAmigoId = planAmigoUsuarioId and amigoUsuarioId = ' . $id . ' and amigoAceptado=3 and planId < ' . $num . ' or planUsuarioId = ' . $id . ' and planId < ' . $num . ' or planUsuarioId = amigoAmigoId and amigoAceptado = 3 and amigoTipo = 1 and planId < ' . $num . ' group by planId order by planId desc limit 10');
        return $mostrar_sig->result();
    }

    /**
     * Metodo que se usa para poder obtener los siguientes 10 registros
     * en mi perfil, que es la informacion que hemos visto con lo que
     * se refiere a todos los posteos que se ha hecho por parte
     * del dueño delperfil
     *
     * @params int id del usuario
     * @params int numero de plan que se quedo
     *
     * @return mixed datos del plan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_mine_plain_limit($id, $num)
    {
        $query = $this->db->query('select * from planesusuarios where planId < ' . $num . ' and planUsuarioId = ' . $id . ' order by planId desc limit 10');
        return $query->result();
    }

    /**
     * Metodo que se usa por el momento para obtener los 10 planes
     * de los amigos que se tienen desde el ultimo visto hasta que
     * se hagan 10, esto para que los usuarios puedan obtener los siguientes
     * registros sin importar de que amigos sean
     *
     * @params int id del usuario
     * @params int numero de plan que se quedo
     *
     * @return mixed datos de los amigos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_friends_plain_limit($id, $num)
    {
        $query = $this->db->query('select * from amigos right join planesusuarios on amigoAmigoId = planUsuarioId where amigoUsuarioId = 1 and amigoAceptado = 3 and amigoTipo = 0 and planId < ' . $num . ' and planUsuarioId != ' . $id . ' order by planId DESC limit 10');
        return $query->result();
    }

    /**
     * Se obtienen los mensajes mayores al id
     **/
    public function get_plains_update($id)
    {
        $this->db->where('planId >', $id);
        $resultados = $this->db->get('planesusuarios');
        return $resultados->result();
    }

    /**
     * se obtiene el ultimo plan id
     **/
    public function get_last_plains($id)
    {
        $resultado = $this->db->query('select * from amigos right join planesusuarios on amigoAmigoId = planUsuarioId where amigoUsuarioId = ' . $id . ' or amigoAmigoId = ' . $id . ' and amigoAceptado = 3 order by planId desc');
        if($resultado->num_rows() > 0)
        {
            $ids = $resultado->row();
            return $ids->planId;
        }
        else{
            return '0';
        }
    }

    /**
     * se obtiene id a actualizar
     **/
    public function get_plain_last_id($id)
    {
        $resultado = $this->db->query('select * from amigos right join planesusuarios on amigoAmigoId = planUsuarioId where amigoUsuarioId = ' . $id . ' or amigoAmigoId = ' . $id . ' and amigoAceptado = 3 order by planId desc');
        return $resultado->row();
    }

    /**
     **/
    public function count_last($id)
    {
        $this->db->from('amigos');
        $this->db->join('planesusuarios', 'amigoAmigoId = planUsuarioId', 'right');
        $this->db->where('amigoUsuarioId', $id);
        $this->db->where('amigoAmigoId', $id);
        $this->db->where('amigoAceptado', '3');
        $this->db->order_by('planId', 'DESC');
        $resultado = $this->db->count_all_results();
        return $resultado;
    }

    /**
     * Metodo que se usa para guardar la imagen de
     * armar un pulzo en la base de datos, 
     * @return mixed datos de los planes
     * @author jorgeLeon
     **/
    public function save_image($data){
         $this->db->insert('imageneventos', $data);
         $return_data = $this->db->insert_id();
         return $return_data;
    }
    /**
     * Metodo que se usa buscar el 
     * ultimo pulzo en la base de datos,
     * mediante el id de ultima imagen insertada x usuario
     *
     * @return mixed datos de los planes
     * @author jorgeLeon
     **/
    public function get_last_plan($id){
        $this->db->where('planImagenId',$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     **/
    public function update_imagenId($planIm,$planId,$idUsuario){
        $this->db->where('ImagenId',$planIm);
        $this->db->update('imageneventos', array('planesusuariosId'=>$planId));
        $this->db->delete('imageneventos', array('planesusuariosId'=>'0', 'idUsuario'=>$idUsuario));
    }

    /**
     * Metodo que se usa para poder obtener los datos de
     * las empresas con los cuales los usuarios seleccionaran
     * para armar un pulzo con la empresa deseada
     *
     * @params int id del negocio
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
     * Metodo que se usa para obtener los datos del pulzo de la
     * empresa en la cual se quiere realizar una reservacion, esto
     * para que los usuarios puedan realizar sus reservaciones de las
     * promociones que la empresa esta colocando para sus seguidores
     *
     * @params int id del pulzos
     * @return mixed datos del pulzo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_general($id)
    {
        $datos = $this->db->query('select * from pulzos left join negocios on pulzoUsuarioId = negocioId where pulzoId = ' . $id);
        return $datos->row();
    }

    /**
     **/
    public function get_plan_calendario($id)
    {
        $query = $this->db->query('SELECT planesusuarios.planId,planesusuarios.planMensaje,from_unixtime(planFechaInicio) AS planfechaCalendario
                                   FROM planesusuarios
                                   WHERE planInvitados LIKE "%'.$id.',%"');
        return $query->result();
    }

    /**
     **/
    public function get_plan_calendarioUsuario($id){
         $query = $this->db->query('SELECT planId,planMensaje,from_unixtime(planFechaInicio) AS planfechaCalendario
                                        FROM planesusuarios INNER JOIN invitacionpersonal ON planesusuarios.planId = invitacionpersonal.invitacionPersonalPlanId
                                        WHERE planesusuarios.planUsuarioId = '.$id.' AND invitacionPersonalAceptadoId = 1 GROUP BY planUsuarioId');
          return $query->result();
    }

    /**
     **/
    public function get_plan_calendarioYo($id){
        $query = $this->db->query('SELECT
                                    planesusuarios.planId,
                                    planesusuarios.planMensaje,
                                    from_unixtime(planFechaInicio) AS planfechaCalendario,
                                    REPLACE(planVirtual,"0","invitado") as planVirtual
                                    FROM planesusuarios
                                    WHERE planInvitados LIKE "%'.$id.',%"

                                    UNION all

                                    SELECT
                                    usuarios.id AS planId,
                                    usuarios.nombre AS planMensaje,
                                    usuarios.edad AS planfechaCalendario,
                                    REPLACE(planesusuarios.planVirtual,"0","cumple") as planVirtual
                                    FROM
                                    planesusuarios,amigos
                                    INNER JOIN usuarios ON amigos.amigoAmigoId = usuarios.id
                                    WHERE
                                    amigoUsuarioId = '.$id.' AND amigoAceptado = 3 AND amigoTipo = 0 GROUP BY usuarios.id

                                    UNION

                                    SELECT 
                                    planId,
                                    planMensaje,
                                    from_unixtime(planFechaInicio) AS planfechaCalendario,
                                    REPLACE(planVirtual,"0","pulzante")
                                    FROM planesusuarios INNER JOIN invitacionpersonal ON planesusuarios.planId = invitacionpersonal.invitacionPersonalPlanId
                                    WHERE planesusuarios.planUsuarioId = '.$id.' AND invitacionPersonalAceptadoId = 1 GROUP BY planUsuarioId');
        
        return $query->result();
    }

    /**
     **/
    public  function get_negocioHubicacion($id){
            $this->db->select('negocios.negocioUsuarioId, negocios.negocioNombre, ciudad.nombre, pais.nombre as pais');
            $this->db->from('negocios');
            $this->db->join('ciudad', 'ciudad.id=negocios.negocioCiudad');
            $this->db->join('pais', 'pais.id=negocios.negocioPais');
            $this->db->where('negocioUsuarioId',$id);
            $query = $this->db->get($this->table);
            return $query->row();
    }

    /**
     * Metodo que se usa para poder borrar todos los comentarios que se tengan
     * del plan uisuario que se tiene por el momento como scribble, esto es
     * una decision del usuario o del negocio
     *
     * @params int id del scrible
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_scribble_main($id)
    {
        $this->db->delete('scribbles_comments', array('scribbleId'=>$id));
    }

    /**
     * Metodo que se usa para la eliminacion de los comentarios que se tienen
     * como hijos de las publicaciones en la parte de los scribbles esto para que
     * se pueda evitar un problema de basura en la base de datos asi como de algun
     * error por informacion del registro
     *
     * @params int id del scribble
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_scribble_son($id)
    {
        $this->db->delete('scribbles_comments', array('scribbleFatherId'=>$id));
    }

    /**
     * Metodo que se usa para consultar si el posteo al que se esta comentando es
     * un scribble y para saber si se tienen que actualizar la tabla en la cual
     * el usuario esta comentando para que el mismo se vaya ligado a los comentarios
     * de los scribbles que se postean desde el telefono movil
     *
     * @params int id del plan
     * @return mixed datos del plan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function known_is_scribble($id)
    {
        $this->db->where('planId', $id);
        $datos = $this->db->get('planesusuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usan para obtener los valores del registro padre de los scribles para
     * que despues se pueda modificar por medio de la consulta y se pueda sumar los valores
     * y asi los usuarios ver los comentarios que se tienen realmente en el posteo virtual
     *
     * @params int id del scribble
     * @return mixed datos del scribble
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_total_scribbles($id)
    {
        $this->db->where('scribbleId', $id);
        $datos = $this->db->get('scribbles_comments');
        return $datos->row();
    }

    /**
     * Metodo que se usa para actualizar los valores que se tienen en la parte de los
     * scribles los cuales se sumab una vez que se va agregando un comentario nuevo al
     * posteoe que hizo algun usuario desde el movil en algun lugar que esta visitando
     *
     * @params int id del scribble
     * @params int dato a actualizar
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data_scribble($id, $update)
    {
        $this->db->update('scribbles_comments', array('totalComentarios'=>$update), array('scribbleId'=>$id));
    }

    /**
     * Metodo que se usa para insertar en la tabla de los scribbles estos para que
     * al momento de que algun usuario vea el scribble padre se pueda mostrar en la parte
     * movil y que sea la misma historia y no se vaya por una diferente en el muro y
     * otra muy aparte en la parte del movil
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_scribble_from_wall($data)
    {
        $this->db->insert('scribbles_comments', $data);
    }

    /**
     * Metodo que se usa para extraer todos los datos de los usuarios que se han
     * apuntado al mensaje de texto con el cual el mismo puede extraer la informacion
     * de los usuarios para notificarles por medio de correo electronico que se ha apuntado
     * tal usuario a su x comentario
     *
     * @params int id del plan del usuario
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_point_users($id)
    {
        $this->db->where('meApuntoPlanId', $id);
        $datos = $this->db->get('meapunto');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de los usuarios con los cuales
     * se haran las verificaciones para mandar correos electronicos de los cuales los
     * usuarios podran recibir si un compa comenta la publicacion principal
     *
     * @params int id del plan
     * @return mixed array data users
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_users_publication($id)
    {
        $datos = $this->db->query('select * from comentarios_planes left join usuarios on comentarioSimpleUsuarioId = id where comentarioSimplePlanId = ' . $id . ' group by comentarioSimpleUsuarioId');
        return $datos->result();
    }
}
