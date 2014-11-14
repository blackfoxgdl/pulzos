<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Modulo de redirecciones para el redireccionamiento de los comntarios
 * cuando el usuario reciba el email de pulzos
 * 
 * @author jalomo
 * @copyright ZavorDigital 2012
 **/
class comentados extends MX_Controller
{

    /**
     * Metodo constructor en el cual se declaran los helpers,
     * libraries y el modelo para poder usarse dentro
     * de este modulo
     *
     * @return void
     * @author jalomo
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comentado','', TRUE);
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'date', 'status', 'emails','form','invitacion'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
    }
	/*
	*Metodo index el cual se utiliza para ingresar al comentario 
	*por medio del email que se envio anteriormente
	* @params int id del plan
	*/
	public function index($id)
	{		
			if($this->session->userdata('id'))
			{
				$datos['plan'] = $this->comentado->get_simple_plain($id);
				$usuarios = $this->comentado->get_data_user($this->session->userdata('id'));
				$datos['usuario'] = $usuarios;
				$datos['notificaciones'] = $this->comentado->get_all_notifications($this->session->userdata('id'));
				$datos['inboxT'] = $this->comentado->inbox_total($this->session->userdata('id'), '1'); 
				$header = $this->load->view('comentados/header_login',$datos,TRUE);
				 
				$content = $this->load->view('comentados/inicio', $datos, TRUE);
           		 $this->load->view('main/template', array('header'=>$header,
                              'content'=>$content,
                              'included_file'=>array('statics/js/usuarios/perfil.js')
            ));
			}
			else
			{
				$datos['idplan']=$id;
				$header = $this->load->view('comentados/ingreso',$datos, true);
				$content = $this->load->view('comentados/registro',$datos,TRUE);
                $this->load->view('main/template', array(
								  'header'=>$header, 
								  'content'=>$content,
								  'included_file'=>array('statics/js/usuarios/guardar.js'),
                ));
			}			
		
	}
	
	/*
	*Metodo ver el cual se utiliza para ver el comentario 
	*por medio del email que se envio anteriormente
	* @params int id del plan
	*/
	public function ver($id)
	{		
			if($this->session->userdata('id'))
			{
				$datos['plan'] = $this->comentado->get_simple_plain($id);
				$usuarios = $this->comentado->get_data_user($this->session->userdata('id'));
				$datos['usuario'] = $usuarios;
				$datos['notificaciones'] = $this->comentado->get_all_notifications($this->session->userdata('id'));
				$datos['inboxT'] = $this->comentado->inbox_total($this->session->userdata('id'), '1'); 
				$this->load->view('comentados/index', $datos);
			}
			
	}
	
	/**
	 *Metodo login para el ingreso al comentario,
	 *es igual que el login del usuario pero
	 *le cambie unas cosas para adaptarlo a el controlador
	 *de comentados
	 **/
	public function login($idP=null)
    {	
		$datos['idplan']=$idP;
		$this->form_validation->set_rules('Ingreso[email]',
										  'Email',
										  'trim|valid_email|required');
		$this->form_validation->set_rules('Ingreso[password]',
										  'Contraseña',
										  'trim|max_length[60]|required');
										  
		$this->form_validation->set_message('valid_email','Ingrese su %s correctamente');
		$this->form_validation->set_message('trim','Ingrese su %s');
		$this->form_validation->set_message('required','Ingresa tu %s');
		
		$this->form_validation->set_error_delimiters('<span>','</span>');
		
		if($this->form_validation->run())
		{	
			$data = $this->input->post('Ingreso');
			$pass = encrypt_password($data['password'],$this->config->item('encryption_key'));
			if($this->comentado->check_account($data['email'], $pass, "0") === TRUE)
			{
				$passDB = $this->comentado->get_password($data['email']);
				if(check_password($data['password'], 
								  $passDB->password, 
								  $this->config->item('encryption_key')) === TRUE)
			   	{
					$this->session->set_userdata('id',$passDB->id);
					redirect('comentados/index/'.$idP.'');
				}
				else
				{	
					
					$header = $this->load->view('comentados/ingreso', $datos, TRUE);
					$content = $this->load->view('comentados/intento', $datos, TRUE);
					$this->load->view('main/template', array('header'=>$header,
													 		 'content'=>$content));
				}
			}
			elseif($this->comentado->check_account($data['email'], $pass, "1") === TRUE)
			{
				$passDB = $this->comentado->get_password($data['email']);
				if(check_password($data['password'], 
								  $passDB->password, 
							 	  $this->config->item('encryption_key')) === TRUE)
                {
                    $session = array('id'=>$passDB->id,
                                     'idN'=>$passDB->negocioId);
                    $this->session->set_userdata($session);
					redirect('negocios/perfil');
				}
				else
				{
					$header = $this->load->view('comentados/ingreso', $datos, TRUE);
					$content = $this->load->view('comentados/intento', $datos, TRUE);
					$this->load->view('main/template', array('header'=>$header,
													 		 'content'=>$content));
				}
			}
			else
			{
				$header = $this->load->view('comentados/ingreso', $datos, TRUE);
				$content = $this->load->view('comentados/intento', $datos, TRUE);
				$this->load->view('main/template', array('header'=>$header,
														 'content'=>$content));
			}			
		}
		else
		{
			$header = $this->load->view('comentados/ingreso', $datos, TRUE);
			$content = $this->load->view('comentados/intento', $datos, TRUE);
			$this->load->view('main/template', array('header'=>$header,
													 'content'=>$content));
		}
	}
	
}	
