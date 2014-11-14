<?php if(! defined('BASEPATH')) exit('No script Access Allowed');
/**
 * Controlador que se encargara de todas las invitaciones
 * personales que tengan los usuarios para poder visualizar
 * todos los eventos que se tienen de manera pendiente
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 29, 2011
 * @package invitacionesPersonales
 **/
class invitacionesPersonales extends MX_Controller
{

    /**
     * Constructor con el que se declararan
     * las librerias, helpers y el modelo
     * que se usara en el modulo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invitacionPersonal', '', TRUE);
        $this->load->helper(array('url', 'avatar', 'html', 'form', 'cyp', 'date'));
        $this->load->library(array('session', 'user_agent', 'form_validation','email'));
    }

    /**
     * Metodo que se encarga de ver a los eventos del usuario
     * que se tienen aun como pendientes, aqui se mostraran en
     * unas breves lineas
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $datos['invitaciones'] = $this->invitacionPersonal->get_invitations_info($id);
        $this->load->view('invitacionespersonales/index', $datos); 
    }

    /**
     * Metodo que se encarga de actualizar los status de las
     * invitaciones en los planes de los usuarios, los cuales al
     * hacer la funcion de actualizacion, iran desapareciendo de
     * las notificaciones de invitaciones
     *
     * @params int id de la invitacion
     * @params int id del plan
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function actualizar_status($id, $idP)
    {
        $this->invitacionPersonal->update_status($id);
        redirect('planesusuarios/ver_plan/'.$idP);
    }

    /**
     * Metodo que se usa o se encargara de que los status de las reservaciones
     * se actualicen y se muestren ya vistas las invitaciones para que el
     * usuario pueda ver tambien de manera mas personalizada la reservacion a
     * la que el usuario estan invitando
     *
     * @params int id del pulzo
     * @params int id del plan
     * @params int id de la invitacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function actualizar_reservaciones($idPu, $idPl, $id, $idU)
    {
        $this->invitacionPersonal->update_status_reservation($idPu, $idPl, $id);
        redirect('planesusuarios/ver_reservacion/'.$idPl.'/'.$idPu.'/'.$idU);
    }

    /**
     * Metodo que se usa para eliminar las invitaciones que ya no se deseen tener
     * en la parte del menu de invitaciones, esto para poder comenzar a limpiar las
     * invitaciones que se tengan de mas
     *
     * @params int id de la invitacion personal
     * @params int id del plan
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($idI, $idP, $idU)
    {
        $this->invitacionPersonal->delete($idI, $idP, $idU);
    }
}
