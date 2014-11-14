<?php
/**
 * Modelo que se encarga de manipular las funciones
 * de la base de datos con las cuales los usuarios
 * podran observar todas sus notificaciones pendientes
 * y las que ya se visualizaron
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 29, 2011
 * @package invitacionesPersonales
 **/

class invitacionPersonal extends CI_Model
{

    /**
     * Metodo constructor que se encarga de 
     * visualizar las variables que se
     * vayan a usar en esta clase del modelo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table = "invitacionpersonal";
    }

    /**
     * Metodo que se encarga de obtener todas las invitaciones
     * que hay pendientes por parte del usuario, esto para que
     * el mismo pueda visualizarlas
     *
     * @params int id del usuario
     * @return mixed datos de las invitaciones
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_invitations_info($id)
    {
        $query = $this->db->query("select * from planesusuarios left join " . $this->table . " on invitacionPersonalPlanId = planId where invitacionInvitadoPersonalId = " . $id . " order by invitacionPersonalId DESC");
        return $query->result();
    }

    /**
     * Metodo que se encarga de actualizar las invitaciones
     * de los usuarios una vez que presionen el link, asi
     * ya no les apareceran en el header para que esten visitando las
     * invitaciones nuevas que tienen
     *
     * @params int id de la invitacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status($id)
    {
        $this->db->where('invitacionPersonalId', $id);
        $this->db->update($this->table, array('invitacionPersonalStatus'=>'0'));
    }

    /**
     * Metodo que se usa para eliminar las invitaciones que se tienen registradas
     * en la base de datos dependiendo el usuario que haya hecho la solicitud de
     * eliminacion presionando el link de eliminacion, esto para no saturar la
     * bandeja de invitaciones
     *
     * @params int id de la invitacion
     * @params int id del plan
     * @params int id del usuarios
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($idI, $idP, $idU)
    {
        $this->db->delete($this->table, array('invitacionPersonalId'=>$idI, 'invitacionPersonalPlanId'=>$idP, 'invitacionInvitadoPersonalId'=>$idU));
    }

    /**
     * Metodo que se usa para poder actualizar los datos de los registros
     * que se tienen de parte del usuario para que se pueda cambiar los
     * status del usuario a 0 y que ya no se muestre el indicador de que el
     * usuario tienen una invitacion sin ver
     *
     * @params int id del pulzo
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status_reservation($idPulzo, $idPlan, $id)
    {
        $this->db->where('invitacionPersonalPlanReservacion', $idPulzo);
        $this->db->where('invitacionPersonalPlanId', $idPlan);
        $this->db->where('invitacionPersonalId', $id);
        $this->db->update($this->table, array('invitacionPersonalStatus'=>'0'));
    }
}
