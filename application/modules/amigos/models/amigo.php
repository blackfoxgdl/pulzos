<?php
/**
 * Access to the friend autoreferencing pivot table
 * TODO: Add validation to store procedures.
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 28 February, 2011
 * @package Amigos
 **/

class Amigo extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'amigos';
    }

    /**
     * save data into table
     *
     * @param mixed Data to store
     * @param string condition to check for
     *
     * @return bool success flag
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save($data, $condition=null)
    {
        if($condition){
            $this->db->update($this->table_name, $data, $condition);
        }else{
            $this->db->insert($this->table_name, $data);
        }
        return true;
    }

    /**
     * Obtener registros de la DB de acuerdo a la condición
     * TODO: Verificar usuario loggeado.
     *
     * @param string $condition la condición a checar. Null por default y trae 
     * todos los registros
     * @param bool $type El tipo de query, si conseguir amigos o amigueros
     *
     * @return mixed an array with friend data
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get($id, $status, $aceptado)
    {
        $query = $this->db->query('select * from usuarios left join amigos on amigoAmigoId = id where amigoUsuarioId = ' . $id . ' and amigoTipo = ' . $status . ' and amigoAceptado = ' . $aceptado);
        return $query->result();
    }

    /**
     * Borrar amistad
     * TODO: Validar
     *
     * @param integer $id_borrador Usuario que inicia la acción
     * @param integer $id_borrado Usuario que recibe la acción
     * @param bool $request True si es para borrar request. False para amistad
     *
     * @return bool success flag
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id_borrado, $id_borrador)
    {
        $this->db->where('amigoUsuarioId', $id_borrado);
        $this->db->where('amigoAmigoId', $id_borrador);
        $this->db->delete('amigos');
    }

    /**
     * Se usa para obtener todos los datos del usuario que esta
     * visualizando a sus amigos aceptados, esto para hacer el 
     * mapa de sitio y poder regresar de nueva cuenta a su perfil.
     *
     * @params int id del usuario logueado
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

    /**
     * Se obtienen los datos de otras tablas del usuario como
     * son la ubicacion del mismo, la ciudad y el pais en
     * el que se encuentran.
     *
     * @params int id de la ciudad, pais
     * @params string nombre de la tabla donde se obtienen los datos
     * @return mixed datos de la tabla seleccionada
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * ver amigos del usuario, para ver a quien invita
     * PARAMS int id del usuario
     * PARAMS uno como segundo parametro
     **/
    public function get_amigos_usuario($id,$val)
    {
        $query = $this->db->query('select * from usuarios left join amigos on amigoAmigoId = id where amigoUsuarioId='.$id.' and amigoAceptado='.$val);
        return $query->result();
    }

    /**
     **/
    public function get_search_friends($id, $val=null)
    {
        if($val)
        {
            $this->db->where('nombre',$val);
        }
        $this->db->order_by('id','desc');
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    /**
     * Check relationship status
     *
     * @param $id_usuario User to check
     * @param $id_amigo User to compare to.
     *
     * @return int 0 not friends 1 pending, 2 friends
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function is_friend($id_usuario, $id_amigo)
    {
        $Q = $this->db->get_where('amigos', array('amigoUsuarioId'=>$id_usuario, 'amigoAmigoId'=>$id_amigo));
        return $Q->row();
    }

    /**
     * Metodo que se encarga para actualizar los datos de los
     * usuarios que tienen la relacion de amigos, en caso de que
     * haya aceptado o autorizado la amistad
     *
     * @params int id del usuario
     * @params int id del amigo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update($id, $id_amigo)
    {
        $this->db->where('amigoUsuarioId',$id);
        $this->db->where('amigoAmigoId',$id_amigo);
        $this->db->update('amigos', array('amigoAceptado'=>'3'));
    }

    /**
     * Metodo que se encarga de contar el numero de amigos que se tienen en las
     * solicitudes pendientes enviadas o recibidas, y los amigos que se tienen
     * aceptados
     *
     * @params int id del usuario
     * @params int id del status tipo
     * @params int id del amigo aceptado
     *
     * @return int numero de solicitudes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_pending_applications($id, $tipo, $status)
    {
        $this->db->where('amigoUsuarioId', $id);
        $this->db->where('amigoAceptado', $status);
        $this->db->where('amigoTipo', $tipo);
        $total = $this->db->count_all_results('amigos');
        return $total;
    }

    /**
     * Metodo que se usa para poder crear los planes de los usuarios que se 
     * tiene por parte del envio de un saludo, con esto el usuario podra enviar 
     * a su amigo un saludo para que esta aparezca en notificaciones
     *
     * @params mixed datos a insertar
     * @return int id del plan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_saludo_plan($data)
    {
        $this->db->insert('planesusuarios', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para poder obtener todos los datos del plan que se 
     * acaba de crear por parte del saludo del usuario, esto para poder crear 
     * la notificacion con los datos del mismo y que el usuario pueda verlas,
     * aunque no se tenga un ver mas
     *
     * @params int id del plan
     * @return mixed datos del plan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_plain_saludo($id)
    {
        $this->db->where('planId', $id);
        $data = $this->db->get('planesusuarios');
        return $data->row();
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
     * Metodo que se usa para obtener todos los datos que
     * se necesitan para poder obtener los datos de los
     * planes del usuario que sean necesarios para
     * poder borrar en caso de rechazar
     *
     * @params int id del usuario
     * @params int id del amigo
     * @params int id del tipo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_plains_friends($idU, $idA, $tipo)
    {
        $this->db->where('planAmigoUsuarioId', $idU);
        $this->db->where('planUsuarioId', $idA);
        $this->db->where('planTipo', $tipo);
        $dts = $this->db->get('planesusuarios');
        return $dts->row();
    }

    /**
     * Metodo que se usa para poder realizar las eliminaciones
     * correspondientes en las cuales estan tres tablas
     * involucradas, esto para tratar de eliminarlas de si mismo
     *
     * @params int id del plan
     * @params string nombre de la tabla
     * @params string campo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_from($planId, $tabla, $campo)
    {
        $this->db->delete($tabla, array($campo=>$planId));
    }
}
