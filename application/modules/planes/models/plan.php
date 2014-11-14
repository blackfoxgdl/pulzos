<?php
/**
 * Modelo que comunica con la base de datos
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 09 May, 2011
 * @package planes
 **/
class Plan extends CI_Model
{
    private $table_name = "planes";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * SAve
     *
     * TODO: DO something nicer
     *
     * @param mixed $data datos a guardar
     * @param string $condition condición en caso de update
     * @return integer ultimo id insertado
     * @author axoloteDeAccion <mario.r.vallejo@gmailcom>
     **/
    public function save($post, $amigos, $plan)
    {
        $this->db->insert('eventos', $post);
        $eventoId = $this->db->insert_id();
        $plan['planElementoId'] = $eventoId;
        $this->db->insert('planes', $plan);
        $planId = $this->db->insert_id();
        $this->save_invites($planId, $amigos);
    }

    /**
     * Accept invitacion
     *
     * @param integer $id Id of the invitation
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save_invitacion_accepted($data, $id)
    {
        $this->db->where('invitacionId', $id);
        $this->db->update('invitaciones', $data);
    }

    /**
     * Delete
     *
     * @param integer $id Id of element to delete
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->update($this->table_name, array('planExito'=>'0'), "planId = $id");
        $this->db->delete('invitaciones', array('invitacionPlanId'=>$id));
    }

    public function rechazar($id)
    {
        $this->db->delete('invitaciones', array('invitacionId'=>$id));
    }

    /**
     * Obtener resultados
     * 
     * @param string $condition Condicion segun la cual buscar
     *
     * @return mixed
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     */
    public function get($condition=null, $tipo=2)
    {
        $this->db->select('*')
            ->from('planes')
            ->join('usuarios', 'usuarios.id = planes.planUsuarioId', 'left')
            ->join('negocios', 'negocios.negocioId = planes.planLugar', 'left');
        if($tipo == 2)
        {
            $this->db->join('eventos', 'eventos.eventoId = planes.planElementoId', 'left');
        }else{
            $this->db->join('pulzos', 'pulzos.pulzoId = planes.planElementoId', 'left');
        }

        $this->db->where('planTipo = 1');
        $this->db->where('planExito = 1');

        if($condition)
        {
            $this->db->where($condition);
        }

        $Q = $this->db->get();
        $planes = $Q->result();
        $data = array();
        foreach($planes as $plan)
        {
            $Q = $this->db->get_where('invitaciones', array('invitacionPlanId'=>$plan->planId));
            $plan->invitaciones = $Q->result();
            $data[] = $plan;
        }
        return $data;
    }

    public function test($testUsuarioId, $testType)
    {
        $this->db->select('*')
            ->from('planes')
            ->join('usuarios', 'usuarios.id = planes.planUsuarioId', 'left')
            ->join('pulzosneg', 'pulzosneg.pulzosnegId = planes.planElementoId', 'left')
            ->where(array('planes.planUsuarioId'=>$testUsuarioId));
        $Q = $this->db->get();
        $plan = $Q->row();

        $Q = $this->db->get_where('invitaciones', array('invitacionPlanId'=>$plan->planId));
        $plan->invitaciones = $Q->result();
        return $plan;
    }

    public function get_invitaciones($id)
    {
        $this->db->select('*')
            ->from('usuarios')
            ->join('planes', 'usuarios.id = planes.planUsuarioId', 'left')
            ->join('invitaciones', 'invitaciones.invitacionPlanId = planes.planId', 'left')
            ->where('invitaciones.invitacionInvitadoId = '.$id)
            ->where('invitaciones.invitacionAceptado != 1');
        $Q = $this->db->get();
        return $Q->result();
    }

    public function get_invitaciones_aceptadas($id)
    {
        $this->db->select('*')
            ->from('usuarios')
            ->join('planes', 'usuarios.id = planes.planUsuarioId', 'left')
            ->join('invitaciones', 'invitaciones.invitacionPlanId = planes.planId', 'left')
            ->where('invitaciones.invitacionInvitadoId = '.$id)
            ->where('invitaciones.invitacionAceptado = 1');
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * Guardar las invitaciones en la DB para futura referencia.
     *
     * TODO: Esta solución es estúpida. Buscar otra más ad-hoc
     *
     * @return bool bandera de éxito
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save_invites($planId, $friends)
    {
        foreach($friends as $friend)
        {
            $this->db->flush_cache();
            $this->db->insert('invitaciones', array('invitacionPlanId'=>$planId, 'invitacionInvitadoId'=>$friend));
        }
    }
}
