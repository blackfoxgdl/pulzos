<?php
/**
 * Modelo para todos los datos y registros que se relacionen 
 * con dar de alta un negocio, guardar datos y obtener la muestra de
 * los mismos
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, August 15 2011
 * @package AltaNegocio
 **/
class altaNegocio extends CI_Model{

    /**
     * Constructor en la cual se puede declarar una
     * variable global para poder obtener
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Metodo que se encarga de obtener los datos del negocio que
     * se ha dado de alta para que al momento de visitar el perfil
     * se puedan ver los datos que estan relacionados a este negocio
     *
     * @params int id del negocio dado de alta
     * @return mixed datos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_company($id)
    {
        $this->db->where('altaNegocioNegocioId', $id);
        $datos = $this->db->get('altanegocio');
        return $datos->row();
    }

    /**
     * Metodo que se encarga de obtener todos los inbox que tiene el
     * usuario sin leer contando los nuevos, todos estos inbox tienen
     * un status de 1, en caso de que sea 0, no se mostraran los inbox
     * como si fueran no leidos.
     *
     * @params int id del usuario
     * @params int status del inbox
     *
     * @return int total de registros con el valor
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function inbox_total($id, $status)
    {
        $this->db->where('inboxnUsuarioRecibeId', $id);
        $this->db->where('inboxnStatus', $status);
        $query = $this->db->count_all_results('inboxn');
        return $query;
    }

    /**
     * Mostrar el numero de notificaciones con las que
     * cuentan los usuarios para que puedan visualizar si tienen
     * las notificaciones los usuarios
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_notifications($id)
    {
        $this->db->where('invitacionInvitadoPersonalId', $id);
        $this->db->where('invitacionPersonalStatus', '1');
        $query = $this->db->count_all_results('invitacionpersonal');
        return $query;
    }

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
     * Gets the data of the user for
     * show the information like the
     * age and id location
     *
     * @params int, the id of the user
     * @return array with the data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_name($id)
    {
        $this->db->select('*')
            ->from('usuarios')
            ->where('usuarios.id = '.$id);

        //limpiar los resultados y asignar al row
        $query = $this->db->get();
        $model = $query->row();
        return $model;
    }

    /**
     * Recover the location of the
     * user with the id of the city assigned
     * to the user
     *
     * @params int, id of the city
     * @return string, name of the city
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_location($id)
    {
            $this->db->where('id',$id);
            $query = $this->db->get('estado');
            return $query->row();
    }

    /**
     * Metodo que se usa para poder obtener todos los registros
     * de los negocios a los cuales sigues, esto para poder visualizar
     * si ya se sigue al negocio o aun no se esta siguiendo, dependiendo
     * del resultado de registros que se obtnegan
     *
     * @params int id del negocio
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_count_follower($id)
    {
        $this->db->where('seguidorNegocioId', $id);
        $query = $this->db->count_all_results('seguidores');
        return $query;
    }
}
