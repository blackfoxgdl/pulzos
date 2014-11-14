<?php
/**
 * Modelo que se usara para realizar todas las operaciones
 * a las bases de datos con los cuales se podran obtener o
 * guardar datos que posteriormente se podran usar
 * @author jalomo
 * @copyright ZavorDigital 2012
 * @package comentado
 **/
class comentado extends CI_Model
{

    /**
     * Metodo constructor donde se podran declarar ciertas cosas
     * como son algunas variables que se vayan a usar dentro de
     * esta clase
     *
     * @return void
     * @author jalomo
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table = "planesusuarios";
    }


	/**
     * Metodo que se usa para poder ver el plan de 
     * del usuario de forma individual con el cual
     * se veran con mas detalle como la de planes usuarios
     *
     * @params int id del plan
     * @return mixed datos del usuario
     * @author jalomo
     **/
    public function get_simple_plain($id)
    {
        $this->db->where('planId', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }
	
	 /**
     *se optienen los dartos para el header
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author jalomo
     **/
    public function get_data_user($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }
	
	/**
	 * Check if there are some
	 * data with the information passed
	 *
	 * @params two strings, email and password
	 * @params tinyint 1 or 0 depending user o business
	 * @return true or false
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function check_account($email, $password, $flag)
	{
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$this->db->where('statusEU',$flag);
		$this->db->from('usuarios');
		$count = $this->db->count_all_results();
		if($count != 0)
		{
		    return TRUE;
		}
		else
		{
		    return FALSE;
		}
	}
	
	/**
	 * Get the password for compare if is 
	 * correct with the typed for the user
	 *
	 * @params string with the email
	 * @return string with the password encode
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	 public function get_password($email)
     {
         $this->db->select('*')
                  ->from('usuarios')
                  ->join('negocios','negocioUsuarioId = id', 'left')
                  ->where('email',$email);
         $query = $this->db->get();
		 return $query->row();
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
        $this->db->where('invitacionUsuarioPersonalId != ', $id);
        $this->db->where('invitacionPersonalStatus', '1');
        $query = $this->db->count_all_results('invitacionpersonal');
        return $query;
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
}	
