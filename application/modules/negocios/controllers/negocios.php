<?php
/** 
 * Negocios que quieren participar.
 *
 * Cada usuario puede registrar n cantidad de negocios/empresas a su nombre 
 * para participar en la dinámica. Tendrá una función muy similar al perfil del 
 * usuario pero con unas funciones diferentes ya que el fin de esta es más bien 
 * promocionar sus negocios.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 03 March, 2011
 * @package Negocios
 **/

class Negocios extends MX_Controller{
    /**
     * @ignore
     * Estructura sugerida DB:
     * negocioId: INT <primaryKey>
     * negocioUsuarioId: INT <id usuario dueño negocio>
	 * negocioNombre: VARCHAR 140 <nombre de la empresa>
     * negocioGiro: VARCHAR 140 <giro al cual pertenece la emprea>
     * negocioDescripcion: VARCHAR 400 <descripcion negocio>
     * negocioEmail: VARCHAR 140 <email del encargado>
     * negocioDireccion: VARCHAR 140 <direccion del negocio>
     * negocioPais: INT <FK a la tabla paises>
     * negocioCiudad: INT <FK a la tabla ciudades>
     * negocioLatitud: FLOAT (10, 6) <latitud para el gmap>
     * negocioLongitud: FLOAT(10, 6) <longitud para el gmap>
     * negocioImagenId: INT <ID de la imágen a utilizar como logotipo>
     * negocioFechaCreacion: INT <unix timestamp>
     * negocioFechaModificiacion: INT <unix timestamp>
     **/

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Negocio', '', TRUE);
        $this->load->library(array('session', 'form_validation', 'user_agent'));
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'status', 'date', 'counters', 'emails'));
    }

    /**
     * Default
     *
     * index redirige a ver. No sé porque hacer esto. Pero suena lógico no? 
     * a si, por si se llega a necesitar poner más info en el default
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index()
    {
		redirect('usuarios/');
    }

    /**
     * Ver elementos de la empresa
     *
     * Esto se refiere a ver el perfil de dicha empresa. Mostrar toda su info 
     * y verificar que de nuevo tiene que enseñar. Hay que pensar bien el 
     * layout de esto. El chiste es que si el usuario que está loggeado es el 
     * dueño de la página, le permita editar cosillas y que quede coquetona. 
     * sino lo es pues pelas y solo puedes ver la información y recomendar el 
     * lugar.
     *
     * @param integer $id opcional. Si se manda se muestra el perfil. Sino se 
     * muestra un listado de empresas.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
	 * @uathor blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id=null)
    {
		$data['datosN'] = $this->Negocio->view();
        $header = $this->load->view('usuarios/header_login', '', TRUE);
		$content = $this->load->view('negocios/ver', $data, TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
    }

    /**
     * crear una nueva empresa
     * 
     * La dinámica detrás de esto es que un usuario puede tener n cantidad de 
     * negocios registrados. Por lo tanto es más bien como una extensión del 
     * perfil. Tiene ciertas cosas en común aunque la personalización no es tan 
     * grande. También tiene apps diseñadas especificamente para cargarlas en 
     * el perfil de empresa y aumente su capacidad de difusión. el dato de 
     * quien crea la empresa se sacará de session
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
	 * @creator blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function crear()
    {
		$this->form_validation->set_rules('Negocio[negocioNombre]',
										  'Nombre',
										  'trim|required|max_length[140]');
		$this->form_validation->set_rules('Negocio[password]',
										  'Contrase&ntilde;a',
										  'trim|required');
		$this->form_validation->set_rules('Negocio[emailConfirm]',
										  'Confirmacion de Email',
										  'trim|required');
		$this->form_validation->set_rules('Negocio[negocioEmail]', 
										  'Correo Electronico',
										  'callback_check_email|trim|valid_email|required');
		$this->form_validation->set_rules('Negocio[negocioDireccion]',
										  'Direccion',
                                          'trim|required');
		/*$this->form_validation->set_rules('Negocio[negocioGiro]',
										  'Giro',
                                          'trim|required');*/
										  
		$this->form_validation->set_message('trim',
											'EL %s esta vacio.');
		$this->form_validation->set_message('required',
											'Ingrese el %s.');
		$this->form_validation->set_message('email_valid',
											'%s es incorrecto.');
		$this->form_validation->set_message('numeric',
											'%s contiene letras');
		$this->form_validation->set_message('max_length[140]',
											'%s tiene mas de 140 caracteres.');
											
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
		
		if($this->form_validation->run($this))
		{
            $post = $this->input->post('Negocio');
			$activacion = '0';
			$post['password'] = encrypt_password($post['password'],
												 $this->config->item('encryption_key'));
			$post['negocioFechaCreacion'] = time();
            $post['negocioFechaModificacion'] = time();
			$creacion = date('Y-m-d H:i:s');
			$uid = $this->Negocio->save_user($activacion, 
											 $post['negocioEmail'],
											 $post['password'], 
											 $creacion,
											 $post['negocioNombre']);
            $post['negocioUsuarioId'] = $uid;
            //$post['negocioPais'] = 0;
            //when create the company init in 0 because is the matriz
            $post['negocioEsSucursal'] = 0;
            //$post['negocioCiudad'] = 0;
			unset($creacion);
			unset($post['emailConfirm']);
            unset($post['password']);
            unset($post['confirmPassword']);
            $post['negocioGiro'] = 28;
            $post['negocioSubgiro'] = 148;
            $post['negocioCiudad'] = 0;
            $idNegocio = $this->Negocio->save($post);
            $this->exito($uid, $idNegocio);
		}
		else
		{
			$datosC = $this->Negocio->data_register('estado');
			$data['ciudad'] = create_array($datosC);
			$datosP = $this->Negocio->data_register('pais');
			$data['pais'] = create_array($datosP);
            $datosG = $this->Negocio->data_register('giro');
			$data['giro'] = create_array($datosG);
			$datosS = $this->Negocio->data_register('subcategorias');
			$data['subgiros'] = create_array($datosS);
			$header = $this->load->view('negocios/header_main', '', TRUE);
			$content = $this->load->view('negocios/crear', $data, TRUE);
			$this->load->view('main/main_template', array('header'=>$header,
                                                          'content'=>$content));
//                                                     'included_file'=>array('statics/js/usuarios/negocios.js')));
		}
			
    }

    /**
     * Method for create new companies in the part of the
     * interlingua, all this for know where is the location
     * of the company, and appear in the part of the calendar
     * or like company in inteliguia, with his data correctly
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function crear_inteliguia()
    {
		$this->form_validation->set_rules('Negocio[negocioNombre]',
										  'Nombre',
										  'trim|required|max_length[140]');
		$this->form_validation->set_rules('Negocio[password]',
										  'Contrase&ntilde;a',
										  'trim|required');
		$this->form_validation->set_rules('Negocio[emailConfirm]',
										  'Confirmacion de Email',
										  'trim|required');
		$this->form_validation->set_rules('Negocio[negocioEmail]', 
										  'Correo Electronico',
										  'callback_check_email|trim|valid_email|required');
		$this->form_validation->set_rules('Negocio[negocioDireccion]',
										  'Direccion',
                                          'trim|required');
		$this->form_validation->set_rules('Negocio[negocioGiro]',
										  'Giro',
										  'trim|required');
										  
		$this->form_validation->set_message('trim',
											'EL %s esta vacio.');
		$this->form_validation->set_message('required',
											'Ingrese el %s.');
		$this->form_validation->set_message('email_valid',
											'%s es incorrecto.');
		$this->form_validation->set_message('numeric',
											'%s contiene letras');
		$this->form_validation->set_message('max_length[140]',
											'%s tiene mas de 140 caracteres.');
											
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
		
		if($this->form_validation->run($this))
		{
            $post = $this->input->post('Negocio');
			$activacion = '0';
			$post['password'] = encrypt_password($post['password'],
												 $this->config->item('encryption_key'));
			$post['negocioFechaCreacion'] = time();
            $post['negocioFechaModificacion'] = time();
			$creacion = date('Y-m-d H:i:s');
			$uid = $this->Negocio->save_user($activacion, 
											 $post['negocioEmail'],
											 $post['password'], 
											 $creacion,
											 $post['negocioNombre']);
            $post['negocioUsuarioId'] = $uid;
            $post['negocioPais'] = 0;
            //when create the company init in 0 because is the matriz
            $post['negocioEsSucursal'] = 0;
            //$post['negocioCiudad'] = 0;
			unset($creacion);
			unset($post['emailConfirm']);
			unset($post['password']);
            $idNegocio = $this->Negocio->save($post);
            $this->exito($uid, $idNegocio);
		}
		else
		{
			$datosC = $this->Negocio->data_register('estado');
			$data['ciudad'] = create_array($datosC);
			$datosP = $this->Negocio->data_register('pais');
			$data['pais'] = create_array($datosP);
            $datosG = $this->Negocio->data_register('giro');
			$data['giro'] = create_array($datosG);
			$datosS = $this->Negocio->data_register('subcategorias');
			$data['subgiros'] = create_array($datosS);
			$header = $this->load->view('negocios/header_main', '', TRUE);
			$content = $this->load->view('negocios/create_inteliguia', $data, TRUE);
			$this->load->view('main/main_template', array('header'=>$header,
                                                          'content'=>$content));
//                                                        'included_file'=>array('statics/js/usuarios/negocios.js')));
		}
			
    }

    /**
     * Metodo que se usa para revisar que el email
     * no sea igual, en caso de que sea igual se 
     * tiene que mostrar un mensaje de error del
     * mismo para que el usuario conosca cual fue el 
     * problema por el cual no se pudo realizar su
     * registro correctamente
     *
     * @params string str valor a checar
     * @return flag --true or false--
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    function check_email($str)
    {
        if($this->Negocio->check_email($str) === TRUE)
        {
            $this->form_validation->set_message('email_check','El %s ya esta registrado, cambialo por favor.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Metodo para el cambio del banner principal
     * del negocio, con ciertas restricciones como
     * las medidas del mismo
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function banner_negocio($id)
    {
        $post = $this->input->post('Banner');
        if($post)
        {
            //se revisa si hay algun registro en la base de datos
            $total = $this->Negocio->total_registro($id);
            
            //ruta donde se guardaran los banners de las empresas
            $file_path = './statics/img_banner_negocios/'.$id.'/';
            //crear directorio
            @mkdir($file_path, 0777, true);

            //preparar el archivo a cargar
            $upload_settings = array(
                    'upload_path'=>$file_path,
                    'allowed_types'=>'gif|jpg|jpeg|png',
                    'max_size'=>'10000',
                    'max_width'=>'520',
                    'max_height'=>'240',
                    'remove_spaces'=>true,
                    'encrypt_name'=>true
                );

            $this->load->library('upload',$upload_settings);
            if($this->upload->do_upload('imagen'))
            {
                //recuperar la informacion sobre el archivo
                $file_info = $this->upload->data();

              //preparar la informacion antes de guardar
                $post['extraNegocioId'] = $id;
                $post['extraRutaImagen'] = 'statics/img_banner_negocios/'.$id.'/'.$file_info['file_name'];
                var_dump($post);
                //se guarda la informacion en la base de datos
                if($total == 0)
                {
                    $val = $this->Negocio->save_banner($post);
                }
                else
                {
                    $val = $this->Negocio->save_banner($post, $id);
                }
            }
        }
        $this->load->view('negocios/banner');
    }

    /**
     * Metodo para redireccionar a la
     * parte de eleccion de ir al 
     * perfil o de regresar al inicio
     * de logueo
     *
     * @return void
     * @author blackofoxgdl <ruben.alonso21@gmail.com>
     **/
    public function exito($uid, $idNegocio)
    {
        $session = array('id'=>$uid,
                         'idN'=>$idNegocio);
        $this->session->set_userdata($session);
        $negociosN = $this->Negocio->data_negocio($idNegocio);
        $data['negociosN'] = $negociosN;

        //crear directorio para el thumbnail negocios
        $file_thumb = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/';
        //create directory
        @mkdir($file_thumb, 0777, true);


        //creacion de la imagen
        $this->load->library('image_lib');

        $datosNegocio = get_user_name($this->session->userdata('id')); 
        $nombres_negocios = $this->session->userdata('idN');

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'statics/img/default/avatarempresas.jpg';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 45;
        $config['height'] = 55;
        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.strtolower($nombres_negocios).'.jpg';

        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //guardar los datos en la base de datos
        $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.strtolower($nombres_negocios).'_thumb.jpg';
        $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                             'thumbUsuarioId'=>$this->session->userdata('id')
                            );
    
        $this->Negocio->save_thumb($datos_thumb);

        //PART WHERE THE COMPANY RECEIVE AN EMAIL FROM PULZOS
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->load->library('email');
        $this->email->initialize($config);

        //PART WHERE CALL THE TEMPLATE FUNCION FOR THEN SEND TO COMPANY
        $datos_company_email = get_name_company($this->session->userdata('idN')); 
        $template_company = email_welcome_company($datos_company_email->negocioNombre); 
        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to($datos_company_email->negocioEmail, $datos_company_email->negocioNombre);
        $this->email->subject('Bienvenido a Pulzos');
        $this->email->message($template_company);
        $this->email->send();

        //SEND MESSAGE TO COMPANY FOR THE WILL SEND THE CONTRACT
        $template_company_pulzos = email_company_pulzos($datos_company_email->negocioNombre,
                                                        $datos_company_email->negocioEmail,
                                                        $datos_company_email->negocioDireccion,
                                                        $datos_company_email->negocioDescripcion);
        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to('mauricio@zavordigital.com','Mauricio Uro');
        $this->email->subject('Nuevo empresa registrada');
        $this->email->message($template_company_pulzos);
        $this->email->send();

        $header = $this->load->view('negocios/header_exito', $data, TRUE);
        $content = $this->load->view('negocios/exito', '', TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Editar empresa
     *
     * La Idea detrás de este método es la capacidad de editar los datos de una 
     * empresa ya existente. El chiste es, como en todos los demás contextos,
     * atomizar las vistas y mantener los elementos reutilizables. Todos los 
     * datos pueden ser cambiados. Los datos mandarlos por POST
     *
     * @param integer $id ID de la empresa a modificar.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function editar($id)
    {
     	$this->negocios = $this->Negocio->data_negocio($this->session->userdata('idN'));
		$datos['negocios'] = $this->negocios;
		$giro = $this->Negocio->data_register('giro');
        $datos['giros'] = create_array($giro);
		$pais = $this->Negocio->data_register('pais');
		$datos['paises'] = create_array($pais);
		$ciudad = $this->Negocio->data_register('ciudad');
        $datos['ciudades'] = create_array($ciudad);
                        
        $this->load->view('negocios/editar_datos', $datos);
    }

    /**
     * Metodo que se usa para poder mostrar la vista de la
     * edicion de la cuenta pero de los datos personales del
     * negocio, esto para que el usuario pueda obtener todos los
     * datos y pueda cambiarlos en caso de ser necesario
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function personal_negocios($id)
    {
        $post = $this->input->post('NegociosE');
        if($post)
        {
            $val = $this->Negocio->update_data($post, $this->session->userdata('id'), $this->session->userdata('idN'));
            $this->Negocio->update_user_data($post['negocioNombre'], $post['negocioEmail'], $this->session->userdata('id'));
        }
        $negocios = $this->Negocio->data_negocio($id);
        $datos['negocios'] = $negocios;
        $giro = $this->Negocio->data_register('giro');
        $datos['giros'] = create_array($giro);
		$sub=get_subcategories($negocios->negocioGiro);
		foreach($sub as $key)
		{
		$subgironegocio[$key->id] = $key->nombre;
		}
		$datos['subgiros'] = $subgironegocio;
        $this->load->view('negocios/edit_negocios', $datos);
    }

    /**
     * Metodo que muestra el formulario de la edicion
     * de los datos generales del negocio, asi poder
     * manipular todos los datos del negocio en el
     * apartado general
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function datos_servicios($id)
    {
        $post = $this->input->post('Servicios');
        if($post)
        {
            $servicios_total = $this->Negocio->count_register_service($id);
            if($servicios_total > 0)
            {
                $hora = $post['serviciosHorario'];
                $this->Negocio->update_hour($hora, $this->session->userdata('idN'));
                unset($post['serviciosHorario']);
                $this->Negocio->update_services($post, $this->session->userdata('idN'));
            }
            else
            {
                $hora = $post['serviciosHorario'];
                $this->Negocio->update_hour($hora, $this->session->userdata('idN'));
                unset($post['serviciosHorario']);
                $post['serviciosNegocioId'] = $this->session->userdata('idN');
                $this->Negocio->save_services($post);
            }
        }
        $negocio = $this->Negocio->data_negocio($id);
        $datos['negocios'] = $negocio;
        $servicios = $this->Negocio->count_register_service($id);
        if($servicios == 0)
        {
            $datos['status_servicios'] = '0';
        }
        else
        {
            $datos['status_servicios'] = '1';
            $datos['servicios'] = $this->Negocio->get_service($id);
        }
        $this->load->view('negocios/datosnegocio', $datos);
    }

    /**
     * Metodo para mostrar los datos de la ubicacion donde
     * se tiene el negocio, para mostrar a los usuarios
     * y que estos puedan acudir
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ubicacionNegocio($id)
    {
        $post = $this->input->post("Ubicacion");
        if($post)
        {
            $this->Negocio->save_ubication($post, $this->session->userdata('idN'));
        }
        $negocio = $this->Negocio->data_negocio($id);
        $pais = $this->Negocio->data_register('pais');
		$datos['paises'] = create_array($pais);
		$ciudad = $this->Negocio->data_register('ciudad');
        $datos['ciudades'] = create_array($ciudad);
        $datos['negocios'] = $negocio;
        $this->load->view('negocios/ubicacion-e', $datos);
    }

    /**
     * Metodo que se encarga de cargar la vista de la
     * edicion de los datos de seguridad como lo
     * es el password y la confirmacion del mismo
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function seguridadNegocio($id)
    {
        $post = $this->input->post('Seguridad');
        if($post)
        {
            $post['password'] = encrypt_password($post['password'],
                                                 $this->config->item('encryption_key'));
            $this->Negocio->update_new_password($post['password'], $this->session->userdata('id'));
        }
        $negocio = $this->Negocio->data_negocio($id);
        $datos['negocios'] = $negocio;
        $this->load->view('negocios/seguridad-e', $datos);
    }

    /**
     * Metodo que se encarga de guardar los datos de edicion
     * en la base de datos y asi poder actualizarlos correctamente
     * y mostrarlos en el perfil
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_edicion($id)
    {
        $post = $this->input->post('NegocioE');
        $post['negocioFechaModificacion'] = time();
        if($post['password'] != "" && $post['confirmPass'] != "")
        {
            $post['password'] = encrypt_password($post['password'],
                                                 $this->config->item('encryption_key'));
            if($post['negocioNombre'] != "" && $post['negocioEmail'] != "")
            {
                $this->Negocio->update_password($post['password'], $this->session->userdata('id'));
            }
            unset($post['password']);
            unset($post['confirmPass']);
            $this->Negocio->update_data($post, $this->session->userdata('id'), $id);
        }
        else
        {
            if($post['negocioNombre'] != "" && $post['negocioEmail'] != "")
            {
                $this->Negocio->update_user_data($post['negocioNombre'],$post['negocioEmail'],'', $this->session->userdata('id'));
            }
            unset($post['password']);
            unset($post['confirmPass']);
            $this->Negocio->update_data($post, $this->session->userdata('id'), $id);
        }
        return;
    }

    /**
     * Borrar una empresa
     *
     * Tengo que explicar más?
     * 
     * @param integer $id ID de la empresa a borrar
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id=null)
    {
        $this->load->view('informacion/api');
    }

    /**
     * Metodo que redirecciona al perfil de
     * de negocio para poder configurar
     * o crear su perfil y
     * acomodarlo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function perfil($id_negocio = NULL)
    {	if($this->session->userdata('id')==FALSE ){$this->index();}else{
		if($id_negocio)
		{
            $this->negocio = $this->Negocio->data_negocio($id_negocio);    
        }
		else
        {
        	$this->negocio = $this->Negocio->data_negocio($this->session->userdata('idN'));
        }
        $data['negocios'] = $this->negocio;
        $data['numeroSeguidor'] = $this->Negocio->get_count_follower($this->negocio->negocioId, $this->session->userdata('id'));
        $numeroPulzos = $this->Negocio->get_count_pulzos_general();
        if($numeroPulzos == 0)
        {
            $data['numeroPulzos'] = $numeroPulzos;
            $data['mensajePulzos'] = "No hay pulzos de usuarios actualmente'";
        }
        else
        {
            $data['numeroPulzos'] = $numeroPulzos;
            $data['pulzosUsuarios'] = $this->Negocio->get_data_pulzos();
        }
        $albums = $this->Negocio->get_total_albums($this->negocio->negocioUsuarioId);
        if($albums == 0)
        {
            $data['albums'] = $albums;
        }
        else
        {
            $data['albums'] = $albums;
            $albumsN = $this->Negocio->get_data_albums($this->negocio->negocioUsuarioId);
            $data['total_albums'] = $this->Negocio->count_albums($albumsN->albumId);
        }
        $negociosN = $this->Negocio->get_data_user($this->session->userdata('id'));
        $data['negociosN'] = $negociosN;
		$data['giros'] = $this->Negocio->get_location($this->negocio->negocioGiro, 'giro');
        $data['paises'] = $this->Negocio->get_location($this->negocio->negocioPais, 'pais');
        $data['ciudades'] = $this->Negocio->get_location($this->negocio->negocioCiudad, 'estado');
        $data['dias'] = days();
        $data['meses'] = month();
        $data['inboxTN'] = $this->Negocio->inbox_company_total($this->negocio->negocioUsuarioId, '1');
		$data['inboxT'] = $this->Negocio->inbox_total($this->session->userdata('id'), '1');
        //METODO QUE SE ENCARGA DE CHECAR SI ES EL HEADER DE LA EMPRESA O DEL 
        //USUARIO PARA SABER SI LOS ENLACES SE REDIRECCIONA
        if($negociosN->statusEU == 1)
        {
            $header = $this->load->view('negocios/header_login', $data, TRUE);
        }
        else
        {
            $data['usuarios2'] = $negociosN;
            $data['localidades2'] = $this->Negocio->get_location($negociosN->ciudad, 'estado');
            $data['inboxT'] = $this->Negocio->inbox_total($this->session->userdata('id'), '1');
            $data['notificaciones'] = $this->Negocio->get_all_notifications($this->session->userdata('id'));
            // SE COMENTA ESTA LINEA HASTA NUEVO AVISO
            $header = $this->load->view('usuarios/header_login3', $data, TRUE);
        }
        $content = $this->load->view('negocios/perfil', $data, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content,
                                                 'included_file'=>array('statics/js/negocios/perfil.js'),
                                             ));
		}									 
    }

    /**
     * Metodo que se usa para poder cargar el centro
     * dinamico del perfil de las empresas o negocios, 
     * en el cual se cargaran los datos del usuario de
     * manera que podra ver su vista al momento de entrar
     *
     * @params int id del usuario
     * @params int id del usuario negocio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function principal($id, $idN)
    {
        $datos['pulzo_perfil'] = $this->Negocio->get_pulzos_negocios($idN);
        $datos['negocios'] = $this->Negocio->data_negocio($idN);
        $datos['negocio_usuario'] = $this->Negocio->data_usuario_negocio($id);
        $this->load->view('negocios/inicio', $datos);
    }

    /**
     * Metodo que se usa para poder obtener los siguientes 10 pulzos
     * que le sigan despues de presionar el link de ver mas, esto para que
     * se carguen los siguientes 10 y asi sucesivamente
     *
     * @params int id del negocio
     * @params int numero del pulzo a seguir
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function siguientes_pulzos($id, $num)
    {
        $datos['pulzo_perfil'] = $this->Negocio->get_next_ten_pulzos($id, $num);
        $this->load->view('negocios/siguientes_diez_pulzos', $datos);
    }

    /**
     * Metodo que se usa para poder hacer que solo se actualice lo que se
     * refiere al numero de pulzo que se esta obteniendo hasta la parte
     * de los siguientes 10 para poder actualizar los registro
     * y que se puedan seguir mostrando los siguientes 10 hasta que sean 0
     *
     * @params int id del pulzo
     * @params int numero del pulzo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzos_next_ten($id, $num)
    {
        $datos_ultimos = $this->Negocio->get_next_ten_pulzos($id, $num);
        $valor = obtain_array_company($datos_ultimos);
        echo json_encode($valor);
    }

    /**
     * Metodo que se usa para poder obtener todos los datos del
     * negocio para que estos puedan ser vistos por los usuarios
     * que visitan el perfil del mismo
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function informacion_personal($id)
    {
        $personales = $this->Negocio->data_negocio($id);
        $data['personales'] = $personales;
        //VALIDACIONES PARA EVITAR WARNING EN CIUDAD Y PAIS SEAN '0'
        if($personales->negocioPais != '0' || $personales->negocioCiudad != '0')
        {
            $data['paises'] = $this->Negocio->get_location($personales->negocioPais, 'pais');
            $data['ciudades'] = $this->Negocio->get_location($personales->negocioCiudad, 'estado');
        }
        $data['servicios'] = $this->Negocio->get_services($id);
        $this->load->view('negocios/personales', $data);
    }

    /**
     * Metodo que se usa para recargar los seguidores de los negocios,
     * en la cual el negocio podra ver todos los seguidores que tiene
     * hasta el momento
     *
     * @params int id negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_follows($id)
    {
        $datos['negocios'] = $this->Negocio->data_negocio($id);
        $this->load->view('negocios/reload_followers', $datos);
    }

    /**
     * Se usa este metodo para cargar la vista externa
     * de la derecha y mostrar los pulzos que hay por el momento
     * o los que se han escrito, en caso de que no haya pulzos,
     * no se mostrara nada en esa columna
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzos_nuevos($id)
    {
        $datos['id'] = $id;
        $datos['pulzos'] = $this->Negocio->get_pulzos($id, '0');
        $datos['retos'] = $this->Negocio->get_pulzos($id, '1');
        $datos['experiencias'] = $this->Negocio->get_pulzos($id, '2');
        $this->load->view('negocios/pulzos', $datos);
    }

    /**
     * Metodo que se usa para guardar los comentarios
     * que la empresa haga en su perfil, esto para que se
     * vaya guardando en el perfil donde las empresas haran
     * sus comentarios y volcado
     *
     * @params int id del negocio - negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_comentario($id)
    {
        $post = $this->input->post('Pulzos');
        $enviarDatos = array('pulzoUsuarioId'=>$id,
                             'pulzoTitulo'=>$post['pulzoTitulo'],
                             'pulzoAccion'=>'0',
                             'pulzoTipoComunicacion'=>'4',
                             'pulzoTipo'=>'3',
                             'pulzoFechaCreacion'=>time());
        $idP = $this->Negocio->save_comments($enviarDatos, 'pulzos');

        //PARTE DONDE SE MANDA A GUARDAR EN EL SCRIBBLE QUE SE PUBLICARA A LA 
        //VISTA DE TODAS LAS PERSONAS
        $datos_recuperar = $this->input->post('Scribble');
        
        $datos_negocios = get_data_company($this->session->userdata('id'));
        $imagen_negocios_thumb = get_thumb_avatar($this->session->userdata('id'));
        $imagen_negocios = substr($imagen_negocios_thumb, 2);
        $imagen_replace = str_replace('/', '-', $imagen_negocios);
        $imagen_complete = 'http:--www.pulzos.com-'.$imagen_replace;
        
        if(empty($datos_recuperar['scribbleAnexos']))
        {
            $datos_recuperar['scribbleAnexos'] = '0';
        }

        $scribble_publico = array('scribbleUsuarioId'=>$this->session->userdata('id'),
                                  'scribbleTexto'=>$post['pulzoTitulo'],
                                  'scribbleLat'=>$datos_recuperar['scribbleLat'],
                                  'scribbleLng'=>$datos_recuperar['scribbleLng'],
                                  'scribbleNombreUsuario'=>$datos_negocios->negocioNombre,
                                  'scribbleImagenUsuario'=>$imagen_complete,
                                  'scribbleFatherId'=>'0',
                                  'totalComentarios'=>'0',
                                  'heading'=>'370',
                                  'altura'=>'0',
                                  'atributo'=>-200,
                                  'scribbleAnexos'=>$datos_recuperar['scribbleAnexos']);
        
        $plan_insert_scribble = $this->Negocio->save_scribble_advertising($scribble_publico);
        $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                     'planDescripcion'=>$post['pulzoTitulo'],
                                     'planFechaCreacion'=>time(),
                                     'planEmpresaPosteo'=>$id,
                                     'planEmpresaPulzoId'=>$idP,
                                     'planScribbleId'=>$plan_insert_scribble);
        $val2 = $this->Negocio->save_comments($datosMostrarUsuario, 'planesusuarios');
        
        $valores_tagging = array('taggingPromotionId'=>$plan_insert_scribble,
                                 'taggingFinishPromotion'=>'0');

        $valor_promotion = $this->Negocio->insert_promotion($valores_tagging);
        
        $postR = $this->input->post('Redes');
        $postO = $this->input->post('Oferta');
        $post2 = $this->input->post('tipo_oferta');
        if($postO['statusTipoBonificacion'] != 5)
        {
            $postO['statusIva'] = $post2;
        }
        else
        {
            $postO['statusIva'] = 3;
        }
        if(empty($postO['bonificaPorcentaje']))
        {
            $postDos = $this->input->post('Ofertas');
            $postO['bonificaPorcentaje'] = $postDos['bonificaPorcentaje'];
        }

        //SAVE THE REDES DATA IN THE DATABASE
        $postR['socialEmpresaUsuarioId'] = $id;
        $val = $this->Negocio->save_tokens_company($postR);

        //SAVE THE OFERTA DATA IN THE DATABASE
        $postO['idNegocioOferta'] = $id;
        $postO['idMensajeOferta'] = $val;
        $postO['tipoDescuento'] = '1';
        $postO['ofertaActivacion'] = '1';
        $postO['idPlanUsuarioOfertaNegocio'] = $val2;
        $return = $this->Negocio->save_ofert($postO);

        //SAVE DATA OF TABLE IN THE MIDDLE OF GEOTAGGING AND OFFERTS
        $geotag_oferta = array('geotagGId'=>$plan_insert_scribble,
                               'ofertaOId'=>$return);
        $this->Negocio->save_tag_ofert($geotag_oferta);
    }

    /**
     * Metodo que se usa para poder obtener los comentarios de los usuario
     * que estos hagan desde el perfil del negocio, esto para que se pueda
     * postear en el perfil del negocio y aparesca en el perfil del usuario
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_comentario_perfil($id, $idN)
    {
        if($this->session->userdata('id') == $id)
        {
            $post = $this->input->post('Perfil');
            $enviarData = array('pulzoUsuarioId'=>$idN,
                                'pulzoTitulo'=>$post['pulzoTitulo'],
                                'pulzoAccion'=>'0',
                                'pulzoTipoComunicacion'=>'5',//SI POSTEA EL NEGOCIO EN LA SECCION MI PERFIL
                                'pulzoTipo'=>'3',
                                'pulzoFechaCreacion'=>time());
            $idPost = $this->Negocio->save_comments($enviarData, 'pulzos');

            $datosMostrarUsuarios = array('planUsuarioId'=>$id,
                                          'planDescripcion'=>$post['pulzoTitulo'],
                                          'planFechaCreacion'=>time(),
                                          'planEmpresaPosteo'=>$idN,
                                          'planEmpresaPulzoId'=>$idPost);
            $valor = $this->Negocio->save_comments($datosMostrarUsuarios, 'planesusuarios');
        }
        else
        {
            $post = $this->input->post('Perfil');
            $enviarData1 = array('pulzoUsuarioId'=>$idN,
                                 'pulzoTitulo'=>$post['pulzoTitulo'],
                                 'pulzoAccion'=>'0',
                                 'pulzoTipoComunicacion'=>'6',//SI POSTEA UN USUARIO EN LA SECCION DEL PERFIL
                                 'pulzoTipo'=>'3',
                                 'pulzoFechaCreacion'=>time());
            $idPost = $this->Negocio->save_comments($enviarData1, 'pulzos');

            $datosMostrarUsuarios1 = array('planUsuarioId'=>$id,
                                           'planAmigoUsuarioId'=>$this->session->userdata('id'),
                                           'planDescripcion'=>$post['pulzoTitulo'],
                                           'planFechaCreacion'=>time(),
                                           'planEmpresaPosteo'=>$idN,
                                           'planEmpresaPulzoId'=>$idPost);
            $valor = $this->Negocio->save_comments($datosMostrarUsuarios1, 'planesusuarios');
        }
    }

    /**
     * Metodo que elimina la
     * sesion que se crea al
     * momento de que el se
     * abre el perfil del
     * negocio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function cerrar_sesion()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('idN');
		$this->session->sess_destroy();
        redirect('usuarios');
    }
	
	/**
	 * Carga la vista de busqueda una
	 * vez que se haya presionado para
	 * el boton de busqueda o que se haya 
	 * realizado la busqueda del usuario por
	 * medio de la barra del header
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function busqueda($nombre=null)
	{
            $post = $this->input->post('buscar');
            
		if($post)
		{
			$datos['buscar'] = $this->Negocio->search($this->session->userdata('id'), $post);	
			$datos['contador'] = $this->Negocio->count_all($this->session->userdata('id'),$post);
		}elseif($nombre)
            {
                        $unir1=str_replace("_", " ",$nombre);
                        $unir=trim($unir1);
                        $datos['buscar'] = $this->Negocio->search($this->session->userdata('id'), $unir);
                        $datos['contador'] = $this->Negocio->count_all($this->session->userdata('id'), $unir);
                       
            }else{
    			$datos['perfiles'] = $this->Negocio->search($this->session->userdata('id'));
	    		$datos['contador'] = $this->Negocio->count_all($this->session->userdata('id'));
            }

        $this->load->view('negocios/busqueda',$datos);
    }

    /**
     * se crea el archivo json para que pueda
     * jalarlo con jquery
     *
     **/
    public function invitaciones_negocio($id)
    {
        $invitaciones = $this->Negocio->get_invitaciones_negocio($id);
        $var = json_encode($invitaciones);
        echo $var;
    }

    /**
     * Este metodo sera usado para ver mas informacion
     * acerca del negocio en el cual se podra mostrar toda la informacion
     * del negocio a la persona que solicite ver mas datos del negocio.
     * Se cargara un mini perfil de usuarios
     *
     **/
    public function ver_mas($id_negocio=null, $idN = null)
    {
        if($id_negocio && $idN)
		{
            $this->negocio = $this->Negocio->data_negocio($id_negocio);    
		}
		else
		{
        	$this->negocio = $this->Negocio->data_negocio($this->session->userdata('id'), $this->session->userdata('idN'));
		}
        $data['negocios'] = $this->negocio;
        $albums = $this->Negocio->get_total_albums($this->negocio->negocioUsuarioId);
        if($albums == 0)
        {
            $data['albums'] = $albums;
        }
        else
        {
            $data['albums'] = $albums;
            $albumsN = $this->Negocio->get_data_albums($this->negocio->negocioUsuarioId);
            $data['total_albums'] = $this->Negocio->count_albums($albumsN->albumId);
        }
       $this->load->view('negocios/ver_mas', $data); 
    }

    /**
     * Ver todas las empresas que sigo
     *
     * @param integer $id ID del usuario que quiero revisar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function sigo($id=null)
    {
        if (!$id) 
        {
            $id = $this->session->userdata('id');
        }
        $empresas = $this->Negocio->obtener_seguidores($id);
        $this->load->view('negocios/ver_seguidos', array('empresas'=>$empresas));
    } 

    /**
     * Metodo que se encarga de cargar los mapas para la edicion de
     * la ubicacion de la empresa, en la cual los mismos podran
     * colocarlos para poder mostrar su ubicacion en el google maps
     * que veran los usuarios
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
     public function editar_mapa($id)
     {
         $post = $this->input->post('Coordenadas');
         if($post)
         {
             $this->Negocio->save_coordenadas($id, $post);
         }
         else
         {
             $negociosN = $this->Negocio->get_data_user($this->session->userdata('id'));
             $this->negocio = $this->Negocio->data_negocio($id);   
             $datos['negocios'] = $this->negocio;
             $datos['negociosN'] = $negociosN;
             $datos['ciudades'] = $this->Negocio->get_location($this->negocio->negocioCiudad, 'ciudad');
        
             $datos['inboxTN'] = $this->Negocio->inbox_company_total($this->negocio->negocioUsuarioId, '1');
             $header = $this->load->view('negocios/header_login', $datos, 'TRUE');
             $content = $this->load->view('negocios/editar_mapa', $datos, 'TRUE');
             $this->load->view('main/template', array('header'=>$header, 'content'=>$content));
        }
     }

    /**
     * Metodo que se usa para obtener los datos de la
     * seccion de mi perfil
     **/
	public function miperfil($id_negocio = NULL)
    {
		if($id_negocio)
		{
            $this->negocio = $this->Negocio->data_negocio($id_negocio);    
        }
		else
        {
        	$this->negocio = $this->Negocio->data_negocio($this->session->userdata('idN'));
        }
        $data['negocios'] = $this->negocio;
  
        $negociosN = $this->Negocio->get_data_user($this->session->userdata('id'));
        $data['negociosN'] = $negociosN;
        $data['pulzo_perfil'] = $this->Negocio->get_pulzos_negocios($this->negocio->negocioId);
		$data['giros'] = $this->Negocio->get_location($this->negocio->negocioGiro, 'giro');
        $data['paises'] = $this->Negocio->get_location($this->negocio->negocioPais, 'pais');
        $data['ciudades'] = $this->Negocio->get_location($this->negocio->negocioCiudad, 'ciudad');
        $data['dias'] = days();
        $data['meses'] = month();
        $data['inboxTN'] = $this->Negocio->inbox_company_total($this->negocio->negocioUsuarioId, '1');
        //METODO QUE SE ENCARGA DE CHECAR SI ES EL HEADER DE LA EMPRESA O DEL 
        //USUARIO PARA SABER SI LOS ENLACES SE REDIRECCIONA
        
        $data['usuarios2'] = $negociosN;
        $data['localidades2'] = $this->Negocio->get_location($negociosN->ciudad, 'ciudad');
        $data['inboxT'] = $this->Negocio->inbox_total($this->session->userdata('id'), '1');
        $data['notificaciones'] = $this->Negocio->get_all_notifications($this->session->userdata('id'));
        
        $this->load->view('negocios/miperfil', $data);
    }	
	
    /**
     * Metodo que se usa para poder guardar los comentarios
     * que se hayan puesto pero como forma de comentarios del
     * negocio o del usuario, esto en el perfil, asi poder obtener
     * ya los datos que se necesitan para el mismo
     *
     * @params int id del usuario a comentar
     * @params int id del negocio del post
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_comentarios_pulzo($id1, $id2)
    {
        $subcomment = $this->input->post('comentar_negocios');
        $data = array('comentarioSimpleUsuarioId'=>$id1,
                      'comentarioSimplePlanId'=>$id2,
                      'comentarioSimpleSubId'=>'1',
                      'comentarioSimple'=>$subcomment,
                      'comentarioFechaCreacion'=>time());
        $this->Negocio->save_subcomments_pulzo($data);
    }

    /**
     * Metodo que se usa para poder guardar los comentarios de un pulzo, reto 
     * o de una experiencia de vida para que el usuario o la empresa puedan 
     * comenzar a debatir sobre las promociones que este mismo esta creado para 
     * que los usuarios las aprovechen
     *
     * @params int id del pulzo, reto, experiencia del negocio
     * @params int id del usuario que esta posteando
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function subcomentarios_post_pulzos($idP, $idN, $idU)
    {
        $comentario = $this->input->post('comentar_negocios');
        $post = array('comentarioTexto'=>$comentario,
                      'comentarioNegocioId'=>$idN,
                      'comentarioUsuarioId'=>$idU,
                      'comentarioPulzoId'=>$idP,
                      'comentarioFechaCreacion'=>time());
        $this->Negocio->subcomments_save_data($post);
    }

    /**
     * Metodo que se usa para poder eliminar los datos pulzos,
     * junto con todos los registros que tenga el mismo como
     * son comentarios, planes y pulzos
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_pulzos($id)
    {
        $this->Negocio->delete_tags($id);
        $this->Negocio->delete_pulzos($id);
        $this->Negocio->delete_planes($id);
        $this->Negocio->delete_comments($id);
    }

    /**
     * Metodo que se usa para borrar los comentarios de los pulzos, los
     * cuales ya no sirven una vez que se elimina el post principal y 
     * solo nos generaria basura
     *
     * @params int id del pulzo comentario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_comentarios_pulzos($id, $idPlan)
    {
        $valores = $this->Negocio->get_data_plains($idPlan);
        $this->Negocio->delete_pulzos($id);
        $this->Negocio->delete_planes($id);
        $this->Negocio->delete_subcomments($idPlan);
        if($valores->planScribbleId != 0)
        {
            $val_scribble = $this->Negocio->count_scribble_specific($valores->planScribbleId);
            if($val_scribble != 0)
            {
                $this->Negocio->delete_scribble($valores->planScribbleId);
            }
        }
    }

    /**
     * Metodo que se usa para eliminar los comentarios subsecuentes del
     * post principal, con el cual el usuario podra eliminar los posts
     * que ya no quieran en su comentario, todos los post del main
     *
     * @params int id del plan
     * @parmas int id del subcomentario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments($idP)
    {
        $this->Negocio->delete_subcomments($idP);
    }

    /**
     * Metodo que se usa para eliminar los subcomentarios con los cuales los
     * negocios podran eliminar los comentarios de los post principales que
     * ya no quieran tener en cuenta en su post y asi evitar si postean algo que
     * es malo para el negocio o no es cierto
     *
     * @params int id del pulzo
     * @params int id del comentario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments_plains($id, $idC)
    {
        $this->Negocio->delete_comments_specific($id, $idC);
    }

    /**
     * Metodo que se usa para borrar solo un comentario especifico
     * con el cual el negocio podra borrar un comentario que ya
     * no quiera tener en su post
     *
     * @params int id del plan
     * @params int id del comentario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments_specific($idP, $idC)
    {
        $this->Negocio->delete_subcomments_specific($idP, $idC);
    }

    /**
     * Metodo que se usa para saber quien el dia ay pulzos
     * con el cual el negocio podra ver quien ira ese dia 
     * a su establecimiento
     *
     * @params int id del empresa
     *
     * @return void
     * @author Jorge Leon
     **/
    public function pulzos_hoy($id){
        $i=0;
        $invitados=array();
        $datos['today']=get_invitedToday($id);
        if(empty($datos['today'])){ echo "<div class='' style='margin-top:20px;color:#994499'>No hay usuarios registrados hoy</div>"; }
        $this->load->view('negocios/pulzos_hoy', $datos);
    }

    /**
     **/
    public function pulzos_semana($id){
        $fechaHoy=strftime("%Y-%m-%d");
        $fechaWeek=explode(' ',unix_to_human(strtotime("+1 week +1 day")));
        $fechaSemana=$fechaWeek[0];
        
        //Conversion de hoy a TimeStamp
        $hoyStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        
        //Conversion de termino a TimeStamp
        $corte=explode('-',$fechaWeek[0]);
        $semanaStamp = mktime(0, 0, 0, $corte[1], $corte[2], $corte[0]);

        $datos['today']=$this->Negocio->get_pulzos_semanaAll($id);
        if(empty($datos['today'])){ echo "<div class='' style='color:#994499;margin-top:20px'>No hay usuarios registrados esta semana</div>"; }
        foreach($datos['today'] as $fechas)
        {
            $content = explode(' ',unix_to_human($fechas->planFechaInicio));
            $datos['fechas']=$content[0];
            $datos['fechasTermino']=$fechaWeek[0];
            if($content[0]>=$fechaHoy && $content[0]<=$fechaWeek[0])
            {
                $datos['semanaInvitados']=$this->Negocio->get_pulzo_semana($fechas->planFechaInicio, $id);
            }
            $this->load->view('negocios/pulzos_semana',$datos);
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
        $valor = $this->Negocio->data_by_category($post);
        echo json_encode($valor);
    }

    /**
     * Metodo que se usa para poder recargar la parte de 
     * comentarios esto para que no se recargue tioda la pagina sino,
     * solo los comentarios que se tienen en la publicacion en la cual
     * se esta llevando la accion
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_comment_company($id_pulzo)
    {
        $datos['pulzo'] = $this->Negocio->get_simple_pulzo($id_pulzo);
        $this->load->view('negocios/recarga_empresa', $datos);
    }

    /**
     * Metodo que se utiliza para completar el formulario con el que 
     * el administrador crea los eventos generales  
     *
     * @params int id del negocio
     * @return void
     * @author jorgeLeon 
     **/
    public function administrador($id=null)
    {
        $datos['dias'] = days();
        $datos['meses'] = month();
        $datos['horas'] = hours();
        $datos['tipo']=array('normal'=>'Normal','finDeSemana'=>'Fin-de-Semana','entreSemana'=>'Entre-Semana');
        $datos['diaSemana']=array('1'=>'Lunes','2'=>'Martes','3'=>'Miercoles','4'=>'Jueves','5'=>'Viernes');
        $giro=$this->Negocio->all_data('giro');
        $subgiro = $this->Negocio->all_data('subcategorias');
        $datos['giros']=create_array($giro);
        $datos['subgiro']=create_array($subgiro);
        $ide=0;
        $ruta=0;
        
        //insercion de datos en pulzos
        if(isset($_POST['admin'])){
            $admin=$_POST['admin'];
            if(isset($admin['planImagenRuta']))
            {
                $ruta=$admin['planImagenRuta'];
                $ide=$admin['planImagenId'];
            }
            
            unset($admin['planImagenId']);
            unset($admin['planImagenRuta']);
            $admin['pulzoUsuarioId']=$id;
            $admin['pulzoTipo']=4;
            $admin['pulzoFechaInicio']=mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $admin['pulzoImagenRuta']=$ruta;
            $admin['pulzoFechaFin']=mktime(0, 0, 0, $admin['mes'], $admin['dia'], date('Y'));
            $admin['pulzoFechaCreacion']=mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $admin['pulzoTipoComunicacion']= '2';
            
            unset($admin['dia']);
            unset($admin['mes']);
            $val=$this->Negocio->insert_admin($admin);
            //insercion de datos en planesusuarios
            $planesUsuario = array('planUsuarioId' => $this->session->userdata('id'),
                                   'planTipo'=>'0',
                                   'planEmpresaPosteo'=> $this->session->userdata('idN'),
                                   'planMensaje'=>$admin['pulzoTitulo'],
                                   'planImagenId'=>$ide,
                                   'planFechaFin'=>$admin['pulzoFechaFin'],
                                   'planHoraFin'=>$admin['pulzoHoraFin'],
                                   'planDireccion'=>$admin['pulzoUbicacion'],
                                   'planDescripcion'=>$admin['pulzoAccion'],
                                   'planFechaCreacion'=>$admin['pulzoFechaCreacion'],
                                   'planLugar'=>$admin['pulzoUbicacion'],
                                   'planFechaInicio'=>$admin['pulzoFechaCreacion'],
                                   'planEmpresaPulzoId'=>$val,
                                   'planIdEmpresa'=>$id
                );
            $this->Negocio->insert_adminPlan($planesUsuario);
        }
        if($ide!='0')
            {
            $idImagen=$this->Negocio->get_last_plan($ide);
            $this->Negocio->update_imagenId($idImagen->planImagenId, $idImagen->planId,$this->session->userdata('id'));
            }
        $this->load->view('negocios/administrador',$datos);   
    }
    
    /**
     * Metodo que se usa para autogenerar los subgiros en las
     * listas desplegables en la seccion del administrador
     *
     * @params 
     * @return imprime el valor devuelto como json_encode
     * @author jorgeLeon 
     **/
    public function createSubGiro()
    {
            $post = $this->input->post('idC');
            $valor=$this->Negocio->get_subgiro($post);
            echo json_encode($valor);
    }
    
    /**
     * Metodo que se usa para subir una imagen caracteristica
     * del evento general dado de alta por el administrador
     * en la seccion del mismo. 
     *
     * @params 
     * @return void
     * @author jorgeLeon 
     **/
    public function crearImagen(){
        // verificar si el formulario ha sido mandado.

        if($_FILES['imagen']!= '')
        {
            $file_path = './statics/img_eventos/'.$this->session->userdata('id').'/';
            //create directory

            @mkdir($file_path, 0777, true);

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
                $post['idUsuario']=$this->session->userdata('id');
                $post['imagenRuta'] = 'statics/img_eventos/'.$this->session->userdata('id').'/'.$file_info['file_name'];
                $post['imagenFechaCreacion'] = time();
                $post['imagenFechaModificacion'] = time();
                $insert_id = $this->Negocio->save_image($post);
                $datos['imagenRuta'] = 'statics/img_eventos/'.$this->session->userdata('id').'/'.$file_info['file_name'];
                // Fin
                $datos['idImagen']=json_encode($insert_id);
                echo "<img src=".base_url().$datos['imagenRuta']."  width='140' height='140'/>";
                echo "<input type='hidden' name='admin[planImagenId]' id='planImagen' value='".$datos['idImagen']."'/>";
                echo "<input type='hidden' name='admin[planImagenRuta]'  value='".$datos['imagenRuta']."'/>";
                
                }
        }
    }

    /**
     * Metodo que se usa solo una vez ya que su fin 
     * principalmente es agrupar a todos los usuarios para que
     * sean amigos y seguidores del administrador, esto
     * con el fin de que todos eventos generales sean vistos por 
     * todos los usuarios
     * 
     * @params 
     * @return void
     * @author jorgeLeon 
     **/
    
    public function amigosAwebo()
    {
        $id=$this->Negocio->getAwebo();
         $awebo=array();
         $awebo2=array();
        foreach($id as $n):
            $awebo['amigoUsuarioId']='822';
            $awebo['amigoAmigoId']=$n->id;
            $awebo['amigoAceptado']='3';
            $awebo['amigoFechaCreacion']=time();
            $awebo['amigoTipo']='1';
            $this->Negocio->insertA($awebo);
            
            $awebo2['amigoUsuarioId']=$n->id;
            $awebo2['amigoAmigoId']='822';
            $awebo2['amigoAceptado']='3';
            $awebo2['amigoFechaCreacion']=time();
            $awebo2['amigoTipo']='1';
            $this->Negocio->insertA($awebo2);
      endforeach;
    }

	/**
	 *
	 **/
	public function create_estados()
    {
        $post = $this->input->post('ciudad');
        $valor = $this->Negocio->estados_pais($post);
        echo json_encode($valor);
    }

    /**
     * Metodo que se usa para cargar la vista
     * de el mapa de google maps para que el usuario
     * al momento de comentar especifique la posicion
     * geografica en la que quiere que aparezca el
     * respectivo comentario
     *
     * @params int id del pulzo
     * @return void
     * @author jorgeLeon
     **/    
    public function ubicacion_comentario(){
        $this->load->view('negocios/ubicacion_comentario'); 
    }

    /**
     * Metodo que se usa para poder actualizar las notificaciones que 
     * la empresa vaya teniendo dependiendo si le llegan un mensaje o
     * si les llega una notificacion de algun comentario o algo por el
     * estilo
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_header_notifications($id)
    {
        $datos['notificaciones'] = $this->Negocio->update_notifications_company($id);
        $datos['mensajes'] = $this->Negocio->inbox_total($this->session->userdata('id'), '1');
        $this->load->view('negocios/actualizar_header',$datos);
    }

    /**
     * Metodo que se encarga de guardar una geoetiqueta con la posicion de
     * los datos pero sin ofertas, esto solamente va ligado a una imagen que
     * se mostrara en la geoetiqueta que se tiene actualmente en la parte
     * de la empresa cuando estos quieran subir alguna imagen de alguna
     * cosa que ellos desean
     *
     * @params int id del negocio como negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_imagen_negocio($id)
    {
        $text_message = $this->input->post('Pulzos');
        $data_scribble = $this->input->post('Scribble');
        if($_FILES['image']['name'] != '')
        { //CHECK IF THE GLOBAL VAR IS EMPTY **BEGIN**
            //CARGAR LA LIBRERIA DE LAS IMAGENES
            $this->load->library('image_lib');

            $file_path = './statics/img_geotag_company/'.$this->session->userdata('id').'/'.$id.'/';
            //CREAR EL DIRECTORIO
            @mkdir($file_path, 0777, true);

            //SE CREA DIRECTORIO PARA THUMBNAIL
            $file_path1 = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/';
            //SE CREA EL DIRECTORIO
            @mkdir($file_path1, 0777, true);

            //PREPARAR EL ARCHIVO PARA SUBIRLO
            $upload_settings = array(
                'upload_path'=>$file_path,
                'allowed_types'=>'gif|jpg|jpeg|png',
                'max_size'=>'1000000000000',
                'max_width'=>'1300000000',
                'max_height'=>'1300000000',
                'remove_spaces'=>true,
                'encrypt_name'=>true,
            );
            
            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('image'))
            {//IF FOR UPLOAD FILES **BEGIN**
                //SE OBTIENE INFORMACION DEL ARCHIVO
                $file_info = $this->upload->data();
                $exif = exif_read_data($file_info['full_path'], 0, true);
                $valores2 = '';

                foreach($exif as $key => $section)
                {
                    foreach($section as $name => $key)
                    {
                        $text = $key.$name;
                        if($text == 'IFD0Orientation')
                        {
                            $valores2 = $val;
                        }
                    }
                }
                //PART WHERE SAVE DATA
                //FIRST INSERT DATA TO THE PULZOS TABLE
                $pulzos_table = array('pulzoUsuarioId'=>$id,
                                      'pulzoTitulo'=>$text_message['pulzoTitulo'],
                                      'pulzoAccion'=>'0',
                                      'pulzoTipoComunicacion'=>'4',
                                      'pulzoTipo'=>'3',
                                      'pulzoFechaCreacion'=>time());
                $id_pulzos = $this->Negocio->save_datas_register($pulzos_table, 'pulzos');

                //GET DATA FOR INSERT IN SCRIBBLES
                $datos_negocios = get_data_company($this->session->userdata('id'));
                $imagen_negocios_thumb = get_thumb_avatar($this->session->userdata('id'));
                $imagen_negocios = substr($imagen_negocios_thumb, 2);
                $imagen_replace = str_replace('/', '-', $imagen_negocios);
                $imagen_complete = 'http:--www.pulzos.com-'.$imagen_replace;

                //SECOND INSERT DATA IN GEOTAGS TABLE
                $geotags_table = array('scribbleUsuarioId'=>$this->session->userdata('id'),
                                       'scribbleTexto'=>$text_message['pulzoTitulo'],
                                       'scribbleLat'=>$data_scribble['scribbleLat'],
                                       'scribbleLng'=>$data_scribble['scribbleLng'],
                                       'scribbleNombreUsuario'=>$datos_negocios->negocioNombre,
                                       'scribbleImagenUsuario'=>$imagen_complete,
                                       'scribbleFatherId'=>'0',
                                       'totalComentarios'=>'0',
                                       'heading'=>'2100',
                                       'altura'=>'.3',
                                       'atributo'=>'0',
                                       'scribbleAnexos'=>'0');
                $id_scribble = $this->Negocio->save_datas_register($geotags_table, 'scribbles_comments');

                //THIRD PART SAVE IN PLAN
                $planes_table = array('planUsuarioId'=>$this->session->userdata('id'),
                                      'planDescripcion'=>$text_message['pulzoTitulo'],
                                      'planFechaCreacion'=>time(),
                                      'planEmpresaPosteo'=>$id,
                                      'planEmpresaPulzoId'=>$id_pulzos,
                                      'planScribbleId'=>$id_scribble);
                $id_planes = $this->Negocio->save_datas_register($planes_table, 'planesusuarios');
                //MAIN IMAGE
                $ruta = 'statics/img_geotag_company/'.$this->session->userdata('id').'/'.$id.'/'.$file_info['file_name'];

                //PART FOR CHECK AN CREATE DATA
                if($file_info['image_width'] < $file_info['image_height'])
                {
                    if($file_info['image_width'] == 800 || $file_info['image_height'] == 800)
                    {
                        unset($config);
                        $config['source_image'] = '';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 480;
                        $config['height'] = 640;
                        $config['new_image'] = $ruta;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $corte = explode(".", $file_info['file_name']);
                    $nombres_usuario1 = 'hola';
                    $name_short1 = $corte[0];
                    //TAKE OUT RARE CHARACTERS
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

                    if($valores2 == 6 || $valores2 == '6')
                    {
                        unset($config);
                        $this->image_lib->clear();

                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $ruta;
                        $config['new_image'] = $ruta;
                        $config['rotation_angle'] = '270';

                        //INITIALIZE THE NEW CONFIG
                        $this->image_lib->initialize($config);

                        //ROTATE THE IMAGE
                        $this->image_lib->rotate();

                        //PART OF THE THUMBNAIL, SETTINGS
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $ruta;
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
                        $ruta_thumb1 = 'statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';
                        $ruta_thumb = str_replace('/', '-', $ruta_thumb1);
                        $ruta1 = str_replace('/', '-', $ruta);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        //SAVE THE FOURTH DATA
                        $imagen_scribble = array('geoPictureIdTag'=>$id_scribble,
                                                 'geoPictureImgNormal'=>$ruta1,
                                                 'geoPictureImgThumb'=>$ruta_thumb);
                        $img_thumg = $this->Negocio->save_datas_register($imagen_scribble, 'geo_pictures');
                    }
                    elseif($valores2 == 3 || $valores2 == '3')
                    {
                        unset($config);
                        $this->image_lib->clear();
                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $ruta;
                        $config['new_image'] = $ruta;
                        $config['rotation_angle'] = '180';
                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        unset($config);
                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $ruta;
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
                        $ruta_thumb1 = 'statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';
                        $ruta_thumb = str_replace('/', '-', $ruta_thumb1);
                        $ruta1 = str_replace('/', '-', $ruta);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        //SAVE THE FOURTH DATA
                        $imagen_scribble = array('geoPictureIdTag'=>$id_scribble,
                                                 'geoPictureImgNormal'=>$ruta1,
                                                 'geoPictureImgThumb'=>$ruta_thumb);
                        $img_thumg = $this->Negocio->save_datas_register($imagen_scribble, 'geo_pictures');
                    }
                    else
                    {
                        unset($config);
                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $ruta;
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
                        $ruta_thumb1 = 'statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';
                        $ruta_thumb = str_replace('/', '-', $ruta_thumb1);
                        $ruta1 = str_replace('/', '-', $ruta);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        //SAVE THE FOURTH DATA
                        $imagen_scribble = array('geoPictureIdTag'=>$id_scribble,
                                                 'geoPictureImgNormal'=>$ruta1,
                                                 'geoPictureImgThumb'=>$ruta_thumb);
                        $img_thumg = $this->Negocio->save_datas_register($imagen_scribble, 'geo_pictures');
                    }
                }
                elseif($file_info['image_height'] < $file_info['image_width'])
                {
                    if($file_info['image_width'] > 800)
                    {
                        unset($config);
                        $config['source_image'] = $ruta;
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 800;
                        $config['height'] = 598;
                        $config['new_image'] = $ruta;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $corte = explode(".", $file_info['file_name']);
                    $nombres_usuario1 = 'hola';
                    $name_short1 = $corte[0];
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
                    if($valores2 == 6 || $valores2 == '6')
                    {
                        unset($config);
                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $ruta;
                        $config['new_image'] = $ruta;
                        $config['rotation_angle'] = '270';
                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        unset($config);
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $ruta;
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
                        $ruta_thumb1 = 'statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';
                        $ruta_thumb = str_replace('/', '-', $ruta_thumb1);
                        $ruta1 = str_replace('/', '-', $ruta);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        //SAVE THE FOURTH DATA
                        $imagen_scribble = array('geoPictureIdTag'=>$id_scribble,
                                                 'geoPictureImgNormal'=>$ruta1,
                                                 'geoPictureImgThumb'=>$ruta_thumb);
                        $img_thumg = $this->Negocio->save_datas_register($imagen_scribble, 'geo_pictures');
                    }
                    elseif($valores2 == 3 || $valores2 == '3')
                    {
                        unset($config);
                        $this->image_lib->clear();
                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $ruta;
                        $config['new_image'] = $ruta;
                        $config['rotation_angle'] = '180';
                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        unset($config);
                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $ruta;
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
                        $ruta_thumb1 = 'statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';
                        $ruta_thumb = str_replace('/', '-', $ruta_thumb1);
                        $ruta1 = str_replace('/', '-', $ruta);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        //SAVE THE FOURTH DATA
                        $imagen_scribble = array('geoPictureIdTag'=>$id_scribble,
                                                 'geoPictureImgNormal'=>$ruta1,
                                                 'geoPictureImgThumb'=>$ruta_thumb);
                        $img_thumg = $this->Negocio->save_datas_register($imagen_scribble, 'geo_pictures');
                    }
                    else
                    {
                        unset($config);
                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $ruta;
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
                        $ruta_thumb1 = 'statics/img_geotag_company/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'_thumb.jpg';
                        $ruta_thumb = str_replace('/', '-', $ruta_thumb1);
                        $ruta1 = str_replace('/', '-', $ruta);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        //SAVE THE FOURTH DATA
                        $imagen_scribble = array('geoPictureIdTag'=>$id_scribble,
                                                 'geoPictureImgNormal'=>$ruta1,
                                                 'geoPictureImgThumb'=>$ruta_thumb);
                        $img_thumg = $this->Negocio->save_datas_register($imagen_scribble, 'geo_pictures');
                    }
                }
            } //IF FOR UPLOAD FILES **END**
        } //CHECK IF THE GLOBAL VAR IS EMPTY **END**
    }

    /**
     * Method that load the form where the main company
     * will create a new branch of it. This for another
     * companies that exists but i another cities or countries
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function create_branch()
    {
        $post = $this->input->post('Branch');
        if($post != '')
        {
            //part where the brach save like a user of the platform
            $pass = $this->input->post('Password');
            $activacion = 0;
            $password = encrypt_password($pass, $this->config->item('encryption_key'));
            $creacion = date('Y-m-d H:i:s');
            $uid = $this->Negocio->save_user($activacion,
                                             $post['negocioEmail'],
                                             $password,
                                             $creacion,
                                             $post['negocioNombre']);

            $post['negocioUsuarioId'] = $uid;//this->session->userdata('id');
            $post['negocioEsSucursal'] = $this->session->userdata('idN');
            $post['negocioFechaCreacion'] = time();
            $post['negocioFechaModificacion'] = time();
            $post['negocioPrimerIngreso'] = 0;
            //var_dump($post);
            $idNegocio = $this->Negocio->save($post);
        }
        else
        {
            $data['negocioSucursal'] = $this->Negocio->data_negocio($this->session->userdata('idN'));
            $content = $this->load->view('negocios/form_sucursal', $data, TRUE);
            $this->load->view('main/template', array('content'=>$content));
        }
    }

    /**
     * Method where call the process of the overlay once
     * the user press the button of go to the contract, because
     * if don't accept the contract the user coudln't make
     * offerts for her users
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function contract()
    {
        $data = $this->Negocio->data_negocio($this->session->userdata('idN'));
        if($data->negocioImagenId == '0')
        {
            $this->Negocio->update_status_activate('1', $this->session->userdata('idN'));
        }
        $header = $this->load->view('negocios/header', '', true);
        $content = $this->load->view('negocios/contract', '', true);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Method where the overlay give the option to download
     * the app desktop of pulzos, all this for the user can
     * navigate over all the platform
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function download_app()
    {
        $data = $this->Negocio->data_negocio($this->session->userdata('idN'));
        if($data->negocioImagenId == '1')
        {
            $this->Negocio->update_status_activate('2', $this->session->userdata('idN'));
        }
        $header = $this->load->view('negocios/header', '', TRUE);
        $content = $this->load->view('negocios/download_app', '', TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Method that use for load the contract that the user need to
     * accept for start to create offert for the user, but if the
     * new company don't accept this condition, can't create offert
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function contract_text()
    {
        $this->load->view('negocios/contract_text');
    }

    /**
     * Method where the form send before to redirect again to the 
     * profile of the company, the form send just, dont make anything
     * this function, just redirect to the profile
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function form_direct()
    {
        redirect('negocios/perfil');
    }

    /**
     * Method where the platform will check if the email exists, if
     * is true so the platform send and notification or message with
     * information about the problem with the email, so the user or
     * company need to register the account with another email
     *
     * @params string email
     * @return int total
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function checkEmailExists($mail)
    {
        $val = $this->Negocio->countEmailSent($mail);
        echo $val;
    }
}
