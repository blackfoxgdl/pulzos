<?php
/**
 * PLan out activities to do during your week with your friends on your 
 * favorite businesses. 
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright ZavorDigital, 09 May, 2011
 * @package planes
 **/
class Planes extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('planes/plan', '', true);
        $this->load->model('amigos/amigo', '', true);
        $this->load->helper(array('url', 'html', 'form', 'apipulzos', 'avatar'));
        $this->load->library(array('session'));
    }

    /**
     * When called bring up all of a given persons plans.
     *
     * @param integer $idLugar Id Del lugar donde se quiere hacer el plan
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index($idLugar=null)
    {
        // Capturar un nuevo event
        if($this->input->post('Eventos'))
        {
            $post = $this->input->post('Eventos');
            $plan = array(
                'planUsuarioId'=>$this->session->userdata('id'),
                'planTipo'=>1,
                'planFechaCreacion'=>time(),
                'planMensaje'=>$post['eventoAccion'],
                'planLugar'=>$post['eventoLugar'],
            );
            $amigos = $this->input->post('amigos');
            $post['eventoFechaCreacion'] = time();
            $this->plan->save($post, $amigos, $plan);
            redirect('planes/eventos');
        }
        $negocios = get_negocios_usuario($this->session->userdata('id'));
        $amigos = get_amigos_usuario($this->session->userdata('id'));
        $this->load->view('planes/index_p', array('amigos'=>$amigos, 'negocios'=>$negocios, 'idLugar'=>$idLugar));
    }

    /**
     * Watch pulzos to attend
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function pulzos($id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        // Get the users plans.
        $planes = $this->plan->get('planUsuarioId = '.$id, 1);
        $this->load->view('planes/pulzos', array('planes'=>$planes));
    }

    /**
     * See Events to attend
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function eventos($id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        // Get the users plans.
        $planes = $this->plan->get('planUsuarioId = '.$id, 2);
        $this->load->view('planes/eventos', array('planes'=>$planes));
    }

    /**
     * Crea un nuevo plan vacio. Listo para agregarle cositas
     *
     * @param integer $tipo Tipo del dato a agregar
     * @param integer $elemento Elemento que se agrega al plan
     * @param integer $id Id del usuario a mappear
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function crear($tipo, $elemento, $id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }

        //Create the pertinent info
        $data = array(
            'planTipo'=>$tipo,
            'planElementoId'=>$elemento,
            'planUsuarioId'=>$id,
            'planFechaCreacion'=>time(),
        );

        $last_insert = $this->plan->save($data);
        $friends = $this->input->post('Amigos');
        if($friends)
        {
            $this->add_invites($last_insert, $friends);
        }
        $amigos = $this->amigo->get_amigos_usuario($id, '1');
        $this->load->view('planes/agregar_amigos', array('last_insert'=>$last_insert, 'amigos'=>$amigos));
    }

    /**
     * Agregar amigos a un plan prefabricado
     *
     * @param integer $planId ID del plan al cual aregar amigos
     *
     * TODO: Agregar validación para no permitir el acceso si no existe.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function agregar_amigos($planId)
    {
        // add friend invitations to plan
        $friends = $this->input->post('Amigos');
        $this->add_invites($planId, $friends);
        redirect('planes/index/'.'1');
    }

    /**
     * Agregar amigos a un plan existente
     *
     * @param integer $planId ID del plan a modificar
     * @param mixed $friends amigos a quienes invitar
     *
     * TODO: Agregar chequeo de errores
     *
     * @return void
     * @author axoloteDeAccion
     **/
    private function add_invites($planId, $friends)
    {
        $this->plan->save_invites($planId, $friends);
    }

    /**
     * A method done to test this somehow.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function test($testUsuarioId, $testType)
    {
        $data = $this->plan->test($testUsuarioId, $testType);
        var_dump($data);
    }

    /**
     * Aceptar invitacion.
     *
     * @param ID invitacion
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function aceptar($id)
    {
        $this->plan->save_invitacion_accepted(array('invitacionAceptado'=>1), $id);
    }

    /**
     * Borrar plan
     *
     * @param integer $id id de la invitacion
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id)
    {
        $this->plan->delete($id);
    }

    /**
     * Rechazar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function rechazar($id)
    {
        $this->plan->rechazar($id);
    }

    /**
     * Mostrar las invitaciones hechas
     *
     * @param integer $id
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function hechas($id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        $planes = $this->plan->get('planUsuarioId = '.$id);
        $this->load->view('planes/hechas', array('planes'=>$planes));
    }

    /**
     * Mostrar las invitaciones recibidas
     *
     * @param integer $id Id del usuario
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function recibidas($id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        $invitaciones = $this->plan->get_invitaciones($id);
        $this->load->view('planes/recibidas', array('invitaciones'=>$invitaciones));
    }

    /**
     * Mostrar las invitaciones aceptadas
     *
     * @param integer $id Id del usuario
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function aceptadas($id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }
        $invitaciones = $this->plan->get_invitaciones_aceptadas($id);
        $this->load->view('planes/aceptadas', array('invitaciones'=>$invitaciones));
    }
}
