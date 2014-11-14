<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Module Usuarios that'll contain all of the logic needed
 * for user management
 *
 * @version 0.1 
 * @copyright ZavorDigital, February 21, 2011
 * @package Usuarios 
 * @author blackfoxgdl <ruben.alonso21@gmail.com> 
 **/

class Usuarios extends MX_Controller{

    /**
     * Constructor. Up until now nothing has been needed
     * Just a Codeigniter controller parent
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com> 
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'passworder', 
            'cyp', 
            'apipulzos', 
            'avatar', 
            'invitacion',
            'status',
            'url',
            'form',
            'html',
            'date',
            'emails',
        ));
        $this->load->library(array('session', 'user_agent', 'form_validation','email'));
        $this->load->model('Usuario', '', TRUE);
    }

    /**
     * Index function to show the registry form,
     * login form and all the components that conform
     * the main view.
	 *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>  
     **/
    public function index()
    {
        //$this->mainI();
		$this->guardar();
    }
	
    /**
     * Method that check all the data of user's new
     * and check if is correct the information
	 * save in database
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>  
     **/
	  public function guardar()
      {
	  	  if($this->session->userdata('id'))
          {
		  	  $this->statusEU = $this->Usuario->check_data($this->session->userdata('id'));
		  	  if($this->statusEU->statusEU == 0)
			  {
              	redirect('usuarios/perfil');
			  }
			  else
			  {
			    redirect('negocios/perfil');
			  }
          }
          else
          {
		  $this->form_validation->set_rules('Usuarios[nombre]',
		  									'Nombre',
                                            'trim|required|max_length[140]');
          $this->form_validation->set_rules('Usuarios[apellidos]',
                                            'Apellidos',
                                            'trim|required|max_length[140]');
          $this->form_validation->set_rules('Usuarios[username]',
                                            'Nombre de Usuario',
                                            'trim|max_length[140]|min_length[6]');
		  $this->form_validation->set_rules('Usuarios[email]',
		  									'Correo Electronico',
											'callback_check_email|trim|required|valid_email');
		  $this->form_validation->set_rules('Usuarios[password]',
		  									'Contrase&ntilde;a',
											'trim|required|max_length[60]|min_length[6]');
		  $this->form_validation->set_rules('Usuarios[emailConfirm]',
		  									'Confirma tu correo electronico',
											'trim|required|max_length[60]|min_length[6]');
		  $this->form_validation->set_rules('Usuarios[idPulsera]',
		  									'Numero de Pulsera',
											'trim|integer');
		  $this->form_validation->set_rules('Usuarios[dias]',
		  									'Dia',
											'required|integer');
		  $this->form_validation->set_rules('Usuarios[mes]',
		  									'Mes',
											'required');
		  $this->form_validation->set_rules('Usuarios[ano]',
		  									'Año',
											'callback_mayor_edad|required|integer');
		  
		  $this->form_validation->set_message('valid_email','Ingrese su %s correctamente');
		  $this->form_validation->set_message('trim','Ingrese su %s');
		  $this->form_validation->set_message('required','Ingresa tu %s');
		  $this->form_validation->set_message('integer','Seleccione un %s');
		  $this->form_validation->set_message('max_length','Tu %s es demasiado largo.');
		  $this->form_validation->set_message('min_length',
		  								'Tu %s es muy corto, ingresa al menos 6 caracteres.');
		  
		
		  
		  if($this->form_validation->run($this))
		  {
              $post = $this->input->post('Usuarios');
              if(same_email($post['email'],$post['emailConfirm']) === TRUE)//same_password($post['password'], $post['confirmPassword']) === TRUE)
		 		{
		     		$now = date('Y-m-d H:i:s');
		     		$post['password'] = encrypt_password($post['password'], 
			 									  		 $this->config->item('encryption_key'));
                    //unset($post['confirmPassword']);
                    unset($post['emailConfirm']);
                    $post['pais'] = 0;
                    $post['ciudad'] = 0;
					$post['edad'] = $post['ano'] . "-" . $post['mes'] . "-" . $post['dias'];
					unset($post['ano']);
					unset($post['dias']);
					unset($post['mes']);
					
					$post['creacion'] = human_to_unix($now);
                    $value = $this->Usuario->save($post);
                    

    
					$this->exito($post['email']);
                }
          }
		  else
		  {	
				$datos = $this->Usuario->all_data('pais');
				$data['country'] = create_array($datos);
                $datosC = $this->Usuario->all_data('estado');
				$data['city'] = create_array($datosC);
				$data['dias'] = days();
				$data['anos'] = year();
				$data['meses'] = month();
				$header = $this->load->view('usuarios/header_main', '', true);
				$content = $this->load->view('registro', $data, true);
                $this->load->view('main/main_template', array(
                                  'header'=>$header, 
                                  'content'=>$content,
                                  'included_file'=>array('statics/js/usuarios/guardar.js'),
                ));
          }
          }//ELSE
      }

