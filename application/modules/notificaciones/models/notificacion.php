<?php
/**
 * Modelo en cual traera todas las notificaciones que se
 * requieran para llenar los datos de las notificaciones 
 * y que los administradores de los negocios puedan 
 * observarlas y si se requiere comentarlas
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 11, 2011
 * @package notificaciones
 **/
class Notificacion extends CI_Model
{
    /**
     * Constructor del modelo de las
     * notificaciones
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "planes";
    }

    /**
     * Se obtienen las notificaciones del usuario con las cuales podran ver
     * quienes se han interesar en las notificaciones y en que pulzos se
     * han interesado para poder ofertar mas pulzos similares
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return mixed datos de planes, notificaciones
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_notificaciones($idU)
    {
        $this->db->where('notificacionUsuarioId', $idU);
        $this->db->order_by('notificacionId', 'DESC');
        $query = $this->db->get('notificaciones');
        return $query->result();
    }

    /**
     * Metodoq ue se usa para mostrar las notificaciones de forma personalizada
     * para que el usuario pueda ver los comentarios y si lo desea tambien puede
     * comentar el comentario principal donde podra comentarlo para responder
     *
     * @params int id de la notificacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_notification_data($id)
    {
        $query = $this->db->query('select * from planesusuarios left join notificaciones on planId = notificacionPlanId where notificacionId = ' . $id);
        return $query->row();
    }

    /**
     * Metodo que se usa para obtener el ultimo registro que se tiene del usuario
     * como '1' en caso de que un plan ya haya sido visualizado en las notificaciones,
     * esto nos servira para saber cual registro actualizar y no el mas nuevo, el cual
     * no pertenece al usuario que esta recibiendo la notificacion
     *
     * @params int id del usuario 
     * @params int id del plan
     * 
     * @return int id del plan a actualizar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_last_notification_update($idU, $idP)
    {
        $this->db->where('notificacionPlanId', $idP);
        $this->db->order_by('notificacionId', 'DESC');
        $query = $this->db->get('notificaciones');
        $valor = $query->row();
        return $valor;
    }

    /**
     * Metodo que se encarga de actualizar los status de las notificaciones para que el
     * mismo usuario pueda ver en su perfil la actualizacion que se ha hecho de parte
     * de la plataforma donde muestra que ya no hay actualizaciones
     *
     * @params int id del plan
     * @params int id del usuario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status($idP, $idU)
    {
        $this->db->where('notificacionUsuarioId', $idU);
        $this->db->where('notificacionPlanId', $idP);
        $this->db->update('notificaciones', array('notificacionLeido'=>'0'));
    }

    /**
     * Metodo que se encarga de eliminar las notificaciones
     * que ya han cancelado los usuario
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($idU, $idP)
    {
        if($this->db->delete("notificaciones", array('notificacionPlanId'=>$idP,'notificacionUsuarioId'=>$idU)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se encarga de eliminar las notificaciones de los usuarios
     * que han recibido un saludo, con el cual el mismo podra hacer que
     * se elimine de las notificaciones en al tabla notificaciones
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_notification_hello($idP, $idU)
    {
        $this->db->delete('notificaciones', array('notificacionPlanId'=>$idP, 'notificacionUsuarioId'=>$idU));
    }

    /**
     * Metodo que se encarga de poder eliminar el registro que se crea en
     * la tabla de los planes esto para que las notificaciones sean hechas
     * correctamente en el sistema
     *
     * @params int id del usuario
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_plain_hello($idP, $idU)
    {
        $this->db->delete('planesusuarios', array('planId'=>$idP, 'planAmigoUsuarioId'=>$idU));
    }

    /**
     * Metodo que se encarga de poder eliminar el registro que se crea en la
     * tabla de notificacion, para que no se marque el conflicto una vez que
     * este ya no desee tener la notificacion en esta area de su perfil
     *
     * @params int id del plan
     * @params int id del usuario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_notify_hello($idP, $idU)
    {
        $this->db->delete('notificacion', array('notificaPlanId'=>$idP, 'notificaUsuarioId'=>$idU));
    }

    /**
     * Metodo que se encarga de eliminar los planes de la tabla
     * de planes de usuarios, puesto que si se elimina de las
     * notificaciones en la visualizacion personal del comentario
     * ya no puede aparecer en planes ni nada de apuntados, comentarios
     * del mismo
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com
     **/
    public function delete_comments($id)
    {
        $this->db->delete('planesusuarios', array('planId'=>$id));
    }