    /**
     * Method where the user can select for what kind
     * of option his want to go, if is user can select user
     * and send to part of the user's login, if is companies
     * the system can send to part of register or login to
     * companies
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mainI()
    {
        if($this->session->userdata('id'))
        {
		  	$this->statusEU = $this->Usuario->check_data($this->session->userdata('id'));
		    if($this->statusEU->statusEU == 0)
			{
              	redirect('usuarios/perfil');
			}
		    else
			{
			    redirect('negocios/perfil');
			}
        }
        else
        {
            $header = $this->load->view('usuarios/header_main', '', TRUE);
            $content = $this->load->view('usuarios/main', '', TRUE);
            $this->load->view('main/main_template', array('header'=>$header,
                                                          'content'=>$content));
        }
    }
	
	/**
	 * Metodos de llamadas a Callback
	 * para la validacion de correo y de
	 * la edad al momento de registrarse
	 *
	 * @params mixed diversos parametros
	 * 				 dependiendo la funcion
	 * @return flag Verdadero exito
	 *				Falso no exito
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	function mayor_edad($str)
	{
			$valor = date('Y');
			$this->edad = $valor - $str;
			if($this->edad <= 13)
			{
				$this->form_validation->set_message('mayor_edad', 
													'Eres menor de edad.');
				return FALSE;
			}
			return TRUE;
	}

    /**
     * Metodo callback para poder checar que el email
     * no existe en la base de datos
     *
     * @params string cadena a revisar
     * @return flags checar si existe o no el correo
     * author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
	function check_email($str)
	{
		if($this->Usuario->check_email($str) === TRUE)
		{
		
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }

    /**
     * Method where the system check if the username or email and the
     * password exists, if the data are correct for get pass to the
     * user to his account login
     *
     * @params string email
     * @params string password
     *
     * @return int total
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function checkExistsAccount($mail, $pass)
    {
        $password = encrypt_password($pass, 
			 						 $this->config->item('encryption_key'));
        $total = $this->Usuario->checkEmailExists($mail, $password, 1);
        echo $total;
    }
	
	/**
	 * Check if the email and password contain data
	 * for validate it and it will be correct and
	 * redirect to profile
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com> 
	 **/
	public function login()
    {	
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
			if($this->Usuario->check_account($data['email'], $pass, "3") === TRUE)
			{
				$passDB = $this->Usuario->get_password($data['email']);
				if(check_password($data['password'], 
								  $passDB->password, 
								  $this->config->item('encryption_key')) === TRUE)
			   	{
					$this->session->set_userdata('id',$passDB->id);
					redirect('usuarios/perfil');
				}
				else
				{
					$header = $this->load->view('negocios/header_main', '', TRUE);
					$content = $this->load->view('intento', '', TRUE);
					$this->load->view('main/template', array('header'=>$header,
													 		 'content'=>$content));
				}
			}
			elseif($this->Usuario->check_account($data['email'], $pass, "1") === TRUE)
			{
				$passDB = $this->Usuario->get_password($data['email']);
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
					$header = $this->load->view('negocios/header_main', '', TRUE);
					$content = $this->load->view('usuarios/intento', '', TRUE);
					$this->load->view('main/main_template', array('header'=>$header,
													 		 'content'=>$content));
				}
			}
			else
			{
				$header = $this->load->view('negocios/header_main', '', TRUE);
				$content = $this->load->view('usuarios/intento', '', TRUE);
				$this->load->view('main/main_template', array('header'=>$header,
														 'content'=>$content));
			}			
		}
		else
		{
			$header = $this->load->view('negocios/header_main', '', TRUE);//$this->load->view('ingreso', '', TRUE);
			$content = $this->load->view('usuarios/intento', '', TRUE);
			$this->load->view('main/main_template', array('header'=>$header,
													 'content'=>$content));
		}
    }

    /**
     * Method that going to use in the part of the
     * facebook login where the system will be
     * check all the information about the user that
     * want to login, for know if exists or not.
     *
     * @params post
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function login_fb()
    {
        $name = $this->input->post('first_name');
        $last = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $tokens = $this->input->post('token');
        $email = $this->input->post('email');
        $birthday = $this->input->post('birth');
        $tokenFBuId = $this->input->post('FBUid');
        /*if()
        {*/
            $total = $this->Usuario->check_fbUId($tokenFBuId);
            //$this->Usuario->check_email_user_exists($email); 
            //echo 'cual es el total: ' . $total;
            if($total == 0)
            {
                $cut_birth = explode('/', $birthday);
    
                if($gender == 'male')
                {
                    $sx = 1;
                }
                else
                {
                    $sx = 0;
                }
                $birth = $cut_birth[2] . "-" . $cut_birth[0] . "-" . $cut_birth[1];
                //echo "<br />la fecha es: " . $birth . "<br />";
                $now = date('Y-m-d H:i:s');
                $save_data = array('nombre'=>$name,
                                   'apellidos'=>$last,
                                   'email'=>$email,
                                   'password'=>'0',
                                   'sexo'=>$sx,
                   //            'edad'=>$birth,
                                   'ciudad'=>0,
                                   'pais'=>0,
                                   'creacion'=>$now,
                                   'codigoRecuperacion'=>'0',
                                   'statusRecuperacion'=>'1',
                                   'statusIngreso'=>'0',
                                   'statusEU'=>'0',
                                   'usuariosCode'=>'0',
                                   'usuariosStatusActivado'=>'0',
                                   'usuariosFBuId'=>$tokenFBuId);

                $date = date($cut_birth[2] . "-" . $cut_birth[0] . "-" . $cut_birth[1]);
                $save_data['edad'] = $date . ' 00:00:00';
                $id_band = $this->Usuario->save_fb($save_data);
                //PART WHERE UPDATE THE DATA OF THE USER FOR GENERATE THE CODE
                $codeRegisterU = $id_band.date('s');
                $this->Usuario->update_codeRegister($id_band, $codeRegisterU);
                $this->Usuario->save_personal($id_band);

                $data_fb = array('tokenFacebook'=>$tokens,
                                 'socialUsuarioId'=>$id_band);
                $this->Usuario->save_tokens_FB($data_fb);
                $names = array();
                $names['name'] = $name;
                $names['email'] = $email;
                $names['tokens'] = $tokens;
                $names['gender'] = $gender;
                $names['last'] = $last;
                echo $id_band;
            }
            else
            {
                //echo "ya debe estar logueado: " . $email;
                $id = $this->Usuario->user_data_by_fb($tokenFBuId);//user_data($email);
                //UPDATE TOKEN FACEBOOK
                $this->Usuario->update_tokenFB($tokens, $id->id);
                //$this->session->set_userdata('id',$id->id);
                //redirect('usuarios/perfil');
                echo $id->id;
            }
            //$this->load->view('usuarios/login_fb', $names);
        /*}
        else
        {
            redirect();
        }*/
    }

    /**
     * Method userd for check that a user made the login
     * will be a user and dont be a company, because if is a company
     * the system recognize and redirect to another site where the
     * companies start session in his profile
     *
     * @params string email
     * @return int status
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_useraccount($email)
    {
        $data = $this->Usuario->user_data($email);
        echo $data->statusEU;
    }

    /**
     * Method where redirect once the user register o login by
     * facebook. this method going to create a session of
     * users for the can navigate for all the platform. Once created
     * this part the platform redirect
     *
     * @paramns int id
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function create($id)
    {
        $this->session->set_userdata('id',$id);
        redirect('usuarios/perfil');
    }

    /**
     * METHOD FOR SAVE THE AVATAR AND THUMB IN FB
     **/
    public function save_avatar()
    {
        //check if exists form or not in all the registers
        $idUser = $this->input->post('id');
        $totalAlbums = get_total_albums($idUser);
        if($totalAlbums == 0)
        {
            //first save one album by default
            $date_creation = time();
            $album_main = array('albumUsuarioId'=>$idUser,
                                'albumDefault'=>1,
                                'albumNombre'=>'Mis fotos de Perfil',
                                'albumFechaCreacion'=>$date_creation,
                                'albumLugar'=>'Mi Perfil',
                                'albumDescripcion'=>'Imágenes que he usado como fotos de perfil',
                                'albumFechaModificacion'=>0);
            $ida = $this->Usuario->save_avatar_fb('albums', $album_main);
    
            //save the url of the picture of avatar
            $avatar1 = $this->input->post('avatar1');
            $album = array('imagenAlbumId'=>$ida,
                           'imagenAvatar'=>1,
                           'imagenNombre'=>'',
                           'imagenDescripcion'=>'',
                           'imagenRuta'=>$avatar1,
                           'imagenFechaCreacion'=>time(),
                           'imagenFechaModificacion'=>time());
            $idi = $this->Usuario->save_avatar_fb('imagenes', $album);

            //save the thumbnail directly of facebook
            $avatar2 = $this->input->post('avatar2');
            $album_avatar = array('usuarioThumbName'=>$avatar2,
                                  'thumbUsuarioId'=>$idUser);
            $idit = $this->Usuario->save_avatar_fb('imagenes_thumb', $album_avatar);
        }
        else
        {
            $avatar1 = $this->input->post('avatar1');
            $avatar2 = $this->input->post('avatar2');
            $idA = get_album_id($idUser);
            $this->Usuario->update_avatar_profile($avatar1, $idA->albumId);
            $this->Usuario->update_avatar_thumb($avatar2, $idUser);
        }
        //echo "las url son: " . $avatar1 . ' ' . $avatar2;
    }
   
   /**
    * Close the session of the user in Pulzos,
	* destroy the data of user's current session
	* 
	* @return void
	* @author blackfoxgdl <ruben.alonso21@gmail.com>
	**/
    public function perfil($id_amigo = NULL, $msj=NULL)
    {	if($this->session->userdata('id')==FALSE){$this->index();}else{
            if($id_amigo)
            {
                $this->nombre_usuario = $this->Usuario->data_name($id_amigo);
                $tipo_amistad = $this->Usuario->type_of_friendly($this->session->userdata('id'), $id_amigo);
                if($tipo_amistad != '0')
                {
                    $amistad = $this->Usuario->data_friendship($this->session->userdata('id'),$id_amigo);
                    $datos['amistad'] = $amistad->amigoAceptado;
                }
                else
                {
                    $datos['amistad'] = '0';
                }
				$datos['amigos_total'] = $this->Usuario->count_friends($this->session->userdata('id'),$id_amigo);
		}
		else
		{
				$this->nombre_usuario = $this->Usuario->data_name($this->session->userdata('id'));
		}
            $total = $this->Usuario->get_count_business($this->session->userdata('id'));
            if($total != 0)
            {
                $negocios_seguir = $this->Usuario->business_follow($this->nombre_usuario->id);
                $datos['total'] = $total;
                $datos['negocios_seguir'] = $negocios_seguir;
                //$datos['pulzos_negocios'] = $this->Usuario->get_pulzos_negocio_vivo($negocios_seguir->negocioUsuarioId);
            }
            else
            {
                $datos['total'] = $total;
                $datos['pulzos_negocios'] = "No sigues ningun negocio actualmente.";
            }
			
            $estado = $this->Usuario->data_profile('usuarioId',
											$this->nombre_usuario->id,
										    'personal');
										  
            if($estado->relaciones != '')
            {
                $datos['personal'] = $this->Usuario->estado_civil($this->nombre_usuario->id);
            }
            else
            {
                $datos['personal'] = null;
            }
            if(isset($msj)){
                $datos['mensaje']=$msj;
            }
            $datos['usuario'] = $this->nombre_usuario;
            //PARA EL HEADER QUE NO CAMBIE USUARIO
            $usuarioSesion = $this->Usuario->data_name($this->session->userdata('id'));
            $datos['usuarios2'] = $usuarioSesion;
            $datos['localidades2'] = $this->Usuario->data_location($usuarioSesion->ciudad);  
            //PARA EL HEADER QUE NO CAMBIE USUARIO
	        $datos['localidad'] = $this->Usuario->data_location($this->nombre_usuario->ciudad);
            $datos['edad'] = edad_usuario($this->nombre_usuario->edad);
            $datos['etiquetas'] = $this->Usuario->etiquetas();
            $datos['pulzosDer'] = $this->Usuario->pulzos_der('0');
            $datos['retosDer'] = $this->Usuario->pulzos_der('1');
            $datos['inboxT'] = $this->Usuario->inbox_total($this->session->userdata('id'), '1');
            $datos['notificaciones'] = $this->Usuario->get_all_notifications($this->session->userdata('id'));
            // SE COMENTAR POR EL MOMENTO ESTA LINEA HASTA PROXIMO AVISO   
            $datos['notificacion'] = $this->Usuario->get_notifications($this->session->userdata('id'));
			$usuariosU = $this->Usuario->get_data_user($this->session->userdata('id'));
			
			if($usuariosU->statusEU == 0)
			{
				$header = $this->load->view('header_login', $datos, TRUE);
			}
			else
			{
            $datos['usuariosU'] = $usuariosU;
            $datos['localidadesN'] = $this->Usuario->data_location($this->nombre_usuario->ciudad);
            // SE COMENTA ESTA LINEA HASTA NUEVO AVISO $data['notificacion'] = $this->Negocio->get_notifications($this->session->userdata('id'));//$this->nombre_usuario->id);
           $header = $this->load->view('negocios/header_login1',$datos, TRUE);
        	}
			$this->Usuario->get_default_album($this->session->userdata('id'));
			$this->Usuario->get_album($this->session->userdata('id'));
            //$header = $this->load->view('header_login', $datos, TRUE);
            $content = $this->load->view('perfil', $datos, TRUE);
            $this->load->view('main/template', array('header'=>$header,
                              'content'=>$content,
                              'included_file'=>array('statics/js/usuarios/perfil.js')
            ));
		}		
    }

        /**
     * Metodo que se usa para poder actualizar los datos
     * que se tienen actualmente en la barra del header para
     * que se pueda actualizar y que no afecte ningun valor
     * que los usuarios pongan en la caja de texto
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_header($id)
    {
        $datos['inboxT'] = $this->Usuario->inbox_total($this->session->userdata('id'), '1');
        $datos['notificaciones'] = $this->Usuario->get_all_notifications($this->session->userdata('id'));
        // SE COMENTAR POR EL MOMENTO ESTA LINEA HASTA PROXIMO AVISO   
        $datos['notificacion'] = $this->Usuario->get_notifications($this->session->userdata('id'));
        $this->load->view('usuarios/actualizar_header', $datos);
    }

    /**
     * Metodo que se encarga de actualizar las vistas de manera dinamica
     * para que se pueda actualizar una vez que se agreguen nuevos amigos
     * o que se eliminen nuevos amigos
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_friends_new($id)
    {
        $datos['usuario'] = $this->Usuario->data_name($id);
        $this->load->view('usuarios/amigos_nuevos', $datos);
    }

    /**
     * Metodo que se usa para poder actualizar los datos de
     * los negocios ya sea para los que se eliminan y los que
     * se agregan como nuevos para que vayan apareciendo poco 
     * a poco
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_companies_new($id)
    {
        $datos['usuario'] = $this->Usuario->data_name($id);
        $this->load->view('usuarios/negocios_nuevos', $datos);
    }

    /**
     * Metodo que se encarga de cargar las vistas de manera dinamica
     * para mostrar los pulzos de las empresas que se tienen en
     * el perfil de los usuarios
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl
     **/
    public function mis_empresas($id)
    {
        $this->load->view('usuarios/empresas');
    }
	
	/**
	 * Recover the data sending
	 * and email with a link for login
	 * to account and change the password
     *
     * @params string with the email address
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
    public function olvidar()
	{
		$this->form_validation->set_rules('email','E-mail','required|email_valid');
		$this->form_validation->set_message('required','Ingrese su %s');
		$this->form_validation->set_message('email_valid','Su E-mail tiene formato incorrecto');
		
		$this->form_validation->set_error_delimiters('<br /><br /><div class="error">','</div>');
		
		if($this->form_validation->run($this))
        {
            $email = $this->input->post('email');
            $name = $this->Usuario->user_data($email);

            //EL CODIGO SE GENERARA CON EL NOMBRE Y EL EMAIL DEL USUARIO Y LA FECHA ACTUAL EN TIMESTAMP
            $code = generate_code($email, $name->nombre);
            //SE GUARDA EL CODIGO DEL USUARIO
            $this->Usuario->save_code_user($code, $name->id);
            
            //PARTE DONDE SE MANDA A LLAMAR LA PARTE DEL EMAIL
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->email->initialize($config);

            //GET THE TEMPLATE
            $nombre_completo = $name->nombre . ' ' . $name->apellidos;
            $url = $code;
            $template = get_password_email($nombre_completo, $url, $name->id);

            $this->email->from('atencion@pulzos.com','Pulzos');
            $this->email->to($email, $name->nombre);
            $this->email->subject('Solicitud de nueva contraseña!');
            $this->email->message($template);
            $this->email->send();
			
            redirect('usuarios/');
		}
		else
		{
			$header = $this->load->view('ingreso', '', true);
			$content = $this->load->view('recuperar', '', true);
			$this->load->view('main/template', array('header'=>$header,
													 'content'=>$content));
		}
    }

    /**
     * Metodo que se usa para recuperar la contraseña del usuario la cual es un
     * metodo con el cual el usuario podra resetear los datos para que el mismo
     * pueda reestablecer la contraseña de nueva cuenta a una nueva la cual
     * el la podra usar sin necesidad de que este mandando correo al administrador
     * de pulzos para que este resetea la contraseña la cual es imposible
     *
     * @params int id del usuario
     * @params string codigo de reseteo de password
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function recuperar_password($id, $code)
    {
        $chequeo = $this->Usuario->get_total_code($id, $code);
        if($chequeo != 0)
        {
            $datos['id'] = $id;
            $header = $this->load->view('ingreso', '', true);
            $content = $this->load->view('recovery', $datos, true);
            $this->load->view('main/template', array('header'=>$header,
                                                     'content'=>$content));
        }
        else
        {
            redirect('usuarios');
        }
    }

    /**
     * Metodo que se usa para resetear el password de los usuarios
     * con los cuales estos se guarda el nuevo password que se tiene para
     * que los usuarios puedan ingresar de nueva cuenta a la plataforma con
     * su nuevo password y asi disfrutar de pulzos
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function resetear_pass($id, $pass1)
    {
        $password = encrypt_password($pass1, 
			 						 $this->config->item('encryption_key')); 
        $this->Usuario->save_new_password($password, $id);
    }

    /**
     * Metodo que se usa para poder revisar que los dos password
     * sean identicos y que se pueda conocer que hacen match, asi se
     * podra seguir en el proceso, en caso contrario se tendra que 
     * checar los password
     *
     * @params string pass uno
     * @params string pass dos
     *
     * @return int 0 o 1
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_password_same($str1, $str2)
    {
        $valor = same_password($str1, $str2);
        if($valor == TRUE)
        {
            $array = array('id'=>1);
            echo json_encode($array);
        }
        else
        {
            $array = array('id'=>0);
            echo json_encode($array);
        }
    }
   
	/**
	 * Load the view of user's profile
	 * and create the session
	 *
	 * @params int for session
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
   public function cerrar_sesion()
   {
       $this->session->unset_userdata('id');
       if($this->session->userdata('idN'))
       {
           $this->session->unset_userdata('idN');
       }
       $this->session->sess_destroy();
	   redirect('');
   }
   
   /**
    * Edit all the user's data when
	* the user press the link edit profile.
	* Can change the data introduced during 
	* the register in the pulzos and save
	* in the database.
	*
	* @params int with id of user
	* @return user's data of database
	* @author blackfoxgdl <ruben.alonso21@gmail.com>
	**/
	public function editar_datos()
	{
		$this->form_validation->set_rules('EditarU[nombre]',
										  'Nombre',
                                          'trim|required|length[140]');
        $this->form_validation->set_rules('EditarU[apellidos]',
                                          'Apellidos',
                                          'trim|length[140]');
		$this->form_validation->set_rules('EditarU[email]',
										  'E-mail',
										  'trim|valid_email|required');
		$this->form_validation->set_rules('EditarU[password]',
										  'Contraseña',
										  'trim|requires');
	 	$this->form_validation->set_rules('EditarU[idPulsera]',
										  'N. Pulsera',
										  'trim|integer');
		$this->form_validation->set_rules('EditarP[acercaDe]',
										  'Acerca de mi',
										  'max_length[500]');
		$this->form_validation->set_rules('EditarP[escuela]',
										  'Universidad',
                                          'max_length[140]');
        $this->form_validation->set_rules('EditarP[escuela2]',
                                          'Escuela Preparatoria',
                                          'max_length[150]');
        $this->form_validation->set_rules('EditarP[escuela3]',
                                          'Escuela Secundaria',
                                          'max_length[150]');
        $this->form_validation->set_rules('EditarP[escuela4]',
                                          'Escuela Primaria',
                                          'max_length[150]');
		$this->form_validation->set_rules('EditarP[estudios]',
										  'Estudios',
										  'max_length[140]');
		$this->form_validation->set_rules('EditarP[ubicacion]',
										  'Ubicacion',
										  'max_length[140]');
		$this->form_validation->set_rules('EditarP[intereses]',
										  'Intereses',
										  'max_length[400]');
		$this->form_validation->set_rules('EditarP[localidad]',
										  'Localidad',
										  'max_length[140]');
		$this->form_validation->set_rules('EditarP[profesion]',
										  'Profesion',
										  'max_length[140]');
		$this->form_validation->set_rules('EditarP[relaciones]',
										  'Relaciones',
										  'max_length[140]');
		
		$this->form_validation->set_message('valid_email','Ingrese su %s correctamente');
		$this->form_validation->set_message('trim','Ingrese su %s');
		$this->form_validation->set_message('required','Ingresa tu %s');
        $this->form_validation->set_message('integer','Ingresa solo numeros en el %s.');
        $this->form_validation->set_message('max_length', 'Demasiada largo el texto de %s.');
		
		$this->form_validation->set_error_delimiters('<span>','</span>');
		
		if($this->form_validation->run())
		{
			$post = $this->input->post('EditarU');
            $post1 = $this->input->post('EditarP');
            if($post['password'] != "")
            {
			    $post['password'] = encrypt_password($post['password'], 
				    								 $this->config->item('encryption_key'));
            }
            else
            {
                unset($post['password']);
            }
			$this->Usuario->update_profile($post, $this->session->userdata('id'));
			$this->Usuario->update_personal($post1, $this->session->userdata('id'));
			redirect('usuarios/perfil');
		}
		else
		{
			$datosP = $this->Usuario->data_profile('usuarioId',
												   $this->session->userdata('id'),
												   'personal');
			$this->nombre_usuario = $this->Usuario->check_data($this->session->userdata('id'));
            $data['localidad'] = $this->Usuario->data_location($this->nombre_usuario->ciudad);
            $relacion = $this->Usuario->all_data('estadocivil');
            $data['relaciones'] = create_array($relacion);
            $data['edad'] = edad_usuario($this->nombre_usuario->edad);
			$data['datos'] = $this->Usuario->data_profile('id',
														  $this->session->userdata('id'),
                                                          'usuarios');
            $ciudades = $this->Usuario->all_data('ciudad');
            $paises = $this->Usuario->all_data('pais');
            $data['ciudad'] = create_array($ciudades);
            $data['pais'] = create_array($paises);
			$data['datosP'] = $datosP;
			//$header = $this->load->view('header_login', '', TRUE);
            /*$content = */$this->load->view('usuarios/editar_perfil', $data);
			//$this->load->view('main/template', array('header'=>$header,
			//									 	 'content'=>$content));
		}
    }

    /**
     * Metodo que cargara y se encargara de guardar
     * los datos del usuario con el cual uno podra
     * editar los datos personales del usuario
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function personales($id)
    {

            $post = $this->input->post("EditarU");
            if($post)
            {
                if($post['ano'] != 'ano' and $post['dia'] != 'dia' and $post['mes'] != '0')
                {
                    $post['edad'] = $post['ano'].'-'.$post['mes'].'-'.$post['dia'].' 00:00:00';
                    unset($post['ano']);
                    unset($post['mes']);
                    unset($post['dia']);
                }
                else
                {
                    unset($post['ano']);
                    unset($post['mes']);
                    unset($post['dia']);
                }
                $post1 = $this->input->post("EditarP");
                $this->Usuario->update_profile($post, $this->session->userdata('id'));
                $this->Usuario->update_personal($post1, $this->session->userdata('id'));
                return ;
            }

            $datosP = $this->Usuario->data_profile('usuarioId',
	    										   $this->session->userdata('id'),
		    									   'personal');
            $relacion = $this->Usuario->all_data('estadocivil');
            $data['datosU'] = $this->Usuario->data_profile('id',
		    											  $this->session->userdata('id'),
                                                          'usuarios');
            $data['datos'] = $datosP;
            $data['dias'] = days();
			$data['anos'] = year();
			$data['meses'] = month();
            $data['relaciones'] = create_array($relacion);
            $data['band'] = 1;
            $this->load->view('usuarios/edit_personales', $data);
       
    }

    /**
     * Metodo para mostrar los datos acerca de
     * mi y asi los usuarios poder manipular los datos
     * ya sea editarlos o no hacer nada
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function acerca_de_mi($id)
    {
        $post = $this->input->post("EditarA");
        if($post)
        {
            $this->Usuario->update_personal($post, $this->session->userdata('id'));
            return;
        }
        $data['datosP'] = $this->Usuario->data_profile('usuarioId',
											            $this->session->userdata('id'),
											            'personal');
        $this->load->view('usuarios/edit_acerca', $data);
    }

    /**
     * Metodo que se encarga de cargar los datos del
     * estudio del usuario para poder validarlos
     * o editarlos y asi puedan ver los
     * datos del usuario
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function estudios_usuario($id)
    {
        $post = $this->input->post('EditarE');
        if($post)
        {
            $this->Usuario->update_personal($post, $this->session->userdata('id'));
            return;
        }
        $data['datosP'] = $this->Usuario->data_profile('usuarioId',
											            $this->session->userdata('id'),
											            'personal');
        $this->load->view('usuarios/edit_estudios', $data);
    }

    /**
     * Metodo que se encarga de mostrar los datos de ubicacion para la 
     * actualizacion de los usuario en cuanto a los datos de edicion de
     * cuenta del usuario
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ubicacion_usuario($id)
    {
        $post = $this->input->post('EditarU');
        $post1 = $this->input->post('EditarP');
        if($post || $post1)
        {
            $this->Usuario->update_profile($post, $this->session->userdata('id'));
            $this->Usuario->update_personal($post1, $this->session->userdata('id'));
            return;
        }
        $dta = $this->Usuario->data_profile('id',
											$this->session->userdata('id'),
                                            'usuarios');
        if($dta->pais == 0)
        {
            $ciudades = $this->Usuario->all_data('estado');
            $paises = $this->Usuario->all_data('pais');
        }
        else
        {
            $ciudades = $this->Usuario->all_data_by_country($dta->pais);
            $paises = $this->Usuario->all_data('pais');
        }
        $data['ciudad'] = create_array($ciudades);
        $data['pais'] = create_array($paises);
        $data['datosU'] = $dta; 
        $data['datosP'] = $this->Usuario->data_profile('usuarioId',
											            $this->session->userdata('id'),
                                                        'personal');
        
        $this->load->view('usuarios/edit_ubicacion', $data);
    }

    /**
     * Metodo que se encarga de llenar obtener todos los datos de los
     * usuarios en cuanto a la ubicacion que tienen actualmente
     * puesta en la parte del header de la plataforma, al momento de
     * editarla se tendra que actualizar para la parte de negocios que
     * se mostrara en una parte de estas
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ubicacion_usuario_header($id)
    {
        $post = $this->input->post('EditarU');
        $post1 = $this->input->post('EditarP');
        if($post || $post1)
        {
            $this->Usuario->update_profile($post, $this->session->userdata('id'));
            $this->Usuario->update_personal($post1, $this->session->userdata('id'));
            return;
        }
        $dta = $this->Usuario->data_profile('id',
											$this->session->userdata('id'),
                                            'usuarios');
        if($dta->pais == 0)
        {
            $ciudades = $this->Usuario->all_data('estado');
            $paises = $this->Usuario->all_data('pais');
        }
        else
        {
            $ciudades = $this->Usuario->all_data_by_country($dta->pais);
            $paises = $this->Usuario->all_data('pais');
        }
        $data['ciudad'] = create_array($ciudades);
        $data['pais'] = create_array($paises);
        $data['datosU'] = $dta;
        $data['datosP'] = $this->Usuario->data_profile('usuarioId',
											            $this->session->userdata('id'),
                                                        'personal');
        $this->load->view('usuarios/edit_ubicacion_header', $data);
        
    }

    /**
     * Metodo que se encarga de actualizar los links que se tienen
     * en la parte de las empresas con los cuales los usuarios podran
     * ver los negocios que se tienen actualmente dados de alta en esa
     * ciudad sin necesidad de actualizar la plataforma completa
     *
     * @params int id de la ciudad
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_links_company_users($id)
    {
        $id_city['id'] = $id;
        $this->load->view('usuarios/update_options_company', $id_city);
    }

    /**
     * Metodo que se encargara de llenar todos los datos de privacidad
     * o mejor dicho de editar los datos de privacidad para que el usuario
     * pueda ingresar sus nuevos datos y actualizarlos, redireccionandolor
     * al index de su pagina.
     *
     * @params int id del usuario
     * @return void
     * @uthor blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function privacidad_usuario($id)
    {
        $post = $this->input->post('EditarP');
        if($post)
        {
            $post['password'] = encrypt_password($post['password'], 
				    							 $this->config->item('encryption_key'));
            unset($post['confirmPass']);
            $this->Usuario->update_profile($post, $this->session->userdata('id'));
            return;
        }
        $data['id'] = $id;
        $this->load->view('usuarios/edit_privacidad', $data);
    }

    /**
     * Show the view of the
     * search of users for
     * add like friends
     *
     * @return void
     * @author jorge Leon 
     **/
    public function busqueda($nombre=null)
    {
		$post = $this->input->post('buscar');
		if($post)
                {
			$datos['buscar'] = $this->Usuario->search($this->session->userdata('id'), $post);
                        $datos['contador'] = $this->Usuario->count_all($this->session->userdata('id'), $post['buscar']);
                        
		}
                elseif($nombre!='Buscar')
                {
                        $unir1=str_replace("_", " ",$nombre);
                        $unir=trim($unir1);
                        $datos['buscar'] = $this->Usuario->search($this->session->userdata('id'), $unir);
                        $datos['contador'] = $this->Usuario->count_all($this->session->userdata('id'), $unir);
                }
                else
		{
			$datos['perfiles'] = $this->Usuario->search($this->session->userdata('id'));
			$datos['contador'] = $this->Usuario->count_all($this->session->userdata('id'));
                      
		}
               $this->load->view('busqueda', $datos);
    }
    
    public function busquedaMas($caracter){
        $datos['buscarMas'] = $this->Usuario->searchMas($this->session->userdata('id'), $caracter);
        $datos['contador'] = $this->Usuario->count_all($this->session->userdata('id'), $caracter);
        $this->load->view('busqueda', $datos);
    }
	
	/** 
	 * Metodo para cargar la redireccion
	 * en caso de que el registro se haya
	 * dado con exito
     * 
     * @params string email
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function exito($email)
	{
		$this->sesion = $this->Usuario->get_password($email);
		$this->session->set_userdata('id',$this->sesion->id);
        $this->Usuario->save_personal($this->sesion->id);
        $usuarioSesion = $this->Usuario->data_name($this->session->userdata('id'));
        $datos['usuarios2'] = $usuarioSesion;
        $datos['localidades2'] = $this->Usuario->data_location($usuarioSesion->ciudad);  
        $datos['inboxT'] = $this->Usuario->inbox_total($this->session->userdata('id'), '1');
        $datos['notificaciones'] = $this->Usuario->get_all_notifications($this->session->userdata('id'));
        // SE COMENTA ESTA LINEA HASTA PROXIMO AVISO 
        $datos['notificacion'] = $this->Usuario->get_notifications($this->session->userdata('id'));
        $datos['usuario'] = $this->Usuario->data_name($this->session->userdata('id'));

        if($usuarioSesion->ciudad == 7)
        {
            //AMIGOS COMO AMIGOS CON PULZOS COLIMA
            $amigosempresa = array('amigoUsuarioId'=>$this->session->userdata('id'),
                                   'amigoAmigoId'=>'946',
                                   'amigoAceptado'=>'3',
                                   'amigoFechaCreacion'=>time(),
                                   'amigoTipo'=>'1');
            $this->Usuario->save_friendly($amigosempresa);

            $empresaamigos = array('amigoUsuarioId'=>'946',
                                   'amigoAmigoId'=>$this->session->userdata('id'),
                                   'amigoAceptado'=>'3',
                                   'amigoFechaCreacion'=>time(),
                                   'amigoTipo'=>'1');
            $this->Usuario->save_friendly($empresaamigos);

            //METODO QUE SE USA PARA PODER REALIZAR AUTOMATICAMENTE SEGUIDOR DE PULZOS COLIMA
            $seguidores = array('seguidorUsuarioId'=>$this->session->userdata('id'),
                                'seguidorNegocioId'=>'892',
                                'seguidorFechaCreacion'=>time());
            $this->Usuario->save_follower_company($seguidores);
        }
        elseif(($usuarioSesion->ciudad == 1) || ($usuarioSesion->ciudad == 2) || ($usuarioSesion->ciudad == 3) || ($usuarioSesion->ciudad == 4) || ($usuarioSesion->ciudad == 5) || ($usuarioSesion->ciudad == 6))
        {
            //AMIGOS COMO AMIGOS
            $amigosempresa = array('amigoUsuarioId'=>$this->session->userdata('id'),
                                   'amigoAmigoId'=>'822',
                                   'amigoAceptado'=>'3',
                                   'amigoFechaCreacion'=>time(),
                                   'amigoTipo'=>'1');
            $this->Usuario->save_friendly($amigosempresa);
    
            $empresaamigos = array('amigoUsuarioId'=>'822',
                                   'amigoAmigoId'=>$this->session->userdata('id'),
                                   'amigoAceptado'=>'3',
                                   'amigoFechaCreacion'=>time(),
                                   'amigoTipo'=>'1');
            $this->Usuario->save_friendly($empresaamigos);
    
            //PARTE PARA GUARDAR LOS SEGUIDORES DE LOS USUARIOS
            $seguidores = array('seguidorUsuarioId'=>$this->session->userdata('id'),
                                'seguidorNegocioId'=>'796',
                                'seguidorFechaCreacion'=>time());
            $this->Usuario->save_follower_company($seguidores);
        }

        //PARTE DONDE SE CREA LA THUMB POR DEFECTO
        $this->load->library('image_lib');

        //se crea el directorio para el thumbnail
        $file_path1 = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/';
        //create directory
        @mkdir($file_path1, 0777, true);

        $nombres_usuarios1 = get_user_name($this->session->userdata('id'));
        $name_short1 = cut_name_user($nombres_usuarios1);

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'statics/img/default/avatar.jpg';
        $config['create_thumb'] = 'TRUE';
        $config['maintain_ratio'] = 'TRUE';
        $config['width'] = 45;
        $config['height'] = 55;
        $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';

        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //GUARDAR EN LA BD
        $ruta_imagen = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';//.$corte[1];
        $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                             'thumbUsuarioId'=>$this->session->userdata('id')
                            );
        //var_dump($datos_thumb);
        $this->Usuario->save_thumb($datos_thumb);

        //SEND EMAIL OF WELCOME TO NEW USER'S
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->load->library('email');
        $this->email->initialize($config);
                    
        //GET THE TEMPLATE
        $name_complete_user = $usuarioSesion->nombre . ' ' . $usuarioSesion->apellidos;//$post['nombre'] . ' ' . $post['apellidos'];
        $template = email_welcome($name_complete_user, $this->session->userdata('id'));

        //FORMAT TO SEND EMAIL WELCOME
        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to($email, $name_complete_user);
        $this->email->subject('Bienvenido a Pulzos.com');
        $this->email->message($template);
        $this->email->send();

		$header = $this->load->view('header_login', $datos, TRUE);
		$content = $this->load->view('exito', '', TRUE);
		$this->load->view('main/template',array('header'=>$header,
												'content'=>$content));
	}
	
	/**
	 * Metodo para redireccionar a la
	 * vista de recuperacion de 
	 * password reseteando el que
	 * tenias anteriormente
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function nuevo($id)
	{
		$this->form_validation->set_rules('Nuevo[password]',
										  'Contrase&ntilde;a',
										  'trim|required');
		$this->form_validation->set_rules('Nuevo[password1]',
										  'Confirmacion de Contrase&ntilde;a',
										  'trim|required');
		
		$this->form_validation->set_message('trim',
											'Ingrese la/el %s.');
		$this->form_validation->set_message('required',
											'Ingrese la/el %s.');
										  
		if($this->form_validation->run())
		{
			$nuevo = $this->input->post('Nuevo');
			$post['password'] = encrypt_password($post['password'],
												 $this->config->item('encryption_key') === TRUE);
			unset($post['password1']);
			$this->Usuario->update_password($post, $id);
			redirect('usuarios');
		}
		else
		{
			$header = $this->load->view('ingreso', '', TRUE);
			$content = $this->load->view('nuevo', '', TRUE);
			$this->load->view('main/template', array('header'=>$header,
													 'content'=>$content));
		}
    }

    /**
     * Metodo que se usara para mostrar los datos personales
     * del usuario a los visitantes de su perfil, solo podran ver
     * esto hasta que el dueño del perfil haya aceptado la
     * amistad del solicitante.
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function datos_personales($id)
    {
        $usuario = $this->Usuario->data_name($id);
        $datos['personales'] = $this->Usuario->get_personal_user($id);
        $datos['usuarios'] = $this->Usuario->data_name($id);
        $estado = $this->Usuario->data_profile('usuarioId',
		    									$usuario->id,
			    							    'personal');
										  
        if($estado->relaciones != '')
        {
            $datos['personal'] = $this->Usuario->estado_civil($usuario->id);
        }
        else
        {
            $datos['personal'] = null;
        }
        $datos['edad'] = edad_usuario($usuario->edad);
        $datos['localidad'] = $this->Usuario->data_location($usuario->ciudad);

        $this->load->view('usuarios/personal', $datos);
    }

    /**
     * Checar el email del usuario para conocer si realmente este
     * existe o si no esta registrado para mandar un mensaje o mandar
     * el email de registro del link para cambiar el password del
     * usuario
     *
     * @params string email de usuario
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function checar_email_existe($str)
    {
        $str = str_replace('---', '@', $str);
        $valor = $this->Usuario->check_email_user_exists($str);
        $val = array('id'=>$valor);
        echo json_encode($val);
    }

    /**
     * Metodo para cargar el formulario con el cual se daran de
     * alta los negocios que no esten registrados en la plataforma,
     * asi el usuario podra ser padrino del negocio una vez que sea
     * reclamado el mismo
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl
     **/
    public function dar_alta($id)
    {
        $post = $this->input->post('DarAlta');
		$postN = $this->input->post('DarAltaN');
        if($post)
        {
            $post['altaNegocioFechaCreacion'] = time();

            //PARTE DE CREACION DEL NEGOCIO EN TABLA USUARIOS
            $activacion = generate_code('null@null', $post['altaNegocioNombre']);
			$pass = encrypt_password('null',
                                    $this->config->item('encryption_key'));
            $datos = array(
                    'nombre'=>$post['altaNegocioNombre'],
                    'email'=>'null@null',
                    'password'=>$pass,
                    'sexo'=>'2',
                    'creacion'=>date('Y-m-d H:i:s'),
                    'codigoActivacion'=>$activacion,
                    'codigoRecuperacion'=>'',
                    'statusRecuperacion'=>'1',
                    'statusEU'=>'2'
                );
            $idU = $this->Usuario->save_company_sponsor($datos);
			
		
	    	$idImagen = $this->Usuario->get_data($idU);
            //PARTE DE CREACION DEL NEGOCIO EN TABLA NEGOCIOS
            $datosNegocio = array(
                    'negocioUsuarioId'=>$idU,
                    'negocioNombre'=>$post['altaNegocioNombre'],
                    'negocioGiro'=>$post['altaNegocioGiro'],
                    'negocioSubgiro'=>$post['altaNegocioSubgiro'],
                    'negocioDireccion'=>$post['altaNegocioDireccion'],
                    'negocioDescripcion'=>'',
                    'negocioEmail'=>'null@null',
                    'negocioTelefono'=>$postN['negocioTelefono'],
                    'negocioSitioWeb'=>'',
                    'negocioHorario'=>'',
                    'negocioPais'=>$post['altaNegocioPais'],
                    'negocioCiudad'=>$post['altaNegocioCiudad'],
                    'negocioLatitud'=>$postN['negocioLatitud'],
                    'negocioLongitud'=>$postN['negocioLongitud'],
                    'negocioFechaCreacion'=>time(),
                    'negocioFechaModificacion'=>time(),
                    'negocioEsSucursal'=>0
                );
            $idNN = $this->Usuario->save_companys($datosNegocio);
			$this->Usuario->get_default_albumN($idU);
		    $postI = $this->input->post('Imagenes');
			$idImagen = $this->Usuario->get_data($idU);
			
			/********************************************************************************************************************/
		if($postI)
        {
            //cargar la libreria de la manipulacion de imagenes
            $this->load->library('image_lib');

            $file_path = './statics/img_negocios/'.$idImagen->negocioId.'/'.$idNN.'/';
            //create directory
            @mkdir($file_path, 0777, true);

            //crear directorio para el thumbnail negocios
            $file_thumb = './statics/img_negocios/'.$idImagen->negocioId.'/thumb/';
            //create directory
            @mkdir($file_thumb, 0777, true);

            //prepare file upload
            $upload_settings = array(
                'upload_path'=>$file_path,
                'allowed_types'=>'gif|jpg|jpeg|png',
                'max_size'=>'10000',
                'max_width'=>'3000',
                'max_height'=>'3000',
                'remove_spaces'=>true,
                'encrypt_name'=>true,
            );

            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('imagen'))
            {
                //sacar información sobre el archivo
                $file_info = $this->upload->data();
            

                // preparar la información antes de guardar
                $postI['imagenFechaCreacion'] = time();
                $postI['imagenFechaModificacion'] = time();
                $postI['imagenNegocioAlbumId'] = $idU;
                $postI['imagenNegocioRuta'] = 'statics/img_negocios/'.$idImagen->negocioId.'/'.$idNN.'/'.$file_info['file_name'];
				$postI['imagenNegocioAvatar']=1;
                $insert_id = $this->Usuario->saveI($postI);
            
                $nombres_negocios = cut_name_user($idImagen->negocioNombre);
                $config['image_library'] = 'gd2';
                $config['source_image'] = $postI['imagenNegocioRuta'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 45;
                $config['height'] = 55;
                $config['new_image'] = './statics/img_negocios/'.$idImagen->negocioId.'/thumb/'.$idNN.'.jpg';
                $this->image_lib->initialize($config);

                $this->image_lib->resize();

                if($file_info['image_width'] < $file_info['image_height'])
                { //if checar si el ancho es menor **inicio**
                    if($file_info['image_width'] == 800 || $file_info['image_height'] == 800)
                    {
                        unset($config);
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 480;
                        $config['height'] = 640;
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $corte = explode(".", $file_info['file_name']);
                    $name_short1 = $this->session->userdata('idN');
        	        //PARTE PARA QUITAR CARACTERES RAROS
        	        $name_short1 = str_replace("ú", "u", $name_short1);
				    $name_short1 = str_replace("ó", "o", $name_short1);
    				$name_short1 = str_replace("í", "i", $name_short1);
				    $name_short1 = str_replace("é", "e", $name_short1);
				    $name_short1 = str_replace("á", "a", $name_short1);
				    $name_short1 = str_replace("Á", "A", $name_short1);
				    $name_short1 = str_replace("É", "E", $name_short1);
				    $name_short1 = str_replace("Í", "I", $name_short1);
				    $name_short1 = str_replace("Ó", "O", $name_short1);
				    $name_short1 = str_replace("Ú", "U", $name_short1);
				    $name_short1 = str_replace("Ñ", "N", $name_short1);
				    $name_short1 = str_replace("ñ", "n", $name_short1);
				    $name_short1 = str_replace("ä", "a", $name_short1);
				    $name_short1 = str_replace("ë", "e", $name_short1);
				    $name_short1 = str_replace("ï", "i", $name_short1);
				    $name_short1 = str_replace("ö", "o", $name_short1);
				    $name_short1 = str_replace("ü", "u", $name_short1);
				    $name_short1 = str_replace("Ä", "A", $name_short1);
				    $name_short1 = str_replace("Ë", "E", $name_short1);
				    $name_short1 = str_replace("Ï", "I", $name_short1);
				    $name_short1 = str_replace("Ö", "O", $name_short1);
				    $name_short1 = str_replace("Ü", "U", $name_short1);
                 
                        unset($config);
                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $postI['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->Usuario->count_data_thumbnail($idNN);
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$idNN
                                                );
                            var_dump($datos_thumb);
                            $this->Usuario->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->Usuario->update_thumb($ruta_imagen, $idNN);
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->Usuario->update_img_geotag($idNN, $ruta_img);
                    
                } //if checar si el ancho es menor **fin**
                elseif($file_info['image_height'] < $file_info['image_width'])
                {//else checar si es menor la altura **inicio**
                    if($file_info['image_width'] > 800)
                    {
                        unset($config);
                        $config['source_image'] = $postI['imagenNegocioRuta'];
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 800;
                        $config['height'] = 598;
                        $config['new_image'] = $postI['imagenNegocioRuta'];
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $corte = explode(".", $file_info['file_name']);
                    $name_short1 = $idNN;
                    //PARTE PARA QUITAR CARACTERES RAROS
        	        $name_short1 = str_replace("ú", "u", $name_short1);
				    $name_short1 = str_replace("ó", "o", $name_short1);
    				$name_short1 = str_replace("í", "i", $name_short1);
				    $name_short1 = str_replace("é", "e", $name_short1);
				    $name_short1 = str_replace("á", "a", $name_short1);
				    $name_short1 = str_replace("Á", "A", $name_short1);
				    $name_short1 = str_replace("É", "E", $name_short1);
				    $name_short1 = str_replace("Í", "I", $name_short1);
				    $name_short1 = str_replace("Ó", "O", $name_short1);
				    $name_short1 = str_replace("Ú", "U", $name_short1);
				    $name_short1 = str_replace("Ñ", "N", $name_short1);
				    $name_short1 = str_replace("ñ", "n", $name_short1);
				    $name_short1 = str_replace("ä", "a", $name_short1);
				    $name_short1 = str_replace("ë", "e", $name_short1);
				    $name_short1 = str_replace("ï", "i", $name_short1);
				    $name_short1 = str_replace("ö", "o", $name_short1);
				    $name_short1 = str_replace("ü", "u", $name_short1);
				    $name_short1 = str_replace("Ä", "A", $name_short1);
				    $name_short1 = str_replace("Ë", "E", $name_short1);
				    $name_short1 = str_replace("Ï", "I", $name_short1);
				    $name_short1 = str_replace("Ö", "O", $name_short1);
                    $name_short1 = str_replace("Ü", "U", $name_short1);
                  
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $postI['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->Usuario->count_data_thumbnail($idNN);
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$idNN
                                                );
                            var_dump($datos_thumb);
                            $this->Usuario->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->Usuario->update_thumb($ruta_imagen, $idNN);
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$idNN.'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->Usuario->update_img_geotag($idNN, $ruta_img);
                    
                }
            }
        }
			/********************************************************************************************************************/

            //PARTE DONDE GUARDA EL USUARIOS EL NUEVO NEGOCIO DAR ALTA
            $post['altaNegocioNegocioId'] = $idNN;
            $id_new = $this->Usuario->save_new_company($post);
            
            //PARTE DONDE GUARDA USUARIOS APADRINADORES
            $time = time();
            $this->Usuario->save_sponsor_company($id, $id_new, $time);

            redirect('altanegocios/index/'.$idNN);
        }
        else
        {
            $ciudades = $this->Usuario->all_data('ciudad');
            $paises = $this->Usuario->all_data('pais');
            $giros = $this->Usuario->all_data('giro');
            $estados = $this->Usuario->all_data('estado');
            $subgiros = $this->Usuario->all_data('subcategorias');
            $datos['ciudad'] = create_array($ciudades);
            $datos['pais'] = create_array($paises);
            $datos['giro'] = create_array($giros);
            $datos['estado'] = create_array($estados);
            $datos['subgiros'] = create_array($subgiros);

            $this->load->view('usuarios/dar_alta', $datos);
        }
    }

    /**
     * Metodo que se usa para hacer dinamica la lista desplegable
     * de las subcategorias en las cuales el usuario podra seleccionar
     * el subgiro del negocio que dara de alta, dependiendo del giro
     *
     * @return json encode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function create_subgiros()
    {
        $post = $this->input->post('subgiro');
        $valor = $this->Usuario->data_by_category($post);
        echo json_encode($valor);
    }

    /**
     * Metodo que se encarga de actualizar el avatar para que este mismo
     * pueda ser eliminado y que se coloque por default el avatar que
     * se pone en la plataforma dependiendo el sexo
     *
     * @params int id
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_avatar($id)
    {
        $this->Usuario->update_avatar_user($id);
        redirect('usuarios/perfil');
    }
	
    /**
     *
     *
     *
     * SE TIENEN QUE CHECAR ESTAS FUNCIONES
     *
     *
     *
     **/
    /* PRUEBAS DEL HELPER */
    public function invitaciones()
    {
        //agregar por medio de que quieres pasar el valor a la funcion
        $texto = $this->input->post('query_string');
//        var_dump($texto);
        $valor = invitacion($texto);
        $giro = palabras_giro($valor);  
//        print_r($giro);
        $giroNegocio = $this->Usuario->get_data_negocios($giro);
        $datos['info_negocios'] = $this->Usuario->get_all_business($giroNegocio->id);
        
        $this->load->view('negocios/propuestas', $datos);
    }

    /**
     * Me retorna el id del usuario loggeado para jquery
     *
     * @param void
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function obtener_usuario()
    {
        echo json_encode(array('id'=>$this->session->userdata('id')));
    }

    /**
     * ver invitaciones hechas por el usuario
     **/
    public function invitaciones_recibidas_pendientes($id)
    {
        $resultado = $this->Usuario->datos_invitaciones_recibidas($id);
        $var = json_encode($resultado);
        echo $var;
    }

    /**
     * ver invitaciones hechas
     **/
    public function invitaciones_hechas_pendientes($id)
    {
        $resultado = $this->Usuario->datos_invitaciones_hechas($id);
        $var = json_encode($resultado);
        var_dump($var);
    }
	/*
	*
	*/
	public function create_estados()
    {
        $post = $this->input->post('ciudad');
        $valor = $this->Usuario->estados_pais($post);
        echo json_encode($valor);
    }
}