    /**
     * Metodo que se hace el funcionamiento de eliminar los
     * subcomentarios del comentarios para que este se puedan
     * eliminar las opciones de subcomentarios en la cual ya no se
     * necesitaran si se eliminar el comentario
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments($id)
    {
        $this->db->delete('comentarios_planes', array('comentarioSimplePlanId'=>$id));
    }

    /**
     * Metodo que se encarga de eliminar todos los registros
     * de apunte que tengan los usuarios en los comentarios
     * para poder organizar algo, esto asi se eliminar, pues 
     * no se necesitaran si es eliminado el comentario
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_point_user($id)
    {            
        $this->db->delete('meapunto', array('meApuntoPlanId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar las notificaciones que se tienen pero
     * desde la parte de los comentarios, los cuales se borraran cuando 
     * eliminen el comentario que se tiene visto en la notificacion
     *
     * @params int id del plan
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_notification($id)
    {
        $this->db->delete('notificaciones', array('notificacionId'=>$id));
    }

    /**
     * Metodo en el cual hara la funcionalidad de actualizacion de los datos de 
     * las notificaciones en cuanto a las solicitudes de amistad, esto para 
     * poder borrar las notificaciones que hayan
     *
     * @params int id de la notificacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_friendlys($id)
    {
        $this->db->where('notificacionId', $id);
        $this->db->update('notificaciones', array('notificacionLeido'=>'0'));
    }

    /**
     * Se obtienen todas las notificaciones que se encuentran
     * canceladas o han sido canceladas por el usuario
     * para mostrarlas la negocio y asi poder evitar una
     * reservacion que no se hara
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_notificaciones_canceladas($id)
    {
        $query = $this->db->query("select * from planes right join pulzos on planTipo = 1 where planLugar = " . $id . " and planExito = 0");
        return $query->result();
    }

    /**
     * Se obtienen los datos del negocio para mostrar en la parte de las
     * notificaciones y saber a que negocio nos referimos
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_datos_negocio($id)
    {
        $this->db->where('negocioId',$id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Se obtienen los datos del usuario que esta mandando
     * una notificacion al negocio el cual este quiere asistir
     * 
     * @params int id del negocio
     * @params int id del usuario
     * @params int id del plan
     *
     * @return mixed datos de los pulzos, planes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_notification($idN, $id, $idP)
    {
        
        $query = $this->db->query("select * from planes right join pulzos on planTipo = 1 where planUsuarioId=" . $id . " and planId=" . $idP . " and planLugar=" . $idN);
        return $query->row();
    }

    /**
     * Se obtienen los datos del negocio
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_company_data($id)
    {
        $this->db->where('negocioId', $id);
        $query = $this->db->get("negocios");
        return $query->row();
    }

    /**
     * Se obtienen los datos del usuario para poder
     * mostrarlos ya en las notificaciones personalizadas
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get("usuarios");
        return $query->row();
    }

    /**
     * Se obtienen todos los datos de los amigos que se
     * invitaron en el plan para que el restaurant
     * pueda ver para cuantas personas va a reservar
     * el usuario interesado
     *
     * @params int id del plan de invitacion
     * @return mixed datos de los invitados
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_invitation($id)
    {
        $query = $this->db->query("select * from invitaciones left join planes on invitacionPlanId = planId where planTipo = 1 and invitacionPlanId=".$id);
        return $query->result();
    }
}
